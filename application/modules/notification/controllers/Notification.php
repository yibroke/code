<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    //function update bell view
    function update_bell_view($user_id)
    {
        $this->mdl_bell->update_vew($user_id);  
    }
    function insert_notification($user_id,$title,$main_id,$module)
    {
        $data['fk_user_id']=  $user_id;
        $data['title']=$title;
        $data['main_id']=$main_id;
        $data['module']=$module;
        $data['date']=date('Y-m-d H:i:s');
        $this->_insert($data);
    }
    //list notification
    function list_notification()
    {
        $user_id=  $this->session->user_id;
        //update bell view to 1
        $this->update_bell_view($user_id);
        $this->load->model('mdl_notification');
        $query= $this->mdl_notification->get_noti_where_custom($user_id);
        $data['query']=$query->result();
        $data['view_file'] = 'list_noti'; //view file
        $data['module'] = 'notification'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
      function get($order_by) {
        $this->load->model('mdl_notification');
        $query = $this->mdl_notification->get($order_by);
        return $query;
    }
    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_notification');
        $query = $this->mdl_notification->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_notification');
        $query = $this->mdl_notification->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_notification');
        $query = $this->mdl_notification->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_notification');
        $this->mdl_notification->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_notification');
        $this->mdl_notification->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_notification');
        $this->mdl_notification->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_notification');
        $count = $this->mdl_notification->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_notification');
        $max_id = $this->mdl_notification->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_notification');
        $query = $this->mdl_notification->_custom_query($mysql_query);
        return $query;
    }
}
