<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reply extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function list_reply($comment_id)
    {
        $id=$comment_id;//change this ID
        $this->load->model('mdl_reply');
          if ($this->session->userdata('logged_in') == TRUE) {
          $user_id= $this->session->user_id;
          }else{
                $user_id='1';
         }
        $data['owner']=56;//admin
        $data['query1'] = $this->mdl_reply->reply_list_comment_join_user(10, 0,$id);
        $data['view_file']='list_rep';//view file
        $data['module']='reply';//module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
        
    }
    function my_reply()
    {
        echo Modules::run('site_security/make_sure_is_user');
        //pagination
        $this->load->model('mdl_reply');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'comment/list_comment/';
        $config['total_rows'] = $this->reuse_model_function->count_all('comment'); 
        $config['per_page'] = 20;
        $config['num_links'] = 4; 
        $config['uri_segment'] = 3;  // add this line to override the default
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //end pagination
        $data['query'] = $this->mdl_reply->get_comment_join_question_and_user($config['per_page'], $page);
        $data['current'] = $this->uri->segment(1);
        $data['title'] = 'List question';
        $data['view_file'] = 'list_comment'; //view file
        $data['module'] = 'comment'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    
    
    function edit(){
        echo Modules::run('site_security/make_sure_is_user');
        
        $id=  $this->uri->segment(3);
        $data['query']=  $this->get_where_custom('comment_id', $id)->row();
        
        $data['current'] = 1;
        $data['description'] = 'description';
        $data['keyword'] = 'Keywords';
        $data['title'] = 'Dashboard';
        $data['view_file'] = 'edit';//view file
        $data['module'] = 'comment';//module
        $this->load->module('template');
        $this->template->dashboard($data);
    }
      function edit_validation(){
         $this->load->library('form_validation');
        $this->form_validation->set_rules('comment_content', 'Comment', 'required|trim|min_length[10]|max_length[500]');
        $this->form_validation->set_rules('comment_for_id', 'ID', 'required');
        if ($this->form_validation->run($this) == TRUE) {
             $data['comment_content'] = $this->input->post('comment_content', TRUE);
             $data['comment_id'] = $this->input->post('comment_id', TRUE);
             if($this->_insert($data)){
             }
        } else {          
        }
    }
    function delete(){
        $id= $this->input->post('id');
        if($this->_delete($id)){
            echo 'true';
        }
        else {
          echo 'false';
        }
    }
    //convert database query result to array. with this format $question_array=array('63','50','47','25');
    // Then use query where_in('q_id',$question_array);
    function my_array_question_id($user_id=1){
      
        $query= $this->mdl_items->my_question($user_id);
        $arr = array();
        foreach($query as $row){
            array_push($arr, $row['id']);
        }
        return $arr;
    }


      function list_comment(){
          echo Modules::run('site_security/make_sure_is_admin');
           //pagination
        $this->load->model('mdl_reply');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'comment/list_comment/';
        $config['total_rows'] = $this->reuse_model_function->count_all('comment'); 
        $config['per_page'] = 20;
        $config['num_links'] = 4; 
        $config['uri_segment'] = 3;  // add this line to override the default
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //end pagination
        $data['query'] = $this->mdl_reply->get_comment_join_question_and_user($config['per_page'], $page);
        $data['current'] = $this->uri->segment(1);
        $data['title'] = 'List question';
        $data['view_file'] = 'list_comment'; //view file
        $data['module'] = 'comment'; //module
        $this->load->module('template');
        $this->template->admin($data);
        
    }  
    function loadmore(){
         
       $id=  $this->input->post('question_id');//change this ID
      $limit = 10;
      $offset = $this->input->post('offset');
      $total = $this->input->post('total');
      $this->load->model('mdl_reply');
     // $result  ='datadsf fds ';
    //  $result  = $this->mdl_reply->list_comment_join_user($limit, $offset,$id);
       $load_comment['load_comment'] = $this->mdl_reply->list_comment_join_user($limit, $offset,$id);
                // third argument means, return template as string instead of echo.
        $result = $this->load->view('comment/load_comment', $load_comment, TRUE);
      $data['view'] = $result;
      $data['offset'] =$offset +10;
      $data['total']=$total-10;  
      echo json_encode($data);
    }
    // dipslay comment in font end.
    function index($question_id){
        $id=$question_id;//change this ID
        $this->load->model('mdl_reply');
          if ($this->session->userdata('logged_in') == TRUE) {
          $user_id= $this->session->user_id;
          }else{
                $user_id='1';
         }
        $data['owner']=56;//admin
        $data['user_id']=$user_id;    
        $total=$this->mdl_reply->count_comment_where($id)-10;
        $data['total'] =$total;
        $data['query'] = $this->mdl_reply->list_comment_join_user(10, 0,$id);
        $data['view_file']='comment_form';//view file
        $data['module']='comment';//module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
    function insert_reply_bell($bell_user_id,$main_id){
        //bell user id= commenter
       if($bell_user_id==$this->session->user_id)
       {
           // replly his own comment. notification to admin.
              $this->load->module('bell');
               $this->bell->insert_bell(56);//admin got 1 bell.
                //insert notification.
               $this->load->module('notification');
               $this->notification->insert_notification(56,'new reply',$main_id,'1');//user id, title, main id, module| Admin got 1 notification.
           
       }else{
           //reply not comment. Mostly will be the admin. so we can just notification to user coment only. no need notification to admin.
           // but very small thing. the reply is not admin. Don't care about this for now.
              $this->load->module('bell');
               $this->bell->insert_bell($bell_user_id);//2 = notification id
                //insert notification.
               $this->load->module('notification');
               $this->notification->insert_notification($bell_user_id,'new reply',$main_id,'1');//user id, title, main id, module
       }
    }
     function get_data_from_post() {
        $data['reply'] = $this->input->post('reply', TRUE);
        $data['fk_comment_id'] = $this->input->post('fk_comment_id', TRUE);
        $data['user_reply_id'] = $this->session->user_id;
        $data['date'] =date('Y-m-d H:i:s');
        return $data;
    }
    function insert_validation(){
         $this->load->library('form_validation');
        $this->form_validation->set_rules('reply', 'Reply content', 'required|trim|min_length[3]|max_length[500]');
        $this->form_validation->set_rules('fk_comment_id', 'ID', 'required');
        
        if ($this->form_validation->run($this) == TRUE) {
              $data=  $this->get_data_from_post();
             if($this->_insert($data)){
                 
               //insert bell.
               $bell_user_id=$this->reuse_model_function->_detail('comment', 'comment_id',  $this->input->post('fk_comment_id') )->fk_user_id;//bell for user.
               $main_id=  $this->input->post('main_id');
               $this->insert_reply_bell($bell_user_id, $main_id);

               $user_id=$this->session->user_id;
                $new_rep['row'] = $this->mdl_reply->get_one_rep($user_id);
                // third argument means, return template as string instead of echo.
                $data1 = $this->load->view('reply/insert_reply', $new_rep, TRUE);

                $array = array();
                $array['success'] = TRUE;
                $array['data'] = $data1;
                  echo json_encode($array);
             }else{
                  $array = array();
                $array['success'] = false;
                $array['data'] = 'Database error';
            echo json_encode($array);
             }
        } else {
              $array = array();
                $array['success'] = false;
                $array['data'] = validation_errors();
            echo json_encode($array);
        }
    }
    //copy

    function get($order_by) {
        $this->load->model('mdl_reply');
        $query = $this->mdl_reply->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_reply');
        $query = $this->mdl_reply->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_reply');
        $query = $this->mdl_reply->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_reply');
        $query = $this->mdl_reply->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_reply');
       return $this->mdl_reply->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_reply');
        $this->mdl_reply->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_reply');
        return  $this->mdl_reply->_delete($id);
        
    }

    function count_where($column, $value) {
        $this->load->model('mdl_reply');
        $count = $this->mdl_reply->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_reply');
        $max_id = $this->mdl_reply->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_reply');
        $query = $this->mdl_reply->_custom_query($mysql_query);
        return $query;
    }

}
