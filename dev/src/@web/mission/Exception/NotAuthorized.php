<?php

namespace Application\Mission\Web\Exception;

class NotAuthorized extends ApiException{
	public function __construct($data){ parent::__construct($data, 401); }
}