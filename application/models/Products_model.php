<?php

class Products_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_products()
    {
        $this->load->model("categories_model", "categoria");
        $resultado = $this->db->select("*")->from("products")->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['nome']=$r->name;
            $data[$i]['preco']=$r->price;
            if($r->status == '1') {
                $data[$i]['status']="Em estoque";
            } else {
                $data[$i]['status']="Inativo";
            }
            
            $cat = $this->categoria->get_one_category($r->categories_id);
            $data[$i]['categoria']=$cat[0]->name;
            $data[$i]['imagem']=$r->cover_image;
            $i++;
        }

        return $data;
    }

    public function get_one_product($id)
    {
        return $this->db->select("*")->from("products")->where("id", $id)->limit(1)->get()->result();
    }

    public function insert($data) {
        //$this->db->insert("products", $data);

        $this->db->query("INSERT INTO products (name, description, price, status, quantidade, necessario_cnpj, categories_id, cover_image) VALUES ('".$data["nome"]."', '".$data["descricao"]."', '".$data["preco"]."', '".$data["status"]."', '".$data["quantidade"]."', '".$data["necessario_cnpj"]."', '".$data["categoria"]."', '".$data["img"]."')");
        return $this->db->insert_id();
    }
}