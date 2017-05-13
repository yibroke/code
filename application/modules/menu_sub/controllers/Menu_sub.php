<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_sub extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    function get_sub($id)
    {
      
        $data['querysub']=  $this->get_where_custom('fk_menu', $id)->result();
        $data['view_file'] = 'get_sub'; //view file
        $data['module'] = 'menu_sub'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
     function do_sort()
    {
       // $data='item[]=1&item[]=3&item[]=2';//  $this->input->post('data');//get data from .post function
        $data=  $this->input->post('data');//get data from .post function
         echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_menu_sub');
         $max_order=$this->mdl_menu_sub->get_max_order();//get max a_order coz we make the first first in the loop is the firt display mean the soft biggest.
         //data look like this: item[]=34&item[]=12&item[]=54 format we have to convert it into array using parse_str
       parse_str($data,$str);
     //  print_r($str); 
       //will print array [0]=> 34, [1]=>12,[2]=>54
      $order=$str['item'];//get item value from array.
      foreach ($order as $value) {
         $this->mdl_menu_sub->update_order($value,$max_order);//first item will get biggset soft coz order_by desc
           $max_order--;
      }
       echo 'Success';
    }
     function sort()
    {
         echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_menu_sub');
       $data['query'] = $this->get('iorder')->result();
       $data['view_file']='sort';//view file
       $data['module']='menu_sub';//module
       $this->load->module('template');
       $this->template->admin($data);
        
    }
    function get_data_from_post() {
        $data['name'] = $this->input->post('name');
        $data['link'] = $this->input->post('link');
        $data['fk_menu'] = $this->input->post('fk_menu');
         $data['public'] = $this->input->post('public',TRUE, "y");
        return $data;
    }
    function get_data_from_db($update_id) {
        $query = $this->get_where($update_id);
        $data['name'] = $query->row()->name;
        $data['link'] = $query->row()->link;
         $data['public'] =  $query->row()->public;
         $data['fk_menu'] =  $query->row()->fk_menu;
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
          $data['menus'] = $this->reuse_model_function->_list('menu');//put this line on top of function will not work. dont know why.
      //  print_r($data['menus']);
        $data['current'] = $this->uri->segment(1);
        $data['update_id'] = $update_id; //use this for the hidden fifle
        $data['view_file'] = 'insert'; //view file
        $data['module'] = 'menu_sub'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function menu_sub_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Category Name', 'required');
        $update_id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == TRUE) {
            //after everything ok insert new topic to database
            $data = $this->get_data_from_post();
            if (is_numeric($update_id)) {// IF EXIST UPDATE ID UPDATE
                $this->_update($update_id, $data);
                $data = 'menu_sub/';
                redirect($data, 'refresh');
            } else {// UPDATE
                $this->_insert($data);
                $data = 'menu_sub/';
                redirect($data, 'refresh');
            }
        } else {
            echo validation_errors();
        }
    }
    function index() {
        echo Modules::run('site_security/make_sure_is_admin');
        $data['query'] = $this->get('id')->result();
       // print_r($data['query']);
        $data['current'] = 'menu_sub';
        $data['view_file'] = 'index'; //view file
        $data['module'] = 'menu_sub'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function delete() {
        $id = $this->input->post('id');
        echo $this->reuse_model_function->_delete('menu_sub', 'id', $id);
    }
    function get($order_by) {
        $this->load->model('mdl_menu_sub');
        $query = $this->mdl_menu_sub->get($order_by);
        return $query;
    }
    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu_sub');
        $query = $this->mdl_menu_sub->get_with_limit($limit, $offset, $order_by);
        return $query;
    }
    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu_sub');
        $query = $this->mdl_menu_sub->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_menu_sub');
        $query = $this->mdl_menu_sub->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_menu_sub');
        $this->mdl_menu_sub->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu_sub');
        $this->mdl_menu_sub->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu_sub');
        $this->mdl_menu_sub->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_menu_sub');
        $count = $this->mdl_menu_sub->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_menu_sub');
        $max_id = $this->mdl_menu_sub->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_menu_sub');
        $query = $this->mdl_menu_sub->_custom_query($mysql_query);
        return $query;
    }

}
