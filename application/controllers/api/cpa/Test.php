<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();
        $this->load->model('api_model');

    }
	public function index(){
		

		// $datetime1 = new DateTime('2009-10-11 9:12:00');
		// $datetime2 = new DateTime('2009-10-11 13:12:00');
		// $interval = $datetime1->diff($datetime2);
		// echo $interval->format('%H');
		// exit;

		$cpa_id = $this->input->post('cpa_id'); 
		$ticket_status = $this->input->post('ticket_status'); 
		$data = $this->api_model->get_ticket($cpa_id, $ticket_status);
		$current_date = date('Y-m-d h:i:s', time());
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
			$datas[] = $val;
		}
		
		$userdata['message'] = 'Get ticket for cpa';
		$userdata['status'] = 'true';
		$userdata['details'] = $datas;
		echo json_encode($userdata);
		exit;
	}	

	public function ss(){
		$cpa_id = $this->input->post('cpa_id'); 
		$ticket_status = $this->input->post('ticket_status'); 
		$data = $this->api_model->get_ticket($cpa_id, $ticket_status);
		$current_date = date('Y-m-d h:i:s', time());
		// echo $current_date;	
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';die;
		$userdata['message'] = 'Get ticket for cpa';
		$userdata['status'] = 'true';
		$userdata['details'] = $data;
		echo json_encode($userdata);
		exit;
	}

	public function get_reviews_ratting(){

		$cpa_id = $this->input->post('cpa_id'); 

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
		if($qus_type == 1){
			if(empty($answer)){
				$userdata['message'] = 'Required answer';
				$userdata['status'] = 'false';
				echo json_encode($userdata);
				exit;
			}
		}	
		if(!empty($answer)){
			$rc_array['answer'] = $answer;	
		}

		$rc_array['qus_type'] = $qus_type;	
		$rc_array['qus_states'] = 2;	
		
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
		$userdata['message'] = 'Submited your ticket successfully';
		$userdata['status'] = 'true';
		$userdata['ticket_number'] = $ticket_number;
		echo json_encode($userdata);
		exit;
	}
	
}
