<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_topic extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "topic";
        return $table;
    }
 function news_topic()
    {   
       
        $this->db->limit(20);
        $this->db->select('*');
        $this->db->from('topic');
       $this->db->order_by('id','DESC');
        $query=$this->db->get();
        return $query->result();
    }
    //detail
    function detail($id) {

        $this->db->select('*');
        $this->db->from('topic');
        $this->db->join('user','user.user_id=topic.topic_by');
        $this->db->where('id',$id);
        $query=  $this->db->get();
        return $query;
    }
        function read_topic($id)
    {
       
        $this->db->select('*');
        $this->db->from('topic');
        $this->db->join('user','user.user_id=topic.topic_by');
        $this->db->where('id',$id);
        $query=  $this->db->get();
        return $query->row();
    }
    function get_all_topic($limit,$offset)
    {
        $this->db->select('*,count(comment.comment_id) AS count_comment');
        $this->db->from('topic');
        $this->db->join('user','user.user_id=topic.topic_by');
        $this->db->join('comment','comment.comment_topic=topic.id','left');
        $this->db->group_by("id");
        $this->db->order_by("id","DESC");
        $this->db->limit($limit,$offset);
        $query=  $this->db->get();
        return $query->result();
    }
    function insert_topic() {
        $date = date('Y-m-d H:i:s');

        $data = array(
            'topic_name' => $this->input->post('name'),
            'topic_content' => $this->input->post('content'),
            'topic_tag' => $this->input->post('tags'),
            'topic_date' => $date,
            'topic_cat' => $this->input->post('category'),
            'topic_by' => $this->session->userdata('user_id'),
            'topic_view' => 0
        );
        ///  print_r($data);
        $this->db->insert('topic', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    function update_topic()
    {
        $id=  $this->input->post('id');
         $data = array(
            'topic_name' => $this->input->post('name'),
            'topic_content' => $this->input->post('content'),
            'topic_tag' => $this->input->post('tags')
        );
        ///  print_r($data);
        $this->db->where('id',$id);
        $this->db->update('topic', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    function get_num_rows()
    {
       $query=  $this->db->get('topic');
       return $query->num_rows();
    }
    function get_search_num_rows()
    {
         $this->db->like('topic_tag',  $this->input->get('search'));
       $query=  $this->db->get('topic');
       return $query->num_rows();
    }
    function search($limit,$offset)
    {
       // echo  $this->input->post('search');
        
        $this->db->select('*');
        $this->db->from('topic');
        $this->db->group_by("id");
        $this->db->like('topic_tag',  $this->input->get('search'));
       // $this->db->limit($limit,$offset);
       $this->db->limit($limit,$offset);
        $this->db->order_by('id','DESC');
        $query=  $this->db->get();
        return $query->result();
    }

    function get_where_custom_search($col, $keyword, $limit, $offset, $order_by) {
        $this->db->select('*');
        $this->db->from('topic');
        $this->db->like($col, $keyword);
        $this->db->limit($limit, $offset);
        //change the order by
        $this->db->order_by($order_by, 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function newest_topic()
    {
        $this->db->select('*');
        $this->db->from('topic');
        $this->db->where('topic_by',  $this->session->userdata('user_id'));
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query=$this->db->get();
        return $query->row();
        
    }
    function get_one_element($id,$select)
    {
        $this->db->select($select);
        $this->db->from('topic');
        $this->db->where('id',$id);
        $query=  $this->db->get();
        return $query->row();
    }
    function update_view($current_view)
    {
         $id=$this->uri->segment(3);
         $data = array(
        'topic_view' => $current_view+1,
        );
        $this->db->where('id', $id);
        $this->db->update('topic', $data);
        
    }
    function get_new_post()
    {
        //get newest id and name
        $this->db->select('id,topic_name');
        $this->db->from('topic');
        $this->db->where('topic_by',  $this->session->userdata('user_id'));
        $this->db->limit(1);
        $this->db->order_by('id','DESC');
        $query=  $this->db->get();
        return $query->row();
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
