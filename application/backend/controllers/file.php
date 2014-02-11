<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('file_model');
        
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');
    }

    public function index() {
        phpinfo();
    }

    public function delete() {
        $id = $this->input->post('id');
        $this->file_model->drop_file($id);
    }

    public function upload($mname, $mid, $type = 0) {
        echo $this->file_model->upload_files($mname, $mid, $type);
    }

    public function category() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $this->file_model->change_category($id, $category);
    }

    public function get($mname, $mid, $type = 0) {
        $files = $this->file_model->get_files($mname, $mid, $type);

        $categories = array(
            'Top',
            'Simple',
            'Developed',
            'Preview',
            'Unidentified'
        );

        $data['count'] = count($files);
        $data['html'] = "";
        foreach ($files as $file) {
            $data['html'] .= $this->load->view('pages/file/item_file', array('file' => $file, 'categories' => $categories), TRUE);
        }

        echo json_encode($data);
    }

    public function details() {
        $id = $this->input->post('id');

        $data = array();
        $data['file'] = $this->database->get_row('ci_file', array('id' => $id));

        $return['html'] = $this->load->view('pages/file/details_file', $data, TRUE);

        echo json_encode($return);
    }

    public function details_save() {
        $id = $this->input->post('id');
        $file = $this->input->post('file');

        if (isset($file['enable'])) {
            $file['enabled'] = isset($file['enabled']) && $file['enabled'] ? '1' : '0';
            unset($file['enable']);
        }
    
        $this->db->update('ci_file', $file, array('id' => $id));
    }

    public function move() {
        $id = $this->input->post('id');
        $dir = $this->input->post('dir');

        $file = $this->database->get_row('ci_file', array('id' => $id));
        if ($file) {
            if ($dir) {
                $SQL = "SELECT * FROM ci_file cp WHERE cp.module_name = '{$file['module_name']}' AND cp.module_id = '{$file['module_id']}' AND cp.ord < {$file['ord']} ".($file['category_id']?" AND cp.category_id = {$file['category_id']} ":"")." ORDER BY cp.ord DESC";
            } else {
                $SQL = "SELECT * FROM ci_file cp WHERE cp.module_name = '{$file['module_name']}' AND cp.module_id = '{$file['module_id']}' AND cp.ord > {$file['ord']} ".($file['category_id']?" AND cp.category_id = {$file['category_id']} ":"")." ORDER BY cp.ord ASC";
            }

            $sfile = $this->db->query($SQL)->row_array();

            if ($sfile) {
                $this->db->update('ci_file', array(
                    'ord' => $file['ord']
                        ), array(
                    'id' => $sfile['id']
                ));
                $this->db->update('ci_file', array(
                    'ord' => $sfile['ord']
                        ), array(
                    'id' => $file['id']
                ));
            }
        }
    }

}
