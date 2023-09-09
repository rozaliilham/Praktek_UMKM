<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_grafik extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // Data Grafik Pesanan Sosial Media

    function grafik7($users)
    {
        $date = mediumdate_indo(date('Y-m-d'));
        $this->db->where('date', $date);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }



    function grafik6($users)
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-1 day")));
        $this->db->where('date', $date);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }



    function grafik5($users)
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-2 day")));
        $this->db->where('date', $date);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }



    function grafik4($users)
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-3 day")));
        $this->db->where('date', $date);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }



    function grafik3($users)
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-4 day")));
        $this->db->where('date', $date);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }



    function grafik2($users)
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-5 day")));
        $this->db->where('date', $date);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }


    function grafik1($users)
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-6 day")));
        $this->db->where('date', $date);
        $this->db->where('user', $users);
        return $this->db->get('pembelian');
    }


    function sum_grafik7($users)
    {
        $date2 = mediumdate_indo(date('Y-m-d'));
        $array = array('user' => $users, 'date' => $date2);
        $this->db->or_where_in('status', 'Success');
        $this->db->where($array);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function sum_grafik6($users)
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-1 day")));
        $array = array('user' => $users, 'date' => $date2);
        $this->db->or_where_in('status', 'Success');
        $this->db->where($array);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function sum_grafik5($users)
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-2 day")));
        $array = array('user' => $users, 'date' => $date2);
        $this->db->or_where_in('status', 'Success');
        $this->db->where($array);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function sum_grafik4($users)
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-3 day")));
        $array = array('user' => $users, 'date' => $date2);
        $this->db->or_where_in('status', 'Success');
        $this->db->where($array);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function sum_grafik3($users)
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-4 day")));
        $array = array('user' => $users, 'date' => $date2);
        $this->db->or_where_in('status', 'Success');
        $this->db->where($array);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function sum_grafik2($users)
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-5 day")));
        $array = array('user' => $users, 'date' => $date2);
        $this->db->or_where_in('status', 'Success');
        $this->db->where($array);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function sum_grafik1($users)
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-6 day")));
        $array = array('user' => $users, 'date' => $date2);
        $this->db->or_where_in('status', 'Success');
        $this->db->where($array);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }


    /////////---------------- GRAFIK ADMIN --------------------/////////

    function Agrafik7()
    {
        $date = mediumdate_indo(date('Y-m-d'));
        $this->db->where('date', $date);
        return $this->db->get('pembelian');
    }



    function Agrafik6()
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-1 day")));
        $this->db->where('date', $date);
        return $this->db->get('pembelian');
    }



    function Agrafik5()
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-2 day")));
        $this->db->where('date', $date);
        return $this->db->get('pembelian');
    }



    function Agrafik4()
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-3 day")));
        $this->db->where('date', $date);
        return $this->db->get('pembelian');
    }



    function Agrafik3()
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-4 day")));
        $this->db->where('date', $date);
        return $this->db->get('pembelian');
    }



    function Agrafik2()
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-5 day")));
        $this->db->where('date', $date);
        return $this->db->get('pembelian');
    }


    function Agrafik1()
    {
        $date = mediumdate_indo(date('Y-m-d', strtotime("-6 day")));
        $this->db->where('date', $date);
        return $this->db->get('pembelian');
    }


    function Asum_grafik7()
    {
        $date2 = mediumdate_indo(date('Y-m-d'));
        $this->db->or_where_in('status', 'Success');
        $this->db->where('date', $date2);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function Asum_grafik6()
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-1 day")));
        $this->db->or_where_in('status', 'Success');
        $this->db->where('date', $date2);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function Asum_grafik5()
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-2 day")));
        $this->db->or_where_in('status', 'Success');
        $this->db->where('date', $date2);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function Asum_grafik4()
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-3 day")));
        $this->db->or_where_in('status', 'Success');
        $this->db->where('date', $date2);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function Asum_grafik3()
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-4 day")));
        $this->db->or_where_in('status', 'Success');
        $this->db->where('date', $date2);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function Asum_grafik2()
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-5 day")));
        $this->db->or_where_in('status', 'Success');
        $this->db->where('date', $date2);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    function Asum_grafik1()
    {
        $date2 = mediumdate_indo(date('Y-m-d', strtotime("-6 day")));
        $this->db->or_where_in('status', 'Success');
        $this->db->where('date', $date2);
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }



    /////// --------- Grafik Bulanan ---------//////////
    function Asum_1($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Jan ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_2($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Feb ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_3($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Mar ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_4($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Apr ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_5($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Mei ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_6($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Jun ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_7($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Jul ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_8($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Ags ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_9($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Sep ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_10($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Okt ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_11($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Nov ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    function Asum_12($tahun)
    {
        $this->db->or_where_in('status', 'Success');
        $this->db->like('date', 'Des ' . $tahun . '');
        $this->db->select_sum('harga');
        return $this->db->get('pembelian');
    }

    //Referral
    function Reff_1($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Jan ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_2($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Feb ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_3($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Mar ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_4($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Apr ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_5($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Mei ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_6($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Jun ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_7($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Jul ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_8($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Ags ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_9($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Sep ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_10($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Okt ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_11($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Nov ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }

    function Reff_12($users, $tahun)
    {
        $this->db->or_where_in('uplink', $users);
        $this->db->like('date', 'Des ' . $tahun . '');
        $this->db->select_sum('jumlah');
        return $this->db->get('riwayat_referral');
    }
}
