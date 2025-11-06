<!-- Main content -->
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-plus text-success mr-2"></i>
                    Tambah Item Menu
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/menu_items') ?>">Item Menu</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Card -->
<section class="content">
    <div class="container-fluid">
        <?= form_open('admin/menu_items/create', 'class="needs-validation" novalidate') ?>
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-plus mr-2"></i>
                            Form Tambah Item Menu
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

                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="fas fa-exclamation-triangle"></i> Validasi Error!</h5>
                                <?= validation_errors() ?>
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
                                        value="<?= set_value('title') ?>"
                                        placeholder="Masukkan judul item menu"
                                        minlength="3"
                                        maxlength="100"
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
                                                <?= set_value('category_id') == $category->id ? 'selected' : '' ?>>
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
                                                <i class="fas fa-file"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                            class="form-control <?= form_error('icon') ? 'is-invalid' : '' ?>"
                                            id="icon"
                                            name="icon"
                                            value="<?= set_value('icon', 'fas fa-file') ?>"
                                            placeholder="fas fa-file"
                                            pattern="^fa[srb]? fa-[a-z-]+$"
                                            title="Format: fas fa-nama-icon"
                                            required>
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
                                        value="<?= set_value('order_position', '1') ?>"
                                        min="1"
                                        max="999"
                                        step="1"
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
                                            <?= set_value('is_active', '1') ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="is_active">
                                            <span class="text-success">Aktif</span> / <span class="text-muted">Nonaktif</span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Item aktif akan ditampilkan di menu navigasi website
                                    </small>
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
                                required><?= set_value('content') ?></textarea>
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
                                value="<?= set_value('meta_title') ?>"
                                placeholder="Otomatis dari judul jika kosong"
                                maxlength="60">
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
                                placeholder="Deskripsi singkat untuk SEO"
                                maxlength="160"><?= set_value('meta_description') ?></textarea>
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

                <!-- Help Card -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-question-circle mr-2"></i>
                            Panduan Pengisian
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6><i class="fas fa-heading text-primary mr-1"></i> Judul Item</h6>
                            <p class="text-muted small mb-2">Judul yang akan muncul di menu navigasi. Sebaiknya singkat dan jelas.</p>
                        </div>

                        <div class="mb-3">
                            <h6><i class="fas fa-folder text-primary mr-1"></i> Kategori</h6>
                            <p class="text-muted small mb-2">Pilih kategori yang sesuai untuk mengelompokkan item menu.</p>
                        </div>

                        <div class="mb-3">
                            <h6><i class="fas fa-edit text-primary mr-1"></i> Konten</h6>
                            <p class="text-muted small mb-2">Gunakan editor untuk menulis konten lengkap. Anda bisa menambahkan gambar, tabel, dan format lainnya.</p>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb mr-1"></i>
                            <strong>Tips:</strong> URL halaman akan otomatis dibuat dari judul item menu.
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
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Item Menu
                                </button>
                                <button type="reset" class="btn btn-secondary ml-2">
                                    <i class="fas fa-undo mr-2"></i>
                                    Reset Form
                                </button>
                            </div>
                            <div class="col-lg-6 text-lg-right">
                                <a href="<?= base_url('admin/menu_items') ?>" class="btn btn-light">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
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

        // Auto-fill meta title from title
        $('#title').on('input', function() {
            if ($('#meta_title').val() === '') {
                $('#meta_title').val($(this).val());
            }
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

    // Form validation handler
    $('.needs-validation').on('submit', function(e) {
        var isValid = true;
        var form = this;

        // Clear previous validation states
        $(form).find('.is-invalid').removeClass('is-invalid');
        $(form).find('.invalid-feedback').remove();

        // Title validation
        var title = $('#title').val().trim();
        if (title === '') {
            showFieldError('#title', 'Judul item menu wajib diisi');
            isValid = false;
        } else if (title.length < 3) {
            showFieldError('#title', 'Judul minimal 3 karakter');
            isValid = false;
        } else if (title.length > 100) {
            showFieldError('#title', 'Judul maksimal 100 karakter');
            isValid = false;
        }

        // Category validation
        var categoryId = $('#category_id').val();
        if (categoryId === '' || categoryId === '0') {
            showFieldError('#category_id', 'Kategori menu wajib dipilih');
            isValid = false;
        }

        // Icon validation
        var icon = $('#icon').val().trim();
        if (icon === '') {
            showFieldError('#icon', 'Icon wajib dipilih');
            isValid = false;
        } else if (!icon.match(/^fa[srb]? fa-[a-z-]+$/)) {
            showFieldError('#icon', 'Format icon tidak valid (gunakan format: fas fa-nama-icon)');
            isValid = false;
        }

        // Order position validation
        var orderPosition = $('#order_position').val();
        if (orderPosition === '' || orderPosition < 1) {
            showFieldError('#order_position', 'Urutan tampil minimal 1');
            isValid = false;
        } else if (orderPosition > 999) {
            showFieldError('#order_position', 'Urutan tampil maksimal 999');
            isValid = false;
        }

        // Content validation (Summernote)
        var content = $('#content').summernote('code').trim();
        var textContent = $('<div>').html(content).text().trim();
        if (content === '' || content === '<p><br></p>' || textContent === '') {
            showFieldError('#content', 'Konten item menu wajib diisi');
            isValid = false;
        } else if (textContent.length < 10) {
            showFieldError('#content', 'Konten minimal 10 karakter');
            isValid = false;
        }

        // Meta title validation (optional but with limits)
        var metaTitle = $('#meta_title').val().trim();
        if (metaTitle !== '' && metaTitle.length > 60) {
            showFieldError('#meta_title', 'Meta title maksimal 60 karakter');
            isValid = false;
        }

        // Meta description validation (optional but with limits)
        var metaDescription = $('#meta_description').val().trim();
        if (metaDescription !== '' && metaDescription.length > 160) {
            showFieldError('#meta_description', 'Meta description maksimal 160 karakter');
            isValid = false;
        }

        // For development - allow form submission even with client-side errors
        if (!isValid) {
            // Show summary alert but allow submission
            showValidationSummary();

            // Add warning but don't prevent submission
            console.warn('Client-side validation failed, but allowing server-side validation');

            // Scroll to first error
            var firstError = $('.is-invalid').first();
            if (firstError.length) {
                $('html, body').animate({
                    scrollTop: firstError.offset().top - 100
                }, 500);
            }
        }
        $(form).addClass('was-validated');
        return isValid;
    });

    // Helper function to show field errors
    function showFieldError(fieldSelector, message) {
        var field = $(fieldSelector);
        field.addClass('is-invalid');

        var feedback = $('<div class="invalid-feedback"></div>').text(message);

        // For select fields or input groups, place feedback after the parent div
        if (field.hasClass('form-control') && field.parent().hasClass('input-group')) {
            field.parent().after(feedback);
        } else {
            field.after(feedback);
        }
    }

    // Show validation summary
    function showValidationSummary() {
        var errorCount = $('.is-invalid').length;

        // Remove existing alert
        $('.validation-summary').remove();

        var alertHtml = `
            <div class="alert alert-danger alert-dismissible validation-summary">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="fas fa-exclamation-triangle"></i> Validasi Gagal!</h5>
                <p>Ditemukan <strong>${errorCount}</strong> kesalahan pada form. Mohon periksa dan perbaiki field yang ditandai merah.</p>
            </div>
        `;

        $('.card-body').first().prepend(alertHtml);
    }

    // Real-time character counter for meta fields
    $('#meta_title').on('input', function() {
        var length = $(this).val().length;
        var counter = $(this).next('.char-counter');
        if (counter.length === 0) {
            counter = $('<small class="form-text text-muted char-counter"></small>');
            $(this).after(counter);
        }

        var color = length > 60 ? 'text-danger' : (length > 50 ? 'text-warning' : 'text-muted');
        counter.removeClass('text-muted text-warning text-danger').addClass(color);
        counter.text(`${length}/60 karakter`);
    });

    $('#meta_description').on('input', function() {
        var length = $(this).val().length;
        var counter = $(this).next('.char-counter');
        if (counter.length === 0) {
            counter = $('<small class="form-text text-muted char-counter"></small>');
            $(this).after(counter);
        }

        var color = length > 160 ? 'text-danger' : (length > 140 ? 'text-warning' : 'text-muted');
        counter.removeClass('text-muted text-warning text-danger').addClass(color);
        counter.text(`${length}/160 karakter`);
    });

    // Title character counter
    $('#title').on('input', function() {
        var length = $(this).val().length;
        var counter = $(this).siblings('.char-counter');
        if (counter.length === 0) {
            counter = $('<small class="form-text text-muted char-counter"></small>');
            $(this).after(counter);
        }

        var color = length > 100 ? 'text-danger' : (length > 80 ? 'text-warning' : 'text-muted');
        counter.removeClass('text-muted text-warning text-danger').addClass(color);
        counter.text(`${length}/100 karakter`);
    });

    // Auto-generate meta title from title if empty
    $('#title').on('blur', function() {
        var title = $(this).val().trim();
        var metaTitle = $('#meta_title').val().trim();

        if (title !== '' && metaTitle === '') {
            var autoMetaTitle = title.length > 60 ? title.substring(0, 57) + '...' : title;
            $('#meta_title').val(autoMetaTitle).trigger('input');
        }
    });

    // Reset form handler
    $('button[type="reset"]').click(function() {
        if (confirm('Apakah Anda yakin ingin mereset semua data yang sudah diisi?')) {
            setTimeout(function() {
                $('#icon-preview i').removeClass().addClass('fas fa-file');
                $('.needs-validation').removeClass('was-validated');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback, .validation-summary, .char-counter').remove();
                $('#content').summernote('code', '');
            }, 10);
        } else {
            return false;
        }
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

    .cke_top {
        border-top: 1px solid #d2d6de !important;
    }

    .char-counter {
        float: right;
        font-weight: 500;
    }

    .char-counter.text-warning {
        color: #ffc107 !important;
    }

    .char-counter.text-danger {
        color: #dc3545 !important;
    }

    .validation-summary {
        border-left: 4px solid #dc3545;
    }

    .is-invalid {
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        75% {
            transform: translateX(5px);
        }
    }

    .form-group .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .btn[type="submit"]:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .required-indicator {
        color: #dc3545;
        font-weight: bold;
        margin-left: 2px;
    }
</style>