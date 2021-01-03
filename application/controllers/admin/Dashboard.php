<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');

        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));

    }
	public function index()
	{
		
        $session_data = $this->session->userdata('userdata_list');
       
        $top_frn = $this->sys_model->top_user();
        
        $data['top_franchisee'] = array();
        $data['received_num'] = 0;
        $data['open_num'] = 0;//count($open);
        $data['closed_num'] = 0;//count($closed);
        $data['number_of_ticket'] = 0;//count($received);
        $data['number_of_franchisee'] = 0;//count($franchisee);
        $data['number_of_cpa'] = 0;//count($cpa);
        if($session_data->user_role == 1){
            foreach($top_frn AS $key=>$val){
                $top_franchisee = $this->sys_model->get_list_with_join('users', 'id', $val->main_admin_id);
                $data['top_franchisee'][$key] = $top_franchisee[0];  
                $data['top_franchisee'][$key]->count = $val->count;    
            }  
            
    		$received = $this->sys_model->getlist('customer_tickets');
    		$open = $this->sys_model->getsingle_list('customer_tickets', 'ticket_status', '1');
            $closed = $this->sys_model->getsingle_list('customer_tickets', 'ticket_status', '3');

            $franchisee = $this->sys_model->getsingle_list('users', 'user_role', '2');
    		$cpa = $this->sys_model->getsingle_list('users', 'user_role', '3');
    		
            $data['received_num'] = count($received);
    		$data['open_num'] = count($open);
    		$data['closed_num'] = count($closed);
            $data['number_of_ticket'] = count($received);
            $data['number_of_franchisee'] = count($franchisee);
            $data['number_of_cpa'] = count($cpa);
          
        }elseif($session_data->user_role == 2){
            $received = $this->sys_model->getsingle_list('customer_tickets', 'main_admin_id', $session_data->id);
            $cpa = $this->sys_model->getsingle_list('users', 'main_admin_id', $session_data->id);
            $open = $this->sys_model->get_ticket_admin_list($session_data->id, '1');
            $closed = $this->sys_model->get_ticket_admin_list($session_data->id, '3');
            $data['zip_code_list'] = explode(',', $session_data->assign_zip_code);
            //$open = $this->sys_model->get_ticket_admin_list($session_data->id, '2');
            $data['open_num'] = count($open);
            $data['received_num'] = count($received);
            $data['number_of_ticket'] = count($received);
            $data['number_of_cpa'] = count($cpa);
            $data['closed_num'] = count($closed);
        }    
        
    
		$this->load->view('admin/header');
		$this->load->view('admin/home', $data);
		$this->load->view('admin/footer');
	}


    public function fill_data(){

        $fill_data = $this->input->post('fill_data');    
        $start_date = '';  
        $end_date = '';
        
        if($fill_data == 30){
            $start_date = date('Y-m-d', strtotime('-30 days')); 
            $end_date = date('Y-m-d', time());      
        }
        if($fill_data == 90){
            $start_date = date('Y-m-d', strtotime('-90 days')); 
            $end_date = date('Y-m-d', time()); 
        }
        if($fill_data == 365){
            $start_date = date('Y-m-d', strtotime('-365 days')); 
            $end_date = date('Y-m-d', time()); 
        }
        if($fill_data == 'custom'){
            $start_date = $this->input->post('start_date');    
            $end_date = $this->input->post('end_date');   
        }

        $session_data = $this->session->userdata('userdata_list');
        
        $data['received_num'] = 0;
        $data['open_num'] = 0;//count($open);
        $data['closed_num'] = 0;//count($closed);
        $data['number_of_ticket'] = 0;//count($received);
        $data['number_of_franchisee'] = 0;//count($franchisee);
        $data['number_of_cpa'] = 0;//count($cpa);
        if($session_data->user_role == 1){
              
            $received = $this->sys_model->fill_tickets('customer_tickets', $start_date, $end_date ,'','');
            //$open = $this->sys_model->getsingle_list('customer_tickets', 'ticket_status', '1');
            //$closed = $this->sys_model->getsingle_list('customer_tickets', 'ticket_status', '3');

            $franchisee = $this->sys_model->fill_users('users', '2', $start_date, $end_date);
            $cpa = $this->sys_model->fill_users('users', '3', $start_date, $end_date);
            
            // $data['received_num'] = count($received);
            // $data['open_num'] = count($open);
            // $data['closed_num'] = count($closed);
            $data['number_of_ticket'] = count($received);
            $data['number_of_franchisee'] = count($franchisee);
            $data['number_of_cpa'] = count($cpa);
          
        }elseif($session_data->user_role == 2){
            $received = $this->sys_model->fill_tickets('customer_tickets', $start_date, $end_date, $session_data->id, '');
            $cpa = $this->sys_model->fill_users('users', '3', $start_date, $end_date, $session_data->id);
            //$open = $this->sys_model->get_ticket_admin_list($session_data->id, '1');
            //$closed = $this->sys_model->get_ticket_admin_list($session_data->id, '3');
            //$open = $this->sys_model->get_ticket_admin_list($session_data->id, '2');
            //$data['open_num'] = count($open);
            //$data['received_num'] = count($received);
            $data['number_of_ticket'] = count($received);
            $data['number_of_cpa'] = count($cpa);
            //$data['closed_num'] = count($closed);
        }  
        echo json_encode($data);
        exit;
    }


     public function fill_data_pie(){

        $fill_data = $this->input->post('fill_data');    
        $start_date = '';  
        $end_date = '';
        
        if($fill_data == 30){
            $start_date = date('Y-m-d', strtotime('-30 days')); 
            $end_date = date('Y-m-d', time());      
        }
        if($fill_data == 90){
            $start_date = date('Y-m-d', strtotime('-90 days')); 
            $end_date = date('Y-m-d', time()); 
        }
        if($fill_data == 365){
            $start_date = date('Y-m-d', strtotime('-365 days')); 
            $end_date = date('Y-m-d', time()); 
        }
        if($fill_data == 'custom'){
            $start_date = $this->input->post('start_date');    
            $end_date = $this->input->post('end_date');   
        }

        $session_data = $this->session->userdata('userdata_list');
        
        $data['received_num'] = 0;
        $data['open_num'] = 0;//count($open);
        $data['closed_num'] = 0;//count($closed);
        $data['number_of_ticket'] = 0;//count($received);
        $data['number_of_franchisee'] = 0;//count($franchisee);
        $data['number_of_cpa'] = 0;//count($cpa);
        if($session_data->user_role == 1){
              
            $received = $this->sys_model->fill_tickets('customer_tickets', $start_date, $end_date ,'');
            $open = $this->sys_model->fill_tickets('customer_tickets', $start_date, $end_date, '', '1');
            $closed = $this->sys_model->fill_tickets('customer_tickets', $start_date, $end_date, '', '3');

            //$franchisee = $this->sys_model->fill_users('users', '2', $start_date, $end_date);
            //$cpa = $this->sys_model->fill_users('users', '3', $start_date, $end_date);
            
            $data['received_num'] = count($received);
            $data['open_num'] = count($open);
            $data['closed_num'] = count($closed);
            // $data['number_of_ticket'] = count($received);
            // $data['number_of_franchisee'] = count($franchisee);
            // $data['number_of_cpa'] = count($cpa);
          
        }elseif($session_data->user_role == 2){
            $received = $this->sys_model->fill_tickets('customer_tickets', $start_date, $end_date, $session_data->id);
            //$cpa = $this->sys_model->fill_users('users', '3', $start_date, $end_date, $session_data->id);
            $open = $this->sys_model->get_ticket_admin_list($session_data->id, '1', $start_date, $end_date);
            $closed = $this->sys_model->get_ticket_admin_list($session_data->id, '3', $start_date, $end_date);
            //$open = $this->sys_model->get_ticket_admin_list($session_data->id, '2');
            $data['open_num'] = count($open);
            $data['received_num'] = count($received);
            $data['closed_num'] = count($closed);
            // $data['number_of_ticket'] = count($received);
            // $data['number_of_cpa'] = count($cpa);
        }  
        echo json_encode($data);
        exit;
    }    


	public function strip(){

		$this->load->view('admin/stripe_view');
	}


	public function place_order() {
        
        $postdata = $this->input->post();

        if( !isset($postdata['stripeToken']) ) {
            $message = ['success'=>true, 'message'=>'Something wrong! Please check again'];
            echo json_encode($message);exit;
        }

        $email = !empty($postdata['email']) ? $postdata['email'] : $postdata['email'];
        $token = $postdata['stripeToken'];
        
        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $stripecustomer = false;
        $source = '';
       
        if( empty($postdata['source']) ) {
            //$getstripedbcust = $this->checkout->getstripecustomer($email);  
            $stripecustomer = $this->_create($email, $token);
            $source = $stripecustomer->default_source;  
        }

        $source = !empty($postdata['source']) ? $postdata['source'] : $source;
        $stripe_customer_id = !empty($postdata['stripe_customer_id']) ? $postdata['stripe_customer_id'] : $stripecustomer['id'];

        $savedata = ['customer_id' => $stripe_customer_id, 'email' => $email];

        //$this->checkout->addstripcustomer($savedata);
        
        echo '<pre>';
        print_r($savedata);
        echo '</pre>';die;

        //$this->pushtoshopify($postdata, $stripecustomer, $source);

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

    public function pay_price(){

        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $customer_data = \Stripe\Customer::retrieve('cus_FwmQfdmkZvCrgm');
        //$customer_data = \Stripe\Customer::all(['limit' => 3]);


        $charge = \Stripe\Charge::create([
            'amount' => 1000,
            'currency' => 'usd',
            'customer' => 'cus_FwmQfdmkZvCrgm',
        ]);

        echo '<pre>';
        print_r($charge);
        echo '</pre>';die;
    }

    public function cust_id(){

        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $customer_data = \Stripe\Token::create([
          'card' => [
            'number' => '4242424242424242',
            'exp_month' => 10,
            'exp_year' => 2020,
            'cvc' => '314'
            ]
        ]);

        $token = $customer_data['id'];
        $email = 'jignesh.gambhava@metizsoft.com';

        $postdata = $this->input->post();

        // if( !isset($postdata['stripeToken']) ) {
        //     $message = ['success'=>true, 'message'=>'Something wrong! Please check again'];
        //     echo json_encode($message);exit;
        // }

        // $email = !empty($postdata['email']) ? $postdata['email'] : $postdata['email'];
        // $token = $postdata['stripeToken'];
        
        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $stripecustomer = false;
        $source = '';
       
        if( empty($postdata['source']) ) {
            //$getstripedbcust = $this->checkout->getstripecustomer($email);  
            $stripecustomer = $this->_create($email, $token);
            $source = $stripecustomer->default_source;  
        }

        $source = !empty($postdata['source']) ? $postdata['source'] : $source;
        $stripe_customer_id = !empty($postdata['stripe_customer_id']) ? $postdata['stripe_customer_id'] : $stripecustomer['id'];

        $savedata = ['customer_id' => $stripe_customer_id, 'email' => $email];

        //$this->checkout->addstripcustomer($savedata);
        
        echo '<pre>';
        print_r($savedata);
        echo '</pre>';die;
    }  

    public function send_zipcode_requies(){

        $message = $this->input->post('message');
        $session_data = $this->session->userdata('userdata_list');
        $from_name = $session_data->first_name;
        $from_email = $session_data->email_address; 
        $htmlContent = '<p>Hello,</p>';
        $htmlContent .= $message;
        
        $htmlContent .= '<p>Thanks</p>';
        //$htmlContent .= '<p>The CPA2GO Team.</p>';
        $subject = 'Requiest for assign zip code';
        $email = 'kd@lanpdt.com';
        send_email_contact($email, $htmlContent, $subject, $from_name, $from_email);
        echo 1;
        exit;
    }
}
