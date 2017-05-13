<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Topic extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    function sort()
    {
        $id= $this->input->post('cate_id');// category
        $name= $this->input->post('cate_name');// category
        $sort= $this->input->post('sort_by');
        redirect('items/cate/'.$name.'/'.$id.'/'.$sort, 'refresh');
    }
    // edit multiple items.(all)
    function edit()
    {
        $this->mdl_topic->update_all();
    }
    //HOME PAGE  before not in use for now.
    function index() {
        $order_by=  ($this->uri->segment(3) ? $this->uri->segment(3) : 'id');
        $limit = 36;
        $offset =($this->input->post('offset')) ? $this->input->post('offset') : 0;
        $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $total = $this->reuse_model_function->count_all_where('items','public','1')-36;
        $data['query'] = $this->get_with_limit($limit, $offset, $order_by)->result(); 
        $data['current'] = 'index';
        $data['total'] = $total; //put total to data array
        $data['view_file'] = 'items_index'; //view file
        $data['module'] = 'items'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function keyup()
    {
        $this->load->model('mdl_topic');
        $keyword=  $this->input->get('k');
        //$keyword=  $this->uri->segment(3);
        echo $keyword.' <br>';
        $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $total =$this->mdl_topic->get_search_num_rows($keyword);
        $data['total'] = $total; //put total to data array
        $data['query12'] = $this->mdl_topic->get_where_custom_search('topic_tag', $keyword,40, 0, 'id')->result();
      // echo $total;
       //print_r($data['query12']);
      foreach ($data['query12'] as $row) {
             $title=$this->url_seo->khong_dau($row->topic_name);
          // echo $title;
           $detail=  base_url().'read/'.url_title($title).'/'.$row->id;
           echo '<a href="'.$detail.'">'.$row->topic_name.'</a><br>';
       }
      
    }
    //related item in detail page =>use category id
    function related($id)
    {
       $item_id= $this->uri->segment(4);
        $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $this->load->model('mdl_topic');
        $query=  $this->mdl_topic->get_related($id,$item_id);
        $data['query']=$query;
        $data['view_file'] = 'include_item_list_reuse';//view file
        $data['module'] = 'items'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
    //ITEM DETAIL
    function detail()
    {
       
        $id=$this->uri->segment(3);
        $this->load->model('user/mdl_user');
        $this->load->model('comment/mdl_comment');
        //get the current view count
        $current_view=  $this->mdl_topic->read_topic($id)->topic_view;
        $this->mdl_topic->update_view($current_view);
        $data['read_topic']=  $this->mdl_topic->read_topic($id);
       $data['topic_comments']=  $this->mdl_comment->get_all_comment();// print all comment
        $data['current']=$this->mdl_topic->read_topic($id)->topic_cat;
        $data['view_file'] = 'detail';//view file
        $data['module'] = 'topic'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    //LOAD MORE CATEGORY
    function more() {
        $order_by = $this->input->post('order_by');
        $limit = 36;
        $offset = $this->input->post('offset');
        $total = $this->input->post('total');
        $cate_id = $this->input->post('cat_id');
        $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $data['query'] = $this->get_where_custom('fk_category_id', $cate_id, $limit, $offset, $order_by)->result();
        $result = $this->load->view('items/include_item_list_reuse', $data, TRUE);
        $data['view'] = $result;
        $data['offset'] = $offset + $limit;
        $data['total'] = $total - $limit;
        echo json_encode($data);
    }
    function cate() {
        $order_by =  ($this->uri->segment(5) ? $this->uri->segment(5) : 'id');
        $limit = 36;
        $offset =($this->input->post('offset')) ? $this->input->post('offset') : 0;
       // $cate_id = 1;
        $cate_id = $this->uri->segment(4);
         $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $data['cate_name']=  $this->reuse_model_function->_detail('category','id',$cate_id)->cat_name;
        $data['sort']= $order_by;
        $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $total = $this->count_where('fk_category_id', $cate_id)-$limit; //count all question where public(f7)=0 mena public.
        $data['total'] = $total; //put total to data array
        $data['query'] = $this->mdl_topic->get_where_cate($cate_id, $limit, $offset, $order_by)->result();
       // $data['query'] = $this->get_with_limit($limit, $offset, $order_by)->result();
        $data['current'] = $this->uri->segment(4);
        $data['view_file'] = 'cate'; //view file
        $data['module'] = 'items'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function delete() {
        $id = $this->input->post('id');
        echo $this->reuse_model_function->_delete('items', 'id', $id);
    }
    function changethumb() {
        echo Modules::run('site_security/make_sure_is_admin');
        $id = $this->input->post('id');
        $data['thumb'] = $this->input->post('thumb_src');
        // echo $id.'==='.  $this->input->post('thumb_src');
        $this->_update($id, $data);
        echo 'true';
    }
    function get_data_from_post() {
         $date = date('Y-m-d H:i:s');

        $data = array(
            'topic_name' => $this->input->post('name'),
            'topic_content' => $this->input->post('content'),
            'topic_tag' => $this->input->post('tags'),
            'topic_date' => $date,
            'topic_cat' => $this->input->post('category'),
            'topic_by' => $this->session->userdata('user_id'),
            'topic_view' => 0
        );
       
        return $data;
    }
    function get_data_from_db($update_id) {
        $query = $this->get_where_custom('id', $update_id);
        // Convert datepicker time to mysql datetime format in PHP
        $data['topic_name'] = $query->row()->topic_name;
        $data['topic_content'] = $query->row()->topic_content;
        $data['topic_tag'] = $query->row()->topic_tag;
        $data['topic_cat'] = $query->row()->topic_cat;
        if (!isset($data)) {
            $data = '';
        }
        return $data;
    }
    function insert() {

        echo Modules::run('site_security/make_sure_is_user');
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
        $data['update_id'] = $update_id; //use this for the hidden fifle
        $data['categories'] = $this->reuse_model_function->_list('category');
        
        $data['current'] = $this->uri->segment(1);
        $data['view_file'] = 'insert'; //view file
        $data['module'] = 'topic'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function my_new_post()
    {
         //get the newst post from this user. redirect the function read the post 
        // 1. Get newset id and name
        $this->mdl_topic->get_new_post();
        $topic_name = $this->mdl_topic->get_new_post()->topic_name;
        $topic_id = $this->mdl_topic->get_new_post()->id;
        $data = base_url() . 'read/' . url_title($topic_name, '-', TRUE) . '/' . $topic_id;
         redirect($data, 'refresh');
    }
    function my_edit_post()
    {
        //get redirect user to read the post just update
        //we need topic id and topic name
         $topic_id = $this->input->post('id');
        $topic_name=$this->mdl_topic->get_one_element($topic_id,'topic_name')->topic_name;
        $data = base_url() . 'read/' . url_title($topic_name, '-', TRUE) . '/' . $topic_id;
         redirect($data, 'refresh');
    }
    function validation() {
         $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Topic Name', 'required');
        $this->form_validation->set_rules('category', 'Topic Category', 'required');
        $this->form_validation->set_rules('content', 'Topic Content', 'required');
        $this->form_validation->set_rules('tags', 'Topic Tags', 'required');
        $update_id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == TRUE) {
            //after everything ok insert new topic to database
            $data = $this->get_data_from_post();
            //exit();
            if (is_numeric($update_id)) {// IF EXIST UPDATE ID UPDATE
                //DON'T CHANGE  
                unset($data['date']);
                unset($data['view']);
                unset($data['topic_by']);
                $this->_update($update_id, $data);
                $this->my_edit_post();// Call here
            } else {// Insert
                $this->_insert($data);
                $this->my_new_post();// Call here
            }
        } else {
            echo validation_errors();
        }
    }
    //LOAD MORE NEW ITEMS
    function more_new_items()
    {
        $order_by = $this->input->post('order_by');
        $limit = 36;
        $offset = $this->input->post('offset');
        $total = $this->input->post('total');
        $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $data['query'] = $this->get_with_limit($limit, $offset, $order_by)->result();
        $result = $this->load->view('items/include_item_list_reuse', $data, TRUE);
        $data['or'] =$order_by;
        $data['view'] = $result;
        $data['offset'] = $offset + $limit;
        $data['total'] = $total - $limit;
        echo json_encode($data);
    }

    //search for admin back end
     function search() {
        echo Modules::run('site_security/make_sure_is_admin');
        $this->load->model('mdl_topic');
        $order_by = 'id';
         $limit = 36;
           $offset = $this->input->get('search');
         $keyword=  $this->input->get('search');
        $data['error'] = ''; //view file this is for up load file
        //pagination
        $this->load->library('pagination');
         $config['base_url']=base_url().'items/search?search='.$keyword;
        $config['total_rows'] = $this->mdl_topic->get_search_num_rows($keyword);
        $config['per_page'] = 36;
        $config['num_links'] = 4;
          $config['use_page_numbers'] = FALSE;
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
        $config['uri_segment'] = 4;  // add this line to override the default
        $this->pagination->initialize($config);
      
        //end pagination
        $data['query'] = $this->mdl_topic->get_where_custom_search('tags', $keyword,$config['per_page'], $this->input->get('page'), $order_by)->result();
         $data['num_result']=   $config['total_rows'];
        $data['description'] =  $keyword;
        $data['current'] = $this->uri->segment(1);
        $data['keyword'] =  $keyword;
        $data['title'] =  $keyword;
        $data['view_file'] = 'list_items'; //view file
        $data['module'] = 'items'; //module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function tim_kiem()
    {
        $data['title']='Search';
        $data['des']='search for your question';
        $data['key']='question,search,keyword';
        $this->load->helper('tags');
       
         //pagination config
         $this->load->library('pagination');
       $config['base_url']=base_url().'topic/tim-kiem?search='.$this->input->get('search');
       $config['total_rows']=$this->mdl_topic->get_search_num_rows();
       $config['per_page']=10;
       $config['num_links']=4;
       $config['use_page_numbers'] = FALSE;
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
     // $config['uri_segment'] = 4; // add this line to override the default
        $this->pagination->initialize($config);   
        $data['num_result']=  $this->mdl_topic->get_search_num_rows();
        $data['news_topic']=$this->mdl_topic->news_topic(10);
        $data['searchs']=  $this->mdl_topic->search($config['per_page'],$this->input->get('page'));
        $data['current']= 15;
        $data['keyword']=  $this->input->get('search');
          $data['view_file'] = 'search'; //view file
        $data['module'] = 'topic'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    
    }
    function home_cate($cat_id)
    {

        $cate_id = $cat_id;
        $data['cate_name']=  $this->reuse_model_function->_detail('category','id',$cate_id)->cat_name;
        $data['cate_id']= $cat_id;
        $this->load->helper('text'); //LOAD TEXT HELPER FOR WORD_LIMITER FUNCITON
        $total = $this->count_where('fk_category_id', $cate_id); //count all question where public(f7)=0 mena public.
        $data['total'] = $total; //put total to data array
        $data['query'] = $this->mdl_topic->home_query($cate_id);
        $data['view_file'] = 'home_cate'; //view file
        $data['module'] = 'items'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }
    function get_fk_table_where($col,$id)
    {
        $this->load->model('mdl_topic');
        $query = $this->mdl_topic->get_fk_table_where($col,$id);
        return $query;
    }
    function get($order_by) {
        $this->load->model('mdl_topic');
        $query = $this->mdl_topic->get($order_by);
        return $query;
    }
    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_topic');
        $query = $this->mdl_topic->get_with_limit_join_images($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_topic');
        $query = $this->mdl_topic->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
      $this->load->model('mdl_topic');
        $query = $this->mdl_topic->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        $this->load->model('mdl_topic');
        $this->mdl_topic->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }
        $this->load->model('mdl_topic');
        $this->mdl_topic->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        $this->load->model('mdl_topic');
        $this->mdl_topic->_delete($id);
    }

      function count_where($column, $value){
        $this->load->model('mdl_topic');
        $count = $this->mdl_topic->count_where($column, $value);
        return $count;
    }

    function get_max() {
        $this->load->model('mdl_topic');
        $max_id = $this->mdl_topic->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        $this->load->model('mdl_topic');
        $query = $this->mdl_topic->_custom_query($mysql_query);
        return $query;
    }

}
