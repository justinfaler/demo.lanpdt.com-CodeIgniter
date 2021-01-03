<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_list extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');

        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));

    }
	public function index()
	{

		$user_data = $this->session->userdata('userdata_list');
		$data['user_list'] = array();
		if($user_data->user_role == 1){
			$data['user_list'] = $this->sys_model->get_list_with_join('users', 'user_role', '4');
			
			foreach ($data['user_list'] as $key => $value) {
				 //$value->id
			
				
				$this->db->order_by("user_plan_history.id", "desc");
				$this->db->where('user_id', $value->id);
				$this->db->select('*');
				$this->db->from('user_plan_history');
				$this->db->join('packages', 'user_plan_history.plan_id = packages.id', 'left'); 
				$query = $this->db->get();
				$userPlanHistory = $query->row();
			

				if(!empty($userPlanHistory)){
					$value->package_name = $userPlanHistory->name;
					$value->plan_start_date = $userPlanHistory->plan_start_date;
					$value->plan_end_date = $userPlanHistory->plan_end_date;
				}else{
					$value->package_name = 'No Plan';
					$value->plan_start_date = '-';
					$value->plan_end_date =  '-';
				}

			
			}
			
		
		}else{	
			
			$ticket_customer_data = $this->sys_model->getsingle_list('customer_tickets', 'main_admin_id', $user_data->id);

			$temp = array_unique(array_column($ticket_customer_data, 'customer_id'));
			$unique_customer_arr = array_intersect_key($ticket_customer_data, $temp);

			$customer_list = array();	
			foreach($unique_customer_arr AS $key=>$cus_val){

				$customer_list = $this->sys_model->get_list_with_join('users', 'id', $cus_val->customer_id);
				$data['user_list'][] = $customer_list[0];			
			}	
		}	

		$this->load->view('admin/header.php');
		$this->load->view('admin/customer_list', $data);
		$this->load->view('admin/footer.php');
	}

	public function view_data(){
		
		$user_id = $this->input->post('user_id');
		$customer_list = $this->sys_model->get_list_with_join('users', 'id', $user_id);
		

		$this->db->order_by("user_plan_history.id", "desc");
		$this->db->where('user_id', $user_id);
		$this->db->select('*');
		$this->db->from('user_plan_history');
		$this->db->join('packages', 'user_plan_history.plan_id = packages.id', 'left'); 
		$query = $this->db->get();
		$userPlanHistory = $query->row();

		//echo "<pre>"; print_r($userPlanHistory); exit;

		$data['user_list'] = $customer_list[0];
		if(!empty($userPlanHistory)){
			$data['user_list']->package_name = $userPlanHistory->name;
			$data['user_list']->plan_start_date = $userPlanHistory->plan_start_date;
			$data['user_list']->plan_end_date = $userPlanHistory->plan_end_date;
		}else{
			$data['user_list']->package_name = 'No Plan';
			$data['user_list']->plan_start_date = '-';
			$data['user_list']->plan_end_date =  '-';
		}
		

	//	echo "<pre>"; print_r($data['user_list']); exit;
		//$data['user_list'] = $this->sys_model->getsinglerow('users', 'id', $user_id);
		$this->load->view('admin/ajax_customer_view', $data);
	}

	public function view_ticket_of_customer(){

		$user_id = $this->input->post('user_id');
		$data['cus_tickets'] = $this->sys_model->get_ticket_customer_list($user_id);

		$this->load->view('admin/ajax_customer_tickets', $data);
		
	}

	public function delete_customer($id){

		$this->sys_model->delete('customer_tickets', 'customer_id', $id);
		$this->sys_model->delete('cpa_ratting', 'customer_id', $id);
		$this->sys_model->delete('users', 'id', $id);
		$this->session->set_flashdata('delete_msg', 'Customer deleted successfully');
		redirect(base_url().'customer_list');
	}
}
