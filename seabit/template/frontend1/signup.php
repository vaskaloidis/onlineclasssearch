
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<?php include 'includes.php';?>
        <title><?php _e('Get Started');?> | <?php echo $system_title;?></title>
    </head>
<body>

<div id="header">
    <div class="container">
        <div class="col-md-12">
            <a class="logo" href="<?php echo base_url();?>"><?php echo $system_name; ?></a>             
        </div>
    </div>
</div>
<?php

	$signup = isset ( $page_data['signup'] ) ? $page_data['signup'] : '' ;
	$modal_form = false;
	$button_func = 'data-cancel="users"';

	if ( isset( $modalform ) ) {
		$modal_form = true;
        $button_func = 'data-dismiss="modal"';
	}
	
	$controlClass = 'text'; 

	$email = '';
	$name = '';
	$usergroupid = '';
	$active = '';
	$username = '';
	$password = '';
	$conf_password = '';
	
	if ( isset( $signup ) ) {
		if ( is_array( $signup ) ) {
			extract( $signup );
		}
	}
	
	$signupid = '';
	if ( isset( $_GET['id'] ) ) 
	{
		$signup_url = '/edit/?id=' . $_GET['id'];
	} else {
		$signup_url = '/create/';
	} 
?>
<div id="main-body">
	<div class="container">
      
			<div class="middle" >
                    <!-- Title -->
                     <h2 class="title">Start Free Trial</h2>
                <!-- Login form -->
                <div class="col-md-12">
					<div class="row">
                  <div class="formy well">

					 <p>&nbsp;</p>
					 
						  <h5>Already have an account?<a href="<?php echo base_url() ?>/login">Sign In</a></h5>
	                                      
                                      <hr>
                                  <div class="form">

                                      <!-- Login form (not working)-->
                                      <?php echo form_open('signup' , array('class' => 'form-vertical', 'onsubmit' => 'return check_account_type()'));?>
										<?php sea_textbox( 'Email', 'email', '', $email, 'v' ); ?>
										<?php sea_textbox( 'Display Name', 'name', '1', $name, 'v'  ); ?>

										<?php sea_textbox( 'User Name', 'username', '1', $username, 'v'  ); ?>
										<?php sea_password( 'Password', 'password', '1', $password, 'v' , 'v'  ); ?>
										<?php sea_password( 'Confirm Password', 'conf_password', '1', $conf_password, 'v'  ); ?>
										<p>By clicking Sign Up below, you acknowledge you have 
										read and agree to the <a href="#" >Terms of Service.</a></p>
										<div class="form-group">
                                             <button type="submit" class="btn btn-default">Sign Up</button>
                                             <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
										<div class="clear" ></div>


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