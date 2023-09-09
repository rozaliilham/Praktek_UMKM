<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Buat Tiket</h1>
            <p class="mb-4"><i class="fa fa-info-circle fa-fw"></i> Ticket maksimal dibalas dalam 24 jam,Itu hanya estimasi terlama, tidak menutupi kemungkinan tiket anda dibalas dalam beberapa menit.</p>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold text-primary">
                        <i class="mt-3 fa fa-envelope fa-fw"></i> Tiket Baru
                        <a href="<?= base_url('dashboard/daftar_tiket'); ?>" style="font-size:13px" class="m-2 btn btn-primary btn-rd5 font-weight-bold btn-sm float-right" role="button">Daftar Tiket</a></h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form class="form-horizontal" action="<?= base_url('dashboard/buat_tiket') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                        <div class="form-group">
                            <label class="control-label">Subjek</label>

                            <select class="form-control" name="subjek" id="subjek">
                                <option value="Pesanan">Pesanan</option>
                                <option value="Deposit">Deposit</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="pesan">Pesan</label>
                            <textarea type="text" class="form-control" id="pesan" placeholder="Tulis Keluhan Pesanan, Deposit, Tentang Layanan, Atau Yang Lainya" name="pesan" onfocus=this.value=''></textarea>
                            <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="reset" class="btn btn-danger btn-rd5" onclick="document.getElementById('InputID').value = ''">Ulangi</button>
                        <button type=" submit" name="kirim" class="btn btn-primary btn-rd5">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Informasi</h6>
                </div>
                <div class="card-body">
                    <b>Subject anda membuat :</b>
                    <ul>
                        <li>Pesanan (Untuk masalah pesananmu)</li>
                        <li>Deposit (Untuk masalah Depositmu)</li>
                        <li>Lainnya (Pertanyaan/masalah yang lain)</li>
                    </ul>
                    <br>
                    <b>Contoh Format Pesan anda buat :</b>
                    <ul>
                        <li>Cek ID order kamu dahulu <a href="<?= base_url('dashboard/riwayat_order'); ?>">di sini</a>.</li>
                        <li>Untuk masalah Pesanan ( id order : sebutin masalahmu ).</li>
                        <li>Jika Banyak masalah pesanan ( id order, id order : sebutin masalahmu ).</li>
                        <li>Contohnya = 563738 : refill/speed up min. </li>
                        <li>Jika pesanan banyak yang mau dilapor contoh = 563738, 563778, 566538 : refill/speed up min.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->