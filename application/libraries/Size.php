<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reuse_model_function {

    private $CI;
    // Create meta tags
      function _create_mdata() {
        $data['title'] ='Poll';
        $data['des'] = 'Poll free servey';
        $data['key'] = 'poll, free, servey';
        return $data;
    }
    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('reuse_model');
    }
    function answer_name($id){
             return $this->CI->reuse_model->answer_id_to_name($id);
      }
    function count_all($table_name){
          return $this->CI->reuse_model->reuse_count_all($table_name);
    }
    function count_all_where($table,$key,$value)
    {
          return $this->CI->reuse_model->reuse_count_all_where($table,$key,$value);
    }


    function _detail($table, $key, $id) {
        return $this->CI->reuse_model->reuse_detail($table, $key, $id);
    }

    function _list($table_name) {

        return $this->CI->reuse_model->reuse_list($table_name);
    }
    function get_with_limit($table_name,$limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }
          return $this->CI->reuse_model->reuse_list_limit($table_name,$limit,$offset,$order_by);
    }
       function _delete($table, $key, $id) {

       if($this->CI->reuse_model->reuse_delete($table, $key, $id)==true)
        {
            return 'true';
        }else{
            return 'false';
        }
        
    }
    function _insert_3_f($table,$f1,$f2,$f3,$n1,$n2,$n3)
    {
       $data = array(
            $n1 => $f1,
            $n2 => $f2,
            $n3 => $f3
        );
        $this->db->insert($table, $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
   }

}
