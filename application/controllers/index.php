<?php if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');
include 'seo.php';
class Login extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        $this->output->delete_cache();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		$wildcard = 'latest';
		$all_cache = $this->cache->cache_info();
		foreach ($all_cache as $cache_id => $cache) :
		   if (strpos($cache_id, $wildcard) !== false) :
		      $this->cache->delete($cache_id);
		   endif;
		endforeach;

		/*cache control*/
	}
	
	/***default functin, redirects to login page if no admin logged in yet***/
	public function index()
	{
		$this->output->delete_cache();
        $page_data['page_name']  = 'homepage';
        $page_data['page_title'] = 'usergroup';
        $this->load->view('index', $page_data);
        echo 'HERE';
        $this->output->delete_cache();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        $wildcard = 'latest';
        $all_cache = $this->cache->cache_info();
        foreach ($all_cache as $cache_id => $cache) :
            if (strpos($cache_id, $wildcard) !== false) :
                $this->cache->delete($cache_id);
            endif;
        endforeach;
	}
	
	
	/***DEFAULT NOR FOUND PAGE*****/
	function four_zero_four()
	{
		$this->load->view('four_zero_four');
	}

}