<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->load->model('jqgrid_model');

        $this->jqgrid_model->init('g_user', 'id');
    }

    public function edit() {
        $oper = $this->input->post('oper');
        $params = array(
            'login' => $this->input->post('login', true),
            'last_login' => $this->input->post('last_login', true)
        );
        $id = $this->input->post('id');
        $this->jqgrid_model->oper($oper, $params, $id);
    }

    public function get() {
        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sord = $this->input->post('sord');
        $sidx = $this->input->post('sidx');
        $count = $this->db->count_all('g_user');
        $start = $this->jqgrid_model->start($count, $page, $limit);
        $list = $this->get_users($start, $limit, $sord, $sidx);

        return $this->jqgrid_model->populate($list, $count, $page, $limit);
    }

    public function get_users($start, $limit, $sord, $sidx) {
        $SQL = "SELECT id, login, last_login FROM g_user ORDER BY `{$sidx}` {$sord} LIMIT {$start}, {$limit}";
        return $this->db->query($SQL)->result_array();
    }

}