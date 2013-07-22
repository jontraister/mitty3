<?php

class ReadOnlyArrayObject extends ArrayObject {
	
	public function offsetSet($index,$newval) { $this->ro(); }
	public function offsetUnset($index) { $this->ro();}
	public function append($value) 	{ $this->ro(); }
	public function exchangeArray($input) { $this->ro(); }
	public function unserialize($serialized) { $this->ro(); }
	
	
	protected function _offsetSet($index,$newval) {
		return parent::offsetSet($index,$newval);
	}
	protected function _offsetUnset($index) {
		return parent::offsetUnset($index);
	}
	protected function _append($value) 	{
		return parent::append($value);
	}
	protected function _exchangeArray($input) {
			return parent::exchangeArray($input);
	}
	
	protected function _unserialize($serialized) {
		return parent::unserialize($serialized);
	}
	
	
	private function ro() {
		throw new Exception('Attempt to write to '.__CLASS__);
	}
}