<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Users Class
 *
 */
class Users {
	
	/**
	 * Users stack
	 *
     */
	private $user_info = array();
	 	
	 /**
	  * Constructor
	  *
	  * @access	public
	  *
	  */
	public function __construct()
	{	
		$this->ci =& get_instance();
	}
}
// END Breadcrumbs Class

/* End of file users.php */
/* Location: ./application/libraries/users.php */
