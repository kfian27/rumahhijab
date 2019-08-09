<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajaxresponse{
	var $status; 	// [ok, failed]
	var $message; 	// array
	var $data;		// array
	
	public function set_data($status, $message, $data){
		$this->status = $status;
		$this->message = $message;
		$this->data = $data;
	}
}

?>