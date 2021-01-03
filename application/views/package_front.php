<!-- Content Section -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>



<div id="expert">
	<div class="container">
		<div class="row">
			<div class="expert_content d-flex flex-wrap col-lg-12 col-md-12 col-sm-12 col-12 p-0">


           <?php 
           
	if($purchase_type=='web' || $purchase_type==''){
           foreach ($packages as $key => $value) { ?>
            
          
				
            <div class="ec_box d-inline-block col-lg-6 col-md-6 col-sm-12 col-12 text-left">
					<div class="ecb_box box_shadow_custom">
						<!-- box detail content -->
						<div class="ecb_details">
							<div class="ecbd_title">
								<div class="ecb_title">
									<h3 class="ecbt_title"><?php echo $value->name; ?></h3>
								</div>
							    <div class="ecb_content">
								    <p style="word-wrap: break-word;"><?php echo $value->description; ?></p>
								</div>
                               
							</div>
						</div>
					
						<div class="ecb_reviews">
							<div class="ecbd_review">
								<div class="ecb_content">
									<p><?php echo "Price: ".$value->price; ?></p>
								</div>
                               
							</div>
                            <div class="ecbd_review">
								<div class="ecb_content">
									<p><?php echo "No Of Questions: ".$value->no_of_questions; ?></p>
								</div>
                               
							</div>
							<?php if(isset($current_plan_id) && $current_plan_id== $value->id){ ?>
							<div class="ecbd_review">
								<div class="ecb_content">
								<?php echo "Auto Renew: "?> &nbsp;&nbsp;<input planattr="<?php echo $value->id; ?>" id="toggleautorenew" type="checkbox" <?php if(isset($autoyes) && $autoyes=='1'){ echo 'checked'; }?>  data-toggle="toggle">
								</div>
                               
							</div>
							<?php } ?>
							
							<?php //if($showBuy == 1){ ?>
							<div class="ecbd_btn">
							
								<?php if(isset($current_plan_id) && $current_plan_id== $value->id){ ?>
									
									<a href="#" plan="<?php echo $value->id; ?>" price="<?php echo $value->price ;?>" class="ecbd_last_btn buy" >CURRENT PACKAGE</a>
								<?php }else{ ?>
									<a href="#" plan="<?php echo $value->id; ?>" price="<?php echo $value->price ;?>" style="background-color:#007bff !important" class="ecbd_last_btn buy">BUY NOW</a>
								<?php }?>
								
							</div>
							<?php //} ?>

							
						</div>
						
					</div>
				</div>

            <?php } }elseif($purchase_type!='' && $purchase_type!='web'){ ?>


				<div class="row">
					<div class="ec_box d-inline-block col-lg-12 col-md-12 col-sm-12 col-12 text-left">

					  <?php if($purchase_type=='ios'){ ?>
							<p style="color:white;border: 10px solid #2fc659;padding: 0px;margin: 2px;background-color:#2fc659;">You have a current subscription active on iOS. Please cancel your subscription with Apple to make purchase successfully</p>
					
						<?php }else{ ?>
								<p style="color:white;border: 10px solid #2fc659;padding: 0px;margin: 2px;background-color:#2fc659;">You have a current subscription active on <?php echo ucfirst($purchase_type); ?>. Please cancel your subscription with Google to make purchase successfully</p>
					
						<?php } ?> 		
					
					
					</div>
				
				</div>



			<?php } ?>




			</div>
		</div>


	

	     </br>								

		<?php if(isset($plan_end_date)){ ?>
		<div class="row">
			<div class="ec_box d-inline-block col-lg-6 col-md-6 col-sm-12 col-12 text-left">
				Current Question Count : <?php echo $no_of_question_count;?>
				</br>
				Expiration Date : <?php echo  date('Y-m-d',strtotime($plan_end_date)); ?>
			</div>
		
		</div>
		<?php }?>
	</div>
</div>




<div class="modal fade" id="charges_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
			</div>
			<div class="modal-body text-center">
				<div class="modal_content text-center">
					
						<input type="hidden" value="" name="" class="text_question" />
						<input type="hidden" value="" name="" class="cpa_id"/>
						<input type="hidden" id="pay_customer_id" name="pay_customer_id" class="pay_customer_id"/>
						
						
						
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
				<input type="hidden"  name="planId" id="planId"/>
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
					<button type="submit" class="btn btn-secondary addcardbuttonsubmit">Done</button>
				</div>
				<div style="margin:20px 20px 20px 20px" class="footer_cont"><p>Processed by Stripe. CPA2GO doesn't store your payment info</p></div>
			</form>
		</div>
	</div>
</div>


<style type="text/css">
	.det_btn{
		background-color: #808080 !important;
	}
</style>

<script src="<?=base_url()?>assets/front/js/jquery.payform.min.js" charset="utf-8"></script>
<script src="<?=base_url()?>assets/front/js/script.js"></script>

<script type="text/javascript">



  $(function() {
   

	$('#toggleautorenew').change(function() {
	//	console.log();
		var toggleAutoRenew= $(this).prop('checked');
		var plan_id = $(this).attr('planattr');
		var url = '<?=base_url()?>' + 'question_answer/manageAutoRenew';
		var user_id = '<?php echo $user_id;?>';	
		if(toggleAutoRenew==true){
			
			$.ajax({
				url: url,
				type: "POST",
				data: {'autorenew':'on','user_id':user_id,'plan_id':plan_id},
				success: function(response) {
					//var data = JSON.parse(response);
					
				}
			});

		}else{
			$.ajax({
				url: url,
				type: "POST",
				data: {'autorenew':'off','user_id':user_id,'plan_id':plan_id},
				success: function(response) {
					//var data = JSON.parse(response);
					
				}
			});
		}
    })

  })


	$(document).on('click', '.close_charges_popup', function(){
		$('#charges_popup').modal('toggle');
		$('#charges_popup').modal('hide');
		return false;
	});

	$(document).on('click', '.buy', function() {
		var price = $(this).attr('price');
		var planId = $(this).attr('plan');
		$("#planId").val(planId);
		$("#exampleModalLabel").text("You will be charged $"+price);
	//	var pay_customer_id = $('#pay_customer_id').val();
	//	$('.pay_customer_id').val(pay_customer_id);
		$('#charges_popup').modal('toggle');
		$('#charges_popup').modal('show');
		return false;
	});

	$(document).on('click', '.save_question', function() {
		$('#charges_popup').modal('toggle');
		$('#charges_popup').modal('hide');
		var pay_customer_id = $('#pay_customer_id').val();

		
		
		if (pay_customer_id == '' || typeof pay_customer_id === "undefined") {
			//$('#pay_question').val(text_question);
		//	$('#pay_cpa_id').val(cpa_id);
			//$('#qus_status').val('1');
			
			$('#add_card_details').modal('toggle');
			$('#add_card_details').modal('show');
			return false;
			//add_card_details();
		}


		
	});

	$('#add_card_data').submit(function(e) {

		$(".addcardbuttonsubmit").hide();

			e.preventDefault();
			var all_data = $('#add_card_data').serialize();
			var url = '<?=base_url()?>' + 'question_answer/add_card_front_details';
			
			
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
							alert('payment success');
							location.reload();
							//$('.tic_show').html(data.ticket_num);
						//	$('#ticket_conform').modal('toggle');
						//	$('#ticket_conform').modal('show');
						}, 1000);
						return false;
					}
					if(data.status == 0){
						$('.card_validation').show();
						$('.card_validation').html(data.msg);
						setTimeout(function() {
							$('.card_validation').slideUp();
						}, 5000);
						$(".addcardbuttonsubmit").show();
						return false;
					}
				}
			});
});

</script>
