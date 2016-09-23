<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<?php	
        $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $list_segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
        $list_url = $list_segments[count($list_segments) - 1 ];
		$listing = $this->db->query("SELECT * from ypusa_ypages_usa where url='$list_url'")->first_row();
		$city = $listing->city ? ', ' . $listing->city : '';
		$state = $listing->state ? ', ' . $listing->state : '';
		$zip = $listing->zip ? ' ' . $listing->zip : '';
		$page_title = $listing->businessname . ' | ' . $listing->address . ' ' . $city  . ' '.  $state  . ' ' . $zip  ;
		$meta_keywords = $listing->categories;
		$meta_description =  $listing->businessname . " " . $city . "; ". $listing->businessname . " , ". $listing->address ."; Get Products, Reviews, Contact, Location, Phone Number, Maps and more for ". $listing->businessname . " on Sidepgaes.com"; ?>
        <title><?php echo $page_title;?></title>
   		<meta name="description" content="<?php echo $meta_description ; ?>" />
        <meta name="robots" content="NOODP,NOYDIR" />
		<?php include 'includes.php';?>
    </head>
<body>
    <?php include 'header.php'; ?>
<div class="container main-content">
	<div class="row"> 



                 <div id="content" class="col-md-8">

				<div class="single">
				<h1 class="name"><?php echo $listing->businessname ?></h1>
                <?php

					$social = false;
					if ( $listing->facebook ) $social = true;
					if ( $listing->twitter ) $social = true;
					
					
                ?>
 
                 <div class="contact">
					<p class="street-address"><?php echo $listing->address ?><?php echo $city ?><?php echo $state ?><?php echo $zip ?></p>
					<p class="phone"><i class="fa fa-phone"></i> &nbsp;<?php echo $listing->phone ?></p></div>
				</div>


				<div class="visit-more">
                <?php if ( $listing->website ) { ?>
				<a href="<?php echo $listing->website ?>"><i class="fa fa-check-square-o"></i> &nbsp; Visit Website</a> &nbsp; &nbsp;&nbsp;
                <?php } ?>
                <?php if ( $listing->email ) { ?>
				<a href="mailto:<?php echo $listing->website ?>"><i class="fa fa-envelope"></i> &nbsp Email Business</a> &nbsp; &nbsp;&nbsp;
                <?php } ?>
				</div>
                
				
				<div class="details">
                    <span class="name">BUSINESS DETAILS</span>
                            <ul class="listing-d">
                            <?php
                                if ( $social ) {
                            ?>
                                <li>
                                    <div class="listing-d-label col-md-3">Social Links:</div>
                                    <div class="listing-d-text col-md-9" >
                                 <?php
                                   if ( $listing->facebook )  echo '<a href="'. $listing->facebook . '">Visit Facebook</a>';
                                   if ( $listing->twitter )  {
                                       if ( $listing->facebook )  echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
                                       echo '<a href="'. $listing->twitter . '">Visit Twitter</a>';
                                   }
                                 ?>
                                   
                                   </div>
                                </li>
                            <?php
                                }
                            ?>
                            <?php if ( $listing->hours ) { ?>
                                <li>
                                    <div class="listing-d-label col-md-3">Hours:</div>
                                    <div class="listing-d-text col-md-9" >
                                    <div class="day-text">Regular Hours</div>
                                    <?php 
                                        $hours = $listing->hours;
                                        $th = explode( ":-:", $hours );
                                        
                                        foreach ( $th as $tth ) {
                                            $tmn = explode( "::", $tth );
                                            echo '<time class="hours" ><span class="day-label">' . $tmn[0] . '</span><span class="day-hours">' . $tmn[1] . '</span></time>'; 
                                        }
                                    ?>
                                    </div>
                                </li>
                           <?php } ?>
                                <?php if ( $listing->about ) { ?>
                                 <li>
                                    <div class="listing-d-label col-md-3">General Info:</div>
                                    <div class="listing-d-text col-md-9" ><?php echo $listing->about; ?></div>
                                </li>
                                <?php } ?>
                                
                                <?php if ( $listing->service ) { ?>
                                <li>
                                    <div class="listing-d-label col-md-3">Services/Products</div>
                                    
                                    <div class="listing-d-text col-md-9" >
                                    <ul>
                                    <?php
                                    $services = explode(',', $listing->service );
                                    
                                    foreach ( $services as $cat ) {
                                        echo '<li>'. str_replace( ',', '', $cat ) . ',</li>';
                                    }
									?>
                                     </ul>
                            		</div>
                                </li>
                               <?php } ?>
                               
                                <?php if ( $listing->payment ) { ?>
                                <li>
                                    <div class="listing-d-label col-md-3">Payment method:</div>
                                    <div class="listing-d-text col-md-9" ><?php echo $listing->payment ?></div>
                                </li>
                                <?php } ?>
                                <?php if ( $listing->categories ) { ?>
                                <li>
                                	<div class="listing-d-label col-md-3">Categories:</div>
                                    
                                    <div class="listing-d-text col-md-9" >
                                    <?php
                                    $categories = explode(',', $listing->categories );
                                    
                                    foreach ( $categories as $cat ) {
                                        echo '<a href="#" >'. $cat . ',</a>';
                                    }
								 ?>
                                	</div>
                                </li>
                                <?php
                                } ?>
                            </ul>
				</div>
			</div>				

                        <div class="col-md-4" >
                        	<img src="<?php echo base_url() ?>images/Plastic-Recycling-Machines_300x250.jpg" />
                        </div>
                
                
                 </div>  <!-- Content End -->

				<div class="clear"></div>
   



		</div>
	</div>
	<?php require_once( 'footer.php' ) ?>
    

</body>
</html>