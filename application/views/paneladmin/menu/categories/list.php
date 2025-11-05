<!-- Main content -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-folder text-primary mr-2"></i>
                    Kategori Menu
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kategori Menu</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Card -->
<section class="content">
    <div class="container-fluid">
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <i class="fas fa-check-circle mr-2"></i>
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-list mr-2"></i>
                            Daftar Kategori Menu
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= base_url('admin/menu_categories/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Kategori
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="categoriesTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="25%">Nama Kategori</th>
                                <th width="20%">Slug</th>
                                <th width="10%">Urutan</th>
                                <th width="15%">Jumlah Item</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded via DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSRF Token -->
<input type="hidden" name="csrf_token_jkt3" value="<?= $this->security->get_csrf_hash(); ?>" />

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-info-circle mr-2"></i>
                    Detail Kategori Menu
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori menu ini?</p>
                <p><strong>Perhatian:</strong> Semua item menu yang terkait dengan kategori ini juga akan terhapus!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Get CSRF token from meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (settings.type == 'POST' && settings.url.indexOf('<?= base_url() ?>') !== -1) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                }
            }
        });

        // Initialize DataTable
        var table = $('#categoriesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('admin/menu_categories/ajax_list') ?>",
                "type": "POST",
                "data": function(d) {
                    d['csrf_token_jkt3'] = csrfToken;
                }
            },
            "columns": [{
                    "data": 0
                },
                {
                    "data": 1
                },
                {
                    "data": 2
                },
                {
                    "data": 3
                },
                {
                    "data": 4
                },
                {
                    "data": 5
                },
                {
                    "data": 6,
                    "orderable": false
                }
            ],
            "order": [
                [3, "asc"]
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "responsive": true,
            "pageLength": 25
        });

        // Note: CSRF token refresh removed to avoid 404 errors
        // DataTables will handle CSRF via form data automatically
    });

    // View detail function
    function viewDetail(id) {
        $('#detailContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
        $('#detailModal').modal('show');

        $.ajax({
            url: '<?= base_url('admin/menu_categories/detail/') ?>' + id,
            type: 'GET',
            success: function(response) {
                $('#detailContent').html(response);
            },
            error: function() {
                $('#detailContent').html('<div class="alert alert-danger">Gagal memuat data!</div>');
            }
        });
    }

    // Delete confirmation
    var deleteId = null;

    function deleteData(id) {
        deleteId = id;
        $('#deleteModal').modal('show');
    }

    $('#confirmDelete').click(function() {
        if (deleteId) {
            $.ajax({
                url: '<?= base_url('admin/menu_categories/delete/') ?>' + deleteId,
                type: 'POST',
                data: {
                    'csrf_token_jkt3': csrfToken
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    if (response.success) {
                        $('#categoriesTable').DataTable().ajax.reload();
                        toastr.success('Kategori menu berhasil dihapus!');
                    } else {
                        toastr.error('Gagal menghapus kategori menu!');
                    }
                },
                error: function() {
                    $('#deleteModal').modal('hide');
                    toastr.error('Terjadi kesalahan sistem!');
                }
            });
        }
    });
</script>