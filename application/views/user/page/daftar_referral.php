<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800"><i class="fa fa-history"></i> Daftar Referral</h1>
            <!-- Divider -->
            <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="mt-3 fa fa-gift fa-fw"></i> Program Referral
                        <a href="<?= base_url('dashboard/daftar_withdraw'); ?>" style="font-size:13px" class="m-2 btn btn-primary btn-rd5 font-weight-bold btn-sm float-right" role="button">Daftar Withdraw</a>
                    </h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-lg-10 control-label">Saldo Referral Kamu</label>
                                <div class="col-md-8">
                                    <form action="<?= base_url() . 'dashboard/tarik_referral'; ?>">
                                        <div class="input-group">
                                            <input style="font-weight:bold" type="text" name="referral" class="form-control" value="Rp <?= number_format($user['saldo_referral'], 0, ',', '.') ?>,-" readonly="" disabled>
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-money"></i> Withdraw</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mb-4">
                                <label class="col-lg-10 control-label">Kode Referral Kamu</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input style="font-weight:bold" type="text" class="form-control" value="<?= $user['kode_referral']; ?>" readonly="">
                                        <button data-toggle="tooltip" title="Salin Referral" class="btn btn-primary btn-sm btn-copy js-tooltip js-copy" data-copy="<?= $user['kode_referral']; ?>"><i class="fa fa-copy"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <b> Langkah - langkah Program Referral : </b>
                    <ul class="mt-2">
                        <li class="mb-1">Beritahu dan ajak Teman, Keluarga, Sanak Saudara, Orang spesial atau siapapun untuk ikut bergabung di <?= $web['nama_web']; ?> melalui kode Referral kamu saat mendaftarkan Akun.</li>
                        <li class="mb-1">Setelah orang yang kamu ajak mendaftar melalui Kode Referral Kamu dan Melakukan Transaksi di <?= $web['nama_web']; ?>, Maka kamu akan mendapatkan bonus <?= $bonus['jumlah']; ?>% dari Transaksinya.</li>
                        <li class="mb-1">Contoh kamu berhasil mengajak Teman dengan memasukan kode Referral kamu saat mendaftar Akun, Kemudian teman kamu telah melakukan Transaksi di <?= $web['nama_web']; ?>, Maka kamu akan mendapatakan bonus <?= $bonus['jumlah']; ?>% Gratis Otomatis langsung masuk ke saldo akun Kamu.</li>
                        <li class="mb-1">Tanpa syarat terbuka untuk semua member <?= $web['nama_web']; ?>. Yuk Mulai kumpulkan bonusnya dari Sekarang untuk komisi bulanan kamu!</li>
                        <li class="mb-1">Status Program Referral <?= $web['nama_web']; ?> saat ini
                            <?php if ($bonus['status'] == 'Aktif') : ?>
                                <i class="badge badge-success">Aktif</i>
                            <?php elseif ($bonus['status'] == 'Tidak Aktif') : ?>
                                <i class="badge badge-danger">Tidak Aktif</i>
                            <?php endif ?>
                        </li>
                        <li class="mb-1">Jika butuh bantuan silahkan hubungi kontak Kami.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-user-plus fa-fw"></i> Daftar Pengguna Referral</h6>
                    </div>
                    <form style="margin: 20px 0;" action="<?= base_url() . 'dashboard/daftar_referral'; ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label>Tipe Sortir</label>
                                <select class="form-control" name="sortir">
                                    <option value="">Tipe..</option>
                                    <option value="ASC">ASC</option>
                                    <option value="DESC">DESC</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Kolom Sortir</label>
                                <select class="form-control" name="kolom">
                                    <option value="">Kolom.</option>
                                    <option value="id">Id</option>
                                    <option value="username">Nama</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Cari Nama</label>
                                <input type="text" class="form-control" name="cari" placeholder="Cari nama referral member" value="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Submit</label>
                                <input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                if (!empty($referral)) : ?>
                                    <?php foreach ($referral->result() as $a) : ?>
                                        <tr>
                                            <td><?= $i + $this->uri->segment(3); ?></td>
                                            <td><?= $a->username; ?></td>
                                            <td>Rp <?= number_format($a->jumlah_reff, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php $i++;
                                    endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan='5'>Data tidak ada</td>
                                    </tr>
                                <?php endif ?>
                                <tr>
                                    <td>#</td>
                                    <td class="float-right"><b>Jumlah Total :</b></td>
                                    <td><b>Rp <?= number_format($tot_reff['jumlah_reff'], 0, ',', '.'); ?>,-</b></td>
                                </tr>
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