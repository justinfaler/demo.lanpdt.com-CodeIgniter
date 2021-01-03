<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$user_data = $this->session->userdata('userdata_list');
?>
<script src="<?=base_url()?>assets/vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>

<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Question </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
		</div>
	</div>
	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	
		<div class="kt-portlet kt-portlet--mobile">
	        <div class="kt-portlet__head kt-portlet__head--lg">
	            <div class="kt-portlet__head-label">
	                <span class="kt-portlet__head-icon">
	                    <i class="kt-font-brand flaticon2-line-chart"></i>
	                </span>
	                <h3 class="kt-portlet__head-title">
	                    <?php if($tic_status == 1) { echo 'Open Question'; }elseif($tic_status == 2) { echo 'Pending Question'; }else{ echo 'Closed Question'; } ?>
	                </h3>
	            </div>
	           <!--  <div class="kt-portlet__head-toolbar">
	                <div class="kt-portlet__head-wrapper">
	                    <div class="kt-portlet__head-actions">
	                        <a href="<?php echo base_url() ?>cpa_user_add" class="btn btn-brand btn-elevate btn-icon-sm">
	                            <i class="la la-plus"></i>New CPA
	                        </a>
	                    </div>  
	                </div>      
	            </div> -->
	        </div>
        	<div class="kt-portlet__body">
        		 <div class="messages">
                <?php 
                    $delete_msg = $this->session->flashdata('delete_msg');
                    if(!empty($delete_msg)) {
                       echo '<div class="alert alert-success alert-dismissible delete_msg">';
                       echo '<a href="#" class="close aio_close" data-dismiss="alert" aria-label="close">&times;</a>';
                       echo $delete_msg;
                       echo '</div>';
                    }
                ?>
                </div>

                <div class="form-group row">
                	<input type="hidden" value="<?=$tic_status?>" class="ticket_status"/>
                	<?php if($user_data->user_role == 1){ ?>
	                <div class="col-lg-3 form-group-sub">
	                	
						<label class="form-control-label">Franchisee</label>
						<select class="form-control admin_id" name="admin_id" aria-describedby="billing_card_exp_year-error" aria-invalid="false">
							<option value="">Select</option>
							<?php foreach($admin_list AS $key=>$val) {?>
								<option value="<?=$val->id?>"><?=$val->first_name.' '.$val->last_name?></option>
							<?php } ?>
						</select>
					</div>
					<?php } ?>
					<div class="col-lg-3 form-group-sub">
	                	
						<label class="form-control-label">CPA Name</label>
						<select class="form-control cpa_id" name="cpa_id" aria-describedby="billing_card_exp_year-error" aria-invalid="false">
							<option value="">Select</option>
							<?php foreach($cpa_list AS $key=>$val) {?>
								<option value="<?=$val->id?>"><?=$val->first_name.' '.$val->last_name?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-3 form-group-sub">
	                	
						<label class="form-control-label">Customer</label>
						<select class="form-control customer_id" name="customer_id" aria-describedby="billing_card_exp_year-error" aria-invalid="false">
							<option value="">Select</option>
							<?php foreach($customer_list AS $key=>$val) {?>
								<option value="<?=$val->id?>"><?=$val->first_name.' '.$val->last_name?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-xl-3 col-lg-3">
					 	<button type="button" class="btn btn-brand btn-elevate btn-icon-sm fillter_data" style="margin-top:25px;">
	                        <i class="la la-search"></i>Search
	                    </button>
	                </div>
				</div>	
	            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="ticket_list" role="grid" aria-describedby="kt_table_1_info">
	                <thead>
	                    <tr role="row">  
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width:15px;" >Question No.</th>
	                        <?php if($user_data->user_role == 1){ ?>
	                         <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >Franchisee Name</th>
	                         <?php } ?>
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >CPA Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >Customer Name</th>
	                        
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Question</th>
	                       
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Answer</th>

	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Type</th>
	                       
	                       <!--  <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Question Type</th> -->
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Start Date</th>
	                         
	                        
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php $i=1; foreach($tickets_list AS $key=>$val) { ?>
		                    <tr role="row" class="odd">
	                            <td><?=$val->ticket_number?></td>
	                            <?php if($user_data->user_role == 1){ ?>
	                           	 <td><?=$val->fran_firstname.' '.$val->fran_lastname?></td>
	                           	<?php } ?> 
	                            <td><?=$val->cpa_firstname.' '.$val->cpa_lastname?></td>
	                            <td><?=$val->customer_firstname.' '.$val->customer_lastname?></td>
	                            <td>
	                            <?php if($val->qus_type == 1){
	                             	//echo $val->question; 
	                             	echo '<input type="hidden" name="que_data" id="que_data'.$val->id.'" value="'.$val->question.'"/>';
	                             	$string = strip_tags($val->question);
									if (strlen($string) > 100) {
									    $stringCut = substr($string, 0, 100);
									    $endPoint = strrpos($stringCut, ' ');
									    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
									    $string .= '... <a href="javascript:void(0);" class="read_qus" data-id="'.$val->id.'">Read More</a>';
									}
									echo $string;
	                             }elseif($val->qus_type == 2){ ?> 
	                            		<audio controls>
  										<source src="<?=base_url().'uploads/audios/'.$val->qus_files?>" type="audio/wav">
									</audio>	
	                            <?php } ?>
	                            </td>

	                            <td>
	                            	<?php if(!empty($val->answer)){ 
	                            		//echo $val->answer; 
	                            		echo '<input type="hidden" name="ans_data" id="ans_data'.$val->id.'" value="'.$val->answer.'"/>';
	                             		$string = strip_tags($val->answer);
										if (strlen($string) > 100) {

										    // truncate string
										    $stringCut = substr($string, 0, 100);
										    $endPoint = strrpos($stringCut, ' ');

										    //if the string doesn't contain any space then it will cut without word basis.
										    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
										    $string .= '... <a href="javascript:void(0);" class="read_ans" data-id="'.$val->id.'">Read More</a>';
										}
										echo $string;
	                            	}elseif(!empty($val->ans_files)){?>
		                            	<audio controls>
	  										<source src="<?=base_url().'uploads/audios/'.$val->ans_files?>" type="audio/wav">
										</audio>
									<?php } ?>	
	                            </td>
	                            <td><?php if($val->qus_type == 1){ echo '<span class="kt-badge kt-badge--success kt-badge--inline">Text</span>'; }elseif($val->qus_type == 2){ echo '<span class="kt-badge kt-badge--info kt-badge--inline">Audio</span>';}else{ echo '<span class="kt-badge kt-badge--danger kt-badge--inline">Video</span>'; } ?></td>
	                           	
	                           <!--  <td><?=($val->qus_type == 1) ? 'Text' : 'Audio'?></td> -->
	                            <td><?= formatdate($val->start_date, "d-m-Y")?></td>
	                            
	                            
	                        </tr> 
	                    <?php $i++; } ?>     
	                </tbody>

            	</table>
        	</div>
    	</div>
	</div>
<!-- end:: Content -->
</div>


<div class="container"> 
    <!-- Shopify Store Product List Modal -->
    <div class="modal fade" id="setting_popup" role="dialog">
        <div class="modal-dialog"> 

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Of CPA</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="view_contain">
                	
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container"> 
    <!-- Shopify Store Product List Modal -->
    <div class="modal fade" id="qus_ans" role="dialog">
        <div class="modal-dialog"> 

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                	<h4 class="qus_ans_title"></h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="qus_ans_data" style="padding: 15px;">
                	
                </div>
            </div>
        </div>
    </div>
</div>


					
<script type="text/javascript">

	
	$(function() {

		var table = $('#ticket_list').DataTable({
			"aaSorting": [],
			"scrollX": true
		});
        
    	
    	setTimeout(function(){
			$('.delete_msg').slideUp(); 
		}, 5000);
        
    	$(document).on('click', '.view_cpa', function(){
    		var user_id = $(this).attr('data-user-id');
    		var url = '<?=base_url()?>'+'admin/cpa_user/view_data';
    		$.ajax({
		        url     : url,
		        type    : "POST",
		        data    : {'user_id':user_id},
		        success : function (response) {
		        	
		        	$('.view_contain').html(response);
		        }	
		    });
    	})

    	$(document).on('change', '.cpa_id', function(){
    		var cpa_id = $(this).val();
    		//var ticket_status = $('.ticket_status').val();
    		var url  = "<?php echo base_url(); ?>" + "admin/tickets_master/get_customer_list";  
    		
    		$.ajax({
		        url     : url,
		        type    : "POST",
		        data    : {'cpa_id':cpa_id},
		        success : function (response) {
		        	
		        	$('.customer_id').html(response);
		        }	
		    });
    		// $('#cpa_list').DataTable({

      //           "destroy": true,
      //           "aaSorting": [],
      //           "ajax": {
      //               "url": url,
      //               "type": "POST",
      //               "data": {'cpa_id': cpa_id, 'ticket_status':ticket_status}
      //           },
      //           "columnDefs": [{
      //               "data": null
      //           }]
      //       });
    	});

    	$(document).on('change', '.admin_id', function(){
    		var admin_id = $(this).val();
    		//var ticket_status = $('.ticket_status').val();
    		var url  = "<?php echo base_url(); ?>" + "admin/tickets_master/get_cpa_list";  
    		
    		$.ajax({
		        url     : url,
		        type    : "POST",
		        data    : {'admin_id':admin_id},
		        success : function (response) {
		        	
		        	$('.cpa_id').html(response);
		        }	
		    });
    		// $('#cpa_list').DataTable({

      //           "destroy": true,
      //           "aaSorting": [],
      //           "ajax": {
      //               "url": url,
      //               "type": "POST",
      //               "data": {'admin_id': admin_id, 'ticket_status':ticket_status}
      //           },
      //           "columnDefs": [{
      //               "data": null
      //           }]
      //       });
    	});

    	$(document).on('click', '.fillter_data', function(){
    		var admin_id = $('.admin_id').val();
    		var cpa_id = $('.cpa_id').val();
    		var customer_id = $('.customer_id').val();
    		var ticket_status = $('.ticket_status').val();
    		var url  = "<?php echo base_url(); ?>" + "admin/tickets_master/ajax_get_fillter_data";  
    		
    		$('#ticket_list').DataTable({

                "destroy": true,
                "aaSorting": [],
                "ajax": {
                    "url": url,
                    "type": "POST",
                    "data": {'admin_id':admin_id, 'cpa_id':cpa_id, 'customer_id': customer_id, 'ticket_status':ticket_status}
                },
                "columnDefs": [{
                    "data": null
                }]
            });
    	});
    });    

    $(document).on('click', '.read_qus', function(){

    	var id = $(this).attr('data-id');
    	var qus_data = $('#que_data'+id).val();
    	$('.qus_ans_title').html('Question');
    	//alert(qus_data);
    	$('.qus_ans_data').html(qus_data);
    	$('#qus_ans').modal('toggle');
		$('#qus_ans').modal('show');
    });

    $(document).on('click', '.read_ans', function(){

    	var id = $(this).attr('data-id');
    	var ans_data = $('#ans_data'+id).val();
    	$('.qus_ans_title').html('Answer');
    	//alert(qus_data);
    	$('.qus_ans_data').html(ans_data);
    	$('#qus_ans').modal('toggle');
		$('#qus_ans').modal('show');
    });

</script>
