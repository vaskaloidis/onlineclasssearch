<script type="text/javascript" >

$(document).ready(function() {
	$('[data-toggle="modal"]').click(function(e) {
		e.preventDefault();
		con_dropdown = $('#' + $(this).data('id') );
		var url = $(this).attr('data-target');

		$.ajax({
		  type: "GET",
		  url: url,
		  data: {action: 2},
		})
		.done(function( data ) {
			$('.modal-content').html( data );
			$('#bootModal').modal();

			$(".sform").on( "submit", function(e) {
				//var box = new ajaxLoader('body',  {bgColor: '#000'} );
				var sform = $(this);
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
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
								id = '';
								name = '';
								result = result.data;
								$.each(result, function ( key, val ) {
									if( key == 'id' ) {
										id = val;
									}
									if( key == 'name' ) {
										name = val
									}					
								});
								 if ( id && name) {
									con_dropdown.attr('selectedIndex', '-1').children("option:selected").removeAttr("selected");
									con_dropdown.append( '<option value="' + id + '" selected >' + name + '</option>' );
								 	con_dropdown.trigger('chosen:updated');
								 }
								 $('#bootModal').modal('hide');
							
							} else if ( result.status == "errors" ) {	
								errors = result.data;
								errors = result.data;
								$.each(errors, function ( key, val ) {
									if ( val ) {
										sform.find('#'+key).next().html(val);
										sform.find('#'+key).parent().addClass('error');
									}
								});
							} else {
								alert('Problem with connection');
							}						
						}
					   if (box) box.remove();
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
		  
	});
});

</script>

	<div class="modal fade" id="bootModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

            </div>
        </div>
    </div>

            