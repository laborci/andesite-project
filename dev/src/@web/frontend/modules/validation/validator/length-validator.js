import Validator from '../validator';

export default class LengthValidator extends Validator {

	static LONG = 1;
	static SHORT = 2;
	/**
	 * @param {number} min
	 * @param {number} max
	 */
	constructor(min, max) {
		super();
		this.args = {min, max}
	}

	test(value, validation) {
		if (value.length < this.args.min) return validation.resultError(LengthValidator.SHORT);
		if (value.length > this.args.max) return validation.resultError(LengthValidator.LONG);
	}
}