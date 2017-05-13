<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    function index(){
        echo 1;
    }
     function show_page()
    {
       $this->load->model('mdl_page');
       $data['records1'] = $this->get('id')->result();
       $data['view_file']='show_page';//view file
       $data['module']='page';//module
       $this->load->module('template');
       $this->template->no_header_no_footer($data);
    }
    function list_page() {
        echo Modules::run('site_security/make_sure_is_admin');
        $data['query'] = $this->get('id');
        $data['view_file'] = 'list_page'; //view file
        $data['module'] = 'page'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function insert(){
          echo Modules::run('site_security/make_sure_is_admin');
            $update_id = $this->uri->segment(3); //get the update id from the url
            $submit=  $this->input->post('submit',TRUE);
            if($submit=='submit'){//if submit get data from post
                  $data=  $this->get_data_from_post();
            }else{// Not submit yet. check update id
                if(is_numeric($update_id)){//if update id is real get date from db
                     $data = $this->get_data_from_db($update_id);
                }
                
            }
         if(!isset($data)){
             $data=  $this->get_data_from_post();
         }   
         $data['update_id']=$update_id;//use this for the hidden fifle
             //get the update id from the post
       
        $data['query'] = $this->get('id');
        $data['current2'] = $this->uri->segment(2);
        $data['description'] = 'description';
        $data['keyword'] = 'Keywords';
        $data['title'] = 'Control';
        $data['view_file'] = 'insert_form'; //view file
        $data['module'] = 'page'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    
    function get_data_from_post() {
        $data['page_headline'] = $this->input->post('headline', TRUE);
        $data['page_title'] = $this->input->post('title', TRUE);
        $data['page_keywords'] = $this->input->post('keywords', TRUE);
        $data['page_description'] = $this->input->post('description', TRUE);
        $data['page_content'] = $this->input->post('content', TRUE);
        return $data;
    }
    function get_data_from_db($update_id){
         $query = $this->get_where($update_id);
         $data['page_headline'] =$query->row()->page_headline;
        $data['page_title'] = $query->row()->page_title;
        $data['page_keywords'] = $query->row()->page_keywords;
        $data['page_description'] = $query->row()->page_description;
        $data['page_content'] = $query->row()->page_content;
        if(!isset($data)){
            $data='';
        }
        return $data;
    }
    function insert_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('headline', 'Headline', 'required');
        $update_id = $this->input->post('id', TRUE);
        if ($this->form_validation->run($this) == TRUE) {
            $data = $this->get_data_from_post();
            //figure out what the page_url should be
            $data['page_url']=  url_title($data['page_headline'],'-',TRUE);//third para for make everything in lowercase
        
               if (is_numeric($update_id)) {
                   if(($update_id === 1)||($update_id===2)){
                       unset($data['page_url']);///special page dont change url
                   }
               
                $this->_update($update_id, $data);
               
            } else {
              $this->_insert($data);
                
            }
          
            redirect('page/list_page');
        } else {
         
            echo validation_errors();
        }
    }
    function delete(){
          $id= $this->input->post('id');
        
        if($this->_delete($id)==TRUE)
        {
            echo 'true';
        }
        else 
        {
          echo 'false';
        }
    }
    function detail(){
        $page_url=  $this->uri->segment(3);
        //get all from page_url
        $data['query']=  $this->get_where_custom('page_url', $page_url)->row();
         $data['current']=  $this->uri->segment(2);
        $data['description']=$data['query']->page_description;
        $data['keyword']=$data['query']->page_keywords;
        $data['title']=$data['query']->page_headline;
       $data['view_file']='detail';//view file
       $data['module']='page';//module
        $this->load->module('template');
        $this->template->one_col($data);
    }


    //funcation copy

    function get($order_by) {
        $this->load->model('mdl_page');
        $query = $this->mdl_page->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_page');
        $query = $this->mdl_page->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_page');
        $query = $this->mdl_page->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_page');
        $query = $this->mdl_page->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_page');
        $this->mdl_page->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_page');
        $this->mdl_page->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_page');
       return $this->mdl_page->_delete($id);
    }

    function count_where($column, $value) {
        $this->load->model('mdl_page');
        $count = $this->mdl_page->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_page');
        $max_id = $this->mdl_page->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_page');
        $query = $this->mdl_page->_custom_query($mysql_query);
        return $query;
    }

}
