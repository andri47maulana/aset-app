<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>

<!-- Link ke Leaflet.js -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<style>
    .dark-bg {
        background-color: rgba(0, 0, 0, 0.3);
    }

    .label-suppco-mitra {
        display: none !important;
    }
</style>


<!-- Link ke CSS Slick -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<!-- Link ke CSS Slick Theme -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Detail Katalog Aset</h4>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-md" id="button_selesai" title="Selesai" data-toggle="modal" data-target="#selesaikanksu" style="display: none" <?= session()->get('role_id') == "4" ? "" : "hidden" ?>>Selesai</button>
                        <button type="button" class="btn btn-danger btn-md" id="button_batalkan" title="Batalkan" data-toggle="modal" data-target="#batalkanksu" style="display: none" <?= session()->get('role_id') == "4" ? "" : "hidden" ?>>Batalkan</button>
                        <button type="button" class="btn btn-info btn-md" id="button_aktifkan" title="Batalkan" data-toggle="modal" data-target="#aktifkanksu" style="display: none" <?= session()->get('role_id') == "4" ? "" : "hidden" ?>>Aktifkan</button>
                    </div>
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <?php
                        foreach ($paket_kerjasama as $key => $value) : ?>
                            <h4 class="card-title">Detail Info</h4>
                            <style type="text/css">
                                .text-success {
                                    color: green;
                                }

                                .text-warning {
                                    color: yellow;
                                }

                                .edit-container {
                                    display: flex;
                                    align-items: center;
                                    cursor: pointer;
                                    transition: background-color 0.3s, color 0.3s;
                                    padding: 5px;
                                    border: 2px solid #ccc;
                                    /* Set border color and thickness */
                                    border-radius: 8px;
                                    /* Add rounded corners */
                                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                                    /* Add a subtle shadow effect */
                                }

                                .edit-container:hover {
                                    background-color: #f0f0f0;
                                }

                                .edit-button {
                                    margin-left: 10px;

                                }

                                .edit-form {
                                    display: none;
                                }

                                .edit-text {
                                    flex: 1;
                                }

                                .form-control {
                                    width: 100%;
                                }

                                .button-container {
                                    display: flex;
                                    align-items: center;
                                }

                                .btn-succes {
                                    font-size: 24px;
                                    cursor: pointer;
                                    margin: 0 5px;
                                }
                            </style>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Nama Aset</label>
                                <div class="col-sm-7">
                                    <span>: </span>
                                    <?= $value->master_aset_nama ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Kode SAP Aset</label>
                                <div class="col-sm-7">
                                    <span>:</span>
                                    <span class="detail-value" id="sapaset_detail">
                                        <?php
                                        function encrypt($assetNumber)
                                        {
                                            $encryptedNumber = base64_encode($assetNumber); // Contoh sederhana dengan Base64
                                            return $encryptedNumber;
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
                                                    $assetID = $masterSAP[0]->nomor_aset; //nilai yang ingin di enkripsi
                                                    $unitID = $masterSAP[0]->unit_id; // Mengambil unit_id dengan sap_id

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

                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Alamat Aset</label>
                                <div class="col-sm-7">
                                    <span>: </span>
                                    <?= $value->master_aset_lokasi_alamat ?>, <?= $value->master_aset_nama_kecamatan ?>, <?= $value->master_aset_nama_kab_kota ?>, <?= $value->master_aset_nama_provinsi ?>.
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Jenis Aset</label>
                                <div class="col-sm-7">
                                    <span>: </span>
                                    <?= $value->master_jenis_aset_nama ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Deskripsi</label>
                                <div class="col-sm-7">
                                    <span>: </span>
                                    <?= $value->master_aset_deskripsi ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Batas Utara</label>
                                <div class="col-sm-7">
                                    <span class="detail-value" id="batasutara_detail">: <?= $value->master_aset_batas_utara ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Batas Timur</label>
                                <div class="col-sm-7">
                                    <span class="detail-value" id="batastimur_detail">: <?= $value->master_aset_batas_timur ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Batas Barat</label>
                                <div class="col-sm-7">
                                    <span class="detail-value" id="batasbarat_detail">: <?= $value->master_aset_batas_barat ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Batas Selatan</label>
                                <div class="col-sm-7">
                                    <span class="detail-value" id="batasselatan_detail">: <?= $value->master_aset_batas_selatan ?></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Foto</label>
                                <div class="col-sm-7">
                                    <span>: </span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gambarModal">Lihat Foto</button>

                                    <!-- Modal Foto -->
                                    <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="gambarModalLabel">Slider Gambar</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $data = $paket_kerjasama[0];
                                                    $photos = array_filter([
                                                        $data->master_aset_foto_satu,
                                                        $data->master_aset_foto_dua,
                                                        $data->master_aset_foto_tiga,
                                                        $data->master_aset_foto_empat,
                                                        $data->master_aset_foto_lima,
                                                    ]);
                                                    ?>
                                                    <div id="slide-detail" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">
                                                            <?php foreach ($photos as $key => $photo) { ?>
                                                                <li data-target="#slide-detail" data-slide-to="<?= $key ?>" <?= $key === 0 ? 'class="active"' : '' ?>></li>
                                                            <?php } ?>
                                                        </ol>
                                                        <div class="carousel-inner">
                                                            <?php foreach ($photos as $key => $photo) { ?>
                                                                <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                                                                    <img class="d-block w-100" src="<?= base_url('assets/assets/photo_katalog/' . $photo) ?>">
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <a class="carousel-control-prev" href="#slide-detail" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#slide-detail" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
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

                            $file_name = $value->master_aset_koordinat;
                            $file_path = FCPATH . 'assets/assets/koordinat/' . $file_name;

                            $placemarks = [];

                            if ($value->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                                $placemarks = extract_placemarks_from_kml($file_path);
                            }
                            ?>

                            <?php if (!empty($placemarks)) { ?>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-5 text-left control-label col-form-label">Koordinat Lokasi</label>
                                    <div class="col-sm-7">
                                        <span class="button-lokasi"> :
                                            <button type="button" class="btn btn-primary" onclick="openMapInModal<?php echo $value->master_aset_id; ?>()" data-target="#myModal_<?php echo $value->master_aset_id; ?>"> <i class="fas fa-map-marker-alt"></i> Lihat Lokasi
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <style>
                                    #map_<?php echo $value->master_aset_id; ?> {
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

                                <div class="modal fade" id="myModal_<?php echo $value->master_aset_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Lokasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="map_<?php echo $value->master_aset_id; ?>"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDooAXYetMc9cp_mbef0YezVqfvFHZnnpc"></script>
                                <script>
                                    function openMapInModal<?php echo $value->master_aset_id; ?>() {
                                        var placemarks = <?php echo json_encode($placemarks); ?>;
                                        var bounds = new google.maps.LatLngBounds();

                                        var mapOptions = {
                                            zoom: 10
                                        };

                                        var map = new google.maps.Map(document.getElementById('map_<?php echo $value->master_aset_id; ?>'), mapOptions);


                                        placemarks.forEach(function(placemark) {
                                            if (placemark.type === 'Point') {
                                                var latitude = parseFloat(placemark.latitude);
                                                var longitude = parseFloat(placemark.longitude);

                                                var marker = new google.maps.Marker({
                                                    position: {
                                                        lat: latitude,
                                                        lng: longitude
                                                    },
                                                    map: map,
                                                    title: placemark.name
                                                });

                                                bounds.extend(marker.getPosition());
                                            } else if (placemark.type === 'LineString') {
                                                var lineCoordinates = [];
                                                placemark.coordinates.forEach(function(coordinate) {
                                                    var latitude = parseFloat(coordinate.latitude);
                                                    var longitude = parseFloat(coordinate.longitude);

                                                    lineCoordinates.push({
                                                        lat: latitude,
                                                        lng: longitude
                                                    });

                                                    bounds.extend({
                                                        lat: latitude,
                                                        lng: longitude
                                                    });
                                                });

                                                var polyline = new google.maps.Polyline({
                                                    path: lineCoordinates,
                                                    geodesic: true,
                                                    strokeColor: '#FF0000',
                                                    strokeOpacity: 1.0,
                                                    strokeWeight: 2
                                                });

                                                polyline.setMap(map);
                                            } else if (placemark.type === 'Polygon') {
                                                var polygonCoordinates = [];
                                                placemark.coordinates.forEach(function(coordinate) {
                                                    var latitude = parseFloat(coordinate.latitude);
                                                    var longitude = parseFloat(coordinate.longitude);

                                                    polygonCoordinates.push({
                                                        lat: latitude,
                                                        lng: longitude
                                                    });

                                                    bounds.extend({
                                                        lat: latitude,
                                                        lng: longitude
                                                    });
                                                });

                                                var polygon = new google.maps.Polygon({
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

                                        $('#myModal_<?php echo $value->master_aset_id; ?>').modal('show');
                                    }
                                </script>

                            <?php } else { ?>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-5 text-left control-label col-form-label">Koordinat Lokasi</label>
                                    <div class="col-sm-7">
                                        <span class="button-lokasi"> :
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mapModal_<?php echo $value->master_aset_id; ?>"> <i class="fas fa-map-marker-alt"></i> Lihat Lokasi
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="mapModal_<?php echo $value->master_aset_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mapModalLabel">Detail Lokasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Embed Google Maps within the modal -->
                                                <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?q=<?= $value->master_aset_koordinat ?>&output=embed" allowfullscreen></iframe>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- <div class="form-group row">
                                <label for="fname" class="col-sm-5 text-left control-label col-form-label">Peminat</label>
                                <div class="col-sm-7">
                                    Daftar
                                    <div class="dark-bg p-4">

                                    </div>

                                </div>
                            </div> -->


                    </div>
                    <!-- Tombol Save dan Batal -->

                    <!-- Modal Konfirmasi Save -->
                    <!-- <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="saveModalLabel">Konfirmasi Simpan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menyimpan perubahan?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="button" type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    <!-- Modal Konfirmasi Batal -->
                    <!-- <div class="modal fade" id="batalModal" tabindex="-1" role="dialog" aria-labelledby="batalModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="batalModalLabel">Konfirmasi Batal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin membatalkan perubahan?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                        <button type="button" class="btn btn-primary">Ya</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                </div>
            </div>

            <?php if (!session()->get('username')) { ?>
                -
            <?php } else { ?>

                <div class="container">

                    <!-- Nav tabs -->

                    <?php if ($value->paket_kerjasama_posisi == '') { ?>
                    <?php } else { ?>


                    <?php } ?>

                <?php } ?>

                <!-- Tab panes -->
            <?php endforeach ?>

                </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



<?= $this->endSection(); ?>