
$(document).ready(function(){

	var path = 'http://localhost/client/onlineclasssearch/';
	
  
	var options = {
	
	  url: "http://localhost/client/onlineclasssearch/locations/autosuggest/?v=",


	  
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

});


$(document).ready(function(){
	$('.chosen').chosen();
	$('.date').datepicker();
});