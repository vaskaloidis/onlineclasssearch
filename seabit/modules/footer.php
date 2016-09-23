   <?php $system_title = 'Online Course Search'; ?>
    <div class="footer" >

<script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-75594440-1', 'auto'); ga('send', 'pageview'); </script>

	<div class="footer-wrapper">
	<div class="container">
		<div class="footer-logo col-md-2"><img src="<?php echo base_url(); ?>images/logo.png" /></div>
			<div class="footer-menu col-md-4">
			<nav class="navbar navbar-default">
				<ul class="nav navbar-nav">

				</ul>
			</nav>
			</div>
		<!-- <div class="footer-icons col-md-4">
			<span class="socialicons"><i class="fa fa-google-plus"></i></span>
			<span class="socialicons"><i class="fa fa-facebook-square"></i></span>
			<span class="socialicons"><i class="fa fa-linkedin"></i></span>
			<span class="socialicons"><i class="fa fa-twitter"></i></span>
		</div> -->
		<div class="footer-icons col-md-4">
			<span class="socialicons"><img src="<?php echo base_url(); ?>images/google-plus.png" /></span>
			<span class="socialicons"><img src="<?php echo base_url(); ?>images/-facebook-square.png" /></span>
			<span class="socialicons"><img src="<?php echo base_url(); ?>images/linkedin.png" /></span>
			<span class="socialicons"><img src="<?php echo base_url(); ?>images/twitter.png" /></i></span>
		</div>

		<div class="footer-login col-md-2">	</div>
	</div>

       <center>
        	&copy; <?php echo date('Y'); ?>,  <?php echo $system_title ?></a>
        </center>

	</div>

    </div>
<script>

$(document).ready(function(){

	//var path = 'http://www.onlineclasssearch.com/';
	var path = '<?php echo base_url(); ?>';
  
	var options = {
	
	 // url: "http://www.onlineclasssearch.com/locations/autosuggest/?v=",
		url: "<?php echo base_url(); ?>/locations/autosuggest/?v=",
	  
	  getValue: "name",
	
	  list: {	
		match: {
		  enabled: true
		}
	  },
	
	  theme: "square"
	};
	
	$("#terms").easyAutocomplete(options);

			 
	$("[data-toggle=tooltip]").tooltip({placement: 'auto'});

	$('.date-picker').datepicker({
		format: 'dd/mm/yyyy',
		multidateSeparator: "/"
	});
	
	$('.form-control').focus(function() {
		$(this).parent().find('.help-block').text('');
	});
	
	$('.btn-cancel').on( "click" , function(e) {
		var href = $( this ).data( 'cancel' );
		window.location.href = path + href;
	});
	
	$('.menugroup').on( "click" , function(e) {
		e.preventDefault();
		return false;
	});
	
	$('.tblistfilter').click(function(e){
		$("#listingfilter").toggleClass("hide");
		e.preventDefault();
		return false;
	});

	$('.tblistmax').click( function(e) {
		if ( $( this ).hasClass('expanded') ) {
			$( this ).children().first().addClass('fa-expand');
			$( this ).children().first().removeClass('fa-compress');
			$( this ).removeClass('expanded');
			$('#main-wrapper').removeClass('expanded');
		} else {
			$( this ).children().first().removeClass('fa-expand');
			$( this ).children().first().addClass('fa-compress');
			$( this ).addClass('expanded');
			$('#main-wrapper').addClass('expanded');
		}
	});
	
	$('.dropdown-menu').hover(
		  function() {
			$( this ).parent().addClass( "open" );
		  }, function() {
			$( this ).parent().removeClass( "open" );
		  }
	);

	$('.chosen').chosen();
	$('.date').datepicker();
	
});


$(document).ready(function(){

});
</script>