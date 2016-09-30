<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title;?></title>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <html lang="en">
		<?php if ( isset ( $page_metad ) ) { ?>
		<meta name="description" content="<?php  echo $page_metad ?>"/>
		<?php } ?>
		<?php if ( isset ( $page_robots ) ) { ?>
        <meta name="robots" content="<?php echo $page_robots ?>"/>
   		<meta name="robots" content="NOODP,NOYDIR" />
		<?php } ?>       
		<?php include 'includes.php';?>
<!-- Facebook Pixel Code --> <script> !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n; n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '776736035787317'); fbq('track', "PageView");</script> <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=776736035787317&ev=PageView&noscript=1" /></noscript> <!-- End Facebook Pixel Code -->
    </head>
<body>

<?php
	if ( isset ( $_GET ) ) {
		$terms =  isset( $_GET['terms'] )  ?  $_GET['terms'] : '';
		$location =  isset( $_GET['location'] )  ?  $_GET['location'] : '';
	}


?>


	<header id="fixed-header">
        <div class="container">
            <div class="row">
                <!---logo-->
                <div class="col-md-4">
                	<div style="padding:5px 80px 0px 0px;" >
                           <a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url(); ?>images/logo.png" /></a>
                   </div>
                </div>
                <!---  form-search  -->
					<div class="col-md-6">
						<div class="header-search-bar">
                        	<form id="search-form" action="<?php echo base_url(); ?>search/" method="GET">
                            	<input id="terms" type="text"  class="input-search" placeholder="What do you want to find?" autocomplete="off"  name="terms" value="<?php echo $terms ?>" tabindex="1" />
                                <button class="btn-search" type="submit" value="Search" >&nbsp;</button>
                            </form>
                        </div>
					</div>
 
            </div>
        </div> <!-- End container  -->
    </header>
        
<div class="clear"></div>