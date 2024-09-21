<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->model('Usuario_model'); 
    }

    public function index()
    {
        $data['error'] = null;
        $this->load->view('login', $data);
    }

    public function autenticar()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $usuario = $this->Usuario_model->verificar_usuario($username, $password);

        if ($usuario) {
            redirect('dashboard');
        } else {
            $data['error'] = 'Usuario o contraseña incorrectos';
            $this->load->view('login', $data);
        }
    }
}
