<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php extract ( $page_data ) ?>
<html>
    <head>
        <title><?php echo $page_data['page_title']; ?></title>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="robots" content="nofollow,noindex"/>
        
		<?php include 'includes.php';?>

    </head>
<body>
    <?php include 'header.php'; ?>
<?php

	$redirect = '';
	$controlClass = 'text'; 

	$email = '';
	$username = '';
	$password = '';
	
if ( $_GET ) {
	if ( isset ( $_GET['redirect'] ) ) {
		$redirect = $_GET['redirect'];
	}
}
?>

<div id="main-body" >
	<div class="container">
        <div class="row">
			<div class="middle" >
                <div class="col-md-12">
                  <div class="formy well resetpassword">
   
                                      <hr>
               		<div class="form-container form-registration">
                    <?php if ( $page_status != 'success' ) { ?>
                    <!-- Title -->
                    	 <h2 class="title text-center">Reset your password</h2>

						 <h5>We'll send you an email with further instructions on how to reset your password.</h5>

                                      <!-- Login form (not working)-->
                                      <?php echo form_open('resetpassword/validate' , array('class' => 'form-horizontal', 'onsubmit' => 'return check_account_type()'));?>
                                      
                                        <div class="form-group has-error">
                                            <div class="controls">
                                            <input class="form-control" type="text" id="email" name="email" placeholder="Enter E-mail" value="">
                                             <span class="help-block m-b-zero"><?php echo form_error( 'email' ) ?></span>
                                        	</div>
                                        </div>

                                    	<div class="form-group">
                                            <input type="hidden" name="redirect" value="<?php $redirect; ?>" />
                                         	<button type="submit" class="btn btn-xlarge ">SUBMIT</button>
                                      	</div>
                                   		<div class="clear" ></div>
                                      
                                        <div class="text-center" >
                                            <p style="padding-bottom:0" >You need to be a member of Side Pages to add or manage a business.</p>
                                            <h5>Not a member?<a class="btn btn-loginow" href="<?php echo base_url() ?>signup/" >SIGN UP</a></h5>
                                        </div>
                                        

                                       </form>
                 <?php } else { ?>
                    	 <h2 class="title text-center">Email sent</h2>

						 <h5>Please follow the instructions in the email to reset your password.</h5>        

                        <div class="form-group">
                            <a href="<?php echo base_url() ?>login" class="btn btn-xlarge ">OK</a>
                        </div>
                        <div class="clear" ></div>
                                        
                 <?php } ?>                     
                                    </div> 
                   			</div>
					</div>
                </div>
    	</div>
  	</div>
</div>
	<?php require_once( 'footer.php' ) ?>
</body>

</html>