<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('DATE_FORMAT', 'dd/mm/yyyy');
define('DATE_SEPARATOR ', '/');


function _e( $text, $domain = 'default' ) 
{
	echo $text;
}

function __( $text, $domain = 'default' ) 
{
	return $text;
}

function getDateFormat() {
	return 'dd/mm/yyyy';
}

function getDateSeparator() {
	return '/';
}

function getDay( $dt = '' ) {
	if ( $dt ) {
		return date('d', strtotime( $dt ) );
	} else {
		return date('d');
	}
}

function getMonth( $dt = '' ) {
	if ( $dt ) {
		return date('m', strtotime( $dt ) );
	} else {
		return date('m');
	}
}

function getFullMonth( $dt = '' ) {
	if ( $dt ) {
		return date('F', strtotime( $dt ) );
	} else {
		return date('F');
	}
}

function getYear( $dt = '' ) {
	if ( $dt ) {
		return date('Y', strtotime( $dt ) );
	} else {
		return date('Y');
	}
}

function getMysqlDate( $dt ) {
	if ( strpos( $dt, '/' ) !== false ) {
		$dtt = explode( getDateSeparator(), $dt );
		return $dtt[2] . '-' . $dtt[1] . '-' . $dtt[0];
	} else {
		return $dt;
	}
}

function getAppDate( $dt ) {
	if ( strpos( $dt, "-") !== false ) {
		$dtt = explode( '-' , $dt );
		return $dtt[2] . getDateSeparator() . $dtt[1] . getDateSeparator() . $dtt[0];
	} else {
		return $dt ;
	}
}

function login_redirect( $module = '' ) {
	date_default_timezone_set('Asia/Calcutta');
	$CI =& get_instance();

	if ($CI->session->userdata('userid') == '' ) {
		if ( $module ) {
			redirect(base_url() . 'login/?redirect=' . $module, 'refresh');
		} else {
			redirect(base_url() . 'login', 'refresh');
		}
	}
	/*	
	if ( $module ) {
		if ( get_user_right( $module, 'view' ) != 1 ) {
			redirect(base_url() . 'dashboard', 'refresh');
		}
	}
	*/
}

function get_userid() {
	$CI =& get_instance();
	$userid = $CI->session->userdata('userid') ;
	return $userid ;
}


function get_user_right($module, $right) {
	$CI =& get_instance();
	$userid = $CI->session->userdata('userid') ;
	global $sea_settings;
	$results = $sea_settings->user_rights;
	foreach ( $results as $row ) {
		if ( $row['userid'] == $userid ) {
			if ( $row['name'] == $module ) {
				if ( $row[$right . '_right'] == 1 ) {
					return true;
				}
			}
		}
	}
	return false;
}

function get_username() {
	$CI =& get_instance();
	$userid = $CI->session->userdata('userid') ;
	if ( $userid ) {
		$username = $CI->db->get_var("select name from ".$CI->db->dbprefix."users where userid = '$userid'");
		return $username;
	}
}


function get_displayname() {
	$CI =& get_instance();
	$userid = $CI->session->userdata('userid') ;
	if ( $userid ) {
		$displayname = $CI->db->get_var("select displayname from ".$CI->db->dbprefix."users where userid = '$userid'");
		return $displayname;
	}
}

function get_user_role() {
	$CI =& get_instance();
	$userid = $CI->session->userdata('userid') ;
	if ( $userid ) {
		$usr_role = $CI->db->get_var("select role from ".$CI->db->dbprefix."users where userid = '$userid'");
		return $usr_role;
	}
}

function get_user_meta( $meta_key, $user_id ) {
	$CI =& get_instance();
	$val = $CI->db->get_var( "select meta_value from " . $CI->db->dbprefix . "usermeta where user_id = '$user_id' and meta_key = '$meta_key' ");

	if ( $val ) {
		return $val;
	}
}

function update_user_meta( $meta_key, $meta_value, $user_id ) {
	$CI =& get_instance();
	$val = $CI->db->get_var( "select meta_value from " . $CI->db->dbprefix . "usermeta where user_id = '$user_id' and meta_key = '$meta_key' ");

	if ( $val ) {
		$data = array(
		'meta_key'=> $meta_key ,
		'meta_value'=> $meta_value ,
		);
		$CI->db->where('user_id', $user_id );
		$CI->db->update('usermeta', $data);
	} else {
		$data = array(
		'meta_key'=> $meta_key ,
		'meta_value'=> $meta_value ,
		'user_id'=> $user_id ,
		);
		$CI->db->insert('usermeta', $data);
	}
}

function toAscii($str, $replace=array(), $delimiter='-') {
	 if( !empty($replace) ) {
	  $str = str_replace((array)$replace, ' ', $str);
	 }
	
	 $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	 $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	 $clean = strtolower(trim($clean, '-'));
	 $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	
	 return $clean;
}


function get_option( $option_name ) {
	$CI =& get_instance();
	$val = $CI->db->get_var( "select option_value from " . $CI->db->dbprefix . "options where option_name = '$option_name' ");

	if ( $val ) {
		return $val;
	}
}

function update_option( $option_name, $option_value ) {
	
	$CI =& get_instance();
	if ( $option_value ) {
		$val = $CI->db->get_var( "select option_value from " . $CI->db->dbprefix . "options where  option_name = '$option_name' ");

		if ( $val ) {
			$data = array(
			'option_value'=> $option_value ,
			);
			$CI->db->where('option_name', $option_name );
			$CI->db->update('options', $data);
		} else {
			$data = array(
			'option_name'=> $option_name ,
			'option_value'=> $option_value
			);
			$CI->db->insert('options', $data);
		}
	} else {
		$CI->db->delete('options', array('option_name' => $option_name));
	}
}

function sea_panel_heading( $caption ) {
	$output = '<div class="panel-heading">
		<h3 class="panel-title">' . $caption .'</h3>
		<div class="actions pull-right">
			<i class="fa fa-expand"></i>
			<i class="fa fa-chevron-down"></i>
			<i class="fa fa-times"></i>
		</div>
    </div>';
	echo $output;
}

function sea_section_heading( $caption ) {
	$output = '<div class="form-group" style="margin-top:0; margin-bottom:0">
		<label class="control-label  col-sm-4" >&nbsp;</label>
		<div class="controls col-sm-8">
			<h5 style="font-weight:700;padding-top:20px;">' . $caption . '</h5>
		</div>
	</div>';
	echo $output;
}

if ( !function_exists('sea_form_select') ) :

function sea_form_select( $name, $sql, $value = "" ) {
	$CI =& get_instance();
	$CI->load->database();
	echo '<select name="' . $name . '" id="' . $name . '" class="form-control select">';
			$results = $CI->db->query($sql)->result_array();
			foreach ( $results as $result )
			{
				if( $result['id'] != '' ) {
					if( $result['id'] == $value ){
						echo "<option value='" . $result['id'] . "' selected >" . $result['name'] . "</option>";
					}else{
						echo "<option value='" . $result['id'] . "'>" . $result['name'] . "</option>";
					}
				}
			}
	echo "</select>";
}
endif;

if ( !function_exists('sea_form_selectoption_v') ) :

function sea_form_selectoption_v( $name, $options, $value = "" ) {
	$output = '';
	if ( isset ( $options ) ) {
		$counter = 1;

		$output .= '<select name="'.$name.'" id="'.$name.'" class="form-control select">';
		foreach ( $options as $option_key => $option_value ) 
		{
			if( $option_value != '' ) {
				if( $option_key == $option_value ){
					$output .= "<option value='" . $option_key . "' selected>" . $option_value . "</option>";
				}else{
					$output .= "<option value='" . $option_key . "'>" . $option_value . "</option>";
				}
			}
		}
		$output .= "</select>";
		return $output;

	}
}
endif;

function sea_checkbox( $caption, $fieldID, $mandatory, $value ) {
	if ( $mandatory === true ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group">
			<label class="control-label  col-sm-4 required" for="' . $fieldID . '"></label>
			<div class="controls col-sm-8"><div class="checkbox">
                        <input id="' . $fieldID . '" name="' . $fieldID . '" type="checkbox" >
                        <label for="' . $fieldID . '">
                            ' . $caption . '
                        </label>
                    </div>
				</div>
			</div>';

}

function sea_textbox( $caption, $fieldID, $mandatory, $value, $layout = 'h' ) {
	$required = '';
	$errorclass = '';
	if ( form_error($fieldID) ) $errorclass = 'has-error';
	if ( $mandatory ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group ' . $errorclass . '">';
	if ( $layout == 'v' ) {
		echo '<label  for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls">
			<input class="form-control" type="text" id="' . $fieldID . '" name="' . $fieldID . '" value="' . $value . '" />
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
		} else {
		echo '<label class="control-label  col-sm-4" for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls col-sm-8">
			<input class="form-control" type="text" id="' . $fieldID . '" name="' . $fieldID . '" value="' . $value . '" />
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
		}
	echo '</div>';
}

function sea_textbox_disabled( $caption, $fieldID, $mandatory, $value, $layout = 'h' ) {
	$required = '';
	if ( $mandatory ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group">';
	if ( $layout == 'v' ) {
		echo '<label  for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls">
			<input class="form-control" type="text" id="' . $fieldID . '" name="' . $fieldID . '" value="' . $value . '" disabled />
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
		} else {
		echo '<label class="control-label  col-sm-4" for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls col-sm-8">
			<input class="form-control" type="text" id="' . $fieldID . '" name="' . $fieldID . '" value="' . $value . '" disabled />
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
		}
	echo '</div>';
}

function sea_textarea( $caption, $fieldID, $mandatory, $value, $layout = 'h' ) {
	$required = '';
	$errorclass = '';
	if ( form_error($fieldID) ) $errorclass = 'has-error';
	if ( $mandatory ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group ' . $errorclass . '">';
	if ( $layout == 'v' ) {
		echo '<label  for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls">
			<textarea class="form-control col-sm-10" id="' . $fieldID . '" name="' . $fieldID . '" rows="6" >' . $value . '</textarea>
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
		} else {
		echo '<label class="control-label  col-sm-4" for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls col-sm-8">
			<textarea class="form-control col-sm-10" id="' . $fieldID . '" name="' . $fieldID . '" rows="6" >' . $value . '</textarea>
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
		}
	echo '</div>';
}

function sea_password( $caption, $fieldID, $mandatory, $value, $layout = 'h' ) {
	$required = '';
	$errorclass = '';
	if ( form_error($fieldID) ) $errorclass = 'has-error';
	if ( $mandatory ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group ' . $errorclass . '">';
	if ( $layout == 'v' ) {
		echo '<label class="required" for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls">
			<input class="form-control" type="password" id="' . $fieldID . '" name="' . $fieldID . '" value="' . $value . '" />
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
	} else {
		echo '<label class="control-label  col-sm-4 required" for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls col-sm-8">
			<input class="form-control" type="password" id="' . $fieldID . '" name="' . $fieldID . '" value="' . $value . '" />
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>';
	}
	echo '</div>';
}

function sea_textbox_date( $caption, $fieldID, $mandatory, $value, $layout = 'h' ) {
	$required = '';
	$errorclass = '';
	if ( form_error($fieldID) ) $errorclass = 'has-error';
	$val =  $value != '' ? getAppDate( $value ) : '';
	if ( $mandatory === true ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group  ' . $errorclass . '">
		<label class="control-label  col-sm-4 required" for="' . $fieldID . '">' . $caption . '&nbsp;' . $required . '</label>
		<div class="controls col-sm-8">
		    <div class="input-group" >
				<input class="form-control date-picker" type="text" id="' . $fieldID . '" name="' . $fieldID . '" value="' . $val . '" />
				<span class="input-group-btn"> <button type="button" class="btn btn-primary add-icon"><i class="fa fa-calendar" ></i></button></span>
				<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
			</div>
		</div>
	</div>';
}


function sea_group_textbox( $caption, $fieldID, $mandatory, $class, $value ) {
	echo '		<div class="'. $class.'" >
			<input class="form-control" type="text" id="' . $fieldID . '" name="' . $fieldID . '" placeholder="' . $caption . '" value="' . $value . '" />
			<span class="help-block m-b-zero label-inline">' . form_error($fieldID) . '</span>

			</div>';
}

function sea_dropdown( $caption, $fieldID, $mandatory, $options, $value ) {
	if ( $mandatory === true ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group" >
		<label class="control-label  col-sm-4 required" for="' . $fieldID . '">' . $caption . '</label>
		<div class="controls col-sm-8">
			' . sea_form_selectoption ( $fieldID, $options, $value ) . '
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>
	</div>';
}

function sea_form_selectoption( $name, $options, $value = "" ) {
	$output = '';
	if ( isset ( $options ) ) {
		$counter = 1;
		$output .= '<select name="' . $name . '" id="' . $name . '" class="form-control chosen select">';
		foreach ( $options as $option ) 
		{
			if( $option != '' ) {
				if( $option == $value ){
					$output .= "<option selected >" . $option . "</option>";
				}else{
					$output .= "<option>" . $option . "</option>";
				}
			}
		}
		$output .= "</select>";
		return $output;

	}
}

function sea_dropdown_v( $caption, $fieldID, $mandatory, $options, $value ) {
	if ( $mandatory === true ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group" >
		<label class="control-label  col-sm-4 required" for="' . $fieldID . '">' . $caption . '</label>
		<div class="controls col-sm-8">
			' . sea_form_selectoption_v ( $fieldID, $options, $value ) . '
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>
	</div>';
}

function set_db_prefix( $sql ) {
	if (!$sql) return '';
	$CI =& get_instance();
	preg_match('/from (\w+)/',$sql ,$matches );
	$tablename = trim( str_replace( 'from' , '', $matches[0] ) );
	return str_replace ( ' ' . $tablename . ' ', ' ' . $CI->db->dbprefix . $tablename . ' ', $sql );
}

function sea_dropdown_sql( $caption, $fieldID, $mandatory, $sql, $addlink, $value, $layout = 'h' ) {
	$CI =& get_instance();
	$sql = set_db_prefix ($sql);
	if ( $mandatory === true ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group" >
		<label class="control-label col-sm-4 required" for="' . $fieldID . '">' . $caption . '</label>
		<div class="controls col-sm-8 ">';
		if ( $addlink ) {
			echo '<div class="input-group" >';
		}
				echo '<select name="'.$fieldID.'" id="'.$fieldID.'" class="form-control chosen select" >';
			
				$results = $CI->db->query($sql)->result_array();
				if ( $results ) {
					foreach ( $results as $result )
					{
						$keys = array_keys($result);
						$name = $keys[0];
						$id = $keys[1];
						
						
						if( $result[$id] != "" ) {
							if( $result[$id] == $value ){
								echo '<option value="' . $result[$id] . '" selected>' . $result[$name] . '</option>';
							} else{
								echo '<option value="' . $result[$id] . '" >' . $result[$name] . '</option>';
							}
						}
					}
				}
			echo '</select>';
			if ( $addlink ) {
			echo '<span class="input-group-btn"> <button type="button" data-id="'.$fieldID.'" data-toggle="modal" data-target="' . base_url() . $addlink . '/create" class="btn btn-primary">+</button> </span>';
			}
			echo '<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>';
			if ( $addlink ) echo '</div>';
		echo '</div>
	</div>';
}

function sea_multi_dropdown_sql( $caption, $fieldID, $mandatory, $sql, $dsql, $addlink ) {
	if ( $mandatory === true ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group" >
		<label class="control-label  col-sm-4 required" for="' . $fieldID . '">' . $caption . '</label>
		<div class="controls col-sm-8">';
		if ( $addlink ) {
			echo '<div class="input-group" >';
		}
				echo '<select name="'.$fieldID.'[]" id="'.$fieldID.'" multiple class="form-control chosen select" >';
			
				$CI =& get_instance();
				$CI->load->database();

				if ( $_POST ) {
					if ( $value ) {
						if ( is_array ( $value ) ) {
							$datavalue = $value ;
						}
					}
				} else {
					if ( $dsql && isset ( $_GET['id'] ) ) {
						$msval = explode("," , $dsql ); 
						$dataresults = $CI->db->query("select " . $msval[2] . " from " . $CI->db->dbprefix . $msval[0] . "  where " . $msval[1] . "  = '" . $_GET['id'] . "'" )->result_array();
						if ( $dataresults ) {
							$datavalue = array();
							foreach ($dataresults as $dataresult ) {
								array_push( $datavalue  , $dataresult[ $msval[2] ] );
							}
						}
					}
				}
						
				$results = $CI->db->query( $sql )->result_array();
	
				foreach ( $results as $result )
				{
					$keys = array_keys($result);
					$name = $keys[0];
					$id = $keys[1];
					if ( $datavalue && in_array(  $result[$id] , $datavalue ) ) {
						$sel_value = 'selected=true' ;
					} else {
						$sel_value = '' ;
					}

					if( $result[$id] != "" ) {
						echo '<option value="' . $result[$id] . '" ' . $sel_value . '>' . $result[$name] . '</option>';
					}
				}
			echo '</select>';
			if ( $addlink ) {
			echo '<span class="input-group-btn"> <button type="button" data-id="'.$fieldID.'" data-toggle="modal" data-target="' . base_url() . $addlink . '/create" class="btn btn-primary">+</button> </span>';
			}
			echo '<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>';
			if ( $addlink ) echo '</div>';
		echo '</div>
	</div>';
}

function tpo_dropdown_sql( $fieldname, $fieldvalue,  $sql  ) {
				$output = '<select name="' . $fieldname . '" id="' . $fieldname . '" class="form-control chosen select" >';
			
				$CI =& get_instance();
				$CI->load->database();
			
				$results = $CI->db->query($sql)->result_array();
	
				foreach ( $results as $result )
				{
					$keys = array_keys($result);
					$name = $keys[0];
					$id = $keys[1];
					
					
					if( $result[$id] != "" ) {
						if( $result[$id] == $fieldvalue ){
							$output .= '<option  selected>' . $result[$name] . '</option>';
						} else{
							$output .= '<option >' . $result[$name] . '</option>';
						}
					}
				}
			$output .= '</select>';
		return $output;
}


function sea_country_dropdown( $caption, $fieldID, $mandatory, $value ) {
	if ( $mandatory === true ) $required = '<span class="mandatory">*</span>';
	echo '<div class="form-group">
		<label class="control-label  col-sm-4 required" for="' . $fieldID . '">' . $caption . '</label>
		<div class="controls col-sm-8">
			<select name="'.$fieldID.'" id="'.$fieldID.'" class="form-control chosen select" >';

			$CI =& get_instance();
			$CI->load->database();
		
			$results = $CI->db->query("SELECT * FROM " . $CI->db->dbprefix . "country  ORDER BY name ASC")->result_array();
		
			foreach ( $results as $result )
			{
				if( $result['countryid'] != "" ) {
					if( $result['countryid'] == $value ){
						echo '<option value="' . $result['countryid'] . '" selected>' . $result['name'] . '</option>';
					} else{
						echo '<option value="' . $result['countryid'] . '" >' . $result['name'] . '</option>';
					}
				}
			}
	 	echo '</select>
			<span class="help-block m-b-zero">' . form_error($fieldID) . '</span>
		</div>
	</div>';
}


function check_duplicate_field( $options  ) 
{
	if ( isset( $options ) ) {
		extract( $options );
	}
	
	$CI =& get_instance();
	$CI->load->database();
	
	if ( $_POST['edit'] == 1 ) {
		$query = $CI->db->query("select id from " . $CI->db->dbprefix . "$tablename where $fieldname = '" . trim( $_POST[ $fieldname ] ) . "' and id <> '" . $CI->input->post('id') . "'");
	} else {
		$query = $CI->db->query("select id from " . $CI->db->dbprefix . "$tablename where $fieldname = '" . trim( $_POST[ $fieldname ] ) . "' ");
	}
	if ( $query->num_rows() > 0 ) {
		$CI->form_validation->set_message( $func, $fieldname . ' already exists');
		return FALSE;
	} else {
		return TRUE;
	}
}

function sea_guid() { 
    $s = strtoupper(md5(uniqid(rand(),true))); 
    $guidText = 
        substr($s,0,8) . '-' . 
        substr($s,8,4) . '-' . 
        substr($s,12,4). '-' . 
        substr($s,16,4). '-' . 
        substr($s,20); 
    return $guidText;
}


function template_url() {

	if (isset($_SERVER['HTTP_HOST']))
	{
		$template_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$template_url .= '://'. $_SERVER['HTTP_HOST'];
		$template_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
	}

	else
	{
		$template_url = 'http://localhost/';
	}

}

function sea_allowed_images( $fieldID ) {

	// A list of permitted file extensions
	$allowed = array('png', 'jpg' );
	
	if( isset( $_FILES[$fieldID] ) && $_FILES[$fieldID]['error'] == 0){
	
		$extension = pathinfo($_FILES[$fieldID]['name'], PATHINFO_EXTENSION);
	
		if(!in_array(strtolower($extension), $allowed)){
			return FALSE;
			exit;
		}
	}
	return TRUE;
}

if ( ! function_exists('seabit_admin_options_creation'))
{
	// Parameters  Class Name, Fields options, POST or MYSQL data, Primarykey field name, Path of home to redirect
	function seabit_admin_options_creation($cls, $options, $data , $primarykey, $homepath ) 
	{
		global $hooks;
		$modulename = $homepath;
	
		foreach ( $options as $value) {
		//	if ( $value['hook'] ) {
				//$value = stripslashes($hooks->apply_filters( $value['hook'] , $value ));
		//	}
		}
		$i=0;

		/*if ( $_REQUEST ) {
			if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
			if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
		}
		*/
		$output = '';
		$output .= '<div class="tab-pane box" id="add" style="padding: 5px">';
		$output .= '	<div class="box-content">';
		$output .= '		<div class="padded" >';
		$output .= '				<form id="masterform" class="form-horizontal" method="post" action="" >';
			foreach ($options as $value) {
				$name = isset( $value['name'] ) ? $value['name'] : '';
				$class = isset( $value['class'] ) ? $value['class'] : '';
				$caption = isset( $value['caption'] ) ? $value['caption'] : '';
				$id = isset( $value['id'] ) ? $value['id'] : '';
				$type = isset( $value['type'] ) ? $value['type'] : '';
				$error = isset( $cls->errors[$name] ) ? $cls->errors[$name] : '';
				$disable = isset( $value['disable'] ) ? $value['disable'] : '';
				$std = isset( $value['std'] ) ? $value['std'] : '';
				$value = isset( $data->$name ) ? $data->$name : '';
				switch ( $type ) {
				case "open":
					$output .= '<div class="panel sixteen columns">';
					break;
				case "section":
					if ( !$class ) { $class ='one_half'; }
					$output .= '<div class="fieldset ' . $class . '">
							<h3 class="form-subtitle" >'.$caption.'</h3>';
					break;
				case "fullsection":
					if ( !$class ) { $class ='sixteen columns'; }
					$output .= '<div class="fieldset ' . $class . '">
							<h3 class="form-subtitle" >'.$caption.'</h3>';
					break;
				case "grid":
					if ( !$class ) { $class ='sixteen columns'; }
					$output .= '<div class="fieldset ' . $class . '">
							<h3 class="form-subtitle" >'.$caption.'</h3>';
							
					require_once( ABSPATH . 'module/' . strtolower($modulename) .'/' .  'tmpl.' . $modulename . $name );
					break;
				case "close":
					$output .= '</div>';
					break;
 				case "title":
					$output .= '			<div class="sixteen columns" >';
					$output .= '				<h2 class="form-title" >'.$caption.'</h2>';
					$output .= '			</div>';
					break;
 				case 'textarea':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
					} else {
						$enable = '';
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><textarea  ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' rows="5" cols="80"  >'.$value.'</textarea></div>';
					$output .= $error . '</div>';
					break;
 				case 'numeric':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
					} else {
						$enable = '';
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "class=\"numeric\"" ) . ' type="text" value="' .
					 ( ( $value  != '') ?  stripslashes($value) :  $std ) . '"    autocomplete="off"  /></div>';
					$output .= $error . '</div>';
					break;
 				case 'text':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
						 $class = 'fixed';
					} else {
						$enable = '';
						$class = '';
					}

					$stdval = "" ;

				//	if( $std == "currentusername" ) {
				//		$currentuser =  get_currentuserinfo();
				//		$stdval = $currentuser->name;        
				////	} 

        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box '.$class.'" ><input  ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != '') ? 'class="'.$class.'"' : '' ) . ' type="' . $type . '" value="' .  ( ( $value   != '') ?  stripslashes( $value  ) :  $stdval ) . '"  autocomplete="off"  /></div>';

					
					$output .= $error . '</div>';
					break;
 				case 'hidden':
        			$output .= '<input name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' type="' . $type . '" value="' .
					 ( ( $value  != '') ?  stripslashes($value) :  $std ) . '" />';
					break;
 				case 'view':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
						 $class = 'fixed';
					} else {
						$class = '';
						$enable = '';
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					if ( $_POST ) {
						if ( $value['dsql'] ) {
							$sql = str_replace('{prefix}',$wpdb->prefix , $value['dsql']);
							$sql = str_replace('{fieldvalue}',$data->$primarykey , $sql);
							$viewval = $wpdb->get_var( $sql  );
						}
					} else {
						$viewval = stripslashes( $value );
					}
					$output .= '<div class="input_box '.$class.'" ><div class="inputview ' . $class .'" >' . $viewval .  '</div></div>';
					$output .= '</div>';
					break;
 				case 'multientry':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
					} else {
						$enable = '';
					}



					$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" >';
					$output .= '<select  style="width:94%" ' . $enable . ' name="' . $name . '" id="' . $id . '"  ' . (($class != "") ? "class=".$class."" : "" ) . ' >';

					if ( $value['options'] ) {
						foreach ( $value['options'] as $key => $row ) {
							if ( $value == $key ) {
								$sel_value = 'selected=true' ;
							} else {
								$sel_value = '' ;
							}
							$output .= '<option ' . $sel_value .' >'.$row.'</option>';
						}
					}
					if ( $value['sql'] ) {
						$sql = str_replace('{prefix}',$wpdb->prefix , $value['sql']);
						$sql = str_replace('{primarykey}',$data->$primarykey , $sql);
						$rows = $wpdb->get_results( $sql, ARRAY_N  );
						if ( $rows ) {
							foreach ( $rows as $key => $row ) {
								$output .= '<option value="'.$row[1].'" ' . $sel_value .' >'.$row[0].'</option>';
							}
						}
					}
					$output .= '</select><a class="add_me"  href="#" ><img src="' . base_url() .'images/add-icon.png" alt="" /></a>';

					$output .= '<div><table class="multi_entry" ><tbody></tbody></table></div>';
					$output .= '</div></div>';

					break;


 				case 'multientry1':
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><table class="table_multi" ><tr ><td><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class= \"add_mr_text ".$class."" : "" ) . ' type="' . $type . '" value="' .  stripslashes($value)   . '"  autocomplete="off"  /><td><a class="add_mr"  href="#" ><img src="' . base_url() .'images/add-icon.png" alt="" /></a></td></tr></table></div>';
					$output .= $error . '</div>';
					break;
				case 'multidisplay':
					$sql = str_replace( '{fieldvalue}', $data->$primarykey , $value['dsql'] );
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" >' . tpo_table_from_sql( $sql ) . '</div>';
					$output .= $error . '</div>';
					break;	
				case 'custom':
					
        			$output .= call_user_func_array($value['hook'], array($data->$primarykey) ) ;
					break;	
 				case 'autono':
					if ( $data->edit != 'true' ) {
						$sql = str_replace( '{branchid}',getbranchid(), $value['sql'] );
						$maxno = $wpdb->get_var($sql);
						$prefix_string = $wpdb->get_var("select prefix from module_prefix where module = '" . $modulename . "'"  );
						$docnobody = $wpdb->get_var("select body from module_prefix where module = '" . $modulename . "'"  );
						$branchcode  = $wpdb->get_var("select code from branch where id='" . getbranchid() . "'");
						if ( !$maxno ) $maxno=1;	
						
						$prefix_string = str_replace('{branchcode}', $branchcode , $prefix_string ) ;
						$prefix_string = str_replace('{Y}', ( date('y') ) . '-' . (date('y')+1) , $prefix_string ) ;
						$prefix = str_replace('{number}', ''  , $prefix_string ) ;
						$fulldocno = str_replace('{number}',  sprintf("%0".$docnobody."d",  $maxno)  , $prefix_string ) ;
					} else {
						$fulldocno = $wpdb->get_var( str_replace( "{fieldvalue}", stripslashes( $data->$primarykey ) , $value['dsql']  ) );
					}

        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><div class="inputview" >' .
					 ( ( $value  != '') ?   $fulldocno:  $fulldocno ) . '</div></div>';
					 if ( $data->edit != 'true' ) {
							$output .= '<input type="hidden" name="prefix" value="' . $prefix . '" />';
							$output .= '<input type="hidden" name="fulldocno" value="' . $fulldocno . '" />';
							$output .= '<input type="hidden" name="' . $name . '" value="' . $maxno . '" />';
					 }
					$output .= '</div>';
					break;
 				case 'username':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
						 $class = 'fixed';
					} else {
						$enable = '';
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' type="text" value="' .
					 ( ( $value  != '') ?  stripslashes($value) :  $std ) . '"  autocomplete="off"  /></div>';
					$output .= '<span id="mess_username" class="reg_form_error_message"></span>';
					$output .= $error . '</div>';
					break;
 				case 'password':
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><input name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' type="' . $type . '"  autocomplete="off"  /></div>';
					$output .= $error . '</div>';
					
        			$output .= '<div class="field">' ;
					$output .= '<label for="conf_user_password">Confirm Password</label>';
					$output .= '<div class="input_box" ><input name="conf_user_password" id="conf_user_password" ' . (($class != "") ? "class=".$class."" : "" ) . ' type="' . $type . '"   autocomplete="off"  /></div>';
					$output .= $cls->errors['conf_user_password'] . '</div>';
					break;
 				case 'import':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
					} else {
						$enable = '';
					}
        			
					if ( $value['dsql']){
					
					$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' type="hidden" value="' .  stripslashes($value)   . '"  autocomplete="off"  /><input type="text" readonly="true"  value="' . $wpdb->get_var( str_replace('{fieldvalue}',  stripslashes($value),  $value['dsql'] ) ) . '" /></div>';

					}
					else {
					
					$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' type="hidden" value="' .  stripslashes($value)   . '"  autocomplete="off"  /><input type="text" readonly="true"  value="' .  stripslashes($value)   . '" /></div>';

					}
					$output .= $error . '</div>';
					break;
 				case 'select':
					if ( $disable == 'Y' ) { 
						 $enable = 'disabled';
					} else {
						$enable = '';
					}


					$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" >';
					$output .= '<select class="chzn-select"  ' . $enable . ' name="' . $name . '" id="' . $id . '"  ' . (($class != "") ? "class=".$class."" : "" ) . ' >';

					
					if ( $value['options'] ) {
						foreach ( $value['options'] as $key => $row ) {
								
							if ( $value == $value['options'][$key] ) {
								

								$sel_value = 'selected=true' ;
								
							} else {
								$sel_value = '' ;
							}
							
							$output .= '<option ' . $sel_value .' >'.$row.'</option>';
						}
					}
					if ( $value['sql'] ) {
						$output .= '<option value="0"  >Select list</option>';
						$sql = str_replace('{prefix}',$wpdb->prefix , $value['sql']);
						$sql = str_replace('{primarykey}',$data->$primarykey , $sql);
						$rows = $wpdb->get_results( $sql, ARRAY_N  );
						if ( $rows ) {
							foreach ( $rows as $key => $row ) {
								if ( $value == $row[1] ) {
									$sel_value = 'selected=true' ;
								} else {
									$sel_value = '' ;
								}
								$output .= '<option value="'.$row[1].'" ' . $sel_value .' >'.$row[0].'</option>';
							}
						}
					}
					$output .= '</select></div>';
					$output .= $error . '</div>';
					break;

 				case 'multiselect':
					$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" >';
					$output .= '<select multiple class="chzn-select"  name="' . $name . '[]" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' >';

					if ( $value['options'] ) {
						foreach ( $value['options'] as $key => $row ) {
							if ( $value == $key ) {
								$sel_value = 'selected=true' ;
							} else {
								$sel_value = '' ;
							}
							$output .= '<option value="'.$key.'" ' . $sel_value .' >'.$row.'</option>';
						}
					}
					
					if ( $value['sql'] ) {
						if ( $_POST ) {
							if ( $value ) {
								if ( is_array ( $value ) ) {
									$datavalue = $value ;
								}
							}
						} else {
							if ( $value['dsql'] ) {
								$msval = explode("," , $value['dsql']); 
								$dataresults = $wpdb->get_results("select ".$msval[2]." from ".$wpdb->prefix.$msval[0]."  where ".$msval[1]."  = '".$data->$primarykey."'"  , ARRAY_N  );
								if ( $dataresults ) {
									$datavalue = array();
									foreach ($dataresults as $dataresult ) {
										array_push($datavalue  , $dataresult[0]);
									}
								}
							}
						}
						$sql = str_replace('{prefix}',$wpdb->prefix , $value['sql']);
						$sql = str_replace('{primarykey}',$data->$primarykey , $sql);
						$rows = $wpdb->get_results( $sql, ARRAY_N  );
						if ( $rows ) {
							foreach ( $rows as $key => $row ) {
								if ( $datavalue && in_array($row[1],$datavalue )) {
									$sel_value = 'selected=true' ;
								} else {
									$sel_value = '' ;
								}
								$output .= '<option value="'.$row[1].'" ' . $sel_value .' >'.$row[0].'</option>';
							}
						}
					}
					$output .= '</select></div>';
					$output .= $error . '</div>';
					break;

 				case 'dropdown':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
					} else {
						$enable = '';
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=\"input_select ".$class."" : "class=\"input_select\"" ) . ' type="text" value="' .
					 ( ( $value['value']  != '') ?  stripslashes($value['value']) :  $std ) . '"    autocomplete="off"  /><div class="dropdown_toggle"><span class="icons">&nbsp;</span></div></div>';
					$output .= $error .  '</div>';
					break;
 				case 'email':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
						 $class = 'fixed';
					} else {
						$enable = '';
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="input_box" ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "" ) . ' type="' . $type . '" value="' .
					 ( ($value  != '') ?  stripslashes($value ) :  $std ) . '"  autocomplete="off" /></div>';
					$output .= '<span id="mess_email" class="reg_form_error_message"></span>';
					$output .= $error .  '</div>';
					break;
 				case 'date':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
						 $class = '';
					} else {
						 $enable = '';
						 $class = $class;
					}
					if ( $std == "currentdate" ) {
						$stdval = date("d/m/Y");        
					} 

					else {
						$stdval = $std;
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div  class="input_box" style="position:inherit"  ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "class=\"$class\""  ) . ' type="text"  value="' .
					 ( ( $value  != '') ?  tpo_getdate($value) : $stdval ) . '"  autocomplete="off"  /></div>';
					$output .= $error . '</div>';
					break;
 				case 'datetime':
					if ( $disable == 'Y' ) { 
						 $enable = 'readonly="true"';
					} else {
						$enable = '';
					}
        			$output .= '<div class="field">' ;
					$output .= '<label for="' . $id . '">' .$caption .'</label>';
					$output .= '<div  class="input_box" style="position:inherit"  ><input ' . $enable . ' name="' . $name . '" id="' . $id . '" ' . (($class != "") ? "class=".$class."" : "class=\"input_date\""  ) . ' type="text" value="' .
					 ( ( $value   != '') ?  stripslashes( $value  ) :  $std ) . '" />';
					$output .= $error .  '</div></div>';
					break;
				case "section":
					$i++;
					$output .= '';
					 break;
 				case 'phone':
        			$output .= '<div class="field">' ;
					$output .= '<label style="padding-top:12px;" for="' . $id . '">' .$caption .'</label>';
					$output .= '<div class="phone" ><table border="1" ><tbody><tr><td>
			<div style="width:60px;" ><label for="' .  $id . 'CountryCode">' . __("Country","") . '</label>
									<div class="input_box" ><input autocomplete="off" type="text" id="' .  $id . 'CountryCode" name="' .  $name . 'CountryCode" maxlength="20" value="" /></div></div>
								</td>
                      			<td><div style="width:60px;" ><label for="' .  $id . 'AreaCode">' . __("Area","") . '</label>
									<div class="input_box" ><input autocomplete="off" type="text" id="' .  $id . 'AreaCode" name="' .  $name . 'AreaCode" maxlength="10" value="" /></div></div>
								</td>
                      			<td><div style="width:110px;" >
									<label for="' .  $id . 'Number">' . __("Number","") . '</label><div class="input_box" style="width:110px;"  ><input autocomplete="off" type="text" id="' .  $id . 'Number" name="' .  $name . 'Number" maxlength="20" value="" class="number" /></div></div></td></tr></tbody></table></div>';
					$output .= '</div>';
					break;

				case "section":
					$i++;
					$output .= '';
					 break;
			}
		}
        $output .= '<div class="form-bottom" >';
		$output .= '<div ><label></label>';	
		//$output .= $hooks->apply_filters('add_button', $data->$primarykey  );
		if ( $data->edit  == true ) {
			$output .= '<a href="' . base_url() . $homepath.'/edit" class="btn btn-gray" type="button" name="addnew"   >Add New</a>';
		}
		$output .= '<input class="btn btn-gray" type="submit" name="Submit" value="Save" >';	
		$output .= '<a href="' . base_url() . $homepath.'" class="btn btn-gray" type="button" name="Cancel"   >Cancel</a>';
	
		if ( $data->edit  == true ) {
			$output .= '<input type="hidden" name="'.$primarykey.'" value="' . $data->$primarykey . '">';	
			$output .= '<input type="hidden" name="edit" value="true">';	
		} else {
			$output .= '<input type="hidden" name="edit" value="false">';	
		}
		$output .= '</div>';	
		$output .= '</form>';
 		$output .= '		</div><!-- form End -->';
 		$output .= '	</div> <!-- container End -->';
		$output .= '</div> <!-- Page End -->';
		return $output;
	}
	
	function tpo_form_view($cls, $options, $data , $primarykey, $homepath , $viewname ) {
		global $themename, $shortname, $wpdb, $hooks;
		foreach ( $options as $value) {
			if ( $value['hook'] ) {
				//$value = stripslashes($hooks->apply_filters( $value['hook'] , $value ));
			}
		}
		$i=0;

		$output = '';
		$output .= '<div id="page" >';
		$output .= '	<div class="view_container" >';
		$firstsection = 0; 
		global $wpdb;
			foreach ( $options as $value) {
				if ( $type == 'section' ) {
					if ( $firstsection === 1 ) {
						$output .= '	</tbody></table>';
					}
					if ( $firstsection === 0 ) {
						$firstsection = 1;
					}
						$output .= '	<table class="table_master_view" ><thead><tr><th>' . $caption . '</th><th>&nbsp;</th></tr></thead><tbody>';
				}
				if ( $type == 'text' || $type == 'textarea' || $type == 'autono' ) {
					$output .= '<tr><td class="vcaption" >' . $caption . '</td><td class="vdata bold" >' .  stripslashes( $value ). '</td></tr>';
				}
				if ( $type == 'date' ) {
					$output .= '<tr><td class="vcaption" >' . $caption . '</td><td class="vdata bold" >' .  tpo_getdate(stripslashes( $value ) ). '</td></tr>';
				}
				if ( $type == 'select' ) {
					if (  $value['dsql'] ) {
						$vdata = $wpdb->get_var( str_replace( "{fieldvalue}", stripslashes( $value ) , $value['dsql']  ) );
					} else {
						$vdata = stripslashes( $value );
					}
						$output .= '<tr><td class="vcaption" >' . $caption . '</td><td class="vdata bold" >' .  $vdata.  '</td></tr>';
				}
				if ( $type == 'multidisplay' ) {
					$sql = str_replace( '{fieldvalue}', $data->$primarykey , $value['dsql'] );
					$output .= '<tr><td class="vcaption" >' .$caption .'</td><td class="vdata bold" >';
					$output .=  tpo_table_from_sql( $sql ) ;
					$output .= '</td></tr>';
					break;	
				}
			}
		$output .= '</table>';
		  $output .= '<div class="view_container_bottom" ><a href="' . base_url()  . $homepath .'/edit/' . $data->id . '" class="lightbutton button_lightgray"  >Edit</a><span>&nbsp;&nbsp;&nbsp;</span><a href="' . base_url() .  $homepath .'/export" class="lightbutton button_lightgray"  >Export</a><span>&nbsp;&nbsp;&nbsp;</span><a href="#" class="lightbutton button_lightgray printlisting" rel="#tablecontent"  >Print</a><span>&nbsp;&nbsp;&nbsp;</span><a href="' . base_url()  . $homepath  . '" class="lightbutton button_lightgray"  >Cancel</a></div>';
 		$output .= '	</div> <!-- container End -->';
		$output .= '</div> <!-- Page End -->';
		return $output;
	}
	
}

if ( !function_exists('sea_list_table') ) :

function sea_list_table( $searchfields , $listfields ,$sql, $path, $modulename ) {

	global $hooks;
    $CI	=& get_instance();
	$message = '';
	$output = '';
	$search_term = ( isset ( $_GET['s'] ) ? $_GET['s'] : '' );
	$search_field = ( isset ( $_GET['f'] ) ? $_GET['f'] : '' );

	$page = ( isset ( $_GET['page'] ) ? $_GET['page'] : '' );
	$display = ( isset ( $_GET['display'] ) ? $_GET['display'] : '' );

	if ( $_GET ) {
		if ( $search_term && $search_field ) {
			$message = '<div class="listinginfo"><span >Search term:</span> <span class="basecolor" >' . $search_term . '</span> in <span class="basecolor" >' . $searchfields[$search_field]['caption'] . '</span></div>';
		}
		$fmess = "";
		if ( isset( $_GET['filter'] ) ) {
			foreach ( $searchfields as $fieldkey => $fieldval ) {
				$uri_key = $fieldkey;
				$res_val = '' ;
				if ( isset( $_GET[$uri_key] ) && $_GET[$uri_key] != '' ) {
					if ( $fieldval['listing'] == 'Y' ) {
						if ( $fieldval['fieldtype'] == 'select' ) {
							$joinsql = $listfields[$fieldkey][2];
							$res_val = $CI->db->get_var( str_replace( "{fieldvalue}", $_GET[$uri_key] , $joinsql ) );
						} else {
							$res_val = $_GET[$uri_key];
						}
						if ( $fmess ) {
							$fmess .= ', ' . $fieldval['caption'] . ':&nbsp;<span class="basecolor" >' . $res_val . '</span>';
						} else {
							$fmess .=  $fieldval['caption'] . ':&nbsp;<span class="basecolor" >' . $res_val . '</span>';
						}
					}
				}
			}
		$message = '<div class="listinginfo"><span class="basecolor bold" >Filters:- &nbsp;&nbsp;</span>' . $fmess . '</div>';
		}
	}
	
    echo $message;
    
	/*
	if ( isset ( $_GET ) ) {
		if ( $_GET['para3'] ) {
			$pagedisplay = $_GET['para3'];
		}
	}
	*/
	if ( !$display ) $display = 50 ;

	$pg = new Pagination(  $sql, $path  , $display );

	$sql = $sql . $pg->limit();

	$query = $CI->db->query( $sql );
	$sorturi = "";
	$vars = $_GET;
	foreach ( $vars as $varkey => $varvalue ) {
		if ( $varkey != 'filter' && $varkey != 'fs' && $varkey != 'module' ) {
			if ( $sorturi ) {
				$sorturi .= '&' . $varkey . '=' . $varvalue;
			} else {
				$sorturi .=  $varkey . '=' . $varvalue;
			}
		}
	}
	$cancel_actions = $hooks->apply_filters('listing_before_action', false );
			
			
	$output .= '<div id="table-custom-sort" class="table-listing" data-sort-name="name" data-sort-order="desc">

	  <table class="table table-striped" cellpadding="0" cellspacing="0" border="0" >
      		<thead class="fixedHeader">
				 <tr>
				<th width="1%">&nbsp;</th>';
	foreach ( $listfields as $fieldkey => $fieldvalue ) {
		if ( $sorturi ) {
			$column_sorturi = '&fs=' . $fieldkey  ;
		} else {
			$column_sorturi = 'fs=' . $fieldkey  ;
		}
		$output .= '		<th width="' . $fieldvalue[1] . '"><a href="' . site_url() . $path . '?' . $sorturi . $column_sorturi . '">' . $fieldvalue['caption'] . '</a></th>';
	}
	$output .= '	
					<th width="15%" style="text-align:right" ><a class="tblistmax"  href="#" ><i class="fa fa-expand"></i></a></th>
				</tr>
			</thead>	
			<tbody class="scrollContent">';
	foreach ( $query->result() as $row ) { 
		$column = 1;
		$output .= '	<tr><td></td>';
		foreach ( $listfields as $fieldkey => $fieldvalue ) :
			$joinsql = set_db_prefix( $fieldvalue[2] );
			$list_hook = $fieldvalue[4];
			 if ( $fieldvalue[3] == 'date' ) {
				$output .= '	<td>' .  tpo_getdate( $row->$fieldvalue[0] ) . '</td>';
			 } elseif ( $fieldvalue[3] == 'amount' ) {
				$output .= '	<td>' .  number_format( $row->$fieldvalue[0], 2 ) . '</td>';
			 } elseif ( $fieldvalue[3] == 'view' ) {
				$output .= '	<td>' .  $row->$fieldvalue[0] . '</td>';
			 } elseif ( $fieldvalue[0] == 'docno' ) {
				$output .= '	<td>' .  $row->fulldocno . '</td>';
			 } elseif ( $fieldvalue[3] == 'listlinkimage' ) {
				 
					$output .= '	<td>';
					if ( $list_hook ) {
						$output .=  $hooks->apply_filters($list_hook, $row->id);
					} else {
						$output .=  '<a href="' . site_url() .  str_replace('{id}', $row->id, $joinsql) .'" ><img src="' . site_url() . '\images\admission-icon.jpg" alt="" /></a></td>';
					}
			} else {
				if ( !$joinsql ) {
					$val =  $row->$fieldvalue[0] ;
					$output .= '	<td>' . $val . '</td>';
				} else {
				 	$output .= '	<td>' . $CI->db->get_var( str_replace( "{fieldvalue}",  $row->$fieldvalue[0] , $joinsql ) ) . '</td>';
				}
			}

			$column++;
		endforeach;
		
			if ( !$cancel_actions ) {
            $output .= '<td class="actions" align="center">';
			$output .= $hooks->apply_filters('listing_new_action', $row->id );
			$output .= '			<a href="' . base_url() .  $path . '/edit/?id=' . $row->id . '"  >
						<i class="fa fa-wrench"></i>Edit
				</a>
				<a data-toggle="modal" href="#modal-delete" onclick="modal_delete(' . base_url() . $path . 'delete/?id=' . $row->id . ')" >
						<i class="fa fa-trash"></i>Delete
				</a>
			</td>';
			} else {
				$output .= '<td class="actions" align="center">';
				$output .= $hooks->apply_filters('listing_new_action', $row->id );
				$output .= '</td>';
			}


			$output .= '	</tr>';

	}

$output .= '	</tbody>
	  </table>
	' . $pg->display() . ' 
	</div>';
	
$output .= '<script type="text/javascript">
	function confirm_delete()
	{
		if(confirm("' . __('Do you want to delete this ' . $modulename . ' Master?','seabit_admin') . '") == true)
		{
			return true;
		}else
			return false;
	}
	</script>';
   echo $output ;
}
endif;


if ( !function_exists('sea_list_filter_sql') ) :

function  sea_list_filter_sql ( $searchfields, $tablename, $autonumber , $branchfilter = 0 ) {
	$CI =& get_instance();
	$tablename = $CI->db->dbprefix.$tablename;

	$joinsql = '';
	$wheresql = '';
	$orderfield = '';
	$sort_field = ( isset ( $_GET['fs'] ) ? $_GET['fs'] : '' );
	$search_term = ( isset ( $_GET['s'] ) ? $_GET['s'] : '' );
	$search_field = ( isset ( $_GET['f'] ) ? $_GET['f'] : '' );


	if ( $_GET ) {
		if ( isset ( $searchfields[ $sort_field ] ) ){
			$fieldval = $searchfields[$sort_field];
			if ( $fieldval['sql'] ) {
				$orderfield =  tpo_getjoinfieldname_fromsql ( $fieldval['sql'] )  ;
				$jointable =  $CI->db->dbprefix.tpo_gettablename_fromsql ( $fieldval['sql'] ) ;
				if ( strrpos( $joinsql, " left outer join " . $jointable  ) === false ) {
					$joinsql .= " left outer join " . $jointable . " on $tablename.".$fieldval['field']." = " . $jointable  . ".id ";
				}
			} else {
				$orderfield = $fieldval['field'];
			}
		}
		if ( isset ( $_GET['filter'] ) ) {
			foreach ( $searchfields as $fieldkey => $fieldval ) {
				$uri_key = $fieldkey;
				if ( isset ( $_GET[$uri_key] ) && $_GET[$uri_key] != '' ) {
					if ( $fieldval['listing'] == 'Y' ) {
						if ( $fieldval['fieldtype'] == 'text' ) {
								if ( $wheresql ) {
									$wheresql .= " and $tablename." . $fieldval['field'] . " like '%" . $_GET[$uri_key] ."%'" ;
								} else {
									$wheresql .= "where $tablename." . $fieldval['field'] . " like '%" . $_GET[$uri_key] ."%'" ;	
								}
						} elseif ( $fieldval['fieldtype'] == 'dropdown' ) {
							if ( $fieldval['sql'] ) {
								$jointable = tpo_gettablename_fromsql( $fieldval['sql'] ) ; 
								$joinsql .= " left outer join " . $jointable  . " on $tablename.".$fieldval['field']." = " . $jointable  . ".id ";
								if ( $wheresql ) {
									$wheresql .= " and $jointable.id = '" . $_GET[$uri_key] ."'" ;
								} else {
									$wheresql .= "where $jointable.id = '" . $_GET[$uri_key] ."'" ;	
								}
							} elseif ( $fieldval['options'] ) {
								if ( $wheresql ) {
									$wheresql .= " and $tablename." . $fieldval['field'] . " = '" . $_GET[$uri_key] ."'" ;
								} else {
									$wheresql .= "where $tablename." . $fieldval['field'] . " = '" . $_GET[$uri_key] ."'" ;	
								}
							}
						}
					}
				}
				
			}

			$sql = "select $tablename.* from $tablename $joinsql  " . $wheresql ;
		} else {
			if ( $search_term != '' && $search_field != '' ) {
				$ac_field = str_replace('_', ' ', $search_field);
				$fieldval = $searchfields[$ac_field];
				if ( $fieldval['fieldtype'] == 'select' ) {
					$orderfield =  tpo_getjoinfieldname_fromsql ( $fieldval['sql'] )  ;
					$jointable =  tpo_gettablename_fromsql ( $fieldval['sql'] ) ;
					$joinsql = " left outer join " . $jointable . " on $tablename.".$fieldval['field']." = " . $jointable  . ".id ";
					$wherefield = tpo_getjoinfieldname_fromsql ( $fieldval['field'] ) ;
				} else {
					$wherefield = $fieldval['field'] ;
				}
				$sql = "select $tablename.* from $tablename $joinsql where " . $wherefield . " like '%" . $search_term . "%'  ";
			} else {
				$sql = "select $tablename.* from $tablename $joinsql ";
			}
		}
	} else {
		$sql = "select $tablename.* from $tablename ";
	}
	
	if ( $branchfilter == 1 ) {
		if ( getbranchid() != 'all') {

					if ($tablename == "studentenquiry"){

					$specialsql .= " and `studentenquiry`.studentid =''" ;
				}

			if ( $wheresql ) {
				$sql .= " and $tablename." . "branchid" . " = '" . getbranchid() ."'".$specialsql ;
			} else {
				$sql .= "where $tablename." . "branchid" . " = '" . getbranchid() ."'".$specialsql ;	
			}
			
			//$sql .=  " " . $wheresql ;
			
		}
	}
	if ( $orderfield ) {
		$sql .= ' order by ' . $orderfield;
	} else {
		if ( $tablename == $CI->db->dbprefix.'users' ) {
			$sql .= ' order by userid';
		} else {
			$sql .= ' order by rowid';
		}
	}
	return $sql;
}

endif;


if ( !function_exists('sea_listing_buttons') ) :

function sea_listing_buttons( $path , $modulename, $searchoptions) {
	
	$sort_field = ( isset ( $_GET['fs'] ) ? $_GET['fs'] : '' );
	$search_term = ( isset ( $_GET['s'] ) ? $_GET['s'] : '' );
	$search_field = ( isset ( $_GET['f'] ) ? $_GET['f'] : '' );
    	$output = '<form method="get" ><div class="col-sm-12" ><div id="listinghead" class="row" >
		<div class="col-sm-3">
			<a href="' . site_url() . $path . '/create" class="btn btn-primary"  >Add ' . $modulename .'</a><span>&nbsp;&nbsp;&nbsp;</span>';
	 	$output .= '<div class="btn-group" >
					&nbsp;
			</div>
		</div>';  
		$output .= '<div class="col-sm-9 list-search">
			<div class="input-group">
				<input id="listsearchtext" name="s" type="text" placeholder="Search" class="input-sm ">
				<select name="stype" id="listsearchtype" >
					<option value="1" >Contains</option>
					<option value="2" >Starts With</option>
					<option value="1" >End With</option>
				</select>' . tpo_fieldcombo_from_array ( $searchoptions, strtolower( str_replace('_', ' ', $search_field )) ,"f" , true) . '
				<span class="input-group-btn">
				<button type="submit" class="btn btn-sm btn-primary"> Go!</button> </span></div>
		</div>
   </div></div></form>';	
   return $output ;
}

endif;

if ( !function_exists('sea_listing_filters') ) :

function  sea_listing_filters ( $searchfields, $searchoptions , $path , $modulename  ) {
	$sort_field = ( isset ( $_GET['fs'] ) ? $_GET['fs'] : '' );

	$output = '<div id="listingfilter" class="hide" >';
    $output .= '	<form class="form-horizontal" method="get">';
	$output .= '		<div class="col-sm-12 form-row">
						<div class="col-sm-6">';
				
	foreach ( $searchfields as $fieldkey => $field ) {
		if ( $field['listing'] == 'Y' ) {
			$fieldname =  $fieldkey;
			$fieldvalue = '';
			if ( isset ( $_GET[ $fieldname ] ) ) $fieldvalue = $_GET[ $fieldname ];
			
			if ( $field['fieldtype'] == 'dropdown' ) {
				$sql = $field['sql'];
				if ( $sql ) {
					 $output .= '	<div class="form-group" >';
					 $output .= '		<label class="control-label col-sm-4" >' . $fieldkey . '</label>';
					 $output .= '		<div class="controls col-sm-8">' . tpo_dropdown_sql ($fieldname, $fieldvalue , $sql ) . '</div>' ;
					 $output .= '	</div>';
				} else if ( $field['options'] ) {
					 $output .= '	<div class="form-group" >';
					 $output .= '		<label class="control-label col-sm-4" >' . $fieldkey . '</label>';
					 $output .= '		<div class="controls col-sm-8">' . tpo_combo_from_array ($field['options'], $fieldkey, $field['caption'], true ) . '</div>' ;
					 $output .= '	</div>';
				}
			} elseif ( $field['fieldtype'] == 'text' ) {
					 $output .= '	<div class="form-group" >';
					 $output .= '		<label class="control-label col-sm-4" >' . $fieldkey . '</label>';
					 $output .= '		<div class="controls col-sm-8"><input type="text" class="form-control" name="' . $fieldname . '" value="' . $fieldvalue . '" /></div>';
					 $output .= '	</div>';
			}
		}
	}
	 $output .= '	<div class="form-group" ><label class="control-label col-sm-4" >Sort By</label>';
	 $output .= '		<div class="controls col-sm-8">' . tpo_combo_from_array ( $searchoptions, $sort_field, "fs", true, true) . '</div>' ;
	 $output .= '	</div>';
	 $output .= '<div class="form-group">
	<div class="col-sm-8 col-sm-offset-4">
		<input type="hidden" name="filter" value="true" />
		<button class="btn btn-filter btn-save btn-primary" style="padding:5px 30px;" type="submit" >Filter</button>
	</div>
</div>';
	$output .= '	</div>
				</div>';
	 $output .= '	</form>';
	 $output .= '</div>';
     echo $output;
}

endif;


if ( !function_exists('tpo_combo_from_array') ) :

function tpo_combo_from_array( $results , $sel_val,  $name , $ecoff = false, $noall = false) {
	$class = '';
	if ( $name != 'f' ) $class = "form-control";
		$output = '<select class="' .  $class . '" name="' . $name . '" id="' . $name . '"  >';
		if ( $noall === false ) {
			$output .= "<option value='' selected >All</option>";
		}
			foreach ( $results as $result )
			{
				if( $result != '' ) {
					if( $result == $sel_val ){
						$output .=  '<option class="form-control" value="' . $result . '" selected >'.$result.'</option>';
					}else{
						$output .=  '<option class="form-control" value="' . $result . '" >'.$result.'</option>';
					}
				}
			}
	$output .=  "</select>";
	if ( $ecoff === true ) {
		return $output;
	} else {
		echo $output;
	}
}
endif;


if ( !function_exists('tpo_fieldcombo_from_array') ) :

function tpo_fieldcombo_from_array( $results , $sel_val,  $name , $ecoff = false, $noall = false) {
	$class = '';
	if ( $name != 'f' ) $class = "form-control";
		$output = '<select class="' .  $class . '" name="' . $name . '" id="' . $name . '"  >';
		if ( $noall === false ) {
			$output .= "<option value='' selected >All</option>";
		}
			foreach ( $results as $key => $value )
			{
				if( $key != '' ) {
						$output .=  '<option class="form-control" value="' . $value['field'] . '" >'. $value['caption'] .'</option>';
				}
			}
	$output .=  "</select>";
	if ( $ecoff === true ) {
		return $output;
	} else {
		echo $output;
	}
}
endif;


function tpo_getsqldate($vdate) {
	if ( DATE_FORMAT == 'dd/mm/yyyy' ) {
		$date_a = explode("/", $vdate );
		return $date_a[2] ."-" . $date_a[1] . "-" . $date_a[0];
	}
}

function tpo_getdate($vdate) {
	if ( DATE_FORMAT == 'dd/mm/yyyy' ) {
		if (strpos($vdate,'-') > 0 ) {
			$date_a = explode("-", $vdate );
			return $date_a[2] ."/" . $date_a[1] . "/" . $date_a[0];
		} else {
			return $vdate;
		}
	}
}

function tpo_table_from_sql ( $sql ) {
	global $wpdb;
	$results = $wpdb->get_results( $sql, ARRAY_N );
	if ( $results ) {
		$output = '<table class="table_multi" >';
			foreach( $results as $row ) {
				$output .= '<tr><td>' . stripslashes( $row[0] ) . '</td></tr>';
			}
		$output .=  '</table>';
	}
	return $output;
}
function tpo_gettablename_fromsql ( $sql ) {
	preg_match("/\s+from\s+`?([a-z\d_]+)`?/i", $sql, $tablename);
	return $tablename[1];
}

function tpo_getfirstfieldname_fromsql ( $sql ) {
	preg_match("/select\s+`?([a-z\d_]+)`?/i", $sql, $matches);
	return $matches[1];
}
function tpo_getjoinfieldname_fromsql ( $sql )  {
	preg_match("/\s+from\s+`?([a-z\d_]+)`?/i", $sql, $tablename);
	preg_match("/select\s+`?([a-z\d_]+)`?/i", $sql, $fieldname);
	return $tablename[1] . '.' . $fieldname[1];
	
}

function in_arraymulti($str, $array)
{
    $exists = false;

    if (is_array($array)) {
       foreach ($array as $arr):
           $exists = in_arraymulti($str, $arr);
       endforeach;
    } else {
        if (strpos($array, $str) !== false) $exists = true;
    }

    return $exists;
}

function in_array_ass($needle, $haystack) {
        foreach ( $haystack as $v) {
               if ($needle == $v->menuid)  {
				   echo $v->menuid;
					return true;
				}
        }
        return false;
} 


function tpo_nav_menu()  { 
	$usergroupid = '';
	$CI =& get_instance();
	$CI->load->database();
	
	$userid = get_userid();
	
	$results = $CI->db->query("select * from " . $CI->db->dbprefix . "users where userid='" . $userid . "'")->first_row();
	
	if ( $results ){
		$usergroupid = $results->usergroupid;
	}
	
	$assigned_results = $CI->db->query("select menuid from " . $CI->db->dbprefix . "menu_user_groups where usergroupid = '" . $usergroupid . "'")->result();
	
	$ass_arr = array();
	foreach ($assigned_results as $arow ) {
		array_push( $ass_arr , $arow->menuid );
	}

	$results = $CI->db->query("select * from " . $CI->db->dbprefix . "menu where rowid > 1 order by menuorder ")->result();
	
	$childresults = $results;

	if ( $results ) {
		foreach ( $results as $key => $row ) {
			$row->haschild = false;
		}
	}
	
	if ( $results ) {
		foreach ( $results as $key => $row ) {
			$row->haschild = false;
			if ( in_array( $row->id, $ass_arr ) ) {
				$results[$key]->show = 1;
			} else {
				$results[$key]->show = 0;
			}
		}
		
		foreach ( $results as $row ) {
			foreach ( $childresults as $childrow ) {
				if ( $row->id == $childrow->parentid ) {
					$row->haschild = true;
					break;	
				}
			}
		}
	}
?>
        <ul class="nav navbar-nav">
			<?php tpo_populatemenu($results, '272036AB-B942-2D56-F1C6-5D3216037D0E' ); ?>
        </ul>
	
  <?php
}
function tpo_setparentmenu( &$results, $menuid ) {

	foreach ( $results as $row ) {

	
		if(  $row->id == $menuid ) {
			$row->show = 1;
			if ( $row->parentid ) {
				tpo_setparentmenu( $results,  $row->parentid) ;
				exit();
			}
		}
	}
}

function tpo_populatemenu( &$results, $parent) {
	foreach ( $results as $row ) {
		if ( $parent == $row->parentid ) {
			if ( $row->icon )  {
				$icon = '<i class="fa fa-' . $row->icon . '"></i>';
			} else {
				$icon = '';
			}
			if ( $row->show == 1 ) {
				if ( $row->haschild  ) {
					echo '<li class="parent dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" >' . $icon . $row->name .'</a>';
					echo '<ul class="dropdown-menu"  >';
					tpo_childmenu( $results , $row->id );
					echo '</li></ul>';
				} else {
					echo '<li><a href="' . base_url() . $row->url . '" >' . $icon . $row->name .'</a></li>';
				}
			}
		}
	}
}

function tpo_childmenu( &$results, $parent) {
	foreach ( $results as $row ) {
		if ( $parent == $row->parentid ) {
			if ( $row->icon )  {
				$icon = '<i class="fa fa-' . $row->icon . '"></i>';
			} else {
				$icon = '';
			}
			if ( $row->show == 1 ) {
				if ( $row->haschild  ) {
					echo '<li class="dropdown-submenu" ><a href="#" >' . $icon . $row->name .'</a>';
					echo '<ul class="dropdown-menu" role="menu" >';
					tpo_childmenu( $results , $row->id );
					echo '</li></ul>';
				} else {
					echo '<li><a href="' . base_url() . $row->url . '" >' . $icon . $row->name .'</a></li>';
				}
			}
		}
	}
}

class Pagination {

	private $num_pages = 1;
	private $current_page = 0;
	private $start = 0;
	private $display;
	private $start_display;
	private $num_records;
	private $path;

	private $pagevalues = array(5,10,25,50,100,200,300,400,500);

	function __construct ( $sql, $path, $display = 10 ) {

		$page = ( isset ( $_GET['page'] ) ? $_GET['page'] : 1 );
		$display = ( isset ( $_GET['display'] ) ? $_GET['display'] : 50 );
		
		$this->path = $path;
		
		if ( !empty( $sql ) ) {
			$this->display = $display;

			if ( is_numeric ( $page ) ) {
				$this->current_page = $page ;
			}
			$CI	=& get_instance();
			$query = $CI->db->query($sql);

			$this->num_records = $query->num_rows();
			
			if  ( $this->num_records == 0 ) return false;


			$this->num_pages = ceil ( $this->num_records/$this->display ) ;

			if ( isset( $this->current_page ) && is_numeric( $this->current_page ) && $this->current_page > 0) $this->start = (int) ( $this->current_page - 1 ) * $this->display ;
			$this->start_display = " LIMIT {$this->start}, {$this->display}";
		}
	}

	public function url($a, $b, $c, $d ) {
		return true;
	}

	public function display ( $split=5 ) {
		global $page;
		$CI =& get_instance();
		$html = '';
		$module = $CI->uri->segment(2);

		if ( $this->num_pages <= 1 ) return $html;

		$current_page = ( $this->start/$this->display ) + 1;
		$begin = $this->current_page - $split;

		$end = $this->current_page + $split;

		if ($begin < 1) {
			$begin = 1;
			$end = $split * 2;
		}
		if ( $end > $this->num_pages ) {
			$end = $this->num_pages;
			$begin = $end - ( $split * 2 );
			$begin++; 
			if ( $begin < 1 ) $begin = 1;
		}


		if ( $this->current_page != 1 ) {
			$html .= '<a class="first" title="First" href="' . site_url() . strtolower( $this->path ) .  '/?page=1&display=' . $this->display . '" >&laquo;</a>';
			$html .= '<a class="prev" title="Previous" href="' . site_url() . strtolower( $this->path ) . '/?page=' . ( $current_page - 1 ). '&display=' . $this->display . '" >Previous</a>';
		} else {
			$html .= '<span class="disabled first" title="First">&laquo;</span>';
			$html .= '<span class="disabled prev" title="Previous">Previous</span>';
		}

	for ( $i = $begin; $i<=$end; $i++) {
		if ($i != $this->current_page) {
			$html .= '<a title="' . $i . '" href= "' . site_url() . strtolower( $this->path ) . '/?page=' . $i . '&display=' .  $this->display . '" ' . '" >' . $i . '</a>';
		} else {
			$html .= '<span class="current">' . $i . '</span>';
		}
	}
	if ($this->current_page != $this->num_pages) {
		$html .= '<a class="next" title="Next" href="' . site_url() . strtolower( $this->path ) . '/?page=' . ( $current_page + 1 ) . '&display=' .  $this->display . '" >Next</a>';
		$last = $this->num_pages;
		$html .= '<a class="last" title="Last" href="' . site_url() . strtolower( $this->path ) .  '/' . ( $last ) . '/' .  $this->display . '"  >&raquo;</a>';
	} else {
		$html .= '<span class="disabled next" title="Next">Next</span>';
		$html .= '<span class="disabled last" title="Last">&raquo;</span>';
	}
	$pageselect = '<div class="paginationinfo" ><span>Page&nbsp;</span><select class="paginationselect" >';
	for ( $i=$begin; $i<=$end; $i++) {
		$selectedvalue =  $this->current_page == $i ? "selected=true" : "" ;
		$pageselect .= '<option value="' . site_url() . strtolower( $this->path ) . "/?page=". $current_page . '/' .  $this->display . '" ' . $selectedvalue . ' >' . $i . '</option>';
	}
	$pageselect .= '</select> ';
	$pageselect .= ' of ' . $this->num_pages . ' <span class="paginationlighttext" > (' . $this->num_records .' total items)</span></div>';
	$pageselect .= '<div class="paginationdisplay" >Showing	<select class="pagselect" >';
	foreach ( $this->pagevalues as $pagevalue ) {
		$select_value = $this->display ==  $pagevalue  ? 'selected=true' : '' ;
		$pageselect .= '<option value="' . site_url() . strtolower( $this->path ) .  '/?page=/' . $pagevalue . '" ' . $select_value .' >' . $pagevalue .'</option>';
	}

	$pageselect .= '</select>';
	$pageselect .= '<span class="paginationlighttext" > items per page</span></div>';

	return '<div class="pagination">' . $pageselect . '<div class="pagenumbers" >' . $html . '</div></div>';
	}

	public function limit () {
	return $this->start_display;
	}

}


// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */