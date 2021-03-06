<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('users_model');
        $this->template->set_layout('default');
    }
    
    public function index() {
        $data = array();
        
        $this->template->build('pages/users/list', $data);
    }
    
    public function get() {
        header('Content-Type: text/plain');
        
        echo $this->users_model->get();
    }
    
    public function edit() {
        $this->users_model->edit();
    }
}