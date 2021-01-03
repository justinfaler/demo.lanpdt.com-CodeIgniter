<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_customer_api extends CI_Controller {

	function __construct() {

        // ini_set('display_errors', 1);
        ini_set('display_errors','off');
        parent::__construct();

        $this->load->model('api_model');

	}
	
	

	public function index(){
		
		$cpa_id = $this->input->post('cpa_id');			
		$customer_id = $this->input->post('customer_id');			
		$question = $this->input->post('question');		
		$qus_type = $this->input->post('qus_type');	
		
		$start_date = date('Y-m-d h:i:s', time());
		$newtimestamp = strtotime($start_date.' + 1440 minute');
		$end_date = date('Y-m-d h:i:s', $newtimestamp);

		if(empty($cpa_id)){
				
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		if(empty($customer_id)){

			$userdata['message'] = 'Required customer_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		if(empty($qus_type)){
			$userdata['message'] = 'Required qus_type';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if($qus_type == 1){
			if(empty($question)){
				$userdata['message'] = 'Required question';
				$userdata['status'] = 'false';
				echo json_encode($userdata);
				exit;
			}
		}	

		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
		$user_deta = $this->api_model->getsinglerow('users', 'id', $customer_id);
	
		$admin_data = $this->api_model->getsinglerow('users', 'id', $cpa_data['main_admin_id']);

		$rc_array['cpa_id'] = $cpa_id;	
		$rc_array['customer_id'] = $customer_id;	
		$rc_array['main_admin_id'] = $admin_data['id'];	
		if(!empty($question)){
			$rc_array['question'] = $question;	
		}
		$rc_array['qus_type'] = $qus_type;	
		$rc_array['ticket_status'] = 1;	
		$rc_array['qus_states'] = 1;	
		$tkt_number = rand(1111111, 9999999);
		$rc_array['ticket_number'] = $tkt_number;
		$rc_array['start_date'] = $start_date;
		$rc_array['end_date'] = $end_date;
		$rc_array['notif_status'] = 1;
		if($user_deta['device_type'] == 'android'){ 
			$device_browser_type = 'Android'; 
		}
		if($user_deta['device_type'] == 'ios'){ 
			$device_browser_type = 'iOS';
		}
		$rc_array['device_browser_type'] = $device_browser_type;
					
		if (!empty($_FILES)) {
            $tempFile   = $_FILES['qus_files']['tmp_name'];
            $temp       = time().'_'.$_FILES["qus_files"]["name"];
            $path_parts = pathinfo($temp);
            $fileNamep   = $path_parts['basename'];
            $targetPath = './uploads/audios/';
            $targetFile = $targetPath . $fileNamep;           
            move_uploaded_file($tempFile, $targetFile);
            $rc_array['qus_files'] = $fileNamep;
        }

		// echo '<pre>';
		// print_r($_FILES);
		// echo '</pre>';die;

   //      if (!empty($_FILES['qus_files']['name'])) {
			
			// $config['upload_path']   = './uploads/user_images/'; 
	  //       $config['allowed_types'] = 'acc|mp3'; 	      
	  //       $config['file_name'] = time() .'_' . $_FILES['qus_files']['name'];
	  //       $this->load->library('upload', $config);
				
	  //       if ( ! $this->upload->do_upload('qus_files')) {
	  //           $error = array('error' => $this->upload->display_errors()); 
	  //           $this->load->view('upload_form', $error); 
	  //       }else { 
	  //           $uplod_data = array('upload_data' => $this->upload->data()); 
	  //           $rc_array['qus_files'] = $uplod_data['upload_data']['file_name'];
	            
	  //       } 
   //      }	

        $this->api_model->insert_data('customer_tickets', $rc_array);

        $image_url = base_url().'assets/front/image/main_logo.png'; 
        $email = $cpa_data['email_address'];
        $htmlContent = '<p>Hello '.$cpa_data['first_name'].' '.$cpa_data['last_name'].',</p>';
        $htmlContent .= 'Ticket number #'.$tkt_number;
        $htmlContent .= '<p>Thanks</p>';
        $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
        $htmlContent .= "<p>www.cpa2go.com</p>";
        $subject = 'A Ticket Has Been Created';
        $name = $user_deta['first_name'].' '.$user_deta['last_name'];
        $from_email = $user_deta['email_address'];

        // echo $email.'-'.$from_email;
        // exit;
        send_email_contact($email, $htmlContent, $subject, $name, $from_email);

        $this->notification_create_tkt($customer_id, $cpa_id, $tkt_number);
		$userdata['message'] = 'Submited your ticket successfully';
		$userdata['status'] = 'true';
		$userdata['ticket_number'] = $tkt_number;
		echo json_encode($userdata);
		exit;
	}	

	public function notification_create_tkt($customer_id, $cpa_id, $tkt_number){

		$customer_data = $this->api_model->getsinglerow('users', 'id', $customer_id);
		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);

		$customer_name = 'Created Ticket Number : #'.$tkt_number.' by '.$customer_data['first_name'].' '.$customer_data['last_name'];
		
		$data['title'] = 'A Ticket Has Been Created';
		$data['body'] = $customer_name;
		$data['details'] = array('title' => 'A Ticket Has Been Created',
								 'ticket_number' => $tkt_number,
								 'customer_id' => $customer_id,
								 'first_name' => $customer_data['first_name'],
								 'last_name' => $customer_data['last_name']);
		// $data['id'] = '1233';
		// $data['first_name'] = 'jignesh';
		// $cust_list = array('first_name'=>'jignesh',
		// 					'last_name'=>'patel',
		// 					'title'=>'title',
		// 					'body'=>'body');
		$div_tocken = $cpa_data['device_token'];
		
		
		if(!empty($cpa_data['device_type']) AND $cpa_data['device_type'] == 'android'){
			
			$this->api_model->anroid_send_pushnotification($div_tocken, $data);
		}elseif(!empty($cpa_data['device_type']) AND $cpa_data['device_type'] == 'ios'){
			
			// $data1['title'] = 'A Ticket Has Been Created';
			// $data1['body'] = $customer_name;
			$this->api_model->ios_send_pushnotification($div_tocken, $data);						
		}
		// $userdata['message'] = 'Notification send successfully';
		// $userdata['status'] = 'true';
		// echo json_encode($userdata);
		// exit;
	}

	public function get_customer_ticket(){

		$customer_id = $this->input->post('customer_id');

		if(empty($customer_id)){
			$userdata['message'] = 'Required customer_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		$ticket_data = $this->api_model->get_ticket_details_customer($customer_id);
		
		$ticket_datas = array();
		foreach($ticket_data AS $val){
			unset($val['main_admin_id']);
			$val['user_image'] = !empty($val['user_image']) ? base_url().'uploads/user_images/'.$val['user_image'] : '';
			$val['qus_files'] = !(empty($val['qus_files'])) ? base_url().'uploads/audios/'.$val['qus_files'] : '';
			$val['ans_files'] = !(empty($val['ans_files'])) ? base_url().'uploads/audios/'.$val['ans_files'] : '';
			$ticket_datas[] = $val;
		}
		$userdata['message'] = 'Get open ticket for customer';
		$userdata['status'] = 'true';
		$userdata['details'] = $ticket_datas;
		echo json_encode($userdata);
		exit;
	}

	public function submit_ratting(){

		$cpa_id = $this->input->post('cpa_id');
		$customer_id = $this->input->post('customer_id');
		$ticket_number = $this->input->post('ticket_number');		
		$ratting_no = $this->input->post('ratting_no');
		$description = $this->input->post('description');

		if(empty($cpa_id)){
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($customer_id)){
			$userdata['message'] = 'Required customer_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($ticket_number)){
			$userdata['message'] = 'Required ticket_number';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($ratting_no)){
			$userdata['message'] = 'Required ratting_no';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($description)){
			$userdata['message'] = 'Required description';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		$rc_array['cpa_id'] = $cpa_id;
		$rc_array['customer_id'] = $customer_id;
		$rc_array['ticket_number'] = $ticket_number;
		$rc_array['ratting_no'] = $ratting_no;
		$rc_array['description'] = $description;
		$rc_array['notif_status'] = 1;
		$rc_array['created_date'] = date('Y-m-d h:i:s', time());
		
		$this->api_model->insert_data('cpa_ratting', $rc_array);
		$ratting_data = $this->api_model->getsingle_list('cpa_ratting', 'cpa_id', $cpa_id);
		
		$total = count($ratting_data);
		$total_rate = 0;
		foreach ($ratting_data as $value) {
			$total_rate += $value['ratting_no']; 		
		}
		$avg = $total_rate/$total;
		$rc_arr['avg_ratting'] = get_retting_avg($avg);
		$this->api_model->update('users', 'id', $cpa_id, $rc_arr);
		$rc_status_tkt['ticket_status'] = 3;
		$this->api_model->update('customer_tickets', 'ticket_number', $ticket_number, $rc_status_tkt);
		
		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
		$ratting_review = $this->api_model->get_ratting_review($cpa_id);
		$this->notification_create_ret($customer_id, $cpa_id, $ticket_number, $ratting_no);
		$userdata['message'] = 'Get review and ratting data';
		$userdata['status'] = 'true';
		$userdata['cpa_first_name'] = $cpa_data['first_name'];
		$userdata['cpa_last_name'] = $cpa_data['last_name'];
		$userdata['cpa_image'] = !empty($cpa_data['user_image']) ? base_url().'uploads/user_images/'.$cpa_data['user_image'] : ''; 
		$userdata['avg_ratting'] = $cpa_data['avg_ratting'];
		$userdata['details'] = $ratting_review;
		echo json_encode($userdata);
		exit;
	}

	public function notification_create_ret($customer_id, $cpa_id, $tkt_number, $ratting_no){

		$customer_data = $this->api_model->getsinglerow('users', 'id', $customer_id);
		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);

		$customer_name = $ratting_no.' Star rating: #'.$tkt_number.' by '.$customer_data['first_name'].' '.$customer_data['last_name'];
		
		$data['title'] = 'Rating';
		$data['body'] = $customer_name;
		$data['details'] = array('title' => 'Rating',
								 'ticket_number' => $tkt_number,
								 'customer_id' => $customer_id,
								 'first_name' => $customer_data['first_name'],
								 'last_name' => $customer_data['last_name']);
		// $data['id'] = '1233';
		// $data['first_name'] = 'jignesh';
		// $cust_list = array('first_name'=>'jignesh',
		// 					'last_name'=>'patel',
		// 					'title'=>'title',
		// 					'body'=>'body');
		$div_tocken = $cpa_data['device_token'];
		

		if(!empty($cpa_data['device_type']) AND $cpa_data['device_type'] == 'android'){
			
			$this->api_model->anroid_send_pushnotification($div_tocken, $data);
		}elseif(!empty($cpa_data['device_type']) AND $cpa_data['device_type'] == 'ios'){
			
			$this->api_model->ios_send_pushnotification($div_tocken, $data);						
		}
		// $userdata['message'] = 'Notification send successfully';
		// $userdata['status'] = 'true';
		// echo json_encode($userdata);
		// exit;
	}

	public function get_closed_ticket_customer(){

		$customer_id = $this->input->post('customer_id');
		$ticket_data = $this->api_model->closed_ticket_customer($customer_id);
		$ticket_datas = array();
		foreach($ticket_data AS $val){
			unset($val['main_admin_id']);
			$val['user_image'] = !empty($val['user_image']) ? base_url().'uploads/user_images/'.$val['user_image'] : '';
			$val['qus_files'] = !(empty($val['qus_files'])) ? base_url().'uploads/audios/'.$val['qus_files'] : '';
			$val['ans_files'] = !(empty($val['ans_files'])) ? base_url().'uploads/audios/'.$val['ans_files'] : '';
			$ticket_datas[] = $val;
		}
		$userdata['message'] = 'Get closed tickets';
		$userdata['status'] = 'true';	
		$userdata['details'] = $ticket_datas;
		echo json_encode($userdata);
		exit;
	}	


	public function video_notification(){

		$cpa_id = $this->input->post('cpa_id');
		$customer_id = $this->input->post('customer_id');

		if(empty($cpa_id)){
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($customer_id)){
			$userdata['message'] = 'Required customer_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		$customer_data = $this->api_model->getsinglerow('users', 'id', $customer_id);
		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);

		$customer_name = $customer_data['first_name'].' '.$customer_data['last_name'];
		
		$data['title'] = 'The incoming video call';
		$data['body'] = $customer_name;
		$data['details'] = array('title' => 'The incoming video call',
								 'first_name' => $customer_data['first_name'],
								 'last_name' => $customer_data['last_name']);
		// $data['id'] = '1233';
		// $data['first_name'] = 'jignesh';
		/*$cust_list = array('first_name'=>'jignesh',
							'last_name'=>'patel',
							'title'=>'title',
							'body'=>'body');*/
		$div_tocken = $cpa_data['device_token'];
		//$div_tocken = 'ceHA_hncA_E:APA91bH1nZqUlPAq3xoI0tVOSiNqS__BN6ofiPT11UFoRWqatJ9F3xZ4S-2axpcqqCzwKRIuTnGM4m8ree1tfuYBfl3Ij_2SpfXrpWsSiLFRe9aRBz05GvlvV1gnV3oVBPQ9d7Ttxujd';
		//$div_tocken_ios = 'dcfiwXCR57M:APA91bEqGI67gSG-UJBWhVZs4loafK2cEaXlalAQGF9IVsAfAwx14YWpsnMrMMX0P3BspfESP-AR6aXDaYResqdyFhUqjWeQCgF-TjKXtfk8SQvigUdiFKLo5KF5E_-2ZsKdSi0jg6RO';
		//$cpa_data['device_token'];
		//$data['deta'] = $data;
		
		//$this->api_model->ios_send_pushnotification($div_tocken_ios, $data);

		if(!empty($cpa_data['device_type']) AND $cpa_data['device_type'] == 'android'){
			
			$this->api_model->anroid_send_pushnotification($div_tocken, $data);
		}elseif(!empty($cpa_data['device_type']) AND $cpa_data['device_type'] == 'ios'){
			
			$this->api_model->ios_send_pushnotification($div_tocken, $data);						
		}
		$userdata['message'] = 'Notification send successfully';
		$userdata['status'] = 'true';
		echo json_encode($userdata);
		exit;
	}

	public function video_notification1(){

		$data['title'] = 'Video call';
		$data['body'] = 'Hello';
		$cust_list = array('first_name'=>'jignesh',
							'last_name'=>'patel',
							'title'=>'title',
							'body'=>'body');
		//$div_tocken = 'ceHA_hncA_E:APA91bH1nZqUlPAq3xoI0tVOSiNqS__BN6ofiPT11UFoRWqatJ9F3xZ4S-2axpcqqCzwKRIuTnGM4m8ree1tfuYBfl3Ij_2SpfXrpWsSiLFRe9aRBz05GvlvV1gnV3oVBPQ9d7Ttxujd';
		$div_tocken_ios = 'dlRigZmcdWU:APA91bHk2qKBSsl5f9nd1ncZh8eh6S1VvIAtQbJY6XhGSWD0QLUHMON-jVbOBr0DX4Rs6qE1oTpv1qaEYQ4xPCPOBm1saveIDBxUQsJf3ZaTpMZOwZVr3l-1JszqRid7gixWHGGy5WE6';



		//'dlRigZmcdWU:APA91bHk2qKBSsl5f9nd1ncZh8eh6S1VvIAtQbJY6XhGSWD0QLUHMON-jVbOBr0DX4Rs6qE1oTpv1qaEYQ4xPCPO'

		//$div_tocken_ios = 'dcfiwXCR57M:APA91bEqGI67gSG-UJBWhVZs4loafK2cEaXlalAQGF9IVsAfAwx14YWpsnMrMMX0P3BspfESP-AR6aXDaYResqdyFhUqjWeQCgF-TjKXtfk8SQvigUdiFKLo5KF5E_-2ZsKdSi0jg6RO';
		//$cpa_data['device_token'];
		$data['details'] = $cust_list;
		//$this->api_model->anroid_send_pushnotification($div_tocken, $data);
		$this->api_model->ios_send_pushnotification($div_tocken_ios, $data);
	}

	public function create_tickets_num(){

		$customer_id = $this->input->post('customer_id');
		$cpa_id = $this->input->post('cpa_id');

		if(empty($customer_id)){
				
			$userdata['message'] = 'Required customer_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		if(empty($cpa_id)){
				
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

        $ticket = rand(1111111, 9999999);  
        $rc_array['ticket_number'] = $ticket;  
        $this->api_model->insert_data('customer_tickets', $rc_array);  

        $rcc_arr['check_ticket_num_api'] = $ticket;
        $this->api_model->update('users', 'id', $customer_id, $rcc_arr);
        $this->api_model->update('users', 'id', $cpa_id, $rcc_arr);
        
        $userdata['message'] = 'Insert tocken number';
		$userdata['status'] = 'true';
		$userdata['ticket_num'] = $ticket;
		echo json_encode($userdata);
		exit;  
    }

	public function add_video_comment(){

		//$ticket_number = $this->input->post('ticket_number');
		$customer_id = $this->input->post('customer_id');
		$cpa_id = $this->input->post('cpa_id');
		$user_role = $this->input->post('user_role');
		$desc = $this->input->post('desc');

		if($user_role == 4 AND empty($customer_id)){
				
			$userdata['message'] = 'Required customer_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		if(empty($cpa_id)){
				
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		if(empty($user_role)){
				
			$userdata['message'] = 'Required user_role';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		if(empty($desc)){
				
			$userdata['message'] = 'Required desc';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		// if(empty($ticket_number)){
				
		// 	$userdata['message'] = 'Required ticket_number';
		// 	$userdata['status'] = 'false';
		// 	echo json_encode($userdata);
		// 	exit;
		// }
		$admin_id = 0;
		if($user_role == 3){
			$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
			$admin_data = $this->api_model->getsinglerow('users', 'id', $cpa_data['main_admin_id']);
			$rc_array['cpa_video_desc'] = $desc;	
			$admin_id = $admin_data['id'];

			$ticket_number = $cpa_data['check_ticket_num_api'];

			$start_date = date('Y-m-d h:i:s', time());
		
			$rc_array['cpa_id'] = $cpa_id;  
	        //$rc_array['customer_id'] = $customer_id;    
	        $rc_array['main_admin_id'] = $admin_id;  

			
	        $rc_array['start_date'] = $start_date;
			$rc_array['qus_type'] = 3;  
	        $rc_array['ticket_status'] = 3; 
	        $rc_array['qus_states'] = 2;   

			$this->api_model->update('customer_tickets', 'ticket_number', $ticket_number, $rc_array);
			$rcc_arr['check_ticket_num_api'] = '';
			$this->api_model->update('users', 'id', $cpa_id, $rcc_arr);

		}elseif($user_role == 4){

			$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
			$admin_data = $this->api_model->getsinglerow('users', 'id', $cpa_data['main_admin_id']);
			$admin_id = $admin_data['id'];

			$customer_data = $this->api_model->getsinglerow('users', 'id', $customer_id);

			$ticket_number = $customer_data['check_ticket_num_api'];

			$rc_array['cus_video_desc'] = $desc;

			$start_date = date('Y-m-d h:i:s', time());
		
			$rc_array['cpa_id'] = $cpa_id;  
	        $rc_array['customer_id'] = $customer_id;    
	        $rc_array['main_admin_id'] = $admin_id;  

			
	        $rc_array['start_date'] = $start_date;
			$rc_array['qus_type'] = 3;  
	        $rc_array['ticket_status'] = 3; 
	        $rc_array['qus_states'] = 2;   

			$this->api_model->update('customer_tickets', 'ticket_number', $ticket_number, $rc_array);
			$rcc_arr['check_ticket_num_api'] = '';
			$this->api_model->update('users', 'id', $customer_id, $rcc_arr);
			$this->api_model->delete_ticket();
		}

		$userdata['message'] = 'Comment added succesfully';
		$userdata['status'] = 'true';
		echo json_encode($userdata);
		exit;
	}


	public function show_notification(){

		$user_role = $this->input->post('user_role');
		$user_id = $this->input->post('user_id');

		if(empty($user_role)){
				
			$userdata['message'] = 'Required user_role';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		if(empty($user_id)){
				
			$userdata['message'] = 'Required user_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		$all_data = $this->api_model->get_notification_list($user_id, $user_role);
		

		$notification_data_rat = array();
		if($user_role == 3){
			$all_data_rat = $this->api_model->get_notification_ratting_list($user_id);
			foreach($all_data_rat AS $key_r=>$val_r){

				$status_rat = 'ratting';
				$noti_sms_rat = $val_r['ratting_no']." Star Rating by ".$val_r['first_name']." ".$val_r['last_name'];

				$notification_data_rat[] = array('ticket_num' => $val_r['ticket_number'],
											 'noti_sms' => $noti_sms_rat,
											 'status' => $status_rat);			
			}
		}	

		$notification_data = array();
		foreach($all_data AS $key=>$val){

			if($val['qus_type'] == 1 OR $val['qus_type'] == 2){

				if($val['ticket_status'] == 3 AND $val['qus_states'] == 2 AND $user_role == 3){
					$status = 'close';
					$noti_sms = "Closed Ticket Number : #".$val['ticket_number']." by ".$val['first_name']." ".$val['last_name'];

					$notification_data[] = array('ticket_num' => $val['ticket_number'],
												 'noti_sms' => $noti_sms,
												 'status' => $status);
				}

				if(($val['ticket_status'] == 1 OR $val['ticket_status'] == 2) AND $val['qus_states'] == 1 AND $user_role == 3){
					$status = 'open';
					$noti_sms = "Open Ticket Number : #".$val['ticket_number']." by ".$val['first_name']." ".$val['last_name'];

					$notification_data[] = array('ticket_num' => $val['ticket_number'],
												 'noti_sms' => $noti_sms,
												 'status' => $status);
				}

				if($val['ticket_status'] == 2 AND $val['qus_states'] == 2 AND $user_role == 4){
					$status = 'answered';
					$noti_sms = "Answered Ticket Number: #".$val['ticket_number']." by ".$val['first_name']." ".$val['last_name'];

					$notification_data[] = array('ticket_num' => $val['ticket_number'],
												 'noti_sms' => $noti_sms,
												 'status' => $status);
				}
			}	
		}
		$details = array_merge($notification_data_rat,$notification_data);
		$userdata['message'] = 'Get notification list';
		$userdata['status'] = 'true';	
		$userdata['details'] = $details;
		echo json_encode($userdata);
		exit;
	}

	public function update_notification_status(){
		
		$ticket_num = $this->input->post('ticket_num');

		if(empty($ticket_num)){
			$userdata['message'] = 'Required ticket_num';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		$rc_array['notif_status'] = 0;
		$this->api_model->update('cpa_ratting', 'ticket_number', $ticket_num, $rc_array);
		$this->api_model->update('customer_tickets', 'ticket_number', $ticket_num, $rc_array);

		$details = $this->api_model->getsinglerow('customer_tickets', 'ticket_number', $ticket_num);

		$userdata['message'] = 'Status change successfully';
		$userdata['status'] = 'true';	
		$userdata['details'] = $details;
		echo json_encode($userdata);
		exit;
	}

	public function clear_notification(){

		$user_role = $this->input->post('user_role');
		$user_id = $this->input->post('user_id');

		if(empty($user_role)){
			$userdata['message'] = 'Required user_role';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		if(empty($user_id)){
			$userdata['message'] = 'Required user_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		if($user_role == 3){
			$rc_array['notif_status'] = 0;
			$this->api_model->update('customer_tickets', 'cpa_id', $user_id, $rc_array);
        	$this->api_model->update('cpa_ratting', 'cpa_id', $user_id, $rc_array);
		}else{
			$rc_array['notif_status'] = 0;
			$this->api_model->update('customer_tickets', 'customer_id', $user_id, $rc_array);	
		}
		$userdata['message'] = 'Notification clear successfully';
		$userdata['status'] = 'true';	
		echo json_encode($userdata);
		exit;
	}

	public function video_call_request(){

		$customer_id = $this->input->post('customer_id');
		$cpa_id = $this->input->post('cpa_id');

		if(empty($customer_id)){
			$userdata['message'] = 'Required customer_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		if(empty($cpa_id)){
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		$rc_arr['video_call_notification'] = 1;
        $rc_arr['video_call_cust_id'] = $customer_id;
        $this->api_model->update('users', 'id', $cpa_id, $rc_arr);

        $userdata['message'] = 'Video call request successfully';
		$userdata['status'] = 'true';	
		echo json_encode($userdata);
		exit;
	}

	public function video_call_change_status(){

		$cpa_id = $this->input->post('cpa_id');
		
		if(empty($cpa_id)){
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}	

		$rc_arr['video_call_notification'] = 0;
        $this->api_model->update('users', 'id', $cpa_id, $rc_arr);

        $userdata['message'] = 'Change status';
		$userdata['status'] = 'true';	
		echo json_encode($userdata);
		exit;
	}

	public function change_status_anw_tkt(){

		$ticket_number = $this->input->post('ticket_number');
		if(empty($ticket_number)){
			$userdata['message'] = 'Required ticket number';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		$rc_array['ticket_status'] = '3';
		$this->api_model->update('customer_tickets', 'ticket_number', $ticket_number, $rc_array);
		$userdata['message'] = 'Change status';
		$userdata['status'] = 'true';
		$userdata['ticket_number'] = $ticket_number;
		echo json_encode($userdata);
		exit;
	}
}
