<?php namespace Application\Mission\Web;

use Andesite\Ghost\GhostManager;
use Andesite\Mission\Web\Middleware\Cache;
use Andesite\Mission\Web\Middleware\Measure;
use Andesite\Mission\Web\Routing\Router;
use Andesite\Mission\Web\WebMission;
use Application\Mission\Web\Action\Auth\PasswordReset;
use Application\Mission\Web\Middleware\AuthRequired;
use Application\Mission\Web\Middleware\DocumentResolver;


class Mission extends WebMission{

	public function route(Router $router){
		GhostManager::Module()->routeThumbnail($router);

//		$router->pipe(Measure::class);
//		$router->pipe(Middleware\ApiErrorMiddleware::class);
		$router->get('/*', Page\Index::class)();
	}
}
