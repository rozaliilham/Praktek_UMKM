<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- DataTales Example -->
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-money fa-fw"></i> Withdraw</h6>
                            </div>
                            <form action="<?= base_url('dashboard/tarik_referral') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                <div class="form-group">
                                    <label>Jenis Penarikan *</label>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="jenis" value="Transfer Bank" name="jenis">
                                        <label class="custom-control-label" for="jenis">Transfer BANK</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="jenis2" value="Transfer Ewallet" name="jenis">
                                        <label class="custom-control-label" for="jenis2">Transfer E-Wallet</label>
                                    </div>
                                    <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Metode Pembayaran *</label>
                                    <select class="form-control" name="metode" id="metode">
                                        <option value="">Pilih jenis penarikan dahulu</option>
                                    </select>
                                    <?= form_error('metode', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div id="desk" class="form-group">
                                    <div class="alert alert-secondary" role="alert" id="catatan" name="catatan" readonly="">
                                    </div>
                                </div>

                                <span id="metode_transfer"></span>

                                <div class="form-group">
                                    <label>Saldo withdraw</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input style="font-weight:bold" type="text" name="referral" class="form-control" value="<?= number_format($user['saldo_referral'], 0, ',', '.') ?>" readonly="" disabled>
                                    </div>
                                    <small class="text-success">Minimal withdraw: Rp 50.000</small>
                                </div>

                                <button type="reset" class="btn btn-danger btn-rd5" onclick="document.getElementById('InputID').value = ''">Reset</button>
                                <button type="submit" class="float-right btn btn-success btn-rd5">Withdraw</button>
                            </form>

                        </div>

                    </div>

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
                url: '<?= site_url('dashboard/get_metode_transfer_withdraw'); ?>',
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
                url: '<?= site_url('dashboard/get_metode_transfer_withdraw'); ?>',
                data: {
                    jenis: this.value
                },
                cache: false,
                success: function(response) {
                    $('#metode_transfer').html(response).show(600);;
                }
            });
        });


    });
</script>