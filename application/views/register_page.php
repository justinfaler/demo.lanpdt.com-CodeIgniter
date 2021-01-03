<!doctype html>
<html>
<head>
	<title>CPA2GO</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/bootstrap_4.3.1.css">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/fontawsome.min.css">
	<!-- Global CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/global.css" type="text/css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/login_signup.css" type="text/css">
	<!-- Jquery Libs -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Bootstrap Js -->
	<script src="<?=base_url()?>assets/front/js/popper.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/front/js/bootstrap_4.3.1.js" type="text/javascript"></script>
</head>

<body>
	<!-- Header Section -->
	<div class="loader"></div>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="logo">
						<a href="<?=base_url()?>">
							<img src="<?=base_url()?>assets/front/image/main_logo.png" alt="header_logo" title="logo" />
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Content Section -->
	<div id="login_signup">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
					<?php $session_ques = $this->session->userdata('land_quas'); 
					if(isset($session_ques)){
					?>
					<h4>Your question is saved. Please sign up to proceed.</h4>
					<?php } ?>
					<div class="login_signup">
						<div class="ls_div text-center">
							<!-- Content Title -->
							<div class="ls_title">
								<h2 class="sub_title">Real CPA's,</h2>
								<h1 class="title">Real Answers, Sign Up Now! </h1>
							</div>
							<!-- Content Form -->
							<div class="ls_form form_div">
								<p class="email_valid" style="color:red;"></p>
								<!-- <p class="pass_val" style="color: red; display: none;">Please enter min 8 character password</p> -->
								<form action="#" id="cust_register" method="post">

									
									<div class="ls_input_div row">
										<div class="ls_input_div_part">
											<div class="input div_input col-lg-6 col-md-6 col-sm-12 col-12 text-left">
												<input type="text" class="email_input ls_input" name="first_name" placeholder="First Name" required>
											</div>
											<div class="input div_input col-lg-6 col-md-6 col-sm-12 col-12 text-left">
												<input type="text" class="password_input ls_input" name="last_name" placeholder="Last Name" required>
											</div>
										</div>
										<div class="ls_input_div_part">
											<div class="input div_input col-lg-6 col-md-6 col-sm-12 col-12 text-left">
												<input type="email" class="email_input ls_input" name="email_address" placeholder="Email Address" required>
												
											</div>
											<div class="select div_input col-lg-6 col-md-6 col-sm-12 col-12 text-left">
												<select class="state_select ls_select" name="state" required>
													<option disabled selected value="">State</option>
													<?php foreach($state_master AS $val) { ?>
													<option value="<?=$val->id?>"><?=$val->name?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="ls_input_div_part">
											<div class="input div_input col-lg-6 col-md-6 col-sm-12 col-12 text-left">
												<input type="text" class="password_input ls_input" name="zip_code" placeholder="Zip Code (Max 5 digits)" pattern="[0-9]{0,5}" required>
											</div>

											<div class="input div_input col-lg-6 col-md-6 col-sm-12 col-12 text-left">

												<input type="password" class="email_input ls_input password" name="password" placeholder="Password [a-z][A-Z][1-9]" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
												<span style="color:#9d9797; margin-left:110px;">Ex:User@123</span>
												
											</div>
										</div>
										<div class="ls_input_div_part">
											<div class="input div_input col-lg-6 col-md-6 col-sm-12 col-12 text-left">
												
												<input type="password" class="password_input ls_input confirm_pass" name="confirm_pass" placeholder="Confirm Password" required>
												<p class="pass_valid" style="color: red;"></p>
											</div>
										</div>
										<div class="input_link col-lg-12 col-md-12 col-sm-12 col-12 text-left">
											<div class="checkbox">
												<label class="checkbox_container">
													<input type="checkbox" class="term_checkbox ls_checkbox" >
													<span class="checkmark"></span>
												</label>
											</div>
											<p>I agree to the <a href="<?= base_url('terms_condition'); ?>" class="link green_link" target="_blank" ><u>Terms and Conditions*</u></a></p>
										</div>
									</div>
									<div class="ls_button_div button col-lg-12 col-md-12 col-sm-12 col-12 text-left p-0">
										<button type="submit" class="ls_button ls_button button btn col-lg-12 col-md-12 col-sm-12 col-12 text-center text-uppercase">Register</button>
									</div>
								</form>

									<div class="ls_other col-lg-12 col-md-12 col-sm-12 col-12 p-0 text-center">
									<p>Sign up With</p>
								<a href="<?php echo $this->facebook->login_url(); ?>" class="login_fb">
									<div class="icon">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</div>
								</a>
								</div>

								<div class="ls_signup_link col-lg-12 col-md-12 col-sm-12 col-12 p-0 text-center">
									<p>Already have an account? <a href="<?=base_url('login')?>" class="link text-uppercase">LOG IN</a></p>
								</div>
							</div>
							<!-- login with other -->
							<!-- <div class="ls_other col-lg-12 col-md-12 col-sm-12 col-12 p-0 text-center">
								<p>Create Account</p>
								<div class="icon">
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>


<style type="text/css">
.loader {
    background: url('<?= base_url('assets/images/loader1.gif'); ?>');
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    position: fixed;
    z-index: 999;
    display: none;
    background-position: center;
    background-color: #ffffffa6;
    background-repeat: no-repeat;
    background-size: 70px;
}
</style>

<script type="text/javascript">
	
$('#cust_register').submit(function(e){

	e.preventDefault();

	var term_checkbox = $(".term_checkbox").val();
	if($(".term_checkbox").is(':checked')){
    	var chek_val = 1;      
    }else{
      	var chek_val = 0; 
    }
	
	if(chek_val == 0){
		$('.email_valid').css('display','block');
		$('.email_valid').html('Please Agree to Our Terms and Conditions in Order to Continue');
		setTimeout(function(){
			$('.email_valid').slideUp(); 
		}, 5000);
		return false;
	}
	var new_pass_lnt = $(".password").val().length;
	if(new_pass_lnt < 8){
		$('.email_valid').css('display','block');
		$('.email_valid').html('Please enter min 8 character password');
		setTimeout(function(){
			$('.email_valid').slideUp(); 
		}, 5000);
		return false;
	}


	var password = $('.password').val();
	var confirm_pass = $('.confirm_pass').val();
	
	if(password != confirm_pass){
		$('.pass_valid').show();
		$('.pass_valid').html('please enter the same password on both fields.');	
		setTimeout(function(){
        	$('.pass_valid').slideUp(); 			
        }, 5000);			
        return false;		
	}
	// $('.loader').show();
	var all_data = $('#cust_register').serialize();
	var url = '<?=base_url()?>'+'customer_register/register_pro';
	$('.loader').show();
	$.ajax({
        url     : url,
        type    : "POST",
        data    : all_data,
        success : function (response){
        	$('.loader').hide();
        	if(response != 0){
        		window.location.href = "<?=base_url('cpa_list')?>";
        		//window.location.href = "<?=base_url('login')?>";
        	}else{
        		$('.loader').hide();
        		var html_inner = '<div class="alert-text">Your email address already exist</div>';
        		$('.email_valid').show();
        		$('.email_valid').html(html_inner);
        		setTimeout(function(){
        			$('.email_valid').slideUp(); 
        		}, 5000);			
        	}
        }	
    });
});
</script>
