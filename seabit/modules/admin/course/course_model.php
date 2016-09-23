<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Course_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'code', 
			  'label' => 'Code',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'name', 
			  'label' => 'Name',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'detail', 
			  'label' => 'Detail',
			  'rules' => 'trim|required',
			  ),
    	array('field' => 'uni_id', 
				'label' => 'University',
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
				'code'=>$this->input->post('code'),
				'name'=>$this->input->post('name'),
				'detail'=>$this->input->post('detail'),
				'uni_id'=>$this->input->post('uni_id'),

				'created_by'=>get_userid(),
				'date_entered'=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('course', $data);
			
		}

		function modify(){
			$data = array(
				'code'=>$this->input->post('code'),
				'name'=>$this->input->post('name'),
				'detail'=>$this->input->post('detail'),
				'uni_id'=>$this->input->post('uni_id'),

				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);
			$this->db->where('id', $_POST['id']);
			$this->db->update('course', $data);	
				 
		}
		
	}