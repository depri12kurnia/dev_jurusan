<!-- Jenjang Hero -->
<section class="jenjang-hero py-5" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
    <div class="container">
        <div class="row justify-content-center text-center text-white">
            <div class="col-lg-8">
                <div class="jenjang-icon mx-auto mb-4"
                    style="width: 100px; height: 100px; background: rgba(255,255,255,0.2); 
                            border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-graduation-cap fa-3x"></i>
                </div>

                <h1 class="font-weight-bold mb-3">Program Studi <?= $jenjang ?></h1>
                <p class="lead mb-4"><?= $jenjang_description ?></p>

                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <h3 class="mb-0"><?= number_format($stats['total_programs']) ?></h3>
                        <small>Program Studi</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h3 class="mb-0"><?= number_format($stats['total_students']) ?></h3>
                        <small>Mahasiswa Aktif</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h3 class="mb-0"><?= number_format($stats['total_alumni']) ?></h3>
                        <small>Total Alumni</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Navigation -->
<section class="jenjang-navigation bg-white shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="navbar-nav w-100 justify-content-center">
                        <a class="nav-link <?= $active_tab == 'semua' ? 'active' : '' ?>"
                            href="<?= site_url('program-studi/jenjang/' . strtolower($jenjang)) ?>">
                            <i class="fas fa-th mr-1"></i> Semua Program
                        </a>
                        <a class="nav-link <?= $active_tab == 'unggulan' ? 'active' : '' ?>"
                            href="<?= site_url('program-studi/jenjang/' . strtolower($jenjang) . '?tab=unggulan') ?>">
                            <i class="fas fa-star mr-1"></i> Program Unggulan
                        </a>
                        <a class="nav-link <?= $active_tab == 'akreditasi' ? 'active' : '' ?>"
                            href="<?= site_url('program-studi/jenjang/' . strtolower($jenjang) . '?tab=akreditasi') ?>">
                            <i class="fas fa-certificate mr-1"></i> Terakreditasi A
                        </a>
                        <a class="nav-link <?= $active_tab == 'terbaru' ? 'active' : '' ?>"
                            href="<?= site_url('program-studi/jenjang/' . strtolower($jenjang) . '?tab=terbaru') ?>">
                            <i class="fas fa-clock mr-1"></i> Terbaru
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<section class="breadcrumb-section bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('program-studi') ?>">Program Studi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $jenjang ?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- Programs Content -->
<section class="programs-content py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Section Header -->
                <div class="section-header mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="font-weight-bold mb-1">
                                <?php
                                switch ($active_tab) {
                                    case 'unggulan':
                                        echo 'Program Unggulan ' . $jenjang;
                                        break;
                                    case 'akreditasi':
                                        echo 'Program Terakreditasi A ' . $jenjang;
                                        break;
                                    case 'terbaru':
                                        echo 'Program Terbaru ' . $jenjang;
                                        break;
                                    default:
                                        echo 'Semua Program ' . $jenjang;
                                }
                                ?>
                            </h3>
                            <p class="text-muted mb-0">
                                Ditemukan <?= number_format($total_programs) ?> program studi
                            </p>
                        </div>

                        <!-- Sort Options -->
                        <div class="sort-options">
                            <select class="form-control" id="sortSelect">
                                <option value="nama_asc" <?= $sort == 'nama_asc' ? 'selected' : '' ?>>Nama A-Z</option>
                                <option value="nama_desc" <?= $sort == 'nama_desc' ? 'selected' : '' ?>>Nama Z-A</option>
                                <option value="akreditasi_desc" <?= $sort == 'akreditasi_desc' ? 'selected' : '' ?>>Akreditasi Tertinggi</option>
                                <option value="created_desc" <?= $sort == 'created_desc' ? 'selected' : '' ?>>Terbaru Ditambahkan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Programs Grid -->
                <?php if (empty($programs)): ?>
                    <div class="no-programs text-center py-5">
                        <div class="empty-state" style="background: #f8f9fa; border-radius: 12px; padding: 3rem;">
                            <i class="fas fa-graduation-cap fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">Belum ada program studi</h4>
                            <p class="text-muted mb-4">
                                <?php
                                switch ($active_tab) {
                                    case 'unggulan':
                                        echo 'Belum ada program unggulan untuk jenjang ' . $jenjang;
                                        break;
                                    case 'akreditasi':
                                        echo 'Belum ada program terakreditasi A untuk jenjang ' . $jenjang;
                                        break;
                                    case 'terbaru':
                                        echo 'Belum ada program terbaru untuk jenjang ' . $jenjang;
                                        break;
                                    default:
                                        echo 'Belum ada program studi untuk jenjang ' . $jenjang;
                                }
                                ?>
                            </p>
                            <a href="<?= site_url('program-studi') ?>" class="btn btn-primary">
                                <i class="fas fa-arrow-left mr-2"></i>Lihat Semua Program
                            </a>
                        </div>
                    </div>
                <?php else: ?>

                    <div class="programs-grid" id="programsContainer">
                        <div class="row">
                            <?php foreach ($programs as $program): ?>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card program-card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <!-- Header -->
                                            <div class="program-header d-flex align-items-start mb-3">
                                                <div class="program-icon mr-3"
                                                    style="background: linear-gradient(135deg, <?= $program->warna ?>, <?= $program->warna ?>90); 
                                                    width: 50px; height: 50px; border-radius: 12px; 
                                                    display: flex; align-items: center; justify-content: center;">
                                                    <i class="<?= $program->icon ?> text-white"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="badges mb-2">
                                                        <span class="badge badge-primary"><?= $program->jenjang ?></span>
                                                        <?php if ($program->is_featured): ?>
                                                            <span class="badge badge-warning">
                                                                <i class="fas fa-star mr-1"></i>Unggulan
                                                            </span>
                                                        <?php endif; ?>
                                                        <?php if ($program->akreditasi): ?>
                                                            <span class="badge badge-success">
                                                                Akreditasi <?= $program->akreditasi ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <h6 class="program-title font-weight-bold mb-0">
                                                        <a href="<?= site_url('program-studi/' . $program->slug) ?>"
                                                            class="text-dark text-decoration-none">
                                                            <?= $program->nama_prodi ?>
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <p class="program-description text-muted mb-3">
                                                <?= character_limiter($program->deskripsi, 100) ?>
                                            </p>

                                            <!-- Meta Info -->
                                            <div class="program-meta mb-3">
                                                <div class="row text-center">
                                                    <?php if ($program->durasi_studi): ?>
                                                        <div class="col-4">
                                                            <small class="text-muted d-block">
                                                                <i class="fas fa-calendar-alt text-primary"></i>
                                                            </small>
                                                            <small class="font-weight-bold"><?= $program->durasi_studi ?> Sem</small>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($program->sks_total): ?>
                                                        <div class="col-4">
                                                            <small class="text-muted d-block">
                                                                <i class="fas fa-book text-success"></i>
                                                            </small>
                                                            <small class="font-weight-bold"><?= $program->sks_total ?> SKS</small>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($program->jumlah_mahasiswa_aktif): ?>
                                                        <div class="col-4">
                                                            <small class="text-muted d-block">
                                                                <i class="fas fa-users text-info"></i>
                                                            </small>
                                                            <small class="font-weight-bold"><?= $program->jumlah_mahasiswa_aktif ?></small>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- Gelar & Action -->
                                            <div class="program-footer">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <strong>Gelar:</strong> <?= $program->gelar ?>
                                                    </small>
                                                    <a href="<?= site_url('program-studi/' . $program->slug) ?>"
                                                        class="btn btn-outline-primary btn-sm">
                                                        Lihat Detail
                                                    </a>
                                                </div>

                                                <?php if ($program->biaya_pendidikan): ?>
                                                    <div class="mt-2">
                                                        <small class="text-success font-weight-bold">
                                                            <i class="fas fa-money-bill-wave mr-1"></i>
                                                            Rp <?= number_format($program->biaya_pendidikan / 1000000, 1) ?>Jt/semester
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Load More Button -->
                    <?php if ($has_more_programs): ?>
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
                                <i class="fas fa-plus mr-2"></i>Muat Lebih Banyak
                            </button>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <!-- Quick Stats -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-bar mr-2"></i>Statistik <?= $jenjang ?>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="stat-item d-flex justify-content-between align-items-center mb-3">
                            <span>Total Program</span>
                            <span class="badge badge-primary"><?= number_format($stats['total_programs']) ?></span>
                        </div>
                        <div class="stat-item d-flex justify-content-between align-items-center mb-3">
                            <span>Program Unggulan</span>
                            <span class="badge badge-warning"><?= number_format($stats['featured_programs']) ?></span>
                        </div>
                        <div class="stat-item d-flex justify-content-between align-items-center mb-3">
                            <span>Terakreditasi A</span>
                            <span class="badge badge-success"><?= number_format($stats['accredited_a']) ?></span>
                        </div>
                        <div class="stat-item d-flex justify-content-between align-items-center">
                            <span>Mahasiswa Aktif</span>
                            <span class="badge badge-info"><?= number_format($stats['total_students']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Jenjang Navigation -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="fas fa-layer-group mr-2"></i>Jenjang Lainnya
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php foreach ($all_jenjang as $other_jenjang): ?>
                            <a href="<?= site_url('program-studi/jenjang/' . strtolower($other_jenjang->jenjang)) ?>"
                                class="d-flex justify-content-between align-items-center text-decoration-none mb-2 p-2 rounded <?= $other_jenjang->jenjang == $jenjang ? 'bg-primary text-white' : 'text-dark' ?>">
                                <span><?= $other_jenjang->jenjang ?></span>
                                <span class="badge <?= $other_jenjang->jenjang == $jenjang ? 'badge-light' : 'badge-secondary' ?>">
                                    <?= $other_jenjang->count ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- CTA Card -->
                <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <div class="card-body text-white text-center">
                        <i class="fas fa-question-circle fa-3x mb-3"></i>
                        <h6 class="font-weight-bold mb-3">Butuh Bantuan Memilih?</h6>
                        <p class="mb-4">Konsultasikan pilihan program studimu dengan konselor ahli</p>
                        <a href="<?= site_url('konsultasi') ?>" class="btn btn-light btn-block">
                            <i class="fas fa-comments mr-2"></i>Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .jenjang-hero {
        position: relative;
        overflow: hidden;
    }

    .jenjang-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="jenjang-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" fill-opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23jenjang-pattern)"/></svg>');
    }

    .jenjang-navigation .nav-link {
        color: #6c757d;
        font-weight: 500;
        padding: 1rem 1.5rem;
        transition: all 0.3s ease;
    }

    .jenjang-navigation .nav-link:hover,
    .jenjang-navigation .nav-link.active {
        color: #007bff;
        border-bottom: 3px solid #007bff;
        background: rgba(0, 123, 255, 0.05);
    }

    .program-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .program-icon {
        transition: all 0.3s ease;
    }

    .program-card:hover .program-icon {
        transform: scale(1.1);
    }

    .program-title a:hover {
        color: #007bff !important;
    }

    .badges .badge {
        font-size: 0.7em;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
    }

    .program-meta {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 0.75rem;
    }

    .stat-item {
        padding: 0.25rem 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .empty-state {
        border: 2px dashed #dee2e6;
    }

    .sort-options select {
        min-width: 200px;
    }

    @media (max-width: 768px) {
        .jenjang-navigation .navbar-nav {
            flex-direction: row;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .jenjang-navigation .nav-link {
            white-space: nowrap;
            padding: 0.75rem 1rem;
            font-size: 0.9em;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .sort-options {
            margin-top: 1rem;
            width: 100%;
        }

        .sort-options select {
            min-width: auto;
            width: 100%;
        }
    }
</style>

<script>
    $(document).ready(function() {
        let currentPage = 1;
        const jenjang = '<?= strtolower($jenjang) ?>';
        const activeTab = '<?= $active_tab ?>';
        const currentSort = '<?= $sort ?>';

        // Sort change handler
        $('#sortSelect').change(function() {
            const sort = $(this).val();
            const url = new URL(window.location);
            url.searchParams.set('sort', sort);
            window.location.href = url.toString();
        });

        // Load more functionality
        $('#loadMoreBtn').click(function() {
            const btn = $(this);
            const originalText = btn.html();

            btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memuat...').prop('disabled', true);

            $.ajax({
                url: '<?= site_url("program-studi/ajax_get_programs") ?>',
                type: 'POST',
                data: {
                    jenjang: jenjang,
                    tab: activeTab,
                    sort: currentSort,
                    page: currentPage + 1
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        let html = '';
                        response.data.forEach(function(program) {
                            html += buildProgramCard(program);
                        });

                        $('#programsContainer .row').append(html);
                        currentPage++;

                        // Hide load more button if no more data
                        if (!response.has_more) {
                            btn.hide();
                        } else {
                            btn.html(originalText).prop('disabled', false);
                        }

                        // Animate new cards
                        $('.program-card').slice(-response.data.length).hide().fadeIn(500);
                    } else {
                        btn.hide();
                    }
                },
                error: function() {
                    btn.html(originalText).prop('disabled', false);
                    alert('Gagal memuat data. Silakan coba lagi.');
                }
            });
        });

        function buildProgramCard(program) {
            let badges = `<span class="badge badge-primary">${program.jenjang}</span>`;
            if (program.is_featured == 1) {
                badges += `<span class="badge badge-warning"><i class="fas fa-star mr-1"></i>Unggulan</span>`;
            }
            if (program.akreditasi) {
                badges += `<span class="badge badge-success">Akreditasi ${program.akreditasi}</span>`;
            }

            let metaInfo = '';
            if (program.durasi_studi) {
                metaInfo += `<div class="col-4"><small class="text-muted d-block"><i class="fas fa-calendar-alt text-primary"></i></small><small class="font-weight-bold">${program.durasi_studi} Sem</small></div>`;
            }
            if (program.sks_total) {
                metaInfo += `<div class="col-4"><small class="text-muted d-block"><i class="fas fa-book text-success"></i></small><small class="font-weight-bold">${program.sks_total} SKS</small></div>`;
            }
            if (program.jumlah_mahasiswa_aktif) {
                metaInfo += `<div class="col-4"><small class="text-muted d-block"><i class="fas fa-users text-info"></i></small><small class="font-weight-bold">${program.jumlah_mahasiswa_aktif}</small></div>`;
            }

            let biayaInfo = '';
            if (program.biaya_pendidikan) {
                const biayaJuta = (program.biaya_pendidikan / 1000000).toFixed(1);
                biayaInfo = `<div class="mt-2"><small class="text-success font-weight-bold"><i class="fas fa-money-bill-wave mr-1"></i>Rp ${biayaJuta}Jt/semester</small></div>`;
            }

            return `
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card program-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="program-header d-flex align-items-start mb-3">
                            <div class="program-icon mr-3" style="background: linear-gradient(135deg, ${program.warna}, ${program.warna}90); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="${program.icon} text-white"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="badges mb-2">${badges}</div>
                                <h6 class="program-title font-weight-bold mb-0">
                                    <a href="<?= site_url('program-studi/') ?>${program.slug}" class="text-dark text-decoration-none">
                                        ${program.nama_prodi}
                                    </a>
                                </h6>
                            </div>
                        </div>
                        <p class="program-description text-muted mb-3">
                            ${program.deskripsi.length > 100 ? program.deskripsi.substring(0, 100) + '...' : program.deskripsi}
                        </p>
                        <div class="program-meta mb-3">
                            <div class="row text-center">${metaInfo}</div>
                        </div>
                        <div class="program-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><strong>Gelar:</strong> ${program.gelar}</small>
                                <a href="<?= site_url('program-studi/') ?>${program.slug}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                            </div>
                            ${biayaInfo}
                        </div>
                    </div>
                </div>
            </div>
        `;
        }
    });
</script>