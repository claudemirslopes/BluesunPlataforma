<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Sistema extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou, acesse novamente');
            redirect('login');
        }
        
        # multiple groups (by name)
        $group = array(1, 3);
        if (!$this->ion_auth->in_group($group)) {
          $this->session->set_flashdata('info', 'Você não tem permissão para acessar o módulo de <b>Configuração do Sistema</b>');
          redirect('home');
        }
        
        $this->load->model('home_model');
        
    }
    
    public function index() {
        
        $data = array (
            'titulo' => 'Editar Sistema',
            
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
            
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );
        
        
        $this->form_validation->set_rules('sistema_razao_social', 'razão social', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia', 'nome fantasia', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', 'IE', 'max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo', 'telefone fixo', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_movel', 'telefone móvel', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_email', 'e-mail', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url', 'site', 'required|valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'required|exact_length[10]');
        $this->form_validation->set_rules('sistema_endereco', 'endereço', 'required|max_length[145]');
        $this->form_validation->set_rules('sistema_numero', 'nº', 'max_length[10]');
        $this->form_validation->set_rules('sistema_cidade', 'cidade', 'required|max_length[45]');
        $this->form_validation->set_rules('sistema_estado', 'UF', 'required|exact_length[2]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', 'Texto ao cliente', 'max_length[500]');
        
        
        if ($this->form_validation->run()) {
            
            /*
                [sistema_razao_social] => Engemetal Comercio e Manutencao LTDA
                [sistema_nome_fantasia] => Bluesun Solar do Brasil
                [sistema_cnpj] => 10.383.997/0001-60
                [sistema_ie] => 
                [sistema_telefone_fixo] => (19) 3441-4291
                [sistema_telefone_movel] => (19) 98364-2927
                [sistema_email] => contato@bluesundobrasil.com.br
                [sistema_site_url] => https://bluesundobrasil.com.br/
                [sistema_cep] => 13.480-309
                [sistema_endereco] => Av. Vitorino Arigone, Jardim Santa Barbara
                [sistema_numero] => 450
                [sistema_cidade] => Limeira
                [sistema_estado] => SP
                [sistema_txt_ordem_servico] => 
             */
            
//            echo '<pre>';
//            print_r($this->input->post());
//            exit();
            
            $data = elements(

                    array(
                        'sistema_razao_social',
                        'sistema_nome_fantasia',
                        'sistema_cnpj',
                        'sistema_ie',
                        'sistema_telefone_fixo',
                        'sistema_telefone_movel',
                        'sistema_email',
                        'sistema_site_url',
                        'sistema_cep',
                        'sistema_endereco',
                        'sistema_numero',
                        'sistema_cidade',
                        'sistema_estado',
                        'sistema_txt_ordem_servico',
                    ), $this->input->post()

            );
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('sistema', $data, array('sistema_id' => 1));
            
            redirect('sistema');
            
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
        
        $this->load->view('layout/header', $data);
        $this->load->view('sistema/index');
        $this->load->view('layout/footer');
        
        }
        
    }
    
}