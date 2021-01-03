<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_cpa extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();
        $this->load->model('api_model');

    }
	public function index(){
		
		$cpa_id = $this->input->post('cpa_id'); 
		$ticket_status = $this->input->post('ticket_status'); 
		
		if(empty($cpa_id)){
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		if(empty($ticket_status)){
			$userdata['message'] = 'Required ticket_status';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		$data = $this->api_model->get_ticket($cpa_id, $ticket_status);

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit;
		$current_date = date('Y-m-d h:i:s', time());
		$datas = array();
		foreach($data AS $val){
			if($current_date <= $val['end_date']){
				$datetime1 = new DateTime($current_date);
				$datetime2 = new DateTime($val['end_date']);
				$interval = $datetime1->diff($datetime2);
				$times = $interval->format('%H');
				$val['status'] = 'Expires in '.$times.' hrs';
			}else{
				$val['status'] = 'Expired';
			}
			$val['qus_files'] = !(empty($val['qus_files'])) ? base_url().'uploads/audios/'.$val['qus_files'] : '';
			$val['ans_files'] = !(empty($val['ans_files'])) ? base_url().'uploads/audios/'.$val['ans_files'] : '';
			$datas[] = $val;
		}
		$userdata['message'] = 'Get ticket for cpa';
		$userdata['status'] = 'true';
		$userdata['details'] = $datas;
		echo json_encode($userdata);
		exit;
	}	

	public function open_ticket_data(){

		$ticket_number = $this->input->post('ticket_number'); 
		
		if(empty($ticket_number)){
			$userdata['message'] = 'Required ticket_number';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		$data = $this->api_model->get_ticket_num($ticket_number);
		$current_date = date('Y-m-d h:i:s', time());
		$datas = array();
		foreach($data AS $val){
			if($current_date <= $val['end_date']){
				$datetime1 = new DateTime($current_date);
				$datetime2 = new DateTime($val['end_date']);
				$interval = $datetime1->diff($datetime2);
				$times = $interval->format('%H');
				$val['status'] = 'Expires in '.$times.' hrs';
			}else{
				$val['status'] = 'Expired';
			}
			$val['qus_files'] = !(empty($val['qus_files'])) ? base_url().'uploads/audios/'.$val['qus_files'] : '';
			$val['ans_files'] = !(empty($val['ans_files'])) ? base_url().'uploads/audios/'.$val['ans_files'] : '';
			$datas[] = $val;
		}
		$userdata['message'] = 'Get ticket for cpa';
		$userdata['status'] = 'true';
		$userdata['details'] = $datas;
		echo json_encode($userdata);
		exit;
	}

	public function get_reviews_ratting(){

		$cpa_id = $this->input->post('cpa_id'); 
		if(empty($cpa_id)){
			$userdata['message'] = 'Required ticket_number';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
		$ratting_review = $this->api_model->get_ratting_review($cpa_id);

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

	public function answer_of_tickets(){

		$ticket_number = $this->input->post('ticket_number');			
					
		$answer = $this->input->post('answer');		
		$qus_type = $this->input->post('qus_type');	

		$ticket_data = $this->api_model->getsinglerow('customer_tickets', 'ticket_number', $ticket_number);

		// $start_date = date('Y-m-d h:i:s', time());
		// $newtimestamp = strtotime($current_date.' + 1440 minute');
		// $end_date = date('Y-m-d h:i:s', $newtimestamp);

		if(empty($ticket_number)){
		
			$userdata['message'] = 'Required ticket_number';
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
		// if($qus_type == 1){
		// 	if(empty($answer)){
		// 		$userdata['message'] = 'Required answer';
		// 		$userdata['status'] = 'false';
		// 		echo json_encode($userdata);
		// 		exit;
		// 	}
		// }	
		if(!empty($answer)){
			$rc_array['answer'] = $answer;	
		}

		$rc_array['qus_type'] = $qus_type;	
		$rc_array['qus_states'] = 2;	
		$rc_array['notif_status'] = 1;	
		$rc_array['ticket_status'] = 2;	
		
		if (!empty($_FILES)) {
            $tempFile   = $_FILES['ans_files']['tmp_name'];
            $temp       = time().'_'.$_FILES["ans_files"]["name"];
            $path_parts = pathinfo($temp);
            $fileNamep   = $path_parts['basename'];
            $targetPath = './uploads/audios/';
            $targetFile = $targetPath . $fileNamep;           
            move_uploaded_file($tempFile, $targetFile);
            $rc_array['ans_files'] = $fileNamep;
        }	

        $this->api_model->update('customer_tickets', 'ticket_number', $ticket_number, $rc_array);

        $this->notification_create_tkt($ticket_data['customer_id'], $ticket_data['cpa_id'], $ticket_number);
				
					  $customer_data = $this->api_model->getsinglerow('users', 'id', $ticket_data['customer_id']);
						$email_address = $customer_data['email_address'];
						$first_name = $customer_data['first_name'];
						$image_url = base_url().'assets/front/image/main_logo.png';
						$htmlContent = '<p>Hello, '.$first_name.'</p>';
						$htmlContent .= '<h4>Ticket '.$ticket_number.' Has Been Answered.</h4>';
						$htmlContent .= '<h4>Review Answer : <a href="https://www.cpa2go.com/"></a> </h4>';
					  $htmlContent .= '<p>Thanks</p>';
						$htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
					
		        // $htmlContent .= '<p>Url : '.$url.' </p>';
		       	$email = $email_address;
		        $subject = 'CPA2GO: Question '.$ticket_number.' Has Been Answered.';
						send_email($email, $htmlContent, $subject);
	
	
	
	
				$userdata['message'] = 'Submited your ticket successfully';
		$userdata['status'] = 'true';
		$userdata['ticket_number'] = $ticket_number;
		echo json_encode($userdata);
		exit;
	}


	public function notification_create_tkt($customer_id, $cpa_id, $tkt_number){

		$customer_data = $this->api_model->getsinglerow('users', 'id', $customer_id);
		$cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);

		$customer_name = 'Answer Ticket Number : #'.$tkt_number.' by'.$cpa_data['first_name'].' '.$cpa_data['last_name'];
		
		$data['title'] = 'Answer Ticket';
		$data['body'] = $customer_name;
		$data['details'] = array('title' => 'Answer Ticket',
								 'ticket_number' => $tkt_number,
								 'cpa_id' => $cpa_id,
								 'first_name' => $cpa_data['first_name'],
								 'last_name' => $cpa_data['last_name']);
		// $data['id'] = '1233';
		// $data['first_name'] = 'jignesh';
		// $cust_list = array('first_name'=>'jignesh',
		// 					'last_name'=>'patel',
		// 					'title'=>'title',
		// 					'body'=>'body');
		$div_tocken = $customer_data['device_token'];
		

		if(!empty($customer_data['device_type']) AND $customer_data['device_type'] == 'android'){
			
			$this->api_model->anroid_send_pushnotification($div_tocken, $data);
		}elseif(!empty($customer_data['device_type']) AND $customer_data['device_type'] == 'ios'){
			
			$this->api_model->ios_send_pushnotification($div_tocken, $data);						
		}
		// $userdata['message'] = 'Notification send successfully';
		// $userdata['status'] = 'true';
		// echo json_encode($userdata);
		// exit;
	}


	public function change_status(){

		$ticket_number = $this->input->post('ticket_number');
		if(empty($ticket_number)){
			$userdata['message'] = 'Required ticket number';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		//$rc_array['ticket_status'] = '2';
		//$this->api_model->update('customer_tickets', 'ticket_number', $ticket_number, $rc_array);
		$userdata['message'] = 'Change status';
		$userdata['status'] = 'true';
		$userdata['ticket_number'] = $ticket_number;
		echo json_encode($userdata);
		exit;
	}
	
}
