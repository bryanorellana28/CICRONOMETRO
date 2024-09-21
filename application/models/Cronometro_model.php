<?php
class Cronometro_model extends CI_Model {

    public function iniciar($data) {
        $this->db->insert('cronometros', $data);
    }

    public function detener($sala_id) {
        $this->db->where('sala_id', $sala_id);
        $this->db->update('cronometros', ['estado' => 'inactivo']);
    }

    public function get_cronometro_activo($sala_id) {
        return $this->db->get_where('cronometros', ['sala_id' => $sala_id, 'estado' => 'activo'])->row_array();
    }
}
