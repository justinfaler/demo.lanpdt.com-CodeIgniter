<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends CI_Controller 
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
       // $this->load->library('input');
        $this->load->model('front_model');
    }
    
    /**
     * This function is used to update the age of users automatically
     * This function is called by cron job once in a day at midnight 00:00
     */

   

    public function manage()
    {            
       
    
      $this->db->order_by("id", "desc");
      $this->db->select('*');
      $this->db->from('auto_renew_user');
      $query = $this->db->get();
      $auto_renew_users = $query->result();
     


      foreach ($auto_renew_users as $key => $value) {
       
            $this->db->order_by("id", "desc");
            $this->db->where('user_id', $value->user_id);
            $this->db->select('*');
            $this->db->from('user_plan_history');
            $query =  $this->db->get(); 
            $current_package = $query->row(); 
            $current_date = date('Y-m-d H:i:s');


          
            $this->db->where('id', $value->user_id);
            $this->db->select('*');
            $this->db->from('users');
            $query1 =  $this->db->get(); 
            $query1_data= $query->row(); 
           
            if($current_date > $current_package->plan_end_date && $query1_data->purchase_type=='web'){
               

                require_once(FCPATH.'application/third_party/stripe/init.php');
        
                $stripe = array(
                    "secret_key"        => STRIPE_API_KEY,
                    "publishable_key"   => STRIPE_PUBLISHABLE_KEY
                );
                \Stripe\Stripe::setApiKey($stripe['secret_key']);
                
                $getUserStripeDetails=$this->front_model->getsinglerow('users', 'id', $current_package->user_id);
              
                if($getUserStripeDetails){
                    $pay_customer_id = $getUserStripeDetails->pay_customer_id;
                    

                    $getPlanDetails=$this->front_model->getsinglerow('packages', 'id', $current_package->plan_id);
                    $amount =$getPlanDetails->price*100;
                    
                    $charge = \Stripe\Charge::create([
                        'amount' => $amount,
                        'currency' => 'usd',
                        'customer' => $pay_customer_id,
                    ]);


                      //user_plan_history
                    $data1 = array();
                    $data1['user_id'] =  $current_package->user_id;
                    $data1['plan_id'] =  $current_package->plan_id;
                    $data1['plan_start_date'] = date('Y-m-d H:i:s');
                    $data1['plan_end_date'] = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($current_package->plan_end_date)));
                    $this->front_model->insert_data('user_plan_history',$data1);    



                    // user update count

                    $userDetail=$this->front_model->getsinglerow('users', 'id', $current_package->user_id);
                    $plan_no_of_questions = $getPlanDetails->no_of_questions;
                    $currentQuestionCount=$userDetail->no_of_question_count;   
                    $newQuestionCount=$currentQuestionCount + $plan_no_of_questions;    
                    
                    $rc_array1['no_of_question_count'] = $newQuestionCount;    
                   
                    $this->front_model->update('users', 'id', $current_package->user_id, $rc_array1);    
                
                }
               

                

            }

      }
     
    }
}
?>