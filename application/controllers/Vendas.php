<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Vendas extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->ion_auth->logged_in()){
            $this->session->set_flashdata('info', 'Sua sessão expirou, acesse novamente');
            redirect('login');
        }
        
        $this->load->model('vendas_model');
        $this->load->model('produtos_model');
        $this->load->model('home_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Vendas',
            
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
            
            'vendas' => $this->vendas_model->get_all(),
            
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
//        print_r($data['vendas']);
//        exit();
        
         // Carrega a view de produtos
        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');
        
    }
    
    public function add() {
        
                        
            $this->form_validation->set_rules('venda_cliente_id', 'cliente', 'required');
            $this->form_validation->set_rules('venda_tipo', 'tipo', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', 'forma de pagamento', 'required');
            $this->form_validation->set_rules('venda_vendedor_id', 'vendedor', 'required');
            
            
            if ($this->form_validation->run()) {
                
//                echo '<pre>';
//                print_r($this->input->post());
//                exit();
                
                $venda_valor_total = str_replace('R$',"", trim($this->input->post('venda_valor_total')));
                
                $data = elements(

                    array(
                        'venda_cliente_id',
                        'venda_forma_pagamento_id',
                        'venda_tipo',
                        'venda_vendedor_id',
                        'venda_valor_desconto',
                        'venda_valor_total',
                    ), $this->input->post()
            );
                
            $data['venda_valor_total'] = trim(preg_replace('/\$/','',$venda_valor_total));
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->insert('vendas', $data, TRUE);
            
            //Recuperar ID
            $id_venda = $this->session->userdata('last_id');
                        
            $produto_id = $this->input->post('produto_id');
            $produto_quantidade = $this->input->post('produto_quantidade');
            $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));
            $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));
            $produto_item_total = str_replace('%', '', $this->input->post('produto_item_total'));
            
            $produto_preco_venda = str_replace(',', '', $produto_preco_venda);
            $produto_item_total = str_replace(',', '', $produto_item_total);
            
            $qty_produto = count($produto_id);
            
            for ($i = 0; $i < $qty_produto; $i++) {
                $data = array(
                    'venda_produto_id_venda' => $id_venda,
                    'venda_produto_id_produto' => $produto_id[$i],
                    'venda_produto_quantidade' => $produto_quantidade[$i],
                    'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                    'venda_produto_desconto' => $produto_desconto[$i],
                    'venda_produto_valor_total' => $produto_item_total[$i],
                );
                
                $data = html_escape($data);
                
                $this->core_model->insert('venda_produtos', $data);
                
                /* Início atualização Estoque (EDIÇÃO ESTOQUE) */
                $produto_qtde_estoque = 0;
                
                $produto_qtde_estoque += intval($produto_quantidade[$i]);
                
                $produtos = array(
                    'produto_qtde_estoque' => $produto_qtde_estoque,
                );
                
                $this->produtos_model->update($produto_id[$i], $produto_qtde_estoque); 
                /* Fim atualização Estoque */
                
            } //Fim for
            var_dump($diferenca);
            // Criar recurso PDF
            
            redirect('vendas/imprimir/' . $id_venda);
                
            } else {
                //Erro de validação
                $data = array(
            
                'titulo' => 'Cadastrar Venda',
                    
                'styles' => array(
                    'vendors/select2/select2.min.css',
                    'vendors/autocomplete/jquery-ui.css',
                    'vendors/autocomplete/estilo.css',
                ),

                'scripts' => array (
                    'vendors/autocomplete/jquery-migrate-3.0.0.min.js', //Nesta ordem
                    'vendors/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendors/calcx/venda.js',
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
                'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),

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
//                print_r($venda_produtos);
//                exit();
                
                 // Carrega a view de produtos
                $this->load->view('layout/header', $data);
                $this->load->view('vendas/add');
                $this->load->view('layout/footer');

            }
        
        
    }
    
    public function edit($venda_id = NULL) {
        
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {            
            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('vendas');
        } else {
            
            //Atualização de estoque
            $venda_produtos = $data['venda_produtos'] =  $this->vendas_model->get_all_produtos_by_venda($venda_id);
                        
            $this->form_validation->set_rules('venda_cliente_id', 'cliente', 'required');
            $this->form_validation->set_rules('venda_tipo', 'tipo', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', 'forma de pagamento', 'required');
            $this->form_validation->set_rules('venda_vendedor_id', 'vendedor', 'required');
            
            
            if ($this->form_validation->run()) {
                
//                echo '<pre>';
//                print_r($this->input->post());
//                exit();
                
                $venda_valor_total = str_replace('R$',"", trim($this->input->post('venda_valor_total')));
                
                $data = elements(

                    array(
                        'venda_cliente_id',
                        'venda_forma_pagamento_id',
                        'venda_tipo',
                        'venda_vendedor_id',
                        'venda_valor_desconto',
                        'venda_valor_total',
                    ), $this->input->post()
            );
                
            $data['venda_valor_total'] = trim(preg_replace('/\$/','',$venda_valor_total));
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('vendas', $data, array('venda_id' =>$venda_id));
            
            /* Deletando produtos antigos da venda editada*/
            $this->vendas_model->delete_old_products($venda_id);
            
            $produto_id = $this->input->post('produto_id');
            $produto_quantidade = $this->input->post('produto_quantidade');
            $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));
            $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));
            $produto_item_total = str_replace('%', '', $this->input->post('produto_item_total'));
            
            $produto_preco_venda = str_replace(',', '', $produto_preco_venda);
            $produto_item_total = str_replace(',', '', $produto_item_total);
            
            $qty_produto = count($produto_id);
            
            for ($i = 0; $i < $qty_produto; $i++) {
                $data = array(
                    'venda_produto_id_venda' => $venda_id,
                    'venda_produto_id_produto' => $produto_id[$i],
                    'venda_produto_quantidade' => $produto_quantidade[$i],
                    'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                    'venda_produto_desconto' => $produto_desconto[$i],
                    'venda_produto_valor_total' => $produto_item_total[$i],
                );
                
                $data = html_escape($data);
                
                $this->core_model->insert('venda_produtos', $data);
                
                /* Início atualização Estoque (EDIÇÃO ESTOQUE) */
//                foreach ($venda_produtos as $venda_p) {
//                    
//                    if ($venda_p->venda_produto_quantidade < $produto_quantidade[$i]) {
//                        
//                        $produto_qtde_estoque = 0;
//                        
//                        $produto_qtde_estoque += intval($produto_quantidade[$i]);
//                        
//                        $diferenca = ($produto_qtde_estoque - $venda_p->venda_produto_quantidade);
//                        
//                        $this->produtos_model->update($produto_id[$i], $diferenca);                                              
//                        
//                    }
//                    
//                }  
                /* Fim atualização Estoque */
                
            } //Fim for
            var_dump($diferenca);
            // Criar recurso PDF
            
//            redirect('vendas/imprimir/' . $venda_id);
            redirect('vendas');
                
            } else {
                //Erro de validação
                $data = array(
            
                'titulo' => 'Visualizar Venda',
                    
                'styles' => array(
                    'vendors/select2/select2.min.css',
                    'vendors/autocomplete/jquery-ui.css',
                    'vendors/autocomplete/estilo.css',
                ),

                'scripts' => array (
                    'vendors/autocomplete/jquery-migrate-3.0.0.min.js', //Nesta ordem
                    'vendors/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendors/calcx/venda.js',
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
                'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                'venda' => $this->vendas_model->get_by_id($venda_id),
                'venda_produtos' =>  $this->vendas_model->get_all_produtos_by_venda($venda_id),
                'desabilitar' => TRUE,

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
//                print_r($venda_produtos);
//                exit();
                
                 // Carrega a view de produtos
                $this->load->view('layout/header', $data);
                $this->load->view('vendas/edit');
                $this->load->view('layout/footer');

            }
            
        }
        
        
    }
    
    public function del($venda_id = NULL) {
        
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {            
            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('vendas');
        } else {
            $this->core_model->delete('vendas', array('venda_id' => $venda_id));
            redirect('vendas');
        }
        
    }
    
    public function imprimir($venda_id = NULL) {
        
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {            
            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('vendas');
        } else {
            
            $data = array(
                'titulo' => 'Escolha uma opção',
                
                // Enviar dados da OS
                'venda' => $this->core_model->get_by_id('vendas', array('venda_id' => $venda_id)),
            );
            
            // Carrega a view de servicos
            $this->load->view('layout/header', $data);
            $this->load->view('vendas/imprimir');
            $this->load->view('layout/footer');
            
        }
        
    }
    
    public function pdf($venda_id = NULL) {
        
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {            
            $this->session->set_flashdata('error', 'Venda não encontrada!');
            redirect('os');
        } else {
            
            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
            
            $venda = $this->vendas_model->get_by_id($venda_id);
            
            $file_name = 'Venda_'.$venda->venda_id;

            //Início do HTML do PDF
            $html = '<html>';
            
            $html .= '<head>';
            $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Comprovante de Venda</title>';
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
                     
            $html .= '<p align="right"><b>FAT_VENDA</b> Nº: '.$venda->venda_id.'</p>';
            $html .='<hr/>';
            
            //Dados do cliente
            
            $html .= '<p>
                    '.'<b>Cliente:</b> '.$venda->cliente_nome_completo.'<br/>
                    '.'<b>CPF/CNPJ:</b> '.$venda->cliente_cpf_cnpj.'<br/>
                    '.'<b>Celular:</b> '.$venda->cliente_celular.'<br/>
                    '.'<b>Data da Venda:</b> '. formata_data_banco_com_hora($venda->venda_data_emissao).'<br/>
                    '.'<b>Forma de Pagamento:</b> '. $venda->forma_pagamento .'<br/>
                    </p>';
            $html .= '<hr/>';
            
            //Dados da venda
            
            $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
            $html .= '<tr>';
            $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Produto</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Quantidade</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Unitário</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Desconto</th>';
            $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
            $html .= '</tr>';          
            
            $venda_id = $venda->venda_id;
            $vendas_produto = $this->vendas_model->get_all_produtos($venda_id);
            
//            echo '<pre>';
//            print_r($vendas_produto);
//            exit();
                       
            $valor_final_venda = $this->vendas_model->get_valor_final_venda($venda_id);
            
//            echo '<pre>';
//            print_r($valor_final_venda);
//            exit();
                        
            foreach ($vendas_produto as $venda_produto):              
                $html .= '<tr>';
                $html .= '<td style="border: solid #ddd 1px;padding: 3px">'.$venda_produto->produto_descricao.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$venda_produto->venda_produto_quantidade.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$venda_produto->venda_produto_valor_unitario.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$venda_produto->venda_produto_desconto.'%'.'</td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$venda_produto->venda_produto_valor_total.'</td>';
                $html .= '</tr>';                 
            endforeach;                         
            
            $html .= '<th colspan="3">';
            $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
//            $html .= '<td align="center" style="border: solid #ddd 1px">'.'R$ '.$valor_final_os->os_valor_total.'</td>';
            $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$venda->venda_valor_total.'</td>';
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
                    '.'<p><hr/>Venda concluída em '.formata_data_banco_com_hora($venda->venda_data_emissao).'</b<br/></p><hr/>
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