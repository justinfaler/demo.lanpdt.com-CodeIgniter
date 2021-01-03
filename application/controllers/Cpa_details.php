<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpa_details extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $user = $this->session->userdata('user_front');
        if($this->session->userdata('user_front') == FALSE OR $user->user_role != 4) redirect(base_url('login'));
    }
    public function index(){
      
    	$user_deta = $this->session->userdata('user_front');
    	
    	
		$admin_data = $this->front_model->check_assign_zip_code($user_deta->zip_code);	

        if(isset($admin_data[0]->id)){
		  $chect_cpa = $this->front_model->getsinglerow('users', 'main_admin_id', $admin_data[0]->id);
		}

		if(isset($admin_data[0]->id) AND isset($chect_cpa->id)){
			$cpa_data = $this->front_model->getsingle_list('users', 'main_admin_id', $admin_data[0]->id);
			
		}else{
			$admin_data = $this->front_model->getsinglerow('users', 'user_role', '1');
			$cpa_data = $this->front_model->getsingle_list('users', 'main_admin_id', $admin_data->id);
		}
		$cpa_datas = array();
		foreach($cpa_data AS $val){
			$count = $this->front_model->count_review('cpa_ratting', 'cpa_id', $val->id);
			unset($val->main_admin_id);	
			unset($val->password);
			$val->count_review = $count;
			if(!empty($val->user_image)){
				$val->user_image = !empty($val->user_image) ? base_url().'uploads/user_images/'.$val->user_image : '';
			}	
			$cpa_datas[] = $val;
		}

		$user_current_no_of_question_count = $this->front_model->getsinglerow('users', 'id', $user_deta->id);
		$all_cpa_data['no_of_question_count'] = $user_current_no_of_question_count->no_of_question_count;


		$this->db->order_by("id", "desc");
        $this->db->where('user_id', $user_deta->id);
        $this->db->select('*');
        $this->db->from('user_plan_history');
        $query =  $this->db->get(); 
        $current_package = $query->row();  


		if(!empty($current_package)){

			$all_cpa_data['plan_end_date'] = date('Y-m-d',strtotime($current_package->plan_end_date)); 
			$all_cpa_data['plan_end_time'] = date('H:i:s',strtotime($current_package->plan_end_date)); 

        }

		
		$all_cpa_data['cpa_list'] = $cpa_datas;
		$this->load->view('header');
		$this->load->view('cpa_view', $all_cpa_data);
		$this->load->view('footer');
			
    }

    public function get_cpa_details($cpa_id){

    	// $cpa_id = $this->input->post('cpa_id');

    	$user_data = $this->session->userdata('user_front');
		
	   
		$user_current_no_of_question_count = $this->front_model->getsinglerow('users', 'id', $user_data->id);
		//echo "<pre>"; print_r($user_current_no_of_question_count->no_of_question_count); exit;
		//$cpa_id = $user_data->id;

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

        $userdata['avg_ratting'] = $active_star;
        $userdata['half_star'] = $half_star;
        $userdata['inactive_rate'] = $inactive_star;
		$userdata['count_review'] = count($ratting_reviews);
        $data['review_data'] = $userdata;

    	$current_year = date("Y");
    	$year_arr = array();
    	for($i=0; $i<=10; $i++){
    		$year_arr[] = $current_year+$i;
    	}
    	$data['year_list'] = $year_arr;
    	$data['cpa_data'] = $this->front_model->getsinglerow('users', 'id', $cpa_id);
    	if(!empty($data['cpa_data']->user_image)){
			$data['cpa_data']->user_image = !empty($data['cpa_data']->user_image) ? base_url().'uploads/user_images/'.$data['cpa_data']->user_image : '';
		}

		$data['no_of_question_count'] = $user_current_no_of_question_count->no_of_question_count;
	//	echo "<pre>"; print_r($data); exit;
    	$this->load->view('header');
    	$this->load->view('cpa_details_view', $data);
    	$this->load->view('footer');
    }

}
