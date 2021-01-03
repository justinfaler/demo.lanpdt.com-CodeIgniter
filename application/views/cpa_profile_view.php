<?php $user_data = $this->session->userdata('user_front'); ?>
<div class="messages col-lg-12 col-md-12 col-sm-12 col-12">
	<?php 
                    $update_profile = $this->session->flashdata('update_profile');
                    if(!empty($update_profile)) {
                       echo '<div class="alert alert-success alert-dismissible update_profile">';
                       echo '<a href="#" class="close aio_close" data-dismiss="alert" aria-label="close">&times;</a>';
                       echo $update_profile;
                       echo '</div>';
                    }
                ?>
</div>
<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
	<div class="account_page expert_details contact_page">
		<div class="ed_profilepic">
			<?php 
								$image_url = !empty($user_data->user_image) ? base_url().'uploads/user_images/'.$user_data->user_image : base_url().'assets/images/unknown-512.png';
								 ?>
			
			<img src="<?=$image_url?>" class="edp_img" alt="profile_pic" id="blah" />
			
		</div>
		<form action="" id="update_profile" method="post" enctype="multipart/form-data">

			<input type="hidden" name="user_role" value="3"/>

				<div class="image_upload text-center">
					<input type="file" name="user_image" onchange="readURL(this);" id="pro_img">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
						<path d="M314.432,111.342l97.613,89.393L164.982,426.959l-97.527-89.371L314.432,111.342z M486.086,89.8l-43.554-39.882
c-16.823-15.393-44.109-15.393-60.977,0l-41.675,38.195l97.57,89.393l48.635-44.536C499.109,121.014,499.109,101.734,486.086,89.8z
M16.386,463.253c-1.75,7.303,5.466,13.836,13.451,12.086l108.757-24.125L41.066,361.8L16.386,463.253z" />
					</svg>
					<p>500x500 px recommended (up to 2 Mb)</p>
				</div>	

			<!-- <div class="image_upload text-center">
				<input type="file" name="user_image" onchange="readURL(this);" placeholder="Change Profile Pic" />
				<p>Change Profile Pic</p>
			</div> -->

			<div class="ed_form form_div">

				<input type="hidden" value="<?=$user_data->id?>" name="user_id" />
				<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* First Name</label>
							<input type="text" class="form-control" id="usr" name="first_name" value="<?=$user_data->first_name?>" placeholder="First Name" required> 
						</div>
					</div>
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* Last Name</label>
							<input type="text" class="form-control" id="usr" name="last_name" value="<?=$user_data->last_name?>" placeholder="Last Name" required>
						</div>
					</div>
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* Email Address</label>
							<input type="email" class="form-control" id="usr" name="email_address" value="<?=$user_data->email_address?>" placeholder="Email" required>
							<p class="email_valid" style="color:red;"></p>
						</div>
					</div>
				</div>

				<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">

						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>Date of Birth</label>
							<input class="form-control date_of_birth" type="date" name="date_of_birth" value="<?=$user_data->date_of_birth?>" id="example-date-input">
						</div>


						<!-- <label>Date Of Birth</label>
											<input type="text" class="form-control" id="usr" value="<?=$user_data->date_of_birth?>" placeholder="Date of Birth"> -->
						<!-- </div> -->
					</div>
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* Phone Number (123-456-7890)</label>
							<input type="text" class="form-control" id="usr" name="phone_number" value="<?=$user_data->phone_number?>" placeholder="Phone Number" pattern="\d{3}[\-]\d{3}[\-]\d{4}" required>
						</div>
					</div>
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>Company Name</label>
							<input type="text" class="form-control" id="usr" name="company_name" value="<?=$user_data->company_name?>" placeholder="Company Name">
						</div>
					</div>
				</div>

				<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
					<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>Web Address</label>
							<input type="text" class="form-control" id="usr" name="web_address" value="<?=$user_data->web_address?>" placeholder="Web Address">
						</div>
					</div>
					<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* Street Address</label>
							<input type="text" class="form-control" id="usr" name="address" value="<?=$user_data->address?>" placeholder="Street Address" required>
						</div>
					</div>
				</div>

				<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content select form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* State</label>
							<select class="form-control" name="state" required>
								<option disabled="" selected="" value="">State</option>
								<?php foreach($state_master AS $key=>$val) { ?>
								<option value="<?=$val->id?>" <?php if($val->id == $user_data->state){ echo 'selected'; } ?>><?=$val->name?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* City</label>
							<input type="text" class="form-control" id="usr" name="city" value="<?=$user_data->city?>" placeholder="City" required>
						</div>
					</div>
					<div class="ed_form_div_part col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="form_content select form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* Zip Code (Max 5 digits)</label>
							<input type="text" class="form-control" name="zip_code" id="usr" value="<?=$user_data->zip_code?>" placeholder="Zip Code" pattern="[0-9]{0,5}" required>
						</div>
					</div>
				</div>



				<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
					<div class="ed_form_div_part col-lg-6 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>* Profile Description</label>
							<textarea name="cpa_description" class="form-control" required><?=$user_data->cpa_description?></textarea>
						</div>
					</div>	
					<div class="ed_form_div_part col-lg-6 col-md-4 col-sm-12 col-12">
						<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
							<label>Services</label>
							<textarea class="form-control" class="cpa_service" name="cpa_service"><?=$user_data->cpa_service?></textarea>
						</div>
					</div>
				</div>

				<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
					<div class="edf_box col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group form_content m-0">
							<label style="color: #6c6c6c;">License Number * </label>
							<div class="edf_border_box">
								<p><?=$user_data->license_number?></p>
							</div>
						</div>
					</div>	
					<?php if(!empty($assign_zip_code[0])) { ?>
						<div class="edf_box col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group form_content m-0">
								<label style="color: #6c6c6c;">Assigned Zip</label>
								<div class="edf_border_box">
								<?php foreach($assign_zip_code AS $key=>$val){ ?>
									
										<span><?=$val?></span>
								<?php } ?>	
								</div>
							</div>
						</div>
					<?php } ?>
				</div>

				<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form_content button form-group col-lg-12 col-md-12 col-sm-12 col-12 text-right p-0 m-0">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>

			</div>
		</form>
	</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function() {
			$('.update_profile').slideUp();
		}, 5000);
	});

	// $(function () {
	//        $('#datetimepicker1').datetimepicker();
	//    });

	// function readURL(input) {
	// 	if (input.files && input.files[0]) {
	// 		var reader = new FileReader();

	// 		reader.onload = function(e) {
	// 			$('#blah')
	// 				.attr('src', e.target.result)
	// 				// .width(90)
	// 				// .height(90);
	// 		};

	// 		reader.readAsDataURL(input.files[0]);
	// 	}
	// }


	$('#pro_img').on('change', function() {
        
        document.getElementById('blah').src = window.URL.createObjectURL(this.files[0]);
        
    });


	$('#update_profile').submit(function(e) {
		
		e.preventDefault();
		var urls = '<?=base_url()?>' + 'customer_register/register_pro';
		$('.loader').show();
		$.ajax({
			url: urls,
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function(response) {
				$('.loader').hide();
				if (response == 0) {
					var html_inner = 'Your email address already exist';
					$('.email_valid').show();
					$('.email_valid').html(html_inner);
					setTimeout(function() {
						$('.email_valid').slideUp();
					}, 5000);
				} else {
					window.location.href = "<?=base_url('cpa_profile')?>";
				}
			}
		});
	});

</script>


<script src="<?=base_url()?>assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
