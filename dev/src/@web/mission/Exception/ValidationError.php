<?php

namespace Application\Mission\Web\Exception;

class ValidationError extends ApiException{
	public function __construct($data){ parent::__construct($data, 400); }
}