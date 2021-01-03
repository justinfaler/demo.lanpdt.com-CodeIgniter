<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/css/styles.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/fontawsome.min.css">
<!-- Google Font CSS -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- End Tabbing Panel Create -->

<?php
    $title=urlencode('CPA2GO');
    $url=urlencode('https://cpa2go.com/');
    $image=urlencode('https://cpa2go.com/assets/front/cpa/image/main_logo.png');
?>

<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">
	<!-- your Forloop here -->
	<?php $count = count($ticket_list);
	 ?>
	<?php foreach($ticket_list AS $val) { ?>
	<div class="ec_box d-inline-block col-lg-4 col-md-6 col-sm-12 col-12 text-left">
		<div class="my_ticket ecb_box box_shadow_custom">
			<!-- box detail content -->
			<div class="mt_details float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
				<div class="mtd_header float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
					<div class="mtdh_id float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
						<p>#<?=$val->ticket_number?></p>
					</div>
					<div class="mtdh_date float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
						<p><?=date('M d, Y', strtotime($val->start_date))?></p>
					</div>
				</div>
				<div class="mtd_body float-left col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="mtd_body_box float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						<div class="float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
							<div class="mtdb_name_2 mtdb_name float-left">
								<p>Name</p>
								<p class="expert_name"><?=$val->first_name.' '.$val->last_name?></p>
								<p style="font-size: 12px; text-transform: none;"><?=!empty($val->device_browser_type) ? ' ('.$val->device_browser_type.')' : ''?></p>
							</div>
						</div>
						<div class="float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
							<div class="mtdb_name">
								<p>Zip</p>
								<p class="expert_name"><?=$val->zip_code?></p>
							</div>
						</div>
					</div>
					<div class="mtd_body_box_2 mtd_body_box float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						
						<div class="mtdb_status">
							<?php if($val->qus_type != 3 AND $val->ticket_status != 3){ ?>
								<p class="pending"><?=$val->status?></p>
							<?php } ?>
						</div>
						
						<div class="mtdb_icon">
							<div class="icon">
								<?php if($val->qus_type == 1) { ?>

								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 82.143 81.429">
									<g>
										<path d="M54.449,48.965c-0.786,0-1.423,0.637-1.423,1.423v9.819c0,3.922-3.19,7.114-7.115,7.114H30.548
		c-0.787,0-1.422,0.637-1.423,1.422l-0.001,2.829l-3.396-3.396c-0.221-0.505-0.723-0.855-1.306-0.855h-9.246
		c-3.924,0-7.115-3.192-7.115-7.114V38.292c0-3.924,3.191-7.115,7.115-7.115h14.372c0.786,0,1.423-0.637,1.423-1.423
		s-0.638-1.423-1.423-1.423H15.175c-5.493,0-9.961,4.468-9.961,9.961v21.915c0,5.492,4.468,9.961,9.961,9.961h8.518l5.844,5.845
		c0.272,0.271,0.637,0.416,1.006,0.416c0.184,0,0.369-0.035,0.543-0.108c0.532-0.221,0.879-0.738,0.88-1.314l0.003-4.838h13.941
		c5.493,0,9.962-4.469,9.962-9.961v-9.819C55.873,49.602,55.235,48.965,54.449,48.965z M57.388,3.571h-3.6
		c-11.405,0-20.684,9.278-20.684,20.683c0,11.404,9.278,20.681,20.684,20.681h3.6c1.781,0,3.544-0.226,5.251-0.672l5.318,5.316
		c0.274,0.272,0.637,0.416,1.007,0.416c0.184,0,0.368-0.035,0.545-0.108c0.531-0.219,0.878-0.738,0.878-1.314v-8.232
		c2.252-1.825,4.123-4.128,5.437-6.702c1.492-2.924,2.248-6.082,2.248-9.385C78.071,12.849,68.793,3.571,57.388,3.571z
		 M68.106,38.511c-0.355,0.269-0.565,0.688-0.565,1.137v5.493l-3.482-3.481c-0.271-0.27-0.634-0.416-1.007-0.416
		c-0.139,0-0.279,0.021-0.416,0.063c-1.693,0.521-3.46,0.784-5.248,0.784h-3.6c-9.837,0-17.837-8-17.837-17.835
		c0-9.836,8-17.837,17.837-17.837h3.6c9.837,0,17.838,8,17.838,17.837C75.226,29.907,72.632,35.105,68.106,38.511z M56.41,13.555
		c-1.69-0.115-3.302,0.454-4.534,1.606c-1.217,1.135-1.914,2.741-1.914,4.404c0,0.786,0.637,1.423,1.423,1.423
		c0.784,0,1.423-0.637,1.423-1.423c0-0.891,0.357-1.717,1.011-2.325c0.649-0.606,1.501-0.907,2.396-0.845
		c1.569,0.107,2.836,1.372,2.942,2.942c0.11,1.585-0.931,2.985-2.473,3.33c-1.249,0.279-2.12,1.364-2.12,2.64v3.419
		c0,0.786,0.637,1.423,1.423,1.423s1.423-0.637,1.423-1.423v-3.305c2.867-0.694,4.79-3.317,4.586-6.279
		C61.79,16.163,59.389,13.762,56.41,13.555z M55.986,32.931c-0.373,0-0.741,0.153-1.007,0.418c-0.263,0.265-0.416,0.631-0.416,1.005
		c0,0.375,0.153,0.743,0.416,1.008c0.266,0.263,0.634,0.415,1.007,0.415c0.374,0,0.74-0.151,1.007-0.415
		c0.264-0.267,0.416-0.633,0.416-1.008c0-0.374-0.152-0.74-0.416-1.005C56.727,33.084,56.36,32.931,55.986,32.931z M44.347,47.685
		H14.321c-0.787,0-1.423,0.637-1.423,1.423s0.637,1.423,1.423,1.423h30.025c0.786,0,1.423-0.637,1.423-1.423
		S45.133,47.685,44.347,47.685z M43.34,56.069c-0.264,0.265-0.417,0.633-0.417,1.007c0,0.373,0.153,0.741,0.417,1.005
		c0.265,0.265,0.633,0.418,1.007,0.418c0.373,0,0.739-0.153,1.007-0.418c0.263-0.264,0.416-0.63,0.416-1.005
		c0-0.374-0.153-0.742-0.416-1.007c-0.268-0.266-0.634-0.416-1.007-0.416C43.973,55.653,43.604,55.804,43.34,56.069z M14.321,55.653
		c-0.787,0-1.423,0.637-1.423,1.423s0.637,1.423,1.423,1.423h24.427c0.786,0,1.423-0.637,1.423-1.423s-0.637-1.423-1.423-1.423
		H14.321z M35.097,39.715H14.321c-0.787,0-1.423,0.637-1.423,1.423c0,0.786,0.637,1.423,1.423,1.423h20.775
		c0.786,0,1.423-0.637,1.423-1.423C36.52,40.352,35.882,39.715,35.097,39.715z" />
									</g>
								</svg>
								<?php }elseif($val->qus_type==2){ ?>

								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 82.143 81.429">
									<g>
										<path d="M47.076,14.143c-4.671,0-9.243,1.228-13.245,3.561c-3.57,2.084-6.596,4.982-8.813,8.434h-9.984
		c-4.058,0-7.348,3.255-7.348,7.272v13.181c0,4.015,3.291,7.271,7.348,7.271h9.984c2.216,3.452,5.242,6.351,8.813,8.435
		c4.001,2.33,8.574,3.561,13.245,3.561c1.047,0,1.883-0.828,1.883-1.863V16.006C48.959,14.984,48.123,14.143,47.076,14.143z
		 M24.195,50.138h-9.16c-1.979,0-3.584-1.587-3.584-3.547V33.41c0-1.96,1.604-3.547,3.584-3.547h9.16V50.138z M45.194,62.062
		c-7.068-0.595-13.511-4.527-17.233-10.572V28.524c3.722-6.044,10.165-9.978,17.233-10.572V62.062z M56.336,25.57
		c-0.851-0.593-2.022-0.387-2.622,0.47c-0.599,0.841-0.391,2.001,0.474,2.595c3.767,2.593,6.01,6.858,6.01,11.386
		c0,4.525-2.243,8.791-6.01,11.386c-0.851,0.593-1.059,1.752-0.474,2.594c0.363,0.524,0.947,0.802,1.548,0.802
		c0.377,0,0.754-0.11,1.074-0.332c4.769-3.298,7.626-8.694,7.626-14.436C63.962,34.293,61.104,28.854,56.336,25.57z M63.614,17.855
		c-0.851-0.592-2.022-0.387-2.62,0.47c-0.601,0.841-0.393,2,0.474,2.595c6.314,4.361,10.081,11.497,10.081,19.086
		c0,7.591-3.767,14.74-10.081,19.088c-0.851,0.594-1.061,1.754-0.474,2.595c0.361,0.524,0.947,0.801,1.546,0.801
		c0.377,0,0.754-0.111,1.074-0.331c7.32-5.052,11.698-13.332,11.698-22.152C75.313,31.188,70.948,22.907,63.614,17.855z" />
									</g>
								</svg>
								<?php }elseif($val->qus_type==3){ ?>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 82.143 81.429">
								<g>
									<path d="M76.071,18.096c-0.719-0.375-1.594-0.336-2.276,0.101l-19.131,12.25v-5.058c0-4.142-3.486-7.512-7.771-7.512
										H12.529c-4.286,0-7.771,3.37-7.771,7.512V58.61c0,4.143,3.486,7.513,7.771,7.513h34.363c4.285,0,7.771-3.37,7.771-7.513v-5.056
										l19.131,12.25c0.371,0.236,0.798,0.356,1.227,0.356c0.361,0,0.721-0.086,1.05-0.255c0.721-0.376,1.171-1.101,1.171-1.893V19.985
										C77.242,19.196,76.792,18.469,76.071,18.096z M50.224,34.443v15.116v9.052c0,1.774-1.495,3.22-3.331,3.22H12.529
										c-1.838,0-3.331-1.445-3.331-3.22V25.389c0-1.773,1.493-3.219,3.331-3.219h34.363c1.836,0,3.331,1.446,3.331,3.219V34.443z
										 M72.802,60.018L54.664,48.404V35.597l18.138-11.615V60.018z M16.761,25.756c-2.651,0-4.8,2.078-4.8,4.642s2.149,4.642,4.8,4.642
										c2.651,0,4.801-2.078,4.801-4.642S19.413,25.756,16.761,25.756z"/>
								</g>
								</svg>
								<?php } ?>
							</div>
						</div>
						<div class="mtdb_btn">
							<a href="javascript:;" class="btn ticket_open" data-id=<?=$val->id?>>Open</a>
						</div>
					</div>
				</div>
				<!-- end detail content -->
			</div>
		</div>
		<!-- end here -->
	</div>
	<?php } ?>

	<?php if($count == 0) {?>
	<div class="ec_box d-inline-block col-lg-12 col-md-12 col-sm-12 col-12 text-left">
		<div class="my_ticket ecb_box box_shadow_custom">
			<!-- box detail content -->
			<div class="mt_details float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
				
				<div class="mtd_body float-left col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="mtd_body_box float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						<h4 class="title_name">No data available</h4>
						<div class="sm_content"><p>Get more questions.</p> <p>Share CPA2GO on social media.</p></div>
						<div class="social_media">
							<a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
								<div class="fs_box">
				                    <i class="fab fa-facebook-f"></i>
								</div>
							</a>
							<a href="http://twitter.com/share?text=<?=$title?>&url=<?=$url?>" target="_blank">
								<div class="fs_box">
									<i class="fab fa-twitter"></i>
								</div>
							</a>
							<!-- <div class="fs_box">
								<a href="https://www.instagram.com/cpa2go/" target="_blank">
									<i class="fab fa-instagram"></i>
								</a>
							</div> -->
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$url?>&title=<?=$title?>" target="_blank">
								<div class="fs_box">
									<i class="fab fa-linkedin"></i>
								</div>
							</a>
							<!-- <div class="fs_box">
								<a href="https://www.youtube.com/channel/UC4KQF2KlKM0XollA9rt1sLg" target="_blank">
									<i class="fab fa-youtube"></i>
								</a>
							</div> -->
						</div>	
					</div>
					
				</div>	
			</div>	
		</div>
	</div>		
						
	<?php } ?>


	<!-- End Forloop here -->
</div>
</div>
</div>
</div>

<style type="text/css">
	.title_name{
		color: #959595;
		margin: 0 auto;
		display: table;
	}

	.fs_box{
		display: inline-block;
	    width: 40px;
	    height: 40px;
	    background-color: #83c623;
	    border: 1px solid #83c623;
	    border-radius: 100%;
	    padding: 9px 0;
	    text-align: center;
	    margin-right: 15px;
	}

	.fs_box:hover{
		background-color: #FFF;
	}
	.social_media{
		text-align: center;
		margin-top: 10px;
	}
	.sm_content{
		text-align: center;
		margin-top: 10px;
	}
	
</style>

<div class="modal fade" id="ticket_open" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" id="close_pop" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body text-center">
				<div class="modal_content text-left">
					<p class="msg_validation"></p>
					<div class="mbc_form form_div">
						<form action="#" method="post">
							<input type="hidden" name="tkt_id" class="tkt_id" value="" />

							<div class="form_content_height scroll_div">
								<div class="form_content form-group m-0">
									<label for="ques">Question *</label>
									<textarea class="form-control que_field" id="ques" name="ques" readonly>I am paid by W2. What other options do I have?</textarea>
									<div class="audio_view"> </div>

								</div>
								<div class="form_content expert_anws form-group m-0">
									<label for="anws">Answer</label>
									<div class="fc_anw_box">
										<div class="ans_audio_view"> </div>
										<p class="ans_valid" style="display: none;"></p>
										<textarea class="form-control ans_field" id="anws" name="anws" placeholder="Write your answer..."></textarea>
										<div class="edqc_icon">
											<div class="icn audio_btn">
												<button type="button" id="recordButton">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
														<path d="M382.725,247.552c-4.662,0-8.449,3.774-8.449,8.448v50.689c0,65.219-53.057,118.276-118.275,118.276
	c-65.223,0-118.276-53.058-118.276-118.276V256c0-4.674-3.787-8.448-8.448-8.448s-8.448,3.774-8.448,8.448v50.689
	c0,71.687,56.13,130.346,126.724,134.743v42.671h-42.241c-4.662,0-8.448,3.778-8.448,8.448s3.787,8.448,8.448,8.448h101.379
	c4.662,0,8.448-3.778,8.448-8.448s-3.786-8.448-8.448-8.448h-42.241v-42.671c70.598-4.397,126.724-63.064,126.724-134.743V256
	C391.172,251.326,387.386,247.552,382.725,247.552"></path>
														<path d="M256,399.621c51.242,0,92.931-41.689,92.931-92.932V103.931C348.931,52.692,307.242,11,256,11
	c-51.238,0-92.931,41.692-92.931,92.931v202.759C163.069,357.932,204.762,399.621,256,399.621 M179.966,103.931
	c0-41.928,34.114-76.034,76.034-76.034s76.034,34.106,76.034,76.034v202.759c0,41.928-34.114,76.035-76.034,76.035
	s-76.034-34.107-76.034-76.035V103.931z"></path>
													</svg>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Record audio -->
							<input type="hidden" name="user_role" id="user_role" value="3" />
							<div class="show_record text-center" style="display:none">
								<div class="status_record"></div>
								<div id="controls">
									<button type="button" id="pauseButton" disabled><i class="fa fa-pause-circle" aria-hidden="true"></i></button>
									<button type="button" id="stopButton" disabled><i class="fa fa-stop-circle" aria-hidden="true"></i></button>
								</div>
								<div id="formats"></div>
								<ol id="recordingsList"></ol>
								<div class="status_record1" style="margin-top: -25px;"></div>
							</div>
							<!-- End Record audio -->
							<div class="form_content select form-group m-0 aud_status">
								<label for="anws">Status</label>
								<select class="qus_status" disabled>
									<option value="1">In Queue</option>
									<option value="2">Answered</option>
								</select>
							</div>

							<div class="form_content form-group m-0 video_call">
								<label for="anws">Description</label>
								<textarea class="form-control" id="video_dec" name="" placeholder="Write your answer...">Video Call</textarea>
							</div>			

							<div class="form_content button form-group m-0">
								<button type="button" class="btn btn-secondary col-12 ans_btn" id="answer_btn">Done</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" value="<?= isset($tkt_id) ? $tkt_id : '' ?>" id="not_ticket_id"/>
<input type="hidden" value="<?= isset($tick_status) ? $tick_status : '' ?>" id="not_tick_status"/>
<style type="text/css">
	
	.play-circle {
	   background: #f00;
	    border: 8px solid white;
	    border-radius: 50%;
	    height: 25px;
	    width: 25px;
	    position: relative;
	    box-shadow: 0 0 0 2px #000;
	    margin: 10px auto;
	}
</style>

<script type="text/javascript">

	(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
	    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));


	$(document).on('click', '#close_pop', function(){
		var not_tick_status = $('#not_tick_status').val();
		$('.audio_data').remove();	
		if(not_tick_status == 'open'){
			window.location.href = '<?=base_url()?>' + 'open_ticket_cpa';
		}
		if(not_tick_status == 'pending'){
			location.reload();
		}
		if(not_tick_status == 'close'){
			window.location.href = '<?=base_url()?>' + 'closed_ticket_cpa';
		}
		
	});


	var ticket_id = $('#not_ticket_id').val(); //"<?=$tkt_id?>";
	
	if(ticket_id != ''){
		$(document).ready(function(){
			open_ticket(ticket_id);
		});
	}

	$(document).on('click', '.ticket_open', function() {
		var ticket_id = $(this).attr('data-id');
		open_ticket(ticket_id);
	});

	function open_ticket(ticket_id){

		$('.show_record').css('display','none');	
		$('.ans_btn').css('display','block');	
		$('#answer_btn').css('display','block');	
		var url = '<?=base_url()?>' + 'ticket_details_cpa/get_ticket_data';
		$.ajax({
			url: url,
			type: "POST",
			data: {
				'ticket_id': ticket_id
			},
			success: function(response) {

				var all_data = JSON.parse(response);
				$('.scroll_div').show();
				$('.ans_btn').show();
				$('.select').show();
				$('.video_call').hide();
				$('.ans_field').prop('disabled', false);
				if (all_data.qus_type == 1) {
					$('.que_field').val(all_data.question);
					$('.audio_view').html('');
					$('.que_field').css('display', 'block');
				}
				if(all_data.qus_type == 2){
					var audio_url = '<?=base_url()?>uploads/audios/' + all_data.qus_files;
					var html_inn = '<audio controls="" class="audio_data" style="width: 250px;"><source src="' + audio_url + '" type="audio/wav"></audio>';
					$('.que_field').css('display', 'none');
					$('.audio_view').html(html_inn);
				}
				if(all_data.qus_type == 3){

					$('.scroll_div').hide();
					$('.ans_btn').hide();
					$('.select').hide();
					$('.video_call').show();
					$('#video_dec').prop('disabled', true);
					$('#video_dec').val(all_data.cpa_video_desc);
				}

				$('.ans_field').val(all_data.answer);
				$('.ans_field').css('display', 'block');
				$('.ans_audio_view').html('');
				$('.edqc_icon').css('display', 'block');
				if (all_data.answer != '' && all_data.qus_states == 2) {
					$('.ans_field').val(all_data.answer);
					$('.ans_field').css('display', 'block');
					$('.ans_audio_view').html('');
				}
				if (all_data.ans_files != '' && all_data.qus_states == 2) {
					var audio_url = '<?=base_url()?>uploads/audios/' + all_data.ans_files;
					var html_inn = '<audio controls="" class="audio_data" style="width: 250px;"><source src="' + audio_url + '" type="audio/wav"></audio>';
					$('.ans_field').css('display', 'none');
					$('.ans_audio_view').html(html_inn);
				}
				//$('#answer_btn').prop('disabled', false);
				$('#answer_btn').css('display', 'block');
				$(".qus_status").val(all_data.qus_states);
				$(".tkt_id").val(all_data.id);
				if (all_data.qus_states == 2) {
					$('.edqc_icon').css('display', 'none');
					//$('#answer_btn').prop('disabled', true);
					$('.ans_field').prop('disabled', true);
					$('#answer_btn').css('display', 'none');
				}
				$('#ticket_open').modal({backdrop: 'static', keyboard: false});
				$('#ticket_open').modal('toggle');
				$('#ticket_open').modal('show');

				// setTimeout(function(){
				// 	$('#write_review').modal('toggle');
				// 	$('#write_review').modal('show');
				// },100);

			}
		});
	}

	$(document).on('click', '.clear_upld', function(){
		var ticket_id = $('.tkt_id').val();
		
	});

	$(document).on('click', '.ans_btn', function() {
		var tkt_id = $(".tkt_id").val();
		var ans_field = $(".ans_field").val();

		
		if(ans_field == ''){
			$('.ans_valid').show();
			$('.ans_valid').css('color','red');
			$('.ans_valid').html('Please enter the answerss');
			setTimeout(function() {
				$('.ans_valid').hide();
			}, 3000);
			return false;
		}
		var url = '<?=base_url()?>' + 'ticket_details_cpa/update_answer';
		$.ajax({
			url: url,
			type: "POST",
			data: {
				'tkt_id': tkt_id,
				'ans_field': ans_field
			},
			success: function(response) {

				if (response == 1) {
					$('.msg_validation').html('Answer submitted');
					$('.msg_validation').css('color', 'green');

					setTimeout(function() {
						window.location.href = "<?=base_url()?>pending_ticket_cpa";
					}, 2000);
				}

			}
		});

	});

	$(document).on('click', '.audio_btn', function() {
		$('.show_record').css('display', 'block');
		$('.ans_btn').css('display', 'none');
		$('.aud_status').css('display', 'none');
		$('.ans_field').val('');
		$('.ans_field').prop('disabled', true);
	});

	$(document).on('click', '.delete_btn', function(){
		$('.show_record').css('display', 'none');
		$('.ans_btn').css('display', 'block');
		$('.aud_status').css('display', 'block');
		$('.ans_field').prop('disabled', false);			
	});

	var cpa_audio = 'yes'; 
	var url_path = "<?=base_url()?>";

</script>

<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="<?=base_url()?>assets/front/audio/app.js"></script>
