<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- DataTales Example -->
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Pengaturan kontak</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('admin/kontak') ?>" method="post">
                        <div class="form-group">
                            <label for="no_wa">Nomor WA</label>
                            <input onchange="onChanges()" type="number" class="form-control" id="no_wa" name="no_wa" value="<?= $kontak['no_wa']; ?>">
                            <i class="form-control-feedback"></i>
                            <small class="text-danger pull-left"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email website</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $kontak['email']; ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Link Facebook</label>
                            <input type="text" class="form-control" name="link_fb" value="<?= $kontak['link_fb']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Link Instagram</label>
                            <input type="text" class="form-control" name="link_ig" value="<?= $kontak['link_ig']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?= $kontak['alamat']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Kode POS</label>
                            <input type="text" class="form-control" name="kode_pos" value="<?= $kontak['kode_pos']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Jam Kerja</label>
                            <input type="text" class="form-control" name="jam_kerja" value="<?= $kontak['jam_kerja']; ?>">
                        </div>

                        <button id="submit" type="submit" name="kirim" class="btn btn-primary btn-rd5"><i class="fa fa-refresh"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->
<script type="text/javascript">
    $(document).ready(function() {
        //mengecek nomer no_hp

        $('#no_wa').blur(function() {
            var no_wa = $(this).val();
            var len = no_wa.length;
            if (len > 0 && len <= 10) {
                $(this).parent().find('.text-danger').text("");
                $(this).parent().find('.text-danger').text("Nomer HP terlalu pendek.");
                return apply_feedback_error(this);
            } else {
                if (!valid_hp(no_wa)) {

                    $('#submit').prop('disabled', true);
                    $('#submit').addClass('disabled');
                    $('#submit').css('cursor', 'not-allowed');
                    $(this).parent().find('.text-danger').text("");
                    $(this).parent().find('.text-danger').text("Format nomor WA wajib 62 (ex: 6281234xxx123)");
                    return apply_feedback_error(this);
                } else {
                    $(this).parent().find('.text-danger').text("");
                    $('#submit').prop('disabled', false);
                    $('#submit').removeClass('disabled');
                    $('#submit').css('cursor', 'pointer');
                    if (len > 13) {
                        $(this).parent().find('.text-danger').text("");
                        $(this).parent().find('.text-danger').text("Nomer HP terlalu Panjang.");
                        return apply_feedback_error(this);
                    }
                }
            }
        });
        //fungsi cek phone
        function valid_hp(no_wa) {
            var pola = new RegExp(/628/);
            return pola.test(no_wa);
        }
    });
</script>