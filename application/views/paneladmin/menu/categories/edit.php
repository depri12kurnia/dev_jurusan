<!-- Main content -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-edit text-warning mr-2"></i>
                    Edit Kategori Menu
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/menu_categories') ?>">Kategori Menu</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Card -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-12">
                <?= form_open('admin/menu_categories/edit/' . $category->id, 'class="needs-validation" novalidate') ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-folder-open mr-2"></i>
                            Form Edit Kategori Menu
                        </h3>
                        <div class="card-tools">
                            <span class="badge badge-info">ID: <?= $category->id ?></span>
                        </div>
                    </div>
                    <div class="card-body">
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

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Name Field -->
                                <div class="form-group">
                                    <label for="name" class="form-label required">
                                        <i class="fas fa-tag mr-1"></i>
                                        Nama Kategori
                                    </label>
                                    <input type="text"
                                        class="form-control <?= form_error('name') ? 'is-invalid' : '' ?>"
                                        id="name"
                                        name="name"
                                        value="<?= set_value('name', $category->name) ?>"
                                        placeholder="Masukkan nama kategori menu"
                                        required>
                                    <?php if (form_error('name')): ?>
                                        <div class="invalid-feedback">
                                            <?= form_error('name') ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Nama kategori yang akan ditampilkan di menu navigasi
                                    </small>
                                </div>

                                <!-- Slug Field (Read Only) -->
                                <div class="form-group">
                                    <label for="slug" class="form-label">
                                        <i class="fas fa-link mr-1"></i>
                                        Slug URL
                                    </label>
                                    <input type="text"
                                        class="form-control bg-light"
                                        id="slug"
                                        value="<?= $category->slug ?>"
                                        readonly>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Slug URL otomatis dibuat dari nama kategori dan tidak dapat diubah
                                    </small>
                                </div>

                                <!-- Icon Field -->
                                <div class="form-group">
                                    <label for="icon" class="form-label">
                                        <i class="fas fa-icons mr-1"></i>
                                        Icon FontAwesome
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="icon-preview">
                                                <i class="<?= $category->icon ?: 'fas fa-folder' ?>"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                            class="form-control <?= form_error('icon') ? 'is-invalid' : '' ?>"
                                            id="icon"
                                            name="icon"
                                            value="<?= set_value('icon', $category->icon) ?>"
                                            placeholder="fas fa-folder">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" id="icon-picker-btn">
                                                <i class="fas fa-search mr-1"></i> Pilih
                                            </button>
                                        </div>
                                        <?php if (form_error('icon')): ?>
                                            <div class="invalid-feedback">
                                                <?= form_error('icon') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Kelas CSS FontAwesome untuk icon kategori (misal: fas fa-home, fas fa-info-circle)
                                    </small>
                                </div>

                                <!-- Order Position Field -->
                                <div class="form-group">
                                    <label for="order_position" class="form-label required">
                                        <i class="fas fa-sort-numeric-up mr-1"></i>
                                        Urutan Tampil
                                    </label>
                                    <input type="number"
                                        class="form-control <?= form_error('order_position') ? 'is-invalid' : '' ?>"
                                        id="order_position"
                                        name="order_position"
                                        value="<?= set_value('order_position', $category->order_position) ?>"
                                        min="1"
                                        required>
                                    <?php if (form_error('order_position')): ?>
                                        <div class="invalid-feedback">
                                            <?= form_error('order_position') ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Urutan tampil kategori di menu navigasi (angka kecil tampil lebih dulu)
                                    </small>
                                </div>

                                <!-- Status Field -->
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-toggle-on mr-1"></i>
                                        Status
                                    </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="is_active"
                                            name="is_active"
                                            value="1"
                                            <?= set_value('is_active', $category->is_active) ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="is_active">
                                            <span class="text-success">Aktif</span> / <span class="text-muted">Nonaktif</span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Kategori aktif akan ditampilkan di menu navigasi website
                                    </small>
                                </div>

                                <!-- Meta Information -->
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Informasi
                                    </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">
                                                <strong>Dibuat:</strong> <?= date('d/m/Y H:i', strtotime($category->created_at)) ?>
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">
                                                <strong>Diperbarui:</strong> <?= date('d/m/Y H:i', strtotime($category->updated_at)) ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save mr-2"></i>
                                    Update Kategori
                                </button>
                                <a href="<?= base_url('admin/menu_categories') ?>" class="btn btn-secondary ml-2">
                                    <i class="fas fa-times mr-2"></i>
                                    Batal
                                </a>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <a href="<?= base_url('admin/menu_items?category=' . $category->id) ?>" class="btn btn-info">
                                    <i class="fas fa-list mr-2"></i>
                                    Lihat Item Menu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>

            <!-- Info Card -->
            <div class="col-lg-4 col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Statistik Kategori
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-right">
                                    <!-- <h4 class="text-primary"><?= $items_count ?></h4> -->
                                    <small class="text-muted">Total Item</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- <h4 class="text-success"><?= $active_items_count ?></h4> -->
                                <small class="text-muted">Item Aktif</small>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6><i class="fas fa-link text-primary mr-1"></i> URL Kategori</h6>
                            <p class="text-muted small">
                                <code><?= base_url($category->slug) ?></code>
                            </p>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            <strong>Perhatian:</strong> Mengubah nama kategori akan memperbarui slug URL secara otomatis.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Icon Picker Modal -->
<div class="modal fade" id="iconPickerModal" tabindex="-1" role="dialog" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconPickerModalLabel">
                    <i class="fas fa-icons mr-2"></i>
                    Pilih Icon FontAwesome
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="iconGrid">
                    <!-- Icons will be loaded here -->
                </div>
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

<script>
    $(document).ready(function() {
        // Icon preview update
        $('#icon').on('input', function() {
            var iconClass = $(this).val() || 'fas fa-folder';
            $('#icon-preview i').removeClass().addClass(iconClass);
        });

        // Icon picker
        $('#icon-picker-btn').click(function() {
            loadIconPicker();
            $('#iconPickerModal').modal('show');
        });

        // Form validation
        $('.needs-validation').on('submit', function(e) {
            if (this.checkValidity() === false) {
                e.preventDefault();
                e.stopPropagation();
            }
            $(this).addClass('was-validated');
        });
    });

    function loadIconPicker() {
        var icons = [
            'fas fa-home', 'fas fa-info-circle', 'fas fa-graduation-cap', 'fas fa-users',
            'fas fa-cog', 'fas fa-phone', 'fas fa-envelope', 'fas fa-map-marker-alt',
            'fas fa-book', 'fas fa-calendar', 'fas fa-trophy', 'fas fa-medal',
            'fas fa-user-graduate', 'fas fa-chalkboard-teacher', 'fas fa-microscope', 'fas fa-laptop',
            'fas fa-building', 'fas fa-university', 'fas fa-library', 'fas fa-clipboard-list',
            'fas fa-file-alt', 'fas fa-newspaper', 'fas fa-image', 'fas fa-video',
            'fas fa-download', 'fas fa-upload', 'fas fa-search', 'fas fa-star',
            'fas fa-heart', 'fas fa-thumbs-up', 'fas fa-comment', 'fas fa-share',
            'fas fa-folder', 'fas fa-folder-open', 'fas fa-file', 'fas fa-tags'
        ];

        var iconGrid = $('#iconGrid');
        iconGrid.empty();

        icons.forEach(function(iconClass) {
            var iconHtml = `
            <div class="col-2 col-md-1 text-center mb-3">
                <button type="button" class="btn btn-light icon-option" data-icon="${iconClass}">
                    <i class="${iconClass}"></i>
                </button>
            </div>
        `;
            iconGrid.append(iconHtml);
        });

        // Icon selection
        $('.icon-option').click(function() {
            var selectedIcon = $(this).data('icon');
            $('#icon').val(selectedIcon);
            $('#icon-preview i').removeClass().addClass(selectedIcon);
            $('#iconPickerModal').modal('hide');
        });
    }
</script>

<style>
    .required::after {
        content: " *";
        color: red;
    }

    .icon-option {
        width: 40px;
        height: 40px;
        padding: 8px;
        margin: 2px;
    }

    .icon-option:hover {
        background-color: #007bff;
        color: white;
    }

    .form-text.text-muted {
        font-size: 0.875rem;
    }

    .custom-control-label {
        padding-left: 0.5rem;
    }

    .border-right {
        border-right: 1px solid #dee2e6;
    }
</style>