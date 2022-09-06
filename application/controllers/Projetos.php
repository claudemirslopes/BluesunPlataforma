<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Projetos extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou, acesse novamente');
            redirect('login');
        }
        
        //Carrega o model diretamente no controller ao invés do autoload
        $this->load->model('projetos_model');
        $this->load->model('home_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Projetos',
            
            'styles' => array(
              'vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
              'vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
            ),
            
            'scripts' => array(
              'vendors/datatables.net/js/jquery.dataTables.min.js', 
              'vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
              
              'vendors/datatables.net/export/dataTables.buttons.min.js',
              'vendors/datatables.net/export/pdfmake.min.js',
              'vendors/datatables.net/export/vfs_fonts.js',
              'vendors/datatables.net/export/buttons.html5.min.js',
                
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
            
            //Usa o model de tickets para dar JOIN nas tabelas
            'projetos' => $this->projetos_model->get_all(),
            
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
        if ($this->home_model->get_tickets_pendentes()) {
            
            $data['ticket_pendente'] = TRUE;
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
//        print_r($data['tickets']);
//        exit();
        
         // Carrega a view de tickets
        $this->load->view('layout/header', $data);
        $this->load->view('projetos/index');
        $this->load->view('layout/footer');
        
    }
    
    public function add() {
        
        $this->form_validation->set_rules('ticket_user_id', 'usuario', 'required');
        $this->form_validation->set_rules('ticket_assunto', 'assunto', 'trim|required|min_length[4]|max_length[80]');
        $this->form_validation->set_rules('ticket_mensagem', 'mensagem', 'trim|required|max_length[500]');
            
           
            if ($this->form_validation->run()) {
                
                $data = elements(

                    array(
                        'ticket_codigo',
                        'ticket_user_id',
                        'ticket_assunto',
                        'ticket_mensagem',
                        'ticket_prioridade',
                        'ticket_status',
                    ), $this->input->post()

            );
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->insert('tickets', $data);
            
            redirect('tickets');
                
            } else {
                
                //Erro de validação
                
                $data = array(
            
                'titulo' => 'Registrar Ticket',
                    
                'ticket_codigo' => $this->core_model->generate_unique_code('tickets', 'numeric', 5, 'ticket_codigo'),
                
                'users' => $this->core_model->get_all('users'),
                    
                // Home
                'soma_vendas' => $this->home_model->get_sum_vendas(),
                'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
                'soma_receber' => $this->home_model->get_sum_receber(),
                'soma_pagar' => $this->home_model->get_sum_pagar(),
                'soma_produtos' => $this->home_model->get_produtos_quantidade(),
                'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
                'top_servicos' => $this->home_model->get_servicos_mais_vendidos(), 

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
            if ($this->home_model->get_tickets_pendentes()) {

                $data['ticket_pendente'] = TRUE;
                $contador_notificacoes ++;
            }
            if ($this->ion_auth->is_admin()) {
               if ($this->home_model->get_tickets_pendentes()) {

                    $data['ticket_pendente'] = TRUE;
                    $contador_notificacoes ++;
                } 
            }


            $data['contador_notificacoes'] = $contador_notificacoes;
            
            // Carrega a view de editar tickets
            $this->load->view('layout/header', $data);
            $this->load->view('tickets/add');
            $this->load->view('layout/footer');
                
            }        
    }
    
    public function edit($ticket_id = NULL) {
        
        if (!$ticket_id || !$this->core_model->get_by_id('tickets', array('ticket_id' => $ticket_id))) {            
            $this->session->set_flashdata('error', 'Ticket não encontrado!');
            redirect('tickets');
        } else {
            
            $this->form_validation->set_rules('ticket_user_id', 'usuario', 'required');
            $this->form_validation->set_rules('ticket_assunto', 'assunto', 'trim|required|min_length[4]|max_length[80]');
            $this->form_validation->set_rules('ticket_mensagem', 'mensagem', 'trim|required|max_length[500]');
            $this->form_validation->set_rules('ticket_resposta', 'resposta', 'trim|required|max_length[500]');
            
//            echo '<pre>';
//            print_r($this->input->post());
//            exit();
            
            if ($this->form_validation->run()) {
                
                $data = elements(

                    array(
                        'ticket_codigo',
                        'ticket_user_id',
                        'ticket_assunto',
                        'ticket_mensagem',
                        'ticket_resposta',
                        'ticket_prioridade',
                        'ticket_status',
                    ), $this->input->post()

            );
            
            // Colocar todo texto em maiúsculo
//            $data['ticket_estado'] = strtoupper($this->input->post('ticket_estado'));
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('tickets', $data, array('ticket_id' => $ticket_id));
            
            redirect('tickets');
                
            } else {
                
                //Erro de validação
                
                $data = array(
            
                'titulo' => 'Atualizar ticket',

                // Home
                'soma_vendas' => $this->home_model->get_sum_vendas(),
                'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
                'soma_receber' => $this->home_model->get_sum_receber(),
                'soma_pagar' => $this->home_model->get_sum_pagar(),
                'soma_produtos' => $this->home_model->get_produtos_quantidade(),
                'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
                'top_servicos' => $this->home_model->get_servicos_mais_vendidos(), 
                
                'users' => $this->core_model->get_all('users'),
                'ticket' => $this->core_model->get_by_id('tickets', array('ticket_id' => $ticket_id)),
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
            if ($this->home_model->get_tickets_pendentes()) {

                $data['ticket_pendente'] = TRUE;
                $contador_notificacoes ++;
            }
            if ($this->ion_auth->is_admin()) {
               if ($this->home_model->get_tickets_pendentes()) {

                    $data['ticket_pendente'] = TRUE;
                    $contador_notificacoes ++;
                } 
            }


            $data['contador_notificacoes'] = $contador_notificacoes;
                
//            $ticket = $data['ticket'] = $this->tickets_model->get_by_id($ticket_id);
//            echo '<pre>';
//            print_r($this->input->post());
//            exit();
            
            // Carrega a view de editar tickets
            $this->load->view('layout/header', $data);
            $this->load->view('tickets/edit');
            $this->load->view('layout/footer');
               
            }
              
        }        
    }
    
    public function del($ticket_id = NULL) {

        if (!$ticket_id || !$this->core_model->get_by_id('tickets', array('ticket_id' => $ticket_id))) {
            $this->session->set_flashdata('error', 'O ticket não foi encontrado');
            redirect('tickets');
        } 
        if ($this->core_model->get_by_id('tickets', array('ticket_id' => $ticket_id, 'ticket_status' => 0))) {
            $this->session->set_flashdata('info', 'Este ticket não pode ser excluído, pois ainda não foi resolvido');
            redirect('tickets');
        } 
        
            $this->core_model->delete('tickets', array('ticket_id' => $ticket_id));
            redirect('tickets');

    }
    
    
}