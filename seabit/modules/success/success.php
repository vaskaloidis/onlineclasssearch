<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Success extends CI_Controller
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
        $page_data['page_name']  = 'success/success_view';
	    $this->load->view('index', $page_data);
    }
	
}