import Validator from "../validator";

export default class ExistsValidator extends Validator {
	constructor() {
		super();
		this.continueOnError = false;
	}
	test(value, validator) { if (typeof value === "undefined") return validator.resultError(); }
}
