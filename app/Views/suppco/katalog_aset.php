<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>

<div class="page-wrapper">
    <!-- Rest of your code -->

    <div class="container-fluid">
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
                    }
                </style>

                <div class="card">
                    <div class="card-body">

                        <button type="button" class="btn btn-warning" style="padding-top:8px; margin-bottom:18px;" title="advance search" data-toggle="modal" data-target="#modalcari_katalogaset">Advance Search</button>
                        <!-- Start of your catalog view code -->
                        <div class="row">
                               <?php foreach ($katalogdua as $key => $value) : ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div id="slider<?= $value->master_aset_id ?>" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <?php if ($value->master_aset_foto_satu != null) : ?>
                                                    <li data-target="#slider<?= $value->master_aset_id ?>" data-slide-to="0" class="active"></li>
                                                    <?php endif; ?>
                                                    <?php if ($value->master_aset_foto_dua != null) : ?>
                                                    <li data-target="#slider<?= $value->master_aset_id ?>" data-slide-to="1"></li>
                                                    <?php endif; ?>
                                                    <?php if ($value->master_aset_foto_tiga != null) : ?>
                                                    <li data-target="#slider<?= $value->master_aset_id ?>" data-slide-to="2"></li>
                                                    <?php endif; ?>
                                                    <?php if ($value->master_aset_foto_empat != null) : ?>
                                                    <li data-target="#slider<?= $value->master_aset_id ?>" data-slide-to="3"></li>
                                                    <?php endif; ?>
                                                    <?php if ($value->master_aset_foto_lima != null) : ?>
                                                    <li data-target="#slider<?= $value->master_aset_id ?>" data-slide-to="4"></li>
                                                    <?php endif; ?>
                                                </ol>
                                                <div class="carousel-inner">
                                                     <?php if ($value->master_aset_foto_satu != null) : ?>
                                                    <div class="carousel-item active">
                                                        <div class="course-img-wrap">
                                                            <img class="card-img-top" src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_satu) ?>" alt="Product Image" data-toggle="modal" data-target="#exampleModal<?= $value->master_aset_id ?>">
                                                            <div class="aset-statusp">
                                                                <?php if ($value->master_aset_status == 1) : ?>
                                                                    Public
                                                                <?php else : ?>
                                                                    Private
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if ($value->master_aset_foto_dua != null) : ?>
                                                    <div class="carousel-item">
                                                        <div class="course-img-wrap">
                                                            <img class="card-img-top" src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_dua) ?>" alt="Product Image" data-toggle="modal" data-target="#exampleModal<?= $value->master_aset_id ?>">
                                                            <div class="aset-statusp">
                                                                <?php if ($value->master_aset_status == 1) : ?>
                                                                    Public
                                                                <?php else : ?>
                                                                    Private
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <?php endif; ?>
                                                     <?php if ($value->master_aset_foto_tiga != null) : ?>
                                                    <div class="carousel-item">
                                                        <div class="course-img-wrap">
                                                            <img class="card-img-top" src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_tiga) ?>" alt="Product Image" data-toggle="modal" data-target="#exampleModal<?= $value->master_aset_id ?>">
                                                            <div class="aset-statusp">
                                                                <?php if ($value->master_aset_status == 1) : ?>
                                                                    Public
                                                                <?php else : ?>
                                                                    Private
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if ($value->master_aset_foto_empat != null) : ?>
                                                    <div class="carousel-item">
                                                        <div class="course-img-wrap">
                                                            <img class="card-img-top" src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_empat) ?>" alt="Product Image" data-toggle="modal" data-target="#exampleModal<?= $value->master_aset_id ?>">
                                                            <div class="aset-statusp">
                                                                <?php if ($value->master_aset_status == 1) : ?>
                                                                    Public
                                                                <?php else : ?>
                                                                    Private
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if ($value->master_aset_foto_lima != null) : ?>
                                                    <div class="carousel-item">
                                                        <div class="course-img-wrap">
                                                            <img class="card-img-top" src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_lima) ?>" alt="Product Image" data-toggle="modal" data-target="#exampleModal<?= $value->master_aset_id ?>">
                                                            <div class="aset-statusp">
                                                                <?php if ($value->master_aset_status == 1) : ?>
                                                                    Public
                                                                <?php else : ?>
                                                                    Private
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <?php endif; ?>
                                                </div>

                                                <?php if (
                                                    ($value->master_aset_foto_satu != null ||
                                                        $value->master_aset_foto_dua != null ||
                                                        $value->master_aset_foto_tiga != null ||
                                                        $value->master_aset_foto_empat != null ||
                                                        $value->master_aset_foto_lima != null) &&
                                                    ($value->master_aset_foto_satu != null &&
                                                        ($value->master_aset_foto_dua != null ||
                                                            $value->master_aset_foto_tiga != null ||
                                                            $value->master_aset_foto_empat != null ||
                                                            $value->master_aset_foto_lima != null)
                                                    )
                                                ) : ?>
                                                <a class="carousel-control-prev" href="#slider<?= $value->master_aset_id ?>" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#slider<?= $value->master_aset_id ?>" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $value->master_aset_nama; ?></h5>
                                                    <?php
                                                    if (!function_exists('extract_coordinates_from_kml')) {
                                                        function extract_coordinates_from_kml($file_path)
                                                        {
                                                            $xml = new DOMDocument();
                                                            $xml->load($file_path);
                                                            $coordinates = [];

                                                            $placemarks = $xml->getElementsByTagName('Placemark');
                                                            foreach ($placemarks as $placemark) {
                                                                $point = $placemark->getElementsByTagName('Point')->item(0);
                                                                if ($point) {
                                                                    $coordinates_str = $point->getElementsByTagName('coordinates')->item(0)->nodeValue;
                                                                    $coordinates_arr = explode(',', $coordinates_str);

                                                                    if (count($coordinates_arr) >= 2) {
                                                                        $latitude = trim($coordinates_arr[1]);
                                                                        $longitude = trim($coordinates_arr[0]);
                                                                        $coordinates[] = [
                                                                            'latitude' => $latitude,
                                                                            'longitude' => $longitude
                                                                        ];
                                                                    }
                                                                }
                                                            }

                                                            return $coordinates;
                                                        }
                                                    }

                                                    $file_name = $value->master_aset_koordinat;
                                                    $file_path = FCPATH . 'assets/assets/koordinat/' . $file_name;

                                                    if ($value->master_aset_koordinat_jenis === 'Upload KML/GPX') {
                                                        if (file_exists($file_path)) {
                                                            $coordinates = extract_coordinates_from_kml($file_path);
                                                        }
                                                    }
                                                    ?>

                                                    <?php if (!empty($coordinates)) { ?>
                                                        <p class="button-wrapper">
                                                            <a href="javascript:void(0)" onclick="openMapInNewTab()" class="button-peta">
                                                                <i class="fas fa-map-marker-alt"></i> <span style="margin-left: 5px;">Lihat Maps</span>
                                                            </a>
                                                        </p>
                                                        <script>
                                                            function openMapInNewTab() {
                                                                var coordinates = <?= json_encode($coordinates) ?>;
                                                                var mapUrl = 'https://www.google.com/maps?q=' + coordinates[0].latitude + ',' + coordinates[0].longitude;
                                                                window.open(mapUrl, '_blank');
                                                            }
                                                        </script>

                                                    <?php } else { ?>
                                                        <p class="button-wrapper">
                                                            <a href="https://www.google.com/maps?q=<?= $value->master_aset_koordinat; ?>" target="_blank" class="button-peta">
                                                                <i class="fas fa-map-marker-alt"></i> <span style="margin-left: 5px;">Lihat Maps</span>
                                                            </a>
                                                        </p>
                                                    <?php } ?>

                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <strong>Provinsi:</strong> <?= $value->master_aset_nama_provinsi ?>
                                                        </li>
                                                        <li>
                                                            <strong>Alamat:</strong> <?= $value->master_aset_lokasi_alamat ?>, <?= $value->master_aset_nama_kecamatan ?>, <?= $value->master_aset_nama_kab_kota ?>.
                                                        </li>
                                                        <li>
                                                            <strong>Jenis Aset :</strong> <?= $value->master_jenis_aset_nama; ?>
                                                        </li>
                                                        <li>
                                                            <strong>Luas :</strong> <?= $value->master_aset_luas_aset; ?> <?= $value->master_aset_luas_aset_satuan; ?>
                                                        </li>
                                                        <li>
                                                            <strong>Deskripsi :</strong> <?= $value->master_aset_deskripsi; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-12 text-right">
                                                        <a href="#" class="btn btn-primary-aset" id="pilih-aset" data-toggle="modal" data-target="#exampleModal" data-whatever="Asset <?= $value->master_aset_id ?>">
                                                            <i class="fa fa-check-square"></i>Pilih Aset
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                

                                <!-- Modal Slider-->
                                <?php foreach ($katalogdua as $key => $value) : ?>
                                    <div id="exampleModal<?= $value->master_aset_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Foto</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div id="slideer<?= $value->master_aset_id ?>" class="carousel slide" data-ride="carousel">
                                                        <ul class="carousel-indicators">
                                                            <?php if ($value->master_aset_foto_satu != null) : ?>
                                                            <li data-target="#slideer<?= $value->master_aset_id ?>" data-slide-to="0" class="active"></li>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_dua != null) : ?>
                                                            <li data-target="#slideer<?= $value->master_aset_id ?>" data-slide-to="1"></li>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_tiga != null) : ?>
                                                            <li data-target="#slideer<?= $value->master_aset_id ?>" data-slide-to="2"></li>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_empat != null) : ?>
                                                            <li data-target="#slideer<?= $value->master_aset_id ?>" data-slide-to="3"></li>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_lima != null) : ?>
                                                            <li data-target="#slideer<?= $value->master_aset_id ?>" data-slide-to="4"></li>
                                                            <?php endif; ?>
                                                        </ul>

                                                        <div class="carousel-inner">
                                                            <?php if ($value->master_aset_foto_satu != null) : ?>
                                                            <div class="carousel-item active">
                                                                <img src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_satu) ?>" alt="Asset Image" style="max-width: 100%;">
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_dua != null) : ?>
                                                            <div class="carousel-item">
                                                                <img src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_dua) ?>" style="max-width: 100%;">
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_tiga != null) : ?>
                                                            <div class="carousel-item">
                                                                <img src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_tiga) ?>" style="max-width: 100%;">
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_empat != null) : ?>
                                                            <div class="carousel-item">
                                                                <img src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_empat) ?>" style="max-width: 100%;">
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if ($value->master_aset_foto_lima != null) : ?>
                                                            <div class="carousel-item">
                                                                <img src="<?= base_url('assets/assets/photo_katalog/'.$value->master_aset_foto_lima) ?>" style="max-width: 100%;">
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- Controls -->
                                                        <?php if (
                                                            ($value->master_aset_foto_satu != null ||
                                                                $value->master_aset_foto_dua != null ||
                                                                $value->master_aset_foto_tiga != null ||
                                                                $value->master_aset_foto_empat != null ||
                                                                $value->master_aset_foto_lima != null) &&
                                                            ($value->master_aset_foto_satu != null &&
                                                                ($value->master_aset_foto_dua != null ||
                                                                    $value->master_aset_foto_tiga != null ||
                                                                    $value->master_aset_foto_empat != null ||
                                                                    $value->master_aset_foto_lima != null)
                                                            )
                                                        ) : ?>
                                                        <a class="carousel-control-prev" href="#slideer<?= $value->master_aset_id ?>" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#slideer<?= $value->master_aset_id ?>" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                        </div>
                        <!-- End of your catalog view code -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalcari_katalogaset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="cari" action="search.php" method="GET">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Pencarian Data</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="statusadv" class="col-form-label">Region:</label>
                        <select name="status" class="form-control" id="statusadv">
                            <option value="" selected disabled>-- Pilih region --</option>
                            <option value="1">Head Office</option>
                            <option value="2">Regiona 1</option>
                            <option value="3">Regiona 2</option>
                            <option value="4">Regiona 3</option>
                            <option value="5">Regiona 4</option>
                            <option value="6">Regiona 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stepadv" class="col-form-label">Jenis Aset:</label>
                        <select name="step" class="form-control" id="stepadv">
                            <option value="" selected disabled>-- Pilih Jenis Aset --</option>
                            <option value="Bangunan">Bangunan</option>
                            <option value="Kebun">Kebun</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="provinsi" class="col-form-label">Lokasi</label>
                        <select class="form-control" name="provinsi" id="provinsi">
                            <option value="" selected disabled>-- Pilih Provinsi --</option>
                        </select>
                        <br>
                        <select class="form-control" name="kabupaten" id="kabupaten">
                            <option value="" selected disabled>-- Pilih Kabupaten --</option>
                        </select>
                        <br>
                        <select class="form-control" name="kecamatan" id="kecamatan">
                            <option value="" selected disabled>-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success" id="cari_button">Search</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah">
                    <div class="form-group">
                        <a>Apakah Anda yakin untuk memilih aset ini?</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="tambah-button">Yakin</button>
            </div>
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
    });
</script>
<script>
    $(document).ready(function() {
        $('#tambah-button').on('click', function() {
            window.location.href = "<?= base_url('C_pengelolaan_ksu_lain/longlist') ?>";
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#exampleModal<?= $value->master_aset_id ?>').on('shown.bs.modal', function() {
            $('#slider<?= $value->master_aset_id ?>').carousel();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#exampleModal<?= $value->master_aset_id ?>').on('shown.bs.modal', function() {
            $('#slideer<?= $value->master_aset_id ?>').carousel();
        });
    });
</script>

<?= $this->endSection(); ?>