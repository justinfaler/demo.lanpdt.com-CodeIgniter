<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_api extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        ini_set('display_errors','off');
        parent::__construct();

        $this->load->model('api_model');

    }
	public function index(){


		$email_address = $this->input->post('email_address');
		$password = $this->input->post('password');
		$device_token = $this->input->post('device_token');
		$device_type = $this->input->post('device_type');
		$fin_password = sha1($password);

		
		
		if(empty($email_address) AND $email_address == ''){	
			$userdata['message'] = 'Please enter the email address';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}	
		
		if(empty($password) AND $password == ''){	
			$userdata['message'] = 'Please enter the password';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}

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

		log_message('error', 'Login email_address' . $email_address);
		log_message('error', 'Login password' . $password);
		log_message('error', 'Login device_token' . $device_token);
		log_message('error', 'Login device_type' . $device_type);
		log_message('error', 'Login fin_password' . $fin_password);
			
		
		$exist = $this->api_model->check_pass('users', 'email_address', $email_address, 'password', $fin_password);
		
		if($exist == 1){

			
			$rc_arr['device_token'] = $device_token;
			$rc_arr['device_type'] = $device_type;
			$rc_arr['active'] = 1;
			$this->api_model->update('users', 'email_address', $email_address, $rc_arr);
			
			$user_data = $this->api_model->getsinglerow('users', 'email_address', $email_address);
			
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
			
			
	
			$this->db->order_by("id", "desc");
			$this->db->where('user_id', $user_data['id']);
			$this->db->select('*');
			$this->db->from('user_plan_history');
			$query1 = $this->db->get();
			$package_data=$query1->row();  
			
			
			$userdata['message'] = 'Login successfully';
			$userdata['status'] = 'true';
			
			$userdata['details'] = $user_data;
			$userdata['details']['package_data'] = $package_data;
			echo json_encode($userdata);

			//log_message('error', 'Login Output' . json_encode($userdata));
			exit;	
		}else{
			$userdata['message'] = 'Your email address OR password invalid';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			log_message('error', 'Login output' . json_encode($userdata));
			exit;
		}	
	}

	public function logout(){

		$user_id = $this->input->post('user_id');
		//$device_token = $this->input->post('device_token');
		if(empty($user_id) AND $user_id == ''){	
			$userdata['message'] = 'Please enter the user_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}

        log_message('error', 'LogOut:'.$user_id);

		$rc_arr['device_token'] = '';
		$rc_arr['device_type'] = '';
		$rc_arr['active'] = 0;
		$this->api_model->update('users', 'id', $user_id, $rc_arr);

		$userdata['message'] = 'Logout successfully';
		$userdata['status'] = 'true';
		echo json_encode($userdata);

        log_message('error', 'LogOut' . json_encode($userdata));

		exit;
	}

	public function forgot_pass(){

		$email_address = $this->input->post('email_address');
		//$device_token = $this->input->post('device_token');
		if(empty($email_address) AND $email_address == ''){	
			$userdata['message'] = 'Please enter the email_address';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;	
		}
		$user_data = $this->api_model->getsinglerow('users', 'email_address', $email_address);
		// echo '<pre>';
		// print_r($user_data);
		// echo '</pre>';
		// exit;
		if(!empty($user_data['id']) AND ($user_data['user_role'] == 3 OR $user_data['user_role'] == 4)){
			$url = base_url().'forgot/'.$user_data['id'];

			$image_url = base_url().'assets/front/image/main_logo.png';
	        $htmlContent = '<p>Hello, '.$user_data['first_name'].'</p>';
	        $htmlContent .= '<h4>Please click on this link to change your password.</h4>';
	        $htmlContent .= '<a href="'.$url.'">Change Password</a>';
	        $htmlContent .= '<p>Thanks</p>';
	        $htmlContent .= '<p>The CPA2GO Team.</p>';
	        $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
	        $subject = 'Forgot Password';
			
			send_email_live($email_address, $htmlContent, $subject);
			//send_email($for_email, $htmlContent, $subject);
			$userdata['message'] = 'Please check your email address to reset your password.';
			$userdata['status'] = 'true';
			echo json_encode($userdata);
			exit;
		}else{
			$userdata['message'] = 'Please enter the valid email address';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
	}
}
