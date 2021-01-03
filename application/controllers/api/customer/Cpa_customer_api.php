<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpa_customer_api extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('api_model');

    }
	public function index(){

		$zip_code = $this->input->post('zip_code');
		
		if(empty($zip_code)){
			$userdata['message'] = 'Required zip code';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}

		$admin_data = $this->api_model->check_assign_zip_code($zip_code);	

		if(isset($admin_data[0]->id)){
		  	$chect_cpa = $this->api_model->getsinglerow('users', 'main_admin_id', $admin_data[0]->id);
		}

		// echo $admin_data[0]->id.'  '.$chect_cpa['id'];
		// exit;
		
		if(isset($admin_data[0]->id) AND isset($chect_cpa['id'])){

			$cpa_data = $this->api_model->getsingle_list('users', 'main_admin_id', $admin_data[0]->id);

		}else{
			$admin_data = $this->api_model->getsinglerow('users', 'user_role', '1');
			$cpa_data = $this->api_model->getsingle_list('users', 'main_admin_id', $admin_data['id']);
		}

		foreach($cpa_data AS $val){
			$count = $this->api_model->count_review('cpa_ratting', 'cpa_id', $val['id']);
			unset($val['main_admin_id']);	
			unset($val['password']);
			$val['count_review'] = $count;
			if(!empty($val['user_image'])){
				$val['user_image'] = !empty($val['user_image']) ? base_url().'uploads/user_images/'.$val['user_image'] : '';
			}	
			$cpa_datas[] = $val;
		}

		$userdata['message'] = 'Get cpa list';
		$userdata['status'] = 'true';
		$userdata['details']= $cpa_datas;
		echo json_encode($userdata);
		exit;		
	}	

	public function get_cpa_data(){

		$cpa_id = $this->input->post('cpa_id');
		if(empty($cpa_id)){
			$userdata['message'] = 'Required cpa_id';
			$userdata['status'] = 'false';
			echo json_encode($userdata);
			exit;
		}
		$cpa_data = $this->api_model->getsingle_list('users', 'id', $cpa_id);	
		$userdata['message'] = 'Get cpa list';
		$userdata['status'] = 'true';
		$userdata['details']= $cpa_data;
		echo json_encode($userdata);
		exit;		
	}
}
