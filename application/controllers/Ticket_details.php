<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_details extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $user = $this->session->userdata('user_front');
        if($this->session->userdata('user_front') == FALSE OR $user->user_role != 4) redirect(base_url('login'));
    }
    public function index($tkt_id=''){

    	$user_deta = $this->session->userdata('user_front');
           
        $data['tkt_id']= $tkt_id;
		$data['ticket_data'] = $this->front_model->get_ticket_details_customer($user_deta->id);
		$data['total_ticket'] = count($data['ticket_data']);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
		$this->load->view('header');
		$this->load->view('customer_ticket_view',$data);
		$this->load->view('footer');
    }

    public function get_ticket_status(){

    	$user_deta = $this->session->userdata('user_front');
    	$status = $this->input->post('status');
    	if(!empty($status)){
    		$data['ticket_data'] = $this->front_model->get_ticket_details__status($user_deta->id, $status);
    	}else{	
    		$data['ticket_data'] = $this->front_model->get_ticket_details_customer($user_deta->id);
    	}
    	$this->load->view('ajax_customer_ticket', $data);
    }

    public function get_single_ticket(){

    	$tik_id = $this->input->post('tik_id');
    	$data['single_ticket'] = $this->front_model->getsinglerow('customer_tickets', 'id', $tik_id);
    	
        $this->load->view('ajax_single_ticket', $data);
    }

    public function change_status_cust(){

        $ticket_id = $this->input->post('ticket_id');
        $cpa_id = $this->input->post('cpa_id');
        $rc_array['ticket_status'] = 3;
        $rc_array['notif_status'] = 1;
        $this->front_model->update('customer_tickets', 'id', $ticket_id, $rc_array);

        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $cpa_data->user_image =  !empty($cpa_data->user_image) ? base_url().'uploads/user_images/'.$cpa_data->user_image : base_url().'assets/images/unknown-512.png';
        echo json_encode($cpa_data);
        exit;
    }

    public function submit_ratting(){

        $cpa_id = $this->input->post('cpa_id');
        $customer_id = $this->input->post('customer_id');
        $ticket_number = $this->input->post('ticket_number');       
        $tickets_id = $this->input->post('tickets_id');       
        $ratting_no = $this->input->post('ratting_no');
        $description = $this->input->post('description');

        
        $rc_array['cpa_id'] = $cpa_id;
        $rc_array['customer_id'] = $customer_id;
        $rc_array['ticket_number'] = $ticket_number;
        $rc_array['ratting_no'] = $ratting_no;
        $rc_array['description'] = $description;
        $rc_array['created_date'] = date('Y-m-d h:i:s', time());
        $rc_array['notif_status'] = 1;
        
        $this->front_model->insert_data('cpa_ratting', $rc_array);
        $ratting_data = $this->front_model->getsingle_list('cpa_ratting', 'cpa_id', $cpa_id);
        
        $rcc_arr['ticket_status'] = 3;
        $rcc_arr['notif_status'] = 1;
        $this->front_model->update('customer_tickets', 'id', $tickets_id, $rcc_arr);
        $total = count($ratting_data);
        $total_rate = 0;
        foreach ($ratting_data as $value) {
            $total_rate += $value->ratting_no;        
        }
        $avg = $total_rate/$total;
        $rc_arr['avg_ratting'] = get_retting_avg($avg);
        $this->front_model->update('users', 'id', $cpa_id, $rc_arr);
        
        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $ratting_review = $this->front_model->get_ratting_review($cpa_id);
        
        // $userdata['cpa_first_name'] = $cpa_data['first_name'];
        // $userdata['cpa_last_name'] = $cpa_data['last_name'];
        // $userdata['cpa_image'] = !empty($cpa_data['user_image']) ? base_url().'uploads/user_images/'.$cpa_data['user_image'] : ''; 
        // $userdata['avg_ratting'] = $cpa_data['avg_ratting'];
        // $userdata['details'] = $ratting_review;
        echo '1';
        exit;
    }

    public function show_review($cpa_id){

        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $ratting_review = $this->front_model->get_ratting_review($cpa_id);
        
        foreach($ratting_review AS $val){
            $val->inactive_rate = (5-$val->ratting_no);                                                   
            $ratting_reviews[] = $val;                                                
        }
        //$avg_ratting = front_ratting_avg($cpa_data->avg_ratting);

        $active_star = 0;
        $half_star = 0;
        $inactive_star = 0;
        if (strpos($cpa_data->avg_ratting,'.') !== false) {
            $active_star = ($cpa_data->avg_ratting-0.5);
            $half_star = 1;
            $inactive_star = (4 - $active_star);
            //echo 'true';
        }else {
            $active_star = $cpa_data->avg_ratting;
            $inactive_star = (5 - $active_star);
        }

        $userdata['cpa_first_name'] = $cpa_data->first_name;
        $userdata['cpa_last_name'] = $cpa_data->last_name;
        $userdata['cpa_image'] = !empty($cpa_data->user_image) ? base_url().'uploads/user_images/'.$cpa_data->user_image : base_url().'assets/images/unknown-512.png'; 
        $userdata['avg_ratting'] = $active_star;
        $userdata['half_star'] = $half_star;
        $userdata['inactive_rate'] = $inactive_star;
        $userdata['customer_details'] = $ratting_reviews;

        $data['review_data'] = $userdata;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';die;
        $this->load->view('header');
        $this->load->view('review_cpa_for_customer', $data);
        $this->load->view('footer');
    }

}
