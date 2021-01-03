<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

    function __construct() {

        //ini_set('display_errors', 1);
        parent::__construct();
        $this->load->model('sys_model');
        if($this->session->userdata('userdata_list') == FALSE) redirect(base_url('admin'));

    }

    public function index()
	{	
       
        $data['packages_list'] = $this->sys_model->getlist('packages');
		$this->load->view('admin/header.php');
		$this->load->view('admin/package_list.php',$data);
		$this->load->view('admin/footer.php');
    }
    public function add(){
        
		$this->load->view('admin/header.php');
		$this->load->view('admin/add_edit_package.php');
		$this->load->view('admin/footer.php');
    }

    public function edit($id){

		$data['package_data'] = $this->sys_model->getsinglerow('packages', 'id', $id);
	    $this->load->view('admin/header.php');
		$this->load->view('admin/add_edit_package.php', $data);
		$this->load->view('admin/footer.php');
	}

    public function add_edit_process(){
        $id = $this->input->post('id');
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		$no_of_questions = $this->input->post('no_of_questions');
		//$no_of_audio_minutes = $this->input->post('no_of_audio_minutes');
       // $no_of_video_minutes = $this->input->post('no_of_video_minutes');
        $price = $this->input->post('price');
		$status = $this->input->post('status');

		if(!empty($this->input->post('name'))){
			$rc_array['name'] = $this->input->post('name');
		}
		if(!empty($this->input->post('description'))){
			$rc_array['description'] = $this->input->post('description');
		}
		if(!empty($this->input->post('no_of_questions'))){
			$rc_array['no_of_questions'] = $this->input->post('no_of_questions');
		}
		// if(!empty($this->input->post('no_of_audio_minutes'))){
		// 	$rc_array['no_of_audio_minutes'] = $this->input->post('no_of_audio_minutes');
		// }
		// if(!empty($this->input->post('no_of_video_minutes'))){
		// 	$rc_array['no_of_video_minutes'] =  $this->input->post('no_of_video_minutes');
		// }
		if(!empty($this->input->post('price'))){
			$rc_array['price'] = $this->input->post('price');
        }
        if(!empty($this->input->post('status'))){
			$rc_array['status'] = $this->input->post('status');
		}
		
	
		if(empty($id) AND $id == ''){
                $id = $this->sys_model->insert_data('packages', $rc_array);
				echo 'Package added successfully';
				exit;
			
		}else{
                $this->sys_model->update('packages', 'id', $id, $rc_array);
				echo 'package updated successfully';
				exit;
				
		}
    }
    
    public function delete($id){
        $this->sys_model->delete('packages', 'id', $id);
		$this->session->set_flashdata('delete_msg', 'Package deleted successfully');
		redirect(base_url().'package_list');
    }
    
    public function view_data(){
        $id = $this->input->post('id');
        $data['package_detail'] = $this->sys_model->getsinglerow('packages', 'id', $id);
        $this->load->view('admin/ajax_package_view', $data);
	}

}