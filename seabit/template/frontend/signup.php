 <?php extract ( $page_data ) ?>
    <?php include 'header.php'; ?>

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
                <!-- Login form -->
                <div class="col-md-12">
					<div class="row">
                  <div class="formy well">
                     <h2 class="title text-center " style="margin-bottom:30px;">Add Your Business</h2>
                     
                     
                <div class="progress-container">
		
		<div id="progress-steps" class="clear" style="width: 423px;">
		
				<div class="left step profile current ">
					<div class="left progress">
							<span>1</span>
					</div>
					<div class="left">
						<h3 class="no-margin">Sign up</h3>
					</div>
				</div>
				<div class="left step business ">
					<div class="left progress">
							<span>2</span>
					</div>
					<div class="left">
						<h3 class="no-margin">Business details</h3>
					</div>
				</div>
		
			<div class="left step">
				<h3 class="no-margin">Done!</h3>
			</div>
		
		</div>
	
	</div>
    	<div class="text-center" >
            <p style="padding-bottom:0" >You need to be a member of Side Pages to add or manage a business.</p>
			<h5>Already a member?<a class="btn btn-loginow" href="<?php echo base_url() ?>/login" >LOG IN NOW</a></h5>
		</div>
        
        
	                                      
                                      <hr>
                                  <div class="form-container form-registration">

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
                                             <button type="submit" class="btn btn-xlarge ">SIGN UP</button>
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