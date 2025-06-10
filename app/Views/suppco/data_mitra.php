<?= $this->extend('layout/template')?>
<?= $this->section('content');?>

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
        <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Master Mitra</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Mitra</li>
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
                            <button type="button" class="btn btn-secondary" data-toggle="modal" onclick="showModalAddMitra()" >Tambah</button>
                        </div>
                        <table id="table_mitra" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Nama Mitra</th>
                                    <th>Jenis Mitra</th>
                                    <th>NPWP</th>
                                    <th>Penginput</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD -->
    <div class="modal fade" id="tambah_mitra" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="tambah_mitra_form">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Tambah Mitra</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="data_mitra_nama" class="col-form-label">Nama Mitra:</label>
                            <input type="text" class="form-control" name="data_mitra_nama" id="data_mitra_nama" required>
                        </div>
                        <div class="form-group">
                            <label for="data_mitra_jenis" class="col-form-label">Jenis Mitra:</label>
                            <select class="form-control" name="data_mitra_jenis" id="data_mitra_jenis" required>
                                <option disabled selected hidden>Jenis Mitra</option>
                                <option value="Perusahaan">Perusahaan</option>
                                <option value="Perorangan">Perorangan</option>
                                <option value="Asosiasi/Organisasi/Koperasi">Asosiasi/Organisasi/Koperasi</option>
                            </select>
                        </div>
                        <div class="form-group segmented-form form-company">
                            <label for="data_mitra_jenis_perusahaan" class="col-form-label">Jenis Perusahaan:</label>
                            <select class="form-control" name="data_mitra_jenis_perusahaan" id="data_mitra_jenis_perusahaan" required>
                                <option disabled selected hidden>Jenis Perusahaan</option>
                                <option value="BUMN">BUMN</option>
                                <option value="Bukan BUMN">Bukan BUMN</option>
                            </select>
                        </div>
                        <div class="form-group segmented-form form-asosiasi">
                            <label for="data_mitra_no_asosiasi" class="col-form-label">Nomor Asosiasi</label>
                            <input type="text" class="form-control" name="data_mitra_no_asosiasi" id="data_mitra_no_asosiasi" required>
                        </div>
                        <div class="form-group segmented-form form-company">
                            <label for="data_mitra_nib" class="col-form-label">SIUP/NIB:</label>
                            <input type="text" class="form-control" name="data_mitra_nib" id="data_mitra_nib" required>
                        </div>
                        <div class="form-group segmented-form form-personal">
                            <label for="data_mitra_ktp" class="col-form-label">KTP:</label>
                            <input type="text" class="form-control" name="data_mitra_ktp" id="data_mitra_ktp" required>
                        </div>
                        <div class="form-group segmented-form">
                            <label for="data_mitra_npwp" class="col-form-label">NPWP:</label>
                            <input type="text" class="form-control" name="data_mitra_npwp" id="data_mitra_npwp" required>
                        </div>
                        <div class="form-group segmented-form">
                            <label for="data_mitra_provinsi_id" class="col-form-label">Provinsi:</label>
                            <input type="text" name="data_mitra_provinsi" id="data_mitra_provinsi" hidden readonly />
                            <select class="form-control" name="data_mitra_provinsi_id" id="data_mitra_provinsi_id" required>
                                <option selected disabled>-- Pilih Provinsi --</option>
                            </select>
                        </div>
                        <div class="form-group segmented-form">
                            <label for="data_mitra_kabupaten_id" class="col-form-label">Kabupaten:</label>
                            <input type="text" name="data_mitra_kabupaten" id="data_mitra_kabupaten" hidden readonly />
                            <select class="form-control" name="data_mitra_kabupaten_id" id="data_mitra_kabupaten_id" required>
                                <option selected disabled>-- Pilih Kota/Kabupaten --</option>
                            </select>
                        </div>
                        <div class="form-group segmented-form">
                            <label for="data_mitra_kecamatan_id" class="col-form-label">Kecamatan:</label>
                            <input type="text" name="data_mitra_kecamatan" id="data_mitra_kecamatan" hidden readonly />
                            <select class="form-control" name="data_mitra_kecamatan_id" id="data_mitra_kecamatan_id" required>
                                <option selected disabled>-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div class="form-group segmented-form">
                            <label for="data_mitra_desa" class="col-form-label">Desa/Jalan:</label>
                            <input type="text" class="form-control" name="data_mitra_desa" id="data_mitra_desa" required>
                        </div>

                        <div id="emailFields" class="form-group segmented-form">
                            <label for="data_alamat_email_mitra" class="col-form-label">Alamat Email:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="data_alamat_email_mitra" name="data_alamat_email_mitra[]"required>
                                    <div class="input-group-append">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary add-button" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="waFields" class="form-group segmented-form">
                            <label for="data_nomor_wa_mitra" class="col-form-label">Nomor Whatsapp:</label>
                            <div id="data_nomor_wa_mitra" class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="data_nomor_wa_mitra[]" required>
                                    <div class="input-group-append">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary add-button" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group segmented-form">
                            <label for="data_mitra_email" class="col-form-label">Upload Dokumen:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="data_mitra_file"  name="data_mitra_file" accept="application/pdf" required>
                                <label class="custom-file-label" for="data_mitra_file">Choose file...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                        </div>
                        <div class="form-group segmented-form">
                            <label for="data_mitra_status" class="col-form-label">Status:</label>
                            <select class="form-control" name="data_mitra_status" id="data_mitra_status" required>
                                <option disabled selected hidden>Status Mitra</option>
                                <option value="1">Verifikasi</option>
                                <option value="0">Reject</option>
                            </select>
                        </div>
                        <div class="form-group segmented-form reject-status">
                            <label for="data_mitra_keterangan_reject" class="col-form-label">Keterangan Reject:</label>
                            <textarea class="form-control" name="data_mitra_keterangan_reject" id="data_mitra_keterangan_reject" rows="3" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-info" id="tambah_button">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DELETE -->
    <div class="modal fade" id="hapus_mitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="hapus_mitra_form" class="hapus_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin untuk mengapus data ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<style>
    .custom-file-label {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script type="text/javascript">
    function showModalAddMitra() {
        emailEl = `<label for="data_alamat_email_mitra" class="col-form-label">Alamat Email:</label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="data_alamat_email_mitra" name="data_alamat_email_mitra[]"required>
                            <div class="input-group-append">
                                <div class="btn-group">
                                    <button class="btn btn-secondary add-button" type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
        waEl = `<label for="data_nomor_wa_mitra" class="col-form-label">Nomor Whatsapp:</label>
                <div id="data_nomor_wa_mitra" class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="data_nomor_wa_mitra[]" required>
                        <div class="input-group-append">
                            <div class="btn-group">
                                <button class="btn btn-secondary add-button" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;

        $('#emailFields').html(emailEl);
        $('#waFields').html(waEl);
        $('#tambah_mitra').modal('show');
    }

    $('#emailFields').on('click', '.add-button', function() {
        const newFormGroupEl = `<div class="form-group dynamic-el">
        <div class="input-group">
            <input type="text" class="form-control" name="data_alamat_email_mitra[]"
                required>
            <div class="input-group-append">
                <div class="btn-group">
                    <button class="btn btn-danger delete-button" type="button">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>`

        $('#emailFields').append(newFormGroupEl)
    }).on('click', '.delete-button', function() {
        $(this).closest('.form-group').remove()
    })
</script>

<script type="text/javascript">
    $('#waFields').on('click', '.add-button', function() {
        const newFormGroupWaEl = `<div class="form-group dynamic-el">
            <div class="input-group">
                <input type="text" class="form-control" name="data_nomor_wa_mitra[]" required>
                <div class="input-group-append">
                    <div class="btn-group">
                        <button class="btn btn-danger delete-button" type="button">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>`

        $('#waFields').append(newFormGroupWaEl);
    }).on('click', '.delete-button', function() {
        $(this).closest('.form-group').remove();
    });
</script>
<!-- tutup divnya page-wrapper di file template.php -->
<script>
$(document).ready(function() {
    const role = <?= session()->get('role_id') ?>;
    const API_URL = `<?= base_url() ?>/C_data_mitra`
    const ADDRESS_API = 'https://dev.farizdotid.com/api/daerahindonesia'
    const modalEl = $('#tambah_mitra')
    const formEl = $('#tambah_mitra_form')
    const modalDel = $('#hapus_mitra')
    const formDel = $('#hapus_mitra_form')
    const formProvinsi = $('#data_mitra_provinsi_id')
    const formKabupaten = $('#data_mitra_kabupaten_id')
    const formKecamatan = $('#data_mitra_kecamatan_id')
    const spinner = `<i class='fa fa-spinner fa-spin '></i> Processing Order`
    formEl.find('.segmented-form').hide();

    /* Reset Form */
    function resetForm(el) {
        el.find('form').trigger('reset')
        const files = el.find('input:file');
        files.each(function () {
            $(this).next('label').text('Choose file...')
        })
        const select = el.find(".custom-select");
        select.each(function() {
            $(this).val('').trigger('change');
        })
    }

    /** Table rendering */
    const table = $('#table_mitra').DataTable({
        ajax: {
            url: `${API_URL}/get`,
            type: "GET",
        },
        serverSide: true,
        scrollX: true,
        drawCallback: function (settings) {
            $('#searchInputMitra').prop('readonly', false);
            $('#searchButtonMitra').prop('disabled', false);
            $('#searchButtonMitra').html('Cari');
        },
        columns: [
            { 
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {data: "data_mitra_nama"},
            {data: "data_mitra_jenis"},
            {data: "data_mitra_npwp"},
            {data: "user_keterangan"},
            {
                data: "data_mitra_status", 
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    let status = ''
                    switch(oData.data_mitra_status) {
                        case '1':
                            status = `<span class='badge-success' style='padding: 2px 5px; display:inline'>Sudah diverifikasi</span>`;
                            break;
                        case '0':
                            status = `<span class='badge-orange' style='padding: 2px 5px; display:inline'>Verifikasi ditolak</span>`;
                            break;
                        default:
                            status = `<span class='badge-danger' style='padding: 2px 5px; display:inline'>Belum diverifikasi</span>`;
                            break;
                    }

                    $(nTd).html(status);
                }
            },
            {
                data: "data_mitra_id", 
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html('<button type="button" class="btn btn-info btn-view-mitra"\
                    data-id="'+oData.data_mitra_id+'" title="view">\
                        <i class="fas fa-info"></i>\
                    </button>\
                    <button type="button" class="btn btn-info btn-edit-mitra"\
                        data-id="'+oData.data_mitra_id+'" title="edit">\
                        <i class="fas fa-pencil-alt"></i>\
                    </button>\
                    <button type="button" class="btn btn-danger btn-delete-mitra"\
                        data-id="'+oData.data_mitra_id+'" title="Hapus">\
                        <i class="fas fa-trash-alt"></i>\
                    </button>');
                }
            },
        ]
    }).on('click', '.btn-view-mitra', function(e) {
        e.preventDefault()
        const id = $(this).data('id');

        $.ajax({
            url: `${API_URL}/getDetail/${id}`,
            method: 'GET',
            success: function({data}) {
                console.log(data);
                const dokumen = data[0].data_mitra_file
                const idProvinsi = data[0].data_mitra_provinsi_id
                const idKabupaten = data[0].data_mitra_kabupaten_id
                const idKecamatan = data[0].data_mitra_kecamatan_id

                const dokumenEl = `<div class="existing-file" style="margin-top:1em">${dokumen ? `<a href="<?= base_url() ?>/public/assets/uploads/datamitra/${dokumen}">${dokumen}</a>` : 'Tidak ada file'}</div>`

                $('#data_mitra_nama').val(data[0].data_mitra_nama)
                $('#data_mitra_jenis').val(data[0].data_mitra_jenis).trigger('change')
                $('#data_mitra_ktp').val(data[0].data_mitra_ktp)
                $('#data_mitra_npwp').val(data[0].data_mitra_npwp)
                $('#data_mitra_nib').val(data[0].data_mitra_nib)
                $('#data_mitra_provinsi_id').val(data[0].data_mitra_provinsi_id)
                $('#data_mitra_no_asosiasi').val(data[0].data_mitra_nomor_asosiasi)
                $('#data_mitra_provinsi').val(data[0].data_mitra_provinsi)
                $('#data_email_mitra_id').val(data[0].data_email_mitra_id)
                $('#data_email_master_mitra').val(data[0].data_email_master_mitra)
                $('#data_mitra_status').val(data[0].data_mitra_status)
                $('#data_mitra_jenis_perusahaan').val(data[0].data_mitra_jenis_perusahaan)
                $('#data_mitra_desa').val(data[0].data_mitra_desa)
                $(dokumenEl).insertAfter($('#data_mitra_file'))

                $.get(`${ADDRESS_API}/kota?id_provinsi=${idProvinsi}`, function({kota_kabupaten}) {
                    let options = ''
                    kota_kabupaten.forEach(item => {
                        options += `<option value="${item.id}">${item.nama}</option>`
                    })
                    formKabupaten.html(options).val(idKabupaten)
                    const kabupatenName = formKabupaten.find('option:selected').text()
                    $('#data_mitra_kabupaten').val(kabupatenName)
                }).done(function() {
                    $.get(`${ADDRESS_API}/kecamatan?id_kota=${idKabupaten}`, function({kecamatan}) {
                        let options = ''
                        kecamatan.forEach(item => {
                            options += `<option value="${item.id}">${item.nama}</option>`
                        })
                        formKecamatan.html(options).val(idKecamatan).trigger('change') 
                    })
                })

                $.ajax({ 
                    url: `${API_URL}/getEmailWa/${id}`,
                    method: 'GET',
                    success: function (response) {console.log(response);
                        emailEl = '';
                        waEl = '';
                        if (response['list_email'].length != 0) {
                            emailEl = '';
                            response['list_email'].forEach((item, index) => {
                                emailEl += `${index == 0? '<label for="data_alamat_email_mitra" class="col-form-label">Alamat Email:</label>' : ''}
                                <div class="form-group dynamic-el">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="data_alamat_email_mitra[]"
                                            value="${item['data_email_alamat']}" placeholder="Nama Nilai Kompensasi"
                                            required>
                                    </div>
                                </div>`;
                            });

                        } else {
                            emailEl = `<label for="data_alamat_email_mitra" class="col-form-label">Alamat Email:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="data_alamat_email_mitra" name="data_alamat_email_mitra[]"required>
                                </div>
                            </div>`;
                        }
                        
                        $('#emailFields').html(emailEl);

                        if (response['list_wa'].length != 0) {
                            response['list_wa'].forEach((element, index) => {
                                waEl += `${index == 0? '<label for="data_nomor_wa_mitra" class="col-form-label">Nomor Whatsapp:</label>' : ''}
                                    <div class="form-group dynamic-el">
                                        <div class="input-group">
                                            <input type="text" value="${element['data_nomor_wa']}" class="form-control" name="data_nomor_wa_mitra[]" required>
                                        </div>
                                    </div>`;
                            });
                        } else {
                            waEl = `<label for="data_nomor_wa_mitra" class="col-form-label">Nomor Whatsapp:</label>
                            <div class="form-group dynamic-el">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="data_nomor_wa_mitra[]" required>
                                        </div>
                                    </div>`;
                        }

                        $('#waFields').html(waEl);

                        const title = modalEl.find('.modal-title');
                        title.text(title.text().replace('Tambah', 'Detail'))
                        formEl.find('button:submit').hide()
                        formEl.find('input:file').attr('required', false)
                        formEl.find('input, select').attr('disabled', true)
                        modalEl.modal('show');
                    }
                });
            },
            fail: function() {
                toastr.fail('', 'Fetching data gagal !',{ timeOut: 1000, fadeOut: 300 }); 
            }
        })
    }).on('click', '.btn-delete-mitra', function(e) {
        e.preventDefault()
        const id = $(this).data('id');
        modalDel.modal('show').data('id', id);
    }).on('click', '.btn-edit-mitra', function(e) {
        e.preventDefault()
        const id = $(this).data('id');

        $.ajax({
            url: `${API_URL}/getDetail/${id}`,
            method: 'GET',
            success: function({data}) {
                const dokumen = data[0].data_mitra_file
                const idProvinsi = data[0].data_mitra_provinsi_id
                const idKabupaten = data[0].data_mitra_kabupaten_id
                const idKecamatan = data[0].data_mitra_kecamatan_id

                const dokumenEl = `<div class="existing-file" style="margin-top:1em">${dokumen ? `<a href="<?= base_url() ?>/public/assets/uploads/datamitra/${dokumen}">${dokumen}</a>` : 'Tidak ada file'}</div>`

                
                $('#data_mitra_nama').val(data[0].data_mitra_nama)
                $('#data_mitra_jenis').val(data[0].data_mitra_jenis).trigger('change')
                $('#data_mitra_ktp').val(data[0].data_mitra_ktp)
                $('#data_mitra_npwp').val(data[0].data_mitra_npwp)
                $('#data_mitra_nib').val(data[0].data_mitra_nib)
                $('#data_mitra_provinsi_id').val(data[0].data_mitra_provinsi_id)
                $('#data_mitra_no_asosiasi').val(data[0].data_mitra_nomor_asosiasi)
                $('#data_mitra_provinsi').val(data[0].data_mitra_provinsi)
                $('#data_email_mitra_id').val(data[0].data_email_mitra_id)
                $('#data_email_master_mitra').val(data[0].data_email_master_mitra)
                $('#data_mitra_status').val(data[0].data_mitra_status)
                $('#data_mitra_jenis_perusahaan').val(data[0].data_mitra_jenis_perusahaan)
                $('#data_mitra_desa').val(data[0].data_mitra_desa)
                $(dokumenEl).insertAfter($('#data_mitra_file'))

                $.get(`${ADDRESS_API}/kota?id_provinsi=${idProvinsi}`, function({kota_kabupaten}) {
                    let options = '<option selected disabled>-- Pilih Kota/Kabupaten --</option>'
                    kota_kabupaten.forEach(item => {
                        options += `<option value="${item.id}">${item.nama}</option>`
                    })
                    formKabupaten.html(options).val(idKabupaten)
                    const kabupatenName = formKabupaten.find('option:selected').text()
                    $('#data_mitra_kabupaten').val(kabupatenName)
                }).done(function() {
                    $.get(`${ADDRESS_API}/kecamatan?id_kota=${idKabupaten}`, function({kecamatan}) {
                        let options = '<option selected disabled>-- Pilih Kecamatan --</option>'
                        kecamatan.forEach(item => {
                            options += `<option value="${item.id}">${item.nama}</option>`
                        })
                        formKecamatan.html(options).val(idKecamatan).trigger('change') 
                    })
                })

                $.ajax({ 
                    url: `${API_URL}/getEmailWa/${id}`,
                    method: 'GET',
                    success: function (response) {console.log(response);
                        emailEl = '';
                        waEl = '';
                        if (response['list_email'].length != 0) {
                            emailEl = '';
                            response['list_email'].forEach((item, index) => {
                                emailEl += `${index == 0? '<label for="data_alamat_email_mitra" class="col-form-label">Alamat Email:</label>' : ''}
                                <div class="form-group dynamic-el">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="data_alamat_email_mitra[]"
                                            value="${item['data_email_alamat']}" placeholder="Nama Nilai Kompensasi"
                                            required>
                                        <div class="input-group-append">
                                            <div class="btn-group">
                                                <button class="btn ${index == 0? 'btn-secondary add-button' : 'btn-danger delete-button'}" type="button">
                                                    <i class="fa ${index == 0? 'fa-plus' : 'fa-trash'}"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            });

                        } else {
                            emailEl = `<label for="data_alamat_email_mitra" class="col-form-label">Alamat Email:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="data_alamat_email_mitra" name="data_alamat_email_mitra[]"required>
                                    <div class="input-group-append">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary add-button" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        
                        $('#emailFields').html(emailEl);

                        if (response['list_wa'].length != 0) {
                            response['list_wa'].forEach((element, index) => {
                                waEl += `${index == 0? '<label for="data_nomor_wa_mitra" class="col-form-label">Nomor Whatsapp:</label>' : ''}
                                    <div class="form-group dynamic-el">
                                        <div class="input-group">
                                            <input type="text" value="${element['data_nomor_wa']}" class="form-control" name="data_nomor_wa_mitra[]" required>
                                            <div class="input-group-append">
                                                <div class="btn-group">
                                                    <button class="btn ${index == 0? 'btn-secondary add-button' : 'btn-danger delete-button'}" type="button">
                                                        <i class="fa ${index == 0? 'fa-plus' : 'fa-trash'}"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });
                        } else {
                            waEl = `<label for="data_nomor_wa_mitra" class="col-form-label">Nomor Whatsapp:</label>
                            <div class="form-group dynamic-el">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="data_nomor_wa_mitra[]" required>
                                            <div class="input-group-append">
                                                <div class="btn-group">
                                                    <button class="btn btn-secondary add-button" type="button">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                        }

                        $('#waFields').html(waEl);

                        const title = modalEl.find('.modal-title');
                        title.text(title.text().replace('Tambah', 'Edit'))
                        formEl.find('button:submit').attr('data-id', id).val('update').text('Update')
                        formEl.find('input:file').attr('required', false)
                        modalEl.modal('show');
                    }
                });
            },
            fail: function() {
                toastr.fail('', 'Fetching data gagal !',{ timeOut: 1000, fadeOut: 300 }); 
            }
        })
    });

    $('#table_mitra_filter').empty();

    // add button search
    $('#table_mitra_filter').append(`Search:<input type="search" class="" id="searchInputMitra" placeholder="" aria-controls="table_mitra">
    <button id="searchButtonMitra" class="btn btn-primary ml-1" fdprocessedid="ye3bnc">Cari</button>`);

    $('#searchButtonMitra').on('click', function(){
        $('#searchInputMitra').prop('readonly', true);
        $('#searchButtonMitra').prop('disabled', true);
        $('#searchButtonMitra').html('<i class="fas fa-spin fa-spinner"></i> Loading...');

        searchValue = $('#searchInputMitra').val();

        table.search(searchValue).draw();
    });

    /** Forms Submit */
    formEl.on('submit', function(e) {
        e.preventDefault();
        const buttonSubmit = $(this).find('button:submit');
        const type = buttonSubmit.val()
        const buttonSubmitHTML = '<button type="submit" class="btn btn-primary" value="tambah">Tambah</button>'
        $(buttonSubmit).html(spinner).prop('disabled', true)

        const data = new FormData(this);
        const id = buttonSubmit.data('id')
        const url = type === 'update' 
            ? `${API_URL}/update/${id}`
            : `${API_URL}/add` 
        const message = type === 'tambah' ? 'Tambah data' : 'Update data'

        $.ajax({ url, data, method: 'POST', contentType: false, cache: false, processData:false,
            success: function() {
                toastr.success('', `${message} berhasil !`,{ timeOut: 1000, fadeOut: 300 });
                modalEl.modal('hide')
                table.ajax.reload();
            },
            error: function(xhr) {
                // Tangani status 500 atau lainnya di sini
                if (xhr.status === 500) {
                    let response = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan';
                    toastr.error(response, `${message} gagal!`, { timeOut: 3000, fadeOut: 300 });
                } else {
                    toastr.error('Terjadi kesalahan lain', `${message} gagal!`, { timeOut: 3000, fadeOut: 300 });
                }
            },
            fail: function() {
                toastr.fail('', `${message} gagal !`,{ timeOut: 1000, fadeOut: 300 }); 
            },
            complete: function () {
                $(buttonSubmit).replaceWith(buttonSubmitHTML)
            }
        })
    })

    /** FORM DELETE */
    formDel.on('submit', function(e) {
        e.preventDefault();
        const id = $(modalDel).data('id')
        $.ajax({
            url: `${API_URL}/delete/${id}`,
            method: 'POST',
            success: function() {
                toastr.success('', 'Hapus data berhasil !',{ timeOut: 1000, fadeOut: 300 });
                modalDel.modal('hide')
                table.ajax.reload();
            },
            fail: function() {
                toastr.fail('', 'Hapus data gagal !',{ timeOut: 1000, fadeOut: 300 }); 
            }
        })
    })

    modalEl.on('show.bs.modal',function() {
        const title = modalEl.find('.modal-title').text()
    }).on('hidden.bs.modal', function() {
        const title = $(this).find('.modal-title')
        title.text(title.text().replace(/Edit|Detail/g, 'Tambah'))
        // title.text(title.text().replace('Edit', 'Tambah')).replace('Detail', 'Tambah')
        $(this).find('form button:submit').show();
        $(this).find('input, select').attr('disabled', false)
        $(this).find('form button:submit').val('tambah').prop('disabled', false).text('Tambah')
        $(this).find('input:file').attr('required', true)
        $(this).find('.existing-file').remove();
        $(this).find('.segmented-form').hide();
        resetForm($(this))
    })

    $('.datepickerq').datepicker({
        autoclose: true, 
        todayHighlight: true,
    });

    $('#data_mitra_jenis').on('change', function() {
        const value = $(this).val();
        if(value === 'Perorangan') {
            formEl.find('.segmented-form:not(.form-company):not(.reject-status)').show()
            formEl.find('.form-company').hide()
            formEl.find('.form-asosiasi').hide()
            formEl.find('.form-company input, .form-company select').prop('required', false)
            formEl.find('.form-asosiasi input, .form-company select').prop('required', false)
            formEl.find('.form-personal input, .form-personal select').prop('required', true)
        } else if(value === 'Perusahaan') {
            formEl.find('.segmented-form:not(.form-personal):not(.reject-status)').show()
            formEl.find('.form-personal').hide()
            formEl.find('.form-asosiasi').hide()
            formEl.find('.form-personal input, .form-personal select').prop('required', false)
            formEl.find('.form-asosiasi input, .form-company select').prop('required', false)
            formEl.find('.form-company input, .form-company select').prop('required', true)
        }
        else{
            formEl.find('.segmented-form:not(.form-company):not(.reject-status)').show()
            formEl.find('.form-company').hide()
            formEl.find('.form-personal').hide()
            formEl.find('.form-personal input, .form-personal select').prop('required', false)
            formEl.find('.form-company input, .form-company select').prop('required', false)
            formEl.find('.form-asosiasi input, .form-personal select').prop('required', true)
        }
    })


    formProvinsi.ready(function() {
        $.get(`${ADDRESS_API}/provinsi`, function({provinsi}) {
            let options = '<option selected disabled>-- Pilih Provinsi --</option>'
            provinsi.forEach(item => {
                options += `<option value="${item.id}">${item.nama}</option>`
            })
            formProvinsi.html(options)            
        })
    }).on('change',function() {
        const idProvinsi = $(this).val()
        const provinsiName = $(this).find('option:selected').text();
        $('#data_mitra_provinsi').val(provinsiName)
        $.get(`${ADDRESS_API}/kota?id_provinsi=${idProvinsi}`, function({kota_kabupaten}) {
            let options = '<option selected disabled>-- Pilih Kota/Kabupaten --</option>'
            kota_kabupaten.forEach(item => {
                options += `<option value="${item.id}">${item.nama}</option>`
            })
            formKabupaten.html(options).trigger('change')
            const kabupatenName = formKabupaten.find('option:selected').text()
            $('#data_mitra_kabupaten').val(kabupatenName)
        })
    })

    formKabupaten.on('change',function() {
        const idKabupaten = formKabupaten.val()
        const kabupatenName = $(this).find('option:selected').text();
        $('#data_mitra_kabupaten').val(kabupatenName)
        $.get(`${ADDRESS_API}/kecamatan?id_kota=${idKabupaten}`, function({kecamatan}) {
            let options = '<option selected disabled>-- Pilih Kecamatan --</option>'
            kecamatan.forEach(item => {
                options += `<option value="${item.id}">${item.nama}</option>`
            })
            formKecamatan.html(options)
            const kecamatanName = formKecamatan.find('option:selected').text()
            console.log({kecamatanName})
            $('#data_mitra_kecamatan').val(kecamatanName)
        })
    })

    formKecamatan.on('change',function() {
        const idKecamatan = formKecamatan.val()
        const kecamatanName = $(this).find('option:selected').text();
        $('#data_mitra_kecamatan').val(kecamatanName)
    })

    $('#data_mitra_status').on('change', function() {
        const value = $(this).val()
        value === '0' ? $('.reject-status').show() : $('.reject-status').hide();
        console.log({value})
        $('#data_mitra_keterangan_reject').attr('required', value === '0')
    })

    $(".custom-file-input").on("change", function() {
        const fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    

})
</script>
<?= $this->endSection();?>
