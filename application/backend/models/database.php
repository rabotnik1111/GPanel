<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Model
{

	public function get_all($table,$arr = array()) {
        $this->db->from($table);
		$this->db->where($arr);
		$query = $this->db->get();
		return $query->result_array();
	}
    
    public function get_row($table,$arr = array()) {
        $this->db->from($table);
		$this->db->where($arr);
		$query = $this->db->get();
		return $query->row_array();
    }

}