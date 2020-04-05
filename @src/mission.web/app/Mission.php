<?php namespace Application\Mission\Web;

use Andesite\Ghost\GhostManager;
use Andesite\Mission\Web\Routing\ApiManager;
use Andesite\Mission\Web\Routing\Router;
use Andesite\Mission\Web\WebMission;
use Application\Mission\Web\Action\Auth\PasswordReset;

class Mission extends WebMission{

	public function route(Router $router){

		ApiManager::setup($router, '/api', __NAMESPACE__.'\\Api');
		GhostManager::Module()->routeThumbnail($router);

	}
}
