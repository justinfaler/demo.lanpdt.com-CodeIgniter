<!-- Content Section -->

<div id="expert">
	<div class="container">
		<div class="row">
			<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">

				<?php 
				$count = count($cpa_list);
				?>
				<?php if($count != 0){ ?>
				<div class="ec_box d-inline-block col-lg-12 col-md-12 col-sm-12 col-12 text-left">
					<div class="my_ticket ecb_box box_shadow_custom">
						<!-- box detail content -->
						<div class="mt_details float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
							<div class="mtd_body float-left col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="mtd_body_box float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
									<p class="title_name" style="text-align: center;"><strong>CPA’s available in your Area</strong></p>
								</div>	
							</div>	
						</div>	
					</div>
				</div>	
				<?php } ?>
				

				<!-- your Forloop here -->
				<?php foreach($cpa_list AS $key=>$val) { 

						// if (is_float($val->avg_ratting)){
						// 	echo 'float';
						// }else{
						// 	echo 'not float';
						// }

						//echo $number = $val->avg_ratting;
						$active_star = 0;
						$half_star = 0;
						$inactive_star = 0;
						if (strpos($val->avg_ratting,'.') !== false) {
							$active_star = ($val->avg_ratting-0.5);
							$half_star = 1;
							$inactive_star = (4 - $active_star);
						    //echo 'true';
						}else {
							$active_star = $val->avg_ratting;
							$inactive_star = (5 - $active_star);
						    
						}

						
						//echo $active_stars = $val->avg_ratting;
						//echo $inactive_stars = (5 - $active_stars);

						// $avg_ratting = 0;
						// if($val->avg_ratting == 1){
						// 	$avg_ratting = 1;
						// }
						// if($val->avg_ratting == 1.5){
						// 	$avg_ratting = 2;
						// }
						// if($val->avg_ratting == 2){
						// 	$avg_ratting = 2;
						// }
						// if($val->avg_ratting == 2.5){
						// 	$avg_ratting = 3;
						// }
						// if($val->avg_ratting == 3){
						// 	$avg_ratting = 3;
						// }
						// if($val->avg_ratting == 3.5){
						// 	$avg_ratting = 4;
						// }
						// if($val->avg_ratting == 4){
						// 	$avg_ratting = 4;
						// }
						// if($val->avg_ratting == 4.5){
						// 	$avg_ratting = 5;
						// }
						// if($val->avg_ratting == 5){
						// 	$avg_ratting = 5;
						// }

						// $active_star = $avg_ratting;
						// $inactive_star = (5 - $avg_ratting);
					?>
				<div class="ec_box d-inline-block col-lg-4 col-md-6 col-sm-12 col-12 text-left">
					<div class="ecb_box box_shadow_custom">
						<!-- box detail content -->
						<div class="ecb_details">
							<div class="ecbd_title">
								<div class="ecb_title">
									<h3 class="ecbt_title"><?php echo $val->first_name.' '.$val->last_name?></h3>
								</div>
								<?php if($val->active == 1 OR !empty($val->device_type)){ ?>
								<div>
									<span style="color:#2fc659;">Online </span>
								</div>
								<?php }else{ ?>	
									<span style="color:#ed0b0b;">Offline</span>
								<?php } ?>
								
								<div class="ecb_content">
								<?php 
									$string = strip_tags($val->cpa_description);
									if (strlen($string) > 50) {
									    $stringCut = substr($string, 0, 50);
									    $endPoint = strrpos($stringCut, ' ');
									    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
									    $string .= '...';
									}
								?>	

									<p style="word-wrap: break-word;"><?=$string?></p>
								</div>
							</div>
							<div class="ecbd_img">
								<?php $user_image = !empty($val->user_image) ? $val->user_image : base_url().'assets/images/unknown-512.png'; ?>
								<div class="ecb_img" style="background-image: url('<?=$user_image?>');">
								</div>
							</div>
							
						</div>
						<!-- end detail content -->
						<!-- box reviews content -->
						<div class="ecb_reviews">
							<div class="ecbd_review">
								<div class="ecb_icon">
									<?php for($i=1; $i<=$active_star; $i++) { ?>
										<i class="fill-up fa fa-star"></i>
									<?php } ?>
									<?php for($i=1; $i<=$half_star; $i++) { ?>
										<i class="fill-up fa fa-star-half-o"></i>
									<?php } ?>
									<?php for($i=1; $i<=$inactive_star; $i++) { ?>
										<i class="un-fill-up fa fa-star-o"></i>
									<?php } ?>
								</div>
								<div class="ecb_content">
									<p><?=$val->count_review?> Reviews</p>
								</div>
							</div>
							<div class="ecbd_btn">
								<a href="<?=base_url().'get_cpa_details/'.$val->id?>" class="det_btn">Details</a>
								<a href="<?=base_url().'get_cpa_details/'.$val->id?>" class="ecbd_last_btn">Ask a Question</a>
							</div>
							
						</div>
						<!-- end reviews content -->
					</div>
				</div>
				<?php } ?>
				<!-- end here -->
				<!-- your Forloop here -->

				<?php if($count == 0) { ?>
				<div class="ec_box d-inline-block col-lg-12 col-md-12 col-sm-12 col-12 text-left">
					<div class="my_ticket ecb_box box_shadow_custom">
						<!-- box detail content -->
						<div class="mt_details float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
							<div class="mtd_body float-left col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="mtd_body_box float-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
									<p class="title_name">Welcome to CPA2GO. Unfortunately, at this point there are no CPA’s available in your region</p>
									<a href="<?=base_url().'customer_profile'?>" class="title_name1">Change Your ZIP</a>
								</div>	
							</div>	
						</div>	
					</div>
				</div>						
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php $land_quas = $this->session->userdata('land_quas'); 
	$land_quas = isset($land_quas) ? $land_quas : '';
?>

<div class="modal fade" id="landing_question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-header justify-content-center">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
			</div>
			<div class="modal-body text-center">
				<p>Your question is being saved, please proceed to selecting a CPA</p>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.det_btn{
		background-color: #808080 !important;
	}
</style>


<!-- <div style="text-align:right">
	<p>Current Question Count :<?php //echo $no_of_question_count;?>&nbsp;&nbsp;</p>
	<p>Expire Date : <?php //if(isset($plan_end_date)){ echo $plan_end_date; }else { echo "-";} ?> &nbsp;&nbsp;</p>
	<p>Expire Time : <?php //if(isset($plan_end_time)){ echo $plan_end_time; }else { echo "-";} ?> &nbsp;&nbsp;</p>
</div> -->

<script type="text/javascript">
	var land_quas = '<?=$land_quas?>';
	if(land_quas != ''){
		$('#landing_question').modal({backdrop: 'static', keyboard: false});
		$('#landing_question').modal('toggle');
		$('#landing_question').modal('show');
	}
</script>