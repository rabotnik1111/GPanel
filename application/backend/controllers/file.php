<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('file_model');
    }

    public function index() {
        
    }
    
    public function delete() {
        $id = $this->input->post('id');
        $this->file_model->drop_file($id);
    }
    
    public function upload($mname,$mid) {
        echo $this->file_model->upload_files($mname,$mid);
    }
    
    public function get($mname,$mid) {
        $files = $this->database->get_all('ci_file',array(
            'module_name' => $mname,
            'module_id' => $mid
        ));
        
        $data['count'] = count($files);
        $data['html'] = "";
        foreach ($files as $file) {
            $data['html'] .= $this->load->view('pages/file/item_file',array('file'=>$file),TRUE);
        }
        
        echo json_encode($data);
    }

}
