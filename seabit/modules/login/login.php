<?php if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');
	
class Login extends CI_Controller {
	
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
		$page_data['layout']  = 'box';
		$page_data['page_title'] = 'onlinecoursesearch.com - Log I';
		$page_data['page_metad']  = 'onlinecoursesearch.com - Log In';
		$page_data['page_robots']  = 'noindex,nofollow';

		if ( $this->session->userdata('userid') ) {
			if ( get_user_role() == 1 ) {
				redirect(base_url() . 'admin/dashboard', 'refresh');
			} else {
				redirect(base_url() . 'admin/dashboard', 'refresh');
			}
		} else {
			include TEMPLATEPATH . 'login.php';	
		}

	}
	
	public function validate()
	{
		//if ( $this->session->userdata('userid') )
		//	redirect(base_url() . 'dashboard', 'refresh');
		
		$config = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|xss_clean|callback_check_duplicate_name'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|xss_clean|callback_validate_login'
			)
		);

		
		$this->form_validation->set_rules($config);
		$this->form_validation->set_message('_validate_login', ucfirst($this->input->post('login_type')) . ' Login failed!');
	//	$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>');

		$page_data['page_title'] = 'Login onlinecoursesearch';

		if ($this->form_validation->run() === FALSE) {

			include TEMPLATEPATH . 'login.php';
		} else {

			if ( $this->session->userdata('userid') ) {
				if ( $this->input->post('redirect') ) {
					redirect(base_url() . $this->input->post('redirect'), 'refresh');
				} else {
					if ( get_user_role() == 1 ) {
						redirect(base_url() . 'admin/dashboard', 'refresh');
				    } else {
						redirect(base_url() . 'admin/dashboard', 'refresh');
					}
				}
			}
		}
		
	}
	
	/***validate login****/
	function validate_login()
	{
		$query = $this->db->get_where('users', array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		));
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$this->session->set_userdata('userid', $row->userid);
			return TRUE;
		} else {
			$this->session->set_flashdata('flash_message', __('login_failed'));
			redirect(base_url() . 'login', 'refresh');
			return FALSE;
		}
	}
	
	/***DEFAULT NOR FOUND PAGE*****/
	function four_zero_four()
	{
		$this->load->view('four_zero_four');
	}
	

	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
	function reset_password()
	{
		$account_type = $this->input->post('account_type');
		if ($account_type == "") {
			redirect(base_url(), 'refresh');
		}
		$email  = $this->input->post('email');
		$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
		if ($result == true) {
			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));
		} else if ($result == false) {
			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
		}
		
		
	}
	/*******LOGOUT FUNCTION *******/
	function logout()
	{
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		$this->session->set_flashdata('logout_notification', 'logged_out');
		redirect(base_url() . 'login', 'refresh');
	}
}