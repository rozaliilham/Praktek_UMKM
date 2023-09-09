<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Pemesanan Baru</h1>
            <p class="mb-4"><i class="fa fa-info-circle fa-fw"></i> Baca Informasi yang terletak dikanan (PC/Tablet) / dibawah (Smartphone) form sebelum melakukan Submit!</p>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-shopping-cart fa-fw"></i> Pesanan Baru</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form class="form-horizontal" action="<?= base_url('dashboard/pesanbaru') ?>" method="post">
                        <div class="form-group">
                            <label for="kategori">Kategori :</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <option value="">Pilih kategori</option>
                                <?php foreach ($kategori as $row) : ?>
                                    <option value="<?= $row->kode; ?>"><?= $row->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="layanan">Layanan :</label>
                            <select class="form-control" id="layanan" name="layanan">
                                <option value="">Pilih kategori dahulu</option>
                            </select>
                            <?= form_error('layanan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div id="pesanan"></div>

                        <div class="form-group">
                            <label class="control-label" for="pesan">Target</label>
                            <input type="text" class="form-control" id="target" name="target" value="<?= set_value('target'); ?>">
                            <?= form_error('target', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jumlah Pesan *</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" onkeyup="get_total(this.value).value;">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Total Harga</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" name="total" class="form-control" id="total" placeholder="0" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="reset" class="btn btn-danger btn-rd5 btn-bold" onclick="document.getElementById('InputID').value = ''">Reset</button>
                        <button type=" submit" name="kirim" class="float-right btn btn-primary btn-rd5 btn-bold">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="col-md-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Informasi</h6>
                </div>
                <div class="card-body">
                    <b>Langkah-langkah membuat pesanan baru:</b>
                    <ul>
                        <li>Pilih salah satu Kategori.</li>
                        <li>Pilih salah satu Layanan yang ingin dipesan.</li>
                        <li>Masukkan Target pesanan sesuai ketentuan yang diberikan layanan tersebut.</li>
                        <li>Masukkan Jumlah Pesanan yang diinginkan.</li>
                        <li>Klik Submit untuk membuat pesanan baru.</li>
                    </ul>
                    <br>
                    <b>Ketentuan membuat pesanan baru:</b>
                    <ul>
                        <li>Silahkan membuat pesanan sesuai langkah-langkah diatas.</li>
                        <li>Jika ingin membuat pesanan dengan Target yang sama dengan pesanan yang sudah pernah dipesan sebelumnya, mohon menunggu sampai pesanan sebelumnya selesai diproses.
                            Jika terjadi kesalahan / mendapatkan pesan gagal yang kurang jelas, silahkan hubungi Admin untuk informasi lebih lanjut.</li>
                        <li>Jangan memasukkan orderan yang sama jika orderan sebelumnya belum selesai. </li>
                        <li>Jangan memasukkan orderan yang sama di panel lain jika orderan di <?= $web['nama_web']; ?> belum selesai. </li>
                        <li>Jangan mengganti username atau menghapus link target saat sudah order. </li>
                        <li>Orderan yang sudah masuk tidak dapat di cancel / refund manual, seluruh proses orderan dikerjakan secara otomatis oleh server. </li>
                        <li>Jika Anda memasukkan orderan di <?= $web['nama_web']; ?> berarti Anda sudah mengerti aturan <?= $web['nama_web']; ?>.<br />Jangan lupa baca menu F.A.Q serta Terms. </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    /* Tanpa Rupiah */
    // var tanpa_rupiah = document.getElementById('jumlah');
    // tanpa_rupiah.addEventListener('keyup', function(e) {
    //     tanpa_rupiah.value = formatRupiah(this.value);
    // });

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('total');
    dengan_rupiah.addEventListener('change', function(e) {
        dengan_rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#kategori').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_kategori'); ?>',
                data: {
                    kategori: this.value
                },
                cache: false,
                success: function(response) {
                    $('#layanan').html();
                    $('#layanan').html(response);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#layanan').change(function() {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('dashboard/get_layanan'); ?>',
                data: {
                    layanan: this.value
                },
                cache: false,
                success: function(response) {
                    $('#pesanan').html(response);
                }
            });
        });
    });

    function get_total(quantity) {
        var rate = $("#harga").val();
        var result = eval(quantity) * rate;
        if (result == NaN) {
            result = 0; //use result at the place you want
            $('#total').val(result);
        }
        $('#total').val(result);
    }
</script>