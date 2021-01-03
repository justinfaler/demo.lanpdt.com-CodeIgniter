<!doctype html>
<html>

<head>
	<title>CPA2GO</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/bootstrap_4.3.1.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/bootstrap-drawer.css">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/fontawsome.min.css">
	<!-- Google Font CSS -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
	<!-- Global CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/terms-condistion/css/global.css" type="text/css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/terms-condistion/css/expert.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/terms-condistion/css/media.css" type="text/css">
	<!-- Jquery Libs -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Bootstrap Js -->
	<script src="<?= base_url() ?>assets/landing/js/popper.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/landing/js/bootstrap_4.3.1.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/landing/js/bootstrap-drawer.js" type="text/javascript"></script>
	<!-- Custom Js -->
	<script src="<?= base_url() ?>assets/landing/js/custom.js" type="text/javascript"></script>
	<link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/gif" sizes="16x16">
</head>

<body>
	<section id="header_banner" class="termsandconditions" style="background-image: url(../assets/landing/image/contact_us.jpg);">
		<header>
			<div class="container">
				<div class="row">
					<div class="header_logo col-12 d-flex flex-wrap justify-content-between align-items-center">
						<div class="logo_img float-left">
							<a href="<?=base_url()?>">
								<img src="<?= base_url() ?>assets/landing/image/Logo.png" alt="logo" />
							</a>
						</div>
						<div class="header_nav">
							<ul>
								<li class="mt-0"><a href="<?php echo base_url(); ?>">Home</a><span>|</span></li>
								<li class="mt-0"><a href="<?php echo base_url('About_us');?>"> About Us</a><span>|</span></li>
								<li class="mt-0"><a href="<?php echo base_url('faq');?>"> FAQ</a><span>|</span></li>
								<li class="mt-0"><a href="<?php echo base_url('Contactus'); ?>" class="active_tab">Contact Us</a></li>
							</ul>
						</div>
						<div class="header-btn float-right">
							<a href="<?= base_url('login') ?>">LOGIN</a>
							<a href="<?= base_url('register') ?>">SIGN UP</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div id="banner">
			<div class="container">
				<div class="row">
					<div class="banner_text_box col-12 d-flex flex-wrap justify-content-between align-items-center p-0">
						<div class="banner_text col-lg-12 col-md-12 col-sm-12 col-12 pr-0">
							<div class="text float-left col-12 p-0">
								<b>Contact Us</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="video_with_text" class="termsandconditions">
		<div class="container">
			<div class="row">
				<div class="vwt_content col-12 d-flex flex-wrap justify-content-between align-items-center p-0">
					<div class="messages col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="alert alert-success alert-dismissible add_contact" style="display: none;">
							<a href="#" class="close aio_close" data-dismiss="alert" aria-label="close">&times;</a>
							<span class="save_validation"></span>
						</div>

					</div>
					<div class="expert_content d-flex flex-wrap col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="expert_details contact_page">
							<div class="ed_profilepic">
								<div class="edp_img">
									<img src="<?= base_url() ?>assets/front/image/contact_pic.png" alt="profile_pic" />
								</div>
							</div>
							<div class="ed_profiledet text-center">
								<div class="ed_content">
									<p>Your feedback is very important to us at CPA2GO. If you have any questions, please select the appropriate department and someone will get back with you within 24-48 Hours.</p>
								</div>
							</div>
							<div class="ed_form form_div">
								<form action="#" id="contactus" method="post">
									<div class="ed_form_div d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
										<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
											<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">
												<input type="text" class="form-control" id="usr" name="name" placeholder="Name" required>
											</div>
										</div>
										<div class="ed_form_div_part col-lg-6 col-md-6 col-sm-12 col-12">
											<div class="form_content form-group col-lg-12 col-md-12 col-sm-12 col-12 p-0 m-0">

												<input type="number" class="form-control" id="usr" name="phone_number" placeholder="Phone (123-456-7890)" pattern="\d{3}[\-]\d{3}[\-]\d{4}" required>
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
					<div class="expert_contact_details vwt_content d-flex flex-wrap col-lg-6 col-md-6 col-sm-12 col-12">
						<div class="vwtc_text float-left col-12 text-lg-left text-md-left text-sm-center text-center p-0">
							<p>We can also be reached between<br> 8:00am - 5:00pm CST (UTC-6) M-F at <br><b> 1-800-555-5555</b></p>
							<p><b>Sales:</b><br>
								<a href="mailto:sales@cpa2go.com" target="_blank">sales@cpa2go.com</a>
							</p>
							<p><b>Support:</b><br>
								<a href="mailto:support@cpa2go.com" target="_blank">support@cpa2go.com</a>
							</p>
							<p><b>General Questions:</b><br>
								<a href="mailto:general@cpa2go.com" target="_blank">general@cpa2go.com</a>
							</p>
							<p class="m-0"><b>Franchise Opportunities:</b><br>
								<a href="mailto:general@cpa2go.com" target="_blank">joinus@cpa2go.com</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				var url = window.location.href;
				if (url == 'https://cpa2go.com/Contactus') {
					$(".active_tab").css("color", "#78be21");
				}
			});

			$('#contact_us').submit(function(e) {

				e.preventDefault();
				var all_data = $('#contact_us').serialize();
				var url = '<?= base_url() ?>' + 'contact_us/add_contact_us';
				$.ajax({
					url: url,
					type: "POST",
					data: all_data,
					success: function(response) {
						if (response == 1) {
							$('#contact_us').trigger("reset");
							$('.add_contact').css('display', 'block');
							$('.save_validation').html('Your message sent successfully');
							setTimeout(function() {
								$('.add_contact').slideUp();
							}, 5000);
							//window.location.href = "<?= base_url('cpa_contact_us') ?>";
						}
					}
				});
			});

		</script>
	</section>
	<footer>
		<div class="container">
			<div class="row text-center">
				<div class="footer_logo col-12 text-center">
					<div class="flogo_img d-inline-block">
						<img src="<?= base_url() ?>assets/landing/image/Logo.png" alt="footer_logo" />
					</div>
				</div>
				<ul class="p-0 col-12 d-inline-block">
					<li><a href="<?php echo base_url('terms_condition'); ?>">Terms & Conditions</a><span>|</span></li>
					<li><a href="<?php echo base_url('Privacy_policy'); ?>">Privacy Policy</a></li>
				</ul>
				<div class="footer-social col-12 text-center">
					<div class="fs_box">
						<a href="https://www.facebook.com/Cpa2Go-307010859847928/" target="_blank">
							<i class="fab fa-facebook-f"></i>
						</a>
					</div>
					<div class="fs_box">
						<a href="https://twitter.com/cpa2go" target="_blank">
							<i class="fab fa-twitter"></i>
						</a>
					</div>
					<div class="fs_box">
						<a href="https://www.instagram.com/cpa2go/" target="_blank">
							<i class="fab fa-instagram"></i>
						</a>
					</div>
					<div class="fs_box">
						<a href="https://www.linkedin.com/in/cpa-2go-056b4116a/" target="_blank">
							<i class="fab fa-linkedin"></i>
						</a>
					</div>
					<div class="fs_box">
						<a href="https://www.youtube.com/channel/UC4KQF2KlKM0XollA9rt1sLg" target="_blank">
							<i class="fab fa-youtube"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</body>

</html>
