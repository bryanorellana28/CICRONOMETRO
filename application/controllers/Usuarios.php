<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model'); 
        $this->load->helper('url');
    }   

    public function index()
    {
        $data['usuarios'] = $this->Usuario_model->get_usuarios();
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/index', $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/create');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $nombre = $this->input->post('nombre');
        $password = $this->input->post('password'); 
        $this->Usuario_model->insert_usuario($nombre, $password);
        redirect('usuarios');
    }

    public function edit($id)
    {
        $data['usuario'] = $this->Usuario_model->get_usuario_by_id($id);
        $this->load->view('templates/sidebar');
        $this->load->view('usuarios/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $nombre = $this->input->post('nombre');
        $password = $this->input->post('password');
        $this->Usuario_model->update_usuario($id, $nombre, $password);
        redirect('usuarios');
    }

    public function delete($id)
    {
        $this->Usuario_model->delete_usuario($id);
        redirect('usuarios');
    }
}
