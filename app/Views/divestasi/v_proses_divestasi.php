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




		.timeline {
	      position: relative;
	      margin: 0;
	      padding: 0;
	      list-style: none;
	    }

	    .timeline-item {
	      margin-bottom: 10px;
	      position: relative;
	    }

	    .timeline-item::before {
	      content: '';
	      position: absolute;
	      top: 0;
	      left: 15px;
	      width: 10px;
	      height: 10px;
	      background-color: #007bff;
	      border-radius: 50%;
	      z-index: 1;
	    }

	    .timeline-item .timeline-content {
	      margin-left: 20px;
	      padding: 5px 10px;
	      background-color: #f8f9fa;
	      border: 1px solid #ddd;
	      border-radius: 5px;
	    }

	    .timeline-item .timeline-date {
	      font-size: 12px;
	      color: #007bff;
	    }

	    .timeline-item .timeline-title {
	      margin: 0;
	      font-size: 14px;
	      font-weight: bold;
	    }

	    .timeline-item .timeline-description {
	      margin: 3px 0 0;
	      font-size: 14px;
	    }
    </style>

    <style>
        /* Custom switch style for Bootstrap 4 */
        .custom-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
        }
        .custom-switch input {
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
            transition: .4s;
            border-radius: 25px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #28a745;
        }
        input:checked + .slider:before {
            transform: translateX(24px);
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
					                        ID DIVESTASI : dives-<?php echo uniqid();?>
					                        <span>
					                        			<?php 
												    	if($divestasi_data->metode==''){
												    		echo '<button class="form-control btn btn-success" onclick="saveDivestasi('.$divestasi_data->id_divestasi.')">Registrasi</button>';
												    	}else{
												    		echo '<button class="form-control btn btn-warning" onclick="saveDivestasi('.$divestasi_data->id_divestasi.')">Update</button>';
												    	}?>
											</span>

					                    </div>
					                    <div class="card-body" style="background:#dcdcdc">
					                        <div class="row mb-3">
					                            <div class="col-md-12 form-group d-flex align-items-center">
					                            	<div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1">Nama Objek Divestasi</label>
											            <span class="flex-grow-1 me-2">
													        <input type="input" id="objekDivestasi" value="<?= ($divestasi_data->objek_divestasi)?>" class="form-control">
													    </span>
											        </div>

											        <div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1">Jenis</label>
											            <span class="flex-grow-1 me-2">
													        <select class="form-control" id="jenis_rkap">
																<option value="RKAP" <?= ($divestasi_data->jenis_rkap == "RKAP") ? "selected" : "" ?>>RKAP</option>
																<option value="Non RKAP" <?= ($divestasi_data->jenis_rkap == "Non RKAP") ? "selected" : "" ?>>Non RKAP</option>
						
													        </select>
													    </span>
											        </div>

											        <div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1">Lokasi (Regional)</label>
											            <span class="flex-grow-1 me-2">
													        <select class="form-control" id="lokasi_objek_divestasi">
													        	<?php foreach ($region as $reg) {
											                        $selected='';
											                        if($divestasi_data->lokasi_objek_divestasi==$reg['master_region_kode']) $selected="selected";

											                        if($kode_region=='ADM' or $kode_region=='HO' or $kode_region==$reg['master_region_kode']){
											                           echo '<option '.$selected.' value="'.$reg['master_region_kode'].'">'.$reg['master_region_nama'].'</option>';
											                        }
											                        
											                        //echo '<option '.$selected.' value="'.$reg['master_region_kode'].'">'.$reg['master_region_nama'].'</option>';
											                      }; ?>
																<!-- <option value="RK01" <?= ($divestasi_data->lokasi_objek_divestasi == "RK01") ? "selected" : "" ?>>PTPN 1 Regional 1</option>
													        	<option value="RK02" <?= ($divestasi_data->lokasi_objek_divestasi == "RK02") ? "selected" : "" ?>>PTPN 1 Regional 2 </option> -->
													        </select>
													    </span>
											        </div>
												</div>
					                        </div>


					                        <div class="row mb-3">
					                            <div class="col-md-12 form-group d-flex align-items-center">
					                        		<div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1">Start</label>
											            <span class="flex-grow-1 me-2">
												        	<input type="date" id="startDate" value="<?= ($divestasi_data->start_date)?>" class="form-control dateDefault">
													    </span>
											        </div>

											        <div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1">Target Selesai</label>
											            <span class="flex-grow-1 me-2">
												        	<input type="date" id="targetDate" value="<?= ($divestasi_data->target_date)?>" class="form-control dateDefault">
													    </span>
											        </div>

											        <div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1">Pilih Metode Divestasi</label>
											             <select class="form-control" id="metode_tahapan">
												            <option value="1" <?= ($divestasi_data->metode=='1')?"selected":''?>> Mekanisme Pengadaan Tanah Skala Besar</option>
												            <option value="2" <?= ($divestasi_data->metode=='2')?"selected":''?>>Mekanisme Pengadaan Tanah Skala Kecil</option>
												            <option value="3" <?= ($divestasi_data->metode=='3')?"selected":''?>>Mekanisme Penjualan / Penunjukan Langsung</option>
												            <option value="9" <?= ($divestasi_data->metode=='9')?"selected":''?>>Cancel Proses Divestasi</option>
												        </select>
												        
											        </div>
												</div>
					                        </div>

					                        <?php 
					                        // echo "<pre>";
					                        // var_dump(json_decode($divestasi_data->nilai_buku_aset));

					                        // echo "</pre>";?>
					                        <div class="row mb-3 multiple_aset">
											    <div class="col-md-12 form-group d-flex align-items-center">
											        <div class="me-2 col-md-3 form-group">
											            <label for="objekDivestasi1">Data SAP</label>
											            <span class="flex-grow-1 me-2 optionAset">
													    	<select  id="selectAset0" multiple="multiple" class="form-control selectAset"></select>
													    </span>
											        </div>
											        <div class="me-2 col-md-2 form-group">
											            <label for="jenis_aset">Jenis Aset</label>
											             <select class="form-control jenis_aset">
													        <option value="" <?= (json_decode($divestasi_data->jenis_aset)[0]=='')?"selected":''?>>--Pilih Jenis--</option>
												            <option value="tanah" <?= (json_decode($divestasi_data->jenis_aset)[0]=='tanah')?"selected":''?>>Tanah</option>
												            <option value="bangunan" <?= (json_decode($divestasi_data->jenis_aset)[0]=='bangunan')?"selected":''?>>Bangunan</option>
												            <option value="tanaman" <?= (json_decode($divestasi_data->jenis_aset)[0]=='tanaman')?"selected":''?>>Tanaman</option>
												            <option value="lainnya" <?= (json_decode($divestasi_data->jenis_aset)[0]=='lainnya')?"selected":''?>>Lainnya</option>
												        </select>
											        </div>
											        <div class="me-1 col-md-1 form-group">
											            <label for="objekDivestasi2">Jumlah</label>
											            <input type="text" value="<?= json_decode($divestasi_data->jumlah_aset)[0] ?>" class="form-control jumlahAset" placeholder="">
											            <span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Satuan: <input class="satuanAset" style="width:50px" type='text' value="<?= (json_decode($divestasi_data->satuan_aset)[0])??'Meter' ?>"/></span>
											        </div>
											        

											        <div class="col-md-2 form-group ">
												    	<label for="objekDivestasi">Nilai Buku</label>
												    	<input type="text" value="<?= json_decode($divestasi_data->nilai_buku_aset)[0] ?>" class="form-control me-2 nilaiBukuAset" placeholder="Rp. ">
												    		<span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Tgl. Nilai: <input class="tgl_nilai_buku" type='date' value='<?= (json_decode($divestasi_data->tgl_nilai_buku)[0])?? date('Y-m-d'); ?>' /></span>

												    </div>

												    <div class="me-2 col-md-2 form-group">
											            <label for="objekDivestasi">Nilai NJOP</label>
											            <div class="d-flex align-items-center">
												            <input type="text" value="<?= json_decode($divestasi_data->nilai_njop)[0] ?>" class="form-control nilai_njop" placeholder="Rp. ">
													    </div>
												    		<span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Tgl. NJOP: <input class="tgl_njop"  type='date' value='<?= (json_decode($divestasi_data->tgl_njop)[0])?? date('Y-m-d'); ?>' /></span>
											        </div>

											        <div class="me-2 col-md-2 form-group">
											            <label for="objekDivestasi">Nilai KJPP</label>
											            <div class="d-flex align-items-center">
												            <input type="text" value="<?= json_decode($divestasi_data->nilai_kjpp)[0] ?>" class="form-control nilai_kjpp" placeholder="Rp. ">
												            <button class="btn btn-success btn-sm btn-add-aset" data-id="1" onclick="add_aset(this)"><i class="fa fa-plus"></i></button>
												            <button class="btn btn-danger btn-sm btn-add-aset" data-id="1" onclick="delete_aset(this)"><i class="fa fa-minus"></i></button>
													    </div>
												    		<span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Tgl. Penilaian:<input class="tgl_kjpp" type='date' value='<?= (json_decode($divestasi_data->tgl_kjpp)[0])?? date('Y-m-d'); ?>' /></span>
											        </div>
											        
											    </div>
											</div>

					                        <?php 
					                        $i=0;

					                        $total_luas = 0;
											$total_nilai_buku = 0;
											$total_nilai_njop = 0;
											$total_nilai_kjpp = 0;

					                        
											if(isset($divestasi_data->id_maia_masterlists)){
					                        foreach(json_decode($divestasi_data->id_maia_masterlists) as $asets){ 
					                        	if($i==0){
					                        		$total_luas=json_decode($divestasi_data->luas_aset)[0];
							                        $total_nilai_buku=json_decode($divestasi_data->nilai_buku_aset)[0];
							                        $total_nilai_njop=json_decode($divestasi_data->nilai_njop)[0];
							                        $total_nilai_kjpp=json_decode($divestasi_data->nilai_kjpp)[0];

					                        		$i++;
					                        		continue;
					                        	}
					                        

					                        	$luas_list        = json_decode($divestasi_data->luas_aset, true);
												$nilai_buku_list  = json_decode($divestasi_data->nilai_buku_aset, true);
												$nilai_njop_list  = json_decode($divestasi_data->nilai_njop, true);
												$nilai_kjpp_list  = json_decode($divestasi_data->nilai_kjpp, true);

												$luas_aset_       = floatval($luas_list[$i] ?? 0);
												$nilai_buku_aset_ = floatval($nilai_buku_list[$i] ?? 0);
												$nilai_njop_aset_ = floatval($nilai_njop_list[$i] ?? 0);
												$nilai_kjpp_aset_ = floatval($nilai_kjpp_list[$i] ?? 0);

												$total_luas       += $luas_aset_;
												$total_nilai_buku += $nilai_buku_aset_;
												$total_nilai_njop += $nilai_njop_aset_;
												$total_nilai_kjpp += $nilai_kjpp_aset_;

					                        ?>
					                        	<div class="row mb-3 multiple_aset">
												    <div class="col-md-12 form-group d-flex align-items-center">
												        <div class="me-2 col-md-3 form-group">
												            <label for="objekDivestasi1">Data SAP</label>
												            <span class="flex-grow-1 me-2 optionAset">
														    	<select id="selectAset<?= $i?>"  name="asets" multiple="multiple" class="form-control selectAset"></select>
														    </span>
												        </div>
												        <div class="me-2 col-md-2 form-group">
												            <label for="jenis_aset">Jenis Aset</label>
												             <select class="form-control jenis_aset">
													            <option value="" <?= (json_decode($divestasi_data->jenis_aset)[$i]=='')?"selected":''?>>--Pilih Jenis--</option>
													            <option value="tanah" <?= (json_decode($divestasi_data->jenis_aset)[$i]=='tanah')?"selected":''?>>Tanah</option>
													            <option value="bangunan" <?= (json_decode($divestasi_data->jenis_aset)[$i]=='bangunan')?"selected":''?>>Bangunan</option>
													            <option value="tanaman" <?= (json_decode($divestasi_data->jenis_aset)[$i]=='tanaman')?"selected":''?>>Tanaman</option>
													            <option value="lainnya" <?= (json_decode($divestasi_data->jenis_aset)[$i]=='lainnya')?"selected":''?>>Lainnya</option>
													        </select>
											        	</div>
												        <div class="me-1 col-md-1 form-group">
												            <label for="objekDivestasi2">Jumlah</label>
												            <input type="text" value="<?= json_decode($divestasi_data->jumlah_aset)[$i] ?>" class="form-control jumlahAset" placeholder="">
											            <span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Satuan: <input class="satuanAset" style="width:50px" type='text' value="<?= (json_decode($divestasi_data->satuan_aset)[$i])??'Meter' ?>"/></span>
												        </div>

												        <div class="col-md-2 form-group ">
													    	<label for="objekDivestasi">Nilai Buku</label>
													    	<input type="text" value="<?= json_decode($divestasi_data->nilai_buku_aset)[$i] ?>" class="form-control me-2 nilaiBukuAset" placeholder="Rp. ">
												    		<span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Tgl. Nilai: <input class="tgl_nilai_buku" type='date' value='<?= (json_decode($divestasi_data->tgl_nilai_buku)[$i])?? date('Y-m-d'); ?>' /></span>
													    </div>
													<div class="me-2 col-md-2 form-group">
											            <label for="objekDivestasi">Nilai NJOP</label>
											            <div class="d-flex align-items-center">
												            <input type="text" value="<?= json_decode($divestasi_data->nilai_njop)[$i] ?>" class="form-control nilai_njop" placeholder="Rp. ">
													    </div>
												    		<span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Tgl. NJOP: <input class="tgl_njop"  type='date' value='<?= (json_decode($divestasi_data->tgl_njop)[$i])?? date('Y-m-d'); ?>' /></span>
											        </div>

											        <div class="me-2 col-md-2 form-group">
												            <label for="objekDivestasi">Nilai KJPP</label>
												            <div class="d-flex align-items-center">
													            <input type="text" value="<?= json_decode($divestasi_data->nilai_kjpp)[$i] ?>" class="form-control nilai_kjpp" placeholder="Rp. ">
													            <button class="btn btn-success btn-sm btn-add-aset" data-id="<?= $i+1?>" onclick="add_aset(this)"><i class="fa fa-plus"></i></button>
												            	<button class="btn btn-danger btn-sm btn-add-aset" data-id="<?= $i+1?>" onclick="delete_aset(this)"><i class="fa fa-minus"></i></button>
													            <br>
														    </div>
												    		<span style="text-align:right; font-size: 9px; display: flow; padding: 0;" class="btn btn-xs btn-primary">Tgl. Penilaian:<input class="tgl_kjpp" type='date' value='<?= (json_decode($divestasi_data->tgl_kjpp)[$i])?? date('Y-m-d'); ?>' /></span>
												        </div>
												        
												    </div>
												</div>

					                        <?php $i++;}
					                    }?>

					                        


											 <div class="row mb-3">
					                            <div class="col-md-12 form-group d-flex align-items-center">
					                            	<div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1"></label>
											            <span class="flex-grow-1 me-2">
													    </span>
											        </div>

											        <div class="me-2 col-md-1 form-group">
												            
											        </div>

											        <div class="me-1 col-md-1 form-group">
											           
											        </div>


											        <div class="me-2 col-md-2 form-group">
											            <label for="objekDivestasi1">Total Nilai Buku (Rp)</label>
											            <span class="flex-grow-1 me-2">
												        	<input type="input" id="nilaiBukuDivestasi" readonly value="<?= ($total_nilai_buku)?>" class="form-control formatNilaiBuku">
													    </span>
											        </div>

											        <div class="me-2 col-md-2 form-group">
											            <label for="objekDivestasi1">Total Nilai NJOP</label>
											            <span class="flex-grow-1 me-2">
												        	<input type="input" id="nilaiObjekDivestasi" readonly value="<?= ($total_nilai_njop)?>" class="form-control formatNilaiObjek">
													    </span>
											        </div>


											        <div class="me-2 col-md-2 form-group">
											            <label for="objekDivestasi1">Total Nilai KJPP</label>
											            <span class="flex-grow-1 me-2">
												        	<input type="input" id="nilaiObjekDivestasi" readonly value="<?= ($total_nilai_kjpp)?>" class="form-control formatNilaiObjek">
													    </span>
											        </div>

											        
												</div>
					                        </div>

					                    

					                        <div class="row mb-3">
					                            <div class="col-md-12 form-group d-flex align-items-center">
					                            	<div class="me-2 col-md-5 form-group">
											            <label for="objekDivestasi1"></label>
											            <span class="flex-grow-1 me-2">
													    </span>
											        </div>
											        <div class="me-2 col-md-4 form-group">
											            <label for="objekDivestasi1"></label>
											            <span class="flex-grow-1 me-2">
											            	<h3>TOTAL REALISASI PEMBAYARAN:</h3>
													    </span>
											        </div>
											        


											        <div class="me-2 col-md-3 form-group">
											            <span class="flex-grow-1 me-2" style="text-align: right; display: flow;">
											            	<h1>Rp. <?= number_format($divestasi_data->realisasi_pembayaran)?></h1>
													    </span>
											        </div>
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
													$active ='';
													$_GET['tab'] = $_GET['tab'] ?? null;
													if(session()->getFlashdata('tab')!=null or $_GET['tab']!=null){
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
								                            UPLOAD & PROGRESS
								                        </a>

								                        <?php $pathFile='uploads/' . $divestasi_data->id_divestasi.'/';?>
								                    </li>
								                    
								                </ul>


								                <!-- Progress Tab -->
								                <div class="tab-content mt-3" id="assetDetailTabContent">
								                	
								                	<!-- Progress Tab -->
								                    <div class="tab-pane fade <?= ($active=='')?'active show':''?>" id="history" role="tabpanel" aria-labelledby="history-tab">
								                        <div class="container mt-5">
													     	<h3 class="">Progress Divestasi : <?= isset($divestasi_data) && is_object($divestasi_data) ? $divestasi_data->objek_divestasi : '' ?></h3>
													    </div>

													     <div class="container mt-4">

															        <div class="row">
															            <!-- First Card -->
															            <div class="col-md-3">
															                <div class="card">
															                	<div class="progress-circle"  style="background: conic-gradient(#007bff 0% <?= $progress_divestasi['persen'][$divestasi_data->id_divestasi]?>%, #e9ecef <?= $progress_divestasi['persen'][$divestasi_data->id_divestasi]?>% 100%)";>
																		            <div class="inner-circle">
																		                <div class="progress-label"><?= $progress_divestasi['persen'][$divestasi_data->id_divestasi]?>%</div>
																		            </div>
																		        </div>

																		        <table class="table table-bordered">
															                            <tbody>
															                                <tr>
															                                    <td><strong>Start Project</strong></td>
															                                    <td><?= ($divestasi_data->start_date)?></td>
															                                </tr>
															                                <tr>
															                                    <td><strong>Target Selesai</strong></td>
															                                    <td><?= ($divestasi_data->target_date)?></td>
															                                </tr>
															                            </tbody>
															                        </table>
															                    
															                </div>
															            </div>
															            <!-- Second Card -->
															            <div class="col-md-9">
															                		
															                        <h4>Riwayat & Progress</h4>
																				    <ul class="timeline">
																				      <?php
																				      		//var_dump($divestasi_log);

																				      		$status_['']='';
																				      		$status_['approve']="<span class='btn btn-xs btn-success'>Approve</span>";
																				      		$status_['reject']="<span class='btn btn-xs btn-warning'>Reject</span>";

																				      		foreach($divestasi_log as $d){
																				      			$d = (object) $d;
																				      			$status="";
																				      			if($d->start_log!=""){
																				      				$color="btn-success";
																				      				if(strtolower($d->status)=='close'){
																				      					$color="btn-default";
																				      					$status='<span class="timeline-text btn btn-xs '.$color.'">'.$d->status.' : '.date('d-m-Y',strtotime($d->created_at)).'</span>';
																				      				}else{
																				      					$status='<span class="timeline-text btn btn-xs '.$color.'">'.$d->status.' : '.date('d-m-Y',strtotime($d->start_log)).' s/d '.date('d-m-Y',strtotime($d->target_log)).'</span>';
																				      				}
																				      			}


																				      			$dokumen='';
																				      			if($d->file_name!="")$dokumen='<a href="#">Upload dokumen : '.$d->file_name.'</a>';
																				      			echo '<li class="timeline-item">
																							        <div class="timeline-content">
																							          '.$status.'
																							          <span class="timeline-date d-flex justify-content-end">'.$d->created_at.'</span>
																							          
																							          <h5 class="timeline-title">'.$d->kategori.'</h5>
																							          '.$dokumen.'
																										<span class="timeline-date d-flex justify-content-end">'.$status_[strtolower($d->approval_status)].'<br><p style="font-size:8px">'.$d->approval_date.'</p></span>																							        </div>

																							      </li>';
																				      		}

																				      ?>																				      
																				    </ul>
															                    
															            </div>
															        </div>
															    </div>

								                    </div>


								                    <!-- Upload Dokumen Tab -->
								                    <div class="tab-pane fade <?= ($active!='')?'active show':''?>" id="upload" role="tabpanel" aria-labelledby="upload-tab">
								                    	Tahapan Sedang Berlangsung:
								                		<h3> <?= $divestasi_data->current_status?></h3>
								                        <div id="accordion">
							                        	<?php 

							                        		$i=0;
							                        		$alphabet = range('A', 'Z');
							                        		$except_tahapan_array = explode(',', $divestasi_data->except_tahapan);

							                        		$color_nav['R']="#43849e";
							                        		$color_nav['P']="#767474";
							                        		$color_nav['H']="#38533e";
							                        		$color_nav['']="green";
							                        		foreach($tahapan_divestasi['tahapan'] as $id_tahapan=>$tahapan){
							                        			$checked="checked";
							                        			if (in_array($id_tahapan, $except_tahapan_array)) {
															        $checked = "";
															    }

															    $disabled_admin="";
															    if(session()->get('role_id')!=20){
																	$disabled_admin="disabled";			         
																}
							                        			?>
							                    				<!-- Item  -->
															    <div class="card">
															        <div class="card-header btn btn-link text-left" 
															        	style="background:<?= $color_nav[$tahapan_divestasi['group_tahapan'][$id_tahapan]]?>"

															        	data-toggle="collapse" data-target="#collapse<?=$id_tahapan?>" aria-expanded="true" aria-controls="collapse<?=$id_tahapan?>" id="heading<?=$id_tahapan?>">
															        	<?php echo $alphabet[$i].". ".$tahapan?>


															             <span class="progress-indicator"><?php echo '<a href="#" class="btn '.(($progress_tahapan[$id_tahapan]>=100)?"btn-success":"btn-warning").'">'.$progress_tahapan[$id_tahapan].'%</a>';?></span>
															             <input type="checkbox" <?= $disabled_admin;?> <?= $checked ?> class="exception_thp" onchange="except_add()" data-thp="<?= $id_tahapan?>"></input>
															        </div>
															        <div id="collapse<?=$id_tahapan?>" class="collapse <?= ($divestasi_data->current_status==$tahapan)?'show':''?>" aria-labelledby="heading<?=$id_tahapan?>" data-parent="#accordion">
															            <div class="card-body">
															            	<div class="row">
															            		<div class="col-4">
																	                <div class="form-control" style="background:#aaaaaa">
																	                	<form action="<?php echo base_url()?>/C_divestasi/upload" method="post" enctype="multipart/form-data">
																	                		<input type="hidden" name="id_divestasi" value="<?php echo $divestasi_data->id_divestasi?>" />
																	                		<input type="hidden" name="objek_divestasi" value="<?php echo $divestasi_data->objek_divestasi?>" />
																	                		<input type="hidden" name="tahapan" value=<?= $id_tahapan?> />
																	                		<input type="hidden" name="tahapan_label" value=<?= $tahapan?> />
																						    <div class="form-group">
																						        <label for="file-group">Group File</label>
																						        <select class="form-control" data="<?= $id_tahapan?>" onchange="cekOption(this)" id="file-group<?= $id_tahapan?>" name="file_group" required>
																						            <option value="">-- Pilih Jenis Dokumen --</option>
																						            <?php 
																						        	foreach($tahapan_divestasi['dokumen'][$id_tahapan] as $label){
																						        		$optional='*';
																						        		// var_dump($tahapan_divestasi['optional'][$id_tahapan][$label]);
																						        		if($tahapan_divestasi['optional'][$id_tahapan][$label]=='o')$optional='';
																						        		echo '<option value="'.$label.'">'.$label.' '.$optional.'</option>';
																						        	}
																						        	?>
																						        	<option value="-->">Dokumen Lainnya</option>
																						        </select>
																						        <input type="text" id="file-add<?= $id_tahapan?>" name="file_add" style="display: none;" placeholder="--input nama dokumen--" class="form-control" />
																						    </div>
																						    <div class="form-group">
																						        <label for="file-awal">File</label>
																						        <input type="file" id="file-awal<?= $id_tahapan?>" name="file_upload" class="form-control" required />
																						    </div>
																						    
																						    <select class="form-control" id="file-status<?= $id_tahapan?>" name="file_status" style="display: none;">
																						            <option value="">-- Status Dokumen --</option>
																						            <option value="draft">Draft</option>
																						            <option value="final">Final</option>
																						            <option value="ttd">Ditandatangani</option>
																						        	?>
																						        </select>

																						    <div class="form-group" id="input_bayar-<?= $id_tahapan?>" style="display: none;">
																						        <label for="nominal">Jumlah Bayar</label><input type="number" placeholder="Rp." id="nominal_bayar-<?= $id_tahapan?>" name="nominal_bayar" class="form-control" />
																						    </div>

																						    <button type="submit" class="btn btn-success" <?= ($divestasi_data->current_status!=$tahapan)?'':''?>>Upload</button>
																						</form>
																	                	
																	                </div>
																	            </div>

																	            <div class="col-8">
																	            	<div class="container mt-4">
																	            		<div class="d-flex align-items-center">
																	            			<?php 
																							if (!is_object($divestasi_data)) {
																							    $divestasi_data = new stdClass(); // Membuat objek kosong
																							}
																	            			if($divestasi_data->current_start_log=='')$divestasi_data->current_start_log=date('Y-m-d');
																	            			if($divestasi_data->current_target_log=='')$divestasi_data->current_target_log=date('Y-m-d');

																	            			?>
																	            			Start Date <input type="date" id="start_log-<?= $i?>" value="<?= date('Y-m-d',strtotime($divestasi_data->current_start_log))?>" class="dateDefault"/> s/d <input type="date" id="target_log-<?= $i?>" value="<?= date('Y-m-d',strtotime($divestasi_data->current_target_log))?>" class="dateDefault"/>
																	            			<!-- <input type="text" value="30" placeholder="lead Time" style="width:50px" /> Hari-->
																				            <!-- Custom Switch -->
																				             &nbsp<label class="custom-switch">
																				             	<?php
																				             		$disabled="disabled";
																				             		if(session()->get('region_id')==99){
																				             			?>
																				             			<input type="checkbox" id="statusSwitch-<?= $i?>" <?= ($divestasi_data->current_status==$tahapan)?'checked':''?> onchange="toggleStatus('<?=$divestasi_data->id_divestasi?>','<?= $tahapan?>',<?= $i?>)">
																				                		<span class="slider"></span>
																				             		<?php } ?>
																				                
																				            </label>
																				            <span class="ml-3" id="statusLabel-<?= $i?>">Status: <?= ($divestasi_data->current_status==$tahapan)?'<b class="btn-success">Open</b>':'Close'?></span>
																				        </div>
																				    </div>
																	                <!-- Tabel -->
																				        <table class="table table-bordered table-responsive">
																				            <thead class="thead-grey">
																				                <tr>
																				                    <th>File</th>
																				                    <th>Kategori Dokumen</th>
																				                    <th>Status</th>
																				                    <th>Keterangan</th>
																				                    <th class="text-center">Aksi</th>
																				                </tr>
																				            </thead>
																				            <tbody>
																				                <?php if (!empty($files)): ?>
																				                    <?php
																				                    $color=array();
																		                    		$color['approve']="btn-success";
																		                    		$color['reject'] ="btn-warning"; 
																		                    		$color['']= "btn-primary";

																				                    foreach ($files as $key => $file){ 

																				                    	foreach ($files as $key => $defaultValue) {
																										    if (!isset($file[$key])) {
																										        $file[$key] = '';//$defaultValue;
																										    }
																										}



																				                    	if($file['tahapan']!=$id_tahapan)continue; ?>
																				                        <tr>
																				                            <td><?= $file['file_name']; ?><br><center style="font-size: 8px"><?= $file['created_at']; ?></center></td>
																				                            <td><?= $file['kategori']; ?><br><?= $file['nominal']; ?></td>
																				                            <td>
																				                            	<center class="<?= $color[$file['approval_status']]; ?>"><?= $file['approval_status']; ?>
																				                            	</center><br>
																				                            	<center style="font-size: 8px"><?= $file['approval_date']; ?></center>
																				                            </td>
																				                            <td><?= $file['keterangan']; ?></td>
																				                            <td>
																				                                <a href="<?= base_url($pathFile.$file['file_name']); ?>" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-eye"> View</i></a>

																				                                <?php if(session()->get('region_id')==99){?>
																				                                <a href="javascript:void(0)" data="<?= $file['id_log_divestasi'] ?>" class="btn btn-success btn-sm approve-btn"><i class="fa fa-check"> Approve</i></a>
																				                                <a href="javascript:void(0)" data="<?= $file['id_log_divestasi'] ?>" class="btn btn-warning btn-sm reject-btn"><i class="fa fa-ban"> Reject</i></a>
																				                                <?php }?>

																				                                <?php if($file['approval_status']!='approve'){?>
																				                                <a href="javascript:void(0)" data="<?= $file['id_log_divestasi'] ?>" class="btn btn-danger btn-sm delete-btn"><i class="fa fa-trash"> Delete</i></a>
																				                                <?php }?>
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

									                		<?php $i++; }?>
															   
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





						<!-- Modal untuk mengedit tooltip -->
						<div class="modal fade" id="modal_action" tabindex="-1" aria-labelledby="tooltipModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <form id="tooltipForm">
						                <div class="modal-header">
						                    <h5 class="modal-title" id="tooltipModalLabel"></h5>
						                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                        <span aria-hidden="true">&times;</span>
						                    </button>
						                </div>
						                <div class="modal-body">
						                    <div class="form-group">
						                        <textarea class="form-control" id="keterangan_log" placeholder="keterangan"></textarea>
						                    </div>
						                </div>
						                <div class="modal-footer">
						                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						                    <button class="btn btn-primary ok-btn">Ok</button>
						                </div>
						            </form>
						        </div>
						    </div>
						</div>



            <script>

                function saveDivestasi(id){
                	let data ={};
                	data['id_divestasi']			= id;
                	data['objek_divestasi'] 		= $("#objekDivestasi").val();
                	data['jenis_rkap']				= $("#jenis_rkap").val();
                	data['lokasi_objek_divestasi']	= $("#lokasi_objek_divestasi").val();
                	data['start_date'] 				= $("#startDate").val();
                	data['target_date'] 			= $("#targetDate").val();
                	data['metode']     				= $("#metode_tahapan :selected").val();

                	// Simpan nilai aset ke dalam array
					$(".selectAset").each(function(){
						if(data['assets']==undefined){data['assets']=[]}
					    data['assets'].push($(this).val());
					});


					$(".jenis_aset").each(function(){
						if(data['jenis_aset']==undefined){data['jenis_aset']=[]}
						if($(this).val()=='')$(this).val(0);
						data['jenis_aset'].push($(this).val());
					});

					$(".jumlahAset").each(function(){
						if(data['jumlah_aset']==undefined){data['jumlah_aset']=[]}
						if($(this).val()=='')$(this).val(0);
						data['jumlah_aset'].push($(this).val());
					});

					$(".satuanAset").each(function(){
						if(data['satuan_aset']==undefined){data['satuan_aset']=[]}
						if($(this).val()=='')$(this).val(0);
						data['satuan_aset'].push($(this).val());
					});

					$(".nilaiBukuAset").each(function(){
						if(data['nilai_buku_aset']==undefined){data['nilai_buku_aset']=[]}
						if($(this).val()=='')$(this).val(0);
						data['nilai_buku_aset'].push($(this).val());
					});

					$(".tgl_nilai_buku").each(function(){
						if(data['tgl_nilai_buku']==undefined){data['tgl_nilai_buku']=[]}
						if($(this).val()=='')$(this).val(0);
						data['tgl_nilai_buku'].push($(this).val());
					});

					$(".nilai_njop").each(function(){
						if(data['nilai_njop']==undefined){data['nilai_njop']=[]}
						if($(this).val()=='')$(this).val(0);
						data['nilai_njop'].push($(this).val());
					});

					$(".tgl_njop").each(function(){
						if(data['tgl_njop']==undefined){data['tgl_njop']=[]}
						if($(this).val()=='')$(this).val(0);
						data['tgl_njop'].push($(this).val());
					});

					$(".nilai_kjpp").each(function(){
						if(data['nilai_kjpp']==undefined){data['nilai_kjpp']=[]}
						if($(this).val()=='')$(this).val(0);
						data['nilai_kjpp'].push($(this).val());
					});

					$(".tgl_kjpp").each(function(){
						if(data['tgl_kjpp']==undefined){data['tgl_kjpp']=[]}
						if($(this).val()=='')$(this).val(0);
						data['tgl_kjpp'].push($(this).val());
					});

                	
                	
                	// data['luas_objek_divestasi'] 	= AutoNumeric.getAutoNumericElement("#luasObjekDivestasi").getNumericString();
                	// data['nilai_objek_divestasi'] 	= AutoNumeric.getAutoNumericElement("#nilaiObjekDivestasi").getNumericString();
                	// data['nilai_buku_divestasi'] 	= AutoNumeric.getAutoNumericElement("#nilaiBukuDivestasi").getNumericString();
                	// data['nilai_realisasi_divestasi']= AutoNumeric.getAutoNumericElement("#nilaiRealisasiDivestasi").getNumericString();
                	

                	// data['assets'] 				 	=[];
                	// data['nilai_buku_aset']			=[];
                	// data['nilai_objek_aset']		=[];
                	// data['luas_aset']				=[];


					

					// // Pastikan jumlah elemen sama dan gunakan indeks yang sama
					// // $(".nilaiBukuAset").each(function(index){
					// //     if (data['assets'][index] !== undefined) {
					// //         data['nilai_buku_aset'].push({
					// //             id: data['assets'][index], // Ambil dari assets
					// //             nilai: $(this).val() // Ambil nilai buku aset
					// //         });
					// //     }
					// // });

					// // $(".selectAset").each(function(){
					// // 	data['assets'].push($(this).val());
					// // });


					// $(".nilaiBukuAset").each(function(){
					// 	data['nilai_buku_aset'].push($(this).val());
					// });

					// $(".nilaiObjekAset").each(function(){
					// 	data['nilai_objek_aset'].push($(this).val());
					// });

					// $(".luasAset").each(function(){
					// 	data['luas_aset'].push($(this).val());
					// });


					let semuaTerisi = data['assets'].every(d => d.length > 0);

					if (!semuaTerisi) {
					  alert('Harap lengkapi penginputan data!');
					  return;
					}

					


                	$.ajax({
	                    method: "post",
	                    url: "<?= base_url() ?>/C_divestasi/save",
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
	                        if(resp.id_divestasi>0)window.location.href = "<?= base_url('C_divestasi') ?>/proses/"+resp.id_divestasi;
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
            <script>
		        function toggleStatus(id_divestasi,tahapan,i) {
			        		const switchInput = document.getElementById('statusSwitch-'+i);
				            const statusLabel = document.getElementById('statusLabel-'+i);
				            let data={};
				            data['id_divestasi'] 		=id_divestasi;
				            data['start_log']		   = document.getElementById('start_log-'+i).value;
				            data['target_log']		   = document.getElementById('target_log-'+i).value;
				            data['objek_divestasi']	   = document.getElementById('objekDivestasi').value;
				            data['tahapan']			   = tahapan;

				            if (switchInput.checked) {
				            	statusLabel.textContent = 'Status: Open';
				            	data['status']			= 'Open';
				            } else {
				                statusLabel.textContent = 'Status: Close';
				            	data['status']			= 'Close';
				            }
				            
				            insert_data_log(data);
			    }

		        function insert_data_log(data){
		        	$.ajax({
	                    method: "post",
	                    url: "<?= base_url() ?>/C_divestasi/save_log",
	                    data: data,
	                    cache: false,
	                    dataType: "json",
	                    success: function(resp) {
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

		       

		        function cekOption(that){
		        	var opt = $(that).val();
		        	var id  = $(that).attr("data");
		        	$("#file-add"+id).hide();
		        	if(opt=="-->"){
		        		$("#file-add"+id).show();
		        	}

		        	if(opt=="BA dan Bukti Pembayaran"){
		        		$("#input_bayar-"+id).show();
		        	}
		        }
		    </script>

		    <script type="text/javascript">
            $(document).ready(function() {
		    	 	
				    // $('.selectAset').select2({
					//     ajax: {
					//         url: '<?= base_url("C_divestasi/getAsetMaia") ?>',
					//         dataType: 'json', 
					//         delay: 250, 
					//         data: function(params) {
					//         	console.log
					//             return {
					//                 search: params.term
					//             };
					//         },
					//         processResults: function(data) {
					//             return {
					//                 results: data.items
					//             };
					//         }
					//     },
					//     placeholder: "Pilih aset...",
					//     language: {
					// 	    noResults: function () {
					// 	      return `
					// 	        <div style="display: flex; justify-content: space-between; align-items: center;">
					// 	          <span>Tidak ditemukan</span>
					// 	          <button type="button" class="btn-add-data" style="margin-left: 10px; color: blue; cursor: pointer;">Tambah Data</button>
					// 	        </div>
					// 	      `;
					// 	    }
					// 	  },
					// 	  escapeMarkup: function (markup) {
					// 	    return markup;
					// 	  }
					// });
            	            		console.log($('.selectAset').select2());

            	$('.selectAset').select2({
				    ajax: {
				        url: '<?= base_url("C_divestasi/getAsetMaia") ?>',
				        dataType: 'json',
				        delay: 250,
				        data: function(params) {
				            return {
				                search: params.term
				            };
				        },
				        processResults: function(data) {
				            return {
				                results: data.items
				            };
				        }
				    },
				    placeholder: "Pilih aset...",
				    "language": {
					       "noResults": function(){
					           return "No Results Found";
					       }
					   },
					    escapeMarkup: function (markup) {
					        return markup;
					    }
				});

				$(document).on('click', '.btn-add-data', function () {
				    // Misal buka modal atau redirect ke form tambah aset
				    // Contoh pakai modal Bootstrap
				    $('#modalTambahAset').modal('show');
				});



					//set selected value dari database
					let id_maia ='<?= ($divestasi_data->id_maia_masterlists)?>';
						            console.log(id_maia);
					if(id_maia!=''){
						$.ajax({
						    url: '<?= base_url("C_divestasi/getOptionAset") ?>', 
						    type: 'POST',
						    dataType: 'json', 
						    data: { 
						        id_maia_masterlists: '<?= ($divestasi_data->id_maia_masterlists)?>' 
						    },
						    success: function (data) {
						    	let i=0;
						            console.log(data);
						        data.items.forEach(function (item) {
						            var option = new Option(item.text, item.id, true, true);
						            $('#selectAset'+i).append(option).trigger('change');
						            i++;
						        });
						    },
						    error: function (xhr, status, error) {
						        console.error('Error fetching default values:', error);
						    }
						});
					}


					$(".approve-btn").on("click",function(){
						var id = $(this).attr('data');
						var data ={};
						data['id']=id;
						data['status']='approve';
						$(".ok-btn").data("data",data);

						$(".modal-title").html("Setujui Dokumen?");
						$("#modal_action").modal("show");
					});



					$(".reject-btn").on("click",function(){
						var id = $(this).attr('data');
						var data ={};
						data['id']=id;
						data['status']='reject';
						$(".ok-btn").data("data",data);

						$(".modal-title").html("Tolak Dokumen?");
						$("#modal_action").modal("show");
					});

					$(".delete-btn").on("click",function(){
						var id = $(this).attr('data');
						var data ={};
						data['id']=id;
						data['status']='delete';
						$(".ok-btn").data("data",data);

						$(".modal-title").html("Hapus Dokumen?");
						$("#modal_action").modal("show");
					});

					$(".ok-btn").on("click",function(event){
						event.preventDefault();
						let data_action=$(this).data("data");
						let data ={};
						data['id'] 			= data_action['id'];
						data['keterangan']	= $("#keterangan_log").val();
						data['status'] 	  	= data_action['status'];

						$.ajax({
		                    method: "post",
		                    url: "<?= base_url() ?>/C_divestasi/update_log",
		                    data: data,
		                    cache: false,
		                    dataType: "json",
		                    success: function(resp) {
		                        Swal.fire({
		                            icon: 'success',
		                            title: ' Berhasil !',
		                            timer: 2500,
		                            showCancelButton: false,
		                            showConfirmButton: false
		                        });

			            		const url = new URL(window.location.href);
								url.searchParams.set('tab', 'progress'); 

								window.history.pushState({}, '', url);
								window.location.href = url.toString();
		                    },
		                    error: function(xhr, status, error) {
		                    	$("#modal_action").modal("hide");
		                    	console.log(status);
		                    	console.log(error);
		                    	const url = new URL(window.location.href);
								url.searchParams.set('tab', 'progress'); 

								//window.history.pushState({}, '', url);
								//window.location.href = url.toString();
		                        // Swal.fire({
		                        //     icon: 'error',
		                        //     title: ' Gagal !',
		                        //     timer: 2500,
		                        //     showCancelButton: false,
		                        //     showConfirmButton: false
		                        // })
		                    }
		                });
					 })


			});


			function add_aset(that){
						let i = $(".btn-add-aset").length+1;
						let cloned = $(that).closest(".multiple_aset").clone();
						
						
						//cloned.find('input').val('');
						cloned.find('.optionAset').html('<select id="selectAset'+i+'" name="asets[]" multiple="multiple" class="form-control selectAset"></select>');
						let today = new Date().toISOString().split('T')[0];
						let data_date=cloned.find('input[type="date"]');
						data_date.each(function(d) {
						  	console.log($(this).val());
						});

						cloned.insertAfter($(that).closest(".multiple_aset"));
						cloned.find('.btn-add-aset').attr('data-id',i);

						$('.selectAset').select2({
						    ajax: {
						        url: '<?= base_url("C_divestasi/getAsetMaia") ?>',
						        dataType: 'json', 
						        delay: 250, 
						        data: function(params) {
						            return {
						                search: params.term
						            };
						        },
						        processResults: function(data) {
						            return {
						                results: data.items
						            };
						        }
						    },
						    placeholder: "Pilih aset...",
						});
	
			}

			function delete_aset(that){
				if (confirm('Yakin ingin menghapus data ini?')) {
			        $(that).closest(".multiple_aset").remove();
			    }
			}


		    </script>
		    <script type="text/javascript">
            	// Ambil semua elemen dengan class 'dateDefault'
				    const dateInputs = document.getElementsByClassName('dateDefault');

				    // Buat tanggal sekarang dalam format YYYY-MM-DD
				    const today = new Date();
				    const formattedDate = today.toISOString().split('T')[0]; 

				    // Iterasi melalui elemen-elemen tersebut dan tetapkan nilai default
				    Array.from(dateInputs).forEach(input => {
				    	if(input.value==="")input.value = formattedDate;
				    });



				    function except_add(){
				    	if(confirm("Tahapan ini akan di kecualikan dari perhitungan persentase?")){
				    		let data = [];
				    		$(".exception_thp").each(function (){
				    			if(!$(this).is(":checked")){
				    				data.push($(this).attr("data-thp"));
				    			}
				    			
				    		})

		    			    $.ajax({
							    url: '<?= base_url("C_divestasi/except_add")?>',
							    type: 'POST',
							    dataType: 'json',
							    data: { except_thp: data, id_divestasi: '<?= $divestasi_data->id_divestasi; ?>' }, // Ensure id_divestasi is sent
							    success: function(response) {
							        if (response.status === "success") {
							            const url = new URL(window.location.href);
										url.searchParams.set('tab', 'progress'); 

										window.history.pushState({}, '', url);
										window.location.href = url.toString();
							        } else {
							        	alert('Gagal, Terjadi kesalahan update data!');
							        	console.log(response);
							            console.error("Error:", response.message);
							        }
							    },
							    error: function(xhr, status, error) {
							        console.error("AJAX Error:", status, error);
							    }
							});
				    	}
				    }
            </script>

            <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
			<!-- <script>
			  new AutoNumeric('.formattedInput', {
			    digitGroupSeparator: ',',
			    decimalCharacter: '.',
			    decimalPlaces: 0
			  });

			   new AutoNumeric('.formatNilaiObjek', {
			    digitGroupSeparator: ',',
			    decimalCharacter: '.',
			    decimalPlaces: 0
			  });

			   new AutoNumeric('.formatNilaiBuku', {
			    digitGroupSeparator: ',',
			    decimalCharacter: '.',
			    decimalPlaces: 0
			  });

			   new AutoNumeric('.formatLuasObjek', {
			    digitGroupSeparator: ',',
			    decimalCharacter: '.',
			    decimalPlaces: 0
			  });
			</script> -->


            <?= $this->endSection(); ?>

            
            <!-- footer  -->
            <footer class="footer text-center">
                <!-- All Rights Reserved by PTPN XII. Designed and Developed by <a href="https://ptpn12.com">PTPN XII</a>. -->
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>