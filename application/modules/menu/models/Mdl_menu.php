<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_menu extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "menu";
        return $table;
    }
      function update_order($id,$sort)
    {
         $data = array(
        'iorder' => $sort
        );
        $this->db->where('id', $id);
        $this->db->update('menu', $data);
    }
    function get_join_item($id)
    {
        $this->db->select('menu.*,items.*');
        $this->db->from('menu');
        $this->db->where('menu.id',$id);
        $this->db->join('items','items.fk_menu_id=menu.id');
        $query=  $this->db->get();
        return $query->result();
    }

    function get($order_by) {
        
        $this->db->select('menu.*,count(menu_sub.id) as count_sub');
        $this->db->from('menu');
        $this->db->join('menu_sub','menu_sub.fk_menu=menu.id','left');
        $this->db->where('menu.public','y');
        $this->db->group_by('menu.id');
        $this->db->order_by($order_by,'DESC');//No group by the count not work.
        $query = $this->db->get();
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
    function get_max_order() {
        $table = $this->get_table();
        $this->db->select('iorder');
        $this->db->limit(1);
        $this->db->order_by('iorder','DESC');
        $query = $this->db->get($table);
        $row = $query->row();
        $max_order = $row->iorder;
        return $max_order;
    }

    function _custom_query($mysql_query) {
        $query = $this->db->query($mysql_query);
        return $query;
    }

}
