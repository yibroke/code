<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MX_Controller {

    function __construct() {
        parent::__construct();
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
    function my_comment(){//select all comment from this user.
         echo Modules::run('site_security/make_sure_is_user');
        $user_id=  $this->session->userdata('user_id'); 
      
           //pagination
        $this->load->model('mdl_comment');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'comment/my_poll_comment/';
        $config['total_rows'] = $this->count_where('fk_user_id', $user_id);
        $config['per_page'] = 20;
        $config['num_links'] = 4; 
        $config['uri_segment'] = 3;  // add this line to override the default
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //end pagination
        $data['query'] = $this->mdl_comment->my_comment_join_question_and_user($user_id,$config['per_page'], $page);
        $data['current'] = $this->uri->segment(2);
        $data['title'] = 'List question';
        $data['view_file'] = 'list_comment'; //view file
        $data['module'] = 'comment'; //module
        $this->load->module('template');
        $this->template->dashboard($data);
    }
    function my_items_comment(){
        echo Modules::run('site_security/make_sure_is_user');
        $user_id=  $this->session->userdata('user_id'); 
        $question_id=  $this->my_array_question_id($user_id) ? $this->my_array_question_id($user_id) : 0;
        //pagination
        $this->load->model('mdl_comment');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'comment/my_poll_comment/';
        $config['total_rows'] = $this->mdl_comment->count_my_poll_comment($question_id);
        $config['per_page'] = 20;
        $config['num_links'] = 4; 
        $config['uri_segment'] = 3;  // add this line to override the default
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //end pagination
        $data['query'] = $this->mdl_comment->my_poll_comment_join_question_and_user($question_id,$config['per_page'], $page);
        $data['current'] = $this->uri->segment(1);
        $data['title'] = 'List question';
        $data['view_file'] = 'list_comment'; //view file
        $data['module'] = 'comment'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
      function list_comment(){
          echo Modules::run('site_security/make_sure_is_admin');
           //pagination
        $this->load->model('mdl_comment');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'comment/list_comment/';
        $config['total_rows'] = $this->reuse_model_function->count_all('comment'); 
        $config['per_page'] = 20;
        $config['num_links'] = 4; 
        $config['uri_segment'] = 3;  // add this line to override the default
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //end pagination
        $data['query'] = $this->mdl_comment->get_comment_join_question_and_user($config['per_page'], $page);
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
      $this->load->model('mdl_comment');
       if ($this->session->userdata('logged_in') == TRUE) {
          $user_id= $this->session->user_id;
          }else{
                $user_id='1';
         }
        $data['owner']=56;//admin
        $data['user_id']=$user_id;    
     // $result  ='datadsf fds ';
    //  $result  = $this->mdl_comment->list_comment_join_user($limit, $offset,$id);
      $data['query'] = $this->mdl_comment->list_comment_join_user($limit, $offset,$id);
                // third argument means, return template as string instead of echo.
      $result = $this->load->view('comment/load_comment', $data, TRUE);
      $data['view'] = $result;
      $data['offset'] =$offset +10;
      $data['total']=$total-10;  
      echo json_encode($data);
    }
    // dipslay comment in font end.
    function index($question_id){
        $id=$question_id;//change this ID
        $this->load->model('mdl_comment');
          if ($this->session->userdata('logged_in') == TRUE) {
          $user_id= $this->session->user_id;
          }else{
                $user_id='1';
         }
        $data['owner']=56;//admin
        $data['user_id']=$user_id;    
        $total=$this->mdl_comment->count_comment_where($id)-10;
        $data['total'] =$total;
        
        $data['query'] = $this->mdl_comment->list_comment_join_user(10, 0,$id);
        $data['view_file']='comment_form';//view file
        $data['module']='comment';//module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
      function get_data_from_post() {
        $data['comment_content'] = $this->input->post('comment_content', TRUE);
        $data['fk_question_id'] = $this->input->post('comment_for_id', TRUE);
        $data['fk_user_id'] = $this->input->post('comment_user_id', TRUE);
        $data['comment_date'] =  $date=date('Y-m-d H:i:s');
        return $data;
    }
    function comment_validation() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('content', 'Topic Content', 'required');
        $this->form_validation->set_rules('topic_id', 'Topic id', 'required');

        if ($this->form_validation->run() == TRUE) {
            //after everything ok insert new topic to database
            $this->load->model('mdl_comment');
            $this->load->model('user/mdl_user');
            if ($this->mdl_comment->insert_comment()) {
                $data['user_comment'] = $this->mdl_user->get_user_session($this->session->userdata('user_id'));
                $data['new_comment'] = $this->mdl_comment->get_one_comment();
                // third argument means, return template as string instead of echo.
                $data = $this->load->view('insert_comment', $data, TRUE);
                $array = array();
                $array['success'] = true;
                $array['data'] = $data;
            } else {
                $array = array();
                $array['success'] = false;
                $array['data'] = validation_errors();
            }
            echo json_encode($array);
        }
    }
    function insert_validation(){
         $this->load->library('form_validation');
        $this->form_validation->set_rules('comment_content', 'Comment', 'required|trim|min_length[3]|max_length[500]');
        $this->form_validation->set_rules('comment_for_id', 'ID', 'required');
       
        if ($this->form_validation->run($this) == TRUE) {
              $data=  $this->get_data_from_post();
             if($this->_insert($data)){
                  //insert bell.
                $bell_user_id=56;//admin id
                $this->load->module('bell');
               $this->bell->insert_bell($bell_user_id);//2 = notification id
               //insert notification.
               $this->load->module('notification');
               $this->notification->insert_notification(56,'new comment',$data['fk_question_id'],'1');//user id, title, main id, module
               
                $user_id=$this->input->post('comment_user_id');
                $new_comment['row'] = $this->mdl_comment->get_one_comment($user_id);
                // third argument means, return template as string instead of echo.
                $data1 = $this->load->view('comment/insert_comment', $new_comment, TRUE);

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
        $this->load->model('mdl_comment');
        $query = $this->mdl_comment->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_comment');
        $query = $this->mdl_comment->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_comment');
        $query = $this->mdl_comment->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        $this->load->model('mdl_comment');
        $query = $this->mdl_comment->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_comment');
       return $this->mdl_comment->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_comment');
        $this->mdl_comment->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_comment');
        return  $this->mdl_comment->_delete($id);
        
    }

    function count_where($column, $value) {
        $this->load->model('mdl_comment');
        $count = $this->mdl_comment->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_comment');
        $max_id = $this->mdl_comment->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_comment');
        $query = $this->mdl_comment->_custom_query($mysql_query);
        return $query;
    }

}
