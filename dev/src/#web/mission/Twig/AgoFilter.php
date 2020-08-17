<?php namespace Application\Mission\Web\Twig;

class AgoFilter{
	function __invoke($date){
		$ago = time() - $date->getTimestamp();
		if ($ago < 0) return "Marty McFly!";
		if ($ago < 30) return "Éppen most";
		if ($ago < 60 * 60) return ceil($ago / 60) . " perce";
		if ($ago < 60 * 60 * 12) return ceil($ago / 60 / 60) . " órája";
		if ($ago < 60 * 60 * 24 * 10) return ceil($ago / 60 / 60 / 24) . " napja";
		else return $date->format("Y.m.d.");
	}
}
