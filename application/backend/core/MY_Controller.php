<?php
/**
 *  File: /application/core/MY_Controller.php
 */
class MY_Controller extends CI_Controller {

    protected $user;
    public $langs;
            
            
    function __construct() {
        parent::__construct();
        
        
        $this->user = $this->session->userdata('user');
        if (!$this->user && $this->router->fetch_class() != 'auth') redirect('auth');
        
        $this->template->set('top_menu',$this->database->get_all('g_menu',array('top'=>1)));
        $this->template->set('left_menu',$this->database->get_all('g_menu',array('top'=>0)));
        
        $this->template->set('active',$this->uri->uri_string());
        
        $this->langs = $this->database->get_all('ci_lang');
        $this->template->set('langs',$this->langs);
    }
    
    public function not_found() {
        echo 'Nui pagina';
    }

}