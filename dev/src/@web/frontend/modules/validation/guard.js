import Converter from "./converter";


export default class Guard {
	constructor() {
		/** @readonly {ValidationSet[]} */
		this.validations = [];
	}

	create(key, alias, as = null) {
		let validationSet = new ValidationSet(key, alias, as);
		this.validations.push(validationSet);
		return validationSet;
	}

	test(subject) {
		return new Promise((resolve, reject) => {
			let valid = true;
			let result = [];
			let validations = [];
			this.validations.forEach(validationSet => validations.push(validationSet.validate(subject)));

			Promise.all(validations)
				.then(results => {
					results.forEach(validationSet => {
						if (!validationSet.isValid) {
							result = result.concat(validationSet.result);
							valid = false;
						}
					})
					valid ? resolve(true) : reject(result);
				});
		});
	}
}

class ValidationSet {
	constructor(key, alias, as = null) {
		/** @readonly {string} */
		this.key = key;
		/** @readonly {string} */
		this.as = as === null ? key : as;
		/** @readonly {string} */
		this.alias = alias === null ? key : alias;

		/** @protected {Array} */
		this.validators = [];
		/** @protected {any} */
		this._default = undefined;
		/** @protected {boolean} */
		this._allowEmpty = false;
		/** @protected {boolean} */
		this._valid = true;
		/** @protected */
		this.result = [];
	}

	default(value = null) {
		this._default = value;
		return this;
	}
	allowEmpty() {
		this._allowEmpty = true;
		return this;
	}
	get isValid() { return this._valid; }
	add(validator) {
		this.validators.push(validator);
		return this;
	}


	validate(subject) {
		this.result = [];
		let key = this.key;
		if (typeof subject[key] === "undefined" && this._allowEmpty) return;
		if (typeof subject[key] === "undefined" && typeof this._default !== "undefined") subject[key] = this._default;

		let tasks = [];

		for (let i in this.validators) {
			let validator = this.validators[i];

			if (validator instanceof Converter) {
				validator.convert(subject, key);
			} else {
				tasks.push(new Validation(this, validator, subject).validate());
			}
		}

		return Promise.all(tasks)
			.then(validations => {
				for (let i in validations) {
					let validation = validations[i];
					if (validation.result instanceof Error) {
						this.result.push(validation.result);
						this._valid = false;
						if (!validation.continueOnError) break;
					}
				}
				return this;
			});
	}
}

class Validation {
	constructor(validationSet, validator, subject) {
		/** @readonly {ValidationSet} */
		this.validationSet = validationSet;
		/** @readonly {Validator} */
		this.validator = validator;
		/** @readonly {subject} */
		this.subject = subject;
		/** @readonly {boolean|Error} */
		this.result = true;
	}

	get key() { return this.validationSet.key; }
	get alias() { return this.validationSet.alias; }
	get value() { return this.subject[this.key]; }
	get args() { return this.validator.args; }
	get id() { return this.validator.id; }
	get continueOnError() { return this.validator.continueOnError; }

	validate() {
		let result = this.validator.validate(this);
		if (!(result instanceof Promise)) return Promise.resolve(this);
		return result.then(() => this);
	}

	resultOk() {
		this.result = true;
		return this;
	}
	resultError(code = null) {
		this.result = new Error(this, code);
		return this;
	}
}

class Error {
	/**
	 *
	 * @param {Validation} validation
	 * @param code
	 */
	constructor(validation, code) {
		this.code = code;
		this.validation = validation;
		this.as = validation.validationSet.as;
	}

	get message() {
		return typeof this.validation.validator.message === "function" ? this.validation.validator.message(this, this.validation) : this.validation.validator.message;
	}

	toString() {
		return typeof this.validation.validator.message === "function" ? this.validation.validator.message(this, this.validation) : this.validation.validator.message;
	}
}