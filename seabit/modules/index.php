
<?php if (  $page_name == 'home/home_view' ) { ?>

    <?php include 'header-home.php'; ?>
 	<div class="home-bg">
        <div class="container home-content">
            <div class="row"> 
            <?php include ROOTPATH . 'seabit/modules/' . $page_name.'.php'; ?>
            </div>
        </div>
    </div>
	<?php require_once( 'footer.php' ) ?>
    
    
<?php } else { ?>


    <?php include 'header.php'; ?>
<div class="container main-content">
	<div class="row"> 
		 <?php
			if ( !isset( $page_name ) ) {
				$page_name = 'homepage';
			}
		?>
		<?php include ROOTPATH . 'seabit/modules/' . $page_name.'.php'; ?>
		</div>
	</div>
	<?php require_once( 'footer.php' ) ?>
<?php } ?>


</body>
</html>