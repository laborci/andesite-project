import Converter from "../converter";

export default class ValueConverter extends Converter {
	convert(subject, key) {subject[key] = this.converter(subject[key]);}
}