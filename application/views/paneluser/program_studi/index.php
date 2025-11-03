<!-- Hero Section -->
<section class="hero-section gradient-animated py-5 position-relative overflow-hidden bg-pattern-dots">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="mb-3">
                    <span class="badge bg-white text-primary px-4 py-2 rounded-pill mb-3">
                        <i class="fas fa-graduation-cap me-2"></i>Pendidikan Berkualitas
                    </span>
                </div>
                <h1 class="display-4 text-white fw-bold mb-4">Program Studi</h1>
                <p class="lead text-white-75 mb-5 lh-lg">
                    Temukan program studi yang sesuai dengan minat dan bakatmu.
                    Kami menyediakan berbagai pilihan program berkualitas dengan akreditasi terbaik untuk masa depan cemerlang.
                </p>

                <!-- Quick Stats -->
                <div class="row g-3 text-white">
                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-15 border-0 text-white text-center">
                            <div class="card-body py-3">
                                <h3 class="fw-bold mb-1"><?= $stats['total_prodi'] ?></h3>
                                <small class="text-white-75">Program Studi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-15 border-0 text-white text-center">
                            <div class="card-body py-3">
                                <h3 class="fw-bold mb-1"><?= number_format($stats['total_mahasiswa']) ?></h3>
                                <small class="text-white-75">Mahasiswa Aktif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-white bg-opacity-15 border-0 text-white text-center">
                            <div class="card-body py-3">
                                <h3 class="fw-bold mb-1"><?= number_format($stats['total_alumni']) ?></h3>
                                <small class="text-white-75">Alumni</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image text-center position-relative">
                    <div class="hero-illustration">
                        <div class="position-relative d-inline-block">
                            <!-- Main Icon -->
                            <div class="bg-white bg-opacity-20 rounded-circle p-5 shadow-lg">
                                <i class="fas fa-graduation-cap display-1 text-white"></i>
                            </div>
                            <!-- Floating Elements -->
                            <div class="position-absolute top-0 start-0 translate-middle">
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 shadow">
                                    <i class="fas fa-book text-white"></i>
                                </div>
                            </div>
                            <div class="position-absolute top-0 end-0 translate-middle">
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 shadow">
                                    <i class="fas fa-certificate text-white"></i>
                                </div>
                            </div>
                            <div class="position-absolute bottom-0 start-50 translate-middle">
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 shadow">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="search-section py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="card border-0 shadow-lg hover-lift">
            <div class="card-header bg-white border-0 pb-0">
                <div class="text-center mb-3">
                    <h4 class="fw-bold text-primary mb-2">Cari Program Studi</h4>
                    <p class="text-muted">Temukan program studi impianmu dengan mudah</p>
                </div>
            </div>
            <div class="card-body pt-3">
                <form action="<?= site_url('program-studi/search') ?>" method="GET" class="row g-4">
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

<!-- All Programs Section -->
<section class="all-programs py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2 class="section-title">Semua Program Studi</h2>
                <p class="text-muted">Jelajahi seluruh program studi yang tersedia dengan berbagai jenjang pendidikan.</p>
            </div>
        </div>

        <!-- Jenjang Filter Tabs -->
        <div class="mb-4">
            <ul class="nav nav-pills justify-content-center flex-wrap" id="jenjangTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-jenjang="">
                        Semua Program (<?= $stats['total_prodi'] ?>)
                    </a>
                </li>
                <?php foreach ($jenjang_list as $jenjang => $count): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-jenjang="<?= $jenjang ?>">
                            <?= $jenjang ?> (<?= $count ?>)
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Programs Grid -->
        <div class="row" id="programsGrid">
            <?php foreach ($prodi_list as $prodi): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 program-item" data-jenjang="<?= $prodi->jenjang ?>">
                    <div class="card program-card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="program-icon-small mr-2" style="background-color: <?= $prodi->warna ?>20; color: <?= $prodi->warna ?>; width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                    <i class="<?= $prodi->icon ?>"></i>
                                </div>
                                <span class="badge badge-primary badge-pill"><?= $prodi->jenjang ?></span>
                                <?php if ($prodi->is_featured): ?>
                                    <span class="badge badge-warning badge-pill ml-1">
                                        <i class="fas fa-star"></i>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h6 class="card-title font-weight-bold mb-2">
                                <a href="<?= site_url('program-studi/' . $prodi->slug) ?>" class="text-dark text-decoration-none">
                                    <?= $prodi->nama_prodi ?>
                                </a>
                            </h6>

                            <p class="text-muted small mb-3">
                                <?= character_limiter($prodi->deskripsi, 60) ?>
                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><?= $prodi->kode_prodi ?></small>
                                <a href="<?= site_url('program-studi/' . $prodi->slug) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-4">
            <button id="loadMoreBtn" class="btn btn-primary btn-lg" data-offset="<?= count($prodi_list) ?>">
                <i class="fas fa-plus-circle mr-2"></i> Muat Lebih Banyak
            </button>
        </div>
    </div>
</section>

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
    .hero-section {
        background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" fill-opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.1;
    }

    .section-title {
        position: relative;
        font-weight: 700;
        color: #2c3e50;
    }

    .program-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }

    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .shadow-hover:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .nav-pills .nav-link {
        color: #6c757d;
        border-radius: 50px;
        margin: 0 5px 10px 0;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover,
    .nav-pills .nav-link.active {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .program-icon,
    .program-icon-small {
        transition: all 0.3s ease;
    }

    .program-card:hover .program-icon,
    .program-card:hover .program-icon-small {
        transform: scale(1.1);
    }

    .badge-pill {
        border-radius: 50px;
    }

    .btn-block {
        width: 100%;
    }

    @media (max-width: 768px) {
        .hero-section {
            text-align: center;
        }

        .hero-section .row>div:last-child {
            margin-top: 2rem;
        }

        .nav-pills {
            justify-content: center !important;
        }
    }
</style>