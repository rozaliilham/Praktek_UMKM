<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Profile extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('M_api');
	}

	public function index_post()
	{
		$api_id  = $this->input->post('api_id');
		$api_key  = $this->input->post('api_key');

		$data1 = $this->M_api->get_Api_id($api_id);
		$data2 = $this->M_api->get_Api_key($api_key);
		$data = $this->M_api->get_Api($api_id, $api_key);

		if ($api_id || $api_key) {
			if ($data1) {
				if ($data2) {

					if ($data) {
						$this->response(
							[
								'status' => TRUE,
								'data' => [
									'username' => $data['username'],
									'full_name' => $data['nama'],
									'balance' => $data['saldo']
								]
							],
							REST_Controller::HTTP_OK
						);
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
