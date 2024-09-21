<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_clients()
    {
        $query = $this->db->get('clientes');
        return $query->result_array();
    }

    public function get_client_by_id($id)
    {
        $query = $this->db->get_where('clientes', array('id' => $id));
        return $query->row_array();
    }

    public function insert_client($data)
    {
        return $this->db->insert('clientes', $data);
    }

    public function update_client($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('clientes', $data);
    }

    public function delete_client($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('clientes');
    }
}
