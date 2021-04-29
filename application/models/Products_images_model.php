<?php

class Products_images_model extends CI_Model { 

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }


    public function insert($data) {
        //$this->db->insert("products", $data);

        $insert = $this->db->query("INSERT INTO product_images (path, products_id) VALUES ('".$data["path"]."', '".$data["produto"]."')");
    }

    /**
     * @author: Vitor Bianchi
     */
    public function get_all_product_image($id)
    {
        $this->db
            ->select("id, path")
            ->from("product_images")
            ->where("products_id", $id);

        return $this->db->get()->result();
    }

    public function delete_product_images($id)
    {
        $this->db->delete('product_images', array('products_id' => $id));

        return true;
    }
}
?>