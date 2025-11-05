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
                                placeholder="Deskripsi singkat untuk SEO"><?= set_value('meta_description') ?></textarea>
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

<!-- Include TinyMCE -->
<script src="https://cdn.tiny.cloud/1/rfomaohh19hujun1nzryt3mq18uefwaxa2u4fbgha42iva90/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Initialize TinyMCE
        tinymce.init({
            selector: '#content',
            height: 400,
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save | insertfile image media link anchor codesample | ltr rtl',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',

            // Content security
            extended_valid_elements: 'div[*],span[*],p[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],ul[*],ol[*],li[*],a[*],img[*],table[*],tr[*],td[*],th[*],tbody[*],thead[*],strong,em,u,br',
            invalid_elements: 'script,iframe[src],object,embed,applet',

            // Image and file upload
            images_upload_url: '<?= base_url("admin/upload/tinymce_image") ?>',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            },

            // Paste settings
            paste_data_images: true,
            paste_as_text: false,

            // Content filtering
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
            ],

            // Additional settings
            branding: false,
            promotion: false,
            resize: true,
            statusbar: true
        }); // Icon preview update
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
            // Update TinyMCE content
            tinymce.triggerSave();

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

    // Reset form handler
    $('button[type="reset"]').click(function() {
        setTimeout(function() {
            $('#icon-preview i').removeClass().addClass('fas fa-file');
            $('.needs-validation').removeClass('was-validated');
            tinymce.get('content').setContent('');
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

    .cke_top {
        border-top: 1px solid #d2d6de !important;
    }
</style>