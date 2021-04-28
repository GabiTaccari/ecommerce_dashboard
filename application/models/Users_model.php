<?php

class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_login($user_login) 
    {
        $this->db
            ->select("id, email, password, roles_id")
            ->from("users")
            ->where("email", $user_login);
        $result = $this->db->get();

        if($result->num_rows() >0 ){
            return $result->row();
        } else {
            return NULL;
        }
    }
}