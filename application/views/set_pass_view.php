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
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="logo">
						<img src="<?=base_url()?>assets/front/image/main_logo.png" alt="header_logo" title="logo" />
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
								<h2 class="sub_title">Set Password</h2>
								
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
								<form action="#" id="forgot_password_data" method="post">
									<input type="hidden" name="user_id" value="<?=$user_id?>"/>
									<div class="ls_input_div row">
										
										<div class="input col-lg-12 col-md-12 col-sm-12 col-12 text-left">
											<input type="password" class="password_input ls_input" name="password" id="password" placeholder="Password" required>
										</div>
										<div class="input col-lg-12 col-md-12 col-sm-12 col-12 text-left">
											<input type="password" class="password_input ls_input" name="conf_password" id="conf_password" placeholder="Confirm Password" required>
										</div>
										
									</div>
									<div class="ls_button_div button col-lg-12 col-md-12 col-sm-12 col-12 text-left p-0">
										<button type="submit" class="ls_button ls_button button btn col-lg-12 col-md-12 col-sm-12 col-12 text-center text-uppercase">Set</button>
									</div>
								</form>
								
							</div>
							<!-- login with other -->
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>


<script type="text/javascript">
	
	$(document).ready(function(){
		setTimeout(function(){
        	$('.messages').slideUp(); 			
        }, 5000);
	});

	$('#forgot_password_data').submit(function(e){

		e.preventDefault();
		var password = $('#password').val();
		var conf_password = $('#conf_password').val();

		var strength = 1;
		var arr = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
		jQuery.map(arr, function(regexp) {
		  if(password.match(regexp))
		     strength++;
		});

		if(strength < 5){

			$('.email_valid').show();
			$('.email_valid').css('color','red');
			$('.email_valid').html('Please enter a stronger password');
    		setTimeout(function(){
    			$('.email_valid').slideUp(); 
    		}, 5000);			
			return false;
		}

		if(password != conf_password){
			$('.email_valid').show();
			$('.email_valid').css('color','red');
			$('.email_valid').html('Pleade enter the same password');
    		setTimeout(function(){
    			$('.email_valid').slideUp(); 
    		}, 5000);			
			return false;
		}
		var all_data = $('#forgot_password_data').serialize();
		var url = '<?=base_url()?>'+'customer_register/change_forgot';
		$.ajax({
	        url     : url,
	        type    : "POST",
	        data    : all_data,
	        success : function (response) {
	        	
	        	if(response == 1){
	        		//$('.loader').hide();
	        		$('.email_valid').show();
	        		$('.email_valid').css('color','green');
	        		$('.email_valid').html('Password set successfully');
	        		setTimeout(function(){
	        			window.location.href = "<?=base_url('login')?>";
	        		}, 5000);			
	        	}
	        }	
	    });
	});

</script>