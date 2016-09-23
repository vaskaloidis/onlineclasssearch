<?php
	
	require_once( 'profile_custom.php' );
	
	$searchfields = array ( 
		'first_name' => array ( 'caption' => 'First Name' , 'field'=>'firstname', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'last_name' => array ( 'caption' => 'Last Name' , 'field'=>'lastname', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'date_of_birth' => array ( 'caption' => 'Date Of Birth' , 'field'=>'dob', 'fieldtype'=>'date', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'mobile' => array ( 'caption' => 'Mobile' , 'field'=>'mobile', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'skype' => array ( 'caption' => 'Skype' , 'field'=>'skype', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'first_name' => array ( 'caption' => 'First Name' , 'field_slug'=>'first_name', 'firstname', '20',  "" , "varchar" , ""  ) ,
		'last_name' => array ( 'caption' => 'Last Name' , 'field_slug'=>'last_name', 'lastname', '20',  "" , "varchar" , ""  ) ,
		'date_of_birth' => array ( 'caption' => 'Date Of Birth' , 'field_slug'=>'date_of_birth', 'dob','20',   "" ,  "date", ""   ) ,
		'mobile' => array ( 'caption' => 'Mobile' , 'field_slug'=>'mobile', 'mobile', '20',  "" , "varchar" , ""  ) ,
		'skype' => array ( 'caption' => 'Skype' , 'field_slug'=>'skype', 'skype', '20',  "" , "varchar" , ""  ) ,
		);
	
	$filteroptions = array ('First Name','Last Name','Date Of Birth','Mobile','Skype',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'users' , 'firstname' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( 'profile' , 'Profile' , $filteroptions ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'profile' , 'Profile' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, 'profile' , 'Profile'  ); ?>