<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-envelope fa-fw"></i> Balas Tiket : <?= $judul['subjek'] ?>
                        <a href="<?= base_url('admin/daftar_tiket') ?>" type="button" class="small btn btn-danger btn-rd5 float-right">Kembali</a></h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <br />
                    <div class="overflow-auto" id="scrollTop" style="max-height: 400px;">
                        <ul class="chat-list list-unstyled">
                            <?php foreach ($pesan->result() as $a) : ?>
                                <?php if ($a->pengirim == 'Admin') : ?>
                                    <li class="clearfix chat-element right media">
                                        <div class="media-body">
                                            <div class="speech-box">
                                                <strong><b><?= $a->pengirim ?></b></strong>
                                                <p><?= $a->pesan ?></p>
                                                <small class="text-info"><?= $a->date ?>, <?= $a->time ?></small>
                                            </div>

                                        </div>
                                        <a class="float-right mr-2">
                                            <img src="<?= base_url('assets/') ?>img/profile.png" width="50%" alt="" class="rounded-circle">

                                        </a>
                                    </li>
                                <?php elseif ($a->pengirim == 'Member') : ?>
                                    <li style="margin-right:70px" class="clearfix chat-element media">
                                        <a class="float-left">
                                            <h1> <i class="fa fa-user-circle ml-3"></i></h1>
                                        </a>
                                        <div class="media-body">
                                            <div class="speech-box">
                                                <strong><b><?= $a->user ?></b></strong>
                                                <p><?= $a->pesan ?></p>
                                                <small class="text-info"><?= $a->date ?>, <?= $a->time ?></small>
                                            </div>
                                        </div>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <br />
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $id_tiket ?>">
                        <div class="row form-inline">
                            <div class="col-md-12 input-group">
                                <input type="text" class="form-control" name="pesan" id="pesan" autofocus>
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#scrollTop').stop().animate({
        scrollTop: $('#scrollTop')[0].scrollHeight
    });
</script>