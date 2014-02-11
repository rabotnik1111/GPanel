<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vars_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->load->model('jqgrid_model');

        
    }

    public function get($parent) {
        $this->jqgrid_model->init('ci_var', 'id');
        
        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sord = $this->input->post('sord');
        $sidx = $this->input->post('sidx');
        $count = $this->db->count_all('ci_var');
        $start = $this->jqgrid_model->start($count, $page, $limit);
        $list = $this->get_vars($parent, $start, $limit, $sord, $sidx);

        return $this->jqgrid_model->populate($list, $count, $page, $limit);
    }
    
    public function get_vars($parent, $start, $limit, $sord, $sidx) {
        $SQL = "SELECT v.id, v.name, concat((SELECT vl.value FROM ci_var_lang vl WHERE v.id = vl.var_id LIMIT 0,1)) as list, v.id as page_id FROM ci_var v
                WHERE v.parent = ?
                ORDER BY `{$sidx}` {$sord} LIMIT {$start}, {$limit}";
        return $this->db->query($SQL,array($parent))->result_array();
    }
    
    public function get_lang($id) {
        $this->jqgrid_model->init('ci_var_lang', 'id');
        
        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sord = $this->input->post('sord');
        $sidx = $this->input->post('sidx');
        $count = $this->db->count_all('ci_var');
        $start = $this->jqgrid_model->start($count, $page, $limit);
        $list = $this->get_vars_lang($id,$start, $limit, $sord, $sidx);

        return $this->jqgrid_model->populate($list, $count, $page, $limit);
    }
    
    public function get_vars_lang($id,$start, $limit, $sord, $sidx) {
        $SQL = "SELECT vl.id, l.name, vl.value FROM ci_var_lang vl 
                INNER JOIN ci_lang l ON l.id = vl.lang_id
                WHERE vl.var_id = ?
                ORDER BY `{$sidx}` {$sord} LIMIT {$start}, {$limit}";
        return $this->db->query($SQL,array($id))->result_array();
    }
    
    public function edit_lang() {
        $this->jqgrid_model->init('ci_var_lang', 'id');
        
        $oper = $this->input->post('oper');
        $params = array(
            'value' => $this->input->post('value', true)
        );
        $id = $this->input->post('id');

        $this->jqgrid_model->oper($oper, $params, $id);
    }
    
    public function create_variable($data) {
        $this->db->insert('ci_var',$data);
        return $this->db->insert_id();
    }
    
    public function set_variable_values($values) {
        foreach ($values as $value) {
            $this->db->insert('ci_var_lang',$value);
        }
    }
    

}