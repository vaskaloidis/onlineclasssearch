<?php
	
	require_once( 'course_custom.php' );
	
	$searchfields = array ( 
		'code' => array ( 'caption' => 'Code' , 'field'=>'code', 'fieldtype'=>'text', 'listing' => 'Y', "sql"=> "" , 'options'=>'' ) ,
		'name' => array ( 'caption' => 'Name' , 'field'=>'name', 'fieldtype'=>'text', 'listing' => 'Y', "sql"=> "" , 'options'=>'' ) ,
		'university' => array ( 'caption' => 'University' , 'field'=>'uni_id', 'fieldtype'=>'dropdown', 'listing' => '', "sql"=> "select name,id from university order by name" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'code' => array ( 'caption' => 'Code' , 'field_slug'=>'code', 'code', '50',  "" , "varchar" , ""  ) ,
		'name' => array ( 'caption' => 'Name' , 'field_slug'=>'name', 'name', '50',  "" , "varchar" , ""  ) ,
		'university' => array ( 'caption' => 'University' , 'field_slug'=>'university', 'uni_id', '50',  "select name from university where id='{fieldvalue}'" , "char" , ""  ) ,
		);
	
	$filteroptions = array ('Code','Name','University',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'course' , 'code' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( 'admin/course' , 'Course' , $filteroptions ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'course' , 'Course' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, 'admin/course' , 'Course'  ); ?>