<?php
	
	require_once( 'emaildata_custom.php' );
	
	$searchfields = array ( 
		'fname' => array ( 'caption' => 'First Name' , 'field'=>'fname', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'lname' => array ( 'caption' => 'Last Name' , 'field'=>'lname', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'email' => array ( 'caption' => 'Email' , 'field'=>'email', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'phone' => array ( 'caption' => 'Phone' , 'field'=>'phone', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'first_name' => array ( 'caption' => 'First Name' , 'field_slug'=>'first_name', 'fname', '10',  "" , "varchar" , ""  ) ,
		'last_name' => array ( 'caption' => 'Last Name' , 'field_slug'=>'last_name', 'lname', '10',  "" , "varchar" , ""  ) ,
		'email' => array ( 'caption' => 'Email' , 'field_slug'=>'email', 'email', '20',  "" , "varchar" , ""  ) ,
		'phone' => array ( 'caption' => 'Phone' , 'field_slug'=>'phone', 'phone', '20',  "" , "varchar" , ""  ) ,
		);
	
	$filteroptions = array ('First Name','Last Name','Email','Phone',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'email' , 'fname' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( 'admin/emaildata' , 'Email Data' , $searchfields ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'emaildata' , 'Email Data' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, 'admin/emaildata' , 'Email Data'  ); ?>