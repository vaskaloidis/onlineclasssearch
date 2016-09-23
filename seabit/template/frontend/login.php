<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                <!-- Login form -->
                <div class="col-md-12">
                  <div class="formy well">
                    <!-- Title -->
                     <h2 class="title text-center">Login to Your Account</h2>

        
        
	                                      
                                      <hr>
                                   <div class="form-container form-registration">

                                      <!-- Login form (not working)-->
                                      <?php echo form_open('login' , array('class' => 'form-horizontal', 'onsubmit' => 'return check_account_type()'));?>
                                      <?php sea_textbox( 'Email', 'email', '', $email, 'v' ); ?>
                                      <?php sea_password( 'Password', 'password', '1', $password, 'v' , 'v'  ); ?>

                                    	<div class="form-group">
                                         	<button type="submit" class="btn btn-xlarge ">LOG IN</button>
                                           <div class="forgot-password-wrapper">
                                                <a href="<?php echo base_url() ?>forgotpassword" class="forgot-password">Forgot your password?</a>
                                           </div>
                                      	</div>
                                   		<div class="clear" ></div>

                                      
   
                                        
                                        
                                        <div class="text-center" >
                                            <p style="padding-bottom:0" >You need to be a member of Side Pages to add or manage a business.</p>
                                            <h5>Not a member?<a class="btn btn-loginow" href="<?php echo base_url() ?>signup/" >SIGN UP</a></h5>
                                        </div>
                                        

                                       </form>
                                      
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