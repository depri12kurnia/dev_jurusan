<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Validation Errors -->
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger alert-dismissible">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Terdapat kesalahan:</strong>
                <?= validation_errors() ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        <?php endif; ?>

        <form action="<?= $action ?>" method="post" enctype="multipart/form-data" id="prodiForm">

            <div class="row">
                <!-- Main Form -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle mr-2"></i>
                                Informasi Dasar
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nama_prodi" class="col-form-label">Nama Program Studi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                                            value="<?= set_value('nama_prodi') ?>" required>
                                        <div class="form-text">Contoh: Keperawatan, Kebidanan</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kode_prodi" class="col-form-label">Kode Prodi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-uppercase" id="kode_prodi" name="kode_prodi"
                                            value="<?= set_value('kode_prodi') ?>" maxlength="20" required>
                                        <div class="form-text">Contoh: KEP, BID</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenjang" class="col-form-label">Jenjang <span class="text-danger">*</span></label>
                                        <select class="form-control" id="jenjang" name="jenjang" required>
                                            <option value="">Pilih Jenjang</option>
                                            <option value="D3" <?= set_select('jenjang', 'D3') ?>>D3 (Diploma 3)</option>
                                            <option value="D4" <?= set_select('jenjang', 'D4') ?>>D4 (Diploma 4)</option>
                                            <option value="Profesi" <?= set_select('jenjang', 'Profesi') ?>>Profesi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gelar" class="col-form-label">Gelar <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="gelar" name="gelar"
                                            value="<?= set_value('gelar') ?>" required>
                                        <div class="form-text">Contoh: S.Kep, A.Md.Keb, Ns.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi" class="col-form-label">Deskripsi Singkat</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= set_value('deskripsi') ?></textarea>
                                <div class="form-text">Deskripsi singkat program studi untuk tampilan card</div>
                            </div>

                            <div class="form-group">
                                <label for="featured_description" class="col-form-label">Deskripsi Featured</label>
                                <textarea class="form-control" id="featured_description" name="featured_description" rows="3"><?= set_value('featured_description') ?></textarea>
                                <div class="form-text">Deskripsi khusus untuk tampilan featured di homepage</div>
                            </div>
                        </div>
                    </div>

                    <!-- Akademik Info -->
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                Informasi Akademik
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="durasi_studi" class="col-form-label">Durasi Studi (Semester)</label>
                                        <input type="number" class="form-control" id="durasi_studi" name="durasi_studi"
                                            value="<?= set_value('durasi_studi', 8) ?>" min="1" max="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sks_total" class="col-form-label">Total SKS</label>
                                        <input type="number" class="form-control" id="sks_total" name="sks_total"
                                            value="<?= set_value('sks_total', 144) ?>" min="1" max="200">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kuota_mahasiswa" class="col-form-label">Kuota Mahasiswa/Tahun</label>
                                        <input type="number" class="form-control" id="kuota_mahasiswa" name="kuota_mahasiswa"
                                            value="<?= set_value('kuota_mahasiswa', 0) ?>" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="prospek_karir" class="col-form-label">Prospek Karir</label>
                                <textarea class="form-control" id="prospek_karir" name="prospek_karir" rows="4"><?= set_value('prospek_karir') ?></textarea>
                                <div class="form-text">Pisahkan setiap prospek dengan koma</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">

                    <!-- Display Settings -->
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h3 class="card-title">
                                <i class="fas fa-palette mr-2"></i>
                                Pengaturan Tampilan
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="icon" class="col-form-label">Icon FontAwesome</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="iconPreview" class="fas fa-graduation-cap"></i></span>
                                    <input type="text" class="form-control" id="icon" name="icon"
                                        value="<?= set_value('icon', 'fas fa-graduation-cap') ?>">
                                </div>
                                <div class="form-text">Contoh: fas fa-user-nurse, fas fa-baby</div>
                            </div>

                            <div class="form-group">
                                <label for="warna" class="col-form-label">Warna Tema</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color" id="warna" name="warna"
                                        value="<?= set_value('warna', '#00B9AD') ?>">
                                    <input type="text" class="form-control" id="warnaText" value="<?= set_value('warna', '#00B9AD') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="urutan" class="col-form-label">Urutan Tampil</label>
                                <input type="number" class="form-control" id="urutan" name="urutan"
                                    value="<?= set_value('urutan', 0) ?>" min="0">
                                <div class="form-text">Semakin kecil angka, semakin atas urutannya</div>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Publikasi -->
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">
                                <i class="fas fa-toggle-on mr-2"></i>
                                Status & Publikasi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="aktif" <?= set_select('status', 'aktif', TRUE) ?>>Aktif</option>
                                    <option value="nonaktif" <?= set_select('status', 'nonaktif') ?>>Non Aktif</option>
                                </select>
                            </div>

                            <div class="form-check form-group">
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                    value="1" <?= set_checkbox('is_published', '1', TRUE) ?>>
                                <label class="form-check-label" for="is_published">
                                    Publikasi di Website
                                </label>
                            </div>

                            <div class="form-check form-group">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                    value="1" <?= set_checkbox('is_featured', '1') ?>>
                                <label class="form-check-label" for="is_featured">
                                    Tampil di Featured Section
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save mr-2"></i> Simpan Program Studi
                                </button>
                                <a href="<?= site_url('admin/prodi') ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<!-- Scripts -->
<script>
    $(document).ready(function() {
        // Auto-generate kode prodi from nama prodi
        $('#nama_prodi').on('input', function() {
            var nama = $(this).val();
            if (nama && $('#kode_prodi').val() === '') {
                var words = nama.split(' ');
                var kode = '';
                if (words.length > 1) {
                    words.forEach(function(word) {
                        if (word.length > 0) {
                            kode += word.charAt(0);
                        }
                    });
                } else {
                    kode = nama.substring(0, 3);
                }
                $('#kode_prodi').val(kode.toUpperCase());
            }
        });

        // Auto-generate gelar based on jenjang
        $('#jenjang').on('change', function() {
            var jenjang = $(this).val();
            var namaProdi = $('#nama_prodi').val().toLowerCase();
            var gelar = '';

            if (jenjang && $('#gelar').val() === '') {
                if (jenjang === 'D3') {
                    if (namaProdi.includes('keperawatan')) {
                        gelar = 'A.Md.Kep';
                    } else if (namaProdi.includes('kebidanan')) {
                        gelar = 'A.Md.Keb';
                    } else {
                        gelar = 'A.Md.';
                    }
                } else if (jenjang === 'D4') {
                    gelar = 'S.Tr.';
                } else if (jenjang === 'S1') {
                    if (namaProdi.includes('keperawatan')) {
                        gelar = 'S.Kep';
                    } else {
                        gelar = 'S.';
                    }
                } else if (jenjang === 'Profesi') {
                    if (namaProdi.includes('ners') || namaProdi.includes('keperawatan')) {
                        gelar = 'Ns.';
                    } else {
                        gelar = '';
                    }
                }

                $('#gelar').val(gelar);
            }
        });

        // Auto-set durasi studi based on jenjang
        $('#jenjang').on('change', function() {
            var jenjang = $(this).val();
            var durasi = 8;
            var sks = 144;

            if (jenjang === 'D3') {
                durasi = 6;
                sks = 108;
            } else if (jenjang === 'D4' || jenjang === 'S1') {
                durasi = 8;
                sks = 144;
            } else if (jenjang === 'Profesi') {
                durasi = 2;
                sks = 36;
            }

            $('#durasi_studi').val(durasi);
            $('#sks_total').val(sks);
        });

        // Icon preview
        $('#icon').on('input', function() {
            var iconClass = $(this).val();
            $('#iconPreview').attr('class', iconClass);
        });

        // Color sync
        $('#warna').on('change', function() {
            $('#warnaText').val($(this).val());
        });

        $('#warnaText').on('input', function() {
            $('#warna').val($(this).val());
        });

        // Uppercase kode prodi
        $('#kode_prodi').on('input', function() {
            $(this).val($(this).val().toUpperCase());
        });

        // Form validation
        $('#prodiForm').on('submit', function(e) {
            var isValid = true;

            // Check required fields
            $('input[required], select[required]').each(function() {
                if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return false;
            }

            // Show loading state
            $(this).find('button[type="submit"]').prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...');
        });

        // Auto-hide alerts
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>

<!-- Custom CSS AdminLTE 3 -->
<style>
    /* Card Styling */
    .card {
        border-radius: 0.375rem;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.375rem 0.375rem 0 0 !important;
        font-weight: 600;
    }

    .card-title {
        font-weight: 600;
        margin-bottom: 0;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 1rem;
    }

    .col-form-label {
        font-weight: 500;
        color: #495057;
        padding-top: calc(0.375rem + 1px);
        padding-bottom: calc(0.375rem + 1px);
        margin-bottom: 0;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .form-text {
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #6c757d;
    }

    /* Button Styling */
    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    /* Input Group */
    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }

    /* Color Picker */
    .form-control-color {
        max-width: 3rem;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem;
    }

    /* Alert Styling */
    .alert {
        position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.375rem;
    }

    .alert-dismissible .close {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 2;
        padding: 0.75rem 1.25rem;
        color: inherit;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1rem;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
        }

        .col-lg-4,
        .col-lg-8 {
            padding-left: 0;
            padding-right: 0;
        }
    }

    /* File Upload */
    .custom-file-label::after {
        content: "Browse";
    }

    /* Icons */
    .fas,
    .far {
        font-weight: 900;
    }

    /* Loading State */
    .loading {
        pointer-events: none;
        opacity: 0.6;
    }
</style>