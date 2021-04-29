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
}