<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Home extends CI_Controller
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
	
        $page_data['page_name']  = 'home/home_view';
        $page_data['page_title'] = get_option('website_title');
		
		$page_data['page_metad'] = get_option('meta_description');
		$page_data['page_metak'] = get_option('meta_keywords');
		
		$page_data['page_robots'] = 'noindex,follow';
        $this->load->view('index', $page_data);
    }

}