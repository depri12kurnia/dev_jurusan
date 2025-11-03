<!-- Search Hero -->
<section class="search-hero py-5" style="background: linear-gradient(135deg, #667eea, #764ba2);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white">
                <h1 class="font-weight-bold mb-3">Temukan Program Studi Impianmu</h1>
                <p class="lead mb-4">Jelajahi berbagai program studi yang tersedia sesuai dengan minat dan bakatmu</p>

                <!-- Search Form -->
                <form method="GET" action="<?= site_url('program-studi/cari') ?>" class="search-form">
                    <div class="input-group input-group-lg">
                        <input type="text"
                            name="q"
                            class="form-control"
                            placeholder="Cari program studi..."
                            value="<?= $search_query ?? '' ?>"
                            autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Filters & Results -->
<section class="search-results py-5">
    <div class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="fas fa-filter mr-2"></i>Filter Pencarian
                        </h6>
                    </div>
                    <div class="card-body">
                        <form id="filterForm" method="GET" action="<?= site_url('program-studi/cari') ?>">
                            <input type="hidden" name="q" value="<?= $search_query ?? '' ?>">

                            <!-- Jenjang Filter -->
                            <div class="filter-group mb-4">
                                <h6 class="filter-title">Jenjang Pendidikan</h6>
                                <?php foreach ($jenjang_list as $jenjang): ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="jenjang_<?= $jenjang->jenjang ?>"
                                            name="jenjang[]"
                                            value="<?= $jenjang->jenjang ?>"
                                            <?= in_array($jenjang->jenjang, $selected_filters['jenjang'] ?? []) ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="jenjang_<?= $jenjang->jenjang ?>">
                                            <?= $jenjang->jenjang ?>
                                            <span class="badge badge-secondary"><?= $jenjang->count ?></span>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Akreditasi Filter -->
                            <div class="filter-group mb-4">
                                <h6 class="filter-title">Akreditasi</h6>
                                <?php foreach ($akreditasi_list as $akreditasi): ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="akreditasi_<?= $akreditasi->akreditasi ?>"
                                            name="akreditasi[]"
                                            value="<?= $akreditasi->akreditasi ?>"
                                            <?= in_array($akreditasi->akreditasi, $selected_filters['akreditasi'] ?? []) ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="akreditasi_<?= $akreditasi->akreditasi ?>">
                                            <?= $akreditasi->akreditasi ?>
                                            <span class="badge badge-secondary"><?= $akreditasi->count ?></span>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Status Filter -->
                            <div class="filter-group mb-4">
                                <h6 class="filter-title">Status Program</h6>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                        class="custom-control-input"
                                        id="unggulan"
                                        name="unggulan"
                                        value="1"
                                        <?= isset($selected_filters['unggulan']) ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="unggulan">
                                        <i class="fas fa-star text-warning mr-1"></i> Program Unggulan
                                    </label>
                                </div>
                            </div>

                            <!-- Sort Options -->
                            <div class="filter-group mb-4">
                                <h6 class="filter-title">Urutkan Berdasarkan</h6>
                                <select name="sort" class="form-control">
                                    <option value="nama_asc" <?= ($selected_filters['sort'] ?? '') == 'nama_asc' ? 'selected' : '' ?>>
                                        Nama A-Z
                                    </option>
                                    <option value="nama_desc" <?= ($selected_filters['sort'] ?? '') == 'nama_desc' ? 'selected' : '' ?>>
                                        Nama Z-A
                                    </option>
                                    <option value="jenjang_asc" <?= ($selected_filters['sort'] ?? '') == 'jenjang_asc' ? 'selected' : '' ?>>
                                        Jenjang A-Z
                                    </option>
                                    <option value="akreditasi_desc" <?= ($selected_filters['sort'] ?? '') == 'akreditasi_desc' ? 'selected' : '' ?>>
                                        Akreditasi Tertinggi
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search mr-2"></i>Terapkan Filter
                            </button>
                        </form>

                        <!-- Clear Filters -->
                        <?php if (!empty($selected_filters)): ?>
                            <a href="<?= site_url('program-studi/cari' . (isset($search_query) ? '?q=' . urlencode($search_query) : '')) ?>"
                                class="btn btn-outline-secondary btn-block mt-2">
                                <i class="fas fa-times mr-2"></i>Hapus Filter
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Results Content -->
            <div class="col-lg-9">
                <!-- Search Info -->
                <div class="search-info d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-1">
                            <?php if (isset($search_query) && $search_query): ?>
                                Hasil pencarian untuk "<strong><?= $search_query ?></strong>"
                            <?php else: ?>
                                Semua Program Studi
                            <?php endif; ?>
                        </h5>
                        <p class="text-muted mb-0">
                            Ditemukan <?= number_format($total_results) ?> program studi
                            <?= isset($pagination) ? ' (halaman ' . $current_page . ' dari ' . $total_pages . ')' : '' ?>
                        </p>
                    </div>

                    <!-- View Toggle -->
                    <div class="view-toggle btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary active" data-view="grid">
                            <i class="fas fa-th"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Applied Filters -->
                <?php if (!empty($applied_filters)): ?>
                    <div class="applied-filters mb-4">
                        <h6 class="mb-2">Filter Aktif:</h6>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($applied_filters as $filter): ?>
                                <span class="badge badge-primary mr-2 mb-2">
                                    <?= $filter ?>
                                    <a href="<?= $filter_remove_urls[$filter] ?? '#' ?>" class="text-white ml-1">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- No Results -->
                <?php if (empty($programs)): ?>
                    <div class="no-results text-center py-5">
                        <i class="fas fa-search fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Tidak ada program studi ditemukan</h4>
                        <p class="text-muted mb-4">
                            Coba ubah kata kunci pencarian atau hapus beberapa filter untuk mendapatkan hasil yang lebih luas.
                        </p>
                        <a href="<?= site_url('program-studi') ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Semua Program
                        </a>
                    </div>
                <?php else: ?>

                    <!-- Results Grid -->
                    <div id="resultsContainer" class="results-grid">
                        <div class="row" id="programsGrid">
                            <?php foreach ($programs as $program): ?>
                                <div class="col-lg-4 col-md-6 mb-4 program-item">
                                    <div class="card program-card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="program-icon mr-3"
                                                    style="background: linear-gradient(135deg, <?= $program->warna ?>, <?= $program->warna ?>90); 
                                                    width: 50px; height: 50px; border-radius: 12px; 
                                                    display: flex; align-items: center; justify-content: center;">
                                                    <i class="<?= $program->icon ?> text-white"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="badge badge-primary mr-2"><?= $program->jenjang ?></span>
                                                        <?php if ($program->is_featured): ?>
                                                            <span class="badge badge-warning">
                                                                <i class="fas fa-star mr-1"></i>Unggulan
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <h6 class="card-title font-weight-bold mb-2">
                                                        <a href="<?= site_url('program-studi/' . $program->slug) ?>"
                                                            class="text-dark text-decoration-none">
                                                            <?= $program->nama_prodi ?>
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>

                                            <p class="card-text text-muted mb-3">
                                                <?= character_limiter($program->deskripsi, 100) ?>
                                            </p>

                                            <div class="program-meta mb-3">
                                                <?php if ($program->akreditasi): ?>
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-certificate text-success mr-1"></i>
                                                        Akreditasi <?= $program->akreditasi ?>
                                                    </small>
                                                <?php endif; ?>

                                                <?php if ($program->durasi_studi): ?>
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-clock text-info mr-1"></i>
                                                        <?= $program->durasi_studi ?> Semester
                                                    </small>
                                                <?php endif; ?>

                                                <small class="text-muted d-block">
                                                    <i class="fas fa-graduation-cap text-primary mr-1"></i>
                                                    Gelar: <?= $program->gelar ?>
                                                </small>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <?php if ($program->biaya_pendidikan): ?>
                                                    <small class="text-success font-weight-bold">
                                                        Rp <?= number_format($program->biaya_pendidikan / 1000000, 1) ?>Jt/sem
                                                    </small>
                                                <?php else: ?>
                                                    <div></div>
                                                <?php endif; ?>

                                                <a href="<?= site_url('program-studi/' . $program->slug) ?>"
                                                    class="btn btn-outline-primary btn-sm">
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <?php if (isset($pagination) && $pagination): ?>
                        <div class="pagination-wrapper mt-5">
                            <?= $pagination ?>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Quick Search Suggestions -->
<section class="search-suggestions py-5 bg-light">
    <div class="container">
        <h4 class="font-weight-bold mb-4 text-center">Pencarian Populer</h4>
        <div class="text-center">
            <a href="<?= site_url('program-studi/cari?q=teknik') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Teknik</a>
            <a href="<?= site_url('program-studi/cari?q=ekonomi') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Ekonomi</a>
            <a href="<?= site_url('program-studi/cari?q=komputer') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Komputer</a>
            <a href="<?= site_url('program-studi/cari?q=manajemen') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Manajemen</a>
            <a href="<?= site_url('program-studi/cari?q=kedokteran') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Kedokteran</a>
            <a href="<?= site_url('program-studi/cari?q=hukum') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Hukum</a>
            <a href="<?= site_url('program-studi/cari?q=psikologi') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Psikologi</a>
            <a href="<?= site_url('program-studi/cari?q=pendidikan') ?>" class="badge badge-pill badge-primary mr-2 mb-2 p-2">Pendidikan</a>
        </div>
    </div>
</section>

<style>
    .search-hero {
        position: relative;
        overflow: hidden;
    }

    .search-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="search-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" fill-opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23search-pattern)"/></svg>');
    }

    .search-form {
        position: relative;
        z-index: 2;
    }

    .search-form .form-control {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .filter-title {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.75rem;
    }

    .filter-group {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
    }

    .filter-group:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .custom-control-label .badge {
        font-size: 0.7em;
        margin-left: 0.25rem;
    }

    .program-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .program-icon {
        transition: all 0.3s ease;
    }

    .program-card:hover .program-icon {
        transform: scale(1.1);
    }

    .view-toggle .btn {
        border-radius: 0;
    }

    .view-toggle .btn:first-child {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .view-toggle .btn:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .applied-filters .badge {
        font-size: 0.8em;
        padding: 0.5em 0.75em;
    }

    .results-list .program-item {
        margin-bottom: 1rem;
    }

    .results-list .program-card {
        border-radius: 8px;
    }

    .results-list .card-body {
        padding: 1.5rem;
    }

    .results-list .program-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        margin-right: 1rem;
    }

    .badge-pill {
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .badge-pill:hover {
        background-color: #0056b3 !important;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .no-results {
        background: white;
        border-radius: 12px;
        border: 2px dashed #dee2e6;
    }

    @media (max-width: 768px) {
        .search-info {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .view-toggle {
            margin-top: 1rem;
        }

        .applied-filters {
            margin-bottom: 1rem;
        }
    }

    /* List View Styles */
    .results-list .row {
        display: block;
    }

    .results-list .program-item {
        width: 100%;
        margin-bottom: 1rem;
    }

    .results-list .program-card {
        border-radius: 8px;
    }

    .results-list .card-body {
        display: flex;
        align-items: center;
        padding: 1.25rem;
    }

    .results-list .program-icon {
        margin-right: 1.5rem;
        flex-shrink: 0;
    }

    .results-list .program-content {
        flex-grow: 1;
    }

    .results-list .program-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 0.5rem;
    }

    .results-list .program-actions {
        margin-left: auto;
        text-align: right;
    }
</style>

<script>
    $(document).ready(function() {
        // View toggle functionality
        $('.view-toggle button').click(function() {
            const view = $(this).data('view');

            $('.view-toggle button').removeClass('active');
            $(this).addClass('active');

            const container = $('#resultsContainer');

            if (view === 'list') {
                container.removeClass('results-grid').addClass('results-list');
                // Restructure cards for list view
                $('.program-item .card-body').each(function() {
                    const $body = $(this);
                    const $icon = $body.find('.program-icon');
                    const $title = $body.find('.card-title');
                    const $badges = $body.find('.badge').parent();
                    const $description = $body.find('.card-text');
                    const $meta = $body.find('.program-meta');
                    const $actions = $body.find('.d-flex:last-child');

                    // Restructure for horizontal layout
                    $body.html(`
                    <div class="d-flex align-items-center w-100">
                        ${$icon.get(0).outerHTML}
                        <div class="program-content flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                ${$title.get(0).outerHTML}
                                <div class="program-badges">${$badges.html()}</div>
                            </div>
                            ${$description.get(0).outerHTML}
                            <div class="program-meta d-flex gap-3">
                                ${$meta.find('small').map(function() { return this.outerHTML; }).get().join('')}
                            </div>
                        </div>
                        <div class="program-actions ml-3">
                            ${$actions.html()}
                        </div>
                    </div>
                `);
                });
            } else {
                container.removeClass('results-list').addClass('results-grid');
                // Reload page to restore original structure
                location.reload();
            }
        });

        // Auto-submit form on filter change
        $('#filterForm input[type="checkbox"], #filterForm select').change(function() {
            $('#filterForm').submit();
        });

        // Search suggestions click tracking
        $('.badge-pill').click(function() {
            // Add analytics tracking here if needed
        });
    });
</script>