<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Controller extends CI_Controller {

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

// Admin base controller
class Admin_Controller extends CI_Controller {
	
	/** The default container view that accepts a $body_view variable  */
	protected $default_container='';
	
	/** The default side_navigation shown for admin type of accounts  */
	protected $default_navigation='';
	
	/** The default footer displayed at the bottom of any admin view  */
	protected $default_footer_view = '';
	
	/** The default footer displayed at the bottom of any admin view  */
	protected $profile_url = '';
	
	/** The default footer displayed at the bottom of any admin view  */
	protected $notifications_url = '';

	public function __construct(string $default_navigation,string $profile_url, string $notifications_url, string $default_container='_templates/admin/body_container',string $default_footer_view='_templates/admin/footer')
	{
		parent::__construct();
		$this->default_navigation = $default_navigation;
		$this->default_container = $default_container;
		$this->default_footer_view = $default_footer_view;
		$this->profile_url = $profile_url;
		$this->notifications_url = $notifications_url;
	}
		
	// Render a view with optional footer/nav
	protected function _render_page(string $body_view,array $data,$extra_header_content='',$extra_footer_content='') 
	{				
		// Load the body view if it could be found ~ 404 if not
		if(file_exists(APPPATH.'views/'.$body_view.'.php'))
		{
			$body_content = $this->load->view($body_view,$data,TRUE);
			$footer_view = $footer_view ?? $this->default_footer_view;
			
			$data['extra_header_content'] = $extra_header_content;
			$data['extra_footer_content'] = $extra_footer_content;
			
			$data['profile_url'] = $this->profile_url;
			$data['notifications_url'] = $this->notifications_url;

			$data['sidebar_nav'] = $this->load->view($this->default_navigation,$data,TRUE);
			
			$data['body_content'] = $body_content;
			$data['footer_content'] = $this->load->view($footer_view,$data,TRUE);
			
			$this->load->view($this->default_container,$data);// *TODO: Create the default container view that accepts a $body_view as a child
		}
		else
		{
			show_404();
		}

	}

	protected function redirect_to_login($current_user,$user_type='merchant')
	{
		if(empty($current_user))
		{
			$this->session->set_flashdata('message', 'You need to be a logged in '.$user_type.' to view this page');
			$this->session->set_flashdata('login_redirect', $redirect_url);

			$login_url = site_url('auth/login/'.$user_type);
			redirect($login_url,'location','301');
		}
	}

}


/* End of file MY_Controller.php */
