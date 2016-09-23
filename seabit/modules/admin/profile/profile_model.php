<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Profile_model extends CI_Model 
	{
		
		public $validation_rules = array(
		
    	array('field' => 'firstname', 
			  'label' => 'First Name',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('field' => 'lastname', 
			  'label' => 'Last Name',
			  'rules' => 'trim|required|max_length[100]',
			  ),
    	array('name' => 'dob', 
				'value' => '',
				'type' => 'date',
		  ),
    	array('field' => 'phone', 
			  'label' => 'Business Phone',
			  'rules' => 'trim',
			  ),
    	array('field' => 'mobile', 
			  'label' => 'Mobile',
			  'rules' => 'trim',
			  ),
    	array('field' => 'skype', 
			  'label' => 'Skype',
			  'rules' => 'trim',
			  ),
    	array('field' => 'address', 
			  'label' => 'Street Address',
			  'rules' => 'trim',
			  ),
    	array('field' => 'city', 
			  'label' => 'City / Town',
			  'rules' => 'trim',
			  ),
    	array('field' => 'state', 
			  'label' => 'State / Region',
			  'rules' => 'trim',
			  ),
    	array('field' => 'zipcode', 
			  'label' => 'Postal / Zip Code',
			  'rules' => 'trim',
			  ),
    	array('field' => 'profile_picture', 
			  'label' => 'Profile Picture',
			  'rules' => 'callback_validate_profile_picture',
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
				'firstname'=>$this->input->post('firstname'),
				'lastname'=>$this->input->post('lastname'),
				'dob'=>$this->input->post('dob'),
				'phone'=>$this->input->post('phone'),
				'mobile'=>$this->input->post('mobile'),
				'skype'=>$this->input->post('skype'),
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'zipcode'=>$this->input->post('zipcode'),
				'website'=>$this->input->post('website'),
				'modified_user_id'=>get_userid(),
				'date_modified'=> date('Y-m-d H:i:s'),
				);

				if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0)
				{
					$extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
					move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'profiles/'.$_POST['id'].'.'.$extension );
				} else {
					if (empty($_FILES['profile_picture']['name']) )
					{
						if ( is_file( 'profiles/'.get_userid().'.jpg' ) ) 
						{
							unlink( 'profiles/'.get_userid().'.jpg' );
						}

						if ( is_file( 'profiles/'.get_userid().'.png' ) ) 
						{
							unlink( 'profiles/'.get_userid().'.png' );
						}
					}
				}
			$this->db->where('userid', $_POST['id']);
			$this->db->update('users', $data);	

			update_user_meta( 'about' , $this->input->post('about') , get_userid() ); 
				 
		}
		
	}