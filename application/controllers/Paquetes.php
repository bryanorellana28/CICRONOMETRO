<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paquetes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paquetes_model');
        $this->load->library('form_validation'); 
    }

    public function index()
    {
        $data['paquetes'] = $this->Paquetes_model->get_all_paquetes();
        $this->load->view('paquetes/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->view('paquetes/create');
    }

    public function store()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('precio_por_hora', 'Precio por Hora', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('paquetes/create');
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'descripcion' => $this->input->post('descripcion'),
                'precio_por_hora' => $this->input->post('precio_por_hora')
            );
            $this->Paquetes_model->insert_paquete($data);
            redirect('paquetes');
        }
    }

    public function edit($id)
    {
        $data['paquete'] = $this->Paquetes_model->get_paquete_by_id($id);

        if (empty($data['paquete'])) {
            show_404();
        }

        $this->load->view('paquetes/edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('precio_por_hora', 'Precio por Hora', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $data['paquete'] = $this->Paquetes_model->get_paquete_by_id($id);
            $this->load->view('paquetes/edit', $data);
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'descripcion' => $this->input->post('descripcion'),
                'precio_por_hora' => $this->input->post('precio_por_hora')
            );
            $this->Paquetes_model->update_paquete($id, $data);
            redirect('paquetes');
        }
    }

    public function delete($id)
    {
        $paquete = $this->Paquetes_model->get_paquete_by_id($id);

        if (empty($paquete)) {
            show_404();
        }

        $this->Paquetes_model->delete_paquete($id);
        redirect('paquetes');
    }
}
