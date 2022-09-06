<?php

defined('BASEPATH') OR exit('Ação não permitida');

    class Usuarios_model extends CI_Model {
        
        public $id;
        public $foto_editor;


    public function __construct() {
        parent::__construct();    
    }   
    
    public function alterar_img($id) {
        $dados['foto_editor'] = 1;
        $this->db->where('id', $id);
        return $this->db->update('users', $dados);
    }
    
    public function alterar($senha,$id) {
        $dados['cliente_senha'] = md5($senha);
        $this->db->where('cliente_id', $id);
        return $this->db->update('clientes', $dados);
    }   
        
}
        