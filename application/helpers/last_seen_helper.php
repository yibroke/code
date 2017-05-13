<?php

//make sure this file cant be include and run outside of ci
defined('BASEPATH') OR exit('No direct script access allowed');

function last_seen($user_id) {
    $this->CI = & get_instance();
    $this->CI->load->model('user/mdl_user');
    $this->CI->mdl_user->update_last_seen($user_id);
}
