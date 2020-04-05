<?php namespace Application\Service\Auth;

use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\Zuul\Interfaces\AutoLoginRepositoryInterface;
use Application\Ghost\UserRemember;

class AutoLoginRepository implements AutoLoginRepositoryInterface{

	public function create($userId): string{
		$token = md5($userId . microtime());
		$password = md5($userId . microtime() . "password");
		$remember = new UserRemember();
		$remember->token = $token;
		$remember->password = password_hash($password, PASSWORD_BCRYPT);
		$remember->userId = $userId;
		$remember->lastUsed = new \DateTime();
		$remember->save();
		return $password . '-' . $token;
	}

	public function findByToken($cookie): ?int{
		$remember = $this->findRemember($cookie);
		return $remember ? $remember->userId : null;
	}

	public function delete($cookie){
		$remember = $this->findRemember($cookie);
		if ($remember) $remember->delete();
	}

	public function update($cookie){
		$remember = $this->findRemember($cookie);
		if ($remember){
			$remember->lastUsed = new \DateTime();
			$remember->save();
		}
	}

	protected function findRemember($cookie):?UserRemember{
		[$password, $token] = explode('-', $cookie, 2);
		$remember = UserRemember::search(Filter::where(UserRemember::f_token()->is($token)))->pick();
		if($remember && password_verify($password, $remember->password)) return $remember;
		else return null;
	}

}