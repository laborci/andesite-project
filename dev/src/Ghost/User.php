<?php namespace Application\Ghost;

use Andesite\Auth\CommonUser;
use Andesite\Auth\RoleManager\RoleManager;
use Andesite\Auth\UserInterface;
use Andesite\Core\Env\Env;
use Andesite\Ghost\Model;
use Application\Andesite\Ghost\Shadow\__User;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;


/**
 * @database default
 * @table    user
 * @mutable  true
 */
class User extends __User implements UserInterface{

	use CommonUser;

	static protected function extendModel(Model $model): Model{
		return $model
			->protectField('password', true, true)
			->addAttachmentCategory('avatar', 5000 * 1024, 1, ['png', 'jpg', 'gif'])
			->addAttachmentCategory('header', 5000 * 1024, 1, ['png', 'jpg', 'gif'])
			->addValidator('email', new Email())
			;
	}
}
