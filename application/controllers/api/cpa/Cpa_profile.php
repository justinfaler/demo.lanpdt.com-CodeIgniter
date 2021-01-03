<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpa_profile extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();
        $this->load->model('api_model');

    }
	public function index(){
		
		$cpa_id = $this->input->post('cpa_id'); 
		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
		$admin_data = $this->api_model->getsinglerow('users', 'id', $cpa_data['main_admin_id']);
		
		$data['id'] = $cpa_data['id'];
		$data['first_name'] = $cpa_data['first_name'];
		$data['last_name'] = $cpa_data['last_name'];
		$data['email_address'] = $cpa_data['email_address'];
		$data['user_image'] =  (!empty($cpa_data['user_image'])) ? $cpa_data['user_image'] : '' ;
		$data['cpa_description'] =  $cpa_data['cpa_description'];
		$data['assign_zip_code'] =  (!empty($admin_data['assign_zip_code'])) ? explode(',', $admin_data['assign_zip_code']) : array();
		$data['license_number'] =  $cpa_data['license_number'];
		$data['user_image'] = !empty($cpa_data['user_image']) ? base_url().'uploads/user_images/'.$cpa_data['user_image'] : ''; 
		$userdata['message'] = 'Get profile for cpa';
		$userdata['status'] = 'true';
		$userdata['details'] = $data;
		echo json_encode($userdata);
		exit;
	}	

	public function update_profile_cpa(){

		$cpa_id = $this->input->post('cpa_id');
		$cpa_description = $this->input->post('cpa_description');
		$email_address = $this->input->post('email_address');

		if(empty($cpa_id)){
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		
		if(empty($cpa_description)){
			$userdata['message'] = 'Required cpa_description';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		if(empty($email_address)){
			$userdata['message'] = 'Required email_address';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if (!empty($_FILES['user_image']['name'])) {
			
          
			$config['upload_path']   = './uploads/user_images/'; 
	        $config['allowed_types'] = 'gif|jpg|png|jpeg'; 	      
	        $config['file_name'] = time() .'_' . $_FILES['user_image']['name'];
	        $this->load->library('upload', $config);
				
	        if ( ! $this->upload->do_upload('user_image')) {
	            $error = array('error' => $this->upload->display_errors()); 
	            $this->load->view('upload_form', $error); 
	        }else { 
	            $uplod_data = array('upload_data' => $this->upload->data()); 
	            $rc_array['user_image'] = $uplod_data['upload_data']['file_name'];
	            //$this->load->view('upload_success', $data); 
	        } 

			
         
        }	
		$rc_array['cpa_description'] = $cpa_description;
		$rc_array['email_address'] = $email_address;


		$this->api_model->update('users', 'id', $cpa_id, $rc_array);

		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
		$admin_data = $this->api_model->getsinglerow('users', 'id', $cpa_data['main_admin_id']);
		
		$data['id'] = $cpa_data['id'];
		$data['first_name'] = $cpa_data['first_name'];
		$data['last_name'] = $cpa_data['last_name'];
		$data['email_address'] = $cpa_data['email_address'];
		$data['user_image'] =  (!empty($cpa_data['user_image'])) ? $cpa_data['user_image'] : '' ;
		$data['cpa_description'] =  $cpa_data['cpa_description'];
		$data['assign_zip_code'] =  explode(',', $admin_data['assign_zip_code']);
		$data['user_image'] = !empty($cpa_data['user_image']) ? base_url().'uploads/user_images/'.$cpa_data['user_image'] : ''; 
		$userdata['message'] = 'Update profile for cpa';
		$userdata['status'] = 'true';
		$userdata['details'] = $data;
		echo json_encode($userdata);
		exit;

	}

	
	
}
