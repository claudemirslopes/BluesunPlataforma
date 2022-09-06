<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Orcamentos extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->session->userdata('logado')) {
            redirect(base_url('orcamentos/login'));
        }
        
        $this->load->model('orcamentos/home_model');
//        $this->load->model('orcamentos_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Orçamentos',
            
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
            'orc_realizados' => $this->home_model->get_orcamentos_realizados(), 
            
            'orcamentos' => $this->core_model->get_all('orcamentos'),
            
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
//        print_r($data['avisados']);
//        exit();
        
         // Carrega a view de avisados
        $this->load->view('orcamentos/layout/header', $data);
        $this->load->view('orcamentos/orcamentos/index');
        $this->load->view('orcamentos/layout/footer');
        
    }
    
    public function add_p1() {

        $this->form_validation->set_rules('orc_cli_nome', 'nome', 'trim|required|min_length[4]|max_length[45]');
        $orc_cli_pessoa = $this->input->post('orc_cli_pessoa');
        if ($orc_cli_pessoa == 1) {
            $this->form_validation->set_rules('orc_cli_cpf', 'CPF', 'trim|required|min_length[14]|max_length[14]|is_unique[orcamentos.orc_cli_cpf_cnpj]|callback_valida_cpf');
        } else {
            $this->form_validation->set_rules('orc_cli_cnpj', 'CNPJ', 'trim|required|min_length[18]|max_length[18]|is_unique[orcamentos.orc_cli_cpf_cnpj]|callback_valida_cnpj');
        }
        $this->form_validation->set_rules('orc_cli_uniconsum', 'Unidade Consumidora', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('orc_cli_email', 'e-mail', 'trim|required|valid_email|max_length[50]|is_unique[orcamentos.orc_cli_email]');            
        if ($this->input->post('orc_cli_telcel')) {
            $this->form_validation->set_rules('orc_cli_telcel', 'telefone/fixo', 'trim|max_length[15]|is_unique[orcamentos.orc_cli_telcel]');
        }
        $this->form_validation->set_rules('orc_cli_cep', 'CEP', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('orc_cli_endereco', 'endereço', 'trim|required|max_length[155]');
        $this->form_validation->set_rules('orc_cli_numero', 'número', 'trim|max_length[10]');
        $this->form_validation->set_rules('orc_cli_bairro', 'bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('orc_cli_complemento', 'complemento', 'trim|max_length[145]');
        $this->form_validation->set_rules('orc_cli_cidade', 'cidade', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('orc_cli_estado', 'estado', 'trim|required|exact_length[2]');

        if ($this->form_validation->run()) { 
            // Teste para ver se valida
//                exit('Validado');

            $data = elements(

                array(
                    'orc_id',
                    'orc_codigo',
                    'orc_cli_cliente_id',
                    'orc_cli_pessoa',
                    'orc_cli_uniconsum',
                    'orc_cli_nome',
                    'orc_cli_email',
                    'orc_cli_telcel',
                    'orc_cli_cep',
                    'orc_cli_endereco',
                    'orc_cli_numero',
                    'orc_cli_bairro',
                    'orc_cli_complemento',
                    'orc_cli_cidade',
                    'orc_cli_estado',
                    'orc_status',
                ), $this->input->post()

        );

        if ($orc_cli_pessoa == 1) {
            $data['orc_cli_cpf_cnpj'] = $this->input->post('orc_cli_cpf');
        } else {
            $data['orc_cli_cpf_cnpj'] = $this->input->post('orc_cli_cnpj');
        }          $data['orc_cli_estado'] = strtoupper($this->input->post('orc_cli_estado'));

        // Limpar dados maliciosos
        $data = html_escape($data);

//        $this->core_model->insert('orcamentos', $data);
        
            if($this->db->insert('orcamentos', $data)) {
                $inserted_id = $this->db->insert_id();
                redirect ('orcamentos/orcamentos/add_p2/'.$inserted_id);
            }

        } else {

            // Erro de validação
            $data = array(

            'titulo' => 'Criar Orçamento - Passo 1',
                
            'orc_codigo' => $this->core_model->generate_unique_code('orcamentos', 'numeric', 16, 'orc_codigo'),

            'scripts' => array (
                'vendors/mask/jquery_3.2.1.min.js',
                'vendors/mask/jquery.maskedinput.min.js',
                'assets/js/clientes.js',
            ),
                
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
        if ($this->home_model->get_contas_pagar_vencidas()) {
            
            $data['contas_pagar_vencidas'] = TRUE;
            $contador_notificacoes ++;
        } 
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

            // Carrega a view de editar clientes
           $this->load->view('orcamentos/layout/header', $data);
           $this->load->view('orcamentos/orcamentos/add_p1');
           $this->load->view('orcamentos/layout/footer');

        }        

    }
    
    public function add_p2($orc_id = NULL) {
            
        if (!$orc_id || !$this->core_model->get_by_id('orcamentos', array('orc_id' => $orc_id))) {            
            $this->session->set_flashdata('error', 'Orçamento não encontrado!');
            redirect('orcamentos/orcamentos');
            
        } else {
            
        $orc_tipo_grupo = $this->input->post('orc_tipo_grupo');
        if ($orc_tipo_grupo == 'A') {
            $this->form_validation->set_rules('orc_demanda_contratada', 'Demanda contratada', 'trim|required');
            $this->form_validation->set_rules('orc_consumo_ponta', 'Consumo ponta', 'trim|required');
            $this->form_validation->set_rules('orc_consumo_fora_ponta', 'Consumo fora de ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_ponta', 'Valor KW ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_fora_ponta', 'Valor KW fora de ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_conta', 'Valor da conta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_demanda_contratada', 'Valor da demanda', 'trim|required');
        } else {
            $this->form_validation->set_rules('orc_consumo_mes1', 'Consumo do mês 1', 'trim|required');
            $this->form_validation->set_rules('orc_consumo_mes2', 'Consumo do mês 2');
            $this->form_validation->set_rules('orc_consumo_mes3', 'Consumo do mês 3');
            $this->form_validation->set_rules('orc_consumo_mes4', 'Consumo do mês 4');
            $this->form_validation->set_rules('orc_consumo_mes5', 'Consumo do mês 5');
            $this->form_validation->set_rules('orc_consumo_mes6', 'Consumo do mês 6');
            $this->form_validation->set_rules('orc_consumo_mes7', 'Consumo do mês 7');
            $this->form_validation->set_rules('orc_consumo_mes8', 'Consumo do mês 8');
            $this->form_validation->set_rules('orc_consumo_mes9', 'Consumo do mês 9');
            $this->form_validation->set_rules('orc_consumo_mes10', 'Consumo do mês 10');
            $this->form_validation->set_rules('orc_consumo_mes11', 'Consumo do mês 11');
            $this->form_validation->set_rules('orc_consumo_mes12', 'Consumo do mês 12');
            $this->form_validation->set_rules('orc_consumo_mes13', 'Consumo do mês 13');
        }
            
            if ($this->form_validation->run()) { 
                
                if ($orc_tipo_grupo == 'A') {
                $data = elements(
                    
                    array(
                        'orc_tipo_grupo',
                        'orc_demanda_contratada',
                        'orc_consumo_ponta',
                        'orc_consumo_fora_ponta',
                        'orc_valor_kw_ponta',
                        'orc_valor_kw_fora_ponta',
                        'orc_valor_conta',
                        'orc_valor_demanda_contratada',
                    ), $this->input->post()

            );
                } else {
                    
                    $data = elements(
                    
                    array(
                        'orc_tipo_grupo',
                        'orc_consumo_mes1',
                        'orc_consumo_mes2',
                        'orc_consumo_mes3',
                        'orc_consumo_mes4',
                        'orc_consumo_mes5',
                        'orc_consumo_mes6',
                        'orc_consumo_mes7',
                        'orc_consumo_mes8',
                        'orc_consumo_mes9',
                        'orc_consumo_mes10',
                        'orc_consumo_mes11',
                        'orc_consumo_mes12',
                        'orc_consumo_mes13',
                    ), $this->input->post()

            );
                    
                }
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('orcamentos', $data, array('orc_id' => $orc_id));
            
            redirect('orcamentos/orcamentos/add_p3/'.$orc_id);
            
            } else {
                
                // Erro de validação
                $data = array(
            
                'titulo' => 'Criar Orçamento - Passo 2',

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

                'orcamento' => $this->core_model->get_by_id('orcamentos', array('orc_id' => $orc_id)),

            );
                
            //CENTRAL DE NOTIFICAÇÕES
            $contador_notificacoes = 0;
            if ($this->home_model->get_contas_receber_vencidas()) {

                $data['contas_receber_vencidas'] = TRUE;
                $contador_notificacoes ++;
            }
            if ($this->home_model->get_contas_pagar_vencidas()) {

                $data['contas_pagar_vencidas'] = TRUE;
                $contador_notificacoes ++;
            } 
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

                // Carrega a view de editar clientes_franqueados
               $this->load->view('orcamentos/layout/header', $data);
               $this->load->view('orcamentos/orcamentos/add_p2');
               $this->load->view('orcamentos/layout/footer');
                
            }
            
        }
        
        
    }
    
    public function add_p3($orc_id = NULL) {
              
        if (!$orc_id || !$this->core_model->get_by_id('orcamentos', array('orc_id' => $orc_id))) {            
            $this->session->set_flashdata('error', 'Orçamento não encontrado!');
            redirect('orcamentos/orcamentos');
        } else {
            
        $orc_tipo_grupo = $this->input->post('orc_tipo_grupo');
        if ($orc_tipo_grupo == 'A') {
            $this->form_validation->set_rules('orc_demanda_contratada', 'Demanda contratada', 'trim|required');
            $this->form_validation->set_rules('orc_consumo_ponta', 'Consumo ponta', 'trim|required');
            $this->form_validation->set_rules('orc_consumo_fora_ponta', 'Consumo fora de ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_ponta', 'Valor KW ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_fora_ponta', 'Valor KW fora de ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_conta', 'Valor da conta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_demanda_contratada', 'Valor da demanda', 'trim|required');
            $this->form_validation->set_rules('orc_irradiacao_local_dia', 'Irradiação no local', 'trim|required');
            $this->form_validation->set_rules('orc_inclinacao_ideal', 'Inclinação ideal', 'trim|required');
            $this->form_validation->set_rules('orc_valor_perda', 'Valor da perda', 'trim|required');
            $this->form_validation->set_rules('orc_concessionaria', 'Concessionária', 'trim|required');
            $this->form_validation->set_rules('orc_tipo_estrutura', 'Tipo de estrutura', 'trim|required');
            $this->form_validation->set_rules('orc_id_painel', 'Painel', 'trim|required');
            
            
        } else {
            $this->form_validation->set_rules('orc_consumo_mes_media', 'Consumo do mês média', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_atual', 'Valor do KW atual');
            $this->form_validation->set_rules('orc_irradiacao_local_dia', 'Irradiação local');
            $this->form_validation->set_rules('orc_inclinacao_ideal', 'Consumo do mês 4');
            $this->form_validation->set_rules('orc_valor_perda', 'Inclinação ideal');
            $this->form_validation->set_rules('orc_tipo_contrato', 'Tipo de contrato');
            $this->form_validation->set_rules('orc_tensao', 'Tensão');
            $this->form_validation->set_rules('orc_concessionaria', 'Concessionária');
            $this->form_validation->set_rules('orc_tipo_estrutura', 'Tipo de estrutura');
            $this->form_validation->set_rules('orc_id_painel', 'Painel');
        }
            
            if ($this->form_validation->run()) { 
                
                if ($orc_tipo_grupo == 'A') {
                $data = elements(
                    
                    array(
                        'orc_tipo_grupo',
                        'orc_demanda_contratada',
                        'orc_consumo_ponta',
                        'orc_consumo_fora_ponta',
                        'orc_valor_kw_ponta',
                        'orc_valor_kw_fora_ponta',
                        'orc_valor_conta',
                        'orc_valor_demanda_contratada',
                        'orc_irradiacao_local_dia',
                        'orc_inclinacao_ideal',
                        'orc_valor_perda',
                        'orc_concessionaria',
                        'orc_tipo_estrutura',
                        'orc_id_painel',
                        
                    ), $this->input->post()

            );
                } else {
                    
                    $data = elements(
                    
                    array(
                        'orc_tipo_grupo',
                        'orc_consumo_mes_media',
                        'orc_valor_kw_atual',
                        'orc_irradiacao_local_dia',
                        'orc_inclinacao_ideal',
                        'orc_valor_perda',
                        'orc_tipo_contrato',
                        'orc_tensao',
                        'orc_concessionaria',
                        'orc_tipo_estrutura',
                        'orc_id_painel',
                    ), $this->input->post()

            );
                    
                }
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('orcamentos', $data, array('orc_id' => $orc_id));
            
            redirect('orcamentos/orcamentos/add_p4/'.$orc_id);
            
            } else {
                
                // Erro de validação
                $data = array(
            
                'titulo' => 'Criar Orçamento - Passo 3',

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

                'orcamento' => $this->core_model->get_by_id('orcamentos', array('orc_id' => $orc_id)),

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
                
//                echo '<pre>';
//                print_r($data['cliente']);
//                exit(); 

                // Carrega a view de editar clientes_franqueados
               $this->load->view('orcamentos/layout/header', $data);
               $this->load->view('orcamentos/orcamentos/add_p3');
               $this->load->view('orcamentos/layout/footer');
                
            }
            
        }
               
    }
    
    public function add_p4($orc_id = NULL) {
              
        if (!$orc_id || !$this->core_model->get_by_id('orcamentos', array('orc_id' => $orc_id))) {            
            $this->session->set_flashdata('error', 'Orçamento não encontrado!');
            redirect('orcamentos/orcamentos');
        } else {
            
        $orc_tipo_grupo = $this->input->post('orc_tipo_grupo');
        if ($orc_tipo_grupo == 'A') {
            $this->form_validation->set_rules('orc_demanda_contratada', 'Demanda contratada', 'trim|required');
            $this->form_validation->set_rules('orc_consumo_ponta', 'Consumo ponta', 'trim|required');
            $this->form_validation->set_rules('orc_consumo_fora_ponta', 'Consumo fora de ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_ponta', 'Valor KW ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_fora_ponta', 'Valor KW fora de ponta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_conta', 'Valor da conta', 'trim|required');
            $this->form_validation->set_rules('orc_valor_demanda_contratada', 'Valor da demanda', 'trim|required');
            $this->form_validation->set_rules('orc_irradiacao_local_dia', 'Irradiação no local', 'trim|required');
            $this->form_validation->set_rules('orc_inclinacao_ideal', 'Inclinação ideal', 'trim|required');
            $this->form_validation->set_rules('orc_valor_perda', 'Valor da perda', 'trim|required');
            $this->form_validation->set_rules('orc_concessionaria', 'Concessionária', 'trim|required');
            $this->form_validation->set_rules('orc_tipo_estrutura', 'Tipo de estrutura', 'trim|required');
            $this->form_validation->set_rules('orc_id_painel', 'Painel', 'trim|required');
            
            
        } else {
            $this->form_validation->set_rules('orc_consumo_mes_media', 'Consumo do mês média', 'trim|required');
            $this->form_validation->set_rules('orc_valor_kw_atual', 'Valor do KW atual');
            $this->form_validation->set_rules('orc_irradiacao_local_dia', 'Irradiação local');
            $this->form_validation->set_rules('orc_inclinacao_ideal', 'Consumo do mês 4');
            $this->form_validation->set_rules('orc_valor_perda', 'Inclinação ideal');
            $this->form_validation->set_rules('orc_tipo_contrato', 'Tipo de contrato');
            $this->form_validation->set_rules('orc_tensao', 'Tensão');
            $this->form_validation->set_rules('orc_concessionaria', 'Concessionária');
            $this->form_validation->set_rules('orc_tipo_estrutura', 'Tipo de estrutura');
            $this->form_validation->set_rules('orc_id_painel', 'Painel');
        }
            
            if ($this->form_validation->run()) { 
                
                if ($orc_tipo_grupo == 'A') {
                $data = elements(
                    
                    array(
                        'orc_tipo_grupo',
                        'orc_demanda_contratada',
                        'orc_consumo_ponta',
                        'orc_consumo_fora_ponta',
                        'orc_valor_kw_ponta',
                        'orc_valor_kw_fora_ponta',
                        'orc_valor_conta',
                        'orc_valor_demanda_contratada',
                        'orc_irradiacao_local_dia',
                        'orc_inclinacao_ideal',
                        'orc_valor_perda',
                        'orc_concessionaria',
                        'orc_tipo_estrutura',
                        'orc_id_painel',
                        
                    ), $this->input->post()

            );
                } else {
                    
                    $data = elements(
                    
                    array(
                        'orc_tipo_grupo',
                        'orc_consumo_mes_media',
                        'orc_valor_kw_atual',
                        'orc_irradiacao_local_dia',
                        'orc_inclinacao_ideal',
                        'orc_valor_perda',
                        'orc_tipo_contrato',
                        'orc_tensao',
                        'orc_concessionaria',
                        'orc_tipo_estrutura',
                        'orc_id_painel',
                    ), $this->input->post()

            );
                    
                }
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('orcamentos', $data, array('orc_id' => $orc_id));
            
            redirect('orcamentos/orcamentos/add_p5/'.$orc_id);
            
            } else {
                
                // Erro de validação
                $data = array(
            
                'titulo' => 'Criar Orçamento - Conclusão',
                    
                'styles' => array (
                    'vendors/selectFX/css/cs-skin-elastic.css',
                    'vendors/chosen/chosen.min.css',
                ),
                    
                'scripts' => array (
                    'vendors/mask/jquery_3.2.1.min.js',
                    'vendors/mask/jquery.maskedinput.min.js',
                    'vendors/chosen/chosen.jquery.min.js',
                ),
                    
                // Home
                'soma_vendas' => $this->home_model->get_sum_vendas(),
                'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
                'soma_receber' => $this->home_model->get_sum_receber(),
                'soma_pagar' => $this->home_model->get_sum_pagar(),
                'soma_produtos' => $this->home_model->get_produtos_quantidade(),
                'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
                'top_servicos' => $this->home_model->get_servicos_mais_vendidos(), 

                'orcamento' => $this->core_model->get_by_id('orcamentos', array('orc_id' => $orc_id)),

            );
                
            //CENTRAL DE NOTIFICAÇÕES
            $contador_notificacoes = 0;
            if ($this->home_model->get_contas_receber_vencidas()) {

                $data['contas_receber_vencidas'] = TRUE;
                $contador_notificacoes ++;
            } 
            if ($this->home_model->get_contas_pagar_vencidas()) {

                $data['contas_pagar_vencidas'] = TRUE;
                $contador_notificacoes ++;
            } 
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

                // Carrega a view de editar clientes_franqueados
               $this->load->view('orcamentos/layout/header', $data);
               $this->load->view('orcamentos/orcamentos/add_p4');
               $this->load->view('orcamentos/layout/footer');
                
            }
            
        }
               
    }
    
    public function check_email($orc_cli_email) {
        
        $orc_cli_id = $this->input->post('orc_cli_id');
        
        if ($this->core_model->get_by_id('orcamentos', array('orc_cli_email' => $orc_cli_email, 'orc_cli_id !=' => $orc_cli_id))) {
            $this->form_validation->set_message('check_email', 'Este e-mail já está cadatrado na base de dados');
            return FALSE;
        } else {
            return TRUE;
        }
        
    }
    
    public function check_telcel($orc_cli_telcel) {
        
        $orc_cli_id = $this->input->post('orc_cli_id');
        
        if ($this->core_model->get_by_id('orcamentos', array('orc_cli_telcel' => $orc_cli_telcel, 'orc_cli_id !=' => $orc_cli_id))) {
            $this->form_validation->set_message('check_telcel', 'Este telefone/celualar já está cadatrado na base de dados');
            return FALSE;
        } else {
            return TRUE;
        }
        
    }
    
    public function valida_cnpj($cnpj) {

        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('orc_cli_id')) {

            $orc_cli_id = $this->input->post('orc_cli_id');

            if ($this->core_model->get_by_id('orcamentos', array('orc_cli_id !=' => $orc_cli_id, 'orc_cli_cpf_cnpj' => $cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');
                return FALSE;
            }
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);


        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cnpj{$i} * $k);

                //$soma2 = intval($soma2) + ($cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($cnpj{12} == $digito1) and ( $cnpj{13} == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
                return false;
            } else {
                return true;
            }
        }
    }
    
    public function valida_cpf($cpf) {

        if ($this->input->post('orc_cli_id')) {

            $orc_cli_id = $this->input->post('orc_cli_id');

            if ($this->core_model->get_by_id('orcamentos', array('orc_cli_id !=' => $orc_cli_id, 'orc_cli_cpf_cnpj' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
                return FALSE;
            }
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {

                    $d += $cpf[$c] * (($t + 1) - $c); 
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }
    
}