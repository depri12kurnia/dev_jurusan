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

    .search-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
    }

    .search-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .search-keyword {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 20px;
        border-radius: 25px;
        display: inline-block;
        font-weight: 500;
        margin: 10px 0;
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

    .search-form-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        margin: -30px auto 40px;
        max-width: 800px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 10;
    }

    .search-form {
        position: relative;
    }

    .search-form input {
        border-radius: 25px;
        padding: 15px 60px 15px 25px;
        border: 2px solid var(--border-color);
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .search-form input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
    }

    .search-form button {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--primary-color);
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        color: white;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .search-form button:hover {
        background: var(--secondary-color);
        transform: translateY(-50%) scale(1.05);
    }

    .search-filters {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .filter-btn {
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 8px 16px;
        color: var(--text-muted);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .results-header {
        background: var(--bg-light);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        border-left: 4px solid var(--primary-color);
    }

    .results-count {
        font-size: 1.1rem;
        color: var(--primary-color);
        font-weight: 600;
    }

    .results-info {
        color: var(--text-muted);
        font-size: 14px;
        margin-top: 5px;
    }

    .news-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        border: 1px solid var(--border-color);
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

    .news-title a {
        color: inherit;
        text-decoration: none;
    }

    .news-title a:hover {
        color: var(--primary-color);
    }

    .news-excerpt {
        color: var(--text-muted);
        margin-bottom: 15px;
        font-size: 14px;
        line-height: 1.6;
    }

    .news-excerpt mark {
        background-color: var(--accent-color);
        padding: 2px 4px;
        border-radius: 3px;
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

    .sidebar-widget {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--border-color);
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

    .search-suggestions {
        background: var(--bg-light);
        border-radius: 10px;
        padding: 20px;
        margin-top: 30px;
    }

    .suggestion-tags {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .suggestion-tag {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 5px 15px;
        color: var(--text-dark);
        text-decoration: none;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .suggestion-tag:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0 40px;
        }

        .search-title {
            font-size: 1.8rem;
        }

        .search-form-section {
            margin: -20px 15px 30px;
            padding: 20px;
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
                <div class="search-icon" data-aos="zoom-in">
                    <i class="fas fa-search"></i>
                </div>
                <h1 class="search-title" data-aos="fade-up">
                    Hasil Pencarian
                </h1>
                <p class="lead mb-3" data-aos="fade-up" data-aos-delay="100">
                    Menampilkan hasil untuk:
                </p>
                <div class="search-keyword" data-aos="fade-up" data-aos-delay="200">
                    "<?= htmlspecialchars($keyword) ?>"
                </div>
                <div class="mt-3" data-aos="fade-up" data-aos-delay="300">
                    <span class="fs-4 fw-bold"><?= $total_news ?></span> hasil ditemukan
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
                <li class="breadcrumb-item active" aria-current="page">Pencarian</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Search Form Section -->
<div class="container">
    <div class="search-form-section" data-aos="fade-up">
        <form class="search-form" action="<?= site_url('news/search') ?>" method="get">
            <input type="text" class="form-control" name="q" placeholder="Cari berita lainnya..." value="<?= htmlspecialchars($keyword) ?>" required>
            <button type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <div class="search-filters">
            <a href="<?= site_url('news') ?>" class="filter-btn">Semua Berita</a>
            <?php foreach ($categories as $cat): ?>
                <a href="<?= site_url('news/category/' . $cat->slug) ?>" class="filter-btn">
                    <?= $cat->name ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Results Header -->
<?php if ($total_news > 0): ?>
    <div class="container">
        <div class="results-header" data-aos="fade-up">
            <div class="results-count">
                <i class="fas fa-search me-2"></i>
                <?= $total_news ?> hasil pencarian ditemukan
            </div>
            <div class="results-info">
                Kata kunci: "<strong><?= htmlspecialchars($keyword) ?></strong>"
                | Halaman <?= $current_page ?> dari <?= $total_pages ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Search Results -->
            <div class="col-lg-8">
                <?php if (!empty($news)): ?>
                    <div class="row">
                        <?php foreach ($news as $item): ?>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <div class="news-card" data-aos="fade-up">
                                    <div class="news-image" style="background-image: url('<?= !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg') ?>');">
                                        <?php if (!empty($item->category_name)): ?>
                                            <div class="news-category"><?= $item->category_name ?></div>
                                        <?php endif; ?>
                                        <div class="news-date"><?= date('d M Y', strtotime($item->published_at)) ?></div>
                                    </div>
                                    <div class="news-content">
                                        <h4 class="news-title">
                                            <a href="<?= site_url('news/' . $item->slug) ?>">
                                                <?php
                                                // Highlight keyword in title
                                                $highlighted_title = str_ireplace($keyword, '<mark>' . $keyword . '</mark>', $item->title);
                                                echo $highlighted_title;
                                                ?>
                                            </a>
                                        </h4>
                                        <div class="news-meta">
                                            <span><i class="fas fa-user"></i> <?= $item->author_name ?></span>
                                            <span><i class="fas fa-eye"></i> <?= number_format($item->views ?? 0) ?></span>
                                        </div>
                                        <p class="news-excerpt">
                                            <?php
                                            // Get excerpt and highlight keyword
                                            $excerpt = !empty($item->excerpt) ? $item->excerpt : strip_tags($item->content);
                                            $excerpt = character_limiter($excerpt, 120);
                                            $highlighted_excerpt = str_ireplace($keyword, '<mark>' . $keyword . '</mark>', $excerpt);
                                            echo $highlighted_excerpt;
                                            ?>
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
                        <i class="fas fa-search-minus"></i>
                        <h4>Tidak Ada Hasil Ditemukan</h4>
                        <p class="text-muted">
                            Maaf, tidak ada berita yang sesuai dengan kata kunci "<strong><?= htmlspecialchars($keyword) ?></strong>".
                        </p>

                        <div class="search-suggestions">
                            <h6><i class="fas fa-lightbulb me-2"></i>Saran Pencarian:</h6>
                            <ul class="text-start d-inline-block">
                                <li>Periksa ejaan kata kunci</li>
                                <li>Gunakan kata kunci yang lebih umum</li>
                                <li>Coba kata kunci yang berbeda</li>
                                <li>Gunakan sinonim atau kata yang berkaitan</li>
                            </ul>

                            <div class="suggestion-tags">
                                <a href="<?= site_url('news/search?q=akademik') ?>" class="suggestion-tag">akademik</a>
                                <a href="<?= site_url('news/search?q=mahasiswa') ?>" class="suggestion-tag">mahasiswa</a>
                                <a href="<?= site_url('news/search?q=kegiatan') ?>" class="suggestion-tag">kegiatan</a>
                                <a href="<?= site_url('news/search?q=prestasi') ?>" class="suggestion-tag">prestasi</a>
                                <a href="<?= site_url('news/search?q=kampus') ?>" class="suggestion-tag">kampus</a>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="<?= site_url('news') ?>" class="btn btn-primary me-3">
                                <i class="fas fa-newspaper me-2"></i> Lihat Semua Berita
                            </a>
                            <button onclick="document.querySelector('.search-form input').focus()" class="btn btn-outline-primary">
                                <i class="fas fa-search me-2"></i> Cari Lagi
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search Tips Widget -->
                <div class="sidebar-widget" data-aos="fade-left">
                    <h5 class="widget-title">
                        <i class="fas fa-question-circle text-info me-2"></i>
                        Tips Pencarian
                    </h5>
                    <div class="small">
                        <div class="mb-3">
                            <strong>Gunakan tanda kutip</strong><br>
                            <code>"kata kunci"</code> untuk mencari frase exact
                        </div>
                        <div class="mb-3">
                            <strong>Kata kunci multiple</strong><br>
                            Pisahkan dengan spasi untuk mencari semua kata
                        </div>
                        <div class="mb-3">
                            <strong>Minimal 3 karakter</strong><br>
                            Gunakan minimal 3 karakter untuk hasil yang lebih akurat
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

                <!-- Categories Widget -->
                <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="200">
                    <h5 class="widget-title">
                        <i class="fas fa-tags text-success me-2"></i>
                        Kategori Berita
                    </h5>
                    <div class="list-group list-group-flush">
                        <a href="<?= site_url('news') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2"></i> Semua Berita
                        </a>
                        <?php foreach ($categories as $cat): ?>
                            <a href="<?= site_url('news/category/' . $cat->slug) ?>" class="list-group-item list-group-item-action">
                                <i class="fas fa-tag me-2"></i> <?= $cat->name ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Recent Searches (if you want to implement) -->
                <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="300">
                    <h5 class="widget-title">
                        <i class="fas fa-history text-secondary me-2"></i>
                        Pencarian Terkait
                    </h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= site_url('news/search?q=mahasiswa') ?>" class="suggestion-tag">mahasiswa</a>
                        <a href="<?= site_url('news/search?q=akademik') ?>" class="suggestion-tag">akademik</a>
                        <a href="<?= site_url('news/search?q=kegiatan') ?>" class="suggestion-tag">kegiatan</a>
                        <a href="<?= site_url('news/search?q=prestasi') ?>" class="suggestion-tag">prestasi</a>
                        <a href="<?= site_url('news/search?q=penelitian') ?>" class="suggestion-tag">penelitian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>