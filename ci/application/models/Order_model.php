<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends MY_Model
{
	// Constructor
	public function __construct()
	{
		parent::__construct('orders');
    }
}