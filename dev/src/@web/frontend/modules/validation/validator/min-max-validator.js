import Validator from "../validator";

export default class MinMaxValidator extends Validator {

	static BIGGER = 1;
	static SMALLER = 2;
	/**
	 * @param {number} min
	 * @param {number} max
	 */
	constructor(min, max) {
		super();
		this.args = {min, max}
	}

	test(value, validation) {
		if (value < this.args.min) return validation.resultError(MinMaxValidator.SMALLER);
		if (value > this.args.max) return validation.resultError(MinMaxValidator.BIGGER);
	}
}