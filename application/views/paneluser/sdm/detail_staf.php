<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">
                    <i class="fas fa-user-tie me-3"></i>
                    <?= isset($title) ? $title : 'Detail Staf' ?>
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                    <?php if (isset($staf) && !empty($staf->nama_lengkap)): ?>
                        Profil lengkap <?= htmlspecialchars($staf->nama_lengkap) ?> - <?= htmlspecialchars($staf->jabatan ?? 'Staf') ?>
                    <?php else: ?>
                        Informasi lengkap profil staf termasuk riwayat pendidikan dan pengalaman kerja.
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-lg-4 text-end">
                <div class="stats-info" data-aos="fade-left" data-aos-delay="200">
                    <?php if (isset($staf) && !empty($staf->divisi)): ?>
                        <h5 class="text-success"><?= htmlspecialchars($staf->divisi) ?></h5>
                        <p class="mb-0">Divisi</p>
                    <?php else: ?>
                        <h5 class="text-success">-</h5>
                        <p class="mb-0">Divisi</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="card card-success card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <?php if (!empty($staf->foto) && file_exists('./uploads/foto/' . $staf->foto)): ?>
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?= base_url('uploads/foto/' . $staf->foto) ?>"
                                    alt="Foto <?= htmlspecialchars($staf->nama_lengkap ?? 'Staf') ?>"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            <?php else: ?>
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?= base_url('assets/dist/img/default-150x150.png') ?>"
                                    alt="Foto Default"
                                    style="width: 150px; height: 150px;">
                            <?php endif; ?>
                        </div>

                        <h3 class="profile-username text-center">
                            <?= htmlspecialchars($staf->nama_lengkap ?? 'Nama tidak tersedia') ?>
                        </h3>

                        <p class="text-muted text-center">
                            <?= htmlspecialchars($staf->jabatan ?? 'Jabatan tidak tersedia') ?>
                        </p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIP</b>
                                <span class="float-right"><?= htmlspecialchars($staf->nip ?? '-') ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Divisi</b>
                                <span class="float-right"><?= htmlspecialchars($staf->divisi ?? '-') ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Status</b>
                                <span class="float-right">
                                    <?php if (isset($staf->status_aktif) && $staf->status_aktif == 'Aktif'): ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                    <?php endif; ?>
                                </span>
                            </li>
                        </ul>

                        <a href="<?= base_url('sdm') ?>" class="btn btn-success btn-block">
                            <i class="fas fa-arrow-left"></i> <b>Kembali ke Daftar SDM</b>
                        </a>
                    </div>
                </div>

                <!-- Contact Info -->
                <?php if (!empty($staf->email) || !empty($staf->telepon) || !empty($staf->alamat)): ?>
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Kontak</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($staf->email)): ?>
                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                <p class="text-muted">
                                    <a href="mailto:<?= htmlspecialchars($staf->email) ?>">
                                        <?= htmlspecialchars($staf->email) ?>
                                    </a>
                                </p>
                                <hr>
                            <?php endif; ?>

                            <?php if (!empty($staf->telepon)): ?>
                                <strong><i class="fas fa-phone mr-1"></i> Telepon</strong>
                                <p class="text-muted">
                                    <a href="tel:<?= htmlspecialchars($staf->telepon) ?>">
                                        <?= htmlspecialchars($staf->telepon) ?>
                                    </a>
                                </p>
                                <hr>
                            <?php endif; ?>

                            <?php if (!empty($staf->alamat)): ?>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                                <p class="text-muted"><?= nl2br(htmlspecialchars($staf->alamat)) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#profile" data-toggle="tab">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#education" data-toggle="tab">
                                    <i class="fas fa-graduation-cap"></i> Pendidikan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#experience" data-toggle="tab">
                                    <i class="fas fa-briefcase"></i> Pengalaman
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <!-- Profile Tab -->
                            <div class="active tab-pane" id="profile">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Informasi Pribadi</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td style="width: 30%;"><strong>Nama Lengkap</strong></td>
                                                    <td><?= htmlspecialchars($staf->nama_lengkap ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>NIP</strong></td>
                                                    <td><?= htmlspecialchars($staf->nip ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tempat, Tanggal Lahir</strong></td>
                                                    <td>
                                                        <?php
                                                        $ttl = '';
                                                        if (!empty($staf->tempat_lahir)) {
                                                            $ttl .= htmlspecialchars($staf->tempat_lahir);
                                                        }
                                                        if (!empty($staf->tanggal_lahir) && $staf->tanggal_lahir != '0000-00-00') {
                                                            if ($ttl) $ttl .= ', ';
                                                            $ttl .= date('d F Y', strtotime($staf->tanggal_lahir));
                                                        }
                                                        echo $ttl ?: '-';
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Jenis Kelamin</strong></td>
                                                    <td><?= htmlspecialchars($staf->jenis_kelamin ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Agama</strong></td>
                                                    <td><?= htmlspecialchars($staf->agama ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Perkawinan</strong></td>
                                                    <td><?= htmlspecialchars($staf->status_perkawinan ?? '-') ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <h4>Informasi Kepegawaian</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td style="width: 30%;"><strong>Divisi</strong></td>
                                                    <td><?= htmlspecialchars($staf->divisi ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Jabatan</strong></td>
                                                    <td><?= htmlspecialchars($staf->jabatan ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Kepegawaian</strong></td>
                                                    <td><?= htmlspecialchars($staf->status_kepegawaian ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>TMT</strong></td>
                                                    <td>
                                                        <?= (!empty($staf->tmt) && $staf->tmt != '0000-00-00') ?
                                                            date('d F Y', strtotime($staf->tmt)) : '-' ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Golongan</strong></td>
                                                    <td><?= htmlspecialchars($staf->golongan ?? '-') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Aktif</strong></td>
                                                    <td>
                                                        <?php if (isset($staf->status_aktif) && $staf->status_aktif == 'Aktif'): ?>
                                                            <span class="badge badge-success">Aktif</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Education Tab -->
                            <div class="tab-pane" id="education">
                                <h4>Riwayat Pendidikan</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width: 30%;"><strong>Pendidikan Terakhir</strong></td>
                                            <td><?= htmlspecialchars($staf->pendidikan_terakhir ?? '-') ?></td>
                                        </tr>
                                        <?php if (!empty($staf->universitas_asal)): ?>
                                            <tr>
                                                <td><strong>Universitas/Institusi</strong></td>
                                                <td><?= htmlspecialchars($staf->universitas_asal) ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($staf->jurusan_asal)): ?>
                                            <tr>
                                                <td><strong>Jurusan/Program Studi</strong></td>
                                                <td><?= htmlspecialchars($staf->jurusan_asal) ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($staf->tahun_lulus) && $staf->tahun_lulus != '0000'): ?>
                                            <tr>
                                                <td><strong>Tahun Lulus</strong></td>
                                                <td><?= htmlspecialchars($staf->tahun_lulus) ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>

                                <?php if (!empty($staf->keahlian)): ?>
                                    <hr>
                                    <h5>Keahlian</h5>
                                    <p><?= nl2br(htmlspecialchars($staf->keahlian)) ?></p>
                                <?php endif; ?>

                                <?php if (!empty($staf->sertifikasi)): ?>
                                    <hr>
                                    <h5>Sertifikasi</h5>
                                    <p><?= nl2br(htmlspecialchars($staf->sertifikasi)) ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Experience Tab -->
                            <div class="tab-pane" id="experience">
                                <h4>Pengalaman Kerja</h4>

                                <?php if (!empty($staf->pengalaman_kerja)): ?>
                                    <p><?= nl2br(htmlspecialchars($staf->pengalaman_kerja)) ?></p>
                                    <hr>
                                <?php endif; ?>

                                <?php if (!empty($staf->tugas_pokok)): ?>
                                    <h5>Tugas Pokok</h5>
                                    <p><?= nl2br(htmlspecialchars($staf->tugas_pokok)) ?></p>
                                    <hr>
                                <?php endif; ?>

                                <?php if (!empty($staf->prestasi)): ?>
                                    <h5>Prestasi</h5>
                                    <p><?= nl2br(htmlspecialchars($staf->prestasi)) ?></p>
                                    <hr>
                                <?php endif; ?>

                                <?php if (!empty($staf->pelatihan)): ?>
                                    <h5>Pelatihan yang Diikuti</h5>
                                    <p><?= nl2br(htmlspecialchars($staf->pelatihan)) ?></p>
                                <?php endif; ?>

                                <?php if (
                                    empty($staf->pengalaman_kerja) && empty($staf->tugas_pokok) &&
                                    empty($staf->prestasi) && empty($staf->pelatihan)
                                ): ?>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> Informasi pengalaman kerja belum tersedia.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<style>
    .profile-user-img {
        border: 3px solid #adb5bd;
        margin: 0 auto;
        padding: 3px;
    }

    .table-responsive {
        border-radius: 5px;
    }

    .nav-pills .nav-link {
        border-radius: 20px;
        margin-right: 5px;
    }

    .nav-pills .nav-link.active {
        background-color: #28a745;
    }

    .card {
        border-radius: 10px;
    }

    .badge {
        font-size: 0.875em;
    }

    .alert {
        border-radius: 10px;
    }

    .hero-section {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
    }

    .hero-section .stats-info h5 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .hero-section .stats-info p {
        opacity: 0.9;
        font-size: 0.9rem;
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
</style>

<script>
    // Tab functionality for detail staf page
    function initializeStafTabs() {
        // Check if jQuery is available
        if (typeof jQuery !== 'undefined') {
            jQuery(document).ready(function($) {
                // Tab click handler
                $('.nav-pills a[data-toggle="tab"]').on('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all tabs and tab panes
                    $('.nav-pills .nav-link').removeClass('active');
                    $('.tab-pane').removeClass('active');

                    // Add active class to clicked tab
                    $(this).addClass('active');

                    // Show corresponding tab pane
                    const target = $(this).attr('href');
                    $(target).addClass('active');
                });

                // Initialize Bootstrap tabs if available
                if ($.fn.tab) {
                    $('.nav-pills a').tab();
                }
            });
        } else {
            // Vanilla JavaScript fallback
            vanillaStafTabInit();
        }
    }

    // Vanilla JavaScript tab functionality
    function vanillaStafTabInit() {
        const tabLinks = document.querySelectorAll('.nav-pills a[data-toggle="tab"]');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                tabLinks.forEach(function(tab) {
                    tab.classList.remove('active');
                });

                // Remove active class from all tab panes
                tabPanes.forEach(function(pane) {
                    pane.classList.remove('active');
                });

                // Add active class to clicked tab
                this.classList.add('active');

                // Show corresponding tab pane
                const targetId = this.getAttribute('href').substring(1);
                const targetPane = document.getElementById(targetId);
                if (targetPane) {
                    targetPane.classList.add('active');
                }
            });
        });
    }

    // Initialize tabs when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeStafTabs);
    } else {
        initializeStafTabs();
    }

    // Backup initialization with timeout
    setTimeout(function() {
        if (typeof jQuery === 'undefined') {
            vanillaStafTabInit();
        }
    }, 500);
</script>