<style>
    .breadcrumb-section {
        background: var(--bg-light);
        padding: 20px 0;
    }

    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('') ?>">Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('program-studi') ?>">Program Studi</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('program-studi/jenjang/' . strtolower($prodi->jenjang)) ?>"><?= $prodi->jenjang ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $prodi->nama_prodi ?></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Program Detail Hero -->
<section class="program-hero py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, <?= $prodi->warna ?> 0%, <?= $prodi->warna ?>cc 50%, <?= $prodi->warna ?>90 100%);">
    <!-- Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22rgba(255,255,255,0.1)%22 fill-opacity=%220.4%22%3E%3Ccircle cx=%2215%22 cy=%2215%22 r=%222%22/%3E%3Ccircle cx=%2245%22 cy=%2215%22 r=%222%22/%3E%3Ccircle cx=%2230%22 cy=%2230%22 r=%222%22/%3E%3Ccircle cx=%2215%22 cy=%2245%22 r=%222%22/%3E%3Ccircle cx=%2245%22 cy=%2245%22 r=%222%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.5;">
    </div>

    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="d-flex align-items-start mb-4">
                    <div class="program-icon-large me-4 shadow-lg" style="background: rgba(255,255,255,0.25); width: 100px; height: 100px; border-radius: 25px; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.3);">
                        <i class="<?= $prodi->icon ?> fa-3x text-white"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="mb-3">
                            <span class="badge bg-light text-dark me-2 px-3 py-2 rounded-pill"><?= $prodi->jenjang ?></span>
                            <span class="badge bg-light text-dark me-2 px-3 py-2 rounded-pill"><?= $prodi->kode_prodi ?></span>
                            <?php if ($prodi->is_featured): ?>
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                    <i class="fas fa-star me-1"></i> Unggulan
                                </span>
                            <?php endif; ?>
                            <?php if ($prodi->akreditasi): ?>
                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    <i class="fas fa-award me-1"></i> Akreditasi <?= $prodi->akreditasi ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <h1 class="text-white fw-bold mb-2 display-5"><?= $prodi->nama_prodi ?></h1>
                        <p class="text-white-75 fs-5 mb-0">
                            <i class="fas fa-graduation-cap me-2"></i> Gelar: <?= $prodi->gelar ?>
                        </p>
                    </div>
                </div>

                <?php if ($prodi->deskripsi): ?>
                    <div class="card bg-white bg-opacity-10 backdrop-blur border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <p class="text-white mb-0 fs-6 lh-lg"><?= $prodi->deskripsi ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row g-3">
                    <?php if ($prodi->durasi_studi): ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-white border-0 text-center h-100 shadow-sm hover-lift-sm" style="backdrop-filter: blur(10px);">
                                <div class="card-body p-4">
                                    <div class="icon-wrapper mb-3">
                                        <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-calendar-alt fa-xl text-white"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold text-primary mb-2"><?= $prodi->durasi_studi ?></h3>
                                    <p class="text-muted mb-0 small fw-semibold">Semester</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($prodi->sks_total): ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-white border-0 text-center h-100 shadow-sm hover-lift-sm" style="backdrop-filter: blur(10px);">
                                <div class="card-body p-4">
                                    <div class="icon-wrapper mb-3">
                                        <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-book fa-xl text-white"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold text-success mb-2"><?= $prodi->sks_total ?></h3>
                                    <p class="text-muted mb-0 small fw-semibold">Total SKS</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($prodi->kuota_mahasiswa): ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-white border-0 text-center h-100 shadow-sm hover-lift-sm" style="backdrop-filter: blur(10px);">
                                <div class="card-body p-4">
                                    <div class="icon-wrapper mb-3">
                                        <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-users fa-xl text-white"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold text-info mb-2"><?= $prodi->kuota_mahasiswa ?></h3>
                                    <p class="text-muted mb-0 small fw-semibold">Kuota/Tahun</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($prodi->biaya_pendidikan): ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-white border-0 text-center h-100 shadow-sm hover-lift-sm" style="backdrop-filter: blur(10px);">
                                <div class="card-body p-4">
                                    <div class="icon-wrapper mb-3">
                                        <div class="bg-warning bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-money-bill-wave fa-xl text-white"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold text-warning mb-2">Rp <?= number_format($prodi->biaya_pendidikan / 1000000, 1) ?>Jt</h3>
                                    <p class="text-muted mb-0 small fw-semibold">Biaya/Semester</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4 text-center" data-aos="fade-left">
                <div class="position-relative">
                    <!-- Hero Image/Illustration -->
                    <div class="program-hero-illustration mb-4">
                        <div class="position-relative d-inline-block">
                            <div class="program-placeholder shadow-lg" style="width: 250px; height: 250px; background: rgba(255,255,255,0.25); border-radius: 30px; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 3px solid rgba(255,255,255,0.3);">
                                <i class="<?= $prodi->icon ?> display-1 text-white"></i>
                            </div>
                            <!-- Floating elements -->
                            <div class="position-absolute top-0 start-0 translate-middle">
                                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                    <i class="fas fa-graduation-cap text-white"></i>
                                </div>
                            </div>
                            <div class="position-absolute top-0 end-0 translate-middle">
                                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                    <i class="fas fa-certificate text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Details -->
<section class="program-details py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Tabs Navigation -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pb-0">
                        <ul class="nav nav-pills nav-fill" id="programTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active rounded-pill" id="overview-tab" data-bs-toggle="pill" href="#overview" role="tab">
                                    <i class="fas fa-info-circle me-2"></i> Gambaran Umum
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-pill" id="curriculum-tab" data-bs-toggle="pill" href="#curriculum" role="tab">
                                    <i class="fas fa-book me-2"></i> Kurikulum
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-pill" id="career-tab" data-bs-toggle="pill" href="#career" role="tab">
                                    <i class="fas fa-briefcase me-2"></i> Prospek Karir
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-pill" id="requirements-tab" data-bs-toggle="pill" href="#requirements" role="tab">
                                    <i class="fas fa-list-check me-2"></i> Persyaratan
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tabs Content -->
                    <div class="card-body pt-4">
                        <div class="tab-content" id="programTabsContent"> <!-- Overview Tab -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <?php if ($prodi->visi || $prodi->misi || $prodi->tujuan): ?>
                                    <div class="row mb-5">
                                        <?php if ($prodi->visi): ?>
                                            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                                                <div class="card border-0 shadow-lg h-100 hover-lift">
                                                    <div class="card-body text-center p-4">
                                                        <div class="icon-circle bg-primary bg-gradient text-white mb-4 mx-auto" style="width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fas fa-eye fa-2x"></i>
                                                        </div>
                                                        <h5 class="fw-bold text-primary mb-3">Visi</h5>
                                                        <p class="text-muted lh-lg"><?= nl2br($prodi->visi) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($prodi->misi): ?>
                                            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                                                <div class="card border-0 shadow-lg h-100 hover-lift">
                                                    <div class="card-body text-center p-4">
                                                        <div class="icon-circle bg-success bg-gradient text-white mb-4 mx-auto" style="width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fas fa-target fa-2x"></i>
                                                        </div>
                                                        <h5 class="fw-bold text-success mb-3">Misi</h5>
                                                        <p class="text-muted lh-lg"><?= nl2br($prodi->misi) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($prodi->tujuan): ?>
                                            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                                                <div class="card border-0 shadow-lg h-100 hover-lift">
                                                    <div class="card-body text-center p-4">
                                                        <div class="icon-circle bg-warning bg-gradient text-white mb-4 mx-auto" style="width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fas fa-bullseye fa-2x"></i>
                                                        </div>
                                                        <h5 class="fw-bold text-warning mb-3">Tujuan</h5>
                                                        <p class="text-muted lh-lg"><?= nl2br($prodi->tujuan) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($prodi->featured_description): ?>
                                    <div class="mb-4">
                                        <h4 class="font-weight-bold mb-3">Tentang Program Studi</h4>
                                        <p class="text-muted"><?= nl2br($prodi->featured_description) ?></p>
                                    </div>
                                <?php endif; ?>

                                <!-- Keunggulan -->
                                <div class="mb-4">
                                    <h4 class="font-weight-bold mb-3">Keunggulan Program</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <?php if ($prodi->akreditasi): ?>
                                                    <li class="mb-2">
                                                        <i class="fas fa-check text-success mr-2"></i>
                                                        Terakreditasi <?= $prodi->akreditasi ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($prodi->jumlah_dosen): ?>
                                                    <li class="mb-2">
                                                        <i class="fas fa-check text-success mr-2"></i>
                                                        <?= $prodi->jumlah_dosen ?> Dosen Berpengalaman
                                                    </li>
                                                <?php endif; ?>

                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success mr-2"></i>
                                                    Kurikulum Sesuai Industri
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success mr-2"></i>
                                                    Fasilitas Laboratorium Modern
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success mr-2"></i>
                                                    Kerjasama dengan Industri
                                                </li>
                                                <li class="mb-2">
                                                    <i class="fas fa-check text-success mr-2"></i>
                                                    Program Magang Terintegrasi
                                                </li>

                                                <?php if ($prodi->tingkat_kelulusan): ?>
                                                    <li class="mb-2">
                                                        <i class="fas fa-check text-success mr-2"></i>
                                                        Tingkat Kelulusan <?= $prodi->tingkat_kelulusan ?>%
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($prodi->lama_tunggu_kerja): ?>
                                                    <li class="mb-2">
                                                        <i class="fas fa-check text-success mr-2"></i>
                                                        Rata-rata Tunggu Kerja <?= $prodi->lama_tunggu_kerja ?> Bulan
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Curriculum Tab -->
                            <div class="tab-pane fade" id="curriculum" role="tabpanel">
                                <h4 class="font-weight-bold mb-3">Struktur Kurikulum</h4>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card border-primary">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="mb-0">Informasi Kurikulum</h6>
                                            </div>
                                            <div class="card-body">
                                                <?php if ($prodi->durasi_studi): ?>
                                                    <p><strong>Durasi Studi:</strong> <?= $prodi->durasi_studi ?> Semester</p>
                                                <?php endif; ?>

                                                <?php if ($prodi->sks_total): ?>
                                                    <p><strong>Total SKS:</strong> <?= $prodi->sks_total ?> SKS</p>
                                                <?php endif; ?>

                                                <p><strong>Jenjang:</strong> <?= $prodi->jenjang ?></p>
                                                <p><strong>Gelar:</strong> <?= $prodi->gelar ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <?php if ($prodi->akreditasi): ?>
                                            <div class="card border-success">
                                                <div class="card-header bg-success text-white">
                                                    <h6 class="mb-0">Status Akreditasi</h6>
                                                </div>
                                                <div class="card-body">
                                                    <p><strong>Akreditasi:</strong> <?= $prodi->akreditasi ?></p>

                                                    <?php if ($prodi->no_sk_akreditasi): ?>
                                                        <p><strong>No. SK:</strong> <?= $prodi->no_sk_akreditasi ?></p>
                                                    <?php endif; ?>

                                                    <?php if ($prodi->tanggal_akreditasi): ?>
                                                        <p><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($prodi->tanggal_akreditasi)) ?></p>
                                                    <?php endif; ?>

                                                    <?php if ($prodi->masa_berlaku_akreditasi): ?>
                                                        <p><strong>Berlaku Hingga:</strong> <?= date('d/m/Y', strtotime($prodi->masa_berlaku_akreditasi)) ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Kurikulum dirancang sesuai dengan kebutuhan industri dan perkembangan teknologi terkini untuk memastikan lulusan siap kerja dan kompetitif di dunia kerja.
                                </div>
                            </div>

                            <!-- Career Tab -->
                            <div class="tab-pane fade" id="career" role="tabpanel">
                                <h4 class="font-weight-bold mb-3">Prospek Karir Lulusan</h4>

                                <?php if ($prodi->prospek_karir): ?>
                                    <div class="mb-4">
                                        <?= nl2br($prodi->prospek_karir) ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Statistics -->
                                <?php if ($prodi->tingkat_kepuasan_mahasiswa || $prodi->tingkat_kelulusan || $prodi->lama_tunggu_kerja): ?>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="font-weight-bold mb-3">Statistik Lulusan</h5>
                                        </div>

                                        <?php if ($prodi->tingkat_kepuasan_mahasiswa): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="card border-0 shadow-sm text-center">
                                                    <div class="card-body">
                                                        <h3 class="text-primary"><?= $prodi->tingkat_kepuasan_mahasiswa ?>%</h3>
                                                        <p class="text-muted mb-0">Tingkat Kepuasan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($prodi->tingkat_kelulusan): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="card border-0 shadow-sm text-center">
                                                    <div class="card-body">
                                                        <h3 class="text-success"><?= $prodi->tingkat_kelulusan ?>%</h3>
                                                        <p class="text-muted mb-0">Tingkat Kelulusan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($prodi->lama_tunggu_kerja): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="card border-0 shadow-sm text-center">
                                                    <div class="card-body">
                                                        <h3 class="text-warning"><?= $prodi->lama_tunggu_kerja ?></h3>
                                                        <p class="text-muted mb-0">Bulan Tunggu Kerja</p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($prodi->jumlah_alumni): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-users mr-2"></i>
                                        <strong><?= number_format($prodi->jumlah_alumni) ?> Alumni</strong> telah berhasil menyelesaikan program studi ini dan berkarir di berbagai bidang industri.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Requirements Tab -->
                            <div class="tab-pane fade" id="requirements" role="tabpanel">
                                <h4 class="font-weight-bold mb-3">Persyaratan Masuk</h4>

                                <?php if ($prodi->syarat_masuk): ?>
                                    <div class="mb-4">
                                        <?= nl2br($prodi->syarat_masuk) ?>
                                    </div>
                                <?php endif; ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Persyaratan Umum:</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-check text-success mr-2"></i>
                                                Lulusan SMA/SMK/MA sederajat
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-check text-success mr-2"></i>
                                                Memiliki ijazah dan transkrip nilai
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-check text-success mr-2"></i>
                                                Lulus tes seleksi masuk
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-check text-success mr-2"></i>
                                                Sehat jasmani dan rohani
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold">Dokumen yang Diperlukan:</h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-file text-primary mr-2"></i>
                                                Fotokopi ijazah yang dilegalisir
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-file text-primary mr-2"></i>
                                                Fotokopi transkrip nilai
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-file text-primary mr-2"></i>
                                                Fotokopi KTP dan KK
                                            </li>
                                            <li class="list-group-item border-0 px-0">
                                                <i class="fas fa-file text-primary mr-2"></i>
                                                Pas foto terbaru 3x4 (3 lembar)
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <?php if ($prodi->biaya_pendidikan): ?>
                                    <div class="mt-4">
                                        <div class="card border-info">
                                            <div class="card-header bg-info text-white">
                                                <h6 class="mb-0"><i class="fas fa-money-bill-wave mr-2"></i>Informasi Biaya</h6>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0"><strong>Biaya Pendidikan:</strong> Rp <?= number_format($prodi->biaya_pendidikan, 0, ',', '.') ?> per semester</p>
                                                <small class="text-muted">*Belum termasuk biaya buku, praktikum, dan biaya lainnya</small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- CTA Card -->
                <div class="card border-0 shadow-lg mb-4 position-relative overflow-hidden">
                    <!-- Background Gradient -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 gradient-animated"></div>

                    <!-- Content -->
                    <div class="card-body text-white text-center p-4 position-relative" style="z-index: 2;">
                        <!-- Icon with Animation -->
                        <div class="mb-4">
                            <div class="bg-white bg-opacity-20 rounded-circle mx-auto d-flex align-items-center justify-content-center shadow-lg" style="width: 100px; height: 100px;">
                                <i class="fas fa-graduation-cap fa-3x text-white"></i>
                            </div>
                        </div>

                        <h4 class="fw-bold mb-3">Tertarik dengan Program Ini?</h4>
                        <p class="mb-4 text-white-75 lh-lg">Bergabunglah dengan ribuan mahasiswa yang telah merasakan pengalaman belajar berkualitas tinggi!</p>

                        <!-- CTA Buttons -->
                        <div class="d-grid gap-2">
                            <a href="<?= site_url('pendaftaran?prodi=' . $prodi->kode_prodi) ?>" class="btn btn-light btn-lg fw-semibold shadow hover-lift">
                                <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                            </a>
                            <a href="<?= site_url('konsultasi') ?>" class="btn btn-outline-light fw-semibold">
                                <i class="fas fa-comments me-2"></i> Konsultasi Gratis
                            </a>
                        </div>

                        <!-- Additional Info -->
                        <div class="mt-4 pt-3 border-top border-white border-opacity-25">
                            <small class="text-white-75">
                                <i class="fas fa-clock me-1"></i> Setiap Pembukaan Pendaftaran Buka Website Ini
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Contact Card -->
                <div class="card border-0 shadow-lg mb-4 hover-lift">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0 fw-semibold">
                            <i class="fas fa-address-book me-2"></i>Informasi Kontak
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <?php if ($prodi->kepala_prodi): ?>
                            <div class="mb-3 p-3 bg-light rounded">
                                <div class="fw-bold text-primary mb-1">Kepala Program Studi</div>
                                <div class="text-dark"><?= $prodi->kepala_prodi ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($prodi->kontak_person): ?>
                            <div class="mb-3 p-3 bg-light rounded">
                                <div class="fw-bold text-primary mb-1">Contact Person</div>
                                <div class="text-dark"><?= $prodi->kontak_person ?></div>
                            </div>
                        <?php endif; ?>

                        <div class="contact-links">
                            <?php if ($prodi->email): ?>
                                <a href="mailto:<?= $prodi->email ?>" class="d-flex align-items-center text-decoration-none mb-3 p-3 bg-light rounded hover-lift-sm">
                                    <div class="bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">Email</div>
                                        <small class="text-muted"><?= $prodi->email ?></small>
                                    </div>
                                </a>
                            <?php endif; ?>

                            <?php if ($prodi->telepon): ?>
                                <a href="tel:<?= $prodi->telepon ?>" class="d-flex align-items-center text-decoration-none mb-3 p-3 bg-light rounded hover-lift-sm">
                                    <div class="bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">Telepon</div>
                                        <small class="text-muted"><?= $prodi->telepon ?></small>
                                    </div>
                                </a>
                            <?php endif; ?>

                            <?php if ($prodi->website): ?>
                                <a href="<?= $prodi->website ?>" target="_blank" class="d-flex align-items-center text-decoration-none mb-3 p-3 bg-light rounded hover-lift-sm">
                                    <div class="bg-info text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">Website</div>
                                        <small class="text-muted">Kunjungi website program studi</small>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <?php if ($prodi->jumlah_dosen || $prodi->jumlah_mahasiswa_aktif): ?>
                    <div class="card border-0 shadow-lg mb-4 hover-lift">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0 fw-semibold">
                                <i class="fas fa-chart-bar me-2"></i>Statistik Program
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <?php if ($prodi->jumlah_dosen): ?>
                                <div class="stat-item mb-3">
                                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Dosen Berkualitas</div>
                                                <small class="text-muted">Pengajar berpengalaman</small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fw-bold text-primary mb-0"><?= $prodi->jumlah_dosen ?></h4>
                                            <small class="text-muted">Orang</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($prodi->jumlah_mahasiswa_aktif): ?>
                                <div class="stat-item mb-3">
                                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user-graduate"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Mahasiswa Aktif</div>
                                                <small class="text-muted">Sedang menempuh studi</small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fw-bold text-success mb-0"><?= number_format($prodi->jumlah_mahasiswa_aktif) ?></h4>
                                            <small class="text-muted">Orang</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($prodi->jumlah_alumni): ?>
                                <div class="stat-item">
                                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Total Alumni</div>
                                                <small class="text-muted">Lulusan sukses</small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fw-bold text-info mb-0"><?= number_format($prodi->jumlah_alumni) ?></h4>
                                            <small class="text-muted">Orang</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Related Programs -->
<?php if (!empty($related_programs)): ?>
    <section class="related-programs py-5 bg-light">
        <div class="container">
            <h3 class="font-weight-bold mb-4 text-center">Program Studi Terkait</h3>
            <p class="text-muted text-center mb-5">Program studi lain dengan jenjang <?= $prodi->jenjang ?> yang mungkin menarik bagi Anda</p>

            <div class="row">
                <?php foreach ($related_programs as $related): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card program-card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="program-icon mx-auto mb-3" style="background: linear-gradient(135deg, <?= $related->warna ?>, <?= $related->warna ?>90); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="<?= $related->icon ?> fa-lg text-white"></i>
                                </div>

                                <h6 class="font-weight-bold mb-2">
                                    <a href="<?= site_url('program-studi/' . $related->slug) ?>" class="text-dark text-decoration-none">
                                        <?= $related->nama_prodi ?>
                                    </a>
                                </h6>

                                <p class="text-muted small mb-3">
                                    <?= character_limiter($related->deskripsi, 60) ?>
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-primary"><?= $related->jenjang ?></span>
                                    <a href="<?= site_url('program-studi/' . $related->slug) ?>" class="btn btn-sm btn-outline-primary">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>