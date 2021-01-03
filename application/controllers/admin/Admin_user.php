<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');

        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));

    }
	public function index()
	{	
		$data['user_list'] = $this->sys_model->get_list_with_join('users', 'user_role', '2');
		$this->load->view('admin/header.php');
		$this->load->view('admin/admin_user_list.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function add_admin_form(){
		
		$data['years'] = exp_year();
		$data['month'] = exp_month();
		$data['state_list'] = $this->sys_model->getstate();
	
		$this->load->view('admin/header.php');
		$this->load->view('admin/add_edit_admin_user.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function edit_admin_form($id){

		$data['user_list'] = $this->sys_model->getsinglerow('users', 'id', $id);
		$data['state_list'] = $this->sys_model->getstate();
		$data['years'] = exp_year();
		$data['month'] = exp_month();	
		
		$this->load->view('admin/header.php');
		$this->load->view('admin/add_edit_admin_user.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function add_edit_process(){

		$user_id = $this->input->post('user_id');
		$password = $this->input->post('password');
		$email = $this->input->post('email_address');
		$user_name = $this->input->post('user_name');
		$first_name = $this->input->post('first_name');
		
		$fin_password = sha1($password);

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
			$rc_array['date_of_birth'] =  formatdate($this->input->post('date_of_birth'), 'Y-m-d');
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
		if(!empty($this->input->post('office_phone'))){
			$rc_array['office_phone'] = $this->input->post('office_phone');
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
		
		$rc_array['user_role'] = 2;
		
		if(empty($user_id) AND $user_id == ''){

			$sess_zip_code = $this->session->userdata('assign_zipcode');
			if(isset($sess_zip_code)){
				$rc_array['assign_zip_code'] = implode(',', $sess_zip_code);
			}	

			$rc_array['created_date'] = date('Y-m-d h:i:s', time());	
			$exist = $this->sys_model->check_email('users', 'email_address', $email);
			if($exist == 1){
				echo '0';
				exit;
			}else{
				
				//$this->sendemail($email, $password, $user_name);
				$id = $this->sys_model->insert_data('users', $rc_array);
				$this->session->unset_userdata('assign_zipcode');
				$url = base_url().'admin/login/set_password/'.$id;
				$image_url = base_url().'assets/front/image/main_logo.png';
		        $htmlContent = '<p>Hello, '.$first_name.'</p>';
		        $htmlContent .= '<h4>You are successfully registered as a Franchisee</h1>';
		        // $htmlContent .= '<p>Url : '.$url.' </p>';
		        $htmlContent .= '<p>Email : '.$email.' </p>';
		        // $htmlContent .= '<p>Password : '.$password.' </p>';
		        $htmlContent .= '<a href="'.$url.'">Please set your password</a>';
		        $htmlContent .= '<p>Thanks</p>';
		        $htmlContent .= "<img src='".$image_url."' width='120' height='70'/>";
		        $htmlContent .= "<p>www.cpa2go.com</p>";
		        $subject = 'Registration Successful';
				send_email_live($email, $htmlContent, $subject);
				//$this->sys_model->insert_data('users', $rc_array);
				echo 'Franchise user added successfully';
				exit;
			}	
		}else{

			$exist = $this->sys_model->check_update_email('users', 'email_address', $email, 'id', $user_id);
			if($exist == 1){
				echo '0';
				exit;
			}else{	
				$this->sys_model->update('users', 'id', $user_id, $rc_array);
				echo 'Franchise user updated successfully';
				exit;
			}	
		}
	}

	public function delete_admin($id){

		$frnc_id = $id;
		// $cust_data = $this->sys_model->getsingle_list('users', 'main_admin_id', $frnc_id);
		// foreach($cust_data AS $val){
		// 	$this->sys_model->delete('customer_tickets', 'customer_id', $val->id);
		// }	
		
		$this->sys_model->delete('customer_tickets', 'main_admin_id', $frnc_id);
		$this->sys_model->delete('users', 'main_admin_id', $frnc_id);
		$this->sys_model->delete('users', 'id', $id);
		$this->session->set_flashdata('delete_msg', 'Franchise user deleted successfully');
		redirect(base_url().'admin_user_list');
	}

	public function view_data(){

		

		$user_id = $this->input->post('user_id');
		$data['user_list'] = $this->sys_model->get_list_with_join('users', 'id', $user_id);
		$assign_zip_code = $data['user_list'][0]->assign_zip_code;
		
		if(!empty($assign_zip_code)){
			$zip_arr = explode(',', $assign_zip_code);
			$state = array();
			foreach($zip_arr AS $val){
				$sate_data = $this->get_state_using_zip($val);
				$state[] = !empty($sate_data) ? $sate_data : ''; 
			}
			if(!empty($state[0])){
				$data['user_list'][0]->assign_state = implode(',', $state);
			}		
		}
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';die;
		// exit;
		$this->load->view('admin/ajax_admin_view', $data);
	}

	public function get_state_using_zip($zip_code){

		$response = @file_get_contents('http://api.zippopotam.us/us/'.$zip_code);
		$zip_status = json_decode($response);
		if(isset($zip_status)){
			return $zip_status->places[0]->state;
		}else{
			return;
		}	
		
		
	}

	public function assign_zip_code(){

		$user_id = $this->input->post('user_id');
		$assign_zip = $this->input->post('assign_zip');
		$user_data = $this->sys_model->getsinglerow('users', 'id', $user_id);

		$zip_exist = $this->sys_model->check_zipcode($assign_zip);
		if(count($zip_exist) != 0){
			echo '0';
			exit;
		}
		
		if(!empty($user_data->assign_zip_code)){
			$zipcode_arr = explode(',', $user_data->assign_zip_code);
			array_push($zipcode_arr, $assign_zip);
			$zipcode_data = implode(',', $zipcode_arr);
			$rc_array['assign_zip_code'] = $zipcode_data;
			$this->sys_model->update('users', 'id', $user_id, $rc_array);
			$html_inner = '';
			foreach($zipcode_arr AS $val){
				$html_inner .= "<div class='col-lg-2'>";
				$html_inner .= "<p class='btn btn-secondary'>".$val."&nbsp;&nbsp;&nbsp; <span class='zip_del' data-zip='".$val."'><i class='fa fa-times'></i></span></p>";
				$html_inner .= "&nbsp;";
				$html_inner .= "</div>";
			}
			echo $html_inner;
			exit;
		}else{
			$rc_array['assign_zip_code'] = $assign_zip;
			$this->sys_model->update('users', 'id', $user_id, $rc_array);
			$html_inner = '';
			$html_inner .= "<p class='btn btn-secondary'>".$assign_zip."&nbsp;&nbsp;&nbsp; <span class='zip_del' data-zip='".$assign_zip."'><i class='fa fa-times'></i></span></p>";
			$html_inner .= "&nbsp;";
			
			echo $html_inner;
			exit;
		}	
	}

	public function assign_zip_code_add(){

		$string_zip = $this->input->post('assign_zip');
		$assign_zip[] = $this->input->post('assign_zip');
		$sess_zip_code = $this->session->userdata('assign_zipcode');
		// $next_assign_zip = array();

		$zip_exist = $this->sys_model->check_zipcode($string_zip);
		if(count($zip_exist) != 0){
			echo '0';
			exit;
		}
		
		if(isset($sess_zip_code)){
			if(in_array($string_zip, $sess_zip_code)){
				echo '0';
				exit;
			}
			$next_assign_zip = array_merge($sess_zip_code, $assign_zip);
			$this->session->set_userdata('assign_zipcode', $next_assign_zip);
			$sess_next_zip_code = $this->session->userdata('assign_zipcode');

			$html_inner = '';
			foreach($sess_next_zip_code AS $val){
				$html_inner .= "<div class='col-lg-2'>";
				$html_inner .= "<p class='btn btn-secondary'>".$val."&nbsp;&nbsp;&nbsp; <span class='zip_del' data-zip='".$val."'><i class='fa fa-times'></i></span></p>";
				$html_inner .= "&nbsp;";
				$html_inner .= "</div>";
			}
			echo $html_inner;
			exit;
		}else{

			$this->session->set_userdata('assign_zipcode', $assign_zip);
			$sess_zip_code = $this->session->userdata('assign_zipcode');

			$html_inner = '';
			foreach($sess_zip_code AS $val){
				$html_inner .= "<p class='btn btn-secondary'>".$val."&nbsp;&nbsp;&nbsp; <span class='zip_del' data-zip='".$val."'><i class='fa fa-times'></i></span></p>";
				$html_inner .= "&nbsp;";
			}
			echo $html_inner;
			exit;
		}

	}

	public function export_ticket_details(){

		$start_date = date('Y-m-d h:i:s', strtotime($this->input->get('start_date')));
		$end_date = date('Y-m-d h:i:s', strtotime($this->input->get('end_date')));

		// echo $start_date.' '.$end_date;
		// exit;

		$admin_data = $this->sys_model->getsingle_list('users', 'user_role', '2');
		$data_arr = array();
		
		foreach($admin_data AS $a_key=>$a_val){

			$data_arr[$a_key]['frn'] = $a_val->first_name.' '.$a_val->last_name; 
			
			$tickets = $this->sys_model->getsingle_list('customer_tickets', 'main_admin_id', $a_val->id);	
			
			//$received = count($tickets);
			$data_arr[$a_key]['received'] = 0;
			if(!empty($tickets)){	
				$received = 1;
				$i = 1;
				$j = 1;
				foreach($tickets AS $t_val){
					if($start_date <= $t_val->start_date AND $end_date >= $t_val->start_date){
						$data_arr[$a_key]['received'] = $received; 	
						$data_arr[$a_key]['answerd'] = '';
						$data_arr[$a_key]['earnings'] = '';
						$data_arr[$a_key]['cancelled'] = '';
						$data_arr[$a_key]['cancellation_rate'] = '';
						if($t_val->qus_states == 2){
							$tot_answerd = $i++;
							$data_arr[$a_key]['answerd'] = $tot_answerd;
							$data_arr[$a_key]['earnings'] = '$'.($tot_answerd*40);
						}

						if($t_val->ticket_status == 3){
							$data_arr[$a_key]['cancelled'] = $j++;
							$data_arr[$a_key]['cancellation_rate'] = '0.00%';
						}
						$data_arr[$a_key]['date'] = $t_val->start_date;
						$received ++;
					}
				}	
			}	
		}
		
		$this->load->helper('csv');
        $p_data = date('M-d-y', strtotime($start_date)).' - '.date('M-d-y', strtotime($end_date));
        $array[0] = array("Period", $p_data);
        $array[1] = array("Franchisee Name","Tickets Received","Tickets Answered", "Tickets Cancelled", "Cancellation Rate", "Earnings");
      	
      	$cancelled = 0;
      	$cancellation_rate = '0.00%';
      	$a=2;
      	
      	foreach($data_arr AS $d_val){
      		if($d_val['received'] != 0){
      			if(!empty($d_val['cancelled'])){
      				$cancelled = $d_val['cancelled'];
      			}else{
      				$cancelled = 0;
      			}
      			$cancellation_rate = '0.00%';
      			if($cancelled != 0){
      				
      				$cancellation_rate = number_format((($cancelled/$d_val['received'])*100),2).'%';
      			}
      			
		      	$array[$a] = array($d_val['frn'], $d_val['received'], $d_val['answerd'], $cancelled, $cancellation_rate, $d_val['earnings']);
		      	$a++;
		    }  		
      	}
        //$this->load->helper("csv");
        array_to_csv($array, "Tickets_export.csv");
	}

	public function delete_zip_code(){

		$user_id = $this->input->post('user_id');
		$zip_code = $this->input->post('zip_code');

		$user_data = $this->sys_model->getsinglerow('users', 'id', $user_id);
		if(!empty($user_data->assign_zip_code)){
			$zipcode_arr = explode(',', $user_data->assign_zip_code);
			$pos = array_search($zip_code, $zipcode_arr);
			unset($zipcode_arr[$pos]);

			$zipcode_data = implode(',', $zipcode_arr);
			$rc_array['assign_zip_code'] = $zipcode_data;
			$this->sys_model->update('users', 'id', $user_id, $rc_array);
			$html_inner = '';
			foreach($zipcode_arr AS $val){
				$html_inner .= "<div class='col-lg-2'>";
				$html_inner .= "<p class='btn btn-secondary'>".$val."&nbsp;&nbsp;&nbsp; <span class='zip_del' data-zip='".$val."'><i class='fa fa-times'></i></span></p>";
				$html_inner .= "&nbsp;";
				$html_inner .= "</div>";
			}
			echo $html_inner;
			exit;
		}
	}

	public function delete_zip_code_add(){

		$zip_code = $this->input->post('zip_code');
		$sess_zip_code = $this->session->userdata('assign_zipcode');

		if (($key = array_search($zip_code, $sess_zip_code)) !== false) {
		    unset($sess_zip_code[$key]);
		}
		$this->session->set_userdata('assign_zipcode', $sess_zip_code);
		$sess_zip_codes = $this->session->userdata('assign_zipcode');

		$html_inner = '';
		foreach($sess_zip_codes AS $val){
			$html_inner .= "<div class='col-lg-2'>";
			$html_inner .= "<p class='btn btn-secondary'>".$val."&nbsp;&nbsp;&nbsp; <span class='zip_del' data-zip='".$val."'><i class='fa fa-times'></i></span></p>";
			$html_inner .= "&nbsp;";
			$html_inner .= "</div>";
		}
		echo $html_inner;
		exit;
	}

	public function session_destroy_zipcode(){

		$this->session->unset_userdata('assign_zipcode');
		exit;
	}

	public function sendemail(){

		$email = 'jignesh.gambhava@metizsoft.com';
		$this->load->library('email');
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
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
        $htmlContent = '<p>Hello</p>';
        $htmlContent .= '<h4>Youe register successfully in CPA2GO as Admin</h1>';
        // $htmlContent .= '<p>Url : '.$url.' </p>';
        // $htmlContent .= '<p>Email : '.$email.' </p>';
        // $htmlContent .= '<p>Password : '.$pass.' </p>';
        // $htmlContent .= '<p>Please change your password</p>';
        // $htmlContent .= '<p>Thanks</p>';

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

	// public function send_email1(){

		
	// 	$to = "jignesh.gambhava@metizsoft.com";
 //         $subject = "This is subject";
         
 //         $message = "<b>This is HTML message.</b>";
 //         $message .= "<h1>This is headline.</h1>";
         
 //         $header = "From:metizdev@gmail.com \r\n";
 //         //$header .= "Cc:afgh@somedomain.com \r\n";
 //         $header .= "MIME-Version: 1.0\r\n";
 //         $header .= "Content-type: text/html\r\n";
         
 //         $retval = mail ($to,$subject,$message,$header);
         
 //         echo '<pre>';
 //         print_r($retval);
 //         echo '</pre>';die;

 //         if( $retval == true ) {
 //            echo "Message sent successfully...";
 //         }else {
 //            echo "Message could not be sent...";
 //         }
	// }
}
