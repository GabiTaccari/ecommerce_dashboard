<?php

class Categories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_one_category($id)
    {

        return $this->db->select("id, name")->from("categories")->where("id", $id)->limit(1)->get()->result();
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

    public function insert($data) 
    {
        $this->db->query("INSERT INTO categories (name) VALUES ('".$data."')");

        return $this->db->insert_id();
    }

    public function delete_one_category($id)
    {
        $this->load->model("products_model", "produtos");
        $categorias = $this->produtos->get_product_by_category($id);
        if(!empty($categorias)){

            return false;
        } else {
            $this->db->delete('categories', array('id' => $id));

            return true;
        }
    }

    public function update_one_category($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $data);

        return true;
    }
    
}