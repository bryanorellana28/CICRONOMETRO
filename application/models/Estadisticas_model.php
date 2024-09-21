<?php
class Estadisticas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Función para insertar estadísticas
    public function insertar_estadistica($data) {
        return $this->db->insert('estadisticas', $data);
    }
}
