<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Api_model extends CI_Model {

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
        return $query->result_array();
    } 

    public function getsingle_list($table_name, $field, $val){
      
      $this->db->order_by("id", "desc");
      $this->db->where($field, $val);
      $this->db->select('*');
      $this->db->from($table_name);
      $query = $this->db->get();
      //  echo $this->db->last_query();
      // exit;
      return $query->result_array();  
    }

    public function getsinglerow($table_name, $field, $val){
    
      $this->db->where($field, $val);
      $this->db->select('*');
      $this->db->from($table_name);
      $query = $this->db->get();
      return $query->row_array();  
    }

    public function getstate(){

        $this->db->order_by("name", "asc");
        $this->db->select('*');
        $this->db->from('state_master');
        $query = $this->db->get();
        return $query->result_array();
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

      $condition = "(customer_tickets.customer_id='$customer_id') AND (customer_tickets.ticket_status=1 OR customer_tickets.ticket_status=2)";

      $this->db->order_by("customer_tickets.id", "desc");
      $this->db->where($condition);
      //$this->db->where('customer_tickets.ticket_status', '1');
      //$this->db->or_where('customer_tickets.ticket_status', '2');
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.email_address, users.user_image, users.zip_code');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.cpa_id = users.id', 'left'); 
      $query = $this->db->get();
      //  echo $this->db->last_query();
      // exit;
      return $query->result_array();
   }




  public function get_ratting_review($cpa_id=''){

      $this->db->where('cpa_id', $cpa_id);
      $this->db->select('cpa_ratting.id, cpa_ratting.ticket_number, cpa_ratting.ratting_no, cpa_ratting.description, cpa_ratting.created_date, users.first_name, users.last_name, users.avg_ratting');
      $this->db->from('cpa_ratting');
      $this->db->join('users', 'cpa_ratting.customer_id = users.id', 'left'); 
      $query = $this->db->get();
      return $query->result_array();
  }

  public function closed_ticket_customer($customer_id){
      
      $this->db->order_by("id", "desc");
      $this->db->where('customer_id', $customer_id);
      $this->db->where('ticket_status', '3');
      $this->db->select('*');
      $this->db->from('customer_tickets');
      $query = $this->db->get();
      return $query->result_array();  
  }

  public function get_ticket($cpa_id='', $ticket_status=''){
      
      $this->db->order_by("customer_tickets.id", "desc");  
      $this->db->where('cpa_id', $cpa_id);  
      $this->db->where('ticket_status', $ticket_status);
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.customer_id = users.id', 'left');
      $query = $this->db->get();
      return $query->result_array();  
  }

  public function get_ticket_num($ticket_number=''){
      
      $this->db->where('ticket_number', $ticket_number);
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('customer_tickets');
      $this->db->join('users', 'customer_tickets.customer_id = users.id', 'left');
      $query = $this->db->get();
      // echo $this->db->last_query();
      // exit;
      return $query->result_array();  
  }

    public function anroid_send_pushnotification($deviceToken, $data) {
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        //$url = 'https://android.googleapis.com/gcm/send';
        $fields = array (
                'to' => $deviceToken,
                'notification' => array (
                        
                        //"message" => 'Create Consignment', 
                        "body" => $data['body'],
                        "title" => $data['title'],
                        "icon" => "myicon",
                        "sound" => "default"
                ),
                'data' => $data['details']
        );

        $fields = json_encode ($fields);
        $headers = array (

                //'Authorization: key='."AIzaSyBx47p10nKc2Tdi9jARFIPFfzPvz2aMg8o",
                // 'Authorization: key='."AAAAkRwNt1U:APA91bEclGuoVY-6OBsltKaAbY4MKEIkeAnZwT0QE1YSXH8ZbzwSToXY4OgcH5jEY4MrRKO8hL-bYJmn0vYvRbdWHt0mKUkQwkbxvYlpPLmGtnxV_YL2klAa7nvW2Gp24cmPfpt0Re06",


                'Authorization: key='."AAAAnBGw8Fs:APA91bE0SL_uoZ4UX2ZFR4JDUEhorfXC6vwqh5Ou9CeHyUjU5zoW5BhYREjJ3CimUi-V-cfpQSpG7q3TlDx52_agNC04WHZFBWxzkFc2rTzQjCS7ElgWQbd_sKUoA6V7MSL--fg2AjOU",
                'Content-Type: application/json'
        );

        $ch = curl_init (); 
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 1); //timeout in seconds
        curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, false);
        $result = curl_exec ($ch);
        curl_close ( $ch );
        return true;
        //echo $result;
        //exit;
        //  if (!$result)
        //     return 'Message not delivered';
        // else
        //     return 'Message successfully delivered';
    }

    public function ios_send_pushnotification($deviceToken, $data){

        // echo '<pre>';
        // print_r($deviceToken);
        // print_r($data);
        // echo '</pre>';die;
        
        //echo $deviceToken;

        define('API_ACCESS_KEY', 'AAAAnBGw8Fs:APA91bE0SL_uoZ4UX2ZFR4JDUEhorfXC6vwqh5Ou9CeHyUjU5zoW5BhYREjJ3CimUi-V-cfpQSpG7q3TlDx52_agNC04WHZFBWxzkFc2rTzQjCS7ElgWQbd_sKUoA6V7MSL--fg2AjOU');
        // define('API_ACCESS_KEY', 'AAAAkRwNt1U:APA91bEclGuoVY-6OBsltKaAbY4MKEIkeAnZwT0QE1YSXH8ZbzwSToXY4OgcH5jEY4MrRKO8hL-bYJmn0vYvRbdWHt0mKUkQwkbxvYlpPLmGtnxV_YL2klAa7nvW2Gp24cmPfpt0Re06');
       
        $registrationIds = array($deviceToken);

        $fields = array(
                    'registration_ids'  => $registrationIds,
                    //'notification' => $data
                    'notification' => array (
                        
                        //"message" => 'Create Consignment', 
                        "body" => $data['body'],
                        "title" => $data['title'],
                        "icon" => "myicon",
                        "sound" => "default"
                ),
                'data' => $data['details']
                    //'aps' => $data
                );
        $fields = json_encode ($fields);
        $headers = array(
                    'Authorization: key=' . API_ACCESS_KEY,
                    'Content-Type: application/json'
                );


        //  $ch = curl_init ();
        // curl_setopt ( $ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        // curl_setopt ( $ch, CURLOPT_POST, true );
        // curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        // curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        // curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        // curl_setopt ( $ch, CURLOPT_TIMEOUT, 1); //timeout in seconds
        // curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, false);
        // $result = curl_exec ($ch);
        // curl_close ( $ch );
        // return true;
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close( $ch );
        return true;
        //echo $result; 
        //exit;
    }


    public function ios_send_pushnotification1($deviceToken, $data){

        // echo '<pre>';
        // print_r($deviceToken);
        // print_r($data);
        // echo '</pre>';die;
        
        // $deviceToken = 'eqxJrKBWuE6vm4X2LKESyO:APA91bGMyNPCDZqAnprT107QXVWRJ9SDs9iFUa_vxTcrFSZrMJHvNk_8FaYcA02pXVth_6uZsLnyzjZjkhRpPuhtWTTfoy35E-i67bwq62BM32ziJJ57UXzfGCiosWS989nyw3yyLoS3';

        define('API_ACCESS_KEY', 'AAAATIsDWUY:APA91bHIcsq-gGoSEVzzPjX4sLeUKlE8isZqRJle-mbJ83xnoDPHGqO42r7FeoiILkaNhVB69ztkUrvj8nhAUrMNICQf5cq_2pSXQExlHQbg93DprViLJl8p4tA6HqNzjxDPoB_b4HIj');
        $registrationIds = array($deviceToken);

        $fields = array(
                    'registration_ids'  => $registrationIds,
                    //'notification' => $data
                    'notification' => array (
                        //"message" => 'Create Consignment', 
                        "body" => 'hello'
                    )
                );

        // echo '<pre>';
        // print_r($fields);
        // echo '</pre>';
        // exit;

        $fields = json_encode ($fields);

        $headers = array(
                    'Authorization: key=' . API_ACCESS_KEY,
                    'Content-Type: application/json'
                );


        //  $ch = curl_init ();
        // curl_setopt ( $ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        // curl_setopt ( $ch, CURLOPT_POST, true );
        // curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        // curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        // curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        // curl_setopt ( $ch, CURLOPT_TIMEOUT, 1); //timeout in seconds
        // curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, false);
        // $result = curl_exec ($ch);
        // curl_close ( $ch );
        // return true;
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close( $ch );
        //return true;
        echo $result;
        exit;
    }


    public function delete_ticket(){

      $this->db->where('main_admin_id', '0');
      $this->db->where('cpa_id', '0');
      $this->db->where('customer_id', '0');
      $this->db->delete('customer_tickets');
    }


    public function get_notification_list($usre_id, $user_role){

      $this->db->order_by("customer_tickets.id", "desc");  
      if($user_role == 3){
        $this->db->where('cpa_id', $usre_id);  
      }
      if($user_role == 4){
        $this->db->where('customer_id', $usre_id);  
      }
      $this->db->where('notif_status', 1);
      $this->db->select('customer_tickets.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('customer_tickets');
      if($user_role == 3){
        $this->db->join('users', 'customer_tickets.customer_id = users.id', 'left');
      }
      if($user_role == 4){
        $this->db->join('users', 'customer_tickets.cpa_id = users.id', 'left');
      }  
      $query = $this->db->get();
      return $query->result_array();  
    }

    public function get_notification_ratting_list($cpa_id){

      $this->db->order_by("cpa_ratting.id", "desc");  
      $this->db->where('cpa_id', $cpa_id);  
      $this->db->where('notif_status', 1);
      $this->db->select('cpa_ratting.*, users.first_name, users.last_name, users.user_name, users.zip_code');
      $this->db->from('cpa_ratting');
      $this->db->join('users', 'cpa_ratting.customer_id = users.id', 'left');
      $query = $this->db->get();
      return $query->result_array();  
    }
}
