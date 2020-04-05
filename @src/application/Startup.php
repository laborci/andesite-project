<?php namespace Application;

use Andesite\Core\Boot\Andesite;
use Andesite\Core\Env\Env;
use Andesite\Core\Module\Module;
use Andesite\Core\ServiceManager\ServiceContainer;
use Andesite\DBAccess\Connection\SqlLogHookInterface;
use Andesite\Util\RemoteLog\RemoteLog;
use Andesite\Util\RemoteLog\SqlLogHook;

class Startup extends Module{

	public static function run($config){
		if(Andesite::Service()->isDevMode()){
			ServiceContainer::value(RemoteLog::class, new RemoteLog($config['remote-log-host']));
			ServiceContainer::shared(SqlLogHookInterface::class, SqlLogHook::class);
			RemoteLog::loadFacade();
		}else{
			RemoteLog::loadFakeFacade();
		}
	}

}