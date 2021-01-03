<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Front_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   
    public function insert_data($tablename, $data=array()){

      $this->db->insert($tablename, $data);
      return $this->db->insert_id();
    }

    public function getlist($table_name){

        $this->db->order_by("id", "desc");
        $this->db->select('*');
        $this->db->from($table_name);
        $query = $this->db->get();
        return $query->result();
    } 

    public function getsingle_list($table_name, $field, $val){
      
      $this->db->order_by("id", "desc");
      $this->db->where($field, $val);
      $this->db->select('*');
      $this->db->from($table_name);
      $query = $this->db->get();
      return $query->result();  
    }

    public function getsinglerow($table_name, $field, $val){
    
      $this->db->where($field, $val);
      $this->db->select('*');
      $this->db->from($table_name);
      $query = $this->db->get();
      return $query->row();  
    }

    public function update($table_name, $field, $val, $data=array()){
         
      $this->db->where($field, $val);
      $this->db->update($table_name, $data);
    }

    public function delete($tablename, $field, $val){

      $this->db->where($field, $val);
      $this->db->delete($tablename);
    }


    public function notification_update($table_name, $field, $val, $data=array()){
      
      // $current_date = date('Y-m-d', time());
      // $this->db->where('DATE_FORMAT(start_date, "%Y-%m-%d") !=', $current_date);
      $this->db->where($field, $val);
      $this->db->update($table_name, $data);
      // echo $this->db->last_query();
      // exit;

    }

    public function check_pass($tablename, $field, $val, $field1, $val1){

      $this->db->where($field, $val);
      $this->db->where($field1, $val1);
      $this->db->select('*');
      $this->db->from($tablename);
      $query = $this->db->get();
      return $query->num_rows();  
    }

    public function check_email($tablename, $field, $val){

      $this->db->where($field, $val);
      $this->db->select('*');
      $this->db->from($tablename);
      $query = $this->db->get();
      return $query->num_rows();  
    }

   public function check_update_email($tablename, $email, $val, $id, $val1){

      $this->db->where($email, $val);
      $this->db->where($id.'!=', $val1);
      $this->db->select('*');
      $this->db->from($tablename);
      $query = $this->db->get();
      return $query->num_rows();  
   }
   
   public function count_review($tablename, $field, $val){

      $this->db->where($field, $val);
      $this->db->select('*');
      $this->db->from($tablename);
      $query = $this->db->get();
      return $query->num_rows();  
    }

   public function check_assign_zip_code($zip_code){

      $this->db->where("FIND_IN_SET( '$zip_code' , assign_zip_code) ");
      $this->db->select('*');
      $this->db->from('users');
      $query = $this->db->get();
      return $query->result();  
   }

   public function get_ticket_details_customer($customer_id=''){

      $this->db->order_by("ticket_status", "asc");
      $this->db->order_by("id", "desc");
      $this->db->where('customer_tickets.customer_id', $customer_id);
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.email_address, users.user_image, users.zip_code, cpa_ratting.id as ratting_id');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.cpa_id = users.id', 'left'); 
      $this->db->join('cpa_ratting', 'customer_tickets.ticket_number = cpa_ratting.ticket_number', 'left'); 

      $query = $this->db->get();
      //  echo $this->db->last_query();
      // exit;
      return $query->result();
   }

    public function get_ticket_details__status($customer_id='', $status=''){

      $this->db->order_by("ticket_status", "asc");
      $this->db->order_by("id", "desc");
      $this->db->where('customer_id', $customer_id);
      if($status == 1 OR $status == 2){
        $this->db->where('qus_states', $status);
        $this->db->where('ticket_status !=', 3);
      }else{
        $this->db->where('ticket_status', 3);
      }  
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.email_address, users.user_image, users.zip_code');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.cpa_id = users.id', 'left'); 
      $query = $this->db->get();
      return $query->result();
   }


  public function get_ratting_review($cpa_id=''){

      $this->db->order_by("cpa_ratting.id", "desc");
      $this->db->where('cpa_id', $cpa_id);
      $this->db->select('cpa_ratting.id, cpa_ratting.ticket_number, cpa_ratting.ratting_no, cpa_ratting.description, cpa_ratting.created_date, users.first_name, users.last_name, users.avg_ratting');
      $this->db->from('cpa_ratting');
      $this->db->join('users', 'cpa_ratting.customer_id = users.id', 'left'); 
      $query = $this->db->get();
      return $query->result();
  }

  public function closed_ticket_customer($customer_id){
      
      $this->db->order_by("id", "desc");
      $this->db->where('customer_id', $customer_id);
      $this->db->where('ticket_status', '3');
      $this->db->select('*');
      $this->db->from('customer_tickets');
      $query = $this->db->get();
      return $query->result();  
  }

  public function get_ticket($cpa_id='', $ticket_status=''){
      
      $this->db->order_by('customer_tickets.id', 'desc');  
      $this->db->where('customer_tickets.cpa_id', $cpa_id);
      $this->db->where('customer_tickets.ticket_status', $ticket_status);
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.customer_id = users.id', 'left');
      $query = $this->db->get();
      return $query->result();  
  }

  public function get_noti_ticket($cpa_id=''){

      $this->db->order_by('customer_tickets.id', 'desc');  
      $this->db->where('customer_tickets.cpa_id', $cpa_id);
      $this->db->where('customer_tickets.notif_status', '1');
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.customer_id = users.id', 'left');
      $query = $this->db->get();
      return $query->result();  
  }

  public function get_noti_cust_ticket($customer_id=''){

      $this->db->order_by('customer_tickets.id', 'desc');  
      $this->db->where('customer_tickets.customer_id', $customer_id);
      $this->db->where('customer_tickets.notif_status', '1');
      $this->db->where('customer_tickets.qus_states', '2');
      $this->db->where('customer_tickets.ticket_status', '2');
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.cpa_id = users.id', 'left');
      $query = $this->db->get();
      return $query->result();  
  }

  public function get_noti_rate($cpa_id=''){

      $this->db->order_by('cpa_ratting.id', 'desc');  
      $this->db->where('cpa_ratting.cpa_id', $cpa_id);
      $this->db->where('cpa_ratting.notif_status', '1');
      $this->db->select('cpa_ratting.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('cpa_ratting');
      $this->db->join('users', 'cpa_ratting.customer_id = users.id', 'left');
      $query = $this->db->get();
      return $query->result();  
  }
}
