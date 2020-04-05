<?php namespace Application;

use Andesite\Ghost\Decorator;

/**
 * @ghost User
 */
class Ghosts{

	public function user(Decorator $decorator){
		$decorator->protectField('password', false, true);
		$decorator->hasAttachment('avatar')->maxFileCount(1)->acceptExtensions('png', 'jpg')->maxFileSize(500 * 1024);
	}

}