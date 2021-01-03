<!-- End Tabbing Panel Create -->
				<div class="messages col-lg-12 col-md-12 col-sm-12 col-12">
                <?php 
                    $update_account = $this->session->flashdata('update_account');
                    if(!empty($update_account)) {
                       echo '<div class="alert alert-success alert-dismissible update_account">';
                       echo '<a href="#" class="close aio_close" data-dismiss="alert" aria-label="close">&times;</a>';
                       echo $update_account;
                       echo '</div>';
                    }
                ?>
                </div>
				<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
					<form action="#" method="post" id="cpa_account" class="d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
						<input type="hidden" name="cpa_id" value="<?=$user_data->id?>"/>
						<div class="account_page expert_details contact_page">
							<div class="ed_profilepic">
									<?php $user_image = !(empty($user_data->user_image)) ? base_url().'uploads/user_images/'.$user_data->user_image : base_url().'assets/images/unknown-512.png'; ?>
								<div class="edp_img" style="background-image: url('<?=$user_image?>');">
								</div>
								
								<div class="image_upload text-center">
									<input type="file" name="user_image" onchange="readURL(this);">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
										<path d="M314.432,111.342l97.613,89.393L164.982,426.959l-97.527-89.371L314.432,111.342z M486.086,89.8l-43.554-39.882
	c-16.823-15.393-44.109-15.393-60.977,0l-41.675,38.195l97.57,89.393l48.635-44.536C499.109,121.014,499.109,101.734,486.086,89.8z
	 M16.386,463.253c-1.75,7.303,5.466,13.836,13.451,12.086l108.757-24.125L41.066,361.8L16.386,463.253z" />
									</svg>
								</div>
							</div>
							<div class="ed_profilecontent text-center">
								<div class="ed_expert_name">
									<h4><?=$user_data->first_name.' '.$user_data->last_name?></h4>
								</div>
								<div class="ed_expert_content">
									<div class="edec_title">
										<h5>Profile Description</h5>
										<!-- <a href="javascript:;" class="btn text-uppercase">Edit</a> -->
									</div>
									<div class="edec_content">
										<textarea name="cpa_description" class="form-control" style="height:130px;" required><?=$user_data->cpa_description?></textarea>
										<!-- <p>Heath graduated with a Bachelor of Science in Accounting in 1991.  He has worked in public accounting for 18 years with a 7 year break where he operated as a CFO for a local company. </p> -->
									</div>
								</div>
							</div>
							<div class="ed_form d-flex flex-wrap align-items-center">
								<div class="edf_box col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group form_content m-0">
										<label>License Number * </label>
										<div class="edf_border_box">
											<p><?=$user_data->license_number?></p>
										</div>
									</div>
								</div>
								<?php if(!empty($assign_zip_code[0])) { ?>
								<div class="edf_box col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group form_content m-0">
										<label>Zip</label>
										<div class="edf_border_box">
										<?php foreach($assign_zip_code AS $key=>$val){ ?>
											
												<span><?=$val?></span>
										<?php } ?>	
										</div>
									</div>
								</div>
								<?php } ?>
								<div class="edf_box col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group form_content m-0">
										<label>Services</label>
										<div class="edf_border_box">
											<textarea class="form-control" class="cpa_service" name="cpa_service"><?=$user_data->cpa_service?></textarea>
										</div>
									</div>
								</div>
								<div class="edf_box col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group form_content m-0">
										<label>Contact Email Address</label>
										<div class="edf_border_box">
											<input type="email" name="email_address" class="form-control" placeholder="Email" value="<?=$user_data->email_address?>" required>
										</div>
									</div>
								</div>
								<div class="edf_box col-lg-6 col-md-6 col-sm-6 col-12 text-right">
									<div class="form-group form_content m-0">
										<label></label>
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

		$(document).ready(function(){
			setTimeout(function(){
				$('.update_account').slideUp();
			}, 5000);
		});

		function readURL(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                $('#blah')
	                    .attr('src', e.target.result)
	                    .width(90)
	                    .height(90);
	            };
	            reader.readAsDataURL(input.files[0]);
	        }
	    }

		$('#cpa_account').submit(function(e){

			e.preventDefault();
			var urls = '<?=base_url()?>'+'cpa_account/update_account';
	        var all_data = $('#cpa_account').serialize();
	        $.ajax({
	             url:urls,
	             type:"post",
	             data:new FormData(this),
	             processData:false,
	             contentType:false,
	             cache:false,
	             async:false,
	             success: function(response){
	             	if(response == 1){
		        		window.location.href = "<?=base_url('cpa_account')?>";
		        	}
	           	}
        	});

		});
	</script>