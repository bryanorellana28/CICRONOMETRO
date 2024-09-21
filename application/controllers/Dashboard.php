<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sala_model');
        $this->load->model('Clientes_model');
        $this->load->model('Paquetes_model');
        $this->load->model('Estadisticas_model'); // Añadimos el modelo Estadísticas
    }

    public function index() {
        $data['salas'] = $this->Sala_model->get_all_salas();
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
    public function actualizar_estado_sala() {
        $sala_id = $this->input->post('sala_id');
        $estado = $this->input->post('estado'); // 'ocupado' o 'libre'
    
        // Actualizar el estado en la base de datos
        $this->Sala_model->actualizar_estado($sala_id, $estado);
    
        echo json_encode(['status' => 'success']);
    }
    

    public function sala($id) {
        $data['sala'] = $this->Sala_model->get_sala($id);
        if (!$data['sala']) {
            show_404();
            return;
        }

        $data['clientes'] = $this->Clientes_model->get_all_clients();
        $data['paquetes'] = $this->Paquetes_model->get_all_paquetes();

       
        $this->load->view('dashboard/sala', $data);
    }

    public function obtener_precio_paquete() {
        $paquete_id = $this->input->post('paquete_id');
        $paquete = $this->Paquetes_model->get_paquete_by_id($paquete_id);

        if ($paquete) {
            $precio_por_hora = $paquete['precio_por_hora'];
            echo json_encode(['precio_por_hora' => $precio_por_hora]);
        } else {
            echo json_encode(['error' => 'Paquete no encontrado']);
        }
    }

    // Nueva función para guardar estadísticas al detener el cronómetro
    public function guardar_estadisticas() {
        $data = array(
            'cliente_id'    => $this->input->post('cliente_id'),
            'paquete_id'    => $this->input->post('paquete_id'),
            'sala_id'       => $this->input->post('sala_id'),
            'tipo_reloj'    => $this->input->post('tipo_reloj'),
            'tiempo_total'  => $this->input->post('tiempo_total'), // en segundos
            'costo_total'   => $this->input->post('costo_total')  // en formato decimal
        );

        $this->Estadisticas_model->insertar_estadistica($data);

        echo json_encode(['status' => 'success']);
    }
}
