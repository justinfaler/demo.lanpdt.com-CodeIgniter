<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_call_cpa extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $user = $this->session->userdata('call_session');
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';die;
        if($this->session->userdata('call_session') == FALSE ) redirect(base_url('open_ticket_cpa'));
    }
    public function index(){

        $data['cpa_data'] = $this->session->userdata('user_front');
        $rc_arr['video_call_notification'] = 0;
        $this->front_model->update('users', 'id', $data['cpa_data']->id, $rc_arr);

        $this->load->view('header_cpa');
        $this->load->view('video_call_view', $data);
        $this->load->view('footer');	
    }
}
