<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_settings() {
        $data = $this->database->get_all('g_settings');
        $result = array();
        foreach ($data as $value) {
            $result[$value['name']] = $value['value'];
        }
        return $result;
    }
    
    public function save_settings($data) {
        foreach ($data as $name => $set) {
            if ($this->database->get_row('g_settings',array('name'=>$name))) {
                $this->db->update('g_settings',array('value'=>$set),array('name'=>$name));
            } else {
                $this->db->insert('g_settings',array('value'=>$set,'name'=>$name));
            }
        }
    }
}