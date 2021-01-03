<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Cpa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   
  
    public function get_cpa_list($table_name, $field, $val, $field1, $val1){

      $this->db->order_by("id", "desc");
      $this->db->where($field, $val);
      $this->db->where($field1, $val1);
      $this->db->select('*');
      $this->db->from($table_name);
      $query = $this->db->get();
      return $query->result();  
    } 
   
}
