<?php namespace Application\Ghost;

use Andesite\Attachment\AttachmentCategoryManager;
use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\DBAccess\Connection\Filter\Comparison;
use Andesite\DBAccess\Connection\Finder;
use Andesite\Ghost\Field;
use Andesite\Ghost\Ghost;
use Andesite\Ghost\Model;

/**
 * @method static GhostUserFinder search(Filter $filter = null)
 * @property-read $id
 * @property-write $password
 * @property-read AttachmentCategoryManager $avatar
 */
abstract class UserGhost extends Ghost{

	/** @var Model */
	public static $model;
	const Table = "user";
	const ConnectionName = "default";

		public static function f_id(){return new Comparison('id');}
		public static function f_name(){return new Comparison('name');}
		public static function f_email(){return new Comparison('email');}
		public static function f_password(){return new Comparison('password');}
		public static function f_nick(){return new Comparison('nick');}
		public static function f_created(){return new Comparison('created');}
		public static function f_login(){return new Comparison('login');}
		public static function f_status(){return new Comparison('status');}
		public static function f_termsAccepted(){return new Comparison('termsAccepted');}
		public static function f_groups(){return new Comparison('groups');}

	const V_status_active = "active";
	const V_status_deleted = "deleted";
	const V_groups_visitor = "visitor";
	const V_groups_admin = "admin";
	const V_groups_social = "social";
	const V_groups_moderator = "moderator";

	const F_id = "id";
	const F_name = "name";
	const F_email = "email";
	const F_password = "password";
	const F_nick = "nick";
	const F_created = "created";
	const F_login = "login";
	const F_status = "status";
	const F_termsAccepted = "termsAccepted";
	const F_groups = "groups";

	const A_avatar = "avatar";

	/** @var int id */
	protected $id;
	/** @var string name */
	public $name;
	/** @var string email */
	public $email;
	/** @var string password */
	protected $password;
	/** @var string nick */
	public $nick;
	/** @var \DateTime created */
	public $created;
	/** @var \DateTime login */
	public $login;
	/** @var string status */
	public $status;
	/** @var int termsAccepted */
	public $termsAccepted;
	/** @var array groups */
	public $groups;

	abstract protected function setPassword($value);

	final static protected function createModel(): Model{
		$model = new Model(get_called_class());
		$model->addField("id", Field::TYPE_ID,NULL);
		$model->addField("name", Field::TYPE_STRING,NULL);
		$model->addField("email", Field::TYPE_STRING,NULL);
		$model->addField("password", Field::TYPE_STRING,NULL);
		$model->addField("nick", Field::TYPE_STRING,NULL);
		$model->addField("created", Field::TYPE_DATETIME,NULL);
		$model->addField("login", Field::TYPE_DATETIME,NULL);
		$model->addField("status", Field::TYPE_ENUM,array (
  0 => 'active',
  1 => 'deleted',
));
		$model->addField("termsAccepted", Field::TYPE_ID,NULL);
		$model->addField("groups", Field::TYPE_SET,array (
  0 => 'visitor',
  1 => 'admin',
  2 => 'social',
  3 => 'moderator',
));
		$model->protectField("id");
		return $model;
	}
}

/**
 * Nobody uses this class, it exists only to help the code completion
 * @method \Application\Ghost\User[] collect($limit = null, $offset = null)
 * @method \Application\Ghost\User[] collectPage($pageSize, $page, &$count = 0)
 * @method \Application\Ghost\User pick()
 */
abstract class GhostUserFinder extends Finder {}