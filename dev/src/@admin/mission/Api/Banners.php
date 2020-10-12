<?php

namespace Application\AdminCodex\Api;

use Andesite\DBAccess\Connection\Filter\Filter;
use Andesite\Mission\Web\Responder\ApiJsonResponder;
use Application\Ghost\Banner;

class Banners extends ApiJsonResponder{
	/**
	 * @on get
	 */
	function get($id){
		$ids = explode(',',$id);
		$items = Banner::collect($ids);
		return array_map([$this, 'map'], $items);
	}
	/**
	 * @accepts get
	 */
	function search($name){
		$items = Banner::search(
			Filter::where(Banner::name()->instring($name)))->collect();
		return array_map([$this, 'map'], $items);
	}

	function map(Banner $item){
		if(is_null($item)) return null;
		return [
			'key'   => $item->id,
			'value' => $item->name,
		];
	}
}