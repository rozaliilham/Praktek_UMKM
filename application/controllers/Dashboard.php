<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('M_grafik');
        $this->load->model('M_payment');
        $this->load->helper('date');
        $this->load->helper('string');
    }

    // echo mediumdate_indo(date('Y-m-d'));
    // echo date('h:i:s');

    public function index()
    {

        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_user->get_user($users)->row_array();

        $data['type'] = "Dahboard | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();
        $data['referral'] = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();

        //Total Deposit
        $array = array('username' => $users, 'status' => 'Success');
        $this->db->where($array);
        $this->db->select_sum('get_saldo');
        $data['sum_depo'] = $this->db->get("deposit")->row_array();

        //Total Order
        $array = array('user' => $users, 'refund' => '0');
        $this->db->where($array);
        $this->db->select_sum('harga');
        $data['sum_order'] = $this->db->get("pembelian")->row_array();

        //Berita
        $data['berita'] = $this->M_user->get_berita()->result_array();
        // 10 Riwayat Pembelian
        $data['riw_pem'] = $this->M_user->get_pembelian($users);


        //Grafik User
        if (empty($this->M_grafik->grafik1($users)->row_array())) {
            $data['grafik1'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-6 day")))];
        } else {
            $data['grafik1'] = $this->M_grafik->grafik1($users)->row_array();
        }

        if (empty($this->M_grafik->grafik2($users)->row_array())) {
            $data['grafik2'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-5 day")))];
        } else {
            $data['grafik2'] = $this->M_grafik->grafik2($users)->row_array();
        }

        if (empty($this->M_grafik->grafik3($users)->row_array())) {
            $data['grafik3'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-4 day")))];
        } else {
            $data['grafik3'] = $this->M_grafik->grafik3($users)->row_array();
        }

        if (empty($this->M_grafik->grafik4($users)->row_array())) {
            $data['grafik4'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-3 day")))];
        } else {
            $data['grafik4'] = $this->M_grafik->grafik4($users)->row_array();
        }

        if (empty($this->M_grafik->grafik5($users)->row_array())) {
            $data['grafik5'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-2 day")))];
        } else {
            $data['grafik5'] = $this->M_grafik->grafik5($users)->row_array();
        }

        if (empty($this->M_grafik->grafik6($users)->row_array())) {
            $data['grafik6'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-1 day")))];
        } else {
            $data['grafik6'] = $this->M_grafik->grafik6($users)->row_array();
        }

        if (empty($this->M_grafik->grafik7($users)->row_array())) {
            $data['grafik7'] = ['date' => mediumdate_indo(date('Y-m-d'))];
        } else {
            $data['grafik7'] = $this->M_grafik->grafik7($users)->row_array();
        }

        $data['sum_grafik1'] = $this->M_grafik->sum_grafik1($users)->row_array();
        $data['sum_grafik2'] = $this->M_grafik->sum_grafik2($users)->row_array();
        $data['sum_grafik3'] = $this->M_grafik->sum_grafik3($users)->row_array();
        $data['sum_grafik4'] = $this->M_grafik->sum_grafik4($users)->row_array();
        $data['sum_grafik5'] = $this->M_grafik->sum_grafik5($users)->row_array();
        $data['sum_grafik6'] = $this->M_grafik->sum_grafik6($users)->row_array();
        $data['sum_grafik7'] = $this->M_grafik->sum_grafik7($users)->row_array();


        $data['grafik'] = $this->db->get_where('grafik_user')->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar');
        $this->load->view('user/index', $data);
        $this->load->view('user/footer', $data);
    }

    public function topuser()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata(
                'message',
                '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>'
            );
            redirect('auth');
        }


        $users = $this->session->userdata('username');
        $data['user'] = $this->M_user->get_user($users)->row_array();

        $data['type'] = "Top User | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        //Top User
        $data['top_user'] = $this->M_user->top_user()->result_array();
        $data['top_depo'] = $this->M_user->top_depo()->result_array();
        $data['top_layanan'] = $this->M_user->top_layanan()->result_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/topuser', $data);
        $this->load->view('user/footer', $data);
    }

    public function get_kategori()
    {
        $kategori = $this->input->post('kategori');
        if (isset($kategori)) {
            $this->db->where('kategori', $kategori);
            $this->db->where('status', 'Aktif');
            $query  =  $this->db->get('layanan');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                $options = '';
                $options .= '<option selected disabled>Pilih Layanan</option>';
                foreach ($result as $value) {
                    $options  .= '<option value="' . $value['service_id'] . '">' .
                        $value['layanan'] . '</option>';
                }
                echo $options;
            }
        }
    }


    public function get_layanan()
    {
        $layanan = $this->input->post('layanan');
        if (isset($layanan)) {
            $this->db->where('service_id', $layanan);
            $query  =  $this->db->get('layanan');
            $result =  $query->result_array();

            if (isset($result[0]) && is_array($result)) {
                $data['layanan']  = $result;
                $this->load->view('user/ajax/pesanan', $data);
            }
        }
    }

    
    public function get_jenis_oto()
    {
        $chanel = $this->M_payment->get_chanel();
        $jenis = $this->input->post('jenis_oto');
      
        if (isset($jenis)) {
            if (isset($chanel[0]) && is_array($chanel)) {
                // $options = '<option selected disabled>- Pilih Metode pembayaran -</option>';
                foreach ($chanel as $value) {
                    if($value['group'] == $jenis && $value['active'] == true){
                        $options = '<option value="' . $value['code'] . '">' . $value['name'] . ' (' . $value['code'] . ')</option>';
                        echo $options;
                    }
                }
            }
        }
    }


    public function riwayat_order()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Pesan Baru | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();


        $users = $this->session->userdata('username');

        // Pagination Tabel Order

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
        }

        $this->db->from("pembelian");
        //total row
        $config['base_url'] = site_url('dashboard/riwayat_order'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $tampil    = $this->input->post('tampil');
        if ($tampil == 10 || $tampil == 0) {
            $config['per_page'] = 10;
        } else {
            $config['per_page'] = $this->input->post('tampil');
        }

        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['order'] = $this->M_user->pembelian($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/history/order', $data);
        $this->load->view('user/footer', $data);
    }


    public function grafik()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_user->get_user($users)->row_array();

        $data['type'] = "Grafik Order | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        //Total Pesanan
        $data['sum_order'] = $this->M_user->sum_order($users)->num_rows();
        $data['tot_order'] = $this->M_user->tot_order($users)->row_array();

        //Grafik User
        if (empty($this->M_grafik->grafik1($users)->row_array())) {
            $data['grafik1'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-6 day")))];
        } else {
            $data['grafik1'] = $this->M_grafik->grafik1($users)->row_array();
        }

        if (empty($this->M_grafik->grafik2($users)->row_array())) {
            $data['grafik2'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-5 day")))];
        } else {
            $data['grafik2'] = $this->M_grafik->grafik2($users)->row_array();
        }

        if (empty($this->M_grafik->grafik3($users)->row_array())) {
            $data['grafik3'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-4 day")))];
        } else {
            $data['grafik3'] = $this->M_grafik->grafik3($users)->row_array();
        }

        if (empty($this->M_grafik->grafik4($users)->row_array())) {
            $data['grafik4'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-3 day")))];
        } else {
            $data['grafik4'] = $this->M_grafik->grafik4($users)->row_array();
        }

        if (empty($this->M_grafik->grafik5($users)->row_array())) {
            $data['grafik5'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-2 day")))];
        } else {
            $data['grafik5'] = $this->M_grafik->grafik5($users)->row_array();
        }

        if (empty($this->M_grafik->grafik6($users)->row_array())) {
            $data['grafik6'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-1 day")))];
        } else {
            $data['grafik6'] = $this->M_grafik->grafik6($users)->row_array();
        }

        if (empty($this->M_grafik->grafik7($users)->row_array())) {
            $data['grafik7'] = ['date' => mediumdate_indo(date('Y-m-d'))];
        } else {
            $data['grafik7'] = $this->M_grafik->grafik7($users)->row_array();
        }


        $data['sum_grafik1'] = $this->M_grafik->sum_grafik1($users)->row_array();
        $data['sum_grafik2'] = $this->M_grafik->sum_grafik2($users)->row_array();
        $data['sum_grafik3'] = $this->M_grafik->sum_grafik3($users)->row_array();
        $data['sum_grafik4'] = $this->M_grafik->sum_grafik4($users)->row_array();
        $data['sum_grafik5'] = $this->M_grafik->sum_grafik5($users)->row_array();
        $data['sum_grafik6'] = $this->M_grafik->sum_grafik6($users)->row_array();
        $data['sum_grafik7'] = $this->M_grafik->sum_grafik7($users)->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/grafik', $data);
        $this->load->view('user/footer', $data);
    }


    public function deposit()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Deposit Baru | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();
        $data['min_oto'] = $this->db->get('payment')->row_array();

        // $data['depo'] =  $this->db->get('metode_depo')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $users = $this->session->userdata('username');

        $this->form_validation->set_rules('jumlah', 'Jumlah Deposit', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/page/deposit', $data);
            $this->load->view('user/footer', $data);
        } else {

            $jenis     = $this->input->post('jenis');
            $jumlah    = $this->input->post('jumlah');
            $metode    = $this->input->post('metode');
            $catan     = $this->db->get_where('metode_depo', ['provider' => $metode])->row_array();
            $minimal   = $catan['minimal'];

            if ($minimal > $jumlah) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Deposit ' . $metode . ' minimal Rp ' . number_format($minimal, 0, ',', '.') . '
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/deposit');
            }

            $kode_deposit = 'INV' . random_string('numeric', 6);
            $rand_saldo = random_string('numeric', 3);

            $get_saldo    = substr($jumlah, 0, -3) . $rand_saldo;

            $pengirim = $this->input->post('pengirim');

            $deposit = [
                'kode_deposit' => $kode_deposit,
                'username' => $users,
                'tipe' => $jenis,
                'provider' => $metode,
                'pengirim' => $pengirim,
                'penerima' => $catan['nama_penerima'],
                'no_penerima' => $catan['tujuan'],
                'catatan' => $catan['catatan'],
                'jumlah_transfer' => $get_saldo,
                'get_saldo' => $get_saldo,
                'metode' => 'MAN',
                'status' => 'Pending',
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s')
            ];

            $this->db->where('username', $users);
            $this->db->insert('deposit', $deposit);

            $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
             Pembuatan Invoice Deposit berhasil!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('dashboard/deposit_transaksi/' . $kode_deposit . '');
        }
    }


    public function deposit_oto()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $users = $this->session->userdata('username');

        $this->form_validation->set_rules('jumlah', 'Jumlah Deposit', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/page/deposit', $data);
            $this->load->view('user/footer', $data);
        } else {

            $jenis     = $this->input->post('jenis');
            $jumlah    = $this->input->post('jumlah');
            $metode    = $this->input->post('metode');

            $catan     = 'Batas pembayaran kamu adalah 1 hari atau 24 jam setelah melakukan Deposit otomatis.<br>Segera lakukan pembayaran sesuai dengan No Penerima.';
            $minia     = $this->db->get('payment')->row_array();
            $minimal   = $minia['min'];

            if ($minimal > $jumlah) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Deposit ' . $metode . ' minimal Rp ' . number_format($minimal, 0, ',', '.') . '
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/deposit');
            }

            $kode_deposit = 1 . random_string('numeric', 5);
            $rand_saldo = random_string('numeric', 3);

            $pengirim = $this->input->post('pengirim');

            $chanel = $this->M_payment->req_payment($data['user']['id'], $kode_deposit, $jumlah, $metode);
            // var_dump($chanel);die;
            
            if ($jenis == 'E-Wallet') {
                $penerima = $chanel['qr_url'];
            }else{
                $penerima = $chanel['pay_code'];
            }
            $deposit = [
                'kode_deposit' => $kode_deposit,
                'username' => $users,
                'tipe' => $jenis,
                'provider' => $metode,
                'penerima' => $chanel['reference'],
                'no_penerima' => $penerima,
                'catatan' => $catan,
                'jumlah_transfer' => $jumlah,
                'get_saldo' => $jumlah,
                'metode' => 'OTO',
                'status' => 'Pending',
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s')
            ];

            $this->db->insert('deposit', $deposit);

            redirect($chanel['checkout_url']);
        }
    }


    public function deposit_transaksi()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Deposit Baru | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $users = $this->session->userdata('username');

        $kode = $this->uri->segment('3');
        $data['deposit'] = $this->M_user->get_deposit($kode, $users);

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/deposit_transaksi', $data);
        $this->load->view('user/footer', $data);
    }

    public function get_metode()
    {
        $jenis = $this->input->post('jenis');
        if (isset($jenis)) {

            $this->db->where('tipe', $jenis);
            $this->db->where('status', 'Aktif');
            $query  =  $this->db->get('metode_depo');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                $options = '';
                $options .= '<option selected disabled>Pilih Metode Transfer</option>';
                foreach ($result as $value) {
                    $options  .= '<option value="' . $value['provider'] . '">' .
                        $value['provider'] . '</option>';
                }
                echo $options;
            }
        }
    }

    public function batal_deposit()
    {

        $users = $this->session->userdata('username');
        $kode = $this->uri->segment('3');
        $this->M_user->batal_deposit($kode, $users);

        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                     Kamu telah berhasil membatalkan Deposit!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
        redirect('dashboard/deposit_transaksi/' . $kode . '');
    }

    public function get_metode_transfer()
    {
        $jenis = $this->input->post('jenis');
        if (isset($jenis)) {
            $this->db->where('tipe', $jenis);
            $this->db->where('status', 'Aktif');
            $query  =  $this->db->get('metode_depo');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                foreach ($result as $value) {
                    $options  = $value['tipe'];
                }
                if ($options == 'Transfer Bank') {
                    echo '<div class="form-group" id="pengirim">
                    <label>Nama Pengirim *</label>
                    <input type="text" class="form-control" name="pengirim">
                </div>';
                } elseif ($options == 'Transfer Ewallet') {
                    echo '<div class="form-group" id="pengirim">
                    <label>Nomor Hp Pengirim *</label>
                    <input type="number" class="form-control" name="pengirim">
                    <small>Contoh: 081234567XXX</small>
                </div>';
                }
            }
        }
    }

    public function get_metode_transfer_withdraw()
    {
        $jenis = $this->input->post('jenis');
        if (isset($jenis)) {
            $this->db->where('tipe', $jenis);
            $this->db->where('status', 'Aktif');
            $query  =  $this->db->get('metode_depo');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                foreach ($result as $value) {
                    $options  = $value['tipe'];
                }
                if ($options == 'Transfer Bank') {
                    echo '<div class="form-group" id="penerima">
                    <label>Nama Penerima *</label>
                    <input type="text" class="form-control" name="penerima">
                </div>';
                    echo '<div class="form-group" id="nomor">
                    <label>Nomor Rekening *</label>
                    <input type="number" class="form-control" name="nomor">
                </div>';
                } elseif ($options == 'Transfer Ewallet') {
                    echo '<div class="form-group" id="penerima">
                    <label>Nama Penerima *</label>
                    <input type="text" class="form-control" name="penerima">
                </div>';
                    echo '<div class="form-group" id="penerima">
                        <label>Nomor Hp Penerima *</label>
                        <input type="number" class="form-control" name="nomor">
                        <small>Contoh: 081234567XXX</small>
                    </div>';
                }
            }
        }
    }


    public function get_catatan()
    {
        $metode = $this->input->post('metode');
        if (isset($metode)) {

            $this->db->where('provider', $metode);
            $this->db->where('status', 'Aktif');
            $query  =  $this->db->get('metode_depo');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                foreach ($result as $value) {
                    $options  = $value['catatan'];
                }
                echo $options;
            }
        }
    }


    public function get_minimal()
    {
        $metode = $this->input->post('metode');
        if (isset($metode)) {
            $this->db->where('provider', $metode);
            $this->db->where('status', 'Aktif');
            $query  =  $this->db->get('metode_depo');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                foreach ($result as $value) {
                    $options  = 'Rp ' . number_format($value['minimal'], 0, ',', '.');
                }
                echo $options;
            }
        }
    }



    public function riwayat_depo()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Riwayat Deposit | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users = $this->session->userdata('username');

        // Pagination Tabel Depo

        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari    = $this->input->post('cari');

        $this->db->where('username', $users);
        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('kode_deposit', $cari);
            }
        }

        $this->db->from("deposit");
        //total row
        $config['base_url'] = site_url('dashboard/riwayat_depo'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $tampil    = $this->input->post('tampil');
        if ($tampil == 10 || $tampil == 0) {
            $config['per_page'] = 10;
        } else {
            $config['per_page'] = $this->input->post('tampil');
        }
        //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['deposit'] = $this->M_user->riwayat_depo($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/history/deposit', $data);
        $this->load->view('user/footer', $data);
    }


    public function buat_tiket()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Buat Tiket | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users = $this->session->userdata('username');

        $this->form_validation->set_rules('pesan', 'Pesan', 'required|trim|max_length[1500]', [
            'max_length' => 'Kolom Pesan tidak boleh lebih dari 1500 karakter.',
            'required' => 'Kolom Pesan harus di isi.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/page/tiket', $data);
            $this->load->view('user/footer', $data);
        } else {
            $rand = 1 . random_string('numeric', 3);
            $time = mediumdate_indo(date('Y-m-d')) . ' - ' . date('h:i:s');
            // load success template...
            $masuk = [
                'id_tiket' => $rand,
                'pengirim' => 'Member',
                'user' => $users,
                'subjek' => $this->security->xss_clean($this->input->post('subjek')),
                'pesan' => $this->security->xss_clean($this->input->post('pesan')),
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s'),
                'update_terakhir' => $time,
                'status' => 'Pending'
            ];

            $this->db->insert('tiket', $masuk);

            $balas = [
                'id_tiket' => $rand,
                'pengirim' => 'Member',
                'user' => $users,
                'pesan' => $this->security->xss_clean($this->input->post('pesan')),
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s'),
                'this_user' => 1,
                'this_admin' => 0
            ];
            $this->db->insert('balas_tiket', $balas);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success!</strong> Tiket kamu berhasil di kirim!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>'
            );
            redirect('dashboard/daftar_tiket');
        }
    }


    public function daftar_tiket()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Daftar Tiket | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();


        $users = $this->session->userdata('username');

        // Pagination Tabel Tiket

        $filter    = $this->input->post('filter');
        $subjek    = $this->input->post('subjek');
        $status     = $this->input->post('status');

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
        }

        $this->db->from("tiket");
        //total row
        $config['base_url'] = site_url('dashboard/daftar_tiket'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 10;  //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['tiket'] = $this->M_user->tiket($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/daftar_tiket', $data);
        $this->load->view('user/footer', $data);
    }


    public function daftar_harga()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Daftar Harga | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        // Pagination Tabel Daftar Harga
        $data['kategori'] = $this->M_user->get_kategori()->result_array();

        $filter    = $this->input->post('filter');
        $kolom     = $this->input->post('kolom');
        $kategori  = $this->input->post('kategori');
        $tipe      = $this->input->post('tipe');

        if ($filter) {
            if (!empty($kategori)) {
                $this->db->where('kategori', $kategori);
            }
            if (!empty($tipe)) {
                $this->db->order_by($kolom, $tipe);
            }
        }
        $this->db->from("layanan");

        $config['base_url'] = site_url('dashboard/daftar_harga'); //site url
        $config['total_rows'] = $this->db->count_all_results(); //total row

        $config['per_page'] = 20;  //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['layanan'] = $this->M_user->daftar_harga($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/daftar_harga', $data);
        $this->load->view('user/footer', $data);
    }


    public function kontak()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Kontak kami | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/halaman/kontak', $data);
        $this->load->view('user/footer', $data);
    }


    public function ketentuan()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Ketentuan Layanan | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/halaman/ketentuan', $data);
        $this->load->view('user/footer', $data);
    }


    public function pertanyaan()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Pertanyaan Umum | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/halaman/pertanyaan', $data);
        $this->load->view('user/footer', $data);
    }


    public function aktifitas()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Log Aktifitas | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $users = $this->session->userdata('username');

        // $data['aktifitas'] = $this->M_user->aktifitas($users)->result_array();

        //Cari aksi
        $filter    = $this->input->post('filter');
        $aksi      = $this->input->post('aksi');

        $this->db->where('username', $users);
        if ($filter) {
            if (!empty($aksi)) {
                $this->db->where('aksi', $aksi);
            }
        }
        $this->db->from("aktifitas");
        //total row
        $config['base_url'] = site_url('dashboard/aktifitas'); //site url
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 15;  //show record per halaman
        $config["num_links"] = 5;
        $data['total'] = $config["total_rows"];

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function aktifitas yang ada pada mmodel M_user. 
        $data['aktifitas'] = $this->M_user->aktifitas($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();

        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/halaman/aktifitas', $data);
        $this->load->view('user/footer', $data);
    }


    public function mutasi()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Mutasi Saldo | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users = $this->session->userdata('username');

        //Cari aksi
        $filter    = $this->input->post('filter');
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
        }

        $this->db->from("riwayat_saldo");
        //total row
        $config['base_url'] = site_url('dashboard/mutasi'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 10;  //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['mutasi'] = $this->M_user->mutasi($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/halaman/mutasi', $data);
        $this->load->view('user/footer', $data);
    }

    public function berita()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
         Silahkan masuk terlebih dahulu!
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
     </div>'
            );
            redirect('auth');
        }

        $data['type'] = "Berita dan informasi | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();


        $config['base_url'] = site_url('dashboard/berita'); //site url
        $config['total_rows'] = $this->db->count_all('berita'); //total row

        $config['per_page'] = 10;  //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['berita'] = $this->M_user->berita($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar');
        $this->load->view('user/page/berita', $data);
        $this->load->view('user/footer', $data);
    }

    public function pesanbaru()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $data['type'] = "Pesan Baru | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data_user = $data['user'];
        $users = $this->session->userdata('username');

        $data['kategori'] = $this->M_service->get_kategori()->result();
        $data['validasi'] = $this->form_validation->set_message('target', 'is-invalid');

        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required', [
            'required' => 'Pilih kategori dahulu.'
        ]);
        $this->form_validation->set_rules('layanan', 'Layanan', 'trim|required', [
            'required' => 'Pilih layanan dahulu.'
        ]);
        $this->form_validation->set_rules('target', 'Target', 'trim|required', [
            'required' => 'Kolom Target tidak boleh kosong.'
        ]);
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required', [
            'required' => 'Kolom Jumlah tidak boleh kosong.'
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/page/pesanbaru', $data);
            $this->load->view('user/footer', $data);
        } else {

            $id_layanan = $this->input->post('layanan');
            $target = $this->input->post('target');
            $jumlah = $this->input->post('jumlah');

            $cek_layanan = $this->db->get_where('layanan', ['service_id' => $id_layanan]);
            $data_layanan = $cek_layanan->row_array();

            $this->db->where('layanan', $data_layanan['layanan']);
            $this->db->where('target', $target);
            $cek_pesanan = $this->db->get_where('pembelian', ['status' => 'Pending']);
            $data_provider = $this->db->get_where('provider', ['code' => $data_layanan['provider']])->row_array();
            $provider = $data_layanan['provider'];
            $layanan  = $data_layanan['layanan'];
            $cek_harga = $data_layanan['harga'] / 1000;
            $harga = $cek_harga * $jumlah;

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
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Ups, Layanan Tidak Tersedia!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
                redirect('dashboard/pesanbaru');
            } else if ($jumlah < $data_layanan['min']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Ups, Minimal jumlah pemesanan Adalah ' . number_format($data_layanan['min'], 0, ',', '.') . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
                redirect('dashboard/pesanbaru');
            } else if ($jumlah > $data_layanan['max']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Ups, Maksimal jumlah pemesanan Adalah ' . number_format($data_layanan['max'], 0, ',', '.') . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
                redirect('dashboard/pesanbaru');
            } else if ($data_user['saldo'] < $harga) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Yahh, Saldo kamu tidak mencukupi untuk melakukan pemesanan ini.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
                redirect('dashboard/pesanbaru');
            } else if ($cek_pesanan->num_rows() == TRUE) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Ups, Masih terdapat Pesanan dengan tujuan yang sama & berstatus Pending.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
                redirect('dashboard/pesanbaru');
            } else {

                $postdata = "api_id=" . $data_provider['api_id'] . "&api_key=" . $data_provider['api_key'] . "&service=" . $data_layanan['provider_id'] . "&target=$target&quantity=$jumlah";
                $url = $data_provider['link_order'];

                //var_dump($postdata);die;

                if ($provider == "MANUAL") {
                    $provider_oid = random_string('numeric', 6);
                } else {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $chresult = curl_exec($ch);
                    $json_result = json_decode($chresult, true);

                    //var_dump($json_result);die;
                    
                    if ($json_result['status'] == false) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ups, ' . $json_result['data'] . '</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                        redirect('dashboard/pesanbaru');
                    } else {

                        $provider_oid = $json_result['data']['id'];
                    }
                }


                $order_id = random_string('numeric', 6);
                $date = mediumdate_indo(date('Y-m-d'));

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
                    'place_from'    => 'Website',
                    'refund'        => '0'
                ];

                $cek_pesanan_data = $this->db->insert('pembelian', $insert11);

                if ($cek_pesanan_data == true) {

                    $insert2 = [
                        'username'  => $users,
                        'tipe'      => 'Layanan',
                        'aksi'      => 'Pengurangan Saldo',
                        'nominal'   => $harga,
                        'pesan'     => 'Mengurangi saldo melalui pemesanan Layanan dengan Kode pesanan : #' . $order_id . '',
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
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Berhasil!</strong> Pesanan ' . $layanan . ' Telah kami terima.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                    );
                    redirect('dashboard/pesanbaru');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Ups, Orderan Gagal!</strong> Sistem kami sedang Mengalami gangguan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                    );
                    redirect('dashboard/pesanbaru');
                }
            }
        }
    }


    public function referral()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_user->get_user($users)->row_array();

        $data['type'] = "Grafik Referral | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        //Total Pesanan
        $data['tot_reff'] = $this->M_user->tot_referral($users)->row_array();
        $data['sum_reff'] = $this->M_user->sum_reff($users)->num_rows();

        //==== Grafik Bulanan ------------//
        $grafik = $this->db->get_where('grafik_user')->row_array();
        $tahun = $grafik['tahun_ref'];
        $data['grafik'] = $grafik;
        $data['jan'] = $this->M_grafik->Reff_1($users, $tahun)->row_array();
        $data['feb'] = $this->M_grafik->Reff_2($users, $tahun)->row_array();
        $data['mar'] = $this->M_grafik->Reff_3($users, $tahun)->row_array();
        $data['apr'] = $this->M_grafik->Reff_4($users, $tahun)->row_array();
        $data['mei'] = $this->M_grafik->Reff_5($users, $tahun)->row_array();
        $data['jun'] = $this->M_grafik->Reff_6($users, $tahun)->row_array();
        $data['jul'] = $this->M_grafik->Reff_7($users, $tahun)->row_array();
        $data['ags'] = $this->M_grafik->Reff_8($users, $tahun)->row_array();
        $data['sep'] = $this->M_grafik->Reff_9($users, $tahun)->row_array();
        $data['okt'] = $this->M_grafik->Reff_10($users, $tahun)->row_array();
        $data['nov'] = $this->M_grafik->Reff_11($users, $tahun)->row_array();
        $data['des'] = $this->M_grafik->Reff_12($users, $tahun)->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/referral', $data);
        $this->load->view('user/footer', $data);
    }



    public function riwayat_referral()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Riwayat Referral | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users = $this->session->userdata('username');

        $this->db->where('username', $users);
        $this->db->where('tipe', 'Referral');
        $this->db->from("riwayat_saldo");
        //total row
        $config['base_url'] = site_url('dashboard/riwayat_referral'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 10;  //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['referral'] = $this->M_user->referral($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/history/referral', $data);
        $this->load->view('user/footer', $data);
    }



    public function daftar_referral()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Daftar Referral | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['bonus'] = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();

        $users = $this->session->userdata('username');
        //Cari 
        $filter    = $this->input->post('filter');
        $cari      = $this->input->post('cari');

        $this->db->where('uplink', $users);

        if ($filter) {
            if (!empty($cari)) {
                $this->db->where('username', $cari);
            }
        }

        $this->db->from("users");
        //total row
        $config['base_url'] = site_url('dashboard/daftar_referral'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 10;  //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['referral'] = $this->M_user->daftar_referral($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination
        $data['tot_reff'] = $this->M_user->tot_referral($users)->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/daftar_referral', $data);
        $this->load->view('user/footer', $data);
    }


    public function update_grafik_user1()
    {
        $update = [
            'min'        => $this->input->post('min'),
            'max'        => $this->input->post('max')
        ];

        $this->db->update('grafik_user', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Perubahan Grafik berhasil di simpan :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('dashboard');
    }


    public function update_grafik_user()
    {
        $update = [
            'min_ref'        => $this->input->post('min_ref'),
            'max_ref'        => $this->input->post('max_ref'),
            'tahun_ref'        => $this->input->post('tahun_ref')
        ];

        $this->db->update('grafik_user', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Perubahan berhasil di simpan :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('dashboard/referral');
    }




    public function tarik_referral()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Withdraw Referral | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data_user = $data['user'];

        $users = $this->session->userdata('username');

        $this->form_validation->set_rules('jenis', '', 'required|trim');
        $this->form_validation->set_rules('metode', '', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/page/tarik_referral', $data);
            $this->load->view('user/footer', $data);
        } else {

            $metode    = $this->input->post('metode');
            $jumlah    = $data_user['saldo_referral'];
            $penerima  = $this->input->post('penerima');
            $nomor     = $this->input->post('nomor');
            $minimal   = '50000';

            if ($penerima == NULL) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Nama penerima wajib diisi.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/tarik_referral');
            }
            if ($nomor == NULL) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Nomor penerima wajib diisi.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/tarik_referral');
            } elseif ($minimal > $jumlah) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Minimal withdraw Rp ' . number_format($minimal, 0, ',', '.') . '
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/tarik_referral');
            }

            $kode = 2 . random_string('numeric', 5);

            $this->db->set('saldo_referral', 0);
            $this->db->where('username', $users);
            $this->db->update('users');

            $date = mediumdate_indo(date('Y-m-d'));
            $insert2 = [
                'username' => $users,
                'tipe' => 'Referral',
                'aksi' => 'Pengurangan Saldo',
                'nominal' => $jumlah,
                'pesan' => 'Pengurangan saldo melalui Withdraw dengan Kode withdraw : #' . $kode . '',
                'date' => $date,
                'time' => date('h:i:s')
            ];

            $this->db->insert('riwayat_saldo', $insert2);

            $withdraw = [
                'kode' => $kode,
                'username' => $users,
                'via' => $metode,
                'penerima' => $penerima,
                'nomor' => $nomor,
                'jumlah' => $jumlah,
                'type' => 'Referral',
                'status' => 'Pending',
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s')
            ];

            $this->db->insert('withdraw', $withdraw);

            $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Withdraw saldo referral berhasil di buat! Silahkan konfirmasi ke Admin.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('dashboard/daftar_withdraw');
        }
    }


    public function daftar_withdraw()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Withdraw Referral | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users = $this->session->userdata('username');

        // Pagination Tabel Depo

        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari    = $this->input->post('cari');

        $this->db->where('username', $users);
        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('kode', $cari);
            }
        }

        $this->db->from("withdraw");
        //total row
        $config['base_url'] = site_url('dashboard/daftar_withdraw'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $tampil    = $this->input->post('tampil');
        if ($tampil == 10 || $tampil == 0) {
            $config['per_page'] = 10;
        } else {
            $config['per_page'] = $this->input->post('tampil');
        }
        //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['referral'] = $this->M_user->withdraw($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/history/withdraw_reff', $data);
        $this->load->view('user/footer', $data);
    }
    

    public function withdraw()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Withdraw | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $saldo = $data['user']['saldo'];

        $users = $this->session->userdata('username');

        $this->form_validation->set_rules('jenis', '', 'required|trim');
        $this->form_validation->set_rules('metode', '', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/page/withdraw', $data);
            $this->load->view('user/footer', $data);
        } else {

            $metode    = $this->input->post('metode');
            $jumlah    = $this->input->post('jumlah');
            $penerima  = $this->input->post('penerima');
            $nomor     = $this->input->post('nomor');
            $minimal   = '10000';

            if ($penerima == NULL) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Nama penerima wajib diisi.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/withdraw');
            }
            if ($nomor == NULL) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Nomor penerima wajib diisi.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/withdraw');
            } 
            if ($saldo < $jumlah) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Saldo tidak cukup untuk melakukan withdraw.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/withdraw');
            } elseif ($minimal > $jumlah) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Minimal withdraw Rp ' . number_format($minimal, 0, ',', '.') . '
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>');
                redirect('dashboard/withdraw');
            }

            $tot_saldo = $saldo - $jumlah;
            $kode = 2 . random_string('numeric', 5);

            $this->db->set('saldo', $tot_saldo);
            $this->db->where('username', $users);
            $this->db->update('users');

            $date = mediumdate_indo(date('Y-m-d'));
            $insert2 = [
                'username' => $users,
                'tipe' => 'Withdraw',
                'aksi' => 'Pengurangan Saldo',
                'nominal' => $jumlah,
                'pesan' => 'Pengurangan saldo melalui Withdraw dengan Kode withdraw : #' . $kode . '',
                'date' => $date,
                'time' => date('h:i:s')
            ];

            $this->db->insert('riwayat_saldo', $insert2);

            $withdraw = [
                'kode' => $kode,
                'username' => $users,
                'via' => $metode,
                'penerima' => $penerima,
                'nomor' => $nomor,
                'jumlah' => $jumlah,
                'type' => 'Withdraw',
                'status' => 'Pending',
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s')
            ];

            $this->db->insert('withdraw', $withdraw);

            $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Withdraw saldo berhasil di buat! Silahkan konfirmasi ke Admin.
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('dashboard/data_withdraw');
        }
    }

    public function data_withdraw()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Silahkan masuk terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }

        $data['type'] = "Data Withdraw | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users = $this->session->userdata('username');

        // Pagination Tabel Depo

        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari    = $this->input->post('cari');

        $this->db->where('username', $users);
        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('kode', $cari);
            }
        }

        $this->db->from("withdraw");
        //total row
        $config['base_url'] = site_url('dashboard/data_withdraw'); //site url
        $config['total_rows'] = $this->db->count_all_results();

        $tampil    = $this->input->post('tampil');
        if ($tampil == 10 || $tampil == 0) {
            $config['per_page'] = 10;
        } else {
            $config['per_page'] = $this->input->post('tampil');
        }
        //show record per halaman
        $config["num_links"] = 5;


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = '⇤ First';
        $config['last_link']        = 'Last ⇥';
        $config['next_link']        = 'Next →';
        $config['prev_link']        = '← Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['referral'] = $this->M_user->data_withdraw($config["per_page"], $data['page'], $users);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/history/data_withdraw', $data);
        $this->load->view('user/footer', $data);
    }

    public function dokumentasi()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata(
                'message',
                '
<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>'
            );
            redirect('auth');
        }


        $users = $this->session->userdata('username');
        $data['user'] = $this->M_user->get_user($users)->row_array();

        $data['type'] = "Dokumentasi | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        //Top User
        $data['top_user'] = $this->M_user->top_user()->result_array();
        $data['top_depo'] = $this->M_user->top_depo()->result_array();
        $data['top_layanan'] = $this->M_user->top_layanan()->result_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/page/dokumentasi', $data);
        $this->load->view('user/footer', $data);
    }

    public function ubah_api_key()
    {
        $web = $this->db->get('setting_web')->row_array();
        $users = $this->session->userdata('username');
        $random = strtoupper(substr($web['nama_web'], 0, 3) . '-' . random_string('alnum', 6) . '-' . random_string('alnum', 6) . '-' . random_string('alnum', 6) . '-' . random_string('alnum', 6));
        $this->db->set('api_key', $random);
        $this->db->where('username', $users);
        $this->db->update('users');

        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Berhasl mengubah Api key.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('dashboard/dokumentasi');
    }
}
