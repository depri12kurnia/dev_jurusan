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

    .article-header {
        margin-bottom: 40px;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.3;
        color: var(--text-dark);
        margin-bottom: 20px;
    }

    .article-meta {
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

    .category-badge {
        background: var(--accent-color);
        color: var(--text-dark);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
    }

    .article-image {
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 40px;
    }

    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4,
    .article-content h5,
    .article-content h6 {
        color: var(--primary-color);
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .article-content h2 {
        font-size: 1.8rem;
        border-left: 4px solid var(--primary-color);
        padding-left: 15px;
    }

    .article-content h3 {
        font-size: 1.5rem;
    }

    .article-content p {
        margin-bottom: 20px;
        text-align: justify;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 20px 0;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .article-content blockquote {
        border-left: 4px solid var(--accent-color);
        background: var(--bg-light);
        padding: 20px;
        margin: 30px 0;
        font-style: italic;
        border-radius: 0 10px 10px 0;
    }

    .article-content ul,
    .article-content ol {
        padding-left: 30px;
        margin-bottom: 20px;
    }

    .article-content li {
        margin-bottom: 8px;
    }

    .share-section {
        background: var(--bg-light);
        padding: 20px;
        border-radius: 15px;
        margin: 40px 0;
    }

    .share-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .share-btn {
        padding: 8px 16px;
        border-radius: 25px;
        text-decoration: none;
        color: white;
        font-size: 14px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .share-btn.facebook {
        background: #3b5998;
    }

    .share-btn.twitter {
        background: #1da1f2;
    }

    .share-btn.whatsapp {
        background: #25d366;
    }

    .share-btn.telegram {
        background: #0088cc;
    }

    .share-btn.linkedin {
        background: #0077b5;
    }

    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .related-news {
        margin-top: 60px;
    }

    .related-news-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 30px;
        text-align: center;
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
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .news-date {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.9);
        color: var(--text-dark);
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 500;
    }

    .news-content {
        padding: 20px;
    }

    .news-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .news-title a {
        color: var(--text-dark);
        text-decoration: none;
    }

    .news-title a:hover {
        color: var(--primary-color);
    }

    .news-excerpt {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.6;
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

    .back-to-list {
        background: var(--primary-color);
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .back-to-list:hover {
        background: var(--secondary-color);
        color: white;
        transform: translateY(-2px);
    }

    .table-of-contents {
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 20px;
        margin: 30px 0;
    }

    .table-of-contents h6 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 15px;
    }

    .table-of-contents ul {
        list-style: none;
        padding-left: 0;
    }

    .table-of-contents li {
        margin-bottom: 8px;
    }

    .table-of-contents a {
        color: var(--text-dark);
        text-decoration: none;
        font-size: 14px;
    }

    .table-of-contents a:hover {
        color: var(--primary-color);
    }

    @media (max-width: 768px) {
        .article-title {
            font-size: 1.8rem;
        }

        .article-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .share-buttons {
            justify-content: center;
        }

        .news-card {
            margin-bottom: 30px;
        }
    }
</style>

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
                <?php if (!empty($news->category_name)): ?>
                    <li class="breadcrumb-item">
                        <a href="<?= site_url('news/category/' . $news->category_slug) ?>"><?= $news->category_name ?></a>
                    </li>
                <?php endif; ?>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Main Content -->
<main class="py-5">
    <div class="container">
        <div class="row">
            <!-- Article Content -->
            <div class="col-lg-8">
                <a href="<?= site_url('news') ?>" class="back-to-list" data-aos="fade-right">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Berita
                </a>

                <article class="mb-5" data-aos="fade-up">
                    <!-- Article Header -->
                    <header class="article-header">
                        <h1 class="article-title"><?= $news->title ?></h1>

                        <div class="article-meta">
                            <div class="meta-item">
                                <i class="fas fa-user"></i>
                                <span>Oleh: <strong><?= $news->author_name ?></strong></span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar"></i>
                                <span><?= date('d F Y', strtotime($news->published_at)) ?></span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-eye"></i>
                                <span><?= number_format($news->views ?? 0) ?> views</span>
                            </div>
                            <?php if (!empty($news->category_name)): ?>
                                <div class="meta-item">
                                    <a href="<?= site_url('news/category/' . $news->category_slug) ?>" class="category-badge">
                                        <i class="fas fa-tag"></i> <?= $news->category_name ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </header>

                    <!-- Featured Image -->
                    <?php if (!empty($news->thumbnail)): ?>
                        <div class="text-center mb-4">
                            <img src="<?= base_url('public/uploads/news/' . $news->thumbnail) ?>"
                                alt="<?= $news->title ?>"
                                class="article-image">
                        </div>
                    <?php endif; ?>

                    <!-- Excerpt -->
                    <?php if (!empty($news->excerpt)): ?>
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Ringkasan</h6>
                            <p class="mb-0"><?= $news->excerpt ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Article Content -->
                    <div class="article-content">
                        <?= $news->content ?>
                    </div>

                    <!-- Share Section -->
                    <div class="share-section">
                        <h6><i class="fas fa-share-alt me-2"></i>Bagikan Artikel Ini</h6>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>"
                                target="_blank" class="share-btn facebook">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($news->title) ?>"
                                target="_blank" class="share-btn twitter">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text=<?= urlencode($news->title . ' - ' . current_url()) ?>"
                                target="_blank" class="share-btn whatsapp">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="https://t.me/share/url?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($news->title) ?>"
                                target="_blank" class="share-btn telegram">
                                <i class="fab fa-telegram"></i> Telegram
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(current_url()) ?>"
                                target="_blank" class="share-btn linkedin">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Related News -->
                <?php if (!empty($related_news)): ?>
                    <section class="related-news">
                        <h3 class="related-news-title" data-aos="fade-up">
                            <i class="fas fa-newspaper me-2"></i>
                            Berita Terkait
                        </h3>
                        <div class="row">
                            <?php foreach ($related_news as $item): ?>
                                <div class="col-md-6 mb-4">
                                    <div class="news-card" data-aos="fade-up">
                                        <div class="news-image" style="background-image: url('<?= !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg') ?>');">
                                            <div class="news-date"><?= date('d M Y', strtotime($item->published_at)) ?></div>
                                        </div>
                                        <div class="news-content">
                                            <h5 class="news-title">
                                                <a href="<?= site_url('news/' . $item->slug) ?>">
                                                    <?= $item->title ?>
                                                </a>
                                            </h5>
                                            <p class="news-excerpt">
                                                <?= character_limiter(strip_tags($item->content), 100) ?>
                                            </p>
                                            <a href="<?= site_url('news/' . $item->slug) ?>" class="btn btn-outline-primary btn-sm">
                                                Baca Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Popular News Widget -->
                <?php if (!empty($popular_news)): ?>
                    <div class="sidebar-widget" data-aos="fade-left">
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

                <!-- Navigation Widget -->
                <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="100">
                    <h5 class="widget-title">
                        <i class="fas fa-compass text-info me-2"></i>
                        Navigasi
                    </h5>
                    <div class="list-group list-group-flush">
                        <a href="<?= site_url('news') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2"></i> Semua Berita
                        </a>
                        <a href="<?= site_url('news/search') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-search me-2"></i> Cari Berita
                        </a>
                        <?php if (!empty($news->category_name)): ?>
                            <a href="<?= site_url('news/category/' . $news->category_slug) ?>" class="list-group-item list-group-item-action">
                                <i class="fas fa-tag me-2"></i> Kategori: <?= $news->category_name ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Back to Top Button -->
                <div class="text-center">
                    <button onclick="window.scrollTo(0,0)" class="btn btn-primary btn-lg rounded-circle">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>