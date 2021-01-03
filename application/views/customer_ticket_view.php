<!-- Content Section -->
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/front/ratting/css/star-rating-svg.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/front/ratting/css/demo.css')?>">


<div id="expert">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="expert_filter box_shadow_custom col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="ef_result">
						<p>Result : <?=$total_ticket?></p>
					</div>
					<div class="ef_filter">
						<select name="fill_status" id="fill_status">
							<option value="">All</option>
							<option value="1">In Queue</option>
							<option value="2">Answered</option>
							<option value="3">Closed</option>
						</select>
					</div>
				</div>
			</div>
			<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0 fill_cust_ticket">
				<!-- your Forloop here -->
				<?php foreach($ticket_data AS $key=>$val) { ?>
				<div class="ec_box d-inline-block col-lg-4 col-md-6 col-sm-12 col-12 text-left">
					<div class="my_ticket ecb_box box_shadow_custom">
						<!-- box detail content -->
						<div class="mt_details float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
							<div class="mtd_header float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
								<div class="mtdh_id float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
									<p>#<?=$val->ticket_number?></p>
								</div>
								<div class="mtdh_date float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
									<p><?=date('M-d-Y', strtotime($val->start_date))?></p>
								</div>
							</div>
							<div class="mtd_body float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
								<div class="float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
									<div class="mtdb_icon">

										<!-- Text -->
										<?php if($val->qus_type == 1){ ?>
										<div class="icon">
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
										<?php }elseif($val->qus_type == 2){ ?>
										<!-- Audio -->
										<div class="icon">
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

										<?php }else{ ?>
										<!-- Video -->

										<div class="icon">
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
										<?php } ?>
									</div>

									
									<div class="mtdb_status">
										<?php if($val->qus_states == 1 AND $val->ticket_status != 3){ ?>
										<p class="pending">In Queue</p>
										<?php }elseif($val->qus_states == 2 AND $val->ticket_status != 3){ ?>
										<p class="anws">Answered</p>
										<?php }elseif($val->ticket_status == 3){ ?>
										<p class="done">Closed</p>
										<?php } ?>
									</div>
									

								</div>
								<div class="float-left col-lg-6 col-md-6 col-sm-6 col-6 p-0">
									<div class="mtdb_name">
										<p>Expert</p>
										<p class="expert_name"><?php echo $val->first_name.' '.$val->last_name?></p>
									</div>
									
									<div class="mtdb_btn">
										<a href="javascript:;" data-id="<?=$val->id?>" class="btn tik_open">Open</a>
									</div>
									<?php if(empty($val->ratting_id) AND $val->ticket_status == 3 ){

										$user_image =  !empty($val->user_image) ? base_url().'uploads/user_images/'.$val->user_image : base_url().'assets/images/unknown-512.png';
									 ?>
										<a href="#" class="add_review" style="margin-left: 75px;" data-tktnumber="<?=$val->ticket_number?>" data-tktid="<?=$val->id?>" data-cpaid="<?=$val->cpa_id?>" data-custid="<?=$val->customer_id?>" data-name="<?=$val->first_name.' '.$val->last_name?>" data-image="<?=$user_image?>">Review</a>
									<?php } ?>
								</div>
							</div>
						</div>
						<!-- end detail content -->
					</div>
				</div>
				<?php } ?>
				<!-- end here -->

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ticket_open" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close ticket_close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body text-center">
				<div class="modal_content text-left show_answer">
					<div class="mbc_status text-right">
						<p class="pending">In Queue</p>
					</div>
					<div class="mbc_form form_div">
						<form action="" method="">
							<div class="form_content_height scroll_div">
								<div class="form_content form-group m-0">
									<label for="ques">Question *</label>
									<textarea class="form-control" id="ques" name="ques" readonly>I am paid by W2. What other options do I have?</textarea>
								</div>
								<div class="form_content expert_anws form-group m-0">
									<label for="anws">Answer</label>
									<textarea class="form-control" id="anws" name="anws" readonly>I am paid by W2. What other options do I have?I am paid by W2. What other options do I have?I am paid by W2. What other options do I have?I am paid by W2. What other options do I have?</textarea>
								</div>
							</div>
							<div class="form_content select form-group m-0">
								<label for="anws">Status</label>
								<select>
									<option>In Queue</option>
									<option>Answered</option>
									<option>Closed</option>
								</select>
							</div>
							<div class="form_content button form-group m-0">
								<button type="button" class="btn btn-secondary col-12">Done</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).on('click','.ticket_close',function(){
		$('.audio_data').remove();
	});
</script>

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
							
							<!-- <?php for($i=1; $i<=5; $i++){ ?>
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
 -->
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

<input type="hidden" value="<?= isset($tkt_id) ? $tkt_id : '' ?>" id="not_ticket_id"/>

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
	polygon[class^="svg-rated-"]{
		fill: #2fc659 !important; 
	}
</style>

<script type="text/javascript">
	$('#fill_status').change(function() {
		$('.loader').show();
		var status = $(this).val();
		var url = '<?=base_url()?>' + 'ticket_details/get_ticket_status';
		$.ajax({
			url: url,
			type: "POST",
			data: {
				'status': status
			},
			success: function(response) {
				$('.loader').hide();
				$('.fill_cust_ticket').html(response);
				var total_count = $('.total_count').val();
				if (total_count != undefined) {
					var html_inn = '<p>Result : ' + total_count + '</p>';
				} else {
					var html_inn = '<p>Result : 0</p>';
				}
				$('.ef_result').html(html_inn);
			}
		});
	});

	var ticket_id = $('#not_ticket_id').val(); //"<?=$tkt_id?>";
	
	if(ticket_id != ''){
		$(document).ready(function(){
			ticket_open_pop(ticket_id);
		});
	}
	
	
	$(document).on('click', '.tik_open', function() {
		var tik_id = $(this).attr('data-id');
		ticket_open_pop(tik_id);
	});

	function ticket_open_pop(tik_id){

		var url = '<?=base_url()?>' + 'ticket_details/get_single_ticket';
		$.ajax({
			url: url,
			type: "POST",
			data: {
				'tik_id': tik_id
			},
			success: function(response) {
				
				$('#ticket_open').modal({backdrop: 'static', keyboard: false});
				$('#ticket_open').modal('toggle');
				$('#ticket_open').modal('show');
				$('.show_answer').html(response);
			}
		});
	}

	$(document).on('click', '.change_status', function() {
		var ticket_id = $('#ticket_id').val();
		var cpa_id = $('#cpa_id').val();
		var ticket_number = $('#ticket_number').val();
		var customer_id = $('#customer_id').val();
		var url = '<?=base_url()?>' + 'ticket_details/change_status_cust';
		$.ajax({
			url: url,
			type: "POST",
			data: {
				'ticket_id': ticket_id,
				'cpa_id': cpa_id
			},
			success: function(response) {

				var all_data = JSON.parse(response);
				//		        	var html_image = '<img src="'+all_data.user_image+'" alt="profile_pic">';
				var html_title = '<h5>' + all_data.first_name + ' ' + all_data.last_name + '</h5>';
				$('.edp_img').css("background-image", "url(" + all_data.user_image + ")");
				$('.mbc_title').html(html_title);
				$('#ticket_numbers').val(ticket_number);
				$('#tickets_id').val(ticket_id);
				$('#cpa_ids').val(cpa_id);
				$('#customer_ids').val(customer_id);

				$('#ticket_open').modal('toggle');
				$('#ticket_open').modal('hide');

				setTimeout(function() {
					$('#write_review').modal({backdrop: 'static', keyboard: false});
					$('#write_review').modal('toggle');
					$('#write_review').modal('show');
				}, 100);

			}
		});
	});

	$(document).on('click', '.add_review', function(){
		
		var ticket_number = $(this).attr('data-tktnumber');		
		var ticket_id = $(this).attr('data-tktid');		
		var cpa_id = $(this).attr('data-cpaid');		
		var customer_id = $(this).attr('data-custid');		
		var user_name = $(this).attr('data-name');		
		var user_image = $(this).attr('data-image');		

		var html_title = '<h5>' + user_name + '</h5>';
		$('.edp_img').css("background-image", "url(" + user_image + ")");
		$('.mbc_title').html(html_title);
		$('#ticket_numbers').val(ticket_number);
		$('#tickets_id').val(ticket_id);
		$('#cpa_ids').val(cpa_id);
		$('#customer_ids').val(customer_id);

		$('#write_review').modal({backdrop: 'static', keyboard: false});
		$('#write_review').modal('toggle');
		$('#write_review').modal('show');
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

	$(document).on('click','#go_back', function(){
		window.location.href = '<?=base_url()?>' + 'get_customer_ticket';
	});

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