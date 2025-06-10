<?= $this->extend('layout/template')?>

<?= $this->section('content');?>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Verifikasi Mitra </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Verifikasi Mitra</li>
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
                                <div class="col-12 mb-3">
                                    
                                </div>
                                <table id="table" class="table table-striped table-bordered nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>Nama</th>
                                            <th>Jenis Mitra</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    
                                    <?php 
                                        $no = 1;
                                        foreach ($verif_mitra as $key => $value): ?>
                                        
                                        <?php $value->modal_type = $value->data_mitra_status !== null ? 'view' : 'edit' ?>
                                    
                                        <tr>
                                            <th><?= $no++ ?></th>
                                            <th><?= $value->data_mitra_nama ?></th>
                                            <th><?= $value->data_mitra_jenis ?></th>
                                            <th><?= $value->data_mitra_status === null 
                                                ? '<div class="badge-orange" 
                                                    style="padding: 2px 5px; display:inline">
                                                    Belum diverifikasi
                                                </div>' 
                                                : ($value->data_mitra_status === "1" 
                                                    ? "<span class='badge-success' 
                                                        style='padding: 2px 5px; display:inline'>
                                                        Sudah diverifikasi
                                                    </span>" 
                                                    : "<span class='badge-danger' 
                                                        style='padding: 2px 5px; display:inline'>
                                                        Verifikasi ditolak
                                                        </span>"
                                                ); 
                                                ?></th>
                                            <th>
                                                <button type="button" 
                                                    class="btn btn-secondary" 
                                                    onclick='edit(<?=json_encode($value)?>)' 
                                                    data-toggle="modal" 
                                                    data-target="#modal-edit"><?= $value->data_mitra_status === null ? 'Edit' : 'Lihat' ?></button>                                            </th>
                                        </tr>
                                        <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="edit">
                            <input type="text" id="mitra_id_edit" name="mitra_id_edit" hidden readonly />
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Edit Verifikasi Mitra</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="mitra_nama_edit" class="col-form-label">Nama Mitra:</label>
                                    <input type="text" class="form-control" name="mitra_nama_edit" id="mitra_nama_edit" readonly> 
                                </div>
                                <div class="form-group">
                                    <label for="mitra_jenis_edit" class="col-form-label">Jenis Mitra:</label>
                                    <input type="text" class="form-control" name="mitra_jenis_edit" id="mitra_jenis_edit" value="Perusahaan" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="mitra_ktp_edit" class="col-form-label">KTP:</label>
                                    <input type="text" class="form-control" name="mitra_ktp_edit" id="mitra_ktp_edit" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="mitra_jenis_perusahaan_edit" class="col-form-label">Jenis Perusahaan:</label>
                                    <input type="text" class="form-control" name="mitra_jenis_perusahaan_edit" id="mitra_jenis_perusahaan_edit" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="mitra_nib_edit" class="col-form-label">NIB</label>
                                    <input type="text" class="form-control" name="mitra_nib_edit" id="mitra_nib_edit" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="mitra_npwp_edit" class="col-form-label">NPWP</label>
                                    <input type="text" class="form-control" name="mitra_npwp_edit" id="mitra_npwp_edit" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="mitra_provinsi_edit" class="col-form-label">Provinsi</label>
                                    <input type="text" class="form-control" name="mitra_provinsi_edit" id="mitra_provinsi_edit" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="mitra_kabupaten_edit" class="col-form-label">Kota/Kabupaten</label>
                                    <input type="text" class="form-control" name="mitra_kabupaten_edit" id="mitra_kabupaten_edit" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="mitra_kecamatan_edit" class="col-form-label">Kecamatan</label>
                                    <input type="text" class="form-control" name="mitra_kecamatan_edit" id="mitra_kecamatan_edit" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="mitra_desa_edit" class="col-form-label">Desa/Jalan:</label>
                                    <textarea class="form-control" name="mitra_desa_edit" id="mitra_desa_edit" readonly rows=3 style="resize:none"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="mitra_email_edit" class="col-form-label">Email:</label>
                                    <input type="text" class="form-control" name="mitra_email_edit" id="mitra_email_edit" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="file_list">Dokumen:</label>
                                    <div id="file-list"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="mitra_status_edit">Status Verifikasi:</label>
                                    <select class="select2 form-control custom-select" id="mitra_status_edit" onchange="showInput()" name="mitra_status_edit" required style="margin-left:-10px;width: 100%; height:36px;">
                                        <option selected disabled value="">-- Pilih Verifikasi --</option>
                                        <option value=1>Verif</option>
                                        <option value=0>Reject</option>
                    
                                    </select>
                                </div>
                               
                                <div class="form-group" id="inputField" style="display:none;">
                                    <label for="mitra_keterangan_reject_edit" class="col-form-label">Keterangan reject:</label>
                                    <textarea class="form-control" name="mitra_keterangan_reject_edit" id="mitra_keterangan_reject_edit" rows=3 style="resize:none"></textarea>
                                </div>
                               
                               
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                <button type="submit" id="verifikasi_button" class="btn btn-info">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            

            


<!-- tutup divnya page-wrapper di file template.php -->

<script>
        function showInput() {
            const selectBox = document.getElementById("mitra_status_edit");
            const selectedValue = selectBox.value;

            var inputField = document.getElementById("inputField");

            if (selectedValue === "0") {
                inputField.style.display = "block";
            } else {
                inputField.style.display = "none";
            }
        }

    </script>

    <script>
    $(document).ready(function(){
        $("#edit").on("submit", function(e){
            e.preventDefault();
            $('#verifikasi_button').html("<i class='fa fa-spinner fa-spin '></i> Processing Order");
            $('#verifikasi_button').prop('disabled', true);

            const data =  {
                id: $('#mitra_id_edit').val(), 
                status: $('#mitra_status_edit').val(),
                email_mitra: $('#mitra_email_edit').val(),
                reason: $('#mitra_keterangan_reject_edit').val()
              

            }

            $.ajax({
                method: "post",
                url: "<?= base_url()?>/C_verif_mitra/verifikasi",
                data,
                success: function(backData){
                    toastr.success('', 'Verifikasi mitra berhasil !',{
                        timeOut: 1000,
                        fadeOut: 300,
                        onHidden: function () {
                            window.location.reload();
                        }
                    });
                },
                fail: function(xhr, textStatus, errorThrown){
                    alert('Gagal transaksi');
                    $('#verifikasi-button').html('<button type="submit" id="verifikasi_button" class="btn btn-info">Simpan</button>')
                }
            });
        });

    });
    </script>
    <script>
        async function edit(data){
            // Define specific form for each jenis mitra
            const form_corporate = ['mitra_nib_edit', 'mitra_jenis_perusahaan_edit'];
            const form_personal = ['mitra_ktp_edit']
            const text_jenis_perusahaan = { 'Bukan BUMN': 'Non BUMN', 'BUMN': 'BUMN' }
            const API = 'https://dev.farizdotid.com/api/daerahindonesia'

            await fetch(`${API}/provinsi/${data.data_mitra_provinsi.id}`)
                .then(response => response.json())
                .then(res => data.data_mitra_provinsi.id = res.nama )
                .catch(err => data.data_mitra_provinsi.id = 'Failed to fetch data')

            await fetch(`${API}/kota/${data.data_mitra_kabupaten.id}`)
                .then(response => response.json())
                .then(res => data.data_mitra_kabupaten.id = res.nama )
                .catch(err => data.data_mitra_kabupaten.id = 'Failed to fetch data')

            await fetch(`${API}/kecamatan/${data.data_mitra_kecamatan.id}`)
                .then(response => response.json())
                .then(res => data.data_mitra_kecamatan.id = res.nama )
                .catch(err => data.data_mitra_kecamatan.id = 'Failed to fetch data')

            data.data_mitra_jenis_perusahaan = text_jenis_perusahaan[data.data_mitra_jenis_perusahaan]
           
            // Iterate all data and map to each form
            Object.entries(data).forEach(([key,value]) => {
                const form_name = key.includes('data_') ? key.replace('data_', '').concat('_edit') : key;
                const $this = $(`#${form_name}`)

                $this.val(value);

                // Show related form only for perorangan
                if(data.data_mitra_jenis.toLowerCase() === 'perorangan') {
                    form_corporate.includes(form_name) && $this.closest('.form-group').hide();
                    form_personal.includes(form_name) && $this.closest('.form-group').show();
                    return false;
                }

                // Show related form only for perusahaan
                form_corporate.includes(form_name) && $this.closest('.form-group').show();
                form_personal.includes(form_name) && $this.closest('.form-group').hide();
            })

            data.data_mitra_file 
                ? $('#file-list').html(`<a href="<?= base_url() ?>/public/assets/uploads/dokumen_mitra/${data.data_mitra_file}" download>${data.data_mitra_file.replace('dokumen_mitra/', '')}</a>`)
                : $('#file-list').html('<span>Tidak ada file</span>')

            const isView = data.modal_type === 'view'

            $('#mitra_status_edit').prop('disabled', isView).change()
            $('#mitra_keterangan_reject_edit').prop('disabled', isView);
            $('#verifikasi_button').prop('disabled', isView)

            isView ? $('#verifikasi_button').hide() : $('#verifikasi_button').show();
        }
    </script>


<?= $this->endSection();?>