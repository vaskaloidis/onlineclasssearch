<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "/home/index";
$route['404_override'] = 'four_zero_four';


//Gather the DB connection settings
include_once APPPATH.'config/database.php'; 


$conn = @mysql_connect($db[$active_group]['hostname'], $db[$active_group]['username'], $db[$active_group]['password'], true  );

// Check connection

$sel_db = @mysql_select_db( $db[$active_group]['database'] , $conn );

if( $result = mysql_query( "SELECT * FROM " . $db[$active_group]['dbprefix'] . "page" ));
{  
	while($row = mysql_fetch_assoc($result))
	{
		$route[ $row['url'] ]   = "page";
	}

}



$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$list_segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
$list_url = $list_segments[count($list_segments) - 1 ];


$bid = '';
if ( isset ( $_GET['bid'] ) ) {
	$bid = $_GET['bid'];

	if( $result = mysqli_query( "SELECT * FROM " . $db[$active_group]['dbprefix'] . "ypages_usa where rowid=$bid " ));
	{  
		$row = mysql_fetch_assoc($result);
		$route[ $row['url'] ]   = "page";
		
	}


}

/*


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

if( $result = mysql_query( "SELECT * FROM " . $db[$active_group]['dbprefix'] . "ypages_usa" ));
{  
	while($row = mysql_fetch_assoc($result))
	{
		echo $row['businessname'];
		$url =  toAscii( $row['businessname'] ) . "-" .  $row['rowid'];
		echo '   '. $url;
		echo  '<br>';
	 	echo  " update " . $db[$active_group]['dbprefix'] . "ypages_usa set url ='$url' where rowid = " . $row['rowid'];
	 	$sql = " update " . $db[$active_group]['dbprefix'] . "ypages_usa set url ='$url' where rowid = " . $row['rowid'];
	 	mysql_query($sql) or die(mysql_error());
	}

}

*/

mysql_close($conn);


/* End of file routes.php */
/* Location: ./application/config/routes.php */