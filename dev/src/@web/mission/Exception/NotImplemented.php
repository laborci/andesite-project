<?php

namespace Application\Mission\Web\Exception;

class NotImplemented extends ApiException{
	public function __construct($data){ parent::__construct($data, 501); }
}