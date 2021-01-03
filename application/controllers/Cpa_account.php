<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpa_account extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $this->load->model('sys_model');
        $user = $this->session->userdata('user_front');
        if($this->session->userdata('user_front') == FALSE OR $user->user_role != 3) redirect(base_url('login'));
    }
    public function show_cpa_account(){
        
        $data['user_data'] = $this->session->userdata('user_front');
        $admin_data = $this->front_model->getsinglerow('users', 'id', $data['user_data']->main_admin_id);
        $data['assign_zip_code'] = explode(',', $admin_data->assign_zip_code);
        
        $this->load->view('header_cpa');
        $this->load->view('cpa_account_view',$data);
        $this->load->view('footer');
    }

    public function update_account(){

        $cpa_id = $this->input->post('cpa_id');
        $cpa_description = $this->input->post('cpa_description');
        $cpa_service = $this->input->post('cpa_service');
        $email_address = $this->input->post('email_address');

        if (!empty($_FILES['user_image']['name'])) {
            $config['upload_path']   = './uploads/user_images/'; 
            $config['allowed_types'] = 'gif|jpg|jpeg|png';        
            $config['file_name'] = time() .'_' . $_FILES['user_image']['name'];
            $this->load->library('upload', $config);
                
            if ( ! $this->upload->do_upload('user_image')) {
                $error = array('error' => $this->upload->display_errors()); 
                $this->load->view('upload_form', $error); 
            }else { 
                $uplod_data = array('upload_data' => $this->upload->data()); 
                $rc_array['user_image'] = $uplod_data['upload_data']['file_name'];
            } 
        }
        $rc_array['cpa_description'] = $cpa_description;
        $rc_array['cpa_service'] = $cpa_service;
        $rc_array['email_address'] = $email_address;
        $this->front_model->update('users', 'id', $cpa_id, $rc_array);
        $user_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $this->session->set_userdata('user_front', $user_data);
        $this->session->set_flashdata('update_account', 'Account updated successfully');
        echo '1';
        exit;
    }

    public function cpa_profile(){
        
        $user = $this->session->userdata('user_front');
        $data['state_master'] = $this->sys_model->getstate();
        $admin_data = $this->front_model->getsinglerow('users', 'id', $user->main_admin_id);
        $data['assign_zip_code'] = explode(',', $admin_data->assign_zip_code);
        $this->load->view('header_cpa');
        $this->load->view('cpa_profile_view',$data);
        $this->load->view('footer');
    }

}
