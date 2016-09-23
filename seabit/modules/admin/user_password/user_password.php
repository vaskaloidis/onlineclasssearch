<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class User_password extends CI_Controller
{
	var $moduletype = "admin";
	var $modulename = "user_password";
	var $tablename = "users";
	var $title = "Password Change";
	var $path = "admin/user_password/";
	var $page_data = array();
	
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
		login_redirect($this->modulename);
	
		$this->page_data["layout"]  = "box";
		$this->page_data["module_path"]  = $this->path;
        $this->page_data["page_title"] = $this->title;
		
    }
    
    /***default function, redirects to login page if user not logged in ***/
    public function index()
    {
		/*** redirects to login page if user not logged in ***/
		login_redirect();
	   	$page_data[$this->modulename]     = $this->db->get($this->tablename)->result_array();
	    $this->page_data["page_name"]  = $this->path . $this->modulename . "create_view";
        $this->load->view('index', $this->page_data);
    }

	function edit() 
	{
		if ( $this->input->post() ) 
		{
			/*** redirects to login page if user not logged in ***/
			login_redirect();
			
			$this->load->model('user_password_model');

			$this->form_validation->set_rules($this->user_password_model->get_validation_rules());

			if ($this->form_validation->run() !== FALSE)
			{
				if ( isset( $_POST['edit'] ) ) {  
					if ( $_POST['edit'] == 1 ) {
						 $this->user_password_model->modify();
						 if ( $this->input->post('modal') == "1" ) {
							 $response = array ( 'status' => array('success'),
								'data'   => array() );
								echo json_encode($response);	
								exit();
						 } else {
							redirect(base_url() . $this->path , "refresh");
						 }
					}
				exit();	
				}
			} else {
				 $errors = array( 
					'username' => form_error('username'), 
					'oldpassword' => form_error('oldpassword'), 
					'password' => form_error('password'), 
					'conf_password' => form_error('conf_password'), 
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
			$this->page_data[$this->modulename] = $_POST;
		} else {
			if ( isset( $_GET['id'] ) ) 
			{
	   			$this->page_data[$this->modulename] = $this->db->get_where($this->tablename,  array('id' => $_GET['id'] ) )->first_row('array');
			}
		}
        $this->page_data["page_name"]  = $this->path . $this->modulename . "create_view";
        $this->load->view('index', $this->page_data);
	}
	
	function checkold_password() {
		$userid = get_userid();
		if ( $userid ) {
			$user_pass = $this->db->get_var("select password from ".$this->db->dbprefix."users where userid = '$userid'");
			if ( md5($this->input->post('oldpassword') ) != $user_pass ) {
				$this->form_validation->set_message( 'checkold_password' , 'Wrong old password');
				return FALSE;
			}
			return TRUE;
		}
	}
	
}