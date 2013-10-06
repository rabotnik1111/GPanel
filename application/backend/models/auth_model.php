<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function verify($username,$password) {
        return $this->database->get_row('g_user',array(
            'login' => $username,
            'password' => sha1($password)
        ));
    }
    
    public function enter($data) {
        $this->session->set_userdata('user',$data);
        $this->db->update('g_user',array('last_login'=>date("Y-m-d H:i:s")),array('id'=>$data['id']));
    }
}