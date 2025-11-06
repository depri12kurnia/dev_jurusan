<!-- jQuery Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .action-buttons .btn {
        margin-right: 2px;
        margin-bottom: 2px;
    }

    #pdf-viewer {
        border-radius: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .modal-xl .modal-body {
        background-color: #f8f9fa;
    }

    #pdf-loading {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 20px;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
    }

    .filter-section {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        border-left: 4px solid #007bff;
    }

    .filter-section .form-control-sm {
        border-radius: 4px;
    }

    .btn-warning.filter-active {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 193, 7, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
        }
    }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-download text-primary mr-2"></i>
                    Manajemen Download
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Download</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Statistics Row -->
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="totalDownloads">-</h3>
                        <p>Total Download</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-download"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="categoryCount">-</h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-folder"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="typeCount">-</h3>
                        <p>Tipe File</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="todayDownloads">-</h3>
                        <p>Download Hari Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary">
                        <h3 class="card-title text-white">
                            <i class="fas fa-list mr-2"></i>
                            Daftar File Download
                        </h3>
                        <div class="card-tools">
                            <button class="btn btn-success btn-sm" onclick="add_download()">
                                <i class="fas fa-plus mr-1"></i> Tambah Download
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Filter Controls -->
                        <div class="filter-section">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="filterCategory">Filter Kategori:</label>
                                    <select class="form-control form-control-sm" id="filterCategory">
                                        <option value="">Semua Kategori</option>
                                        <?php foreach ($category as $cat): ?>
                                            <option value="<?= $cat->name ?>"><?= $cat->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="filterType">Filter Tipe:</label>
                                    <select class="form-control form-control-sm" id="filterType">
                                        <option value="">Semua Tipe</option>
                                        <?php foreach ($type as $t): ?>
                                            <option value="<?= $t->name ?>"><?= $t->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button class="btn btn-info btn-sm" onclick="applyFilters()">
                                            <i class="fas fa-search"></i> Filter
                                        </button>
                                        <button class="btn btn-secondary btn-sm" onclick="clearFilters()">
                                            <i class="fas fa-times"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Tipe</th>
                                        <th>Nama</th>
                                        <th>Filename</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datatables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="csrf_token" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash(); ?>">

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Form Download</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label>Kategori *</label>
                            <select name="d_category_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($category as $c): ?>
                                    <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Tipe *</label>
                            <select name="d_type_id" class="form-control">
                                <option value="">Pilih Tipe</option>
                                <?php foreach ($type as $t): ?>
                                    <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Nama *</label>
                            <input name="name" placeholder="Nama File" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>File *</label>
                            <input name="filesname" class="form-control" type="file" accept=".pdf">
                            <small class="form-text text-muted">Format file yang diizinkan: PDF (Maksimal 5MB)</small>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk melihat file PDF -->
<div class="modal fade" id="modal_view_file" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-file-pdf text-danger"></i>
                    <span id="file-title">Preview File</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 80vh; padding: 0;">
                <div id="pdf-loading" class="text-center p-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat file PDF...</p>
                </div>
                <div id="pdf-error" class="text-center p-4" style="display: none;">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Error!</strong> File tidak dapat dimuat.
                        <br>
                        <small>Pastikan file ada dan dalam format PDF yang valid.</small>
                    </div>
                </div>
                <iframe id="pdf-viewer"
                    style="width: 100%; height: 100%; border: none; display: none;"
                    type="application/pdf">
                </iframe>
            </div>
            <div class="modal-footer">
                <a id="download-link" href="#" class="btn btn-success" target="_blank">
                    <i class="fas fa-download"></i> Download File
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var save_method;
    var table;
    var base_url = '<?php echo base_url(); ?>';

    function getCsrfToken() {
        return $('input[name="<?= $this->security->get_csrf_token_name() ?>"]').val();
    }

    function updateCsrfToken(newToken) {
        $('input[name="<?= $this->security->get_csrf_token_name() ?>"]').val(newToken);
        $('meta[name="csrf-token"]').attr('content', newToken);
    }

    $(document).ajaxSend(function(e, xhr, options) {
        let csrfToken = getCsrfToken();
        if (csrfToken) {
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        }
    });

    $(document).ready(function() {
        // Initialize DataTable
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('admin/files/download/ajax_list') ?>",
                "type": "POST",
                "data": function(d) {
                    d.<?= $this->security->get_csrf_token_name() ?> = getCsrfToken();
                    d.category_filter = $('#filterCategory').val();
                    d.type_filter = $('#filterType').val();
                },
                "dataSrc": function(json) {
                    // Update CSRF token if provided
                    if (json.csrf_token) {
                        updateCsrfToken(json.csrf_token);
                    }
                    return json.data;
                }
            },
            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
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

        // Form validation
        $("#form").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                d_category_id: {
                    required: true
                },
                d_type_id: {
                    required: true
                },
                name: {
                    required: true,
                    minlength: 3
                },
                filesname: {
                    required: function() {
                        return save_method === 'add';
                    }
                }
            },
            messages: {
                d_category_id: {
                    required: "Kategori harus dipilih"
                },
                d_type_id: {
                    required: "Tipe harus dipilih"
                },
                name: {
                    required: "Nama file harus diisi",
                    minlength: "Nama file minimal 3 karakter"
                },
                filesname: {
                    required: "File harus dipilih"
                }
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            }
        });

        // Load statistics
        loadStatistics();

        // Initialize filter button style
        updateFilterButtonStyle();

        // Update filter button style when dropdown values change
        $('#filterCategory, #filterType').on('change', function() {
            updateFilterButtonStyle();
        });

        // File validation on change
        $('input[name="filesname"]').on('change', function() {
            var file = this.files[0];
            var $input = $(this);
            var $formGroup = $input.closest('.form-group');
            var $helpBlock = $input.next('.help-block');

            // Reset previous errors
            $formGroup.removeClass('has-error');
            $helpBlock.empty();

            if (file) {
                // Check file type
                var fileName = file.name.toLowerCase();
                var fileExtension = fileName.split('.').pop();

                if (fileExtension !== 'pdf') {
                    $formGroup.addClass('has-error');
                    $helpBlock.text('Hanya file PDF yang diperbolehkan');
                    $input.val('');
                    return;
                }

                // Check file size (5MB = 5242880 bytes)
                if (file.size > 5242880) {
                    $formGroup.addClass('has-error');
                    $helpBlock.text('Ukuran file melebihi 5MB');
                    $input.val('');
                    return;
                }

                // Show success message
                $helpBlock.text('File valid: ' + fileName + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)')
                    .css('color', 'green');
            }
        });
    });

    function loadStatistics() {
        // You can implement AJAX calls to get actual statistics
        $('#totalDownloads').text('<?= count($category) ?>');
        $('#categoryCount').text('<?= count($category) ?>');
        $('#typeCount').text('<?= count($type) ?>');
        $('#todayDownloads').text('0');
    }

    function add_download() {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Download');
    }

    function edit_download(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo base_url('admin/files/download/ajax_edit/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="d_category_id"]').val(data.d_category_id);
                $('[name="d_type_id"]').val(data.d_type_id);
                $('[name="name"]').val(data.name);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Download');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled', true);

        if (!$("#form").valid()) {
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled', false);
            return;
        }

        var formData = new FormData($('#form')[0]);

        // Add CSRF token to FormData
        formData.append('<?= $this->security->get_csrf_token_name() ?>', getCsrfToken());

        var url;

        if (save_method == 'add') {
            url = "<?php echo base_url('admin/files/download/ajax_add') ?>";
        } else {
            url = "<?php echo base_url('admin/files/download/ajax_update') ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    // Update CSRF token
                    if (data.csrf_token) {
                        updateCsrfToken(data.csrf_token);
                    }

                    Swal.fire({
                        title: 'Berhasil!',
                        text: save_method == 'add' ? 'Data berhasil ditambahkan' : 'Data berhasil diperbarui',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').closest('.form-group').addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next('.help-block').text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled', false);
            }
        });
    }

    function delete_download(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo base_url('admin/files/download/ajax_delete/') ?>" + id,
                    type: "POST",
                    data: {
                        '<?= $this->security->get_csrf_token_name() ?>': getCsrfToken()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            reload_table();
                            // Update CSRF token
                            if (data.csrf_token) {
                                updateCsrfToken(data.csrf_token);
                            }

                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal menghapus data',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menghapus data',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function applyFilters() {
        // Show loading state
        var $filterBtn = $('button[onclick="applyFilters()"]');
        var originalText = $filterBtn.html();
        $filterBtn.html('<i class="fas fa-spinner fa-spin"></i> Loading...');
        $filterBtn.prop('disabled', true);

        // Reload DataTable with new filter parameters
        table.ajax.reload(function() {
            // Restore button state
            $filterBtn.html(originalText);
            $filterBtn.prop('disabled', false);

            // Update button appearance based on active filters
            updateFilterButtonStyle();
        });
    }

    function clearFilters() {
        $('#filterCategory').val('');
        $('#filterType').val('');

        // Show loading state
        var $clearBtn = $('button[onclick="clearFilters()"]');
        var originalText = $clearBtn.html();
        $clearBtn.html('<i class="fas fa-spinner fa-spin"></i> Clearing...');
        $clearBtn.prop('disabled', true);

        // Reload DataTable after clearing filters
        table.ajax.reload(function() {
            // Restore button state
            $clearBtn.html(originalText);
            $clearBtn.prop('disabled', false);

            // Update button appearance
            updateFilterButtonStyle();
        });
    }

    function updateFilterButtonStyle() {
        var hasFilters = $('#filterCategory').val() || $('#filterType').val();
        var $filterBtn = $('button[onclick="applyFilters()"]');

        if (hasFilters) {
            $filterBtn.removeClass('btn-info').addClass('btn-warning filter-active');
            $filterBtn.html('<i class="fas fa-filter"></i> Filter Aktif');
        } else {
            $filterBtn.removeClass('btn-warning filter-active').addClass('btn-info');
            $filterBtn.html('<i class="fas fa-search"></i> Filter');
        }
    }

    function view_file(filename, name) {
        // Set title
        $('#file-title').text(name);

        // Reset modal state
        $('#pdf-loading').show();
        $('#pdf-error').hide();
        $('#pdf-viewer').hide();

        // Set file path (using secure controller method)
        var filePath = base_url + 'admin/files/download/view_file/' + encodeURIComponent(filename);
        var downloadPath = base_url + 'admin/files/download/download_file/' + encodeURIComponent(filename);

        // Set download link
        $('#download-link').attr('href', downloadPath); // Show modal
        $('#modal_view_file').modal('show');

        // Load PDF in iframe
        var iframe = $('#pdf-viewer');

        iframe.on('load', function() {
            $('#pdf-loading').hide();
            $('#pdf-viewer').show();
        });

        iframe.on('error', function() {
            $('#pdf-loading').hide();
            $('#pdf-error').show();
        });

        // Set iframe source (add #toolbar=0 to hide PDF toolbar in some browsers)
        iframe.attr('src', filePath + '#toolbar=0&navpanes=0&scrollbar=0');

        // Fallback: If iframe doesn't load after 5 seconds, show error
        setTimeout(function() {
            if ($('#pdf-loading').is(':visible')) {
                $('#pdf-loading').hide();
                $('#pdf-error').show();
            }
        }, 5000);
    }

    // Reset modal when closed
    $('#modal_view_file').on('hidden.bs.modal', function() {
        $('#pdf-viewer').attr('src', '');
        $('#pdf-loading').show();
        $('#pdf-error').hide();
        $('#pdf-viewer').hide();
    });
</script>