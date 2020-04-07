<?php namespace Application;

use Andesite\Core\Boot\Andesite;
use Andesite\Core\Module\Module;
use Andesite\Core\ServiceManager\ServiceContainer;
use Andesite\Util\Dumper\Dumper;
use Andesite\Util\Dumper\DumpInterface;
use Andesite\Util\RemoteLog\RemoteLog;
use Andesite\Util\ErrorHandler\ErrorHandler;
use Andesite\Util\ErrorHandler\ExceptionHandlerInterface;
use Andesite\Util\ErrorHandler\FatalErrorHandlerInterface;
use Andesite\DBAccess\Connection\SqlLogInterface;

class Startup extends Module{

	public static function run($config){
		if(Andesite::Service()->isDevMode()){
			$remoteLog = new RemoteLog($config['remote-log-host'], Andesite::Service()->getRequestId());
			ServiceContainer::value(ExceptionHandlerInterface::class, $remoteLog);
			ServiceContainer::value(FatalErrorHandlerInterface::class, $remoteLog);
			ServiceContainer::value(DumpInterface::class, $remoteLog);
			ServiceContainer::value(SqlLogInterface::class, $remoteLog);
			ErrorHandler::Service()->register();
		}
		Dumper::load();
	}

}