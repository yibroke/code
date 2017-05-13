<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
      function changethumb()
    {
          echo Modules::run('site_security/make_sure_is_admin');
        $id = $this->input->post('id');
        $data['img'] = $this->input->post('thumb_src');
        // echo $id.'==='.  $this->input->post('thumb_src');
        $this->_update($id, $data);
        echo 'true';
    }
    function show_slider()
    {
          $soft= 'id';
          $this->load->model('mdl_banner');
        $data['query']=  $this->mdl_banner->get_slider($soft);
        $data['view_file'] = 'show_slider'; //view file
        $data['module'] = 'banner'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
    function show_right_slider()
    {
          $soft= 'id';
          $this->load->model('mdl_banner');
        $data['query']=  $this->mdl_banner->get_right_slider($soft);
        $data['view_file'] = 'show_right_slider'; //view file
        $data['module'] = 'banner'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
    function show_ship()
    {
          $soft= 'id';
          $this->load->model('mdl_banner');
        $data['query']=  $this->mdl_banner->get_ship($soft);
        $data['view_file'] = 'show_ship'; //view file
        $data['module'] = 'banner'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
    function list_banner()
    {
         $soft= 'id';
       $data['current']=  $this->uri->segment(1);
        $data['query']=  $this->get($soft);
        $data['view_file'] = 'list_banner'; //view file
        $data['module'] = 'banner'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
     function get_data_from_post() {
        $data['link']=$this->input->post('link', TRUE);// category
        $data['name']=$this->input->post('name', TRUE);// category
        $data['img']=$this->input->post('img', TRUE);// category
        $data['type_id']=$this->input->post('type_id', TRUE);// category
        return $data;
    }
    function get_data_from_db($update_id){
         $query = $this->get_where($update_id);
         $data['link'] =$query->row()->link;
         $data['name'] =$query->row()->name;
         $data['img'] =$query->row()->img;
        $data['type_id'] = $query->row()->type_id;
       
        if(!isset($data)){
            $data='';
        }
        return $data;
    }
    function insert_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('img', 'Image', 'required');
        $this->form_validation->set_rules('type_id', 'Type', 'required');
        $update_id = $this->input->post('id', TRUE);
        if ($this->form_validation->run($this) == TRUE) {
            $data = $this->get_data_from_post();
               if (is_numeric($update_id)) {
                $this->_update($update_id, $data);
            } else {
              $this->_insert($data);
            }
            redirect('banner/list_banner');
        } else {
            echo validation_errors();
        }
    }
    function add_banner()
    {
         $update_id = $this->uri->segment(3); //get the update id from the url
          //get the update id from the post
        if (!isset($update_id)) {
            $update_id = $this->input->post('id', TRUE);
        }
        if (is_numeric($update_id)) {
            $data = $this->get_data_from_db($update_id);
            $data['update_id'] = $update_id;
        } else {
            $data = $this->get_data_from_post();
        }
         $this->load->model('banner_type/mdl_banner_type');
         $data['types'] = $this->mdl_banner_type->get('id')->result();
       
         $data['update_id']=$update_id;//use this for the hidden fifle
             //get the update id from the post
        $data['view_file'] = 'add_banner'; //view file
        $data['module'] = 'banner'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }

    function get($order_by) {
        $this->load->model('mdl_banner');
        $query = $this->mdl_banner->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_banner');
        $query = $this->mdl_banner->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_banner');
        $query = $this->mdl_banner->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_banner');
        $query = $this->mdl_banner->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_banner');
        $this->mdl_banner->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_banner');
        $this->mdl_banner->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_banner');
        return  $this->mdl_banner->_delete($id);
        
    }

    function count_where($column, $value) {
        $this->load->model('mdl_banner');
        $count = $this->mdl_banner->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_banner');
        $max_id = $this->mdl_banner->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_banner');
        $query = $this->mdl_banner->_custom_query($mysql_query);
        return $query;
    }

}
