import Validator from "../validator";

export default class EmailValidator extends Validator {
	test(value, validator) {
		if (!/\S+@\S+\.\S+/.test(value)) return validator.resultError();
	}
}
