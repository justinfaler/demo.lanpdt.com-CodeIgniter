<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');
        
        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));
      
    }
	public function index()
	{

		$user = $this->session->userdata('userdata_list');
		$data['state_master'] = $this->sys_model->getstate();
		$data['profile_data'] = $this->sys_model->get_list_with_join('users', 'id', $user->id);
		// $data['years'] = exp_year();
		// $data['month'] = exp_month();	
		$this->load->view('admin/header.php');
		$this->load->view('admin/profile_view.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function update_profile(){

		$user_id = $this->input->post('user_id');
		
		if(!empty($this->input->post('user_name'))){
			$rc_array['user_name'] = $this->input->post('user_name');
		}
		if(!empty($this->input->post('first_name'))){
			$rc_array['first_name'] = $this->input->post('first_name');
		}
		if(!empty($this->input->post('last_name'))){
			$rc_array['last_name'] = $this->input->post('last_name');
		}
		if(!empty($this->input->post('date_of_birth'))){
			$rc_array['date_of_birth'] = $this->input->post('date_of_birth');
		}
		if(!empty($this->input->post('email_address'))){
			$rc_array['email_address'] = $this->input->post('email_address');
		}
		if(!empty($this->input->post('phone_number'))){
			$rc_array['phone_number'] = $this->input->post('phone_number');
		}
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

		if(!empty($this->input->post('pay_card_number'))){
			$rc_array['pay_card_number'] = $this->input->post('pay_card_number');
		}
		if(!empty($this->input->post('pay_name_on_card'))){
			$rc_array['pay_name_on_card'] = $this->input->post('pay_name_on_card');
		}
		if(!empty($this->input->post('pay_month'))){
			$rc_array['pay_month'] = $this->input->post('pay_month');
		}
		if(!empty($this->input->post('pay_year'))){
			$rc_array['pay_year'] = $this->input->post('pay_year');
		}
		if(!empty($this->input->post('pay_cvv'))){
			$rc_array['pay_cvv'] = $this->input->post('pay_cvv');
		}

		$this->sys_model->update('users', 'id', $user_id, $rc_array);
		echo '1';
		exit;
	}

	public function change_password(){

		$user_id = $this->input->post('user_id');
		$curr_pass = $this->input->post('curr_pass');
		$new_pass = $this->input->post('new_pass');
		$curr_password = sha1($curr_pass);
		$new_password = sha1($new_pass);
		$exit = $this->sys_model->check_pass('users', 'id', $user_id, 'password', $curr_password);
		if($exit == 1){
			$rc_array['password'] = $new_password;
			$this->sys_model->update('users', 'id', $user_id, $rc_array);
			echo $exit;
			exit;
		}else{
			echo $exit;
			exit;
		}
	}
}
