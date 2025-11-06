<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manajemen Staf</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Staf</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Staf</span>
                        <span class="info-box-number"><?php echo $staf_count; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Staf Aktif</span>
                        <span class="info-box-number">
                            <?php
                            $aktif = 0;
                            foreach ($status_stats as $stat) {
                                if ($stat->status_aktif == 'Aktif') {
                                    $aktif = $stat->total;
                                    break;
                                }
                            }
                            echo $aktif;
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-building"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Divisi</span>
                        <span class="info-box-number"><?php echo count($divisi_stats); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-pie"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Laporan</span>
                        <span class="info-box-number">
                            <a href="<?php echo base_url('admin/staf/report'); ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-file-alt"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Staf</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" onclick="add_staf()">
                        <i class="fas fa-plus"></i> Tambah Staf
                    </button>
                    <button type="button" class="btn btn-info btn-sm" onclick="show_import_modal()">
                        <i class="fas fa-file-import"></i> Import Excel
                    </button>
                    <button type="button" class="btn btn-success btn-sm" onclick="export_excel()">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="table-staf" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Detail Staf -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Staf</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="detail-content">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="modal-import-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-import-label">Import Data Staf</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-import" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Petunjuk Import:</h6>
                        <ol>
                            <li>Download template Excel terlebih dahulu</li>
                            <li>Isi data sesuai dengan format template</li>
                            <li>Kolom yang bertanda (*) wajib diisi</li>
                            <li>Format tanggal: YYYY-MM-DD (contoh: 2020-01-01)</li>
                            <li>Jenis Kelamin: L untuk Laki-laki, P untuk Perempuan</li>
                            <li>Upload file Excel (.xls atau .xlsx)</li>
                        </ol>
                        <a href="<?php echo base_url('admin/staf/download_template'); ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-download"></i> Download Template
                        </a>
                    </div>

                    <div class="form-group">
                        <label for="file_excel">Pilih File Excel <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_excel" name="file_excel" accept=".xls,.xlsx" required>
                            <label class="custom-file-label" for="file_excel">Pilih file...</label>
                        </div>
                        <small class="form-text text-muted">Format yang diizinkan: .xls, .xlsx (Maksimal 2MB)</small>
                    </div>

                    <div id="import-progress" class="d-none">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%">
                                Sedang memproses...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-import">
                        <i class="fas fa-upload"></i> Import Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var table;

    // CSRF Token handling
    var csrfName = '<?php echo $csrf_token; ?>';
    var csrfHash = '<?php echo $csrf_hash; ?>';

    function refreshCsrfToken() {
        $.get('<?php echo base_url('admin/staf/get_csrf_token'); ?>', function(response) {
            var data = JSON.parse(response);
            csrfName = data.csrf_token;
            csrfHash = data.csrf_hash;
        });
    }

    $(document).ready(function() {
        // Initialize DataTable
        table = $('#table-staf').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('admin/staf/ajax_list'); ?>",
                "type": "POST",
                "data": function(d) {
                    d[csrfName] = csrfHash;
                    return d;
                }
            },
            "columnDefs": [{
                "targets": [0, 7],
                "orderable": false,
            }, ],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });

    function add_staf() {
        window.location.href = '<?php echo base_url('admin/staf/add'); ?>';
    }

    function edit_staf(id) {
        window.location.href = '<?php echo base_url('admin/staf/edit/'); ?>' + id;
    }

    function view_staf(id) {
        $.ajax({
            url: '<?php echo base_url('admin/staf/view/'); ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    var html = `
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>NIP</strong></td>
                                    <td>: ${data.nip || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIK</strong></td>
                                    <td>: ${data.nik || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Lengkap</strong></td>
                                    <td>: ${data.nama_lengkap}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat, Tanggal Lahir</strong></td>
                                    <td>: ${data.tempat_lahir || '-'}, ${data.tanggal_lahir || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>: ${data.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Agama</strong></td>
                                    <td>: ${data.agama || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>: ${data.email || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Telepon</strong></td>
                                    <td>: ${data.telepon || '-'}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Divisi</strong></td>
                                    <td>: ${data.divisi || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jabatan</strong></td>
                                    <td>: ${data.jabatan || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Golongan</strong></td>
                                    <td>: ${data.golongan || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pangkat</strong></td>
                                    <td>: ${data.pangkat || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pendidikan Terakhir</strong></td>
                                    <td>: ${data.pendidikan_terakhir || '-'}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Kepegawaian</strong></td>
                                    <td>: ${data.status_kepegawaian}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Aktif</strong></td>
                                    <td>: <span class="badge badge-${data.status_aktif == 'Aktif' ? 'success' : 'secondary'}">${data.status_aktif}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Masuk</strong></td>
                                    <td>: ${data.tanggal_masuk || '-'}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    ${data.alamat ? '<div class="row"><div class="col-12"><strong>Alamat:</strong><br>' + data.alamat + '</div></div>' : ''}
                    ${data.keterangan ? '<div class="row"><div class="col-12"><strong>Keterangan:</strong><br>' + data.keterangan + '</div></div>' : ''}
                `;
                    $('#detail-content').html(html);
                    $('#modal-detail').modal('show');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Terjadi kesalahan saat memuat data', 'error');
            }
        });
    }

    function delete_staf(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data staf ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = {};
                formData[csrfName] = csrfHash;

                $.ajax({
                    url: '<?php echo base_url('admin/staf/delete/'); ?>' + id,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        refreshCsrfToken(); // Refresh CSRF token after successful request
                        if (response.success) {
                            Swal.fire('Berhasil!', response.message, 'success');
                            table.ajax.reload();
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data', 'error');
                    }
                });
            }
        });
    }

    function export_excel() {
        window.location.href = '<?php echo base_url('admin/staf/export_excel'); ?>';
    }

    function show_import_modal() {
        $('#modal-import').modal('show');
        $('#file_excel').val('');
        $('.custom-file-label').text('Pilih file...');
    }

    // Handle file input change
    $('#file_excel').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });

    // Handle import form submission
    $('#form-import').on('submit', function(e) {
        e.preventDefault();

        var fileInput = $('#file_excel')[0];
        if (!fileInput.files.length) {
            Swal.fire('Error!', 'Silahkan pilih file Excel terlebih dahulu', 'error');
            return;
        }

        var file = fileInput.files[0];
        var allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if (!allowedTypes.includes(file.type)) {
            Swal.fire('Error!', 'Format file tidak valid. Gunakan file Excel (.xls atau .xlsx)', 'error');
            return;
        }

        if (file.size > 2048000) { // 2MB in bytes
            Swal.fire('Error!', 'Ukuran file terlalu besar. Maksimal 2MB', 'error');
            return;
        }

        var formData = new FormData(this);
        formData.append(csrfName, csrfHash);

        $('#btn-import').prop('disabled', true);
        $('#import-progress').removeClass('d-none');

        $.ajax({
            url: '<?php echo base_url('admin/staf/import_excel'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                $('#btn-import').prop('disabled', false);
                $('#import-progress').addClass('d-none');
                refreshCsrfToken();

                if (response.success) {
                    $('#modal-import').modal('hide');
                    Swal.fire({
                        title: 'Import Berhasil!',
                        html: response.message.replace(/\n/g, '<br>'),
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        table.ajax.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Import Gagal!',
                        html: response.message.replace(/\n/g, '<br>'),
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#btn-import').prop('disabled', false);
                $('#import-progress').addClass('d-none');
                Swal.fire('Error!', 'Terjadi kesalahan saat mengimport data: ' + error, 'error');
            }
        });
    });
</script>