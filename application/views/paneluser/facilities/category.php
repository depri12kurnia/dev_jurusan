<style>
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 80px 0 60px;
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
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,20 50,40 100,20 150,40 200,20 250,40 300,20 350,40 400,20 450,40 500,20 550,40 600,20 650,40 700,20 750,40 800,20 850,40 900,20 950,40 1000,20 1000,100 0,100"/></svg>') repeat-x bottom;
    }

    .breadcrumb-section {
        background: var(--bg-light);
        padding: 15px 0;
        margin-bottom: 30px;
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

    .category-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .category-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 2rem;
    }

    .category-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .category-description {
        font-size: 1.1rem;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .category-stats {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
    }

    .stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-light);
    }

    .stat-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .stat-label {
        color: var(--text-muted);
        font-weight: 500;
    }

    .stat-value {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .filters-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .sort-controls {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 15px;
        justify-content: space-between;
    }

    .sort-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sort-label {
        font-weight: 500;
        color: var(--text-dark);
        white-space: nowrap;
    }

    .form-select {
        border: 2px solid var(--border-light);
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .view-toggle {
        display: flex;
        background: var(--bg-light);
        border-radius: 10px;
        overflow: hidden;
    }

    .view-btn {
        padding: 8px 15px;
        border: none;
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.9rem;
    }

    .view-btn.active {
        background: var(--primary-color);
        color: white;
    }

    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .facilities-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 40px;
    }

    .facility-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .facility-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: inherit;
    }

    .facility-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .facility-card:hover .facility-image {
        transform: scale(1.05);
    }

    .facility-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, var(--bg-light), #f8f9fa);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: 3rem;
    }

    .facility-content {
        padding: 20px;
    }

    .facility-category {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .facility-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .facility-excerpt {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .facility-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .facility-meta-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(45deg, #FFD700, #FFA500);
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* List View Styles */
    .facility-card.list-view {
        display: flex;
        align-items: stretch;
    }

    .facility-card.list-view .facility-image,
    .facility-card.list-view .facility-placeholder {
        width: 250px;
        height: 150px;
        flex-shrink: 0;
    }

    .facility-card.list-view .facility-content {
        flex: 1;
        padding: 20px 25px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .facility-card.list-view .facility-title {
        font-size: 1.3rem;
        margin-bottom: 8px;
    }

    .facility-card.list-view .facility-excerpt {
        margin-bottom: 12px;
        -webkit-line-clamp: 1;
        line-clamp: 1;
    }

    .no-facilities {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }

    .no-facilities i {
        font-size: 4rem;
        color: var(--border-color);
        margin-bottom: 20px;
    }

    .no-facilities h4 {
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .pagination {
        background: white;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-link {
        border: none;
        color: var(--text-dark);
        padding: 10px 15px;
        margin: 0 2px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: var(--primary-color);
        color: white;
    }

    .page-item.active .page-link {
        background: var(--primary-color);
        color: white;
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
        .category-title {
            font-size: 2rem;
        }

        .facilities-grid {
            grid-template-columns: 1fr;
        }

        .facility-card.list-view {
            flex-direction: column;
        }

        .facility-card.list-view .facility-image,
        .facility-card.list-view .facility-placeholder {
            width: 100%;
            height: 200px;
        }

        .sort-controls {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .sort-group {
            justify-content: space-between;
        }

        .view-toggle {
            align-self: center;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">
                    <i class="<?= !empty($category->icon) ? $category->icon : 'fas fa-building' ?> me-3"></i>
                    <?= htmlspecialchars($category->name) ?>
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                    <?= !empty($category->description) ? htmlspecialchars($category->description) : 'Jelajahi fasilitas kategori ' . htmlspecialchars($category->name) . ' yang lengkap dan modern untuk mendukung proses pembelajaran' ?>
                </p>
                <div class="d-flex justify-content-center gap-3" data-aos="fade-up" data-aos-delay="200">
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-list me-2"></i>
                        <?= number_format($total_facilities) ?> Fasilitas
                    </span>
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-tag me-2"></i>
                        Kategori <?= htmlspecialchars($category->name) ?>
                    </span>
                    <?php if ($featured_count > 0): ?>
                        <span class="badge bg-white text-warning px-3 py-2">
                            <i class="fas fa-star me-2"></i>
                            <?= number_format($featured_count) ?> Unggulan
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
        Kembali ke Semua Fasilitas
    </a>

    <!-- Category Header -->
    <div class="category-header" data-aos="fade-up">
        <div class="category-icon">
            <i class="<?= $category->icon ?: 'fas fa-building' ?>"></i>
        </div>
        <h1 class="category-title"><?= htmlspecialchars($category->name) ?></h1>
        <?php if (!empty($category->description)): ?>
            <p class="category-description"><?= htmlspecialchars($category->description) ?></p>
        <?php endif; ?>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Category Statistics -->
            <div class="category-stats" data-aos="fade-up" data-aos-delay="100">
                <div class="row text-center">
                    <div class="col-md-3 col-6">
                        <div class="stat-row">
                            <span class="stat-label">Total Fasilitas</span>
                            <span class="stat-value"><?= number_format($total_facilities) ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-row">
                            <span class="stat-label">Fasilitas Unggulan</span>
                            <span class="stat-value"><?= number_format($featured_count) ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-row">
                            <span class="stat-label">Halaman Ini</span>
                            <span class="stat-value"><?= count($facilities) ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-row">
                            <span class="stat-label">Diperbarui</span>
                            <span class="stat-value"><?= date('d/m/Y') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Sort -->
            <div class="filters-section" data-aos="fade-up" data-aos-delay="200">
                <form method="GET" action="<?= current_url() ?>" class="sort-controls">
                    <div class="sort-group">
                        <label class="sort-label">Urutkan:</label>
                        <select name="sort" class="form-select" style="width: auto;" onchange="this.form.submit()">
                            <option value="newest" <?= ($sort == 'newest') ? 'selected' : '' ?>>Terbaru</option>
                            <option value="oldest" <?= ($sort == 'oldest') ? 'selected' : '' ?>>Terlama</option>
                            <option value="title_asc" <?= ($sort == 'title_asc') ? 'selected' : '' ?>>Judul A-Z</option>
                            <option value="title_desc" <?= ($sort == 'title_desc') ? 'selected' : '' ?>>Judul Z-A</option>
                            <option value="most_viewed" <?= ($sort == 'most_viewed') ? 'selected' : '' ?>>Paling Dilihat</option>
                            <option value="featured" <?= ($sort == 'featured') ? 'selected' : '' ?>>Unggulan Dulu</option>
                        </select>
                    </div>

                    <div class="sort-group">
                        <label class="sort-label">Tampilkan:</label>
                        <select name="per_page" class="form-select" style="width: auto;" onchange="this.form.submit()">
                            <option value="6" <?= ($per_page == 6) ? 'selected' : '' ?>>6 per halaman</option>
                            <option value="12" <?= ($per_page == 12) ? 'selected' : '' ?>>12 per halaman</option>
                            <option value="24" <?= ($per_page == 24) ? 'selected' : '' ?>>24 per halaman</option>
                            <option value="48" <?= ($per_page == 48) ? 'selected' : '' ?>>48 per halaman</option>
                        </select>
                    </div>

                    <div class="view-toggle">
                        <button type="button" class="view-btn <?= ($view == 'grid') ? 'active' : '' ?>" onclick="toggleView('grid')">
                            <i class="fas fa-th"></i>
                            Grid
                        </button>
                        <button type="button" class="view-btn <?= ($view == 'list') ? 'active' : '' ?>" onclick="toggleView('list')">
                            <i class="fas fa-list"></i>
                            List
                        </button>
                    </div>
                </form>
            </div>

            <!-- Facilities Content -->
            <?php if (!empty($facilities)): ?>
                <div id="facilities-container" class="<?= ($view == 'list') ? 'facilities-list' : 'facilities-grid' ?>" data-aos="fade-up" data-aos-delay="300">
                    <?php foreach ($facilities as $index => $facility): ?>
                        <a href="<?= site_url('facilities/detail/' . $facility->slug) ?>"
                            class="facility-card <?= ($view == 'list') ? 'list-view' : '' ?>"
                            data-aos="zoom-in"
                            data-aos-delay="<?= ($index % 6) * 100 ?>">

                            <?php if ($facility->is_featured == 'Yes'): ?>
                                <div class="featured-badge">
                                    <i class="fas fa-star"></i>
                                    Unggulan
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($facility->image)): ?>
                                <img src="<?= base_url('public/uploads/facilities/' . $facility->image) ?>"
                                    alt="<?= htmlspecialchars($facility->title) ?>"
                                    class="facility-image">
                            <?php else: ?>
                                <div class="facility-placeholder">
                                    <i class="<?= $category->icon ?: 'fas fa-building' ?>"></i>
                                </div>
                            <?php endif; ?>

                            <div class="facility-content">
                                <div class="facility-category" style="background-color: <?= $category->color ?>20; color: <?= $category->color ?>; border: 1px solid <?= $category->color ?>40;">
                                    <i class="<?= $category->icon ?: 'fas fa-tag' ?>"></i>
                                    <?= htmlspecialchars($category->name) ?>
                                </div>

                                <h3 class="facility-title"><?= htmlspecialchars($facility->title) ?></h3>

                                <?php if (!empty($facility->description)): ?>
                                    <p class="facility-excerpt"><?= character_limiter(strip_tags($facility->description), 100) ?></p>
                                <?php endif; ?>

                                <div class="facility-meta">
                                    <div class="facility-meta-left">
                                        <div class="meta-item">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span><?= date('d M Y', strtotime($facility->created_at)) ?></span>
                                        </div>
                                        <?php if (!empty($facility->view_count)): ?>
                                            <div class="meta-item">
                                                <i class="fas fa-eye"></i>
                                                <span><?= number_format($facility->view_count) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if (!empty($pagination)): ?>
                    <div class="pagination-wrapper" data-aos="fade-up" data-aos-delay="400">
                        <?= $pagination ?>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <!-- No Facilities -->
                <div class="no-facilities" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-search"></i>
                    <h4>Belum Ada Fasilitas</h4>
                    <p>Belum ada fasilitas dalam kategori <strong><?= htmlspecialchars($category->name) ?></strong>.</p>
                    <p>Silakan periksa kembali nanti atau jelajahi kategori lainnya.</p>
                    <a href="<?= site_url('facilities') ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-building me-2"></i>
                        Lihat Semua Fasilitas
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-3">
            <!-- Other Categories -->
            <div class="sidebar-card" data-aos="fade-up" data-aos-delay="300">
                <h5 class="sidebar-title">
                    <i class="fas fa-layer-group text-primary"></i>
                    Kategori Lainnya
                </h5>
                <?php if (!empty($other_categories)): ?>
                    <?php foreach ($other_categories as $other_cat): ?>
                        <a href="<?= site_url('facilities/category/' . $other_cat->slug) ?>"
                            class="sidebar-category-item">
                            <div class="category-item-icon" style="background-color: <?= $other_cat->color ?>20; color: <?= $other_cat->color ?>;">
                                <i class="<?= $other_cat->icon ?: 'fas fa-tag' ?>"></i>
                            </div>
                            <div class="category-item-content">
                                <h6><?= htmlspecialchars($other_cat->name) ?></h6>
                                <small><?= isset($other_cat->facility_count) ? $other_cat->facility_count : (isset($other_cat->facilities_count) ? $other_cat->facilities_count : '0') ?> fasilitas</small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-card" data-aos="fade-up" data-aos-delay="400">
                <h5 class="sidebar-title">
                    <i class="fas fa-bolt text-warning"></i>
                    Aksi Cepat
                </h5>
                <div class="d-grid gap-2">
                    <a href="<?= site_url('facilities') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-list me-2"></i>Semua Fasilitas
                    </a>
                    <a href="<?= site_url('facilities/search') ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-search me-2"></i>Cari Fasilitas
                    </a>
                    <a href="<?= site_url('facilities') ?>?featured=1" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-star me-2"></i>Fasilitas Unggulan
                    </a>
                    <a href="<?= site_url('contact') ?>" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Category Info -->
            <?php if (!empty($category->description) || !empty($category->additional_info)): ?>
                <div class="sidebar-card" data-aos="fade-up" data-aos-delay="500">
                    <h5 class="sidebar-title">
                        <i class="fas fa-info-circle text-info"></i>
                        Tentang Kategori
                    </h5>
                    <?php if (!empty($category->description)): ?>
                        <p class="text-muted small"><?= htmlspecialchars($category->description) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($category->additional_info)): ?>
                        <div class="mt-3">
                            <?= $category->additional_info ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function toggleView(viewType) {
        // Update view buttons
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector(`[onclick="toggleView('${viewType}')"]`).classList.add('active');

        // Update container class
        const container = document.getElementById('facilities-container');
        if (viewType === 'list') {
            container.className = 'facilities-list';
            document.querySelectorAll('.facility-card').forEach(card => {
                card.classList.add('list-view');
            });
        } else {
            container.className = 'facilities-grid';
            document.querySelectorAll('.facility-card').forEach(card => {
                card.classList.remove('list-view');
            });
        }

        // Update URL without reload
        const url = new URL(window.location);
        url.searchParams.set('view', viewType);
        window.history.replaceState(null, '', url);
    }

    // Initialize view on page load
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentView = urlParams.get('view') || 'grid';
        toggleView(currentView);
    });
</script>

<style>
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

    .sidebar-category-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-light);
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s ease;
    }

    .sidebar-category-item:last-child {
        border-bottom: none;
    }

    .sidebar-category-item:hover {
        text-decoration: none;
        color: var(--primary-color);
        padding-left: 10px;
    }

    .category-item-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.1rem;
    }

    .category-item-content h6 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 2px;
        line-height: 1.3;
    }

    .category-item-content small {
        color: var(--text-muted);
        font-size: 0.8rem;
    }
</style>