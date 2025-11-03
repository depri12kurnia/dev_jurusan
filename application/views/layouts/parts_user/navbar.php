<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url() ?>">
            <img src="<?php echo base_url(); ?>public/settings/logo/logo.png" alt="Logo" onerror="this.style.display='none'">
            <!-- <span class="brand-text"><?php echo $title; ?></span> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/'); ?>">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#programs" id="programsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-graduation-cap me-1"></i>Program Studi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="programsDropdown">
                        <?php
                        // Fallback: load program studi jika belum dimuat dari controller
                        if (!isset($program_studi_all) || empty($program_studi_all)) {
                            $CI = &get_instance();
                            $CI->load->model('M_prodi');
                            $program_studi_all = $CI->m_prodi->get_all_active(10); // Limit 10 untuk navbar
                        }
                        ?>

                        <?php if (!empty($program_studi_all)): ?>
                            <?php foreach ($program_studi_all as $prodi): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('program-studi/' . $prodi->slug) ?>">
                                        <i class="<?= isset($prodi->icon) ? $prodi->icon : 'fas fa-graduation-cap' ?> me-2"
                                            style="color: <?= isset($prodi->warna) ? $prodi->warna : '#00B9AD' ?>;"></i>
                                        <?= $prodi->jenjang ?> <?= $prodi->nama_prodi ?>
                                        <?php if (isset($prodi->akreditasi) && $prodi->akreditasi == 'A'): ?>
                                            <span class="badge bg-success ms-1" style="font-size: 0.6em;">A</span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-nurse me-2" style="color: #E8717A;"></i>S1 Keperawatan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-baby me-2" style="color: #F4A7B9;"></i>D3 Kebidanan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-stethoscope me-2" style="color: #00B9AD;"></i>Profesi Ners</a></li>
                        <?php endif; ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= site_url('program-studi') ?>"><i class="fas fa-list me-2"></i>Semua Program Studi</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-2"></i>Info Pendaftaran</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#features" id="facilitiesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-building me-1"></i>Fasilitas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="facilitiesDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-procedures"></i>Lab Keperawatan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-heartbeat"></i>Lab Kebidanan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-hospital-alt"></i>Rumah Sakit Pendidikan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-microscope"></i>Lab Sains Dasar</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-book"></i>Perpustakaan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="academicDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-university me-1"></i>Akademik
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="academicDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-alt"></i>Kalender Akademik</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt"></i>Kurikulum</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-award"></i>Beasiswa</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-clipboard-check"></i>Uji Kompetensi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#news">
                        <i class="fas fa-newspaper me-1"></i>Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">
                        <i class="fas fa-info-circle me-1"></i>Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('auth/login'); ?>">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>