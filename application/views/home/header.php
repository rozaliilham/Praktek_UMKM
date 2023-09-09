<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $type; ?><?= $web['short_title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="<?= $web['deskripsi_web']; ?>" name="description" />
    <meta content="ArCode" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <!----------------------- Snipet Open graph Fcebook ---------------------->
    <meta property="og:title" content="<?= $web['title']; ?>" />
    <meta property="og:description" content="<?= $web['deskripsi_web']; ?>" />
    <meta property="og:image" content="<?= base_url('assets/'); ?>img/<?= $web['og']; ?>" />


    <!-- Start Favicon Icon -->
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/logo/<?= $web['fav']; ?>" />
    <!-- End Favicon Icon -->
    <!-- Start Bootstrap 4.1.3 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
    <!-- End Bootstrap 4.1.3 -->

    <!-- Start Animate Css -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/animate.css">
    <!-- End Animate Css -->

    <!-- Start Magnific Popup -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/magnific-popup.css">
    <!-- End Magnific Popup -->

    <!-- Start Slick Slider -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/slick.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/slick-theme.css">
    <!-- End Slick Slider -->

    <!-- Start Main Style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/main.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/custom.css">

    <!-- Start Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <!-- End Google Fonts -->

    <!-- Start Fonts Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <!-- End Fonts Awesome -->

</head>

<body>
    <!-- Start Page Loading -->
    <div class="se-pre-con"></div>
    <div id="app">
        <!-- End Page Loading -->

        <!-- Start Navbar -->
        <header class="header-global">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="<?= base_url(); ?>">
                        <img style="max-height: 50px;max-width:150px;height:50px;width:150px;" src="<?= base_url('assets/') ?>img/logo/<?= $web['logo']; ?>" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php if ($menu != '0') {
                                                                echo base_url(); ?>#slider<?php } else {
                                                                                            echo base_url();
                                                                                        }; ?>">Halaman Utama</a>
                            </li>
                            <li <?php if ($menu != '0') {
                                    echo base_url(); ?>#slider<?php } else {
                                                                echo "hidden";
                                                            }; ?> class="nav-item">
                                <a class="nav-link" href="#benefits">Fitur Kami</a>
                            </li>
                            <li hidden class="nav-item">
                                <a class="nav-link" href="#testimonials">Testimonial</a>
                            </li>
                            <li <?php if ($menu != '0') {
                                    echo base_url(); ?>#slider<?php } else {
                                                                echo "hidden";
                                                            }; ?> class="nav-item">
                                <a class="nav-link" href="#contact">Kontak Kami</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>home/service">Daftar Harga</a>
                            </li>
                        </ul>
                        <a href="<?= base_url(); ?>auth" role="button" class="btn-1">Masuk</a>

                    </div>
                </div>
            </nav>
        </header>
        <!-- End Navbar -->