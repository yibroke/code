<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    function do_sort()
    {
        $data=  $this->input->post('data');//get data from .post function
         echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_menu');
         $max_order=  $this->mdl_menu->get_max_order();//get max a_order coz we make the first first in the loop is the firt display mean the soft biggest.
         //data look like this: item[]=34&item[]=12&item[]=54 format we have to convert it into array using parse_str
       parse_str($data,$str);
     //  print_r($str); 
       //will print array [0]=> 34, [1]=>12,[2]=>54
      $order=$str['item'];//get item value from array.
      foreach ($order as $value) {
         $this->mdl_menu->update_order($value,$max_order);//first item will get biggset soft coz order_by desc
           $max_order--;
      }
       echo 'Success';
    }
    function sort()
    {
         echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_menu');
       $data['query'] = $this->get('iorder')->result();
       $data['view_file']='sort';//view file
       $data['module']='menu';//module
       $this->load->module('template');
       $this->template->admin($data);
        
    }
    function nav()
    {
        $data['navs'] = $this->get('iorder')->result();
        $data['view_file'] = 'nav'; //view file
        $data['module'] = 'menu'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
        //$this->template->one_col($data);
    }

    function get_data_from_post() {
        $this->load->model('mdl_menu');
        $data['name'] = $this->input->post('name');
        $data['link'] = $this->input->post('link');
        $data['public'] = $this->input->post('public',TRUE, "y");
        $max_order=  $this->mdl_menu->get_max_order();
        $data['iorder'] = $max_order+1;
        return $data;
    }
    function get_data_from_db($update_id) {
        $query = $this->get_where_custom('id', $update_id);
        $data['name'] = $query->row()->name;
        $data['link'] = $query->row()->link;
        $data['public'] = $query->row()->public;
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
        $data['module'] = 'menu'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function menu_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Category Name', 'required');
        $update_id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == TRUE) {
            //after everything ok insert new topic to database
            $data = $this->get_data_from_post();
            if (is_numeric($update_id)) {// IF EXIST UPDATE ID UPDATE
                unset($data['iorder']);///special page dont change ur
                $this->_update($update_id, $data);
                $data = 'menu/';
                redirect($data, 'refresh');
            } else {// UPDATE
                $this->_insert($data);
                $data = 'menu/';
                redirect($data, 'refresh');
            }
        } else {
            echo validation_errors();
        }
    }
    function index() {
        echo Modules::run('site_security/make_sure_is_admin');
       $data['query'] = $this->get('id')->result();
     //   echo '<pre>';
    //    print_r($data['query']);
    //    echo '</pre>';
        $data['current'] = 'menu';
        $data['view_file'] = 'index'; //view file
        $data['module'] = 'menu'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function delete() {
        $id = $this->input->post('id');
        echo $this->reuse_model_function->_delete('menu', 'id', $id);
    }
    function get($order_by) {
        $this->load->model('mdl_menu');
        $query = $this->mdl_menu->get($order_by);
        return $query;
    }
    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu');
        $query = $this->mdl_menu->get_with_limit($limit, $offset, $order_by);
        return $query;
    }
    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu');
        $query = $this->mdl_menu->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_menu');
        $query = $this->mdl_menu->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_menu');
        $this->mdl_menu->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu');
        $this->mdl_menu->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_menu');
        $this->mdl_menu->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_menu');
        $count = $this->mdl_menu->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_menu');
        $max_id = $this->mdl_menu->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_menu');
        $query = $this->mdl_menu->_custom_query($mysql_query);
        return $query;
    }

}
