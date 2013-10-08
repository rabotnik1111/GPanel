<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jqgrid_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    protected $table;
    protected $key;

    /**
     * set table and key
     * @param str $table
     * @param int $key
     */
    public function init($table, $key) {
        $this->table = $table;
        $this->key = $key;
    }

    /**
     * get row
     * @param int $id
     * @return array
     */
    public function get($id) {
        return $this->db->get_where($this->table, array($this->key => $id))->row_array();
    }

    /**
     * jqgrid insert
     * @param array $params
     * @return int
     */
    public function insert($params) {
        $this->db->insert($this->table, $params);
        return $this->db->insert_id();
    }

    /**
     * jqgrid update
     * @param array $params
     * @param int $id
     * @return int
     */
    public function update($params, $id) {
        $this->db->update($this->table, $params, array($this->key => $id));
        return $this->db->affected_rows();
    }

    /**
     * jqgrid delete
     * @param str $id
     */
    public function delete($id) {
        $idx = explode(",", $id);
        foreach ($idx as $id) {
            if ($this->get($id)) {
                $this->db->where($this->key, $id);
                $this->db->delete($this->table);
            }
        }
    }

    /**
     * select operation
     * @param str $oper
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function oper($oper, $params, $id) {
        switch ($oper) {
            case 'add' : {
                    $result = $this->insert($params);
                }
                break;

            case 'edit' : {
                    $result = $this->update($params, $id);
                }
                break;

            case 'del' : {
                    $result = $this->delete($id);
                }
                break;
        }
        return $result;
    }

    /**
     * return start limit
     * @param int $count
     * @param int $page
     * @param int $limit
     * @return int
     */
    public function start($count, $page, $limit) {
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }

        if ($page > $total_pages)
            $page = $total_pages;
        $start = $limit * $page - $limit;

        return $start;
    }

    /**
     * json for jqgrid
     * @param array $list
     * @param int $count
     * @param int $page
     * @return json
     */
    public function populate($list, $count, $page, $limit) {

        if ($count == 0) {
            $total_pages = 0;
            $responce->page = 0;
            $responce->total = 0;
            $responce->records = 0;
            return json_encode($responce);
        } else {
            $total_pages = ceil($count / $limit);
        }

        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        $i = 0;
        foreach ($list as $row) {
            $responce->rows[$i]['id'] = $row[$this->key];
            $responce->rows[$i]['cell'] = array_values($row);
            $i++;
        }

        return json_encode($responce);
    }

}