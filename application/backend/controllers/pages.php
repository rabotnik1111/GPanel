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

    public function cdelete($id) {
        $data['page'] = $this->pages_model->get_page($id);

        if (isset($data['page']['id'])) {
            $data['page_lang'] = $this->database->get_all('ci_page_lang', array('page_id' => $id));
            $data['files'] = $this->database->get_all('ci_file', array('module_id' => $id, 'module_name' => 'page'));
}

        $this->template->build('pages/pages/delete', $data);
    }

    public function delete($id) {
        $this->load->model('file_model');
        $this->db->delete('ci_page', array('id' => $id));
        $this->db->delete('ci_page_lang', array('page_id' => $id));

        $files = $this->database->get_all('ci_file', array('module_id' => $id, 'module_name' => 'page'));

        foreach ($files as $item) {
            $this->file_model->drop_file($item['id']);
        }
        
        redirect('pages');
    }

    public function move($id, $up = 1) {
        $page = $this->database->get_row('ci_page', array('id' => $id));

        if ($page) {
            if ($up) {
                $SQL = "SELECT * FROM ci_page cp WHERE cp.parent = {$page['parent']} AND cp.ord < {$page['ord']} ORDER BY cp.ord DESC";
            } else {
                $SQL = "SELECT * FROM ci_page cp WHERE cp.parent = {$page['parent']} AND cp.ord > {$page['ord']} ORDER BY cp.ord ASC";
            }

            $spage = $this->db->query($SQL)->row_array();

            if ($spage) {
                $this->db->update('ci_page', array(
                    'ord' => $page['ord']
                        ), array(
                    'id' => $spage['id']
                ));
                $this->db->update('ci_page', array(
                    'ord' => $spage['ord']
                        ), array(
                    'id' => $page['id']
                ));
            }
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

}
