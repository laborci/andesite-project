<?php namespace Application\Mission\Web;

use Andesite\Ghost\GhostManager;
use Andesite\Mission\Web\Routing\Router;
use Andesite\Mission\Web\WebMission;
use Application\Ghost\DomainRouter;

class Mission extends WebMission{

	public function route(Router $router){
		GhostManager::Module()->routeThumbnail($router);
		$router->api('/api', __NAMESPACE__.'\\Api')();
		$router->get('/*', Page\Index::class)();
	}

}
