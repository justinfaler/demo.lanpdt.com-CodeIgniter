<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_data extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');

        // if($this->session->userdata('user_front') == FALSE) redirect(base_url('login'));
    }
    public function index(){
    	
    	$this->load->view('share_fb');
    }
}
