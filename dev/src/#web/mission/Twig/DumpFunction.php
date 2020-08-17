<?php namespace Application\Mission\Web\Twig;

class DumpFunction{
	function __invoke($data){
		dump($data);
	}
}
