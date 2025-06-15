<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>
<?php
$encrypter = \Config\Services::encrypter();

?>

<div class="page-wrapper">
  <style>
    .d-flex {
      display: flex;
    }

    .flex-row {
      flex-direction: row;
    }

    .me-2 {
      margin-right: 0.5rem;
    }

    .button-container {
      display: flex;
    }


    .progress-circle {
        position: relative;
        width: 50px; /* Ukuran lingkaran lebih kecil */
        height: 50px;
        border-radius: 50%;
    }

    .progress-circle .inner-circle {
        position: absolute;
        top: 5px; /* Sesuaikan agar tetap proporsional */
        left: 5px;
        width: 40px; /* Lingkaran dalam lebih kecil */
        height: 40px;
        background-color: white;
        border-radius: 50%;
    }

    .progress-circle .progress-label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-weight: bold;
        font-size: 10px; /* Teks lebih kecil */
    }

    .progress-indicator {
        margin-left: auto;
    }

    .countdown {
        font-family: Arial, sans-serif;
        font-size: 8px;
        font-weight: bold;
        text-align: left;
    }

    .text-end {
        text-align: right;
    }


    
  </style>
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Divestasi Aset</h4>
        <div class="ml-auto text-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Divestasi@</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <!-- <h4 class="header-title">Data</h4> -->
              <span class="card-text">
                <button type="button" class="btn btn-info waves-effect waves-light" hidden data-toggle="modal" id="tombolFilterData" data-target="#modal_filter" data-backdrop="static"><i class="fas fa-search"></i> Filter Data </button>
              </span>
            </div>
            <!-- </div> -->
            <div class="grupExport mb-3 d-flex flex-row">
              <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                <div class="alert alert-success alert-dismissible fade show mt-1 px=0" role="alert">
                  <strong>PESAN</strong><br> <?php echo session()->getFlashdata('sukses'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php } ?>

              <?php if (!empty(session()->getFlashdata('error'))) { ?>
                <div class="alert alert-danger alert-dismissible fade show mt-1 px=0" role="alert">
                  <strong>Maaf!</strong> <?php echo session()->getFlashdata('error'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php } ?>
            </div>

            <!-- Cards Row -->
            <div class="row">

                <div class="col-md-4">
                <div class="form-group">
                  <select name="region[]" id="filter_region" class="form-control" style="width: 100%; font-weight: bold;" onchange="load_data(this);">
                      <option value="">-- Seluruh Lokasi --</option>
                      <?php foreach ($region as $reg) {
                        $selected='';
                        if(isset($_GET['lokasi'])){
                            if($_GET['lokasi']==$reg['master_region_kode']) $selected="selected";
                        }
                        
                        echo '<option '.$selected.' value="'.$reg['master_region_kode'].'">'.$reg['master_region_nama'].'</option>';
                      }; ?>
                  </select>
                </div>
              </div>

                <!-- Pengajuan Divestasi -->
                <div class="col-md-12">
                  
                  <div class="card text-white bg-info mb-3 shadow-sm">
                      <div class="card-body d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center">
                              <i class="fas fa-file-alt fa-3x mr-3"></i>
                              <div>
                                  <h3 class="card-title mb-1"><span id="totalDivestasi"><?= $dash_progress['group_progress']['R']+$dash_progress['group_progress']['H']+$dash_progress['group_progress']['P']; ?></span> Pengajuan Divestasi</h3>
                              </div>
                          </div>
                          <div class="text-right">
                              <h1 style="font-size: 22px; font-family: Roboto;">Rp. <?= number_format($dash_progress['total_nilai_objek_divestasi']); ?></h1>
                              <span>Target Nilai Objek Divestasi</span>
                          </div>
                      </div>
                  </div>
              </div>

                <?php
                  $color_nav['R']="#43849e";
                  $color_nav['P']="#767474";
                  $color_nav['H']="#38533e";
                  $color_nav['']="green";

                ?>
                <!-- On Progress -->
                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow-sm" style="background:<?= $color_nav['R']?>">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-spinner fa-3x mr-3"></i>
                            <div>
                                <h5 class="card-title">Progress Regional</h5>
                                <p class="card-text"><b id="totalProgress" data=0 style="font-size:20px"><?= $dash_progress['group_progress']['R'] ?? 0; ?></b> Objek Divestasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow-sm"  style="background:<?= $color_nav['H']?>">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-spinner fa-3x mr-3"></i>
                            <div>
                                <h5 class="card-title">Progress Head Office</h5>
                                <p class="card-text"><b id="totalProgress" data=0 style="font-size:20px"><?= $dash_progress['group_progress']['H'] ?? 0; ?></b> Objek Divestasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow-sm " style="--bs-bg-opacity: .1; background:<?= $color_nav['P']?>";>
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-spinner fa-3x mr-3"></i>
                            <div>
                                <h5 class="card-title">Progress Pemegang Saham</h5>
                                <p class="card-text"><b id="totalProgress" data=0 style="font-size:20px"><?= $dash_progress['group_progress']['P'] ?? 0; ?></b> Objek Divestasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-check-circle fa-3x mr-3"></i>
                            <div>
                                <h5 class="card-title">Selesai</h5>
                                <p class="card-text"><b id="totalSelesai" data=0><?= $progress_divestasi['selesai'];  ?></b> Objek Divestasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow-sm" style="background:#6448a4">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-check-circle fa-3x mr-3"></i>
                            <div>
                                <h5 class="card-title">Nilai Buku</h5>
                                <p class="card-text"><b data=0>Rp. <?= number_format($dash_progress['total_nilai_buku']); ?></b></p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-check-circle fa-3x mr-3"></i>
                            <div>
                                <h5 class="card-title">Realisasi Pembayaran</h5>
                                <p class="card-text"><b data=0>Rp. <?= number_format($dash_progress['total_nilai_realisasi']); ?></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container mt-4">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Search...">
                    <div class="input-group-append">
                      <button class="btn btn-info" type="button" id="search-button">Search</button>
                      <a class="btn btn-success" href="<?= base_url(); ?>/C_divestasi/proses/0" aria-expanded="false">Tambah</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card-body">
              <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="table_info" style="width: 1274px;">
                      <thead>
                        <tr style="text-align: center;" role="row">
                          <th>No.</th>
                          <th>Objek Divestasi</th>
                          <!-- <th>Luas Objek<br>Divestasi (Meter)</th> -->
                          <th>Lokasi</th>
                          <th>Nilai Buku (Rp.)</th>
                          <th>Nilai Objek Divestasi (Rp.)</th>
                          <th>Realisasi Pembayaran (Rp.)</th>
                          <th>Progress <br>Divestasi</th>
                          <th>On Going Step</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div id="custom-pagination" class="text-center mt-3">
                  <button id="custom-previous" class="btn btn-info">Previous</button>
                  Page <span id="custom-current-page">1</span> of <span id="custom-total-pages">1</span>
                  <button id="custom-next" class="btn btn-info">Next</button>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Filter Data -->
  <?php /*<div class="modal fade" id="modal_filter" tabindex="-1" role="dialog" aria-labelledby="uploadDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadDataModalLabel">Filter Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Isi modal di sini sesuai dengan kebutuhan Anda -->
        <!-- Contoh: Form untuk upload file -->
        <div class="modal-body p-4">
          <form id="form_filter" method="POST">
            <div class="row">
              <div class="col-md-12">
                <p class="text-danger "><b>*kosongi kolom untuk pilih semua</b></p>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Perusahaan</label>
                  <select name="filter_perusahaan[]" id="filter_perusahaan" class="form-control" onchange="getFilterRegion(this)" style="width: 100%;">
                    <?php 
                    echo "<option>--Pilih Perusahaan--</option>";
                    foreach ($perusahaan as $prs){
                      $selected="";
                      echo "<option ".$selected."  value='".$prs['master_perusahaan_kode']."'>".$prs['master_perusahaan_nama']."</option>";
                    }?>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Region</label>
                  <select name="region[]" id="filter_region" class="select2 form-control" multiple="multiple" style="width: 100%;">
                    <?php foreach ($region as $reg) : ?>
                      <option value="<?= $reg['master_region_nama']; ?>"><?= $reg['master_region_nama']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Unit</label>
                  <select name="unit[]" id="unit" class="select2 form-control" multiple="multiple" style="width: 100%;">
                    <?php foreach ($unitData as $reg) : ?>
                      <option value="<?= $reg['unit_desc']; ?>"><?= $reg['unit_desc']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Class Aset</label>
                  <select name="aset_class[]" id="aset_class" class="select2 form-control" multiple="multiple" style="width: 100%;">
                    <?php foreach ($asetclass as $a) : ?>
                      <option value="<?= $a['aset_class']; ?>"><?= $a['aset_class']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Grup Aset</label>
                  <select name="aset_grup[]" id="aset_grup" class="select2 form-control" multiple="multiple" style="width: 100%;">
                    <?php foreach ($asetgroup as $a) : ?>
                      <option value="<?= $a['aset_group']; ?>"><?= $a['aset_group']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Jenis Alas Hak</label>
                  <select name="jenis_alas[]" id="jenis_alas" class="select2 form-control" multiple="multiple" style="width: 100%;">
                    <option value="HGU">HGU</option>
                    <option value="HGB">HGB</option>
                    <option value="Belum Bersertifikat">Belum Bersertifikat</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Status Alas Hak</label>
                  <select name="status_alas[]" id="status_alas" class="select2 form-control" multiple="multiple" style="width: 100%;">
                    <option value="Berlaku">Berlaku</option>
                    <option value="Berakhir">Berakhir</option>
                    <option value="Proses Perpanjangan">Proses Perpanjangan</option>
                  </select>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <a href="C_aset_manajemen" type="button" class="btn btn-danger waves-effect" id="refresh_form">Reset Filter</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="#" id="submit_filter" onclick="filter_data()" class="btn btn-info waves-effect waves-light">
            Apply Filter
          </a>
          </form>
        </div>
      </div>
    </div>
  </div>*/?>

  <style>
    #latlnginfo {
      position: absolute;
      top: 50%;
      left: 60%;
      transform: translate(-50%, -50%);
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 10%;
      padding: 10px;
      display: none;
      z-index: 1;
    }
  </style>


  <!-- functions-->
  <script type="text/javascript">
      function formatRupiah(value) {
        var formatter = new Intl.NumberFormat('id-ID', {
          minimumFractionDigits: 0
        });
        return formatter.format(value);
      }

      

  function initializeDataTable() {
        var currentPage = 1;
        var formatter = new Intl.NumberFormat('id-ID', {
          minimumFractionDigits: 0
        });

        var dataAdvance = $('#datatable').DataTable({
          "processing": true,
          "serverSide": true,
          "scrollX": true,
          "ajax": {
        "url": "<?php echo base_url()?>/C_divestasi/masterlist",
        // "url": "http://localhost:8080/PTPNXII/laravel-manajemen-aset/api/v2/masterlist/dashboard-v2",
        "data": function(d) {
          d.id_region = <?php echo $id_region; ?>;
          d.page = currentPage;
          if ($('#search-input').val()) {
            d.searchTerm = $('#search-input').val();
          }
        },
        "type": "GET",
        "dataSrc": function (json) {
          var pageInfo = json.last_page; // Adjust this based on your API response
          $('#custom-total-pages').text(pageInfo);
          return json.data;
        },
      },
      "columns": [{}],
      "searching": false, // Enable searching
      "pageLength": 100,
      "paging": false,
      "info":false
        });
  }
  </script>


  <!-- Untuk set aset class grup nama -->
  <script>
    $(document).ready(function() {
      $("#aset").change(function() {
        var selectedOptions = $(this).val();
        var values = JSON.parse(selectedOptions);

        $('#aset_class').val(values.aset_class);
        $('#aset_group').val(values.aset_group);
        $('#aset_desc').val(values.aset_desc);
      })
    })
  </script>


  <script>
    <?php 
      if(!isset($_GET['lokasi'])){
        $_GET['lokasi']='';
      }
    ?>

    $(document).ready(function() {

      var currentPage = 1;
      var userId = <?= session()->get('user_id'); ?>; // Get the user ID from PHP session
      var progress;
      var all_tahapan;
      var progress_persen={};
      var total_selesai={};
      
      var dataTable = $('#datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo base_url()?>/C_divestasi/masterlist",
        "data": function(d) {
          d.id_region = <?php echo $id_region; ?>;
          d.filter_lokasi = '<?php echo $_GET['lokasi']; ?>';
          d.page = currentPage;
          if ($('#search-input').val()) {
            d.searchTerm = $('#search-input').val();
          }
        },
        "type": "GET",
        "dataSrc": function (json) {
          var pageInfo = json.last_page; 
          progress = json.progress;
          all_tahapan = json.all_tahapan;
          $('#custom-total-pages').text(pageInfo);


          //$("#totalDivestasi").html(json.totalRecords);
          return json.data;
        },
      },
      "columns": [
        {
          "data": null,
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {
          "data": "objek_divestasi",
          render: function(data,type,row){
            var editUrl = "<?= base_url('C_divestasi/proses') ?>" + "/" + row.id_divestasi;
            return '<a href="' + editUrl +'">'+row.objek_divestasi+'</a>';
          }
        },
        
        // {
        //   "data": "luas_objek_divestasi",
        //   render: function(data, type, row) {
        //         // Format angka dengan koma sebagai pemisah ribuan
        //         return new Intl.NumberFormat('id-ID', {
        //             style: 'decimal',
        //             minimumFractionDigits: 0
        //         }).format(data);
        //     },
        //     className: "text-end"
        // },

        {
          "data": "master_region_nama",
          render: function(data,type,row){
            var editUrl = "<?= base_url('C_divestasi/proses') ?>" + "/" + row.id_divestasi;
            return '<b>'+row.master_region_nama+'</b>';
          }
        },

        {
          "data": "nilai_buku",
          render: function(data, type, row) {
                // Format angka dengan koma sebagai pemisah ribuan
                return new Intl.NumberFormat('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 0
                }).format(data);
            },
            className: "text-end"
        },

        {
          "data": "nilai_objek_divestasi",
          render: function(data, type, row) {
                // Format angka dengan koma sebagai pemisah ribuan
                return new Intl.NumberFormat('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 0
                }).format(data);
            },
            className: "text-end"
        },

        

        {
          "data": "realisasi_pembayaran",
          render: function(data, type, row) {
                // Format angka dengan koma sebagai pemisah ribuan
                return new Intl.NumberFormat('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 0
                }).format(data);
            },
            className: "text-end"
        },

        {
          "data": null,
          "render": function(data, type, row, meta) {

            var user_id = <?= session()->get('user_id'); ?>;
            var hak_akses_id = <?= session()->get('hak_akses_id'); ?>;
            var editUrl = "<?= base_url('C_divestasi/proses') ?>" + "/" + row.id_divestasi;
            var persen = {};
            var progress_divestasi = <?= json_encode($progress_divestasi['persen'])?>;


            if(row.id_divestasi>0 && row.metode!=9){
                let circle_color = "#007bff";

                try{
                  persen[row.id_divestasi] = progress_divestasi[row.id_divestasi];
                }catch(e){
                  persen[row.id_divestasi] = 0;
                }

                if(persen[row.id_divestasi]!==undefined){
                    
                    if(persen[row.id_divestasi]>=100){
                        circle_color="#09b954";
                        persen[row.id_divestasi]=100;
                    }
                    
                    persen[row.id_divestasi]= persen[row.id_divestasi].toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                }else{
                    persen[row.id_divestasi]=0;
                }
                  
                var editButton =`
                    <div style="margin:0 auto">
                              <a href="` + editUrl +`" class="">
                                  <div class="progress-circle"  style="background: conic-gradient(`+circle_color+` 0% `+persen[row.id_divestasi]+`%, #e9ecef `+persen[row.id_divestasi]+`% 100%)";>
                                      <div class="inner-circle">
                                          <div class="progress-label">`+(persen[row.id_divestasi].toString().replace(".00", "") || '')+`%</div>
                                      </div>
                                  </div>
                                  <div>
                                  </div>
                                </a>
                    </div>
                    `; 



            }else{
              var editButton = '<a href="' + editUrl +'" class="btn btn-success btn-sm"><i class="fa fa-add"></i> Registrasi Divestasi</a>';
            }

            return editButton;
          }
        },
        {
          "data": null,
          render: function(data, type, row, meta) {

                  const datetime = new Date(row.current_target_log);  
                  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };  
                  const dateOnly = datetime.toLocaleDateString('en-CA', options);  

                  const targetDate = new Date(dateOnly+"T23:59:59").getTime();
                  const countdownId = `countdown${row.id_divestasi}`;


                        setTimeout(() => {
                            countDownLeadTime(row.id_divestasi, targetDate); 
                        }, 0);

                        if(progress_persen[row.id_divestasi]==100){
                          return `-`;
                        }

                        if(row.id_divestasi>0){
                          if(row.metode==9)return `<b style="color:red">Cancel</b>`;
                          if(row.current_status==null)return `-`;
                          return `
                              ${row.current_status}<br>
                              <div class="countdown" id="${countdownId}">
                                  Loading countdown...
                              </div>
                          `;
                        }else{
                           return `-`;
                        }
          }
        }

      ],
      "searching": false, // Enable searching
      "pageLength": 100,
      "paging": false,
      "info":false,

    });


      $('#custom-next').on('click', function() {
        currentPage++;
        reloadAndRedrawDataTable();
      });

      // Custom Previous button behavior
      $('#custom-previous').on('click', function() {
        if (currentPage > 1) {
          currentPage--;
          reloadAndRedrawDataTable();
        }
      });

      // Function to reload and redraw the DataTable
      function reloadAndRedrawDataTable() {
        dataTable.page(currentPage - 1).draw('page');
      }

      dataTable.on('draw', function() {
        $('#custom-current-page').text(currentPage);
      });

      $('#search-button').on('click', function() {
        performSearch();
      });

      $('#search-input').on('keypress', function(e) {
        if (e.which === 13) { // 13 is the key code for Enter
          performSearch();
        }
      });


      // Function to reload and redraw the DataTable
      function reloadAndRedrawDataTable() {
        dataTable.page(currentPage - 1).draw('page');
      }

      
      function performSearch() {
        var searchTerm = $('#search-input').val();
        $('#search-button').html(`<i class="fa fa-solid fa-spinner fa-spin mr-1"></i> Processing`);
        $('#search-button').prop('disabled', true);
        dataTable.ajax.url("<?= base_url('C_divestasi/filter_data') ?>?nomor_aset=" + searchTerm + "&query=" + encodeURIComponent(searchTerm)).load(function() {
          $('#search-button').html(`Search`);
          $('#search-button').prop('disabled', false);
        });
      }



      // Event handler untuk tombol delete
      $('#datatable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        deleteData(id);
      });

    });

    // function untuk menampilkan datatable sesuai dengan filter
    //$(document).ready(function() {

      // var search = $('.select2').select2({
      //   dropdownParent: $('#modal_filter')
      // });

      
      

      // $('#custom-next').on('click', function() {
      //   currentPage++;
      //   reloadAndRedrawDataTable();
      // });

      // // Custom Previous button behavior
      // $('#custom-previous').on('click', function() {
      //   if (currentPage > 1) {
      //     currentPage--;
      //     reloadAndRedrawDataTable();
      //   }
      // });

      

      // dataTable.on('draw', function() {
      //   $('#custom-current-page').text(dataTable.page.info().page + 1);
      //   var total_progress=$("#totalProgress").attr('data');
      // });


      function sumData(objects) {
          let totalKeys = 0;
          let totalItems = 0;

          objects.forEach(obj => {
              totalKeys += Object.keys(obj).length;
              totalItems += Object.values(obj).reduce((total, arr) => total + arr.length, 0);
          });

          return { totalKeys, totalItems };
      }

      



      function filter_data(){
          const perusahaan = $("#filter_perusahaan").val();
          const region = $("#filter_region").val();
          const unit = $("#unit").val();
          const class_aset = $("#aset_class").val();
          const grup_aset = $("#aset_grup").val();
          const jenis_alas = $("#jenis_alas").val();
          const status_alas = $("#status_alas").val();

          const params = {
            perusahaan: perusahaan,
            region: region,
            unit: unit,
            class_aset: class_aset,
            grup_aset: grup_aset,
            jenis_alas: jenis_alas,
            status_alas: status_alas
          };


          // Membuat query string dari parameter-parameter
          const queryString = $.param(params);

          // Reload the DataTable with new data
          if ($.fn.dataTable.isDataTable('#datatable')) {
              $('#datatable').DataTable().clear().destroy();
          }

          const newDataTable = initializeDataTable();

          const url = `<?php echo base_url()?>/C_divestasi/masterlist/filterdata?${queryString}`;
          
          $("#modal_filter").modal('hide');

      }

   // });

    function getRegionData(that){
       $.ajax({
            url: "<?php echo base_url('C_aset_manajemen/getRegionBy') ?>/" + that.value,
            type: "POST",
            success: function(response) {
                populateDropdown(response)
            },
            error: function(xhr, status, error) {
            }
          });
    }


    function getFilterRegion(that){
      $('#filter_region').select2({
            placeholder: '-- Pilih region --',
            ajax: {
                url: "<?php echo base_url('C_aset_manajemen/getRegionBy') ?>/" + that.value,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id_region,
                            text: item.master_region_nama
                        }))
                    };
                },
                cache: true
            }
        });
    }


    function populateDropdown(data) {
        const selectElement = document.getElementById('import_region');
        const selectElement2 = document.getElementById('update_region');

        selectElement.innerHTML = '<option value="">--Pilih Region--</option>';
        selectElement2.innerHTML = '<option value="">--Pilih Region--</option>';
        data = JSON.parse(data);

        data.forEach(item => {
            const newOption = document.createElement('option');
            newOption.value = item.master_region_kode;
            newOption.textContent = item.master_region_nama;
            selectElement.appendChild(newOption);

            const newOption2 = document.createElement('option');
            newOption2.value = item.master_region_kode;
            newOption2.textContent = item.master_region_nama;
            selectElement2.appendChild(newOption2);

        });
    }
  </script>

  <script>
         function countDownLeadTime(id, targetDate) {
              const targetDateTime = new Date(targetDate).getTime(); // Ubah targetDate ke timestamp
              const countdownElement = document.getElementById(`countdown${id}`);
              if (!countdownElement) return; // Pastikan elemen ada

              // Perbarui setiap detik
              const interval = setInterval(() => {
                  const now = new Date().getTime();
                  const timeRemaining = targetDateTime - now; // Hitung selisih waktu

                  if (timeRemaining < 0) {
                      // Jika waktu sudah lewat
                      const timeLate = Math.abs(timeRemaining); // Waktu negatif diubah jadi positif
                      const days = Math.floor(timeLate / (1000 * 60 * 60 * 24));
                      const hours = Math.floor((timeLate % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                      const minutes = Math.floor((timeLate % (1000 * 60 * 60)) / (1000 * 60));
                      const seconds = Math.floor((timeLate % (1000 * 60)) / 1000);

                      countdownElement.innerHTML = `<span style="color:red">Delay: <br>${days} Hari ${hours} Jam ${minutes} Menit ${seconds} Detik</span>`;
                  } else {
                      // Jika waktu belum habis
                      const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                      const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                      const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                      const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                      countdownElement.innerHTML = `<span style="color:#007bff">Batas Waktu Penyelesaian: <br><b>${days} Hari ${hours} Jam ${minutes} Menit ${seconds} Detik</b></span>`;
                  }
              }, 1000);
          }


          function load_data(that){
            let filter = $(that).val();
            if(filter=='')window.location.href="<?php echo base_url().'/C_divestasi';?>";
            else window.location.href="<?php echo base_url().'/C_divestasi?lokasi='?>"+filter;
          }

    </script>


  <!-- <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/aes.js"></script> -->

  <script type="text/javascript">
    
  </script>

  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 60000);
  </script>

  <?php if (session()->has('processing')) : ?>
    <script>
      $(document).ready(function() {
        // Munculkan alert "Data sedang diproses"
        alert("<?= session('processing') ?>");
      });
    </script>
  <?php endif; ?>

  <?= $this->endSection(); ?>
  <!-- footer  -->
  <footer class="footer text-center">
    All Rights Reserved by PTPN XII. Designed and Developed by <a href="https://ptpn12.com">PTPN XII</a>.
  </footer>
  <!-- ============================================================== -->
  <!-- End footer -->
  <!-- ============================================================== -->
</div>