<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    function home()
    {
        $this->load->model('mdl_category');
         //$data['query']=$this->get('id')->result();
         $data['query']=$this->mdl_category->category_home('id')->result();
         $data['news_topic']=  $this->mdl_topic->news_topic(10);
        $data['current'] = 0;
        $data['view_file'] = 'home'; //view file
        $data['module'] = 'category'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function catelist()
    {
         $this->load->model('mdl_category');
         $data['query']=$this->get('id')->result();
         $data['news_topic']=  $this->mdl_topic->news_topic(10);
        $data['current'] = $this->uri->segment(1);
        $data['view_file'] = 'home'; //view file
        $data['module'] = 'category'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }


    function cate() {
         $cate_id = $this->uri->segment(3);
         $this->load->model('mdl_category');
           $this->load->helper('tags');
        //pagination config
         $this->load->library('pagination');
       $config['base_url']=base_url().'category/cate/'.$cate_id;
       $config['total_rows']=$this->mdl_category->get_num_rows();
        $page = ($this->uri->segment(4,0));
         $config["cur_page"] = $page;
       $config['per_page']=10;
       $config['num_links']=4;
     // $config['uri_segment'] = 4;      // add this line to override the default
        $this->pagination->initialize($config);
        $data['query']=  $this->mdl_category->get_join_topic($cate_id,$config['per_page'],$page);
       // print_r($data['query']);
        
         $data['current']= $cate_id;
         $data['cate_name']=  $this->reuse_model_function->_detail('category','id',$cate_id)->cat_name;
        $data['view_file'] = 'cate'; //view file
        $data['module'] = 'category'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function nav()
    {
        $this->load->library('Url_seo');
        $soft= 'id';
        $data['query1']=  $this->get($soft);
        $data['view_file'] = 'nav'; //view file
        $data['module'] = 'category'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
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
        $data['current'] = $this->uri->segment(1);
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
        $this->mdl_category->_delete($id);
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
