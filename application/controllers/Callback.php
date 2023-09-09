<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Callback extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
    }

    public function handle()
    {
        $json = $this->input->raw_input_stream;

        $this->db->where('id', 1);  
        $query  =  $this->db->get('payment')->row_array();

        // Isi dengan private key anda
        $privateKey = $query['private_key'];
        $signa = $this->input->server('HTTP_X_CALLBACK_SIGNATURE');
        $event = $this->input->server('HTTP_X_CALLBACK_EVENT');
        
        $callbackSignature = isset($signa) ? $signa: '';
     
        // Generate signature untuk dicocokkan dengan X-Callback-Signature
        $signature = hash_hmac('sha256', $json, $privateKey);
        
        if ($callbackSignature !== $signature) {
            exit('Invalid signature');
        }

        if ('payment_status' !== $event) {
            echo 'Invalid callback event, no action was taken';
        }
        
        $data = json_decode($json);
        $uniqueRef = $data->merchant_ref;
        $status = strtoupper((string) $data->status);

        /*
        |--------------------------------------------------------------------------
        | Proses callback untuk closed payment
        |--------------------------------------------------------------------------
        */
        if (1 === (int) $data->is_closed_payment) {
          
            if ($status == 'PAID'){
                $stat = 'Success';
            } elseif ($status == 'EXPIRED'){
                $stat = 'Expired';
            } elseif ($status == 'FAILED'){
                $stat = 'Error';
            } elseif ($status == 'UNPAID'){
                $stat = 'Pending';
            }
            
            $update = [
                'status'         => $stat
            ];
            
            $this->db->where('kode_deposit', $uniqueRef);
            $this->db->update('deposit', $update);
            
            if ($status == 'PAID'){

                $data =  $this->db->get_where('deposit', ['kode_deposit' => $uniqueRef])->row_array();
                $users = $data['username'];
                $jumlah = $data['jumlah_transfer'];
    
                $data_user = $this->M_admin->get_user($users)->row_array();
                $saldo = $data_user['saldo'];
                $date = mediumdate_indo(date('Y-m-d'));
                $insert2 = [
                    'username' => $users,
                    'tipe' => 'Deposit',
                    'aksi' => 'Penambahan Saldo',
                    'nominal' => $data['get_saldo'],
                    'pesan' => 'Penambahan saldo melalui Deposit dengan Kode deposit : #' . $uniqueRef . '',
                    'date' => $date,
                    'time' => date('h:i:s')
                ];
    
                $this->db->insert('riwayat_saldo', $insert2);
    
                $update1 = [
                    'saldo'         => $saldo + $data['get_saldo']
                ];
    
                $this->db->where('username', $users);
                $this->db->update('users', $update1);
    
                $top_depo = $this->db->get_where('top_depo', ['username' => $users]);
                $top    = $top_depo->row_array();
    
                if ($top_depo->num_rows() == 0) {
                    $insert3 = [
                        'method' => 'Deposit',
                        'username' => $users,
                        'jumlah' => $jumlah,
                        'total' => 1,
                    ];
                    $this->db->insert('top_depo', $insert3);
                } else {
                    $update3 = [
                        'jumlah' => $top['jumlah'] + $jumlah,
                        'total'  => $top['total'] + 1,
                    ];
                    $this->db->where('username', $users);
                    $this->db->where('method', 'Deposit');
                    $this->db->update('top_depo', $update3);
                }
            } elseif ($status == 'EXPIRED'){
                $this->db->where('kode_deposit', $uniqueRef);
                $this->db->delete('deposit');
            }

            echo json_encode(['success' => true]);
            exit;
        }

    }
}
