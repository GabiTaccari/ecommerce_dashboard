<?php

class People_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_one_person($id)
    {
        return $this->db->select("*")->from("people")->where("id", $id)->limit(1)->get()->result();
    }

    public function get_one_person_by_user($id)
    {
        return $this->db->select("*")->from("people")->where("users_id", $id)->limit(1)->get()->result();
    }

    public function delete_one_person($id)
    {
        $this->db->delete('people', array('users_id' => $id));

        return true;
    }
}