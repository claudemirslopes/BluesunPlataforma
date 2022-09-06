<?php

defined('BASEPATH') OR exit('Ação não permitida');

    class Projetos_model extends CI_Model {
        
        public function get_all() {
            
            //Array de um select com JOIN na base de dados
            $this->db->select([
                'projetos.*',
                'clientes.cliente_id',
                'clientes.cliente_nome',
                'clientes.cliente_sobrenome',
                'clientes.cliente_cpf_cnpj',
                'clientes_franqueados.cli_fran_id',
                'clientes_franqueados.cli_fran_nome',
                'clientes_franqueados.cli_fran_cpf_cnpj',
                'ordens_servicos.ordem_servico_id',
                'ordens_servicos.ordem_servico_id',
                'ordens_servicos.ordem_servico_pedido',
            ]);
            
            //Aqui faz as ligações com LEFT JOIN nas tabelas (produtos, categorias, marcas e fornecedores)
            $this->db->join('clientes', 'cliente_id = projeto_cliente_id', 'LEFT');
            $this->db->join('clientes_franqueados', 'cli_fran_id = projeto_cli_fran_id', 'LEFT');
            $this->db->join('ordens_servicos', 'ordem_servico_id = projeto_os_id', 'LEFT');
            
            //Retorna todos os resultados na tabela produtos,
            return $this->db->get('projetos')->result();
            
        }
        
        public function get_by_id($ticket_id = NULL) {
            
            //Array de um select com JOIN na base de dados
            $this->db->select([
                'projetos.*',
                'clientes.cliente_id',
                'clientes.cliente_nome',
                'clientes.cliente_sobrenome',
                'clientes.cliente_cpf_cnpj',
                'clientes_franqueados.cli_fran_id',
                'clientes_franqueados.cli_fran_nome',
                'clientes_franqueados.cli_fran_cpf_cnpj',
                'ordens_servicos.ordem_servico_id',
                'ordens_servicos.ordem_servico_id',
                'ordens_servicos.ordem_servico_pedido',
            ]);
            
            $this->db->where('projeto_id', $projeto_id);
            //Aqui faz as ligações com LEFT JOIN nas tabelas (tickets, users)
            $this->db->join('clientes', 'cliente_id = projeto_cliente_id', 'LEFT');
            $this->db->join('clientes_franqueados', 'cli_fran_id = projeto_cli_fran_id', 'LEFT');
            $this->db->join('ordens_servicos', 'ordem_servico_id = projeto_os_id', 'LEFT');
            
            //Retorna todos os resultados na tabela produtos,
            return $this->db->get('projetos')->row();
            
        }
        
    }
        