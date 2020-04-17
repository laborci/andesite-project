<?php namespace Application\AdminCodex\GhostHelper;

use Andesite\Codex\Form\AdminDescriptor;
use Andesite\Codex\Form\DataProvider\GhostDataProvider;
use Andesite\Codex\Form\Field;
use Andesite\Codex\Interfaces\DataProviderInterface;

/**
 * @label-field id:
 * @label-field name:
 * @label-field password:
 * @label-field email:
 * @label-field groups:
 * @label-field groups.admin:
 * @label-attachment avatar: avatár
 */
abstract class UserGhostCodexHelper extends AdminDescriptor{


	/** @var Field */ protected $id;
	/** @var Field */ protected $name;
	/** @var Field */ protected $password;
	/** @var Field */ protected $email;
	/** @var Field */ protected $groups;
	/** @var Field */ protected $avatar;

	public function __construct(){
		$this->id = new Field('id', 'id');
		$this->name = new Field('name', 'name');
		$this->password = new Field('password', 'password');
		$this->email = new Field('email', 'email');
		$this->groups = new Field('groups', 'groups', ['admin'=>'admin']);
		$this->avatar = new Field('avatar', 'avatár');
	}

	protected function createDataProvider(): DataProviderInterface{
		return new GhostDataProvider(\Application\Ghost\User::class);
	}

}
