<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">
                    <i class="fas fa-users me-3"></i>
                    <?= isset($title) ? $title : 'Sumber Daya Manusia' ?>
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                    Informasi lengkap tentang dosen dan staf yang mendukung kegiatan akademik dan operasional Jurusan <?= htmlspecialchars($website->name) ?>.
                </p>
            </div>
            <div class="col-lg-4 text-end">
                <div class="row">
                    <div class="col-6">
                        <div class="stats-info" data-aos="fade-left" data-aos-delay="200">
                            <h5 class="text-primary"><?= isset($statistics['total_dosen']) ? $statistics['total_dosen'] : 0 ?></h5>
                            <p class="mb-0">Total Dosen</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stats-info" data-aos="fade-left" data-aos-delay="300">
                            <h5 class="text-success"><?= isset($statistics['total_staf']) ? $statistics['total_staf'] : 0 ?></h5>
                            <p class="mb-0">Total Staf</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">

        <!-- Tab Navigation -->
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="dosen-tab" data-toggle="tab" href="#dosen" role="tab" aria-controls="dosen" aria-selected="true">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i> Data Dosen
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="staf-tab" data-toggle="tab" href="#staf" role="tab" aria-controls="staf" aria-selected="false">
                                    <i class="fas fa-users mr-2"></i> Data Staf
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">

                            <!-- Dosen Tab -->
                            <div class="tab-pane fade show active" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
                                <!-- Filter Controls -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="filter_prodi">Filter Program Studi:</label>
                                            <select class="form-control" id="filter_prodi" onchange="filterDosen()">
                                                <option value="">Semua Program Studi</option>
                                                <?php if (isset($program_studi_list)): ?>
                                                    <?php foreach ($program_studi_list as $prodi): ?>
                                                        <option value="<?= htmlspecialchars($prodi->program_studi) ?>">
                                                            <?= htmlspecialchars($prodi->program_studi) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="search_dosen">Cari Dosen:</label>
                                            <input type="text" class="form-control" id="search_dosen" placeholder="Ketik nama dosen..." onkeyup="searchDosen()">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="form-control-plaintext">
                                                <button type="button" class="btn btn-secondary" onclick="resetDosenFilter()">
                                                    <i class="fas fa-sync-alt"></i> Reset Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dosen Cards Grid -->
                                <div class="row" id="dosen-grid">
                                    <?php if (isset($dosen) && !empty($dosen)): ?>
                                        <?php foreach ($dosen as $d): ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3 dosen-card"
                                                data-prodi="<?= htmlspecialchars($d->program_studi ?? '') ?>"
                                                data-nama="<?= strtolower(htmlspecialchars($d->nama_lengkap ?? '')) ?>">
                                                <div class="card card-outline card-primary h-100 sdm-card">
                                                    <div class="card-body text-center p-3">
                                                        <div class="mb-3">
                                                            <?php if (!empty($d->foto) && file_exists('./uploads/foto/' . $d->foto)): ?>
                                                                <img class="profile-img rounded-circle"
                                                                    src="<?= base_url('uploads/foto/' . $d->foto) ?>"
                                                                    alt="Foto <?= htmlspecialchars($d->nama_lengkap ?? 'Dosen') ?>">
                                                            <?php else: ?>
                                                                <img class="profile-img rounded-circle"
                                                                    src="<?= base_url('assets/dist/img/default-150x150.png') ?>"
                                                                    alt="Foto Default">
                                                            <?php endif; ?>
                                                        </div>

                                                        <h5 class="card-title font-weight-bold mb-1">
                                                            <?= htmlspecialchars($d->nama_lengkap ?? 'Nama tidak tersedia') ?>
                                                        </h5>

                                                        <p class="text-muted small mb-2">
                                                            <?= htmlspecialchars($d->jabatan_akademik ?? 'Jabatan tidak tersedia') ?>
                                                        </p>

                                                        <div class="info-list mb-3">
                                                            <div class="info-item">
                                                                <small class="text-muted">NIDN:</small>
                                                                <span class="font-weight-bold"><?= htmlspecialchars($d->nidn ?? '-') ?></span>
                                                            </div>
                                                            <div class="info-item">
                                                                <small class="text-muted">Prodi:</small>
                                                                <span class="font-weight-bold"><?= htmlspecialchars($d->program_studi ?? '-') ?></span>
                                                            </div>
                                                            <div class="info-item">
                                                                <small class="text-muted">Pendidikan:</small>
                                                                <span class="font-weight-bold"><?= htmlspecialchars($d->pendidikan_terakhir ?? '-') ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <?php if (!empty($d->email)): ?>
                                                                <a href="mailto:<?= htmlspecialchars($d->email) ?>" class="btn btn-outline-primary btn-sm">
                                                                    <i class="fas fa-envelope"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <span></span>
                                                            <?php endif; ?>
                                                            <a href="<?= base_url('sdm/detail_dosen/' . $d->id) ?>" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <div class="alert alert-info text-center">
                                                <i class="fas fa-info-circle"></i> Belum ada data dosen yang tersedia.
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- No Results Message -->
                                <div class="row" id="no-dosen-results" style="display: none;">
                                    <div class="col-12">
                                        <div class="alert alert-warning text-center">
                                            <i class="fas fa-search"></i> Tidak ada dosen yang sesuai dengan filter pencarian.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Staf Tab -->
                            <div class="tab-pane fade" id="staf" role="tabpanel" aria-labelledby="staf-tab">
                                <!-- Filter Controls -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="filter_divisi">Filter Divisi:</label>
                                            <select class="form-control" id="filter_divisi" onchange="filterStaf()">
                                                <option value="">Semua Divisi</option>
                                                <?php if (isset($divisi_list)): ?>
                                                    <?php foreach ($divisi_list as $divisi): ?>
                                                        <option value="<?= htmlspecialchars($divisi->divisi) ?>">
                                                            <?= htmlspecialchars($divisi->divisi) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="search_staf">Cari Staf:</label>
                                            <input type="text" class="form-control" id="search_staf" placeholder="Ketik nama staf..." onkeyup="searchStaf()">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="form-control-plaintext">
                                                <button type="button" class="btn btn-secondary" onclick="resetStafFilter()">
                                                    <i class="fas fa-sync-alt"></i> Reset Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staf Cards Grid -->
                                <div class="row" id="staf-grid">
                                    <?php if (isset($staf) && !empty($staf)): ?>
                                        <?php foreach ($staf as $s): ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3 staf-card"
                                                data-divisi="<?= htmlspecialchars($s->divisi ?? '') ?>"
                                                data-nama="<?= strtolower(htmlspecialchars($s->nama_lengkap ?? '')) ?>">
                                                <div class="card card-outline card-success h-100 sdm-card">
                                                    <div class="card-body text-center p-3">
                                                        <div class="mb-3">
                                                            <?php if (!empty($s->foto) && file_exists('./uploads/foto/' . $s->foto)): ?>
                                                                <img class="profile-img rounded-circle"
                                                                    src="<?= base_url('uploads/foto/' . $s->foto) ?>"
                                                                    alt="Foto <?= htmlspecialchars($s->nama_lengkap ?? 'Staf') ?>">
                                                            <?php else: ?>
                                                                <img class="profile-img rounded-circle"
                                                                    src="<?= base_url('assets/dist/img/default-150x150.png') ?>"
                                                                    alt="Foto Default">
                                                            <?php endif; ?>
                                                        </div>

                                                        <h5 class="card-title font-weight-bold mb-1">
                                                            <?= htmlspecialchars($s->nama_lengkap ?? 'Nama tidak tersedia') ?>
                                                        </h5>

                                                        <p class="text-muted small mb-2">
                                                            <?= htmlspecialchars($s->jabatan ?? 'Jabatan tidak tersedia') ?>
                                                        </p>

                                                        <div class="info-list mb-3">
                                                            <div class="info-item">
                                                                <small class="text-muted">NIP:</small>
                                                                <span class="font-weight-bold"><?= htmlspecialchars($s->nip ?? '-') ?></span>
                                                            </div>
                                                            <div class="info-item">
                                                                <small class="text-muted">Divisi:</small>
                                                                <span class="font-weight-bold"><?= htmlspecialchars($s->divisi ?? '-') ?></span>
                                                            </div>
                                                            <div class="info-item">
                                                                <small class="text-muted">Pendidikan:</small>
                                                                <span class="font-weight-bold"><?= htmlspecialchars($s->pendidikan_terakhir ?? '-') ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <?php if (!empty($s->email)): ?>
                                                                <a href="mailto:<?= htmlspecialchars($s->email) ?>" class="btn btn-outline-success btn-sm">
                                                                    <i class="fas fa-envelope"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <span></span>
                                                            <?php endif; ?>
                                                            <a href="<?= base_url('sdm/detail_staf/' . $s->id) ?>" class="btn btn-success btn-sm">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <div class="alert alert-info text-center">
                                                <i class="fas fa-info-circle"></i> Belum ada data staf yang tersedia.
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- No Results Message -->
                                <div class="row" id="no-staf-results" style="display: none;">
                                    <div class="col-12">
                                        <div class="alert alert-warning text-center">
                                            <i class="fas fa-search"></i> Tidak ada staf yang sesuai dengan filter pencarian.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container -->
</section>
<!-- /.content -->


<script>
    // Wait for jQuery and DOM to be ready
    function initializeSDM() {
        if (typeof jQuery !== 'undefined') {
            jQuery(document).ready(function($) {
                // Initialize tooltips
                if ($.fn.tooltip) {
                    $('[data-toggle="tooltip"]').tooltip();
                }

                // Auto-resize images on load error
                $('img').on('error', function() {
                    $(this).attr('src', '<?= base_url("assets/dist/img/default-150x150.png") ?>');
                });

                // Ensure tabs work properly
                if (typeof $.fn.tab !== 'undefined') {
                    // Bootstrap tabs available
                    $('#custom-tabs-one-tab a').tab();
                }

                // Manual tab initialization if needed
                $('.nav-tabs a').click(function(e) {
                    e.preventDefault();
                    if ($.fn.tab) {
                        $(this).tab('show');
                    }
                });
            });
        } else {
            // Fallback if jQuery is not loaded
            setTimeout(initializeSDM, 100);
        }
    }

    // Initialize when page loads
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeSDM);
    } else {
        initializeSDM();
    }

    // Filter Dosen Functions
    function filterDosen() {
        if (typeof jQuery === 'undefined') return;

        const selectedProdi = jQuery('#filter_prodi').val().toLowerCase();
        const searchTerm = jQuery('#search_dosen').val().toLowerCase();

        let visibleCount = 0;

        jQuery('.dosen-card').each(function() {
            const cardProdi = jQuery(this).data('prodi').toString().toLowerCase();
            const cardNama = jQuery(this).data('nama').toString().toLowerCase();

            const prodiMatch = selectedProdi === '' || cardProdi.includes(selectedProdi);
            const namaMatch = searchTerm === '' || cardNama.includes(searchTerm);

            if (prodiMatch && namaMatch) {
                jQuery(this).show();
                visibleCount++;
            } else {
                jQuery(this).hide();
            }
        });

        if (visibleCount === 0) {
            jQuery('#no-dosen-results').show();
        } else {
            jQuery('#no-dosen-results').hide();
        }
    }

    function searchDosen() {
        filterDosen();
    }

    function resetDosenFilter() {
        if (typeof jQuery === 'undefined') return;

        jQuery('#filter_prodi').val('');
        jQuery('#search_dosen').val('');
        jQuery('.dosen-card').show();
        jQuery('#no-dosen-results').hide();
    }

    // Filter Staf Functions
    function filterStaf() {
        if (typeof jQuery === 'undefined') return;

        const selectedDivisi = jQuery('#filter_divisi').val().toLowerCase();
        const searchTerm = jQuery('#search_staf').val().toLowerCase();

        let visibleCount = 0;

        jQuery('.staf-card').each(function() {
            const cardDivisi = jQuery(this).data('divisi').toString().toLowerCase();
            const cardNama = jQuery(this).data('nama').toString().toLowerCase();

            const divisiMatch = selectedDivisi === '' || cardDivisi.includes(selectedDivisi);
            const namaMatch = searchTerm === '' || cardNama.includes(searchTerm);

            if (divisiMatch && namaMatch) {
                jQuery(this).show();
                visibleCount++;
            } else {
                jQuery(this).hide();
            }
        });

        if (visibleCount === 0) {
            jQuery('#no-staf-results').show();
        } else {
            jQuery('#no-staf-results').hide();
        }
    }

    function searchStaf() {
        filterStaf();
    }

    function resetStafFilter() {
        if (typeof jQuery === 'undefined') return;

        jQuery('#filter_divisi').val('');
        jQuery('#search_staf').val('');
        jQuery('.staf-card').show();
        jQuery('#no-staf-results').hide();
    }

    // Tab switching functionality
    function switchTab(tabId, paneId) {
        if (typeof jQuery === 'undefined') return;

        // Remove active from all tabs and panes
        jQuery('.nav-link').removeClass('active').attr('aria-selected', 'false');
        jQuery('.tab-pane').removeClass('show active');

        // Activate clicked tab and corresponding pane
        jQuery(tabId).addClass('active').attr('aria-selected', 'true');
        jQuery(paneId).addClass('show active');
    }

    // Initialize tab functionality when jQuery is available
    function initializeTabs() {
        if (typeof jQuery === 'undefined') {
            setTimeout(initializeTabs, 100);
            return;
        }

        jQuery(document).ready(function($) {
            // Dosen tab click
            $('#dosen-tab').on('click', function(e) {
                e.preventDefault();
                console.log('Dosen tab clicked');
                switchTab('#dosen-tab', '#dosen');
            });

            // Staf tab click
            $('#staf-tab').on('click', function(e) {
                e.preventDefault();
                console.log('Staf tab clicked');
                switchTab('#staf-tab', '#staf');
            });

            // General tab click handler
            $('.nav-tabs a').on('click', function(e) {
                e.preventDefault();
                const targetPane = $(this).attr('href');
                console.log('Tab clicked, target:', targetPane);

                $('.nav-link').removeClass('active').attr('aria-selected', 'false');
                $('.tab-pane').removeClass('show active');

                $(this).addClass('active').attr('aria-selected', 'true');
                $(targetPane).addClass('show active');
            });
        });
    }

    // Initialize tabs when page loads
    initializeTabs();

    // Vanilla JavaScript fallback for tabs
    function vanillaTabSwitch() {
        const dosenTab = document.getElementById('dosen-tab');
        const stafTab = document.getElementById('staf-tab');
        const dosenPane = document.getElementById('dosen');
        const stafPane = document.getElementById('staf');

        if (dosenTab && stafTab && dosenPane && stafPane) {
            dosenTab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active classes
                dosenTab.classList.add('active');
                stafTab.classList.remove('active');
                dosenPane.classList.add('show', 'active');
                stafPane.classList.remove('show', 'active');
            });

            stafTab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active classes
                stafTab.classList.add('active');
                dosenTab.classList.remove('active');
                stafPane.classList.add('show', 'active');
                dosenPane.classList.remove('show', 'active');
            });
        }
    }

    // Initialize vanilla JS tabs as backup
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', vanillaTabSwitch);
    } else {
        vanillaTabSwitch();
    }
</script>

<style>
    /* SDM Card Styling */
    .sdm-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }

    .sdm-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .card-outline.card-primary {
        border-left: 4px solid #007bff;
    }

    .card-outline.card-success {
        border-left: 4px solid #28a745;
    }

    .profile-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .info-list {
        text-align: left;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 4px 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .card-title {
        font-size: 1.1rem;
        line-height: 1.3;
        color: #2c3e50;
    }

    .nav-tabs .nav-link {
        border-radius: 10px 10px 0 0;
        font-weight: 600;
        padding: 12px 20px;
    }

    .nav-tabs .nav-link.active {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white !important;
        border-color: transparent;
    }

    .card-tabs {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .tab-content {
        position: relative;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    .tab-pane.show.active {
        display: block;
    }

    .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn {
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 10px 15px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 80px 0;
        margin-bottom: 30px;
        border-radius: 0 0 20px 20px;
    }

    .hero-section .stats-info {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 15px;
    }

    .hero-section .stats-info h5 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .hero-section .stats-info p {
        opacity: 0.9;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0;
        }

        .hero-section .stats-info {
            padding: 15px;
            margin-bottom: 10px;
        }

        .hero-section .stats-info h5 {
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1rem;
        }

        .profile-img {
            width: 70px;
            height: 70px;
        }

        .info-item {
            font-size: 0.85rem;
        }

        .nav-tabs .nav-link {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section .row .col-6 {
            margin-bottom: 10px;
        }

        .container {
            padding: 0 15px;
        }

        .sdm-card {
            margin-bottom: 15px;
        }
    }
</style>