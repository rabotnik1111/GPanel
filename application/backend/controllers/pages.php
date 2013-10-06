<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('pages_model');
        $this->template->set_layout('default');
    }

    public function index() {
        $data = array();
        
        $data['tree'] = $this->pages_model->tree_pages(0);
        
        $this->template->build('pages/pages/edit', $data);
    }
    
    public function add() {
        $name = $this->input->post('name');
        $parent = $this->input->post('parent');
        $page_id = $this->pages_model->create_page($this->langs,$name,$parent);
        redirect("pages/form/{$page_id}");
    }
    
    public function form($id) {
        $data = array();
        $data['tree'] = $this->pages_model->tree_pages(0);
        $data['page'] = $this->pages_model->get_page($id);
        $this->template->build('pages/pages/edit', $data);
    }
    
    public function save($id) {
        $general = $this->input->post('general');
        $lang = $this->input->post('lang');
        $this->pages_model->update_page($general,$lang,$id);
        redirect("pages/form/{$id}");
    }

}
