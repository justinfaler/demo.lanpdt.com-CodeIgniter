<div class="kt-portlet">
	
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
		
			<h3 class="kt-portlet__head-title">
				Information
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
				      		<th>Mobile Phone</th>
				      		<td><?=$user_list[0]->phone_number?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>Zip Codes Assigned OR State</th>
				      		<td><?= str_replace(",", ", ", $user_list[0]->assign_zip_code)?></td>
				    	</tr>
				    	
				    	<tr>
				      		<th>State</th>
				      		<td></td>
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
				Company Details
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
				      		<th>Company Name</th>
				      		<td><?=$user_list[0]->company_name?></td>
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
				Company Address
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
				      		<th>Street</th>
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
				      		<th>Office Phone</th>
				      		<td><?=$user_list[0]->office_phone?></td>
				    	</tr>
				    	
				  	</tbody>
				</table>
			</div>
		</div>
		<!--end::Section-->
	</div>
	
	
	<!--end::Form-->
</div>