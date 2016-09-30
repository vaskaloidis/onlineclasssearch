
			   <!---  menu  -->
			<div class="top-header">
			   <div class="col-md-2"><span class="home-logo"><img src="<?php echo base_url(); ?>images/logo.png" /><span></div>
			   <div class=" col-md-8">
				<nav class="navbar navbar-default">
					<ul class="nav navbar-nav">

					</ul>
				</nav>
				</div>
				<div class="col-md-2">
					<span class="home-login">
						
					</span>
				</div>
			</div>
				
				
				<!---  form-search  -->
				
                <div class="home-search" > 
					<div class="col-sm-offset-4 col-md-8">

                      <!---logo-->
                        <!--<div id="logo" class="text-center">
                            	<img alt="Oneline Class Search Logo" src="<?php echo base_url(); ?>images/logo.png" />
                                <h4>The Easy Way to Find Accredited Online College Courses.</h4>
                        </div> -->
						<div class="online-school">
							<h1>Find an online course</h1>
							<h5>Step 1: search for a college course (Example: Accounting) </h5>
							<h5>Step 2: Browse our database of courses related to the type of course you're looking for </h5>
							<h5>Step 3: Click sign up here to sign up for the class! </h5>
					        

							<div class="search-bar">
								<p>Search our database- 20,000+ courses:</p>
								<form id="search-form" action="<?php echo base_url(); ?>search/" method="GET">
									<input id="terms" type="text"  class="input-search" placeholder="example: chem" autocomplete="off"  name="terms" value="<?php echo $terms ?>" tabindex="1" />
									<button class="btn-search" type="submit" value="Search" ><!-- <i class="fa fa-search" aria-hidden="true"></i> --></button>
								</form>

							</div>
						</div>  <!--- online-school -->

					</div>
                 </div> <!-- End home-search -->
				 


						<div class="section2">
						<div class="container">
						<div class="row">
							<div class="col-md-9">
								<h2>Want to Start/Continue a degree at any level of education?</h2>
							
								<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">CLICK HERE!</button>

								<h4>(Associate Degrees, Bachelor's Degrees, Master's Degrees, Doctorate Degrees all available)</h4>
							</div>

							<div class="col-md-3">
								
							</div>
						</div>
						</div>
						</div>

						<div class="section3">
						<div class="container">
							<h2>Why Online College</h2>
							<p>Take Accreditted online college courses anywhere <br> you have access to the internet! Take them at <br> your convenience so you can live the life </br> you want to outside of the classroom.</p>
						</div>
						</div>

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