<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Search extends CI_Controller
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

    // Load the tables library
        $this->load->library('table');
		
		// Load Pagination
		$this->load->library('pagination');
 
 		$location = '';
		$city = '';
		$state = '';
		$terms = '';
		

		
 		if ( isset ( $_GET['terms'] ) ) {
			$terms =  $_GET['terms'];
		}
		
		if ( $terms  ) :

			$search =  "where name like '%" . $terms . "%' or detail like '%" . $terms . "%' or uname like '%" . $terms . "%'  ";
			

			
			$query = $this->db->query("select * from ypusa_course $search order by prior");

			$totalrows = $query->num_rows();	
				
			$per_page = 30;
	
			// Config setup
			$config['base_url'] = base_url().'/search/?terms=' . $terms  ;
			
			$config['total_rows'] = $totalrows;
			$config['per_page'] = $per_page;
			
			// I added this extra one to control the number of links to show up at each page.
			$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE;
			$config['query_string_segment'] = 'page';
			$config['num_links'] = 5;
			$config['cur_tag_open'] = '&nbsp;<span class="current">';
			$config['cur_tag_close'] = '</span>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
	
	
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			
			
			// Initialize
			$this->pagination->initialize($config);
			$page = $this->input->get('page');
			$page =  $page  ? $page : '1';
			
			$page_data['startno']  = (( $page - 1 ) * $per_page)  ;
			
			$this->db->order_by('rowid');
			
			$page_data['listing'] = $this->db->query("select * from ypusa_course  $search order by prior limit " .  $page_data['startno'] . ", 30 " );
	
			
			$page_data['showing']  = "Showing " . $page_data['startno'] . "-" . ($page_data['startno']+$per_page-1) . " of " . $totalrows . " results";
		
		else:
			$page_data['startno'] = 0; 
			$page_data['listing'] = null;
			$page_data['showing'] = '';
		endif;
		
        $page_data['page_name']  = 'search/search_view';
        $page_data['page_title'] = "$terms - Online Class Ssearch";
		
		$page_data['page_metad'] = "Showing 0 courses related to $terms in on Online Class Ssearch. ";
		
		$page_data['page_robots'] = 'noindex,follow';
        $this->load->view('index', $page_data);
    }

}