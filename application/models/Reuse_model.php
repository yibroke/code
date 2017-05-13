<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reuse_model extends CI_Model {

    function update_last_seen($user_id)
    {
         $time=date('Y-m-d H:i:s');
        $data=array(
            'user_last_seen'=>$time,
        );
        $this->db->where('user_id',$user_id);
        $this->db->update('user',$data);
                
    }
    function reuse_list($tbl) {
        $this->db->select('*');
        $this->db->from($tbl);
        $query = $this->db->get();
        return $query->result();
    }
      function reuse_detail($table,$key,$id)
    {
         $this->db->select('*');
        $this->db->from($table);
        $this->db->where($key, $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    function reuse_delete($table,$key,$id)
    {
       $this->db->where($key,$id);
       $this->db->delete($table);
       return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    function reuse_count_all_where($table,$key,$value)
    {
        $this->db->where($key,$value);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }
    function reuse_count_all($table){
        
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }
    function reuse_list_limit($table_name,$limit,$offset,$order_by){
       
       $this->db->select('*');
        $this->db->from($table_name);
        $this->db->limit($limit,$offset);
        $this->db->order_by($order_by,'DESC');//1 is the first column should be id
        $query = $this->db->get();
        return $query->result();
    }
      function answer_id_to_name($id){
        $this->db->select('a_f1');
        $this->db->from('answer');
        $this->db->where('a_id',$id);
        $query=  $this->db->get();
        return $query->row()->a_f1;
        
    }

}
