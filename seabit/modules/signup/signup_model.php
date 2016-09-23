<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Signup_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'email', 
			  'label' => 'Email',
			  'rules' => 'trim|required|valid_email|min_length[5]|max_length[60]||callback_check_duplicate_name',
			  ),
    	array('field' => 'name', 
			  'label' => 'Display Name',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'username', 
			  'label' => 'User Name',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'password', 
			  'label' => 'Password',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'conf_password', 
			  'label' => 'Confirm Password',
			  'rules' => 'trim|required',
			  )
		);

		function __construct()
		{
			parent::__construct();
			$this->load->helper('url');	
			$this->load->helper('date');
		}

		public function get_validation_rules() {
			return $this->validation_rules;
		}
		
		function insert(){
			$data = array(
				'id'=>sea_guid(),
				'email'=>$this->input->post('email'),
				'name'=>$this->input->post('name'),
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'created_by'=>get_userid(),
				'date_entered'=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('users', $data);
			
		}

	}