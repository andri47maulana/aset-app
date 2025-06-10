<!-- UNTUK KATALOG DI DEPAN SEBELUM LOGIN -->



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
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/assets/images/LOGO-PTPN.png">
    <title>Monika</title>
    <!-- Custom CSS -->
    <!-- <link href="<?= base_url(); ?>/assets/assets/libs/flot/css/float-chart.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/select2/dist/css/select2.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/jquery-minicolors/jquery.minicolors.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/quill/dist/quill.snow.css"> -->
    <link href="<?= base_url(); ?>/assets/dist/css/style.min.css" rel="stylesheet">

    <script src="<?= base_url(); ?>/assets/assets/libs/jquery/dist/jquery.min.js"></script>
    <link href="<?= base_url(); ?>/assets/assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>/assets/assets/libs/toastr/build/toastr.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
        /* CSS untuk tombol */
        #scroll-to-top {
            position: fixed;
            bottom: 20px;
            /* jarak dari bawah */
            right: 20px;
            /* jarak dari kanan */
            z-index: 999;
            /* tingkat kedalaman */
            background-color: #007bff;
            /* warna latar belakang */
            color: white;
            /* warna teks */
            border: none;
            /* tanpa border */
            width: 60px;
            /* lebar tombol */
            height: 60px;
            /* tinggi tombol */
            border-radius: 50%;
            /* membuatnya lingkaran */
            cursor: pointer;
            /* kursor pointer */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            /* ukuran font */
        }

        /* CSS untuk ikon */
        #scroll-icon {
            margin-top: 5px;
            /* spasi antara teks dan ikon */
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

        .aset-status {
            position: absolute;
            top: 10px;
            right: 80px;
            background-color: gold;
            color: #000;
            padding: 5px 10px;
            border-radius: 4px;
            z-index: 10;
        }

        .blurred-image {
            filter: blur(10px);
            /* Adjust the blur amount as needed */
        }


        .form-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container.form-column {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container+.row {
            margin-top: 20px;
        }


        #loadMoreButton {
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: none;
            font-size: 16px;
        }

        #loadMoreButton:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .flex-manual {
            display: flex;
            flex-direction: row;
        }

        @media (width <=375px) {
            .flex-manual {
                display: flex;
                flex-direction: column;
            }

            .flex-manual>input {
                margin-bottom: 10px;
            }
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
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- Logo -->
                    <a class="navbar-brand" href="">
                        <b class="logo-icon p-l-10">
                            <img src="<?= base_url(); ?>/assets/assets/images/LOGO-PTPN.png" alt="homepage" width="30" height="30" class="light-logo" loading="lazy" />
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
                            <a class="nav-link" href="C_login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="C_register">Register</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="card-body">
            <form id="cari">
                <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ced4da; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <!-- Baris Pertama -->
                    <div style="margin-bottom: 15px; display: flex;">
                        <div style="flex: 1; padding-right: 10px;">
                            <label for="regional_search" style="color: #333; font-weight: bold;">Regional:</label>
                            <select id="regional_search" name="regional_search" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
                                <option value="all" selected>-- Pilih Semua Regional --</option>
                                <option value="Head Office">Head Office</option>
                                <option value="Regional 1">Regional 1</option>
                                <option value="Regional 2">Regional 2</option>
                                <option value="Regional 3">Regional 3</option>
                                <option value="Regional 4">Regional 4</option>
                                <option value="Regional 5">Regional 5</option>
                                <option value="Regional 6">Regional 6</option>
                                <option value="Regional 7">Regional 7</option>
                                <option value="Regional 8">Regional 8</option>
                            </select>
                        </div>
                        <div style="flex: 1; padding-right: 10px;">
                            <label for="jenisaset_search" style="color: #333; font-weight: bold;">Jenis Aset:</label>
                            <select name="jenis_aset_search" id="jenisaset_search" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
                                <option value="all" selected>-- Pilih Semua Jenis --</option>
                                <option value="Tanah">Tanah</option>
                                <option value="Bangunan">Bangunan</option>
                                <option value="Tanah dan Bangunan">Tanah & Bangunan</option>
                            </select>
                        </div>
                        <div style="flex: 1;">
                            <label for="luasaset_search" style="color: #333; font-weight: bold;">Luas (m²):</label>
                            <select name="luas_aset_search" id="luasaset_search" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
                                <option value="all" selected>-- Pilih Semua Luas --</option>
                                <option value="lt5000">&lt; 5.000 m²</option>
                                <option value="5000-500000">5.000 – 500.000 m²</option>
                                <option value="500000-5000000">500.000 – 5.000.000 m²</option>
                                <option value="5000000-10000000">5.000.000 – 10.000.000 m²</option>
                                <option value="gt10000000">&gt; 10.000.000 m²</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris Kedua: Lokasi -->
                    <div style="margin-bottom: 15px; display: flex;">
                        <div style="flex: 1; padding-right: 10px;">
                            <label for="lokasi_provinsi_search" style="color: #333; font-weight: bold;">Provinsi:</label>
                            <select id="lokasi_provinsi_search" name="lokasi_provinsi_search" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
                                <option value="all" selected>-- Pilih Semua Provinsi --</option>
                            </select>
                        </div>
                        <div style="flex: 1; padding-right: 10px;">
                            <label for="lokasi_kabupaten_kota_search" style="color: #333; font-weight: bold;">Kabupaten/Kota:</label>
                            <select id="lokasi_kabupaten_kota_search" name="lokasi_kabupaten_kota_search" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
                                <option value="all" selected>-- Pilih Semua Kabupaten/Kota --</option>
                            </select>
                        </div>
                        <div style="flex: 1;">
                            <label for="lokasi_kecamatan_search" style="color: #333; font-weight: bold;">Kecamatan:</label>
                            <select id="lokasi_kecamatan_search" name="lokasi_kecamatan_search" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
                                <option value="all" selected>-- Pilih Semua Kecamatan --</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris Ketiga: Nama Katalog -->
                    <div style="margin-bottom: 15px;">
                        <label for="katalog_search" style="color: #333; font-weight: bold;">Nama Katalog:</label>
                        <input type="text" id="katalog_search" name="katalog_search" placeholder="Masukkan Nama Katalog" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ced4da;">
                    </div>

                    <!-- Baris Keempat: Tombol Cari dan Reset -->
                    <div style="display: flex; gap: 10px; justify-content: flex-start;">
                        <button type="submit" style="background-color: #007bff; color: white; padding: 8px 20px; border: none; border-radius: 5px; font-size: 16px;"><i class="fa fa-search"></i> Cari</button>
                        <button type="button" style="background-color: #6c757d; color: white; padding: 8px 20px; border: none; border-radius: 5px; font-size: 16px;" id="button-reset">Reset</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="modal fade" id="modal-ganti_paswword" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="ganti_password">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Ganti Password</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Password Lama:</label>
                                <input type="password" class="form-control" name="password" autocomplete="new-password" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Password Baru:</label>
                                <input type="password" class="form-control" name="password" autocomplete="new-password" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Ulang Password Baru:</label>
                                <input type="password" class="form-control" name="password" autocomplete="new-password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-info" id="button_ganti">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (!function_exists('extract_placemarks_from_kml')) {
            function extract_placemarks_from_kml($file_path)
            {
                $xml = new DOMDocument();
                $xml->load($file_path);
                $placemarks = [];

                $placemarkNodes = $xml->getElementsByTagName('Placemark');
                foreach ($placemarkNodes as $placemarkNode) {
                    $name = $placemarkNode->getElementsByTagName('name')->item(0)->nodeValue;

                    $pointNode = $placemarkNode->getElementsByTagName('Point')->item(0);
                    $lineStringNode = $placemarkNode->getElementsByTagName('LineString')->item(0);
                    $polygonNode = $placemarkNode->getElementsByTagName('Polygon')->item(0);

                    if ($pointNode) {
                        $coordinatesStr = $pointNode->getElementsByTagName('coordinates')->item(0)->nodeValue;
                        $coordinatesArr = explode(',', $coordinatesStr);

                        if (count($coordinatesArr) >= 2) {
                            $latitude = trim($coordinatesArr[1]);
                            $longitude = trim($coordinatesArr[0]);
                            $placemarks[] = [
                                'type' => 'Point',
                                'name' => $name,
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                            ];
                        }
                    } elseif ($lineStringNode) {
                        $coordinatesStr = $lineStringNode->getElementsByTagName('coordinates')->item(0)->nodeValue;
                        $coordinatesArr = explode(' ', trim($coordinatesStr));

                        if (!empty($coordinatesArr)) {
                            $lineCoordinates = [];
                            foreach ($coordinatesArr as $coordinate) {
                                $coordinateArr = explode(',', $coordinate);
                                if (count($coordinateArr) >= 2) {
                                    $latitude = trim($coordinateArr[1]);
                                    $longitude = trim($coordinateArr[0]);
                                    $lineCoordinates[] = [
                                        'latitude' => $latitude,
                                        'longitude' => $longitude,
                                    ];
                                }
                            }
                            $placemarks[] = [
                                'type' => 'LineString',
                                'name' => $name,
                                'coordinates' => $lineCoordinates,
                            ];
                        }
                    } elseif ($polygonNode) {
                        $coordinatesStr = $polygonNode->getElementsByTagName('coordinates')->item(0)->nodeValue;
                        $coordinatesArr = explode(' ', trim($coordinatesStr));

                        if (!empty($coordinatesArr)) {
                            $polygonCoordinates = [];
                            foreach ($coordinatesArr as $coordinate) {
                                $coordinateArr = explode(',', $coordinate);
                                if (count($coordinateArr) >= 2) {
                                    $latitude = trim($coordinateArr[1]);
                                    $longitude = trim($coordinateArr[0]);
                                    $polygonCoordinates[] = [
                                        'latitude' => $latitude,
                                        'longitude' => $longitude,
                                    ];
                                }
                            }
                            $placemarks[] = [
                                'type' => 'Polygon',
                                'name' => $name,
                                'coordinates' => $polygonCoordinates,
                            ];
                        }
                    }
                }

                return $placemarks;
            }
        }
        ?>

        <div class="container-fluid">

            <button id="scroll-to-top">Scroll<i id="scroll-icon" class="fas fa-arrow-up"></i></button>

            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <?php foreach ($katalog as $key => $value): ?>
                            <?php
                            $images = [];
                            $fields = ['master_aset_foto_satu', 'master_aset_foto_dua', 'master_aset_foto_tiga', 'master_aset_foto_empat', 'master_aset_foto_lima'];
                            foreach ($fields as $field) {
                                if ($value->{$field}) {
                                    array_push($images, $value->{$field});
                                }
                            }
                            ?>

                            <div class="col-md-3">
                                <div class="card-asset">
                                    <div id="slider<?= $value->aset_potensial_aset_id ?>" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <?php for ($i = 0; $i < count($images); $i++) { ?>
                                                <li data-target="#slider<?= $value->aset_potensial_aset_id ?>" data-slide-to=<?= $i; ?>" <?= $i === 0 ? 'class="active"' : ''; ?>></li>
                                            <?php } ?>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div>
                                                <div class="aset-statusp">
                                                    <?= $value->master_aset_status == 1 ? "Public" : "Private"; ?>

                                                </div>
                                                <?php if ($value->aset_potensial_status == 1): ?>
                                                    <div class="aset-status">
                                                        Potensial
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php for ($i = 0; $i < count($images); $i++) { ?>
                                                <div class="carousel-item <?= $i === 0 ? "active" : ""; ?>">
                                                    <div class="course-img-wrap">
                                                        <?php if ($value->master_aset_status == 2): ?>
                                                            <div class="blurred-image">
                                                                <img class="card-img-top" src="<?= base_url('assets/assets/photo_katalog/' . $images[$i]) ?>">
                                                            </div>
                                                        <?php else: ?>
                                                            <img class="card-img-top thumb-img" src="<?= base_url('assets/assets/photo_katalog/' . $images[$i]) ?>" alt="Product Image">
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <?php if (count($images)) { ?>
                                            <a class="carousel-control-prev" href="#slider<?= $value->aset_potensial_aset_id ?>" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#slider<?= $value->aset_potensial_aset_id ?>" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        <?php } ?>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title"><?= $value->master_aset_nama; ?></h5>

                                        <?php if ($value->master_aset_status == 1): ?>
                                            <?php
                                            $file_name = $value->master_aset_koordinat;
                                            $file_path = FCPATH . 'assets/assets/koordinat/' . $file_name;

                                            $placemarks = [];

                                            if ($value->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                                                $placemarks = json_encode(extract_placemarks_from_kml($file_path));
                                            }
                                            ?>

                                            <?php if (!empty($placemarks)) { ?>
                                                <p class="button-wrapper">
                                                    <a href="#" data-target="#modal-map" class="button-peta">
                                                        <i class="fas fa-map-marker-alt"></i> <span style="margin-left: 5px;">Lihat Maps</span>
                                                    </a>
                                                </p>
                                                <script>
                                                    $('.button-peta').on('click', function(e) {
                                                        e.preventDefault();
                                                        const data = <?= $placemarks; ?>;
                                                        openMapInModal(data);
                                                    })
                                                </script>
                                            <?php } else { ?>
                                                <p class="button-wrapper">
                                                    <a href="https://www.google.com/maps?q=<?= $value->master_aset_koordinat; ?>" target="_blank" class="button-peta">
                                                        <i class="fas fa-map-marker-alt"></i> <span style="margin-left: 5px;">Lihat Maps</span>
                                                    </a>
                                                </p>
                                            <?php } ?>
                                        <?php endif; ?>

                                        <ul class="list-unstyled">
                                            <li>
                                                <strong>Regional :</strong> <?= $value->master_aset_status == 1 ? $value->master_region_nama : ''; ?>
                                            </li>
                                            <li>
                                                <strong>Provinsi :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_nama_provinsi : ''; ?>
                                            </li>
                                            <li>
                                                <strong>Alamat :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_lokasi_alamat . ', ' . $value->master_aset_nama_kecamatan . ', ' . $value->master_aset_nama_kab_kota : ''; ?>
                                            </li>
                                            <li>
                                                <strong>Jenis Aset :</strong> <?= $value->master_aset_status == 1 ? $value->master_jenis_aset_nama : ''; ?>
                                            </li>
                                            <!-- <li>
                                                <strong>Luas :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_luas_aset . ', ' . $value->master_aset_luas_aset_satuan : '' ?>
                                            </li> -->
                                            <li>
                                                <strong>Luas (m²) :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_luas_aset . ' m²' : '' ?>
                                            </li>
                                            <li>
                                                <strong>Luas (hektar) :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_luas_aset_ha . ' ha' : '' ?>
                                            </li>
                                            <!-- <li>
                                                <strong>Deskripsi :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_deskripsi : ''; ?>
                                            </li>
                                            <li>
                                                <strong>Batas Utara :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_batas_utara : ''; ?>
                                            </li>
                                            <li>
                                                <strong>Batas Timur :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_batas_timur : ''; ?>
                                            </li>
                                            <li>
                                                <strong>Batas Barat :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_batas_barat : ''; ?>
                                            </li>
                                            <li>
                                                <strong>Batas Selatan :</strong> <?= $value->master_aset_status == 1 ? $value->master_aset_batas_selatan : ''; ?>
                                            </li> -->

                                        </ul>

                                        <?php if ($value->master_aset_status != 1): ?>
                                            <p class="button-wrapper">
                                                <a href="" class="button-private disabled-link">
                                                    <span style="margin-left: 5px;">Untuk mendapatkan infomasi lebih lengkap, Silahkan daftar sebagai mitra.</span>
                                                </a>
                                            </p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <a href="<?= base_url() ?>/C_brosur/index/<?= $value->master_aset_id ?>" class="btn btn-primary-aset pilih-brosur" target="_blank">
                                                    <i class="fa fa-eye"></i>Lihat Brosur
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- End of your catalog view code -->
                    <div id="content-loader"><span>Loading...</span></div>
                </div>
            </div>
        </div>

        <!-- Modal
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Anda belum melakukan logiin, mohon login terlebih dahulu</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="tambah-button">Login</button>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL SEARCH -->
        <!-- <div class="modal fade" id="modalcari_katalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="cari">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Pencarian Dataa</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label" for="regional-search">Regional:</label>
                                <select class="form-control" id="regional_search" name="regional_search">
                                    <option value="all" selected>-- Pilih Semua Regional --</option>
                                    <option value="Head Office">Head Office</option>
                                    <option value="Regional 1">Regional 1</option>
                                    <option value="Regional 2">Regional 2</option>
                                    <option value="Regional 3">Regional 3</option>
                                    <option value="Regional 4">Regional 4</option>
                                    <option value="Regional 5">Regional 5</option>
                                    <option value="Regional 6">Regional 6</option>
                                    <option value="Regional 7">Regional 7</option>
                                    <option value="Regional 8">Regional 8</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis-aset-search" class="col-form-label">Jenis Aset:</label>
                                <select name="jenis_aset_search" class="form-control" id="jenisaset_search">
                                    <option value="all" selected>-- Pilih Semua Jenis --</option>
                                    <option value="Tanah">Tanah</option>
                                    <option value="Bangunan">Bangunan</option>
                                    <option value="Tanah dan Bangunan">Tanah & Bangunan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Lokasi:</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="nama_provinsi_search" value="all" hidden readonly />
                                        <select class="form-control" id="lokasi_provinsi_search" name="lokasi_provinsi_search">
                                            <option value="all" selected>-- Pilih Semua Provinsi --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 6px;">
                                        <input type="text" name="nama_kabupaten_kota_search" value="all" hidden  readonly />
                                        <select class="form-control" id="lokasi_kabupaten_kota_search" name="lokasi_kabupaten_kota_search">
                                            <option value="all" selected>-- Pilih Semua Kabupaten/Kota --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 6px;">
                                        <input type="text" name="nama_kecamatan_search" value="all" hidden readonly />
                                        <select class="form-control" id="lokasi_kecamatan_search" name="lokasi_kecamatan_search">
                                            <option value="all" selected>-- Pilih Semua Kecamatan </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="button" class="btn btn-default" id="btn-reset">Reset</button>
                            <button type="submit" class="btn btn-success" id="cari_button">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->

        <!-- MODAL MAP -->
        <div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Map</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="map"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL IMAGE -->
        <div id="modal-image" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body"></div>

                </div>
            </div>
        </div>

        <!-- <script>
            $(document).ready(function() {
                $('#tambah-button').on('click', function() {
                    var katalogInput = $('#katalog-input').val();
                    // Perform additional operations with the input value
                    console.log(katalogInput);
                    $('#exampleModal').modal('hide');
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#tambah-button').on('click', function() {
                    window.location.href = "C_login";
                });
            });
        </script> -->

        <script>
            // Menangani klik pada tombol Reset
            document.getElementById('button-reset').addEventListener('click', function() {
                // Memuat ulang halaman
                location.reload();
            });
        </script>

        <script>
            $(document).ready(function() {
                let isLoading = false;
                let page = 1;

                const renderIndicators = ({
                    data,
                    id
                }) => {
                    let content = ''
                    data.length ? data.forEach((item, index) => {
                        content += `<li data-target="#slider${id}" data-slide-to="${index}" ${index === 0 ? 'class="active"' : ''}></li>`
                    }) : ''
                    return `<ol class="carousel-indicators">${content}</ol>`
                }

                const renderSlider = ({
                    data,
                    status,
                    status_potensial
                }) => {
                    let content = ''
                    data.length ? data.forEach((item, index) => {
                        const active = index === 0 ? ' active' : '';

                        content += `<div class="carousel-item${active}">
                            <div class="course-img-wrap">
                                ${status === '2'
                                    ? `<div class="blurred-image">
                                            <img class="card-img-top"
                                            src="<?= base_url('assets/assets/photo_katalog') ?>/${item}"
                                            loading="lazy">
                                        </div>`
                                    :  `<img class="card-img-top thumb-img"
                                        src="<?= base_url('assets/assets/photo_katalog') ?>/${item}"
                                        alt="Product Image" loading="lazy">`}
                            </div>
                        </div>`
                    }) : ''

                    return `<div class="carousel-inner">
                        <div class="aset-statusp">${status === '1' ? "Public" :  "Private"}</div>
                        ${content}

                        ${status_potensial === '1' ? `<div class="aset-status">Potensial</div>` : ''}

                    </div>`
                }

                const renderSlideNav = (id) => {
                    return `<a class="carousel-control-prev" href="#slider${id}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#slider${id}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>`
                }

                const renderMapButton = ({
                    type,
                    id,
                    coordinate
                }) => {
                    if (!coordinate) {
                        return null
                    }

                    if (type === 'Upload KML/GPX') {
                        return `<p class="button-wrapper">
                            <a href="#" data-id="${id}" data-target="#modal-map" class="button-peta button-peta-dynamic">
                                <i class="fas fa-map-marker-alt"></i> <span style="margin-left: 5px;">Lihat Maps</span>
                            </a>
                        </p>`
                    }

                    return `<p class="button-wrapper">
                            <a href="https://www.google.com/maps?q=${coordinate}" target="_blank" class="button-peta">
                                <i class="fas fa-map-marker-alt"></i> <span style="margin-left: 5px;">Lihat Maps</span>
                            </a>
                        </p>`
                }

                const renderCard = ({
                    images,
                    id,
                    item
                }) => {
                    const type = item.master_aset_koordinat_jenis;
                    const coordinate = item.master_aset_koordinat;
                    const placemarks = item.placemarks;

                    return `<div class="col-md-3">
                        <div class="card-asset">
                            <div id="slider${id}" class="carousel slide" data-ride="carousel">
                                ${renderIndicators({data: images, id})}
                                ${renderSlider({data:images, status: item.master_aset_status, status_potensial: item.aset_potensial_status})}
                                ${images.length ? renderSlideNav(id): ''}
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">${item.master_aset_nama}</h5>
                                ${renderMapButton({type, id: item.master_aset_id, coordinate})}

                                <ul class="list-unstyled">
                                    <li><strong>Regional :</strong> ${item.master_aset_status === '1' ? item.master_region_nama : ''}</li>
                                    <li><strong>Provinsi :</strong> ${item.master_aset_status === '1' ? item.master_aset_nama_provinsi : ''}</li>
                                    <li><strong>Alamat :</strong> ${item.master_aset_status === '1' ? `${item.master_aset_lokasi_alamat} ${item.master_aset_nama_kecamatan} ${item.master_aset_nama_kab_kota}` : ''}</li>
                                    <li><strong>Jenis Aset :</strong> ${item.master_aset_status === '1' ? item.master_jenis_aset_nama : ''}</li>
                                    <!-- <li><strong>Luas :</strong> ${item.master_aset_status === '1' ? `${item.master_aset_luas_aset} ${item.master_aset_luas_aset_satuan}` : ''}</li> -->
                                    <li><strong>Luas (m²):</strong> ${item.master_aset_status === '1' ? `${item.master_aset_luas_aset}` + ' m²' : ''}</li>
                                    <li><strong>Luas (hektar):</strong> ${item.master_aset_status === '1' ? `${item.master_aset_luas_aset_ha ? item.master_aset_luas_aset_ha + ' ha': ''}` : ''}</li>
                                </ul>

                                 ${item.master_aset_status != '1'
                                    ? `<p class="button-wrapper">
                                            <a href="" class="button-private disabled-link">
                                                <span style="margin-left: 5px;">Untuk mendapatkan infomasi lebih lengkap, Silahkan daftar sebagai mitra.</span>
                                            </a>
                                        </p>`
                                    : ''}
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="<?= base_url() ?>/C_brosur/index/${item.master_aset_id}" class="btn btn-primary-aset pilih-brosur" target="_blank" >
                                            <i class="fa fa-eye"></i>Lihat Brosur
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>`
                }


                function fetchData() {
                    const formData = $('form#cari').serializeArray();
                    const jsonForm = {}
                    Object.values(formData).map(item => {
                        jsonForm[item.name] = item.value
                    })
                    $.ajax({
                            url: `<?= base_url() ?>/C_katalog/get`,
                            type: "GET",
                            data: {
                                page,
                                ...jsonForm
                            },
                            contentType: 'application/json',
                            dataType: 'json',
                            beforeSend: function() {
                                $("#content-loader").show();
                                if (isLoading === false) {
                                    isLoading = true
                                }
                            },
                            success: function({
                                data
                            }) {
                                if (!data.length) {
                                    return false;
                                }
                                let result = ''
                                const imageFields = ['master_aset_foto_satu', 'master_aset_foto_dua', 'master_aset_foto_tiga', 'master_aset_foto_empat', 'master_aset_foto_lima'];

                                data.forEach(item => {
                                    const id = item.beranda_katalog_id

                                    const images = []
                                    imageFields.forEach(img => {
                                        if (!item[img]) {
                                            return false;
                                        }
                                        images.push(item[img]);
                                    })

                                    result += renderCard({
                                        id,
                                        item,
                                        images
                                    })
                                })
                                page++;

                                $('.container-fluid .card-body > .row').append(result).on('click', '.button-peta-dynamic', function(e) {
                                    e.preventDefault();
                                    const id = $(this).data('id');

                                    $.ajax({
                                        url: `<?= base_url() ?>/C_katalog/getPlacemarks/${id}`,
                                        method: 'GET',
                                        success: function({
                                            data
                                        }) {
                                            openMapInModal(JSON.parse(data))
                                        }
                                    })
                                })
                            }
                        })
                        .done(function(data) {
                            //show data
                            $("#content-loader").fadeOut("slow");
                            cekEmptyData(data);
                            isLoading = false
                        })
                        .fail(function(jqXHR, ajaxOptions, thrownError) {
                            $("#content-loader").fadeOut("slow");
                            console.log({
                                thrownError
                            })
                            isLoading = false
                        });
                }

                function fetchDataSearch() {
                    const formData = $('form#cari').serializeArray();
                    const jsonForm = {}
                    Object.values(formData).map(item => {
                        jsonForm[item.name] = item.value
                    })
                    $.ajax({
                            url: `<?= base_url() ?>/C_katalog/search`,
                            type: "GET",
                            data: {
                                page,
                                ...jsonForm
                            },
                            contentType: 'application/json',
                            dataType: 'json',
                            beforeSend: function() {
                                $("#content-loader").show();
                                if (isLoading === false) {
                                    isLoading = true
                                }
                            },
                            success: function({
                                data
                            }) {
                                if (!data.length) {
                                    return false;
                                }
                                let result = ''
                                const imageFields = ['master_aset_foto_satu', 'master_aset_foto_dua', 'master_aset_foto_tiga', 'master_aset_foto_empat', 'master_aset_foto_lima'];

                                data.forEach(item => {
                                    const id = item.beranda_katalog_id

                                    const images = []
                                    imageFields.forEach(img => {
                                        if (!item[img]) {
                                            return false;
                                        }
                                        images.push(item[img]);
                                    })

                                    result += renderCard({
                                        id,
                                        item,
                                        images
                                    })
                                })
                                page++;

                                $('.container-fluid .card-body > .row').append(result).on('click', '.button-peta-dynamic', function(e) {
                                    e.preventDefault();
                                    const id = $(this).data('id');

                                    $.ajax({
                                        url: `<?= base_url() ?>/C_katalog/getPlacemarks/${id}`,
                                        method: 'GET',
                                        success: function({
                                            data
                                        }) {
                                            openMapInModal(JSON.parse(data))
                                        }
                                    })
                                })
                            }
                        })
                        .done(function(data) {
                            //show data
                            $("#content-loader").fadeOut("slow");
                            cekEmptyData(data);
                            isLoading = false
                        })
                        .fail(function(jqXHR, ajaxOptions, thrownError) {
                            $("#content-loader").fadeOut("slow");
                            console.log({
                                thrownError
                            })
                            isLoading = false
                        });
                }

                $('form#cari').on('submit', function(e) {
                    e.preventDefault();

                    const formData = $(this).serializeArray();
                    const jsonForm = {}
                    Object.values(formData).map(item => {
                        jsonForm[item.name] = item.value
                    })

                    $.ajax({
                            url: `<?= base_url() ?>/C_katalog/search`,
                            type: "GET",
                            data: {
                                page: 0,
                                limit: 4,
                                ...jsonForm
                            },
                            contentType: 'application/json',
                            dataType: 'json',
                            beforeSend: function() {
                                // $(".preloader").show();
                                if (isLoading === false) {
                                    isLoading = true
                                }
                            },
                            success: function({
                                data
                            }) {
                                if (!data.length) {
                                    $('.container-fluid .card-body > .row').html('<div style="display:flex;align-items:center;justify-content:center;min-height:75vh;width:100%"><h4 class="text-center">Tidak ditemukan data dengan kategori yang dipilih.</h4></div>')
                                    return false;
                                }
                                let result = ''
                                const imageFields = ['master_aset_foto_satu', 'master_aset_foto_dua', 'master_aset_foto_tiga', 'master_aset_foto_empat', 'master_aset_foto_lima'];

                                data.forEach(item => {
                                    const id = item.beranda_katalog_id
                                    //const file_path = `<?= FCPATH . 'assets/assets/koordinat/' ?>${item.master_aset_koordinat}`
                                    const placemarks = ''

                                    // if ($value->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                                    //                     $placemarks = extract_placemarks_from_kml($file_path);
                                    //                 }

                                    const images = []
                                    imageFields.forEach(img => {
                                        if (!item[img]) {
                                            return false;
                                        }
                                        images.push(item[img]);
                                    })

                                    result += renderCard({
                                        id,
                                        item,
                                        images
                                    })
                                })
                                page = 1;

                                $('.container-fluid .card-body > .row').html(result)
                            }
                        })
                        .done(function(data) {
                            //show data
                            // $(".preloader").fadeOut("slow");
                            isLoading = false
                            $('#modalcari_katalog').modal('hide');
                            cekEmptyData(data);
                        })
                        .fail(function(jqXHR, ajaxOptions, thrownError) {
                            console.log({
                                thrownError
                            })
                            isLoading = false
                        });
                })

                $('#btn-reset').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('.modal').find('form')[0].reset();

                    $.ajax({
                            url: `<?= base_url() ?>/C_katalog/get`,
                            type: "GET",
                            data: {
                                page: 0
                            },
                            contentType: 'application/json',
                            dataType: 'json',
                            beforeSend: function() {
                                // $(".preloader").show();
                                if (isLoading === false) {
                                    isLoading = true
                                }
                            },
                            success: function({
                                data
                            }) {
                                let result = ''
                                const imageFields = ['master_aset_foto_satu', 'master_aset_foto_dua', 'master_aset_foto_tiga', 'master_aset_foto_empat', 'master_aset_foto_lima'];

                                data.forEach(item => {
                                    const id = item.beranda_katalog_id
                                    const status = item.master_aset_status
                                    //const file_path = `<?= FCPATH . 'assets/assets/koordinat/' ?>${item.master_aset_koordinat}`
                                    const placemarks = ''

                                    // if ($value->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                                    //                     $placemarks = extract_placemarks_from_kml($file_path);
                                    //                 }

                                    const images = []
                                    imageFields.forEach(img => {
                                        if (!item[img]) {
                                            return false;
                                        }
                                        images.push(item[img]);
                                    })

                                    result += renderCard({
                                        id,
                                        item,
                                        images,
                                        status
                                    })
                                })
                                page = 1;

                                $('.container-fluid .card-body > .row').html(result)
                            }
                        })
                        .done(function(data) {
                            //show data
                            // $(".preloader").fadeOut("slow");
                            isLoading = false
                            $('#modalcari_katalog').modal('hide');
                            cekEmptyData(data);

                        })
                        .fail(function(jqXHR, ajaxOptions, thrownError) {
                            console.log({
                                thrownError
                            })
                            isLoading = false
                        });
                })

                var isFormSubmitted = false; // Variabel penanda apakah formulir telah diajukan

                // Event listener untuk pengajuan formulir
                $('form#cari').on('submit', function(e) {
                    e.preventDefault(); // Mencegah formulir untuk melakukan submit default
                    isFormSubmitted = true; // Set variabel penanda menjadi true ketika formulir diajukan
                });

                let isScrolling;

                function checkScrollBottom() {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 10) {
                        console.log("Sudah sampai di bagian bawah halaman!");
                        loadDataCatalog();
                    }
                }

                function loadDataCatalog() {
                    if (isLoading) {
                        return false;
                    }
                    if (isFormSubmitted) {
                        fetchDataSearch();
                    } else {
                        fetchData();
                    }
                }


                function cekEmptyData(data) {
                    data = data.data;
                    if (Array.isArray(data) && data.length === 0) {
                        $("#loadMoreButton").hide();
                    } else if (typeof data === 'object' && Object.keys(data).length === 0) {
                        $("#loadMoreButton").hide();
                    } else {
                        $("#loadMoreButton").show();
                    }

                }

                $(window).scroll(function() {
                    clearTimeout(isScrolling);
                    isScrolling = setTimeout(checkScrollBottom, 100);
                });

                $(window).resize(function() {
                    checkScrollBottom();
                });


                const myDiv = document.querySelector('#footer-monika');
                if (!document.querySelector('#loadMoreButton')) {
                    const loadMoreButton = document.createElement('button');
                    loadMoreButton.id = 'loadMoreButton';
                    loadMoreButton.textContent = 'Load More...';
                    loadMoreButton.classList.add('btn', 'btn-primary', 'btn-sm');
                    loadMoreButton.style.margin = "0 auto";
                    loadMoreButton.style.display = "block";
                    loadMoreButton.addEventListener('click', loadDataCatalog);
                    myDiv.parentNode.insertBefore(loadMoreButton, myDiv);
                }

            })
        </script>

        <!-- footer  -->
        <footer class="footer text-center" id="footer-monika">
            All Rights Reserved by PT APN. Designed and Developed by PT APN.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->


    <!-- Modal Attention -->
    <!-- <div class="modal fade" id="modal-attention" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please log in to perform this action.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
</body>
<!-- <script src="<?= base_url(); ?>/assets/assets/libs/popper.js/dist/umd/popper.min.js"></script> -->
<script src="<?= base_url(); ?>/assets/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<!-- <script src="<?= base_url(); ?>/assets/assets/extra-libs/sparkline/sparkline.js"></script> -->
<!--Wave Effects -->
<script src="<?= base_url(); ?>/assets/dist/js/waves.js"></script>
<!--Menu sidebar -->
<!-- <script src="<?= base_url(); ?>/assets/dist/js/sidebarmenu.js"></script> -->
<!--Custom JavaScript -->
<script src="<?= base_url(); ?>/assets/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<!-- <script src="<?= base_url(); ?>/assets/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/dist/js/pages/mask/mask.init.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/quill/dist/quill.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/excanvas.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/jquery.flot.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/jquery.flot.pie.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/jquery.flot.time.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/jquery.flot.stack.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url(); ?>/assets/dist/js/pages/chart/chart-page-init.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> -->
<!-- <script type="text/javascript">
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*colorpicker*/
    $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',

            change: function(value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    /*datwpicker*/
    jQuery('.mydatepicker').datepicker({
        dateFormat: 'dd/mm/yy',
        startDate: "'09/09/2021'",
        autoclose: true,
    });
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    $('#table').DataTable({
        "scrollX": true
    });
</script> -->
<script>
    $(document).ready(function() {
        $('.pilih-aset').on('click', function(e) {
            e.preventDefault();

            // Check if user is logged in
            var isLoggedIn = checkLoggedIn(); // Replace checkLoggedIn() with your actual login check function

            if (isLoggedIn) {
                // User is logged in, proceed with button action
                var assetName = $(this).data('whatever');
                console.log('Asset Name:', assetName);

                // Perform additional operations with the asset name

                // Hide the modal
                $('#modal-image').modal('hide');
                $('#modal-map').modal('hide');
            } else {
                // User is not logged in, show modal attention
                $('#modal-attention').modal('show');
            }
        });
    });

    function checkLoggedIn() {
        // Replace this with your actual login check logic
        // Example: check if the user is logged in by checking a session or cookie
        // Return true if logged in, false otherwise
        // For demonstration purposes, always return false here
        return false;
    }
</script>

<!-- <script>
    var deskripsiElement = document.getElementById('deskripsi');
    var words = deskripsiElement.innerHTML.trim().split(' ');
    if (words.length > 7) {
        var shortenedText = words.slice(0, 7).join(' ') + '...';
        deskripsiElement.innerHTML = shortenedText;
    }
</script> -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDooAXYetMc9cp_mbef0YezVqfvFHZnnpc"></script>
<script>
    function openMapInModal(data) {

        const bounds = new google.maps.LatLngBounds();
        const mapOptions = {
            zoom: 10
        };
        const map = new google.maps.Map(document.getElementById('map'), mapOptions);

        data.forEach(function(placemark) {
            if (placemark.type === 'Point') {
                const latitude = parseFloat(placemark.latitude);
                const longitude = parseFloat(placemark.longitude);

                const marker = new google.maps.Marker({
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                    map: map,
                    title: placemark.name
                });

                bounds.extend(marker.getPosition());
            } else if (placemark.type === 'LineString') {
                const lineCoordinates = [];
                placemark.coordinates.forEach(function(coordinate) {
                    const latitude = parseFloat(coordinate.latitude);
                    const longitude = parseFloat(coordinate.longitude);

                    lineCoordinates.push({
                        lat: latitude,
                        lng: longitude
                    });

                    bounds.extend({
                        lat: latitude,
                        lng: longitude
                    });
                });

                const polyline = new google.maps.Polyline({
                    path: lineCoordinates,
                    geodesic: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });

                polyline.setMap(map);
            } else if (placemark.type === 'Polygon') {
                const polygonCoordinates = [];
                placemark.coordinates.forEach(function(coordinate) {
                    const latitude = parseFloat(coordinate.latitude);
                    const longitude = parseFloat(coordinate.longitude);

                    polygonCoordinates.push({
                        lat: latitude,
                        lng: longitude
                    });

                    bounds.extend({
                        lat: latitude,
                        lng: longitude
                    });
                });

                const polygon = new google.maps.Polygon({
                    paths: polygonCoordinates,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });

                polygon.setMap(map);
            }
        });

        map.fitBounds(bounds);

        $('#modal-map').modal('show');
    }
</script>

<script>
    // Menangani klik pada tombol scroll
    document.getElementById('scroll-to-top').addEventListener('click', function() {
        // Mendapatkan tinggi dari seluruh dokumen
        var documentHeight = document.body.scrollHeight || document.documentElement.scrollHeight;

        // Mengatur animasi scroll ke bagian bawah halaman
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Efek scroll yang halus
        });
    });
</script>

<script>
    $('.container-fluid').on('click', '.card-asset .carousel-item .thumb-img', function() {
        const slider = $(this).closest('.slide').clone().prop('id', 'slider-modal');
        $(slider).find('.carousel-indicators li').attr('data-target', '#slider-modal')
        $(slider).find('.carousel-control-prev').attr('href', '#slider-modal')
        $(slider).find('.carousel-control-next').attr('href', '#slider-modal')
        $(slider).find('.aset-statusp').remove()
        $(slider).find('.aset-status').remove()
        $('#modal-image .modal-body').html(slider)
        $('#modal-image').modal('show')
    })

    const ADDRESS_API = 'https://dev.farizdotid.com/api/daerahindonesia'
    const formProvinsi = $('form#cari select[name="lokasi_provinsi_search"]');
    const formProvinsiName = $('form#cari input[name="nama_provinsi_search"]');
    const formKota = $('form#cari select[name="lokasi_kabupaten_kota_search"]');
    const formKotaName = $('form#cari input[name="nama_kabupaten_kota_search"]');
    const formKecamatan = $('form#cari select[name="lokasi_kecamatan_search"]');
    const formKecamatanName = $('form#cari input[name="nama_kecamatan_search"]');

    $.get(`${ADDRESS_API}/provinsi`, function({
        provinsi
    }) {
        let options = '<option value="all" selected>-- Pilih Semua Provinsi --</option>'
        provinsi.forEach(item => {
            options += `<option value="${item.id}">${item.nama}</option>`
        })
        formProvinsi.html(options);
    });

    formProvinsi.on('change', function() {
        const idProvinsi = formProvinsi.val();
        const defaultOption = '<option value="all" selected>-- Pilih Semua Kabupaten/Kota --</option>'

        const provinsiName = idProvinsi === 'all' ?
            idProvinsi :
            formProvinsi.find('option:selected').text()
        formProvinsiName.val(provinsiName)
        formKotaName.val('all')
        formKecamatanName.val('all')
        formKecamatan.html('<option value="all" selected>-- Pilih Semua Kecamatan --</option>')

        if (idProvinsi === 'all') {
            formKota.html(defaultOption)
            return false;
        }

        $.get(`${ADDRESS_API}/kota?id_provinsi=${idProvinsi}`, function({
            kota_kabupaten
        }) {
            let options = defaultOption
            kota_kabupaten.forEach(item => {
                options += `<option value="${item.id}">${item.nama}</option>`
            })
            formKota.html(options);

        });
    })

    formKota.on('change', function() {
        const idKota = formKota.val();
        const defaultOption = '<option value="all" selected>-- Pilih Semua Kecamatan --</option>'

        const kotaName = idKota === 'all' ?
            idKota :
            formKota.find('option:selected').text()
        formKotaName.val(kotaName)
        formKecamatanName.val('all')

        if (idKota === 'all') {
            formKecamatan.html(defaultOption);
            return false;
        }

        $.get(`${ADDRESS_API}/kecamatan?id_kota=${idKota}`, function({
            kecamatan
        }) {
            let options = defaultOption;
            kecamatan.forEach(item => {
                options += `<option value="${item.id}">${item.nama}</option>`
            })
            formKecamatan.html(options);

        });
    })

    formKecamatan.on('change', function() {
        const kecamatanName = formKecamatan.val() === 'all' ?
            'all' :
            formKecamatan.find('option:selected').text()
        formKecamatanName.val(kecamatanName)
    })
</script>

</html>