<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    function upload_img()
    {
        
         $data['view_file'] = 'upload_img'; //view file
        $data['module'] = 'test'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    
    function check_box()
    {
        $data['view_file'] = 'check_box'; //view file
        $data['module'] = 'test'; //module
        $this->load->module('template');
        $this->template->one_col($data);
        
    }
    function check_box_submit()
    {
        $color=  $this->input->post('color');
       // print_r($color);
        $mycolor=  implode(',', $color);
        echo $mycolor;
    }
    function check_user_bell($user_id)
    {
        // if return true fire update. Else fire insert.
        return $this->mdl_bell->check_user($user_id);
       // return TRUE;
    }
    function insert_bell($user_id=10)
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
    function reply()
    {
        
       $data['view_file']='reply';//view file
       $data['module']='test';//module
     
        echo Modules::run('template/one_col',$data);
    }


}
