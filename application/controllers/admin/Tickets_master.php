<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_master extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');

        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));

    }
	public function index()
	{	
		$user_data = $this->session->userdata('userdata_list');
	
		if($user_data->user_role == 1){
			$data['tickets_list'] = $this->sys_model->get_ticket_list('customer_tickets', 'ticket_status', '1');
			$data['admin_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '2');
			$data['cpa_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '3');
			$data['customer_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '4');
		}elseif($user_data->user_role == 2){
			
			$data['tickets_list'] = $this->sys_model->get_ticket_admin_list($user_data->id, '1');
			
			$data['cpa_list'] = $this->sys_model->get_name_order_list('users', 'main_admin_id', $user_data->id);

			$ticket_customer_data = $this->sys_model->getsingle_list('customer_tickets', 'main_admin_id', $user_data->id);

			$temp = array_unique(array_column($ticket_customer_data, 'customer_id'));
			$unique_customer_arr = array_intersect_key($ticket_customer_data, $temp);

			$customer_list = array();
			foreach($unique_customer_arr AS $key=>$cus_val){
				$customer_list[] = $this->sys_model->getsinglerow('users', 'id', $cus_val->customer_id);			
			}
			
			$data['customer_list'] = $customer_list;
		}
		$data['tic_status'] = '1';	

		// echo '<pre>';
		// print_r($data['tickets_list']);
		// echo '</pre>';die;

		$this->load->view('admin/header.php');
		$this->load->view('admin/tickets_list.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function pending()
	{	

		$user_data = $this->session->userdata('userdata_list');
		if($user_data->user_role == 1){
			$data['tickets_list'] = $this->sys_model->get_ticket_list('customer_tickets', 'ticket_status', '2');
			$data['admin_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '2');
			$data['cpa_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '3');
			$data['customer_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '4');
		}elseif($user_data->user_role == 2){

			$data['tickets_list'] = $this->sys_model->get_ticket_admin_list($user_data->id, '2');
			$data['cpa_list'] = $this->sys_model->get_name_order_list('users', 'main_admin_id', $user_data->id);

			$ticket_customer_data = $this->sys_model->getsingle_list('customer_tickets', 'main_admin_id', $user_data->id);

			$temp = array_unique(array_column($ticket_customer_data, 'customer_id'));
			$unique_customer_arr = array_intersect_key($ticket_customer_data, $temp);

			$customer_list = array();
			foreach($unique_customer_arr AS $key=>$cus_val){
				$customer_list[] = $this->sys_model->getsinglerow('users', 'id', $cus_val->customer_id);			
			}
			
			$data['customer_list'] = $customer_list;
		}	
		$data['tic_status'] = '2';	
		$this->load->view('admin/header.php');
		$this->load->view('admin/tickets_list.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function closed()
	{	
		$user_data = $this->session->userdata('userdata_list');
		if($user_data->user_role == 1){
			$data['tickets_list'] = $this->sys_model->get_ticket_list('customer_tickets', 'ticket_status', '3');
			$data['admin_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '2');
			$data['cpa_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '3');
			$data['customer_list'] = $this->sys_model->get_name_order_list('users', 'user_role', '4');
		}elseif($user_data->user_role == 2){
			$data['tickets_list'] = $this->sys_model->get_ticket_admin_list($user_data->id, '3');
			$data['cpa_list'] = $this->sys_model->get_name_order_list('users', 'main_admin_id', $user_data->id);
			$ticket_customer_data = $this->sys_model->getsingle_list('customer_tickets', 'main_admin_id', $user_data->id);
			$temp = array_unique(array_column($ticket_customer_data, 'customer_id'));
			$unique_customer_arr = array_intersect_key($ticket_customer_data, $temp);
			$customer_list = array();
			foreach($unique_customer_arr AS $key=>$cus_val){
				$customer_list[] = $this->sys_model->getsinglerow('users', 'id', $cus_val->customer_id);			
			}
			
			$data['customer_list'] = $customer_list;
		}	
		$data['tic_status'] = '3';	
		$this->load->view('admin/header.php');
		$this->load->view('admin/tickets_list.php', $data);
		$this->load->view('admin/footer.php');
	}

	public function ajax_get_fillter_data(){

		$cpa_id = $this->input->post('cpa_id');
		$admin_id = $this->input->post('admin_id');
		$customer_id = $this->input->post('customer_id');
		$ticket_status = $this->input->post('ticket_status');
		$user_data = $this->session->userdata('userdata_list');
		
		if($user_data->user_role == 1){

			if(!empty($admin_id) AND !empty($cpa_id) AND !empty($customer_id)){
				
				$all_data = $this->sys_model->filter_ticket_list('customer_tickets', $admin_id, $cpa_id, $customer_id, $ticket_status);
			}elseif(!empty($admin_id) AND !empty($cpa_id)){
				$all_data = $this->sys_model->filter_ticket_list('customer_tickets', $admin_id, $cpa_id, '', $ticket_status);
			}elseif(!empty($admin_id) AND !empty($customer_id)){
				$all_data = $this->sys_model->filter_ticket_list('customer_tickets', $admin_id, '', $customer_id, $ticket_status);
			}elseif(!empty($cpa_id) AND !empty($customer_id)){
				$all_data = $this->sys_model->filter_ticket_list('customer_tickets', '', $cpa_id, $customer_id, $ticket_status);
			}elseif(!empty($admin_id)){
				$all_data = $this->sys_model->filter_ticket_list('customer_tickets', $admin_id, '', '', $ticket_status);
			}elseif(!empty($cpa_id)){
				$all_data = $this->sys_model->filter_ticket_list('customer_tickets', '', $cpa_id, '', $ticket_status);
			}elseif(!empty($customer_id)){
				$all_data = $this->sys_model->filter_ticket_list('customer_tickets', '', '', $customer_id, $ticket_status);
			}else{
				$all_data = $this->sys_model->get_ticket_list('customer_tickets', 'ticket_status', $ticket_status);	
			}
			
		}elseif($user_data->user_role == 2){

			if(!empty($cpa_id) AND !empty($customer_id)){
				$all_data = $this->sys_model->filter_ticket_admin_list('customer_tickets', $cpa_id, $customer_id, $ticket_status, $user_data->id);
			}elseif(!empty($cpa_id)){
				$all_data = $this->sys_model->filter_ticket_admin_list('customer_tickets', $cpa_id, '', $ticket_status, $user_data->id);
			}elseif(!empty($customer_id)){
				$all_data = $this->sys_model->filter_ticket_admin_list('customer_tickets', '', $customer_id, $ticket_status, $user_data->id);
			}else{
				$all_data = $this->sys_model->get_ticket_admin_list($user_data->id, $ticket_status);	
			}
		}
		
		$html_qus = '';
		$html_ans = '';
		$cpa_name = '';
		$alldata['data'] = array();

		// echo '<pre>';
		// print_r($all_data);
		// echo '</pre>';
		// exit;

		foreach($all_data AS $key=>$val){
			
			// if($val->user_role == 1){ 
	  //           $val->fran_firstname.' '.$val->fran_lastname;
	  //       }
			$cpa_name = $val->cpa_firstname.' '.$val->cpa_lastname;
			$customer_name = $val->customer_firstname.' '.$val->customer_lastname;

			if($val->qus_type == 1){
				$html_qus = '';//$val->question; 

				$html_qus .= '<input type="hidden" name="que_data" id="que_data'.$val->id.'" value="'.$val->question.'"/>';
             	$string = strip_tags($val->question);
				if (strlen($string) > 100) {
				    $stringCut = substr($string, 0, 100);
				    $endPoint = strrpos($stringCut, ' ');
				    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
				    $string .= '... <a href="javascript:void(0);" class="read_qus" data-id="'.$val->id.'">Read More</a>';
				}
				$html_qus .= $string;

			}elseif($val->qus_type == 2){  
				$url = base_url().'uploads/audios/'.$val->qus_files;
	        	$html_qus = "<audio controls><source src='".$url."' type='audio/wav'></audio>";	
	        }

	        $type = '';
	       	if($val->qus_type == 1){ 
	       		$type = '<span class="kt-badge kt-badge--success kt-badge--inline">Text</span>'; 
	       	}elseif($val->qus_type == 2){ 
	       		$type = '<span class="kt-badge kt-badge--info kt-badge--inline">Audio</span>';
	       	}else{ 
	       		$type = '<span class="kt-badge kt-badge--danger kt-badge--inline">Video</span>'; 
	       	}

	        if(!empty($val->answer)){ 
	        	$html_ans = ''; 
	        	$html_ans .= '<input type="hidden" name="ans_data" id="ans_data'.$val->id.'" value="'.$val->answer.'"/>';
         		$string = strip_tags($val->answer);
				if (strlen($string) > 100) {

				    // truncate string
				    $stringCut = substr($string, 0, 100);
				    $endPoint = strrpos($stringCut, ' ');

				    //if the string doesn't contain any space then it will cut without word basis.
				    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
				    $string .= '... <a href="javascript:void(0);" class="read_ans" data-id="'.$val->id.'">Read More</a>';
				}
				$html_ans .= $string;
	        }elseif(!empty($val->ans_files)){
	        	$url2 = base_url().'uploads/audios/'.$val->ans_files;
		       	$html_ans = "<audio controls><source src='".$url2."' type='audio/wav'></audio>";
			} 	

			//$que_type = ($val->qus_type == 1) ?  'Text' :  'Audio';
			$alldata['data'][$key] = array($val->ticket_number, '', $cpa_name, $customer_name, $html_qus, $html_ans, $type, date('d-m-Y h:i:s', strtotime($val->start_date)));	
		}

		// echo '<pre>';
		// print_r($alldata);
		// echo '</pre>';die;

		$result = json_encode($alldata);
        echo $result;
        exit;
	}

	public function get_cpa_list(){

		$admin_id = $this->input->post('admin_id');
		if(!empty($admin_id)){
			$cpa_list = $this->sys_model->getsingle_list('users', 'main_admin_id', $admin_id);
		}else{
			$cpa_list = $this->sys_model->getsingle_list('users', 'user_role', 3);
		}	
		$html_inner = "<option value=''>Select</option>";
		foreach($cpa_list AS $val){
			$html_inner .= "<option value='".$val->id."'>".$val->first_name." ".$val->last_name."</option>"; 
		}
		echo $html_inner;
		exit;
							
	}

	public function get_customer_list(){

		$cpa_id = $this->input->post('cpa_id');
		if(!empty($cpa_id)){
			$cpa_list = $this->sys_model->getsingle_list('customer_tickets', 'cpa_id', $cpa_id);
		}else{
			$cpa_list = $this->sys_model->getlist('customer_tickets');
		}	
		$temp = array_unique(array_column($cpa_list, 'customer_id'));
		$unique_customer_arr = array_intersect_key($cpa_list, $temp);
		
		$customer_list = array();
		foreach($unique_customer_arr AS $cpa_val){
			$customer_list[] = $this->sys_model->getsinglerow('users', 'id', $cpa_val->customer_id);
		}

		$html_inner = "<option value=''>Select</option>";
		foreach($customer_list AS $val){
			$html_inner .= "<option value='".$val->id."'>".$val->first_name." ".$val->last_name."</option>"; 
		}
		echo $html_inner;
		exit;

	}
}
