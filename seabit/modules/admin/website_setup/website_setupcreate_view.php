<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>
$(document).ready(function() {

			$(".sform").on( "submit", function(e) {
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
						alert(errorThrown);  
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

	$website_name = get_option( 'website_name');
	$website_title = get_option( 'website_title');
	$meta_keywords = get_option( 'meta_keywords');
	$meta_description = get_option( 'meta_description');
	$admin_name = get_option( 'admin_name');
	$admin_email = get_option( 'admin_email');

	?>
    	<?php sea_panel_heading("Website Setting"); ?>
		
        <div class="panel-body" >
			<?php echo form_open('admin/website_setup/edit/' , array( 'class' => 'form-horizontal sform','target'=>'_top', 'enctype' => 'multipart/form-data')); ?>
				<div class="col-sm-12 form-row"><div class="row" >

				<div class="col-sm-6">

					<?php sea_textbox( 'Website Name', 'website_name', '1', $website_name ); ?>
				</div>
				</div></div>
	<div class="col-sm-12 form-row"><div class="row" >

				<div class="col-sm-6">
					<?php sea_section_heading( 'Seo Details' ); ?>
					<?php sea_textbox( 'Website Title', 'website_title', '1', $website_title ); ?>
					<?php sea_textarea( 'Meta Keywords', 'meta_keywords', '', $meta_keywords ); ?>
					<?php sea_textarea( 'Meta Description', 'meta_description', '', $meta_description ); ?>
					<?php sea_section_heading( 'Admin Details' ); ?>
					<?php sea_textbox( 'Admin Name', 'admin_name', '1', $admin_name ); ?>
					<?php sea_textbox( 'Admin Email', 'admin_email', '', $admin_email ); ?>
				</div>

				</div></div>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-3">
								<input type="hidden" name="edit" value="1">
								<input type="hidden" name="modal" value="1">
								<input type="submit" name="save" class="btn-save btn btn-primary floatleft" value="  &nbsp;&nbsp;Save&nbsp;&nbsp;  ">
								<div class="alert alert-save floatleft" >
										Settings Updated successfully.
								</div>
							</div>
						</div>
					</div>
					
				<div class="clearfix" ></div>
			</form> 