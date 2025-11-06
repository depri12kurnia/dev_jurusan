<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url() ?>">
            <?php
            // Ambil logo dan nama dari model
            $CI = &get_instance();
            $CI->load->model('M_settings');
            $navbar_data = $CI->M_settings->get_navbar_logo();

            if (!empty($navbar_data)) {
                if (!empty($navbar_data->logo)) {
                    // Ada logo, tampilkan logo
                    echo '<img src="' . base_url('assets/uploads/settings/' . $navbar_data->logo) . '" alt="Logo" style="max-height: 80px;">';
                } else {
                    // Tidak ada logo, tampilkan nama website
                    echo '<span class="brand-text fw-bold">' . (!empty($navbar_data->name) ? htmlspecialchars($navbar_data->name) : 'Website') . '</span>';
                }
            } else {
                // Tidak ada data settings
                echo '<span class="brand-text fw-bold">Website</span>';
            }
            ?>
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
                <?php
                // Load tentang menu items dynamically
                if (!isset($tentang_menu) || empty($tentang_menu)) {
                    $CI = &get_instance();
                    if (!isset($CI->m_menu_items)) {
                        $CI->load->model('M_menu_items', 'm_menu_items');
                    }
                    $tentang_menu = $CI->m_menu_items->get_by_category_slug('tentang-kami');
                }
                ?>

                <?php if (!empty($tentang_menu) && count($tentang_menu) > 1): ?>
                    <!-- Multiple tentang items - show as dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tentangDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-info-circle me-1"></i>Tentang Kami
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tentangDropdown">
                            <?php foreach ($tentang_menu as $item): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('tentang/' . $item->slug) ?>">
                                        <i class="<?= !empty($item->icon) ? $item->icon : 'fas fa-info-circle' ?> me-2"></i>
                                        <?= htmlspecialchars($item->title) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php elseif (!empty($tentang_menu) && count($tentang_menu) == 1): ?>
                    <!-- Single tentang item - direct link -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('tentang/' . $tentang_menu[0]->slug) ?>">
                            <i class="<?= !empty($tentang_menu[0]->icon) ? $tentang_menu[0]->icon : 'fas fa-info-circle' ?> me-1"></i>
                            <?= htmlspecialchars($tentang_menu[0]->title) ?>
                        </a>
                    </li>
                <?php else: ?>
                    <!-- Fallback static link -->
                    <li class="nav-item">
                        <a class="nav-link" href="#about">
                            <i class="fas fa-info-circle me-1"></i>Tentang
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#programs" id="programsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-graduation-cap me-1"></i>Program Studi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="programsDropdown">
                        <?php
                        // Fallback: load program studi jika belum dimuat dari controller
                        if (!isset($program_studi_all) || empty($program_studi_all)) {
                            $CI = &get_instance();
                            if (!isset($CI->m_prodi)) {
                                $CI->load->model('M_prodi', 'm_prodi');
                            }
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
                        <?php
                        // Fallback: load facilities jika belum dimuat dari controller
                        if (!isset($facility_categories) || empty($facility_categories)) {
                            $CI = &get_instance();
                            if (!isset($CI->m_facilities)) {
                                $CI->load->model('M_facilities', 'm_facilities');
                            }
                            $facility_categories = $CI->m_facilities->get_categories();
                            $featured_facilities_nav = $CI->m_facilities->get_featured_facilities(5); // Limit 5 untuk navbar
                        } else {
                            $CI = &get_instance();
                            if (!isset($CI->m_facilities)) {
                                $CI->load->model('M_facilities', 'm_facilities');
                            }
                            $featured_facilities_nav = $CI->m_facilities->get_featured_facilities(5);
                        }
                        ?>

                        <!-- Featured Facilities -->
                        <?php if (!empty($featured_facilities_nav)): ?>
                            <li class="dropdown-header">Fasilitas Unggulan</li>
                            <?php foreach ($featured_facilities_nav as $facility): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('facilities/detail/' . $facility->slug) ?>">
                                        <i class="<?= $facility->icon ?: 'fas fa-building' ?> me-2"
                                            style="color: <?= $facility->category_color ?: '#00B9AD' ?>;"></i>
                                        <?= htmlspecialchars($facility->title) ?>
                                        <?php if ($facility->is_featured): ?>
                                            <span class="badge bg-primary ms-1" style="font-size: 0.6em;">★</span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Categories -->
                        <?php if (!empty($facility_categories)): ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-header">Kategori Fasilitas</li>
                            <?php foreach ($facility_categories as $category): ?>
                                <?php if ($category->facilities_count > 0): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('facilities/category/' . $category->slug) ?>"
                                            <i class="<?= $category->icon ?: 'fas fa-building' ?> me-2"
                                            style="color: <?= $category->color ?: '#6c757d' ?>;"></i>
                                            <?= htmlspecialchars($category->name) ?>
                                            <small class="text-muted ms-1">(<?= $category->facilities_count ?>)</small>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Static fallback jika tidak ada data -->
                            <li><a class="dropdown-item" href="#"><i class="fas fa-procedures me-2" style="color: #007bff;"></i>Lab Keperawatan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heartbeat me-2" style="color: #28a745;"></i>Lab Kebidanan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-hospital-alt me-2" style="color: #dc3545;"></i>Rumah Sakit Pendidikan</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-microscope me-2" style="color: #6f42c1;"></i>Lab Sains Dasar</a></li>
                        <?php endif; ?>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= site_url('facilities') ?>"><i class="fas fa-list me-2"></i>Semua Fasilitas</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('facilities') ?>?featured=1"><i class="fas fa-star me-2"></i>Fasilitas Unggulan</a></li>
                    </ul>
                </li>
                <?php
                // Load academic menu items dynamically
                if (!isset($academic_menu) || empty($academic_menu)) {
                    $CI = &get_instance();
                    if (!isset($CI->m_menu_items)) {
                        $CI->load->model('M_menu_items', 'm_menu_items');
                    }
                    // Get academic category items (assuming 'akademik' slug)
                    $academic_menu = $CI->m_menu_items->get_by_category_slug('akademik');
                }
                ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="academicDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-university me-1"></i>Akademik
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="academicDropdown">
                        <?php if (!empty($academic_menu)): ?>
                            <?php foreach ($academic_menu as $item): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('akademik/' . $item->slug) ?>">
                                        <i class="<?= !empty($item->icon) ? $item->icon : 'fas fa-file-alt' ?> me-2"></i>
                                        <?= htmlspecialchars($item->title) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback static menu if no database items -->
                            <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-alt me-2"></i>Kosong</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php
                // Load academic menu items dynamically
                if (!isset($kemahasiswaan_menu) || empty($kemahasiswaan_menu)) {
                    $CI = &get_instance();
                    if (!isset($CI->m_menu_items)) {
                        $CI->load->model('M_menu_items', 'm_menu_items');
                    }
                    // Get academic category items (assuming 'kemahasiswaan' slug)
                    $kemahasiswaan_menu = $CI->m_menu_items->get_by_category_slug('kemahasiswaan');
                }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="kemahasiswaanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-graduate me-1"></i>Kemahasiswaan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="kemahasiswaanDropdown">
                        <?php if (!empty($kemahasiswaan_menu)): ?>
                            <?php foreach ($kemahasiswaan_menu as $item): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('kemahasiswaan/' . $item->slug) ?>">
                                        <i class="<?= !empty($item->icon) ? $item->icon : 'fas fa-file-alt' ?> me-2"></i>
                                        <?= htmlspecialchars($item->title) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback static menu if no database items -->
                            <li><a class="dropdown-item" href="#"><i class="fas fa-empty-alt"></i>Kosong</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="#news"> -->
                    <a class="nav-link" href="<?= site_url('news') ?>">
                        <i class="fas fa-newspaper me-1"></i>Berita
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