<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>
<?php
$encrypter = \Config\Services::encrypter();

?>

<div class="page-wrapper">
  
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Dashboard Divestasi Aset</h4>
        <div class="ml-auto text-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Divestasi</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
     <!-- Main Content -->
            <h2>Dashboard Overview</h2>

            <!-- Cards Row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">1,245 Active Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Revenue</h5>
                            <p class="card-text">$15,678 This Month</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">New Orders</h5>
                            <p class="card-text">320 Pending Orders</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Table -->
            <h3>Recent Transactions</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>$500</td>
                            <td><span class="badge badge-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>$300</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Michael Johnson</td>
                            <td>$700</td>
                            <td><span class="badge badge-danger">Failed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
  </div>


  

  

  <!-- functions-->
  <script type="text/javascript">
      function formatRupiah(value) {
        var formatter = new Intl.NumberFormat('id-ID', {
          minimumFractionDigits: 0
        });
        return formatter.format(value);
      }


  
  </script>

  <?= $this->endSection(); ?>
  <!-- footer  -->
  <footer class="footer text-center">
    All Rights Reserved by PTPN XII. Designed and Developed by <a href="https://ptpn12.com">PTPN XII</a>.
  </footer>
  <!-- ============================================================== -->
  <!-- End footer -->
  <!-- ============================================================== -->
</div>