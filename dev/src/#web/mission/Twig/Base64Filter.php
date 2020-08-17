<?php namespace Application\Mission\Web\Twig;

class Base64Filter{
	function __invoke($data){ return base64_encode($data); }
}
