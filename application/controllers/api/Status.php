<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Status extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_api');
    }

    public function index_post()
    {

        $status_array = array('Pending', 'Processing');
        $this->db->where_in('status', $status_array);
        $check_order = $this->db->get('pembelian')->result_array();
        $persen     = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();
        $date       = mediumdate_indo(date('Y-m-d'));

        foreach ($check_order as $data_order) {

            $o_oid = $data_order['oid'];
            $o_poid = $data_order['provider_oid'];
            $o_provider = $data_order['provider'];
            $o_harga = $data_order['harga'];
            $o_user = $data_order['user'];

            if ($o_provider == "MANUAL") {
            } else {

                $data_user   = $this->db->get_where('users', ['username' => $o_user])->row_array();
                $data_uplink = $data_user['uplink'];
                $data_reff   = $this->db->get_where('users', ['username' => $data_uplink])->row_array();


                $data_provider = $this->db->get_where('provider', ['tipe' => 'SMM'])->row_array();
                $p_apikey   = $data_provider['api_key'];
                $p_api_id   = $data_provider['api_id'];
                $url        = $data_provider['link_status'];

                $postdata = array(
                    'api_id' => $p_api_id,
                    'api_key' => $p_apikey,
                    'id' => $o_poid,
                );
                // echo json_encode($data);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $chresult = curl_exec($ch);
                $result = json_decode($chresult, true);
                // echo $result;
                $sn = $result['data']['status'];
                if (isset($result['status']) and $result['status'] == true) {
                    if ($sn == 'Success') {
                        $status = 'Success';
                    } elseif ($sn == 'Error') {
                        $status = 'Error';
                    } elseif ($sn == 'Partial') {
                        $status = 'Partial';
                    } elseif ($sn == 'Processing') {
                        $status = 'Processing';
                    } else {
                        $status = 'Pending';
                    }

                    $persen = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();
                    if ($persen['status'] == 'Aktif') {
                        if ($status == 'Success') {

                            $tambah = [
                                'username'  => $o_user,
                                'uplink'    => $data_uplink,
                                'kode'      => $data_reff['kode_referral'],
                                'jumlah'    => ($o_harga * $persen['jumlah'] / 100),
                                'date'      => $date,
                                'time'      => date('h:i:s')
                            ];

                            $this->db->insert('riwayat_referral', $tambah);

                            $tambah1 = [
                                'saldo'    => ($data_reff['saldo'] + $o_harga * $persen['jumlah'] / 100)
                            ];

                            $this->db->where('username', $data_uplink);
                            $this->db->update('users', $tambah1);

                            $tambah3 = [
                                'jumlah_reff'    => ($data_user['jumlah_reff'] + $o_harga * $persen['jumlah'] / 100)
                            ];

                            $this->db->where('username', $o_user);
                            $this->db->update('users', $tambah3);

                            $tambah4 = [
                                'username'  => $data_uplink,
                                'tipe'      => 'Referral',
                                'aksi'      => 'Penambahan Saldo',
                                'nominal'   => ($o_harga * $persen['jumlah'] / 100),
                                'pesan'     => 'Penambahan saldo melalui Referral dari member : ' . $o_user . '',
                                'date'      => $date,
                                'time'      => date('h:i:s')
                            ];

                            $this->db->insert('riwayat_saldo', $tambah4);

                            $tambah5 = [
                                'saldo_referral'    => ($data_reff['saldo_referral'] + $o_harga * $persen['jumlah'] / 100)
                            ];

                            $this->db->where('username', $data_uplink);
                            $this->db->update('users', $tambah5);
                        }
                    }

                    $start_count = (isset($result['data']['start_count'])) ? $result['data']['start_count'] : 0;
                    $remains = (isset($result['data']['remains'])) ? $result['data']['remains'] : 0;

                    $insert11 = [
                        'remains'       => $remains,
                        'start_count'   => $start_count,
                        'status'        => $status,
                        'date'          => $date,
                        'time'          => date('h:i:s')
                    ];

                    $this->db->where('oid', $o_oid);
                    $this->db->update('pembelian', $insert11);
                }
            }
        }

        ///Data Refund
        $status_array = array('Error', 'Partial');
        $this->db->where_in('status', $status_array);
        $this->db->where('refund', '0');
        $dataorderr = $this->db->get('pembelian')->result_array();

        foreach ($dataorderr as $data_orderr) {
            $o_oidd     = $data_orderr['oid'];
            $layanan    = $data_orderr['layanan'];
            $u_remains  = $data_orderr['remains'];
            $harga      = $data_orderr['harga'];
            $priceone   = $harga / $data_orderr['jumlah'];
            $refund     = $priceone * $u_remains;
            $buyer      = $data_orderr['user'];

            $data_userr = $this->db->get_where('users', ['username' => $buyer])->row_array();
            $saldo = $data_userr['saldo'];
            $p_saldo = $data_userr['pemakaian_saldo'];

            if ($u_remains == 0) {
                $refund = $harga;
            }
            $date = mediumdate_indo(date('Y-m-d'));
            $insert2 = [
                'date'          => $date,
                'time'          => date('h:i:s'),
                'refund'        => 1
            ];

            $this->db->where('oid', $o_oidd);
            $this->db->update('pembelian', $insert2);


            $insert3 = [
                'saldo'             => $saldo + $refund,
                'pemakaian_saldo'   => $p_saldo + $refund
            ];

            $this->db->where('username', $buyer);
            $this->db->update('users', $insert3);

            if ($data_orderr['status'] == 'Partial') {
                $status = 'Partial';
            } elseif ($data_orderr['status'] == 'Error') {
                $status = 'Error';
            }

            $insert4 = [
                'username' => $buyer,
                'tipe' => 'Layanan',
                'aksi' => 'Penambahan Saldo',
                'nominal' => $refund,
                'pesan' => 'Pengembalian Dana dari Pemesanan ' . $layanan . ' akibat Status pesanan ' . $status . ' dengan Kode pesanan : #' . $o_oidd . '',
                'date' => $date,
                'time' => date('h:i:s')
            ];

            $this->db->where('username', $buyer);
            $this->db->insert('riwayat_saldo', $insert4);
        }


		$api_id  = $this->input->post('api_id');
		$api_key  = $this->input->post('api_key');

        $data1 = $this->M_api->get_Api_id($api_id);
        $data2 = $this->M_api->get_Api_key($api_key);
        $data = $this->M_api->get_Api($api_id, $api_key);

        if ($api_id || $api_key) {
            if ($data1) {
                if ($data2) {

                    if ($data) {
                        $orderan = $this->M_api->get_Order();

                        if ($orderan) {
                            foreach ($orderan as $order) {
                                $servarr[] = [
                                    'id'    => $order->oid,
                                    'status'    => $order->status,
                                    'start_count'    => $order->start_count,
                                    'remains' => $order->remains
                                ];
                            }
							$this->response(
								[
									'status' => TRUE,
									'data' => $servarr
								],
								REST_Controller::HTTP_OK
							);

                        } else {
                            // Set the response and exit
                            $this->response([
                                'status' => FALSE,
                                'data' => 'Ups, Orderan kosong!'
                            ], REST_Controller::HTTP_NOT_FOUND);
                        }
                    } else {
                        // Set the response and exit
                        $this->response([
                            'status' => FALSE,
                            'data' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan'
                        ], REST_Controller::HTTP_NOT_FOUND);
                    }
                } else {
                    $this->response([
                        'status' => FALSE,
                        'data' => 'Ups, API_KEY kamu salah.'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $this->response([
                    'status' => FALSE,
                    'data' => 'Ups, API_ID kamu salah.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'data' => 'Ups, Permintaan Tidak Sesuai.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
