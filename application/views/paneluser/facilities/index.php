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

    .facility-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .facility-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .facility-image {
        height: 220px;
        background-size: cover;
        background-position: center;
        position: relative;
        overflow: hidden;
    }

    .facility-image::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    }

    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8em;
        font-weight: 600;
        z-index: 2;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(45deg, #FFD700, #FFA500);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75em;
        font-weight: 600;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .facility-content {
        padding: 25px;
    }

    .facility-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--text-dark);
        line-height: 1.4;
    }

    .facility-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .facility-description {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .facility-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid var(--border-light);
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .read-more-btn:hover {
        color: var(--secondary-color);
        text-decoration: none;
        transform: translateX(3px);
    }

    .sidebar-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        border: 1px solid var(--border-light);
    }

    .sidebar-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-item,
    .facility-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-light);
        transition: all 0.3s ease;
    }

    .category-item:last-child,
    .facility-item:last-child {
        border-bottom: none;
    }

    .category-item:hover,
    .facility-item:hover {
        padding-left: 10px;
    }

    .category-link,
    .facility-link {
        color: var(--text-dark);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
        transition: all 0.3s ease;
    }

    .category-link:hover,
    .facility-link:hover {
        color: var(--primary-color);
        text-decoration: none;
    }

    .count-badge {
        background: var(--bg-light);
        color: var(--text-muted);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .search-form {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .search-input {
        border: 2px solid var(--border-light);
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 185, 173, 0.1);
    }

    .search-btn {
        background: var(--primary-color);
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 15px;
    }

    .search-btn:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
    }

    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }

    .filter-btn {
        padding: 8px 16px;
        border: 2px solid var(--border-light);
        background: white;
        border-radius: 20px;
        color: var(--text-dark);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        text-decoration: none;
    }

    .pagination-info {
        background: var(--bg-light);
        padding: 15px 20px;
        border-radius: 10px;
        text-align: center;
        color: var(--text-muted);
        font-size: 0.9rem;
        margin: 30px 0;
    }

    .no-facilities {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0 40px;
        }

        .facility-content {
            padding: 20px;
        }

        .sidebar-card {
            padding: 20px;
        }

        .filter-buttons {
            justify-content: center;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">
                    <i class="fas fa-building me-3"></i>
                    Fasilitas & Sarana
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                    Jelajahi fasilitas lengkap dan modern yang tersedia untuk mendukung proses pembelajaran dan praktik mahasiswa
                </p>
                <div class="d-flex justify-content-center gap-3" data-aos="fade-up" data-aos-delay="200">
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-list me-2"></i><?= $total_facilities ?> Fasilitas
                    </span>
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-tags me-2"></i><?= count($categories) ?> Kategori
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Search Form -->
            <div class="search-form" data-aos="fade-up">
                <h5 class="mb-3">
                    <i class="fas fa-search me-2 text-primary"></i>
                    Cari Fasilitas
                </h5>
                <form action="<?= site_url('facilities/search') ?>" method="get">
                    <div class="row">
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" name="q" class="form-control search-input"
                                placeholder="Masukkan nama fasilitas atau kata kunci..."
                                value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn search-btn w-100">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Category Filter -->
            <?php if (!empty($categories)): ?>
                <div class="filter-buttons" data-aos="fade-up" data-aos-delay="100">
                    <a href="<?= site_url('facilities') ?>" class="filter-btn <?= !isset($_GET['category']) ? 'active' : '' ?>">
                        <i class="fas fa-th-large me-2"></i>Semua
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="<?= site_url('facilities/category/' . $category->slug) ?>" class="filter-btn">
                            <i class="<?= $category->icon ?: 'fas fa-tag' ?> me-2"
                                style="color: <?= $category->color ?>"></i>
                            <?= $category->name ?>
                            <span class="ms-2 count-badge"><?= $category->facilities_count ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Facilities Grid -->
            <div class="row">
                <?php if (!empty($facilities)): ?>
                    <?php foreach ($facilities as $index => $facility): ?>
                        <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= ($index % 6) * 100 ?>">
                            <article class="facility-card h-100">
                                <?php if (!empty($facility->image)): ?>
                                    <div class="facility-image" style="background-image: url('<?= base_url('public/uploads/facilities/' . $facility->image) ?>')">
                                        <?php if (!empty($facility->category_name)): ?>
                                            <span class="category-badge" style="background-color: <?= $facility->category_color ?>40; color: <?= $facility->category_color ?>">
                                                <i class="<?= $facility->category_icon ?: 'fas fa-tag' ?> me-1"></i>
                                                <?= $facility->category_name ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($facility->is_featured == 'Yes'): ?>
                                            <span class="featured-badge">
                                                <i class="fas fa-star"></i>
                                                Unggulan
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="facility-image bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-building text-muted" style="font-size: 3rem;"></i>
                                        <?php if (!empty($facility->category_name)): ?>
                                            <span class="category-badge" style="background-color: <?= $facility->category_color ?>40; color: <?= $facility->category_color ?>">
                                                <i class="<?= $facility->category_icon ?: 'fas fa-tag' ?> me-1"></i>
                                                <?= $facility->category_name ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($facility->is_featured == 'Yes'): ?>
                                            <span class="featured-badge">
                                                <i class="fas fa-star"></i>
                                                Unggulan
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="facility-content d-flex flex-column">
                                    <h3 class="facility-title">
                                        <a href="<?= site_url('facilities/detail/' . $facility->slug) ?>" class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($facility->title) ?>
                                        </a>
                                    </h3>

                                    <?php if (!empty($facility->subtitle)): ?>
                                        <p class="facility-subtitle"><?= htmlspecialchars($facility->subtitle) ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($facility->description)): ?>
                                        <p class="facility-description"><?= character_limiter(strip_tags($facility->description), 120) ?></p>
                                    <?php endif; ?>

                                    <div class="facility-meta mt-auto">
                                        <small class="text-muted">
                                            <?php if (!empty($facility->view_count)): ?>
                                                <i class="fas fa-eye me-1"></i><?= number_format($facility->view_count) ?> views
                                            <?php endif; ?>
                                            <?php if (!empty($facility->created_at)): ?>
                                                <span class="ms-3">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    <?= date('d M Y', strtotime($facility->created_at)) ?>
                                                </span>
                                            <?php endif; ?>
                                        </small>
                                        <a href="<?= site_url('facilities/detail/' . $facility->slug) ?>" class="read-more-btn">
                                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="no-facilities" data-aos="fade-up">
                            <i class="fas fa-building text-muted mb-4" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mb-3">Belum ada fasilitas yang tersedia</h4>
                            <p class="text-muted mb-4">
                                Mohon periksa kembali nanti atau hubungi administrator untuk informasi lebih lanjut.
                            </p>
                            <a href="<?= site_url('') ?>" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination Info -->
            <?php if (!empty($facilities) && $total_pages > 1): ?>
                <div class="pagination-info">
                    Halaman <?= $current_page ?> dari <?= $total_pages ?>
                    (Menampilkan <?= count($facilities) ?> dari <?= $total_facilities ?> fasilitas)
                </div>
            <?php endif; ?>

            <!-- Pagination -->
            <?php if (!empty($pagination)): ?>
                <div class="d-flex justify-content-center" data-aos="fade-up">
                    <?= $pagination ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Categories Sidebar -->
            <?php if (!empty($categories)): ?>
                <div class="sidebar-card" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="sidebar-title">
                        <i class="fas fa-tags text-primary"></i>
                        Kategori Fasilitas
                    </h5>
                    <?php foreach ($categories as $category): ?>
                        <div class="category-item">
                            <a href="<?= site_url('facilities/category/' . $category->slug) ?>" class="category-link">
                                <i class="<?= $category->icon ?: 'fas fa-tag' ?>"
                                    style="color: <?= $category->color ?>"></i>
                                <span><?= $category->name ?></span>
                            </a>
                            <span class="count-badge"><?= $category->facilities_count ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Featured Facilities Sidebar -->
            <?php if (!empty($featured_facilities)): ?>
                <div class="sidebar-card" data-aos="fade-up" data-aos-delay="300">
                    <h5 class="sidebar-title">
                        <i class="fas fa-star text-warning"></i>
                        Fasilitas Unggulan
                    </h5>
                    <?php foreach ($featured_facilities as $featured): ?>
                        <div class="facility-item">
                            <a href="<?= site_url('facilities/detail/' . $featured->slug) ?>" class="facility-link">
                                <div class="d-flex align-items-center">
                                    <?php if (!empty($featured->image)): ?>
                                        <img src="<?= base_url('public/uploads/facilities/' . $featured->image) ?>"
                                            alt="<?= htmlspecialchars($featured->title) ?>"
                                            class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-building text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="fw-medium"><?= character_limiter($featured->title, 30) ?></div>
                                        <small class="text-muted"><?= $featured->category_name ?></small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Quick Stats -->
            <div class="sidebar-card" data-aos="fade-up" data-aos-delay="400">
                <h5 class="sidebar-title">
                    <i class="fas fa-chart-bar text-success"></i>
                    Statistik Fasilitas
                </h5>
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="h4 text-primary mb-1"><?= $total_facilities ?></div>
                        <small class="text-muted">Total Fasilitas</small>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="h4 text-warning mb-1"><?= count($categories) ?></div>
                        <small class="text-muted">Kategori</small>
                    </div>
                    <?php if (!empty($featured_facilities)): ?>
                        <div class="col-6">
                            <div class="h4 text-success mb-1"><?= count($featured_facilities) ?></div>
                            <small class="text-muted">Unggulan</small>
                        </div>
                    <?php endif; ?>
                    <div class="col-6">
                        <div class="h4 text-info mb-1">
                            <?php
                            $total_views = 0;
                            if (!empty($facilities)) {
                                foreach ($facilities as $facility) {
                                    $total_views += $facility->view_count ?? 0;
                                }
                            }
                            echo number_format($total_views);
                            ?>
                        </div>
                        <small class="text-muted">Total Views</small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-card" data-aos="fade-up" data-aos-delay="500">
                <h5 class="sidebar-title">
                    <i class="fas fa-bolt text-warning"></i>
                    Aksi Cepat
                </h5>
                <div class="d-grid gap-2">
                    <a href="<?= site_url('facilities/search?q=laboratorium') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-flask me-2"></i>Cari Laboratorium
                    </a>
                    <a href="<?= site_url('facilities/search?q=ruang kuliah') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-chalkboard me-2"></i>Cari Ruang Kuliah
                    </a>
                    <a href="<?= site_url('facilities/search?q=perpustakaan') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-book me-2"></i>Cari Perpustakaan
                    </a>
                    <a href="<?= site_url('facilities?featured=1') ?>" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-star me-2"></i>Lihat Unggulan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>