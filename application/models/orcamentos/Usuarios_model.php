<?php

defined('BASEPATH') OR exit('Ação não permitida');

    class Usuarios_model extends CI_Model {
        
        public $cliente_id;
        public $cliente_logo;


    public function __construct() {
        parent::__construct();    
    }   
    
    public function alterar_img($cliente_id) {
        $dados['cliente_logo'] = 1;
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->update('clientes', $dados);
    } 
    
    public function alterar_foto($cliente_id) {
        $dados['cliente_img'] = 1;
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->update('clientes', $dados);
    }
        
}
        