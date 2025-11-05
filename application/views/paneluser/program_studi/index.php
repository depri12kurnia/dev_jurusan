<!-- Hero Section -->
<section class="hero-section gradient-animated py-5 position-relative overflow-hidden">
    <div class="hero-background">
        <div class="floating-elements">
            <div class="floating-icon" style="top: 20%; left: 10%; animation-delay: 0s;">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="floating-icon" style="top: 60%; right: 15%; animation-delay: 2s;">
                <i class="fas fa-book"></i>
            </div>
            <div class="floating-icon" style="top: 40%; left: 80%; animation-delay: 4s;">
                <i class="fas fa-microscope"></i>
            </div>
            <div class="floating-icon" style="top: 80%; left: 20%; animation-delay: 1s;">
                <i class="fas fa-laptop-medical"></i>
            </div>
            <div class="floating-icon" style="top: 30%; right: 40%; animation-delay: 3s;">
                <i class="fas fa-user-md"></i>
            </div>
        </div>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-content">
                    <div class="mb-4">
                        <span class="badge bg-white text-primary px-4 py-2 rounded-pill mb-3 shadow-sm">
                            <i class="fas fa-graduation-cap me-2"></i>Pendidikan Berkualitas Tinggi
                        </span>
                    </div>
                    <h1 class="hero-title display-3 text-white fw-bold mb-4">
                        Program Studi
                        <span class="text-gradient d-block">Terdepan</span>
                    </h1>
                    <p class="hero-subtitle lead text-white-75 mb-5 lh-lg">
                        Temukan program studi yang sesuai dengan minat dan passion-mu.
                        Kami menyediakan berbagai pilihan program berkualitas dengan akreditasi A dan B,
                        kurikulum berbasis industri, serta fasilitas modern untuk masa depan cemerlang.
                    </p>

                    <div class="hero-actions mb-5">
                        <a href="#programs" class="btn btn-white btn-lg rounded-pill px-4 py-3 me-3 shadow-lg hover-lift">
                            <i class="fas fa-search me-2"></i>Jelajahi Program
                        </a>
                        <a href="<?= site_url('pendaftaran') ?>" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 shadow-lg hover-lift">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="hero-stats">
                    <div class="row g-4">
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number"><?= $stats['total_prodi'] ?></h3>
                                    <p class="stat-label">Program Studi</p>
                                    <small class="stat-sublabel">Terakreditasi A & B</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number"><?= number_format($stats['total_mahasiswa']) ?></h3>
                                    <p class="stat-label">Mahasiswa Aktif</p>
                                    <small class="stat-sublabel">Dari berbagai daerah</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number"><?= number_format($stats['total_alumni']) ?></h3>
                                    <p class="stat-label">Alumni</p>
                                    <small class="stat-sublabel">Berkarir profesional</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="400">
                <div class="hero-visual">
                    <div class="main-visual-container">
                        <!-- Central Hub -->
                        <div class="central-hub">
                            <div class="hub-core">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>

                        <!-- Orbiting Icons -->
                        <div class="orbit-ring" style="animation: rotate 30s linear infinite reverse;">
                            <div class="orbit-icon" style="top: 0; left: 50%; transform: translate(-50%, -20px);">
                                <div class="orbit-dot">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                            <div class="orbit-icon" style="top: 50%; right: -10px; transform: translate(0, -50%);">
                                <div class="orbit-dot">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            </div>
                            <div class="orbit-icon" style="bottom: 0; left: 50%; transform: translate(-50%, 20px);">
                                <div class="orbit-dot">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="orbit-icon" style="top: 50%; left: -10px; transform: translate(0, -50%);">
                                <div class="orbit-dot">
                                    <i class="fas fa-microscope"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Search & Filter Section -->
<section id="programs" class="search-section py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="card border-0 shadow-lg hover-lift" data-aos="fade-up">
            <div class="card-header bg-white border-0 pb-0">
                <div class="text-center mb-3">
                    <h4 class="fw-bold text-primary mb-2">Cari Program Studi</h4>
                    <p class="text-muted">Temukan program studi impianmu dengan mudah</p>
                </div>
            </div>
            <div class="card-body pt-3">
                <form action="<?= site_url('program-studi/cari') ?>" method="GET" class="row g-4">
                    <div class="col-md-6">
                        <label for="searchInput" class="form-label fw-semibold text-dark">
                            <i class="fas fa-search me-2 text-primary"></i>Kata Kunci
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white border-0">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control border-0 shadow-sm" id="searchInput" name="q"
                                placeholder="Nama program studi, kode, atau kata kunci..."
                                value="<?= $this->input->get('q') ?>" style="border-radius: 0 10px 10px 0;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="jenjangFilter" class="form-label fw-semibold text-dark">
                            <i class="fas fa-layer-group me-2 text-primary"></i>Jenjang Pendidikan
                        </label>
                        <select class="form-select border-0 shadow-sm" id="jenjangFilter" name="jenjang" style="border-radius: 10px;">
                            <option value="">Semua Jenjang</option>
                            <?php foreach ($jenjang_list as $jenjang => $count): ?>
                                <option value="<?= $jenjang ?>" <?= $this->input->get('jenjang') == $jenjang ? 'selected' : '' ?>>
                                    <?= $jenjang ?> (<?= $count ?> Program)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary d-block w-100 shadow-sm fw-semibold" style="border-radius: 10px; padding: 12px;">
                            <i class="fas fa-search me-2"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Program Unggulan Section -->
<?php if (!empty($prodi_featured)): ?>
    <section class="featured-programs py-5">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="section-header">
                        <div class="d-flex align-items-center mb-3">
                            <div class="section-icon bg-warning bg-gradient text-white me-3" style="width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-star fa-lg"></i>
                            </div>
                            <div>
                                <h2 class="fw-bold mb-0 text-dark">Program Studi Unggulan</h2>
                                <div class="text-primary">━━━━━━━━━━</div>
                            </div>
                        </div>
                        <p class="text-muted fs-5 lh-lg mb-0">Program studi unggulan yang menjadi kebanggaan institusi dengan fasilitas terdepan, kurikulum terintegrasi industri, dan track record lulusan yang cemerlang.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                    <a href="<?= site_url('program-studi/unggulan') ?>" class="btn btn-outline-primary btn-lg rounded-pill px-4 py-3 shadow-sm hover-lift">
                        <i class="fas fa-star me-2"></i>
                        Lihat Semua Unggulan
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <?php foreach ($prodi_featured as $index => $prodi): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 100 ?>">
                        <div class="card program-card h-100 border-0 shadow-lg hover-lift position-relative overflow-hidden">
                            <!-- Featured Ribbon -->
                            <div class="position-absolute top-0 end-0" style="z-index: 2;">
                                <div class="bg-warning text-dark px-3 py-1 rounded-start" style="font-size: 0.8rem; font-weight: 600;">
                                    <i class="fas fa-star me-1"></i> UNGGULAN
                                </div>
                            </div>

                            <!-- Card Header with Gradient -->
                            <div class="card-header border-0 text-white position-relative" style="background: linear-gradient(135deg, <?= $prodi->warna ?> 0%, <?= $prodi->warna ?>cc 100%); padding: 2rem 1.5rem 1rem;">
                                <div class="d-flex align-items-center">
                                    <div class="program-icon me-3 bg-white bg-opacity-25 shadow" style="width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                                        <i class="<?= $prodi->icon ?> fa-lg text-white"></i>
                                    </div>
                                    <div>
                                        <div class="badge bg-white text-dark mb-2 fw-semibold"><?= $prodi->jenjang ?></div>
                                        <h6 class="mb-0 text-white-75"><?= $prodi->kode_prodi ?></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3 lh-base">
                                    <a href="<?= site_url('program-studi/' . $prodi->slug) ?>" class="text-dark text-decoration-none stretched-link">
                                        <?= $prodi->nama_prodi ?>
                                    </a>
                                </h5>

                                <p class="text-muted lh-lg mb-4" style="font-size: 0.95rem;">
                                    <?= $prodi->featured_description ? character_limiter($prodi->featured_description, 100) : character_limiter($prodi->deskripsi, 100) ?>
                                </p>

                                <!-- Stats Row -->
                                <div class="row g-2 text-center mb-3">
                                    <?php if ($prodi->akreditasi): ?>
                                        <div class="col">
                                            <div class="bg-light p-2 rounded">
                                                <small class="text-success fw-bold d-block">Akreditasi</small>
                                                <small class="text-muted"><?= $prodi->akreditasi ?></small>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($prodi->durasi_studi): ?>
                                        <div class="col">
                                            <div class="bg-light p-2 rounded">
                                                <small class="text-primary fw-bold d-block">Durasi</small>
                                                <small class="text-muted"><?= $prodi->durasi_studi ?> Sem</small>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-2">
                                    <div class="text-primary fw-semibold">
                                        <i class="fas fa-arrow-right me-1"></i> Lihat Detail
                                    </div>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-3">Siap Memulai Pendidikan Impianmu?</h2>
        <p class="lead mb-4">Bergabunglah dengan ribuan mahasiswa yang telah memilih masa depan cerah bersama kami.</p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="<?= site_url('pendaftaran') ?>" class="btn btn-light btn-lg btn-block">
                            <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="<?= site_url('kontak') ?>" class="btn btn-outline-light btn-lg btn-block">
                            <i class="fas fa-phone mr-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Smooth scroll untuk anchor links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000, 'easeInOutExpo');
            }
        });

        // Jenjang filter tabs
        $('#jenjangTabs .nav-link').on('click', function(e) {
            e.preventDefault();

            // Update active tab
            $('#jenjangTabs .nav-link').removeClass('active');
            $(this).addClass('active');

            var jenjang = $(this).data('jenjang');

            // Filter programs
            if (jenjang === '') {
                $('.program-item').show();
            } else {
                $('.program-item').hide();
                $('.program-item[data-jenjang="' + jenjang + '"]').show();
            }
        });

        // Load more functionality
        $('#loadMoreBtn').on('click', function() {
            var btn = $(this);
            var offset = btn.data('offset');
            var jenjang = $('#jenjangTabs .nav-link.active').data('jenjang') || '';

            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Memuat...');

            $.post('<?= site_url("program-studi/ajax_get_programs") ?>', {
                offset: offset,
                limit: 12,
                jenjang: jenjang
            }, function(response) {
                if (response.status === 'success' && response.data.length > 0) {
                    var html = '';
                    response.data.forEach(function(prodi) {
                        html += generateProgramCard(prodi);
                    });

                    $('#programsGrid').append(html);
                    btn.data('offset', offset + response.data.length);

                    if (!response.has_more) {
                        btn.hide();
                    }
                } else {
                    btn.hide();
                }

                btn.prop('disabled', false).html('<i class="fas fa-plus-circle mr-2"></i> Muat Lebih Banyak');
            }, 'json').fail(function() {
                btn.prop('disabled', false).html('<i class="fas fa-plus-circle mr-2"></i> Muat Lebih Banyak');
                alert('Terjadi kesalahan saat memuat data');
            });
        });

        function generateProgramCard(prodi) {
            var featuredBadge = '';
            if (prodi.is_featured == 1) {
                featuredBadge = '<span class="badge badge-warning badge-pill ml-1"><i class="fas fa-star"></i></span>';
            }

            return '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 program-item" data-jenjang="' + prodi.jenjang + '">' +
                '<div class="card program-card h-100 border-0 shadow-sm">' +
                '<div class="card-body">' +
                '<div class="d-flex align-items-center mb-2">' +
                '<div class="program-icon-small mr-2" style="background-color: ' + prodi.warna + '20; color: ' + prodi.warna + '; width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px;">' +
                '<i class="' + prodi.icon + '"></i>' +
                '</div>' +
                '<span class="badge badge-primary badge-pill">' + prodi.jenjang + '</span>' +
                featuredBadge +
                '</div>' +
                '<h6 class="card-title font-weight-bold mb-2">' +
                '<a href="<?= site_url("program-studi/") ?>' + prodi.slug + '" class="text-dark text-decoration-none">' +
                prodi.nama_prodi +
                '</a>' +
                '</h6>' +
                '<p class="text-muted small mb-3">' + (prodi.deskripsi ? prodi.deskripsi.substring(0, 60) + '...' : '') + '</p>' +
                '<div class="d-flex justify-content-between align-items-center">' +
                '<small class="text-muted">' + prodi.kode_prodi + '</small>' +
                '<a href="<?= site_url("program-studi/") ?>' + prodi.slug + '" class="btn btn-sm btn-outline-primary">' +
                '<i class="fas fa-eye mr-1"></i> Lihat' +
                '</a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        }
    });
</script>

<style>
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="0.8" fill="white" opacity="0.08"/><circle cx="40" cy="60" r="1.2" fill="white" opacity="0.06"/><circle cx="90" cy="80" r="0.9" fill="white" opacity="0.1"/><circle cx="10" cy="90" r="1.1" fill="white" opacity="0.07"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
    }

    .floating-icon {
        position: absolute;
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.6);
        font-size: 1.5rem;
        animation: float 6s ease-in-out infinite;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(10deg);
        }
    }

    .min-vh-75 {
        min-height: 75vh;
    }

    .hero-title {
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    .text-gradient {
        background: linear-gradient(135deg, #ffd700, #ff6b35);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 900;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        font-weight: 400;
        line-height: 1.8;
    }

    .btn-white {
        background: white;
        color: var(--primary-color);
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-white:hover {
        background: #f8f9fa;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .hero-stats {
        margin-top: 3rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        font-size: 1rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0.25rem;
    }

    .stat-sublabel {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 400;
    }

    .hero-visual {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .main-visual-container {
        position: relative;
        width: 300px;
        height: 300px;
    }

    .central-hub {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid rgba(255, 255, 255, 0.3);
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: translate(-50%, -50%) scale(1);
        }

        50% {
            transform: translate(-50%, -50%) scale(1.05);
        }
    }

    .hub-core {
        font-size: 3rem;
        color: white;
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .orbit-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 280px;
        height: 280px;
        transform: translate(-50%, -50%);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .orbit-icon {
        position: absolute;
    }

    .orbit-dot {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        animation: float 4s ease-in-out infinite;
    }

    .orbit-icon:nth-child(2) .orbit-dot {
        animation-delay: -1s;
    }

    .orbit-icon:nth-child(3) .orbit-dot {
        animation-delay: -2s;
    }

    .orbit-icon:nth-child(4) .orbit-dot {
        animation-delay: -3s;
    }

    .orbit-icon:nth-child(5) .orbit-dot {
        animation-delay: -4s;
    }

    .search-section {
        margin-top: -50px;
        position: relative;
        z-index: 10;
    }

    .section-title {
        font-weight: 700;
        color: #2c3e50;
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
    }

    .program-card {
        border-radius: 20px;
        transition: all 0.4s ease;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .program-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
    }

    .program-card .card-header {
        border-radius: 20px 20px 0 0;
    }

    .nav-pills .nav-link {
        color: #6c757d;
        border-radius: 25px;
        margin: 0 5px 10px 0;
        border: 2px solid #dee2e6;
        transition: all 0.3s ease;
        font-weight: 500;
        padding: 10px 20px;
        background: white;
    }

    .nav-pills .nav-link:hover,
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .program-icon,
    .program-icon-small {
        transition: all 0.3s ease;
    }

    .program-card:hover .program-icon,
    .program-card:hover .program-icon-small {
        transform: scale(1.1) rotate(5deg);
    }

    .badge-pill {
        border-radius: 50px;
    }

    .btn-block {
        width: 100%;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="0,20 50,40 100,20 150,40 200,20 250,40 300,20 350,40 400,20 450,40 500,20 550,40 600,20 650,40 700,20 750,40 800,20 850,40 900,20 950,40 1000,20 1000,100 0,100"/></svg>') repeat-x;
    }

    @media (max-width: 768px) {
        .hero-section {
            text-align: center;
            min-height: 70vh;
        }

        .hero-title {
            font-size: 2.5rem;
        }

        .floating-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .stat-card {
            margin-bottom: 1rem;
            padding: 1.5rem 1rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .central-hub {
            width: 120px;
            height: 120px;
        }

        .hub-core {
            font-size: 2rem;
        }

        .main-visual-container {
            width: 250px;
            height: 250px;
        }

        .nav-pills {
            justify-content: center !important;
        }

        .nav-pills .nav-link {
            margin: 5px;
            padding: 8px 16px;
            font-size: 0.9rem;
        }

        .search-section {
            margin-top: -30px;
        }
    }

    @media (max-width: 576px) {
        .hero-actions .btn {
            display: block;
            width: 100%;
            margin-bottom: 1rem;
        }

        .hero-stats {
            margin-top: 2rem;
        }

        .stat-card {
            padding: 1.25rem 1rem;
        }
    }
</style>