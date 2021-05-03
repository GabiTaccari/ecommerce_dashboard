<?php

class Roles_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_one_role($id)
    {
        return $this->db->select("*")->from("roles")->where("id", $id)->limit(1)->get()->result();
    }
}