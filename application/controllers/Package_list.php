<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_list extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('front_model');
        $user = $this->session->userdata('user_front');
        if($this->session->userdata('user_front') == FALSE OR $user->user_role != 4) redirect(base_url('login'));
    }
    public function index(){
       
    	$user_deta = $this->session->userdata('user_front');
        $data['packages']= $this->front_model->getlist('packages');
        $current_year = date("Y");
    	$year_arr = array();
    	for($i=0; $i<=10; $i++){
    		$year_arr[] = $current_year+$i;
    	}
        $data['year_list'] = $year_arr;
        
        $customer_id = $user_deta->id;
        $cust_data = $this->front_model->getsinglerow('users','id',$customer_id);
       
        $purchase_type = $cust_data->purchase_type;
        $no_of_question_count=$cust_data->no_of_question_count;

        $this->db->order_by("id", "desc");
        $this->db->where('user_id', $customer_id);
        $this->db->select('*');
        $this->db->from('user_plan_history');
        $query =  $this->db->get(); 
        $current_package = $query->row();  

      
        $current_date = date('Y-m-d H:i:s');

        $showBuy = 0;

        if(!empty($current_package)){


            $data['plan_end_date'] = $current_package->plan_end_date;
            if($current_date > $current_package->plan_end_date){
                $showBuy = 1;
            }
            if($no_of_question_count == 0){
                $showBuy = 1;
            }
            $data['no_of_question_count'] = $no_of_question_count;
            $data['showBuy'] = $showBuy;
            $data['current_plan_id'] = $current_package->plan_id;

        }
       // echo "<pre>"; print_r($data);exit;
        

        $data['user_id'] = $customer_id;
        $data['purchase_type'] = $purchase_type;


        $autorenewcheck = $this->front_model->getsinglerow('auto_renew_user','user_id',$customer_id);
        
        if(!empty($autorenewcheck)){
            $data['autoyes'] = '1';
        }
        
	    $this->load->view('header');
		$this->load->view('package_front',$data);
		$this->load->view('footer');
			
    }


}
