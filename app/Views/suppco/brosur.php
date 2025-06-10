<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <!-- <script type="text/javascript" id="debugbar_loader" data-time="1685435630" src="<?= base_url() ?>/index.php?debugbar"></script> -->
    <!-- <script type="text/javascript" id="debugbar_dynamic_script"></script> -->
    <!-- <style type="text/css" id="debugbar_dynamic_style"></style> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--- Tell the browser to be responsive to screen width --->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/assets/images/logo-ptpn1.png">
    <title>Monika</title>

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/quill/dist/quill.snow.css"> -->
    <link href="<?= base_url(); ?>/assets/dist/css/style.min.css" rel="stylesheet">

    <script src="<?= base_url(); ?>/assets/assets/libs/jquery/dist/jquery.min.js"></script>
    <link href="<?= base_url(); ?>/assets/assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>/assets/assets/libs/toastr/build/toastr.min.js"></script>

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 1px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <style>
        .card-asset {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .card-asset:hover {
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            border-radius: 8px 8px 0 0;
            object-fit: cover;
            height: 200px;
            cursor: pointer;
        }

        .modal .card-img-top {
            height: auto;
            border-radius: 8px;
        }

        .card-img-top2 {
            border-radius: 8px 8px 0 0;
            object-fit: cover;
            height: 200px;
            cursor: pointer;
            filter: blur(6px);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
            text-align: center;
            text-transform: uppercase;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            font-size: 20px;
            line-height: 40px;
            text-align: center;
            color: #fff;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }

        .button-wrapper {
            display: flex;
            justify-content: center;
        }

        .button-wrapper a {
            color: #FFFFFF;
            text-decoration: none;
        }

        .button-wrapper a:hover {
            color: #FFFFFF;
            text-decoration: none;
        }

        .button-peta {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50px;
            background-color: navy;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 12px;
            padding: 4px 8px;
            width: 100px;
            transition: all 0.3s;
            cursor: pointer;
            margin: 5px;
            position: relative;
            overflow: hidden;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .button-peta:before {
            content: "";
            background: linear-gradient(45deg, #001f3f, #003e7d);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: all 0.3s;
            z-index: -1;
        }

        .button-peta:hover {
            transform: scale(0.95);
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.2);
        }

        .button-peta:hover:before {
            opacity: 1;
        }

        .button-private {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50px;
            background-color: black;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 12px;
            padding: 4px 8px;
            width: 300px;
            transition: all 0.3s;
            cursor: not-allowed;
            margin: 5px;
            position: relative;
            overflow: hidden;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .disabled-link {
            background-color: black;
            color: #888888;
            cursor: not-allowed;
            pointer-events: none;
            text-decoration: none;
        }


        .btn-primary-aset {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary-aset:hover {
            background-color: #0069d9;
            border-color: #0062cc;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-primary-aset i.fa {
            margin-right: 5px;
        }

        .btn-disabled-aset {
            background-color: #555555;
            border-color: #dddddd;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: not-allowed;
        }

        .btn-disabled-aset i.fa {
            margin-right: 5px;
        }

        .col-12.text-right {
            text-align: right;
        }

        .course-img-wrap {
            position: relative;
        }

        .aset-statusp {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            z-index: 10;
        }

        .blurred-image {
            filter: blur(10px);
            /* Adjust the blur amount as needed */
        }
    </style>

    <style>
        #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            margin-top: 20px;
        }

        .modal-dialog {
            max-width: 800px;
            margin: 30px auto;
        }

        #content-loader {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 20px;
            margin: 0 auto;
            width: 100px;
            display: none;
        }

        #content-loader>span {
            background-color: white;
            border-radius: 20px;
            padding: 8px 20px;
            -moz-box-shadow: 0 0 3px #ccc;
            -webkit-box-shadow: 0 0 3px #ccc;
            box-shadow: 0 0 3px #ccc;
        }
    </style>
</head>


<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" style="min-height: 720px;  display: flex; flex-direction: column; justify-content: space-between">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div>
            <header class="topbar" data-navbarbg="skin5">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header" data-logobg="skin5">
                        <!-- This is for the sidebar toggle which is visible on mobile only -->
                        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        <!-- Logo -->
                        <a class="navbar-brand" href="">
                            <b class="logo-icon p-l-10">
                                <img src="<?= base_url(); ?>/assets/assets/images/logo-ptpn1.png" alt="homepage" width="30" height="30" class="light-logo" loading="lazy" />
                            </b>
                            <span class="logo-text">
                                <span class="light-logo"> Monika</span>
                            </span>
                        </a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                        <!-- Left side toggle and nav items -->

                        <!-- Right side toggle and nav items -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>/C_login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>/C_register">Register</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="container">
                <div class="row">
                    <div class="col" style="text-align: center;">
                        <h1> Brosur <?= $brosur->master_aset_nama ?></h1>
                        <?php if (!empty($brosur->master_aset_brosur)): ?>
                            <img src="<?= site_url('../assets/assets/photo_brosur/' . $brosur->master_aset_brosur) ?>" alt="Brosur Aset" class="img-fluid">
                        <?php else: ?>
                            <p>Brosur akan segera hadir</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer  -->
        <footer class="footer text-center">
            All Rights Reserved by PT Perkebunan Nusantara I. Designed and Developed by PTPN I.
        </footer>

    </div>

    </div>

</body>
<script src="<?= base_url(); ?>/assets/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

<script src="<?= base_url(); ?>/assets/dist/js/waves.js"></script>

<script src="<?= base_url(); ?>/assets/dist/js/custom.min.js"></script>
