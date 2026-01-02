<style>
    .download-hero {
        background: linear-gradient(135deg, #00B9AD 0%, #60C0D0 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 40px;
    }

    .download-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .download-hero p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .facility-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .download-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid #667eea;
    }

    .download-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .download-icon {
        font-size: 1.5rem;
        color: #667eea;
        margin-right: 15px;
    }

    .download-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .download-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 12px;
        flex-wrap: wrap;
    }

    .badge-category {
        background: #e3f2fd;
        color: #60C0D0;
    }

    .badge-type {
        background: #f3e5f5;
        color: #00B9AD;
    }

    .download-date {
        color: #999;
        font-size: 0.9rem;
    }

    .download-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-download {
        background: linear-gradient(135deg, #00B9AD 0%, #60C0D0 100%);
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-download:hover {
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-view {
        background: #f0f0f0;
        border: 1px solid #e0e0e0;
        color: #333;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-view:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .modal-body-content {
        max-height: 600px;
        overflow: auto;
    }

    .modal-body-content iframe,
    .modal-body-content embed,
    .modal-body-content img {
        width: 100%;
        border-radius: 8px;
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
        border: 2px solid #e0e0e0;
        background: white;
        border-radius: 20px;
        color: #333;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: #667eea;
        border-color: #667eea;
        color: white;
        text-decoration: none;
    }

    .search-box {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .search-box input {
        border: 2px solid #f0f0f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 0.95rem;
    }

    .search-box input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
    }

    .empty-icon {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
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
        .download-hero h1 {
            font-size: 1.8rem;
        }

        .filter-buttons {
            justify-content: center;
        }

        .download-actions {
            justify-content: flex-start;
        }
    }
</style>


<!-- Hero Section -->
<div class="download-hero">
    <div class="container">
        <div class="text-center">
            <h1>
                <i class="fas fa-download me-3"></i>
                Downloads
            </h1>
            <p>Akses file dan dokumen yang Anda butuhkan dengan mudah</p>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <!-- Search Box -->
        <div class="search-box">
            <form method="GET" action="<?= base_url('downloads/search') ?>">
                <div class="row">
                    <div class="col-md-9 mb-2 mb-md-0">
                        <input type="text" name="q" class="form-control" placeholder="Cari downloads..."
                            value="<?= isset($keyword) ? htmlspecialchars($keyword) : '' ?>">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-download w-100">
                            <i class="fas fa-search me-2"></i>Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Category Filter -->
        <div class="filter-buttons">
            <a href="<?= base_url('downloads') ?>" class="filter-btn <?= !isset($current_category) && !isset($keyword) ? 'active' : '' ?>">
                <i class="fas fa-list me-2"></i>Semua
            </a>
            <?php if (isset($categories) && !empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <a href="<?= base_url('downloads/category/' . $cat->id) ?>"
                        class="filter-btn <?= isset($current_category) && $current_category == $cat->id ? 'active' : '' ?>">
                        <i class="fas fa-folder me-2"></i><?= htmlspecialchars($cat->name) ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Downloads List -->
        <div class="downloads-container">
            <?php if (isset($downloads) && !empty($downloads)): ?>
                <?php foreach ($downloads as $download): ?>
                    <div class="download-card">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-file-pdf download-icon"></i>
                                    <div class="flex-grow-1">
                                        <div class="download-title">
                                            <?= htmlspecialchars($download->name) ?>
                                        </div>
                                        <div class="download-meta">
                                            <?php if (isset($download->category_name)): ?>
                                                <span class="badge badge-category">
                                                    <i class="fas fa-folder me-1"></i><?= htmlspecialchars($download->category_name) ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if (isset($download->type_name)): ?>
                                                <span class="badge badge-type">
                                                    <i class="fas fa-tag me-1"></i><?= htmlspecialchars($download->type_name) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="download-date">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?= date('d M Y H:i', strtotime($download->created_at)) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="download-actions">
                                    <a href="<?= base_url('downloads/download/' . $download->id) ?>" class="btn btn-download btn-sm">
                                        <i class="fas fa-download me-1"></i>Download
                                    </a>
                                    <button type="button" class="btn btn-view btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="viewFile(<?= $download->id ?>, '<?= htmlspecialchars($download->name) ?>')">
                                        <i class="fas fa-eye me-1"></i>Lihat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Pagination -->
                <?php if (isset($pagination) && !empty($pagination)): ?>
                    <div class="d-flex justify-content-center mt-5">
                        <?= $pagination ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4 class="text-muted mb-2">Tidak ada file download</h4>
                    <p class="text-muted mb-4">Maaf, tidak ada file yang sesuai dengan filter Anda. Silakan coba filter lain atau kembali lagi nanti.</p>
                    <a href="<?= base_url('downloads') ?>" class="btn btn-download">
                        <i class="fas fa-refresh me-2"></i>Lihat Semua Download
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- View File Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">
                    <i class="fas fa-file-pdf me-2"></i>
                    <span id="fileName">Lihat File</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body-content" id="fileContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Memuat file...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="downloadLink" class="btn btn-download">
                    <i class="fas fa-download me-2"></i>Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function viewFile(fileId, fileName) {
        // Update modal title
        document.getElementById('fileName').textContent = fileName;
        document.getElementById('downloadLink').href = '<?= base_url('downloads/download/') ?>' + fileId;

        // Load file content via AJAX
        fetch('<?= base_url('downloads/view_ajax/') ?>' + fileId)
            .then(response => response.json())
            .then(data => {
                const fileContent = document.getElementById('fileContent');

                if (data.success) {
                    const ext = data.file_extension.toLowerCase();

                    if (ext === 'pdf') {
                        fileContent.innerHTML = `<embed src="${data.file_url}" type="application/pdf" />`;
                    } else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                        fileContent.innerHTML = `<img src="${data.file_url}" alt="${fileName}" />`;
                    } else if (ext === 'txt') {
                        fileContent.innerHTML = `<iframe src="${data.file_url}" style="width: 100%; height: 500px; border: none;"></iframe>`;
                    } else {
                        fileContent.innerHTML = `
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Format tidak didukung</strong>
                                <p class="mb-0">File dengan format .${ext} tidak dapat ditampilkan di browser. Silakan download file untuk membukanya.</p>
                            </div>
                        `;
                    }
                } else {
                    fileContent.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Error</strong>
                            <p class="mb-0">${data.message}</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                document.getElementById('fileContent').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error</strong>
                        <p class="mb-0">Gagal memuat file: ${error.message}</p>
                    </div>
                `;
            });
    }
</script>