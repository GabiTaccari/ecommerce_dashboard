<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {
    public function index()
    {
        $this->load->helper('url');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $dados['nome_usuario'] = 'Fulano';
        $dados['email_usuario'] = 'Fulano@gmail.com';
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("dashboard", $dados);
    }
}