<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function index()
    {
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("categories_model", "categorias");

        $dados['categorias_tabela'] = $this->categorias->get_and_list_all_categories();
        $dados['categorias'] =$this->categorias->get_all_categories();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_categorias", $dados);
    }

    public function ajax_save_categoria()
    {
        $categoria = $_POST['nome'];

        $this->load->model("categories_model", "categorias");

        $insert = $this->categorias->insert($_POST['nome']);

        if(!empty($insert)){
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function editarCategoria()
    {
        
    }
}