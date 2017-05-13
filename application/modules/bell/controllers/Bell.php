<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bell extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
      function insert_bell($user_id)
    {
      
        if($this->mdl_bell->check_user($user_id)==TRUE)
        {
            //update
            $id=$this->reuse_model_function->_detail('bell','fk_user_id',$user_id)->id;
            $data['fk_user_id']=$user_id;
            $current_view= $this->reuse_model_function->_detail('bell','fk_user_id',$user_id)->view;
            $data['view']=$current_view+1;
            $this->mdl_bell->_update($id,$data);
        }else
        {
            //insert
            $data['fk_user_id']=$user_id;
            $data['view']=1;
            $this->mdl_bell->_insert($data);
        }
      
        
    }
    // Count bell for specific user.
    function count_bell()
    {
         $user_id=  $this->session->user_id;
          if($this->mdl_bell->check_user($user_id)==TRUE)
          {
                $count=$this->reuse_model_function->_detail('bell','fk_user_id',$user_id)->view;
                if($count==0)
                {
                    echo ' <span class="badge">'.$count.'</span>';
                }else{
                     echo ' <span class="badge badge-success">'.$count.'</span>';
                }
          }else
          {
                echo ' <span class="badge"> 0 </span>';
          }
    }
    // get bell list for specific user
    function list_bell()
    {
         $user_id=  $this->session->user_id;
        $this->load->model('mdl_bell');
        //update bell view to 1
        $this->update_bell_view($user_id);
        $query= $this->mdl_bell->list_bell($user_id);
        $data['query']=$query;
       $data['view_file'] = 'list_bell'; //view file
        $data['module'] = 'bell'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    //function update bell view
    function update_bell_view($user_id)
    {
         $this->load->model('mdl_bell');
         $this->mdl_bell->update_vew($user_id);  
    }
    
    //insert bell
    function insert($bell_user_id,$notification_id)
    {
        $this->load->model('mdl_bell');
        $this->mdl_bell->insert($bell_user_id,$notification_id);       
    }
    function get($order_by) {
        $this->load->model('mdl_bell');
        $query = $this->mdl_bell->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_bell');
        $query = $this->mdl_bell->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_bell');
        $query = $this->mdl_bell->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_bell');
        $query = $this->mdl_bell->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_bell');
        $this->mdl_bell->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_bell');
        $this->mdl_bell->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_bell');
        return  $this->mdl_bell->_delete($id);
        
    }

    function count_where($column, $value) {
        $this->load->model('mdl_bell');
        $count = $this->mdl_bell->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_bell');
        $max_id = $this->mdl_bell->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_bell');
        $query = $this->mdl_bell->_custom_query($mysql_query);
        return $query;
    }

}
