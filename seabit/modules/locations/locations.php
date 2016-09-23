<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Locations extends CI_Controller
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

    }

	public function autosuggest()
	{
		$v = '';
		if ( $this->input->get('v') ) {
			$v = $this->input->get('v');
		}


		$results = $this->db->query("select * from ypusa_course where name like '%$v%' order by rowid")->result();
		$output = '';
		echo '['. "\n";
		foreach ( $results as $result ) {
			if ( $output ) {
				$output .= ',' . "\n";
			}
			$output .= '{"name": "' . $result->name . '", "code": "' . $result->rowid . '"}';
		}
		echo $output;
		echo "\n";
		echo ']'; 
	}

}