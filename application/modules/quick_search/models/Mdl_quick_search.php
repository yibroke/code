<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_quick_search extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "quick_search";
        return $table;
    }
    function update_order($id,$a_soft)
    {
         $data = array(
        'a_order' => $a_soft
        );
        $this->db->where('id', $id);
        $this->db->update('quick_search', $data);
    }
    function quick_search_menu()
    {
        $this->db->select('id,name,a_order');
        $this->db->from('quick_search');
        $this->db->order_by('a_order','desc');
        $query=  $this->db->get();
        return $query->result();
    }
     function list_quick_search()
    {
       $this->db->select('quick_search.*,quick_search_img.url,max(quick_search_img.id)');
        $this->db->from('quick_search');
         $this->db->join('quick_search_img','quick_search_img.quick_search_id=quick_search.id','left');
         $this->db->group_by("quick_search.id");

        $query=  $this->db->get();// quick_search is table name
        return $query->result();
    }
    function insert_quick_search()
    {
         $date = date('Y-m-d H:i:s');

        $data = array(
            'name' => $this->input->post('ia1'),
            'age' => $this->input->post('ia2'),
            'bar' => $this->input->post('ia3'),
            'height' => $this->input->post('ia4'),
            'services'=>$this->input->post('ia5'),
            'rates'=> $this->input->post('ia6'),
            'note'=> $this->input->post('ia7'),
            'date'=> $date
        );
        $this->db->insert('quick_search', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    function read($id) {

        $this->db->select('quick_search.*,quick_search_img.url');
        $this->db->from('quick_search');
        $this->db->join('quick_search_img','quick_search_img.quick_search_id=quick_search.id','left');
        $this->db->where('quick_search.id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
     function girls() {

         $this->db->select('quick_search.*');
        $this->db->from('quick_search');
         $this->db->order_by('a_order','DESC');
        $query=  $this->db->get();// quick_search is table name
        return $query->result();
    }
     function update_quick_search($id)
    {
      

        $data = array(
            
            'name' => $this->input->post('ea1'),
            'age' => $this->input->post('ea2'),
            'bar' => $this->input->post('ea3'),
            'height' => $this->input->post('ea4'),
            'services' => $this->input->post('ea5'),
            'rates' => $this->input->post('ea6'),
            'note' => $this->input->post('ea7')
            
           
        );
         $this->db->where('id', $id);
        $this->db->update('quick_search', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    function delete_quick_search($id)
    {
         $this->db->where('id',$id);
       $this->db->delete('quick_search');
       return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        
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
    function get_max_order() {
        $table = $this->get_table();
        $this->db->select('a_order');
        $this->db->limit(1);
        $this->db->order_by('a_order','DESC');
        $query = $this->db->get($table);
        $row = $query->row();
        $max_order = $row->a_order;
        return $max_order;
    }
    

    function _custom_query($mysql_query) {
        $query = $this->db->query($mysql_query);
        return $query;
    }

}
