<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clientes_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['clientes'] = $this->Clientes_model->get_all_clients();
        $this->load->view('templates/sidebar');
        $this->load->view('clientes/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->view('templates/sidebar');
        $this->load->view('clientes/create');
    }

    public function store()
    {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'correo' => $this->input->post('correo')
        );
        $this->Clientes_model->insert_client($data);
        redirect('clientes');
    }

    public function edit($id)
    {
        $data['cliente'] = $this->Clientes_model->get_client_by_id($id);
        $this->load->view('templates/sidebar');
        $this->load->view('clientes/edit', $data);
    }

    public function update($id)
    {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'correo' => $this->input->post('correo')
        );
        $this->Clientes_model->update_client($id, $data);
        redirect('clientes');
    }

    public function delete($id)
    {
        $this->Clientes_model->delete_client($id);
        redirect('clientes');
    }
}
