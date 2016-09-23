<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Page_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'name', 
			  'label' => 'Page Name',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'url', 
			  'label' => 'Page URL',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'content', 
			  'label' => 'Content',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'title', 
			  'label' => 'Title',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'meta_keywords', 
			  'label' => 'Meta Keywords',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'meta_description', 
			  'label' => 'Meta Description',
			  'rules' => 'trim|required|max_length[100]',
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
				'name'=>$this->input->post('name'),
				'url'=>$this->input->post('url'),
				'content'=>$this->input->post('content'),
				'title'=>$this->input->post('title'),
				'meta_keywords'=>$this->input->post('meta_keywords'),
				'meta_description'=>$this->input->post('meta_description'),

				'created_by'=>get_userid(),
				'date_entered'=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('page', $data);
			
		}

		function modify(){
			$data = array(
				'name'=>$this->input->post('name'),
				'url'=>$this->input->post('url'),
				'content'=>$this->input->post('content'),
				'title'=>$this->input->post('title'),
				'meta_keywords'=>$this->input->post('meta_keywords'),
				'meta_description'=>$this->input->post('meta_description'),

				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);
			$this->db->where('id', $_POST['id']);
			$this->db->update('page', $data);	
				 
		}
		
	}