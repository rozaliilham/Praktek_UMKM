<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
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

    function get_berita()
    {
        $query = $this->db->order_by('id', 'DESC');
        $query = $this->db->limit(5);
        $query = $this->db->get_where('berita');
        return $query;
    }

    function get_kategori()
    {
        $query = $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('kategori_layanan');
        return $query;
    }

    function berita($limit, $start)
    {
        $query = $this->db->order_by('id', 'DESC');
        $query = $this->db->get('berita', $limit, $start);
        return $query;
    }

    function get_pembelian($users)
    {
        $this->db->where('user', $users);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get('pembelian');
        $riw_pem = array();
        if ($query !== FALSE && $query->num_rows() > 0) {
            $riw_pem = $query->result_array();
        }

        return $riw_pem;
    }

    // jumlah Total Pesanan

    function sum_order($users)
    {
        $status_array = array('Success', 'Partial');
        $this->db->or_where_in('status', $status_array);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }


    function tot_order($users)
    {
        $status_array = array('Success', 'Partial');
        $this->db->or_where_in('status', $status_array);
        $this->db->where('user', $users);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    //Top User
    function top_user()
    {

        $query = $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->limit(7);
        $query = $this->db->get_where('top_users');
        return $query;
    }

    //Top Deposit
    function top_depo()
    {

        $query = $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->limit(7);
        $query = $this->db->get_where('top_depo');
        return $query;
    }

    //Top Layanan
    function top_layanan()
    {

        $query = $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->limit(7);
        $query = $this->db->get_where('top_layanan');
        return $query;
    }

    //get aktifitas pagination
    function aktifitas($limit, $start, $users)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $kolom     = $this->input->post('kolom');
        $tipe      = $this->input->post('tipe');
        $aksi      = $this->input->post('aksi');

        $this->db->where('username', $users);

        if ($filter) {
            if (!empty($aksi)) {
                $this->db->where('aksi', $aksi);
            }
            if (!empty($kolom)) {
                $this->db->order_by($kolom, $tipe);
                if ($kolom == 'date') {
                    $this->db->order_by('time', $tipe);
                }
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }
        $query = $this->db->get('aktifitas', $limit, $start);
        return $query;
    }

    //get mutasi pagination
    function mutasi($limit, $start, $users)
    {
        $filter    = $this->input->post('filter');
        $kolom     = $this->input->post('kolom');
        $sortir     = $this->input->post('sortir');
        $aksi      = $this->input->post('aksi');
        $tipe      = $this->input->post('tipe');

        $this->db->where('username', $users);

        if ($filter) {
            if (!empty($aksi)) {
                $this->db->where('aksi', $aksi);
            }
            if (!empty($tipe)) {
                $this->db->where('tipe', $tipe);
            }
            if (!empty($sortir)) {
                $this->db->order_by($kolom, $sortir);
                if ($kolom == 'date') {
                    $this->db->order_by('time', $sortir);
                }
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('riwayat_saldo', $limit, $start);
        return $query;
    }

    //get daftar harga
    function riwayat_depo($limit, $start, $users)
    {
        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari      = $this->input->post('cari');

        $this->db->where('username', $users);

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('kode_deposit', $cari);
            }
        }

        $query = $this->db->get('deposit', $limit, $start);
        return $query;
    }

    //get pembelian
    function pembelian($limit, $start, $users)
    {
        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari      = $this->input->post('cari');

        $this->db->where('user', $users);

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('oid', $cari);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('pembelian', $limit, $start);
        return $query;
    }

    //get Daftar Tiket
    function tiket($limit, $start, $users)
    {
        $filter    = $this->input->post('filter');
        $kolom     = $this->input->post('kolom');
        $subjek    = $this->input->post('subjek');
        $status    = $this->input->post('status');

        $array = array('Pesanan', 'Deposit', 'Lainnya');
        $this->db->or_where_in('subjek', $array);
        $this->db->where('user', $users);

        if ($filter) {
            if (!empty($subjek)) {
                $this->db->where('subjek', $subjek);
            }
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($kolom)) {
                $this->db->order_by($kolom, 'DESC');
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('tiket', $limit, $start);
        return $query;
    }

    function pesan_tiket($id_tiket, $users)
    {
        $this->db->where('user', $users);
        $this->db->where('id_tiket', $id_tiket);
        $query = $this->db->get('balas_tiket');
        return $query;
    }

    //Daftar Harga pagination
    function daftar_harga($limit, $start)
    {
        //Cari aksi
        $filter    = $this->input->post('filter');
        $kolom     = $this->input->post('kolom');
        $tipe      = $this->input->post('tipe');
        $kategori  = $this->input->post('kategori');

        if ($filter) {
            if (!empty($kategori)) {
                $this->db->where('kategori', $kategori);
            }
            if (!empty($tipe)) {
                $this->db->order_by($kolom, $tipe);
            }
        }

        $query = $this->db->get('layanan', $limit, $start);
        return $query;
    }

    // ----------- Get Jquery ------------- //

    function get_deposit($kode, $users)
    {
        $this->db->or_where_in('kode_deposit', $kode);
        $this->db->where('username', $users);
        $query = $this->db->get('deposit');
        return $query->result_array();
    }

    function batal_deposit($kode, $users)
    {
        $this->db->or_where_in('kode_deposit', $kode);
        $this->db->where('username', $users);
        $this->db->set('status', 'Error');
        $query = $this->db->update('deposit');
        return $query;
    }

    function sum_reff($users)
    {
        $this->db->where('uplink', $users);
        return $this->db->get('riwayat_referral');
    }

    function referral($limit, $start, $users)
    {
        $this->db->where('username', $users);
        $this->db->where('tipe', 'Referral');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('riwayat_saldo', $limit, $start);
        return $query;
    }

    function daftar_referral($limit, $start, $users)
    {
        $filter    = $this->input->post('filter');
        $cari      = $this->input->post('cari');
        $kolom     = $this->input->post('kolom');
        $sortir     = $this->input->post('sortir');

        $this->db->where('uplink', $users);

        if ($filter) {
            if (!empty($cari)) {
                $this->db->where('username', $cari);
            }
            if (!empty($kolom)) {
                $this->db->order_by($kolom, $sortir);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $query = $this->db->get('users', $limit, $start);
        return $query;
    }


    function tot_referral($users)
    {
        $this->db->where('uplink', $users);
        $this->db->select_sum('jumlah_reff');
        return $this->db->get('users');
    }


    //get daftar harga
    function withdraw($limit, $start, $users)
    {
        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari      = $this->input->post('cari');

        $this->db->where('username', $users);

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
        $this->db->where('type', 'Referral');
        $query = $this->db->get('withdraw', $limit, $start);
        return $query;
    }

    //get daftar harga
    function data_withdraw($limit, $start, $users)
    {
        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari      = $this->input->post('cari');

        $this->db->where('username', $users);

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
        $this->db->where('type', 'Withdraw');
        $query = $this->db->get('withdraw', $limit, $start);
        return $query;
    }
}
