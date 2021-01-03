<?php

$session_data = $this->session->userdata('userdata_list');
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?=base_url()?>assets/css/mdb.css" rel="stylesheet">

<!-- end:: Header -->

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Content Head -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">Dashboard</h3>
			
			<div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
				<input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
				<span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="flaticon2-search-1"></i></span>
				</span>
			</div>
		</div>
	</div>
	<!-- end:: Content Head -->
	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<div>
			<p class="fill_val" style="color:red;"></p>
		</div>
		<div class="row" style="padding: 0 0 25px 0;">	
			<div class="col-xl-2 col-lg-2">
				<label class="col-form-label">Search</label>
				<select class="form-control" name="fill_data" id="fill_data" required>
					<option value="30">Last 30 days</option>
					<option value="90">Last 90 days</option>
					<option value="365">Year to Date</option>
					<option value="custom">Custom</option>
				</select>
			</div>
			<div class="col-xl-2 col-lg-2 start_div" style="display: none;">
				<label class="col-form-label">Start Date</label>
				<input class="form-control start_date" type="date" name="start_date" value="" id="example-date-input">
			</div>
			<div class="col-xl-2 col-lg-2 end_div" style="display: none;">
				<label class="col-form-label">End Date</label>
				<input class="form-control end_date" type="date" name="end_date" value="" id="example-date-input">
			</div>	
			<div class="col-xl-2 col-lg-2">
			 	<button type="button" class="btn btn-brand btn-elevate btn-icon-sm fillter" style="margin-top:38px;">
                    <i class="la la-search"></i>Search
                </button>
            </div>
		</div>
		<!--Begin::Section-->
		
		<div class="row">
			<div class="col-xl-4">
				<div class="kt-portlet">
					<section class="panel panel-box">
                        <div class="panel-left panel-icon bg-success">
                            <i class="fa fa-ticket fa-3x stat-icon success-text" style="margin-top: 8px;"></i>
                            <p class="text-muted no-margin text" style="margin-top: 5px; color: #FFF !important;"><span>Number of Questions</span></p>
                        </div>
                        <div class="panel-right panel-icon bg-reverse">
                            <p class="size-h1 no-margin counter num_of_tkt" data-count="<?=$number_of_ticket?>"></p>
                            
                        </div>
                    </section>
				</div>
			</div>
			<?php if($session_data->id == 1){ ?>
				<div class="col-xl-4">
					<div class="kt-portlet">
						<section class="panel panel-box">
	                        <div class="panel-left panel-icon bg-success">
	                            <i class="fa fa-users fa-3x stat-icon success-text" style="margin-top: 8px;"></i>
	                            <p class="text-muted no-margin text" style="margin-top: 5px; color: #FFF !important;"><span>Number of Franchisees</span></p>
	                        </div>
	                        <div class="panel-right panel-icon bg-reverse">
	                            <p class="size-h1 no-margin counter num_of_fran" data-count="<?=$number_of_franchisee?>"></p>
	                            
	                        </div>
	                    </section>
					</div>
				</div>
			<?php } ?>	

			<div class="col-xl-4">
				<div class="kt-portlet">
					<section class="panel panel-box">
                        <div class="panel-left panel-icon bg-success">
                            <i class="fa fa-user fa-3x stat-icon success-text" style="margin-top: 8px;"></i>
                            <p class="text-muted no-margin text" style="margin-top: 5px; color: #FFF !important;"><span>Number of CPA's</span></p>
                        </div>
                        <div class="panel-right panel-icon bg-reverse">
                            <p class="size-h1 no-margin counter num_of_cpa" data-count="<?=$number_of_cpa?>"></p>
                            
                        </div>
                    </section>
				</div>
			</div>
		</div>	
		<?php if($session_data->id == 1){ ?>
		<div class="row">
			<div class="col-xl-12">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Top Franchisees
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">

						<!--begin::Section-->
						<div class="kt-section">
							<div class="kt-section__content">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email Address</th>
											<th>State</th>
											<th>City</th>
											<th>Assigned Zip Codes</th>
											<th>Question Answered</th>
										</tr>
									</thead>
									<tbody>
									<?php $i=1; foreach($top_franchisee AS $val){ 
										if($val->user_role == 2){
										?>
										<tr>
											<th scope="row"><?=$i?></th>
											<td><?=$val->first_name?></td>
											<td><?=$val->last_name?></td>
											<td><?=$val->email_address?></td>
											<td><?=$val->state_name?></td>
											<td><?=$val->city?></td>
											<td><?= str_replace(",", ", ", $val->assign_zip_code)?></td>
											<td><?=$val->count?></td>
										</tr>
									<?php $i++; } } ?>	
									</tbody>
								</table>
								<div class="col-xl-12 col-lg-12">
								 	<a href="<?=base_url().'admin_user_list'?>" class="btn btn-brand btn-elevate btn-icon-sm fillter" style="margin: 0 auto; display: table;">View All</a>
					            </div>
							</div>
						</div>

						<!--end::Section-->
					</div>

					<!--end::Form-->
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if($session_data->user_role == 2){ ?>
		<div class="row">
			<div class="col-xl-12">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon kt-hidden">
								<i class="la la-gear"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								Assigned Zip Codes
							</h3>
						</div>
						 <div class="kt-portlet__head-toolbar">
		                <div class="kt-portlet__head-wrapper">
		                    <div class="kt-portlet__head-actions">
		                        <a href="javascript:voide();" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#req_assign_code">
		                            Request ZIP codes
		                        </a>
		                    </div>  
		                </div>      
		            </div>
					</div>

					<div class="kt-portlet__body">
						<div class="row">
						<?php foreach($zip_code_list AS $zip_val) { ?>
							<div class="col-sm-2">
								<p class="btn btn-secondary"><?=$zip_val?>&nbsp;&nbsp;&nbsp;</p>
							</div>	
						<?php } ?>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>


		<div class="row">
			<div class="col-xl-12">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon kt-hidden">
								<i class="la la-gear"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								Question by Type
							</h3>
						</div>
					</div>

					<div class="kt-portlet__body">
						<div>
							<p class="fill_val_pie" style="color:red;"></p>
						</div>
						<div class="row" style="padding: 0 0 25px 0;">	
							<div class="col-xl-2 col-lg-2">
								<label class="col-form-label">Search</label>
								<select class="form-control" name="fill_data_pie" id="fill_data_pie" required>
									<option value="30">Last 30 days</option>
									<option value="90">Last 90 days</option>
									<option value="365">Year to Date</option>
									<option value="custom">Custom</option>
								</select>
							</div>
							<div class="col-xl-2 col-lg-2 start_div_pie" style="display: none;">
								<label class="col-form-label">Start Date</label>
								<input class="form-control start_date_pie" type="date" name="start_date_pie" value="" id="example-date-input">
							</div>
							<div class="col-xl-2 col-lg-2 end_div_pie" style="display: none;">
								<label class="col-form-label">End Date</label>
								<input class="form-control end_date_pie" type="date" name="end_date_pie" value="" id="example-date-input">
							</div>	
							<div class="col-xl-2 col-lg-2">
							 	<button type="button" class="btn btn-brand btn-elevate btn-icon-sm fillter_pie" style="margin-top:38px;">
				                    <i class="la la-search"></i>Search
				                </button>
				            </div>
						</div>

						<strong>
							
						    <div class="pie_chart_div">
						      <canvas id="pieChart" style="max-width: 500px; margin: 0 auto;"></canvas>
						    </div>
						</strong>
					</div>
				</div>
			</div>
		</div>	

	</div>
</div>


<div class="container"> 
    <!-- Shopify Store Product List Modal -->
    <div class="modal fade" id="req_assign_code" role="dialog">
        <div class="modal-dialog"> 

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Request for assign zip code</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="view_contain">
                	<p class="email_validation" style="color:green; margin: 10px;"></p>
                	<form action="" method="post">
                		<div class="col-lg-12">
	                		<label class="col-form-label">Message</label>
	                		<textarea class="form-control" id="zipcode_message"></textarea>
	                	</div>	

                		<div class="kt-form__actions">
                			<div class="col-lg-12">
								<button type="button" class="btn btn-success send_requiest_zipcode" style="float:right; margin: 15px;">Send</button>
							</div>
						</div>
                	</form>	
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
		.panel-box {
    display: table;
    table-layout: fixed;
    width: 100%;
    height: 100%;
    text-align: center;
    border: medium none;
}
	
.panel-box .panel-icon {
    display: table-cell;
    padding: 20px;
    width: 1%;
    vertical-align: top;
    border-radius: 0px;
    text-align: center;
	border-bottom: 1px solid #fcfcfc;
	border-top: 1px solid #fcfcfc;
	border-right: 1px solid #fcfcfc;
}
	
	.dashboard-stats .stat-icon {
    line-height: 65px;
}
	

	.bg-success {
    background-color: #7d896d !important;
    color: #FFF !important;
}
	
	.success-text {
    color: #82b33a;
}
	
	.bg-danger {
    background-color: #FF7857 !important;
    color: #FFF !important;
}
	
	.danger-text {
    color: #d15b3d;
}
	
	
	.bg-lovender {
    background-color: #8075C4 !important;
    color: #FFF !important;
}
	
	
	.lovender-text {
    color: #6a5fb1;
}
	
	

	.bg-info {
    background-color: #7ACBEE !important;
    color: #FFF !important;
}
	
	.info-text {
    color: #3ca0cb;
}
	
	
	
	
	.size-h1 {
    font-size: 30px;
    margin-top: 18px;

}
	
	.panel-icon p.text {
    font-weight: bold;
    font-size: 14px;
    text-align: center;
}
	
	
	
    .panel-icon i {
    text-align: center;
}
	
	
    .panel-icon i {
    text-align: center;
}
	
	
    .text-large {
    font-size: 50px;
}


    .text-large {
    font-size: 50px;
}
	
</style>

<script type="text/javascript">

	$(function() {
   		$('#admin_data').DataTable({"aaSorting": []});
   		call_counter();
  	});


  	$(document).on('change', '#fill_data', function(){
  		var fill_data = $(this).val();
  		if(fill_data == 'custom'){
  			$('.start_div').css('display','block');	
  			$('.end_div').css('display','block');	
  		}
  		if(fill_data != 'custom'){
  			$('.start_div').css('display','none');	
  			$('.end_div').css('display','none');	
  		}
  	});

  	$(document).on('click', '.fillter', function(){
  		var fill_data = $('#fill_data').val();
  		var start_date = $('.start_date').val();
  		var end_date = $('.end_date').val();
  		
  		if(start_date > end_date){
  			$('.fill_val').html('End date should be greater than start date');
  			setTimeout(function(){
				$('.fill_val').slideUp(); 
			}, 5000);
  			return;
  		}
  		var url_path = '<?=base_url()?>'+'admin/dashboard/fill_data';
  		$.ajax({
  			url     : url_path,
  			type    : 'POST',
  			data    : {'fill_data':fill_data, 'start_date':start_date, 'end_date':end_date},
  			success : function(response){
  				var all_data = JSON.parse(response);
  				
  				$('.num_of_tkt').attr('data-count',all_data.number_of_ticket);
  				$('.num_of_fran').attr('data-count',all_data.number_of_franchisee);
  				$('.num_of_cpa').attr('data-count',all_data.number_of_cpa);
  				call_counter();
  				//num_of_tkt num_of_fran num_of_cpa
  			}  
  		})
  		// alert(fill_data);
  		// alert(start_date);
  		// alert(end_date);
  	});


  	$(document).on('change', '#fill_data_pie', function(){
  		var fill_data = $(this).val();
  		if(fill_data == 'custom'){
  			$('.start_div_pie').css('display','block');	
  			$('.end_div_pie').css('display','block');	
  		}
  		if(fill_data != 'custom'){
  			$('.start_div_pie').css('display','none');	
  			$('.end_div_pie').css('display','none');	
  		}
  	});

  	$(document).on('click', '.fillter_pie', function(){
  		var fill_data = $('#fill_data_pie').val();
  		var start_date = $('.start_date_pie').val();
  		var end_date = $('.end_date_pie').val();
  		
  		if(start_date > end_date){
  			$('.fill_val_pie').html('End date should be greater than start date');
  			setTimeout(function(){
				$('.fill_val_pie').slideUp(); 
			}, 5000);
  			return;
  		}
  		var url_path = '<?=base_url()?>'+'admin/dashboard/fill_data_pie';
  		$.ajax({
  			url     : url_path,
  			type    : 'POST',
  			data    : {'fill_data':fill_data, 'start_date':start_date, 'end_date':end_date},
  			success : function(response){
  				var all_data = JSON.parse(response);
  				piechart(all_data.received_num, all_data.open_num, all_data.closed_num);
  				// $('.num_of_tkt').attr('data-count',all_data.number_of_ticket);
  				// $('.num_of_fran').attr('data-count',all_data.number_of_franchisee);
  				// $('.num_of_cpa').attr('data-count',all_data.number_of_cpa);
  				// call_counter();
  				//num_of_tkt num_of_fran num_of_cpa
  			}  
  		})
  		// alert(fill_data);
  		// alert(start_date);
  		// alert(end_date);
  	});

  	function call_counter(){
  		$('.counter').each(function() {
			var $this = $(this),
		    countTo = $this.attr('data-count');
		  
		  	$({ countNum: $this.text()}).animate({
		    	countNum: countTo
		  	},
			{
		    	duration: 2000,
		    	easing:'linear',
		    	step: function() {
		      		$this.text(Math.floor(this.countNum));
		    	},
		    	complete: function() {
		      		$this.text(this.countNum);
		      	//alert('finished');
		    	}
		  	});  
		});
  	}

  	$(document).on('click', '.send_requiest_zipcode', function(){
  		var message = $('#zipcode_message').val();

  		var url_path = '<?=base_url()?>'+'admin/dashboard/send_zipcode_requies';
  		$.ajax({
  			url     : url_path,
  			type    : 'POST',
  			data    : {'message':message},
  			success : function(response){
 				if(response == 1){
 					$('.email_validation').html('Request submitted successfully. A CPA2GO representative will respond within a few days.');
 					setTimeout(function(){
						$('#req_assign_code').modal('toggle');
						$('#req_assign_code').modal('show');
					}, 5000);
		  			return;
		  	
 				}	
  			}  
  		})
  	});
</script>

   <!-- <script type="text/javascript" src="<?=base_url()?>assets/js/popper.min.js"></script> -->
   	<script type="text/javascript" src="<?=base_url()?>assets/js/mdb.js"></script> 

 	<script type="text/javascript">
 	
 		var received_num = '<?=$received_num?>';	
 		var open_num = '<?=$open_num?>';	
 		var closed_num = '<?=$closed_num?>';
 		piechart(received_num, open_num, closed_num);	
 		//var expired = '0';	
      //pie

      	function piechart(received_num, open_num, closed_num){

      		$('#pieChart').remove();
      		$('.pie_chart_div').html('<canvas id="pieChart" style="max-width: 500px; margin: 0 auto;"></canvas>');
		    var ctxP = document.getElementById("pieChart").getContext('2d');
		    var myPieChart = new Chart(ctxP, {
		        type: 'pie',
		        data: {
		          labels: ['Open', 'Closed'],
		          datasets: [{
		            data: [open_num, closed_num],
		            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
		            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
		          }]
		        },
		        options: {
		          responsive: true
		        }
		      });

		}      
    // "Expired or Cancelled tickets"
 </script>   