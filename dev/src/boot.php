<?php ( function ($classLoader){
	Andesite\Core\Boot\Andesite::setup(__DIR__ . "/../..", "dev/ini/env", "app/var/env.php", $classLoader);
} )(include __DIR__ . '/../../vendor/autoload.php');