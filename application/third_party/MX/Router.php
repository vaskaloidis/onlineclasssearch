<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX core module class */
require dirname(__FILE__).'/Modules.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter router class.
 *
 * Install this file as application/third_party/MX/Router.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Router extends CI_Router
{
	protected $module;

	protected $module_section;

	public function fetch_module() {
		return $this->module;
	}

	public function fetch_module_section() {
		return $this->module_section;
	}

	public function _validate_request($segments) {

		if (count($segments) == 0) return $segments;

		/* locate module controller */
		if ($located = $this->locate($segments)) return $located;

        // If we've gotten this far it means that the URI does not correlate to a valid
        // controller class.  We will now see if there is an override


        if (!empty($this->routes['404_override']))
        {
            $x = explode('/', $this->routes['404_override']);
            $this->set_class($x[0]);
            $this->set_method(isset($x[1]) ? $x[1] : 'index');
            return $x;
        }

        // Nothing else to do at this point but show a 404
		show_404(implode('/', $segments));
	}
	
	function locatepage($segments) {
		//SEABIT CHANGES IN CORE
		$page_name = $segments[0];
		include( TEMPLATEPATH . 'frontend/page.php' );
		exit();
	}

	/** Locate the controller **/
	public function locate($segments) {		
		$this->module = '';
		$this->directory = '';
		$this->module_section = '';
		$ext = $this->config->item('controller_suffix').EXT;
		
		/* use module route if available */
		if (isset($segments[0]) AND $routes = Modules::parse_routes($segments[0], implode('/', $segments))) {
			$segments = $routes;
		}
	
		/* get the segments array elements */
	

		list($module, $sub_controller, $controller) = array_pad($segments, 3, NULL);
		

		if (!is_dir("seabit/modules/$module/")) {
			$module = 'search';
		}


        $controller = str_replace('-', '_', $controller);                                                                                                    

        $sub_controller = str_replace('-', '_', $sub_controller);  


		/* check modules */
		foreach (Modules::$locations as $location => $offset) {
		
			/* module exists? */

			if (is_dir($source = $location.$module.'/')) {
	
				// SEABIT MODULE PATH
				if ( $sub_controller ) {
					if ( is_file( $location.$module.'/'.$sub_controller.'/'. $sub_controller.$ext ) ) {
						$this->module = $sub_controller;
						$this->module_section = $module;
					} else {
						$this->module = $module;
					}
				} else {
					$this->module = $module;
				}

				$this->directory = $offset.$module.'/';

				/* module sub-controller exists? */
				if($sub_controller AND is_file($source.$sub_controller.$ext)) {
					return array_slice($segments, 1);
				}
				 	
				/* module sub-directory exists? */
				if($sub_controller AND is_dir($source.$sub_controller.'/')) {
					$source = $source.$sub_controller.'/'; 
					$this->directory .= $sub_controller.'/';
					/* module sub-directory controller exists? */

					if(is_file($source.$sub_controller.$ext)) {
						return array_slice($segments, 1);
					}

					/* module sub-directory sub-controller exists? */
					if($controller AND is_file($source.$controller.$ext))	{
						return array_slice($segments, 2);
					}
				}

				/* module controller exists? */			
				if(is_file($source.$module.$ext)) {
					return $segments;
				}
			} else {
				return $segments;
			}
		}
	
		/* application controller exists? */			
		if (is_file(APPPATH.'controllers/'.$module.$ext)) {
			return $segments;
		}
		
		/* application sub-directory controller exists? */
		if($sub_controller AND is_file(APPPATH.'controllers/'.$module.'/'.$sub_controller.$ext)) {
			$this->directory = $module.'/';
			return array_slice($segments, 1);
		}
		
		/* application sub-directory default controller exists? */
		if (is_file(APPPATH.'controllers/'.$module.'/'.$this->default_controller.$ext)) {
			$this->directory = $module.'/';
			return array($this->default_controller);
		}
	}

	public function set_class($class) {
		$this->class = str_replace('-', '_', $class.$this->config->item('controller_suffix') );
	}
                                                                                                                

    public function set_method($method)
    {
        $this->method = str_replace('-', '_', $method);
    }
}