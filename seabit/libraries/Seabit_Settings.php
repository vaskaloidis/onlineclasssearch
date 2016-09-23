<?php

if (!class_exists('Seabit_Settings')){
  /**
  * Hooks
  */
	class Seabit_Settings 
	{
		var $user_rights = array();
		
		var $status = array('Open','Close','Stale');
		
		var $priority = array('Important','High','Medium','Low');

		var $action = array('Final','New','Pending','Ready', 'Sent','Excel Pending','No Response','Dispute','Close');
		
		var $action_icons = array('warning','new','important','success','success', 'primary','info','warning','info');

		function __construct()
		{
			$CI	=&	get_instance();
			$CI->load->database();
			$userid = $CI->session->userdata('userid') ;
			$this->user_rights = $CI->db->query("select name,userid, add_right, modify_right, delete_right, view_right from " . $CI->db->dbprefix . "user_right where userid = '$userid'")->result_array();
		}

		function get_action($id) {
			return $this->action[$id - 1];
		}
		
		function get_actionicon($id) {
			return $this->action_icons[$id - 1];
		}
		
		function get_status($id) {
			return $this->status[$id - 1];
		}

		function get_priority($id) {
			return $this->priority[$id - 1];
		}

	}
	
	global $sea_settings;
	$sea_settings = new Seabit_Settings();
}//end if
