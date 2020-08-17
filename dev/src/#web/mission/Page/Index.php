<?php namespace Application\Mission\Web\Page;

use Andesite\TwigResponder\Responder\SmartPageResponder;
use Andesite\TwigResponder\TwigResponder;
use Twig\{TwigFilter, TwigFunction};
use Application\Mission\Web\Twig\{AgoFilter, Base64Filter, DumpFunction};
/**
 * @template "index.twig"
 * @title "Andesite"
 * @bodyclass ""
 * @js "/~web/app.js"
 * @css "/~web/app.css"
 */
class Index extends SmartPageResponder{

	protected function prepare(){
		TwigResponder::Module()->addTwigFilter(new TwigFilter('ago', new AgoFilter()));
		TwigResponder::Module()->addTwigFilter(new TwigFilter('base64enc', new Base64Filter()));
		TwigResponder::Module()->addTwigFunction(new TwigFunction('dump', new DumpFunction()));
	}

}