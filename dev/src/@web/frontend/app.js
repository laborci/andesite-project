
import {Application} from "zengular";

import './style/style.scss';
//mport "./style/misc/**/*.scss";
//mport "./template/**/*.scss";
//mport "./bricks/**/*.js";

import AppEvent      from "zengular/src/app-event";


let application = new class extends Application {

	initialize() {}

	run() {
		AppEvent.broadcast('app-init-done');
	}

};

export default application;