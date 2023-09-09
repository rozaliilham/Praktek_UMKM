
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Page Heading -->
        <div class="col-md-12 text-center">
            <h1 class="h4 mb-2 text-gray-800">Kontak</h1> <hr class="sidebar-divider">
        </div>

        <!-- DataTales Example -->
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-address-card  fa-fw"></i> Kontak Kami</h6>
                </div>
                <div class="card-body">
                    <h6 class="font-weight-bold mb-3">Silahkan hubungi kontak dibawah ini untuk mendaftar atau mengajukan pertanyaan :</h6>
                    
                    <h6 class="h8 mb-1">Email : <span class="float-right"><a href="mailto:<?= $kontak['email']; ?>" target=”_blank”><?= $kontak['email']; ?></a></span></h6>
                    <h6 class="h8 mb-1">Nomor HP : <span class="float-right"><a href="https://wa.me/<?= $kontak['no_wa']; ?>" class="kt-widget__data" target=”_blank”><?= $kontak['no_wa']; ?></a></span></h6>
                    <h6 class="h8 mb-1">Jam Kerja : <span class="float-right"><?= $kontak['jam_kerja']; ?></span></h6>
                    <h6 class="h8 mb-1">Lokasi : <span class="float-right"><?= $kontak['alamat']; ?></span></h6>
                    <h6 class="h8 mb-1">Hari Libur Slow Respon</h6>            
                    
                </div>
                <div class="card-footer text-center">
                <a href="<?= $kontak['link_fb']; ?>" class="btn btn-primary btn-circle btn-sm"target=”_blank”>
                    <i class="fab fa-facebook-f"></i>
                  </a>
                <a href="<?= $kontak['link_ig']; ?>" class="btn btn-ig btn-circle btn-sm" target=”_blank”>
                    <i class="fab fa-instagram"></i>
                  </a>
                <a href="https://wa.me/<?= $kontak['no_wa']; ?>" class="btn btn-success btn-circle btn-sm" target=”_blank”>
                    <i class="fab fa-whatsapp"></i>
                  </a>
                </div>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="col-md-4">
            <div align="center" class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><img style="max-height: 50px;max-width:150px;height:50px;width:150px;" src="<?= base_url('assets/') ?>img/logo/logo-4.png" alt="logo"></h6>
                </div>
                <div class="card-body">
                <b><?= $web['title']; ?></b><br /><br />
                    <p><?= $web['deskripsi_web']; ?></p>               
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->
