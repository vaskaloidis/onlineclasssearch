<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Signup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    
    /***default function, redirects to login page if user not logged in ***/
    public function index()
    {
		/*** redirects to login page if user not logged in ***/
		
		$page_data['layout']  = 'box';
		$page_data['page_title'] = 'Join SidePages';
		$page_data['page_metad']  = 'Sign Up';
		$page_data['page_robots']  = 'noindex,nofollow';
		
		
		if ( $this->input->post() ) {
			
			$this->load->model('signup_model');

			$this->form_validation->set_rules($this->signup_model->get_validation_rules());
	
			if ($this->form_validation->run() !== FALSE)
			{
				 $this->signup_model->insert();
					 redirect(base_url() . "success/", "refresh");
					 exit();	
			} else {
				 $errors = array( 
					'email' => form_error('email'), 
					'name' => form_error('name'), 
					'username' => form_error('username'), 
					'password' => form_error('password'), 
					'conf_password' => form_error('conf_password'), 
				);

			}

			if ( $_POST ) $page_data['signup'] = $_POST;	
			
			$page_data['page_name']  = 'signup/signupcreate_view';
			
    		 include TEMPLATEPATH . 'signup.php';
		} else {
			$page_data['layout']  = 'box';
		    $page_data['page_title'] = 'Join SidePages.com';
		    $page_data['page_metad']  = 'Sign Up';
		    $page_data['page_robots']  = 'noindex,nofollow';
		 	include TEMPLATEPATH . 'signup.php';
		}


		
    }
	
}