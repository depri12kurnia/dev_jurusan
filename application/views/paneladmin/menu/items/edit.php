<!-- Main content -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-edit text-warning mr-2"></i>
                    Edit Item Menu
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/menu_items') ?>">Item Menu</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Card -->
<section class="content">
    <div class="container-fluid">
        <?= form_open('admin/menu_items/edit/' . $item->id, 'class="needs-validation" novalidate') ?>
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-edit mr-2"></i>
                            Form Edit Item Menu
                        </h3>
                        <div class="card-tools">
                            <span class="badge badge-info">ID: <?= $item->id ?></span>
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
                                <!-- Title Field -->
                                <div class="form-group">
                                    <label for="title" class="form-label required">
                                        <i class="fas fa-heading mr-1"></i>
                                        Judul Item Menu
                                    </label>
                                    <input type="text"
                                        class="form-control <?= form_error('title') ? 'is-invalid' : '' ?>"
                                        id="title"
                                        name="title"
                                        value="<?= set_value('title', $item->title) ?>"
                                        placeholder="Masukkan judul item menu"
                                        required>
                                    <?php if (form_error('title')): ?>
                                        <div class="invalid-feedback">
                                            <?= form_error('title') ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Judul yang akan ditampilkan di menu navigasi
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
                                        value="<?= $item->slug ?>"
                                        readonly>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        URL: <code><?= base_url($item->slug) ?></code>
                                    </small>
                                </div>

                                <!-- Category Field -->
                                <div class="form-group">
                                    <label for="category_id" class="form-label required">
                                        <i class="fas fa-folder mr-1"></i>
                                        Kategori Menu
                                    </label>
                                    <select class="form-control <?= form_error('category_id') ? 'is-invalid' : '' ?>"
                                        id="category_id"
                                        name="category_id"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category->id ?>"
                                                <?= set_value('category_id', $item->category_id) == $category->id ? 'selected' : '' ?>>
                                                <?= $category->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (form_error('category_id')): ?>
                                        <div class="invalid-feedback">
                                            <?= form_error('category_id') ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Pilih kategori untuk mengelompokkan item menu
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
                                                <i class="<?= $item->icon ?: 'fas fa-file' ?>"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                            class="form-control <?= form_error('icon') ? 'is-invalid' : '' ?>"
                                            id="icon"
                                            name="icon"
                                            value="<?= set_value('icon', $item->icon) ?>"
                                            placeholder="fas fa-file">
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
                                        Kelas CSS FontAwesome untuk icon item menu
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
                                        value="<?= set_value('order_position', $item->order_position) ?>"
                                        min="1"
                                        required>
                                    <?php if (form_error('order_position')): ?>
                                        <div class="invalid-feedback">
                                            <?= form_error('order_position') ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Urutan tampil item dalam kategori (angka kecil tampil lebih dulu)
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
                                            <?= set_value('is_active', $item->is_active) ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="is_active">
                                            <span class="text-success">Aktif</span> / <span class="text-muted">Nonaktif</span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Item aktif akan ditampilkan di menu navigasi website
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
                                                <strong>Dibuat:</strong> <?= date('d/m/Y H:i', strtotime($item->created_at)) ?>
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">
                                                <strong>Diperbarui:</strong> <?= date('d/m/Y H:i', strtotime($item->updated_at)) ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit mr-2"></i>
                            Konten Item Menu
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Content Field -->
                        <div class="form-group">
                            <label for="content" class="form-label required">
                                <i class="fas fa-align-left mr-1"></i>
                                Konten
                            </label>
                            <textarea class="form-control <?= form_error('content') ? 'is-invalid' : '' ?>"
                                id="content"
                                name="content"
                                rows="15"
                                required><?= set_value('content', $item->content) ?></textarea>
                            <?php if (form_error('content')): ?>
                                <div class="invalid-feedback">
                                    <?= form_error('content') ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Konten lengkap yang akan ditampilkan di halaman item menu
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-12">
                <!-- SEO Card -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-search mr-2"></i>
                            SEO & Meta Data
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Meta Title Field -->
                        <div class="form-group">
                            <label for="meta_title" class="form-label">
                                <i class="fas fa-tag mr-1"></i>
                                Meta Title
                            </label>
                            <input type="text"
                                class="form-control <?= form_error('meta_title') ? 'is-invalid' : '' ?>"
                                id="meta_title"
                                name="meta_title"
                                value="<?= set_value('meta_title', $item->meta_title) ?>"
                                placeholder="Otomatis dari judul jika kosong">
                            <?php if (form_error('meta_title')): ?>
                                <div class="invalid-feedback">
                                    <?= form_error('meta_title') ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">
                                Judul halaman untuk SEO (maksimal 60 karakter)
                            </small>
                        </div>

                        <!-- Meta Description Field -->
                        <div class="form-group">
                            <label for="meta_description" class="form-label">
                                <i class="fas fa-align-left mr-1"></i>
                                Meta Description
                            </label>
                            <textarea class="form-control <?= form_error('meta_description') ? 'is-invalid' : '' ?>"
                                id="meta_description"
                                name="meta_description"
                                rows="3"
                                placeholder="Deskripsi singkat untuk SEO"><?= set_value('meta_description', $item->meta_description) ?></textarea>
                            <?php if (form_error('meta_description')): ?>
                                <div class="invalid-feedback">
                                    <?= form_error('meta_description') ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">
                                Deskripsi halaman untuk mesin pencari (maksimal 160 karakter)
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-2"></i>
                            Informasi Item
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6><i class="fas fa-folder text-primary mr-1"></i> Kategori</h6>
                            <p class="text-muted small">
                                <span class="badge badge-info"><?= $item->category_name ?></span>
                            </p>
                        </div>

                        <div class="mb-3">
                            <h6><i class="fas fa-link text-primary mr-1"></i> URL Item</h6>
                            <p class="text-muted small">
                                <code><?= base_url($item->slug) ?></code>
                            </p>
                            <a href="<?= base_url($item->slug) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat Halaman
                            </a>
                        </div>

                        <div class="mb-3">
                            <h6><i class="fas fa-eye text-primary mr-1"></i> Status Publikasi</h6>
                            <p class="text-muted small">
                                <?php if ($item->is_active): ?>
                                    <span class="badge badge-success">Dipublikasikan</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Draft</span>
                                <?php endif; ?>
                            </p>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb mr-1"></i>
                            <strong>Tips:</strong> Pastikan konten sudah lengkap sebelum mengaktifkan status publikasi.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save mr-2"></i>
                                    Update Item Menu
                                </button>
                                <a href="<?= base_url('admin/menu_items') ?>" class="btn btn-secondary ml-2">
                                    <i class="fas fa-times mr-2"></i>
                                    Batal
                                </a>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <a href="<?= base_url($item->slug) ?>" target="_blank" class="btn btn-info">
                                    <i class="fas fa-eye mr-2"></i>
                                    Preview
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close() ?>
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

<!-- Include Summernote -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@19d5f7d70f5a32386894c2573713049dc9e2e5f0/plugins/summernote/summernote-bs4.min.css">
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@19d5f7d70f5a32386894c2573713049dc9e2e5f0/plugins/summernote/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#content').summernote({
            height: 400,
            placeholder: 'Tulis konten di sini...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    // Handle image upload if needed
                    for (let i = 0; i < files.length; i++) {
                        uploadImage(files[i]);
                    }
                }
            }
        });

        // Function to handle image upload
        function uploadImage(file) {
            var data = new FormData();
            data.append('file', file);

            $.ajax({
                url: '<?= base_url("admin/upload/summernote_image") ?>',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#content').summernote('insertImage', response.url);
                    }
                },
                error: function() {
                    // Insert image as base64 if upload fails
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#content').summernote('insertImage', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } // Icon preview update
        $('#icon').on('input', function() {
            var iconClass = $(this).val() || 'fas fa-file';
            $('#icon-preview i').removeClass().addClass(iconClass);
        });

        // Icon picker
        $('#icon-picker-btn').click(function() {
            loadIconPicker();
            $('#iconPickerModal').modal('show');
        });

        // Form validation
        $('.needs-validation').on('submit', function(e) {
            // Summernote automatically syncs content to textarea

            if (this.checkValidity() === false) {
                e.preventDefault();
                e.stopPropagation();
            }
            $(this).addClass('was-validated');
        });
    });

    function loadIconPicker() {
        var icons = [
            'fas fa-file', 'fas fa-file-alt', 'fas fa-info-circle', 'fas fa-user',
            'fas fa-users', 'fas fa-graduation-cap', 'fas fa-university', 'fas fa-book',
            'fas fa-calendar', 'fas fa-calendar-alt', 'fas fa-trophy', 'fas fa-medal',
            'fas fa-certificate', 'fas fa-award', 'fas fa-star', 'fas fa-heart',
            'fas fa-home', 'fas fa-phone', 'fas fa-envelope', 'fas fa-map-marker-alt',
            'fas fa-building', 'fas fa-library', 'fas fa-microscope', 'fas fa-laptop',
            'fas fa-chalkboard-teacher', 'fas fa-user-graduate', 'fas fa-clipboard-list', 'fas fa-tasks',
            'fas fa-search', 'fas fa-download', 'fas fa-upload', 'fas fa-share',
            'fas fa-eye', 'fas fa-comment', 'fas fa-thumbs-up', 'fas fa-newspaper'
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

    .cke_top {
        border-top: 1px solid #d2d6de !important;
    }

    .border-right {
        border-right: 1px solid #dee2e6;
    }
</style>