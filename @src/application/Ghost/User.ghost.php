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
		public static function f_groups(){return new Comparison('groups');}

	const V_groups_admin = "admin";

	const F_id = "id";
	const F_name = "name";
	const F_email = "email";
	const F_password = "password";
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
	/** @var array groups */
	public $groups;

	abstract protected function setPassword($value);

	final static protected function createModel(): Model{
		$model = new Model(get_called_class());
		$model->addField("id", Field::TYPE_ID,NULL);
		$model->addField("name", Field::TYPE_STRING,NULL);
		$model->addField("email", Field::TYPE_STRING,NULL);
		$model->addField("password", Field::TYPE_STRING,NULL);
		$model->addField("groups", Field::TYPE_SET,array (
  1 => 'admin',
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