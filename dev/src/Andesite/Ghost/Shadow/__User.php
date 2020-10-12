<?php namespace Application\Andesite\Ghost\Shadow;

use Andesite\Attachment\Collection;
use Andesite\DBAccess\Connection\Filter\Comparison;
use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\Ghost\Field;
use Andesite\Ghost\Ghost;
use Andesite\Ghost\Model;

/**
 * @method static \Application\Andesite\Ghost\Finder\__User search( Filter $filter = null )

 * @property-read $id
 * @property $password
 * @property-read Collection $avatar
 * @property-read Collection $header

 * @method static Comparison id()
 * @method static Comparison email()
 * @method static Comparison password()
 * @method static Comparison name()
 * @method static Comparison group()
 */
abstract class __User extends Ghost{

	public static ?Model $model = null;
	public static function __callStatic($name, $arguments){ if (in_array($name, static::$model->fields)) return new Comparison($name); }

	abstract protected function getPassword();
	abstract protected function setPassword($value);

	const group__anonymized = "anonymized";
	const group__visitor = "visitor";
	const group__admin = "admin";

	const id = "id";
	const email = "email";
	const password = "password";
	const name = "name";
	const group = "group";

	protected ?int $id = null;
	public ?string $email = null;
	protected ?string $password = null;
	public ?string $name = null;
	public ?string $group = null;

	static protected function model(Model $model): Model{
		return $model
			->addField("id", Field::TYPE_ID, null)
			->addField("email", Field::TYPE_STRING, null)
			->addField("password", Field::TYPE_STRING, null)
			->addField("name", Field::TYPE_STRING, null)
			->addField("group", Field::TYPE_ENUM, ['anonymized','visitor','admin'])
			->addValidator("id", new \Symfony\Component\Validator\Constraints\Type('int'))
			->addValidator("id", new \Symfony\Component\Validator\Constraints\PositiveOrZero())
			->addValidator("email", new \Symfony\Component\Validator\Constraints\Type('string'))
			->addValidator("email", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]))
			->addValidator("password", new \Symfony\Component\Validator\Constraints\Type('string'))
			->addValidator("password", new \Symfony\Component\Validator\Constraints\Length(['max'=>128]))
			->addValidator("name", new \Symfony\Component\Validator\Constraints\Type('string'))
			->addValidator("name", new \Symfony\Component\Validator\Constraints\Length(['max'=>255]))
			->addValidator("group", new \Symfony\Component\Validator\Constraints\Type('string'))
			->addValidator("group", new \Symfony\Component\Validator\Constraints\Choice(['anonymized','visitor','admin']))
			->protectField('id')
			->noInsertField('id')
			->noUpdateField('id')
		;
	}
}


