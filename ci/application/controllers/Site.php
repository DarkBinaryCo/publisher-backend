<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {
	public function __construct()
	{
		//__construct($container_template,$header_view_name,$footer_view_name)
		parent::__construct('_templates/site/body_container');
		
		//Initializations
		$this->data['page_title'] = SITE_NAME;
	}
	
	public function index()
	{
		//TODO: Add implementation
	}

}

/* End of file Site.php */
