<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vars extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('vars_model');
        $this->template->set_layout('default');
    }
    
    public function index($parent = 0) {
        $data = array();
        
        $data['parent'] = $parent;
        $data['active'] = 'vars';
        
        $this->template->build('pages/vars/list', $data);
    }
    
    public function get($parent = 0) {
        header('Content-Type: text/plain');
   
        echo $this->vars_model->get($parent);
    }
    
    public function langs($id) {
        $data = array();
        
        $data['active'] = 'vars';
        $data['id'] = $id;
        $data['langs'] = $this->db->select('ci_var_lang.*, ci_lang.name as lang')
                            ->from('ci_var_lang')
                            ->join('ci_lang','ci_var_lang.lang_id = ci_lang.id')
                            ->where(array('ci_var_lang.var_id'=>$id))
                            ->get()
                            ->result_array();
        
        $this->template->build('pages/vars/lang', $data);
    }
    
    public function get_lang($id) {
        header('Content-Type: text/plain');
        
        echo $this->vars_model->get_lang($id);
    }
    
    public function edit_lang() {
        $this->clear_frontend_cache();
        $this->vars_model->edit_lang();
    }
    
    public function save_lang() {
        $langs = $this->input->post('langs');
        
        $this->clear_frontend_cache();
        
        foreach ($langs as $lang) {
            $this->db->update('ci_var_lang',array('value'=>$lang['value']),array('id'=>$lang['id']));
        }
        
        if (isset($lang) && $lang) {
            $dt = $this->database->get_row('ci_var_lang',array('id'=>$lang['id']));
            $dt = $this->database->get_row('ci_var',array('id'=>$dt['var_id']));
            redirect('vars/index/'.$dt['parent']);
        }
        
        redirect('vars');
    }
    
    public function add() {
        $new_var = $this->input->post('new_var');

        // perepare data_var for inser
        $var_data = array(
            'parent' => $new_var['parent'],
            'name' => strtolower(url_title($new_var['name']))
        );
        
        // insert and get id of var
        $var_id = $this->vars_model->create_variable($var_data);

        // prepare vars_lang for insert
        $vars_lang_data = array();
        foreach ($new_var['values'] as $lang_id => $var) {
            $vars_lang_data[] = array(
                'var_id' => $var_id,
                'lang_id' => $lang_id,
                'value' => $var
            );
        }
        
        $this->clear_frontend_cache();
        
        // insert value for new variable
        $this->vars_model->set_variable_values($vars_lang_data);
        
        redirect('vars/index/'.$new_var['parent']);
    }
}