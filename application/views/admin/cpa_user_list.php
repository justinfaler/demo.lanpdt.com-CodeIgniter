<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$userdata = $this->session->userdata('userdata_list');
?>
<script src="<?=base_url()?>assets/vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>

<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				CPA </h3>
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
	                    CPA List
	                </h3>
	            </div>
	            <div class="kt-portlet__head-toolbar">
	                <div class="kt-portlet__head-wrapper">
	                    <div class="kt-portlet__head-actions">
	                        <a href="<?php echo base_url() ?>cpa_user_add" class="btn btn-brand btn-elevate btn-icon-sm">
	                            <i class="la la-plus"></i>New CPA
	                        </a>
	                    </div>  
	                </div>      
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
                <?php if($userdata->user_role==1){ ?>
                <div class="form-group row">
	                <div class="col-lg-3 form-group-sub">
						<label class="form-control-label">Franchise</label>
						<select class="form-control admin_id" name="admin_id" aria-describedby="billing_card_exp_year-error" aria-invalid="false">
							<option value="">Select</option>
							<?php foreach($admin_list AS $key=>$val) {?>
								<option value="<?=$val->id?>"><?=$val->first_name.' '.$val->last_name?></option>
							<?php } ?>
						</select>
					</div>
				</div>	
				<?php } ?>
	            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="cpa_list" role="grid" aria-describedby="kt_table_1_info">
	                <thead>
	                    <tr role="row">  
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width:15px;" >No.</th>
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >First Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >Last Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Email Address</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Phone Number</th>
	                        <!-- <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" aria-label="Actions">Address</th> -->
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
	                            <td><?=$val->email_address?></td>
	                            <td><?=$val->phone_number?></td>
	                            <!-- <td><?=$val->address?></td> -->
	                            <!-- <td><?= formatdate($val->created_date, "d-m-Y")?></td> -->
	                            <td>
                                    <a href="<?=base_url()?>cpa_user_edit/<?=$val->id?>" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i class="la la-edit"></i></a>   

                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md view_cpa" title="View" data-toggle="modal" data-target="#setting_popup" data-user-id="<?=$val->id?>"><i class="la la-eye"></i></a>   

                                    <a href="<?=base_url()?>cpa_user_delete/<?=$val->id?>" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_admin" onclick="return confirm('Are you sure you want to delete?')" title="Delete" ><i class="la la-trash"></i></a>   
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
                    <h4 class="modal-title">View of CPA</h4>
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

		var table = $('#cpa_list').DataTable({
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

    	$(document).on('change', '.admin_id', function(){
    		
    		
    		var admin_id = $(this).val();
    		var url  = "<?php echo base_url(); ?>" + "admin/cpa_user/ajax_get_filter_user";  
    		
    		$('#cpa_list').DataTable({

                "destroy": true,
                // "processing": true,
                // "serverSide": true,
                "ajax": {
                    "url": url,
                    "type": "POST",
                    "data": {'admin_id': admin_id}
                },
                "columnDefs": [{
                    "data": null
                }]
            });

    	});
    });    

    
</script>
