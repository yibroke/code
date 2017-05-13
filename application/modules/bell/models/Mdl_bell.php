<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_bell extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "bell";
        return $table;
    }
    function check_user($user_id)
    {
        $this->db->select('*');
        $this->db->from('bell');
        $this->db->where('fk_user_id', $user_id);// login use user email so we cant use user id here
        $query= $this->db->get();
         if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function list_bell($user_id)
    {
       
        $this->db->select('bell.*,notification.*');
        $this->db->from('bell');
        $this->db->join('notification','bell.fk_notification_id=notification.id');
        $this->db->where('fk_user_id', $user_id);
        $this->db->order_by('bell.id','DESC');
        $this->db->limit(10);
        //$this->db->where('view', 0);
        $query = $this->db->get();
        return $query->result();
    }
    function get_count_bell_where($user_id)
    {
        $table = $this->get_table();
        $this->db->where('fk_user_id', $user_id);
       // $this->db->where('view', 0);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }
    function insert($user_id,$notification_id)
    {
        $data=array(
          'fk_notification_id'=>$notification_id,
          'fk_user_id'=>$user_id,
          'view'=>0,
          'date'=> date('Y-m-d H:i:s')
        );
        $this->db->insert('bell',$data);
    }
    function update_vew($user_id)
    {
        $data = array(
        'view' => 0
            );
            $this->db->where('fk_user_id', $user_id);
            $this->db->update('bell', $data);
    }

    function get($order_by) {
        $table = $this->get_table();
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $table = $this->get_table();
        $this->db->limit($limit, $offset);
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        return $query;
    }

    function get_where($id) {
        $table = $this->get_table();
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query;
    }

    function get_where_custom($col, $value) {
        $table = $this->get_table();
        $this->db->where($col, $value);
        $query = $this->db->get($table);
        return $query;
    }

    function _insert($data) {
        $table = $this->get_table();
        $this->db->insert($table, $data);
    }

    function _update($id, $data) {
        $table = $this->get_table();
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

    function _delete($id) {
        $table = $this->get_table();
        $this->db->where('id', $id);
        $this->db->delete($table);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    function count_where($column, $value) {
        $table = $this->get_table();
        $this->db->where($column, $value);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function count_all() {
        $table = $this->get_table();
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function get_max() {
        $table = $this->get_table();
        $this->db->select_max('id');
        $query = $this->db->get($table);
        $row = $query->row();
        $id = $row->id;
        return $id;
    }

    function _custom_query($mysql_query) {
        $query = $this->db->query($mysql_query);
        return $query;
    }

}
