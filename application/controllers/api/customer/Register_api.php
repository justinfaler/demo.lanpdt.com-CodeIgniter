<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_api extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();
				$this->load->helper(array('form', 'url'));
        $this->load->model('api_model');
    }
	public function index(){

		
		$user_id = $this->input->post('user_id');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email_address = $this->input->post('email_address');
		$date_of_birth = $this->input->post('date_of_birth');
		$phone_number = $this->input->post('phone_number');
		$company_name = $this->input->post('company_name');
		$web_address = $this->input->post('web_address');
		$address = $this->input->post('address');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$zip_code = $this->input->post('zip_code');
		$user_name = $this->input->post('user_name');
		$password = $this->input->post('password');
		$user_role = $this->input->post('user_role');
		$device_token = $this->input->post('device_token');
		$device_type = $this->input->post('device_type');

		if(empty($first_name) AND $first_name == ''){	
			$userdata['message'] = 'Please enter the first name';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}	
		if(empty($last_name) AND $last_name == ''){	
			$userdata['message'] = 'Please enter the last name';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($email_address) AND $email_address == ''){	
			$userdata['message'] = 'Please enter the email address';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}	

		if(empty($user_id) AND $user_id == ''){

			if(empty($device_token) AND $device_token == ''){	
				$userdata['message'] = 'Please enter the device_token';
				$userdata['status'] = 'false';
				echo json_encode($userdata);
				exit;	
			}	

			if(empty($device_type) AND $device_type == ''){	
				$userdata['message'] = 'Please enter the device_type';
				$userdata['status'] = 'false';
				echo json_encode($userdata);
				exit;	
			}	
		}	
		// if(empty($phone_number) AND $phone_number == ''){	
		// 	$userdata['message'] = 'Please enter the phone number';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;	
		// }	
		// if(empty($address) AND $address == ''){	
		// 	$userdata['message'] = 'Please enter the full address';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;	
		// }	
		// if(empty($state) AND $state == ''){	
		// 	$userdata['message'] = 'Please enter the state';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;	
		// }	
		// if(empty($city) AND $city == ''){	
		// 	$userdata['message'] = 'Please enter the city';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;	
		// }	
		// if(empty($user_id)){
		// 	if(empty($password) AND $password == ''){	
		// 		$userdata['message'] = 'Please enter the password';
		// 		$userdata['status'] = 'false';
		// 		echo json_encode($userdata);
		// 		exit;	
		// 	}
		// }	
		// if(empty($user_role) AND $user_role == ''){	
		// 	$userdata['message'] = 'Please enter the user role';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;	
		// }
		// if(empty($zip_code) AND $zip_code == ''){	
		// 	$userdata['message'] = 'Please enter the zip code';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;	
		// }

		
		if(!empty($first_name)){
			$rc_array['first_name'] = $first_name;
		}
		if(!empty($last_name)){
			$rc_array['last_name'] = $last_name;
		}
		if(!empty($user_name)){
			$rc_array['user_name'] = $user_name;
		}
		if(!empty($email_address)){
			$rc_array['email_address'] = $email_address;
		}
		if(!empty($date_of_birth)){
			$rc_array['date_of_birth'] = date('Y-m-d', strtotime($date_of_birth)); 
		}
		if(!empty($phone_number) OR $phone_number != ''){
			$rc_array['phone_number'] = $phone_number;
		}
		if(!empty($company_name) OR $company_name != ''){
			$rc_array['company_name'] = $company_name; 
		}
		if(!empty($web_address) OR $web_address != ''){
			$rc_array['web_address'] = $web_address;
		}
		if(!empty($address) OR $address != ''){
			$rc_array['address'] = $address;
		}
		if(!empty($state)){
			$rc_array['state'] = $state;
		}
		if(!empty($city) OR $city != ''){
			$rc_array['city'] = $city;
		}
		if(!empty($zip_code)){
			$rc_array['zip_code'] = $zip_code;
		}
		if(!empty($password)){
			$fin_password = sha1($password);
			$rc_array['password'] = $fin_password;
		}
		if(!empty($user_role)){
			$rc_array['user_role'] = $user_role;
		}

		if(!empty($device_token)){
			$rc_array['device_token'] = $device_token;
		}
		if(!empty($device_type)){
			$rc_array['device_type'] = $device_type;
		}
		$rc_array['created_date'] = date('Y-m-d h:i:s', time());

		
		// echo '<pre>';
		// print_r($_FILES['user_image']);
		// echo '</pre>';die;
		// exit;

		if (!empty($_FILES['user_image']['name'])) {
			
				  $config['upload_path']   = './uploads/user_images/'; 
					$config['allowed_types'] = '*'; 	
					$config['file_name'] = time() .'_' . $_FILES['user_image']['name'];

		// echo '<pre>';
		// 	print_r($config);
		// 	echo '</pre>';die;
		// 	exit;

	        $this->load->library('upload', $config);
				
	        if ( ! $this->upload->do_upload('user_image')) {
							$error = array('error' => $this->upload->display_errors()); 

							$errData['message'] = $error;
							$errData['status'] = 'false';
						
							echo json_encode($errData);exit;
						// 	echo '<pre>';
						// print_r($error);
						// echo '</pre>';die;
						// exit;
	           // $this->load->view('upload_form', $error); 
	        }else { 
	            $uplod_data = array('upload_data' => $this->upload->data()); 
	            $rc_array['user_image'] = $uplod_data['upload_data']['file_name'];
	            //$this->load->view('upload_success', $data); 
	        } 
        }	

		if(empty($user_id) AND $user_id == ''){
			
			$rc_array['created_date'] = date('Y-m-d H:i:s', time());
			$exist = $this->api_model->check_email('users', 'email_address', $email_address);
			
			if($exist == 0){
				$user_id = $this->api_model->insert_data('users', $rc_array);
				$user_data = $this->api_model->getsinglerow('users', 'id', $user_id);
				$image_url = base_url().'assets/front/image/main_logo.png';
				$htmlContent = '<p>Hello, '.$first_name.'</p>';
		        $htmlContent .= '<h4>You are successfully registered in CPA2GO</h1>';
		        $htmlContent .= '<p>Thanks</p>';
						$htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
					
		        // $htmlContent .= '<p>Url : '.$url.' </p>';
		       	$email = $email_address;
		        $subject = 'Registration Successful';
						 send_email($email, $htmlContent, $subject);


				unset($user_data['password']);
				unset($user_data['main_admin_id']);
				if($user_data['cpa_description'] == NULL){
					$user_data['cpa_description'] = '';
				}
				if($user_data['cpa_service'] == NULL){
					$user_data['cpa_service'] = '';
				}
				if($user_data['company_name'] == NULL OR $user_data['company_name'] == "null"){
					$user_data['company_name'] = '';
				}
				if($user_data['phone_number'] == NULL OR $user_data['phone_number'] == "null"){
					$user_data['phone_number'] = '';
				}
				if($user_data['city'] == NULL OR $user_data['city'] == "null"){
					$user_data['city'] = '';
				}
				if($user_data['user_name'] == NULL OR $user_data['user_name'] == "null"){
					$user_data['user_name'] = '';
				}
				if($user_data['web_address'] == NULL OR $user_data['web_address'] == "null"){
					$user_data['web_address'] = '';
				}
				if($user_data['address'] == NULL OR $user_data['address'] == "null"){
					$user_data['address'] = '';
				}
			
				$user_data['user_image'] = !empty($user_data['user_image']) ? base_url().'uploads/user_images/'.$user_data['user_image'] : '';

				$userdata['message'] = 'Your account registered successfully.';
				$userdata['status'] = 'true';
				$userdata['details'] = $user_data;
				echo json_encode($userdata);
				exit;	
			}else{
				$userdata['message'] = 'This email address already exist';
				$userdata['status'] = 'false';
				echo json_encode($userdata);
				exit;
			}	
				
		}else{

			$exist = $this->api_model->check_update_email('users', 'email_address', $email_address, 'id', $user_id);

			if($exist == 0){
				$this->api_model->update('users', 'id', $user_id, $rc_array);
				$user_data = $this->api_model->getsinglerow('users', 'id', $user_id);
				unset($user_data['password']);
				unset($user_data['main_admin_id']);


					// echo '<pre>';
					// 	print_r($user_data['company_name']);
					// 	echo '</pre>';die;
					// 	exit;

				if(isset($user_data) &&  isset($user_data['cpa_description']) &&  $user_data['cpa_description'] == NULL){
					$user_data['cpa_description'] = '';
				}
				if(isset($user_data) && isset($user_data['cpa_service']) &&  $user_data['cpa_service'] == NULL){
					$user_data['cpa_service'] = '';
				}
				if(isset($user_data) && isset($user_data['company_name']) && ($user_data['company_name'] == NULL OR $user_data['company_name'] == "null")){
					$user_data['company_name'] = '';
				}
				if(isset($user_data) && ($user_data['phone_number'] == NULL OR $user_data['phone_number'] == "null")){
					$user_data['phone_number'] = '';
				}
				if(isset($user_data) && ($user_data['city'] == NULL OR $user_data['city'] == "null")){
					$user_data['city'] = '';
				}
				if(isset($user_data) && ($user_data['user_name'] == NULL OR $user_data['user_name'] == "null")){
					$user_data['user_name'] = '';
				}
				if(isset($user_data) && ($user_data['web_address'] == NULL OR $user_data['web_address'] == "null")){
					$user_data['web_address'] = '';
				}
				if(isset($user_data) && ($user_data['address'] == NULL OR $user_data['address'] == "null")){
					$user_data['address'] = '';
				}
				$user_data['user_image'] = !empty($user_data['user_image']) ? base_url().'uploads/user_images/'.$user_data['user_image'] : ''; 
				$userdata['message'] = 'Profile updated successfully';
				$userdata['status'] = 'true';
				$userdata['details']= $user_data;
				echo json_encode($userdata);
				exit;
			}else{
				$userdata['message'] = 'This email address already exist';
				$userdata['status'] = 'false';
				echo json_encode($userdata);
				exit;
			}
			
		}
	}

	public function login_with_facebook(){

		$device_token = $this->input->post('device_token');
		$device_type = $this->input->post('device_type');
		$user_name = $this->input->post('user_name');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email_address = $this->input->post('email_address');
		$user_role = $this->input->post('user_role');
		$login_type = $this->input->post('login_type');
		$fb_id = $this->input->post('fb_id');
		$fb_image = $this->input->post('fb_image');
		$apple_id = $this->input->post('apple_id');
		// $zip_code = $this->input->post('zip_code');

		if(empty($device_token) AND $device_token == ''){	
			$userdata['message'] = 'Please enter the device_token';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($device_type) AND $device_type == ''){	
			$userdata['message'] = 'Please enter the device_type';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($user_name) AND $user_name == ''){	
			$userdata['message'] = 'Please enter the user_name';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($first_name) AND $first_name == ''){	
			$userdata['message'] = 'Please enter the first name';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}	
		if(empty($last_name) AND $last_name == ''){	
			$userdata['message'] = 'Please enter the last name';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($email_address) AND $email_address == ''){	
			$userdata['message'] = 'Please enter the email address';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($login_type) AND $login_type == ''){	
			$userdata['message'] = 'Please enter the login_type';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		// if(empty($zip_code) AND $zip_code == ''){	
		// 	$userdata['message'] = 'Please enter the zip_code';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;	
		// }	

		log_message('error', 'Login email_address :' . $email_address);
		log_message('error', 'Login device_token :' . $device_token);
		log_message('error', 'Login device_type :' . $device_type);
		log_message('error', 'Login login_type :' . $login_type);
		log_message('error', 'Login fb_id :' . $fb_id);
		log_message('error', 'Login apple_id :' . $apple_id);

		if($login_type == 1){
			$user_data = $this->api_model->getsinglerow('users', 'email_address', $email_address);
		}elseif($login_type == 2){
			$user_data = $this->api_model->getsinglerow('users', 'apple_id', $apple_id);
		}

		
		if(!empty($user_data['email_address'])){

			$rcs_array['device_token'] = $device_token;
        	$rcs_array['device_type'] = $device_type;
			$this->api_model->update('users', 'email_address', $user_data['email_address'], $rcs_array);
			$user_data = $this->api_model->getsinglerow('users', 'email_address', $user_data['email_address']);
			unset($user_data['password']);
			unset($user_data['main_admin_id']);
			if($user_data['cpa_description'] == NULL){
				$user_data['cpa_description'] = '';
			}
			if($user_data['cpa_service'] == NULL){
				$user_data['cpa_service'] = '';
			}
			if($user_data['company_name'] == NULL OR $user_data['company_name'] == "null"){
				$user_data['company_name'] = '';
			}
			if($user_data['phone_number'] == NULL OR $user_data['phone_number'] == "null"){
				$user_data['phone_number'] = '';
			}
			if($user_data['city'] == NULL OR $user_data['city'] == "null"){
				$user_data['city'] = '';
			}
			if($user_data['user_name'] == NULL OR $user_data['user_name'] == "null"){
				$user_data['user_name'] = '';
			}
			if($user_data['web_address'] == NULL OR $user_data['web_address'] == "null"){
				$user_data['web_address'] = '';
			}
			if($user_data['address'] == NULL OR $user_data['address'] == "null"){
				$user_data['address'] = '';
			}
			if($user_data['fb_image'] == NULL OR $user_data['fb_image'] == "null"){
				$user_data['fb_image'] = '';
			}
		
			$user_data['user_image'] = !empty($user_data['user_image']) ? base_url().'uploads/user_images/'.$user_data['user_image'] : ''; 

			$userdata['message'] = 'Customer registered with facebook';
			$userdata['status'] = 'true';
			$userdata['details']= $user_data;
			echo json_encode($userdata);
			//log_message('error', 'Login With FB' . json_encode($userdata));
			exit;
		}else{
			$rc_array['user_name'] = $user_name;
			$rc_array['first_name'] = $first_name;
        	$rc_array['last_name'] = $last_name;
        	$rc_array['email_address'] = $email_address;
        	$rc_array['user_role'] = 4;
        	if($login_type == 1){
	        	$rc_array['login_type'] = 'fb';
	        	$rc_array['fb_id'] = $fb_id;
	        	$rc_array['fb_image'] = $fb_image;
        	}else{
        		$rc_array['login_type'] = 'apple';
	        	$rc_array['apple_id'] = $apple_id;
        	}
        	// $rc_array['zip_code'] = $zip_code;
        	$rc_array['device_token'] = $device_token;
        	$rc_array['device_type'] = $device_type;
        	$rc_array['created_date'] = date('Y-m-d h:i:s', time());

        	$user_id = $this->api_model->insert_data('users', $rc_array);

        	$user_data = $this->api_model->getsinglerow('users', 'id', $user_id);
			unset($user_data['password']);
				unset($user_data['main_admin_id']);
				if($user_data['cpa_description'] == NULL){
					$user_data['cpa_description'] = '';
				}
				if($user_data['cpa_service'] == NULL){
					$user_data['cpa_service'] = '';
				}
				if($user_data['company_name'] == NULL OR $user_data['company_name'] == "null"){
					$user_data['company_name'] = '';
				}
				if($user_data['phone_number'] == NULL OR $user_data['phone_number'] == "null"){
					$user_data['phone_number'] = '';
				}
				if($user_data['city'] == NULL OR $user_data['city'] == "null"){
					$user_data['city'] = '';
				}
				if($user_data['user_name'] == NULL OR $user_data['user_name'] == "null"){
					$user_data['user_name'] = '';
				}
				if($user_data['web_address'] == NULL OR $user_data['web_address'] == "null"){
					$user_data['web_address'] = '';
				}
				if($user_data['address'] == NULL OR $user_data['address'] == "null"){
					$user_data['address'] = '';
				}
				if($user_data['fb_image'] == NULL OR $user_data['fb_image'] == "null"){
					$user_data['fb_image'] = '';
				}
			$user_data['user_image'] = !empty($user_data['user_image']) ? base_url().'uploads/user_images/'.$user_data['user_image'] : ''; 
			if($login_type == 1){

				$userdata['message'] = 'Customer registered with facebook';
			}else{
				$userdata['message'] = 'Customer registered with apple';
			}

			$image_url = base_url().'assets/front/image/main_logo.png';
			$htmlContent = '<p>Hello, '.$first_name.'</p>';
	        $htmlContent .= '<h4>You are successfully registered in CPA2GO</h1>';
	        $htmlContent .= '<p>Thanks</p>';
	        $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
	        // $htmlContent .= '<p>Url : '.$url.' </p>';
	       	$email = $email_address;
	        $subject = $userdata['message'];
					send_email($email, $htmlContent, $subject);
					//send_email_live($email, $htmlContent, $subject);

			$userdata['status'] = 'true';
			$userdata['details']= $user_data;
			echo json_encode($userdata);
			//log_message('error', 'Login With FB' . json_encode($userdata));
			exit;	
		}
	}

	public function apple_with_login(){

		$email_address = $this->input->post('email_address');
		$first_name = $this->input->post('first_name');

		if(empty($first_name) AND $first_name == ''){	
			$userdata['message'] = 'Please enter the first_name';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($email_address) AND $email_address == ''){	
			$userdata['message'] = 'Please enter the email_address';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}

		$image_url = base_url().'assets/front/image/main_logo.png';
		$htmlContent = '<p>Hello, '.$first_name.'</p>';
        $htmlContent .= '<h4>You are successfully registered in CPA2GO</h1>';
        $htmlContent .= '<p>Thanks</p>';
        $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
        // $htmlContent .= '<p>Url : '.$url.' </p>';
       	$email = $email_address;
				$subject = 'Registration Successful';
				send_email($email, $htmlContent, $subject);
				//send_email_live($email, $htmlContent, $subject);

		$userdata['message'] = 'Customer registered with apple';
		$userdata['status'] = 'true';
		echo json_encode($userdata);
		exit;
	}

	public function update_zip_code(){

		$user_id = $this->input->post('user_id');
		$zip_code = $this->input->post('zip_code');

		if(empty($user_id) AND $user_id == ""){	
			$userdata['message'] = 'Please enter the user_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		if(empty($zip_code) AND $zip_code == ""){	
			$userdata['message'] = 'Please enter the zip_code';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}

		$rc_array['zip_code'] = $zip_code;
		
		$this->api_model->update('users', 'id', $user_id, $rc_array);
		$user_data = $this->api_model->getsinglerow('users', 'id', $user_id);
		unset($user_data['password']);
		unset($user_data['main_admin_id']);
		$user_data['user_image'] = !empty($user_data['user_image']) ? base_url().'uploads/user_images/'.$user_data['user_image'] : ''; 
		$userdata['message'] = 'Zip code update successfully';
		$userdata['status'] = 'true';
		$userdata['details']= $user_data;
		echo json_encode($userdata);
		exit;
	}

	public function change_password(){

		$user_id = $this->input->post('user_id');
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');

		$old_password = sha1($old_pass);
		$new_password = sha1($new_pass);
		

		if(empty($user_id)){
			$userdata['message'] = 'Required user_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($old_pass)){
			$userdata['message'] = 'Required old_pass';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($new_pass)){
			$userdata['message'] = 'Required new_pass';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		$exist = $this->api_model->check_pass('users', 'id', $user_id, 'password', $old_password);

		if($exist == 0){
			$userdata['message'] = 'Invalid old password';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		$rc_array['password'] = $new_password;
		$this->api_model->update('users', 'id', $user_id, $rc_array);
		$userdata['message'] = 'Password changed successfully';
		$userdata['status'] = 'true';
		echo json_encode($userdata);
		exit;
	}

	public function get_state(){

		$state_data = $this->api_model->getstate();
		$userdata['message'] = 'Get state list';
		$userdata['status'] = 'true';
		$userdata['details']= $state_data;
		echo json_encode($userdata);
		exit;
	}

	public function get_city(){

		$state_id = $this->input->post('state_id');
		
		if(empty($state_id)){	
			$userdata['message'] = 'Required state_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}	
		$state_data = $this->api_model->getsingle_list('city_master', 'state_id', $state_id);
		$userdata['message'] = 'Get state list';
		$userdata['status'] = 'true';
		$userdata['details']= $state_data;
		echo json_encode($userdata);
		exit;
	}
}
