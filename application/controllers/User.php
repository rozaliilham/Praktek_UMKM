<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('M_grafik');
    }

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

        redirect('dashboard');
    }


    public function setting()
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

        $data['type'] = "Setting | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('user/header', $data);
        $this->load->view('user/sidebar', $data);
        $this->load->view('user/topbar', $data);
        $this->load->view('user/setting/setting', $data);
        $this->load->view('user/footer', $data);
    }


    public function edit()
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

        $data['type'] = "Setting | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users = $this->session->userdata('username');

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|alpha|max_length[15]', [
            'alpha' => 'Kolom Nama Lengkap hanya boleh berisi karakter alfabet.', 'max_length' => 'Kolom Nama Lengkap tidak boleh lebih dari 15 karakter.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/setting/setting', $data);
            $this->load->view('user/footer', $data);
        } else {
            // load success template...
            $edit = [
                'nama' => $this->security->xss_clean($this->input->post('nama')),
                'no_hp' => $this->security->xss_clean($this->input->post('no_hp'))
            ];

            $this->db->where('username', $users);
            $this->db->update('users', $edit);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Profile kamu berhasil di Update!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>'
            );
            redirect('user/setting');
        }
    }


    public function edit_pass()
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

        $data['type'] = "Setting | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('old_password', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password Baru', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!', 'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password Baru', 'required|trim|min_length[3]|matches[password1]', [
            'matches' => 'Password tidak sama!', 'min_length' => 'Password terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/setting/setting', $data);
            $this->load->view('user/footer', $data);
        } else {
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('password1');
            if (!password_verify($old_password, $data['user']['password'])) {
                $this->session->set_flashdata(
                    'messagepp',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Password lama salah!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>'
                );
                redirect('user/setting');
            } else {
                if ($old_password == $new_password) {
                    $this->session->set_flashdata(
                        'messagepp',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password baru tidak boleh sama dengan Password saat ini!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>'
                    );
                    redirect('user/setting');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('users');

                    $this->session->set_flashdata(
                        'messagepp',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password berhasil di ubah! :)
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             </div>'
                    );
                    redirect('user/setting');
                }
            }
        }
    }


    public function balas_tiket($id_tiket = NULL)
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

        $data['type'] = "Balas Tiket | ";
        $data['web'] =  $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $users      = $this->session->userdata('username');

        //ID Tiket
        $data['id_tiket'] = $id_tiket;
        $this->db->where('user', $users);
        $this->db->where('id_tiket', $id_tiket);
        $data['judul'] = $this->db->get('tiket')->row_array();

        $data['pesan'] = $this->M_user->pesan_tiket($id_tiket, $users);

        $this->form_validation->set_rules('pesan', 'Pesan', 'required|trim|max_length[200]', [
            'max_length' => 'Kolom Pesan tidak boleh lebih dari 200 karakter.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/sidebar', $data);
            $this->load->view('user/topbar', $data);
            $this->load->view('user/page/balas_tiket', $data);
            $this->load->view('user/footer', $data);
        } else {
            // load success template...

            $time = mediumdate_indo(date('Y-m-d')) . ' - ' . date('h:i:s');

            $insert1 = [
                'pengirim' => 'Member',
                'update_terakhir' => $time,
                'status' => 'Pending'
            ];
            $this->db->where('id_tiket', $id_tiket);
            $this->db->update('tiket', $insert1);

            $insert2 = [
                'id_tiket' => $id_tiket,
                'pengirim' => 'Member',
                'user' => $users,
                'pesan' => $this->security->xss_clean($this->input->post('pesan')),
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s'),
                'this_user' => 1,
                'this_admin' => 0
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
            redirect("user/balas_tiket/$id_tiket");
        }
    }


    public function get_news()
    {
        $users      = $this->session->userdata('username');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Silahkan masuk terlebih dahulu!
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         </div>');
            redirect('auth');
        }

        $this->db->set('read_news', '1');
        $this->db->where('username', $users);
        $this->db->update('users');
    }
}
