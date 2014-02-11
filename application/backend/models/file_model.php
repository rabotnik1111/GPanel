<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    private $upload_path = "/upload/files/";

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
                $type = "excel";
                break;
            case 'audio/mp4':
            case 'audio/mpeg':
            case 'audio/mpg':
            case 'audio/mpeg3':
            case 'audio/mp3':
                $type = "audio";
                break;
            default:
                $type = "{$mime}";
                break;
        }
        return $type;
    }

    public function register_file($path, $mid, $mname, $file_ext, $category = 0) {
        $type = $this->type_file($path);

        $this->db->insert('ci_file', array(
            'path' => $path,
            'module_id' => $mid,
            'module_name' => $mname,
            'type' => $type,
            'size' => filesize($_SERVER["DOCUMENT_ROOT"] . $path)
        ));

        $id = $this->db->insert_id();

        $this->create_attach($type, $path, $file_ext, $id);
    }

    public function create_attach($type, $path, $file_ext, $id) {

        $update = array('ord' => $id);

        switch ($type) {
            default:
                break;
        }

        $this->db->update('ci_file', $update, array('id' => $id));
    }

    public function drop_file($id) {
        $data = $this->database->get_row('ci_file', array('id' => $id));
        if ($data) {
            $this->db->delete('ci_file', array('id' => $id));
            $full_path = $_SERVER['DOCUMENT_ROOT'] . $data['path'];
            $thumb_path = $_SERVER['DOCUMENT_ROOT'] . $data['thumb_path'];
            if (file_exists($full_path))
                unlink($full_path);
            if (file_exists($thumb_path))
                unlink($thumb_path);
            return true;
        } else {
            return false;
        }
    }

    public function upload_files($mname, $mid, $type = 0) {

        $upload_path = $this->upload_path;

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $upload_path;
        $config['allowed_types'] = 'doc|jpg|jpeg|gif|pdf|docx|xls|xlsx|png|m4a|mp4|mp3';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            var_dump($this->upload->data());
            $json['status'] = 'error';
            $json['issue'] = $this->upload->display_errors('', '');
        } else {
            $upload_arr = $this->upload->data();
            $json['status'] = 'success';

            $raw_name = $upload_arr['raw_name'];
            $file_ext = $upload_arr['file_ext'];

            $file_path = $upload_path . $raw_name . $file_ext;

            $this->register_file($file_path, $mid, $mname, $file_ext, $type);
        }

        return json_encode($json);

        $this->output->enable_profiler(FALSE);
    }

    public function change_category($id, $category) {
        $this->db->update('ci_file', array(
            'category' => $category
                ), array(
            'id' => $id
        ));
    }

    public function get_files($mname = '', $mid = 0, $type = 0) {
        $where = array();
        if ($mname)
            $where['module_name'] = $mname;
        if ($mid)
            $where['module_id'] = $mid;
        if ($type)
            $where['category_id'] = $type;

        $data = $this->db->select("ci_file.*")
                ->from('ci_file');

        if ($where)
            $data = $data->where($where);

        $data = $data->order_by('ord', 'desc');

        return $data->get()->result_array();
    }

}