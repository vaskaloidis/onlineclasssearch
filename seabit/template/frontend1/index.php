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
    <?php // include 'header.php'; ?>
<div class="container"  style="min-height:380px;" >
	<div class="row"> 
		 <?php //include 'sidebar.php'; ?>
		 <?php
			if ( !isset( $page_name ) ) {
				$page_name = 'login';
			}
		?>
		<?php include ROOTPATH . 'seabit/modules/' . $page_name.'.php'; ?>
		</div>
	</div>
	<?php // require_once( 'footer.php' ) ?>
    

</body>
</html>