<!-- Academic Content Page -->
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Page Header -->
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3"
                    style="width: 80px; height: 80px; font-size: 2rem;">
                    <i class="<?= !empty($item->icon) ? $item->icon : 'fas fa-university' ?>"></i>
                </div>
                <h1 class="display-5 fw-bold text-dark mb-3"><?= htmlspecialchars($item->title) ?></h1>
                <div class="text-muted">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Dipublikasikan: <?= date('d F Y', strtotime($item->created_at ?? date('Y-m-d'))) ?>
                </div>
            </div>

            <!-- Content -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <?php if (!empty($item->content)): ?>
                        <div class="content-body">
                            <?= $item->content ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Konten sedang dalam tahap pengembangan. Silakan kembali lagi nanti.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Navigation to other academic pages -->
            <?php if (!empty($academic_menu) && count($academic_menu) > 1): ?>
                <div class="mt-5">
                    <h4 class="mb-3">Halaman Akademik Lainnya</h4>
                    <div class="row">
                        <?php foreach ($academic_menu as $menu_item): ?>
                            <?php if ($menu_item->slug !== $item->slug): // Don't show current page 
                            ?>
                                <div class="col-md-6 mb-3">
                                    <a href="<?= site_url('akademik/' . $menu_item->slug) ?>"
                                        class="card text-decoration-none h-100 shadow-sm border-0 hover-card">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="<?= !empty($menu_item->icon) ? $menu_item->icon : 'fas fa-file-alt' ?> 
                                                          text-primary fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="card-title mb-1 text-dark"><?= htmlspecialchars($menu_item->title) ?></h6>
                                                <small class="text-muted">Klik untuk melihat detail</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Back to Home -->
            <div class="text-center mt-5">
                <a href="<?= site_url('/') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .content-body {
        font-size: 1.1rem;
        line-height: 1.7;
    }

    .content-body h1,
    .content-body h2,
    .content-body h3 {
        color: #2c3e50;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .content-body h1 {
        font-size: 2rem;
    }

    .content-body h2 {
        font-size: 1.75rem;
    }

    .content-body h3 {
        font-size: 1.5rem;
    }

    .content-body ul,
    .content-body ol {
        padding-left: 2rem;
        margin-bottom: 1.5rem;
    }

    .content-body li {
        margin-bottom: 0.5rem;
    }

    .content-body p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    .content-body strong {
        color: #2c3e50;
    }
</style>