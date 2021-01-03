<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
	<div class="expert_details review_page contact_page">
		<div class="ed_profilepic">
			<div class="edp_img" style="background-image: url('<?=$review_data['cpa_image']?>');">
			</div>
		</div>
		<div class="ed_profiledet text-center">
			<div class="ed_title">
				<h3><?=$review_data['cpa_first_name'].' '.$review_data['cpa_last_name']?></h3>
			</div>
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
						<p>
							<p><?=count($review_data['customer_details'])?> Reviews</p>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="ed_review_details d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12">
			<!-- Review Forloop Here -->
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

		        //echo $active_star.'-'.$half_star.'-'.$inactive_star;

				?>
			<div class="edrd_box col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="edrdb_box">
					<div class="edrdb_name">
						<h6><?php echo $val->first_name.' '.$val->last_name ?></h6>
					</div>
					<div class="edrdb_review">
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
					</div>
					<div class="edrdb_content">
						<input type="hidden" name="que_data" id="que_data<?=$val->id?>" value="<?=$val->description?>"/>
						<p style="word-wrap: break-word;"><?php 
							$string = strip_tags($val->description);
							if (strlen($string) > 60) {
							    $stringCut = substr($string, 0, 60);
							    $endPoint = strrpos($stringCut, ' ');
							    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
							    $string .= '... <a href="javascript:void(0);" class="read_qus" data-id="'.$val->id.'">Read More</a>';
							}
							echo $string;
						?></p>
					</div>
					<div class="show_date" style="margin-top:15px; font-size: 12px; color: #969696;">
						<p><?= date('M dS, Y', strtotime($val->created_date))?></p>
					</div>
				</div>
			</div>
			<?php } ?>
			<!-- End Review Forloop Here -->
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
