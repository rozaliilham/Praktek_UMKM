<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Services extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('M_api');
	}

	public function index_post()
	{
		$data_provider = $this->db->get_where('provider', ['tipe' => 'SMM'])->row_array();
		$konv =  $this->db->get('konversi')->row_array();
		$p_apiid = $data_provider['api_id'];
		$p_apikey = $data_provider['api_key'];
		$url = $data_provider['link_layanan'];
		$code = $data_provider['code'];

		$postdata = array(
			'api_id' => $p_apiid,
			'api_key' => $p_apikey
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$chresult = curl_exec($ch);
		$result = json_decode($chresult, true);

		if ($result['status'] == true) {
			$this->db->where('provider', $code);
			$this->db->delete('kategori_layanan');

			$this->db->where('provider', $code);
			$this->db->delete('layanan');

			foreach ($result['data'] as $catte) {
				//INSERT KATEGORI
				$category = $catte['category'];
				$data_cat = $this->db->get_where('kategori_layanan', ['nama' => $category])->num_rows();
				if ($data_cat == 0) {
					$insert = [
						'nama'      => $category,
						'kode'      => $category,
						'provider'  => $code
					];

					$this->db->insert('kategori_layanan', $insert);
				}
			}

			//Harga Web
			$persen = $this->db->get_where('keuntungan', ['jenis' => 'WEB'])->row_array();
			if ($persen['status'] == 'Aktif') {
				$persentase = $persen['jumlah'];
			} elseif ($persen['status'] == 'Tidak Aktif') {
				$persentase = 40;
			}
			//Harga API
			$persen1 = $this->db->get_where('keuntungan', ['jenis' => 'API'])->row_array();
			if ($persen1['status'] == 'Aktif') {
				$persentase1 = $persen1['jumlah'];
			} elseif ($persen['status'] == 'Tidak Aktif') {
				$persentase1 = 40;
			}

			// get data service
			foreach ($result['data'] as $data) {

				$name = strtr($data['name'], array(
					$konv['a1']  => $konv['b1'],
					$konv['a2']  => $konv['b2'],
					$konv['a3']  => $konv['b3'],
					$konv['a4']  => $konv['b4'],
					$konv['a5']  => $konv['b5'],
					$konv['a6']  => $konv['b6'],
					$konv['a7']  => $konv['b7'],
					$konv['a8']  => $konv['b8']
				));
				$descc = strtr($data['description'], array(
					$konv['a1']  => $konv['b1'],
					$konv['a2']  => $konv['b2'],
					$konv['a3']  => $konv['b3'],
					$konv['a4']  => $konv['b4'],
					$konv['a5']  => $konv['b5'],
					$konv['a6']  => $konv['b6'],
					$konv['a7']  => $konv['b7'],
					$konv['a8']  => $konv['b8']
				));


				$tambah = [
					'service_id'  => $data['id'],
					'kategori'    => $data['category'],
					'layanan'     => $name,
					'catatan'     => $descc,
					'min'         => $data['min'],
					'max'         => $data['max'],
					'harga'       => ($data['price'] + $data['price'] * $persentase / 100),
					'harga_api'   => ($data['price'] + $data['price'] * $persentase1 / 100),
					'status'      => 'Aktif',
					'provider_id' => $data['id'],
					'provider'    => $code
				];

				$this->db->insert('layanan', $tambah);
			}
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
						$service = $this->M_api->get_Services();

						if ($service) {
							
							foreach ($service as $serv) {
								$servarr[] = [
									'id'       		=> $serv->service_id,
									'category' 		=> $serv->kategori,
									'name' 			=> $serv->layanan,
									'price' 		=> $serv->harga_api,
									'min' 			=> $serv->min,
									'max' 			=> $serv->max,
									'description'	=> $serv->catatan
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
								'data' => 'Ups, Layanan kosong!'
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
