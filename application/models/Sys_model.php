<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Sys_model extends CI_Model {

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

    public function get_name_order_list($table_name, $field, $val){
      
      $this->db->order_by("first_name", "asc");
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

   public function check_update_email($tablename, $field, $val, $field1, $val1){

      $this->db->where($field, $val);
      $this->db->where($field1.'!=', $val1);
      $this->db->select('*');
      $this->db->from($tablename);
      $query = $this->db->get();
      return $query->num_rows();  
   }

   public function getstate(){

        $this->db->order_by("name", "asc");
        $this->db->select('*');
        $this->db->from('state_master');
        $query = $this->db->get();
        return $query->result();
    } 

   public function city_list(){

      $this->db->select('city_master.*, state_master.name as state_name');
      $this->db->from('city_master');
      $this->db->join('state_master', 'city_master.state_id = state_master.id', 'left'); 
      $query = $this->db->get();
      return $query->result();
   }

   public function get_list_with_join($tablename, $field, $val){

      $this->db->order_by($tablename.".id", "desc");
      $this->db->where($tablename.'.'.$field, $val);
      $this->db->select($tablename.'.*, state_master.name as state_name');
      $this->db->from($tablename);
      $this->db->join('state_master', $tablename.'.state = state_master.id', 'left'); 
      $query = $this->db->get();
      return $query->result();
   }

  

   public function get_ticket_list($tablename, $field, $val){

      $this->db->order_by($tablename.".id", "desc");
      $this->db->where($field, $val);
      $this->db->select($tablename.'.*, cpa.user_name as cpa_username, cpa.first_name as cpa_firstname, cpa.last_name as cpa_lastname, customer.user_name as customer_username, customer.first_name as customer_firstname, customer.last_name as customer_lastname, franch.first_name as fran_firstname, franch.last_name as fran_lastname');
      $this->db->from($tablename);
      $this->db->join('users as franch', $tablename.'.main_admin_id = franch.id', 'left'); 
      $this->db->join('users as cpa', $tablename.'.cpa_id = cpa.id', 'left'); 
      $this->db->join('users as customer', $tablename.'.customer_id = customer.id', 'left'); 
      $query = $this->db->get();
      //  echo $this->db->last_query();
      // exit;
      return $query->result();
  }

   public function get_ticket_admin_list($admin_id, $ticket_status, $start_date='', $end_date=''){
    
      $this->db->order_by("customer_tickets.id", "desc");
      if(!empty($start_date) AND !empty($end_date)){
        $this->db->where('DATE_FORMAT(start_date, "%Y-%m-%d") >=', $start_date);
        $this->db->where('DATE_FORMAT(start_date, "%Y-%m-%d") <=', $end_date);
      }
      $this->db->where('customer_tickets.ticket_status', $ticket_status);
      $this->db->where('customer_tickets.main_admin_id', $admin_id);
      $this->db->select('customer_tickets.*, cpa.user_name as cpa_username, cpa.first_name as cpa_firstname, cpa.last_name as cpa_lastname, customer.user_name as customer_username, customer.first_name as customer_firstname, customer.last_name as customer_lastname');
      $this->db->from('customer_tickets');
      $this->db->join('users as cpa', 'customer_tickets.cpa_id = cpa.id', 'left'); 
      $this->db->join('users as customer', 'customer_tickets.customer_id = customer.id', 'left'); 
      $query = $this->db->get();
      // echo $this->db->last_query();
      // exit;
      return $query->result();
  }


  public function get_ticket_customer_list($customer_id=''){

      $this->db->order_by("customer_tickets.id", "desc");
      $this->db->where('customer_tickets.customer_id', $customer_id);
      $this->db->select('customer_tickets.*, cpa.first_name as cpa_firstname, cpa.last_name as cpa_lastname, customer.first_name as customer_first_name, customer.last_name as customer_last_name');
      $this->db->from('customer_tickets');
      $this->db->join('users as cpa', 'customer_tickets.cpa_id = cpa.id', 'left'); 
      $this->db->join('users as customer', 'customer_tickets.customer_id = customer.id', 'left'); 
      $query = $this->db->get();
      return $query->result();
  }


  public function filter_ticket_list($tablename, $main_admin_id, $cpa_id, $customer_id, $ticket_status){

      $this->db->order_by($tablename.".id", "desc");
      if(!empty($main_admin_id) AND !empty($cpa_id) AND !empty($customer_id)){
        $this->db->where($tablename.'.main_admin_id', $main_admin_id);
        $this->db->where($tablename.'.cpa_id', $cpa_id);
        $this->db->where($tablename.'.customer_id', $customer_id);
      }elseif(!empty($main_admin_id) AND !empty($cpa_id)){
        $this->db->where($tablename.'.main_admin_id', $main_admin_id);
        $this->db->where($tablename.'.cpa_id', $cpa_id);
      }elseif(!empty($main_admin_id) AND !empty($customer_id)){
        $this->db->where($tablename.'.main_admin_id', $main_admin_id);
        $this->db->where($tablename.'.customer_id', $customer_id);
      }elseif(!empty($cpa_id) AND !empty($customer_id)){
        $this->db->where($tablename.'.cpa_id', $cpa_id);
        $this->db->where($tablename.'.customer_id', $customer_id);
      }elseif(!empty($main_admin_id)){
          $this->db->where($tablename.'.main_admin_id', $main_admin_id);
      }elseif(!empty($cpa_id)){
        $this->db->where($tablename.'.cpa_id', $cpa_id);
      }elseif(!empty($customer_id)){
        $this->db->where($tablename.'.customer_id', $customer_id);
      }
      $this->db->where($tablename.'.ticket_status', $ticket_status);
      $this->db->select($tablename.'.*, cpa.user_name as cpa_username, cpa.first_name as cpa_firstname, cpa.last_name as cpa_lastname, customer.user_name as customer_username, customer.first_name as customer_firstname, customer.last_name as customer_lastname');
      $this->db->from($tablename);
      $this->db->join('users as cpa', $tablename.'.cpa_id = cpa.id', 'left'); 
      $this->db->join('users as customer', $tablename.'.customer_id = customer.id', 'left'); 
      $query = $this->db->get();
      //   echo $this->db->last_query();
      // exit;
      return $query->result();
  }

  public function filter_ticket_admin_list($tablename, $cpa_id, $customer_id, $ticket_status, $main_admin_id){

      $this->db->order_by($tablename.".id", "desc");
      if(!empty($cpa_id) AND !empty($customer_id)){
        $this->db->where($tablename.'.cpa_id', $cpa_id);
        $this->db->where($tablename.'.customer_id', $customer_id);
      }elseif(!empty($cpa_id)){
        $this->db->where($tablename.'.cpa_id', $cpa_id);
      }elseif(!empty($customer_id)){
        $this->db->where($tablename.'.customer_id', $customer_id);
      }
      $this->db->where($tablename.'.ticket_status', $ticket_status);
      $this->db->where($tablename.'.main_admin_id', $main_admin_id);
      $this->db->select($tablename.'.*, cpa.user_name as cpa_username, cpa.first_name as cpa_firstname, cpa.last_name as cpa_lastname, customer.user_name as customer_username, customer.first_name as customer_firstname, customer.last_name as customer_lastname');
      $this->db->from($tablename);
      $this->db->join('users as cpa', $tablename.'.cpa_id = cpa.id', 'left'); 
      $this->db->join('users as customer', $tablename.'.customer_id = customer.id', 'left'); 
      $query = $this->db->get();
      //   echo $this->db->last_query();
      // exit;
      return $query->result();
  }

  public function get_csv_data(){

      $this->db->where('admin.user_role', '2');
      $this->db->select('admin.*');
      $this->db->from('users as admin');
      $this->db->join('users as cpa', 'admin.id = cpa.main_admin_id', 'left'); 
      $query = $this->db->get();
      //$ss = $this->db->last_query();
      return $query->result();
  }

  public function check_zipcode($zip_code){

      $this->db->where("FIND_IN_SET( '$zip_code' , assign_zip_code) ");
      $this->db->select('*');
      $this->db->from('users');
      $query = $this->db->get();
      return $query->result();  
  }
   
  public function top_user(){

    $this->db->order_by("count", "desc");
    $this->db->select('main_admin_id, COUNT(main_admin_id) AS count', false);
    $this->db->from('customer_tickets');
    $this->db->where_in('ticket_status', '1,2', false);
    $this->db->group_by('main_admin_id');
    $this->db->limit(5);
    $query = $this->db->get();
    //echo $this->db->last_query();
    return $query->result();
  }

  public function fill_tickets($table_name, $start_date, $end_date, $main_admin_id='', $tik_status=''){

      if(!empty($main_admin_id)){
        $this->db->where('main_admin_id', $main_admin_id);
      }
      if(!empty($tik_status)){
        $this->db->where('ticket_status', $tik_status);
      }
      $this->db->where('DATE_FORMAT(start_date, "%Y-%m-%d") >=', $start_date);
      $this->db->where('DATE_FORMAT(start_date, "%Y-%m-%d") <=', $end_date);
      $this->db->select('*');
      $this->db->from($table_name);
      $query = $this->db->get();
      return $query->result();
  }


  public function fill_users($table_name, $user_role, $start_date, $end_date, $main_admin_id=''){

      if(!empty($main_admin_id)){
        $this->db->where('main_admin_id', $main_admin_id);
      }
      $this->db->where('user_role', $user_role);
      $this->db->where('DATE_FORMAT(created_date, "%Y-%m-%d") >=', $start_date);
      $this->db->where('DATE_FORMAT(created_date, "%Y-%m-%d") <=', $end_date);
      $this->db->select('*');
      $this->db->from($table_name);
      $query = $this->db->get();
      return $query->result();
  }

}
