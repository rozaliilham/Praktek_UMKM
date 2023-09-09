<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Deposit</h1>
            <p class="mb-4"><i class="fa fa-info-circle fa-fw"></i> Baca Informasi yang terletak dikanan (PC/Tablet) / dibawah (Smartphone) form sebelum melakukan Submit!</p>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-money fa-fw"></i> Deposit Baru</h6>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-manual-tab" data-toggle="tab" href="#nav-manual" role="tab" aria-controls="nav-manual" aria-selected="true">Manual</a>
                            <a class="nav-item nav-link" id="nav-otomatis-tab" data-toggle="tab" href="#nav-otomatis" role="tab" aria-controls="nav-otomatis" aria-selected="false">Otomatis</a>
                        </div>
                    </nav>
                    <br />
                    <?= $this->session->flashdata('message') ?>
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-manual" role="tabpanel" aria-labelledby="nav-manual-tab">
                            <form action="<?= base_url('dashboard/deposit') ?>" method="post">

                                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                <div class="form-group">
                                    <label>Jenis Pembayaran *</label>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="jenis" value="Transfer Bank" name="jenis">
                                        <label class="custom-control-label" for="jenis">Transfer BANK</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="jenis2" value="Transfer Ewallet" name="jenis">
                                        <label class="custom-control-label" for="jenis2">Transfer E-Wallet</label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Metode Pembayaran *</label>
                                    <select class="form-control" name="metode" id="metode">
                                        <option value="">Pilih jenis pembayaran dahulu</option>
                                    </select>
                                </div>

                                <div id="desk" class="form-group">
                                    <div class="alert alert-secondary" role="alert" id="catatan" name="catatan" readonly="">
                                    </div>
                                </div>

                                <span id="metode_transfer"></span>

                                <div class="form-group">
                                    <label>Jumlah Deposit *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                                    </div>
                                    <small id="minim" class="text-danger">Minimal : <span id="minimal"></span></small>
                                </div>

                                <button type="reset" class="btn btn-danger btn-rd5" onclick="document.getElementById('InputID').value = ''">Reset</button>
                                <button type="submit" class="btn btn-success btn-rd5">Submit</button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="nav-otomatis" role="tabpanel" aria-labelledby="nav-otomatis-tab">
                            <form action="<?= base_url('dashboard/deposit_oto') ?>" method="post">

                                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                <div class="form-group">
                                    <label>Jenis Pembayaran *</label>
                                    <select class="form-control" name="jenis" id="jenis_oto">
                                        <option value="">- Pilih jenis pembayaran -</option>
                                        <option value="Virtual Account">Virtual Account Bank</option>
                                        <option value="Convenience Store">Convenience Store</option>
                                        <option value="E-Wallet">E-Wallet</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Metode Pembayaran *</label>
                                    <select class="form-control" name="metode" id="metode_oto">
                                        <option value="">Pilih jenis pembayaran dahulu</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Jumlah Deposit *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                                    </div>
                                    <small id="minim" class="text-danger">Minimal : <span id="minimal"><?= number_format($min_oto['min'], 0, ',', '.') ?></span></small>
                                </div>

                                <button type="reset" class="btn btn-danger btn-rd5" onclick="document.getElementById('InputID').value = ''">Reset</button>
                                <button type="submit" class="btn btn-success btn-rd5">Submit</button>
                            </form>                       
                        </div>


                    </div>
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
                    <b>Langkah-langkah deposit baru:</b>
                    <ul>
                        <li>Pilih jenis pembayaran yang Anda inginkan, tersedia 2 opsi: Transfer Bank & Transfer E-wallet.</li>
                        <li>Pilih metode pembayaran yang Anda inginkan, serta masukkan jumlah deposit.</li>
                        <li>Otomatis: Pembayaran Anda akan dikonfirmasi secara otomatis oleh sistem dalam 5-10 menit setelah melakukan pembayaran.</li>
                        <li>Manual: Anda harus melakukan konfirmasi pembayaran pada Admin, agar permintaan deposit Anda dapat diterima.</li>
                        <li>Klik Submit untuk membuat deposit baru.</li>
                    </ul>
                    <br>
                    <b>Ketentuan membuat deposit baru:</b>
                    <ul>
                        <li>Anda hanya dapat memiliki maksimal 3 permintaan deposit Pending, jadi jangan melakukan spam dan segera lunasi pembayaran.</li>
                        <li>Jika permintaan deposit tidak dibayar dalam waktu lebih dari 24 jam, maka permintaan deposit akan otomatis dibatalkan.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#minim").hide();
        $("#desk").hide();
        $("#nama").hide();
        $("#nomor").hide();

        $("#jenis").click(function() {
            $("#nama").show();
            $("#nomor").hide();
        });

        $("#jenis2").click(function() {
            $("#nomor").show();
            $("#nama").hide();
        });

        $('#jenis').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_metode'); ?>',
                data: {
                    jenis: this.value
                },
                cache: false,
                success: function(response) {
                    $('#metode').html();
                    $('#metode').html(response);
                }
            });

            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_metode_transfer'); ?>',
                data: {
                    jenis: this.value
                },
                cache: false,
                success: function(response) {
                    $('#metode_transfer').html(response).show(600);;
                }
            });


        });

        $('#jenis2').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_metode'); ?>',
                data: {
                    jenis: this.value
                },
                cache: false,
                success: function(response) {
                    $('#metode').html();
                    $('#metode').html(response);
                }
            });

            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_metode_transfer'); ?>',
                data: {
                    jenis: this.value
                },
                cache: false,
                success: function(response) {
                    $('#metode_transfer').html(response).show(600);;
                }
            });
        });


        $('#metode').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_catatan'); ?>',
                data: {
                    metode: this.value
                },
                cache: false,
                success: function(response) {
                    $('#catatan').html(response);
                    $('#desk').show(600);
                }
            });

            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_minimal'); ?>',
                data: {
                    metode: this.value
                },
                cache: false,
                success: function(response) {
                    $('#minimal').html(response);
                    $('#minim').show(600);
                }
            });
        });

        $('#jenis_oto').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_jenis_oto'); ?>',
                data: {
                    jenis_oto: this.value
                },
                cache: false,
                success: function(response) {
                    $('#metode_oto').html();
                    $('#metode_oto').html(response);
                }
            });
        });

        $('#metode_oto').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_metode_oto'); ?>',
                data: {
                    metode_oto: this.value
                },
                cache: false,
                success: function(response) {
                    $('#pesanan').html(response);
                }
            });
        });
    });
</script>