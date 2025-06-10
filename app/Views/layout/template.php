<!DOCTYPE html>
<html dir="ltr" lang="en" <?php if (session()->get('role_id') == 14) { ?> style="background-color: black; height: 100% !important;" <?php } ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="csrf_token()">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/assets/images/LOGO-PTPN.png">
  <title>Monika</title>
  <!-- Custom CSS -->
  <link href="<?= base_url(); ?>/assets/assets/libs/flot/css/float-chart.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/select2/dist/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/jquery-minicolors/jquery.minicolors.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/assets/libs/quill/dist/quill.snow.css">
  <link href="<?= base_url(); ?>/assets/dist/css/style.min.css" rel="stylesheet">

  <script src="<?= base_url(); ?>/assets/assets/libs/jquery/dist/jquery.min.js"></script>
  <link href="<?= base_url(); ?>/assets/assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
  <script src="<?= base_url(); ?>/assets/assets/libs/toastr/build/toastr.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

  <!-- New Add by heyaender -->
  <!-- DataTables CSS and JS files -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

  <!-- DataTables Buttons CSS and JS files -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

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

  <?= $this->renderSection('styles'); ?>
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <!-- <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div> -->
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <?php if (session()->get('role_id') != 14) { ?>
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="">
              <!-- Logo icon -->
              <b class="logo-icon p-l-10">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="<?= base_url(); ?>/assets/assets/images/LOGO-PTPN.png" alt="homepage" width="30" height="32"
                  class="light-logo" />
                Monika
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text">
                <!-- dark Logo text -->
                <span class="light-logo"> </span>

              </span>
              <!-- Logo icon -->
              <!-- <b class="logo-icon"> -->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

              <!-- </b> -->
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
              <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
              <!-- ============================================================== -->
              <!-- create new -->
              <!-- ============================================================== -->

            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
              <!-- ============================================================== -->
              <!-- Comment -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Messages -->
              <!-- ============================================================== -->
              <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5>
                                                        <span class="mail-desc">Just a reminder that event</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5>
                                                        <span class="mail-desc">You can customize this template</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5>
                                                        <span class="mail-desc">Just see the my admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Luanch Admin</h5>
                                                        <span class="mail-desc">Just see the my new admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
              <!-- ============================================================== -->
              <!-- End Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <h4 class="mt-4" style="color:white">Haloo <?= session()->get('username'); ?></h4>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url(); ?>/assets/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>

                <div class="dropdown-menu dropdown-menu-right user-dd animated">

                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item" data-toggle="modal" data-target="#modal-ganti_paswword" href="<?= base_url(); ?>/C_login/logout"><i class="fa fa-key m-r-5 m-l-5"></i> Ganti Password</a>
                  <a class="dropdown-item" href="<?= base_url(); ?>/C_login/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                </div>

              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Header -->

      <!-- sidebar -->
      <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
              <!-- <?= var_dump(session()->get('hak_akses_id'));?> -->
              <?php if (!session()->get('username')) { ?>
                -
              <?php } else { ?>
              <!-- SIDEBAR DIVESTASI -->
              <?php 
              if(session()->get('hak_akses_id')=='20') { ?>
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_divestasi" aria-expanded="false">
                        <i class="mdi mdi-file-document"></i><span class="hide-menu">Divestasi Aset</span>
                      </a>
                    </li>
              <!-- INI SIDEBAR MONIKA -->
              <?php }elseif (session()->get('hak_akses_id') == "13") {//DEKOM?>
                   <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                      </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master Data Mia
                      </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                      <li class="sidebar-item"><a href="<?= base_url(); ?>/C_aset_manajemen" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Nomor Aset SAP </span></a></li>
                      <li class="sidebar-item"><a href="<?= base_url(); ?>/C_data_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Aset Manajemen </span></a></li>
                    </ul>
                  </li>

              <?php }elseif (session()->get('role_id') != "11") {?>

                  <?php if (session()->get('role_id') == "8") { ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                      </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_data_mitra" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Data Mitra</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_master_rkap" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Master RKAP</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_master_katalog" aria-expanded="false"><i class="mdi mdi-image-filter"></i><span class="hide-menu">Master Katalog</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_urutan_katalog" aria-expanded="false"><i class="mdi mdi-buffer"></i><span class="hide-menu">Katalog Potensial</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file-excel"></i><span class="hide-menu">Report</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url('reportcash') ?>" class="sidebar-link"><i class="mdi mdi-file-excel"></i><span class="hide-menu"> Report Cash In </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_report_katalog" class="sidebar-link"><i class="mdi mdi-file-excel"></i><span class="hide-menu"> Report Katalog </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_report_monika" class="sidebar-link"><i class="mdi mdi-file-excel"></i><span class="hide-menu"> Report Kerja Sama </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_report_presentase" class="sidebar-link"><i class="mdi mdi-file-excel"></i><span class="hide-menu"> Report Progress Pengisian </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_rkap_real" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report PKS RKAP v Real</span></a></li>

                      </ul>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_piutang" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Pembayaran Mitra</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_target" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Target vs Realisasi</span></a></li>
                  <?php } elseif (session()->get('role_id') == "13") { ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                      </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_tampilan_katalog" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Katalog</span></a></li>
                    <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                href="<?= base_url(); ?>/C_pengelolaan_ksu" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span
                  class="hide-menu">Pengelolaan KSO Tansem</span></a></li> -->
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_pengelolaan_ksu_lain" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Pengelolaan Kerja Sama</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_monika" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Report Monika</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_katalog" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Report Katalog</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_rkap_real" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report PKS RKAP v Real</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_piutang" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Pembayaran Mitra</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_target" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Target vs Realisasi</span></a></li>

                  <?php } elseif (session()->get('role_id') == "9") { ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                      </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_tampilan_katalog" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Katalog</span></a></li>
                    <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                href="<?= base_url(); ?>/C_pengelolaan_ksu" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span
                  class="hide-menu">Pengelolaan KSO Tansem</span></a></li> -->
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_pengelolaan_ksu_lain" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Pengelolaan Kerja Sama</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file-excel"></i><span class="hide-menu">Report</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_report_monika" class="sidebar-link"><i class="mdi mdi-file-excel"></i><span class="hide-menu"> Report Kerja Sama </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_report_presentase" class="sidebar-link"><i class="mdi mdi-file-excel"></i><span class="hide-menu"> Report Progress Pengisian </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_rkap_real" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report PKS RKAP v Real</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_piutang" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Pembayaran Mitra</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_target" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Target vs Realisasi</span></a></li>
                      </ul>
                    </li>

                  <?php } elseif (session()->get('role_id') == "10") { ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                      </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_tampilan_katalog" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Katalog</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_pengelolaan_ksu_lain" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Pengelolaan Kerja Sama</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_monika" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Report Monika</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_presentase" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Report Presentase</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_rkap_real" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report PKS RKAP v Real</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_piutang" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Pembayaran Mitra</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_target" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Target vs Realisasi</span></a></li>


                  <?php } elseif (session()->get('role_id') == "12") { ?>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                      </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master Monika</span></a>
                      <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_master_user_monika" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Master User </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_master_kerjasama" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Master Jenis Kerja Sama </span></a></li>
                        <li class="sidebar-item"><a href="<?= base_url(); ?>/C_master_role_monika" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Master Role </span></a></li>
                      </ul>
                    </li>
                  <?php } ?>
                  <!-- JANGAN DIHAPUS YAA -->

                <?php } elseif (session()->get('role_id') == "11") { ?>
                  <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                      <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                      <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                      <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                    </ul>
                  </li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_data_mitra" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Data Mitra</span></a></li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_master_katalog" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Master Katalog</span></a></li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_monika" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Report Monika</span></a></li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_katalog" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Report Katalog</span></a></li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_rkap_real" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report PKS RKAP v Real</span></a></li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_piutang" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Pembayaran Mitra</span></a></li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_report_target" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Report Target vs Realisasi</span></a></li>
                <?php } ?>

                <!-- BATAS AKHIR SIDEBAR MONIKA -->

                <!-- MASTER MENU AMANAT -->
                <li <?= in_array(session()->get('hak_akses_id'), range(1, 7)) || in_array(session()->get('hak_akses_id'), range(10, 12)) || in_array(session()->get('role_id'), range(3, 14)) ? "hidden" : "" ?> class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard</span></a>
                  <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                    <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                    <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                  </ul>
                </li>

                <li <?= (in_array(session()->get('role_id'), range(3, 14))) ? "hidden" : "" ?> class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master Aset
                    </span></a>
                  <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="<?= base_url(); ?>/C_aset_manajemen" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Nomor Aset SAP </span></a></li>
                    <li class="sidebar-item"><a href="<?= base_url(); ?>/C_data_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Aset Manajemen </span></a></li>
                  </ul>
                </li>
              <?php if(session()->get('role_id')!='20') { ?>
              <!-- MASTER MENU AMANAT -->
              <li <?= in_array(session()->get('hak_akses_id'), range(1, 7)) || in_array(session()->get('hak_akses_id'), range(10, 12)) || in_array(session()->get('role_id'), range(3, 14)) ? "hidden" : "" ?> class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Dashboard <?= session()->get('hak_akses_id')?></span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_peta_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Dashboard Peta </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Inventarisasi aset </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_dashboard_katalog" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Optimalisasi aset </span></a></li>
                </ul>
              </li>

              <li <?= (in_array(session()->get('role_id'), range(3, 14))) ? "hidden" : "" ?> class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master Data Mia
                  </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_aset_manajemen" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Nomor Aset SAP </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_data_aset" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Data Aset Manajemen </span></a></li>
                </ul>
              </li>

              <li <?= in_array(session()->get('hak_akses_id'), range(1, 7)) || in_array(session()->get('hak_akses_id'), range(10, 12)) || in_array(session()->get('role_id'), range(3, 14)) ? "hidden" : "" ?> class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master Sistem</span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_master_sub_unit" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Sub Unit </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_master_afdeling" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Afdeling </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_master_region" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Region </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_master_unit" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Unit </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_amanat_user" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Users </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_amanat_gl" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> GL Account </span></a></li>
                </ul>
              </li>
              <li <?= in_array(session()->get('hak_akses_id'), range(1, 11)) ? "" : "hidden" ?> class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Reports</span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_amanat_report/reportLuasan" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Report Luasan Aset </span></a></li>
                  <!-- <li class="sidebar-item"><a href="<?= base_url(); ?>/C_amanat_report/masterassets" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Report Aset SAP </span></a></li> -->
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_amanat_report/reportQR" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Report QR Aset </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_amanat_report/controlNilai" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Control Nilai Aset </span></a></li>
                  <li class="sidebar-item"><a href="<?= base_url(); ?>/C_amanat_report/reportMasterList" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Report Master List</span></a></li>
                </ul>
              </li>
              <li <?= in_array(session()->get('hak_akses_id'), range(1, 7)) || in_array(session()->get('hak_akses_id'), range(10, 12)) || in_array(session()->get('role_id'), range(3, 14)) ? "hidden" : "" ?> class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_aset_koordinat" aria-expanded="false">
                  <i class="mdi mdi-file-document"></i><span class="hide-menu">Koordinat Aset</span>
                </a>
              </li>
              <?php }?>

              

              <!-- <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url(); ?>/C_peta_aset"
                aria-expanded="false">
                <i class="mdi mdi-map-marker"></i><span class="hide-menu">Aset Locations</span>
              </a>
            </li> -->

                <!-- END MASTER MENU AMANAT -->
                <!--
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="widgets.html" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Widgets</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="tables.html" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Tables</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Forms </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Form Basic </span></a></li>
                                <li class="sidebar-item"><a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Form Wizard </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
                                <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
                                <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
                                <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
                                <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
                                <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
                                <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
                                <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
                                <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
                                <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
                            </ul>
                        </li> -->
            </ul>
          </nav>
        <?php } ?>
        <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!-- sidebar -->
    <?php } ?>

    <!-- Modal Ganti Password -->
    <div class="modal fade" id="modal-ganti_paswword" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action='<?= base_url('C_login/ganti_password'); ?>'>
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Ganti Password</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" name="user_id" value=<?= session()->get('user_id'); ?> hidden>
                <input type="text" class="form-control" name="current_url" value=<?= current_url(); ?> hidden>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Password Lama:</label>
                <input type="password" class="form-control" name="old_password" autocomplete="new-password" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Password Baru:</label>
                <input type="password" class="form-control" name="new_password" autocomplete="new-password" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Ulang Password Baru:</label>
                <input type="password" class="form-control" name="conf_new_password" autocomplete="new-password" required>
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
    <!-- End Modal Ganti Password -->

    <?php
    $change_fail = session()->getFlashdata("change_password_fail");
    $change_success = session()->getFlashdata("change_password_success");

    ?>
    <?php if (isset($change_fail)) : ?>
      <script type="text/javascript">
        $(document).ready(function() {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= $change_fail; ?>',
          })
        });
      </script>
    <?php endif; ?>
    <?php if (isset($change_success)) : ?>
      <script type="text/javascript">
        $(document).ready(function() {
          Swal.fire({
            icon: 'success',
            title: 'Good Job',
            text: '<?= $change_success; ?>',
          })
        });
      </script>
    <?php endif; ?>

    <?= $this->renderSection('content'); ?>
    <style>
      body {
        margin: 0;
        padding: 0;
      }

      .content {
        min-height: calc(100vh - 60px);
        padding: 20px;
      }

      .footer {
        position: relative;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #f0f0f0;
        padding: 10px 0;
        text-align: center;
      }
    </style>
    <!-- footer  -->
    <?php if (session()->get('role_id') != 14) { ?>
      <footer class="footer">
        All Rights Reserved by PTPN 1. Designed and Developed by <a href="https://ptpn1.co.id">PTPN 1</a>.
      </footer>
    <?php } ?>
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


</body>
<script src="<?= base_url(); ?>/assets/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?= base_url(); ?>/assets/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?= base_url(); ?>/assets/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url(); ?>/assets/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="<?= base_url(); ?>/assets/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
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
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#ganti_password").on("submit", function(e) {
      e.preventDefault();
      $('#tambah_button').html("<i class='fa fa-spinner fa-spin '></i> Processing Order");
      $('#tambah_button').prop('disabled', true);
      $.ajax({
        method: "post",
        url: "<?= base_url() ?>/user/tambah",
        data: $("#tambah").serialize(),
        success: function(backData) {
          toastr.success('', 'Berhasil Menambahkan data !', {
            timeOut: 1000,
            fadeOut: 300,
            onHidden: function() {
              window.location.reload();
            }
          });
        },
        fail: function(xhr, textStatus, errorThrown) {
          alert('Tambah Data Gagal');
          $('#tambah_button').html("Tambah");
          $('#tambah_button').prop('disabled', false);
        }
      });
    });
  });
  // });
</script>
<script type="text/javascript">
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
          //console.log(value);
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

  table = document.getElementById('table');

  if (table !== null) {
    $('#table').DataTable({
      "scrollX": true
    });
  }
</script>

<?php if (session()->get('role_id') == 14) { ?>
  <script>
    $(document).ready(function() {
      let pageWrapper = $('.page-wrapper').first();
      let mainWrapper = $('#main-wrapper');

      // remove class page-wrapper
      pageWrapper.removeClass('page-wrapper');

      // add style min-height
      mainWrapper.css('min-height', '100vh');
    });
  </script>
<?php } ?>

<?= $this->renderSection('scripts'); ?>

</html>
<!-- footer -->