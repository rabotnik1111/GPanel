<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articles extends MY_Controller {

    function __construct() {
        parent::__construct();
        //Init
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
    
    public function cdelete($id) {
        $data['article'] = $this->database->get_row('ci_article',array('id'=>$id));
        $data['article_lang'] = $this->database->get_all('ci_article_lang',array('article_id'=>$id));
        $data['files'] = $this->database->get_all('ci_file',array('module_id'=>$id,'module_name'=>'article'));
        
        $this->template->build('pages/articles/delete', $data);
    }
    
    public function delete($id) {
        $this->db->delete('ci_article',array('id'=>$id));
        $this->db->delete('ci_article_lang',array('article_id'=>$id));
        $files = $this->database->get_all('ci_file',array('module_id'=>$id,'module_name'=>'article'));
        
        $this->load->model('file_model');
        foreach ($files as $itm) {
            $this->file_model->drop_file($itm['id']);
        }
                
        redirect('articles');
    }

    public function save($id = 0) {
        $data = $this->input->post('lang');
        $ganeral = $this->input->post('general');
        $article_id = $this->articles_model->save_article($this->langs,$data,$ganeral,$id);
        redirect('articles/form/'.$article_id);
    }
}