<?php namespace Application\AdminCodex\GhostHelper;

use Andesite\Codex\Form\AdminDescriptor;
use Andesite\Codex\Form\DataProvider\GhostDataProvider;
use Andesite\Codex\Form\Field;
use Andesite\Codex\Interfaces\DataProviderInterface;

/**
 * @label-field id: 
 * @label-field name: név
 * @label-field email: 
 * @label-field password: 
 * @label-field nick: 
 * @label-field created: 
 * @label-field login: 
 * @label-field status: 
 * @label-field status.active: 
 * @label-field status.deleted: 
 * @label-field termsAccepted: 
 * @label-field groups: 
 * @label-field groups.visitor: látogató
 * @label-field groups.admin: 
 * @label-field groups.social: 
 * @label-field groups.moderator: 
 * @label-attachment avatar: avatár
 */
abstract class UserGhostCodexHelper extends AdminDescriptor{


	/** @var Field */ protected $id;
	/** @var Field */ protected $name;
	/** @var Field */ protected $email;
	/** @var Field */ protected $password;
	/** @var Field */ protected $nick;
	/** @var Field */ protected $created;
	/** @var Field */ protected $login;
	/** @var Field */ protected $status;
	/** @var Field */ protected $termsAccepted;
	/** @var Field */ protected $groups;
	/** @var Field */ protected $avatar;

	public function __construct(){
		$this->id = new Field('id', 'id');
		$this->name = new Field('name', 'név');
		$this->email = new Field('email', 'email');
		$this->password = new Field('password', 'password');
		$this->nick = new Field('nick', 'nick');
		$this->created = new Field('created', 'created');
		$this->login = new Field('login', 'login');
		$this->status = new Field('status', 'status', ['active'=>'active', 'deleted'=>'deleted']);
		$this->termsAccepted = new Field('termsAccepted', 'termsAccepted');
		$this->groups = new Field('groups', 'groups', ['visitor'=>'látogató', 'admin'=>'admin', 'social'=>'social', 'moderator'=>'moderator']);
		$this->avatar = new Field('avatar', 'avatár');
	}

	protected function createDataProvider(): DataProviderInterface{
		return new GhostDataProvider(\Application\Ghost\User::class);
	}

}
