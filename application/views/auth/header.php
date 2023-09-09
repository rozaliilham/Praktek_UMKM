<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Start Favicon Icon -->
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/logo/<?= $web['fav']; ?>" />
    <!-- End Favicon Icon -->
    <title><?= $type; ?><?= $web['short_title']; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style type="text/css">
    .se-pre-con {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("<?= base_url('assets/'); ?>img/loader/Preloader_2.gif") center no-repeat #fff;
    }

    .bg-rgb {
        background: rgb(0, 232, 255);
        background: linear-gradient(0deg, rgba(0, 232, 255, 1)0%, rgba(33, 137, 217, 1)100%);
    }

    .btn-rgb {
        background: linear-gradient(to right, #507bf5 0%, #04c3e1 100%);
        color: white;
    }

    .btn-rgb:hover {
        font-weight: bold;
        color: white;
    }
</style>

<!-- Start Page Loading -->
<div class="se-pre-con"></div>
<!-- End Page Loading -->

<!-- Content Wrapper -->

<body id="page-top" class="bg-rgb">

    <!-- Page Wrapper -->
    <div id="wrapper">