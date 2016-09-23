<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	
	$modal_form = false;
	$button_func = 'data-cancel=' . $module_path;

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


	if ( isset( $users ) ) {
		extract( $users );
	}
	
	$usersid = '';
	if ( isset( $_GET['id'] ) ) 
	{
		$users_url = 'edit/?id=' . $_GET['id'];
	} else {
		$users_url = 'create/';
	} 
	?>
    	<?php sea_panel_heading("Edit Your Profile"); ?>
		
        <div class="panel-body" >
			<?php echo form_open($module_path.$users_url , array( 'class' => 'form-horizontal sform','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
				<div class="col-sm-12 form-row"><div class="row" >

				<div class="col-sm-6">

					<?php sea_textbox( 'Email', 'email', '', $email ); ?>
					<?php sea_textbox( 'Display Name', 'name', '1', $name ); ?>
					<?php sea_dropdown_sql('User Type', 'usergroupid', true, 'select name,id from usergroup order by name' , '' , $usergroupid ); ?>
									<?php sea_dropdown('Active/Deactive', 'active', true, array('Y','N') , $active ); ?>
								</div>
				<div class="col-sm-6">

					<?php sea_textbox( 'User Name', 'username', '1', $username ); ?>
					<?php sea_password( 'Password', 'password', '1', $password ); ?>
					<?php sea_password( 'Confirm Password', 'conf_password', '1', $conf_password ); ?>
				</div>
				</div></div>
		<div class="col-sm-12">
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
						<button class="btn-cancel btn btn-white" type="button" <?php echo $button_func ?> >Cancel</button>
						<?php if ( isset( $_GET['id'] ) ) { ?>
							<input type="hidden" name="edit" value="1">
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
							<input type="submit" name="savenew" class="btn-save btn btn-primary" value="Save & New">
							<input type="submit" name="save" class="btn-save btn btn-primary" value="Save & Close">
						<?php } else { ?>
							<input type="hidden" name="edit" value="0">
							<input type="submit" name="savenew" class="btn-save btn btn-primary" value="Save & New">
							<input type="submit" name="save" class="btn-save btn btn-primary" value="Save & Close">
						<?php } ?>
						<?php if ( $modal_form == true ) { ?>
							<input type="hidden" name="modal" value="1">
						<?php } ?>
						</div>
					</div>
				</div>
				<div class="clearfix" ></div>
			</form> 