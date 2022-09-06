<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Contas_receber extends CI_Controller{
    
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
          $this->session->set_flashdata('info', 'Você não tem permissão para acessar o módulo <b>Financeiro</b>');
          redirect('home');
        }
        
        $this->load->model('financeiro_model');
        $this->load->model('home_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Contas a Receber',
            
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
            
            'contas_receber' => $this->financeiro_model->get_all_receber(),
            
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
//        print_r($data['contas_receber']);
//        exit();
        
         // Carrega a view de contas_receber
        $this->load->view('layout/header', $data);
        $this->load->view('contas_receber/index');
        $this->load->view('layout/footer');
        
    }
    
    public function add() {
        
        // formn_validation
            $this->form_validation->set_rules('conta_receber_cliente_id', 'cliente', 'trim|required|max_length[1]');
            $this->form_validation->set_rules('conta_receber_data_vencimento', 'data de vencimento', 'trim|required');
            $this->form_validation->set_rules('conta_receber_valor', 'valor', 'trim|required');
            $this->form_validation->set_rules('conta_receber_obs', 'observação', 'max_length[100]');
            
            if ($this->form_validation->run()) { 
                // Teste para ver se valida
//                exit('Validado');
                
                $data = elements(

                    array(
                        'conta_receber_cliente_id',
                        'conta_receber_data_vencimento',
                        'conta_receber_valor',
                        'conta_receber_status',
                        'conta_receber_obs',
                    ), $this->input->post()

            );
                
            $conta_receber_status = $this->input->post('conta_receber_status');
            
            if ($conta_receber_status == 1) {
                $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
            }
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
//            echo '<pre>';
//            print_r($data);
//            exit();
            
            $this->core_model->insert('contas_receber', $data);
            
            redirect('contas_receber');
            
            } else {
            
            $data = array(
            
                'titulo' => 'Cadastrar Conta a Receber',
                
                'styles' => array(
                    'vendors/select2/select2.min.css',
                    'vendors/autocomplete/jquery-ui.css',
                    'vendors/autocomplete/estilos.css',
                ),

                'scripts' => array (
                    'vendors/autocomplete/jquery-migrate.js', //Nesta ordem
                    'vendors/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendors/calcx/os.js',
                    'vendors/select2/select2.min.js',
                    'vendors/select2/app.js',
                    'vendors/autocomplete/jquery-ui.js',
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

                'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),

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

                // Carrega a view de editar contas_receber
               $this->load->view('layout/header', $data);
               $this->load->view('contas_receber/add');
               $this->load->view('layout/footer');
               
            }
                
    }
    
    public function edit($conta_receber_id = NULL) {
        
        if (!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id))) {            
            $this->session->set_flashdata('error', 'Conta a receber não encontrada!');
            redirect('contas_receber');
        } else {
            
            // formn_validation
            $this->form_validation->set_rules('conta_receber_cliente_id', 'cliente', 'trim|required|max_length[15]');
            $this->form_validation->set_rules('conta_receber_data_vencimento', 'data de vencimento', 'trim|required');
            $this->form_validation->set_rules('conta_receber_valor', 'valor', 'trim|required');
            $this->form_validation->set_rules('conta_receber_obs', 'observação', 'max_length[100]');
            
            if ($this->form_validation->run()) { 
                // Teste para ver se valida
//                exit('Validado');
                
                $data = elements(

                    array(
                        'conta_receber_cliente_id',
                        'conta_receber_data_vencimento',
                        'conta_receber_valor',
                        'conta_receber_status',
                        'conta_receber_obs',
                    ), $this->input->post()

            );
                
            $conta_receber_status = $this->input->post('conta_receber_status');
            
            if ($conta_receber_status == 1) {
                $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
            }
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
//            echo '<pre>';
//            print_r($data);
//            exit();
            
            $this->core_model->update('contas_receber', $data, array('conta_receber_id' => $conta_receber_id));
            
            redirect('contas_receber');
            
            } else {
            
            $data = array(
            
                'titulo' => 'Atualizar Conta a Receber',
                
                'styles' => array(
                    'vendors/select2/select2.min.css',
                    'vendors/autocomplete/jquery-ui.css',
                    'vendors/autocomplete/estilos.css',
                ),

                'scripts' => array (
                    'vendors/autocomplete/jquery-migrate.js', //Nesta ordem
                    'vendors/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendors/calcx/os.js',
                    'vendors/select2/select2.min.js',
                    'vendors/select2/app.js',
                    'vendors/autocomplete/jquery-ui.js',
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

                'conta_receber' => $this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id)),
                'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),

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

                // Carrega a view de editar contas_receber
               $this->load->view('layout/header', $data);
               $this->load->view('contas_receber/edit');
               $this->load->view('layout/footer');
               
            }
            
        }
                
    }
    
    public function del($conta_receber_id = NULL) {

        if (!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id))) {
            $this->session->set_flashdata('error', 'A conta não foi encontrada');
            redirect('contas_receber');
        } 
        if ($this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id, 'conta_receber_status' => 0))) {
            $this->session->set_flashdata('info', 'Esta conta não pode ser excluída, pois ainda está em aberto');
            redirect('contas_receber');
        } 
        
            $this->core_model->delete('contas_receber', array('conta_receber_id' => $conta_receber_id));
            redirect('contas_receber');

    }
    
}