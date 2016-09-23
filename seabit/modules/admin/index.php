<?php
$show_modalform = false;
if ( isset ( $modalform ) ) {
	if ( $modalform ==  true ) {
		$show_modalform = true;
	}
}

if ( $show_modalform !== true ) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<?php include 'includes.php';?>
        <title><?php echo $page_title;?> | <?php echo $system_title;?></title>
    </head>
<body>
    <?php include 'header.php';?>
	<div id="main-body">
		<?php include 'page_info.php';?>
               
        <div id="main-wrapper"> 
          	<div class="col-md-2" >
 				<?php include 'sidebar.php';?>
			</div>
            <div class="col-md-10" >	
                <div class="appwrapper">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <?php echo  $this->breadcrumbs->show(); ?>
                    </ul>
                    <!--breadcrumbs end -->
					<div class="panel panel-default  <?php echo $layout; ?>">
							<?php include ROOTPATH . 'seabit/modules/' . $page_name.'.php'; ?>
					</div>
				</div>
            </div>
	   	</div>
    </div>
	<div class="clear" ></div>
	<?php require_once( 'footer.php' ) ?>
    <?php require_once( 'modal_hidden.php' ) ?>
    

</body>
</html>
    <?php } else { ?>
			<div class="modal-frame <?php echo $layout; ?>" >
				<div class="wrapper">
					<?php include ROOTPATH . 'seabit/modules/' . $page_name.'.php'; ?>
				</div>
			</div>
	<?php } ?>