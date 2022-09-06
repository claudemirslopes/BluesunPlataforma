<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Reclamacoes extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou, acesse novamente');
            redirect('login');
        }
        
        $this->load->model('reclamacoes_model');
        $this->load->model('home_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Reclamações',
            
            'styles' => array(
              'vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
              'vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
            ),
            
            'scripts' => array(
              'vendors/datatables.net/js/jquery.dataTables.min.js', 
              'vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
              'vendors/datatables.net-bs4/js/app.js',
              'vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
              'vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',
              'vendors/datatables.net-buttons/js/buttons.html5.min.js',
              'vendors/datatables.net-buttons/js/buttons.print.min.js',
              'vendors/datatables.net-buttons/js/buttons.colVis.min.js',
              'assets/js/init-scripts/data-table/datatables-init.js',  
            ),
            
            // Home
            'soma_vendas' => $this->home_model->get_sum_vendas(),
            'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
            'soma_receber' => $this->home_model->get_sum_receber(),
            'soma_pagar' => $this->home_model->get_sum_pagar(),
            'soma_produtos' => $this->home_model->get_produtos_quantidade(),
            'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
            'top_servicos' => $this->home_model->get_servicos_mais_vendidos(), 
            
            'reclamacoes' => $this->reclamacoes_model->get_all(),
            
        );
        
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
        
//        echo '<pre>';
//        print_r($data['categorias']);
//        exit();
        
         // Carrega a view de categorias
        $this->load->view('layout/header', $data);
        $this->load->view('reclamacoes/index');
        $this->load->view('layout/footer');
        
    }
    
    public function edit($reclama_id = NULL) {
        
        if (!$reclama_id || !$this->core_model->get_by_id('reclamacoes', array('reclama_id' => $reclama_id))) {            
            $this->session->set_flashdata('error', 'Reclamação não encontrada!');
            redirect('reclamacoes');
        } else {
            
            $this->form_validation->set_rules('reclama_orc_id', 'codigo', 'required');
            $this->form_validation->set_rules('reclama_cli_id', 'autorizado', 'required');
            $this->form_validation->set_rules('reclama_obs', 'reclamação', 'trim|required|max_length[500]');
            $this->form_validation->set_rules('reclama_retorno_obs', 'resposta', 'trim|required|max_length[500]');
            
//            echo '<pre>';
//            print_r($this->input->post());
//            exit();
            
            if ($this->form_validation->run()) {
                
                $data = elements(

                    array(
                        'reclama_orc_id',
                        'reclama_cli_id',
                        'reclama_obs',
                        'reclama_tipo',
                        'reclama_retorno_obs',
                        'reclama_status',
                    ), $this->input->post()

            );
            
            // Colocar todo texto em maiúsculo
//            $data['reclama_estado'] = strtoupper($this->input->post('reclama_estado'));
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('reclamacoes', $data, array('reclama_id' => $reclama_id));
            
            redirect('reclamacoes');
                
            } else {
                
                //Erro de validação
                
                $data = array(
            
                'titulo' => 'Atualizar reclamação',

                'scripts' => array (
                    'vendors/mask/jquery_3.2.1.min.js',
                    'vendors/mask/jquery.mask.min.js',
                    'vendors/mask/app.js',
                ),

                // Home
                'soma_vendas' => $this->home_model->get_sum_vendas(),
                'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
                'soma_receber' => $this->home_model->get_sum_receber(),
                'soma_pagar' => $this->home_model->get_sum_pagar(),
                'soma_produtos' => $this->home_model->get_produtos_quantidade(),
                'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
                'top_servicos' => $this->home_model->get_servicos_mais_vendidos(), 
                
                'clientes' => $this->core_model->get_all('clientes'),
                'orcamentos' => $this->core_model->get_all('orcamentos'),
                'reclama' => $this->core_model->get_by_id('reclamacoes', array('reclama_id' => $reclama_id)),
            );
                
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
                
//            $reclama = $data['reclama'] = $this->reclamacoes_model->get_by_id($reclama_id);
//            echo '<pre>';
//            print_r($this->input->post());
//            exit();
            
            // Carrega a view de editar reclamacoes
            $this->load->view('layout/header', $data);
            $this->load->view('reclamacoes/edit');
            $this->load->view('layout/footer');
               
            }
              
        }        
    }
    
    public function del($reclama_id = NULL) {

        if (!$reclama_id || !$this->core_model->get_by_id('reclamacoes', array('reclama_id' => $reclama_id))) {
            $this->session->set_flashdata('error', 'A reclamação não foi encontrada');
            redirect('reclamacoes');
        } 
        if ($this->core_model->get_by_id('reclamacoes', array('reclama_id' => $reclama_id, 'reclama_status' => 0))) {
            $this->session->set_flashdata('info', 'Esta reclamação não pode ser excluída, pois ainda não foi resolvida');
            redirect('reclamacoes');
        } 
        
            $this->core_model->delete('reclamacoes', array('reclama_id' => $reclama_id));
            redirect('reclamacoes');

    }
    
}