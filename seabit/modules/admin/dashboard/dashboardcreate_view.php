<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>
$(document).ready(function() {

			$(".sform").on( "submit", function(e) {
				//var box = new ajaxLoader('body',  {bgColor: '#000'} );
				var sform = $(this);
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
				$('.btn-save').addClass('btn-loading');
				$('.btn-save').attr('disabled', 'disabled');
				$.ajax(
				{
					url : formURL,
					type: "POST",
					data : postData,
					success:function(data, textStatus, jqXHR) 
					{
						if ( data.trim() !== '') {
							result = $.parseJSON( data.trim() );
							if ( result.status == "success" ) {

								$('.alert').show();
								$('.btn-save').removeClass('btn-loading');
								$('.btn-save').removeAttr('disabled');
								setTimeout( "$('.alert-save').fadeOut( 'slow');", 1000);

							} else if ( result.status == "errors" ) {
								errors = result.data;
								errors = result.data;
								$.each(errors, function ( key, val ) {
									if ( val ) {
										sform.find('#'+key).next().html(val);
										sform.find('#'+key).parent().addClass('error');
									}
								});
								$('.btn-save').removeClass('btn-loading');
								$('.btn-save').removeAttr('disabled');
							} else {
								alert('Problem with connection');
							}						
						}
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						//if fails    
						alert(textStatus);  
					}
				});
				e.preventDefault(); //STOP default action
				e.unbind(); //unbind. to stop multiple form submit.
			});
				
});

</script>

<?php

	$modal_form = false;
	$button_func = 'data-cancel="profile"';

	if ( isset( $modalform ) ) {
		$modal_form = true;
        $button_func = 'data-dismiss="modal"';
	}
	
	$controlClass = 'text'; 

	$firstname = '';
	$lastname = '';
	$dob = '';
	$phone = '';
	$mobile = '';
	$skype = '';
	$address = '';
	$city = '';
	$state = '';
	$zipcode = '';
	$country = '';
	$website = '';
	$about = '';


	if ( isset( $profile ) ) {
		extract( $profile );
	}
	
	$profileid = '';
	if ( isset( $_GET['id'] ) ) 
	{
		$profile_url = '/edit/';
	} else {
		$profile_url = '/create/';
	} 
	?>
    	<?php sea_panel_heading('Edit Your Profile'); ?>

        <div class="panel-body">

			<?php echo form_open_multipart('members/profile' , array( 'class' => 'form-horizontal sform','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
				<div class="col-sm-6">

					<div class="form-group">
						<label class="control-label  col-sm-4 required" >Name&nbsp;<span class="mandatory">*</span></label>
						<div class="controls col-sm-8">
							<div class="row" >

							<?php sea_group_textbox( 'First Name', 'firstname', '1', 'col-md-6' ,  $firstname ); ?>
							<?php sea_group_textbox( 'Last Name', 'lastname', '1', 'col-md-6' ,  $lastname ); ?>
											</div>
						</div>
					</div>

					<?php sea_textbox_date( 'Date Of Birth', 'dob', '', $dob ); ?>
					<?php sea_textbox( 'Business Phone', 'phone', '', $phone ); ?>
					<?php sea_textbox( 'Mobile', 'mobile', '', $mobile ); ?>
					<?php sea_textbox( 'Skype', 'skype', '', $skype ); ?>
					<?php sea_section_heading( 'Mailing Address' ); ?>
					<?php sea_textbox( 'Street Address', 'address', '', $address ); ?>
					<?php sea_textbox( 'City / Town', 'city', '', $city ); ?>
					<?php sea_textbox( 'State / Region', 'state', '', $state ); ?>
					<?php sea_textbox( 'Postal / Zip Code', 'zipcode', '', $zipcode ); ?>
					<?php sea_country_dropdown('Country', 'country', true,  $country ); ?>


					<?php sea_section_heading( 'Additional Information' ); ?>

					<?php 
					$file_exists_class = 'fileinput-new';
					$file_value = '';
					$file_url = '';
					if ( is_file('profiles/'.get_userid().'.jpg' ) ) 
					{ 
						$file_value = '<img src="' . base_url() . 'profiles/'.get_userid().'.jpg" />';
						$file_url = base_url() . 'profiles/'.get_userid().'.jpg';
						$file_exists_class = 'fileinput-exists';
					} else {
						if ( is_file('profiles/'.get_userid().'.png' ) )
						{
							$file_value = '<img src="' .base_url() . 'profiles/'.get_userid().'.png" />';
							$file_url = base_url() . 'profiles/'.get_userid().'.png';
							$file_exists_class = 'fileinput-exists';
						}
					}
					?>

					<div class="form-group">
						<label class="control-label  col-sm-4" for="Profile Picture">&nbsp;</label>
						<div class="controls col-sm-8">
							<div class="fileinput <?php echo $file_exists_class; ?>" data-provides="fileinput">
								<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"><?php echo $file_value; ?></div>
								<div><span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="profile_picture" name="profile_picture"></span>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a></div>
									<input type="hidden" name="propic" value="<?php $file_url; ?>" />
							</div>
							<span class="help-block m-b-zero"><?php echo form_error( 'profile_picture' ) ?></span>
						</div>
					</div>

					<?php sea_textbox( 'Website', 'website', '', $website ); ?>
					<?php sea_textarea( 'About', 'about', '', get_user_meta( 'about', get_userid() ) ); ?>

					<div class="col-sm-12">
						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-3">
								<input type="hidden" name="edit" value="1">
								<input type="hidden" name="modal" value="1">
								<input type="hidden" name="id" value="<?php echo get_userid(); ?>">
								<input type="submit" name="save" class="btn-save btn btn-primary floatleft" value="  &nbsp;&nbsp;Save&nbsp;&nbsp;  ">
								<div class="alert alert-save floatleft" >
										Profile Updated successfully.
								</div>
							</div>
						</div>
					</div>

				<div class="clearfix" ></div>
			</form>
	

		</div>