<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Usuarios extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
    }
    
//    public function index() {
//        
//        //Dados para serem enviados para o cabeçalho
//        $dados['titulo'] = 'Painel de Controle';
//        $dados['subtitulo'] = 'Home';
//        
//        $this->load->view('blog/backend/template/html-header', $dados);
//        $this->load->view('blog/backend/template/template');
//        $this->load->view('blog/backend/home');
//        $this->load->view('blog/backend/template/html-footer');
//        
//    }
    
    public function pag_login() {
        
        //Dados para serem enviados para o cabeçalho
        $dados['titulo'] = 'Login Franquias';
        
        $this->load->view('orcamentos/login/header', $dados);
        $this->load->view('orcamentos/login/index');
        $this->load->view('orcamentos/login/footer');
        
    }
    
    // Sessão de login do Orçamentos
    public function login() {
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txt-user', 'E-mail',
                'required|min_length[3]');
        $this->form_validation->set_rules('txt-senha', 'Senha',
                'required|min_length[3]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->pag_login();
        } else {
            $usuario = $this->input->post('txt-user');
            $senha = sha1($this->input->post('txt-senha'));
            
            $this->db->where('cliente_email', $usuario);
            $this->db->where('cliente_senha', $senha);
            
            $userlogado = $this->db->get('clientes')->result();
            
            if (count($userlogado) == 1) {
                $dadosSessao['userlogado'] = $userlogado[0];
                $dadosSessao['logado'] = TRUE;
                
                $this->session->set_userdata($dadosSessao);
                redirect(base_url('orcamentos/home'));
            } else {
                $dadosSessao['userlogado'] = NULL;
                $dadosSessao['logado'] = FALSE;
                
                $this->session->set_userdata($dadosSessao);
                redirect(base_url('orcamentos/login'));
            }
        }
        
    }
    
    public function logout() {
        $dadosSessao['userlogado'] = NULL;
        $dadosSessao['logado'] = FALSE;

        $this->session->set_userdata($dadosSessao);
        redirect(base_url('orcamentos/login'));
    }
    
}
