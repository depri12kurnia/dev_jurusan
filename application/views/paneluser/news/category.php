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
        font-size: 2rem;
        color: white;
    }

    .category-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .category-description {
        font-size: 1.1rem;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
    }

    .news-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .news-image {
        height: 220px;
        background-size: cover;
        background-position: center;
        position: relative;
        overflow: hidden;
    }

    .news-image::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    }

    .news-category {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--accent-color);
        color: var(--text-dark);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
    }

    .news-date {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.9);
        color: var(--text-dark);
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
        z-index: 2;
    }

    .news-content {
        padding: 25px;
    }

    .news-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 15px;
        line-height: 1.4;
        color: var(--text-dark);
    }

    .news-excerpt {
        color: var(--text-muted);
        margin-bottom: 15px;
        font-size: 14px;
        line-height: 1.6;
    }

    .news-meta {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 15px;
    }

    .news-meta span {
        margin-right: 15px;
    }

    .news-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .news-link:hover {
        color: var(--secondary-color);
    }

    .filter-section {
        background: var(--bg-light);
        padding: 20px 0;
        margin-bottom: 40px;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        border-radius: 25px;
        padding: 12px 50px 12px 20px;
        border: 1px solid var(--border-color);
    }

    .search-box button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--primary-color);
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        color: white;
    }

    .category-filter .btn {
        border-radius: 20px;
        margin: 5px;
    }

    .category-filter .btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .stats-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .stat-item {
        text-align: center;
        padding: 20px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        display: block;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 14px;
    }

    .sidebar-widget {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .widget-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border-color);
    }

    .sidebar-news-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .sidebar-news-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .sidebar-news-thumb {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        background-size: cover;
        background-position: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .sidebar-news-content h6 {
        font-size: 14px;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 5px;
    }

    .sidebar-news-content h6 a {
        color: var(--text-dark);
        text-decoration: none;
    }

    .sidebar-news-content h6 a:hover {
        color: var(--primary-color);
    }

    .sidebar-news-date {
        font-size: 11px;
        color: var(--text-muted);
    }

    .pagination .page-link {
        border-radius: 25px;
        margin: 0 3px;
        border: none;
        color: var(--primary-color);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .empty-state {
        text-align: center;
        padding: 80px 0;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0 40px;
        }

        .category-title {
            font-size: 1.8rem;
        }

        .news-card {
            margin-bottom: 30px;
        }

        .sidebar-widget {
            margin-top: 40px;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="category-icon" data-aos="zoom-in">
                    <i class="fas fa-tags"></i>
                </div>
                <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">
                    Berita <?= $category->name ?>
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                    <?= $meta_description ?>
                </p>
                <div class="d-flex justify-content-center gap-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <span class="d-block fs-2 fw-bold"><?= $total_news ?></span>
                        <small>Total Berita</small>
                    </div>
                    <div class="text-center">
                        <span class="d-block fs-2 fw-bold"><?= $total_pages ?></span>
                        <small>Halaman</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= site_url() ?>"><i class="fas fa-home"></i> Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= site_url('news') ?>">Berita</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?= $category->name ?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-3">
                <div class="search-box">
                    <form action="<?= site_url('news/search') ?>" method="get">
                        <input type="text" class="form-control" name="q" placeholder="Cari berita dalam kategori ini..." value="<?= $this->input->get('q') ?>">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="category-filter">
                    <a href="<?= site_url('news') ?>" class="btn btn-outline-primary">Semua</a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="<?= site_url('news/category/' . $cat->slug) ?>"
                            class="btn <?= ($cat->id == $category->id) ? 'btn-primary active' : 'btn-outline-secondary' ?>">
                            <?= $cat->name ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- News Content -->
            <div class="col-lg-8">
                <?php if (!empty($news)): ?>
                    <div class="row">
                        <?php foreach ($news as $item): ?>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="news-card" data-aos="fade-up">
                                    <div class="news-image" style="background-image: url('<?= !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg') ?>');">
                                        <div class="news-category"><?= $category->name ?></div>
                                        <div class="news-date"><?= date('d M Y', strtotime($item->published_at)) ?></div>
                                    </div>
                                    <div class="news-content">
                                        <h4 class="news-title">
                                            <a href="<?= site_url('news/' . $item->slug) ?>" class="text-decoration-none">
                                                <?= $item->title ?>
                                            </a>
                                        </h4>
                                        <div class="news-meta">
                                            <span><i class="fas fa-user"></i> <?= $item->author_name ?></span>
                                            <span><i class="fas fa-eye"></i> <?= number_format($item->views ?? 0) ?></span>
                                        </div>
                                        <p class="news-excerpt">
                                            <?= !empty($item->excerpt) ? character_limiter($item->excerpt, 120) : character_limiter(strip_tags($item->content), 120) ?>
                                        </p>
                                        <a href="<?= site_url('news/' . $item->slug) ?>" class="news-link">
                                            Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if (!empty($pagination)): ?>
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-center">
                                <?= $pagination ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <h4>Belum Ada Berita di Kategori Ini</h4>
                        <p class="text-muted">Saat ini belum ada berita yang dipublikasikan dalam kategori <?= $category->name ?>.</p>
                        <a href="<?= site_url('news') ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i> Lihat Semua Berita
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Category Info Widget -->
                <div class="sidebar-widget" data-aos="fade-left">
                    <h5 class="widget-title">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        Tentang Kategori
                    </h5>
                    <div class="text-center">
                        <div class="category-icon mb-3" style="width: 60px; height: 60px; font-size: 1.5rem; margin: 0 auto;">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h6><?= $category->name ?></h6>
                        <p class="text-muted small">
                            <?= $category->description ?? 'Kumpulan berita dan informasi terkait ' . $category->name ?>
                        </p>
                        <div class="stats-section">
                            <div class="row">
                                <div class="col-6">
                                    <div class="stat-item">
                                        <span class="stat-number"><?= $total_news ?></span>
                                        <span class="stat-label">Berita</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-item">
                                        <span class="stat-number"><?= $current_page ?></span>
                                        <span class="stat-label">Halaman</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular News Widget -->
                <?php if (!empty($popular_news)): ?>
                    <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="100">
                        <h5 class="widget-title">
                            <i class="fas fa-fire text-danger me-2"></i>
                            Berita Populer
                        </h5>
                        <?php foreach ($popular_news as $item): ?>
                            <div class="sidebar-news-item">
                                <div class="sidebar-news-thumb" style="background-image: url('<?= !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg') ?>');"></div>
                                <div class="sidebar-news-content">
                                    <h6>
                                        <a href="<?= site_url('news/' . $item->slug) ?>">
                                            <?= character_limiter($item->title, 60) ?>
                                        </a>
                                    </h6>
                                    <div class="sidebar-news-date">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('d M Y', strtotime($item->published_at)) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- All Categories Widget -->
                <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="200">
                    <h5 class="widget-title">
                        <i class="fas fa-list text-success me-2"></i>
                        Semua Kategori
                    </h5>
                    <div class="list-group list-group-flush">
                        <a href="<?= site_url('news') ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Semua Berita
                            <span class="badge bg-primary rounded-pill"><?= array_sum(array_column($categories, 'total_news')) ?></span>
                        </a>
                        <?php foreach ($categories as $cat): ?>
                            <a href="<?= site_url('news/category/' . $cat->slug) ?>"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= ($cat->id == $category->id) ? 'active' : '' ?>">
                                <?= $cat->name ?>
                                <span class="badge <?= ($cat->id == $category->id) ? 'bg-light text-dark' : 'bg-secondary' ?> rounded-pill">
                                    <?= $cat->total_news ?? 0 ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Back to News -->
                <div class="text-center" data-aos="fade-left" data-aos-delay="300">
                    <a href="<?= site_url('news') ?>" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Semua Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>