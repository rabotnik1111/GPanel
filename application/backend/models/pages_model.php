<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages_model extends CI_Model {

    private $lang = 1;

    function __construct() {
        parent::__construct();
    }

    public function get_page_langs($id) {
        $data = $this->database->get_all('ci_page_lang', array('page_id' => $id));
        $result = array();
        foreach ($data as $dt) {
            $result[$dt['lang_id']] = $dt;
        }
        return $result;
    }

    public function get_page($id) {
        $data = $this->database->get_row('ci_page', array('id' => $id));
        $data['langs'] = $this->get_page_langs($id);
        return $data;
    }

    public function get_pages_parent($parent = 0) {
        $data = $this->database->get_all('ci_page', array('parent' => $parent));
        foreach ($data as $k => $row) {
            $data[$k]['langs'] = $this->get_page_langs($row['id']);
        }
        return $data;
    }

    public function tree_pages($parent = 0) {
        $data = $this->get_pages_parent($parent);
        foreach ($data as $k => $row) {
            $data[$k]['childs'] = $this->tree_pages($row['id']);
        }
        return $data;
    }
    
    public function max_ord() {
        return 0;
    }
    
    public function create_page($langs,$name,$parent) {
        $this->db->insert('ci_page',array('parent'=>$parent,'ord'=>$this->max_ord()+1));
        $page_id = $this->db->insert_id();
        
        foreach ($langs as $lang) {
            $uri = strtolower(url_title("{$lang['ext']} {$name} {$page_id}")); 
            $this->db->insert('ci_page_lang',array(
                'page_id'=>$page_id,
                'lang_id'=>$lang['id'],
                'title' => $name,
                'uri' => $uri
            ));
        }
        
        return $page_id;
    }
    
    public function update_page($general,$langs,$id) {
        // Update general settings
        $general['enabled'] = isset($general['enabled']) && $general['enabled'] ? 1 : 0;
        $this->db->update('ci_page',$general,array('id'=>$id));
        
        // Update language settings
        foreach ($langs as $lid => $lang) {
            $this->db->update('ci_page_lang',$lang,array('page_id'=>$id,'lang_id'=>$lid));
        }
    } 

}