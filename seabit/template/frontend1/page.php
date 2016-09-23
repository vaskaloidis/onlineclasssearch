<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<?php include 'includes.php';?>
        <title><?php echo $page_title;?></title>
    </head>
<body>
    <?php include 'header.php'; ?>
<div class="container">
	<div class="row"> 
		<div class="content-wrapper">	 
			 <?php include 'sidebar.php'; ?>
			
			 <div class="content col-md-8">
				<div class="page">
					 <?php
						if ( isset( $page_name ) ) {
							$CI =& get_instance();
							$page = $CI->db->get_where('page', array( 'url' => $page_name ) )->first_row();
							echo '<h2 class="page-title">' . $page->name . '</h2>';
							echo '<p>' . $page->content . '</p>';


						}
					?>
				</div>
			</div>

		</div>
	</div>
</div>
	<?php require_once( 'footer.php' ) ?>
    

</body>
</html>