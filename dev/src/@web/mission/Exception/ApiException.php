<?php namespace Application\Mission\Web\Exception;

abstract class ApiException extends \Exception{

	protected $data;

	/** @return mixed */
	public function getData(){ return $this->data; }

	public function __construct($data, $code){
		parent::__construct('Api Error', $code);
		$this->data = $data;
	}
}