<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <!-- <div class="col-md-12 text-center">
            <div class="shadow mb-3">
                <div class="shadow h-100 py-2">
                    <div class="body mt-3">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total saldo seluruh pengguna</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">Rp. <?= number_format($total_saldo['saldo'], 0, ',', '.') ?></div>
                                <div class="small mb-0 font-weight-bold text-gray-500 mt-2">
                                    <p>Dari 50 User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> -->

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="mt-0 mb-3 header-title"><i class="fas fa-list"></i> Daftar Pesanan</h4>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'admin/daftar_orderan'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-2">
                                <label>Ambil status</label>
                                <a href="<?= base_url('home/update_status/admin'); ?>" class="btn btn-block btn-warning" type="button"><i class="fa fa-refresh"></i> Refresh</a>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Tipe sortir</label>
                                <select class="form-control" name="tipe">
                                    <option value="">Tipe</option>
                                    <option value="ASC">ASC</option>
                                    <option value="DESC">DESC</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Sortir status</label>
                                <select class="form-control" name="status">
                                    <option value="">Semua</option>
                                    <option value="Success">Success</option>
                                    <option value="Partial">Partial</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Error">Error</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari kode order</label>
                                <input type="number" class="form-control" name="cari" placeholder="Ketik kode orderan" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <?= $this->session->flashdata('message1'); ?>
                        <?= $this->session->flashdata('message'); ?>
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Member</th>
                                    <th>Layanan</th>
                                    <th>Tujuan</th>
                                    <th>Jumlah</th>
                                    <th>Start count</th>
                                    <th>Remains</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Refund</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($daftar)) : ?>
                                    <?php $i = 1;
                                    foreach ($daftar->result() as $a) : ?>
                                        <tr>
                                            <td><span class="badge p-2 badge-secondary disabled">#<?= $a->oid ?></span></td>
                                            <td><?= $a->date . ', ' . $a->time ?></td>
                                            <td><span class="badge p-2 badge-warning disabled"><?= $a->user ?></span></td>
                                            <td><?= $a->layanan ?></td>
                                            <td style="min-width: 150px;">
                                                <div class="input-group">

                                                    <input type="text" class="form-control form-control-sm" value="<?= $a->target ?>" id="myInput<?= $a->oid ?>" readonly="">
                                                    <button data-toggle="tooltip" data-placement="top" title="Salin text" class="btn btn-primary btn-sm btn-copy js-tooltip js-copy" data-copy="<?= $a->target ?>">
                                                        <i id="myTooltip" style="color:white" class="fa fa-copy"></i>
                                                    </button>

                                                </div>
                                            </td>
                                            <td><?= $a->jumlah ?></td>
                                            <td><?= $a->start_count ?></td>
                                            <td><?= $a->remains ?></td>
                                            <td><span class="badge p-2 badge-info disabled">Rp <?= number_format($a->harga, 0, ',', '.'); ?></span></td>
                                            <form action="<?= base_url() . 'admin/status_order'; ?>" method="post">
                                                <input type="hidden" name="id" value="<?= $a->oid ?>">
                                                <td>
                                                    <?php if ($a->status == 'Pending') : ?>
                                                        <select class="form-control" style="width: 110px;" id="status" name="status">
                                                            <option value="<?= $a->status ?>"><?= $a->status ?></option>
                                                            <option value="Processing">Processing</option>
                                                            <option value="Success">Success</option>
                                                            <option value="Error">Error</option>
                                                            <option value="Partial">Partial</option>
                                                        </select>
                                                    <?php elseif ($a->status == 'Processing') : ?>
                                                        <select class="form-control" style="width: 110px;" id="status" name="status">
                                                            <option value="<?= $a->status ?>"><?= $a->status ?></option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Success">Success</option>
                                                            <option value="Error">Error</option>
                                                            <option value="Partial">Partial</option>
                                                        </select>
                                                    <?php elseif ($a->status == 'Success') : ?>
                                                        <span class="badge p-2 badge-success disabled"><?= $a->status ?></span>
                                                    <?php elseif ($a->status == 'Partial') : ?>
                                                        <span class="badge p-2 badge-secondary disabled"><?= $a->status ?></span>
                                                    <?php elseif ($a->status == 'Error') : ?>
                                                        <span class="badge p-2 badge-danger disabled"><?= $a->status ?></span>
                                                    <?php endif; ?>

                                                </td>
                                                <td class="text-center"><?php if ($a->refund == '1') : ?>
                                                        <span class="badge badge-success"><i class="fa fa-check"></i></span>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger"><i class="fa fa-times"></i></span>
                                                    <?php endif ?>
                                                </td>
                                                <td><?php if (($a->status == 'Pending') || ($a->status == 'Processing')) : ?>
                                                        <button type="submit" class="badge badge-sm btn-rd5 badge-primary">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    <?php endif; ?>
                                            </form>
                                            <button class="badge badge-sm btn-rd5 badge-danger" data-toggle="modal" data-target="#hapusM<?= $a->id ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusM<?= $a->id ?>" tabindex="-1" role="dialog" aria-labelledby="hapusMLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusMLabel">Hapus Pesanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus orderan dengan Kode pesanan <b>#<?= $a->oid ?></b><br>
                                                        Pilih "Hapus" di bawah ini jika Anda ingin menghapusnya.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                        <a class="btn btn-danger" href="<?= base_url('admin/hapus_orderan/' . $a->oid . ''); ?>">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php $i++;
                                    endforeach ?>
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
    $(document).ready(function() {

        //update record to database
        $('#status').on('click', function() {
            var status = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/update_status') ?>",
                dataType: "JSON",
                data: {
                    status: status
                }
            });
            return false;
        });
    });


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