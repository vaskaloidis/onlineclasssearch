<?php $path =  SITE_URL . 'portfolio/' ?>
<div class="sidebar col-md-4">

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
<div class="game">
	<ul>
		<li>
			<a href="#"><img src="<?php echo TEMPLATE_URL; ?>frontend/images/game1.png" alt="game"></a>
		</li>

		<li>
			<a href="#"><img src="<?php echo TEMPLATE_URL; ?>frontend/images/game2.png" alt="game"></a>
		</li>
		<li>
			<a href="#"><img src="<?php echo TEMPLATE_URL; ?>frontend/images/game3.png" alt="game"></a>
		</li>
		<li>
		<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.3420719115775!2d88.35781200000001!3d22.566305999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277a986dbf91d%3A0x411c6506d793d89b!2sSeabit+Media!5e0!3m2!1sen!2sin!4v1432288666304" width="800%" height="200" frameborder="0" style="border:0"></iframe></div>
		</li>
	</ul>
</div>
<!-- /.navbar-collapse -->
</div>
