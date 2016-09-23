<?php
	
	require_once( 'page_custom.php' );
	
	$searchfields = array ( 
		'page_name' => array ( 'caption' => 'Page Name' , 'field'=>'name', 'fieldtype'=>'text', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'page_name' => array ( 'caption' => 'Page Name' , 'field_slug'=>'page_name', 'name', '30',  "" , "varchar" , ""  ) ,
		);
	
	$filteroptions = array ('Page Name',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'page' , 'name' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( $module_path , 'Page Creation' , $filteroptions ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'page' , 'Page Creation' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, $module_path , 'Page Creation'  ); ?>