<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_service extends CI_Model
{

    function get_kategori()
    {
        $query = $this->db->order_by('nama', 'ASC');
        $query = $this->db->get_where('kategori_layanan');
        return $query;
    }
}
