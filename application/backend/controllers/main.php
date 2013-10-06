<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->template->set_layout('default');
    }

    public function index() {
        $data = array();
        $this->template->build('pages/dashboard/main', $data);
    }

}
