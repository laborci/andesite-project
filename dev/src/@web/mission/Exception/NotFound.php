<?php

namespace Application\Mission\Web\Exception;

class NotFound extends ApiException{
	public function __construct($data){ parent::__construct($data, 404); }
}