<?php defined('BASEPATH') or exit('No direct script access allowed');

//Model override
class MY_Model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}
}
