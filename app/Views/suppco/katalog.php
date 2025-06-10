<!-- //! UNTUK VIEW KATALOG SETELAH LOGIN SUPPCO -->

<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>

<!-- Untuk Select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<div class="page-wrapper">
    <!-- Rest of your code -->

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
                            'longitude' => $longitude
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
                                    'longitude' => $longitude
                                ];
                            }
                        }
                        $placemarks[] = [
                            'type' => 'LineString',
                            'name' => $name,
                            'coordinates' => $lineCoordinates
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
                                    'longitude' => $longitude
                                ];
                            }
                        }
                        $placemarks[] = [
                            'type' => 'Polygon',
                            'name' => $name,
                            'coordinates' => $polygonCoordinates
                        ];
                    }
                }
            }

            return $placemarks;
        }
    }
    ?>

    <div class="container-fluid">
                <button id="scroll-to-top">Up<i id="scroll-icon" class="fas fa-arrow-up"></i></button>

        <div class="row">
            <div class="col-12">
                <style>
                    .card {
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        transition: box-shadow 0.3s;
                        background-color: #fff;
                    }

                    .card:hover {
                        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
                    }

                    .card-img-top {
                        border-radius: 8px 8px 0 0;
                        object-fit: cover;
                        height: 200px;
                        cursor: pointer;
                        width: 100%;
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

                    .modal .card-img-top {
                        height: auto;
                        border-radius: 8px;
                    }

                    #content-loader {
                        position: absolute;
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
                </style>

                <style>
                    /* CSS untuk tombol */
                    #scroll-to-top {
                        position: fixed;
                        bottom: 20px; /* jarak dari bawah */
                        right: 20px; /* jarak dari kanan */
                        z-index: 999; /* tingkat kedalaman */
                        background-color: #007bff; /* warna latar belakang */
                        color: white; /* warna teks */
                        border: none; /* tanpa border */
                        width: 60px; /* lebar tombol */
                        height: 60px; /* tinggi tombol */
                        border-radius: 50%; /* membuatnya lingkaran */
                        cursor: pointer; /* kursor pointer */
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        font-size: 14px; /* ukuran font */
                    }

                    /* CSS untuk ikon */
                    #scroll-icon {
                        margin-top: 5px; /* spasi antara teks dan ikon */
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
                </style>

                <div class="card" style="position:relative">
                    <div class="card-body">
                        <!--- Start of your catalog view code --->
                        <button type="button" class="btn btn-warning" style="padding-top:8px; margin-bottom:18px;" title="advance search" data-toggle="modal" data-target="#modalcari_katalog">Advance Search</button>
                        <button type="button" class="btn btn-primary" style="padding-top:8px; margin-bottom:18px;" title="advance search" data-toggle="modal" data-target="#modalpilih_katalog">Pilih Katalog</button>

                        <div class="row">
                            <?php foreach ($katalogsatu as $key => $value) : ?>
                                <?php
                                $images = [];
                                $fields = ['master_aset_foto_satu', 'master_aset_foto_dua', 'master_aset_foto_tiga', 'master_aset_foto_empat', 'master_aset_foto_lima'];
                                foreach ($fields as $field) {
                                    if ($value->{$field}) {
                                        array_push($images, $value->{$field});
                                    }
                                }
                                ?>

                                <div class="col-md-4 mb-4">
                                    <div class="card card-asset h-100">
                                        <div id="slider<?= $value->beranda_katalog_id ?>" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php for ($i = 0; $i < count($images); $i++) { ?>
                                                    <li data-target="#slider<?= $value->beranda_katalog_id ?>" data-slide-to=<?= $i; ?>" <?= $i === 0 ? 'class="active"' : ''; ?>></li>
                                                <?php } ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="aset-statusp">
                                                    <?= $value->master_aset_status == 1 ? "Public" : "Private"; ?>
                                                </div>
                                                <?php for ($i = 0; $i < count($images); $i++) { ?>
                                                    <div class="carousel-item <?= $i === 0 ? "active" : ""; ?>">
                                                        <div class="course-img-wrap">
                                                            <img class="card-img-top thumb-img" src="<?= base_url('assets/assets/photo_katalog/' . $images[$i]) ?>" alt="Product Image" loading="lazy">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <?php if (count($images)) { ?>
                                                <a class="carousel-control-prev" href="#slider<?= $value->beranda_katalog_id ?>" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#slider<?= $value->beranda_katalog_id ?>" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $value->master_aset_nama; ?></h5>

                                            <?php
                                            $file_name = $value->master_aset_koordinat;
                                            $file_path = FCPATH . 'assets/assets/koordinat/' . $file_name;

                                            $placemarks = [];

                                            if ($value->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                                                $placemarks = json_encode(extract_placemarks_from_kml($file_path));
                                            }
                                            ?>

                                            <p class="button-wrapper">
                                                <?php if (!empty($placemarks)) { ?>
                                                    <a href="#" data-target="#modal-map" class="button-peta">
                                                        <script>
                                                            $('.button-peta').on('click', function(e) {
                                                                e.preventDefault();
                                                                const data = <?= $placemarks; ?>;
                                                                openMapInModal(data);
                                                            })
                                                        </script>
                                                    <?php } else { ?>
                                                        <a href="https://www.google.com/maps?q=<?= $value->master_aset_koordinat; ?>" target="_blank" class="button-peta">
                                                        <?php } ?>
                                                        <i class="fas fa-map-marker-alt"></i> <span style="margin-left: 5px;">Lihat Maps</span>
                                                        </a>
                                            </p>

                                            <ul class="list-unstyled">
                                                <li><strong>Provinsi:</strong> <?= $value->master_aset_nama_provinsi ?></li>
                                                <li><strong>Alamat:</strong> <?= $value->master_aset_lokasi_alamat ?>, <?= $value->master_aset_nama_kecamatan ?>, <?= $value->master_aset_nama_kab_kota ?></li>
                                                <li><strong>Jenis Aset :</strong> <?= $value->master_jenis_aset_nama; ?></li>
                                                <!-- <li><strong>Luas :</strong> <?= $value->master_aset_luas_aset; ?> <?= $value->master_aset_luas_aset_satuan; ?></li> -->
                                                <li><strong>Luas (m²):</strong> <?= $value->master_aset_luas_aset; ?> m²</li>
                                                <li><strong>Luas (hektar):</strong> <?= $value->master_aset_luas_aset_ha; ?> ha</li>
                                                <li><strong>Deskripsi :</strong> <?= $value->master_aset_deskripsi; ?></li>
                                                <li><strong>Batas Utara :</strong> <?= $value->master_aset_batas_utara; ?></li>
                                                <li><strong>Batas Timur :</strong> <?= $value->master_aset_batas_timur; ?></li>
                                                <li><strong>Batas Barat :</strong> <?= $value->master_aset_batas_barat; ?></li>
                                                <li><strong>Batas Selatan :</strong> <?= $value->master_aset_batas_selatan; ?></li>
                                                <li>
                                                    <strong>No SAP :</strong>
                                                    <?php
                                                    if (!function_exists('encrypt')) {
                                                        function encrypt($assetNumber)
                                                        {
                                                            $encryptedNumber = base64_encode($assetNumber);
                                                            return $encryptedNumber;
                                                        }
                                                    }

                                                    $m_detail_aset_sap = new \App\Models\M_detail_aset_sap();
                                                    $selectedSAP = $m_detail_aset_sap->getSelectedSAP($value->master_aset_id);

                                                    $m_master_aset = new \App\Models\M_master_aset();

                                                    $role = json_encode(session()->get('role_id'));

                                                    if (empty($selectedSAP)) {
                                                        echo "Belum ada nomor SAP yang diinputkan";
                                                    } else {
                                                        foreach ($selectedSAP as $index) {
                                                            $sapId = $index['sap_id'];
                                                            $masterSAP = $m_master_aset->getSAP($sapId);

                                                            if ($masterSAP) {
                                                                $assetID = $masterSAP[0]->nomor_aset;
                                                                $unitID = $masterSAP[0]->unit_id;

                                                                $encryptedAssetID = encrypt($assetID);
                                                                $encryptedunitID = encrypt($unitID);

                                                                if ($assetID) {
                                                                    $assetLink = "https://m-aset.ptpn12.com/aset/" . $encryptedunitID . "/" . $encryptedAssetID;
                                                                    if ($role != 7) {
                                                                        echo "<a href='{$assetLink}' target='_blank'>{$masterSAP[0]->nomor_aset}</a>";
                                                                    } else {
                                                                        echo $masterSAP[0]->nomor_aset;
                                                                    }
                                                                }

                                                                if ($index !== end($selectedSAP)) {
                                                                    echo ', ';
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-12 text-right">
                                                    <a href="#" class="<?php if (session()->get('role_id') != 13) { ?>btn btn-primary-aset btn-edit <?php } else { ?>btn btn-primary-aset disabled<?php } ?>" data-id="<?= $value->beranda_katalog_id; ?>" data-nama_aset="<?= $value->master_aset_nama; ?>" data-id_aset="<?= $value->master_aset_id; ?>">
                                                        <i class="fa fa-check-square"></i>Pilih Aset</a>
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
                    <div id="footer-monika"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SEARCH -->
<div class="modal fade" id="modalcari_katalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="cari">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Pencarian Data</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (session()->get('role_id') == "9") { ?>
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
                    <?php } elseif (session()->get('role_id') == "10") { ?>

                    <?php } ?>
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
                                <input type="text" name="nama_kabupaten_kota_search" value="all" hidden readonly />
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
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('C_pengajuan_opset/suppco') ?>" method="post">
                    <input type="hidden" class="form-control master_aset_id" name="master_aset_id">
                    <input type="hidden" class="form-control beranda_katalog_id" name="beranda_katalog_id">
                    <div class="form-group">
                        <label for="nama_aset" class="col-form-label">Nama Aset:</label>
                        <input type="text" class="form-control nama_aset" name="nama_aset" readonly>
                    </div>
                    <div class="form-group">
                        <label for="katalog-input" class="col-form-label">Nama Paket Kerjasama:</label>
                        <input type="text" class="form-control" id="katalog-input" name="katalog-input" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH KERJASAMA DARI LIST KATALOG -->
<div class="modal fade bd-example-modal-lg" id="modalpilih_katalog" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= base_url('C_pengajuan_opset/suppco') ?>" method="post">
                <input type="text" name="pengajuan_calonmitra_paket_kerjasama_id" value="<?= session()->get('paket_kerjasama_id') ?>" hidden readonly />
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Kerjasama</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_aset" class="col-form-label">Pilih Katalog Aset</label>
                        <br>
                        <select class="form-control select2" name="nama_aset" required style="width: 720px;" onchange="displayAsetId()">
                            <option value="" disabled selected>Pilih Nama Katalog</option>
                            <?php foreach ($pilihkatalog as $aset) : ?>
                                <option value="<?= $aset->master_aset_id; ?>" data-aset-id="<?= $aset->master_aset_id; ?>" data-beranda-katalog="<?= $aset->beranda_katalog_id; ?>" data-regional-nama="<?= $aset->master_region_nama; ?>" data-provinsi="<?= $aset->master_aset_nama_provinsi; ?>" data-kab-kota="<?= $aset->master_aset_nama_kab_kota; ?>" data-kecamatan="<?= $aset->master_aset_nama_kecamatan; ?>" data-luas-aset-m2="<?= $aset->master_aset_luas_aset; ?>" data-luas-aset-ha="<?= $aset->master_aset_luas_aset_ha; ?>"><?= $aset->master_aset_nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="master_aset_id" name="master_aset_id" readonly>
                    <input type="hidden" class="form-control" id="beranda_katalog_id" name="beranda_katalog_id" readonly>

                    <div class="form-group">
                        <label for="master_region_nama" class="col-form-label">Regional </label>
                        <input type="text" class="form-control" id="master_region_nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="master_aset_nama_provinsi" class="col-form-label">Provinsi</label>
                        <input type="text" class="form-control" id="master_aset_nama_provinsi" name="master_aset_nama_provinsi" readonly>
                    </div>
                    <div class="form-group">
                        <label for="master_aset_nama_kab_kota" class="col-form-label">Kabupaten/Kota</label>
                        <input type="text" class="form-control" id="master_aset_nama_kab_kota" name="master_aset_nama_kab_kota" readonly>
                    </div>
                    <div class="form-group">
                        <label for="master_aset_nama_kecamatan" class="col-form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="master_aset_nama_kecamatan" name="master_aset_nama_kecamatan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="data-luas-aset-m2" class="col-form-label">Luas (m²)</label>
                        <input type="text" class="form-control" id="data-luas-aset-m2" name="data-luas-aset-m2" readonly>
                    </div>
                    <div class="form-group">
                        <label for="data-luas-aset-ha" class="col-form-label">Luas (hektar)</label>
                        <input type="text" class="form-control" id="data-luas-aset-ha" name="data-luas-aset-ha" readonly>
                    </div>

                    <div class="form-group">
                        <label for="katalog-input" class="col-form-label">Nama Paket Kerjasama:</label>
                        <input type="text" class="form-control" id="katalog-input" name="katalog-input" required>
                    </div>
                </div>

                <script>
                    function displayAsetId() {
                        var selectedOption = document.querySelector('select[name="nama_aset"] option:checked');
                        var asetId = selectedOption.getAttribute('data-aset-id');
                        var berandaKatalogId = selectedOption.getAttribute('data-beranda-katalog');
                        var regionalnama = selectedOption.getAttribute('data-regional-nama');
                        var provinsinama = selectedOption.getAttribute('data-provinsi');
                        var kotanama = selectedOption.getAttribute('data-kab-kota');
                        var kecamatan_nama = selectedOption.getAttribute('data-kecamatan');
                        var luas_aset = selectedOption.getAttribute('data-luas-aset-m2');
                        var luas_aset_ha = selectedOption.getAttribute('data-luas-aset-ha');

                        document.getElementById('master_aset_id').value = asetId;
                        document.getElementById('beranda_katalog_id').value = berandaKatalogId;
                        document.getElementById('master_region_nama').value = regionalnama;
                        document.getElementById('master_aset_nama_provinsi').value = provinsinama;
                        document.getElementById('master_aset_nama_kab_kota').value = kotanama;
                        document.getElementById('master_aset_nama_kecamatan').value = kecamatan_nama;
                        document.getElementById('data-luas-aset-m2').value = luas_aset;
                        document.getElementById('data-luas-aset-ha').value = luas_aset_ha;
                    }
                </script>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" value="tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>



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




<script>
    $(document).ready(function() {
        $('#tambah-button').on('click', function() {
            var katalogInput = $('#katalog-input').val();
            // Perform additional operations with the input value
            console.log(katalogInput);
            $('#exampleModal').modal('hide');
        });

        $('.container-fluid').on('click', '.card-asset .btn-edit', function(e) {
            e.preventDefault()
            // get data from button edit
            const id = $(this).data('id');
            const id_aset = $(this).data('id_aset');
            const nama_aset = $(this).data('nama_aset');

            // Set data to Form Edit
            $('.master_aset_id').val(id_aset);
            $('.beranda_katalog_id').val(id);
            $('.nama_aset').val(nama_aset);

            // Call Modal Edit
            $('#editModal').modal('show');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tambah-button').on('click', function() {
            window.location.href = "<?= base_url('C_pengelolaan_ksu_lain/supcolist') ?>";
        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDooAXYetMc9cp_mbef0YezVqfvFHZnnpc"></script>
<script>
    function openMapInModal(placemarks) {
        const bounds = new google.maps.LatLngBounds();
        const mapOptions = {
            zoom: 10
        };
        const map = new google.maps.Map(document.getElementById('map'), mapOptions);

        placemarks.forEach(function(placemark) {
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
            status
        }) => {
            let content = ''
            data.length ? data.forEach((item, index) => {
                const active = index === 0 ? ' active' : '';

                content += `<div class="carousel-item${active}">
                <div class="course-img-wrap">
                    ${status === 2
                        ? `<div class="blurred-image">
                                <img class="card-img-top" 
                                src="<?= base_url('assets/assets/photo_katalog') ?>/${item}" loading="lazy">
                            </div>`
                        :  `<img class="card-img-top thumb-img" 
                            src="<?= base_url('assets/assets/photo_katalog') ?>/${item}" 
                            alt="Product Image" loading="lazy">`}
                </div>
            </div>`
            }) : ''

            return `<div class="carousel-inner">
            <div class="aset-statusp">${status == 1 ? "Public" :  "Private"}</div>
            ${content}
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

        // const renderCard = ({images, id, item}) => {
        //     const type = item.master_aset_koordinat_jenis;
        //     const coordinate = item.master_aset_koordinat;
        //     const placemarks = item.placemarks;

        //     const sapNumbers = !item.sap_numbers.length 
        //         ? `Belum ada nomor SAP yang diinputkan` 
        //         : item.sap_numbers.map(num => {
        //             return `<a href="http://m-aset.ptpn12.com/aset/${num.nomor_aset}" target="_blank">${num.nomor_aset}</a>`
        //         }).join(', ');

        //     return `<div class="col-md-4 mb-4">
        //         <div class="card card-asset h-100">
        //             <div id="slider${id}" class="carousel slide" data-ride="carousel">
        //                 ${renderIndicators({data: images, id})}
        //                 ${renderSlider({data:images, status: item.master_aset_status})}
        //                 ${images.length ? renderSlideNav(id): ''}
        //             </div>

        //             <div class="card-body">
        //                 <h5 class="card-title">${item.master_aset_nama}</h5>
        //                 ${renderMapButton({type, id: item.master_aset_id, coordinate})}

        //                 <ul class="list-unstyled">
        //                     <li><strong>Provinsi :</strong> ${item.master_aset_nama_provinsi}</li>
        //                     <li><strong>Alamat :</strong> ${item.master_aset_lokasi_alamat} ${item.master_aset_nama_kecamatan} ${item.master_aset_nama_kab_kota}</li>
        //                     <li><strong>Jenis Aset :</strong> ${item.master_jenis_aset_nama}</li>
        //                     <li><strong>Luas :</strong> ${item.master_aset_luas_aset} ${item.master_aset_luas_aset_satuan}</li>
        //                     <li><strong>Deskripsi :</strong> ${item.master_aset_deskripsi}</li>
        //                     <li><strong>No SAP :</strong> ${sapNumbers}</li>
        //                 </ul>
        //             </div>

        //             <div class="card-footer">
        //                 <div class="row">
        //                     <div class="col-12 text-right">
        //                         <a href="#" class="btn btn-primary-aset btn-edit" 
        //                         data-id="${item.beranda_katalog_id}"
        //                         data-nama_aset="${item.master_aset_nama}" 
        //                         data-id_aset="${item.master_aset_id}">
        //                         <i class="fa fa-check-square"></i>Pilih Aset</a>
        //                     </div>

        //                 </div>
        //             </div>
        //         </div>
        //     </div>`
        // }


        const renderCard = ({
            images,
            id,
            item
        }) => {
            const type = item.master_aset_koordinat_jenis;
            const coordinate = item.master_aset_koordinat;
            const placemarks = item.placemarks;

            function encrypt(data) {
                return btoa(data);
            }

            const sapNumbers = !item.sap_numbers.length ?
                `Belum ada nomor SAP yang diinputkan` :
                item.sap_numbers
                .map((num) => {
                    const encryptedNumber = num.nomor_aset ? encrypt(num.nomor_aset) : '';
                    const encryptedUnitId = num.unit_id ? encrypt(num.unit_id) : '';
                    return num.nomor_aset ? `<a href="https://m-aset.ptpn12.com/aset/${encryptedUnitId}/${encryptedNumber}" target="_blank">${num.nomor_aset}</a>` : '';
                })
                .join(', ');

            const noSap = sapNumbers ? `<strong>No SAP :</strong> ${sapNumbers}` : '';

            return `<div class="col-md-4 mb-4">
           <div class="card card-asset h-100">
               <div id="slider${id}" class="carousel slide" data-ride="carousel">
                   ${renderIndicators({ data: images, id })}
                   ${renderSlider({ data: images, status: item.master_aset_status })}
                   ${images.length ? renderSlideNav(id) : ''}
               </div>

               <div class="card-body">
                   <h5 class="card-title">${item.master_aset_nama}</h5>
                   ${renderMapButton({ type, id: item.master_aset_id, coordinate })}

                   <ul class="list-unstyled">
                       <li><strong>Provinsi :</strong> ${item.master_aset_nama_provinsi}</li>
                       <li><strong>Alamat :</strong> ${item.master_aset_lokasi_alamat} ${item.master_aset_nama_kecamatan} ${item.master_aset_nama_kab_kota}</li>
                       <li><strong>Jenis Aset :</strong> ${item.master_jenis_aset_nama}</li>
                       <!-- <li><strong>Luas :</strong> ${item.master_aset_luas_aset} ${item.master_aset_luas_aset_satuan}</li> -->
                       <li><strong>Luas (m²):</strong> ${item.master_aset_luas_aset} m²</li>
                       <li><strong>Luas (hektar):</strong> ${item.master_aset_luas_aset_ha} ha</li>
                       <li><strong>Deskripsi :</strong> ${item.master_aset_deskripsi}</li>
                       <li><strong>Batas Utara :</strong> ${item.master_aset_batas_utara}</li>
                       <li><strong>Batas Timur :</strong> ${item.master_aset_batas_timur}</li>
                       <li><strong>Batas Barat :</strong> ${item.master_aset_batas_barat}</li>
                       <li><strong>Batas Selatan :</strong> ${item.master_aset_batas_selatan}</li>
                       <li>${noSap}</li>
                   </ul>
               </div>

               <div class="card-footer">
                   <div class="row">
                       <div class="col-12 text-right">
                           <a href="#" class="<?php if (session()->get('role_id') != 13) { ?>btn btn-primary-aset btn-edit <?php } else { ?>btn btn-primary-aset disabled<?php } ?>" 
                           data-id="${item.beranda_katalog_id}"
                           data-nama_aset="${item.master_aset_nama}" 
                           data-id_aset="${item.master_aset_id}">
                           <i class="fa fa-check-square"></i>Pilih Aset</a>
                       </div>
                   </div>
               </div>
           </div>
       </div>`;
        };


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
                        limit: 3,
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
                    $("#content-loader").fadeOut("slow");
                    isLoading = false
                    cekEmptyData(data);
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
                    url: `<?= base_url() ?>/C_katalog/get`,
                    type: "GET",
                    data: {
                        page: 0,
                        limit: 3,
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
                            $('.container-fluid > .row .card > .card-body > .row').html('<div style="display:flex;align-items:center;justify-content:center;min-height:75vh;width:100%"><h4 class="text-center">Tidak ditemukan data dengan kategori yang dipilih.</h4></div>')
                            return false;
                        }

                        let result = ''
                        const imageFields = ['master_aset_foto_satu', 'master_aset_foto_dua', 'master_aset_foto_tiga', 'master_aset_foto_empat', 'master_aset_foto_lima'];

                        data.forEach(item => {
                            const id = item.beranda_katalog_id
                            const status = item.master_aset_status
                            // const file_path = `<?= FCPATH . 'assets/assets/koordinat/' ?>${item.master_aset_koordinat}`
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

                        $('.container-fluid > .row .card > .card-body > .row').html(result)
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

        $('#btn-reset').on('click', function() {
            $(this).closest('.modal').find('form')[0].reset();
            $.ajax({
                    url: `<?= base_url() ?>/C_katalog/get`,
                    type: "GET",
                    data: {
                        page: 0,
                        limit: 3
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
                            // const file_path = `<?= FCPATH . 'assets/assets/koordinat/' ?>${item.master_aset_koordinat}`
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

                        $('.container-fluid > .row .card > .card-body > .row').html(result)
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

        let isScrolling;

                function checkScrollBottom() {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 10) {
                        console.log("Sudah sampai di bagian bawah halaman!");
                        loadDataCatalog();
                    }
                }

                function loadDataCatalog(){
                    if(isLoading) {
                        return false;
                    }

                    fetchData();
                    // if (isFormSubmitted) {
                    //     fetchDataSearch();
                    // } else {
                    //     fetchData();
                    // }
                }


                function cekEmptyData(data){
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
                    loadMoreButton.classList.add('btn', 'btn-warning', 'btn-sm');
                    loadMoreButton.style.margin="0 auto";
                    loadMoreButton.style.display="block";
                    loadMoreButton.addEventListener('click', loadDataCatalog);
                    myDiv.parentNode.insertBefore(loadMoreButton, myDiv);
                }
                
    })
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
        $('#modal-image .modal-body').html(slider)
        $('#modal-image').modal('show')
    })

    const ADDRESS_API = 'http://dev.farizdotid.com/api/daerahindonesia'
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

<!-- Paket Kerjasama dari List -->



<?= $this->endSection(); ?>