<div class="kt-portlet">
	<?php $img_url = !empty($user_list[0]->user_image) ? base_url().'uploads/user_images/'.$user_list[0]->user_image : base_url().'assets/images/download.png'; ?>
	<div style="text-align: center;">
		<img src="<?=$img_url?>" class="user_images" />
	</div>		
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
		
			<!-- <h3 class="kt-portlet__head-title">
				Personal:
			</h3> -->
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin::Section-->
		<div class="kt-section">
			<div class="kt-section__content">
				<table class="table table-striped">
				  	<tbody>
				    	<tr>
				      		<th>First Name</th>
				      		<td><?=$user_list[0]->first_name?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Last Name</th>
				      		<td><?=$user_list[0]->last_name?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Email Address</th>
				      		<td><?=$user_list[0]->email_address?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Date Of Birth</th>
				      		<td></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Phone No</th>
				      		<td><?=$user_list[0]->phone_number?></td>
				    	</tr>
				    	
				    	
				    	
				
				  	</tbody>
				</table>
			</div>
		</div>
		<!--end::Section-->
	</div>
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Business:
			</h3>
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin::Section-->
		<div class="kt-section">
			<div class="kt-section__content">
				<table class="table table-striped">
				  	<tbody>
				    	<tr>
				      		<th>Street:</th>
				      		<td><?=$user_list[0]->address?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>State</th>
				      		<td><?=$user_list[0]->state_name?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>City</th>
				      		<td><?=$user_list[0]->city?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Zip Code</th>
				      		<td><?=$user_list[0]->zip_code?></td>
				    	</tr>
				    	<tr>
				      		<th>Franchisee Assigned to:</th>
				      		<td><?=$admin_name?></td>
				    	</tr>
				    	<tr>
				      		<th>Zip Codes Assigned to:</th>
				      		<td><?=str_replace(",", ", ", $assign_zip_code)?></td>
				    	</tr>
				    	<tr>
				      		<th>CPA License No:</th>
				      		<td><?=$user_list[0]->license_number?></td>
				    	</tr>
				    	
				  	</tbody>
				</table>
			</div>
		</div>
		<!--end::Section-->
	</div>
	
	
	<!--end::Form-->
</div>

<style type="text/css">
	.user_images{
		display: inline-block;
	    width: 40%;
	    /*height: 100%;*/
	    background-size: cover;
	    background-repeat: no-repeat;
	    border-radius: 100%;
	    padding: 10px;
	}
</style>