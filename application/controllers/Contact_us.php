<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {

	function __construct() {

        ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');

        if($this->session->userdata('user_front') == FALSE) redirect(base_url('login'));
    }
    public function index(){
        $user = $this->session->userdata('user_front');
        if($user->user_role != 4) redirect(base_url('login'));    
		$this->load->view('header');
		$this->load->view('contact_us_view');
		$this->load->view('footer');
    }

    public function cpa_contact(){
        $user = $this->session->userdata('user_front');
        if($user->user_role != 3) redirect(base_url('login'));
        $this->load->view('header_cpa');
        $this->load->view('cpa_contact_us');
        $this->load->view('footer');
    }

    public function add_contact_us(){

        $name = $this->input->post('name');
        $phone_number = $this->input->post('phone_number');
        $from_email = $this->input->post('email');
        $department = $this->input->post('department');
        $message = $this->input->post('message');

        if(!empty($name)){
            $rc_array['name'] = $name;
        }
        if(!empty($phone_number)){
            $rc_array['phone_number'] = $phone_number;
        }
        if(!empty($from_email)){
            $rc_array['email'] = $from_email;
        }
        if(!empty($department)){
            $rc_array['department'] = $department;
        }
        if(!empty($message)){
            $rc_array['message'] = $message;
        }
        $this->front_model->insert_data('contact_support', $rc_array);
        $image_url = base_url().'assets/front/image/main_logo.png';
        if($department == 'sales'){
            //$email = 'jignesh.gambhava@metizsoft.com';
            $email = 'sales@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='120' height='75'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }elseif($department == 'support'){
            $email = 'support@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='120' height='75'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }elseif($department == 'general'){
            $email = 'general@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='120' height='75'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }elseif($department == 'franchise'){
            $email = 'joinus@cpa2go.com';
            $htmlContent = '<p>Hello There,</p>';
            $htmlContent .= $message;
            $htmlContent .= '<p>Thanks</p>';
            $htmlContent .= "<img src='".$image_url."' width='120' height='75'/>";
            $htmlContent .= "<p>www.cpa2go.com</p>";
            $subject = 'Customer Support';
            send_email_contact($email, $htmlContent, $subject, $name, $from_email);
        }
        
        $this->session->set_flashdata('add_contact_validation', 'Your message sent successfully');
        echo '1';
        exit;
    }
}
