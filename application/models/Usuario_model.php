<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

  
    public function verificar_usuario($username, $password)
    {
        $this->db->where('nombre', $username);
        $this->db->where('password', $password); 
        $query = $this->db->get('usuarios');
        return $query->row_array();
    }


    public function get_usuarios()
    {
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }

  
    public function insert_usuario($nombre, $password)
    {
        $data = array(
            'nombre' => $nombre,
            'password' => $password
        );
        return $this->db->insert('usuarios', $data);
    }

  
    public function get_usuario_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('usuarios');
        return $query->row_array();
    }


    public function update_usuario($id, $nombre, $password)
    {
        $data = array(
            'nombre' => $nombre,
            'password' => $password
        );
        $this->db->where('id', $id);
        return $this->db->update('usuarios', $data);
    }

  
    public function delete_usuario($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('usuarios');
    }
}
