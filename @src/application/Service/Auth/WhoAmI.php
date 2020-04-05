<?php namespace Application\Service\Auth;

use Andesite\Core\ServiceManager\Service;
use Andesite\Core\ServiceManager\SharedService;
use Application\Constant\Permission\Role;
use Application\Ghost\User;
use Andesite\Zuul\Interfaces\WhoAmIInterface;
use Andesite\Zuul\Auth\AuthSession;

class WhoAmI implements WhoAmIInterface, SharedService{

	use Service;

	/** @var AuthSession */
	private $session;

	public function __construct(AuthSession $session){ $this->session = $session; }

	public function checkRole($role): bool{ return $this->isAuthenticated() ? $this->get()->checkRole($role) : false; }

	public function isAuthenticated(): bool{ return (bool)$this->session->getUserId(); }

	public function logout(){
		$this->session->forget();
		$this->session->flush();
	}

	public function __invoke(): ?int{ return $this->session->getUserId(); }
	public function getUserId(): ?int{ return $this->session->getUserId(); }

	public function get(): ?User{ return $this->isAuthenticated() ? User::pick($this->session->getUserId()) : null; }

	public function isModerator(){ return $this->checkRole(Role::Moderator); }
	public function isAdmin(){ return $this->checkPermission(Role::Admin); }
	public function isSocial(){ return $this->checkPermission(Role::Social); }

}