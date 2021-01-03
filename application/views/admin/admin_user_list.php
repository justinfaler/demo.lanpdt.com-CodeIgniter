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
				Franchisee </h3>
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
	                    Franchisees
	                </h3>
	            </div>
	             <div class="kt-portlet__head-toolbar">
	                <div class="kt-portlet__head-wrapper">
	                    <div class="kt-portlet__head-actions">
	                    
	                       
	                        <a href="<?php echo base_url() ?>admin_user_add" class="btn btn-brand btn-elevate btn-icon-sm">
	                            <i class="la la-plus"></i>New Franchisee
	                        </a>
	                    </div>  
	                </div>      
	            </div>
	           
	        </div>
        	<div class="kt-portlet__body">
        		<h5 class="kt-portlet__head-title">
	                Export Tickets
	            </h5>
        		<div class="form-group row">
        			<div class="col-xl-3 col-lg-3">
						<label class="col-form-label">Start Date</label>
						<input class="form-control start_date" type="date" name="start_date" value="" id="example-date-input">
					</div>
					<div class="col-xl-3 col-lg-3">
						<label class="col-form-label">End Date</label>
						<input class="form-control end_date" type="date" name="end_date" value="" id="example-date-input">
					</div>
					<div class="col-xl-3 col-lg-3">
					 	<button type="button" class="btn btn-brand btn-elevate btn-icon-sm export_data" style="margin-top:38px;">
	                        <i class="la la-download"></i>Export
	                    </button>
	                </div>    
				
				</div>
				
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
	            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="admin_list" role="grid" aria-describedby="kt_table_1_info">
	                <thead>
	                    <tr role="row">  
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width:15px;" >No.</th>
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >First Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >Last Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Email Address</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Zip Codes Assigned</th>
	                         <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">State</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">City</th>
	                       <!--  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" aria-label="Actions">Address</th> -->
	                       <!--  <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Created Date</th> -->
	                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" >Actions</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php $i=1; foreach($user_list AS $key=>$val) { ?>
		                    <tr role="row" class="odd">
	                            <td><?=$i?></td>
	                            <td><?=$val->first_name?></td>
	                            <td><?=$val->last_name?></td>
	                            <td><?=$val->email_address?></td>
	                            <td><?= str_replace(",", ", ", $val->assign_zip_code)?></td>
	                            <td><?=$val->state_name?></td>
	                            <td><?=$val->city?></td>
	                           <!--  <td><?=$val->address?></td> -->
	                            <!-- <td><?= formatdate($val->created_date, "d-m-Y")?></td> -->
	                            <td>
                                    <a href="<?=base_url()?>admin_user_edit/<?=$val->id?>" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i class="la la-edit"></i></a>   

                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md view_admin" title="View" data-toggle="modal" data-target="#setting_popup" data-user-id="<?=$val->id?>"><i class="la la-eye"></i></a>  

                                    <a href="<?=base_url()?>admin_user_delete/<?=$val->id?>" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_admin" onclick="return confirm('Are you sure you want to delete?')" title="Delete" ><i class="la la-trash"></i></a>   
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
    <div class="modal fade" id="setting_popup" role="dialog">
        <div class="modal-dialog"> 

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Franchisee Account</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="view_contain">
                	
                </div>
            </div>
        </div>
    </div>
</div>
					
<script type="text/javascript">
	
	$(function() {
        $('#admin_list').dataTable({
        	"aaSorting": [],
        	"scrollX": true
        });
    	
    	setTimeout(function(){
			$('.delete_msg').slideUp(); 
		}, 5000);
    });  


    $(document).on('click', '.view_admin', function(){
		var user_id = $(this).attr('data-user-id');
		var url = '<?=base_url()?>'+'admin/admin_user/view_data';
		$.ajax({
	        url     : url,
	        type    : "POST",
	        data    : {'user_id':user_id},
	        success : function (response) {
	        	$('.view_contain').html(response);
	        }	
	    });
	})

	$(document).on('click', '.export_data', function(){
		var start_date = $('.start_date').val();
		var end_date = $('.end_date').val();
		if(start_date == '' || end_date == ''){
			alert('Please select start date && end date');
    		return false;
    	}
		var url = '<?=base_url()?>'+'admin/admin_user/export_ticket_details?start_date='+start_date+'&end_date='+end_date;
		document.location.href = url;
		
	});  

    
</script>
