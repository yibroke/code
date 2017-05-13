<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Time_type extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    function get_data_from_post() {
        $data['cat_name'] = $this->input->post('cat_name');
        return $data;
    }

    function get_data_from_db($update_id) {
        $query = $this->get_where_custom('id', $update_id);
        $data['cat_name'] = $query->row()->cat_name;
        if (!isset($data)) {
            $data = '';
        }
        return $data;
    }

    function insert() {

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
        $data['view_file'] = 'insert'; //view file
        $data['module'] = 'category'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }

    function category_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
        $update_id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == TRUE) {
            //after everything ok insert new topic to database
            $data = $this->get_data_from_post();
            if (is_numeric($update_id)) {// IF EXIST UPDATE ID UPDATE
                $this->_update($update_id, $data);
                $data = 'category/';
                redirect($data, 'refresh');
            } else {// UPDATE
                $this->_insert($data);
                $data = 'category/';
                redirect($data, 'refresh');
            }
        } else {
            echo validation_errors();
        }
    }

    function index() {
        echo Modules::run('site_security/make_sure_is_admin');
        $data['query'] = $this->get('id')->result();
        $data['current'] = 'category';
        $data['view_file'] = 'index'; //view file
        $data['module'] = 'category'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }

    function delete() {
        $id = $this->input->post('id');
        echo $this->reuse_model_function->_delete('category', 'id', $id);
    }

    function get($order_by) {
        $this->load->model('mdl_category');
        $query = $this->mdl_category->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_category');
        $query = $this->mdl_category->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_category');
        $query = $this->mdl_category->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_category');
        $query = $this->mdl_category->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_category');
        $this->mdl_category->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_category');
        $this->mdl_category->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_category');
        return $this->mdl_category->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_category');
        $count = $this->mdl_category->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_category');
        $max_id = $this->mdl_category->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_category');
        $query = $this->mdl_category->_custom_query($mysql_query);
        return $query;
    }

}
