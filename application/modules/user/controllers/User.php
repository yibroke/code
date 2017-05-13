<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MX_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function naver_callback()
    {
         $data['view_file'] = 'naver_callback'; //view file
        $data['module'] = 'user'; //module
        $this->load->module('template');
        $this->template->no_header_no_footer($data);
    }

    function profile(){
       // $user_id= 56;
       $user_id=  $this->uri->segment(3);
        $data['current']=  $this->uri->segment(2);
        $data['description']= 'description';
        $data['title']= $data['query']=  $this->get_where_custom('user_id', $user_id)->row()->user_name;
        $data['query']= $this->get_where_custom('user_id', $user_id)->row();
        $data['view_file']= 'profile';//view file
        $data['module']= 'user';//module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function activity(){
         $user_id=  $this->uri->segment(3);
          $data['current']=  $this->uri->segment(2);
        $data['description']='User poll';
        $data['title']='User poll';
        //pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'user/activity/'.$user_id;  $config['total_rows'] = $this->question_model->count_all_from_user($user_id); $config['per_page'] = 10; $config['num_links'] = 4; $config['uri_segment'] = 4; 
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //end pagination
        $data['query'] = $this->question_model->my_list_question_join_vote($user_id,$config['per_page'], $page,'q_id');
        $data['view_file']='activity';//view file
        $data['module']='user';//module
         $this->load->module('template');
        $this->template->one_col($data);
    }

    function my_account(){
          echo Modules::run('site_security/make_sure_is_user');
        // from session get user ID. From user ID get user detail
        $user_id=  $this->session->userdata('user_id');  
        
        $data['current']= 'user';
        $data['description']='description';
        $data['keyword']='Keywords';
        $data['title']='My account';
        $data['query']=  $this->get_where_custom('user_id', $user_id)->row();
       $data['view_file']='my_account';//view file
       $data['module']='user';//module
       $this->load->module('template');
       $this->template->one_col($data);
    }
    function get_data_from_post() {
        $data['user_name'] = $this->input->post('user_name');
        $data['user_email'] = $this->input->post('user_email');
        // day, month, year
        $data['age'] = $this->input->post('age');
        $data['country'] = $this->input->post('country');
        $data['gender'] = $this->input->post('gender');
        $data['user_about'] = $this->input->post('user_about');
        return $data;
    }
    function update_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name','User Name','required');
        $this->form_validation->set_rules('user_email','Email','required');
         $update_id = $this->input->post('user_id', TRUE);
         if ($this->form_validation->run() == TRUE) {
            //after everything ok insert new topic to database
            $data = $this->get_data_from_post();
            $this->_update($update_id, $data);
            
            echo base_url().'user/my-account';
        } else {
            echo validation_errors();
        }
    }
    function update_info() {
        $data['title'] = 'Update info';
         $data['current']= 'user';
        $id = $this->session->userdata('user_id');
        $data['query'] = $this->get_where_custom('user_id', $id)->row();
        $data['view_file'] = 'update_info'; //view file
        $data['module'] = 'user'; //module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function index() {
        echo 'user';
    }
    function login()
    {
        $data['current']= $this->uri->segment(2);
        $data['description']='description';
        $data['keyword']='Keywords';
        $data['title']='Login';
        $data['view_file']='login_form';//view file
        $data['module']='user';//module
        $this->load->module('template');
        $this->template->short_height($data);
    }
    function check_cookie()
    {
     if(isset($_COOKIE['remember_me'])) {
        //precess login.
        //check table user for token $cookie.
        
        $cookie_value=$_COOKIE['remember_me'];
        if($this->mdl_user->check_token_cookie($cookie_value)==TRUE)
        {
           // echo ' token corect';
               $user= $this->mdl_user->get_user_detail_where_token($cookie_value);
               $new_data = array('user_name' => $user->user_name, 'user_id' => $user->user_id, 'user_role' => $user->user_role, 'logged_in' => TRUE);
               $this->session->set_userdata($new_data);
               redirect($this->uri->uri_string());//refresh current page.
        }
    }
    }
   function set_cookie($user_id)
    {
         $cookie_name = "remember_me";
          $this->load->model('mdl_user');
         $user = $this->mdl_user->get_user_detail_from_id($user_id);
         if($user->remember_me_token!='' || $user->remember_me_token!=NULL)  
         {
            $cookie_value =$user->remember_me_token;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day ;
         }else{
             //create unike token
            $cookie_value= md5(uniqid());//token unique
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day ;
            $this->mdl_user->update_token_remember_me($cookie_value,$user_id);//insert token remember me to user table.
         }
    }
    function login_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_login', 'Email', 'required|callback_check_user');
        $this->form_validation->set_rules('password_login', 'Password', 'required');
        if ($this->form_validation->run($this) == TRUE) {
             //after everything ok get user detail save in session
            $user = $this->mdl_user->get_user_detail($this->input->post('email_login'));
            $new_data = array('user_name' => $user->user_name, 'user_id' => $user->user_id, 'user_role' => $user->user_role, 'logged_in' => TRUE);
            $this->session->set_userdata($new_data);
            //set cookie to remember user.
            $this->set_cookie($user->user_id);
            echo 'true';
        } else {
            echo validation_errors();
        }
    }
     function check_user(){
        
        if ($this->mdl_user->can_login()) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_user', 'Incorrect Email or password');
            return FALSE;
        }
    }
    function logout() {
        $this->session->sess_destroy();
        // set the expiration date to one hour ago
        setcookie("remember_me", "", time() - 3600,"/");
    }
    // use fb_login for both fb and google.
      //check facebook id. already exist.
      //if already login like nomal
      //else register.
 function fb_login()
    {
        $user_name=  $this->input->post('user_name');
        $user_id=  $this->input->post('user_id');//use user_id instead of email
       if($this->count_where('user_email', $user_id)==0){
            
            if ($this->mdl_user->insert_user_from_fb() == TRUE) {
               //success
                 $user = $this->mdl_user->get_user_detail($user_id);
                 $new_data = array('user_name' => $user_name, 'user_id' => $user->user_id, 'user_role' => $user->user_role, 'logged_in' => TRUE);
                // print_r($new_data);
              $this->session->set_userdata($new_data);
               //set cookie to remember user.
            $this->set_cookie($user->user_id);
               echo 'true';
            } else {
               //fail
               echo 'error';
            }
       }else if($this->count_where('user_email', $user_id)==1){
             //get user Id from user email.
               $user = $this->mdl_user->get_user_detail($user_id);
            
                $new_data = array('user_name' => $user_name, 'user_id' => $user->user_id, 'user_role' => $user->user_role, 'logged_in' => TRUE);
                // print_r($new_data);
              $this->session->set_userdata($new_data);
               //set cookie to remember user.
                $this->set_cookie($user->user_id);
               echo 'true';
       }else{
            echo 'error arl - '.$this->count_where('user_email', $user_id);
       }
    }
    function register(){
        if($this->session->logged_in==true)
        {
            redirect('');
        }
        $data['description']='Register';
        $data['keyword']='register';
        $data['title']='Register';
       // $data['results']=  $this->mdl_post->get();
       $data['view_file']='register_form';//view file
       $data['module']='user';//module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function register_validation()
    {
         $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[5]|max_length[30]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.user_email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');
        //costum is_unique error message
        $this->form_validation->set_message('is_unique', 'The email address already exist');
        if ($this->form_validation->run($this)) {
          
           $active_key=md5(uniqid());
            $email=  $this->input->post('email');
            if ($this->mdl_user->insert_user($active_key) == TRUE) {
               // send email activate
               $this->send_email_activate_accout($active_key, $email);
             
            } else {
               $array = array(); $array['success'] = false; $array['data'] = 'Database error';
                 echo json_encode($array);
            }
           
        } else {
           $array = array();$array['success'] = false;$array['data'] = validation_errors();
             echo json_encode($array);
        }  
       
    }
    function resiger_success(){
          $data['description']='Register';
        $data['keyword']='register';
        $data['title']='Register';
       
       // $data['results']=  $this->mdl_post->get();
       $data['view_file']='register_success';//view file
       $data['module']='user';//module
        $this->load->module('template');
        $this->template->short_height($data);
    }
    function email_recover_password()
    {
         $data['description']='Email reset password';
        $data['keyword']='Email reset password';
        $data['title']='Email reset password';
       $data['view_file']='email_form';//view file
       $data['module']='user';//module
        $this->load->module('template');
        $this->template->short_height($data);
    }
    function active(){
         $data['description']='Activate account';
        $data['keyword']='Activate account';
        $data['title']='Activate account';
        // Check active code
        $active_key=  $this->uri->segment(3);
        if(strlen($active_key)<10){
               $data['active_message']='<p>Your code is too short. Sorry! Your active url not correct!</p>';
        }else{
        //if have 1 fill with this key update. Else wrong key.
        if($this->count_where('user_active', $active_key)==1){
             $this->mdl_user->active_account($active_key);
             $data['active_message']='<p>Well done! Your account has been active!</p>';
        }else{
            $data['active_message']='<p>Sorry! Your active url not correct!</p>';
        }
        }
       $data['view_file']='activate';//view file
       $data['module']='user';//module
        $this->load->module('template');
        $this->template->one_col($data);
    }
    function delete(){
        $id=  $this->input->post('id');
          
        if($this->mdl_user->delete_user($id)==true)
        {
            echo 'true';
        }
        else 
        {
          echo 'false';
        }
    }
    function send_email_activate_accout($active_key,$email)
    {
        $this->load->library('email');
         $this->email->from('servernoreply@yahoo.com','Poller.co.kr');
         $this->email->to($email);
         $this->email->subject('Activate account');
         $message='<h1>Please Confirm Subscription</h1>';
         $message.="<a href='".  base_url()."user/active/".$active_key."'>Active Here</a>";
          $message.='<p>If you received this email by mistake, simply delete it. You will not be subscribed if you dont click the confirmation link above.</p>';
          $message.='<p>For questions about this list, please contact:<br> servernoreply@yahoo.com </p>';
         $this->email->message($message);
         if($this->email->send()){
              $array = array(); $array['success'] = true; $array['data'] = 'Kindly check your email '.$email.' to activate your account';
         }else{
              $array = array(); $array['success'] = false; $array['data'] = 'Error: Can not send email';
         }
          echo json_encode($array);
    }
    //function send email reset password
    function send_mail_reset_password($reset_key,$email){
              $this->load->library('email');
              $this->email->from('servernoreply@yahoo.com','Poller.co.kr');
              $this->email->to($email);
              $this->email->subject('Reset Password');
              $message='<h1>Reset Password</h1>';
              $message.='<p>You or someone request to reset password</p>';
              $message.="<a href='".  base_url()."user/reset_password/".$reset_key."'>Click here to reset your password</a>";
              $this->email->message($message);
              if($this->email->send()){
                  $array = array(); $array['success'] = true; $array['data'] = 'Kindly check your email '.$email.' to change your password';
              }else{
                   $array = array(); $array['success'] = false; $array['data'] = 'Error: Can not send email';
              }
               echo json_encode($array);
    }
   //validate email and send email with reset password link
    function email_validation(){
         $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email');
        if ($this->form_validation->run($this)) {
          $reset_key=  md5(uniqid());
          $email=  $this->input->post('email');
          
          if($this->mdl_user->update_reset_key($reset_key)){
              //update and send email.
              $this->send_mail_reset_password($reset_key, $email);
          }else{
              $array = array(); $array['success'] = false; $array['data'] = 'Error: Can not update reset password key. DB error';
              echo json_encode($array);
          }
        } else {
          $array = array(); $array['success'] = false; $array['data'] = validation_errors();
          echo json_encode($array);
        }  
    }
     function check_email() {
        
        if ($this->mdl_user->has_email()) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_email', 'The email address doesnt exist in our system');
            return FALSE;
        }
    }
    function update_reset_key(){
        $email=  $this->input->post('email');
         
    }
    function reset_password(){
          $data['description']='Reset Password';
        $data['keyword']='Reset Password';
        $data['title']='Reset Password';
         //validate reset code.
         if($this->check_reset_password_code()){
             $data['view_file']='reset_password';//view file
         }else{
            $data['view_file']='not_correct_reset_code';//view file
         }
       
       $data['module']='user';//module
        $this->load->module('template');
        $this->template->short_height($data);
    }
    function check_reset_password_code(){
        //get code from uri
         $code=  $this->uri->segment(3);
         if(strlen($code)<10){
             return FALSE;
             exit();
         }
        //get code from db
        $count=  $this->count_where('reset_password_key', $code);
        if($count==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function reset_password_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');
        if($this->form_validation->run($this)){
            
            if($this->mdl_user->update_password()){
                  $array = array(); $array['success'] = true; $array['data'] = 'Reset Password successful';
            }else{
                  $array = array(); $array['success'] = false; $array['data'] = 'Password can not be reset unknown error from database';
            }
        }else{
              $array = array(); $array['success'] = false; $array['data'] = validation_errors();
        }
        echo json_encode($array);
    }
    function change_password()
    {
        $data['view_file']= 'change_password';//view file
        $data['module']= 'user';//module
        $this->load->module('template');
        $this->template->no_footer($data);
    }
    function check_password(){
        if ($this->mdl_user->check_pass()) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_password', 'The current password is not correct');
            return FALSE;
        }
    }
    function change_password_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('current_password', ' current Password', 'required|callback_check_password');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');
        if($this->form_validation->run($this)){
            if($this->mdl_user->change_password()){
                  $array = array(); $array['success'] = true; $array['data'] = 'Change Password successful';
            }else{
                  $array = array(); $array['success'] = false; $array['data'] = 'Password can not be reset unknown error from database';
            }
        }else{
              $array = array(); $array['success'] = false; $array['data'] = validation_errors();
        }
        echo json_encode($array);
    }
    //list user but not admin
    function list_user(){
         echo Modules::run('site_security/make_sure_is_admin');
         $data['query']=  $this->get_where_custom('user_role!=', 'admin');
           $data['description']='description';
         $data['current']=  $this->uri->segment(2);
        $data['keyword']='Keywords';
        $data['title']='Control';
       $data['view_file']='list_user';//view file
       $data['module']='user';//module
        $this->load->module('template');
        $this->template->admin($data);
    }
    function detail(){
         echo Modules::run('site_security/make_sure_is_admin');
         $id=  $this->uri->segment(3);
         $data['query']=  $this->get_where_custom('user_id', $id);
           $data['description']='description';
         $data['current']=  $this->uri->segment(2);
        $data['keyword']='Keywords';
        $data['title']='Control';
       $data['view_file']='detail';//view file
       $data['module']='user';//module
        $this->load->module('template');
        $this->template->admin($data);
    }
    ///////////////////////////////////////// Copy stuff////////////////////////////
    function get($order_by) {
        
        $query = $this->mdl_user->get($order_by);
        return $query;
    }
    function get_with_limit($limit, $offset, $order_by) {
        if ((!is_numeric($limit)) || (!is_numeric($offset))) {
            die('Non-numeric variable!');
        }

        
        $query = $this->mdl_user->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        
        $query = $this->mdl_user->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value) {
        
        $query = $this->mdl_user->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data) {
        
        $this->mdl_user->_insert($data);
    }

    function _update($id, $data) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        
        $this->mdl_user->_update($id, $data);
    }

    function _delete($id) {
        if (!is_numeric($id)) {
            die('Non-numeric variable!');
        }

        
        $this->mdl_user->_delete($id);
    }

    function count_where($column, $value) {
        
        $count = $this->mdl_user->count_where($column, $value);
        return $count;
    }

    function get_max() {
        
        $max_id = $this->mdl_user->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query) {
        
        $query = $this->mdl_user->_custom_query($mysql_query);
        return $query;
    }

}
