<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Program Studi</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/prodi') ?>">Program Studi</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                    <i class="fas fa-edit mr-2"></i>Edit Program Studi: <?= $prodi->nama_prodi ?>
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

                <form action="<?= site_url('admin/prodi/update/' . $prodi->id) ?>" method="post" enctype="multipart/form-data" id="editProdiForm">
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
                                                    value="<?= set_value('nama_prodi', $prodi->nama_prodi) ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="kode_prodi" class="col-form-label">Kode Prodi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="kode_prodi" name="kode_prodi"
                                                    value="<?= set_value('kode_prodi', $prodi->kode_prodi) ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jenjang" class="col-form-label">Jenjang <span class="text-danger">*</span></label>
                                                <select class="form-control" id="jenjang" name="jenjang" required>
                                                    <option value="">Pilih Jenjang</option>
                                                    <option value="D3" <?= set_select('jenjang', 'D3', $prodi->jenjang == 'D3') ?>>D3</option>
                                                    <option value="D4" <?= set_select('jenjang', 'D4', $prodi->jenjang == 'D4') ?>>D4</option>
                                                    <option value="Profesi" <?= set_select('jenjang', 'Profesi', $prodi->jenjang == 'Profesi') ?>>Profesi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gelar" class="col-form-label">Gelar <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="gelar" name="gelar"
                                                    value="<?= set_value('gelar', $prodi->gelar) ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="urutan" class="col-form-label">Urutan Tampil</label>
                                                <input type="number" class="form-control" id="urutan" name="urutan"
                                                    value="<?= set_value('urutan', $prodi->urutan) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= set_value('deskripsi', $prodi->deskripsi) ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="featured_description" class="col-form-label">Deskripsi Featured</label>
                                        <textarea class="form-control" id="featured_description" name="featured_description" rows="3"><?= set_value('featured_description', $prodi->featured_description) ?></textarea>
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
                                        <textarea class="form-control" id="visi" name="visi" rows="3"><?= set_value('visi', $prodi->visi) ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="misi" class="col-form-label">Misi</label>
                                        <textarea class="form-control" id="misi" name="misi" rows="4"><?= set_value('misi', $prodi->misi) ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan" class="col-form-label">Tujuan</label>
                                        <textarea class="form-control" id="tujuan" name="tujuan" rows="4"><?= set_value('tujuan', $prodi->tujuan) ?></textarea>
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
                                                    value="<?= set_value('durasi_studi', $prodi->durasi_studi) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sks_total" class="col-form-label">Total SKS</label>
                                                <input type="number" class="form-control" id="sks_total" name="sks_total"
                                                    value="<?= set_value('sks_total', $prodi->sks_total) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="kuota_mahasiswa" class="col-form-label">Kuota Mahasiswa/Tahun</label>
                                                <input type="number" class="form-control" id="kuota_mahasiswa" name="kuota_mahasiswa"
                                                    value="<?= set_value('kuota_mahasiswa', $prodi->kuota_mahasiswa) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_pendidikan" class="col-form-label">Biaya Pendidikan</label>
                                        <input type="number" class="form-control" id="biaya_pendidikan" name="biaya_pendidikan"
                                            value="<?= set_value('biaya_pendidikan', $prodi->biaya_pendidikan) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="syarat_masuk" class="col-form-label">Syarat Masuk</label>
                                        <textarea class="form-control" id="syarat_masuk" name="syarat_masuk" rows="4"><?= set_value('syarat_masuk', $prodi->syarat_masuk) ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="prospek_karir" class="col-form-label">Prospek Karir</label>
                                        <textarea class="form-control" id="prospek_karir" name="prospek_karir" rows="4"><?= set_value('prospek_karir', $prodi->prospek_karir) ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-bar mr-2"></i>Statistik & KPI</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jumlah_dosen" class="col-form-label">Jumlah Dosen</label>
                                                <input type="number" class="form-control" id="jumlah_dosen" name="jumlah_dosen"
                                                    value="<?= set_value('jumlah_dosen', $prodi->jumlah_dosen) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jumlah_mahasiswa_aktif" class="col-form-label">Mahasiswa Aktif</label>
                                                <input type="number" class="form-control" id="jumlah_mahasiswa_aktif" name="jumlah_mahasiswa_aktif"
                                                    value="<?= set_value('jumlah_mahasiswa_aktif', $prodi->jumlah_mahasiswa_aktif) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jumlah_alumni" class="col-form-label">Jumlah Alumni</label>
                                                <input type="number" class="form-control" id="jumlah_alumni" name="jumlah_alumni"
                                                    value="<?= set_value('jumlah_alumni', $prodi->jumlah_alumni) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tingkat_kepuasan_mahasiswa" class="col-form-label">Tingkat Kepuasan Mahasiswa (%)</label>
                                                <input type="number" class="form-control" id="tingkat_kepuasan_mahasiswa" name="tingkat_kepuasan_mahasiswa"
                                                    min="0" max="100" value="<?= set_value('tingkat_kepuasan_mahasiswa', $prodi->tingkat_kepuasan_mahasiswa) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tingkat_kelulusan" class="col-form-label">Tingkat Kelulusan (%)</label>
                                                <input type="number" class="form-control" id="tingkat_kelulusan" name="tingkat_kelulusan"
                                                    min="0" max="100" value="<?= set_value('tingkat_kelulusan', $prodi->tingkat_kelulusan) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lama_tunggu_kerja" class="col-form-label">Lama Tunggu Kerja (bulan)</label>
                                                <input type="number" class="form-control" id="lama_tunggu_kerja" name="lama_tunggu_kerja"
                                                    value="<?= set_value('lama_tunggu_kerja', $prodi->lama_tunggu_kerja) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact & Leadership -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-address-book mr-2"></i>Kontak & Pimpinan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kepala_prodi" class="col-form-label">Kepala Program Studi</label>
                                                <input type="text" class="form-control" id="kepala_prodi" name="kepala_prodi"
                                                    value="<?= set_value('kepala_prodi', $prodi->kepala_prodi) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sekretaris_prodi" class="col-form-label">Sekretaris Program Studi</label>
                                                <input type="text" class="form-control" id="sekretaris_prodi" name="sekretaris_prodi"
                                                    value="<?= set_value('sekretaris_prodi', $prodi->sekretaris_prodi) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kontak_person" class="col-form-label">Contact Person</label>
                                                <input type="text" class="form-control" id="kontak_person" name="kontak_person"
                                                    value="<?= set_value('kontak_person', $prodi->kontak_person) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="col-form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="<?= set_value('email', $prodi->email) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telepon" class="col-form-label">Telepon</label>
                                                <input type="text" class="form-control" id="telepon" name="telepon"
                                                    value="<?= set_value('telepon', $prodi->telepon) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="website" class="col-form-label">Website</label>
                                                <input type="url" class="form-control" id="website" name="website"
                                                    value="<?= set_value('website', $prodi->website) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= set_value('alamat', $prodi->alamat) ?></textarea>
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
                                            <option value="aktif" <?= set_select('status', 'aktif', $prodi->status == 'aktif') ?>>Aktif</option>
                                            <option value="nonaktif" <?= set_select('status', 'nonaktif', $prodi->status == 'nonaktif') ?>>Non Aktif</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                                <?= set_checkbox('is_featured', '1', $prodi->is_featured) ?>>
                                            <label class="form-check-label" for="is_featured">
                                                Featured Program
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                                                <?= set_checkbox('is_published', '1', $prodi->is_published) ?>>
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
                                                value="<?= set_value('warna', $prodi->warna ?: '#007bff') ?>" title="Pilih warna">
                                            <input type="text" class="form-control" id="warna_hex"
                                                value="<?= set_value('warna', $prodi->warna ?: '#007bff') ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="icon" class="col-form-label">Icon</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i id="icon-preview" class="<?= $prodi->icon ?: 'fas fa-graduation-cap' ?>"></i>
                                            </span>
                                            <input type="text" class="form-control" id="icon" name="icon"
                                                value="<?= set_value('icon', $prodi->icon) ?>" placeholder="fas fa-graduation-cap">
                                        </div>
                                        <div class="form-text">Gunakan icon FontAwesome. Contoh: fas fa-graduation-cap</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accreditation -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-certificate mr-2"></i>Akreditasi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="akreditasi" class="col-form-label">Status Akreditasi</label>
                                        <select class="form-control" id="akreditasi" name="akreditasi">
                                            <option value="">Belum Terakreditasi</option>
                                            <option value="A" <?= set_select('akreditasi', 'A', $prodi->akreditasi == 'A') ?>>A</option>
                                            <option value="B" <?= set_select('akreditasi', 'B', $prodi->akreditasi == 'B') ?>>B</option>
                                            <option value="C" <?= set_select('akreditasi', 'C', $prodi->akreditasi == 'C') ?>>C</option>
                                            <option value="Unggul" <?= set_select('akreditasi', 'Unggul', $prodi->akreditasi == 'Unggul') ?>>Unggul</option>
                                            <option value="Baik Sekali" <?= set_select('akreditasi', 'Baik Sekali', $prodi->akreditasi == 'Baik Sekali') ?>>Baik Sekali</option>
                                            <option value="Baik" <?= set_select('akreditasi', 'Baik', $prodi->akreditasi == 'Baik') ?>>Baik</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_sk_akreditasi" class="col-form-label">No. SK Akreditasi</label>
                                        <input type="text" class="form-control" id="no_sk_akreditasi" name="no_sk_akreditasi"
                                            value="<?= set_value('no_sk_akreditasi', $prodi->no_sk_akreditasi) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_akreditasi" class="col-form-label">Tanggal Akreditasi</label>
                                        <input type="date" class="form-control" id="tanggal_akreditasi" name="tanggal_akreditasi"
                                            value="<?= set_value('tanggal_akreditasi', $prodi->tanggal_akreditasi) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="masa_berlaku_akreditasi" class="col-form-label">Masa Berlaku</label>
                                        <input type="date" class="form-control" id="masa_berlaku_akreditasi" name="masa_berlaku_akreditasi"
                                            value="<?= set_value('masa_berlaku_akreditasi', $prodi->masa_berlaku_akreditasi) ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Files -->
                            <div class="card border">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-file-image mr-2"></i>File</h5>
                                </div>
                                <div class="card-body">


                                    <?php if ($prodi->banner): ?>
                                        <div class="form-group">
                                            <label class="col-form-label">Banner Saat Ini</label>
                                            <div class="text-center">
                                                <img src="<?= base_url('public/uploads/prodi/banner/' . $prodi->banner) ?>"
                                                    alt="Banner" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <label for="banner" class="col-form-label">Banner Program Studi</label>
                                        <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
                                        <div class="form-text">Format: JPG, JPEG, PNG. Ukuran maksimal: 5MB. Rasio 16:9</div>
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
                                    <i class="fas fa-save mr-1"></i> Update Program Studi
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
        // Auto generate kode from nama
        $('#nama_prodi').on('input', function() {
            if ($('#kode_prodi').val() == '') {
                let nama = $(this).val();
                let kode = nama.split(' ').map(word => word.charAt(0).toUpperCase()).join('');
                $('#kode_prodi').val(kode);
            }
        });

        // Auto generate gelar based on jenjang
        $('#jenjang').change(function() {
            if ($('#gelar').val() == '') {
                let jenjang = $(this).val();
                let gelar = '';

                switch (jenjang) {
                    case 'D3':
                        gelar = 'A.Md.';
                        break;
                    case 'D4':
                        gelar = 'S.Tr.';
                        break;
                    case 'Profesi':
                        gelar = '';
                        break;

                }

                $('#gelar').val(gelar);
            }
        });

        // Color picker sync
        $('#warna').on('input', function() {
            $('#warna_hex').val($(this).val());
        });

        // Icon preview
        $('#icon').on('input', function() {
            let iconClass = $(this).val() || 'fas fa-graduation-cap';
            $('#icon-preview').attr('class', iconClass);
        });

        // Form validation
        $('#editProdiForm').on('submit', function(e) {
            let isValid = true;

            // Required fields validation
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
    });
</script>