import Validator from "../validator";

export default class RegexValidator extends Validator {

	/**
	 * @param {RegExp} regex
	 */
	constructor(regex) {
		super();
		this.regex = regex
	}

	test(value, validator) {
		if (!this.regex.test(value)) return validator.resultError();
	}
}
