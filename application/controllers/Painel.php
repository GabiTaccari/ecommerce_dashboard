<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {
    public function index()
    {
        $dados['nome_usuario'] = 'Fulano';
        $dados['email_usuario'] = 'Fulano@gmail.com';
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("login", $dados);
    }
}