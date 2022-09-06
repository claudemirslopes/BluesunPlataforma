<?php

defined('BASEPATH') OR exit('Ação não permitida');

    class Avisos_model extends CI_Model {
        
        public function get_all() {
            
            $this->db->select('aviso_id as id, aviso_assunto as assunto, aviso_mensagem as mensagem, aviso_tipo as tipo, aviso_ativo as ativo');
            $this->db->from('avisos');

            $query = $this->db->get('avisos');

            return $this->db->query($query)->result_array();
        }
        
    }
        