import Validator from "../validator";
import {Ajax}    from "zengular-util";


export default class AvailabilityValidator extends Validator {

	/**
	 * @param {function} endpoint
	 */
	constructor(endpoint) {
		super();
		this.endpoint = endpoint
	}

	test(value, validator) {
		return Ajax.json(this.endpoint, {value}).getJson.then(res => res.response === false ? validator.resultError() : true);
	}
}
