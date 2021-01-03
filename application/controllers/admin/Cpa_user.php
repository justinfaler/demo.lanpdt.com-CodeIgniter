<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpa_user extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');
        $this->load->model('cpa_model');

        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));

    }
	public function index()
	{

		$userdata = $this->session->userdata('userdata_list');
		
		if($userdata->user_role == 1){
			$data['user_list'] = $this->sys_model->getsingle_list('users', 'user_role', '3');
			$data['admin_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '2');
			
		}elseif($userdata->user_role == 2){
			$data['user_list'] = $this->cpa_model->get_cpa_list('users', 'user_role', '3', 'main_admin_id', $userdata->id);
		}

		$this->load->view('admin/header.php');
		$this->load->view('admin/cpa_user_list.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function add_cpa_form(){
		
		$data['state_list'] = $this->sys_model->getstate();
		$data['years'] = exp_year();
		$data['month'] = exp_month();		
		$this->load->view('admin/header.php');
		$this->load->view('admin/add_edit_cpa_user.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function edit_cpa_form($id){

		$data['user_list'] = $this->sys_model->getsinglerow('users', 'id', $id);
		$data['state_list'] = $this->sys_model->getstate();
		$admin_list = $this->sys_model->getsinglerow('users', 'id', $data['user_list']->main_admin_id);
		$data['admin_name'] = $admin_list->first_name.' '.$admin_list->last_name;
		$data['years'] = exp_year();
		$data['month'] = exp_month();	
		
		$this->load->view('admin/header.php');
		$this->load->view('admin/add_edit_cpa_user.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function add_edit_process(){

		$sess_user_data = $this->session->userdata('userdata_list');	

		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');
		$email = $this->input->post('email_address');
		$user_name = $this->input->post('user_name');
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
		// if(!empty($this->input->post('date_of_birth'))){
		// 	$rc_array['date_of_birth'] = $this->input->post('date_of_birth');
		// }
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
		if(!empty($this->input->post('license_number'))){
			$rc_array['license_number'] = $this->input->post('license_number');
		}
		// if(!empty($this->input->post('pay_card_number'))){
		// 	$rc_array['pay_card_number'] = $this->input->post('pay_card_number');
		// }
		// if(!empty($this->input->post('pay_name_on_card'))){
		// 	$rc_array['pay_name_on_card'] = $this->input->post('pay_name_on_card');
		// }
		// if(!empty($this->input->post('pay_month'))){
		// 	$rc_array['pay_month'] = $this->input->post('pay_month');
		// }
		// if(!empty($this->input->post('pay_year'))){
		// 	$rc_array['pay_year'] = $this->input->post('pay_year');
		// }
		// if(!empty($this->input->post('pay_cvv'))){
		// 	$rc_array['pay_cvv'] = $this->input->post('pay_cvv');
		// }
		if(!empty($password)){
			$fin_password = sha1($password);
			$rc_array['password'] = $fin_password;
		}
		

		$rc_array['user_role'] = 3;
		$rc_array['main_admin_id'] = $sess_user_data->id;

		if(empty($user_id) AND $user_id == ''){
			$rc_array['created_date'] = date('Y-m-d h:i:s', time());
			$exist = $this->sys_model->check_email('users', 'email_address', $email);
			if($exist == 1){
				echo '0';
				exit;
			}else{	
				//$this->sendemail($email, $password, $user_name);
				$id = $this->sys_model->insert_data('users', $rc_array);
				$url = base_url().'customer_register/set_pass/'.$id;
				$image_url = base_url().'assets/front/image/main_logo.png';
		        $htmlContent = '<p>Hello, '.$first_name.'</p>';
		        $htmlContent .= '<h4>You are successfully registered as a CPA</h1>';
		        //$htmlContent .= '<p>Url : '.$url.' </p>';
		        $htmlContent .= '<p>Email : '.$email.' </p>';
		        //$htmlContent .= '<p>Password : '.$password.' </p>';
		        $htmlContent .= '<a href="'.$url.'">Please change your password</a>';
		        $htmlContent .= '<p>Thanks</p>';
		        $htmlContent .= "<img src='".$image_url."' width='120' height='70'/>";
		        $htmlContent .= "<p>www.cpa2go.com</p>";
		        $subject = 'Registration Successful';
		         
				send_email_live($email, $htmlContent, $subject);
				//send_email($email, $htmlContent, $subject);
				echo 'CPA user added successfully';
				exit;
			}	
		}else{
			$exist = $this->sys_model->check_update_email('users', 'email_address', $email, 'id', $user_id);
			if($exist == 1){
				echo '0';
				exit;
			}else{	
				$this->sys_model->update('users', 'id', $user_id, $rc_array);
				echo 'CPA user updated successfully';
				exit;
			}	
		}
	}

	public function delete_cpa($id){

		$this->sys_model->delete('customer_tickets', 'cpa_id', $id);
		$this->sys_model->delete('users', 'id', $id);
		$this->session->set_flashdata('delete_msg', 'CPA user deleted successfully');
		redirect(base_url().'cpa_user_list');
	}

	public function view_data(){
		
		$user_id = $this->input->post('user_id');
		$data['user_list'] = $this->sys_model->get_list_with_join('users', 'id', $user_id);
		$admin_list = $this->sys_model->getsinglerow('users', 'id', $data['user_list'][0]->main_admin_id);
		$data['admin_name'] = $admin_list->first_name.' '.$admin_list->last_name;
		$data['assign_zip_code'] = $admin_list->assign_zip_code;
		$this->load->view('admin/ajax_cpa_view', $data);

	}

	public function sendemail($email, $pass, $user_name){

		$this->load->library('email');
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'metizdev@gmail.com',
            'smtp_pass' => '123metizdev$',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $url = base_url().'admin';
        $htmlContent = '<p>Hello, '.$user_name.'</p>';
        $htmlContent .= '<h4>Youe register successfully in CPA2GO as CPA</h1>';
        $htmlContent .= '<p>Url : </p>';
        $htmlContent .= '<p>Email : '.$email.' </p>';
        $htmlContent .= '<p>Password : '.$pass.' </p>';
        $htmlContent .= '<p>Please change your password</p>';
        $htmlContent .= '<p>Thanks</p>';

        $this->email->to($email);
        $this->email->from('metizdev@gmail.com','MyWebsite');
        $this->email->subject('Register Successfully');
        $this->email->message($htmlContent);

        if($this->email->send())
	    {
	    	return; 
	    }else{
	    	show_error($this->email->print_debugger());
	    }


	}

	public function ajax_get_filter_user(){

		$admin_id = $this->input->post('admin_id');

		if(!empty($admin_id)){
			$cpa_data = $this->sys_model->getsingle_list('users', 'main_admin_id', $admin_id);
		}else{
			$cpa_data = $this->sys_model->getsingle_list('users', 'user_role', '3');
		}
		
		$html_inner = '';
		$alldata['data'] = array();
		$i=1;
		foreach($cpa_data AS $key=>$val){
			
			$html_inner = "<a href='".base_url()."cpa_user_edit/".$val->id."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit'><i class='la la-edit'></i></a>
				<a href='#' class='btn btn-sm btn-clean btn-icon btn-icon-md view_cpa' title='Delete' data-toggle='modal' data-target='#setting_popup' data-user-id='".$val->id."'><i class='la la-eye'></i></a>
				<a href='".base_url()."cpa_user_delete/".$val->id."' class='btn btn-sm btn-clean btn-icon btn-icon-md delete_admin' onclick='return confirm('Are you sure you want to delete?')' title='Delete' ><i class='la la-trash'></i></a>";	

			$alldata['data'][$key] = array($i, $val->first_name, $val->last_name, $val->email_address, $val->phone_number, $html_inner);
			$i++;
		}

		// echo '<pre>';
		// print_r($alldata);
		// echo '</pre>';die;

		$result = json_encode($alldata);
        echo $result;
        exit;
	}
}
