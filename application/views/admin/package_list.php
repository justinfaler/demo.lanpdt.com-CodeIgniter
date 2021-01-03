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
				Packages </h3>
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
                        Packages
	                </h3>
	            </div>
	             <div class="kt-portlet__head-toolbar">
	                <div class="kt-portlet__head-wrapper">
	                    <div class="kt-portlet__head-actions">
	                    
	                       
	                        <a href="<?php echo base_url() ?>package_add" class="btn btn-brand btn-elevate btn-icon-sm">
	                            <i class="la la-plus"></i>New package
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
	            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="admin_list" role="grid" aria-describedby="kt_table_1_info">
	                <thead>
	                    <tr role="row">  
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width:15px;" >No.</th>
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >Name</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >No Of Questions</th>

	                         <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Price</th>
	                        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Status</th>
	                       <!--  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" aria-label="Actions">Address</th> -->
	                       <!--  <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Created Date</th> -->
	                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" >Actions</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php $i=1; foreach($packages_list AS $key=>$val) { ?>
		                    <tr role="row" class="odd">
	                            <td><?=$i?></td>
	                            <td><?=$val->name?></td>
	                            <td><?=$val->no_of_questions?></td>
	                           
	                            <td><?=$val->price?></td>
	                            <td><?=$val->status?></td>
	                        
	                            <td>
                                    <a href="<?=base_url()?>package_edit/<?=$val->id?>" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit"><i class="la la-edit"></i></a>   

                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md view_admin" title="View" data-toggle="modal" data-target="#view_popup" data-user-id="<?=$val->id?>"><i class="la la-eye"></i></a>  

                                   <a href="<?=base_url()?>package_delete/<?=$val->id?>" 
								   class="btn btn-sm btn-clean btn-icon btn-icon-md delete_admin" 
								   onclick="return confirm('Are you sure you want to delete?')" 
								   title="Delete" ><i class="la la-trash"></i></a>


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
    <div class="modal fade" id="view_popup" role="dialog">
        <div class="modal-dialog"> 

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Package detail</h4>
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
		var id = $(this).attr('data-user-id');
		var url = '<?=base_url()?>'+'admin/package/view_data';
		$.ajax({
	        url     : url,
	        type    : "POST",
	        data    : {'id':id},
	        success : function (response) {
	        	$('.view_contain').html(response);
	        }	
	    });
	})

	

    
</script>
