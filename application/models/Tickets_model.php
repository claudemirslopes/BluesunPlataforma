<?php

defined('BASEPATH') OR exit('Ação não permitida');

    class Tickets_model extends CI_Model {
        
        public function get_all() {
            
            //Array de um select com JOIN na base de dados
            $this->db->select([
                'tickets.*',
                'users.id',
                'users.first_name as user_nome',
                'users.last_name as user_sobrenome',
            ]);
            
            //Aqui faz as ligações com LEFT JOIN nas tabelas (produtos, categorias, marcas e fornecedores)
            $this->db->join('users', 'id = ticket_user_id', 'LEFT');
            
            //Retorna todos os resultados na tabela produtos,
            return $this->db->get('tickets')->result();
            
        }
        
        public function get_by_id($ticket_id = NULL) {
            
            //Array de um select com JOIN na base de dados
            $this->db->select([
                'tickets.*',
                'users.id',
                'users.first_name as user_nome',
                'users.last_name as user_sobrenome',
            ]);
            
            $this->db->where('ticket_id', $ticket_id);
            //Aqui faz as ligações com LEFT JOIN nas tabelas (tickets, users)
            $this->db->join('users', 'id = ticket_user_id', 'LEFT');
            
            //Retorna todos os resultados na tabela produtos,
            return $this->db->get('tickets')->row();
            
        }
        
    }
        