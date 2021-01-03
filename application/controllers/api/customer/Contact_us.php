<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('api_model');

    }
	public function index(){

		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone_number = $this->input->post('phone_number');
		$department = $this->input->post('department');
		$message = $this->input->post('message');
		
		if(empty($name)){
			$userdata['message'] = 'Required name';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($email)){
			$userdata['message'] = 'Required email';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($phone_number)){
			$userdata['message'] = 'Required phone_number';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		if(empty($message)){
			$userdata['message'] = 'Required message';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		$rc_array['name'] = $name;  
		$rc_array['email'] = $email;  
		$rc_array['phone_number'] = $phone_number;
		$rc_array['department'] = $department;
		$rc_array['message'] = $message;
		$from_email = $email;
		$this->api_model->insert_data('contact_support', $rc_array);

		$image_url = base_url().'assets/front/image/main_logo.png';
        if($department == 'sales'){
            //$email = 'jignesh.gambhava@metizsoft.com';
            $email = 'sales@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }elseif($department == 'support'){
            $email = 'support@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }elseif($department == 'general'){
            $email = 'general@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }elseif($department == 'franchise'){
            $email = 'joinus@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='160' height='55'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }

		$userdata['message'] = 'Your message was submitted successfully';
		$userdata['status'] = 'true';
		echo json_encode($userdata);
		exit;		
	}	
}

