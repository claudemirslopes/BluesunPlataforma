<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Relatorios extends CI_Controller{
    
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
          $this->session->set_flashdata('info', 'Você não tem permissão para acessar o módulo de <b>Relatórios</b>');
          redirect('home');
        }
        
        $this->load->model('home_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Relatorios',
            
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
//        print_r($data['categorias']);
//        exit();
        
         // Carrega a view de categorias
        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/index');
        $this->load->view('layout/footer');
        
    }
    
    public function vendas() {
        
        $data = array(
            'titulo' => 'Relatório de Vendas',
            
            // Home
            'soma_vendas' => $this->home_model->get_sum_vendas(),
            'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
            'soma_receber' => $this->home_model->get_sum_receber(),
            'soma_pagar' => $this->home_model->get_sum_pagar(),
            'soma_produtos' => $this->home_model->get_produtos_quantidade(),
            'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
            'top_servicos' => $this->home_model->get_servicos_mais_vendidos(), 
        );
        
        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');
        
        if ($data_inicial) {
            $this->load->model('vendas_model');
            
            if ($this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final)) {
                
                // Montar o PDF abaixo
                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
            
                $vendas = $this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final);

                $file_name = 'RelatorioVendas';

                //Início do HTML do PDF
                $html = '<html>';

                $html .= '<head>';
                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Vendas</title>';
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
                
                if ($data_inicial && $data_final) {
                    $html .= '<p align="center"><b>Relatório de vendas realizadas entre o período de </b>';
                    $html .= '<span>'. formata_data_banco_sem_hora($data_inicial).' a '. formata_data_banco_sem_hora($data_final).'</span></p>';
                } else {
                    $html .= '<p align="center"><b>Relatório de vendas do dia </b>';
                    $html .= '<span>'. formata_data_banco_sem_hora($data_inicial).'</span></p>';
                }
                
                $html .='<hr/>';

                //Dados da venda

                $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                $html .= '<tr>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data</th>';
                $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cliente</th>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Forma de Pagamento</th>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                $html .= '</tr>';       
                
                $valor_final_vendas = $this->vendas_model->get_valor_final_relatorio($data_inicial, $data_final);

                foreach ($vendas as $venda):              
                    $html .= '<tr>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$venda->venda_id.'</td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_com_hora($venda->venda_data_emissao).'</td>';
                    $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$venda->cliente_nome_completo.'</td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$venda->forma_pagamento.'</td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$venda->venda_valor_total.'</td>';
                    $html .= '</tr>';                 
                endforeach;                         

                $html .= '<th colspan="3">';
                $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_vendas->venda_valor_total.'</td>';
                $html .= '</th>';
                $html .= '</table><br/>';
                $html .= '<hr/>';

                //Texto do rodapé da OS
                $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                        '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                        '.'<p><hr/>Relatório de venda gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                        </footer>';                                  

                $html .= '</body>';         
                $html .= '</html>';

                //False abre PDF no navegador e o true faz download
                $this->pdf->createPDF($html, $file_name, false);
                
            } else {
                if (!empty($data_inicial) && !empty($data_final)) {
                    $this->session->set_flashdata('info', 'Não foram encontradas vendas entre as datas '. formata_data_banco_sem_hora($data_inicial).' e '. formata_data_banco_sem_hora($data_final));
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontradas vendas a partir de '. formata_data_banco_sem_hora($data_inicial));
                }
                redirect('relatorios/vendas');
            }
        }
        
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
        
        // Carrega a view de relatorios
        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/vendas');
        $this->load->view('layout/footer');
        
    }
    
    public function os() {
        
        $data = array(
            'titulo' => 'Relatório de Ordem de Serviço',
            
            // Home
            'soma_vendas' => $this->home_model->get_sum_vendas(),
            'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
            'soma_receber' => $this->home_model->get_sum_receber(),
            'soma_pagar' => $this->home_model->get_sum_pagar(),
            'soma_produtos' => $this->home_model->get_produtos_quantidade(),
            'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
            'top_servicos' => $this->home_model->get_servicos_mais_vendidos(),
        );
        
        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');
        
        if ($data_inicial) {
            $this->load->model('ordem_servicos_model');
            
            if ($this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final)) {
                
                // Montar o PDF abaixo
                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
            
                $ordem_servicos = $this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final);

                $file_name = 'RelatorioOS';

                //Início do HTML do PDF
                $html = '<html>';

                $html .= '<head>';
                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Ordem de Serviço</title>';
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
                
                if ($data_inicial && $data_final) {
                    $html .= '<p align="center"><b>Relatório de Ordem de Serviço realizadas entre o período de </b>';
                    $html .= '<span>'. formata_data_banco_sem_hora($data_inicial).' a '. formata_data_banco_sem_hora($data_final).'</span></p>';
                } else {
                    $html .= '<p align="center"><b>Relatório de Ordem de Serviço do dia </b>';
                    $html .= '<span>'. formata_data_banco_sem_hora($data_inicial).'</span></p>';
                }
                
                $html .='<hr/>';

                //Dados da OS

                $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                $html .= '<tr>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data</th>';
                $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cliente</th>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Forma de Pagamento</th>';
                $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                $html .= '</tr>';       
                
                $valor_final_os = $this->ordem_servicos_model->get_valor_final_relatorio($data_inicial, $data_final);

                foreach ($ordem_servicos as $ordem_servico):              
                    $html .= '<tr>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$ordem_servico->ordem_servico_id.'</td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao).'</td>';
                    $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$ordem_servico->cliente_nome_completo.'</td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$ordem_servico->forma_pagamento.'</td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$ordem_servico->ordem_servico_valor_total.'</td>';
                    $html .= '</tr>';                 
                endforeach;                         

                $html .= '<th colspan="3">';
                $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_os->ordem_servico_valor_total.'</td>';
                $html .= '</th>';
                $html .= '</table><br/>';
                $html .= '<hr/>';

                //Texto do rodapé da OS
                $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                        '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                        '.'<p><hr/>Relatório de Ordem de Serviço gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                        </footer>';                                  

                $html .= '</body>';         
                $html .= '</html>';

                //False abre PDF no navegador e o true faz download
                $this->pdf->createPDF($html, $file_name, false);
                
            } else {
                if (!empty($data_inicial) && !empty($data_final)) {
                    $this->session->set_flashdata('info', 'Não foram encontradas OS entre as datas '. formata_data_banco_sem_hora($data_inicial).' e '. formata_data_banco_sem_hora($data_final));
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontradas OS a partir de '. formata_data_banco_sem_hora($data_inicial));
                }
                redirect('relatorios/os');
            }
        }
        
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
        
        // Carrega a view de relatorios
        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/os');
        $this->load->view('layout/footer');
        
    }
    
    // Método para os relatórios de Contas a Receber
    public function receber() {
        
        $data = array(
         'titulo' => 'Relatório de Contas a Receber', 
            
        // Home
        'soma_vendas' => $this->home_model->get_sum_vendas(),
        'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
        'soma_receber' => $this->home_model->get_sum_receber(),
        'soma_pagar' => $this->home_model->get_sum_pagar(),
        'soma_produtos' => $this->home_model->get_produtos_quantidade(),
        'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
        'top_servicos' => $this->home_model->get_servicos_mais_vendidos(),
        );
        
        $contas = $this->input->post('contas');
        
        if ($contas == 'vencidas' || $contas == 'pagas' || $contas == 'receber') {
            
            $this->load->model('financeiro_model');
            
            if ($contas == 'vencidas') {
                $conta_receber_status = 0;
                
                $data_vencimento = TRUE;
                
                if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento)) {
                    
                    //Formar PDF do relatorio de Contas a Receber vencidas
                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento);

                    $file_name = 'RelatorioContasAReceberVencidas';

                    //Início do HTML do PDF
                    $html = '<html>';

                    $html .= '<head>';
                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Contas a Receber Vencidas</title>';
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

                    $html .= '<p align="center"><b>Relatório de Contas a Receber com status <big>"vencida"</big></b></p>';
                    $html .='<hr/>';

                    //Dados da venda

                    $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                    $html .= '<tr>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data Venc.</th>';
                    $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cliente</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Situação</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                    $html .= '</tr>'; 

                    foreach ($contas as $conta):              
                        $html .= '<tr>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->conta_receber_id.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_sem_hora($conta->conta_receber_data_vencimento).'</td>';
                        $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$conta->cliente_nome_completo.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">vencida</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$conta->conta_receber_valor.'</td>';
                        $html .= '</tr>';                 
                    endforeach; 

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento);

                    $html .= '<th colspan="3">';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_contas->conta_receber_valor_total.'</td>';
                    $html .= '</th>';
                    $html .= '</table><br/>';
                    $html .= '<hr/>';

                    //Texto do rodapé do relatório
                    $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                            '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                            '.'<p><hr/>Relatório de contas a receber gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                            </footer>';                                  

                    $html .= '</body>';         
                    $html .= '</html>';

    //                echo '<pre>';
    //                print_r($html);
    //                exit();

                    //False abre PDF no navegador e o true faz download
                    $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas vencidas na base de dados');
                    redirect('relatorios/receber');
                }
                
            }
            
            if ($contas == 'pagas') {
                $conta_receber_status = 1;
                
                if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)) {
                    
                    //Formar PDF do relatorio de Contas a Receber pagas
                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);

                    $file_name = 'RelatorioContasAReceberPagas';

                    //Início do HTML do PDF
                    $html = '<html>';

                    $html .= '<head>';
                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Contas a Receber Pagas</title>';
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

                    $html .= '<p align="center"><b>Relatório de Contas a Receber com status <big>"paga"</big></b></p>';
                    $html .='<hr/>';

                    //Dados da venda

                    $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                    $html .= '<tr>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data Pagam.</th>';
                    $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cliente</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Situação</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                    $html .= '</tr>'; 

                    foreach ($contas as $conta):              
                        $html .= '<tr>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->conta_receber_id.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_com_hora($conta->conta_receber_data_pagamento).'</td>';
                        $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$conta->cliente_nome_completo.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">paga</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$conta->conta_receber_valor.'</td>';
                        $html .= '</tr>';                 
                    endforeach; 

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                    $html .= '<th colspan="3">';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_contas->conta_receber_valor_total.'</td>';
                    $html .= '</th>';
                    $html .= '</table><br/>';
                    $html .= '<hr/>';

                    //Texto do rodapé do relatório
                    $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                            '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                            '.'<p><hr/>Relatório de contas a receber gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                            </footer>';                                  

                    $html .= '</body>';         
                    $html .= '</html>';

//                    echo '<pre>';
//                    print_r($html);
//                    exit();

                    //False abre PDF no navegador e o true faz download
                    $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas pagas na base de dados');
                    redirect('relatorios/receber');
                }
                
            }
            
            if ($contas == 'receber') {
                $conta_receber_status = 0;
                
                if ($this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)) {
                    
                    //Formar PDF do relatorio de Contas a Receber
                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);

                    $file_name = 'RelatorioContasaAReceber';

                    //Início do HTML do PDF
                    $html = '<html>';

                    $html .= '<head>';
                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Contas a Receber</title>';
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

                    $html .= '<p align="center"><b>Relatório de Contas a Receber com status <big>"a receber"</big></b></p>';
                    $html .='<hr/>';

                    //Dados da venda

                    $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                    $html .= '<tr>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data Venc.</th>';
                    $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cliente</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Situação</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                    $html .= '</tr>'; 

                    foreach ($contas as $conta):              
                        $html .= '<tr>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->conta_receber_id.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_sem_hora($conta->conta_receber_data_vencimento).'</td>';
                        $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$conta->cliente_nome_completo.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">a receber</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$conta->conta_receber_valor.'</td>';
                        $html .= '</tr>';                 
                    endforeach; 

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                    $html .= '<th colspan="3">';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_contas->conta_receber_valor_total.'</td>';
                    $html .= '</th>';
                    $html .= '</table><br/>';
                    $html .= '<hr/>';

                    //Texto do rodapé do relatório
                    $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                            '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                            '.'<p><hr/>Relatório de contas a receber gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                            </footer>';                                  

                    $html .= '</body>';         
                    $html .= '</html>';

//                    echo '<pre>';
//                    print_r($html);
//                    exit();

                    //False abre PDF no navegador e o true faz download
                    $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas a receber na base de dados');
                    redirect('relatorios/receber');
                }
                
            }
            
        }
        
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
        
        // Carrega a view de relatorios Contas a Receber
        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/contas_receber');
        $this->load->view('layout/footer');
        
    }
    
    // Método para os relatórios de Contas a Receber
    public function pagar() {
        
        $data = array(
         'titulo' => 'Relatório de Contas a Pagar',
        
        // Home
        'soma_vendas' => $this->home_model->get_sum_vendas(),
        'soma_servicos' => $this->home_model->get_sum_ordem_servicos(),
        'soma_receber' => $this->home_model->get_sum_receber(),
        'soma_pagar' => $this->home_model->get_sum_pagar(),
        'soma_produtos' => $this->home_model->get_produtos_quantidade(),
        'top_produtos' => $this->home_model->get_produtos_mais_vendidos(),
        'top_servicos' => $this->home_model->get_servicos_mais_vendidos(),
        );
        
        $contas = $this->input->post('contas');
        
        if ($contas == 'pagas' || $contas == 'vencidas' || $contas == 'a_pagar') {
            
            $this->load->model('financeiro_model');
            
            if ($contas == 'vencidas') {
                $conta_pagar_status = 0;
                
                $data_vencimento = TRUE;
                
                if ($this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {
                    
                    //Formar PDF do relatorio de Contas a Pagar vencidas
                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $file_name = 'RelatorioContasAPagarVencidas';

                    //Início do HTML do PDF
                    $html = '<html>';

                    $html .= '<head>';
                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Contas a Pagar Vencidas</title>';
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

                    $html .= '<p align="center"><b>Relatório de Contas a Pagar com status <big>"vencida"</big></b></p>';
                    $html .='<hr/>';

                    //Dados da venda

                    $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                    $html .= '<tr>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data Venc.</th>';
                    $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Fornecedor</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">CNPJ</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Situação</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                    $html .= '</tr>'; 

                    foreach ($contas as $conta):              
                        $html .= '<tr>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->conta_pagar_id.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento).'</td>';
                        $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$conta->fornecedor_nome_fantasia.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->fornecedor_cnpj.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">vencida</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$conta->conta_pagar_valor.'</td>';
                        $html .= '</tr>';                 
                    endforeach; 

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $html .= '<th colspan="4">';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_contas->conta_pagar_valor_total.'</td>';
                    $html .= '</th>';
                    $html .= '</table><br/>';
                    $html .= '<hr/>';

                    //Texto do rodapé do relatório
                    $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                            '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                            '.'<p><hr/>Relatório de contas a pagar gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                            </footer>';                                  

                    $html .= '</body>';         
                    $html .= '</html>';

    //                echo '<pre>';
    //                print_r($html);
    //                exit();

                    //False abre PDF no navegador e o true faz download
                    $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas vencidas na base de dados');
                    redirect('relatorios/receber');
                }
                
            }
            
            if ($contas == 'pagas') {
                $conta_pagar_status = 1;
                
                if ($this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status)) {
                    
                    //Formar PDF do relatorio de Contas a Pagar pagas
                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status);

                    $file_name = 'RelatorioContasAPagarPagas';

                    //Início do HTML do PDF
                    $html = '<html>';

                    $html .= '<head>';
                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Contas A Pagar Pagas</title>';
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

                    $html .= '<p align="center"><b>Relatório de Contas a Pagar com status <big>"paga"</big></b></p>';
                    $html .='<hr/>';

                    //Dados da venda

                    $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                    $html .= '<tr>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data Pagam.</th>';
                    $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Fornecedor</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">CNPJ</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Situação</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                    $html .= '</tr>'; 
                    
                    foreach ($contas as $conta):              
                        $html .= '<tr>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->conta_pagar_id.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_com_hora($conta->conta_pagar_data_pagamento).'</td>';
                        $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$conta->fornecedor_nome_fantasia.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->fornecedor_cnpj.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">paga</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$conta->conta_pagar_valor.'</td>';
                        $html .= '</tr>';                 
                    endforeach; 

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status);

                    $html .= '<th colspan="4">';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_contas->conta_pagar_valor_total.'</td>';
                    $html .= '</th>';
                    $html .= '</table><br/>';
                    $html .= '<hr/>';

                    //Texto do rodapé do relatório
                    $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                            '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                            '.'<p><hr/>Relatório de contas a pagar gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                            </footer>';                                  

                    $html .= '</body>';         
                    $html .= '</html>';

//                    echo '<pre>';
//                    print_r($html);
//                    exit();

                    //False abre PDF no navegador e o true faz download
                    $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas pagas na base de dados');
                    redirect('relatorios/receber');
                }
                
            }
            
            if ($contas == 'a_pagar') {
                $conta_pagar_status = 0;
                
                if ($this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status)) {
                    
                    //Formar PDF do relatorio de Contas a Pagar
                    $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status);

                    $file_name = 'RelatorioContasAPagar';

                    //Início do HTML do PDF
                    $html = '<html>';

                    $html .= '<head>';
                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de Contas a Pagar</title>';
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

                    $html .= '<p align="center"><b>Relatório de Contas a Pagar com status <big>"a pagar"</big></b></p>';
                    $html .='<hr/>';

                    //Dados da venda

                    $html .= '<table width="100%" align="center" style="border-collapse: collapse;padding-top:15px;">';
                    $html .= '<tr>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Cód.</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Data Venc.</th>';
                    $html .= '<th align="left" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Fornecedor</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">CNPJ</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Situação</th>';
                    $html .= '<th align="center" style="border: solid #ddd 1px;background: #ccc;padding: 3px">Valor Total</th>';
                    $html .= '</tr>'; 

                    foreach ($contas as $conta):              
                        $html .= '<tr>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->conta_pagar_id.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'. formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento).'</td>';
                        $html .= '<td align="left" style="border: solid #ddd 1px;padding: 3px">'.$conta->fornecedor_nome_fantasia.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.$conta->fornecedor_cnpj.'</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">a pagar</td>';
                        $html .= '<td align="center" style="border: solid #ddd 1px;padding: 3px">'.'R$ '.$conta->conta_pagar_valor.'</td>';
                        $html .= '</tr>';                 
                    endforeach; 
                    
                    $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status);

                    $html .= '<th colspan="4">';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #aaa;padding: 3px"><strong>Valor Final</strong></td>';
                    $html .= '<td align="center" style="border: solid #ddd 1px;background: #ddd;padding: 3px">'.'R$ '.$valor_final_contas->conta_pagar_valor_total.'</td>';
                    $html .= '</th>';
                    $html .= '</table><br/>';
                    $html .= '<hr/>';

                    //Texto do rodapé do relatório
                    $html .='<footer style="position:absolute;bottom:0;width:100%;text-align:center;">
                            '.'<p><strong>Bluesun Solar do Brasil &copy;</strong>, todos os direitos reservados. Faça parte de uma das maiores importadoras e distribuidoras de sistemas fotovoltaicos do Brasil. Relatório para fins meramente informativos<br/></p>
                            '.'<p><hr/>Relatório de contas a pagar gerado em '.'<b>'.date("d/m/Y H:i:s").'</b<br/></p><hr/>
                            </footer>';                                  

                    $html .= '</body>';         
                    $html .= '</html>';

//                    echo '<pre>';
//                    print_r($html);
//                    exit();

                    //False abre PDF no navegador e o true faz download
                    $this->pdf->createPDF($html, $file_name, false);
                    
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas a receber na base de dados');
                    redirect('relatorios/receber');
                }
                
            }
            
        }
        
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
        
        // Carrega a view de relatorios Contas a Receber
        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/contas_pagar');
        $this->load->view('layout/footer');
        
    }
    
}