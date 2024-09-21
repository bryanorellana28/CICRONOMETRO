<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paquetes_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_paquetes()
    {
        $query = $this->db->get('paquetes');
        return $query->result_array();
    }

    public function insert_paquete($data)
    {
        return $this->db->insert('paquetes', $data);
    }

    public function get_paquete_by_id($id)
    {
        $query = $this->db->get_where('paquetes', array('id' => $id));
        return $query->row_array();
    }

    public function update_paquete($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('paquetes', $data);
    }

    public function delete_paquete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('paquetes');
    }
}
