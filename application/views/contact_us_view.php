<!-- Content Section -->
	<div id="expert">
		<div class="container">
			<div class="row">
				<div class="messages col-lg-12 col-md-12 col-sm-12 col-12">
                	<div class="alert alert-success alert-dismissible add_contact" style="display: none;">
						<a href="#" class="close aio_close" data-dismiss="alert" aria-label="close">&times;</a>
						<span class="save_validation"></span>
					</div>
                </div>
				<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="expert_details contact_page">
						<div class="ed_profilepic">
							<div class="edp_img">
								<img src="<?=base_url()?>assets/front/image/contact_pic.png" alt="profile_pic" />
								
							</div>
						</div>
						<div class="ed_profiledet text-center">
							<div class="ed_content">
								<p>Your feedback is very important to us at CPA2GO. If you have any questions, please select the appropriate  department and someone will get back with you within 24-48 Hours.</p>
							</div>
						</div>
						<div class="ed_form form_div">
							<form action="#" id="contact_us" method="post">
								<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
									<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
											<input type="text" class="form-control" id="usr" name="name" placeholder="Name" required>
										</div>
									</div>
									<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
											<input type="text" class="form-control" id="usr" name="phone_number" placeholder="Phone (123-456-7890)" min="0" pattern="\d{3}[\-]\d{3}[\-]\d{4}" required>
										</div>
									</div>
								</div>
								<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
									<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
											<input type="email" class="form-control" id="usr" name="email" placeholder="Email" required>
										</div>
									</div>

									<!-- 
									Sales: sales@cpa2go.com 
									Support: support@cpa2go.com 
									General Questions: general@cpa2go.com 
									Franchise Opportunities: joinus@cpa2go.com 
									-->

									<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form_content select form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
											<select name="department" required>
												<option value="">Select Department</option>
												<option value="sales">Sales</option>
												<option value="support">Support</option>
												<option value="general">General Questions</option>
												<option value="franchise">Franchise Opportunities</option>
											</select>
										</div>
									</div>
								</div>
								<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
									<div class="ed_form_div_part col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form_content textarea form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
											<textarea class="form-control" name="message" placeholder="Message" required></textarea>
										</div>
									</div>
								</div>
								<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form_content button form-group col-lg-12 col-md-12 col-sm-12 col-12 text-right p-0 m-0">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">

		$(document).ready(function(){
			// setTimeout(function(){
			// 	$('.add_contact').slideUp();
			// }, 5000);
		});

		$('#contact_us').submit(function(e){

			e.preventDefault();
			var all_data = $('#contact_us').serialize();
			var url = '<?=base_url()?>'+'contact_us/add_contact_us';
			$.ajax({
		        url     : url,
		        type    : "POST",
		        data    : all_data,
		        success : function (response){
		        	if(response == 1){
		        		$('#contact_us').trigger("reset");
		        		$('.add_contact').css('display','block');
		        		$('.save_validation').html('Your message sent successfully');
		        		setTimeout(function(){
							$('.add_contact').slideUp();
						}, 5000);
		        		//window.location.href = "<?=base_url('contactus')?>";
		        	}
		        }	
		    });
		});
	</script>