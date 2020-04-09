<?php namespace Application\Ghost;

use Andesite\Core\Env\Env;
use Andesite\Zuul\Interfaces\AuthenticableInterface;
use Andesite\Zuul\RoleManager\RoleManager;

class User extends UserGhost implements AuthenticableInterface{

	public function __toString(){ return $this->name; }
	public function getId(): int{ return $this->id; }
	public function checkPassword($password): bool{ return password_verify($password, $this->password); }
	protected function setPassword($value){ $this->password = password_hash($value, PASSWORD_BCRYPT); }
	public function checkRole($role = null): bool{ return ( is_null($role) || array_key_exists($role, RoleManager::Module()->resolveGroups($this->groups)) ); }
	public function getAvatar128(){ return $this->avatar->count ? $this->avatar->first->thumbnail->crop(128, 128)->png : Env::Service()->get('app.no-avatar'); }
	public function getAvatar64(){ return $this->avatar->count ? $this->avatar->first->thumbnail->crop(64, 64)->png : Env::Service()->get('app.no-avatar'); }
	public function getAvatar32(){ return $this->avatar->count ? $this->avatar->first->thumbnail->crop(32, 32)->png : Env::Service()->get('app.no-avatar'); }

}
