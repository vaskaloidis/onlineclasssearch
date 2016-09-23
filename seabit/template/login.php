
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<?php include 'admin/includes.php';?>
        <title><?php _e('login');?></title>
    </head>
<body>
<?php
$redirect = '';
if ( $_GET ) {
	if ( isset ( $_GET['redirect'] ) ) {
		$redirect = $_GET['redirect'];
	}
}
?>
<div id="header"  style="background:#000;padding:20px 0;" >
    <div class="container">
        <div class="col-md-12">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo TEMPLATE_URL; ?>frontend/images/logo.png"></a>          
        </div>
    </div>
</div>

<div id="main-body" style="padding-top:130px;" >
	<div class="container">
        <div class="row">
			<div class="middle" >
                <!-- Login form -->
                <div class="col-md-12">
                  <div class="formy well">
                    <!-- Title -->
                     <h4 class="title">Login to Your Account</h4>
					 <p>&nbsp;</p>
                                  <div class="form">

                                      <!-- Login form (not working)-->
                                      <?php echo form_open('login' , array('class' => 'form-horizontal', 'onsubmit' => 'return check_account_type()'));?>
                                         <div class="form-group">
                                           <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
                                           <div class="col-lg-8">
                                        		<input name="username" type="text" class="form-control" placeholder="<?php _e('username'); ?>" autocomplete="off" value="" >
                                           </div>
                                         </div>
                                         <div class="form-group">
                                           <label for="inputPassword1" class="col-lg-2 control-label">Password</label>
                                           <div class="col-lg-8">
                                        		<input name="password" type="password" class="form-control" placeholder="<?php _e('password'); ?>" autocomplete="off" value="" >
                                           </div>
                                         </div>
                                         <div class="form-group">
                                           <div class="col-lg-offset-2 col-lg-8">
                                             <div class="checkbox">
                                               <label>
                                                 <input type="checkbox"> Remember me
                                               </label>
                                             </div>
                                           </div>
                                         </div>
                                         <div class="form-group">
                                           <div class="col-lg-offset-2 col-lg-10">
											 <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                                             <button type="submit" class="btn btn-default">Sign in</button>
                                             <button type="reset" class="btn btn-default">Reset</button>
                                           </div>
                                         </div>
                                       </form>
                                      
                                      <hr>

                                      <h5>New Account</h5>
                                      <!-- Register link -->
                                             Don't have an Account? <a href="<?php echo base_url() ?>signup">Sign Up</a>
                                    </div> 
                                  </div>
					</div>
                </div>
    	</div>
  	</div>
</div>
	<?php require_once( 'frontend/footer.php' ) ?>
</body>

</html>