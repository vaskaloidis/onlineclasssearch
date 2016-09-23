<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Dashboard extends CI_Controller
{
	var $moduletype = "admin";
	var $modulename = "dashboard";
	var $title = "Dashboard";
	var $path = 'admin/dashboard/';

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

		/*
		$db = mysql_connect('localhost','root','');
		$dbs = array();
		$dbs[] = 'ci_ypusa';

		foreach($dbs as $v){
			mysql_select_db($v);
			$q = mysql_query('show tables');
			$tables = array();
			while($r = mysql_fetch_row($q)){
					$tables[] = $r[0];
			}
			foreach($tables as $t){
			//	echo "do $v.$t\n";
			//	echo 'SET storage_engine=InnoDB;ALTER TABLE `'.$t.'`  ENGINE = InnoDB;' . '</br>';
				mysql_query('ALTER TABLE `'.$t.'`  ENGINE = InnoDB;');
				//mysql_query('ALTER TABLE `'.$t.'` convert to character set utf8 collate utf8_general_ci;');
			}
		}
		mysql_close($db);
		*/

		$page_data['layout']  = 'box';
        $page_data['page_name']  = $this->path . $this->modulename . '_view';
        $page_data['page_title'] = $this->title;
        $this->load->view('index', $page_data);
    }
}