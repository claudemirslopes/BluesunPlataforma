<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Reclamacoes_model extends CI_Model {

    public function get_all() {
            
            //Array de um select com JOIN na base de dados
            $this->db->select([
                'reclamacoes.*',
                'orcamentos.orc_id',
                'orcamentos.orc_codigo',
                'orcamentos.orc_cli_nome',
                'clientes.cliente_id',
                'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
            ]);
            
            //Aqui faz as ligações com LEFT JOIN nas tabelas (reclamacoes, clientes_franqueados, clientes e os)
            $this->db->join('orcamentos', 'orc_id = reclama_orc_id', 'LEFT');
            $this->db->join('clientes', 'cliente_id = reclama_cli_id', 'LEFT');
            
            //Retorna todos os resultados na tabela produtos,
            return $this->db->get('reclamacoes')->result();
            
        }
        
    public function get_by_id($reclama_id = NULL) {
            
            //Array de um select com JOIN na base de dados
            $this->db->select([
                'reclamacoes.*',
                'orcamentos.orc_id',
                'orcamentos.orc_codigo',
                'orcamentos.orc_cli_nome',
                'clientes.cliente_id',
                'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
            ]);
            
            $this->db->where('reclama_id', $reclama_id);
            //Aqui faz as ligações com LEFT JOIN nas tabelas (reclamacoes, clientes_franqueados, clientes e os)
            $this->db->join('orcamentos', 'orc_id = reclama_orc_id', 'LEFT');
            $this->db->join('clientes', 'cliente_id = reclama_cli_id', 'LEFT');
            
            //Retorna todos os resultados na tabela produtos,
            return $this->db->get('reclamacoes')->row();
            
        }

}

