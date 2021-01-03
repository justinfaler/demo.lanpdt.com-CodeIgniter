<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_detail extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('api_model');

    }
	
    public function add_payment_details(){

        //4242424242424242

        $customer_id = $this->input->post('customer_id');
        $email_address = $this->input->post('email_address');
        $card_number = $this->input->post('card_number');
        $exp_month = $this->input->post('exp_month');
        $exp_year = $this->input->post('exp_year');
        $cvv = $this->input->post('cvv');
        

        if(empty($customer_id)){
            $userdata['message'] = 'Required customer_id';
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
        }
        if(empty($email_address)){
            $userdata['message'] = 'Required email_address';
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
        }
        if(empty($card_number)){
            $userdata['message'] = 'Required card_number';
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
        }
        if(empty($exp_month)){
            $userdata['message'] = 'Required exp_month';
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
        }
        if(empty($exp_year)){
            $userdata['message'] = 'Required exp_year';
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
        }
        if(empty($cvv)){
            $userdata['message'] = 'Required cvv';
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
        }

        $cust_details = $this->api_model->getsinglerow('users', 'id', $customer_id);

        if(!empty($cust_details['pay_customer_id'])){
            $userdata['message'] = 'Your card details already exist';
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
        }

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
            
            $userdata['message'] = $ex->getMessage();;
            $userdata['status'] = 'false';
            echo json_encode($userdata);
            exit;
           
         } 
        // echo '<pre>';
        // print_r($customer_data);
        // echo '</pre>';die;

        $token = $customer_data['id'];
        $email = $email_address;
                
        require_once(FCPATH.'application/third_party/stripe/init.php');
        
        $stripe = array(
            "secret_key"        => STRIPE_API_KEY,
            "publishable_key"   => STRIPE_PUBLISHABLE_KEY
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $stripecustomer = $this->_create($email, $token);
        $rc_array['pay_customer_id'] = $stripecustomer['id'];
        $this->api_model->update('users', 'id', $customer_id, $rc_array);

        $userdata['message'] = 'Your card details added successfully';
        $userdata['status'] = 'true';
        $userdata['pay_customer_id'] = $stripecustomer['id'];
        echo json_encode($userdata);
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

}
