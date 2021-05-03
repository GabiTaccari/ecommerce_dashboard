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

    public function get_one_user($id)
    {
        return $this->db->select("*")->from("users")->where("id", $id)->limit(1)->get()->result();
    }

    public function get_all_users()
    {
        $this->load->model("roles_model", "roles");
        $resultado = $this->db->select("*")->from("users")->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['email']=$r->email;
            $role = $this->roles->get_one_role($r->roles_id);
            $data[$i]['roles']=$role[0]->name;
            $i++;
        }

        return $data;
    }

    public function liberarUsuario($id)
    {
        $data['roles_id']=8;
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return true;
    }

    public function bloquearUsuario($id)
    {
        $data['roles_id']=6;
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return true;
    }

    public function delete_one_user($id)
    {
        return $this->db->delete('users', array('id' => $id));
    }

    public function get_all_pendent_users()
    {
        $this->load->model("roles_model", "roles");
        $resultado = $this->db->select("*")->from("users")->where("roles_id", '6')->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['email']=$r->email;
            $role = $this->roles->get_one_role($r->roles_id);
            $data[$i]['roles']=$role[0]->name;
            $i++;
        }

        return $data;
    }

    public function get_all_released_users()
    {
        $this->load->model("roles_model", "roles");
        $resultado = $this->db->select("*")->from("users")->where("roles_id", '8')->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['email']=$r->email;
            $role = $this->roles->get_one_role($r->roles_id);
            $data[$i]['roles']=$role[0]->name;
            $i++;
        }

        return $data;
    }
}