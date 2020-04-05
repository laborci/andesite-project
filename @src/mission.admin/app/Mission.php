<?php

namespace Application\AdminCodex;

use Andesite\Codex\CodexMission;
use Andesite\Codex\Form\CodexMenu;
use Andesite\Mission\Web\Routing\ApiManager;
use Andesite\Mission\Web\Routing\Router;

class Mission extends CodexMission{

	protected function menu(CodexMenu $menu){
		$menu->addCodexItem(Form\UserCodex::class);
	}

	public function route(Router $router){
		parent::route($router);
		ApiManager::setup($router, '/api', __NAMESPACE__.'\\Api');
	}

}