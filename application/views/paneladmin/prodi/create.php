<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Tambah Program Studi</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/prodi') ?>">Program Studi</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="fas fa-plus mr-2"></i>Tambah Program Studi Baru
                </h4>
            </div>
            <div class="card-body">
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger">
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('admin/prodi/store') ?>" method="post" enctype="multipart/form-data" id="createProdiForm">
                    <!-- CSRF Token -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-8">
                            <!-- Basic Information -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Informasi Dasar</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="nama_prodi" class="col-form-label">Nama Program Studi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                                                    value="<?= set_value('nama_prodi') ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="kode_prodi" class="col-form-label">Kode Prodi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kode_prodi" name="kode_prodi"
                                                    value="<?= set_value('kode_prodi') ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jenjang" class="col-form-label">Jenjang <span class="text-danger">*</span></label>
                                                <select class="form-control" id="jenjang" name="jenjang" required>
                                                    <option value="">Pilih Jenjang</option>
                                                    <option value="D3" <?= set_select('jenjang', 'D3') ?>>D3</option>
                                                    <option value="D4" <?= set_select('jenjang', 'D4') ?>>D4</option>
                                                    <option value="Profesi" <?= set_select('jenjang', 'Profesi') ?>>Profesi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gelar" class="col-form-label">Gelar <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="gelar" name="gelar"
                                                    value="<?= set_value('gelar') ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="urutan" class="col-form-label">Urutan Tampil</label>
                                                <input type="number" class="form-control" id="urutan" name="urutan"
                                                    value="<?= set_value('urutan') ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= set_value('deskripsi') ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="featured_description" class="col-form-label">Deskripsi Featured</label>
                                        <textarea class="form-control" id="featured_description" name="featured_description" rows="3"><?= set_value('featured_description') ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Vision Mission -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-bullseye mr-2"></i>Visi, Misi & Tujuan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="visi" class="col-form-label">Visi</label>
                                        <textarea class="form-control" id="visi" name="visi" rows="3"><?= set_value('visi') ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="misi" class="col-form-label">Misi</label>
                                        <textarea class="form-control" id="misi" name="misi" rows="4"><?= set_value('misi') ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-form-label">Tujuan</label>
                                        <textarea class="form-control" id="tujuan" name="tujuan" rows="4"><?= set_value('tujuan') ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Info -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-graduation-cap mr-2"></i>Informasi Akademik</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="durasi_studi" class="col-form-label">Durasi Studi (Semester)</label>
                                                <input type="number" class="form-control" id="durasi_studi" name="durasi_studi"
                                                    value="<?= set_value('durasi_studi', 8) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sks_total" class="col-form-label">Total SKS</label>
                                                <input type="number" class="form-control" id="sks_total" name="sks_total"
                                                    value="<?= set_value('sks_total', 144) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="kuota_mahasiswa" class="col-form-label">Kuota Mahasiswa/Tahun</label>
                                                <input type="number" class="form-control" id="kuota_mahasiswa" name="kuota_mahasiswa"
                                                    value="<?= set_value('kuota_mahasiswa') ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="biaya_pendidikan" class="col-form-label">Biaya Pendidikan</label>
                                                <input type="number" class="form-control" id="biaya_pendidikan" name="biaya_pendidikan"
                                                    value="<?= set_value('biaya_pendidikan') ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="akreditasi" class="col-form-label">Akreditasi</label>
                                                <select class="form-control" id="akreditasi" name="akreditasi">
                                                    <option value="">Pilih Akreditasi</option>
                                                    <option value="A" <?= set_select('akreditasi', 'A') ?>>A</option>
                                                    <option value="B" <?= set_select('akreditasi', 'B') ?>>B</option>
                                                    <option value="C" <?= set_select('akreditasi', 'C') ?>>C</option>
                                                    <option value="Unggul" <?= set_select('akreditasi', 'Unggul') ?>>Unggul</option>
                                                    <option value="Baik Sekali" <?= set_select('akreditasi', 'Baik Sekali') ?>>Baik Sekali</option>
                                                    <option value="Baik" <?= set_select('akreditasi', 'Baik') ?>>Baik</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="syarat_masuk" class="col-form-label">Syarat Masuk</label>
                                        <textarea class="form-control" id="syarat_masuk" name="syarat_masuk" rows="4"><?= set_value('syarat_masuk') ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="prospek_karir" class="col-form-label">Prospek Karir</label>
                                        <textarea class="form-control" id="prospek_karir" name="prospek_karir" rows="4"><?= set_value('prospek_karir') ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-4">
                            <!-- Settings -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-cog mr-2"></i>Pengaturan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="aktif" <?= set_select('status', 'aktif', true) ?>>Aktif</option>
                                            <option value="nonaktif" <?= set_select('status', 'nonaktif') ?>>Non Aktif</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                                <?= set_checkbox('is_featured', '1') ?>>
                                            <label class="form-check-label" for="is_featured">
                                                Featured Program
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                                                <?= set_checkbox('is_published', '1', true) ?>>
                                            <label class="form-check-label" for="is_published">
                                                Publish di Website
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Visual Settings -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-palette mr-2"></i>Tampilan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="warna" class="col-form-label">Warna Tema</label>
                                        <div class="input-group">
                                            <input type="color" class="form-control form-control-color" id="warna" name="warna"
                                                value="<?= set_value('warna', '#007bff') ?>" title="Pilih warna">
                                            <input type="text" class="form-control" id="warna_hex"
                                                value="<?= set_value('warna', '#007bff') ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="icon" class="col-form-label">Icon</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="icon" name="icon"
                                                value="<?= set_value('icon', 'fas fa-graduation-cap') ?>" placeholder="fas fa-graduation-cap">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i id="icon-preview" class="<?= set_value('icon', 'fas fa-graduation-cap') ?>"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="text-end">
                                <a href="<?= site_url('admin/prodi') ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success ml-2">
                                    <i class="fas fa-save mr-1"></i> Simpan Program Studi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Color picker sync
        $('#warna').on('input', function() {
            $('#warna_hex').val(this.value);
        });

        // Icon preview
        $('#icon').on('input', function() {
            $('#icon-preview').attr('class', this.value || 'fas fa-graduation-cap');
        });

        // Form validation
        $('#createProdiForm').on('submit', function(e) {
            var isValid = true;

            // Check required fields
            $('.form-control[required], .form-control[required]').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Mohon lengkapi semua field yang wajib diisi!'
                });
            }
        });

        // Remove validation class on input
        $('.form-control, .form-control').on('input change', function() {
            $(this).removeClass('is-invalid');
        });

        // CSRF Token handling
        function getCsrfToken() {
            // Ambil dari meta tag terlebih dahulu
            let metaToken = $('meta[name="csrf-token"]').attr('content');
            if (metaToken) {
                return metaToken;
            }

            // Jika tidak ada, ambil dari cookie
            let token = document.cookie.split('; ')
                .find(row => row.startsWith('csrf_cookie_jkt3='))
                ?.split('=')[1] || '';
            return token;
        }

        // Update CSRF token before form submission
        $('#createProdiForm').on('submit', function() {
            // Update CSRF token dari meta tag atau cookie jika tersedia
            let currentToken = getCsrfToken();
            if (currentToken) {
                $('input[name="<?= $this->security->get_csrf_token_name(); ?>"]').val(currentToken);
            }
        });
    });
</script>