<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cronmoneyback extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('front_model');
    }

    public function manage()
    { 
      $query =  $this->db->query("SELECT (TIMESTAMPDIFF(HOUR,start_date, NOW()))  as HOURS,id,customer_id,qus_states,start_date FROM customer_tickets
        where qus_states !=2 and returncount = 0 and (TIMESTAMPDIFF(HOUR,start_date, NOW())) > 24
      ");
      $countBackUser = $query->result();
      foreach ($countBackUser as $key => $value) {

         $userDetail=$this->front_model->getsinglerow('users', 'id', $value->customer_id);
         $currentQuestionCount=$userDetail->no_of_question_count; 
         $newQuestionCount=$currentQuestionCount + 1;  
         $rc_array1['no_of_question_count'] = $newQuestionCount;  
         $this->front_model->update('users', 'id', $value->customer_id, $rc_array1);    

         $returncount['returncount'] = 1;
         $this->front_model->update('customer_tickets', 'id', $value->id, $returncount);    
        
        }

    }
}