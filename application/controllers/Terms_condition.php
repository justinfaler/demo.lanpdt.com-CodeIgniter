<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_condition extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();   
    }
    public function index(){

        $this->load->view('terms_condition');
    }
    public function privacypolicy(){

        $this->load->view('privacypolicy_view');
    }
}
