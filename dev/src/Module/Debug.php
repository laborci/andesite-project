<?php namespace Application\Module;

use Andesite\Core\Boot\Andesite;
use Andesite\Core\Module\Module;
use Andesite\Core\ServiceManager\ServiceContainer;
use Andesite\Util\Dumper\Dumper;
use Andesite\Util\Dumper\DumpInterface;
use Andesite\Util\ErrorHandler\ErrorHandlerInterface;
use Andesite\Util\RemoteLog\RemoteLog;
use Andesite\Util\ErrorHandler\ErrorHandler;
use Andesite\Util\ErrorHandler\ExceptionHandlerInterface;
use Andesite\Util\ErrorHandler\FatalErrorHandlerInterface;
use Andesite\DBAccess\Connection\SqlLogInterface;
use Andesite\Util\RemoteLog\RemoteLogSender;
use Andesite\Util\RemoteLog\RemoteLogSenderSocket;
use Symfony\Component\HttpFoundation\Request;

class Debug extends Module{

	public static function run($config){
		if (Andesite::Service()->isDevMode()){
			$request = ServiceContainer::get(Request::class);
			$requestId = Andesite::Service()->getRequestId();
			$sender= null;
			if ($config['remote-log-type'] === 'tcp'){
				$sender = new RemoteLogSender(
					$config['remote-log'],
					$requestId,
					$request->getMethod(),
					$request->getHost(),
					$request->getPathInfo()
				);
			}elseif ($config['remote-log-type'] === 'socket' && file_exists($config['remote-log'])){
				$sender = new RemoteLogSenderSocket(
					$config['remote-log'],
					$requestId,
					$request->getMethod(),
					$request->getHost(),
					$request->getPathInfo()
				);
				if(!$sender->hasResource()){
					$sender = null;
				}
			}
			if(!is_null($sender)){
				$remoteLog = new RemoteLog($sender);
				ServiceContainer::value(ExceptionHandlerInterface::class, $remoteLog);
				ServiceContainer::value(ErrorHandlerInterface::class, $remoteLog);
				ServiceContainer::value(FatalErrorHandlerInterface::class, $remoteLog);
				ServiceContainer::value(DumpInterface::class, $remoteLog);
				ServiceContainer::value(SqlLogInterface::class, $remoteLog);
				ErrorHandler::Service()->register();
			}
		}
		Dumper::load();
	}

}