<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('users_model');
    }
    
    public function index() {
        
    }
}