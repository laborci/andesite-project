<?php namespace Application\Service;

use Andesite\Auth\AuthSession;
use Andesite\Core\Env\Env;
use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\Auth\AbstractAuth;
use Andesite\Auth\UserInterface;
use Application\Component\Constant\Permission\Role;
use Application\Ghost\User;
use Lcobucci\JWT\Token\DataSet;

class AuthService extends AbstractAuth{

	public function __construct(AuthSession $session){
		$this->autologinTimeOut = strval(Env::Service()->get('app.auth.autologin.timeout'));
		$this->autologinCookie = strval(Env::Service()->get('app.auth.autologin.cookie'));
		$this->jwtKey = strval(Env::Service()->get('app.auth.jwt-key'));
		parent::__construct($session);
	}

	public function whoAmI(): ?User{ return !is_null($this->user) ? User::pick($this->user->getIdentifier()) : null; }
	protected function find($login): ?UserInterface{ return User::search(Filter::where(User::f_email()->is($login)))->pick(); }
	protected function create($id): ?UserInterface{ return User::pick($id); }
	protected function hasLoginAccess(UserInterface $user): bool{ return $user->hasRole(Role::Active); }
	protected function validateToken(DataSet $token): bool{
		$user = User::pick($token->get('IDENTIFIER'));
		return !is_null($user) && $token->get('key') === md5($user->password);
	}
	protected function createTokenData(): array{
		return ['key'=>md5($this->whoAmI()->password)];
	}

}