<?php namespace Application\Mission\Web\Page;

use Andesite\Core\Env\Env;
use Andesite\Core\Session\SessionEvent;
use Application\Constant\Label\Label;
use Application\Constant\SessionEvents;
use Application\Ghost\Article;
use Application\Ghost\Config;
use Application\Mission\Web\Page\Abstracts\AbstractPage;
use Application\Service\Content;


/**
 * @template "index.twig"
 * @title "Gamer365 🤖"
 * @js "/~web/app.js"
 * @css "/~web/app.css"
 * @page-name index
 */
class Index extends AbstractPage{

	protected function prepare(){
		parent::prepare();
	}

}