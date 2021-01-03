<div class="kt-portlet">
	<?php $img_url = !empty($user_list->user_image) ? base_url().'uploads/user_images/'.$user_list->user_image : base_url().'assets/images/download.png'; ?>
	<div style="text-align: center;">
		<img src="<?=$img_url?>" class="user_images" />
	</div>	
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
		
			<h3 class="kt-portlet__head-title">
				Personal Information:
			</h3>
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin::Section-->
		<div class="kt-section">
			
			<div class="kt-section__content">
				<table class="table table-striped">
				  	<tbody>
				    	<tr style="word-break: break-all;">
				      		<th>First Name</th>
				      		<td><?=$user_list->first_name?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>Last Name</th>
				      		<td><?=$user_list->last_name?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>Email Address</th>
				      		<td><?=$user_list->email_address?></td>
				    	</tr>
				    	
				    	<!-- <tr>
				      		<th>Date Of Birth</th>
				      		<td></td>
				    	</tr> -->
				    	
				    	<tr style="word-break: break-all;">
				      		<th>Phone Number</th>
				      		<td><?=$user_list->phone_number?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>Company Name</th>
				      		<td><?=$user_list->company_name?></td>
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
				Current Package Information:
			</h3>
		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin::Section-->
		<div class="kt-section">
			<div class="kt-section__content">
				<table class="table table-striped">
				  	<tbody>
				    	<tr style="word-break: break-all;">
				      		<th>Package Name:</th>
				      		<td><?=$user_list->package_name?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>No of Current Questions Count</th>
				      		<td><?=$user_list->no_of_question_count?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>Plan Start Date</th>
				      		<td><?=$user_list->plan_start_date?></td>
				    	</tr>

						<tr style="word-break: break-all;">
				      		<th>Plan End Date</th>
				      		<td><?=$user_list->plan_end_date?></td>
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
				Billing Address:
			</h3>
		</div>
	</div>
	<div class="kt-portlet__body">
		<!--begin::Section-->
		<div class="kt-section">
			<div class="kt-section__content">
				<table class="table table-striped">
				  	<tbody>
				    	<tr style="word-break: break-all;">
				      		<th>Street Address:</th>
				      		<td><?=$user_list->address?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>State</th>
				      		<td><?=$user_list->state_name?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>City</th>
				      		<td><?=$user_list->city?></td>
				    	</tr>
				    	
				    	<tr style="word-break: break-all;">
				      		<th>Zip Code</th>
				      		<td><?=$user_list->zip_code?></td>
				    	</tr>
				    	
				  	</tbody>
				</table>
			</div>
		</div>
		<!--end::Section-->
	</div>
	<!-- <div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
				Payment Info:
			</h3>
		</div>
	</div>
	<div class="kt-portlet__body"> -->
		<!--begin::Section-->
		<!-- <div class="kt-section">
			<div class="kt-section__content">
				<table class="table table-striped">
				  	
				  	<tbody>
				    	<tr>
				      		<th>Card Number</th>
				      		<td><?=$user_list->pay_card_number?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Name On Card</th>
				      		<td><?=$user_list->pay_name_on_card?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Month</th>
				      		<td><?=$user_list->pay_month?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Year</th>
				      		<td><?=$user_list->pay_year?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>CVV</th>
				      		<td><?=$user_list->pay_cvv?></td>
				    	</tr>
				    	
				  	</tbody>
				</table>
			</div>
		</div> -->
		<!--end::Section-->
	<!-- </div> -->
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