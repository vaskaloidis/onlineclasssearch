<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	$controlClass = 'span6'; 

	$usersid = '';
	if ( isset( $_GET['id'] ) ) 
	{
		$users_url = '/edit/?id=' . $_GET['id'];
	} else {
		$users_url = '/create/';
	} 
	?>
	<?php echo form_open('users'.$users_url , array(  'class' => 'form-horizontal validatable','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
		<div class="control-group">
			<label class="control-label required" for="username">User Name</label>
			<div class="controls">
				<input class="<?php echo $controlClass; ?>" type="text" id="username" name="username" value="<?php echo set_value('username', isset( $users ) ? $users->username : '' ) ?>" />
				<span class="help-inline"><?php echo form_error('username'); ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="email">Email</label>
			<div class="controls">
				<input class="<?php echo $controlClass; ?>" type="text" id="email" name="email" value="<?php echo set_value('email', isset( $users ) ? $users->email : '' ) ?>" />
				<span class="help-inline"><?php echo form_error('email'); ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="name">Display Name</label>
			<div class="controls">
				<input class="<?php echo $controlClass; ?>" type="text" id="name" name="name" value="<?php echo set_value('name', isset( $users ) ? $users->name : '' ) ?>" />
				<span class="help-inline"><?php echo form_error('name'); ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="password">Password</label>
			<div class="controls">
				<input class="<?php echo $controlClass; ?>" type="password" id="password" name="password" value="" />
				<span class="help-inline"><?php echo form_error('password'); ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="pass_confirm">Confirm Password</label>
			<div class="controls">
				<input class="<?php echo $controlClass; ?>" type="password" id="pass_confirm" name="pass_confirm" value="" />
				<span class="help-inline"><?php echo form_error('pass_confirm'); ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="role">User Role</label>
			<div class="controls">
				<?php $options = array('Admin','Manager','Executive','Designer') ; ?>
				<?php sea_form_selectoption("role", $options ,  set_value("role", isset( $users ) ? $users->role : "0" )  ) ?>
				<span class="help-inline"><?php echo form_error('role'); ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="active">Active/Deactive</label>
			<div class="controls">
				<?php $options = array('Y','N') ; ?>
				<?php sea_form_selectoption("active", $options ,  set_value("active", isset( $users ) ? $users->active : "0" )  ) ?>
				<span class="help-inline"><?php echo form_error('active'); ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">&nbsp;</label>
			<div class="controls">
            <?php if ( isset( $_GET['id'] ) ) { ?>
            	<input type="hidden" name="edit" value="1">
				<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
				<input type="submit" name="save" class="btn btn-primary" value="Edit">
			<?php } else { ?>
           		<input type="hidden" name="edit" value="0">
				<input type="submit" name="save" class="btn btn-primary" value="Save">			
			<?php } ?>
			<input type="button" name="cancel" class="btn btn-primary" onclick="location.href = '<?php echo base_url() . 'users/' ?>';" value="Cancel">
		</div>
	</form> 