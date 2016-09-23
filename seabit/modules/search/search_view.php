							<?php
						//	$query = $this->db->query('SELECT * from ypusa_ypages_usa order by rowid limit 100');
							?>
                 <div id="content" class="col-md-12">
                 		<div class="post-wrapper" >
								<table class="table table-bordered">
                                <tr>
                                <th> COURSE NAME</th>
                                <th>SCHOOL</th>
                                <th>ACCREDITED COURSE?</th>
                                <th>&nbsp;</th>
                                </tr> 

                                <?php 
								if ( $listing ) :
								$rowno = $startno+1; 
                                foreach ($listing->result() as $row) :
								?>
								<tr>
									<td>
										<?php echo $row->code; ?><div class="rest-title"><a href="<?php echo $row->url ?>"><?php echo $row->name; ?></a></div>
                                        

                                            
											
                                            
											<p><?php echo $row->detail; ?></p>
                                            
                               	    </td>
                                            
                                     <td><span class="subtext">
											<?php echo $this->db->get_var("select name from ypusa_university where id ='" . $row->uni_id . "'"); ?></span>

									</td>
                                    <td>accredited? Yes </td>
                                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">SIGN UP HERE</button></td>
								</tr>  <!-- post End -->
								<?php 
								$rowno++; 
								endforeach; 
								endif;
								?>
						</table>
                        </div>
								<div class="navigation">
                                	<div class="col-md-8" >
                                    	<div class="row" >
                                		<?php echo $this->pagination->create_links(); ?>
                                        </div>
									</div>
                                    <div class="col-md-4" >
                                   		<div class="row" >
                                            <div class="search-results" >
                                                <?php echo $showing; ?>
                                            </div>
                                        </div>
                                    </div>
								</div>   <!-- navigation End -->
						</div>  <!-- Content End -->
					<div class="clear"></div>
   
					<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">SIGN UP HERE</h4>
								<p>Your information will be secure and not shared with any outside party</p>
							  </div>
							  <div class="modal-body">
								  <form role="form" id="contact_form">
									  <div class="form-group">
										<div class="col-md-6">
											<input type="text" class="form-control" 
											id="fname" placeholder="First Name"/>
										</div>
										<div class="col-md-6">
											<input type="text" class="form-control" 
											id="lname" placeholder="Last Name"/>
										</div>
										<div class="clear" ></div>
									</div>

									  <div class="form-group">
										<div class="col-md-12">
											<input type="email" class="form-control" 
											id="email" placeholder="Email"/>
										</div>
										<div class="clear" ></div>
									  </div>

									  <div class="form-group">
										<div class="col-md-12">
											<input type="phone" class="form-control" 
											id="phone" placeholder="Phone"/>
										</div>
										<div class="clear" ></div>
									  </div>


									  <div class="form-group">
										<div class="col-sm-12">
										  <a class="btn btn-default" id="submitContact">Submit</a>
										</div>
									  </div>
									  <div class="clear" ></div>
								</form>
							  </div>
							  <div class="modal-footer"></div>
							</div>

						  </div>
						</div>
<script>
	$(document).ready(function(e){
	
		$("#submitContact").click(function(e){
			var fname = $("#fname").val();
			var lname = $("#lname").val();
			var email = $("#email").val();
			var phone = $("#phone").val();
			
			var listVals = { var_fname : fname , var_lname : lname , var_email : email, var_phone : phone } 
			$.ajax({
				type: 'post',
				url:  '<?php echo base_url();?>' +  'ajax/add_contact',
				data: listVals ,
                dataType: 'json',
				success: function(data) {
					//var result = $.parseJSON(data);
					if(data.status=='failed'){
						alert(data.message);
					}else{
						alert(data.message);
						$("#myModal").hide();
					}
						

				}
			});
			
		});
	
	});
</script>