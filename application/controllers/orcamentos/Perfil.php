<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Perfil extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->session->userdata('logado')) {
            redirect(base_url('orcamentos/login'));
        }
        
        $this->load->model('orcamentos/home_model');
        
    }
    
    public function index() {
        
        $data = array (
            'titulo' => 'Perfil',
            
            'scripts' => array (
                'vendors/mask/jquery_3.2.1.min.js',
                'vendors/mask/jquery.maskedinput.min.js',
            ),
            
            // Home
            'soma_vendas' => $this->home_model->get_sum_vendas(),
            'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
            'soma_receber' => $this->home_model->get_sum_receber(),
            'soma_pagar' => $this->home_model->get_sum_pagar(),
            'soma_produtos' => $this->home_model->get_produtos_quantidade(),
            'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
            'top_servicos' => $this->home_model->get_servicos_mais_vendidos(), 
            
            'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $this->session->userdata('userlogado')->cliente_id)),
        );       
        
            $this->form_validation->set_rules('cliente_responsavel', 'responsável', 'trim|required|min_length[4]|max_length[250]');
            $this->form_validation->set_rules('cliente_user', 'Usuário', 'min_length[3]');
            $this->form_validation->set_rules('cliente_senha', 'Senha', 'min_length[5]');
            $this->form_validation->set_rules('cliente_senha_repete', 'Confirmar Senha', 'matches[cliente_senha]');
        
        
        if ($this->form_validation->run()) {
            
            $data = elements(

                    array(
                        'cliente_responsavel',
                        'cliente_user',
                        'cliente_senha',
                    ), $this->input->post()

            );
            
            $data['cliente_senha'] = sha1($this->input->post('cliente_senha'));
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $password = $this->input->post('cliente_senha');
            if (!$password) { 
                unset($data['cliente_senha']);
            }
            
            $this->core_model->update('clientes', $data, array('cliente_id' => $this->session->userdata('userlogado')->cliente_id));
            
            redirect('orcamentos/perfil');
            
        } else {
            
        //CENTRAL DE NOTIFICAÇÕES
        $contador_notificacoes = 0;
        if ($this->home_model->get_contas_receber_vencidas()) {
            
            $data['contas_receber_vencidas'] = TRUE;
            $contador_notificacoes ++;
        } 
//        else {
//            $data['contas_receber_vencidas'] = FALSE;
//        }
        if ($this->home_model->get_contas_pagar_vencidas()) {
            
            $data['contas_pagar_vencidas'] = TRUE;
            $contador_notificacoes ++;
        } 
//        else {
//            $data['contas_pagar_vencidas'] = FALSE;
//        }
        if ($this->home_model->get_contas_pagar_vencem_hoje()) {
            
            $data['contas_pagar_vence_hoje'] = TRUE;
            $contador_notificacoes ++;
        }
        if ($this->home_model->get_contas_receber_vencem_hoje()) {
            
            $data['contas_receber_vence_hoje'] = TRUE;
            $contador_notificacoes ++;
        }
        if ($this->home_model->get_usuarios_desativados()) {
            
            $data['usuarios_desativados'] = TRUE;
            $contador_notificacoes ++;
        }
        if ($this->home_model->get_produtos_sem_estoque()) {
            
            $data['produto_sem_estoque'] = TRUE;
            $contador_notificacoes ++;
        }
        if ($this->home_model->get_reclamacoes_pendentes()) {
            
            $data['reclama_pendente'] = TRUE;
            $contador_notificacoes ++;
        }
        if ($this->ion_auth->is_admin()) {
           if ($this->home_model->get_tickets_pendentes()) {
            
                $data['ticket_pendente'] = TRUE;
                $contador_notificacoes ++;
            } 
        }
        
      
        $data['contador_notificacoes'] = $contador_notificacoes;
            
        // Erro de validação
        
        $this->load->view('orcamentos/layout/header', $data);
        $this->load->view('orcamentos/perfil/index');
        $this->load->view('orcamentos/layout/footer');
        
        }
        
    }
    
}