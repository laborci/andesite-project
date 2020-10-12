<?php namespace Application\Module;

use Andesite\Core\Module\Module;
use Andesite\Core\ServiceManager\ServiceContainer;
use Andesite\Util\Alert\AlertInterface;
use Andesite\Util\Alert\TelegramAlert;


class Alert extends Module{

	public static function run($config){
		ServiceContainer::shared(AlertInterface::class, function () use ($config){return new TelegramAlert($config['bot']);});
	}

}