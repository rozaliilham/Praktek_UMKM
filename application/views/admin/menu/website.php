<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Pengaturan</h1>
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Pengaturan Website</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('admin/website') ?>" method="post">
                        <div class="form-group">
                            <label for="nama_web">Nama Website</label>
                            <input type="text" class="form-control" id="nama_web" name="nama_web" value="<?= $web['nama_web']; ?>">
                            <?= form_error('nama_web', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="short_title">Short Title</label>
                            <input type="text" class="form-control" id="short_title" name="short_title" value="<?= $web['short_title']; ?>">

                        </div>

                        <div class="form-group">
                            <label>Title Website</label>
                            <textarea type="text" class="form-control" name="title"><?= $web['title']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi website</label>
                            <textarea rows="7" type="text" class="form-control" name="deskripsi_web"><?= $web['deskripsi_web']; ?></textarea>
                        </div>

                        <button type="submit" name="kirim" class="btn btn-primary btn-rd5"><i class="fa fa-refresh"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Ganti Logo</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('messagelogo') ?>

                    <div class="logoset">
                        <div class="logo">
                            <?php echo form_open_multipart('admin/Logo'); ?>
                            <input type="file" name="logo" id="logoUpload" style="display:none;" accept="image/x-png,image/gif,image/jpeg"></input>
                            <div class="title">Logo</div>
                            <img id="logo" src="<?= base_url('assets/'); ?>img/logo/<?= $web['logo']; ?>" />
                            <div class="form-group">
                                <div style="text-align:left;" class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambar" name="gambar" onchange="previewImg()" value="<?= base_url('assets/'); ?>img/logo/<?= $web['logo']; ?>">
                                    <label class="custom-file-label" for="gambar">Pilih gambar</label>
                                </div>
                                <button type="submit" class="btn btn-info mt-3"><i class="fas fa-sync"></i> Ganti Logo</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                    <div class="logoset">
                        <div class="favicon">
                            <?php echo form_open_multipart('admin/LogoFav'); ?>
                            <input type="file" name="logo" id="logoUpload" style="display:none;" accept="image/x-png,image/gif,image/jpeg"></input>
                            <div class="title">Logo Favicon</div>
                            <img id="logo" src="<?= base_url('assets/'); ?>img/logo/<?= $web['fav']; ?>" />
                            <div class="form-group">
                                <div style="text-align:left;" class="custom-file">
                                    <input type="file" class="custom-file-input" id="fav" name="fav" onchange="previewFav()" value="<?= base_url('assets/'); ?>img/logo/<?= $web['fav']; ?>">
                                    <label class="favic custom-file-label" for="fav">Pilih gambar</label>
                                </div>
                                <button type="submit" class="btn btn-info mt-3"><i class="fas fa-sync"></i> Ganti Favicon</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-7">
            <div class="row">

                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Setting Google Recaptcha</h6>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('messagecap') ?>
                            <a target="_blank" rel="nofollow" href="https://www.google.com/recaptcha/admin">
                                <p>Recaptcha v2 Checkbox →</p>
                            </a>

                            <form action="<?= base_url('admin/recaptcha') ?>" method="post">
                                <div class="form-group">
                                    <label for="site_key">Site Key</label>
                                    <input type="text" class="form-control" id="site_key" name="site_key" value="<?= $web['site_key']; ?>">
                                    <?= form_error('site_key', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="secret_key">Secret Key</label>
                                    <input type="text" class="form-control" id="secret_key" name="secret_key" value="<?= $web['secret_key']; ?>">

                                </div>
                                <button type="submit" name="kirim" class="btn btn-primary btn-rd5"><i class="fa fa-refresh"></i> Submit</button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-code fa-fw"></i> Setting Tawk.to</h6>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('messagetawk') ?>
                            <a target="_blank" rel="nofollow" href="https://dashboard.tawk.to">
                                <p>Masuk ke Dashboard Tawk.to →</p>
                            </a>
                            <p class="small text-warning">Pilih menu setting → Chat Widget, Lalu copy kode widgetnya.</p>

                            <form action="<?= base_url('admin/tawkto') ?>" method="post">
                                <div class="form-group">
                                    <label>Kode Widget</label>
                                    <textarea rows="7" type="text" class="form-control" name="tawkto"><?= $web['tawkto']; ?></textarea>
                                </div>

                                <button type="submit" name="kirim" class="btn btn-primary btn-rd5"><i class="fa fa-refresh"></i> Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Ganti Open graph</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('messageog') ?>

                    <div class="logoset">
                        <div class="logo">
                            <?php echo form_open_multipart('admin/open_graph'); ?>
                            <input type="file" name="og" id="logoUpload" style="display:none;" accept="image/x-png,image/gif,image/jpeg"></input>
                            <div class="title">Open graph Facebook</div>
                            <img id="logo" style="height:172px;width:auto;" src="<?= base_url('assets/'); ?>img/<?= $web['og']; ?>" />
                            <div class="mt-2 form-group">
                                <div style="text-align:left;" class="custom-file">
                                    <input type="file" class="custom-file-input" id="og" name="og" onchange="previewOg()" value="<?= base_url('assets/'); ?>img/logo/<?= $web['logo']; ?>">
                                    <label class="og custom-file-label" for="og">Pilih gambar</label>
                                </div>
                                <button type="submit" class="btn btn-info mt-3"><i class="fas fa-sync"></i> Ganti Gambar</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <p>Setelah melakukan perubahan Open graph Facebook, <br />Silahkan melakukan debuger dahulu untuk menyimpan perubahan cache di Facebook.</p>
                    <a target="_blank" rel="nofollow" href="https://developers.facebook.com/tools/debug">Debug open graph →</a>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- /.container-fluid -->
<script type="text/javascript">
    function previewImg() {

        const gambar = document.querySelector('#gambar');
        const gambarLabel = document.querySelector('.custom-file-label');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.file[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewOg() {

        const og = document.querySelector('#og');
        const ogLabel = document.querySelector('.og');

        ogLabel.textContent = og.files[0].name;

        const fileog = new FileReader();
        fileog.readAsDataURL(og.file[0]);

        fileog.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewFav() {

        const fav = document.querySelector('#fav');
        const favLabel = document.querySelector('.favic');

        favLabel.textContent = fav.files[0].name;

        const fileFav = new FileReader();
        fileFav.readAsDataURL(fav.file[0]);

        fileFav.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>