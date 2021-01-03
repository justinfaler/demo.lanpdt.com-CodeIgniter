<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_details_cpa extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $user = $this->session->userdata('user_front');
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';die;
        if($this->session->userdata('user_front') == FALSE OR $user->user_role != 3) redirect(base_url('login'));
    }
    public function open_tkt_cpa($tkt_id=''){


        $user_data = $this->session->userdata('user_front');
        $data = $this->front_model->get_ticket($user_data->id, 1);
        $current_date = date('Y-m-d h:i:s', time());
        $datas = array();
        foreach($data AS $val){
            if($current_date <= $val->end_date){
                $datetime1 = new DateTime($current_date);
                $datetime2 = new DateTime($val->end_date);
                $interval = $datetime1->diff($datetime2);
                $times = $interval->format('%H');
                $val->status = 'Expires in '.$times.' hrs';
            }else{
                $val->status = 'Expired';
            }
            $datas[] = $val;
        }
        $data['tkt_id'] = $tkt_id;
        $data['tick_status'] = 'open';
		$data['ticket_list'] = $datas;
        $this->load->view('header_cpa');
        $this->load->view('cpa_tickets_view',$data);
		$this->load->view('footer');
    }

    public function pending_tkt_cpa(){

        $user_data = $this->session->userdata('user_front');
        $data = $this->front_model->get_ticket($user_data->id, 2);
        $current_date = date('Y-m-d h:i:s', time());
        $datas = array();
        foreach($data AS $val){
            if($current_date <= $val->end_date){
                $datetime1 = new DateTime($current_date);
                $datetime2 = new DateTime($val->end_date);
                $interval = $datetime1->diff($datetime2);
                $times = $interval->format('%H');
                $val->status = 'Expires in '.$times.' hrs';
            }else{
                $val->status = 'Expired';
            }
            $datas[] = $val;
        }
        $data['tkt_id'] = '';
        $data['tick_status'] = 'pending';
        $data['ticket_list'] = $datas;
        $this->load->view('header_cpa');
        $this->load->view('cpa_tickets_view',$data);
        $this->load->view('footer');  
    }

    public function closed_tkt_cpa($tkt_id=''){

        $user_data = $this->session->userdata('user_front');
        $data = $this->front_model->get_ticket($user_data->id, 3);
        $current_date = date('Y-m-d h:i:s', time());
        $datas = array();
        foreach($data AS $val){

            if($current_date <= $val->end_date){
                $datetime1 = new DateTime($current_date);
                $datetime2 = new DateTime($val->end_date);
                $interval = $datetime1->diff($datetime2);
                $times = $interval->format('%H');
                $val->status = 'Expires in '.$times.' hrs';
            }else{
                $val->status = 'Expired';
            }
             
            $datas[] = $val;
        }
        $data['ticket_list'] = $datas;
        $data['tick_status'] = 'close';
        $data['tkt_id'] = $tkt_id;
        $this->load->view('header_cpa');
        $this->load->view('cpa_tickets_view',$data);
        $this->load->view('footer');
        
    }

    public function get_ticket_data(){

        $ticket_id = $this->input->post('ticket_id');
        $tickets = $this->front_model->getsinglerow('customer_tickets', 'id', $ticket_id);
        // if($tickets->ticket_status != 3){
        //     $rc_array['ticket_status'] = 1;
        //     $this->front_model->update('customer_tickets', 'id', $ticket_id, $rc_array);
        // }    
        $tickets_list = $this->front_model->getsinglerow('customer_tickets', 'id', $ticket_id);
        
        echo json_encode($tickets_list);
        exit;
    }

    public function update_answer(){

        $tkt_id = $this->input->post('tkt_id');
        $ans_field = $this->input->post('ans_field');
        if(!empty($ans_field)){
            $rc_array['answer'] = $ans_field;
        }    
        $rc_array['qus_states'] = 2;
        $rc_array['notif_status'] = 1;
        $rc_array['ticket_status'] = 2;
        if (!empty($_FILES)) {
            $tempFile   = $_FILES['audio_data']['tmp_name'];
            $temp       = $_FILES['audio_data']["name"].".wav";
            $path_parts = pathinfo($temp);
            $fileNamep   = $path_parts['basename'];
            $targetPath = './uploads/audios/';
            $targetFile = $targetPath . $fileNamep;           
            move_uploaded_file($tempFile, $targetFile);
        
            $rc_array['ans_files'] = $fileNamep;
        }
        $tickets_list = $this->front_model->getsinglerow('customer_tickets', 'id', $tkt_id);
       // echo "<pre>"; print_r($tickets_list ); exit;
        $customer_details = $this->front_model->getsinglerow('users', 'id', $tickets_list->customer_id);
        $user_deta = $this->session->userdata('user_front');
        //$user_data = $this->session->userdata('user_front');
        //$data = $this->front_model->get_ticket($user_data->id, 1);
        $current_date = date('Y-m-d h:i:s', time());
        $datas = array();
        $exp_status = 0;
        if($current_date <= $tickets_list->end_date){
            $datetime1 = new DateTime($current_date);
            $datetime2 = new DateTime($tickets_list->end_date);
            $interval = $datetime1->diff($datetime2);
            $times = $interval->format('%H');
            $exp_status = $times;
        }
        if($exp_status != 0){
            $this->pay_price($tickets_list->customer_id);
        }    
        $this->front_model->update('customer_tickets', 'id', $tkt_id, $rc_array);
        
        $email = $customer_details->email_address;

        $image_url = base_url().'assets/front/image/main_logo.png'; 
        $ans_url = base_url().'get_customer_ticket';

        //CPA2GO: Your Question #11111 Has Been Answered
        $htmlContent = '<p>Hello '.$customer_details->first_name.' '.$customer_details->last_name.',</p>';
        $htmlContent .= 'Your Question #'.$tickets_list->ticket_number.' Has Been Answered';
        $htmlContent .= "<p><a href='".$ans_url."'>Review Answer</a></p>";
        $htmlContent .= '<p>Thanks</p>';
        $htmlContent .= "<img src='".$image_url."' width='120' height='50'/>";
        $htmlContent .= "<p>www.cpa2go.com</p>";
        $subject = 'CPA2GO: Your Question #'.$tickets_list->ticket_number.' Has Been Answered';
        $name = $user_deta->first_name.' '.$user_deta->last_name;
        $from_email = $user_deta->email_address;
        send_email_contact($email, $htmlContent, $subject, $name, $from_email);

        echo '1';
        exit;
    }

    public function pay_price($customer_id){

        $cust_data = $this->front_model->getsinglerow('users', 'id', $customer_id);
        
       // echo "<pre>"; print_r($cust_data ); exit;
        
        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        //$customer_data = \Stripe\Customer::retrieve('');
        //$customer_data = \Stripe\Customer::all(['limit' => 3]);
        $amount = 9.99*100;
        if($cust_data->pay_customer_id!=''){
            $charge = \Stripe\Charge::create([
             'amount' => $amount,
             'currency' => 'usd',
             'customer' => $cust_data->pay_customer_id,
            ]);
        }
        
        return;
    }

    public function video_pay_price(){

        $cpa_id = $this->input->post('cpa_id');
        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $cust_data = $this->front_model->getsinglerow('users', 'id', $cpa_data->video_call_cust_id);
        if(!empty($cust_data->id)){
            require_once(FCPATH.'application/third_party/stripe/init.php');
            
            $stripe = array(
                "secret_key"        => STRIPE_API_KEY,
                "publishable_key"   => STRIPE_PUBLISHABLE_KEY
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            //$customer_data = \Stripe\Customer::retrieve('');
            //$customer_data = \Stripe\Customer::all(['limit' => 3]);
            $amount = 9.99*100;

            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'customer' => $cust_data->pay_customer_id,
            ]);
            return;
        }else{
            return;
        }    
    }
}
