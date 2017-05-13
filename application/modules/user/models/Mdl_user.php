<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_user extends CI_Model {

    function __construct() {
        parent::__construct();
    }
      function get_table() {
        $table = "user";
        return $table;
    }
      function get_user_session($id)
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id',$id);
        $query=  $this->db->get();
        return $query->row();
  
    }
    function update_token_remember_me($token,$user_id)
    {
         $this->db->where('user_id',$user_id);
         $data=array(
             'remember_me_token'=>$token,
             );
         $this->db->update('user',$data);
    }
     function delete_user($id)
    {
         $this->db->where('user_id',$id);
       $this->db->delete('user');
       return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        
    }
    function get_count_point_where($user_id)
    {
        $table = $this->get_table();
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($table);
      
        return $query->row()->user_point;
    }
  
    function update_avatar($user_id,$avatar)
    {
          $this->db->where('user_id',$user_id);
         $data=array(
             'user_avatar'=>$avatar
             );
         $this->db->update('user',$data);
          return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
     function can_login()
    {
        $user_email = $this->input->post('email_login');
        $user_pass =md5($this->input->post('password_login'));
        $this->db->select('user_id', 'user_name');
        $this->db->where('user_email', $user_email);
        $this->db->where('user_pass', $user_pass);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    function check_pass()
    {
        $user_id = $this->session->user_id;
        $user_pass =md5($this->input->post('current_password'));
        $this->db->select('user_id', 'user_name');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_pass', $user_pass);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    function check_token_cookie($cookie)
    {
        $this->db->where('remember_me_token', $cookie);
        $query = $this->db->get('user');
        return ($query->num_rows() == 1) ? TRUE : FALSE;
    }
    function get_user_detail_where_token($cookie_value)
    {
          $this->db->select('*');
        $this->db->from('user');
        $this->db->where('remember_me_token', $cookie_value);// login use user email so we cant use user id here
        $query= $this->db->get();
         if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
     function get_user_detail($user_email)//for login
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_email', $user_email);// login use user email so we cant use user id here
        $query= $this->db->get();
         if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    function get_user_detail_from_id($user_id)//for token
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);// user id.
        $query= $this->db->get();
         if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    //insert user
    function insert_user($active_key)
    {
         $table = $this->get_table();
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $password= md5($this->input->post('password'));
         $time=date('Y-m-d H:i:s');
        $data=array(
          'user_name'=>$name,
          'user_email'=>$email,
          'user_pass'=>$password,
          'user_date'=>$time,
          'user_role'=>'user',
          'user_active'=>$active_key,
          'user_last_seen'=>$time 
        );
      $this->db->insert($table,$data);
       return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    //insert user with facebook // same with Google
    function insert_user_from_fb()
    {
         $table = $this->get_table();
        $name=$this->input->post('user_name');
        $email=$this->input->post('user_id');//facebook id
         $time=date('Y-m-d H:i:s');
        $data=array(
          'user_name'=>$name,
          'user_email'=>$email,
          'user_pass'=>'password',
          'user_date'=>$time,
          'user_role'=>'user',
          'user_active'=>'No',
          'user_last_seen'=>$time 
        );
      $this->db->insert($table,$data);
       return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    //active account
    function active_account($active_key){
          $this->db->where('user_active',$active_key);
         $data=array(
             'user_active'=>0
             );
         $this->db->update('user',$data);
          return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    // Check email.
    function has_email(){
        $user_email = $this->input->post('email');
        $this->db->select('user_id', 'user_name');
        $this->db->where('user_email', $user_email);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    //update reset key
    function update_reset_key($reset_key){
         $user_email = $this->input->post('email');
         $this->db->where('user_email',$user_email);
         $data=array('reset_password_key'=>$reset_key);
         $this->db->update('user',$data);
          return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
         
    }
    //update password
    function update_password(){
         $reset_key = $this->input->post('reset_key');
         $password=  md5($this->input->post('password'));
         $this->db->where('reset_password_key',$reset_key);
         $data=array(
             'user_pass'=>$password,
             'reset_password_key'=>'0'
             );
         $this->db->update('user',$data);
          return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    // change password
    function change_password(){
         $user_id = $this->session->user_id;
         $password=  md5($this->input->post('password'));
         $this->db->where('user_id',$user_id);
         $data=array(
             'user_pass'=>$password,//change pas
             'remember_me_token'=>NULL// change cookie.
             );
         $this->db->update('user',$data);
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
        $this->db->where('user_id', $id);
        $query = $this->db->get($table);
        return $query;
    }

    function get_where_custom($col, $value) {
        $table = $this->get_table();
        $this->db->where($col, $value);
        $this->db->order_by('user_last_seen','DESC');
        $query = $this->db->get($table);
        return $query;
    }

    function _insert($data) {
        $table = $this->get_table();
        $this->db->insert($table, $data);
    }

    function _update($id, $data) {
        $table = $this->get_table();
        $this->db->where('user_id', $id);
        $this->db->update($table, $data);
    }
    function _delete($id) {
        $table = $this->get_table();
        $this->db->where('user_id', $id);
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
        $this->db->select_max('user_id');
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
