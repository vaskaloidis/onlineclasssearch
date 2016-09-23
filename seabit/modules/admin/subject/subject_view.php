<?php
	
	require_once( 'subject_custom.php' );
	
	$searchfields = array ( 
		'name' => array ( 'caption' => 'Name' , 'field'=>'name', 'fieldtype'=>'text', 'listing' => 'Y', "sql"=> "" , 'options'=>'' ) ,
		'remark' => array ( 'caption' => 'Remark' , 'field'=>'remark', 'fieldtype'=>'textarea', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'name' => array ( 'caption' => 'Name' , 'field_slug'=>'name', 'name', '50',  "" , "varchar" , ""  ) ,
		'remark' => array ( 'caption' => 'Remark' , 'field_slug'=>'remark', 'remark', '50',  "" , "varchar" , ""  ) ,
		);
	
	$filteroptions = array ('Name','Remark',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'subject' , 'name' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( '/subject' , 'Subject' , $filteroptions ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'subject' , 'Subject' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, '/subject' , 'Subject'  ); ?>