<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>
<style>
        .btn-link::after {
            content: "\25BC"; /* Downward arrow */
            font-size: 1rem;
            float: right;
            transition: transform 0.3s ease;
        }
        .btn-link.collapsed::after {
            transform: rotate(-90deg); /* Rotate arrow */
        }

        .card-header {
        	background-color: #546066;
        	color: white;
        }

        .card-header:hover {
            background-color: #00334d;
            color: white;
        }

        .card-header:hover .btn-link {
            color: white;
        }

        .card-header {
		    display: flex;
		    justify-content: space-between; /* Mengatur jarak antara teks kiri dan elemen kanan */
		    align-items: center; /* Menyelaraskan elemen secara vertikal */
		}
    </style>

    <style>
        .progress-circle {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
           
        }

        .progress-circle .inner-circle {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 50%;
        }

        .progress-circle .progress-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
            font-size: 18px;
        }

        .progress-indicator {
		    margin-left: auto; 
		}

		input[type="checkbox"] {
		    transform: scale(1.5); /* Perbesar checkbox */
		    margin: 10px; /* Tambahkan margin jika diperlukan */
		}
    </style>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Registrasi Divestasi Aset</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Aset Manajemen</li>
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
                        <div class="row">
                            <div class="col-sm-12">

					                <div class="card">
					                    <div class="card-header bg-secondary text-white h4">
					                        Informasi Aset
					                    </div>
					                    <div class="card-body">
					                        <div class="row mb-3">
					                            <div class="col-md-4"><strong>Kode Perusahaan:</strong></div>
					                            <div class="col-md-8"><?= isset($asetManajemen) && is_object($asetManajemen) ? $asetManajemen->kode_perusahaan : '' ?></div>
					                        </div>
					                        <div class="row mb-3">
					                            <div class="col-md-4"><strong>Region:</strong></div>
					                            <div class="col-md-8"><?= isset($asetManajemen) ? $asetManajemen->id_region : '' ?></div>
					                        </div>
					                        <div class="row mb-3">
					                            <div class="col-md-4"><strong>Nomor SAP:</strong></div>
					                            <div class="col-md-8"><?= isset($asetManajemen) ? $asetManajemen->nomor_aset : '' ?></div>
					                        </div>
					                        <div class="row mb-3">
					                            <div class="col-md-4"><strong>Unit:</strong></div>
					                            <div class="col-md-8"><?= isset($asetManajemen) && is_object($asetManajemen) ? $asetManajemen->unit_desc : '' ?></div>
					                        </div>
					                        <div class="row mb-3">
					                            <div class="col-md-4"><strong>Deskripsi Aset SAP:</strong></div>
					                            <div class="col-md-8">
					                                <span class=""><?= isset($asetManajemen) && is_object($asetManajemen) ? $asetManajemen->deskripsi_aset : '' ?></span>
					                            </div>
					                        </div>
					                        <div class="row mb-3">
					                            <div class="col-md-4"><strong>Kelas - Grup - Nama Aset:</strong></div>
					                            <div class="col-md-8">
					                               <?= isset($asetManajemen) && is_object($asetManajemen) ? $asetManajemen->class_aset . '-' . $asetManajemen->grup_aset . '-' . $asetManajemen->kelompok_aset : '' ?>
					                            </div>
					                        </div>

					                        <div class="row mb-3">
					                            <div class="col-md-4"><strong>Pilih Metode Divestasi</strong></div>
					                            <div class="col-md-8 form-group d-flex align-items-center">
												    <span class="flex-grow-1 me-2">
												        <select class="form-control" id="metode_tahapan">
												            <option value="langsung" <?= ($divestasi_data->metode=='langsung')?"selected":''?>>Tahapan Penjualan Langsung</option>
												            <option value="tidak_langsung" <?= ($divestasi_data->metode=='tidak_langsung')?"selected":''?>>Tahapan Penjualan Tidak Langsung</option>
												        </select>
												    </span>
												    <span>
												        <button class="btn btn-primary" onclick="saveDivestasi(<?= $asetManajemen->id?>)">Proses</button>
												    </span>
												</div>

					                        </div>
					                        <div class="text-center mt-4">
					                            
					                            <!--<button class="btn btn-danger">Hapus Aset</button> -->
					                        </div>
					                    </div>
					                </div>




								        <div class="card">
								            <div class="card-header text-white" style="background: #0394de;">

								            	<?php 
								            	if ($divestasi_data->metode=='langsung'): ?>
								                	Proses Divestasi Aset [Penjualan Langsung]
												<?php endif; ?>

												<?php if ($divestasi_data->metode=='tidak_langsung'): ?>
								                	Proses Divestasi Aset [Penjualan Tidak Langsung]
												<?php endif; ?>
								            </div>
								            <div class="card-body">

								            	<?php if (session()->getFlashdata('success')): ?>
													    <div class="alert alert-success">
													        <?= session()->getFlashdata('success'); ?>
													    </div>
													<?php endif; ?>

													<?php if (session()->getFlashdata('error')): ?>
													    <div class="alert alert-danger">
													        <?= session()->getFlashdata('error'); ?>
													    </div>
													<?php endif; ?>

													<?php 
													$tab_tahapan='';
													if(session()->getFlashdata('tab')!=null){
														$tab_tahapan=session()->getFlashdata('tab');
														$active = "show active";
													}

													?>

								                <!-- Tab Navigation -->
								                <ul class="nav nav-tabs" id="assetDetailTab" role="tablist">
								                	<li class="nav-item">
								                        <a class="nav-link <?= ($active=='')?'active show':''?>" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">
								                            PROGRESS DIVESTASI
								                        </a>
								                    </li>
								                    <li class="nav-item">
								                        <a class="nav-link <?= ($active!='')?'active show':''?>" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="true">
								                            UPLOAD DOKUMEN
								                        </a>

								                        <?php $pathFile='uploads/' . $asetManajemen->id.'/';?>
								                    </li>
								                    <li class="nav-item">
								                        <a class="nav-link" id="verifikasi-tab" data-toggle="tab" href="#verifikasi" role="tab" aria-controls="verifikasi" aria-selected="true">
								                            REVIEW DOKUMEN
								                        </a>
								                    </li>
								                    
								                    <!-- <li class="nav-item">
								                        <a class="nav-link" id="divestasi-tab" data-toggle="tab" href="#divestasi" role="tab" aria-controls="divestasi" aria-selected="false">
								                            Divestasi Final
								                        </a>
								                    </li> -->
								                </ul>


								                <!-- Tab Panes -->
								                <div class="tab-content mt-3" id="assetDetailTabContent">
								                	<!-- Progress Tab -->
								                    <div class="tab-pane fade <?= ($active=='')?'active show':''?>" id="history" role="tabpanel" aria-labelledby="history-tab">
								                        <div class="container text-center mt-5">

													        <div class="progress-circle"  style="background: conic-gradient(#007bff 0% <?= $progress?>%, #e9ecef <?= $progress?>% 100%)";>
													            <div class="inner-circle">
													                <div class="progress-label"><?= $progress?>%</div>
													            </div>
													        </div>
													    </div>
								                    </div>

								                    <!-- Progress Tab -->

								                    <?php foreach($tahapan_divestasi['tahapan'] as $id_tahapan=>$thp){?>
								                    	

								                	<?php }?>




								                    <div class="tab-pane fade" id="verifikasi" role="tabpanel" aria-labelledby="history-tab">
								                        <div class="container text-center mt-5">
													        <h5>Review Kelengkapan Dokumen yang sudah ditandatangani</h5>
													        <div class="col-12">
													                <!-- Tabel -->
																        <table class="table table-bordered table-responsive">
																            <thead class="thead-grey">
																                <tr>
																                    <th>Nama File</th>
																                    <th>Keterangan</th>
																                    <th>Status</th>
																                    <th>Tanggal Upload</th>
																                    <th>Verifikasi</th>
																                    <th>Reject</th>
																                </tr>
																            </thead>
																            <tbody>
																                <?php if (!empty($files)): ?>
																                    <?php 
																                    foreach ($files as $key => $file){ 
																                    		if($file['tahapan']!="001")continue; ?>
																                        <tr>
																                            <td><?= $file['file_name']; ?></td>
																                            <td><?= $file['keterangan']; ?></td>
																                            <td><?= $file['status']; ?></td>
																                            <td><?= $file['created_at']; ?></td>
																                            <td>
																                                <input type="checkbox" class="form-control alert-success"/>
																                            </td>
																                            <td>
																                                <button class="btn btn-danger btn-xs"><i class="mdi mdi-close"></i></button>
																                            </td>
																                        </tr>
																                    <?php }; ?>
																                <?php else: ?>
																                    <tr>
																                        <td colspan="5" class="text-center">
																                        Tidak ada file yang diunggah.</td>
																                    </tr>
																                <?php endif; ?>
																            </tbody>
																        </table>
													            </div>
													    </div>
								                    </div>

								                    <!-- Upload Dokumen Tab -->
								                    <div class="tab-pane fade <?= ($active!='')?'active show':''?>" id="upload" role="tabpanel" aria-labelledby="upload-tab">
								                        <div id="accordion">
							                        		<?php foreach($tahapan_divestasi['tahapan'] as $id_tahapan=>$tahapan){?>
							                    				<!-- Item  -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1" id="heading1">
															        	<?php echo $tahapan?>
															            <!-- A. Upload Permohonan Minat Aset dari Pemohon <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['001']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['001'].'%</a>';?></span> -->
															        </div>
															        <div id="collapse1" class="collapse <?= ($tab_tahapan=='001')?'show':''?>" aria-labelledby="heading1" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="001" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['001'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php 
																				                    foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="001")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile.$file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

							                				<?php }?>








															    <?php /*<!-- Item 1 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1" id="heading1">
															            A. Upload Permohonan Minat Aset dari Pemohon <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['001']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['001'].'%</a>';?></span>
															        </div>
															        <div id="collapse1" class="collapse <?= ($tab_tahapan=='001')?'show':''?>" aria-labelledby="heading1" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="001" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['001'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php 
																				                    foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="001")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile.$file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 2 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2" id="heading2">
															             B. Upload Tanggapan Permohonan  <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['002']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['002'].'%</a>';?></span>
															        </div>
															        <div id="collapse2" class="collapse <?= ($tab_tahapan=='002')?'show':''?>" aria-labelledby="heading2" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="002" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['002'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="002")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 3 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3" id="heading3">
															             C. Upload Dokumen Hasil Uji Tuntas (Regional)  <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['003']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['003'].'%</a>';?></span>
															        </div>
															        <div id="collapse3" class="collapse <?= ($tab_tahapan=='003')?'show':''?>" aria-labelledby="heading3" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="003" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['003'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="003")continue;?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 4 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4" id="heading4">
															             D. Upload Dokumen Hasil Appraisal KJPP (Regional) <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['004']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['004'].'%</a>';?></span>
															        </div>
															        <div id="collapse4" class="collapse <?= ($tab_tahapan=='004')?'show':''?>" aria-labelledby="heading4" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="004" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																									<?php 
																						        	foreach($data_tahapan['004'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="004")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 5 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5" id="heading5">
															             E. Upload Approval Hasil Kajian <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['005']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['005'].'%</a>';?></span>
															        </div>
															        <div id="collapse5" class="collapse <?= ($tab_tahapan=='005')?'show':''?>" aria-labelledby="heading5" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="005" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['005'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="005")continue;
																				                    	?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 6 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6" id="heading6">
															             F. Upload Dokumen Hasil Reviu dan Persetujuan Direktur <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['006']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['006'].'%</a>';?></span>
															        </div>
															        <div id="collapse6" class="collapse <?= ($tab_tahapan=='006')?'show':''?>" aria-labelledby="heading6" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="006" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['006'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="006")continue;?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 7 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7" id="heading7">
															             G. Upload Hasil dan Tanggapan Dewan Komisaris <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['007']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['007'].'%</a>';?></span>
															        </div>
															        <div id="collapse7" class="collapse <?= ($tab_tahapan=='007')?'show':''?>" aria-labelledby="heading7" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="007" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['007'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="007")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 8 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8" id="heading8">
															             H. Upload Dokumen Hasil Persetujuan Pemegang Saham <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['008']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['008'].'%</a>';?></span>
															        </div>
															        <div id="collapse8" class="collapse <?= ($tab_tahapan=='008')?'show':''?>" aria-labelledby="heading8" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="008" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['008'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="008")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 9 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse9" aria-expan="false" aria-controls="collapse9" id="heading9">
															        	I. Upload Surat Kuasa Khusus <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['009']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['009'].'%</a>';?></span>
															        </div>
															        <div id="collapse9" class="collapse <?= ($tab_tahapan=='009')?'show':''?>" aria-labelledby="heading9" data-parent="#accordion">
															        	<div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="009" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						        	<option value="">-- Pilih Jenis Dokumen --</option>
																						        	<?php 
																						        	foreach($data_tahapan['009'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="009")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 10 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10" id="heading10">
															             J. Upload Dokumen Invoice dan Bukti Pembayaran Ganti Rugi <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['010']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['010'].'%</a>';?></span>
															        </div>
															        <div id="collapse10" class="collapse <?= ($tab_tahapan=='010')?'show':''?>" aria-labelledby="heading10" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="010" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['010'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="010")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
															    </div>

															    <!-- Item 11 -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11" id="heading11">
															            K. Upload Dokumen AJB dan Serah Terima, Sertifikat <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan['011']>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan['011'].'%</a>';?></span>
															        </div>
															        <div id="collapse11" class="collapse <?= ($tab_tahapan=='011')?'show':''?>" aria-labelledby="heading10" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $asetManajemen->id?>" />
																	                		<input type="hidden" name="tahapan" value="011" />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" id="file-group" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($data_tahapan['011'] as $opt=>$label){
																						        		echo '<option value="'.$opt.'">'.$label.'</option>';
																						        	}
																						        	?>
																						        </select>
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal" name="file_upload" class="form-control" required />
																						    </div>
																						    <select class="form-control" id="file-status" name="file_status" required>
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>
																						    <button type="submit" class="btn btn-success">Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>Nama File</th>
																				                    <th>Keterangan</th>
																				                    <th>Status</th>
																				                    <th>Tanggal Upload</th>
																				                    <th>Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php foreach ($files as $key => $file){ 
																				                    		if($file['tahapan']!="011")continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?></td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td><?= $file['status']; ?></td>
																				                            <td><?= $file['created_at']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile . $file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank">View</a>
																				                            </td>
																				                        </tr>
																				                    <?php }; ?>
																				                <?php else: ?>
																				                    <tr>
																				                        <td colspan="5" class="text-center">
																				                        Tidak ada file yang diunggah.</td>
																				                    </tr>
																				                <?php endif; ?>
																				            </tbody>
																				        </table>
																	            </div>
																            </div>
															            </div>
															        </div>
											                    </div>*/?>
											                </div>
											            </div>
									                </div>
									            </div>
									        </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>

                function saveDivestasi(id){
                	let data ={};
                	data['metode']     =$("#metode_tahapan :selected").val();
                	data['id_maia']	   =id;

                	$.ajax({
	                    method: "post",
	                    url: "<?= base_url() ?>/C_Divestasi/save",
	                    data: data,
	                    cache: false,
	                    dataType: "json",
	                    success: function(resp) {
	                    	console.log(resp);
	                        Swal.fire({
	                            icon: 'success',
	                            title: ' Berhasil !',
	                            timer: 2500,
	                            showCancelButton: false,
	                            showConfirmButton: false
	                        });
	                        window.location.reload();
	                    },
	                    error: function(xhr, status, error) {
	                        Swal.fire({
	                            icon: 'error',
	                            title: ' Gagal !',
	                            timer: 2500,
	                            showCancelButton: false,
	                            showConfirmButton: false
	                        })
	                    }
	                });
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