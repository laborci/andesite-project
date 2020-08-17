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
 * @property $password
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

	const V_groups_visitor = "visitor";
	const V_groups_admin = "admin";

	const F_id = "id";
	const F_name = "name";
	const F_email = "email";
	const F_password = "password";
	const F_groups = "groups";

	const A_avatar = "avatar";

	/** @var int $id */
	protected $id;
	/** @var string $name */
	public $name;
	/** @var string $email */
	public $email;
	/** @var string $password */
	protected $password;
	/** @var array $groups */
	public $groups;

	abstract protected function getPassword();
	abstract protected function setPassword($value);

	final static protected function createModel(): Model{
		$model = new Model(get_called_class());
		$model->addField("id", Field::TYPE_ID,null);
		$model->addField("name", Field::TYPE_STRING,null);
		$model->addField("email", Field::TYPE_STRING,null);
		$model->addField("password", Field::TYPE_STRING,null);
		$model->addField("groups", Field::TYPE_SET,['visitor','admin']);
		$model->protectField("id");
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\Type('int'));
		$model->addValidator("id", new \Symfony\Component\Validator\Constraints\PositiveOrZero());
		$model->addValidator("name", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("name", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("email", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("email", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]));
		$model->addValidator("password", new \Symfony\Component\Validator\Constraints\Type('string'));
		$model->addValidator("password", new \Symfony\Component\Validator\Constraints\Length(['max'=>128]));
		$model->addValidator("groups", new \Symfony\Component\Validator\Constraints\Type('array'));
		$model->addValidator("groups", new \Symfony\Component\Validator\Constraints\Choice(['multiple'=>true,'choices'=>['visitor','admin']]));
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