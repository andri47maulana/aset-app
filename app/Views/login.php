<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x8" href="<?= base_url(); ?>/assets/assets/images/LOGO-PTPN.png">
    <title>Manajemen Aset Terpadu Supp Co</title>
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/assets/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .radio-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            border: 1px solid white;
            padding: 10px;
        }

        .form-check {
            margin-right: 10px;
        }

        .unselectable {
            -webkit-user-select: none;
            -webkit-touch-callout: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #cc0000;
        }

        body {
            overflow-y: hidden;
            /* Sembunyikan vertical scrollbar */
            overflow-x: hidden;
            /* Sembunyikan horizontal scrollbar */
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
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
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="row">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <img src="<?= base_url(); ?>/assets/assets/images/LOGO-PTPN.png" alt="homepage" width="120" height="120" />
                        <br><br>
                        <h1 style="color:white; margin-left:-150px; margin-right:-150px; font-size: 37px;">Manajemen dan Optimalisasi Aset</h1>
                    </div>
                    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                        <div id="error-message" class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('gagal') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="row p-b-30">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" method="post" action="" id="loginForm">

                                <!-- Login As -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text bg-secondary text-white" for="inputGroupSelect01">Login As</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="radios">
                                        <option selected disabled>Pilih Jenis Login</option>
                                        <option value="monica">Monika</option>
                                        <option value="amanat">MAIA</option>
                                        <option value="divestasi">Divestasi</option>
                                    </select>
                                </div>

                                <!-- <div class="radio-container">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radios" id="radio1" value="monica">
                                        <label class="form-check-label text-white" for="radio1">
                                            Monika
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radios" id="radio2" value="amanat">
                                        <label class="form-check-label text-white" for="radio2">
                                            MAIA
                                        </label>
                                    </div>
                                </div> -->


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <?php
                                    $num1 = session()->get("num1");
                                    $num2 = session()->get("num2");
                                    ?>
                                    <!-- Captcha -->
                                    <strong style="color:white;font-size:30px; margin-right:20px;" class="unselectable"><?= $num1 . " + " . $num2 ?></strong>
                                    <!-- Input Captcha -->
                                    <input type="text" name="captcha" id="captcha" class="form-control form-control-lg" placeholder="Tuliskan hasil perhitungannya" required>
                                </div>
                                <!-- ========= Jgn di delete dulu ea ======== -->
                                <!-- <div class="my-3">
                                        <a class="btn" role="button" id="btn_refresh" onclick="refreshHandler()"><i class="fa-solid fa-arrows-rotate" style="color: #ffffff;"></i></a>
                                        <label class="form-check-label text-white">
                                            Refresh Captcha
                                        </label>
                                </div> -->
                                <!-- ========= Jgn di delete dulu ea ========-->
                                <div class="radio-container" style="display: none;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radios" id="radio1" value="monica">
                                        <label class="form-check-label text-white" for="radio1">
                                            User Monika
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radios" id="radio2" value="amanat">
                                        <label class="form-check-label text-white" for="radio2">
                                            User MAIA
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radios" id="radio3" value="divestasi">
                                        <label class="form-check-label text-white" for="radio3">
                                           User Divestasi
                                        </label>
                                    </div>
                                </div>
                                <?php if (isset($validation)) : ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-1">
                                    <button class="btn btn-block btn-primary" type="submit" id="loginButton">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="text-white">Belum punya akun? <a href="<?= base_url('C_register') ?>" class="text-primary" style="text-decoration: underline;">Daftar disini</a></p>
                        </div>
                    </div>

                </div>
            </div>

            <div id="recoverform">
                <div class="text-center">
                    <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                </div>
                <div class="row m-t-20">
                    <!-- Form -->
                    <form class="col-12" action="index.html">
                        <!-- email -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                            </div>
                            <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- pwd -->
                        <div class="row m-t-20 p-t-20 border-top border-secondary">
                            <div class="col-12">
                                <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?= base_url(); ?>/assets/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e45c3e1c15.js" crossorigin="anonymous"></script>

    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function() {

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });

        document.addEventListener('DOMContentLoaded', function() {

            localStorage.clear();
            console.log('Local storage cleared.');

            // Mendapatkan elemen form dan radio buttons
            const form = document.getElementById('loginForm');
            const selectLoginAs = document.getElementById('inputGroupSelect01');

            // const radioMonica = document.getElementById('radio1');
            // const radioAmanat = document.getElementById('radio2');

            const radioDivestasi = document.getElementById('radio3');
            const loginButton = document.getElementById('loginButton');

            /* // Menambahkan event listener pada radio buttons
            radioMonica.addEventListener('change', function() {
                form.action = '<?= base_url('C_login/login_action'); ?>';
            });

            radioAmanat.addEventListener('change', function() {
                form.action = '<?= base_url('C_login/login_aset'); ?>';
            });

            radioDivestasi.addEventListener('change', function() {
                form.action = '<?= base_url('C_login/login_action_divestasi'); ?>';
            });

            // Menambahkan event listener pada tombol login
            loginButton.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah form di-submit secara langsung

                // Validasi form
                if (!radioMonica.checked && !radioAmanat.checked && !radioDivestasi.checked) {
                    // Jika tidak ada radio button yang dipilih, tampilkan flash data
                    alert(' <?php echo session()->getFlashdata("gagal"); ?>');
                } else {
                    // Jika ada radio button yang dipilih, submit form
                    form.submit();
                }
            }); */

            //  Login Dropdown
            // Menambahkan event listener pada dropdown
            selectLoginAs.addEventListener('change', function() {
                // Mengatur action form berdasarkan pilihan dropdown
                if (selectLoginAs.value === 'monica') {
                    form.action = '<?= base_url('C_login/login_action'); ?>';
                } else if (selectLoginAs.value === 'amanat') {
                    form.action = '<?= base_url('C_login/login_aset'); ?>';
                }
                else if (selectLoginAs.value === 'divestasi') {
                    form.action = '<?= base_url('C_login/login_action_divestasi'); ?>';
                }
            });

            // Menambahkan event listener pada tombol login
            loginButton.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah form di-submit secara langsung

                // Validasi form
                if (selectLoginAs.value === 'Pilih Jenis Login') {
                    // Jika tidak ada pilihan yang dipilih, tampilkan flash data
                    alert('<?php echo session()->getFlashdata("gagal"); ?>');
                } else {
                    // Jika ada pilihan yang dipilih, submit form
                    form.submit();
                }
            });
        });
    </script>

</body>

</html>