<?php if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');
	
class Resetpassword extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('date');
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	}
	
	/***default functin, redirects to login page if no admin logged in yet***/
	public function index() 
	{
		$page_data['page_status'] = 'form';
		$page_data['page_title'] = 'Sidepages.com - Reset Password';
		$page_data['page_metad']  = 'Sidepages.com - Reset Password';
		$page_data['page_robots']  = 'noindex,nofollow';

		if ( $this->session->userdata('userid') ) {
			if ( get_user_role() == 1 ) {
				redirect(base_url() . 'member/dashboard', 'refresh');
			} else {
				redirect(base_url() . 'member/dashboard', 'refresh');
			}
		} else {
			include TEMPLATEPATH . 'resetpassword.php';	
		}

	}
	
	public function validate()
	{
		//if ( $this->session->userdata('userid') )
		//	redirect(base_url() . 'dashboard', 'refresh');
		
		$config = array(
			array(
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|callback_check_email_exists'
			)
		);

		
		$this->form_validation->set_rules($config);
		$this->form_validation->set_message('_validate_login', ucfirst($this->input->post('login_type')) . 'Email not registered!');


		$page_data['page_title'] = 'SidePages - Reset Password';
		$page_data['page_metad']  = 'Sidepages.com - Reset Password';
		$page_data['page_robots']  = 'noindex,nofollow';
		if ($this->form_validation->run() === FALSE) {
			$page_data['page_status'] = 'form';
			include TEMPLATEPATH . 'resetpassword.php';
		} else {
			$page_data['page_status'] = 'success';
			include TEMPLATEPATH . 'resetpassword.php';
		}
		
	}

	function check_email_exists() {
		$query = $this->db->get_where('users', array(
			'email' => $this->input->post('email')
		));
		if ($query->num_rows() == 0) {
			$this->form_validation->set_message( 'check_email_exists' , 'Email not registered with us.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/***DEFAULT NOR FOUND PAGE*****/
	function four_zero_four()
	{
		$this->load->view('four_zero_four');
	}
	

	
}