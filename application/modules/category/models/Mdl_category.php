<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_category extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "category";
        return $table;
    }
     function category_home($order_by) {
       $this->db->select('category.*, count(topic.id) AS count_topic, count(comment.comment_id) AS count_comment');
        $this->db->from('category');
       $this->db->join('topic','topic_cat=category.id','right');
       $this->db->join('comment','comment.comment_topic=topic.id','left');
       $this->db->group_by('category.id');
       $this->db->order_by('count_topic','DESC');
        $query=  $this->db->get();
        return $query;
    }
     //category in index page
    function category()
    {
      $this->db->select('category.*');
        $this->db->from('category');
      
        $query=  $this->db->get();
    
        
        return $query->result();
    }
        //category in index page
    function category_old($id)
    {
      $this->db->select('category.*,category_dad.*, count(topic.id) AS count_topic, count(comment.comment_id) AS count_comment');
        $this->db->from('category');
        $this->db->join('category_dad','category_dad_id=category_dad_is');
       $this->db->join('topic','topic_cat=category_id','right');
       $this->db->join('comment','comment.comment_topic=topic.id','left');
       $this->db->group_by('category_id');
        $this->db->where('category_dad_is',$id);
        $query=  $this->db->get();
    
        
        return $query->result();
    }
    //category in category page
    function get_category()
    {
        $id=  $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_id',$id);
        $query=  $this->db->get();
        return $query->row();
    }
    function get_category_topic($limit,$offset)
    {
        $id=  $this->uri->segment(3);
        $this->db->select('*,count(comment.comment_id) AS count_comment');
        $this->db->from('category');
        $this->db->join('topic','topic.topic_cat=category.category_id');
        $this->db->join('user','user.user_id=topic.topic_by');
        $this->db->join('comment','comment.comment_topic=topic.id','left');
        $this->db->where('category_id',$id);
        $this->db->group_by("id");
         $this->db->order_by('id','DESC');
        //$this->db->limit($limit,$offset);//limit should get from parameter
      $this->db->limit($limit,$offset);
        $query=  $this->db->get();
        return $query->result();
    }
    function new_comment_on_category()
    {
        $id=  $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('category');
        $this->db->join('topic','topic.topic_cat=category.category_id');
        $this->db->join('comment','comment.comment_topic=topic.id');
        $this->db->join('user','user.user_id=comment.comment_by');
        $this->db->where('category_id',$id);
        $this->db->group_by("id");
        $this->db->order_by('comment_id','DESC');
        $this->db->limit(10);
        $query=  $this->db->get();
        return $query->result();
    }
    function get_category_list()
    {
        $this->db->select('*');
        $this->db->from('category');
        $query=  $this->db->get();
        return $query->result();
        
    }
    // count how many topic in a category
    function get_num_rows()
    {
        $id=  $this->uri->segment(3);
        $this->db->from('category');
        $this->db->join('topic','topic.topic_cat=category.id');
         $this->db->where('category.id',$id);
        $query=  $this->db->get();
       return $query->num_rows();
    }
    function get_join_topic($id,$limit, $offset)
    {
        $this->db->select('category.*,topic.*');
        $this->db->from('category');
        $this->db->where('category.id',$id);
        $this->db->join('topic','topic.topic_cat=category.id');
          $this->db->limit($limit, $offset);
        $this->db->order_by('topic.id','DESC');
        $query=  $this->db->get();
        return $query->result();
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
