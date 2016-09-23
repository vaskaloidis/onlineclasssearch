<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Profile extends CI_Controller
{
	var $moduletype = "admin";
	var $modulename = "profile";
	var $title = "Profile";
	var $path = 'admin/profile/';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
		login_redirect( $this->path );
    }
    
    /***default function, redirects to login page if user not logged in ***/
    public function index()
    {
		/*** redirects to login page if user not logged in ***/
		//login_redirect();
		
		if ( $this->input->post() ) {
			$this->edit();			
		}
		$page_data['layout']  = 'box';
		$id = $this->db->get_var("select id from " . $this->db->dbprefix . "users where userid = " .get_userid() );
		$_GET['id'] = $id;
	   	$page_data[$this->modulename] = $this->db->get_where('users',  array('id' => $id ) )->first_row('array');
        $page_data['page_name']  = $this->path . $this->modulename . 'create_view';
        $page_data['page_title'] = $this->title;
        $this->load->view('index', $page_data);
    }

	function edit() 
	{
		if ( $this->input->post() ) 
		{
			/*** redirects to login page if user not logged in ***/
			login_redirect();
			
			$this->load->model('profile_model');

			$this->form_validation->set_rules($this->profile_model->get_validation_rules());

			if ($this->form_validation->run() !== FALSE)
			{
				if ( isset( $_POST['edit'] ) ) {  
					if ( $_POST['edit'] == 1 ) {
						 $this->profile_model->modify();
						 if ( $this->input->post('modal') == "1" ) {
							 $response = array ( 'status' => array('success'),
								'data'   => array() );
								echo json_encode($response);	
								exit();
						 } else {
							 if ( $this->input->post('savenew') ) {
								 redirect(base_url() .  $this->path . 'create', "refresh");
							 } else {
								 redirect(base_url() .  $this->path, "refresh");
							 }
						 }
					}
				exit();	
				}
			} else {
				 $errors = array( 
					'firstname' => form_error('firstname'), 
					'lastname' => form_error('lastname'), 
					'dob' => form_error('dob'), 
					'phone' => form_error('phone'), 
					'mobile' => form_error('mobile'), 
					'skype' => form_error('skype'), 
					'address' => form_error('address'), 
					'city' => form_error('city'), 
					'state' => form_error('state'), 
					'zipcode' => form_error('zipcode'), 
				);
				$response = array ( 'status' => array('errors'),
								'data' => $errors );
				if ( $this->input->post('modal') == '1' ) {
					echo json_encode($response);	
					exit();
				}
			}
		}

		if ( $_POST ) {
			$page_data[$this->modulename] = $_POST;
		} else {
			if ( isset( $_GET['id'] ) ) 
			{
	   			$page_data[$this->modulename] = $this->db->get_where('users',  array('id' => $_GET['id'] ) )->first_row('array');
			}
		}
		
		$page_data['layout']  = 'box';
        $page_data['page_name']  = $this->path . '/' . $this->modulename . 'create_view';
        $page_data['page_title'] = $this->title;
        $this->load->view('index', $page_data);
	}
	
	function validate_profile_picture() {
		if ( sea_allowed_images('profile_picture') === FALSE )
			{
				$this->form_validation->set_message( 'validate_profile_picture' , 'Image type not supported for Profile Picture');
				return FALSE;
			} else {
				return TRUE;
			}
		}
}