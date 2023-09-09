<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">History Order</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>
        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card card-body">
                    <form class="form-horizontal" action="<?= base_url() . 'dashboard/riwayat_order'; ?>" method="post">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>Ambil status</label>
                                <a href="<?= base_url('home/update_status/riwayat_order'); ?>" class="btn btn-block btn-primary" type="button"><i class="fa fa-refresh"></i> Refresh</a>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Filter Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Semua</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Success">Success</option>
                                    <option value="Error">Error</option>
                                    <option value="Partial">Partial</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari Kode Pesanan</label>
                                <input type="number" class="form-control" name="cari" placeholder="Masukkan Kode Pesanan Kamu" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter / Cari">
                            </div>
                        </div>
                    </form>


                    <div class="table-responsive">
                        <?= $this->session->flashdata('message1'); ?>
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tgl &amp; Waktu</th>
                                    <th>Nama Layanan</th>
                                    <th>Target</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($order)) : ?>
                                    <?php foreach ($order->result() as $a) : ?>
                                        <tr>
                                            <td><span class="btn btn btn-secondary btn-rd5 btn-sm disabled" data-toggle="modal" id="79" data-target="#myDetailSosmed"><?= $a->oid ?></span></td>
                                            <td><?= $a->date ?> - <?= $a->time ?></td>
                                            <td><?= $a->layanan ?></td>
                                            <td style="min-width: 200px;">
                                                <div class="input-group">

                                                    <input type="text" class="form-control form-control-sm" value="<?= $a->target ?>" id="myInput<?= $a->oid ?>" readonly="">
                                                    <button data-toggle="tooltip" data-placement="top" title="Salin text" class="btn btn-primary btn-sm btn-copy js-tooltip js-copy" data-copy="<?= $a->target ?>">
                                                        <i id="myTooltip" style="color:white" class="fa fa-copy"></i>
                                                    </button>

                                                </div>
                                            </td>
                                            <td><?= $a->jumlah ?></td>
                                            <td>Rp <?= number_format($a->harga, 0, ',', '.') ?></td>
                                            <td>
                                                <?php if ($a->status == 'Pending') : ?>
                                                    <span class="btn btn-warning btn-rd5 btn-sm disabled">Pending</span>
                                                <?php elseif ($a->status == 'Processing') : ?>
                                                    <span class="btn btn-info btn-rd5 btn-sm disabled">Processing</span>
                                                <?php elseif ($a->status == 'Error') : ?>
                                                    <span class="btn btn-danger btn-rd5 btn-sm disabled">Error</span>
                                                <?php elseif ($a->status == 'Partial') : ?>
                                                    <span class="btn btn-secondary btn-rd5 btn-sm disabled">Partial</span>
                                                <?php elseif ($a->status == 'Success') : ?>
                                                    <span class="btn btn-success btn-rd5 btn-sm disabled">Success</span>
                                                <?php endif ?>
                                        </tr>

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