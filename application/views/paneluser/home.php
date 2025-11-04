<!-- Hero Section -->
<section id="home" class="hero hero-slider" role="region" aria-label="Hero Slider">
    <?php if (!empty($sliders)): ?>
        <!-- Slider Background Images -->
        <div class="hero-slides" role="img" aria-live="polite" aria-atomic="true">
            <?php foreach ($sliders as $index => $slider): ?>
                <div class="hero-slide <?= $index === 0 ? 'active' : '' ?>"
                    style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('<?= !empty($slider->image) ? base_url('public/uploads/sliders/' . $slider->image) : base_url('assets/img/hero-bg.jpg') ?>');">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-lg-7 col-md-8">
                                <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                                    <h1><?= !empty($slider->title) ? htmlspecialchars($slider->title) : 'Fakultas Kesehatan' ?></h1>
                                    <p>Membangun generasi tenaga kesehatan profesional yang kompeten dan berjiwa sosial tinggi. Bergabunglah dengan kami untuk memberikan pelayanan kesehatan terbaik bagi masyarakat!</p>
                                    <div class="hero-buttons">
                                        <a href="#programs" class="btn btn-hero btn-primary">Daftar Sekarang</a>
                                        <a href="#news" class="btn btn-hero btn-outline">Info Pendaftaran</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-4 d-none d-md-block">
                                <div class="hero-decoration" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                                    <div class="decoration-icon">
                                        <i class="fas fa-user-nurse"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Slider Controls -->
        <?php if (count($sliders) > 1): ?>
            <div class="hero-controls" role="group" aria-label="Slider Navigation">
                <button class="hero-control hero-prev" aria-label="Previous slide" title="Previous slide">
                    <i class="fas fa-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="hero-control hero-next" aria-label="Next slide" title="Next slide">
                    <i class="fas fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>

            <!-- Slider Indicators -->
            <div class="hero-indicators" role="group" aria-label="Slide indicators">
                <?php foreach ($sliders as $index => $slider): ?>
                    <button class="hero-indicator <?= $index === 0 ? 'active' : '' ?>"
                        aria-label="Go to slide <?= $index + 1 ?>"
                        title="Slide <?= $index + 1 ?>: <?= htmlspecialchars($slider->title) ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?> <?php else: ?>
        <!-- Default Hero when no slider data -->
        <div class="hero-slide active" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('<?= base_url('assets/img/hero-bg.jpg') ?>');">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-7 col-md-8">
                        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
                            <h1>Fakultas Kesehatan</h1>
                            <p>Membangun generasi tenaga kesehatan profesional yang kompeten dan berjiwa sosial tinggi. Bergabunglah dengan kami untuk memberikan pelayanan kesehatan terbaik bagi masyarakat!</p>
                            <div class="hero-buttons">
                                <a href="#programs" class="btn btn-hero btn-primary">Daftar Sekarang</a>
                                <a href="#news" class="btn btn-hero btn-outline">Info Pendaftaran</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-4 d-none d-md-block">
                        <div class="hero-decoration" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                            <div class="decoration-icon">
                                <i class="fas fa-user-nurse"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Hero Slider Assets -->
<link rel="stylesheet" href="<?= base_url('assets/css/hero-slider.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/hero-gradients.css') ?>">
<script src="<?= base_url('assets/js/hero-slider.js') ?>"></script>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-number"><?= isset($stats['total_prodi']) ? $stats['total_prodi'] : '3' ?>+</div>
                    <div class="stat-label">Program Studi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-number"><?= isset($stats['total_mahasiswa']) ? number_format($stats['total_mahasiswa']) : '2,200' ?>+</div>
                    <div class="stat-label">Mahasiswa Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-number"><?= isset($stats['total_alumni']) ? number_format($stats['total_alumni']) : '5,500' ?>+</div>
                    <div class="stat-label">Alumni Sukses</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="stat-number"><?= isset($stats['rata_akreditasi_a']) ? $stats['rata_akreditasi_a'] : '3' ?></div>
                    <div class="stat-label">Prodi Terakreditasi A</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section id="programs" class="programs">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Program Studi Unggulan</h2>
            <p>Program studi berkualitas dengan akreditasi A yang mempersiapkan tenaga kesehatan profesional dan kompeten</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($program_studi_featured)): ?>
                <?php foreach ($program_studi_featured as $index => $prodi): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="program-card" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>" style="--theme-color: <?= $prodi->warna ?>">
                            <div class="program-icon" style="background: linear-gradient(135deg, <?= $prodi->warna ?>20, <?= $prodi->warna ?>40); color: <?= $prodi->warna ?>;">
                                <i class="<?= $prodi->icon ?>"></i>
                            </div>
                            <div class="program-jenjang">
                                <span class="badge" style="background-color: <?= $prodi->warna ?>;"><?= $prodi->jenjang ?></span>
                                <?php if ($prodi->akreditasi): ?>
                                    <span class="badge bg-success ms-1">Akreditasi <?= $prodi->akreditasi ?></span>
                                <?php endif; ?>
                            </div>
                            <h4 class="program-title"><?= $prodi->nama_prodi ?></h4>
                            <div class="program-gelar mb-2">
                                <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: <?= $prodi->gelar ?></small>
                            </div>
                            <p class="program-description">
                                <?= $prodi->featured_description ?: $prodi->deskripsi ?: 'Program studi unggulan dengan kurikulum terkini dan fasilitas modern.' ?>
                            </p>
                            <div class="program-meta">
                                <div class="meta-item">
                                    <i class="fas fa-clock me-1"></i>
                                    <small><?= $prodi->durasi_studi ?> Semester</small>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-award me-1"></i>
                                    <small><?= $prodi->sks_total ?> SKS</small>
                                </div>
                            </div>
                            <a href="<?= site_url('program-studi/' . $prodi->slug) ?>" class="program-link">
                                Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Default programs jika tidak ada data -->
                <div class="col-lg-4 col-md-6">
                    <div class="program-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="program-icon" style="background: linear-gradient(135deg, #E8717A20, #E8717A40); color: #E8717A;">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <div class="program-jenjang">
                            <span class="badge" style="background-color: #E8717A;">S1</span>
                            <span class="badge bg-success ms-1">Akreditasi A</span>
                        </div>
                        <h4 class="program-title">Keperawatan</h4>
                        <div class="program-gelar mb-2">
                            <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: S.Kep</small>
                        </div>
                        <p class="program-description">Program Studi Keperawatan yang menghasilkan perawat profesional dengan kompetensi klinis dan kepemimpinan yang unggul.</p>
                        <div class="program-meta">
                            <div class="meta-item">
                                <i class="fas fa-clock me-1"></i>
                                <small>8 Semester</small>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-award me-1"></i>
                                <small>144 SKS</small>
                            </div>
                        </div>
                        <a href="#" class="program-link">
                            Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="program-icon" style="background: linear-gradient(135deg, #F4A7B920, #F4A7B940); color: #F4A7B9;">
                            <i class="fas fa-baby"></i>
                        </div>
                        <div class="program-jenjang">
                            <span class="badge" style="background-color: #F4A7B9;">D3</span>
                            <span class="badge bg-success ms-1">Akreditasi A</span>
                        </div>
                        <h4 class="program-title">Kebidanan</h4>
                        <div class="program-gelar mb-2">
                            <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: A.Md.Keb</small>
                        </div>
                        <p class="program-description">Program Diploma Kebidanan yang mempersiapkan bidan kompeten dalam pelayanan kesehatan ibu dan anak.</p>
                        <div class="program-meta">
                            <div class="meta-item">
                                <i class="fas fa-clock me-1"></i>
                                <small>6 Semester</small>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-award me-1"></i>
                                <small>108 SKS</small>
                            </div>
                        </div>
                        <a href="#" class="program-link">
                            Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="program-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="program-icon" style="background: linear-gradient(135deg, #00B9AD20, #00B9AD40); color: #00B9AD;">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="program-jenjang">
                            <span class="badge" style="background-color: #00B9AD;">Profesi</span>
                            <span class="badge bg-success ms-1">Akreditasi A</span>
                        </div>
                        <h4 class="program-title">Profesi Ners</h4>
                        <div class="program-gelar mb-2">
                            <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i>Gelar: Ns.</small>
                        </div>
                        <p class="program-description">Program Profesi untuk lulusan S1 Keperawatan menjadi perawat profesional berlisensi dan bersertifikat.</p>
                        <div class="program-meta">
                            <div class="meta-item">
                                <i class="fas fa-clock me-1"></i>
                                <small>2 Semester</small>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-award me-1"></i>
                                <small>36 SKS</small>
                            </div>
                        </div>
                        <a href="#" class="program-link">
                            Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($program_studi_all) && count($program_studi_all) > 3): ?>
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                <a href="<?= site_url('program-studi') ?>" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-graduation-cap me-2"></i>Lihat Semua Program Studi
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features">
    <div class="container features-container">
        <div class="section-title text-center" data-aos="fade-up">
            <h2>Fasilitas Unggulan</h2>
            <p>Fasilitas modern dan lengkap untuk mendukung pembelajaran praktis dan klinis yang berkualitas tinggi</p>
        </div>

        <?php if (!empty($featured_facilities)): ?>
            <div class="row align-items-stretch">
                <?php foreach ($featured_facilities as $index => $facility): ?>
                    <?php
                    $highlights = $this->M_facilities->get_facility_highlights($facility->id);
                    $col_class = ($index % 2 == 0) ? 'col-lg-6' : 'col-lg-6';
                    $aos_direction = ($index % 2 == 0) ? 'fade-right' : 'fade-left';
                    ?>

                    <div class="<?= $col_class ?>" data-aos="<?= $aos_direction ?>" data-aos-delay="<?= ($index + 1) * 100 ?>">
                        <div class="features-grid mb-4">
                            <div class="feature-card">
                                <div class="feature-number"><?= str_pad($facility->featured_order, 2, '0', STR_PAD_LEFT) ?></div>
                                <div class="feature-header">
                                    <div class="feature-icon" style="color: <?= $facility->category_color ?>;">
                                        <i class="<?= $facility->icon ?>"></i>
                                    </div>
                                    <div>
                                        <div class="feature-subtitle"><?= htmlspecialchars($facility->subtitle) ?></div>
                                        <h4 class="feature-title"><?= htmlspecialchars($facility->title) ?></h4>
                                    </div>
                                </div>
                                <p class="feature-description">
                                    <?= $facility->short_description ?: character_limiter(strip_tags($facility->description), 120) ?>
                                </p>

                                <?php if (!empty($highlights)): ?>
                                    <div class="feature-highlights">
                                        <?php foreach ($highlights as $highlight): ?>
                                            <span class="feature-highlight" style="border-color: <?= $highlight->color ?>; color: <?= $highlight->color ?>;">
                                                <?= htmlspecialchars($highlight->title) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <a href="<?= site_url('facilities/detail/' . $facility->slug) ?>" class="feature-link">
                                    Jelajahi Fasilitas <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Default facilities jika tidak ada data -->
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="features-grid">
                        <!-- Feature 1: Lab Keperawatan -->
                        <div class="feature-card">
                            <div class="feature-number">01</div>
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <i class="fas fa-procedures"></i>
                                </div>
                                <div>
                                    <div class="feature-subtitle">Simulasi Klinis</div>
                                    <h4 class="feature-title">Laboratorium Keperawatan</h4>
                                </div>
                            </div>
                            <p class="feature-description">
                                Lab simulasi dengan manikin canggih berteknologi tinggi untuk praktik keterampilan klinis keperawatan yang realistis dan komprehensif.
                            </p>
                            <div class="feature-highlights">
                                <span class="feature-highlight">High-Fidelity Simulator</span>
                                <span class="feature-highlight">VR Training</span>
                                <span class="feature-highlight">Real-time Monitoring</span>
                            </div>
                            <a href="#" class="feature-link">
                                Jelajahi Lab <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="features-grid">
                        <!-- Feature 2: Lab Kebidanan -->
                        <div class="feature-card">
                            <div class="feature-number">02</div>
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div>
                                    <div class="feature-subtitle">Maternal Care</div>
                                    <h4 class="feature-title">Laboratorium Kebidanan</h4>
                                </div>
                            </div>
                            <p class="feature-description">
                                Fasilitas praktik lengkap untuk simulasi persalinan, perawatan ibu hamil, dan neonatal dengan teknologi terdepan.
                            </p>
                            <div class="feature-highlights">
                                <span class="feature-highlight">Birth Simulator</span>
                                <span class="feature-highlight">Neonatal Care</span>
                                <span class="feature-highlight">Emergency Training</span>
                            </div>
                            <a href="#" class="feature-link">
                                Lihat Fasilitas <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Illustration Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="feature-illustration" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-clinic-medical"></i>
                    <div class="feature-stats">
                        <div class="feature-stats-number">95%</div>
                        <div class="feature-stats-label">Kepuasan Mahasiswa</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Facilities Button -->
        <?php if (!empty($featured_facilities) && count($featured_facilities) >= 3): ?>
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
                <a href="<?= site_url('facilities') ?>" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-building me-2"></i>Lihat Semua Fasilitas
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- News Section -->
<section id="news" class="news">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Berita & Kegiatan</h2>
            <p>Update terbaru seputar kegiatan akademik, praktik klinik, dan prestasi mahasiswa kesehatan</p>
        </div>

        <!-- News Container -->
        <div id="news-container" class="row g-4">
            <?php if (!empty($get_featured_news)): ?>
                <?php foreach ($get_featured_news as $index => $news): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                            <div class="news-image" style="background-image: url('<?= !empty($news->thumbnail) ? base_url('public/uploads/news/' . $news->thumbnail) : base_url('assets/img/default-news.jpg') ?>');">
                                <div class="news-date"><?= date('d M Y', strtotime($news->published_at)) ?></div>
                                <?php if (!empty($news->category_name)): ?>
                                    <div class="news-category"><?= $news->category_name ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="news-content">
                                <h4 class="news-title"><?= $news->title ?></h4>
                                <p class="news-excerpt">
                                    <?= !empty($news->excerpt) ? character_limiter($news->excerpt, 120) : character_limiter(strip_tags($news->content), 120) ?>
                                </p>
                                <a href="<?= site_url('news/detail/' . $news->slug) ?>" class="news-link">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Default news jika tidak ada data -->
                <div class="col-lg-4 col-md-6">
                    <div class="news-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="news-image" style="background-image: url('<?= base_url('assets/img/default-news.jpg') ?>');">
                            <div class="news-date"><?= date('d M Y') ?></div>
                            <div class="news-category">Pengumuman</div>
                        </div>
                        <div class="news-content">
                            <h4 class="news-title">Selamat Datang di Portal Berita</h4>
                            <p class="news-excerpt">
                                Portal berita resmi Fakultas Kesehatan yang menyajikan informasi terkini seputar kegiatan akademik dan prestasi mahasiswa.
                            </p>
                            <a href="<?= site_url('news') ?>" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="news-image" style="background-image: url('<?= base_url('assets/img/default-news.jpg') ?>');">
                            <div class="news-date"><?= date('d M Y') ?></div>
                            <div class="news-category">Informasi</div>
                        </div>
                        <div class="news-content">
                            <h4 class="news-title">Pendaftaran Mahasiswa Baru</h4>
                            <p class="news-excerpt">
                                Informasi pendaftaran mahasiswa baru untuk program studi unggulan di Fakultas Kesehatan.
                            </p>
                            <a href="<?= site_url('news') ?>" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="news-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="news-image" style="background-image: url('<?= base_url('assets/img/default-news.jpg') ?>');">
                            <div class="news-date"><?= date('d M Y') ?></div>
                            <div class="news-category">Kegiatan</div>
                        </div>
                        <div class="news-content">
                            <h4 class="news-title">Kegiatan Praktik Klinik</h4>
                            <p class="news-excerpt">
                                Kegiatan praktik klinik mahasiswa di rumah sakit mitra untuk pengalaman langsung di dunia kesehatan.
                            </p>
                            <a href="<?= site_url('news') ?>" class="news-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($get_featured_news) || (!empty($latest_news) && count($latest_news) >= 3)): ?>
            <div class="text-center mt-4">
                <a href="<?= site_url('news') ?>" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-newspaper me-2"></i>Lihat Semua Berita
                </a>
            </div>
        <?php endif; ?>
    </div>
</section><!-- CTA Section -->
<section class="cta">
    <div class="container">
        <div data-aos="fade-up">
            <h2>Bergabunglah dengan Keluarga Besar Fakultas Kesehatan</h2>
            <p>Wujudkan cita-cita mulia Anda menjadi tenaga kesehatan profesional yang berkompeten</p>
            <button class="btn btn-cta">Daftar Sekarang</button>
        </div>
    </div>
</section>