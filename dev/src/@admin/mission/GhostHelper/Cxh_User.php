<?php namespace Application\AdminCodex\GhostHelper;

use Andesite\Codex\Form\AdminDescriptor;
use Andesite\Codex\Form\DataProvider\GhostDataProvider;
use Andesite\Codex\Form\Field;
use Andesite\Codex\Interfaces\DataProviderInterface;

/**
 * @label-field id: 
 * @label-field email: 
 * @label-field password: 
 * @label-field name: 
 * @label-field group: 
 * @label-field group.anonymized: 
 * @label-field group.visitor: 
 * @label-field group.admin: 
 * @label-attachment avatar:
 * @label-attachment header: 
 */
abstract class Cxh_User extends AdminDescriptor{


	/** @var Field */ protected $id;
	/** @var Field */ protected $email;
	/** @var Field */ protected $password;
	/** @var Field */ protected $name;
	/** @var Field */ protected $group;
	/** @var Field */ protected $avatar;
	/** @var Field */ protected $header;

	public function __construct(){
		$this->id = new Field('id', 'id');
		$this->email = new Field('email', 'email');
		$this->password = new Field('password', 'password');
		$this->name = new Field('name', 'name');
		$this->group = new Field('group', 'group', ['anonymized'=>'anonymized', 'visitor'=>'visitor', 'admin'=>'admin']);
		$this->avatar = new Field('avatar', 'avatár');
		$this->header = new Field('header', 'header');
	}

	protected function createDataProvider(): DataProviderInterface{
		return new GhostDataProvider(\Application\Ghost\User::class);
	}

}
