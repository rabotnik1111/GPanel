<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articles extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('articles_model');
        $this->template->set_layout('default');
    }
    
    public function index() {
        $data = array();
        
        $this->template->build('pages/articles/list', $data);
    }
    
    public function get() {
        header('Content-Type: text/plain');
        
        echo $this->articles_model->get();
    }
    
    public function form($id) {
        $data = array();
        
        $data['categories'] = $this->articles_model->tree_categories(0);
        $data['article'] = $this->articles_model->get_article($id);

        $this->template->build('pages/articles/form', $data);
    }
    
    public function add() {
        $data = array();
        
        $data['categories'] = $this->articles_model->tree_categories(0);
        
        $this->template->build('pages/articles/form', $data);
    }
    
    public function save($id = 0) {
        $data = $this->input->post('lang');
        $ganeral = $this->input->post('general');
        $article_id = $this->articles_model->save_article($this->langs,$data,$ganeral,$id);
        redirect('articles/form/'.$article_id);
    }
}