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

    .facility-header {
        margin-bottom: 40px;
    }

    .facility-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.3;
        color: var(--text-dark);
        margin-bottom: 20px;
    }

    .facility-subtitle {
        font-size: 1.2rem;
        color: var(--text-muted);
        margin-bottom: 25px;
        line-height: 1.5;
    }

    .facility-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 20px;
        padding: 20px 0;
        border-top: 2px solid var(--border-color);
        border-bottom: 2px solid var(--border-color);
        margin-bottom: 30px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        color: var(--text-muted);
        font-size: 14px;
    }

    .meta-item i {
        margin-right: 8px;
        color: var(--primary-color);
    }

    .facility-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .facility-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-dark);
    }

    .facility-content h1,
    .facility-content h2,
    .facility-content h3 {
        color: var(--text-dark);
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .facility-content p {
        margin-bottom: 20px;
    }

    .facility-content ul,
    .facility-content ol {
        padding-left: 30px;
        margin-bottom: 20px;
    }

    .facility-content img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 20px 0;
    }

    .highlights-section,
    .specifications-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .highlight-item,
    .spec-item {
        padding: 15px 0;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .highlight-item:last-child,
    .spec-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .highlight-icon,
    .spec-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .highlight-content,
    .spec-content {
        flex: 1;
    }

    .highlight-title,
    .spec-title {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 5px;
    }

    .highlight-description,
    .spec-description {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .spec-value {
        color: var(--primary-color);
        font-weight: 600;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .category-badge:hover {
        text-decoration: none;
        transform: translateY(-2px);
    }

    .featured-badge {
        background: linear-gradient(45deg, #FFD700, #FFA500);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .sidebar-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .sidebar-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .related-facility {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-light);
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s ease;
    }

    .related-facility:last-child {
        border-bottom: none;
    }

    .related-facility:hover {
        text-decoration: none;
        color: var(--primary-color);
        padding-left: 10px;
    }

    .related-facility-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 15px;
    }

    .related-facility-placeholder {
        width: 60px;
        height: 60px;
        background: var(--bg-light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: var(--text-muted);
    }

    .related-facility-content h6 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.3;
    }

    .related-facility-content small {
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .social-share {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .share-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        text-decoration: none;
        color: white;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        text-decoration: none;
        color: white;
    }

    .share-facebook {
        background: #1877F2;
    }

    .share-twitter {
        background: #1DA1F2;
    }

    .share-whatsapp {
        background: #25D366;
    }

    .share-linkedin {
        background: #0A66C2;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        background: var(--primary-color);
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }

    .back-button:hover {
        background: var(--secondary-color);
        text-decoration: none;
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .facility-title {
            font-size: 2rem;
        }

        .facility-image {
            height: 250px;
        }

        .facility-meta {
            gap: 15px;
        }

        .meta-item {
            font-size: 13px;
        }

        .highlights-section,
        .specifications-section {
            padding: 20px;
        }

        .sidebar-card {
            padding: 20px;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">
                    <i class="<?= !empty($facility->icon) ? $facility->icon : 'fas fa-building' ?> me-3"></i>
                    <?= htmlspecialchars($facility->title) ?>
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                    <?= !empty($facility->subtitle) ? htmlspecialchars($facility->subtitle) : 'Fasilitas lengkap dan modern untuk mendukung proses pembelajaran dan praktik mahasiswa' ?>
                </p>
                <div class="d-flex justify-content-center gap-3" data-aos="fade-up" data-aos-delay="200">
                    <?php if (!empty($facility->category_name)): ?>
                        <span class="badge bg-white text-primary px-3 py-2">
                            <i class="fas fa-tag me-2"></i>
                            <?= htmlspecialchars($facility->category_name) ?>
                        </span>
                    <?php endif; ?>
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <?= date('d M Y', strtotime($facility->created_at ?? date('Y-m-d'))) ?>
                    </span>
                    <?php if ($facility->is_featured == 'Yes'): ?>
                        <span class="badge bg-white text-warning px-3 py-2">
                            <i class="fas fa-star me-2"></i>Unggulan
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Back Button -->
    <a href="<?= site_url('facilities') ?>" class="back-button" data-aos="fade-right">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Fasilitas
    </a>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <article class="facility-detail">
                <!-- Facility Header -->
                <div class="facility-header" data-aos="fade-up">
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <?php if (!empty($facility->category_name)): ?>
                            <a href="<?= site_url('facilities/category/' . $facility->slug) ?>"
                                class="category-badge"
                                style="background-color: <?= $facility->category_color ?>20; color: <?= $facility->category_color ?>; border: 2px solid <?= $facility->category_color ?>40;">
                                <i class="<?= $facility->slug ?: 'fas fa-tag' ?>"></i>
                                <?= $facility->category_name ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($facility->is_featured == 'Yes'): ?>
                            <span class="featured-badge">
                                <i class="fas fa-star"></i>
                                Fasilitas Unggulan
                            </span>
                        <?php endif; ?>
                    </div>

                    <h1 class="facility-title"><?= htmlspecialchars($facility->title) ?></h1>

                    <?php if (!empty($facility->subtitle)): ?>
                        <p class="facility-subtitle"><?= htmlspecialchars($facility->subtitle) ?></p>
                    <?php endif; ?>

                    <!-- Facility Meta -->
                    <div class="facility-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Dibuat: <?= date('d F Y', strtotime($facility->created_at)) ?></span>
                        </div>
                        <?php if (!empty($facility->view_count)): ?>
                            <div class="meta-item">
                                <i class="fas fa-eye"></i>
                                <span><?= number_format($facility->view_count) ?> kali dilihat</span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($facility->updated_at)): ?>
                            <div class="meta-item">
                                <i class="fas fa-edit"></i>
                                <span>Diperbarui: <?= date('d F Y', strtotime($facility->updated_at)) ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?= !empty($facility->location) ? htmlspecialchars($facility->location) : 'Kampus Utama' ?></span>
                        </div>
                    </div>
                </div>

                <!-- Facility Image -->
                <?php if (!empty($facility->image)): ?>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <img src="<?= base_url('public/uploads/facilities/' . $facility->image) ?>"
                            alt="<?= htmlspecialchars($facility->title) ?>"
                            class="facility-image">
                    </div>
                <?php endif; ?>

                <!-- Facility Description -->
                <?php if (!empty($facility->description)): ?>
                    <div class="facility-content" data-aos="fade-up" data-aos-delay="200">
                        <?= $facility->description ?>
                    </div>
                <?php endif; ?>

                <!-- Facility Content -->
                <?php if (!empty($facility->content)): ?>
                    <div class="facility-content" data-aos="fade-up" data-aos-delay="300">
                        <?= $facility->content ?>
                    </div>
                <?php endif; ?>

                <!-- Facility Highlights -->
                <?php if (!empty($facility_highlights)): ?>
                    <div class="highlights-section" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="section-title">
                            <i class="fas fa-star text-warning"></i>
                            Keunggulan Fasilitas
                        </h3>
                        <?php foreach ($facility_highlights as $highlight): ?>
                            <div class="highlight-item">
                                <div class="highlight-icon">
                                    <i class="<?= $highlight->icon ?: 'fas fa-check' ?>"></i>
                                </div>
                                <div class="highlight-content">
                                    <div class="highlight-title"><?= htmlspecialchars($highlight->title) ?></div>
                                    <?php if (!empty($highlight->description)): ?>
                                        <div class="highlight-description"><?= htmlspecialchars($highlight->description) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Facility Specifications -->
                <?php if (!empty($facility_specifications)): ?>
                    <div class="specifications-section" data-aos="fade-up" data-aos-delay="500">
                        <h3 class="section-title">
                            <i class="fas fa-cogs text-primary"></i>
                            Spesifikasi & Detail
                        </h3>
                        <?php foreach ($facility_specifications as $spec): ?>
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-title"><?= htmlspecialchars($spec->spec_name) ?></div>
                                    <?php if (!empty($spec->spec_value)): ?>
                                        <div class="spec-description">
                                            <span class="spec-value">
                                                <?= htmlspecialchars($spec->spec_value) ?>
                                                <?php if (!empty($spec->spec_unit)): ?>
                                                    <?= htmlspecialchars($spec->spec_unit) ?>
                                                <?php endif; ?>
                                            </span>
                                            <?php if (!empty($spec->spec_category)): ?>
                                                <small class="text-muted ms-2">(<?= htmlspecialchars($spec->spec_category) ?>)</small>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Social Share -->
                <div class="social-share" data-aos="fade-up" data-aos-delay="600">
                    <h6 class="mb-3">Bagikan Fasilitas Ini:</h6>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>"
                            target="_blank" class="share-btn share-facebook" title="Bagikan di Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($facility->title) ?>"
                            target="_blank" class="share-btn share-twitter" title="Bagikan di Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text=<?= urlencode($facility->title . ' - ' . current_url()) ?>"
                            target="_blank" class="share-btn share-whatsapp" title="Bagikan di WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(current_url()) ?>"
                            target="_blank" class="share-btn share-linkedin" title="Bagikan di LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Facilities -->
            <?php if (!empty($related_facilities)): ?>
                <div class="sidebar-card" data-aos="fade-up" data-aos-delay="300">
                    <h5 class="sidebar-title">
                        <i class="fas fa-layer-group text-primary"></i>
                        Fasilitas Terkait
                    </h5>
                    <?php foreach ($related_facilities as $related): ?>
                        <a href="<?= site_url('facilities/detail/' . $related->slug) ?>" class="related-facility">
                            <?php if (!empty($related->image)): ?>
                                <img src="<?= base_url('public/uploads/facilities/' . $related->image) ?>"
                                    alt="<?= htmlspecialchars($related->title) ?>"
                                    class="related-facility-image">
                            <?php else: ?>
                                <div class="related-facility-placeholder">
                                    <i class="fas fa-building"></i>
                                </div>
                            <?php endif; ?>
                            <div class="related-facility-content">
                                <h6><?= character_limiter($related->title, 40) ?></h6>
                                <small><?= $related->category_name ?></small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Featured Facilities -->
            <?php if (!empty($featured_facilities)): ?>
                <div class="sidebar-card" data-aos="fade-up" data-aos-delay="400">
                    <h5 class="sidebar-title">
                        <i class="fas fa-star text-warning"></i>
                        Fasilitas Unggulan
                    </h5>
                    <?php foreach ($featured_facilities as $featured): ?>
                        <a href="<?= site_url('facilities/detail/' . $featured->slug) ?>" class="related-facility">
                            <?php if (!empty($featured->image)): ?>
                                <img src="<?= base_url('public/uploads/facilities/' . $featured->image) ?>"
                                    alt="<?= htmlspecialchars($featured->title) ?>"
                                    class="related-facility-image">
                            <?php else: ?>
                                <div class="related-facility-placeholder">
                                    <i class="fas fa-star"></i>
                                </div>
                            <?php endif; ?>
                            <div class="related-facility-content">
                                <h6><?= character_limiter($featured->title, 40) ?></h6>
                                <small><?= $featured->category_name ?></small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Quick Actions -->
            <div class="sidebar-card" data-aos="fade-up" data-aos-delay="500">
                <h5 class="sidebar-title">
                    <i class="fas fa-bolt text-warning"></i>
                    Aksi Cepat
                </h5>
                <div class="d-grid gap-2">
                    <a href="<?= site_url('facilities') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-list me-2"></i>Lihat Semua Fasilitas
                    </a>
                    <?php if (!empty($facility->slug)): ?>
                        <a href="<?= site_url('facilities/category/' . $facility->slug) ?>" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-tag me-2"></i>Fasilitas Sejenis
                        </a>
                    <?php endif; ?>
                    <a href="<?= site_url('facilities/search') ?>" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-search me-2"></i>Cari Fasilitas Lain
                    </a>
                    <a href="<?= site_url('contact') ?>" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>