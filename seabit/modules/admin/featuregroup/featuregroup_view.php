<?php
	
	require_once( 'featuregroup_custom.php' );
	
	$searchfields = array ( 
		'group_name' => array ( 'caption' => 'Group Name' , 'field'=>'name', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		'description' => array ( 'caption' => 'Description' , 'field'=>'description', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'group_name' => array ( 'caption' => 'Group Name' , 'field_slug'=>'group_name', 'name', '20',  "" , "varchar" , ""  ) ,
		'description' => array ( 'caption' => 'Description' , 'field_slug'=>'description', 'description', '20',  "" , "varchar" , ""  ) ,
		);
	
	$filteroptions = array ('Group Name','Description',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'featuregroup' , 'name' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( 'admin/featuregroup' , 'Feature Group Master' , $filteroptions ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'featuregroup' , 'Feature Group Master' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, 'admin/featuregroup' , 'Feature Group Master'  ); ?>