<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Emaildata_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'fname', 
			  'label' => 'First Name',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'lname', 
			  'label' => 'Last Name',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'email', 
			  'label' => 'Email',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'phone', 
			  'label' => 'Phone',
			  'rules' => 'trim|required',
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
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname'),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('phone'),

				'created_by'=>get_userid(),
				'date_entered'=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('email', $data);
			
		}

		function modify(){
			$data = array(
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname'),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('phone'),

				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);
			$this->db->where('id', $_POST['id']);
			$this->db->update('email', $data);	
				 
		}
		
	}