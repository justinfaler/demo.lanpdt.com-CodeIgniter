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
	<link rel="icon" href="<?=base_url()?>assets/images/favicon.ico" type="image/gif" sizes="16x16">
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
					<div class="login_signup">
						<div class="ls_div text-center">
							<!-- Content Title -->
							<div class="ls_title">
								<h2 class="sub_title">Login to</h2>
								<h1 class="title">Your Account</h1>
							</div>
							<!-- Content Form -->
							<div class="ls_form form_div">

								<div class="messages">
				                <?php 
				                    $succ_register = $this->session->flashdata('succ_register');
				                    if(!empty($succ_register)) {
				                       echo '<div class="alert alert-success alert-dismissible succ_register">';
				                       echo '<a href="#" class="close aio_close" data-dismiss="alert" aria-label="close">&times;</a>';
				                       echo $succ_register;
				                       echo '</div>';
				                    }
				                ?>
				                </div>
								<p class="email_valid" style="color:red;"></p>
								<form action="#" id="cust_login" method="post">
									
									<div class="ls_input_div row">
										<div class="input col-lg-12 col-md-12 col-sm-12 col-12 text-left">
											<input type="email" class="email_input ls_input" name="email" placeholder="Email Address" required>
										</div>
										<div class="input col-lg-12 col-md-12 col-sm-12 col-12 text-left">
											<input type="password" class="password_input ls_input" name="password" placeholder="Password" required>
										</div>
										<div class="input_link col-lg-12 col-md-12 col-sm-12 col-12 text-right">
											<!-- <a class="dropdown-item nav_dropdown_box_link" href="javascript:;" data-toggle="modal" data-target="#change_password">Forgot Password ?</a> -->
											<a href="javascript:;" class="link" data-toggle="modal" data-target="#change_password">Forgot Password ?</a>
										</div>
									</div>
									<div class="ls_button_div button col-lg-12 col-md-12 col-sm-12 col-12 text-left p-0">
										<button type="submit" class="ls_button ls_button button btn col-lg-12 col-md-12 col-sm-12 col-12 text-center text-uppercase">LOGIN</button>
									</div>
								</form>
								<div class="ls_signup_link col-lg-12 col-md-12 col-sm-12 col-12 p-0 text-center">
									<p>Don’t have an account? <a href="<?=base_url('register')?>" class="link text-uppercase">REGISTER</a></p>
								</div>
							</div>
							<!-- login with other -->
							<div class="ls_other col-lg-12 col-md-12 col-sm-12 col-12 p-0 text-center">
								<p>Login With</p>
								<a href="<?php echo $this->facebook->login_url(); ?>" class="login_fb">
									<div class="icon">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>


<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-body text-center">
					<div class="modal_content text-left">
						<div class="mbc_form form_div">
							<p class="validation" style="color:red"></p>
							<form action="" method="" id="forgot_pass">
								<div class="form_content_height scroll_div">
									<div class="form_content form-group m-0">
										<input type="email" class="form-control" id="for_email" name="for_email" placeholder="Email Address" required="">
									</div>
									
								</div>
								<div class="form_content button form-group m-0">
									<button type="submit" class="btn btn-secondary col-12 change_pass">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


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
	
	$(document).ready(function(){
		setTimeout(function(){
        	$('.messages').slideUp(); 			
        }, 5000);
	});

	$('#cust_login').submit(function(e){

		e.preventDefault();

		var all_data = $('#cust_login').serialize();
		var url = '<?=base_url()?>'+'customer_register/login_process';
		$('.loader').show();
		$.ajax({
	        url     : url,
	        type    : "POST",
	        data    : all_data,
	        success : function (response) {
	        	$('.loader').hide();
	        	if(response == 3){
	        		window.location.href = "<?=base_url('open_ticket_cpa')?>";
	        	}
	        	if(response == 4){
	        		window.location.href = "<?=base_url('cpa_list')?>";
	        	}
	        	if(response == 0){
	        		$('.loader').hide();
	        		$('.email_valid').show();
	        		$('.email_valid').html('<div class="alert-text">Invalid email address OR password</div>');
	        		setTimeout(function(){
	        			$('.email_valid').slideUp(); 
	        		}, 5000);			
	        	}
	        }	
	    });
	});

	$('#forgot_pass').submit(function(e){

		e.preventDefault();
		var all_data = $('#forgot_pass').serialize();
		var url = '<?=base_url()?>'+'customer_register/forgot_password';
		$.ajax({
	        url     : url,
	        type    : "POST",
	        data    : all_data,
	        success : function (response) {
	        	if(response == 1){
	        		$('.validation').show();
	        		$('.validation').css('color','green');
	        		$('.validation').html('Please check your email');
	        		setTimeout(function(){
	        			window.location.href = "<?=base_url('login')?>";
	        		}, 5000);
	        		
	        		
	        	}
	        	if(response == 0){
	        		//$('.loader').hide();
	        		$('.validation').show();
	        		$('.validation').css('color','red');
	        		$('.validation').html('Invalid email address');
	        		setTimeout(function(){
	        			$('.validation').slideUp(); 
	        		}, 5000);			
	        	}
	        }	
	    });
	});

</script>