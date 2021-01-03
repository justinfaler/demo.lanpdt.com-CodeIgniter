<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpa_review_rate extends CI_Controller {

	function __construct() {

        ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $user = $this->session->userdata('user_front');
        if($this->session->userdata('user_front') == FALSE OR $user->user_role != 3) redirect(base_url('login'));
    }
    public function review_ratting(){

        $user_data = $this->session->userdata('user_front');
        $cpa_id = $user_data->id;
       
        $cpa_data = $this->front_model->getsinglerow('users', 'id', $cpa_id);
        $ratting_review = $this->front_model->get_ratting_review($cpa_id);
        $ratting_reviews = array();
        foreach($ratting_review AS $val){
            $val->inactive_rate = (5-$val->ratting_no);                                                   
            $ratting_reviews[] = $val;                                                
        }
        //$avg_ratting = front_ratting_avg($cpa_data->avg_ratting);

        $active_star = 0;
        $half_star = 0;
        $inactive_star = 0;
        if (strpos($cpa_data->avg_ratting,'.') !== false) {
            $active_star = ($cpa_data->avg_ratting-0.5);
            $half_star = 1;
            $inactive_star = (4 - $active_star);
            //echo 'true';
        }else {
            $active_star = $cpa_data->avg_ratting;
            $inactive_star = (5 - $active_star);
            
        }

        $userdata['cpa_first_name'] = $cpa_data->first_name;
        $userdata['cpa_last_name'] = $cpa_data->last_name;
        $userdata['cpa_image'] = !empty($cpa_data->user_image) ? base_url().'uploads/user_images/'.$cpa_data->user_image : base_url().'assets/front/image/contact_pic.png'; 
        $userdata['avg_ratting'] = $active_star;
        $userdata['half_star'] = $half_star;
        $userdata['inactive_rate'] = $inactive_star;
        $userdata['customer_details'] = $ratting_reviews;
        $data['review_data'] = $userdata;
       
        $this->load->view('header_cpa');
        $this->load->view('cpa_review_ratting',$data);
        $this->load->view('footer');
    }

   
}
