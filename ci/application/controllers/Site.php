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
		$this->_render_page('home',$this->data);
	}

	// Get book page
	public function book()
	{
		$this->_render_page('book',$this->data);
	}

	// Thank you page
	public function thanks()
	{
		$this->_render_page('thanks',$this->data);
	}

}

/* End of file Site.php */
