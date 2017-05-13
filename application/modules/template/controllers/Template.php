<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Template extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    function one_col($data){
       
       if(!isset($data['meta_img'])){
           $data['meta_img']=  base_url().'img/structure/slider2.jpg';//default meta img
       }
       if(!isset($data['link'])){
           $data['link']=  base_url();//default meta url
       }
       if(!isset($data['title'])){
           $data['title']='yibroke';//default title
       }
       if(!isset($data['keyword'])){
           $data['keyword']='yibroke';//default keyword
       }
       if(!isset($data['description'])){
           $data['description']='yibroke';//default description
       }
       if(!isset($data['current'])){
           $data['current']=100;//default current for active navigation
       }
        $this->load->view('one_col',$data);
    }
    function no_footer($data){
       
       if(!isset($data['meta_img'])){
           $data['meta_img']=  base_url().'img/structure/slider2.jpg';//default meta img
       }
       if(!isset($data['link'])){
           $data['link']=  base_url();//default meta url
       }
       if(!isset($data['title'])){
           $data['title']='yibroke';//default title
       }
       if(!isset($data['keyword'])){
           $data['keyword']='yibroke';//default keyword
       }
       if(!isset($data['description'])){
           $data['description']='yibroke';//default description
       }
       if(!isset($data['current'])){
           $data['current']=100;//default current for active navigation
       }
        $this->load->view('no_footer',$data);
    }
    function no_header_no_footer($data){
        $this->load->view('no_header_no_footer',$data);
    }
    function two_col($data){
        $this->load->view('two_col',$data);
    }
    function admin($data){
         if(!isset($data['title'])){
         $data['title']='';//default title
       }
       if(!isset($data['keyword'])){
           $data['keyword']='';//default keyword
       }
       if(!isset($data['description'])){
           $data['description']='';//default description
       }
       if(!isset($data['current'])){
           $data['current']=100;//default current for active navigation
       }
       if(!isset($data['current2'])){
           $data['current2']='index';//default current for active navigation
       }
        $this->load->view('admin',$data);
    }
    function dashboard($data){
         if(!isset($data['title'])){
           $data['title']='';//default title
       }
       if(!isset($data['keyword'])){
           $data['keyword']='';//default keyword
       }
       if(!isset($data['description'])){
           $data['description']='';//default description
       }
       if(!isset($data['current'])){
           $data['current']=100;//default current for active navigation
       }
       if(!isset($data['current2'])){
           $data['current2']='index';//default current for active navigation
       }
        $this->load->view('dashboard',$data);
    }
    function short_height($data){
         if(!isset($data['title'])){
           $data['title']='';//default title
       }
       if(!isset($data['keyword'])){
           $data['keyword']='';//default keyword
       }
       if(!isset($data['description'])){
           $data['description']='';//default description
       }
       if(!isset($data['current'])){
           $data['current']=100;//default current for active navigation
       }
       if(!isset($data['link'])){
           $data['link']=  base_url();//default current for active navigation
       }
       if(!isset($data['meta_img'])){
           $data['meta_img']=  base_url().'img/poll.png';//default current for active navigation
       }
        $this->load->view('short_height',$data);
    }
    function no_header($data)
    {
          if(!isset($data['title'])){
           $data['title']='';//default title
       }
       if(!isset($data['keyword'])){
           $data['keyword']='';//default keyword
       }
       if(!isset($data['description'])){
           $data['description']='';//default description
       }
       if(!isset($data['current'])){
           $data['current']=100;//default current for active navigation
       }
       if(!isset($data['link'])){
           $data['link']=  base_url();//default current for active navigation
       }
       if(!isset($data['meta_img'])){
           $data['meta_img']=  base_url().'img/poll.png';//default current for active navigation
       }
        $this->load->view('no_header',$data);
        
    }
}
