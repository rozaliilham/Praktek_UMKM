<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div id="padi" class="">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Pendaftaran akun!</h1>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" method="post" action="<?= base_url('auth/register'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <?php $persen = $this->db->get_where('keuntungan', ['jenis' => 'Referral'])->row_array();
                            if ($persen['status'] == 'Aktif') : ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="reff" name="reff" placeholder="Kode Refferal" value="<?= set_value('reff'); ?>">
                                    <small class="pl-3">* Kosongkan jika tidak ada.</small>
                                </div>
                            <?php endif ?>

                            <div class="row">
                                <div class="form-group form-box ml-1">
                                    <div class="g-recaptcha" data-sitekey="<?= $web['site_key']; ?>"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Saya setuju dengan <a href="<?= base_url('auth/about') ?>">Ketentuan Layanan</a>.</label>
                                    <label class="" style="font-size:13px;float:right;margin-right:10px;"><a href="<?= base_url('auth/forgotpassword') ?>">Lupa Password?</a></label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-rgb btn-user btn-block">
                                Daftar
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <p>Sudah punya akun? <a class="small" href="<?= base_url('auth'); ?>">Login!</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--Start of Tawk.to Script-->
<?= $web['tawkto']; ?>
<!--End of Tawk.to Script-->