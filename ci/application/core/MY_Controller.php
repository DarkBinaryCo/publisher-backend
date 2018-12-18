<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	// Default template views
	protected $default_header_view = '';
	protected $default_footer_view = '';

	
	public function __construct($default_header_view,$default_footer_view)
	{
		parent::__construct();
		$this->default_header_view = $default_header_view;
		$this->default_footer_view = $default_footer_view;
	}
	

	// Render a view with optional header/footer content
	/**
	 * @param $body_view The body view
	 */
	protected function _render_page(string $body_view,array $data,$extra_header_content='',$extra_footer_content='') 
	{
		$header = $this->default_header_view;
		$footer = $this->default_footer_view;
			
		$data['extra_header_content'] = $extra_header_content;
		$data['extra_footer_content'] = $extra_footer_content;
		
		$page_content = '';
		// Load the header if one is specified
		if(!empty($header))
		{
			$page_content .= $this->load->view($header,$data,TRUE);
		}

		// Load the body view if it could be found ~ 404 if not
		if(file_exists(APPPATH.'views/'.$body_view.'.php'))
		{
			$page_content .= $this->load->view($body_view,$data,TRUE);
		}
		else
		{
			show_404();
		}

		// Load the footer if one is specified
		if(!empty($footer))
		{
			$page_content .= $this->load->view($footer,$data,TRUE);
		}
		
		$this->load->view('_templates/site/body_container', array(
			'page_content'=>$page_content
		));
	}

}


/* End of file MY_Controller.php */
