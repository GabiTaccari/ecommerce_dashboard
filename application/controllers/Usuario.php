<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function index()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("users_model", "usuarios");

        $dados['usuarios_tabela'] = $this->usuarios->get_all_users();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        
        $this->load->view("listar_usuarios", $dados);
    }

    public function liberarUsuario()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $id = $_POST['id'];

        $this->load->model("users_model", "usuario");
        if($this->usuario->liberarUsuario($id)) {
            echo json_encode(array("status"=>true));
        }
    }

    public function bloquearUsuario()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $id = $_POST['id'];

        $this->load->model("users_model", "usuario");
        if($this->usuario->bloquearUsuario($id)) {
            echo json_encode(array("status"=>true));
        }
    }

    public function carregarEditaUsuario()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $id = $_POST['id'];
        $this->load->model("people_model", "pessoa");
        $this->load->model("users_model", "usuarios");
        $this->load->model("roles_model", "roles");

        $p = $this->pessoa->get_one_person_by_user($id);
        $u = $this->usuarios->get_one_user($id);
        //$permissao = $this->roles->get_one_role($u[0]->roles_id);

        echo json_encode(array("status"=>true,
                            "nome"=>$p[0]->name,
                            "doc"=>$p[0]->doc,
                            "phone"=>$p[0]->phone,
                            "email"=>$u[0]->email,
                            "password"=>$u[0]->password,
                            "roles"=>$u[0]->roles_id));
    }

    public function excluirUsuario()
    {
        $id = $_POST['id'];
		$this->load->model("users_model", "usuario");
        $this->load->model("people_model", "pessoa");
        $this->pessoa->delete_one_person($id);
		if($this->usuario->delete_one_user($id)) {
			echo json_encode(array("status" => true));
		} else{
            echo json_encode(array("status" => false, "msg"=>"Existem produtos vinculados a essa categoria!"));
        }
    }

    public function pendentes()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("users_model", "usuarios");

        $dados['usuarios'] = $this->usuarios->get_all_pendent_users();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_usuarios_pendentes", $dados);
    }

    public function liberados()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("users_model", "usuarios");

        $dados['usuarios'] = $this->usuarios->get_all_released_users();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_usuarios_liberados", $dados);
    }

    public function perfil()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("users_model", "usuarios");

        $dados['usuario'] = $this->usuarios->get_logged_user();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("perfil", $dados);
    }

    public function editarPerfil()
    {

    }
}