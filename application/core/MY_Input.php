<?php
class MY_Input extends CI_Input {

    function post($index = '', $xss_clean = FALSE)
    {
        // this will be true if post() is called without arguments 
        if($index === '')
        {
            return ($_SERVER['REQUEST_METHOD'] === 'POST');
        }
        
        // otherwise do as normally
        return parent::post($index, $xss_clean);
    }
}

// END: Class MY_Input

/* End of file MY_Input.php */
/* Location: ./application/core/MY_Input.php */
