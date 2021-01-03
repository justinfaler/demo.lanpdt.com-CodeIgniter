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
				City </h3>
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
	                    City List
	                </h3>
	            </div>
	             <div class="kt-portlet__head-toolbar">
	                <div class="kt-portlet__head-wrapper">
	                    <div class="kt-portlet__head-actions">
	                        <a href="<?php echo base_url() ?>admin_user_add" class="btn btn-brand btn-elevate btn-icon-sm new_btn" data-toggle="modal" data-target="#add_edit_city">
	                            <i class="la la-plus"></i>New City
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

               <!--  <div class="alert alert-success alert-dismissible success_msg" style="display:none">
                    
                </div> -->

	            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="admin_list" role="grid" aria-describedby="kt_table_1_info">
	                <thead>
	                    <tr role="row">  
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width:15px;" >No.</th>
	                        <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >State Name</th>
	                         <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >City Name</th>
	                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;" >Actions</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php $i=1; foreach($city_list AS $key=>$val) { ?>
		                    <tr role="row" class="odd">
	                            <td><?=$i?></td>
	                            <td><?=$val->state_name?></td>
	                            <td><?=$val->name?></td>
	                            <td>
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md edit_state_btn" title="Edit" data-toggle="modal" data-target="#add_edit_state" data-id="<?=$val->id?>"><i class="la la-edit"></i></a>    
                                    <a href="<?=base_url()?>state_delete/<?=$val->id?>" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_admin" onclick="return confirm('Are you sure you want to delete?')" title="Delete" ><i class="la la-trash"></i></a>   
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
    <div class="modal fade" id="add_edit_city" role="dialog">
        <div class="modal-dialog"> 

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title city_title">Add City</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="view_contain" style="padding: 20px;">
         			<form class="kt-form" id="add_edit_admin_user">
         				<input type='hidden' class="city_id" value=""/>
         				<div class="form-group row">
							<div class="col-lg-12">
								<label class="col-form-label">* State Name:</label>
								<select class="form-control state_id" name="state_id">
									<option value="">Select</option>
									<?php foreach($state_list AS $key=>$val) { ?>
										<option value="<?=$val->id?>"><?=$val->name?></option>
									<?php } ?>
								</select>
								<p class="state_msg" style="color: red"></p>

							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-12">
								<label class="col-form-label">* City Name:</label>
								<input type="text" name="city_name" class="form-control city_name" placeholder="Enter city name" value="" required>
								<p class="city_msg" style="color: red"></p>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-lg-6">
								<button type="submit" class="btn btn-success save_city">Save</button>	
							</div>
						</div>
							
         			</form>
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
        
    	$(document).on('click', '.new_btn', function(){
    		$('.state_title').html('Add State');
        	$('.state_name').val('');
        	$('.state_id').val('');
    	});

    	$(document).on('click', '.edit_state_btn', function(){
    		$('.state_title').html('Edit State');
    		var id = $(this).attr('data-id');
    		var url = '<?=base_url()?>'+'admin/state_city/get_state';
    		$.ajax({
		        url     : url,
		        type    : "POST",
		        data    : {'state_id':id},
		        success : function (response) {	
		        	var state_data = JSON.parse(response);
		        	$('.state_id').val(state_data.id);
		        	$('.state_name').val(state_data.name);
		        		// alert('State added successfully');
		        		// window.location = "<?php  echo base_url('state_list'); ?>";
		        	
		        }	
		    });
    	});

        $(document).on('click', '.save_city', function(){
        	
    		var city_name = $('.city_name').val();
    		var city_id = $('.city_id').val();
    		var state_id = $('.state_id').val();
    		alert(city_name);
    		alert(state_id);

    		if(city_name == ''){
    			$('.city_msg').html('Required city name');
    			setTimeout(function(){
					$('.city_msg').slideUp(); 
				}, 5000);
    			return false;
    		}
    		if(state_id == ''){
    			$('.state_msg').html('Select state name');
    			setTimeout(function(){
					$('.state_msg').slideUp(); 
				}, 5000);
    			return false;
    		}
    		//alert(state_name);
    		// var url = '<?=base_url()?>'+'admin/state_city/add_edit_process';
    		// $.ajax({
		    //     url     : url,
		    //     type    : "POST",
		    //     data    : {'state_name':state_name, 'state_id':state_id},
		    //     success : function (response) {	
		    //     	if(response == 'add'){
		        		
		    //     		window.location = "<?php  echo base_url('state_list'); ?>";
		    //     	}
		    //     	if(response == 'edit'){
		        		
		    //     		window.location = "<?php  echo base_url('state_list'); ?>";
		    //     	}
		    //     }	
		    // });
    	})
    });    

    
</script>
