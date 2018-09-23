<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	protected $data;
	protected $container_template;
	private $_header_view_name;
	private $_footer_view_name;

	public function __construct($container_template,$header_view_name=NULL,$footer_view_name=NULL)
	{
		parent::__construct();

		// Controller scope
		$this->data = array();
		
		$this->_header_view_name = $header_view_name ?? NULL;
		$this->_footer_view_name = $footer_view_name ?? NULL;
		$this->container_template = $container_template;
	}

	protected function _render_page($view_path='',$data=NULL,$header_view_info=NULL,$footer_view_info=NULL)
	{
		// Ensure the correct data is set ~ pass NULL as data if the data is invalid
		$header_view_name = $header_view_info['view'] ?? $this->_header_view_name;
		$header_view_data = &$header_view_info['data'];
		$header_view_data = (!empty($header_view_data) && is_array($header_view_data)) ? $header_view_data : NULL;
		
		$footer_view_name = $footer_view_info['view'] ?? $this->_footer_view_name;
		$footer_view_data = &$footer_view_info['data'];
		$header_view_data = (!empty($footer_view_data) && is_array($footer_view_data)) ? $footer_view_data : NULL;


		//If the view file does not exist 
		if(!file_exists(APPPATH.'views/'.$view_path.'.php'))
		{
			log_message('debug','Page not found: '.$view_path);
			show_404();
		}

		$header_content = $this->load->view($header_view_name,$header_view_data,TRUE);
		$page_content = $this->load->view($view_path, $data, TRUE);
		$footer_content = $this->load->view($footer_view_name,$footer_view_data,TRUE);

		//Place the view in the container specified
		$this->load->view($this->container_template,array(
			'header_content'=>$header_content,
			'page_content'=>$page_content,
			'footer_content'=>$footer_content,
		));
	}
}

/* End of file MY_Controller.php */
