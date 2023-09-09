<!-- Start Slider -->
<section class="slider d-flex align-items-center" id="slider">
    <div class="container">
        <div class="content">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="left">
                        <h3><?= $web['title']; ?></h3>
                        <p><?= $web['deskripsi_web']; ?></p>
                        <a href="<?= base_url(); ?>auth" class="btn-1">Masuk</a>
                        <a href="<?= base_url(); ?>auth/register" class="btn-2">Daftar</a>
                    </div>
                </div>
                <!-- Right-->
                <div class="col-md-6">
                    <div class="right">
                        <img src="assets/img/slider-img.png" alt="slider-img" class="img-fluid wow fadeInRight" data-wow-offset="1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Slider -->

<!-- Start Features -->
<section class="features" id="features">
    <div class="container text-center">
        <div class="heading">
            <h2>3 Langkah Mudah Untuk Memulai Transaksi</h2>
        </div>
        <div class="line"></div>
        <div class="row">
            <!-- Box-1 -->
            <div class="col-md-4">
                <div class="box">
                    <img src="assets/img/feature-1.png" alt="feature-1">
                    <h3>Melakukan Pendaftaran Akun</h3>
                    <p>Pendaftaran Mudah Dan Gratis, Setelah Mendaftar Akun Anda Langsung Aktif Dan Dapat Melakukan Isi Saldo.</p>
                </div>
            </div>
            <!-- Box-2 -->
            <div class="col-md-4">
                <div class="box">
                    <img src="assets/img/feature-2.png" alt="feature-1">
                    <h3>Melakukan Isi Saldo</h3>
                    <p>Langkah Selanjutnya Anda Melakukan Isi Saldo Agar Dapat Digunakan Untuk Transaksi Semua Produk Terlengkap Dari Kami.</p>
                </div>
            </div>
            <!-- Box-3 -->
            <div class="col-md-4">
                <div class="box">
                    <img src="assets/img/feature-3.png" alt="feature-1">
                    <h3>Melakukan Transaksi</h3>
                    <p>Langkah Terakhir Melakukan Transaksi Anda Dengan Produk Terlengkap Dan Termurah Dari Kami.</p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End Features -->

<!-- Start Some Facts -->
<section class="some-facts">
    <div class="container text-center">
        <div class="row">
            <!-- BOX-1 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="assets/img/some-fact/1.png" alt="some-fact-1">
                    <h3><span class="counter"><?= number_format($sum_user, 0, ',', '.'); ?></span>+</h3>
                    <div class="line mx-auto"></div>
                    <h4>Total Pengguna</h4>
                </div>
            </div>
            <!-- BOX-2 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="assets/img/some-fact/3.png" alt="some-fact-1">
                    <h3><span class="counter"><?= number_format($sum_pesanan, 0, ',', '.'); ?></span>+</h3>
                    <div class="line mx-auto"></div>
                    <h4>Total Pesanan</h4>
                </div>
            </div>
            <!-- BOX-3 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="assets/img/some-fact/2.png" alt="some-fact-1">
                    <h3><span class="counter"><?= number_format($sum_depo, 0, ',', '.'); ?></span>+</h3>
                    <div class="line mx-auto"></div>
                    <h4>Total Deposit</h4>
                </div>
            </div>
            <!-- BOX-4 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="assets/img/some-fact/4.png" alt="some-fact-1">
                    <h3><span class="counter"><?= number_format($sum_layanan, 0, ',', '.'); ?></span>+</h3>
                    <div class="line mx-auto"></div>
                    <h4>Total Layanan</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Some Facts -->

<!-- Start Project -->
<section class="project" id="about-us">
    <div class="container">
        <div class="row d-flex align-items-center">
            <!-- Left -->
            <div class="col-md-6">
                <img src="assets/img/create-saas.png" alt="project" class="img-fluid">
            </div>
            <!-- Right -->
            <div class="col-md-5">
                <div class="right">
                    <h2>Tentang Kami</h2>
                    <p><?= $web['deskripsi_web']; ?></p>
                    <a href="<?= base_url(); ?>auth/register" class="btn-1">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Project -->

<!-- Start Benefits -->
<section class="benefits" id="benefits">
    <div class="container text-center">
        <div class="heading">
            <h2>Fitur <?= $web['nama_web']; ?></h2>
        </div>
        <div class="line"></div>
        <div class="row">
            <!-- BOX-1 -->
            <div class="col-md-4 col-sm-6">
                <div class="box mb-30">
                    <img src="assets/img/icons/plan.png" width="80" alt="benefits">
                    <h3>Layanan Terbaik</h3>
                    <p>Kami Menyediakan Berbagai Layanan Terbaik Untuk Kebutuhan Sosial Media & Pulsa/PPOB Untuk Anda.</p>

                </div>
            </div>
            <!-- BOX-2 -->
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="assets/img/icons/megaphone.png" width="80" alt="benefits">
                    <h3>Pelayanan Bantuan</h3>
                    <p>Kami Selalu Siap Membantu Jika Anda Membutuhkan Kami Dalam Penggunaan Layanan Kami.</p>

                </div>
            </div>
            <!-- BOX-3 -->
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="assets/img/icons/api.png" width="80" alt="benefits">
                    <h3>API Dokumentasi</h3>
                    <p>Tersedia API Beserta Dokumentasinya Untuk Reseller Anda.</p>

                </div>
            </div>
            <!-- BOX-4 -->
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="assets/img/icons/admin.png" width="80" alt="benefits">
                    <h3>Desain Web Responsive</h3>
                    <p>Kami Menggunakan Desain Website Yang Dapat Diakses Dari Berbagai Device, Baik Smartphone Android Maupun Desktop.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="assets/img/icons/debit-card.png" width="80" alt="benefits">
                    <h3>Deposit Saldo</h3>
                    <p>Deposit Otomatis 24 Jam, Memudahkan Anda Deposit Kapan Saja.</p>

                </div>
            </div>
            <!-- BOX-5 -->
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="assets/img/icons/timeline.png" width="80" alt="benefits">
                    <h3>Kemudahan Pengguna</h3>
                    <p>Kami Menyediakan Fitur Yang Mudah Di Mengerti Oleh Para Pengguna.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Benifits -->

<!-- Start Testimonials -->
<section hidden class="testimonials" id="testimonials">
    <div class="container text-center">
        <div class="heading">
            <h2>Testimonial</h2>
        </div>
        <div class="line"></div>
        <div class="slick-slider">
            <!-- BOX-1 -->
            <div class="box">
                <img src="assets/img/testimonials/1.png" alt="" class="m-auto">
                <h3>Jack Fritz</h3>
                <span>Member</span>
                <p><?= $web['nama_web']; ?> Terbaik, Pelayanan Nya Fast Respon.</p>
            </div>
            <!-- BOX-2 -->
            <div class="box">
                <img src="assets/img/testimonials/2.png" alt="" class="m-auto">
                <h3>Mohamed Moaz</h3>
                <span>Member</span>
                <p><?= $web['nama_web']; ?> Mantap, Pesanan Nya Di Proses Sangat Cepat Dan Layanan Nya Murah Meriah.</p>
            </div>
            <!-- BOX-3 -->
            <div class="box">
                <img src="assets/img/testimonials/3.png" alt="" class="m-auto">
                <h3>Pascal Brin</h3>
                <span>Member</span>
                <p><?= $web['nama_web']; ?> Harga Sangat Terjangkau Dan Produk Layanan Lengkap.</p>
            </div>
            <div class="box">
                <img src="img/testimonials/4.html" alt="" class="m-auto">
                <h3>Hector Mark</h3>
                <span>Member</span>
                <p><?= $web['nama_web']; ?> Bagus Untuk Reseller Yang Butuh Layanan Pulsa & Produk Layanan Via API.</p>
            </div>
        </div>
    </div>
</section>
<!-- End Testimonials -->
<a hidden href='https://pngtree.com/so/boost'>boost png from pngtree.com</a>
<!-- Start Contact Us -->
<section class="contact" id="contact">
    <div class="container">
        <div class="heading text-center">
            <h2>Info Kontak</h2>
            <div class="line"></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="title">
                    <h3>Hubungi Kami :</h3>
                    <p>Silahkan Hubungi Kami Jika Anda Butuh Bantuan</p>
                </div>
                <div class="content">
                    <!-- INFO-1 -->
                    <div class="info d-flex align-items-start">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <h4 class="d-inline-block">NOMOR WHATSAPP :
                            <br>
                            <a href="https://api.whatsapp.com/send?phone=<?= $kontak['no_wa']; ?>" target="_blank"><span><?= $kontak['no_wa']; ?></span></a></h4>
                    </div>
                    <!-- INFO-2 -->
                    <div class="info d-flex align-items-start">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <h4 class="d-inline-block">EMAIL :
                            <br>
                            <span><?= $kontak['email']; ?></span></h4>
                    </div>
                    <!-- INFO-3 -->
                    <div class="info d-flex align-items-start">
                        <i class="fa fa-street-view" aria-hidden="true"></i>
                        <h4 class="d-inline-block">ALAMAT :<br>
                            <span><?= $kontak['alamat']; ?></span></h4>
                    </div>
                    <!-- INFO-4 -->
                    <div class="info d-flex align-items-start">
                        <i class="fa fa-street-view" aria-hidden="true"></i>
                        <h4 class="d-inline-block">JAM KERJA :<br>
                            <span><?= $kontak['jam_kerja']; ?></span></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <img src="assets/img/contact.png" alt="project" class="img-fluid">
            </div>

        </div>
    </div>
</section>
<!-- End Contact Us -->