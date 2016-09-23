<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Featuregroup_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'name', 
			  'label' => 'Group Name',
			  'rules' => 'trim|required|callback_check_duplicate_name',
			  ),
    	array('field' => 'description', 
			  'label' => 'Description',
			  'rules' => '',
			  ),
    	array('field' => 'active', 
				'label' => 'Active/Deactive',
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
				'description'=>$this->input->post('description'),
				'active'=>$this->input->post('active'),

				'created_by'=>get_userid(),
				'date_entered'=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('featuregroup', $data);
			
		}

		function modify(){
			$data = array(
				'name'=>$this->input->post('name'),
				'description'=>$this->input->post('description'),
				'active'=>$this->input->post('active'),

				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);
			$this->db->where('id', $_POST['id']);
			$this->db->update('featuregroup', $data);	
				 
		}
		
	}