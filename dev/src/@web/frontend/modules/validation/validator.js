export default class Validator {

	static message = () => 'Validation error';

	/**
	 * @param {function|null} message
	 * @param {function|null} test
	 */
	constructor(message = null, test = null) {
		this.message = message === null ? this.constructor.message : message;
		if (typeof test === "function") this.test = test;
		this.args = {};
		this.continueOnError = true;
		this.id = this.constructor.name;
	}

	/**
	 * @param {function|string} message
	 * @returns {Validator}
	 */
	setMessage(message) {
		this.message = message;
		return this;
	}

	/**
	 * @returns {Validator}
	 */
	break() {
		this.continueOnError = false;
		return this;
	}

	/**
	 * @param id
	 * @returns {Validator}
	 */
	identify(id) {
		this.id = id;
		return this;
	}

	/**
	 * @param value
	 * @param  {Validation} validation
	 */
	test(value, validation) { return true; }

	/**
	 * @param {Validation} validation
	 */
	validate(validation) { return this.test(validation.value, validation);}
}