<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Ordem_servicos extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou, acesse novamente');
            redirect('login');
        }
        
        $this->load->model('ordem_servicos_model');
        $this->load->model('home_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Ordem de Serviços',
            
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
            
            'ordens_servicos' => $this->ordem_servicos_model->get_all(),
            
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
//        print_r($data['ordens_servicos']);
//        exit();
        
         // Carrega a view de servicos
        $this->load->view('layout/header', $data);
        $this->load->view('ordem_servicos/index');
        $this->load->view('layout/footer');
        
    }
    
    public function add() {
        
        $this->form_validation->set_rules('ordem_servico_cliente_id', 'cliente', 'required');
        $this->form_validation->set_rules('ordem_servico_equipamento', 'equipamento', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'marca', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'modelo', 'trim|required|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_acessorios', 'acessórios', 'required|max_length[300]');
        $this->form_validation->set_rules('ordem_servico_defeito', 'defeito', 'required|max_length[700]');
        $this->form_validation->set_rules('ordem_servico_obs', 'cliente', 'max_length[500]');
                        
            if ($this->form_validation->run()) {
                
//                echo '<pre>';
//                print_r($this->input->post());
//                exit();
                
                $ordem_servico_valor_total = str_replace('R$',"", trim($this->input->post('ordem_servico_valor_total')));
                
                $data = elements(

                    array(
                        'ordem_servico_pedido',
                        'ordem_servico_cliente_id',
                        'ordem_servico_status',
                        'ordem_servico_equipamento',
                        'ordem_servico_marca_equipamento',
                        'ordem_servico_modelo_equipamento',
                        'ordem_servico_acessorios',
                        'ordem_servico_defeito',
                        'ordem_servico_obs',
                        'ordem_servico_valor_desconto',
                        'ordem_servico_valor_total',
                    ), $this->input->post()
            );
                
            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/','',$ordem_servico_valor_total));
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->insert('ordens_servicos', $data, TRUE);
            
            //RECUPERAR ID
            $id_ordem_servico = $this->session->userdata('last_id');
                        
            $servico_id = $this->input->post('servico_id');
            $servico_quantidade = $this->input->post('servico_quantidade');
            $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
            $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
            $servico_item_total = str_replace('%', '', $this->input->post('servico_item_total'));
            
            $servico_preco = str_replace(',', '', $servico_preco);
            $servico_item_total = str_replace(',', '', $servico_item_total);
            
            $qty_servico = count($servico_id);
            
            $ordem_servico_id = $this->input->post('ordem_servico_id');
            
            for ($i = 0; $i < $qty_servico; $i++) {
                $data = array(
                    'ordem_ts_id_ordem_servico' => $id_ordem_servico,
                    'ordem_ts_id_servico' => $servico_id[$i],
                    'ordem_ts_quantidade' => $servico_quantidade[$i],
                    'ordem_ts_valor_unitario' => $servico_preco[$i],
                    'ordem_ts_valor_desconto' => $servico_desconto[$i],
                    'ordem_ts_valor_total' => $servico_item_total[$i],
                );
                
                $data = html_escape($data);
                
                $this->core_model->insert('ordem_tem_servicos', $data);
            }
            
            // Criar recurso PDF
            
            redirect('os/imprimir/' . $id_ordem_servico);
                
            } else {
                //Erro de validação
                $data = array(
            
                'titulo' => 'Cadastrar Ordem de servico',
                    
                'styles' => array(
                    'vendors/select2/select2.min.css',
                    'vendors/autocomplete/jquery-ui.css',
                    'vendors/autocomplete/estilo.css',
                ),

                'scripts' => array (
                    'vendors/autocomplete/jquery-migrate-3.0.0.min.js', //Nesta ordem
                    'vendors/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendors/calcx/os.js',
                    'vendors/select2/select2.min.js',
                    'vendors/select2/app.js',
                    'vendors/sweetalert2/sweetalert2.js',
                    'vendors/autocomplete/jquery-ui.js', //Vem por último
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
                'ordem_servico_pedido' => $this->core_model->generate_unique_code('ordens_servicos', 'numeric', 10, 'ordem_servico_pedido'),
                    
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
                
                 // Carrega a view de servicos
                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/add');
                $this->load->view('layout/footer');

            }        
        
    }
    
    public function edit($ordem_servico_id = NULL) {
        
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {            
            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('os');
        } else {
            
            $this->form_validation->set_rules('ordem_servico_cliente_id', 'cliente', 'required');
            
            $ordem_servico_status = $this->input->post('ordem_servico_status');
            
            if ($ordem_servico_status == 1) {
                $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', 'forma de pagamento', 'required');
            }
            
            
            
            $this->form_validation->set_rules('ordem_servico_equipamento', 'equipamento', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'marca', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'modelo', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', 'acessórios', 'required|max_length[300]');
            $this->form_validation->set_rules('ordem_servico_defeito', 'defeito', 'required|max_length[700]');
            $this->form_validation->set_rules('ordem_servico_obs', 'cliente', 'max_length[500]');
            
            
            if ($this->form_validation->run()) {
                
//                echo '<pre>';
//                print_r($this->input->post());
//                exit();
                
                $ordem_servico_valor_total = str_replace('R$',"", trim($this->input->post('ordem_servico_valor_total')));
                
                $data = elements(

                    array(
                        'ordem_servico_pedido',
                        'ordem_servico_cliente_id',
                        'ordem_servico_forma_pagamento_id',
                        'ordem_servico_status',
                        'ordem_servico_equipamento',
                        'ordem_servico_marca_equipamento',
                        'ordem_servico_modelo_equipamento',
                        'ordem_servico_acessorios',
                        'ordem_servico_defeito',
                        'ordem_servico_obs',
                        'ordem_servico_valor_desconto',
                        'ordem_servico_valor_total',
                    ), $this->input->post()
            );
                
            if ($ordem_servico_status == 0) {
                unset($data['ordem_servico_forma_pagamento_id']);
            }
                
            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/','',$ordem_servico_valor_total));
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('ordens_servicos', $data, array('ordem_servico_id' =>$ordem_servico_id));
            
            /* Deletando serviços antigos da OS editada*/
            $this->ordem_servicos_model->delete_old_services($ordem_servico_id);
            
            $servico_id = $this->input->post('servico_id');
            $servico_quantidade = $this->input->post('servico_quantidade');
            $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
            $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
            $servico_item_total = str_replace('%', '', $this->input->post('servico_item_total'));
            
            $servico_preco = str_replace(',', '', $servico_preco);
            $servico_item_total = str_replace(',', '', $servico_item_total);
            
            $qty_servico = count($servico_id);
            
            $ordem_servico_id = $this->input->post('ordem_servico_id');
            
            for ($i = 0; $i < $qty_servico; $i++) {
                $data = array(
                    'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                    'ordem_ts_id_servico' => $servico_id[$i],
                    'ordem_ts_quantidade' => $servico_quantidade[$i],
                    'ordem_ts_valor_unitario' => $servico_preco[$i],
                    'ordem_ts_valor_desconto' => $servico_desconto[$i],
                    'ordem_ts_valor_total' => $servico_item_total[$i],
                );
                
                $data = html_escape($data);
                
                $this->core_model->insert('ordem_tem_servicos', $data);
            }
            
            // Criar recurso PDF
            
            redirect('os/imprimir/' . $ordem_servico_id);
                
            } else {
                //Erro de validação
                $data = array(
            
                'titulo' => 'Atualizar Ordem de servico',
                    
                'styles' => array(
                    'vendors/select2/select2.min.css',
                    'vendors/autocomplete/jquery-ui.css',
                    'vendors/autocomplete/estilo.css',
                ),

                'scripts' => array (
                    'vendors/autocomplete/jquery-migrate-3.0.0.min.js', //Nesta ordem
                    'vendors/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendors/calcx/os.js',
                    'vendors/select2/select2.min.js',
                    'vendors/select2/app.js',
                    'vendors/sweetalert2/sweetalert2.js',
                    'vendors/autocomplete/jquery-ui.js', //Vem por último
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
                'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id),
                
                

                );

                $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);
                
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
//                print_r($ordem_servico);
//                exit();
                
                 // Carrega a view de servicos
                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/edit');
                $this->load->view('layout/footer');

            }
            
        }
        
        
    }
    
    public function del($ordem_servico_id = NULL) {
        
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {            
            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('os');
        }
        
        if ($this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id, 'ordem_servico_status' => 0))) {            
            $this->session->set_flashdata('error', 'Não é possivel excluír uma Ordem de Serviço com status <b>EM ABERTO</b>');
            redirect('os');
        }
        
        $this->core_model->delete('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id));
        redirect('os');
        
    }
    
    public function imprimir($ordem_servico_id = NULL) {
        
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {            
            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('os');
        } else {
            
            $data = array(
                'titulo' => 'Escolha uma opção',
                
                // Enviar dados da OS
                'ordem_servico' => $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id)),
            );
            
            // Carrega a view de servicos
            $this->load->view('layout/header', $data);
            $this->load->view('ordem_servicos/imprimir');
            $this->load->view('layout/footer');
            
        }
        
    }
    
    public function pdf($ordem_servico_id = NULL) {
        
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {            
            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada!');
            redirect('os');
        } else {
            
            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
            
//            echo '<pre>';
//            print_r($empresa);
//            exit();
            
            $ordem_servico = $this->ordem_servicos_model->get_by_id($ordem_servico_id);
            
//            echo '<pre>';
//            print_r($ordem_servico);
//            exit();
            
            $file_name = 'OS_'.$ordem_servico->ordem_servico_id;

            //Início do HTML do PDF
            $html = '<html>';
            
            $html .= '<head>';
            $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de O.S</title>';
            $html .= '</head>';
            
            $html .= '<body style="font-size: 12px">';
            
            $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
            $html .= '<tr>';
            $html .= '<th align="left">';
            $html .='<img src="public/images/logo_bsum.png" width="330px">';
            $html .='</th>';
            $html .= '<th align="right">';
            $html .= '<h4 align="right">                  
                    '.$empresa->sistema_razao_social.'<br/>
                    '.$empresa->sistema_nome_fantasia.'<br/>
                    '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                    '.$empresa->sistema_endereco.',&nbsp;'.$empresa->sistema_numero. '<br/>
                    '.'CEP: '.$empresa->sistema_cep.'&nbsp;|&nbsp;'.$empresa->sistema_cidade.'/'.$empresa->sistema_estado. '<br/>
                    '.'Telefone: '.$empresa->sistema_telefone_fixo. '<br/>
                    '.'E-mail:&nbsp;'.$empresa->sistema_email. '<br/>
                    </h4>';
            $html .='</th>';
            $html .= '</tr>';
            $html .='</table>';
            $html .='<hr/>';
                     
            $html .= '<p align="right"><b>Ordem de Serviço</b> nº: '.$ordem_servico->ordem_servico_id.'</p>';
            $html .='<hr/>';
            
            //Dados do cliente
            
            $html .= '<p>
                    '.'<b>Cliente:</b> '.$ordem_servico->cliente_nome_completo.'<br/>
                    '.'<b>CPF/CNPJ:</b> '.$ordem_servico->cliente_cpf_cnpj.'<br/>
                    '.'<b>Celular:</b> '.$ordem_servico->cliente_celular.'<br/>
                    '.'<b>Data da OS:</b> '. formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao).'<br/>
                    '.'<b>Forma de Pagamento:</b> '.($ordem_servico->ordem_servico_status == 1 ? $ordem_servico->forma_pagamento : 'Em aberto').'<br/>
                    </p>';
            $html .= '<hr/>';
            
            //Dados da Ordem de Serviço
            
            $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
            $html .= '<tr>';
            $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Serviço</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Quantidade</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Unitário</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Desconto</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
            $html .= '</tr>';          
            
            $ordem_servico_id = $ordem_servico->ordem_servico_id;
            $servicos_ordem = $this->ordem_servicos_model->get_all_servicos($ordem_servico_id);
            
//            echo '<pre>';
//            print_r($servicos_ordem);
//            exit();
                       
            $valor_final_os = $this->ordem_servicos_model->get_valor_final_os($ordem_servico_id);
            
//            echo '<pre>';
//            print_r($valor_final_os);
//            exit();
                        
            foreach ($servicos_ordem as $servico):              
                $html .= '<tr>';
                $html .= '<td style="border: solid #ddd 1px;padding: 3px">'.$servico->servico_descricao.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$servico->ordem_ts_quantidade.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$servico->ordem_ts_valor_unitario.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$servico->ordem_ts_valor_desconto.'%'.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$servico->ordem_ts_valor_total.'</td>';
                $html .= '</tr>';                 
            endforeach;                         
            
            $html .= '<th colspan="3">';
            $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
//            $html .= '<td align="center" style="border: solid #ddd 1px">'.'R$ '.$valor_final_os->os_valor_total.'</td>';
            $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$ordem_servico->ordem_servico_valor_total.'</td>';
            $html .= '</th>';
            $html .= '</table><br/>';
            $html .= '<hr/>';
            
            //Condições gerais da OS
            $html .='<p align="justify" style="font-size: 8px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pellentesque, dolor pretium aliquam commodo, ex velit consectetur dui, a pulvinar nulla orci sed lectus. Nam urna leo, tincidunt at risus quis, gravida fermentum tortor. In vel metus non lectus viverra consectetur ac nec ante. Sed auctor massa ante, in congue felis mollis vitae. Duis eget erat pharetra, commodo lorem ac, congue nisi. Integer posuere, erat ut pretium lobortis, leo ipsum placerat nibh, a scelerisque metus nibh dignissim risus. Morbi laoreet id sem ut elementum. Fusce molestie sagittis urna, a porta orci mollis eu. Duis purus tortor, fringilla quis urna ut, pellentesque tempus dolor. Curabitur luctus gravida nibh.</p>';
            $html .='<p align="justify" style="font-size: 8px">Suspendisse potenti. Duis mollis tempus augue, sit amet consequat lectus facilisis sed. Mauris blandit congue eros. Donec eget neque vitae ligula rhoncus euismod. Nulla molestie vestibulum lectus, at placerat elit. Aenean malesuada mattis lorem, eu egestas turpis. Nullam sed hendrerit purus. Donec vulputate ipsum vel nunc gravida rutrum. Pellentesque vel semper ex. Donec non est feugiat, tristique arcu eget, porttitor nisi. Nunc id venenatis ligula. Nam faucibus vel lorem ac tempor. Praesent sollicitudin volutpat mi fringilla ultricies. Vivamus nec lacus quis turpis lacinia ullamcorper et eu odio. Aenean a erat dignissim, volutpat augue eu, faucibus dolor. Aliquam non sollicitudin ante, vitae ullamcorper ante.</p>';
            $html .= '<hr/>';
            
            $html .='<p align="center" style="margin-top: 135px;">
                    __________________________________________________________<br>
                    Assinatura do Cliente
                    </p>';
            
            //Texto do rodapé da OS
            $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                    '.'<p>'.$empresa->sistema_txt_ordem_servico.'<br/></p>
                    '.'<p><hr/>'.($ordem_servico->ordem_servico_status == 1 ? 'OS concluída em '.formata_data_banco_com_hora($ordem_servico->ordem_servico_data_alteracao) : 'OS aberta em '.formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao)).'</b<br/></p><hr/>
                    </footer>';                                  
            
            $html .= '</body>';         
            $html .= '</html>';
            
//            echo '<pre>';
//            print_r($html);
//            exit();
            
            
            //False abre PDF no navegador e o true faz download
            $this->pdf->createPDF($html, $file_name, false);
            
        }
        
    }
    
}