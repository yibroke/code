<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quick_search extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    function test()
    {
         $update_id = $this->uri->segment(3,''); //get the update id from the url
         
         //get the update id from the post
        if (!isset($update_id)) {
            $update_id = $this->input->post('id', TRUE);
        }
        if (is_numeric($update_id)) {
            $data = $this->get_db($update_id);
            $data['update_id'] = $update_id;
        } else {
            $data = $this->get_post();
        }
         if(!isset($data)){
             $data=$this->get_post();
         }   
         $data['update_id']=$update_id;//use this for the hidden fifle
       $data['view_file']='test';//view file
       $data['module']='quick_search';//module
       $this->load->module('template');
       $this->template->admin($data);
    }
    function get_post()//insert default value
    {
            $data['firstname'] ='';
            $data['lastname'] = '';
            return $data;
    }
        function get_db($update_id){
        
         $data['update_id'] =$update_id;
         $data['firstname'] ='Vuong';
         $data['lastname'] ='Tran';
        if(!isset($data)){
            $data='';
        }
        return $data;
    }
    function get1($do,$f,$l)
    {
        return $do.' '.$f.' - '.$l;
    }
    function message()
    {
        
       // var_dump($_POST);
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $f = $request->firstname;
        $l = $request->lastname;
        $update_id =  $request->id;
        
         $_POST = json_decode(file_get_contents("php://input"), true);
         $this->load->library('form_validation');
         $this->form_validation->set_rules('firstname', 'firstname', 'required|min_length[5]');
         $this->form_validation->set_rules('lastname', 'lastname', 'required|min_length[10]');
       
        if ($this->form_validation->run() == TRUE) {
            
          $data['firstname']=$f;
          $data['lastname']=$l;
         
           if (is_numeric($update_id)) {
                    $value= $this->get1('update:',$f,$l);
            } else {
               $value= $this->get1('Insert:',$f,$l);
            }

            $array = array();
            $array['success'] = TRUE;
            
            $array['data'] = '<div class="alert alert-success">Successful: '.$value.'</div>';
           
        } else {
            $array = array();
            $array['success'] = false;
            $array['data'] = '<div class="alert alert-danger">'.validation_errors().'</div>';
        }
          echo json_encode($array);
    }
    function show_quick_search()
    {
        $this->load->model('mdl_quick_search');
        $data['records'] = $this->mdl_quick_search->girls();
       
       $data['view_file']='show_quick_search';//view file
       $data['module']='quick_search';//module
       $this->load->module('template');
       $this->template->no_header_no_footer($data);
    }
    function do_change_order()
    {
        $data=  $this->input->post('data');//get data from .post function
         echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_quick_search');
         $max_order=  $this->mdl_quick_search->get_max_order();//get max a_order coz we make the first first in the loop is the firt display mean the soft biggest.
         //data look like this: item[]=34&item[]=12&item[]=54 format we have to convert it into array using parse_str
       parse_str($data,$str);
     //  print_r($str); 
       //will print array [0]=> 34, [1]=>12,[2]=>54
      $order=$str['item'];//get item value from array.
      foreach ($order as $value) {
         $this->mdl_quick_search->update_order($value,$max_order);//first item will get biggset soft coz order_by desc
           $max_order--;
      }
       echo 'Success';
    }
    function change_order()
    {
        echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_quick_search');
       $data['query'] = $this->mdl_quick_search->girls();
       $data['current']=  $this->uri->segment(1);
        // $this->load->model('mdl_user');
       $data['description']='korean quick_search in sydney';
       $data['keyword']='korean quick_search';
       $data['title']='All quick_search';
       $data['view_file']='change_order';//view file
       $data['module']='quick_search';//module
       $this->load->module('template');
       $this->template->admin($data);
    }
   function get_data_from_post() {
          //get biggist order number  and +1 for it.
        $this->load->model('mdl_quick_search');
        $max_order=  $this->mdl_quick_search->get_max_order();
        $data['name'] = $this->input->post('name', TRUE);
        $data['a_order'] = $max_order+1;
        return $data;
    }
    function get_data_from_db($update_id){
         $query = $this->get_where($update_id);
         $data['name'] =$query->row()->name;
        if(!isset($data)){
            $data='';
        }
        return $data;
    }
    function feach()
    {
         $this->load->model('mdl_quick_search');
        $data['records'] = $this->mdl_quick_search->girls();
        
        
         $arr_data=array();
     $i=0;
     foreach($data['records'] as $row)
     {
         $arr_data[$i]['id']=$row->id;
         $arr_data[$i]['name']=$row->name;
       
       $i++;  
     }
   
     echo json_encode($arr_data);
    }
    function list_quick_search()
    {
        echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_quick_search');
        $data['records'] = $this->mdl_quick_search->girls();
        
        
         $arr_data=array();
     $i=0;
     foreach($data['records'] as $row)
     {
         $arr_data[$i]['id']=$row->id;
         $arr_data[$i]['name']=$row->name;
       
       $i++;  
     }
   
     $data['json']= json_encode($arr_data);
        
        
        
        $data['current']=  $this->uri->segment(1);
        // $this->load->model('mdl_user');
       $data['description']='korean quick_search in sydney';
       $data['keyword']='korean quick_search';
       $data['title']='All quick_search';
       $data['view_file']='control_quick_search';//view file
       $data['module']='quick_search';//module
       $this->load->module('template');
       $this->template->admin($data);
    }
    function insert_quick_search()
    {
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
        // $this->load->model('mdl_user');
     
       $data['view_file']='insert';//view file
       $data['module']='quick_search';//module
       $this->load->module('template');
       $this->template->admin($data);
    }
    function insert_validation()
    {
         echo Modules::run('site_security/make_sure_is_admin');
         $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
         $update_id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == TRUE) {
             $data = $this->get_data_from_post();
               if (is_numeric($update_id)) {
                     unset($data['a_order']);///special page dont change ur
                     unset($data['date']);///special page dont change ur
                     unset($data['thumb']);///special page dont change ur
                $this->_update($update_id, $data);
            } else {
                
             for($i=0;$i<100;$i++)
                {
                   $this->_insert($data);
                }
            }
            redirect('quick_search/list-quick_search');
        } else {
            echo validation_errors();
        }
    }
    function delete_search()
    {
         echo Modules::run('site_security/make_sure_is_admin');
          $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id;
        echo $this->reuse_model_function->_delete('quick_search','id',$id);
    }
    function get($order_by) {
        $this->load->model('mdl_quick_search');
        $query = $this->mdl_quick_search->get($order_by);
        return $query;
    }
    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_quick_search');
        $query = $this->mdl_quick_search->get_with_limit($limit, $offset, $order_by);
        return $query;
    }
    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_quick_search');
        $query = $this->mdl_quick_search->get_where($id);
        return $query;
    }
    function get_where_custom($col, $value) {
        $this->load->model('mdl_quick_search');
        $query = $this->mdl_quick_search->get_where_custom($col, $value);
        return $query;
    }
    function _insert($data) {
        $this->load->model('mdl_quick_search');
        $this->mdl_quick_search->_insert($data);
    }
    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_quick_search');
        $this->mdl_quick_search->_update($id, $data);
    }
    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_quick_search');
        return  $this->mdl_quick_search->_delete($id);
    }
    function count_where($column, $value) {
        $this->load->model('mdl_quick_search');
        $count = $this->mdl_quick_search->count_where($column, $value);
        return $count;
    }
    function get_max() {
        $this->load->model('mdl_quick_search');
        $max_id = $this->mdl_quick_search->get_max();
        return $max_id;
    }
    function _custom_query($mysql_query) {
        $this->load->model('mdl_quick_search');
        $query = $this->mdl_quick_search->_custom_query($mysql_query);
        return $query;
    }
}
