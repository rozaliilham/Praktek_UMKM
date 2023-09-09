<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- DataTales Example -->
        <div class="col-lg-8 offset-lg-2">

            <?= $this->session->flashdata('message') ?>
            <div class="card shadow mb-1">
                <?php foreach ($deposit as $d) : ?>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h2>
                                    <b>INVOICE <br />
                                        <span data-toggle="tooltip" data-placement="top" title="Salin kode" class="btn btn btn-secondary btn-rd5 btn-sm js-tooltip js-copy" data-copy="#<?= $d['kode_deposit']; ?>">
                                            #<?= $d['kode_deposit'] ?>
                                        </span>
                                    </b>
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right float-right">
                                    <img style="max-height: 50px;max-width:150px;height:50px;width:150px;" src="<?= base_url('assets/') ?>img/logo/logo-4.png" alt="logo">
                                    <br><span class="h6 small">
                                        <?= $kontak['alamat']; ?></span><br>
                                    <span class="h6 small">Kode Pos <?= $kontak['kode_pos']; ?></span>
                                </div>
                            </div>
                        </div>
                        <hr style="border-top: 1px solid white;">
                        <div class="row text-white-100 small">
                            <div class="col-md-4 mb-2">
                                TANGGAL & WAKTU<br>
                                <span class="text-gray-700"><?= $d['date'] ?>, <?= $d['time'] ?></span>
                            </div>
                            <div class="col-md-4 mb-2">
                                KODE INVOICE<br>
                                <span class="text-gray-700"><b>#<?= $d['kode_deposit'] ?></b></span>
                            </div>
                            <div class="col-md-4 mb-1">
                                STATUS<br>
                                <?php if ($d['status']  == 'Success') : ?>
                                    <h6><span class="badge badge-success btn-rd5 disabled">Sukses</span></h6>
                                <?php elseif ($d['status']  == 'Pending') : ?>
                                    <h6><span class="badge badge-warning btn-rd5 disabled">Pending</span></h6>
                                <?php elseif ($d['status']  == 'Error') : ?>
                                    <h6><span class="badge badge-danger btn-rd5 disabled">Error</span></h6>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card bg-gray-400 shadow">
                <div class="card-body">
                    <?= $d['catatan'] ?>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>TIPE TRANSFER</td>
                                    <td><?= $d['provider'] ?></td>
                                </tr>
                                <tr>
                                    <td>PENERIMA</td>
                                    <td><?= $d['penerima'] ?></td>
                                </tr>
                                <tr>
                                    <td>NO PENERIMA</td>
                                    <?php if ($d['metode'] == 'OTO') : ?>
                                        <td class="h5 text-danger bold">
                                            <span data-toggle="tooltip" data-placement="top" title="Salin nomor" class="js-tooltip js-copy" data-copy="<?= $d['no_penerima'] ?>">
                                                <b id="myTooltip">
                                                    <?= $d['no_penerima'] ?>
                                                </b>
                                            </span>
                                        </td>
                                    <?php else : ?>
                                        <td><b><?= $d['no_penerima'] ?></b></td>
                                    <?php endif ?>
                                </tr>
                                <tr>
                                    <td>SALDO YANG DIDAPATKAN</td>
                                    <td><b>Rp <?= number_format($d['get_saldo'], 0, ',', '.') ?></b></td>
                                </tr>
                                <tr>
                                    <td>JUMLAH TRANSFER</td>
                                    <?php if ($d['metode'] == 'OTO') : ?>
                                        <td class="h5 bold"><b>Rp <?= number_format($d['get_saldo'], 0, ',', '.') ?></b></td>
                                    <?php else : ?>
                                        <td class="h5 text-danger bold">
                                            <span data-toggle="tooltip" data-placement="top" title="Salin nomor" class="js-tooltip js-copy" data-copy="<?= $d['jumlah_transfer']; ?>">
                                                <b id="myTooltip">
                                                    Rp <?= number_format($d['jumlah_transfer'], 0, ',', '.') ?>,-
                                                </b>
                                            </span>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row text-white-100 small">
                        <div class="col-md-12">
                            <div class="float-left">
                                <a href="<?= base_url('dashboard/riwayat_depo'); ?>" class="btn btn-light btn-icon-split">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-left"></i>
                                    </span>
                                    <span class="text">History</span>
                                </a>
                            </div>
                            <?php if ($d['metode']  !== 'OTO') : ?>
                            <?php if ($d['status']  == 'Pending') : ?>
                                <div class="float-right mt-2">
                                    <a href="<?= base_url('dashboard/batal_deposit/' . $d['kode_deposit']); ?>" type="submit" class="btn btn-rd5 btn-danger btn-bold">Batalkan</a>
                                </div>
                            <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>


                </div>

            </div>
        <?php endforeach ?>

        </div>

    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    function copyToClipboard(text, el) {
        var copyTest = document.queryCommandSupported('copy');
        var elOriginalText = el.attr('data-original-title');

        if (copyTest === true) {
            var copyTextArea = document.createElement("textarea");
            copyTextArea.value = text;
            document.body.appendChild(copyTextArea);
            copyTextArea.select();
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'Tersalin!' : 'Ups, tidak tersalin!';
                el.attr('data-original-title', msg).tooltip('show');
            } catch (err) {
                console.log('Ups, tidak dapat menyalin');
            }
            document.body.removeChild(copyTextArea);
            el.attr('data-original-title', elOriginalText);
        } else {
            // Fallback if browser doesn't support .execCommand('copy')
            window.prompt("Salin ke clipboard: Ctrl + C atau Command + C, Enter", text);
        }
    }

    $(document).ready(function() {
        // Initialize
        // ---------------------------------------------------------------------

        // Tooltips
        // Requires Bootstrap 3 for functionality
        $('.js-tooltip').tooltip();

        // Copy to clipboard
        // Grab any text in the attribute 'data-copy' and pass it to the 
        // copy function
        $('.js-copy').click(function() {
            var text = $(this).attr('data-copy');
            var el = $(this);
            copyToClipboard(text, el);
        });
    });
</script>