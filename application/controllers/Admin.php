<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('M_grafik');
        $this->load->model('M_admin');
        $this->load->helper('date');
        $this->load->helper('string');

        $users = $this->session->userdata('username');

        if (!$users) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $user = $this->db->get_where('users', ['username' => $users])->row_array();
        if ($user['level'] == 'Member') {
            redirect('user');
        }
    }

    // echo mediumdate_indo(date('Y-m-d'));
    // echo date('h:i:s');
    public function index()
    {


        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Dahboard Admin | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['sum_user'] = $this->db->get("users where level = 'Member'")->num_rows();

        $this->db->select_sum('get_saldo');
        $data['sum_depo'] = $this->db->get("deposit where status = 'Success'")->row_array();

        $this->db->select_sum('harga');
        $data['sum_order'] = $this->db->get("pembelian where status = 'Success'")->row_array();


        //Grafik User
        if (empty($this->M_grafik->Agrafik1()->row_array())) {
            $data['grafik1'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-6 day")))];
        } else {
            $data['grafik1'] = $this->M_grafik->Agrafik1()->row_array();
        }

        if (empty($this->M_grafik->Agrafik2()->row_array())) {
            $data['grafik2'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-5 day")))];
        } else {
            $data['grafik2'] = $this->M_grafik->Agrafik2()->row_array();
        }

        if (empty($this->M_grafik->Agrafik3()->row_array())) {
            $data['grafik3'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-4 day")))];
        } else {
            $data['grafik3'] = $this->M_grafik->Agrafik3()->row_array();
        }

        if (empty($this->M_grafik->Agrafik4()->row_array())) {
            $data['grafik4'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-3 day")))];
        } else {
            $data['grafik4'] = $this->M_grafik->Agrafik4()->row_array();
        }

        if (empty($this->M_grafik->Agrafik5()->row_array())) {
            $data['grafik5'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-2 day")))];
        } else {
            $data['grafik5'] = $this->M_grafik->Agrafik5()->row_array();
        }

        if (empty($this->M_grafik->Agrafik6()->row_array())) {
            $data['grafik6'] = ['date' => mediumdate_indo(date('Y-m-d', strtotime("-1 day")))];
        } else {
            $data['grafik6'] = $this->M_grafik->Agrafik6()->row_array();
        }

        if (empty($this->M_grafik->Agrafik7()->row_array())) {
            $data['grafik7'] = ['date' => mediumdate_indo(date('Y-m-d'))];
        } else {
            $data['grafik7'] = $this->M_grafik->Agrafik7()->row_array();
        }

        $data['sum_grafik1'] = $this->M_grafik->Asum_grafik1()->row_array();
        $data['sum_grafik2'] = $this->M_grafik->Asum_grafik2()->row_array();
        $data['sum_grafik3'] = $this->M_grafik->Asum_grafik3()->row_array();
        $data['sum_grafik4'] = $this->M_grafik->Asum_grafik4()->row_array();
        $data['sum_grafik5'] = $this->M_grafik->Asum_grafik5()->row_array();
        $data['sum_grafik6'] = $this->M_grafik->Asum_grafik6()->row_array();
        $data['sum_grafik7'] = $this->M_grafik->Asum_grafik7()->row_array();

        //==== Grafik Bulanan ------------//
        $grafik = $this->db->get_where('grafik_admin')->row_array();
        $tahun = $grafik['tahun_bar'];
        $data['grafik'] = $grafik;
        $data['jan'] = $this->M_grafik->Asum_1($tahun)->row_array();
        $data['feb'] = $this->M_grafik->Asum_2($tahun)->row_array();
        $data['mar'] = $this->M_grafik->Asum_3($tahun)->row_array();
        $data['apr'] = $this->M_grafik->Asum_4($tahun)->row_array();
        $data['mei'] = $this->M_grafik->Asum_5($tahun)->row_array();
        $data['jun'] = $this->M_grafik->Asum_6($tahun)->row_array();
        $data['jul'] = $this->M_grafik->Asum_7($tahun)->row_array();
        $data['ags'] = $this->M_grafik->Asum_8($tahun)->row_array();
        $data['sep'] = $this->M_grafik->Asum_9($tahun)->row_array();
        $data['okt'] = $this->M_grafik->Asum_10($tahun)->row_array();
        $data['nov'] = $this->M_grafik->Asum_11($tahun)->row_array();
        $data['des'] = $this->M_grafik->Asum_12($tahun)->row_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/index', $data);
        $this->load->view('admin/footer', $data);
    }


    public function daftar_member()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Daftar Member | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $this->db->select_sum('saldo');
        $data['total_saldo'] = $this->db->get("users where level = 'Member'")->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $status     = $this->input->post('status');
        $cari  = $this->input->post('cari');

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status_akun', $status);
            }
            if (!empty($cari)) {
                $this->db->like('username', $cari);
                $this->db->or_like('email', $cari);
                $this->db->or_like('nama', $cari);
            }
        }

        $this->db->from("users");

        $config['base_url'] = site_url('admin/daftar_member'); //site url
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
        $data['daftar'] = $this->M_admin->daftar_member($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/daftar_member', $data);
        $this->load->view('admin/footer', $data);
    }

    public function daftar_orderan()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Daftar Orderan | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();


        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $status     = $this->input->post('status');
        $cari  = $this->input->post('cari');

        if ($filter) {
            if (!empty($status)) {
                $this->db->where('status', $status);
            }
            if (!empty($cari)) {
                $this->db->where('oid', $cari);
            }
        }

        $this->db->from("pembelian");

        $config['base_url'] = site_url('admin/daftar_orderan'); //site url
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
        $data['daftar'] = $this->M_admin->daftar_orderan($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/daftar_orderan', $data);
        $this->load->view('admin/footer', $data);
    }


    public function daftar_layanan()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Daftar Layanan | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $this->load->model('M_user');
        $data['kategori'] = $this->M_user->get_kategori()->result_array();
        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $cari      = $this->input->post('cari');
        $kategori  = $this->input->post('kategori');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->like('layanan', $cari);
                $this->db->or_like('kategori', $cari);
            }
            if (!empty($kategori)) {
                $this->db->where('kategori', $kategori);
            }
        }


        $this->db->from("layanan");

        $config['base_url'] = site_url('admin/daftar_layanan'); //site url
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
        $data['layanan'] = $this->M_admin->daftar_layanan($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/daftar_layanan', $data);
        $this->load->view('admin/footer', $data);
    }


    public function daftar_kategori()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Daftar Kategori | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $cari  = $this->input->post('cari');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->like('nama', $cari);
            }
        }

        $this->db->from("kategori_layanan");

        $config['base_url'] = site_url('admin/daftar_kategori'); //site url
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
        $data['daftar'] = $this->M_admin->daftar_kategori($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/daftar_kategori', $data);
        $this->load->view('admin/footer', $data);
    }



    public function daftar_tiket()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Daftar Tiket | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $status  = $this->input->post('status');
        $cari  = $this->input->post('cari');

        if ($filter) {
            if (!empty($status)) {
                $this->db->like('status', $status);
            }
            if (!empty($cari)) {
                $this->db->like('id_tiket', $cari);
            }
        }

        $this->db->from("tiket");

        $config['base_url'] = site_url('admin/daftar_tiket'); //site url
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
        $data['daftar'] = $this->M_admin->daftar_tiket($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/daftar_tiket', $data);
        $this->load->view('admin/footer', $data);
    }




    public function daftar_deposit()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Daftar Deposit | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $status  = $this->input->post('status');
        $cari  = $this->input->post('cari');

        if ($filter) {
            if (!empty($status)) {
                $this->db->like('status', $status);
            }
            if (!empty($cari)) {
                $this->db->like('kode_deposit', $cari);
            }
        }

        $this->db->from("deposit");

        $config['base_url'] = site_url('admin/daftar_deposit'); //site url
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
        $data['daftar'] = $this->M_admin->daftar_deposit($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/daftar_deposit', $data);
        $this->load->view('admin/footer', $data);
    }



    public function daftar_berita()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Daftar Berita | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $status  = $this->input->post('status');
        if ($filter) {
            if (!empty($status)) {
                $this->db->like('status', $status);
            }
        }

        $this->db->from("berita");

        $config['base_url'] = site_url('admin/daftar_berita'); //site url
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
        $data['daftar'] = $this->M_admin->daftar_berita($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/daftar_berita', $data);
        $this->load->view('admin/footer', $data);
    }



    public function penggunaan_saldo()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Penggunaan Saldo | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $tipe      = $this->input->post('tipe');
        $cari      = $this->input->post('cari');
        if ($filter) {
            if (!empty($tipe)) {
                $this->db->where('tipe', $tipe);
            }
            if (!empty($cari)) {
                $this->db->where('username', $cari);
            }
        }

        $this->db->from("riwayat_saldo");

        $config['base_url'] = site_url('admin/penggunaan_saldo'); //site url
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
        $data['daftar'] = $this->M_admin->penggunaan_saldo($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/penggunaan_saldo', $data);
        $this->load->view('admin/footer', $data);
    }




    public function aktifitas_user()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Aktifitas User | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $cari      = $this->input->post('cari');
        $aksi      = $this->input->post('aksi');
        if ($filter) {
            if (!empty($cari)) {
                $this->db->where('username', $cari);
            }
            if (!empty($aksi)) {
                $this->db->where('aksi', $aksi);
            }
        }

        $this->db->from("aktifitas");

        $config['base_url'] = site_url('admin/aktifitas_user'); //site url
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
        $data['daftar'] = $this->M_admin->aktifitas_user($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/aktifitas_user', $data);
        $this->load->view('admin/footer', $data);
    }


    public function edit_member()
    {
        $user          = $this->input->post('username');

        $insert = [
            'email' => $this->input->post('email'),
            'nama' => $this->input->post('nama'),
            'no_hp' => $this->input->post('no_hp'),
            'saldo' => $this->input->post('saldo'),
            'status_akun' => $this->input->post('status_akun'),
            'status' => $this->input->post('status')
        ];
        $this->db->where('username', $user);
        $this->db->update('users', $insert);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Member dengan username <strong>' . $user . '</strong> berhasil di Update!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_member');
    }


    public function hapus_member($user = NULL)
    {
        $this->db->where('username', $user);
        $this->db->delete('users');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Member dengan username <strong>' . $user . '</strong> berhasil di Hapus!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_member');
    }


    public function hapus_orderan($id_order = NULL)
    {
        $this->db->where('oid', $id_order);
        $this->db->delete('pembelian');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pesanan dengan kode <strong>#' . $id_order . '</strong> berhasil di Hapus!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_orderan');
    }


    public function update_status()
    {
        $user          = $this->input->post('username');

        $this->db->set('status_akun', $this->input->post('status'));
        $this->db->where('username', $user);

        $result = $this->db->update('users');
        return $result;
    }


    public function website()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Setting Website | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $this->form_validation->set_rules('nama_web', 'Nama Website', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/website', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $update = [
                'nama_web'      => $this->input->post('nama_web'),
                'short_title'   => $this->input->post('short_title'),
                'title'         => $this->input->post('title'),
                'deskripsi_web' => $this->input->post('deskripsi_web')
            ];

            $this->db->update('setting_web', $update);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/website');
        }
    }


    public function recaptcha()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $update = [
            'site_key'    => $this->input->post('site_key'),
            'secret_key'  => $this->input->post('secret_key')
        ];

        $this->db->update('setting_web', $update);
        $this->session->set_flashdata(
            'messagecap',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Recaptcha berhasil di ubah. :)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>'
        );

        redirect('admin/website');
    }


    public function tawkto()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $update = [
            'tawkto'  => $_POST['tawkto']
        ];

        $this->db->update('setting_web', $update);
        $this->session->set_flashdata(
            'messagetawk',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Kode Tawkto berhasil di ubah. :)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>'
        );

        redirect('admin/website');
    }


    public function Logo()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $gambar        = $_FILES['gambar'];

        if ($gambar = '') {
        } else {
            $config['upload_path'] = './assets/img/logo/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('messagelogo', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Logo Header gagal diubah :(
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>');
                redirect('admin/website');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }
        $g =  $this->db->get_where('setting_web')->row_array();
        //hapus gambar di path
        unlink("./assets/img/logo/" . $g['logo']);
        $data = [
            'logo' => $gambar
        ];

        $this->db->update('setting_web', $data);
        $this->session->set_flashdata('messagelogo', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Logo Header baru berhasil diubah :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
        redirect('admin/website');
    }

    public function LogoFav()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $gambar = $_FILES['fav'];

        if ($gambar = '') {
        } else {
            $config['upload_path'] = './assets/img/logo/';
            $config['allowed_types'] = 'jpg|png|ico|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('fav')) {
                $this->session->set_flashdata('messagelogo', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Logo Favicon gagal diubah :(
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>');
                redirect('admin/website');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }
        $g =  $this->db->get_where('setting_web')->row_array();
        //hapus gambar di path
        unlink("./assets/img/logo/" . $g['favicon']);
        $data = [
            'fav' => $gambar
        ];

        $this->db->update('setting_web', $data);
        $this->session->set_flashdata('messagelogo', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Logo Favicon baru berhasil diubah :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
        redirect('admin/website');
    }


    public function open_graph()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $gambar = $_FILES['og'];

        if ($gambar = '') {
        } else {
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'jpg|png|ico|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('og')) {
                $this->session->set_flashdata('messageog', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   Gambar Open Graph gagal diubah :(
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>');
                redirect('admin/website');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }
        $g =  $this->db->get_where('setting_web')->row_array();
        //hapus gambar di path
        unlink("./assets/img/" . $g['og']);
        $data = [
            'og' => $gambar
        ];

        $this->db->update('setting_web', $data);
        $this->session->set_flashdata('messageog', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Gambar Open Graph berhasil diubah :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>');
        redirect('admin/website');
    }



    public function keuntungan()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Setting Keuntungan | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['reff'] = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();
        $data['webb'] = $this->db->get_where('keuntungan', ['jenis' => 'WEB'])->row_array();
        $data['api'] = $this->db->get_where('keuntungan', ['jenis' => 'API'])->row_array();

        $this->form_validation->set_rules('web', 'Web', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/keuntungan', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $update1 = [
                'jumlah'      => $this->input->post('web'),
                'status'   => $this->input->post('status')
            ];

            $this->db->where('jenis', 'WEB');
            $this->db->update('keuntungan', $update1);

            $update2 = [
                'jumlah'      => $this->input->post('api'),
                'status'   => $this->input->post('status')
            ];

            $this->db->where('jenis', 'API');
            $this->db->update('keuntungan', $update2);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Keuntungan layanan berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/keuntungan');
        }
    }


    public function referral()
    {

        $update = [
            'jumlah'      => $this->input->post('jumlah'),
            'status'   => $this->input->post('status')
        ];

        $this->db->where('jenis', 'Referral');
        $this->db->update('keuntungan', $update);
        $this->session->set_flashdata(
            'message1',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Keuntungan referral berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/keuntungan');
    }


    public function email_sender()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Setting email sender | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['esen'] =  $this->db->get('email_sender')->row_array();

        $this->form_validation->set_rules('protocol', 'Protocol', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/email_sender', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $update = [
                'protocol'  => $this->input->post('protocol'),
                'host'      => $this->input->post('host'),
                'port'      => $this->input->post('port'),
                'email'     => $this->input->post('email'),
                'password'  => $this->input->post('password'),
                'charset'   => $this->input->post('charset')
            ];

            $this->db->update('email_sender', $update);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Email sender website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/email_sender');
        }
    }


    public function kontak()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Setting Kontak | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/kontak', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $update = [
                'no_wa'      => $this->input->post('no_wa'),
                'email'   => $this->input->post('email'),
                'link_fb'         => $this->input->post('link_fb'),
                'link_ig' => $this->input->post('link_ig'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'jam_kerja' => $this->input->post('jam_kerja')
            ];

            $this->db->update('kontak_web', $update);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Kontak website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/kontak');
        }
    }


    public function payment()
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Setting Payment | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        // Pagination Tabel Daftar Harga
        $filter    = $this->input->post('filter');
        $cari  = $this->input->post('cari');

        if ($filter) {
            if (!empty($cari)) {
                $this->db->like('provider', $cari);
            }
        }

        $this->db->from("metode_depo");

        $config['base_url'] = site_url('admin/payment'); //site url
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
        $data['daftar'] = $this->M_admin->payment($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar');
        $this->load->view('admin/menu/payment', $data);
        $this->load->view('admin/footer', $data);
    }



    public function payment_oto()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Payment Otomatis | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['payment'] =  $this->db->get('payment')->row_array();

        $this->form_validation->set_rules('api_key', 'Api Key', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/payment_oto', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $update = [
                'kode_merchant' => $this->input->post('kode_merchant'),
                'api_key'       => $this->input->post('api_key'),
                'private_key'   => $this->input->post('private_key'),
                'min'           => $this->input->post('min'),
                'mode'          => $this->input->post('mode')
            ];

            $this->db->update('payment', $update);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Payment otomatis berhasil di update. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/payment_oto');
        }
    }



    public function saldo_pusat()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Saldo Pusat | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['pusat'] =  $this->db->get('cek_pusat')->row_array();

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/saldo_pusat', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $update = [
                'no_wa'      => $this->input->post('no_wa'),
                'email'   => $this->input->post('email'),
                'link_fb'         => $this->input->post('link_fb'),
                'link_ig' => $this->input->post('link_ig'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'jam_kerja' => $this->input->post('jam_kerja')
            ];

            $this->db->update('cek_pusat', $update);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Kontak website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/kontak');
        }
    }



    public function setting_provider()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Setting Provider | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();

        $data['provider'] =  $this->db->get('provider')->row_array();
        $data['konversi'] =  $this->db->get('konversi')->row_array();
        $data['manual'] =  $this->db->get_where('provider', ['code' => 'MANUAL'])->row_array();

        $this->form_validation->set_rules('provider', 'Provider', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/setting_provider', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $update = [
                'code'      => $this->input->post('provider'),
                'link'   => $this->input->post('link'),
                'api_id'         => $this->input->post('api_id'),
                'api_key' => $this->input->post('api_key')
            ];

            $this->db->where('tipe', 'SMM');
            $this->db->update('provider', $update);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Provider website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/setting_provider');
        }
    }



    public function setting_link_provider()
    {
        $this->form_validation->set_rules('link_layanan', 'Link Layanan', 'trim|required');

        $update = [
            'link_akun'      => $this->input->post('link_akun'),
            'link_layanan'   => $this->input->post('link_layanan'),
            'link_order'     => $this->input->post('link_order'),
            'link_status'    => $this->input->post('link_status')
        ];

        $this->db->where('code', $this->input->post('code'));
        $this->db->update('provider', $update);
        $this->session->set_flashdata(
            'messageLink',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Link provider berhasil di ubah. :)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'
        );

        redirect('admin/setting_provider');
    }

    public function setting_konversi()
    {
        $update = [
            'a1'  => $this->input->post('a1'),
            'a2'  => $this->input->post('a2'),
            'a3'  => $this->input->post('a3'),
            'a4'  => $this->input->post('a4'),
            'a5'  => $this->input->post('a5'),
            'a6'  => $this->input->post('a6'),
            'a7'  => $this->input->post('a7'),
            'a8'  => $this->input->post('a8'),
            'b1'  => $this->input->post('b1'),
            'b2'  => $this->input->post('b2'),
            'b3'  => $this->input->post('b3'),
            'b4'  => $this->input->post('b4'),
            'b5'  => $this->input->post('b5'),
            'b6'  => $this->input->post('b6'),
            'b7'  => $this->input->post('b7'),
            'b8'  => $this->input->post('b8'),
        ];

        $this->db->update('konversi', $update);
        $this->session->set_flashdata(
            'messageKon',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Konversi karakter berhasil di ubah. :)
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'
        );

        redirect('admin/setting_provider');
    }


    public function update_pusat()
    {

        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();

        $data['type'] = "Saldo Pusat | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();

        $data_provider =  $this->db->get_where('provider', ['tipe' => 'SMM'])->row_array();

        $p_apiid = $data_provider['api_id'];
        $p_apikey = $data_provider['api_key'];

        $url = $data_provider['link_akun'];
        $postdata = array(
            'api_id' => $p_apiid,
            'api_key' => $p_apikey
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
        
        if ($result['status'] == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ups, ' . $result['data'] . '</strong> Sistem kami sedang Mengalami gangguan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
            redirect('admin/saldo_pusat');
        }

        $sisa_saldo = $result['data']['balance'];

        $date = mediumdate_indo(date('Y-m-d'));

        $update = [
            'provider'  => $data_provider['code'],
            'saldo'     => $sisa_saldo,
            'tipe'     => 'SMM',
            'date'      => $date,
            'time'      => date('h:i:s')
        ];

        $cek_p = $this->db->get('cek_pusat')->num_rows();
          
        if ($cek_p == 0) {
            $insert = $this->db->insert('cek_pusat', $update);
        }else{
            $this->db->where('tipe', 'SMM');
            $insert = $this->db->update('cek_pusat', $update);
        }  

        if ($insert == TRUE) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Berhasil menampilkan data informasi Akun :) <br> Sisa Saldo : Rp ' . number_format($sisa_saldo, 0, ',', '.') . ' 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/saldo_pusat');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Gagal Menampilkan Data Informasi Akun :(
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('admin/saldo_pusat');
        }
    }


    public function tambah_payment()
    {
        $insert = [
            'provider'      => $this->input->post('provider'),
            'catatan'       => $this->input->post('catatan'),
            'nama_penerima' => $this->input->post('nama_penerima'),
            'tujuan'        => $this->input->post('tujuan'),
            'tipe'          => $this->input->post('tipe'),
            'minimal'       => $this->input->post('minimal'),
            'status'        => $this->input->post('status')
        ];

        $this->db->insert('metode_depo', $insert);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Payment website berhasil di Tambah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/payment');
    }


    public function edit_payment()
    {
        $update = [
            'provider'      => $this->input->post('provider'),
            'catatan'       => $this->input->post('catatan'),
            'nama_penerima' => $this->input->post('nama_penerima'),
            'tujuan'        => $this->input->post('tujuan'),
            'tipe'          => $this->input->post('tipe'),
            'minimal'       => $this->input->post('minimal'),
            'status'        => $this->input->post('status')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('metode_depo', $update);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Payment website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/payment');
    }

    public function hapus_payment($id = NULL)
    {
        $this->db->where('id', $id);
        $this->db->delete('metode_depo');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> berhasil menghapus payment!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/payment');
    }


    public function tambah_berita()
    {
        $date = mediumdate_indo(date('Y-m-d'));
        $insert = [
            'title'         => $this->input->post('nama'),
            'icon'          => $this->input->post('kategori'),
            'tipe'          => $this->input->post('tipe'),
            'konten'        => $this->input->post('konten'),
            'date'          => $date,
            'time'          => date('h:i:s')
        ];

        $this->db->insert('berita', $insert);

        $this->db->set('read_news', 0);
        $this->db->update('users');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Berita website berhasil di Tambah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_berita');
    }


    public function edit_berita()
    {
        $update = [
            'title'         => $this->input->post('nama'),
            'icon'          => $this->input->post('kategori'),
            'tipe'          => $this->input->post('tipe'),
            'konten'        => $this->input->post('konten')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('berita', $update);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Berita website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_berita');
    }

    public function hapus_berita($id = NULL)
    {
        $this->db->where('id', $id);
        $this->db->delete('berita');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> berhasil menghapus Berita!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_kategori');
    }


    public function tambah_kategori()
    {
        $insert = [
            'nama'         => $this->input->post('nama'),
            'kode'          => $this->input->post('kode'),
            'provider'          => $this->input->post('provider')
        ];

        $this->db->insert('kategori_layanan', $insert);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Kategori website berhasil di Tambah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_kategori');
    }


    public function edit_kategori()
    {
        $update = [
            'nama'         => $this->input->post('nama'),
            'kode'          => $this->input->post('kode'),
            'provider'          => $this->input->post('provider')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kategori_layanan', $update);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Kategori website berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_kategori');
    }

    public function hapus_kategori($id = NULL)
    {
        $this->db->where('id', $id);
        $this->db->delete('kategori_layanan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> berhasil menghapus Kategori!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_kategori');
    }

    public function status_order()
    {
        $update = [
            'status'         => $this->input->post('status')
        ];

        $this->db->where('oid', $this->input->post('id'));
        $this->db->update('pembelian', $update);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Status pesanan berhasil di update. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_orderan');
    }

    public function status_deposit()
    {
        $kode = $this->input->post('id');
        $status = $this->input->post('status');

        $update = [
            'status'         => $status
        ];

        $this->db->where('kode_deposit', $kode);
        $this->db->update('deposit', $update);

        if ($status == 'Success') {

            $data =  $this->db->get_where('deposit', ['kode_deposit' => $kode])->row_array();
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
                'pesan' => 'Penambahan saldo melalui Deposit dengan Kode deposit : #' . $kode . '',
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
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Status deposit berhasil di update. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_deposit');
    }


    public function hapus_deposit($id = NULL)
    {
        $this->db->where('id', $id);
        $this->db->delete('deposit');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Berhasil menghapus daftar deposit!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_deposit');
    }


    public function balas_tiket($id_tiket = NULL)
    {
        $users = $this->session->userdata('username');
        $data['user'] = $this->M_admin->get_user($users)->row_array();
        $data['type'] = "Balas Tiket | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $tiket = $this->db->get_where('tiket', ['id_tiket' => $id_tiket])->row_array();
        $users = $tiket['user'];
        //ID Tiket
        $data['id_tiket'] = $id_tiket;

        $this->db->where('id_tiket', $id_tiket);
        $data['judul'] = $this->db->get('tiket')->row_array();

        $data['pesan'] = $this->M_admin->pesan_tiket($id_tiket, $users);
        $pesan = $data['judul'];

        $time = mediumdate_indo(date('Y-m-d')) . ' - ' . date('h:i:s');

        if ($pesan['status'] == 'Pending') {
            $insert1 = [
                'update_terakhir' => $time,
                'status' => 'Waiting'
            ];
            $this->db->where('id_tiket', $id_tiket);
            $this->db->update('tiket', $insert1);
        }
        $this->form_validation->set_rules('pesan', 'Pesan', 'required|trim|max_length[200]', [
            'max_length' => 'Kolom Pesan tidak boleh lebih dari 200 karakter.'
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar');
            $this->load->view('admin/menu/balas_tiket', $data);
            $this->load->view('admin/footer', $data);
        } else {
            // load success template...

            $insert1 = [
                'pengirim' => 'Admin',
                'update_terakhir' => $time,
                'status' => 'Responded'
            ];
            $this->db->where('id_tiket', $id_tiket);
            $this->db->update('tiket', $insert1);

            $insert2 = [
                'id_tiket' => $id_tiket,
                'pengirim' => 'Admin',
                'user' => $users,
                'pesan' => $this->security->xss_clean($this->input->post('pesan')),
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s'),
                'this_user' => 0,
                'this_admin' => 1
            ];
            $this->db->insert('balas_tiket', $insert2);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Pesan Terkirim!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>'
            );
            redirect("admin/balas_tiket/$id_tiket");
        }
    }

    public function tutup_tiket($id_tiket = NULL)
    {

        $time = mediumdate_indo(date('Y-m-d')) . ' - ' . date('h:i:s');

        $insert1 = [
            'update_terakhir' => $time,
            'status' => 'Closed'
        ];
        $this->db->where('id_tiket', $id_tiket);
        $this->db->update('tiket', $insert1);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Berhasil menutup daftar Tiket!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_tiket');
    }

    public function hapus_tiket($id_tiket = NULL)
    {
        $this->db->where('id_tiket', $id_tiket);
        $this->db->delete('tiket');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Berhasil menghapus daftar Tiket!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_tiket');
    }



    public function tambah_layanan()
    {
        $tambah = [
            'service_id'  => $this->input->post('id_layanan'),
            'kategori'    => $this->input->post('kategori'),
            'layanan'     => $this->input->post('layanan'),
            'catatan'     => $this->input->post('catatan'),
            'min'         => $this->input->post('min'),
            'max'         => $this->input->post('max'),
            'harga'       => $this->input->post('harga'),
            'harga_api'   => $this->input->post('harga_api'),
            'status'      => $this->input->post('status'),
            'provider'    => $this->input->post('provider')
        ];

        $this->db->insert('layanan', $tambah);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Layanan berhasil di Tambah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_layanan');
    }


    public function edit_layanan()
    {
        $update = [
            'kategori' => $this->input->post('kategori'),
            'layanan'      => $this->input->post('layanan'),
            'catatan'       => $this->input->post('catatan'),
            'harga'        => $this->input->post('harga'),
            'status'        => $this->input->post('status')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('layanan', $update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Layanan berhasil di ubah. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_layanan');
    }

    public function hapus_layanan($id = NULL)
    {
        $this->db->where('id', $id);
        $this->db->delete('layanan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Berhasil menghapus daftar Layanan!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_layanan');
    }

    public function update_layanan()
    {
        $data_provider = $this->db->get_where('provider', ['tipe' => 'SMM'])->row_array();
        $web =  $this->db->get('setting_web')->row_array();
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
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Semua layanan Berhasil di update! :)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/daftar_layanan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ops, ' . $result['data'] . '</strong> - Gagal mengupdate Layanan! :(
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
            redirect('admin/daftar_layanan');
        }
    }

    public function update_grafik1()
    {
        $update = [
            'min'        => $this->input->post('min'),
            'max'        => $this->input->post('max')
        ];

        $this->db->update('grafik_admin', $update);

        $this->session->set_flashdata(
            'message1',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Perubahan berhasil di simpan :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin');
    }


    public function update_grafik2()
    {
        $update = [
            'tahun_bar'      => $this->input->post('tahun_bar'),
            'min_bar'        => $this->input->post('min_bar'),
            'max_bar'        => $this->input->post('max_bar')
        ];

        $this->db->update('grafik_admin', $update);

        $this->session->set_flashdata(
            'message2',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Perubahan berhasil di simpan :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin');
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

        $data['type'] = "Daftar Withdraw | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        // Pagination Tabel Depo

        $filter    = $this->input->post('filter');
        $status    = $this->input->post('status');
        $cari    = $this->input->post('cari');

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
        $config['base_url'] = site_url('admin/daftar_withdraw'); //site url
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
        $data['referral'] = $this->M_admin->withdraw($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['total'] = $config['total_rows'];
        //end pagination

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/menu/daftar_withdraw', $data);
        $this->load->view('admin/footer', $data);
    }

    public function hapus_withdraw($id = NULL)
    {
        $this->db->where('id', $id);
        $this->db->delete('withdraw');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Berhasil menghapus daftar withdraw!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('admin/daftar_withdraw');
    }

    public function status_withdraw()
    {
        $kode = $this->input->post('id');
        $status = $this->input->post('status');
        $jumlah = $this->input->post('jumlah');

        $update = [
            'status'         => $status
        ];

        $this->db->where('kode', $kode);
        $this->db->update('withdraw', $update);

        $data =  $this->db->get_where('withdraw', ['kode' => $kode])->row_array();
        $users = $data['username'];
        $jumlah = $data['jumlah'];

        $data_user = $this->M_admin->get_user($users)->row_array();
        $saldo = $data_user['saldo_referral'];

        $date = mediumdate_indo(date('Y-m-d'));

        if ($status == 'Error') {
            $update = [
                'saldo_referral' =>  $saldo + $jumlah
            ];

            $this->db->where('username', $users);
            $this->db->update('users', $update);


            $insert2 = [
                'username' => $users,
                'tipe' => 'Referral',
                'aksi' => 'Penambahan Saldo',
                'nominal' => $jumlah,
                'pesan' => 'Penambahan saldo melalui Error withdraw dengan Kode withdraw : #' . $kode . '',
                'date' => $date,
                'time' => date('h:i:s')
            ];

            $this->db->insert('riwayat_saldo', $insert2);
        }

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Status withdraw berhasil di update. :)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
        );

        redirect('admin/daftar_withdraw');
    }
}
