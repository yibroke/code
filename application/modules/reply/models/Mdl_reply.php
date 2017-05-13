<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_reply extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "reply";
        return $table;
    }
   function delete_comment_where($item_id)
   {
        $this->db->delete('reply', array('fk_question_id' => $item_id));//delete answer
   }
    function count_my_poll_comment($question_array){
         $table = $this->get_table();
          $this->db->where_in('fk_question_id',$question_array);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }
      function get_comment_join_question_and_user($limit,$offset){
        $this->db->select('comment.*,user.user_name,user.user_id,items.id,items.name');
        $this->db->from('comment');
        $this->db->join('items','items.id=comment.fk_question_id','left');
        $this->db->join('user','user.user_id=comment.fk_user_id','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('comment_id','DESC');//1 is the first column should be id
         $query=  $this->db->get();
        return $query->result();
    }
      function my_poll_comment_join_question_and_user($question_id,$limit,$offset){
        $this->db->select('comment.*,user.user_id,user.user_name,items.id,items.name');
        $this->db->from('comment');
        $this->db->join('items','items.id=comment.fk_question_id','left');
        $this->db->join('user','user.user_id=comment.fk_user_id','right');
        $this->db->limit($limit,$offset);
        $this->db->where_in('id', $question_id);
        $this->db->order_by('comment_id','DESC');//1 is the first column should be id
         $query=  $this->db->get();
        return $query->result();
    }
      function my_comment_join_question_and_user($user_id,$limit,$offset){
        $this->db->select('comment.*,user.user_id,user.user_name,question.q_f1');
        $this->db->from('comment');
        $this->db->join('question','question.q_id=comment.fk_question_id','left');
        $this->db->join('user','user.user_id=comment.fk_user_id','right');
        $this->db->limit($limit,$offset);
        $this->db->where_in('comment.fk_user_id', $user_id);
        $this->db->order_by('comment.comment_id','DESC');//1 is the first column should be id
         $query=  $this->db->get();
        return $query->result();
    }
    function get_one_rep($user_id){
         $table = $this->get_table();
           $this->db->select('reply.*,user.user_id,user.user_name,user_avatar');
        $this->db->from($table);
        $this->db->where('user_reply_id',$user_id);
         $this->db->join('user','user_id=user_reply_id');
        $this->db->limit(1);
        $this->db->order_by('id','DESC');
        $query=  $this->db->get();
        return $query->row(); 
    }
    function list_comment_join_user($limit,$offset,$id){
         $table = $this->get_table();
         $this->db->select('comment.*,user.user_id,user.user_name,user_avatar');
        $this->db->from($table);
        $this->db->where('fk_question_id',$id);
        $this->db->where('parent_id',0);
        $this->db->join('user','user_id=fk_user_id');
          $this->db->limit($limit, $offset);
        $this->db->order_by('comment_id','DESC');//1 is the first column should be id
        $query=  $this->db->get();
        return $query->result();
    }
    function reply_list_comment_join_user($limit,$offset,$id){
         $table = $this->get_table();
         $this->db->select('reply.*,user.user_id,user.user_name,user_avatar');
        $this->db->from($table);
        $this->db->where('fk_comment_id',$id);
        $this->db->join('user','user_id=user_reply_id');
          $this->db->limit($limit, $offset);
        $this->db->order_by('id','ASC');//1 is the first column should be id
        $query=  $this->db->get();
        return $query->result();
    }
    function count_comment_where($id){
          $table = $this->get_table();
          $this->db->where('fk_question_id',$id);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
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
         return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
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
