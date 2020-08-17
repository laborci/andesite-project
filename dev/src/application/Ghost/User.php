<?php namespace Application\Ghost;

use Andesite\Auth\CommonUser;
use Andesite\Auth\UserInterface;

class User extends UserGhost implements  UserInterface{
	use CommonUser;
	public function __toString(){ return $this->name; }
	protected function getPassword(){ return $this->password; }
}

