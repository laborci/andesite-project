<?php namespace Application;

use Andesite\Ghost\Decorator;
use Symfony\Component\Validator\Constraints\Email;

/**
 * @ghost User
 */
class Ghosts{

	public function user(Decorator $decorator){
		$decorator->protectField('password', true, true);
		$decorator->hasAttachment('avatar')->maxFileCount(1)->acceptExtensions('png', 'jpg')->maxFileSize(5000 * 1024);
		$decorator->addValidator('email', new Email());
	}

}

