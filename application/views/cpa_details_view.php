<?php $user_data = $this->session->userdata('user_front'); ?>
<!-- Content Section -->
<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/audio/style.css"> -->
<script src="<?=base_url()?>assets/front/video/AgoraRTCSDK-2.9.0.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/front/ratting/css/star-rating-svg.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/css/styles.css">

<div id="expert">
	<div class="container">
		<div class="row">
			<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0 text-center">
				<input type="hidden" name="pay_customer_id" id="pay_customer_id" value="<?=$user_data->pay_customer_id?>" />
				<input type="hidden" name="cpa_id" id="cpa_id" value="<?=$cpa_data->id?>" />
				<div class="expert_details">

					<?php //if(isset($no_of_question_count)) { ?>
						<!-- <p style="text-align:right;"><span style="background-color:#3AFFFF;color:black;"> -->
						<!-- Available questions :  -->
						<?php //echo $no_of_question_count;?>
						<!-- </span></p> -->
					<?php //} ?>
					
					<div class="ed_profilepic">
						<?php $user_image = !empty($cpa_data->user_image) ? $cpa_data->user_image : base_url().'assets/images/unknown-512.png'; ?>
						<div class="edp_img" style="background-image: url('<?=$user_image?>');">
							<!--							<img src="//<?=$user_image?>" alt="profile_pic" />-->
						</div>
						
					</div>
					<div class="ed_profiledet">
						<?php if($cpa_data->active == 1 OR !empty($cpa_data->device_type)){ ?>
						<div>
							<span style="color:#2fc659;">Online </span>
						</div>
						
						<?php }else{ ?>	
							<span style="color:#ed0b0b;">Offline</span>
						<?php } ?>
						<div class="ed_title">
							<h3><?php echo $cpa_data->first_name.' '.$cpa_data->last_name?></h3>
						</div>
						<div class="ed_title divider"></div>
						<!-- box reviews content -->
						<div class="ecb_reviews">
							<div class="ecbd_review">
								<div class="ecb_icon">
									<?php for($i=1; $i<=$review_data['avg_ratting']; $i++) { ?>
										<i class="fill-up fa fa-star"></i>
									<?php } ?>
									<?php for($i=1; $i<=$review_data['half_star']; $i++) { ?>
										<i class="fill-up fa fa-star-half-o"></i>
									<?php } ?>

									<?php for($i=1; $i<=$review_data['inactive_rate']; $i++) { ?>
										<i class="fa fa-star-o"></i>
										
									<?php } ?>
								</div>
								<div class="ecb_content">
									<p><a href="<?=base_url().'ticket_details/show_review/'.$cpa_data->id?>"><?=$review_data['count_review']?> Reviews</a></p>
								</div>
							</div>
						</div>
						<div class="ecb_reviews divider"></div>
						<!-- end reviews content -->
						<div class="ed_content">
							<p style="word-wrap: break-word;"><?=$cpa_data->cpa_description?></p>
						</div>
						<div class="ed_content divider"></div>
					</div>
					<div class="ed_service">
						<div class="ed_title green">
							<h3>Services</h3>
						</div>
						<div class="ed_title divider"></div>
						<div class="eds_content">
							<ul class="p-0 list-unstyled text-left">
							<?php if(!empty($cpa_data->cpa_service)) { ?>
								<li><?=$cpa_data->cpa_service?></li>
								<!-- <li><i class="fa fa-check" aria-hidden="true"></i>Personal Returns</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>Partnership Returns</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>Corporation Returns</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>Estate Returns</li>
								<li><i class="fa fa-check" aria-hidden="true"></i>Business Consulting</li> -->
							<?php } ?>	
							</ul>
						</div>
						<div class="ed_content divider"></div>
					</div>
					
					<div class="ed_question">
						<div class="ed_title green">
							<h3>Ask Question as</h3>


							
							
							<?php if($no_of_question_count == 0){ ?>	
							   <a href="/pack_list" >Buy Packages</a>
							<?php }?>
						
						</div>
						<div class="ed_title divider"></div>
						
						<?php if($no_of_question_count > 0){ ?>		
						
						<div class="edq_content">
							<ul class="edq_box row nav nav-tabs">
								<li class="edqb_box nav-item col-lg-4 col-md-4 col-sm-4 col-4">
									<a class="nav-link active" data-toggle="tab" href="#text" id="text_button">
										<div class="edq_img">
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
										</div>
										<div class="edq_text">
											<p>Text</p>
										</div>
									</a>
								</li>
								<li class="edqb_box nav-item col-lg-4 col-md-4 col-sm-4 col-4">
									<a class="nav-link" data-toggle="tab" href="#audio" id="audio_button">
										<div class="edq_img">
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
										</div>
										<div class="edq_text">
											<p>Audio</p>
										</div>
									</a>
								</li>
								
								<li class="edqb_box nav-item col-lg-4 col-md-4 col-sm-4 col-4">
									
									<a class="nav-link" data-toggle="tab" href="#video_view" id="video_button">
										<div class="edq_img">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 82.143 81.429">
												<g>
													<path d="M76.071,18.096c-0.719-0.375-1.594-0.336-2.276,0.101l-19.131,12.25v-5.058c0-4.142-3.486-7.512-7.771-7.512
															H12.529c-4.286,0-7.771,3.37-7.771,7.512V58.61c0,4.143,3.486,7.513,7.771,7.513h34.363c4.285,0,7.771-3.37,7.771-7.513v-5.056
															l19.131,12.25c0.371,0.236,0.798,0.356,1.227,0.356c0.361,0,0.721-0.086,1.05-0.255c0.721-0.376,1.171-1.101,1.171-1.893V19.985
															C77.242,19.196,76.792,18.469,76.071,18.096z M50.224,34.443v15.116v9.052c0,1.774-1.495,3.22-3.331,3.22H12.529
															c-1.838,0-3.331-1.445-3.331-3.22V25.389c0-1.773,1.493-3.219,3.331-3.219h34.363c1.836,0,3.331,1.446,3.331,3.219V34.443z
															 M72.802,60.018L54.664,48.404V35.597l18.138-11.615V60.018z M16.761,25.756c-2.651,0-4.8,2.078-4.8,4.642s2.149,4.642,4.8,4.642
															c2.651,0,4.801-2.078,4.801-4.642S19.413,25.756,16.761,25.756z" />
												</g>
											</svg>
										</div>
										<div class="edq_text">
											<p>Video</p>
										</div>
									</a>
									
									<!-- <a class="nav-link" data-toggle="tab">
										<div class="edq_img">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 82.143 81.429">
												<g>
													<path d="M76.071,18.096c-0.719-0.375-1.594-0.336-2.276,0.101l-19.131,12.25v-5.058c0-4.142-3.486-7.512-7.771-7.512
															H12.529c-4.286,0-7.771,3.37-7.771,7.512V58.61c0,4.143,3.486,7.513,7.771,7.513h34.363c4.285,0,7.771-3.37,7.771-7.513v-5.056
															l19.131,12.25c0.371,0.236,0.798,0.356,1.227,0.356c0.361,0,0.721-0.086,1.05-0.255c0.721-0.376,1.171-1.101,1.171-1.893V19.985
															C77.242,19.196,76.792,18.469,76.071,18.096z M50.224,34.443v15.116v9.052c0,1.774-1.495,3.22-3.331,3.22H12.529
															c-1.838,0-3.331-1.445-3.331-3.22V25.389c0-1.773,1.493-3.219,3.331-3.219h34.363c1.836,0,3.331,1.446,3.331,3.219V34.443z
															 M72.802,60.018L54.664,48.404V35.597l18.138-11.615V60.018z M16.761,25.756c-2.651,0-4.8,2.078-4.8,4.642s2.149,4.642,4.8,4.642
															c2.651,0,4.801-2.078,4.801-4.642S19.413,25.756,16.761,25.756z" />
												</g>
											</svg>
										</div>
										<div class="edq_text">
											<p>Video</p>
										</div>
									</a> -->
									
								</li>
								
							</ul>
						</div>
						
							<?php } ?>			


						<div class="edq_tab_content tab-content text-left">
							<?php $land_quas = $this->session->userdata('land_quas'); ?>
							
							<?php if($no_of_question_count > 0){ ?>	
							
							<div id="text" class="container tab-pane active">
								<form action="#" method="post">
									<div class="form-group">
										<p class="validation" style="color: red;"></p>
										<label for="ques">Question *</label>
										<textarea class="form-control text_question" id="ques" placeholder="Write your question" name="ques" required><?=isset($land_quas) ? $land_quas : ''?></textarea>
									</div>
									<div class="edqc_btn">
										<button type="button" class="btn btn-primary add_question">Submit</button>
										</br>
									
										</br>
										<?php if(isset($no_of_question_count)) { ?>
										<p>Available questions : <?php echo $no_of_question_count;?></p>
										<?php } ?>
									</div>
								</form>
							</div>
							<?php } ?>		

							<div id="audio" class="container tab-pane fade text-center">
								<form action="" method="get">
									<div class="form-group m-0">
										<label for="ques">Question *</label>
									</div>
									<div class="edqc_icon">
										<div class="icn audio_btn mic_icon">
											<button type="button" id="recordButton">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
													<path d="M382.725,247.552c-4.662,0-8.449,3.774-8.449,8.448v50.689c0,65.219-53.057,118.276-118.275,118.276
	c-65.223,0-118.276-53.058-118.276-118.276V256c0-4.674-3.787-8.448-8.448-8.448s-8.448,3.774-8.448,8.448v50.689
	c0,71.687,56.13,130.346,126.724,134.743v42.671h-42.241c-4.662,0-8.448,3.778-8.448,8.448s3.787,8.448,8.448,8.448h101.379
	c4.662,0,8.448-3.778,8.448-8.448s-3.786-8.448-8.448-8.448h-42.241v-42.671c70.598-4.397,126.724-63.064,126.724-134.743V256
	C391.172,251.326,387.386,247.552,382.725,247.552" />
	<path d="M256,399.621c51.242,0,92.931-41.689,92.931-92.932V103.931C348.931,52.692,307.242,11,256,11
	c-51.238,0-92.931,41.692-92.931,92.931v202.759C163.069,357.932,204.762,399.621,256,399.621 M179.966,103.931
	c0-41.928,34.114-76.034,76.034-76.034s76.034,34.106,76.034,76.034v202.759c0,41.928-34.114,76.035-76.034,76.035
	s-76.034-34.107-76.034-76.035V103.931z" />
												</svg>
											</button>
										</div>

									</div>

									<div class="edqc_note">
										<p>Click to record your question</p>
										<?php if(isset($no_of_question_count)) { ?>
										<p>Available questions : <?php echo $no_of_question_count;?></p>
										</br>
										<?php } ?>
									</div>
									<div class="status_record">
									</div>
									<!-- Record audio -->
									<input type="hidden" name="user_role" id="user_role" value="4"/>
									<div class="show_record" style="display:none">
										<div id="controls">
											<button type="button" id="pauseButton" disabled><i class="fa fa-pause-circle" aria-hidden="true"></i></button>

											<!-- <div ></div> -->

											<button type="button" id="stopButton" disabled><i class="fa fa-stop-circle" aria-hidden="true"></i></button>
										</div>
										<div id="formats"></div>
										<ol id="recordingsList"></ol>
									</div>
									<div class="status_record1" style="margin-top: -25px;"></div>
									<!-- End Record audio -->
								</form>
							</div>
							<div id="video_view" class="container tab-pane fade  text-center">
								
							<?php if($cpa_data->active == 1 OR !empty($cpa_data->device_type)) { ?> 

								<form action="#" id="" method="post">
									<div class="form-group m-0">
										<label for="ques">Question *</label>

										<?php if(isset($no_of_question_count)) { ?>
										<p>Available questions : <?php echo $no_of_question_count;?></p>
										</br>
										<?php } ?>

									</div>
									
									<!-- Video call -->
										
									<div id="div_device" class="panel panel-default" style="display:none;">
										<div class="select">
											<label for="audioSource">Audio source: </label>
											<select id="audioSource"></select>
										</div>
										<div class="select">
											<label for="videoSource">Video source: </label>
											<select id="videoSource"></select>
										</div>
									</div>
									<div id="div_join" class="panel panel-default">
										<div class="panel-body">
											<input id="appId" type="hidden" value="<?=application_id?>" size="36"></input>
											<input id="channel" type="hidden" value="<?=$cpa_data->id?>" size="4"></input>
											<input id="video" type="hidden" checked></input>
											<button type="button" id="join" class="btn btn-primary">Call</button>
											<button type="button" id="call_can" class="btn btn-danger">cancel</button>
										</div>
										<p class="call_cut_msg" style="color:red"></p>
									</div>
									<div class="loader_section" style="margin-top: 25px; display: none;">
										<img class="call_loader" src="<?=base_url().'assets/images/301.gif'?>" style="width: 50%; float:unset !important;"/>
									</div>
									
										<!-- Video call End -->
								</form>

							<?php }else{ ?> 
								<p style="color: #203569"><?=$cpa_data->first_name.' '.$cpa_data->last_name?> is offline at the moment. But you can send your question via Text or Audio.</p>
							<?php } ?>	
						
							</div>
						</div>
						<div id="video" class="pos_video" style="">
							<button type="button" id="leave" class="btn btn-primary" style="display:none;">Leave</button>
							<div id="agora_local" style="display: none;"></div>
						</div>	
					</div>
					<!-- <div class="row">
						<div class="col-sm-12">
							<h4 style="margin-top: 25px;">$9.99</h4>
						</div>
					</div> -->
					<div class="row">
						<div class="col-sm-12" style="margin-top: 20px;">
						<!-- <p class="paym_turm"><span style="color:red;">Important Notice* Payment will be processed in full upon submission of the answer to your query by the CPA. A response in 24 hours is guaranteed or the answer is free.</span></p> -->
						<p class="paym_turm"><span style="color:red;">The typical response time is 12-24 hrs, but can take up to 72 hrs depending on the complexity and extent of your question.</span></p>
						</div>	
					</div>
				
				</div>

			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$('#text_button').click(function(){
		//var inner_html = "<span style='color:red;''>Important Notice* Payment will be processed in full upon submission of the answer to your query by the CPA. A response in 24 hours is guaranteed or the answer is free.</span>";
		var inner_html = "<span style='color:red;''>The typical response time is 12-24 hrs, but can take up to 72 hrs depending on the complexity and extent of your question.</span>";
		$('.paym_turm').html(inner_html);
	});
	$('#audio_button').click(function(){
		var inner_html = "<span style='color:red;''>The typical response time is 12-24 hrs, but can take up to 72 hrs depending on the complexity and extent of your question.</span>";
		$('.paym_turm').html(inner_html);
	});
	$('#video_button').click(function(){
		//var inner_html = "<span style='color:red;''>Important Notice* A video call with a CPA will be initiated. It may take a few minutes for a CPA to respond. Please stay on this page. Payment will be processed in full upon completion of the call.</span>";
		var inner_html = "<span style='color:red;''>Important Notice* A video call with a CPA will be initiated. It may take a few minutes for a CPA to respond. Please stay on this page.</span>";
		$('.paym_turm').html(inner_html);
	});
	
</script>


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

	.paym_turm{
		color: #203569;
		font-size: 12px;	
	}
	#agora_local{
		/*float:right;*/
		width:210px;
		height:147px;
		display:inline-block;
		position: absolute;
		z-index: 99999;
		margin:30px auto;
	}
	#agora_local video{
		position: unset !important;
	}
	.second_video video{
		position: unset !important;
	}
	.second_video{
		/*float:left; */
		width:810px;
		height:607px;
		display:inline-block;
    	margin-top: 30px;
    	box-shadow: 0 0 18px 5px;
	}
	.pos_video{
		margin: 0 auto;
	    /*position: fixed;*/
	    top: 0;
	    right: 0;
	    bottom: 0;
	    z-index: 999;
	    background: #0009;
	    left: 0;	
	    /*display: none;		*/
	}
	#leave{
		position: absolute;
    	right: 48%;
    	bottom: 3%;
    	z-index: 999;
	}
</style>

<!-- <div class="creditCardForm">
           
        </div> -->


<div class="modal fade" id="ticket_conform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> -->
			<div class="modal-header justify-content-center">
				<h5 class="modal-title" id="exampleModalLabel">Question confirmation</h5>
			</div>
			<div class="modal-title divider"></div>
			<div class="modal-body text-center">
				<div class="modal_content text-left">
					<!-- <h5>Dear customer,</h5> -->
					<div class="mbc_text">
						<p>Your question has been submitted successfully. </p>
						<p>You can check the status of your question in "My Questions"</p>
					</div>
					<div class="mbc_ticket text-center">
						<p>Question number</p>
						<h6 class="tic_show">5535878</h6>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary close_ticket" data-dismiss="modal">Done</button>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stripe.css'); ?>" media="all" />


<div class="modal fade" id="add_card_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-header justify-content-center">
				<h5 class="modal-title" id="exampleModalLabel">Add Card Details</h5>
			</div>
			<div class="modal-title divider"></div>
			
			<form action="#" id="add_card_data" method="POST">
				<input type="hidden" name="pay_question" id="pay_question" value=""/>
				<input type="hidden" name="pay_cpa_id" id="pay_cpa_id" value=""/>
				<input type="hidden" name="qus_status" id="qus_status" value=""/>
				<div class="modal-body text-center">
					<p class="card_validation" style="color: red;"></p>
					<div class="payment">
						<div class="form-group" id="card-number-field">
							<label for="cardNumber">Card Number</label>
							<input type="text" class="form-control" name="card_number" id="cardNumber" required>
						</div>
						<div class="form-group" id="expiration-date">
							<label>Exp Month</label>
							<select name="exp_month" class="form-control">
								<option value="01">January</option>
								<option value="02">February </option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
						</div>	
						<div class="form-group" id="expiration-date">	
							<label>Exp Year</label>
							<select name="exp_year" class="form-control">
							<?php foreach($year_list AS $val) { ?>
								<option value="<?=substr($val, -2)?>"><?=$val?></option>
							<?php } ?>	
							</select>
						</div>

						<div class="form-group CVV">
							<label for="cvv">CVV</label>
							<input type="password" class="form-control" id="cvv" name="cvv_no" required>
						</div>
						<!--  <div class="form-group" id="credit_cards">
		                        <img src="assets/images/visa.jpg" id="visa">
		                        <img src="assets/images/mastercard.jpg" id="mastercard">
		                        <img src="assets/images/amex.jpg" id="amex">
		                    </div> -->
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<button type="submit" class="btn btn-secondary">Done</button>
				</div>
				<div class="footer_cont"><p>Processed by Stripe. CPA2GO doesn't store your payment info</p></div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="video_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button> -->
			<div class="modal-header justify-content-center">
				<h5 class="modal-title" id="exampleModalLabel">Video Call</h5>
			</div>
			<div class="modal-body text-center">
				<form>

					<div class="form-group" id="card-number-field">
						<label for="cardNumber">Description</label>
						<textarea name="cpa_video_desc" class="form-control" id="cpa_video_desc"></textarea>
					</div>
					<p class="dec_valid" style="color:red;"></p>
					<div class="modal-footer justify-content-center">
						<button type="button" class="btn btn-secondary" id="save_des">Save</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>


<!-- <div class="modal fade" id="write_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<h5 class="modal-title" id="exampleModalLabel">How Was Your Experience?</h5>
			</div>
			<div class="modal-body text-center">
				<div class="modal_content text-center">
					<form action="#" method="post">
						<input type="hidden" value="5" name="ratting_no" class="ratting_val" />
						<input type="hidden" name="ticket_number" id="ticket_numbers" value="" />
						<input type="hidden" name="tickets_id" id="tickets_id" value=""/>
						<input type="hidden" name="cpa_id" id="cpa_ids" value="" />
						<input type="hidden" name="customer_id" id="customer_ids" value="" />
						<div class="mbc_img">
							<div class="edp_img" style="background-image: url(<?=base_url()?>assets/front/image/ed_profile.png);">
							</div>
						</div>
						<div class="mbc_title">
							<h5>Mao Miler</h5>
						</div>
						<p class="star_val" style="color:red"></p>
						<div class="mbc_review">

							<?php for($i=1; $i<=5; $i++){ ?>
							<i class="inactive" id="ratting-<?=$i?>">
								<svg fill="none" stroke="#9A9A99" stroke-miterlimit="10" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 57 51.5">
									<path d="M41.26,46.508c-0.642,0-1.26-0.15-1.836-0.447l-9.319-4.792c-0.137-0.069-0.33-0.069-0.467,0.001l-9.318,4.791
	c-1.63,0.836-3.676,0.445-4.865-0.938c-0.758-0.878-1.064-1.991-0.863-3.133l1.778-10.146c0.028-0.159-0.027-0.321-0.146-0.435
	l-7.538-7.186c-1.083-1.033-1.466-2.549-0.999-3.957c0.469-1.409,1.69-2.416,3.188-2.628l10.419-1.48
	c0.163-0.023,0.304-0.124,0.377-0.268l4.659-9.234c0.67-1.327,2.026-2.152,3.54-2.152c1.515,0,2.872,0.825,3.541,2.152l4.658,9.232
	c0.073,0.144,0.213,0.244,0.377,0.267l10.42,1.481c1.498,0.213,2.719,1.22,3.188,2.628c0.467,1.409,0.084,2.925-0.998,3.958
	l-7.539,7.187c-0.119,0.113-0.174,0.275-0.146,0.435l1.779,10.147c0.203,1.141-0.104,2.254-0.864,3.134
	C43.529,46.004,42.427,46.508,41.26,46.508z" />
								</svg>
							</i>
							<?php } ?>

						</div>
						<div class="mbc_textarea">
							<div class="form_content form-group m-0">
								<textarea class="form-control" name="description" id="description" placeholder="Write your feedback and suggestion..." maxlength="500" required></textarea>
							</div>
						</div>
						
						<div class="form_content form-group m-0 sub_btn">

							<button type="button" class="btn btn-secondary col-12" id="submit_rate">Submit</button>
						</div>	
						<div class="form_content button form-group m-0">	
							<button type="button" class="btn btn-secondary col-12" id="go_back" style="">Go Back</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div> -->


<div class="modal fade" id="write_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<h5 class="modal-title review_title" id="exampleModalLabel">How Was Your Experience ?</h5>
			</div>
			<div class="modal-body text-center">
				<div class="modal_content text-center">
					<form action="#" method="post">
						<input type="hidden" value="5" name="ratting_no" class="ratting_val" />
						<input type="hidden" name="ticket_number" id="ticket_numbers" value="" />
						<input type="hidden" name="tickets_id" id="tickets_id" value=""/>
						<input type="hidden" name="cpa_id" id="cpa_ids" value="" />
						<input type="hidden" name="customer_id" id="customer_ids" value="" />
						<div class="mbc_img">
							<div class="edp_img" style="background-image: url(<?=base_url()?>assets/front/image/ed_profile.png);">
							</div>
						</div>
						<div class="mbc_title">
							<h5>Mao Miler</h5>
						</div>
						<p class="star_val" style="color:red"></p>
						<div class="mbc_review">
							<span class="my-rating-9"></span>
						</div>
						<div class="mbc_textarea">
							<div class="form_content form-group m-0">
								<textarea class="form-control" name="description" id="description" placeholder="Write your feedback and suggestion..." maxlength="500" required></textarea>
							</div>
						</div>
						
						<div class="form_content form-group m-0 sub_btn">

							<button type="button" class="btn btn-secondary col-12" id="submit_rate">Submit</button>
						</div>	
						<div class="form_content button form-group m-0">	
							<button type="button" class="btn btn-secondary col-12" id="go_back" style="">Go Back</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="charges_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<!-- <h5 class="modal-title" id="exampleModalLabel">You will be charged $9.99</h5> -->
				<h5 class="modal-title" id="exampleModalLabel">Are you sure want to do this?</h5>
			</div>
			<div class="modal-body text-center">
				<div class="modal_content text-center">
					
						<input type="hidden" value="" name="" class="text_question" />
						<input type="hidden" value="" name="" class="cpa_id"/>
						<input type="hidden" value="" name="" class="pay_customer_id"/>
						
						
						<div class="form_content form-group m-0 sub_btn">

							<button type="button" class="btn btn-secondary col-12 save_question" id="">Agree</button>
						</div>	
						<div class="form_content button form-group m-0">	
							<button type="button" class="btn btn-secondary col-12 close_charges_popup" id="" style="">Cancel</button>
						</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="music"></div>
 



<style type="text/css">
	.review_title{
		font-size: 20px !important;
	}
	
	.mbc_title h5{
		font-size: 14px !important;
	}
	#submit_rate{
		font-size: 15px !important;
		padding: 5px 5px !important;
		background-color: #2fc659;
		border: none;
	}
	.sub_btn{
		margin-bottom: 0 !important;
	}
	#go_back{
		font-size: 15px !important;
		padding: 5px 5px !important;
	}
	.footer_cont p{
		text-align: center;
    	font-size: 12px;
	}
</style>

<script src="<?=base_url()?>assets/front/js/jquery.payform.min.js" charset="utf-8"></script>
<script src="<?=base_url()?>assets/front/js/script.js"></script>

<script type="text/javascript">

	$(document).on('click', '.close_charges_popup', function(){
		$('#charges_popup').modal('toggle');
		$('#charges_popup').modal('hide');
		return false;
	});

	$(document).on('click', '.add_question', function() {

		var text_question = $('.text_question').val();
		var cpa_id = $('#cpa_id').val();
		var pay_customer_id = $('#pay_customer_id').val();
		$('.text_question').val(text_question);
		$('.cpa_id').val(cpa_id);
		$('.pay_customer_id').val(pay_customer_id);
		$('#charges_popup').modal('toggle');
		$('#charges_popup').modal('show');
		return false;
	})

	$(document).on('click', '.save_question', function() {
		//$('.add_question').prop('disabled', true);
		$('#charges_popup').modal('toggle');
		$('#charges_popup').modal('hide');
		var text_question = $('.text_question').val();
		var cpa_id = $('#cpa_id').val();
		var pay_customer_id = $('#pay_customer_id').val();
		if (text_question == '') {
			$('.validation').show();
			$('.validation').html('Please enter the question');
			setTimeout(function() {
				$('.validation').slideUp();
			}, 5000);
			return false;
		}
		// if (pay_customer_id == '') {
		// 	$('#pay_question').val(text_question);
		// 	$('#pay_cpa_id').val(cpa_id);
		// 	$('#qus_status').val('1');
		// 	$('#add_card_details').modal('toggle');
		// 	$('#add_card_details').modal('show');
		// 	return false;
		// 	//add_card_details();
		// }
		var url = '<?=base_url()?>' + 'question_answer/add_question';
		$('.loader').show();
		$.ajax({
			url: url,
			type: "POST",
			data: {
				'cpa_id': cpa_id,
				'text_question': text_question
			},
			success: function(response) {
				$('.loader').hide();
				$('.tic_show').html(response);
				$('#ticket_conform').modal({backdrop: 'static', keyboard: false});
				$('#ticket_conform').modal('toggle');
				$('#ticket_conform').modal('show');
			}
		});
	});


	$('#add_card_data').submit(function(e) {

		e.preventDefault();
		var all_data = $('#add_card_data').serialize();
		var url = '<?=base_url()?>' + 'question_answer/add_card_details';
		$.ajax({
			url: url,
			type: "POST",
			data: all_data,
			success: function(response) {
				var data = JSON.parse(response);
				if(data.status == 3){
					location.reload();
				}
				if(data.status == 1){

					$('#add_card_details').modal('toggle');
					$('#add_card_details').modal('hide');
					setTimeout(function() {
						$('.tic_show').html(data.ticket_num);
						$('#ticket_conform').modal('toggle');
						$('#ticket_conform').modal('show');
					}, 1000);
					return false;
				}
				if(data.status == 0){
					$('.card_validation').show();
					$('.card_validation').html(data.msg);
					setTimeout(function() {
						$('.card_validation').slideUp();
					}, 5000);
					return false;
				}
			}
		});
	});

	$('.close_ticket').click(function() {
		//location.reload();
		window.location.href = '<?=base_url()?>' + 'get_customer_ticket';
	});

	$(document).on('click', '.audio_btn', function() {
		$('.show_record').css('display', 'block');
	});

	$(document).on('click', '.clear_upld', function(){
		location.reload();
	});

	$(document).on('click', '#join', function(){
		var cpa_id = $('#cpa_id').val();

		var pay_customer_id = $('#pay_customer_id').val();
		if (pay_customer_id == '') {
			$('#pay_cpa_id').val(cpa_id);
			$('#qus_status').val('3');
			$('#add_card_details').modal('toggle');
			$('#add_card_details').modal('show');
			return false;
			//add_card_details();
		}
		var url = '<?=base_url()?>' + 'question_answer/add_video_data';
	    $.ajax({
	      	url: url,
	      	type: "POST",
	      	data: {
	        	'cpa_id': cpa_id
	      	},
	      	success: function(response) {
	      		if(response == 1){
	      			alert('Already call start please wait');
	      			return false;
	      		}else{
	      			$('.loader_section').css('display','block');
	      			$('.music').html('<audio id="myAudio" loop autoplay> <source src="<?=base_url()?>assets/audio/simple-ringtone-25290.mp3" type="audio/wav"></audio>');
	      			
	      			join();
	      		}
	      	}
	    });
		
	})
	$(document).on('click', '#leave', function(){

		$('.loader_section').css('display','none');
		var cpa_id = $('#cpa_id').val();
		var url = '<?=base_url()?>' + 'question_answer/create_video_tickets';
	    $.ajax({
	      	url: url,
	      	type: "POST",
	      	data: {
	        	'cpa_id': cpa_id
	      	},
	      	success: function(response) {
	      		$('#agora_local').html('');
	      		$('#agora_local').next().remove();
	      		leave();
	      		$('#video_info').modal({backdrop: 'static', keyboard: false});
			    $('#video_info').modal('toggle');
			    $('#video_info').modal('show');
	      	}
	    });
	})

	var call_fun = setInterval(function(){video_call_cut();},500);
	function video_call_cut(){
		var url = '<?=base_url()?>'+'question_answer/cut_video_call_user';
		$.ajax({
			url: url,
			type: "POST",
			success: function(response) {
				console.log(response);
				if(response == 1){
					var player = document.getElementById('myAudio');
					console.log(player);
					if(player != null){
						player.pause();
				    	player.src = player.src;
				    	$('.music').html('');
					}
					$('.loader_section').css('display','none');
					$('.call_cut_msg').html('CPA disconnected the call. Please try calling after some time.');
					setTimeout(function(){
						$('.call_cut_msg').html('');
						location.reload();
					},5000);
					clearInterval(call_fun);
				}	
			}
		});
	}



	$(document).on('click', '#save_des', function(){
		var desc = $('#cpa_video_desc').val();
		if(desc == ''){
			$('.dec_valid').html('Please enter the description');
			setTimeout(function() {
				$('.dec_valid').slideUp();
			}, 5000);	
			return false;		
		}
		var url = '<?=base_url()?>'+'question_answer/update_description_video_cpa';
		$.ajax({
			url: url,
			type: "POST",
			data: {'desc':desc},
			success: function(response) {
				
				var all_data = JSON.parse(response);
				//		        	var html_image = '<img src="'+all_data.user_image+'" alt="profile_pic">';
				var html_title = '<h5>' + all_data.first_name + ' ' + all_data.last_name + '</h5>';
				$('.edp_img').css("background-image", "url(" + all_data.user_image + ")");
				$('.mbc_title').html(html_title);
				$('#ticket_numbers').val(all_data.ticket_number);
				$('#tickets_id').val(all_data.ticket_id);
				$('#cpa_ids').val(all_data.cpa_id);
				$('#customer_ids').val(all_data.customer_id);

				$('#video_info').modal('toggle');
				$('#video_info').modal('hide');
					
				setTimeout(function() {
					$('#write_review').modal({backdrop: 'static', keyboard: false});
					$('#write_review').modal('toggle');
					$('#write_review').modal('show');
				}, 100);	
			}
		});		
			
	});

	$(document).on('click', '#submit_rate', function() {

		var ratting_val = $('.ratting_val').val();
		
		
		if(ratting_val == '' || ratting_val == 0){
			$('.star_val').html('Please submit rating and write your feedback');
			return false;
		}
		var ticket_number = $('#ticket_numbers').val();
		var tickets_id = $('#tickets_id').val();
		var cpa_id = $('#cpa_ids').val();
		var customer_id = $('#customer_ids').val();
		var description = $('#description').val();

		var url = '<?=base_url()?>' + 'ticket_details/submit_ratting';
		$.ajax({
			url: url,
			type: "POST",
			data: {
				'ratting_no': ratting_val,
				'ticket_number': ticket_number,
				'tickets_id': tickets_id,
				'cpa_id': cpa_id,
				'customer_id': customer_id,
				'description': description
			},
			success: function(response) {

				window.location.href = '<?=base_url()?>' + 'ticket_details/show_review/' + cpa_id;

				//      	$('#write_review').modal('toggle');
				// $('#write_review').modal('hide');
			}
		});
	});

	$(document).on('click', '#call_can', function(){
		// var player = document.getElementById('myAudio');
		// console.log(player);
		// if(player != null){
		// 	player.pause();
	 //    	player.src = player.src;
	 //    	$('.music').html('');
		// }
		location.reload();
	});

	$(document).on('click','#go_back', function(){
		window.location.href = '<?=base_url()?>' + 'get_customer_ticket';
	});

	var cpa_audio = 'no'; 
	var url_path = "<?=base_url()?>";

	// $('#ratting-1').click(function() {
	// 	var className = $('#ratting-1').attr('class');
	// 	if (className == 'inactive') {
	// 		$("#ratting-1").attr('class', 'active');
	// 		$('.ratting_val').val(1);
	// 	} else {
	// 		$("#ratting-1").attr('class', 'inactive');
	// 		$("#ratting-2").attr('class', 'inactive');
	// 		$("#ratting-3").attr('class', 'inactive');
	// 		$("#ratting-4").attr('class', 'inactive');
	// 		$("#ratting-5").attr('class', 'inactive');
	// 		$('.ratting_val').val(0);
	// 	}
	// });
	// $('#ratting-2').click(function() {
	// 	var className = $('#ratting-2').attr('class');
	// 	if (className == 'inactive') {
	// 		$("#ratting-1").attr('class', 'active');
	// 		$("#ratting-2").attr('class', 'active');
	// 		$('.ratting_val').val(2);
	// 	} else {
	// 		$("#ratting-2").attr('class', 'inactive');
	// 		$("#ratting-3").attr('class', 'inactive');
	// 		$("#ratting-4").attr('class', 'inactive');
	// 		$("#ratting-5").attr('class', 'inactive');
	// 		$('.ratting_val').val(1);
	// 	}
	// });
	// $('#ratting-3').click(function() {
	// 	var className = $('#ratting-3').attr('class');
	// 	if (className == 'inactive') {
	// 		$("#ratting-1").attr('class', 'active');
	// 		$("#ratting-2").attr('class', 'active');
	// 		$("#ratting-3").attr('class', 'active');
	// 		$('.ratting_val').val(3);
	// 	} else {
	// 		$("#ratting-3").attr('class', 'inactive');
	// 		$("#ratting-4").attr('class', 'inactive');
	// 		$("#ratting-5").attr('class', 'inactive');
	// 		$('.ratting_val').val(2);
	// 	}
	// });
	// $('#ratting-4').click(function() {
	// 	var className = $('#ratting-4').attr('class');
	// 	if (className == 'inactive') {
	// 		$("#ratting-1").attr('class', 'active');
	// 		$("#ratting-2").attr('class', 'active');
	// 		$("#ratting-3").attr('class', 'active');
	// 		$("#ratting-4").attr('class', 'active');
	// 		$('.ratting_val').val(4);
	// 	} else {
	// 		$("#ratting-4").attr('class', 'inactive');
	// 		$("#ratting-5").attr('class', 'inactive');
	// 		$('.ratting_val').val(3);
	// 	}
	// });
	// $('#ratting-5').click(function() {
	// 	var className = $('#ratting-5').attr('class');
	// 	if (className == 'inactive') {
	// 		$("#ratting-1").attr('class', 'active');
	// 		$("#ratting-2").attr('class', 'active');
	// 		$("#ratting-3").attr('class', 'active');
	// 		$("#ratting-4").attr('class', 'active');
	// 		$("#ratting-5").attr('class', 'active');
	// 		$('.ratting_val').val(5);
	// 	} else {
	// 		$("#ratting-5").attr('class', 'inactive');
	// 		$('.ratting_val').val(4);
	// 	}
	// });

</script>

<script>
$(function() {

  // basic use comes with defaults values
  	$(".my-rating").starRating({
    	initialRating: 4.0,
    	starSize: 25
  	});

  	$(".my-rating-2").starRating({
	    totalStars: 5,
	    starSize: 30,
	    starShape: 'rounded',
	    emptyColor: 'lightgray',
	    hoverColor: 'salmon',
	    activeColor: 'crimson',
	    useGradient: false
  	});

  	// example grabing rating from markup, and custom colors
  	$(".my-rating-4").starRating({
	    totalStars: 5,
	    starShape: 'rounded',
	    starSize: 40,
	    emptyColor: 'lightgray',
	    hoverColor: 'salmon',
	    activeColor: 'crimson',
	    useGradient: false
  	});

	// specify the gradient start and end for the selected stars
	$(".my-rating-5").starRating({
	    starSize: 80,
	    strokeWidth: 10,
	    strokeColor: 'black',
	    initialRating: 2,
	    starGradient: {
	      start: '#93BFE2',
	      end: '#105694'
	    },
  	});

  	$(".my-rating-6").starRating({
	    totalStars: 5,
	    emptyColor: 'lightgray',
	    hoverColor: 'slategray',
	    activeColor: 'cornflowerblue',
	    initialRating: 4,
	    strokeWidth: 0,
	    useGradient: false,
	    minRating: 1,
	    callback: function(currentRating, $el){
	      alert('rated ' +  currentRating);
	      console.log('DOM Element ', $el);
	    }
  	});

  	$(".my-rating-7").starRating({
	    initialRating: 4,
	    readOnly: true,
	    starShape: 'rounded'
  	});

  	$(".my-rating-8").starRating({
    	useFullStars: true
  	});

  	$(".my-rating-9").starRating({
	    initialRating: 5,
	    disableAfterRate: false,
	    onHover: function(currentIndex, currentRating, $el){
	      console.log('index: ', currentIndex, 'currentRating: ', currentRating, ' DOM element ', $el);
	      $('.ratting_val').val(currentIndex);
	    },
	    onLeave: function(currentIndex, currentRating, $el){
	      console.log('index: ', currentIndex, 'currentRating: ', currentRating, ' DOM element ', $el);
	      $('.ratting_val').val(currentRating);
	    }
  	});

});
</script>

<script src="<?= base_url('assets/front/ratting/js/jquery.star-rating-svg.js')?>"></script>	
	

<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="<?=base_url()?>assets/front/audio/app.js"></script>
<script src="<?=base_url()?>assets/front/video/video.js"></script>