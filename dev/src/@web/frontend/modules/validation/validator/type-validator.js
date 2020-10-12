import Validator from "../validator";

export default class TypeValidator extends Validator {
	/**
	 * @param {string} type
	 */
	constructor(type) {
		super();
		this.args = {type};
	}
	test(value, validation) { if (typeof value !== this.args.type) return validation.resultError();}
}
