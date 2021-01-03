<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
        
        // Load facebook library
        $this->load->library('facebook');
        
        //Load user model
        $this->load->model('front_model');
    }
    
    public function index() {
    }

    public function web_login(){
       
        error_reporting(0);
        $data['user'] = array();
         
        // Check if user is logged in
        if ($this->facebook->is_authenticated()) {
            
            $user = $this->facebook->request('get', '/me?fields=id,name,email,birthday,gender,picture');

            $full_name = explode(' ', $user['name']);
           
            // $user_data = $this->front_model->getsinglerow('users', 'email_address', $user['email']);
            // if(empty($user_data->id)){
             
            //     $rc_array['first_name'] = $user['first_name'];
            //     $rc_array['last_name'] = $user['last_name'];
            //     $rc_array['email_address'] = $user['email'];
            //     $rc_array['user_role'] = 4;
            //     $rc_array['login_type'] = 'fb';
            //     $rc_array['fb_id'] = $user['id'];
                
            //     $this->front_model->insert_data('users', $rc_array);
            //     $user_data = $this->front_model->getsinglerow('users', 'email_address', $user['email']);
            //     $this->session->set_userdata('user_front', $user_data);
            //     redirect(base_url().'cpa_list');
            // }else{
            // 	$user_data = $this->front_model->getsinglerow('users', 'email_address', $user['email']);
            //     $this->session->set_userdata('user_front', $user_data);
            //     redirect(base_url().'cpa_list');
            // }
            
            if (!isset($user['error'])) {
                $full_name = explode(' ', $user['name']);
                $data['user'] = $user;
                $log_users = $this->front_model->getsinglerow('users', 'email_address', $user['email']);
                if (!empty($log_users)) :
                    $user_data = $this->front_model->getsinglerow('users', 'email_address', $user['email']);
                    $this->session->set_userdata('user_front', $user_data);
                    redirect(base_url().'cpa_list');
                else :
                    $rc_array['first_name'] = $full_name[0];
                    $rc_array['last_name'] = $full_name[1];
                    $rc_array['email_address'] = $user['email'];
                    $rc_array['user_role'] = 4;
                    $rc_array['login_type'] = 'fb';
                    $rc_array['fb_id'] = $user['id'];
                    $browser_name =  browser_list();   
                    if(!empty($browser_name)){
                        $rc_array['browser_type'] = $browser_name;
                    }

                    $this->front_model->insert_data('users', $rc_array);
                    $user_data = $this->front_model->getsinglerow('users', 'email_address', $user['email']);
                    $this->session->set_userdata('user_front', $user_data);
                    redirect(base_url().'cpa_list');
                endif;
                redirect('');    
            }
        } else {
            $this->session->set_flashdata('message', 'We are unable fetch your facebook information....!');
            redirect('');
        }
    }
}