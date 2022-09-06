<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Financiamentos extends CI_Controller{
    
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
            'titulo' => 'Financiamento',
            
            'scripts' => array (
                'vendors/mask/jquery_3.2.1.min.js',
                'vendors/mask/jquery.maskedinput.min.js',
                'vendors/mask/mascaras.js',
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
        
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required|min_length[3]|calcParcelaJuros');
        
        if ($this->form_validation->run()) {
            
            $data = elements(

                    array(
                        'valor',
                    ), $this->input->post()

            );
            
//            $valor = 0;
//            $valor_puro = 0;
//            $parcela12x = 0;
//            $parcela24x = 0;
//            $parcela36x = 0;
//            $parcela48x = 0;
//            $parcela60x = 0;
//            
//            $parcela12x_30 = 0;
//            $parcela24x_30 = 0;
//            $parcela36x_30 = 0;
//            $parcela48x_30 = 0;
//            $parcela60x_30 = 0;
//            
//            if (isset($_POST['valor'])) {
//                if ($_POST['valor'] != "") {
//
//                    $valor = addslashes($_POST['valor']);
//                    $valor = $valor+350;//TAC
//                    $valor_puro = $_POST['valor'];//TAC
//                    $valor = str_replace(',', '.', $valor);
//                    $valor_puro = str_replace(',', '.', $valor_puro);
//
//                    //SEM ENTRADA 90 dias
//                    $parcela12x = calcParcelaJuros($valor, 12, 1.78);
//                    $parcela24x = calcParcelaJuros($valor, 24, 1.56);
//                    $parcela36x = calcParcelaJuros($valor, 36, 1.58);
//                    $parcela48x = calcParcelaJuros($valor, 48, 1.61);
//                    $parcela60x = calcParcelaJuros($valor, 60, 1.62);
//
//                    //SEM ENTRADA 30 dias
//                    $parcela12x_30 = calcParcelaJuros($valor, 12, 1.61);
//                    $parcela24x_30 = calcParcelaJuros($valor, 24, 1.44);
//                    $parcela36x_30 = calcParcelaJuros($valor, 36, 1.40);
//                    $parcela48x_30 = calcParcelaJuros($valor, 48, 1.44);
//                    $parcela60x_30 = calcParcelaJuros($valor, 60, 1.45);
//
//                    //COM ENTRADA 12x
//                    $valor_entrada12_01     = (3.91/100)*$valor_puro;
//                    $parcela_entrada12_01   = calcParcelaJuros($valor, 12, 1.31);
//
//                    $valor_entrada12_02     = (9.97/100)*$valor_puro;
//                    $parcela_entrada12_02   = calcParcelaJuros($valor, 12, 0.02);
//
//                    //COM ENTRADA 24x
//                    $valor_entrada24_01     = (16.48/100)*$valor_puro;
//                    $parcela_entrada24_01   = calcParcelaJuros($valor, 24, 0);
//
//                    $valor_entrada24_02     = (5.33/100)*$valor_puro;
//                    $parcela_entrada24_02   = calcParcelaJuros($valor, 24, 1.16);
//
//                    $valor_entrada24_03     = (8.57/100)*$valor_puro;
//                    $parcela_entrada24_03   = calcParcelaJuros($valor, 24, 0.84);
//
//                    //COM ENTRADA 36x
//                    $valor_entrada36_01     = (22.62/100)*$valor_puro;
//                    $parcela_entrada36_01   = calcParcelaJuros($valor, 36, 0);
//
//                    $valor_entrada36_02     = (6.97/100)*$valor_puro;
//                    $parcela_entrada36_02   = calcParcelaJuros($valor, 36, 1.11);
//
//                    $valor_entrada36_03     = (6.14/100)*$valor_puro;
//                    $parcela_entrada36_03   = calcParcelaJuros($valor, 36, 1.17);
//
//                    //COM ENTRADA 48x
//                    $valor_entrada48_01     = (17.90/100)*$valor_puro;
//                    $parcela_entrada48_01   = calcParcelaJuros($valor, 48, 0.65);
//
//                    $valor_entrada48_02     = (9.73/100)*$valor_puro;
//                    $parcela_entrada48_02   = calcParcelaJuros($valor, 48, 1.08);
//
//                    $valor_entrada48_03     = (5.04/100)*$valor_puro;
//                    $parcela_entrada48_03   = calcParcelaJuros($valor, 48, 1.33);
//
//                    //COM ENTRADA 60x
//                    $valor_entrada60_01     = (16.83/100)*$valor_puro;
//                    $parcela_entrada60_01   = calcParcelaJuros($valor, 60, 0.85);
//
//                    $valor_entrada60_02     = (11.91/100)*$valor_puro;
//                    $parcela_entrada60_02   = calcParcelaJuros($valor, 60, 1.07);
//
//                    $valor_entrada60_03     = (4.24/100)*$valor_puro;
//                    $parcela_entrada60_03   = calcParcelaJuros($valor, 60, 1.39);
//
//                    $mostra = 1;
//
//
//
//                } else{
//                    $this->session->set_flashdata('error', 'O campo "VALOR DO FINANCIAMENTO" está vazio!');
//                    redirect('financiamentos');
//                    $mostra = 0;
//                }
//            } else{
//                $mostra = 0;
//            }
            
            
            // Limpar dados maliciosos
            $data = html_escape($data);
                        
            redirect('orcamentos/empresa');
            
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
        $this->load->view('orcamentos/financiamentos/index');
        $this->load->view('orcamentos/layout/footer');
        
        }
        
    }
    
//    public function calcParcelaJuros($valor_total,$parcelas,$juros=0) {
//        if($juros==0){
//           $string = 'PARCELA - VALOR <br />';
//           for($i=1;$i<($parcelas+1);$i++){
//              $string = number_format($valor_total/$parcelas, 2, ",", ".");
//           }
//           return $string;
//        }else{
//           $string = 'PARCELA - VALOR <br />';
//           for($i=1;$i<($parcelas+1);$i++){
//              $I =$juros/100.00;
//              $valor_parcela = $valor_total*$I*pow((1+$I),$parcelas)/(pow((1+$I),$parcelas)-1);
//              $string = number_format($valor_parcela, 2, ",", ".");
//           }
//           return $string;
//        }
//     }
    
}