<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venda extends CI_Controller {

    public function index()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("orders_model", "orders");

        $dados['produtos'] = $this->orders->get_all_orders();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_vendas", $dados);
    }

    public function listar()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }
        $id = $_GET['venda'];
        $this->load->model("orders_model", "orders");
        $this->load->model("order_product_model", "p_order");
        $this->load->model("people_model", "pessoa");
        $res = $this->orders->get_one_order($id);
        $prod_order = $this->p_order->get_products_by_order($id);
        $pessoa = $this->pessoa->get_one_person($res[0]->people_id);
        $dados['order'] = $res;
        $dados['prod'] = $prod_order;
        $dados['pessoa'] = $pessoa;
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        
        $this->load->view("listar_venda", $dados);
    }

    public function rastreio()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }
        $id = $_GET['venda'];
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("campo_rastreio", $dados);

    }

    public function salvaRastreamento()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }
        $id = $_POST['id'];
        $codigo=$_POST['codigo'];

        $this->load->model("orders_model", "order");

        if($this->order->atualizaCodigoRastreio($id, $codigo)){
            echo json_encode(array("status"=>true));
        } else{
            echo json_encode(array("status"=>false));
        }
    }

    public function pendentes()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("orders_model", "orders");

        $dados['produtos'] = $this->orders->get_pending_orders();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_vendas", $dados);
    }

    public function trajeto()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("orders_model", "orders");

        $dados['produtos'] = $this->orders->get_sent_orders();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_vendas", $dados);
    }

    public function concluidas()
    {
        $this->load->library('session');
        if(empty($this->session->userdata("user_id"))){
            //tratar sem acesso
            redirect('login/', 'refresh');
        }

        $this->load->model("orders_model", "orders");

        $dados['produtos'] = $this->orders->get_delivered_orders();
        $dados['nome_usuario'] = $this->session->userdata("user_email");
        $dados['email_usuario'] = $this->session->userdata("user_email");
        $dados['acesso_usuario'] = 'Administrador';
        $this->load->view("listar_vendas", $dados);
    }
}