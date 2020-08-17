<?php namespace Application\Service;

use Andesite\Auth\UserInterface;
use Application\Component\Constant\Permission\Role;

class CodexAuthService extends AuthService{
	protected function hasLoginAccess(UserInterface $user): bool{ return $user->hasRole(Role::Active) && $user->hasRole(Role::Admin); }
}