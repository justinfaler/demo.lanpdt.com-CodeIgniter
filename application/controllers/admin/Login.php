<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');

    }
	public function index()
	{
		
		$this->load->view('admin/login_view.php');
	}

	public function check_auth(){

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$password_to = sha1($password);
		$exist = $this->sys_model->check_pass('users', 'email_address', $email, 'password', $password_to);
		if($exist == 1){
			$user_data = $this->sys_model->getsinglerow('users', 'email_address', $email);
			
			if($user_data->user_role == 1 OR $user_data->user_role == 2){
				$this->session->set_userdata('userdata_list', $user_data);
				echo $exist;
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

	public function logout(){

		$this->session->unset_userdata('userdata_list');
		redirect(base_url().'admin');
	}

	public function set_password($id){

		$data['franch_id'] = $id;
		$this->load->view('admin/set_password_view',$data);
	}

	public function set_password_proc(){

		$frac_id = $this->input->post('frac_id');
		$password = $this->input->post('password');
		if(!empty($password)){
			$fin_password = sha1($password);
			$rc_array['password'] = $fin_password;
		}
		$this->sys_model->update('users', 'id', $frac_id, $rc_array);
		echo 1;
		exit;
	}

	public function forgot_pass(){

		$email = $this->input->post('email');

		$exit = 0;
		$user_data = $this->sys_model->getsinglerow('users', 'email_address', $email);
		if(isset($user_data)){
			if(!empty($user_data->user_role)){
				if($user_data->user_role == 1 OR $user_data->user_role == 2){
					$url = base_url().'forgot_admin/'.$user_data->id;

			        $htmlContent = '<p>Hello, '.$user_data->first_name.'</p>';
			        $htmlContent .= '<h4>Please click on this link to change your password.</h1>';
			        $htmlContent .= '<a href="'.$url.'">Change Password</a>';
			        $htmlContent .= '<p>Thanks</p>';
			        $htmlContent .= '<p>The CPA2GO Team.</p>';
			        $subject = 'Forgot Password';
					 send_email_live($email, $htmlContent, $subject);
					//send_email($email, $htmlContent, $subject);
					$exit = 1;
				}
			}	
		}	
		echo $exit;
		exit;
	}


	public function show_forgot_form($user_id){

		$data['user_id'] = $user_id;
		$this->load->view('admin/forgot_page', $data); 
	}

	

	public function change_forgot(){

		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');
		$new_password = sha1($password);
		$rc_array['password'] = $new_password;
		$this->sys_model->update('users', 'id', $user_id, $rc_array);
		echo '1';
		exit;
	}
	
}
