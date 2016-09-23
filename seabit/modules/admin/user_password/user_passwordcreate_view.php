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
	$button_func = 'data-cancel=' . $module_path;

	if ( isset( $modalform ) ) {
		$modal_form = true;
        $button_func = 'data-dismiss="modal"';
	}
	
	$controlClass = 'text'; 

	$username = '';
	$oldpassword = '';
	$password = '';
	$conf_password = '';


	if ( isset( $user_password ) ) {
		extract( $user_password );
	}
	
	$user_passwordid = '';

	$user_password_url = 'edit/';
	?>
    	<?php sea_panel_heading("Password Change"); ?>
		
        <div class="panel-body" >

			<?php echo form_open($module_path.$user_password_url , array( 'class' => 'form-horizontal sform','target'=>'_top', 'enctype' => 'multipart/form-data'));?>

				<div class="col-sm-12 form-row">
					<div class="row" >
						<div class="col-sm-6">
							<?php sea_textbox_disabled( 'User Name', 'username', '1', get_username() ); ?>
							<?php sea_password( 'Old Password', 'oldpassword', '1', $oldpassword ); ?>
							<?php sea_password( 'Password', 'password', '1', $password ); ?>
							<?php sea_password( 'Confirm Password', 'conf_password', '1', $conf_password ); ?>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
						<input type="hidden" name="id" value="<?php echo get_userid(); ?>">
						<input type="hidden" name="modal" value="1">
						<input type="hidden" name="edit" value="1">
						<input type="submit" name="savenew" class="btn-save btn btn-primary floatleft" value="Save">
						<div class="alert alert-save floatleft" >
								Password Changed Successfully.
						</div>
						<?php if ( $modal_form == true ) { ?>
							<input type="hidden" name="modal" value="1">
						<?php } ?>
						</div>
					</div>
				</div>
				<div class="clearfix" ></div>
			</form> 