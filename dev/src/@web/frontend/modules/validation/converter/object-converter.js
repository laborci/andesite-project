import Converter from "../converter";

export default class ObjectConverter extends Converter {
	convert(subject, key) { this.converter(subject, key);}
}