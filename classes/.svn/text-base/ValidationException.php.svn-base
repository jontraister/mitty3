<?php

/**
 * Distinguished exception for ApplicationApi with reportable error message. 
 * 
 * @author christian.kissner@fox.com
 *
 */
class ValidationException extends Exception  {
	
	private $details=array();
	
	public function setDetails($details) {
		$this->details=$details;
		return $this;
	}
	
	public function getDetails() {
		return $this->details;
	}
	
	public static function throwNew($message,$details=array()) {
		$o=new self($message);
		$o->setDetails($details); 
		throw $o;  
	}
}