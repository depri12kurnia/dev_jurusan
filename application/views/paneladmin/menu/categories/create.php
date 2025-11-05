<!-- Main content -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-plus text-success mr-2"></i>
                    Tambah Kategori Menu
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/menu_categories') ?>">Kategori Menu</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
                <?= form_open('admin/menu_categories/create', 'class="needs-validation" novalidate') ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-folder-plus mr-2"></i>
                            Form Tambah Kategori Menu
                        </h3>
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
                                        value="<?= set_value('name') ?>"
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

                                <!-- Description Field -->
                                <div class="form-group">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-left mr-1"></i>
                                        Deskripsi
                                    </label>
                                    <textarea class="form-control <?= form_error('description') ? 'is-invalid' : '' ?>"
                                        id="description"
                                        name="description"
                                        rows="3"
                                        placeholder="Deskripsi kategori menu (opsional)"><?= set_value('description') ?></textarea>
                                    <?php if (form_error('description')): ?>
                                        <div class="invalid-feedback">
                                            <?= form_error('description') ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Deskripsi singkat tentang kategori menu ini
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
                                                <i class="fas fa-folder"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                            class="form-control <?= form_error('icon') ? 'is-invalid' : '' ?>"
                                            id="icon"
                                            name="icon"
                                            value="<?= set_value('icon', 'fas fa-folder') ?>"
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
                                        value="<?= set_value('order_position', '1') ?>"
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
                                            <?= set_value('is_active', '1') ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="is_active">
                                            <span class="text-success">Aktif</span> / <span class="text-muted">Nonaktif</span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Kategori aktif akan ditampilkan di menu navigasi website
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Kategori
                                </button>
                                <button type="reset" class="btn btn-secondary ml-2">
                                    <i class="fas fa-undo mr-2"></i>
                                    Reset Form
                                </button>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <a href="<?= base_url('admin/menu_categories') ?>" class="btn btn-light">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>

            <!-- Help Card -->
            <div class="col-lg-4 col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-question-circle mr-2"></i>
                            Panduan Pengisian
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6><i class="fas fa-tag text-primary mr-1"></i> Nama Kategori</h6>
                            <p class="text-muted small mb-2">Nama kategori yang akan muncul di menu navigasi website. Contoh: "Tentang Kami", "Akademik", "Fasilitas"</p>
                        </div>

                        <div class="mb-3">
                            <h6><i class="fas fa-icons text-primary mr-1"></i> Icon FontAwesome</h6>
                            <p class="text-muted small mb-2">Kelas CSS FontAwesome untuk icon. Gunakan tombol "Pilih" untuk memilih icon yang tersedia.</p>
                            <p class="text-muted small">Contoh: <code>fas fa-home</code>, <code>fas fa-graduation-cap</code></p>
                        </div>

                        <div class="mb-3">
                            <h6><i class="fas fa-sort-numeric-up text-primary mr-1"></i> Urutan Tampil</h6>
                            <p class="text-muted small mb-2">Menentukan urutan kategori di menu. Angka yang lebih kecil akan tampil lebih dulu.</p>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb mr-1"></i>
                            <strong>Tips:</strong> Pastikan nama kategori singkat dan jelas agar mudah dipahami pengunjung website.
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

        // Auto-generate slug preview (optional enhancement)
        $('#name').on('input', function() {
            var name = $(this).val();
            var slug = name.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            // You can show slug preview here if needed
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

    // Reset form handler
    $('button[type="reset"]').click(function() {
        setTimeout(function() {
            $('#icon-preview i').removeClass().addClass('fas fa-folder');
            $('.needs-validation').removeClass('was-validated');
        }, 10);
    });
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
</style>