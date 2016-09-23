<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Users_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'email', 
			  'label' => 'Email',
			  'rules' => 'trim|required|valid_email|min_length[5]|max_length[60]',
			  ),
    	array('field' => 'name', 
			  'label' => 'Display Name',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'usergroupid', 
				'label' => 'User Type',
				'rules' => '',
			  ),
    	array('field' => 'active', 
				'label' => 'Active/Deactive',
				'rules' => '',
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
			  ),
		array(  'name' => 'itemgrid', 
				'type' => 'grid',
				'primarykey' => '',
				'value' =>  array(
				    		array(  'field' => 'name', 
						'label' => 'Name',
						'rules' => '',
						 ),
    		array(  'field' => 'jobtitle', 
						'label' => 'Job Title',
						'rules' => '',
						 ),
    		array(  'name' => 'doj', 
							'value' => '',
							'type' => 'date',
						 ),
    		array(  'field' => 'phone', 
						'label' => 'Phone',
						'rules' => '',
						 ),
    		array(  'field' => 'mobile', 
						'label' => 'Mobile',
						'rules' => '',
						 ),
    		array(  'field' => 'instantmess', 
						'label' => 'Instant Messanger',
						'rules' => '',
						 ),
    		array(  'field' => 'instantmessid', 
						'label' => 'Messanger ID',
						'rules' => '',
						 ),
    		array(  'field' => 'comcity', 
						'label' => 'City / Town',
						'rules' => '',
						 ),
    		array(  'field' => 'comstate', 
						'label' => 'State / Region',
						'rules' => '',
						 ),
    		array(  'field' => 'comzipcode', 
						'label' => 'Postal / Zip Code',
						'rules' => '',
						 ),
    		array(  'field' => 'city', 
						'label' => 'City / Town',
						'rules' => '',
						 ),
    		array(  'field' => 'state', 
						'label' => 'State / Region',
						'rules' => '',
						 ),
    		array(  'field' => 'zipcode', 
						'label' => 'Postal / Zip Code',
						'rules' => '',
						 ),
    		array(  'name' => 'gender', 
							'value' => '',
							'type' => 'select',
						 ),
    		array(  'name' => 'dob', 
							'value' => '',
							'type' => 'date',
						 ),
    		array(  'name' => 'mstatus', 
							'value' => '',
							'type' => 'select',
						 ),
    		array(  'field' => 'fathername', 
						'label' => 'Father Name',
						'rules' => '',
						 ),
    		array(  'field' => 'mothername', 
						'label' => 'Mother Name',
						'rules' => '',
						 ),
    		array(  'name' => 'bloodgroup', 
							'value' => '',
							'type' => 'select',
						 ),
    		array(  'name' => 'countryid', 
							'value' => '',
							'type' => 'select',
						 ),
    		array(  'field' => 'qualification', 
						'label' => 'Qualifications',
						'rules' => '',
						 ),
			array(  'name' => 'rowid', 
							'value' => '',
							'type' => 'text',
							 ),
						), 
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
		
		function insert(){
			$data = array(
				'id'=>sea_guid(),
				'email'=>$this->input->post('email'),
				'name'=>$this->input->post('name'),
				'usergroupid'=>$this->input->post('usergroupid'),
				'active'=>$this->input->post('active'),
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'created_by'=>get_userid(),
				'date_entered'=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('users', $data);
			
		}

		function modify(){
			$data = array(
				'email'=>$this->input->post('email'),
				'name'=>$this->input->post('name'),
				'usergroupid'=>$this->input->post('usergroupid'),
				'active'=>$this->input->post('active'),
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),

				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);
			$this->db->where('id', $_POST['id']);
			$this->db->update('users', $data);	
				 
		}
		
	}