<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="pt-3 col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div id="padi" class="">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><b><?= $web['nama_web']; ?> Login</b></h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('email'); ?>">
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <label class="" for="customCheck"></label>
                                            <label class="" style="font-size:13px;float:right;margin-right:10px;"><a href="<?= base_url('auth/forgotpassword') ?>">Lupa Password?</a></label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-rgb btn-user btn-block">
                                        Login
                                    </button>
                                </form>

                                <div class="pt-4 text-center">
                                    <p>Belum Punya Akun? <a class="small" href="<?= base_url('auth/register'); ?>">Buat akun!</a></p>
                                </div>
                                <div class="text-center">
                                    <a href="<?= base_url(); ?>">← Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>