<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	
	$modal_form = false;
	$button_func = 'data-cancel=' . $module_path;

	if ( isset( $modalform ) ) {
		$modal_form = true;
        $button_func = 'data-dismiss="modal"';
	}
	
	$controlClass = 'text'; 

	$name = '';
	$url = '';
	$content = '';
	$title = '';
	$meta_keywords = '';
	$meta_description = '';


	if ( isset( $page ) ) {
		extract( $page );
	}
	
	$pageid = '';
	if ( isset( $_GET['id'] ) ) 
	{
		$page_url = 'edit/?id=' . $_GET['id'];
	} else {
		$page_url = 'create/';
	} 
	?>
    	<?php sea_panel_heading("Page Creation"); ?>
		
        <div class="panel-body" >
			<?php echo form_open($module_path.$page_url , array( 'class' => 'form-horizontal sform','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
				<div class="col-sm-12 form-row"><div class="row" >

				<div class="col-sm-8">

					<?php sea_textbox( 'Page Name', 'name', '1', $name ); ?>
					<?php sea_textbox( 'Page URL', 'url', '1', $url ); ?>
					<?php sea_textarea( 'Content', 'content', '', $content ); ?>
				</div>
				</div></div>
	<div class="col-sm-12 form-row"><div class="row" >

				<div class="col-sm-8">
					<?php sea_section_heading( 'Seo Details' ); ?>
					<?php sea_textbox( 'Title', 'title', '1', $title ); ?>
					<?php sea_textarea( 'Meta Keywords', 'meta_keywords', '', $meta_keywords ); ?>
					<?php sea_textarea( 'Meta Description', 'meta_description', '', $meta_description ); ?>
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