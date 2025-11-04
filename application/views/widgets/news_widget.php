<!-- Simple News Widget for Home Page -->
<div class="news-widget">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="widget-title">Berita Terbaru</h2>
                <p class="widget-subtitle">Informasi terkini dari kampus</p>
            </div>
        </div>

        <div class="row" id="news-container">
            <!-- News items will be loaded here -->
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Memuat berita...</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="<?= site_url('news') ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-newspaper mr-2"></i>Lihat Semua Berita
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .news-widget {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .widget-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .widget-subtitle {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    .news-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        margin-bottom: 2rem;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-5px);
    }

    .news-image {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .news-category {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0, 123, 255, 0.9);
        color: white;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
    }

    .news-content {
        padding: 1.5rem;
    }

    .news-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.8rem;
        line-height: 1.4;
    }

    .news-excerpt {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .news-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .news-link {
        color: inherit;
        text-decoration: none;
    }

    .news-link:hover {
        color: inherit;
        text-decoration: none;
    }
</style>

<script>
    // Load news when page is ready
    document.addEventListener('DOMContentLoaded', function() {
        loadNewsWidget();
    });

    function loadNewsWidget() {
        fetch('<?= site_url("news/widget/latest/6") ?>')
            .then(response => response.json())
            .then(result => {
                const container = document.getElementById('news-container');

                if (result.success && result.data.length > 0) {
                    let html = '';

                    result.data.forEach(news => {
                        html += `
                        <div class="col-lg-4 col-md-6">
                            <a href="${news.url}" class="news-link">
                                <div class="news-card">
                                    <div class="news-image" style="background-image: url('${news.thumbnail}')">
                                        <span class="news-category">${news.category}</span>
                                    </div>
                                    <div class="news-content">
                                        <h5 class="news-title">${news.title}</h5>
                                        <p class="news-excerpt">${news.excerpt}</p>
                                        <div class="news-meta">
                                            <span><i class="fas fa-user"></i> ${news.author}</span>
                                            <span><i class="fas fa-calendar"></i> ${news.published_at}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                    });

                    container.innerHTML = html;
                } else {
                    container.innerHTML = `
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Belum ada berita tersedia saat ini.
                        </div>
                    </div>
                `;
                }
            })
            .catch(error => {
                console.error('Error loading news:', error);
                document.getElementById('news-container').innerHTML = `
                <div class="col-12 text-center">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        Gagal memuat berita. Silakan coba lagi nanti.
                    </div>
                </div>
            `;
            });
    }
</script>