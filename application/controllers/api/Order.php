<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Order extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('M_api');
		$this->load->helper('string');
	}

	public function index_post()
	{
		$api_id  = $this->input->post('api_id');
		$api_key  = $this->input->post('api_key');
		$id_layanan = $this->input->post('service');
		$target = $this->input->post('target');
		$jumlah = $this->input->post('quantity');

		$data1 = $this->M_api->get_Api_id($api_id);
		$data2 = $this->M_api->get_Api_key($api_key);
		$data = $this->M_api->get_Api($api_id, $api_key);

		$this->db->where('api_id', $api_id);
		$this->db->where('api_key', $api_key);
        $data_user = $this->db->get('users')->row_array();

		$users = $data_user['username'];
		
		$cek_layanan = $this->db->get_where('layanan', ['service_id' => $id_layanan]);
		$data_layanan = $cek_layanan->row_array();

		$this->db->where('layanan', $data_layanan['layanan']);
		$this->db->where('target', $target);
		$cek_pesanan = $this->db->get_where('pembelian', ['status' => 'Pending']);
		$data_provider = $this->db->get_where('provider', ['tipe' => 'SMM'])->row_array();
		$provider = $data_layanan['provider'];
		$layanan  = $data_layanan['layanan'];
		$cek_harga = $data_layanan['harga_api'] / 1000;
		$harga = $cek_harga * $jumlah;

		
		if ($api_id || $api_key) {
			if ($data1) {
				if ($data2) {

					if ($data) {

						$order_id = random_string('numeric', 6);
						$date = mediumdate_indo(date('Y-m-d'));
				
						// Get Start Count
						if ($data_layanan['kategori'] == "Instagram Likes" and "Instagram Likes Indonesia" and "Instagram Likes [Targeted Negara]" and "Instagram Likes/Followers Per Minute") {
							$start_count = likes_count($target);
						} else if ($data_layanan['kategori'] == "Instagram Followers No Refill/Not Guaranteed" and "Instagram Followers Indonesia" and "Instagram Followers [Negara]" and "Instagram Followers [Refill] [Guaranteed] [NonDrop]") {
							$start_count = followers_count($target);
						} else if ($data_layanan['kategori'] == "Instagram Views") {
							$start_count = views_count($target);
						} else {
							$start_count = 0;
						}

						if (!$cek_layanan->num_rows() == TRUE) {
							$this->response([
								'status' => FALSE,
								'data' => 'Ups, Layanan Tidak Tersedia!'
							], REST_Controller::HTTP_NOT_FOUND);
						} else if ($data_user['saldo'] < $harga) {
							$this->response([
								'status' => FALSE,
								'data' => 'Ups, Saldo kamu tidak mencukupi untuk melakukan pemesanan ini.'
							], REST_Controller::HTTP_NOT_FOUND);
						} else if ($cek_pesanan->num_rows() == TRUE) {
								$this->response([
									'status' => FALSE,
									'data' => 'Ups, Masih terdapat Pesanan dengan tujuan yang sama & berstatus Pending.'
								], REST_Controller::HTTP_NOT_FOUND);
						} else {

							$postdata = "api_id=" . $data_provider['api_id'] . "&api_key=" . $data_provider['api_key'] . "&service=" . $data_layanan['provider_id'] . "&target=$target&quantity=$jumlah";
							$url = $data_provider['link_order'];

							// var_dump($postdata);die;

								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL, $url);
								curl_setopt($ch, CURLOPT_POST, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								$chresult = curl_exec($ch);
								$json_result = json_decode($chresult, true);

								// var_dump($json_result);die;

								if ($json_result['status'] == false) {
									$this->response([
										'status' => FALSE,
										'data' => 'Ups, Gagal! Sistem Kami Sedang Mengalami Gangguan'
									], REST_Controller::HTTP_NOT_FOUND);
								} else {
									$provider_oid = $json_result['data']['id'];
								}

							$insert11 = [
								'oid'           => $order_id,
								'provider_oid'  => $provider_oid,
								'user'          => $users,
								'layanan'       => $layanan,
								'jumlah'        => $jumlah,
								'target'        => $target,
								'remains'       => $jumlah,
								'start_count'   => $start_count,
								'harga'         => $harga,
								'profit'        => '0',
								'status'        => 'Pending',
								'date'          => $date,
								'time'          => date('h:i:s'),
								'provider'      => $provider,
								'place_from'    => 'API',
								'refund'        => '0'
							];

							$cek_pesanan_data = $this->db->insert('pembelian', $insert11);

							if ($cek_pesanan_data == true) {

								$insert2 = [
									'username'  => $users,
									'tipe'      => 'Layanan',
									'aksi'      => 'Pengurangan Saldo',
									'nominal'   => $harga,
									'pesan'     => 'Mengurangi saldo melalui pemesanan Layanan dengan Kode pesanan : #' . $order_id . ' melalui API',
									'date'      => $date,
									'time'      => date('h:i:s')
								];

								$this->db->insert('riwayat_saldo', $insert2);

								$saldo_min = $data_user['saldo'] - $harga;
								$saldo_plus = $data_user['pemakaian_saldo'] + $harga;

								$this->db->set('saldo', $saldo_min);
								$this->db->set('pemakaian_saldo', $saldo_plus);
								$this->db->where('username', $users);
								$this->db->update('users');

								$check_top   = $this->db->get_where('top_users', ['username' => $users]);
								$data_top    = $check_top->row_array();

								$top_layanan = $this->db->get_where('top_layanan', ['layanan' => $layanan]);
								$data_lay    = $top_layanan->row_array();

								if ($check_top->num_rows() == 0) {
									$insert3 = [
										'method' => 'Order',
										'username' => $users,
										'jumlah' => $harga,
										'total' => 1,
									];
									$this->db->insert('top_users', $insert3);
								} else {
									$update3 = [
										'jumlah' => $data_top['jumlah'] + $harga,
										'total'  => $data_top['total'] + 1,
									];
									$this->db->where('username', $users);
									$this->db->where('method', 'Order');
									$this->db->update('top_users', $update3);
								}

								if ($top_layanan->num_rows() == 0) {
									$insert4 = [
										'method' => 'Layanan',
										'layanan' => $layanan,
										'jumlah' => $harga,
										'total' => 1,
									];
									$this->db->insert('top_layanan', $insert4);
								} else {
									$update4 = [
										'jumlah' => $data_lay['jumlah'] + $harga,
										'total'  => $data_lay['total'] + 1,
									];
									$this->db->where('method', 'Layanan');
									$this->db->where('layanan', $layanan);
									$this->db->update('top_layanan', $update4);
								}		
							}
						}

						$orderan = $this->M_api->get_Order($provider_oid);

						if ($orderan) {
							foreach ($orderan as $order) {
								$servarr[] = [
									'id'    => $order->oid,
									'price' => $order->harga
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