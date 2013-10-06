<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct() {
        parent::__construct();
        
        $this->load->model('auth_model');
    }
    
	public function index()
	{
		$this->template->set_layout('login');
        
        $data['error'] = $this->session->userdata('login_error');
        $this->session->set_userdata('login_error','');
                
		$this->template->build('pages/auth/login',$data);
	}
    
    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($username && $password) {
            if ($data = $this->auth_model->verify($username, $password)) {
                $this->auth_model->enter($data);
                redirect('main');
            } else {
                $this->session->set_userdata('login_error','Username or password is wrong');
            }
        } else {
            $this->session->set_userdata('login_error','All fields is required');
        }
        
        redirect('auth');
    }
    
    public function logout() {
        $this->session->set_userdata('user',array());
        redirect('auth');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */