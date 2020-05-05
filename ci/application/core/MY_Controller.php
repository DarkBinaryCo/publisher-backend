<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $data;
	protected $current_user;
	protected $container_template;
	private $_header_view_name;
	private $_footer_view_name;

	public function __construct($container_template='',$header_view_name=NULL,$footer_view_name=NULL)
	{
		parent::__construct();
		date_default_timezone_set('Africa/Nairobi');
		
		$this->current_user = $this->ion_auth->user()->row();

		// Controller scope data 
		$this->data = array(
			'current_user'=>$this->current_user
		);

		$this->_header_view_name = $header_view_name ?? NULL;
		$this->_footer_view_name = $footer_view_name ?? NULL;
		$this->container_template = $container_template;
	}

	

	// Get the current user
	protected function get_current_user()
	{
		return $this->ion_auth->user()->row();
	}

	// Render page template
	protected function _render_page($view_path='',$data=NULL,$header_view_info=NULL,$footer_view_info=NULL)
	{
		// Ensure the correct data is set ~ pass NULL as data if the data is invalid
		$header_view_name = $header_view_info['view'] ?? $this->_header_view_name;
		$header_view_data = $header_view_info['data'];
		$header_view_data = (!empty($header_view_data) && is_array($header_view_data)) ? $header_view_data : NULL;
		
		$footer_view_name = $footer_view_info['view'] ?? $this->_footer_view_name;
		$footer_view_data = $footer_view_info['data'];
		$footer_view_data = (!empty($footer_view_data) && is_array($footer_view_data)) ? $footer_view_data : NULL;

		//If the view file does not exist 
		if(!file_exists(APPPATH.'views/'.$view_path.'.php'))
		{
			log_message('debug','Page not found: '.$view_path);
			show_404();
		}

		// Only set the header if we have provided a header view
		$header_content = !$header_view_name ? '' : $this->load->view($header_view_name,$header_view_data,TRUE);
		
		// Only provide the footer if we have provided a footer view
		$footer_content = !$footer_view_name ? '' : $this->load->view($footer_view_name,$footer_view_data,TRUE);

		$page_content = $this->load->view($view_path, $data, TRUE);

		//Place the view in the container specified
		$this->load->view($this->container_template,array(
			'header_content'=>$header_content,
			'page_content'=>$page_content,
			'footer_content'=>$footer_content,
		));
	}

	/** Gets script string eg <script src="url"></script>
	 * @param string $asset_path The path to the JS file inside the asset folder (assets in this case. For example: for a js file in assets/js/script.js, $asset_path would be js/script.js
	 * @param bool $is_asset_url Whether the path should be returned as an asset url or as the raw url
	 */
	protected function get_script_string($asset_path,$is_asset_url=TRUE)
	{
		if($is_asset_url)
		{
			$asset_path = asset_url($asset_path);
		}
		return '<script src="'.$asset_path.'"></script>'."\n";
	}

	/** Gets css string eg <link rel="stylesheet" href="style.css">
	 * @param string $asset_path The path to the CSS file inside the asset folder (assets in this case. For example: for a css file in assets/css/style.css, $asset_path would be css/style.css
	 * @param bool $preload Whether or not this css file should be preloaded (include 'preload' in `rel` attribute)
	 * @param bool $is_asset_url Whether the path should be returned as an asset url or as the raw url
	 */
	protected function get_css_string($asset_path,$preload=FALSE,$is_asset_url=TRUE)
	{
		if($is_asset_url)
		{
			$asset_path = asset_url($asset_path);
		}

		$rel_string = '';
		$rel_string = $preload ? 'preload stylesheet': 'stylesheet';

		return '<link rel="'.$rel_string.'" href="'.$asset_path.'">';
	}

	/** Set url to redirect to on successful login. Currently used for admin/escort accounts
	 * @param string $redirect_url Url to redirect to on successful login
	 * @return $redirect_url The redirect url provided wrapped as site_url($redirect_url)
	*/
	protected function set_login_redirect($redirect_url=NULL)
	{
		// Default to using the current url when no redirect url is provided
		$redirect_url = $redirect_url ?? $this->uri->uri_string();
		
		$final_redirect = site_url($redirect_url);
		return $this->session->set_flashdata('login_redirect',$final_redirect);
	}

}

//Controller override
class Api_Controller extends CI_Controller
{
    function __construct()
    {
		parent::__construct();
        $this->load->library('api_lib');
        // Set content type to JSON
	}
	
	// Get request body
	protected function get_request_body()
	{
		return json_decode(file_get_contents('php://input'),true);
	}
}

