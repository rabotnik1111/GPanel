<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('menu_model');
        $this->template->set_layout('default');
    }
    
    public function index() {
        $data = array();
        
        $this->template->build('pages/menu/list', $data);
    }
    
    public function get() {
        header('Content-Type: text/plain');
        
        echo $this->menu_model->get();
    }
    
    public function edit() {
        $this->menu_model->edit();
    }
}