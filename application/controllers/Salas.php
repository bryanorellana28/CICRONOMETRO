<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sala_model');  
    }


    public function index() {
        $data['salas'] = $this->Sala_model->get_all_salas();
        $this->load->view('templates/sidebar');
        $this->load->view('salas/index', $data);
        $this->load->view('templates/footer');
    }


    public function create() {
        $this->load->view('templates/sidebar');
        $this->load->view('salas/create');
        $this->load->view('templates/footer');
    }


    public function store() {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'estadoactual' => '' 
        );
        $this->Sala_model->insert_sala($data);
        redirect('salas');
    }

   
    public function edit($id) {
        $data['sala'] = $this->Sala_model->get_sala($id);
        $this->load->view('templates/sidebar');
        $this->load->view('salas/edit', $data);
        $this->load->view('templates/footer');
    }

 
    public function update($id) {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion')
        );
        $this->Sala_model->update_sala($id, $data);
        redirect('salas');
    }

    public function delete($id) {
        $this->Sala_model->delete_sala($id);
        redirect('salas');
    }
}
