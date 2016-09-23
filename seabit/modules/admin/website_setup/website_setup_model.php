<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Website_setup_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'website_name', 
			  'label' => 'Website Name',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'website_title', 
			  'label' => 'Website Title',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'meta_keywords', 
			  'label' => 'Meta Keywords',
			  'rules' => 'trim|max_length[400]',
			  ),
    	array('field' => 'meta_description', 
			  'label' => 'Meta Description',
			  'rules' => 'trim|max_length[400]',
			  ),
    	array('field' => 'admin_name', 
			  'label' => 'Admin Name',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'admin_email', 
			  'label' => 'Admin Email',
			  'rules' => 'trim|required|max_length[100]',
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
				'website_name'=>$this->input->post('website_name'),
				'website_title'=>$this->input->post('website_title'),
				'meta_keywords'=>$this->input->post('meta_keywords'),
				'meta_description'=>$this->input->post('meta_description'),
				'admin_name'=>$this->input->post('admin_name'),
				'admin_email'=>$this->input->post('admin_email'),
				);
			foreach ( $data as $key => $val )
			{
				update_option( $key, $val );
			}
			
		}

		
	}