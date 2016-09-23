<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class User_password_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'oldpassword', 
			  'label' => 'Old Password',
			  'rules' => 'trim|required|callback_checkold_password',
			  ),
    	array('field' => 'password', 
			  'label' => 'Password',
			  'rules' => 'trim|required|min_length[4]|max_length[20]'
			  ),
    	array('field' => 'conf_password', 
			  'label' => 'Confirm Password',
			  'rules' => 'trim|required|matches[password]',
			  ),
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
		
		function modify(){
			$data = array(
				'password'=>md5($this->input->post('password')),
				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);
			$this->db->where('userid', $_POST['id']);
			$this->db->update('users', $data);	
				
		}
		
	}