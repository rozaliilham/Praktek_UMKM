<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('string');
        $this->load->library('user_agent');
    }

    public function index()
    {

        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['type'] = "Login | ";
            $data['web'] =  $this->db->get('setting_web')->row_array();
            $data['kontak'] =  $this->db->get('kontak_web')->row_array();

            $this->load->view('auth/header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('auth/footer', $data);
        } else {
            // validasinya success
            $this->login();
        }
    }


    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['username' => $username])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['status_akun'] == 'Sudah Verifikasi') {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'level' => $user['level']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['level'] == 'Developers') {
                        redirect('admin');
                    } else {

                        $browser = $this->agent->browser();
                        $os = $this->agent->platform();

                        $ipv = $this->input->ip_address();

                        if ($ipv == '::1') {
                            $ip = '127.0.0.1';
                        } else {
                            $ip = $ipv;
                        }

                        $date = mediumdate_indo(date('Y-m-d'));

                        $aktifitas = [
                            'username' => $username,
                            'aksi' => 'Masuk',
                            'ip' => $ip,
                            'browser' => $browser,
                            'os' => $os,
                            'date' => $date,
                            'time' => date('h:i:s')
                        ];

                        $this->db->insert('aktifitas', $aktifitas);

                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Susccess!</strong> Anda berhasil login! :)
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>'
                        );
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Password salah!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 Maaf, Username ini belum diaktifkan! Silahkan verifikasi akun anda.
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Username kamu tidak terdaftar!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );
            redirect('auth');
        }
    }


    public function register()
    {
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[15]', [
            'max_length' => 'Nama maksimal 15 karakter!',
            'required' => 'Nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[8]|is_unique[users.username]', [
            'is_unique' => 'Username ini sudah terdaftar!',
            'max_length' => 'Username maksimal 8 karakter!',
            'required' => 'Username tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!',
            'required' => 'Email tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!',
            'required' => 'Password tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!',
            'required' => 'Password tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['type'] = "Daftar | ";
            $data['web'] =  $this->db->get('setting_web')->row_array();
            $data['kontak'] =  $this->db->get('kontak_web')->row_array();
            $this->load->view('auth/header', $data);
            $this->load->view('auth/register', $data);
            $this->load->view('auth/footer', $data);
        } else {

            $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

            $userIp = $this->input->ip_address();

            $web = $this->db->get('setting_web')->row_array();
            $secret = $web['secret_key'];

            $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $status = json_decode($output, true);

            if (!$status['success']) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> Kotak reCAPTCHA harus di centang.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'
                );
                redirect('auth/register');
            }

            $persen = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();
            if ($persen['status'] == 'Aktif') {
                if (!empty($this->input->post('reff'))) {
                    $reff = $this->input->post('reff');
                    $this->db->where('kode_referral', $reff);
                    $reffe = $this->db->get('users')->row_array();
                    $referral = $reffe['username'];
                }else{
                    $referral = "";
                }
            } else {
                $referral = "";
            }

            $rand = random_string('numeric', 4);
            $rand1 = strtoupper(substr($web['nama_web'], 0, 3) . '-' . random_string('alnum', 6) . '-' . random_string('alnum', 6) . '-' . random_string('alnum', 6) . '-' . random_string('alnum', 6));

            $kode = strtoupper(random_string('alnum', 7));
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $email,
                'username' => $username,
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'level' => 'Member',
                'status' => 'Aktif',
                'status_akun' => 'Belum Verifikasi',
                'api_id' => $rand,
                'api_key' => $rand1,
                'uplink' => $referral,
                'date' => mediumdate_indo(date('Y-m-d')),
                'time' => date('h:i:s'),
                'kode_referral' => $kode
            ];

            $this->db->insert('users', $data);

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);
       
            $this->sendEmail($token, 'verify');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Akun anda berhasil dibuat. Silakan verifikasi akun Anda
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>'
            );
            redirect('auth');
        }
    }

    
    // ---------------- SEND EMAIL SENDER ----------------- //
    private function sendEmail($token, $type)
    {
        $response = false;
        $mail = new PHPMailer(true);

        $data['web'] = $this->db->get('setting_web')->row_array();
        $data['kontak'] =  $this->db->get('kontak_web')->row_array();
        $web = $data['web'];
        $email = $this->input->post('email');

        $esen =  $this->db->get('email_sender')->row_array();

        // SMTP configuration
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();
        $mail->Host     = $esen['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $esen['email']; // user email
        $mail->Password = $esen['password']; // password email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port     = $esen['port'];

        $mail->SMTPKeepAlive = true;

        $mail->setFrom($esen['email'], ''); // user email
        $mail->addReplyTo($esen['email'], ''); //user email
        $mail->IsHTML(true);

        // Add a recipient
        $mail->addAddress($email); //email tujuan pengiriman email

        // Email subject
        // $mail->Subject = $subjek; 

        // Set email format to HTML
        $mail->isHTML(true);


        $data['link_web'] = base_url();
        $data['email'] = $email;
        $data['token'] = urlencode($token);

        $data['user'] = $this->db->get_where('users', ['email' => $email])->row_array();



        // Email body content
        $bodyver = $this->load->view('auth/email_ver', $data, TRUE);
        $bodypass = $this->load->view('auth/email_pass', $data, TRUE);

        // $body_test = 'test';

        if ($type == 'verify') {
            $mail->Subject = 'Veriifikasi Akun di ' . ' - ' . $web['nama_web'];
            $mail->Body = $bodyver;
        } else if ($type == 'forgot') {
            $mail->Subject = 'Hapus Password di ' . ' - ' . $web['nama_web'];
            $mail->Body = $bodypass;
        }

        
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return true;
        }
    }



    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('status_akun', 'Sudah Verifikasi');
                    $this->db->where('email', $email);
                    $this->db->update('users');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>' . $email . ' Berhasil diaktifkan!</strong> Silahkan Login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'
                    );
                    redirect('auth');
                } else {
                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>Aktivasi akun gagal!</strong>  Token expired.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Aktivasi akun gagal!</strong>  Token salah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Aktivasi akun gagal!</strong>  Email salah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );
            redirect('auth');
        }
    }


    public function logout()
    {
        $users = $this->session->userdata('username');
        $browser = $this->agent->browser();
        $os = $this->agent->platform();

        $ipv = $this->input->ip_address();

        if ($ipv == '::1') {
            $ip = '127.0.0.1';
        } else {
            $ip = $ipv;
        }

        $date = mediumdate_indo(date('Y-m-d'));

        $aktifitas = [
            'username' => $users,
            'aksi' => 'Keluar',
            'ip' => $ip,
            'browser' => $browser,
            'os' => $os,
            'date' => $date,
            'time' => date('h:i:s')
        ];

        $this->db->insert('aktifitas', $aktifitas);

        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Anda berhasil Keluar :)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>'
        );
        redirect('auth');
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    /// ----------- HALAMAN UNTUK UBAH PASSWORD ----------------------///

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['type'] = "Lupa Password | ";
            $data['web'] =  $this->db->get('setting_web')->row_array();
            $data['kontak'] =  $this->db->get('kontak_web')->row_array();

            $this->load->view('auth/header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('auth/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email, 'status_akun' => 'Sudah Verifikasi'])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->sendEmail($token, 'forgot');

                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Silakan periksa email Anda untuk mengatur ulang kata sandi Anda!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>'
                );
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Email yang anda masukkan tidak terdaftar!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>'
                );
                redirect('auth/forgotpassword');
            }
        }
    }


    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal mennghapus Password!</strong> Token salah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal mennghapus Password!</strong> Email salah!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('auth');
        }
    }


    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['type'] = "Perubahan Password | ";
            $data['web'] =  $this->db->get('setting_web')->row_array();
            $data['kontak'] =  $this->db->get('kontak_web')->row_array();

            $this->load->view('auth/header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('auth/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Password berhasil diubah!</strong> Silahkan login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>'
            );

            redirect('auth');
        }
    }
}
