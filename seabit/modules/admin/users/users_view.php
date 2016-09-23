<?php
	
	require_once( 'users_custom.php' );
	
	$searchfields = array ( 
		'email' => array ( 'caption' => 'Email' , 'field'=>'email', 'fieldtype'=>'email', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'display_name' => array ( 'caption' => 'Display Name' , 'field'=>'name', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'user_type' => array ( 'caption' => 'User Type' , 'field'=>'usergroupid', 'fieldtype'=>'dropdown', 'listing' => '', "sql"=> "select name,id from usergroup order by name" , 'options'=>'' ) ,
		'user_name' => array ( 'caption' => 'User Name' , 'field'=>'username', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'email' => array ( 'caption' => 'Email' , 'field_slug'=>'email', 'email', '15',  "" , "varchar" , ""  ) ,
		'display_name' => array ( 'caption' => 'Display Name' , 'field_slug'=>'display_name', 'name', '30',  "" , "varchar" , ""  ) ,
		'user_type' => array ( 'caption' => 'User Type' , 'field_slug'=>'user_type', 'usergroupid', '15',  "select name from usergroup where id='{fieldvalue}'" , "char" , ""  ) ,
		'user_name' => array ( 'caption' => 'User Name' , 'field_slug'=>'user_name', 'username', '15',  "" , "varchar" , ""  ) ,
		);
	
	$filteroptions = array ('Email','Display Name','User Type','User Name',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'users' , 'email' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( $module_path , 'User Master' , $filteroptions ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'users' , 'User Master' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, $module_path , 'User Master'  ); ?>