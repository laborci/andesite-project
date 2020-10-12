import AbstractInputBrick from "zengular-codex/admin/inputs/~abstract-input-brick";
import {Brick}            from "zengular";
import twig               from "./gmark-big.twig";
import "./gmark-big.scss";
import GMarkBlock         from "./gmark-block.brick";
import AppEvent           from "zengular/src/app-event";
import GMarkSelect        from "./gmark-select.brick";
import GMarkBigModal      from "./gmark-big-modal.brick";

@Brick.register('codex-input-gmark-big', twig)
export default class InputGmarkBig extends AbstractInputBrick {

	getValue() {
		return this.$$('value').node.value;
	}
	setValue(value) {
		this.$$('value').node.value = value;
	}
	setOptions(options) {
		return super.setOptions(options)
	}

	onRender() {
		this.$$('open-editor').listen('click', (event)=>{
			GMarkBigModal.modalify({options: this.options, value: this.value, valueHolder: this});
			event.preventDefault();
		});
	}
}