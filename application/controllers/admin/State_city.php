<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_city extends CI_Controller {

	function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();

        $this->load->model('sys_model');

        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));

    }
	public function index()
	{	
		$data['state_list'] = $this->sys_model->getlist('state_master');
		$this->load->view('admin/header.php');
		$this->load->view('admin/state_list', $data);
		$this->load->view('admin/footer.php');
	}

	public function add_edit_process(){

		$state_id = $this->input->post('state_id');
		$rc_array['name'] = ucfirst($this->input->post('state_name'));
		if(empty($state_id)){
			$this->sys_model->insert_data('state_master', $rc_array);
			echo 'add';
			exit;
		}else{
			$this->sys_model->update('state_master', 'id', $state_id, $rc_array);
			echo 'edit';
			exit;
		}	
	}

	public function get_state(){

		$state_id = $this->input->post('state_id');
		
		$state_list = $this->sys_model->getsinglerow('state_master', 'id', $state_id);
		$data['id'] = $state_list->id;
		$data['name'] = $state_list->name;
		echo json_encode($data);
		exit;
	}

	public function delete($id){

		$this->sys_model->delete('state_master', 'id', $id);
		$this->sys_model->delete('city_master', 'state_id', $id);
		$this->session->set_flashdata('delete_msg', 'State deleted successfully');
		redirect(base_url().'state_list');
	}

	public function city_list(){

		$data['city_list'] = $this->sys_model->city_list();
		$data['state_list'] = $this->sys_model->getlist('state_master');
		$this->load->view('admin/header.php');
		$this->load->view('admin/city_list', $data);
		$this->load->view('admin/footer.php');
	}
}
