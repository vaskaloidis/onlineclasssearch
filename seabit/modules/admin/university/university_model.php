<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class University_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'name', 
			  'label' => 'Name',
			  'rules' => 'trim|required|callback_check_duplicate_name',
			  ),
    	array('field' => 'remark', 
			  'label' => 'Remark',
			  'rules' => '',
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
				'name'=>$this->input->post('name'),
				'remark'=>$this->input->post('remark'),

				'created_by'=>get_userid(),
				'date_entered'=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('university', $data);
			
		}

		function modify(){
			$data = array(
				'name'=>$this->input->post('name'),
				'remark'=>$this->input->post('remark'),

				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);
			$this->db->where('id', $_POST['id']);
			$this->db->update('university', $data);	
				 
		}
		
	}