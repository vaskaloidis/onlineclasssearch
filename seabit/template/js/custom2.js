// JavaScript Document

$(document).on('click','.menuitem', function(event) {
    event.preventDefault();
    var target = "#" + this.getAttribute('data-target');
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 2000);
});

   

$(this).click(function() {
	$("#main-menu li").removeClass("active");
	$(this).addClass('active');
     $('html, body').animate({scrollTop: targetOffset}, 1000);
     return true;
});

/* +++++++++++++++   fixed header +++++++++++++++++*/

$(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('#fixed-header').addClass("fixed");
    }
    else{
        $('#fixed-header').removeClass("fixed");
    }
});

/*+++++++++++++++++   for slider  +++++++++++++++++++++*/

$(window).load( function() {
		$(document).smoothSlides({
		duration: 5000
		});
		
	});




