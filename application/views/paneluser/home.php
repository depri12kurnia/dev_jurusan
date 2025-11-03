<!-- Hero Section -->
<section id="home" class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                    <h1>Fakultas Kesehatan</h1>
                    <p>Membangun generasi tenaga kesehatan profesional yang kompeten dan berjiwa sosial tinggi. Bergabunglah dengan kami untuk memberikan pelayanan kesehatan terbaik bagi masyarakat!</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <button class="btn btn-hero">Daftar Sekarang</button>
                        <button class="btn btn-hero">Info Pendaftaran</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="text-center">
                        <i class="fas fa-user-nurse" style="font-size: 20rem; opacity: 0.1;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="features-grid">
                    <!-- Feature 3: Rumah Sakit Pendidikan -->
                    <div class="feature-card">
                        <div class="feature-number">03</div>
                        <div class="feature-header">
                            <div class="feature-icon">
                                <i class="fas fa-hospital-alt"></i>
                            </div>
                            <div>
                                <div class="feature-subtitle">Clinical Practice</div>
                                <h4 class="feature-title">Rumah Sakit Pendidikan</h4>
                            </div>
                        </div>
                        <p class="feature-description">
                            Praktik langsung di rumah sakit mitra dengan supervisi dosen berpengalaman dan perawat senior untuk pengalaman klinis nyata.
                        </p>
                        <div class="feature-highlights">
                            <span class="feature-highlight">Real Patient Care</span>
                            <span class="feature-highlight">Expert Supervision</span>
                            <span class="feature-highlight">Case Studies</span>
                        </div>
                        <a href="#" class="feature-link">
                            Program Magang <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Feature 4: Lab Sains Dasar -->
                    <div class="feature-card">
                        <div class="feature-number">04</div>
                        <div class="feature-header">
                            <div class="feature-icon">
                                <i class="fas fa-microscope"></i>
                            </div>
                            <div>
                                <div class="feature-subtitle">Medical Sciences</div>
                                <h4 class="feature-title">Laboratorium Sains Dasar</h4>
                            </div>
                        </div>
                        <p class="feature-description">
                            Lab anatomi, fisiologi, dan biokimia dengan peralatan canggih untuk pemahaman mendalam ilmu dasar kesehatan.
                        </p>
                        <div class="feature-highlights">
                            <span class="feature-highlight">3D Anatomy</span>
                            <span class="feature-highlight">Digital Microscopy</span>
                            <span class="feature-highlight">Interactive Learning</span>
                        </div>
                        <a href="#" class="feature-link">
                            Eksplorasi Lab <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
    </div>
</section>

<!-- News Section -->
<section id="news" class="news">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Berita & Kegiatan</h2>
            <p>Update terbaru seputar kegiatan akademik, praktik klinik, dan prestasi mahasiswa kesehatan</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="news-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="news-image">
                        <div class="news-date">15 Nov 2025</div>
                    </div>
                    <div class="news-content">
                        <h4 class="news-title">Mahasiswa Keperawatan Raih Juara Lomba Inovasi Kesehatan</h4>
                        <p class="news-excerpt">Tim mahasiswa berhasil menciptakan alat bantu kesehatan inovatif dan meraih juara pertama tingkat nasional...</p>
                        <a href="#" class="news-link">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="news-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="news-image">
                        <div class="news-date">10 Nov 2025</div>
                    </div>
                    <div class="news-content">
                        <h4 class="news-title">Kerjasama dengan RSUD untuk Program Magang</h4>
                        <p class="news-excerpt">Fakultas menjalin kerjasama dengan 15 rumah sakit untuk program magang dan praktik klinik mahasiswa...</p>
                        <a href="#" class="news-link">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="news-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="news-image">
                        <div class="news-date">5 Nov 2025</div>
                    </div>
                    <div class="news-content">
                        <h4 class="news-title">Seminar Kesehatan Ibu dan Anak</h4>
                        <p class="news-excerpt">Seminar nasional dengan tema terkini dalam pelayanan kesehatan maternal dan neonatal...</p>
                        <a href="#" class="news-link">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="container">
        <div data-aos="fade-up">
            <h2>Bergabunglah dengan Keluarga Besar Fakultas Kesehatan</h2>
            <p>Wujudkan cita-cita mulia Anda menjadi tenaga kesehatan profesional yang berkompeten</p>
            <button class="btn btn-cta">Daftar Sekarang</button>
        </div>
    </div>
</section>