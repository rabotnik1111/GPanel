<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Model
{

	public function get_all($table,$arr) {
		$this->db->where($arr);
		$this->db->get();
		return $this->db->result_array();
	}

}