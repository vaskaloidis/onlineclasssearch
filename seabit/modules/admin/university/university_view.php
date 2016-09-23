<?php
	
	require_once( 'university_custom.php' );
	
	$searchfields = array ( 
		'name' => array ( 'caption' => 'Name' , 'field'=>'name', 'fieldtype'=>'text', 'listing' => 'Y', "sql"=> "" , 'options'=>'' ) ,
		'remark' => array ( 'caption' => 'Remark' , 'field'=>'remark', 'fieldtype'=>'textarea', 'listing' => '', "sql"=> "" , 'options'=>'' ) ,
		);
    
	$listfields = array ( 
		'name' => array ( 'caption' => 'Name' , 'field_slug'=>'name', 'name', '50',  "" , "varchar" , ""  ) ,
		'remark' => array ( 'caption' => 'Remark' , 'field_slug'=>'remark', 'remark', '50',  "" , "varchar" , ""  ) ,
		);
	
	$filteroptions = array ('Name','Remark',		); 

	$sql = sea_list_filter_sql ( $searchfields, 'university' , 'name' , 0 ) ;
		
	?>
    
  	<?php echo sea_listing_buttons( 'admin/university' , 'University' , $filteroptions ); ?>
   
   	<?php echo sea_listing_filters( $searchfields, $filteroptions , 'university' , 'University' );  ?>
	
     
	<?php sea_list_table ( $searchfields , $listfields , $sql, 'admin/university' , 'University'  ); ?>