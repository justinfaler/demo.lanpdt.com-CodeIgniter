<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require APPPATH . '/third_party/sendgrid/vendor/autoload.php';

class Question_answer extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $this->load->model('api_model');

        // if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));
    }
    public function index(){
    	
    	$this->load->view('audio_record');
    }

    public function add_question(){
       
        $this->session->unset_userdata('land_quas');

        $cpa_id = $this->input->post('cpa_id');
        $text_question = $this->input->post('text_question');

        $user_deta = $this->session->userdata('user_front');
        $customer_id = $user_deta->id;

        $UserCurrentData = $this->front_model->getsinglerow('users', 'id', $customer_id);
        $currentQuestionCount=$UserCurrentData->no_of_question_count;
        
      
        $start_date = date('Y-m-d h:i:s', time());
        $newtimestamp = strtotime($start_date.' + 1440 minute');
        $end_date = date('Y-m-d h:i:s', $newtimestamp);
        $ticket = rand(1111111, 9999999);

        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $admin_data = $this->front_model->getsinglerow('users', 'id', $cpa_data->main_admin_id);

        $rc_array['cpa_id'] = $cpa_id;  
        $rc_array['customer_id'] = $customer_id;    
        $rc_array['main_admin_id'] = $admin_data->id;   
        $rc_array['question'] = $text_question; 
        $rc_array['qus_type'] = 1;  
        $rc_array['ticket_status'] = 1; 
        $rc_array['qus_states'] = 1;    

        $browser_name =  browser_list();   
        if(!empty($browser_name)){
            $rc_array['device_browser_type'] = 'Website';
        }

        $rc_array['ticket_number'] = $ticket;
        $rc_array['start_date'] = $start_date;
        $rc_array['end_date'] = $end_date;
        $rc_array['notif_status'] = 1;
        $this->front_model->insert_data('customer_tickets', $rc_array);

        // update question count in users table
        $newQuestionCount=$currentQuestionCount - 1;
        $updateDataQuestionCount = array('no_of_question_count'=>$newQuestionCount);
        $this->front_model->update('users','id',$customer_id,$updateDataQuestionCount);

        //CPA2GO: Your Question #11111 Has Been Answered
        $email = $cpa_data->email_address;
        $image_url = base_url().'assets/front/image/main_logo.png'; 
        $ans_url = base_url().'open_ticket_cpa';

        $htmlContent = '<p>Hello '.$cpa_data->first_name.' '.$cpa_data->last_name.',</p>';
        $htmlContent .= 'Ticket #'.$ticket.' Has Been Created';
        $htmlContent .= "<p><a href='".$ans_url."'>Review Question</a></p>";
        $htmlContent .= '<p>Thanks</p>';
        $htmlContent .= "<img src='".$image_url."' width='120' height='70'/>";
        $htmlContent .= "<p>www.cpa2go.com</p>";
        $subject = 'CPA2GO: Question #'.$ticket.' Has Been Created';
        $name = $user_deta->first_name.' '.$user_deta->last_name;
        $from_email = 'no-reply@cpa2go.com';//$user_deta->email_address;
        send_email_contact($email, $htmlContent, $subject, $name, $from_email);
       
        $this->notification_create_tkt($customer_id, $cpa_id, $ticket);
        echo $ticket;   
        exit;
    }

    public function upload(){

        $cpa_id = $this->input->post('cpa_id');
        $user_deta = $this->session->userdata('user_front');
        $customer_id = $user_deta->id;

        $UserCurrentData = $this->front_model->getsinglerow('users', 'id', $customer_id);
        $currentQuestionCount=$UserCurrentData->no_of_question_count;
       
      
        
        $start_date = date('Y-m-d h:i:s', time());
        $newtimestamp = strtotime($start_date.' + 1440 minute');
        $end_date = date('Y-m-d h:i:s', $newtimestamp);
        $ticket = rand(1111111, 9999999);

        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $admin_data = $this->front_model->getsinglerow('users', 'id', $cpa_data->main_admin_id);

        $rc_array['cpa_id'] = $cpa_id;  
        $rc_array['customer_id'] = $customer_id;    
        $rc_array['main_admin_id'] = $admin_data->id;   
        $rc_array['qus_type'] = 2;  
        $rc_array['ticket_status'] = 1; 
        $rc_array['qus_states'] = 1;    
        
        $rc_array['ticket_number'] = $ticket;
        $rc_array['start_date'] = $start_date;
        $rc_array['end_date'] = $end_date;

        $browser_name =  browser_list();   
        if(!empty($browser_name)){
            $rc_array['device_browser_type'] = 'Website';
        }

        
        if (!empty($_FILES)) {
            $tempFile   = $_FILES['audio_data']['tmp_name'];
            $temp       = $_FILES['audio_data']["name"].".wav";
            $path_parts = pathinfo($temp);
            $fileNamep   = $path_parts['basename'];
            $targetPath = './uploads/audios/';
            $targetFile = $targetPath . $fileNamep;           
            move_uploaded_file($tempFile, $targetFile);
            
            $rc_array['qus_files'] = $fileNamep;
        }
        $this->front_model->insert_data('customer_tickets', $rc_array);
        $email = $user_deta->email_address;


        // update question count in users table
        $newQuestionCount=$currentQuestionCount - 1;
        $updateDataQuestionCount = array('no_of_question_count'=>$newQuestionCount);
        $this->front_model->update('users','id',$customer_id,$updateDataQuestionCount);

        
        //CPA2GO: Your Question #11111 Has Been Answered
        $image_url = base_url().'assets/front/image/main_logo.png'; 
        $ans_url = base_url().'get_customer_ticket';
        
        $htmlContent = '<p>Hello '.$user_deta->first_name.' '.$user_deta->last_name.',</p>';
        $htmlContent .= 'Ticket #'.$ticket.' Has Been Answered';
        $htmlContent .= "<p><a href='".$ans_url."'>Review Answer</a></p>";
        $htmlContent .= '<p>Thanks</p>';
        $htmlContent .= "<img src='".$image_url."' width='120' height='70'/>";
        $htmlContent .= "<p>www.cpa2go.com</p>";
        $subject = 'CPA2GO: Question #'.$ticket.' Has Been Answered';
        //$name = $user_deta->first_name.' '.$user_deta->last_name;
        $name = $cpa_data->first_name.' '.$cpa_data->last_name;
        $from_email = $cpa_data->email_address;
        send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        $this->notification_create_tkt($customer_id, $cpa_id, $ticket);
        echo $ticket;   
        exit;
    }

    public function notification_create_tkt($customer_id, $cpa_id, $tkt_number){
        
        //  echo $cpa_id."</br>";  
        $customer_data = $this->api_model->getsinglerow('users', 'id', $customer_id);
        
        
        $cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);
        
        // echo "<pre>";
        // print_r($cpa_data['device_token']);
        
        // exit;

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
        //                  'last_name'=>'patel',
        //                  'title'=>'title',
        //                  'body'=>'body');
        $div_tocken = $cpa_data['device_token'];
        
     
        if(!empty($cpa_data['device_type']) && $cpa_data['device_type'] == 'android'){
            
            $this->api_model->anroid_send_pushnotification($div_tocken, $data);
        }elseif(!empty($cpa_data['device_type']) && $cpa_data['device_type'] == 'ios'){
            
            // $data1['title'] = 'A Ticket Has Been Created';
            // $data1['body'] = $customer_name;
          
            $this->api_model->ios_send_pushnotification($div_tocken, $data);                        
        }
        // $userdata['message'] = 'Notification send successfully';
        // $userdata['status'] = 'true';
        // echo json_encode($userdata);
        // exit;
    }

    public function video_data(){

        $this->load->view('video_view');
    }

    public function add_video_data(){

        $cpa_id = $this->input->post('cpa_id');
        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $user_deta = $this->session->userdata('user_front');

        $image_url = base_url().'assets/front/image/main_logo.png'; 
        $email = $cpa_data->email_address;
        $htmlContent = '<p>Hello '.$cpa_data->first_name.' '.$cpa_data->last_name.',</p>';
        $htmlContent .= 'Video call request has been received';
        $htmlContent .= '<p>Thanks</p>';
        $htmlContent .= "<img src='".$image_url."' width='120' height='70'/>";
        $subject = 'CPA2GO: Video call request';
        $name = $user_deta->first_name.' '.$user_deta->last_name;
        $from_email = $user_deta->email_address;
        send_email_contact($email, $htmlContent, $subject, $name, $from_email);

        $customer_id = $user_deta->id;
        $exist = '';
        if($cpa_data->video_call_notification == 1){
            $exist = 1;
        }
        
        if($exist == 1){
            echo 1;   
            exit;
        }else{

            if(!empty($cpa_data->device_type)){
                $this->notification_video_call_tkt($customer_id, $cpa_id);
            }    
            $rc_arr['video_call_notification'] = 1;
            $rc_arr['video_call_cust_id'] = $customer_id;
            $this->front_model->update('users', 'id', $cpa_id, $rc_arr);
            //$this->front_model->insert_data('customer_tickets', $rc_array);
            $this->session->userdata('user_front');
            echo $ticket;   
            exit;
        }    
    }

    public function notification_video_call_tkt($customer_id, $cpa_id){

        $customer_data = $this->api_model->getsinglerow('users', 'id', $customer_id);
        $cpa_data = $this->api_model->getsinglerow('users', 'id', $cpa_id);

        $customer_name = 'Video call request by '.$customer_data['first_name'].' '.$customer_data['last_name'];
        
        $data['title'] = ' Video call request';
        $data['body'] = $customer_name;
        $data['details'] = array('title' => ' Video call request',
                                 'cpa_id' => $cpa_id,
                                 'customer_id' => $customer_id,
                                 'first_name' => $customer_data['first_name'],
                                 'last_name' => $customer_data['last_name']);
        // $data['id'] = '1233';
        // $data['first_name'] = 'jignesh';
        // $cust_list = array('first_name'=>'jignesh',
        //                  'last_name'=>'patel',
        //                  'title'=>'title',
        //                  'body'=>'body');
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

    public function add_description_video_cpa(){

        //$this->inpu
        $desc = $this->input->post('desc');
        $cpa_data = $this->session->userdata('user_front');
        $cust_data = $this->front_model->getsinglerow('users', 'id', $cpa_data->id);
        $cpa_id = $cpa_data->id;
        $customer_id = $cust_data->video_call_cust_id;

        $start_date = date('Y-m-d h:i:s', time());
        $newtimestamp = strtotime($start_date.' + 1440 minute');
        $end_date = date('Y-m-d h:i:s', $newtimestamp);
        $ticket = rand(1111111, 9999999);

        $admin_data = $this->front_model->getsinglerow('users', 'id', $cpa_data->main_admin_id);

        $rc_array['cpa_id'] = $cpa_id;  
        $rc_array['customer_id'] = $customer_id;    
        $rc_array['main_admin_id'] = $admin_data->id;   
            
        $rc_array['qus_type'] = 3;  
        $rc_array['ticket_status'] = 3; 
        $rc_array['qus_states'] = 2;    
        
        $rc_array['ticket_number'] = $ticket;
        $rc_array['start_date'] = $start_date;
        $rc_array['end_date'] = $end_date;
        $rc_array['cpa_video_desc'] = $desc;

        $this->front_model->insert_data('customer_tickets', $rc_array);
        
        echo $ticket;   
        exit;
    }

    public function change_video_noti_customer(){

        $customer_data = $this->session->userdata('user_front');
        $video_call_data = $this->front_model->getsinglerow('users', 'video_call_cust_id', $customer_data->id);
        if(isset($video_call_data->id)){
            $cpa_id = $video_call_data->id;
            $rc_arr['video_call_notification'] = 0;
            $rc_arr['video_call_cust_id'] = 0;
            $rc_arr['video_call_fun'] = 0;
            $this->front_model->update('users', 'id', $cpa_id, $rc_arr);
        }
    }

    public function create_video_tickets(){

        $cpa_id = $this->input->post('cpa_id');
        $user_deta = $this->session->userdata('user_front');
        $customer_id = $user_deta->id;

        $UserCurrentData = $this->front_model->getsinglerow('users', 'id', $customer_id);
        $currentQuestionCount=$UserCurrentData->no_of_question_count;

        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);

        // $ticket_data = $this->front_model->getsingle_list('customer_tickets', 'customer_id', $user_deta->id);
        
        // $exist = '';
        // foreach($ticket_data AS $val){
        //     if($val->qus_type == 3 AND $val->notif_status == 1){
        //         $tik_id = $val->id;
        //     }
        // }  


        $start_date = date('Y-m-d h:i:s', time());
        $newtimestamp = strtotime($start_date.' + 1440 minute');
        $end_date = date('Y-m-d h:i:s', $newtimestamp);
        $ticket = rand(1111111, 9999999);

        $admin_data = $this->front_model->getsinglerow('users', 'id', $cpa_data->main_admin_id);

        $rc_array['cpa_id'] = $cpa_id;  
        $rc_array['customer_id'] = $customer_id;    
        $rc_array['main_admin_id'] = $admin_data->id;   
            
        $rc_array['qus_type'] = 3;  
        $rc_array['ticket_status'] = 3; 
        $rc_array['qus_states'] = 2;    
        
        $rc_array['ticket_number'] = $ticket;
        $rc_array['start_date'] = $start_date;
        $rc_array['end_date'] = $end_date;
        //$rc_array['cpa_video_desc'] = $desc;

        $this->front_model->insert_data('customer_tickets', $rc_array);
        
        $rc_arr['check_ticket_num'] = $ticket;
        //$rc_arr['video_call_cust_id'] = 0;
        $this->front_model->update('users', 'id', $cpa_id, $rc_arr);
        $this->front_model->update('users', 'id', $customer_id, $rc_arr);
        // $this->session->set_userdata('call_session', 0);

        // update question count in users table
        $newQuestionCount=$currentQuestionCount - 1;
        $updateDataQuestionCount = array('no_of_question_count'=>$newQuestionCount);
        $this->front_model->update('users','id',$customer_id,$updateDataQuestionCount);

        exit;
    }    


    public function update_description_video_cpa(){

        $user_deta = $this->session->userdata('user_front');
        if($user_deta->user_role == 4){
            $customer_id = $user_deta->id;
            $desc = $this->input->post('desc');
            $cust_data = $this->front_model->getsinglerow('users','id',$customer_id);
            $ticket = $cust_data->check_ticket_num;
            $ticket_details = $this->front_model->getsinglerow('customer_tickets', 'ticket_number', $ticket);
            $rc_arr['cus_video_desc'] = $desc;
            $browser_name =  browser_list();   
            if(!empty($browser_name)){
                $rc_arr['device_browser_type'] = 'Website';
            }
            $this->front_model->update('customer_tickets', 'ticket_number', $ticket, $rc_arr);
            $rc_array['check_ticket_num'] = '';
            $this->front_model->update('users', 'id', $customer_id, $rc_array);

           
            $cpa_data = $this->front_model->getsinglerow('users', 'id', $ticket_details->cpa_id);
            
            $data['first_name'] = $cpa_data->first_name;
            $data['last_name'] = $cpa_data->last_name;
            $data['user_image'] = !empty($cpa_data->user_image) ? base_url().'uploads/user_images/'.$cpa_data->user_image : base_url().'assets/images/unknown-512.png';
            $data['ticket_id'] = $ticket_details->id;
            $data['ticket_number'] = $ticket_details->ticket_number;
            $data['cpa_id'] = $ticket_details->cpa_id;
            $data['customer_id'] = $ticket_details->customer_id;
            
            echo json_encode($data);
            exit;

        }elseif($user_deta->user_role == 3){
            $cpa_id = $user_deta->id;
            $desc = $this->input->post('desc');
            $cpa_data = $this->front_model->getsinglerow('users','id',$cpa_id);
            $ticket = $cpa_data->check_ticket_num;
            $rc_arr['cpa_video_desc'] = $desc;
            $this->front_model->update('customer_tickets', 'ticket_number', $ticket, $rc_arr);
            $rc_array['video_call_notification'] = 0;
            $rc_array['video_call_cust_id'] = 0;
            $rc_array['video_call_fun'] = 0;
            $rc_array['check_ticket_num'] = '';
            $this->front_model->update('users', 'id', $cpa_id, $rc_array);
        }
    }

    public function check_video_call(){

        $user_deta = $this->session->userdata('user_front');
                                    
        $cpa_data = $this->front_model->getsinglerow('users', 'id', $user_deta->id);
        $data_arr = array();
        $call_session = 0;
        if($cpa_data->video_call_notification == 1){
            $customer = $this->front_model->getsinglerow('users', 'id', $cpa_data->video_call_cust_id);
            $data_arr['cust_id'] = $customer->id;
            $data_arr['cust_firstname'] = $customer->first_name;
            $data_arr['cust_lastname'] = $customer->last_name;
            $data_arr['cust_image'] = !empty($customer->user_image) ? base_url().'uploads/user_images/'.$customer->user_image : base_url().'assets/images/unknown-512.png';
            $data_arr['cust_zip_code'] = $customer->zip_code;
            $data_arr['status'] = 1;
            $call_session = 1;
            $rc_arr['video_call_fun'] = 1;
            $this->front_model->update('users', 'id', $user_deta->id, $rc_arr);
        }
        
        $this->session->set_userdata('call_session', $call_session);
        echo json_encode($data_arr);
        exit;
    }

    public function close_video_call(){

        $user_deta = $this->session->userdata('user_front');
                                    
        $cpa_data = $this->front_model->getsinglerow('users', 'id', $user_deta->id);
        // $video_status = 0;
        // if($cpa_data->video_call_notification == 1){
        //     $video_status = 1;
        // }
        $array_data = array('video_status' => $cpa_data->video_call_notification,
                            'video_fun'    => $cpa_data->video_call_fun);

        echo json_encode($array_data);
        exit;
    }


    public function cut_video_call_user(){

        $user_deta = $this->session->userdata('user_front');
                            
        $cpa_data = $this->front_model->getsinglerow('users', 'video_call_cust_id', $user_deta->id);
      
        $video_cut_fun = 0;
        if(!empty($cpa_data->id)){
            if($cpa_data->video_cut_fun == 1){
                $video_cut_fun = $cpa_data->video_cut_fun;
                $rc_array['video_call_notification'] = 0;
                $rc_array['video_call_cust_id'] = 0;
                $rc_array['video_call_fun'] = 0;
                $rc_array['check_ticket_num'] = '';
                $rc_array['video_cut_fun'] = 0;
                $this->front_model->update('users', 'id', $cpa_data->id, $rc_array); 
            }
        }
        // $array_data = array('video_status' => $cpa_data->video_call_notification,
        //                     'video_fun'    => $cpa_data->video_call_fun);
        echo $video_cut_fun;
        exit;
    }


    // public function pay_price($customer_id){

    //     $cust_data = $this->front_model->getsinglerow('users', 'id', $customer_id);
    //     require_once(FCPATH.'application/third_party/stripe/init.php');
        
    //     $stripe = array(
    //         "secret_key"        => STRIPE_API_KEY,
    //         "publishable_key"   => STRIPE_PUBLISHABLE_KEY
    //     );

    //     \Stripe\Stripe::setApiKey($stripe['secret_key']);

    //     //$customer_data = \Stripe\Customer::retrieve('');
    //     //$customer_data = \Stripe\Customer::all(['limit' => 3]);
    //     $amount = 9.99*100;

    //     $charge = \Stripe\Charge::create([
    //         'amount' => $amount,
    //         'currency' => 'usd',
    //         'customer' => $cust_data->pay_customer_id,
    //     ]);
    //     return;
    // }

    public function manageAutoRenew(){
        $autorenew = $this->input->post('autorenew');
        $user_id = $this->input->post('user_id');
        $plan_id = $this->input->post('plan_id');
        $this->front_model->delete('auto_renew_user', 'user_id', $user_id);
      
        if($autorenew=='on'){
            $data['user_id'] = $user_id;
            $data['plan_id'] = $plan_id;
            $this->front_model->insert_data('auto_renew_user',$data);
        }
    }



    public function add_card_front_details(){
       
        $user_deta = $this->session->userdata('user_front');
        $customer_id = $user_deta->id;
        $card_number = str_replace(' ', '', $this->input->post('card_number'));
        $exp_month = $this->input->post('exp_month');
        $exp_year = $this->input->post('exp_year');
        $cvv = $this->input->post('cvv_no');

        $planId = $this->input->post('planId');
        $plan_data = $this->front_model->getsinglerow('packages', 'id', $planId);
        $plan_no_of_questions =  $plan_data->no_of_questions;
        $plan_price = $plan_data->price;

      

     //   echo "<pre>"; print_r($planId); exit;

        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        
        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        try {
            $customer_data = \Stripe\Token::create([
            'card' => [
                'number' => $card_number,
                'exp_month' => $exp_month,
                'exp_year' => $exp_year,
                'cvc' => $cvv
                ]
            ]);
        } catch (Exception $ex) {
            
            // $userdata['message'] = 
            // $userdata['status'] = 'false';
            $msg = $ex->getMessage();
            $succ_data = array('status' => 0, 'msg' => $msg);
            echo json_encode($succ_data);  
            exit;
        } 

        $token = $customer_data['id'];
        $email = $user_deta->email_address;

        $stripecustomer = $this->_create($email, $token);
        $rc_array1['pay_customer_id'] = $stripecustomer['id'];
        
        $amount =$plan_price*100;
        
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'customer' => $stripecustomer['id'],
        ]);
        
        $UserCurrentData = $this->front_model->getsinglerow('users', 'id', $customer_id);
        $currentQuestionCount=$UserCurrentData->no_of_question_count;
        
        $newQuestionCount=$currentQuestionCount + $plan_no_of_questions;
     //   $updateDataQuestionCount = array('no_of_question_count'=>$newQuestionCount);
     //   $this->front_model->update('users','id',$customer_id,$updateDataQuestionCount);
        $rc_array1['no_of_question_count'] = $newQuestionCount;    
        $rc_array1['purchase_type'] = 'web'; 
        $this->front_model->update('users', 'id', $customer_id, $rc_array1);


         //user_plan_history
         $data = array();
         $data['user_id'] =  $customer_id;
         $data['plan_id'] = $planId;
         $data['plan_start_date'] = date('Y-m-d H:i:s');
         $data['plan_end_date'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($data['plan_start_date'])));
         $response=$this->front_model->insert_data('user_plan_history',$data);

        $succ_data = array('status' => 1);
        echo json_encode($succ_data);  
        exit;

    }

    public function add_card_details(){

        //4242424242424242
         $this->session->unset_userdata('land_quas');
        $cpa_id = $this->input->post('pay_cpa_id');
        $text_question = $this->input->post('pay_question');
        $qus_status = $this->input->post('qus_status');

        $user_deta = $this->session->userdata('user_front');

        $customer_id = $user_deta->id;
        $card_number = str_replace(' ', '', $this->input->post('card_number'));
        $exp_month = $this->input->post('exp_month');
        $exp_year = $this->input->post('exp_year');
        $cvv = $this->input->post('cvv_no');
        
        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        
        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        try {
            $customer_data = \Stripe\Token::create([
            'card' => [
                'number' => $card_number,
                'exp_month' => $exp_month,
                'exp_year' => $exp_year,
                'cvc' => $cvv
                ]
            ]);
        } catch (Exception $ex) {
            
            // $userdata['message'] = 
            // $userdata['status'] = 'false';
            $msg = $ex->getMessage();
            $succ_data = array('status' => 0, 'msg' => $msg);
            echo json_encode($succ_data);  
            exit;
        } 
        
        $token = $customer_data['id'];
        $email = $user_deta->email_address;

        $stripecustomer = $this->_create($email, $token);
        $rc_array1['pay_customer_id'] = $stripecustomer['id'];
        $this->front_model->update('users', 'id', $customer_id, $rc_array1);



        $user_new_data = $this->front_model->getsinglerow('users', 'id', $customer_id);
        $this->session->set_userdata('user_front', $user_new_data);

        if($qus_status == 1){    
            
            // Add Question
            $start_date = date('Y-m-d h:i:s', time());
            $newtimestamp = strtotime($start_date.' + 1440 minute');
            $end_date = date('Y-m-d h:i:s', $newtimestamp);
            $ticket = rand(1111111, 9999999);

            $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
            $admin_data = $this->front_model->getsinglerow('users', 'id', $cpa_data->main_admin_id);

            $rc_array['cpa_id'] = $cpa_id;  
            $rc_array['customer_id'] = $customer_id;    
            $rc_array['main_admin_id'] = $admin_data->id;   
            $rc_array['question'] = $text_question; 
            $rc_array['qus_type'] = 1;  
            $rc_array['ticket_status'] = 1; 
            $rc_array['qus_states'] = 1;    
            
            $rc_array['ticket_number'] = $ticket;
            $rc_array['start_date'] = $start_date;
            $rc_array['end_date'] = $end_date;
            $rc_array['notif_status'] = 1;
        
            $this->front_model->insert_data('customer_tickets', $rc_array);
            $succ_data = array('status' => 1, 'ticket_num' => $ticket);
        }elseif($qus_status == 3){
            $succ_data = array('status' => 3);
        }    
        echo json_encode($succ_data);  
        exit;
    }  

    private function _create($email, $token) {

        try {

            $customer = \Stripe\Customer::create(array(
                'email'  => $email,
                'source' => $token
            ));
            return $customer;

        } catch (Exception $e) {
            $message = ['success'=>false, 'message'=>'Invalid token. Please try again.'];
            echo json_encode($message); exit;
        }

        return false;
    }

    public function cut_video_call(){

        $user_deta = $this->session->userdata('user_front');
        $cpa_id = $user_deta->id;
        $rc_array['video_call_notification'] = 0;
        //$rc_array['video_call_cust_id'] = 0;
        $rc_array['video_call_fun'] = 0;
        $rc_array['check_ticket_num'] = '';
        $rc_array['video_cut_fun'] = 1;
        $this->front_model->update('users', 'id', $cpa_id, $rc_array);                    
    }

    // public function send_email_grid($email_address, $htmlContent, $subject, $from_name, $from_email){
        

    //     $email = new \SendGrid\Mail\Mail(); 
    //     $email->setFrom($from_email, $from_name);
    //     $email->setSubject($subject);
    //     $email->addTo($email_address, "");
    //     $email->addContent(
    //         "text/html", $htmlContent
    //     );
    //     $sendgrid = new \SendGrid('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');
    //     try {
    //         $response = $sendgrid->send($email);
    //         // print $response->statusCode() . "\n";
    //         // print_r($response->headers());
    //         // print $response->body() . "\n";
    //     } catch (Exception $e) {
    //         echo 'Caught exception: '. $e->getMessage() ."\n";
    //     }
    // }
	
}
