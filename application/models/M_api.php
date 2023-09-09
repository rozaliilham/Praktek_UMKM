<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_api extends CI_Model
{

    public function get_Api($api_id, $api_key)
    {
        $this->db->where('api_id', $api_id);
        $this->db->where('api_key', $api_key);
        return $this->db->get_where('users')->row_array();
    }

    public function get_Api_id($api_id)
    {
        $this->db->where('api_id', $api_id);
        return $this->db->get_where('users')->result_array();
    }

    public function get_Api_key($api_key)
    {
        $this->db->where('api_key', $api_key);
        return $this->db->get_where('users')->result_array();
    }

    public function get_Services()
    {
        $this->db->select("*");
        $this->db->from("layanan");
        $query = $this->db->get();
        return $query->result();
    }


    public function get_Order($provider_oid)
    {
        $this->db->where('provider_oid', $provider_oid);
        return $this->db->get_where('pembelian')->result();
    }
}
