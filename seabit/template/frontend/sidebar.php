<?php $path =  SITE_URL . 'portfolio/' ?>
<div class="col-md-3">

<?php 
$expanded = 'false';
$class = 'collapse';
if ( isset ( $page_parent ) ) {
	if ( $page_parent == 'logodesign' ) {
		$expanded = 'true';
		$class = 'collapse in';
	}
}
?>
<div class="collapse navbar-collapse navbar-ex1-collapse logo-categories">
	<ul>
    	<li>
        	<img src="<?php echo TEMPLATE_URL; ?>frontend/images/google-ad.jpg" alt="logo">
        </li>    	
    </ul>
</div>
<!-- /.navbar-collapse -->
</div>
