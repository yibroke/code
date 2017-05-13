<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_info extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
     function get_data_from_post() {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        
        return $data;
    }
     function get_data_from_db($update_id) {
         
        $query = $this->get_where_custom('id', $update_id);
         $data['name']=$query->row()->name;
         $data['phone']=$query->row()->phone;
         $data['email']=$query->row()->email;
         $data['address']=$query->row()->address;
        if (!isset($data)) {
            $data = '';
        }
        return $data;
    }
     function shop_info_validation()
    {
         $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Shop Name', 'required');
        $this->form_validation->set_rules('phone', 'Shop Phone', 'required');
        $this->form_validation->set_rules('email', 'Shop Email', 'required');
        $this->form_validation->set_rules('address', 'Shop Address', 'required');
       $update_id = $this->input->post('id', TRUE);

        if ($this->form_validation->run() == TRUE) {
            //after everything ok insert new topic to database
             $data = $this->get_data_from_post();
              if (is_numeric($update_id)) {// IF EXIST UPDATE ID UPDATE
                $this->_update($update_id, $data);
                 $data = 'shop_info/index';
                  // 1. Get id and name
                redirect($data, 'refresh');

              }else{// UPDATE
                   $this->_insert($data);
               
                $data = 'shop_info/index';
                  // 1. Get id and name
                redirect($data, 'refresh');
                  
              }
        }else{
            echo validation_errors();
        }
                  

    }
    function insert()
    {
         echo Modules::run('site_security/make_sure_is_admin');
       
        $update_id = $this->uri->segment(3); //get the update id from the url
        if (!isset($update_id)) {
            $update_id = $this->input->post('id', TRUE);
        }
        if (is_numeric($update_id)) {
            $data = $this->get_data_from_db($update_id);
            $data['update_id'] = $update_id;
        } else {
            $data = $this->get_data_from_post();
        }
        $data['update_id'] = $update_id; //use this for the hidden fifle
      $data['current'] = $this->uri->segment(1);
        $data['view_file'] = 'insert'; //view file
        $data['module'] = 'shop_info'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function index()
    {
        $data['current'] = $this->uri->segment(1);
       $data['query']=  $this->get_where(1)->result();
        $data['title'] = 'Mua xem, khong mua thi xem';
        $data['view_file'] = 'index'; //view file
        $data['module'] = 'shop_info'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function get($order_by) {
        $this->load->model('mdl_shop_info');
        $query = $this->mdl_shop_info->get($order_by);
        return $query;
    }
    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_shop_info');
        $query = $this->mdl_shop_info->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_shop_info');
        $query = $this->mdl_shop_info->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_shop_info');
        $query = $this->mdl_shop_info->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_shop_info');
        $this->mdl_shop_info->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_shop_info');
        $this->mdl_shop_info->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_shop_info');
        $this->mdl_shop_info->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_shop_info');
        $count = $this->mdl_shop_info->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_shop_info');
        $max_id = $this->mdl_shop_info->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_shop_info');
        $query = $this->mdl_shop_info->_custom_query($mysql_query);
        return $query;
    }

}
