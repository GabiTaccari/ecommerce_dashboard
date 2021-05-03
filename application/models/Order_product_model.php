<?php

class Order_product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_products_by_order($id)
    {
        $resultado = $this->db->select("order_product.*, products.name")->from("order_product")
        ->join("products", "order_product.products_id = products.id")
        ->where("orders_id", $id)->get()->result();
        $data=array();

        $i=0;
        

        return $resultado;
    }
}