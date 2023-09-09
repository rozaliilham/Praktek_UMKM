<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Riwayat Deposit</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card card-body">
                    <form class="form-horizontal" action="<?= base_url() . 'dashboard/riwayat_depo'; ?>" method="post">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>Tampilkan Beberapa</label>
                                <select class="form-control" name="tampil">
                                    <option value="10">Default</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Filter Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Semua</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Success">Success</option>
                                    <option value="Error">Cancel</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari Kode Deposit</label>
                                <input type="number" class="form-control" name="cari" placeholder="Masukkan Kode Deposit Kamu" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter / Cari">
                            </div>
                        </div>
                    </form>


                    <div class="table-responsive">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tgl &amp; Waktu</th>
                                    <th>Via</th>
                                    <th>Penerima</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($deposit)) : ?>
                                    <?php foreach ($deposit->result() as $a) : ?>
                                        <tr>
                                            <td>
                                                <h5>
                                                    <span data-toggle="tooltip" data-placement="top" title="Salin kode" class="badge badge-secondary badge-pill btn-sm js-tooltip js-copy" data-copy="#<?= $a->kode_deposit ?>">#<?= $a->kode_deposit ?></span></h5>
                                            </td>
                                            <td><?= $a->date . ', ' . $a->time ?></td>
                                            <td><?= $a->provider ?></td>
                                            <td><?= $a->penerima ?></td>
                                            <td>Rp <?= number_format($a->jumlah_transfer, 0, ',', '.'); ?></td>
                                            <td>
                                                <?php if ($a->status  == 'Success') : ?>
                                                    <span class="btn btn-success btn-rd5 btn-pill btn-sm disabled" aria-disabled="true">Sukses</span>
                                                <?php elseif ($a->status  == 'Pending') : ?>
                                                    <span class="btn btn-warning btn-rd5 btn-pill btn-sm disabled" aria-disabled="true">Pending</span>
                                                <?php elseif ($a->status  == 'Error') : ?>
                                                    <span class="btn btn-danger btn-rd5 btn-pill btn-sm disabled" aria-disabled="true">Error</span>
                                                <?php endif ?>
                                            </td>
                                            <?php if ($a->metode  == 'OTO') : ?>
                                            <td>
                                                <a href="https://tripay.co.id/checkout/<?= $a->penerima ?>" target="_blank" type="button" class="btn btn-sm btn-rd5 btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                            <?php else : ?>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-rd5 btn-primary" data-toggle="modal" data-target="#detailM<?= $a->id ?>">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                            <?php endif ?>
                                        </tr>


                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="detailMLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailMLabel">Detail Deposit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4><?= $a->tipe ?> <?= $a->provider ?><?php if ($a->status  == 'Success') : ?>
                                                            <span class="btn btn-success btn-rd5 btn-pill btn-sm float-right disabled" aria-disabled="true">Sukses</span>
                                                        <?php elseif ($a->status  == 'Pending') : ?>
                                                            <span class="btn btn-warning btn-rd5 btn-pill btn-sm float-right disabled" aria-disabled="true">Pending</span>
                                                        <?php elseif ($a->status  == 'Error') : ?>
                                                            <span class="btn btn-danger btn-rd5 btn-pill btn-sm float-right disabled" aria-disabled="true">Error</span>
                                                        <?php endif ?></h4>
                                                        <p><b><?= $a->penerima ?> : <?= $a->no_penerima ?></b> <br>
                                                            <h6>Kode Deposit : #<?= $a->kode_deposit ?></h6>
                                                            <?php if ($a->status  == 'Pending') : ?>
                                                                <div class="alert alert-success" role="alert">
                                                                    <strong>Segera lunasi pembayaran!</strong><br />Jumlah yang harus di Transfer <strong>Rp <?= number_format($a->jumlah_transfer, 0, ',', '.') ?>,-</strong></div>
                                                            <?php endif ?>
                                                            Catatan :
                                                        </p>
                                                        <div class="alert alert-dark" role="alert">
                                                            <?= $a->catatan ?></div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan='5'>Data tidak ada</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                        <div>
                            <ul class="pagination pagination-split">
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">
                                        <b>Total data: <?= $total; ?></b>
                                    </span>
                                </li>
                                <?php echo $pagination; ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

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