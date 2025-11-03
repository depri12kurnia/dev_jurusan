<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Pengaturan Sistem</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/settings') ?>">Pengaturan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                            <i class="fas fa-edit mr-1"></i>
                            Form Edit Pengaturan
                        </h3>
                    </div>

                    <?= form_open_multipart('admin/settings/update/' . $settings->id, ['class' => 'form-horizontal']) ?>
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
                                    value="<?= set_value('name', $settings->name) ?>"
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
                                    placeholder="Masukkan deskripsi aplikasi"><?= set_value('description', $settings->description) ?></textarea>
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
                                    value="<?= set_value('company', $settings->company) ?>"
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
                                    required><?= set_value('address', $settings->address) ?></textarea>
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
                                        value="<?= set_value('telepon', $settings->telepon) ?>"
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
                                        value="<?= set_value('email', $settings->email) ?>"
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

                                <?php if (!empty($settings->logo)): ?>
                                    <div class="mt-3">
                                        <label class="form-label">Logo Saat Ini:</label><br>
                                        <img src="<?= base_url('assets/uploads/settings/' . $settings->logo) ?>"
                                            alt="Current Logo"
                                            class="img-thumbnail"
                                            style="max-width: 200px; max-height: 150px;">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Update Pengaturan
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
                            Informasi
                        </h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Tips:</strong></p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success mr-2"></i> Pastikan data yang dimasukkan valid</li>
                            <li><i class="fas fa-check text-success mr-2"></i> Logo akan ditampilkan di header sistem</li>
                            <li><i class="fas fa-check text-success mr-2"></i> Email digunakan untuk notifikasi sistem</li>
                            <li><i class="fas fa-check text-success mr-2"></i> Simpan perubahan sebelum meninggalkan halaman</li>
                        </ul>

                        <hr>

                        <p><strong>Terakhir Diupdate:</strong></p>
                        <p class="text-muted">
                            <i class="fas fa-clock mr-1"></i>
                            <?= isset($settings->updated_at) ? date('d M Y H:i', strtotime($settings->updated_at)) : 'Belum ada data' ?>
                        </p>
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
                    return;
                }

                // Check file type
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak diizinkan! Gunakan JPG, PNG, GIF, atau SVG');
                    $(this).val('');
                    return;
                }
            }
        });
    });
</script>