<?php

namespace Application\Mission\Web\Exception;

class Forbidden extends ApiException{
	public function __construct($data){ parent::__construct($data, 403); }
}