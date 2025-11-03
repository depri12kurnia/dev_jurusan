<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/adminlte3/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte3/dist/css/adminlte.min.css') ?>">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .preview-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .news-meta {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .news-thumbnail {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .news-content {
            line-height: 1.8;
            font-size: 16px;
        }

        .news-content img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>

<body>
    <div class="preview-container">
        <!-- Status Badge -->
        <div class="status-badge">
            <?php if ($news->status == 'published'): ?>
                <span class="badge badge-success badge-lg">
                    <i class="fas fa-check-circle mr-1"></i>Terbit
                </span>
            <?php else: ?>
                <span class="badge badge-warning badge-lg">
                    <i class="fas fa-edit mr-1"></i>Draft
                </span>
            <?php endif; ?>
        </div>

        <!-- News Header -->
        <div class="news-header mb-4">
            <h1 class="display-4 text-primary mb-3"><?= $news->title ?></h1>

            <?php if (!empty($news->excerpt)): ?>
                <p class="lead text-muted"><?= $news->excerpt ?></p>
            <?php endif; ?>
        </div>

        <!-- News Meta Information -->
        <div class="news-meta">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-info">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Berita
                    </h6>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="30%"><strong>Kategori:</strong></td>
                            <td>
                                <span class="badge badge-info"><?= $news->category_name ?: 'Tidak ada kategori' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Penulis:</strong></td>
                            <td>
                                <i class="fas fa-user mr-1 text-primary"></i><?= $news->author ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Slug:</strong></td>
                            <td><code><?= $news->slug ?></code></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="text-success">
                        <i class="fas fa-calendar mr-2"></i>Waktu Publikasi
                    </h6>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="30%"><strong>Tanggal:</strong></td>
                            <td><?= date('d F Y', strtotime($news->published_at)) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Waktu:</strong></td>
                            <td><?= date('H:i', strtotime($news->published_at)) ?> WIB</td>
                        </tr>
                        <?php if (isset($news->views) && $news->views > 0): ?>
                            <tr>
                                <td><strong>Views:</strong></td>
                                <td>
                                    <i class="fas fa-eye mr-1 text-info"></i><?= number_format($news->views) ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- Thumbnail -->
        <?php if (!empty($news->thumbnail)): ?>
            <div class="text-center mb-4">
                <img src="<?= base_url('assets/uploads/news/' . $news->thumbnail) ?>"
                    alt="<?= $news->title ?>"
                    class="news-thumbnail">
                <p class="text-muted mt-2">
                    <small><i class="fas fa-image mr-1"></i>Gambar utama berita</small>
                </p>
            </div>
        <?php endif; ?>

        <!-- News Content -->
        <div class="news-content">
            <?= $news->content ?>
        </div>

        <!-- Footer Actions -->
        <div class="mt-5 pt-3 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        <i class="fas fa-clock mr-1"></i>
                        Dibuat: <?= date('d/m/Y H:i', strtotime($news->created_at)) ?>
                        <?php if ($news->updated_at != $news->created_at): ?>
                            | Diupdate: <?= date('d/m/Y H:i', strtotime($news->updated_at)) ?>
                        <?php endif; ?>
                    </small>
                </div>
                <div>
                    <button onclick="window.print()" class="btn btn-primary btn-sm">
                        <i class="fas fa-print mr-1"></i>Print
                    </button>
                    <button onclick="window.close()" class="btn btn-secondary btn-sm">
                        <i class="fas fa-times mr-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('assets/adminlte3/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <script>
        // Print styles
        const printStyles = `
            @media print {
                .status-badge, .btn { display: none !important; }
                .preview-container { 
                    box-shadow: none !important; 
                    margin: 0 !important;
                    max-width: none !important;
                }
                .news-meta { 
                    background: transparent !important; 
                    border: 1px solid #ddd !important;
                }
            }
        `;

        const style = document.createElement('style');
        style.textContent = printStyles;
        document.head.appendChild(style);
    </script>
</body>

</html>