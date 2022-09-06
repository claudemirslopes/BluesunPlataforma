<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Login extends CI_Controller{
    
    public function index() {
        
        $data = array(
            'titulo' => 'Login Orcamentos',
        );
        
        $this->load->view('orcamentos/login/header', $data);
        $this->load->view('orcamentos/login/index');
        $this->load->view('orcamentos/login/footer');
        
    }
    
    public function autentica() {
        
        $identity = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));;
        $remember = FALSE; // remember the user
        
        if ($this->ion_auth->login($identity, $password, $remember)) {
            redirect('orcamentos/home');
        } else {
            
            $this->session->set_flashdata('error', 'Verfique seu e-mail ou senha e tente novamente!');
            redirect('orcamentos/login');
        }
        
//        echo '<pre>';
//        print_r($this->input->post());
//        exit();
        
    }
    
    public function logout() {
        
        $this->ion_auth->logout();
        redirect('orcamentos/home');
        
    }
    
}