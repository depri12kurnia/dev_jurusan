<!-- Main content -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-list text-primary mr-2"></i>
                    Item Menu
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Item Menu</li>
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
                            Daftar Item Menu
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= base_url('admin/menu_items/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Item Menu
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Filter Section -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="categoryFilter">Filter Kategori:</label>
                            <select class="form-control" id="categoryFilter">
                                <option value="">Semua Kategori</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat->id ?>" <?= $this->input->get('category') == $cat->id ? 'selected' : '' ?>>
                                        <?= $cat->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="statusFilter">Filter Status:</label>
                            <select class="form-control" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="button" class="btn btn-info" id="applyFilter">
                                    <i class="fas fa-search mr-1"></i> Filter
                                </button>
                                <button type="button" class="btn btn-secondary" id="resetFilter">
                                    <i class="fas fa-refresh mr-1"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="itemsTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="25%">Judul Item</th>
                                <th width="15%">Kategori</th>
                                <th width="15%">Slug</th>
                                <th width="8%">Urutan</th>
                                <th width="10%">Status</th>
                                <th width="12%">Tanggal</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($items) && $items): ?>
                                <!-- Debug: Found <?= count($items) ?> items -->
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?= $item->id ?></td>
                                        <td>
                                            <i class="<?= $item->icon ?: 'fas fa-file' ?> mr-2"></i>
                                            <?= $item->title ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-info"><?= $item->category_name ?: 'No Category' ?></span>
                                        </td>
                                        <td><?= $item->slug ?></td>
                                        <td><?= $item->order_position ?></td>
                                        <td>
                                            <?php if ($item->is_active): ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d M Y', strtotime($item->created_at ?? date('Y-m-d'))) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-info" onclick="viewDetail(<?= $item->id ?>)">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="<?= base_url('admin/menu_items/edit/' . $item->id) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(<?= $item->id ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            <strong>No Data Found</strong><br>
                                            Debug Info: Items variable <?= isset($items) ? 'is set' : 'is NOT set' ?><?= isset($items) ? ' with ' . count($items) . ' items' : '' ?>
                                            <br><br>
                                            <a href="<?= base_url('admin/menu_items/create') ?>" class="btn btn-primary">
                                                <i class="fas fa-plus mr-1"></i> Add Menu Item
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-info-circle mr-2"></i>
                    Detail Item Menu
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
                <p>Apakah Anda yakin ingin menghapus item menu ini?</p>
                <p><strong>Perhatian:</strong> Aksi ini tidak dapat dibatalkan!</p>
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

        // Initialize DataTable with client-side processing for debugging
        var table = $('#itemsTable').DataTable({
            "processing": false,
            "serverSide": false,
            "order": [
                [4, "asc"]
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "responsive": true,
            "pageLength": 25,
            "columnDefs": [{
                    "orderable": false,
                    "targets": 7
                } // Disable ordering for action column
            ]
        });

        // Note: CSRF token refresh removed to avoid 404 errors
        // DataTables will handle CSRF via form data automatically

        // Filter functionality
        $('#applyFilter').click(function() {
            table.draw();
        });

        $('#resetFilter').click(function() {
            $('#categoryFilter').val('');
            $('#statusFilter').val('');
            table.draw();
        });

        // Auto-apply filter on category change (if from URL parameter)
        <?php if ($this->input->get('category')): ?>
            table.draw();
        <?php endif; ?>
    });

    // View detail function
    function viewDetail(id) {
        $('#detailContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
        $('#detailModal').modal('show');

        $.ajax({
            url: '<?= base_url('admin/menu_items/detail/') ?>' + id,
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
                url: '<?= base_url('admin/menu_items/delete/') ?>' + deleteId,
                type: 'POST',
                data: {
                    'csrf_token_jkt3': csrfToken
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    if (response.success) {
                        $('#itemsTable').DataTable().ajax.reload();
                        toastr.success('Item menu berhasil dihapus!');
                    } else {
                        toastr.error('Gagal menghapus item menu!');
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