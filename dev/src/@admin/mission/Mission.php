<?php

namespace Application\AdminCodex;

use Andesite\Codex\CodexMission;
use Andesite\Codex\Form\CodexMenu;
use Andesite\Codex\Interfaces\AuthInterface;
use Andesite\Core\ServiceManager\ServiceContainer;
use Andesite\Mission\Web\Routing\ApiManager;
use Andesite\Mission\Web\Routing\Router;
use Application\Service\CodexAuthService;

class Mission extends CodexMission{

	public function run($config){
		ServiceContainer::shared(AuthInterface::class, CodexAuthService::class);
		/** @var AuthInterface $auth */
		$auth = ServiceContainer::get(AuthInterface::class);
		/** @var \Application\Ghost\User $user */
		$user = $auth->whoAmI();
		if (!is_null($user)){
			$this->userAvatar = $user->getAvatar(32);
			$this->userName = $user->nick;
		}
		parent::run($config);
	}

	protected function menu(CodexMenu $menu){

		$menu->addCodexItem(Form\Cdx_User::class);
	}

	public function route(Router $router){
		parent::route($router);
		ApiManager::setup($router, '/api', __NAMESPACE__ . '\\Api');
	}

}