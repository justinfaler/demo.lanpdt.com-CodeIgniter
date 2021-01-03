<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_register extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();
        
        $this->load->library('facebook');
        $this->load->model('front_model');
        $this->load->model('sys_model');

        //if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));
    }
    public function index(){
    		
    	$data['land_quas'] = $this->input->post('land_quas');
    	$data['state_master'] = $this->sys_model->getstate();
    	$this->load->view('register_page', $data);
    }
    public function faq(){   
		//$this->load->view('header');
		$this->load->view('faq');
		//$this->load->view('footer');
  }
	public function register_pro()
	{	
		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');
		$email = $this->input->post('email_address');
		$user_name = $this->input->post('user_name');
		$user_role = $this->input->post('user_role');
		$first_name = $this->input->post('first_name');
		if(!empty($this->input->post('first_name'))){
			$rc_array['first_name'] = $this->input->post('first_name');
		}
		if(!empty($this->input->post('last_name'))){
			$rc_array['last_name'] = $this->input->post('last_name');
		}
		if(!empty($this->input->post('user_name'))){
			$rc_array['user_name'] = $this->input->post('user_name');
		}
		if(!empty($this->input->post('email_address'))){
			$rc_array['email_address'] = $this->input->post('email_address');
		}
		if(!empty($this->input->post('date_of_birth'))){
			$rc_array['date_of_birth'] =  date('Y-m-d', strtotime($this->input->post('date_of_birth')));
		}
		if(!empty($this->input->post('phone_number'))){
			$rc_array['phone_number'] = $this->input->post('phone_number');
		}
		
		$rc_array['company_name'] = $this->input->post('company_name');
		
		$rc_array['web_address'] = $this->input->post('web_address');
		
		if(!empty($this->input->post('address'))){
			$rc_array['address'] = $this->input->post('address');
		}
		if(!empty($this->input->post('state'))){
			$rc_array['state'] = $this->input->post('state');
		}
		if(!empty($this->input->post('city'))){
			$rc_array['city'] = $this->input->post('city');
		}
		if(!empty($this->input->post('zip_code'))){
			$rc_array['zip_code'] = $this->input->post('zip_code');
		}
		if(!empty($password)){
			$fin_password = sha1($password);
			$rc_array['password'] = $fin_password;
		}

		$rc_array['cpa_description'] = $this->input->post('cpa_description');
		$rc_array['cpa_service'] = $this->input->post('cpa_service');

		$browser_name =  browser_list();   
    	if(!empty($browser_name)){
			$rc_array['browser_type'] = $browser_name;
    	}
		
		if(!empty($user_role)){
			$rc_array['user_role'] = $user_role;	
		}else{
			$rc_array['user_role'] = '4';
		}
		$rc_array['created_date'] = date('Y-m-d h:i:s', time());


		if (!empty($_FILES['user_image']['name'])) {
			
			$config['upload_path']   = './uploads/user_images/'; 
	        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 	
	        $config['file_name'] = time() .'_' . $_FILES['user_image']['name'];
	        $this->load->library('upload', $config);
				
	        if ( ! $this->upload->do_upload('user_image')) {
	            $error = array('error' => $this->upload->display_errors()); 
	            $this->load->view('upload_form', $error); 
	        }else { 
	            $uplod_data = array('upload_data' => $this->upload->data()); 
	            $rc_array['user_image'] = $uplod_data['upload_data']['file_name'];

	            $image_path = base_url().'/uploads/user_images/'.$uplod_data['upload_data']['file_name'];

	   //          $exif = exif_read_data($image_path); //parameter should be image path

				// if(isset($exif['Orientation'])) {

				//     if($exif['Orientation'] === 1) print 'rotated clockwise by 0 deg (nothing)';

				//     if($exif['Orientation'] === 8) print 'rotated clockwise by 90 deg';

				//     if($exif['Orientation'] === 3) print 'rotated clockwise by 180 deg';

				//     if($exif['Orientation'] === 6) print 'rotated clockwise by 270 deg';

				//     if($exif['Orientation'] === 2) print 'vertical flip, rotated clockwise by 0 deg';

				//     if($exif['Orientation'] === 7) print 'vertical flip, rotated clockwise by 90 deg';

				//     if($exif['Orientation'] === 4) print 'vertical flip, rotated clockwise by 180 deg';

				//     if($exif['Orientation'] === 5) print 'vertical flip, rotated clockwise by 270 deg';

				// }

				
	            //$uplod_data['upload_data']['file_name']

	            //$this->load->view('upload_success', $data); 
	        } 
        }

		if(empty($user_id) AND $user_id == ''){
			$exist = $this->front_model->check_email('users', 'email_address', $email);
			if($exist == 1){
				echo '0';
				exit;
			}else{
				$id = $this->front_model->insert_data('users', $rc_array);

				$user_data = $this->front_model->getsinglerow('users', 'id', $id);
				$this->session->set_userdata('user_front', $user_data);

				$image_url = base_url().'assets/front/image/main_logo.png';
				$login_url = base_url().'login';
				$htmlContent = "<p>Hello, ".$first_name."</p>";
		        $htmlContent .= "<h4>You are successfully registered in CPA2GO</h4>";
		        $htmlContent .= "<p>Login : ".$login_url."</p>";
		        $htmlContent .= "<p>Thanks</p>";
		        $htmlContent .= "<img src='".$image_url."' width='120' height='70'/>";
		        $htmlContent .= "<p>www.cpa2go.com</p>";
		        $subject = 'Registration Successful';
				send_email_live($email, $htmlContent, $subject);
				$this->session->set_flashdata('succ_register', 'Your register successfully');
				echo 'add';
				exit;
			}	
		}else{
			$exist = $this->front_model->check_update_email('users', 'email_address', $email, 'id', $user_id);
			if($exist == 1){
				echo '0';
				exit;
			}else{	
				$this->front_model->update('users', 'id', $user_id, $rc_array);
				$user_data = $this->front_model->getsinglerow('users', 'id', $user_id);
				$this->session->set_userdata('user_front', $user_data);
				$this->session->set_flashdata('update_profile', 'Your profile updated successfully');
				echo 'update';
				exit;
			}	
		}
	}

	public function customer_profile(){
		$user = $this->session->userdata('user_front');
        if($this->session->userdata('user_front') == FALSE OR $user->user_role != 4) redirect(base_url('login'));
        //$data['user_data'] = $this->session->userdata('user_front');
        
		$data['state_master'] = $this->sys_model->getstate();
		$this->load->view('header');
		$this->load->view('profile_view', $data);
		$this->load->view('footer');
	}

	public function change_password(){

		$user_data = $this->session->userdata('user_front');
		//$user_id = $this->input->post('user_id');
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		
		$old_password = sha1($old_pass);
		$new_password = sha1($new_pass);
		
		$exist = $this->front_model->check_pass('users', 'id', $user_data->id, 'password', $old_password);

		if($exist == 0){
			
			echo $exist;
			exit;
		}

		$rc_array['password'] = $new_password;
		$this->front_model->update('users', 'id', $user_data->id, $rc_array);
		echo $exist;
		exit;
	}

	public function login(){

		$this->load->view('login_page');
	}
	
	public function login_process(){

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password_to = sha1($password);
		
		

		$exist = $this->front_model->check_pass('users', 'email_address', $email, 'password', $password_to);
		
		if($exist == 1){
			$user_data = $this->front_model->getsinglerow('users', 'email_address', $email);
			$rc_arr['active'] = 1;

			$browser_name =  browser_list();   
	    	if(!empty($browser_name)){
				$rc_arr['browser_type'] = $browser_name;
	    	}
			//echo "<pre>"; print_r($user_data); exit;
			$this->front_model->update('users', 'email_address', $email, $rc_arr);
			//echo $user_data->user_role; exit;
			if($user_data->user_role == 3 OR $user_data->user_role == 4){
				$this->session->set_userdata('user_front', $user_data);
				echo $user_data->user_role;
				exit;
			}else{
				echo '0';
				exit;
			}	
		}else{
			echo $exist;
			exit;
		}	
	}

	public function update_zip_code(){

		$user_id = $this->input->post('user_id');
		$zipcode = $this->input->post('zipcode');
		$rc_array['zip_code'] = $zipcode;
		$this->front_model->update('users', 'id', $user_id, $rc_array);
		$user_data = $this->front_model->getsinglerow('users', 'id', $user_id);
        $this->session->set_userdata('user_front', $user_data);
		echo 1;
	}

	public function forgot_password(){

		$for_email = $this->input->post('for_email');
		$user_data = $this->front_model->getsinglerow('users', 'email_address', $for_email);
		if(!empty($user_data->id) AND ($user_data->user_role == 3 OR $user_data->user_role == 4)){
			$url = base_url().'forgot/'.$user_data->id;

			$image_url = base_url().'assets/front/image/main_logo.png';
	        $htmlContent = '<p>Hello, '.$user_data->first_name.'</p>';
	        $htmlContent .= '<h4>Please click on this link to change your password.</h4>';
	        $htmlContent .= '<a href="'.$url.'">Change Password</a>';
	        $htmlContent .= '<p>Thanks</p>';
	        $htmlContent .= '<p>The CPA2GO Team.</p>';
	        $htmlContent .= "<img src='".$image_url."' width='120' height='70'/>";
	        $subject = 'Forgot Password';
			
			send_email_live($for_email, $htmlContent, $subject);
			//send_email($for_email, $htmlContent, $subject);
			echo '1';
		}else{
			echo '0';
		}
	}

	public function forgot($user_id){
		$data['user_id'] = $user_id;
		$this->load->view('forgot_view', $data);	
	}

	public function change_forgot(){

		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');
		$new_password = sha1($password);
		$rc_array['password'] = $new_password;
		$this->front_model->update('users', 'id', $user_id, $rc_array);
		echo '1';
		exit;
	}

	public function set_pass($user_id){

		$data['user_id'] = $user_id;
		$this->load->view('set_pass_view',$data);
	}

	public function logout(){
		$user_data = $this->session->userdata('user_front');
		$rc_arr['active'] = 0;
		$this->front_model->update('users', 'email_address', $user_data->email_address, $rc_arr);	
		$this->session->unset_userdata('user_front');
		redirect(base_url().'customer_register/login');
	}
}
