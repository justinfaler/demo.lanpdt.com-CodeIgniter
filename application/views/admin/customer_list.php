<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="<?=base_url()?>assets/vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>

<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Customer </h3>
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
	                    Customer List
	                </h3>
	            </div>
	           
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
	            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="customer_list" role="grid" aria-describedby="kt_table_1_info">
	                <thead>
	                    <tr role="row">  
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width:15px;" >No.</th>
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >First Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >Last Name</th>
							<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >Package Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >No of Questions</th>
							<th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Email Address</th>
	                        <!-- <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">State</th>
	                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" aria-label="Actions">Zip Code</th> -->
	                        <!-- <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Created Date</th> -->
	                         <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" >Actions</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php $i=1; foreach($user_list AS $key=>$val) { ?>
		                    <tr role="row" class="odd">
	                            <td><?=$i?></td>
	                            <td><?=$val->first_name?></td>
	                            <td><?=$val->last_name?></td>
								
								<td><?=$val->package_name?></td>
								<td><?=$val->no_of_question_count?></td>
	                            <td><?=$val->email_address?></td>
	                            <!-- <td><?=$val->state_name?></td>
	                            <td><?=$val->zip_code?></td> -->
	                            <!-- <td><?= formatdate($val->created_date, "d-m-Y")?></td> -->
	                            <td>
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md view_customer" title="Customer Details" data-toggle="modal" data-target="#view_customer" data-user-id="<?=$val->id?>"><i class="la la-eye"></i></a> 
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md view_tkt" title="View Tickets" data-toggle="modal" data-target="#view_tickets" data-user-id="<?=$val->id?>"><i class="la la-ticket"></i></a> 
                                     <a href="<?=base_url()?>customer_delete/<?=$val->id?>" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_admin" onclick="return confirm('Are you sure you want to delete?')" title="Delete" ><i class="la la-trash"></i></a>  
	                            </td>
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
    <div class="modal fade" id="view_customer" role="dialog">
        <div class="modal-dialog"> 

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Of Customer</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="view_contain">
                	
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="view_tickets" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">View Ticketsr</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      	<div class="modal-body tkt_contain">
        ...
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


<style type="text/css">
	#view_tickets .modal-dialog{
		max-width: 1200px !important;
	}
</style>    
					
<script type="text/javascript">
	
	$(function() {
        $('#customer_list').dataTable({
        	"aaSorting": [],
        	"scrollX": true
        });
    	
    	setTimeout(function(){
			$('.delete_msg').slideUp(); 
			
		}, 5000);
        
        $(document).on('click', '.view_customer', function(){
    		var user_id = $(this).attr('data-user-id');
    		var url = '<?=base_url()?>'+'admin/customer_list/view_data';
    		$.ajax({
		        url     : url,
		        type    : "POST",
		        data    : {'user_id':user_id},
		        success : function (response) {
		        	
		        	$('.view_contain').html(response);
		        }	
		    });
    	})

    	$(document).on('click', '.view_tkt', function(){
    		var user_id = $(this).attr('data-user-id');
    		var url = '<?=base_url()?>'+'admin/customer_list/view_ticket_of_customer';	
    		$.ajax({
		        url     : url,
		        type    : "POST",
		        data    : {'user_id':user_id},
		        success : function (response) {
		        	
		        	$('.tkt_contain').html(response);
		        }	
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
