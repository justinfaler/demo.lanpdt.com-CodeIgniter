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
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
	<!-- Header CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/header.css" type="text/css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/expert.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/media.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/bootstrap-drawer.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/global.css" type="text/css">
	<link href="<?=base_url()?>assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
	<!-- Jquery Libs -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Bootstrap Js -->
	<script src="<?=base_url()?>assets/front/js/bootstrap_4.3.1.js" type="text/javascript"></script>


	<script src="<?=base_url()?>assets/front/js/popper.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/front/js/bootstrap-drawer.js" type="text/javascript"></script>
	<link rel="icon" href="<?=base_url()?>assets/images/favicon.ico" type="image/gif" sizes="16x16">
	<!-- Custom Js -->

</head>

<body>
	<!-- Header Section -->
	<div class="loader"></div>
	<header id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="logo">
						<a href="<?=base_url().'cpa_list'?>">
							<img src="<?=base_url()?>assets/front/image/main_logo.png" alt="header_logo" title="logo" />
						</a>
					</div>
					<?php $class = $this->router->fetch_class(); 
						
						$user_data = $this->session->userdata('user_front');
					?>
					<div class="navigation">
						<nav class="navbar navbar-expand-lg navbar-dark p-0">
							<div class="collapse navbar-collapse nav_dropdown_box_2 justify-content-end nav_dropdonw_box" id="collapsibleNavbar">
								<ul class="navbar-nav align-items-center">

									<li class="nav-item nav_dropdown_box_link">
										<a class="nav-link <?php if($class == 'package_list'){ ?>active<?php }?>" href="<?=base_url('pack_list')?>">Subscriptions</a>
									</li>
									<li class="nav-item nav_dropdown_box_link">
										<a class="nav-link <?php if($class == 'cpa_details'){ ?>active<?php }?>" href="<?=base_url('cpa_list')?>">Ask a Question</a>
									</li>
									<li class="nav-item nav_dropdown_box_link">
										<a class="nav-link <?php if($class == 'ticket_details'){ ?>active<?php }?>" href="<?=base_url('get_customer_ticket')?>">My Questions</a>
									</li>
									<li class="nav-item nav_dropdown_box_link">
										<a class="nav-link <?php if($class == 'contact_us'){ ?>active<?php }?>" href="<?=base_url('contactus')?>">Contact</a>
									</li>
								</ul>
							</div>
							<button class="navbar-toggler d-lg-block noti_btn" type="button" data-toggle="drawer" data-target="#noti">
								<span class="navbar-toggler-icon noti_active">
									<i>
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
											<g>
												<g>
													<path stroke="#333333" stroke-miterlimit="10" d="M468.684,412.352c-52.248-23.562-54.231-124.701-54.281-127.264
			v-67.856c0-65.311-39.963-121.469-96.759-145.377C317.527,38.281,290.13,11,256.483,11s-61.028,27.281-61.16,60.854
			c-56.795,23.909-96.759,80.067-96.759,145.377v67.856c-0.032,2.563-2.033,103.687-54.281,127.264
			c-5.952,2.68-9.227,9.16-7.854,15.525c1.372,6.383,7.026,10.93,13.558,10.93H182.46c2.728,14.914,9.788,28.804,20.585,40.045
			C217.396,493.783,236.378,502,256.483,502s39.087-8.217,53.438-23.148c10.797-11.241,17.873-25.131,20.585-40.045h132.472
			c6.531,0,12.188-4.547,13.56-10.93C477.909,421.512,474.652,415.03,468.684,412.352z M256.483,38.695
			c15.228,0,28.092,10.21,32.126,24.132c-10.385-2.149-21.114-3.282-32.126-3.282c-10.995,0-21.743,1.133-32.109,3.282
			C228.392,48.905,241.255,38.695,256.483,38.695z M126.293,285.17v-67.938c0-71.676,58.415-129.992,130.19-129.992
			c71.792,0,130.19,58.316,130.19,129.992v68.055c0.018,2.083,0.347,23.975,5.869,50.908h-272.12
			C125.945,309.229,126.276,287.303,126.293,285.17z M256.483,474.322c-21.164,0-39.633-15.245-45.568-35.517h91.137
			C296.115,459.077,277.646,474.322,256.483,474.322z M88.81,411.128c11.028-13.889,18.816-30.589,24.306-47.222h286.735
			c5.489,16.617,13.276,33.315,24.306,47.222H88.81z M256.483,106.667c-59.655,0-108.184,48.462-108.184,108.026
			c0,7.647,6.2,13.847,13.855,13.847c7.655,0,13.872-6.2,13.872-13.847c0-44.304,36.095-80.34,80.456-80.34
			c7.655,0,13.872-6.2,13.872-13.848C270.355,112.859,264.139,106.667,256.483,106.667z"></path>
												</g>
											</g>
										</svg>
									</i>
								</span>
							</button>
							<ul class="navbar-nav-profile">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<div class="profile-img">
											<?php $img_url = !empty($user_data->user_image) ? base_url().'uploads/user_images/'.$user_data->user_image : base_url().'assets/images/unknown-512.png'; ?>
											<div class="profile_img_div" style="background-image: url('<?=$img_url?>');"></div>
										</div>
										<p class="profile-text"><?php echo $user_data->first_name.' '.$user_data->last_name ?></p>
									</a>
									<div class="dropdown-menu nav_dropdown_box" aria-labelledby="navbarDropdownMenuLink">
										<a class="dropdown-item nav_dropdown_box_link <?php if($class == 'customer_register'){ ?>active<?php }?>" href="<?=base_url('customer_profile')?>">Profile</a>
										<a class="dropdown-item nav_dropdown_box_link" href="javascript:;" data-toggle="modal" data-target="#change_password">Change Password</a>
										<a class="dropdown-item nav_dropdown_box_link" href="<?=base_url('logout')?>">Log Out</a>
									</div>
								</li>
							</ul>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
								<span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
							</button>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
		

	<div class="drawer drawer-right slide" tabindex="-1" role="dialog" aria-labelledby="drawer-demo-title" aria-hidden="true" id="noti">
		<div class="drawer-content drawer-content-scrollable" role="document">
			<div class="drawer-header">
				<h4 class="drawer-title" id="drawer-1-title">Notifications</h4>
				<button type="button" class="btn close_btn" data-dismiss="drawer" aria-label="Close"><span>×</span></button>
			</div>
			<div class="drawer-body">
				<div class="drawer-row">
					<div class="clear_btn_div">
						<a href="#" class="clear_btn">Clear All</a>
					</div>
					<div class="notification">
						<!-- forloop here -->
						
						<!-- end forloop here -->
						
					</div>
				</div>
			</div>
		</div>
	</div>


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
							<form action="" method="">
								<div class="form_content_height scroll_div">
									<div class="form_content form-group m-0">
										<input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Old Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
									</div>
									<div class="form_content expert_anws form-group m-0">
										<input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
									</div>
									<div class="form_content form-group m-0">
										<input type="password" class="form-control" id="conf_pass" name="conf_pass" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
									</div>
								</div>
								<div class="form_content button form-group m-0">
									<button type="button" class="btn btn-secondary col-12 change_pass">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="add_zip_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> -->
				<div class="modal-body text-center">
					<div class="modal_content text-left">
						<div class="mbc_form form_div">
							<p class="zip_validation" style="color:red"></p>
							<form action="" method="">
								<input type="hidden" name="user_id" id="user_id" value="<?=$user_data->id?>"/>
								<div class="form_content_height scroll_div">
									<div class="form_content form-group m-0">
										<input type="number" class="form-control" id="zipcode" name="zipcode" placeholder="Enter zip code">
									</div>
								</div>
								<div class="form_content button form-group m-0">
									<button type="button" class="btn btn-secondary col-12 add_zip_code_btn">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="noti_btn_style">
	<style>.navbar-toggler-icon:after{ background-color: transparent !important;}</style>
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


	<?php if(empty($user_data->zip_code)) { ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#add_zip_code').modal({backdrop: 'static', keyboard: false});  
				$('#add_zip_code').modal('toggle');
				$('#add_zip_code').modal('hide');
			});
		</script>
	 <?php } ?>
	<script type="text/javascript">
		$(document).on('click', '.change_pass', function() {

			var old_pass = $('#old_pass').val();
			var new_pass = $('#new_pass').val();
			var conf_pass = $('#conf_pass').val();
			var strength = 1;
			var arr = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
			jQuery.map(arr, function(regexp) {
			  if(new_pass.match(regexp))
			     strength++;
			});

			if (old_pass == '' || new_pass == '' || conf_pass == '') {

				$('.validation').show();
				$('.validation').html('Requied all fields');
				setTimeout(function() {
					$('.validation').slideUp();
				}, 5000);
				return false;
			}


			if(strength < 5){
				$('.validation').show();
				$('.validation').html('Please enter a stronger password');
				setTimeout(function() {
					$('.validation').slideUp();
				}, 5000);
				return false;
			}
			

			if (new_pass != conf_pass) {
				$('.validation').show();
				$('.validation').html('please enter the same password on both fields.');
				setTimeout(function() {
					$('.validation').slideUp();
				}, 5000);
				return false;
			}
			var url = '<?=base_url()?>' + 'customer_register/change_password';
			$.ajax({
				url: url,
				type: "POST",
				data: {
					'old_pass': old_pass,
					'new_pass': new_pass
				},
				success: function(response) {
					if (response == 0) {
						$('.validation').show();
						$('.validation').html('Invalid your old password');
						setTimeout(function() {
							$('.validation').slideUp();
						}, 5000);
					} else {
						$('.validation').show();
						$('.validation').html('Your password changed successfully');
						$('.validation').css('color', 'green');
						setTimeout(function() {
							$('.validation').slideUp();
							$('#change_password').modal('toggle');
							$('#change_password').modal('hide');
						}, 5000);
					}
				}
			});
		});

		$(document).on('click', '.add_zip_code_btn', function(){
			
			var user_id = $('#user_id').val();
			var zipcode = $('#zipcode').val();
			if (zipcode == '' || user_id == '') {
				$('.zip_validation').show();
				$('.zip_validation').html('Requied zip code');
				setTimeout(function() {
					$('.zip_validation').slideUp();
				}, 5000);
				return false;
			}
			var url = '<?=base_url()?>' + 'customer_register/update_zip_code';
			$.ajax({
				url: url,
				type: "POST",
				data: {
					'user_id': user_id,
					'zipcode': zipcode
				},
				success: function(response) {
					if (response == 1) {
						$('.zip_validation').show();
						$('.zip_validation').html('Your zip code added successfully');
						$('.zip_validation').css('color', 'green');
						setTimeout(function() {
							// $('.zip_validation').slideUp();
							// $('#change_password').modal('toggle');
							// $('#change_password').modal('hide');
							window.location.href = "<?=base_url('cpa_list')?>";
						}, 3000);
					} 
				}
			});
		});

		$(document).ready(function(){
			
			
			var url = '<?=base_url()?>' + 'question_answer/change_video_noti_customer';
		    $.ajax({
		      	url: url,
		      	type: "POST",
		      	
		      	success: function(response) {
		      		$('#agora_local').html('');
		      		$('#agora_local').next().remove();
		      		
		      	}
		    });
		})

		$(document).on('click', '.noti_btn', function(){
			var url = '<?=base_url()?>' + 'notification/get_notification_customer';
			$.ajax({
				url: url,
				type: "POST",
				success: function(response) {
					$('.notification').html(response);
				}
			});
		});

		$(document).on('click', '.noti_status', function(){
			var not_id = $(this).attr('data-id');
			var data_status = 1;
			var url = '<?=base_url()?>' + 'notification/change_noti_status';
			$.ajax({
				url: url,
				type: "POST",
				data: {
					'not_id': not_id,
					'data_status':data_status
				},
				success: function(response) {

					if(data_status == 1){
						window.location.href = '<?=base_url()?>' + 'get_customer_ticket/'+not_id;
					}
					
					// $('.notification').html(response);
				}
			});
		});
		
		setInterval(function(){get_notification();},500);

		function get_notification(){

			//alert('get_notificationget_notification');
			var url = '<?=base_url()?>'+'notification/get_cust_notification'
			$.ajax({
				url: url,
				type: "POST",
				success: function(response){
					if(response == 0){
						$('.noti_btn_style').html('<style>.navbar-toggler-icon:after{ background-color: transparent !important;}</style>');
						console.log('dfd');
						//$('.navbar-toggler-icon .noti_active:after').css('background-color', 'transparent', '!important');
						// $('.noti_active').css('display', 'none');
					}else{
						$('.noti_btn_style').html('<style>.navbar-toggler-icon:after{ background-color: #2fc659 !important;}</style>');
						// $('.noti_active').css('display', 'block');
					}	
				}
			});	
		}			

		$(document).on('click', '.clear_btn', function(){
			var url = '<?=base_url()?>' + 'notification/clear_cust_notification';
			$.ajax({
				url: url,
				type: "POST",
				success: function(response) {
					if(response == 1){
						
						$('.notification').html("<div class='noti_box d-flex align-items-center flex-wrap'><div>No new notifications</div></div>");
					}
				}
			});
		});

	</script>
	<script src="<?=base_url()?>assets/front/js/custom.js" type="text/javascript"></script>

<!-- 
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
	  var OneSignal = window.OneSignal || [];
	  OneSignal.push(function() {
	    OneSignal.init({
	      appId: "1d7468d8-0366-4399-8f4f-016592d47e13",
	      notifyButton: {
	        enable: true,
	      },
	    });
	  });
	</script> -->
