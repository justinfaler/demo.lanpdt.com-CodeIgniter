<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');

        if($this->session->userdata('user_front') == FALSE) redirect(base_url('login'));
    }
    public function index(){

    	$user_data = $this->session->userdata('user_front');
        $data['noti_data'] = $this->front_model->get_noti_ticket($user_data->id);
    	$data['rate_noti_data'] = $this->front_model->get_noti_rate($user_data->id);
    	$this->load->view('notification_view', $data);
    }

    public function get_notification_customer(){

        $user_data = $this->session->userdata('user_front');
        $data['noti_data'] = $this->front_model->get_noti_cust_ticket($user_data->id);
        $this->load->view('notification_cust_view', $data);
    }

    public function change_noti_status(){

        $not_id = $this->input->post('not_id');
        $data_status = $this->input->post('data_status');

        if($data_status == 0){
            $rcc_array['notif_status'] = 0;
            $this->front_model->update('cpa_ratting', 'id', $not_id, $rcc_array);
            exit; 
        }else{
            $rc_array['notif_status'] = 0;
            $this->front_model->update('customer_tickets', 'id', $not_id, $rc_array);
            exit;       
        }
              
    }

    public function get_notification(){
        $user_data = $this->session->userdata('user_front');
        $noti_data = $this->front_model->get_noti_ticket($user_data->id);
        $rate_noti_data = $this->front_model->get_noti_rate($user_data->id);
        $rate_noti_count = count($rate_noti_data);
        $noti_count = 0;
        foreach($noti_data AS $val){
            if($val->ticket_status == 1){
                $noti_count ++;    
            }
            if($val->ticket_status == 3){
                $noti_count ++;    
            }
        }   
        $notification = $noti_count+$rate_noti_count;
        
        echo $notification;
        exit; 
    }

    public function clear_notification(){

        $user_data = $this->session->userdata('user_front');
        $rc_array['notif_status'] = 0;
        $this->front_model->notification_update('customer_tickets', 'cpa_id', $user_data->id, $rc_array);
        $this->front_model->notification_update('cpa_ratting', 'cpa_id', $user_data->id, $rc_array);
        //redirect(base_url().'open_ticket_cpa');
        echo '1';

    }

    public function clear_cust_notification(){

        $user_data = $this->session->userdata('user_front');
        $rc_array['notif_status'] = 0;
        $this->front_model->notification_update('customer_tickets', 'customer_id', $user_data->id, $rc_array);
        $this->front_model->notification_update('cpa_ratting', 'customer_id', $user_data->id, $rc_array);
        echo '1';

    }


    public function get_cust_notification(){

        $user_data = $this->session->userdata('user_front');

        $noti_data = $this->front_model->get_noti_cust_ticket($user_data->id);
        $noti_count = count($noti_data);
        
        echo $noti_count;
        exit; 
    }
}
