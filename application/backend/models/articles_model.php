<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articles_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->load->model('jqgrid_model');

        $this->jqgrid_model->init('ci_article', 'id');
    }

    public function get() {
        $page = $this->input->post('page');
        $limit = $this->input->post('rows');
        $sord = $this->input->post('sord');
        $sidx = $this->input->post('sidx');
        $count = $this->db->count_all('ci_article');
        $start = $this->jqgrid_model->start($count, $page, $limit);
        $list = $this->get_articles($start, $limit, $sord, $sidx);

        return $this->jqgrid_model->populate($list, $count, $page, $limit);
    }

    public function get_articles($start, $limit, $sord, $sidx) {
        $SQL = "SELECT a.id, al.title, al.text, al.uri FROM ci_article a
                INNER JOIN ci_article_lang al ON a.`id` = al.`article_id` AND al.`lang_id` = 1
                ORDER BY `{$sidx}` {$sord} LIMIT {$start}, {$limit}";
        return $this->db->query($SQL)->result_array();
    }

    public function get_article($id) {
        $data = $this->database->get_row('ci_article', array('id' => $id));
        $langs = $this->database->get_all('ci_article_lang', array('article_id' => $id));
        $data['langs'] = array();
        foreach ($langs as $item) {
            $data['langs'][$item['lang_id']] = $item;
        }
        return $data;
    }

    public function save_article($langs,$data,$general,$article_id) {
        if ($article_id) {
            $this->db->update('ci_article', $general, array('id' => $article_id));
        } else {
            $this->db->insert('ci_article', $general);
            $article_id = $this->db->insert_id();
        }

        foreach ($langs as $lang) {
            $data[$lang['id']]['uri'] = strtolower(url_title("{$lang['ext']} {$data[$lang['id']]['title']} {$article_id}"));
            $data[$lang['id']]['enabled'] = isset($data[$lang['id']]['enabled']) ? 1 : 0;
            
            $fields = array(
                'article_id' => $article_id,
                'lang_id' => $lang['id'],
            ) + $data[$lang['id']];
            
            $where = array(
                'article_id' => $article_id,
                'lang_id' => $lang['id']
            );
            
            if ($this->database->get_row('ci_article_lang',$where)) {
                $this->db->update('ci_article_lang',$fields ,$where);
            } else {
                $this->db->insert('ci_article_lang', $fields);
            }
            
        }

        return $article_id;
    }
    
    public function tree_categories($parent = 0,$enabled = 1) {
        $data = $this->database->get_all('ci_category',array('parent'=>$parent,'enabled'=>$enabled));
        
        foreach ($data as $k => $row) {
            $data[$k]['childs'] = $this->tree_categories($row['id'],$enabled);
        }
        return $data;
    }

}