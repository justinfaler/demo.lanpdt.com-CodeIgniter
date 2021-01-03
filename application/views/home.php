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
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/global.css" type="text/css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/expert.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/media.css" type="text/css">
	<!-- Jquery Libs -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Bootstrap Js -->
	<script src="<?= base_url() ?>assets/landing/js/popper.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/landing/js/bootstrap_4.3.1.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/landing/js/bootstrap-drawer.js" type="text/javascript"></script>
	<!-- Custom Js -->
	<script src="<?= base_url() ?>assets/landing/js/custom.js" type="text/javascript"></script>
	<link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/gif" sizes="16x16">
	
		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-96620109-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-96620109-2');
</script>

</head>

<body>
	<section id="header_banner">
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
								<li class="mt-0"><a href="<?php echo base_url(); ?>" class="active_tab">Home</a><span>|</span></li>
								<li class="mt-0"><a href="<?php echo base_url('About_us');?>"> About Us</a><span>|</span></li>
								<li class="mt-0"><a href="<?php echo base_url('faq');?>"> FAQ</a><span>|</span></li>
								<li class="mt-0"><a href="<?php echo base_url('Contactus'); ?>">Contact Us</a></li>
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
						<div class="banner_text col-lg-6 col-md-12 col-sm-12 col-12 pr-0">
							<div class="text float-left col-12 p-0">
								<b>Reliable answers</b> from certified tax professionals, when you need them.
							</div>
						</div>
						<div class="banner_form col-lg-5 col-md-12 col-sm-12 col-12" style="margin-top: 87px;">
							<form action="<?= base_url('home/call_register') ?>" method="post">
								<div class="form-group">
									<textarea class="form-control" name="land_quas" rows="5" placeholder="Type your question here..." required></textarea>
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-success btn-block btn-rounded z-depth-1">Continue</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="easy_to_use">
		<div class="container">
			<div class="row">
				<div class="etu_title col-12 text-center">
					<h3 class="m-0">CPA2GO Is Easy To Use</h3>
				</div>
				<div class="etu_box col-12 d-flex flex-wrap justify-content-between align-items-top p-0 text-center">
					<div class="etu_boxes float-left col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="etu_box_img float-left col-12 p-0">
							<div class="etub_img_box">
								<img src="<?= base_url() ?>assets/landing/image/Icon_1.png" alt="icon_1" />
							</div>
						</div>
						<div class="etu_box_content float-left col-12 p-0">
							<h4>Sign Up</h4>
							<p class="m-0">Quickly sign up with an email or a social media account.</p>
						</div>
					</div>
					<div class="etu_boxes float-left col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="etu_box_img float-left col-12 p-0">
							<div class="etub_img_box">
								<img src="<?= base_url() ?>assets/landing/image/Icon_2.png" alt="icon_1" />
							</div>
						</div>
						<div class="etu_box_content float-left col-12 p-0">
							<h4>Ask a Question</h4>
							<p class="m-0">Submit your tax question to one of our licensed in your area CPA’s.</p>
						</div>
					</div>
					<div class="etu_boxes float-left col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="etu_box_img float-left col-12 p-0">
							<div class="etub_img_box">
								<img src="<?= base_url() ?>assets/landing/image/Icon_3.png" alt="icon_1" />
							</div>
						</div>
						<div class="etu_box_content float-left col-12 p-0">
							<h4>CPA Responds</h4>
							<p class="m-0">Receive a response from a licensed CPA within 12 hours of submitting your question.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="mobile_store">
		<div class="container">
			<div class="row align-items-center">
				<div class="mobile_store_box col-lg-6 col-md-6 col-sm-6 col-12 text-center">
					<div class="mobile_store_img d-inline-block">
						<img src="<?= base_url() ?>assets/landing/image/home_page_phone.png" alt="home_page_phone" />
					</div>
				</div>
				<div class="mobile_store_box col-lg-6 col-md-6 col-sm-6 col-12 text-center">
					<h4>Download Our Mobile App</h4>
					<div class="mobile_store_box_logo col-12 p-0 d-inline-block">
						<div class="logo_img d-inline-block">
							<img src="<?= base_url() ?>assets/landing/image/logo-2.png" alt="logo_2" />
						</div>
					</div>
					<div class="mobile_download_link d-flex flex-wrap justify-content-center col-12 p-0">
						<div class="mobile_store_box_img col-lg-6 col-md-6 col-sm-12 col-12 d-inline-block text-md-right text-sm-center text-center">
							<div class="logo_img d-inline-block">
								<a href="https://play.google.com/store/apps/details?id=com.cpago.cpa2go" target="_blank">
									<img src="<?= base_url() ?>assets/landing/image/download-android.png" alt="download-android" />
								</a>
							</div>
						</div>
						<div class="mobile_store_box_img col-lg-6 col-md-6 col-sm-12 col-12 d-inline-block text-md-left text-sm-center text-center">
							<div class="logo_img d-inline-block">
								<a href="https://apps.apple.com/us/app/cpa2go/id1498018761#?platform=ipad" target="_blank">
									<img src="<?= base_url() ?>assets/landing/image/download-apple.png" alt="download-apple" />
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="video_with_text">
		<div class="container">
			<div class="row">
				<div class="vwt_content col-12 d-flex flex-wrap justify-content-between align-items-center p-0">
					<div class="vwtc_text float-left col-lg-6 col-md-6 col-sm-12 col-12 text-left">
						<h4>The CPA2GO Story</h4>
						<p>After growing a small local firm 500% in 7 years, a CPA saw a trend developing among business owners and individuals seeking advice. That trend sparked an idea that support from CPA’s and business professionals could be offered without setting up an appointment or waiting for a phone call.</p>
						<p>Thus, CPA2GO was born! Why not provide quality answers and professional advice at the fingertips of those who need it most? CPA’s are in high demand especially with the current market structure. Tax laws change and business owners as well as individuals are left with numerous questions.</p>
						<p>For many business owners, their business is their lifeline. We here at CPA2GO are vested in partnering with you to expand your business and assist you to achieve success.</p>
						<div class="form-group text-right">
							<a href="https://cpa2go.com/register" target="_blank" class="btn btn-success btn-block btn-rounded z-depth-1">Sign Up</a>
						</div>
					</div>
					<div class="vwtc_video float-left col-lg-6 col-md-6 col-sm-12 col-12 ">
						<iframe class="float-left" width="100%" height="460" src="https://www.youtube-nocookie.com/embed/avOOjVXAcV4?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="testimonials">
		<div class="container">
			<div class="row">
				<div class="vwt_content col-12 d-flex flex-wrap justify-content-between align-items-center p-0">
					<div class="vwtc_text float-left col-lg-12 col-md-12 col-sm-12 col-12 text-center">
						<h4>What our clients are saying</h4>
						<div class="testimonials_content col-12 p-0">
							<div class="tc_image d-inline-block">
								<div class="tci_image_box"></div>
								<div class="tci_star">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</div>
							</div>
							<div class="tc_text d-inline-block">
								<p>As a business owner, I trust the expertise and guidance of CPA2GO. The professionals at CPA2GO really made my life easier when it came to my tax questions.</p>
								<p class="tc_text_name">Leslie Hankins</p>
								<p class="m-0">Owner, LaRousse Events</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
				<ul class="p-0 col-12 d-inline-block">
					<li>CPA2GO © 2020</li>
				</ul>
			</div>
		</div>
	</footer>
</body>
<script>
	$(document).ready(function() {
		var url = window.location.href;
		if (url == 'https://cpa2go.com/') {
			$(".active_tab").css("color", "#78be21");
		} else(url == 'https://cpa2go.com') {
			$(".active_tab").css("color", "#78be21");
		}
	});

</script>

</html>
