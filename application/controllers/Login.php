<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function index()
    {
        
    }

    public function realizaLogin()
    {
        
        //echo password_hash("123456", PASSWORD_DEFAULT); die;
        if(!$this->input->is_ajax_request()){
            exit("Nenhum acesso de script direto permitido");
        }

        $username = $_POST['usuario'];
        $password = $_POST['senha'];

        if (empty($username)) {
            echo json_encode(array("status"=>false, "msg"=>"Usuário não deve ser vazio!"));
            exit();
            //ERRO USUARIO VAZIO
        } else {
            $this->load->model("users_model", "usuario");
            $result = $this->usuario->get_user_login($username);

            if ($result != NULL){
                $user_id = $result->id;
                $password_hash = $result->password;
                if(password_verify($password, $password_hash)) {
                    $this->load->library('session');
                    $this->session->set_userdata("user_id", $user_id);
                    $this->session->set_userdata("user_nome", $user_id);
                    echo json_encode(array("status"=>true, "msg"=>"Logando..."));
                    exit();
                } else {
                }
            } else {
                $json["status"]=0;
            }
            echo json_encode(array("status"=>false, "msg"=>"Usuário e/ou senha incorretos"));
            exit();
        }
    }
}