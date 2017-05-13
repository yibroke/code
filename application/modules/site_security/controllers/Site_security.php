<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Site_security extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    function make_sure_is_user()
    {
        $user_role=$this->session->userdata('user_role');
        if($user_role=='user' || $user_role=='admin')
        {
           echo '';
        }else{
             //redirect('site-security/not-allow');
        }
    }
    function make_sure_is_admin(){

       
         $user_role=$this->session->userdata('user_role');
        
        if($user_role!='admin')
        {
          redirect('site-security/not-allow');
        }
    }
     function not_allow(){
       
         $data['description']='Access Denied';
        $data['keyword']='Access Denied';
        $data['title']='Access Denied';
        $data['view_file']='not_allow';//view file
        $data['module']='site_security';//module
        $this->load->module('template');
        $this->template->one_col($data);
    }

}
