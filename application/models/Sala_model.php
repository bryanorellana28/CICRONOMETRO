<?php
class Sala_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();  
    }

    public function get_all_salas() {
        $query = $this->db->get('salas');
        return $query->result_array();
    }

    public function get_sala($id) {
        $query = $this->db->get_where('salas', array('id' => $id));
        return $query->row_array();
    }
    
    public function insert_sala($data) {
        return $this->db->insert('salas', $data);
    }

    public function update_sala($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('salas', $data);
    }

    public function delete_sala($id) {
        return $this->db->delete('salas', array('id' => $id));
    }
    public function actualizar_estado($id, $estado) {
        $this->db->where('id', $id);
        $this->db->update('salas', ['estadoactual' => $estado]);
    }
    
}
