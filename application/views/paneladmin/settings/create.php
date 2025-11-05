<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Pengaturan Sistem</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/settings') ?>">Pengaturan</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (validation_errors()): ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                <?= validation_errors() ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-plus mr-1"></i>
                            Form Tambah Pengaturan
                        </h3>
                    </div>

                    <?= form_open_multipart('admin/settings/store', ['class' => 'form-horizontal']) ?>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">
                                Nama Aplikasi <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text"
                                    class="form-control <?= form_error('name') ? 'is-invalid' : '' ?>"
                                    name="name"
                                    id="name"
                                    value="<?= set_value('name') ?>"
                                    placeholder="Masukkan nama aplikasi"
                                    required>
                                <div class="invalid-feedback">
                                    <?= form_error('name') ?>
                                </div>
                                <small class="form-text text-muted">Nama aplikasi yang akan ditampilkan di sistem</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <textarea class="form-control <?= form_error('description') ? 'is-invalid' : '' ?>"
                                    name="description"
                                    id="description"
                                    rows="3"
                                    placeholder="Masukkan deskripsi aplikasi"><?= set_value('description') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('description') ?>
                                </div>
                                <small class="form-text text-muted">Deskripsi singkat tentang aplikasi</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company" class="col-sm-3 col-form-label">
                                Nama Perusahaan <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text"
                                    class="form-control <?= form_error('company') ? 'is-invalid' : '' ?>"
                                    name="company"
                                    id="company"
                                    value="<?= set_value('company') ?>"
                                    placeholder="Masukkan nama perusahaan"
                                    required>
                                <div class="invalid-feedback">
                                    <?= form_error('company') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">
                                Alamat <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <textarea class="form-control <?= form_error('address') ? 'is-invalid' : '' ?>"
                                    name="address"
                                    id="address"
                                    rows="3"
                                    placeholder="Masukkan alamat lengkap"
                                    required><?= set_value('address') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= form_error('address') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telepon" class="col-sm-3 col-form-label">
                                Telepon <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text"
                                        class="form-control <?= form_error('telepon') ? 'is-invalid' : '' ?>"
                                        name="telepon"
                                        id="telepon"
                                        value="<?= set_value('telepon') ?>"
                                        placeholder="Contoh: (021) 123-4567"
                                        required>
                                    <div class="invalid-feedback">
                                        <?= form_error('telepon') ?>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Format: nomor telepon dengan kode area</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">
                                Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email"
                                        class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>"
                                        name="email"
                                        id="email"
                                        value="<?= set_value('email') ?>"
                                        placeholder="contoh@email.com"
                                        required>
                                    <div class="invalid-feedback">
                                        <?= form_error('email') ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input"
                                        name="logo"
                                        id="logo"
                                        accept="image/*">
                                    <label class="custom-file-label" for="logo">Pilih file logo...</label>
                                </div>
                                <small class="form-text text-muted">
                                    Format yang diizinkan: JPG, JPEG, PNG, GIF, SVG. Maksimal ukuran: 2MB
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon_file" class="col-sm-3 col-form-label">Icon (File)</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input <?= form_error('icon_file') ? 'is-invalid' : '' ?>"
                                        name="icon_file"
                                        id="icon_file"
                                        accept="image/*">
                                    <label class="custom-file-label" for="icon_file">Pilih file icon...</label>
                                </div>
                                <div class="invalid-feedback">
                                    <?= form_error('icon_file') ?>
                                </div>
                                <small class="form-text text-muted">
                                    Format yang diizinkan: JPG, JPEG, PNG, GIF, SVG, ICO. Maksimal ukuran: 1MB. Recommended: 32x32px atau 64x64px
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon_class" class="col-sm-3 col-form-label">Icon (FontAwesome)</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i id="icon-preview" class="<?= set_value('icon_class', 'fas fa-university') ?>"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                        class="form-control <?= form_error('icon_class') ? 'is-invalid' : '' ?>"
                                        name="icon_class"
                                        id="icon_class"
                                        value="<?= set_value('icon_class', 'fas fa-university') ?>"
                                        placeholder="Contoh: fas fa-university">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="icon-picker-btn" data-toggle="modal" data-target="#iconPickerModal">
                                            <i class="fas fa-search"></i> Pilih
                                        </button>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= form_error('icon_class') ?>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Pilih icon FontAwesome untuk favicon browser. Contoh: fas fa-university, fas fa-graduation-cap
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Simpan Pengaturan
                                </button>
                                <a href="<?= base_url('admin/settings') ?>" class="btn btn-secondary ml-2">
                                    <i class="fas fa-times mr-1"></i> Batal
                                </a>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle mr-1"></i>
                            Panduan
                        </h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Petunjuk Pengisian:</strong></p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Nama Aplikasi:</strong> Wajib diisi, akan tampil di header</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Deskripsi:</strong> Opsional, untuk informasi tambahan</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Perusahaan:</strong> Wajib diisi, nama institusi</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Alamat:</strong> Wajib diisi, alamat lengkap</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Telepon:</strong> Format dengan kode area</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Email:</strong> Untuk notifikasi sistem</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Logo:</strong> Opsional, ukuran max 2MB</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Icon File:</strong> Opsional, untuk favicon (max 1MB)</li>
                            <li><i class="fas fa-check text-success mr-2"></i> <strong>Icon FontAwesome:</strong> Untuk tampilan di browser</li>
                        </ul>

                        <hr>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Perhatian:</strong> Pastikan data yang dimasukkan sudah benar sebelum menyimpan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Custom file input
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });

        // Form validation
        $('#logo').on('change', function() {
            var file = this.files[0];
            if (file) {
                // Check file size (2MB)
                if (file.size > 2048000) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    $(this).val('');
                    $(this).siblings('.custom-file-label').html('Pilih file logo...');
                    return;
                }

                // Check file type
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak diizinkan! Gunakan JPG, PNG, GIF, atau SVG');
                    $(this).val('');
                    $(this).siblings('.custom-file-label').html('Pilih file logo...');
                    return;
                }
            }
        });

        // Auto format phone number
        $('#telepon').on('input', function() {
            var value = $(this).val();
            // Remove all non-numeric characters except +, -, (, ), and space
            value = value.replace(/[^0-9\+\-\(\)\s]/g, '');
            $(this).val(value);
        });

        // Icon file validation
        $('#icon_file').on('change', function() {
            var file = this.files[0];
            if (file) {
                // Check file size (1MB for icon)
                if (file.size > 1048576) {
                    alert('Ukuran file icon terlalu besar! Maksimal 1MB');
                    $(this).val('');
                    $(this).siblings('.custom-file-label').html('Pilih file icon...');
                    return;
                }

                // Check file type
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml', 'image/x-icon'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak diizinkan! Gunakan JPG, PNG, GIF, SVG, atau ICO');
                    $(this).val('');
                    $(this).siblings('.custom-file-label').html('Pilih file icon...');
                    return;
                }
            }
        });

        // Icon class preview
        $('#icon_class').on('input', function() {
            var iconClass = $(this).val() || 'fas fa-university';
            $('#icon-preview').attr('class', iconClass);
        });

        // Icon picker functionality
        $('#iconPickerModal').on('show.bs.modal', function() {
            loadIconPicker();
        });
    });

    // Icon picker data
    var popularIcons = [
        'fas fa-university', 'fas fa-graduation-cap', 'fas fa-school', 'fas fa-book',
        'fas fa-user-graduate', 'fas fa-chalkboard-teacher', 'fas fa-laptop',
        'fas fa-microscope', 'fas fa-flask', 'fas fa-heartbeat', 'fas fa-stethoscope',
        'fas fa-user-md', 'fas fa-hospital', 'fas fa-pills', 'fas fa-syringe',
        'fas fa-dna', 'fas fa-tooth', 'fas fa-eye', 'fas fa-brain',
        'fas fa-home', 'fas fa-cog', 'fas fa-star', 'fas fa-heart',
        'fas fa-check', 'fas fa-times', 'fas fa-plus', 'fas fa-minus',
        'fas fa-search', 'fas fa-envelope', 'fas fa-phone', 'fas fa-map-marker-alt'
    ];

    function loadIconPicker() {
        var iconGrid = $('#iconGrid');
        iconGrid.empty();

        popularIcons.forEach(function(iconClass) {
            var iconHtml = '<div class="col-2 mb-2">' +
                '<button type="button" class="btn btn-outline-secondary btn-sm icon-pick-btn w-100" data-icon="' + iconClass + '">' +
                '<i class="' + iconClass + '"></i>' +
                '</button>' +
                '</div>';
            iconGrid.append(iconHtml);
        });

        // Handle icon selection
        $('.icon-pick-btn').on('click', function() {
            var selectedIcon = $(this).data('icon');
            $('#icon_class').val(selectedIcon);
            $('#icon-preview').attr('class', selectedIcon);
            $('#iconPickerModal').modal('hide');
        });
    }
</script>

<!-- Icon Picker Modal -->
<div class="modal fade" id="iconPickerModal" tabindex="-1" role="dialog" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconPickerModalLabel">
                    <i class="fas fa-icons mr-2"></i>Pilih Icon
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Pilih icon yang sesuai untuk aplikasi Anda:</p>
                <div class="row" id="iconGrid">
                    <!-- Icons will be loaded here -->
                </div>
                <hr>
                <div class="form-group">
                    <label>Atau masukkan class icon manual:</label>
                    <input type="text" class="form-control" id="customIconInput" placeholder="Contoh: fas fa-university">
                    <small class="text-muted">Gunakan icon dari FontAwesome 5. Lihat <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com/icons</a></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Batal
                </button>
                <button type="button" class="btn btn-primary" id="useCustomIcon">
                    <i class="fas fa-check mr-1"></i>Gunakan Custom Icon
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle custom icon input
    $('#useCustomIcon').on('click', function() {
        var customIcon = $('#customIconInput').val();
        if (customIcon.trim()) {
            $('#icon_class').val(customIcon);
            $('#icon-preview').attr('class', customIcon);
            $('#iconPickerModal').modal('hide');
        }
    });
</script>