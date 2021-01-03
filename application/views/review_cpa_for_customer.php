<!-- Content Section -->
<div id="expert">
	<div class="container">
		<div class="row">
			<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0 text-center">
				<div class="expert_details">
					<div class="ed_profilepic">
						<div class="edp_img" style="background-image: url(<?=$review_data['cpa_image']?>);">
						</div>
					</div>
					<div class="ed_profiledet">
						<div class="ed_title">
							<h3><?php echo $review_data['cpa_first_name'].' '.$review_data['cpa_last_name'] ?></h3>
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
									<p><?=count($review_data['customer_details'])?> Reviews</p>
								</div>
							</div>
						</div>
						<div class="ed_content divider"></div>
					</div>
					<div class="edc_reviews text-left col-lg-12 col-md-12 col-sm-12 col-12 p-0">
						<!-- your Forloop here -->
						<?php foreach($review_data['customer_details'] AS $key=>$val) { 

							$active_star = 0;
					        $half_star = 0;
					        $inactive_star = 0;
					        if (strpos($val->ratting_no,'.') !== false) {
					            $active_star = ($val->ratting_no-0.5);
					            $half_star = 1;
					            $inactive_star = (4 - $active_star);
					            //echo 'true';
					        }else {
					            $active_star = $val->ratting_no;
					            $inactive_star = (5 - $active_star);
					            
					        }

							?>
						<div class="ec_box d-inline-block col-lg-4 col-md-6 col-sm-12 col-12 text-left">
							<div class="ecb_box">
								<!-- box detail content -->
								<div class="ecb_details">
									<div class="ecbd_title">
										<div class="ecb_title">
											<h3 class="ecbt_title"><?php echo $val->first_name.' '.$val->last_name ?></h3>
											<!-- box reviews content -->
											<div class="ecb_reviews">
												<div class="ecbd_review">
													<div class="ecb_icon">
														<?php for($j=1; $j<=$active_star; $j++) { ?>
														
														<i class="fill-up fa fa-star"></i>
														<?php } ?>
														<?php for($i=1; $i<=$half_star; $i++) { ?>
															<i class="fill-up fa fa-star-half-o"></i>
														<?php } ?>
														<?php for($j=1; $j<=$inactive_star; $j++) { ?>
														
														<i class="fa fa-star-o"></i>
														<?php } ?>
													</div>
												</div>
											</div>
											<!-- end reviews content -->
										</div>
										<div class="ecb_content">
											<input type="hidden" name="que_data" id="que_data<?=$val->id?>" value="<?=$val->description?>"/>
											<p style="word-wrap: break-word;"><?php 
												$string = strip_tags($val->description);
												if (strlen($string) > 40) {
												    $stringCut = substr($string, 0, 40);
												    $endPoint = strrpos($stringCut, ' ');
												    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
												    $string .= '... <a href="javascript:void(0);" class="read_qus" data-id="'.$val->id.'">Read More</a>';
												}
												echo $string;
											?></p>
										</div>
										<div class="show_date" style="margin-top:15px;">
											<p><?= date('M dS, Y', strtotime($val->created_date))?></p>
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
	</div>
</div>

<div class="container"> 
    <!-- Shopify Store Product List Modal -->
    <div class="modal fade" id="review_desc" role="dialog">
        <div class="modal-dialog"> 
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                	<h4 class="qus_ans_title">Comment</h4>
                    <button type="button" class="close" id="close_pop" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                </div>
                <div class="rev_data" style="padding: 15px; word-wrap: break-word;">
                	
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
	$(document).on('click', '.read_qus', function(){
		var id = $(this).attr('data-id');
		var desc_data = $('#que_data'+id).val();
		$('.rev_data').html(desc_data);
		$('#review_desc').modal('toggle');
		$('#review_desc').modal('show');
		// alert(desc_data);			
	});
</script>
