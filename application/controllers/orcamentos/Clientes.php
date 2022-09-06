<?php

defined('BASEPATH') OR exit ('Ação não permitida');

class Clientes extends CI_Controller{
    
    public function __construct() {
        parent::__construct(); 
        
        // Definir se tem sessão aberta
        if (!$this->session->userdata('logado')) {
            redirect(base_url('orcamentos/login'));
        }
        
        $this->load->model('orcamentos/home_model');
        
    }
    
    public function index() {
        
        $data = array(
            
            'titulo' => 'Clientes',
            
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
            
            'clientes_franqueados' => $this->core_model->get_all('clientes_franqueados'),
            
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
//        print_r($data['clientes_franqueados']);
//        exit();
        
         // Carrega a view de clientes_franqueados
        $this->load->view('orcamentos/layout/header', $data);
        $this->load->view('orcamentos/clientes/index');
        $this->load->view('orcamentos/layout/footer');
        
    }
    
    public function add() {

        $this->form_validation->set_rules('cli_fran_nome', 'nome', 'trim|required|min_length[4]|max_length[45]');
        $cli_fran_pessoa = $this->input->post('cli_fran_pessoa');
        if ($cli_fran_pessoa == 1) {
            $this->form_validation->set_rules('cli_fran_cpf', 'CPF', 'trim|required|min_length[14]|max_length[14]|is_unique[clientes_franqueados.cli_fran_cpf_cnpj]|callback_valida_cpf');
        } else {
            $this->form_validation->set_rules('cli_fran_cnpj', 'CNPJ', 'trim|required|min_length[18]|max_length[18]|is_unique[clientes_franqueados.cli_fran_cpf_cnpj]|callback_valida_cnpj');
        }
        $this->form_validation->set_rules('cli_fran_uni_consum', 'Unidade Consumidora', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('cli_fran_email', 'e-mail', 'trim|required|valid_email|max_length[50]|is_unique[clientes_franqueados.cli_fran_email]');            
        if ($this->input->post('cli_fran_tel_cel')) {
            $this->form_validation->set_rules('cli_fran_tel_cel', 'telefone/fixo', 'trim|max_length[15]|is_unique[clientes_franqueados.cli_fran_tel_cel]');
        }
        $this->form_validation->set_rules('cli_fran_cep', 'CEP', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('cli_fran_endereco', 'endereço', 'trim|required|max_length[155]');
        $this->form_validation->set_rules('cli_fran_numero', 'número', 'trim|max_length[10]');
        $this->form_validation->set_rules('cli_fran_bairro', 'bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('cli_fran_complemento', 'complemento', 'trim|max_length[145]');
        $this->form_validation->set_rules('cli_fran_cidade', 'cidade', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('cli_fran_estado', 'estado', 'trim|required|exact_length[2]');

        if ($this->form_validation->run()) { 
            // Teste para ver se valida
//                exit('Validado');

            $data = elements(

                array(
                    'cli_fran_cliente_id',
                    'cli_fran_pessoa',
                    'cli_fran_uni_consum',
                    'cli_fran_nome',
                    'cli_fran_email',
                    'cli_fran_tel_cel',
                    'cli_fran_cep',
                    'cli_fran_endereco',
                    'cli_fran_numero',
                    'cli_fran_bairro',
                    'cli_fran_complemento',
                    'cli_fran_cidade',
                    'cli_fran_estado',
                    'cli_fran_status',
                ), $this->input->post()

        );

        if ($cli_fran_pessoa == 1) {
            $data['cli_fran_cpf_cnpj'] = $this->input->post('cli_fran_cpf');
        } else {
            $data['cli_fran_cpf_cnpj'] = $this->input->post('cli_fran_cnpj');
        }

        // Colocar todo texto em maiúsculo
//            $data['cli_fran_estado'] = strtoupper($this->input->post('cli_fran_estado'));

        // Limpar dados maliciosos
        $data = html_escape($data);

        $this->core_model->insert('clientes_franqueados', $data);

        redirect('orcamentos/clientes');

        } else {

            // Erro de validação
            $data = array(

            'titulo' => 'Cadastrar cliente',

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

            // Carrega a view de editar clientes
           $this->load->view('orcamentos/layout/header', $data);
           $this->load->view('orcamentos/clientes/add');
           $this->load->view('orcamentos/layout/footer');

        }        

}
    
    public function edit($cli_fran_id = NULL) {
              
        if (!$cli_fran_id || !$this->core_model->get_by_id('clientes_franqueados', array('cli_fran_id' => $cli_fran_id))) {            
            $this->session->set_flashdata('error', 'Cliente não encontrado!');
            redirect('orcamentos/clientes');
        } else {
            
            $this->form_validation->set_rules('cli_fran_nome', 'nome', 'trim|required|min_length[4]|max_length[45]');
            $cli_fran_pessoa = $this->input->post('cli_fran_pessoa');
            if ($cli_fran_pessoa == 1) {
                $this->form_validation->set_rules('cli_fran_cpf', 'CPF', 'trim|required|min_length[14]|max_length[14]|callback_valida_cpf');
            } else {
                $this->form_validation->set_rules('cli_fran_cnpj', 'CNPJ', 'trim|required|min_length[18]|max_length[18]|callback_valida_cnpj');
            }
            $this->form_validation->set_rules('cli_fran_uni_consum', 'Unidade Consumidora', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('cli_fran_email', 'e-mail', 'trim|required|valid_email|max_length[50]|callback_check_email');            
            if ($this->input->post('cli_fran_tel_cel')) {
                $this->form_validation->set_rules('cli_fran_tel_cel', 'telefone/celular', 'trim|max_length[15]|callback_check_tel_cel');
            }
            $this->form_validation->set_rules('cli_fran_cep', 'CEP', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('cli_fran_endereco', 'endereço', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('cli_fran_numero', 'número', 'trim|max_length[10]');
            $this->form_validation->set_rules('cli_fran_bairro', 'bairro', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('cli_fran_complemento', 'complemento', 'trim|max_length[145]');
            $this->form_validation->set_rules('cli_fran_cidade', 'cidade', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cli_fran_estado', 'estado', 'trim|required|exact_length[2]');
            
            if ($this->form_validation->run()) { 
                
                $data = elements(

                    array(
                        'cli_fran_cliente_id',
                        'cli_fran_pessoa',
                        'cli_fran_uni_consum',
                        'cli_fran_nome',
                        'cli_fran_email',
                        'cli_fran_tel_cel',
                        'cli_fran_cep',
                        'cli_fran_endereco',
                        'cli_fran_numero',
                        'cli_fran_bairro',
                        'cli_fran_complemento',
                        'cli_fran_cidade',
                        'cli_fran_estado',
                        'cli_fran_status',
                    ), $this->input->post()

            );
                
            if ($cli_fran_pessoa == 1) {
                $data['cli_fran_cpf_cnpj'] = $this->input->post('cli_fran_cpf');
            } else {
                $data['cli_fran_cpf_cnpj'] = $this->input->post('cli_fran_cnpj');
            }
            
            // Limpar dados maliciosos
            $data = html_escape($data);
            
            $this->core_model->update('clientes_franqueados', $data, array('cli_fran_id' => $cli_fran_id));
            
            redirect('orcamentos/clientes');
            
            } else {
                
                // Erro de validação
                $data = array(
            
                'titulo' => 'Atualizar cliente',

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

                'cliente' => $this->core_model->get_by_id('clientes_franqueados', array('cli_fran_id' => $cli_fran_id)),

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
               $this->load->view('orcamentos/clientes/edit');
               $this->load->view('orcamentos/layout/footer');
                
            }
            
        }
        
        
    }
    
    public function check_email($cli_fran_email) {
        
        $cli_fran_id = $this->input->post('cli_fran_id');
        
        if ($this->core_model->get_by_id('clientes_franqueados', array('cli_fran_email' => $cli_fran_email, 'cli_fran_id !=' => $cli_fran_id))) {
            $this->form_validation->set_message('check_email', 'Este e-mail já está cadatrado na base de dados');
            return FALSE;
        } else {
            return TRUE;
        }
        
    }
    
    public function check_tel_cel($cli_fran_tel_cel) {
        
        $cli_fran_id = $this->input->post('cli_fran_id');
        
        if ($this->core_model->get_by_id('clientes_franqueados', array('cli_fran_tel_cel' => $cli_fran_tel_cel, 'cli_fran_id !=' => $cli_fran_id))) {
            $this->form_validation->set_message('check_tel_cel', 'Este telefone/celualar já está cadatrado na base de dados');
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

        if ($this->input->post('cli_fran_id')) {

            $cli_fran_id = $this->input->post('cli_fran_id');

            if ($this->core_model->get_by_id('clientes_franqueados', array('cli_fran_id !=' => $cli_fran_id, 'cli_fran_cpf_cnpj' => $cnpj))) {
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

        if ($this->input->post('cli_fran_id')) {

            $cli_fran_id = $this->input->post('cli_fran_id');

            if ($this->core_model->get_by_id('clientes_franqueados', array('cli_fran_id !=' => $cli_fran_id, 'cli_fran_cpf_cnpj' => $cpf))) {
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
    
    public function nova_foto() {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('orcamentos/login'));
        }
        
        $this->load->model('orcamentos/usuarios_model', 'modelusuarios');
        
        $cliente_id = $this->input->post('cliente_id');
        $config['image_library'] = 'gd2';
        $config['upload_path'] = './public/images/franquias';
        $config['allowed_types'] = 'png';
        $config['file_name'] = $cliente_id.".png";
        $config['overwrite'] = TRUE;
        $this->load->library('image_lib', $config);

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {
            $config2['source'] = './public/images/orcamentos/'.$cliente_id.'.png';
            $config2['create_thumb'] = FALSE;
            $config2['width'] = 499;
            $config2['height'] = 143;

            $this->load->library('image_lib', $config2);

            if ($this->image_lib->resize()) {

                if ($this->modelusuarios->alterar_img($cliente_id)) {
                    redirect ('orcamentos/empresa/index/'.$cliente_id,'refresh');
                } else {
                    echo 'Houve um erro no sistema!';
                }

            } else {
                echo $this->image_lib->display_errors();
            }
        }
        
    }
    
    public function foto_perfil() {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('orcamentos/login'));
        }
        
        $this->load->model('orcamentos/usuarios_model', 'modelusuarios');
        
        $cliente_id = $this->input->post('cliente_id');
        $config['image_library'] = 'gd2';
        $config['upload_path'] = './public/images/perfil';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = $cliente_id.".jpg";
        $config['overwrite'] = TRUE;
        $this->load->library('image_lib', $config);

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {
            $config2['source'] = './public/images/perfil/'.$cliente_id.'.jpg';
            $config2['create_thumb'] = FALSE;
            $config2['width'] = 200;
            $config2['height'] = 200;

            $this->load->library('image_lib', $config2);

            if ($this->image_lib->resize()) {

                if ($this->modelusuarios->alterar_foto($cliente_id)) {
                    redirect ('orcamentos/perfil/index/'.$cliente_id,'refresh');
                } else {
                    echo 'Houve um erro no sistema!';
                }

            } else {
                echo $this->image_lib->display_errors();
            }
        }
        
    }
}