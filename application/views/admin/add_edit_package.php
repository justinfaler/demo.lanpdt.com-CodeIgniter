<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$id = isset($package_data->id) ? $package_data->id : '';
$user_name = isset($package_data->user_name) ? $package_data->user_name : '';
$name = isset($package_data->name) ? $package_data->name : '';
$no_of_questions = isset($package_data->no_of_questions) ? $package_data->no_of_questions : '';
$no_of_audio_minutes = isset($package_data->no_of_audio_minutes) ? $package_data->no_of_audio_minutes : '';
$no_of_video_minutes = isset($package_data->no_of_video_minutes) ? $package_data->no_of_video_minutes : '';
$price = isset($package_data->price) ? $package_data->price : '';
$description = isset($package_data->description) ? $package_data->description : '';

?>


<!-- end:: Header -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

	<!-- begin:: Subheader -->
	<div class="kt-subheader kt-grid__item" id="kt_subheader">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Packages </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			
		</div>
	</div>

	<!-- end:: Subheader -->

	<!-- begin:: Content -->
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<div class="row">
			
			<div class="col-lg-12">

				<!--begin::Portlet-->
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								<?php if(empty($id) AND $id == '') { echo 'Add '; }else{ echo 'Update '; } ?>Package
							</h3>
						</div>
					</div>

					

					<!--begin::Form-->
					<form class="kt-form" id="add_edit_admin_user">
						<input type="hidden" class="id" name="id" value="<?=$id?>"/>
						<div class="kt-portlet__body">
							<div class="alert alert-success msg_validation" role="alert" style="display: none;">
								<div class="alert-text">A simple success alert—check it out!</div>
							</div>
							<div class="alert alert-danger error_validation" role="alert" style="display: none;">
								<div class="alert-text">A simple success alert—check it out!</div>
							</div>
							<div class="kt-section kt-section--first">
								<!-- <h3 class="kt-section__title">Franchise Owner Info:</h3> -->
								<div class="kt-section__body">
									<div class="form-group row">
										<div class="col-lg-4">
											<label class="col-form-label">* Name</label>
											<input type="text" name="name" class="form-control" placeholder="Enter name" value="<?=$name?>" required>
											<!-- <span class="form-text text-muted">Please enter your full name</span> -->
										</div>
										<div class="col-lg-4">
											<label class="col-form-label">* No Of Questions</label>
											<input type="text" name="no_of_questions" class="form-control" placeholder="Enter no of questions" value="<?=$no_of_questions?>" required>
											
										</div>
										<!-- <div class="col-lg-4">
											<label class="col-form-label">* No Of Audio Minutes</label>
											<input type="text" name="no_of_audio_minutes" id="no_of_audio_minutes" class="form-control" placeholder="Enter no of audio minutes" value="<?=$no_of_audio_minutes?>" required>
										</div> -->

										<div class="col-lg-4">
											<label class="col-form-label">* Price</label>
											<input type="text" name="price" class="form-control" placeholder="Enter the price" min="0" value="<?=$price?>"  required>
											
										</div>
										
									</div>
									<div class="form-group row">
										
										<!-- <div class="col-lg-4">
											<label class="col-form-label">Date Of Birth</label>
											<input type="text" name="date_of_birth" class="form-control" placeholder="" value="">
										</div> -->
									
										<!-- <div class="col-lg-4">
											<label class="col-form-label">* No Of Video Minutes</label>
											<input type="text" name="no_of_video_minutes" class="form-control" placeholder="Enter No Of Video Minutes" value="<?=$no_of_video_minutes?>" required>
											
										</div> -->
										<div class="col-lg-4">
											<label class="col-form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="active">Active</option>
                                                <option value="inactive">InActive</option>
                                            </select>
											<!-- <input type="text" name="status" class="form-control" placeholder="Enter the web address" value="<?=$web_address?>" >
											 -->
										</div> 

										<div class="col-lg-4">
											<label class="col-form-label">Description</label>
											<textarea class="form-control" id="exampleTextarea" rows="3" name="description" ><?=$description?></textarea>
											<!-- <span class="form-text text-muted">Please enter your full name</span> -->
										</div>
										

									</div>	
									
								</div>
								
								<!-- <div class="kt-section__body">
									<div class="form-group row">
										
										
									</div>
										
									
								</div> -->
								
							</div>
						</div>

						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="submit" class="btn btn-success">Submit</button>
								<button type="reset" class="btn btn-secondary">Cancel</button>
							</div>
						</div>

					</form>

					<!--end::Form-->
				</div>

				<!--end::Portlet-->
			</div>
		</div>
	</div>

	<!-- end:: Content -->
</div>

<script type="text/javascript">
	
$('#add_edit_admin_user').submit(function(e){
	e.preventDefault();

	var id = $('.id').val();
		
	$('.loader').show();
	var all_data = $('#add_edit_admin_user').serialize();
	var url = '<?=base_url()?>'+'admin/package/add_edit_process';
	$.ajax({
        url     : url,
        type    : "POST",
        data    : all_data,
        success : function (response) {
        	
        	if(response != 0){
        		$('.loader').hide();
        		var html_inner = '<div class="alert-text">'+response+'</div>';

        		$('.msg_validation').css('display','block');
        		$('.msg_validation').html(html_inner);

        		window.scrollTo(500,0);

        		setTimeout(function(){
        			$('.msg_validation').slideUp(); 
                    location.reload();
        			
        		}, 5000);
               
        	}else{
        		$('.loader').hide();
        	

        		window.scrollTo(500,0);

        		setTimeout(function(){
        			$('.error_validation').slideUp(); 
        			
        		}, 5000);			
        	}
        }	
    });
});

$(document)


</script>					

