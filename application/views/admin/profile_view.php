<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$id = isset($profile_data[0]->id) ? $profile_data[0]->id : '';
$user_name = isset($profile_data[0]->user_name) ? $profile_data[0]->user_name : '';
$first_name = isset($profile_data[0]->first_name) ? $profile_data[0]->first_name : '';
$last_name = isset($profile_data[0]->last_name) ? $profile_data[0]->last_name : '';
$email_address = isset($profile_data[0]->email_address) ? $profile_data[0]->email_address : '';
$date_of_birth = isset($profile_data[0]->date_of_birth) ? $profile_data[0]->date_of_birth : '';
$phone_number = isset($profile_data[0]->phone_number) ? $profile_data[0]->phone_number : '';
$company_name = isset($profile_data[0]->company_name) ? $profile_data[0]->company_name : '';
$address = isset($profile_data[0]->address) ? $profile_data[0]->address : '';
$state = isset($profile_data[0]->state) ? $profile_data[0]->state : '';
$city = isset($profile_data[0]->city) ? $profile_data[0]->city : '';
$zip_code = isset($profile_data[0]->zip_code) ? $profile_data[0]->zip_code : '';

// $pay_card_number = isset($profile_data[0]->pay_card_number) ? $profile_data[0]->pay_card_number : '';
// $pay_name_on_card = isset($profile_data[0]->pay_name_on_card) ? $profile_data[0]->pay_name_on_card : '';
// $pay_month = isset($profile_data[0]->pay_month) ? $profile_data[0]->pay_month : '';
// $pay_year = isset($profile_data[0]->pay_year) ? $profile_data[0]->pay_year : '';
// $pay_cvv = isset($profile_data[0]->pay_cvv) ? $profile_data[0]->pay_cvv : '';

?>


<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Profile
			</h3>
			<span class="kt-subheader__separator kt-subheader__separator--v"></span>
			<div class="kt-subheader__group" id="kt_subheader_search">
				<span class="kt-subheader__desc" id="kt_subheader_total">
					Edit </span>
			</div>
		</div>
	</div>

	<!-- end:: Content Head -->
	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<div class="kt-portlet kt-portlet--tabs">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-toolbar">
					<ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#kt_apps_user_edit_tab_1" role="tab" aria-selected="true">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
										<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero"></path>
										<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3"></path>
									</g>
								</svg> Profile
							</a>
						</li>
						<?php $user_data = $this->session->userdata('userdata_list'); 
						
						?>	

						
					
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#kt_apps_user_edit_tab_3" role="tab" aria-selected="false">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect id="bound" x="0" y="0" width="24" height="24"></rect>
										<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"></path>
										<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" id="Mask" fill="#000000" opacity="0.3"></path>
										<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" id="Mask-Copy" fill="#000000" opacity="0.3"></path>
									</g>
								</svg> Change Password
							</a>
						</li>
						
					</ul>
				</div>
			</div>
			<div class="kt-portlet__body">
				
				<div class="tab-content">
					<div class="tab-pane active" id="kt_apps_user_edit_tab_1" role="tabpanel">

						
						<div class="alert alert-success msg_validation" role="alert" style="display: none;">
							<div class="alert-text">A simple success alert—check it out!</div>
						</div>


						<form id="change_profile" method="post">
							<input type="hidden" name="user_id" value="<?=$id?>"/>
							<div class="kt-form kt-form--label-right">
								<div class="kt-form__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											<div class="row">
												<label class="col-xl-3"></label>
												<div class="col-lg-9 col-xl-6">
													<h3 class="kt-section__title kt-section__title-sm">User Info:</h3>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* User Name</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="text" name="user_name" value="<?=$user_name?>" required>
												</div>
											</div>	
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* First Name</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="text" name="first_name" value="<?=$first_name?>" required>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* Last Name</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="text" name="last_name" value="<?=$last_name?>" required>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">Date of Birth</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="date" name="date_of_birth" value="<?=$date_of_birth?>" id="example-date-input">
												</div>
												
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* Email Address</label>
												<div class="col-lg-9 col-xl-6">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
														<input type="email" class="form-control" name="email_address" value="<?=$email_address?>" placeholder="Email" aria-describedby="basic-addon1" required>
													</div>
													<span class="form-text text-muted">We'll never share your email address with anyone else.</span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* Phone</label>
												<div class="col-lg-9 col-xl-6">
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
														<input type="text" class="form-control" name="phone_number" value="<?=$phone_number?>" placeholder="Phone" aria-describedby="basic-addon1" required>
													</div>
													
												</div>
											</div>
											
											<!-- <div class="form-group form-group-last row">
												<label class="col-xl-3 col-lg-3 col-form-label">Company Site</label>
												<div class="col-lg-9 col-xl-6">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Username" value="loop">
														<div class="input-group-append"><span class="input-group-text">.com</span></div>
													</div>
												</div>
											</div> -->
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* Address</label>
												<div class="col-lg-9 col-xl-6">
													<textarea class="form-control" id="exampleTextarea" rows="3" name="address" required><?=$address?></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* State</label>
												<div class="col-lg-9 col-xl-6">
													<select class="form-control" name="state" required>
														<option value="">--Select--</option>
														<?php foreach($state_master AS $val) { ?>
															<option value="<?=$val->id?>" <?php if($val->id == $state) { echo 'selected'; } ?>><?=$val->name?></option>
														<?php } ?>
													</select>
													
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* City</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="text" name="city" value="<?=$city?>" required>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* Zip Code</label>
												<div class="col-lg-9 col-xl-6">
													<input class="form-control" type="number" name="zip_code" value="<?=$zip_code?>" required>
												</div>
											</div>

										</div>
									</div>
								</div>
								<div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
								<div class="kt-form__actions">
									<div class="row">
										<div class="col-xl-3"></div>
										<div class="col-lg-9 col-xl-6">
											<button type="submit" class="btn btn-label-brand btn-bold">Save changes</button>
											<button type="reset" class="btn btn-secondary">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
						
					<div class="tab-pane" id="kt_apps_user_edit_tab_3" role="tabpanel">
						<div class="alert alert-success msg_validation" role="alert" style="display: none;">
							<div class="alert-text">A simple success alert—check it out!</div>
						</div>
						<form id="change_pass" method="">
							<input type="hidden" class="user_id" name="user_id" value="<?=$id?>"/>
							<div class="kt-form kt-form--label-right">
								<div class="kt-form__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											
											<div class="row">
												<label class="col-xl-3"></label>
												<div class="col-lg-9 col-xl-6">
													<h3 class="kt-section__title kt-section__title-sm">Change Or Recover Your Password:</h3>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* Current Password</label>
												<div class="col-lg-9 col-xl-6">
													<input type="password" class="form-control curr_pass" value="" placeholder="Current password" name="curr_pass" required>
													<p class="current_vali" style="color: red; display: none;">Invalid current password</p>
													<!-- <a href="#" class="kt-link kt-font-sm kt-font-bold kt-margin-t-5">Forgot password ?</a> -->
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">* New Password</label>
												<div class="col-lg-9 col-xl-6">
													<input type="password" class="form-control new_pass" name="new_pass" value="" placeholder="New password" required>
													<p class="pass_val" style="color: red; display: none;">Please enter a stronger password</p>
												</div>
											</div>
											<div class="form-group form-group-last row">

												<label class="col-xl-3 col-lg-3 col-form-label">* Verify Password</label>
												<div class="col-lg-9 col-xl-6">
													<input type="password" class="form-control verify_pass" name="verify_pass" value="" placeholder="Verify password" required>
													<p class="varify_vali" style="color: red; display: none;">please enter the same password on both fields</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
								<div class="kt-form__actions">
									<div class="row">
										<div class="col-xl-3"></div>
										<div class="col-lg-9 col-xl-6">
											<button type="submit" class="btn btn-label-brand btn-bold">Save changes</button>
											<button type="reset" class="btn btn-secondary">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end:: Content -->
</div>

<script type="text/javascript">


$('#change_profile').submit(function(e){

	e.preventDefault();
	var all_data = $('#change_profile').serialize();
	var url = '<?=base_url()?>'+'admin/profile/update_profile';
	
	$.ajax({
        url     : url,
        type    : "POST",
        data    : all_data,
        success : function (response) {
        	
        	if(response == 1){
        		var html_inner = '<div class="alert-text">Your profile updated successfully</div>';

        		$('.msg_validation').css('display','block');
        		$('.msg_validation').html(html_inner);

        		window.scrollTo(500,0);

        		setTimeout(function(){
        			$('.msg_validation').slideUp(); 
        			
        		}, 5000);
        	}
        }	
    });
});

$('#change_account').submit(function(e){

	e.preventDefault();
	var all_data = $('#change_account').serialize();
	var url = '<?=base_url()?>'+'admin/profile/update_profile';
	
	$.ajax({
        url     : url,
        type    : "POST",
        data    : all_data,
        success : function (response) {
        	
        	if(response == 1){
        		var html_inner = '<div class="alert-text">Your account details update successfully</div>';

        		$('.msg_validation').css('display','block');
        		$('.msg_validation').html(html_inner);

        		window.scrollTo(500,0);

        		setTimeout(function(){
        			$('.msg_validation').slideUp(); 
        			
        		}, 5000);
        	}
        }	
    });
});




$('#change_pass').submit(function(e){

	e.preventDefault();
	
	var user_id = $('.user_id').val();
	var curr_pass = $('.curr_pass').val();
	var new_pass = $('.new_pass').val();
	var verify_pass = $('.verify_pass').val();
	var new_pass_lnt = $(".new_pass").val().length;

	var strength = 1;
	var arr = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
	jQuery.map(arr, function(regexp) {
	  if(new_pass.match(regexp))
	     strength++;
	});

	if(strength < 5){
		$('.pass_val').css('display','block');
		setTimeout(function(){
			$('.pass_val').slideUp(); 
		}, 5000);
		return false;
	}

	// if(new_pass_lnt < 8){
	// 	$('.pass_val').css('display','block');
	// 	setTimeout(function(){
	// 		$('.pass_val').slideUp(); 
	// 	}, 5000);
	// 	return false;
	// }
	if(new_pass != verify_pass){
		$('.varify_vali').css('display','block');
		setTimeout(function(){
			$('.varify_vali').slideUp(); 
		}, 5000);
		return false;
	}

	var url = '<?=base_url()?>'+'admin/profile/change_password';
	$.ajax({
        url     : url,
        type    : "POST",
        data    : {'user_id':user_id, 'curr_pass':curr_pass, 'new_pass':new_pass},
        success : function (response) {
        	
        	if(response == 1){
        		var html_inner = '<div class="alert-text">Your password changed successfully</div>';

        		$('.msg_validation').css('display','block');
        		$('.msg_validation').html(html_inner);

        		window.scrollTo(500,0);

        		setTimeout(function(){
        			$('.msg_validation').slideUp(); 
        			
        		}, 5000);
        	}else{
        		$('.current_vali').css('display','block');
				setTimeout(function(){
					$('.current_vali').slideUp(); 
				}, 5000);
				return false;
        	}
        }	
    });
});


	
	

</script>
					