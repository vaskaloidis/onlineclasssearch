<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title><?php echo $page_title;?></title>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<?php if ( isset ( $page_metad ) ) { ?>
		<meta name="description" content="<?php  echo $page_metad ?>"/>
		<?php } ?>
		<?php if ( isset ( $page_robots ) ) { ?>
        <meta name="robots" content="<?php echo $page_robots ?>"/>
		<?php } ?>       
		<?php include 'includes.php';?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '776736035787317');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=776736035787317&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
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
                <div id="logo" class="col-md-2">
                    <a href="#">	
                        <img src="<?php echo TEMPLATE_URL; ?>frontend/images/logo.png" alt="logo" width="120px">
                    </a>
                </div>
                <!---  form-search  -->
					<div class="col-md-6">
						<div class="search-bar">
                        	<form id="search-form" action="<?php echo base_url(); ?>search/" method="GET">
                            	<input id="terms" type="text"  class="input-search" placeholder="What do you want to find?" autocomplete="off"  name="terms" value="<?php echo $terms ?>" tabindex="1" />
                                <input id="location" type="text" class="input-location" placeholder="Where?" autocomplete="off"  name="location" value="<?php echo $location ?>" tabindex="2" />
                                <button class="btn-search" type="submit" value="Search" >GO</button>
                            </form>
                        </div>
					</div>
                    
                    
                <!---menu-->
                <div id="main-menu" class="col-md-4">
                     <div class="mobile-nav">
                    
                                    <ul class="nav-right right">
										<li class="">
                                                <a class="call-to-action " data-width="700" data-height="235" href="/missing-business">
                                                    <span class="fa fa-plus icontruelocal-add-circle-1"></span>
                                                    <span>Add business</span>
                                                </a>
                                            </li>
                                            <li class="left last">
                                    
                                                <div class="login font-colour-white uppercase login-button">
                                                    <span class="fa fa-signin show-mobile"></span>
                                                    <span>Log In</span><span class="nav-with-signup"> / Sign Up</span>
                                                    <span class="fa fa-arrow-down no-mobile"></span>
                                                </div>
                                            
                                            </li>
                                
                            
                                    </ul>
                    
                                </div>
                 </div> <!-- End main-menu  -->
                <!---responsive menu--> 

            </div>
        </div> <!-- End container  -->
    </header>
        
<div class="clear"></div>