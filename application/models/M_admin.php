<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function get_user($users)
    {
        $this->db->where('username', $users);
        return $this->db->get('users');
    }

    //get daftar member
    function daftar_member($limit, $start)
    {
        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari      = $this->input->post('cari');
        $tipe      = $this->input->post('tipe');

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status_akun', $status);
            }
            if (!empty($cari)) {
                $this->db->like('username', $cari);
                $this->db->or_like('email', $cari);
                $this->db->or_like('nama', $cari);
            }
            if (!empty($tipe)) {
                $this->db->order_by('username', $tipe);
            }
        } else {
            $this->db->order_by('saldo', 'DESC');
        }

        $query = $this->db->get('users', $limit, $start);
        return $query;
    }

    function daftar_orderan($limit, $start)
    {
        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari      = $this->input->post('cari');
        $tipe      = $this->input->post('tipe');

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('oid', $cari);
            }
            if (!empty($tipe)) {
                $this->db->order_by('id', $tipe);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }
        $query = $this->db->get('pembelian', $limit, $start);
        return $query;
    }


    //Daftar Harga pagination
    function daftar_layanan($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $kolom     = $this->input->post('kolom');
        $tipe      = $this->input->post('tipe');
        $cari      = $this->input->post('cari');
        $kategori  = $this->input->post('kategori');

        if ($filter) {
            if (!empty($kategori)) {
                $this->db->where('kategori', $kategori);
            }
            if (!empty($tipe)) {
                $this->db->order_by($kolom, $tipe);
            }
            if (!empty($cari)) {
                $this->db->like('layanan', $cari);
                $this->db->or_like('kategori', $cari);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('layanan', $limit, $start);
        return $query;
    }

    //Daftar Harga pagination
    function daftar_kategori($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $cari    = $this->input->post('cari');
        $tipe      = $this->input->post('tipe');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->like('nama', $cari);
            }
            if (!empty($tipe)) {
                $this->db->order_by('nama', $tipe);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('kategori_layanan', $limit, $start);
        return $query;
    }


    function daftar_deposit($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $cari    = $this->input->post('cari');
        $tipe      = $this->input->post('tipe');
        $status      = $this->input->post('status');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->where('kode_deposit', $cari);
            }
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($tipe)) {
                $this->db->order_by('id', $tipe);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('deposit', $limit, $start);
        return $query;
    }


    function daftar_tiket($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $cari    = $this->input->post('cari');
        $tipe      = $this->input->post('tipe');
        $status      = $this->input->post('status');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->where('id_tiket', $cari);
            }
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($tipe)) {
                $this->db->order_by('id', $tipe);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('tiket', $limit, $start);
        return $query;
    }


    function daftar_berita($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $tipe      = $this->input->post('tipe');
        $status      = $this->input->post('status');

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($tipe)) {
                $this->db->order_by('id', $tipe);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('berita', $limit, $start);
        return $query;
    }


    function penggunaan_saldo($limit, $start)
    {
        //Cari cari
        $filter    = $this->input->post('filter');
        $sortir      = $this->input->post('sortir');
        $tipe      = $this->input->post('tipe');
        $cari      = $this->input->post('cari');

        if ($filter) {
            if (!empty($tipe)) {
                $this->db->where('tipe', $tipe);
            }
            if (!empty($cari)) {
                $this->db->where('username', $cari);
            }
            if (!empty($sortir)) {
                $this->db->order_by('id', $sortir);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('riwayat_saldo', $limit, $start);
        return $query;
    }


    function aktifitas_user($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $sortir      = $this->input->post('sortir');
        $aksi      = $this->input->post('aksi');
        $cari      = $this->input->post('cari');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->where('username', $cari);
            }
            if (!empty($aksi)) {
                $this->db->where('aksi', $aksi);
            }
            if (!empty($sortir)) {
                $this->db->order_by('id', $sortir);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('aktifitas', $limit, $start);
        return $query;
    }

    //Daftar Harga pagination
    function payment($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $cari    = $this->input->post('cari');
        $tipe      = $this->input->post('tipe');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->like('provider', $cari);
            }
            if (!empty($tipe)) {
                $this->db->order_by('provider', $tipe);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('metode_depo', $limit, $start);
        return $query;
    }


    function pesan_tiket($id_tiket, $users)
    {
        $this->db->where('user', $users);
        $this->db->where('id_tiket', $id_tiket);
        $query = $this->db->get('balas_tiket');
        return $query;
    }



    //get daftar harga
    function withdraw($limit, $start)
    {
        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari      = $this->input->post('cari');

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('kode', $cari);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('withdraw', $limit, $start);
        return $query;
    }
}
