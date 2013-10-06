<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function type_file($file) {
        $mime = get_mime_by_extension($file);

        $type = "";
        switch ($mime) {
            case 'image/png':
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/gif':
                $type = "image";
                break;

            case 'application/pdf':
                $type = "pdf";
                break;

            case 'application/x-photoshop':
                $type = "psd";
                break;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            case 'application/msword':
                $type = "doc";
                break;
            case 'application/excel':
                $type = "doc";
                break;
            default:
                $type = "unidentified";
                break;
        }
        return $type;
    }

    public function register_file($path, $mid, $mname) {
        $type = $this->type_file($path);

        $this->db->insert('ci_file', array(
            'path' => $path,
            'module_id' => $mid,
            'module_name' => $mname,
            'type' => $type
        ));
    }

    public function drop_file($id) {
        $data = $this->database->get_row('ci_file', array('id' => $id));
        if ($data) {
            $this->db->delete('ci_file', array('id' => $id));
            $full_path = $_SERVER['DOCUMENT_ROOT'] . $data['path'];
            if (file_exists($full_path))
                unlink($full_path);
            return true;
        } else {
            return false;
        }
    }

    public function upload_files($mname, $mid) {

        $upload_path = '/upload/files/';

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $upload_path;
        $config['allowed_types'] = 'doc|jpg|jpeg|gif|pdf|docx|xls|xlsx|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $json['status'] = 'error';
            //$json['issue'] = $this->upload->display_errors('', '');
        } else {
            $upload_arr = $this->upload->data();
            $json['status'] = 'success';

            $raw_name = $upload_arr['raw_name'];
            $file_ext = $upload_arr['file_ext'];

            $file_path = $upload_path . $raw_name . $file_ext;

            $this->register_file($file_path, $mid, $mname);
        }

        return json_encode($json);

        $this->output->enable_profiler(FALSE);
    }

}