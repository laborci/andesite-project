<?php namespace Application\Mission\Web\Page\Abstracts;

use Andesite\TwigResponder\Responder\SmartPageResponder;
use Andesite\TwigResponder\TwigResponder;
use Application\Mission\Web\Twig\AgoFilter;
use Application\Mission\Web\Twig\Base64Filter;
use Application\Mission\Web\Twig\DumpFunction;
use Twig\TwigFilter;
use Twig\TwigFunction;


abstract class AbstractPage extends SmartPageResponder{

	protected $sitedata = [];

	protected function getViewModelData(){
		$this->set('sitedata', base64_encode(json_encode($this->sitedata)));
		return parent::getViewModelData();
	}

	protected function prepare(){
		TwigResponder::Module()->addTwigFilter(new TwigFilter('ago', new AgoFilter()));
		TwigResponder::Module()->addTwigFilter(new TwigFilter('base64enc', new Base64Filter()));
		TwigResponder::Module()->addTwigFunction(new TwigFunction('dump', new DumpFunction()));
	}

}