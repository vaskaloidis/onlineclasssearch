<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Page extends CI_Controller
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

        $page_data['page_name'] = $this->uri->segment(  $this->uri->total_segments() );
		$page_data["page_title"] = $this->db->get_var ( "select title from " . $this->db->dbprefix . "page where url = '" . $this->uri->segment(  $this->uri->total_segments() ) . "' ");
		if ( $page_data['page_name'] == 'page' ) exit();
        $this->load->view('index', $page_data);
    }

	
}