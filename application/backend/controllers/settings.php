<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('settings_model');
    }

    public function index() {
        $this->template->set_layout('default');

        $data['settings'] = $this->settings_model->get_settings();
        
        $this->template->build('pages/settings/general', $data);
    }

    public function save() {
        $data = $this->input->post('settings');
        
        if ($data) {
            $this->settings_model->save_settings($data);
        }
        
        redirect('settings');
    }

}
