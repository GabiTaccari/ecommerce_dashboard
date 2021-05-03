<?php

class Orders_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_orders()
    {
        $resultado = $this->db->select("*")->from("orders")->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['endereco']=$r->delivery_address;
            $data[$i]['pincode']=$r->pincode;
            $data[$i]['valor']=$r->price_total;
            $data[$i]['status']=$r->order_status;
            $i++;
        }

        return $data;
    }

    public function get_one_order($id)
    {
        return $this->db->select("*")->from("orders")->where("id", $id)->limit(1)->get()->result();  
    }

    public function atualizaCodigoRastreio($id, $codigo)
    {
        $data['track_code']=$codigo;
        $data['order_status']='trajeto';
        $this->db->where('id', $id);
        $this->db->update('orders', $data);

        return true;
    }

    public function get_pending_orders()
    {
        $resultado = $this->db->select("*")->from("orders")->where("order_status", "pendente")->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['endereco']=$r->delivery_address;
            $data[$i]['pincode']=$r->pincode;
            $data[$i]['valor']=$r->price_total;
            $data[$i]['status']=$r->order_status;
            $i++;
        }

        return $data;
    }

    public function get_sent_orders()
    {
        $resultado = $this->db->select("*")->from("orders")->where("order_status", "trajeto")->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['endereco']=$r->delivery_address;
            $data[$i]['pincode']=$r->pincode;
            $data[$i]['valor']=$r->price_total;
            $data[$i]['status']=$r->order_status;
            $i++;
        }

        return $data;
    }

    public function get_delivered_orders()
    {
        $resultado = $this->db->select("*")->from("orders")->where("order_status", "entregue")->get()->result();
        $data=array();
        $i=0;
        foreach($resultado as $r) 
        {
            $data[$i]['id']=$r->id;
            $data[$i]['endereco']=$r->delivery_address;
            $data[$i]['pincode']=$r->pincode;
            $data[$i]['valor']=$r->price_total;
            $data[$i]['status']=$r->order_status;
            $i++;
        }

        return $data;
    }
}