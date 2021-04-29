<?php

class Categories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_one_category($id)
    {
        return $this->db->select("name")->from("categories")->where("id", $id)->limit(1)->get()->result();
    }

    public function get_all_categories()
    {
        $retorno = $this->db->select('*', false)
            ->from('categories')
            ->get()->result();

        foreach ($retorno as $r) {
            $ret[$r->id] = $r->name;
        }

        return $ret;
    }

    public function get_and_list_all_categories()
    {
        $resultado = $this->db->select("*")->from("categories")->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['nome']=$r->name;
           
            $i++;
        }

        return $data;
    }

    public function insert($data) {
        //$this->db->insert("products", $data);

        $this->db->query("INSERT INTO categories (name) VALUES ('".$data."')");
        return $this->db->insert_id();
    }
}