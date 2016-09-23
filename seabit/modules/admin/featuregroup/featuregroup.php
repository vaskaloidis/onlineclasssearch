<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Roshan Bhati
 *	Seabit Technologies Private Limited
 *	http://www.seabit.in
 */

class Featuregroup extends CI_Controller
{
	var $moduletype = "admin";
	var $modulename = "featuregroup";
	var $tablename = "featuregroup";
	var $title = "Feature Group Master";
	var $path = "admin/featuregroup/";
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
	    $this->page_data["page_name"]  = $this->path . $this->modulename . "_view";
        $this->load->view('index', $this->page_data);
    }

	function create() 
	{
		/*** redirects to login page if user not logged in ***/
		login_redirect();
		
		if ( $this->input->post() ) {
			
			$this->load->model('featuregroup_model');

			$this->form_validation->set_rules($this->featuregroup_model->get_validation_rules());

		
			if ($this->form_validation->run() !== FALSE)
			{
				if ( isset( $_POST['edit'] ) ) 
				{  
					if ( $_POST['edit'] == 0 ) 
					{
						 $this->featuregroup_model->insert();
						 if ( $this->input->post('modal') == "1" ) {
							 $response = array ( 'status' => array('success'),
								'data'   => $data );
								echo json_encode($response);	
								exit();
						 } else {
							 if ( $this->input->post('savenew') ) {
								 redirect(base_url() . $this->path . "create", "refresh");
							 } else {
								 redirect(base_url() . $this->path , "refresh");
							 }
						 }
					}
				exit();	
				}
			} else {
				 $errors = array( 
					'name' => form_error('name'), 
					'description' => form_error('description'), 
					'active' => form_error('active'), 
				);
				$response = array ( 'status' => array('errors'),
								'data' => $errors );
				if ( $this->input->post('modal') == '1' ) {
					echo json_encode($response);	
					exit();
				}
			}
		}
		$this->page_data['layout']  = 'box';

		if ( isset( $_GET['action'] ) ) {
			if ( $_GET['action'] == 2 ) {
				 $this->page_data['modalform']  = true;
			}
		}
		
		if ( $_POST ) $this->page_data[$this->modulename] = $_POST;	
        $this->page_data["page_name"]  = $this->path . $this->modulename . "create_view";
		$this->load->view('index', $this->page_data);
	}
	
	function edit() 
	{
		if ( $this->input->post() ) 
		{
			/*** redirects to login page if user not logged in ***/
			login_redirect();
			
			$this->load->model('featuregroup_model');

			$this->form_validation->set_rules($this->featuregroup_model->get_validation_rules());

			if ($this->form_validation->run() !== FALSE)
			{
				if ( isset( $_POST['edit'] ) ) {  
					if ( $_POST['edit'] == 1 ) {
						 $this->featuregroup_model->modify();
						 if ( $this->input->post('modal') == "1" ) {
							 $response = array ( 'status' => array('success'),
								'data'   => $data );
								echo json_encode($response);	
								exit();
						 } else {
							 if ( $this->input->post('savenew') ) {
								 redirect(base_url() . $this->path . "create", "refresh");
							 } else {
								 redirect(base_url() . $this->path , "refresh");
							 }
						 }
					}
				exit();	
				}
			} else {
				 $errors = array( 
					'name' => form_error('name'), 
					'description' => form_error('description'), 
					'active' => form_error('active'), 
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
	
	function check_duplicate_name() 
	{
		$options = array(
			"func" => "check_duplicate_name",
			"tablename" => "featuregroup",
			"fieldname" => "name",
			"dupmsg" => "Duplicate Portfolio Group  Name"
			);
		return check_duplicate_field( $options );
	}
	
}