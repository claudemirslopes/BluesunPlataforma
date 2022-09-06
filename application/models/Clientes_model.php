<?php

defined('BASEPATH') OR exit('Ação não permitida');

    class Clientes_model extends CI_Model {
        
        public function get_all() {
            
            //Array de um select com JOIN na base de dados
            $this->db->select([
                'clientes.*',
            ]);
            
            $this->db->order_by('clientes.cliente_nome', 'ASC');
            
            //Retorna todos os resultados na tabela produtos,
            return $this->db->get('clientes')->result();
            
        }
    }
        