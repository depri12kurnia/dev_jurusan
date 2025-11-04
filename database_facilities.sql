-- ============================================
-- DATABASE STRUCTURE FOR FACILITIES SECTION
-- ============================================

-- Tabel untuk kategori fasilitas
CREATE TABLE IF NOT EXISTS `facility_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text,
  `icon` varchar(50) DEFAULT 'fas fa-building',
  `color` varchar(7) DEFAULT '#007bff',
  `sort_order` int(11) DEFAULT 0,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel utama untuk fasilitas
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(200) DEFAULT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `short_description` varchar(300) DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'fas fa-building',
  `image` varchar(255) DEFAULT NULL,
  `gallery` text DEFAULT NULL COMMENT 'JSON array of images',
  `video_url` varchar(500) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `capacity` varchar(100) DEFAULT NULL,
  `operational_hours` varchar(200) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website_url` varchar(300) DEFAULT NULL,
  `virtual_tour_url` varchar(500) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `featured_order` int(11) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `view_count` int(11) DEFAULT 0,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` enum('Active','Inactive','Draft') NOT NULL DEFAULT 'Active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_category` (`category_id`),
  KEY `idx_featured` (`is_featured`, `featured_order`),
  KEY `idx_status` (`status`),
  KEY `idx_sort` (`sort_order`),
  FOREIGN KEY (`category_id`) REFERENCES `facility_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk highlight/keunggulan fasilitas
CREATE TABLE IF NOT EXISTS `facility_highlights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'fas fa-check',
  `color` varchar(7) DEFAULT '#28a745',
  `sort_order` int(11) DEFAULT 0,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_facility` (`facility_id`),
  KEY `idx_sort` (`sort_order`),
  FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk spesifikasi teknis fasilitas
CREATE TABLE IF NOT EXISTS `facility_specifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `spec_name` varchar(100) NOT NULL,
  `spec_value` varchar(300) NOT NULL,
  `spec_unit` varchar(50) DEFAULT NULL,
  `spec_category` varchar(100) DEFAULT 'General',
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_facility` (`facility_id`),
  KEY `idx_category` (`spec_category`),
  KEY `idx_sort` (`sort_order`),
  FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- SAMPLE DATA / DATA CONTOH
-- ============================================

-- Insert kategori fasilitas
INSERT INTO `facility_categories` (`name`, `slug`, `description`, `icon`, `color`, `sort_order`) VALUES
('Laboratorium Medis', 'laboratorium-medis', 'Fasilitas laboratorium untuk praktik dan penelitian medis', 'fas fa-microscope', '#007bff', 1),
('Simulasi Klinis', 'simulasi-klinis', 'Ruang simulasi untuk praktik keterampilan klinis', 'fas fa-procedures', '#28a745', 2),
('Teknologi Kesehatan', 'teknologi-kesehatan', 'Fasilitas teknologi canggih untuk pendukung pembelajaran', 'fas fa-laptop-medical', '#6f42c1', 3),
('Fasilitas Umum', 'fasilitas-umum', 'Fasilitas penunjang akademik dan kemahasiswaan', 'fas fa-building', '#fd7e14', 4);

-- Insert fasilitas utama (sesuai dengan yang ada di home.php)
INSERT INTO `facilities` (`category_id`, `title`, `subtitle`, `slug`, `description`, `short_description`, `icon`, `is_featured`, `featured_order`, `sort_order`) VALUES
(2, 'Laboratorium Keperawatan', 'Simulasi Klinis', 'laboratorium-keperawatan', 'Lab simulasi dengan manikin canggih berteknologi tinggi untuk praktik keterampilan klinis keperawatan yang realistis dan komprehensif. Fasilitas ini dilengkapi dengan peralatan medis terkini dan teknologi simulasi yang memungkinkan mahasiswa untuk belajar dalam lingkungan yang aman namun realistis.', 'Lab simulasi dengan manikin canggih berteknologi tinggi untuk praktik keterampilan klinis keperawatan yang realistis dan komprehensif.', 'fas fa-procedures', 1, 1, 1),
(1, 'Laboratorium Kebidanan', 'Maternal Care', 'laboratorium-kebidanan', 'Fasilitas praktik lengkap untuk simulasi persalinan, perawatan ibu hamil, dan neonatal dengan teknologi terdepan. Lab ini menyediakan lingkungan pembelajaran yang aman untuk mahasiswa kebidanan dalam mempelajari berbagai skenario klinis yang mungkin terjadi dalam praktik nyata.', 'Fasilitas praktik lengkap untuk simulasi persalinan, perawatan ibu hamil, dan neonatal dengan teknologi terdepan.', 'fas fa-heartbeat', 1, 2, 2),
(3, 'Rumah Sakit Pendidikan', 'Clinical Practice', 'rumah-sakit-pendidikan', 'Praktik langsung di rumah sakit mitra dengan supervisi dosen berpengalaman dan perawat senior untuk pengalaman klinis nyata. Mahasiswa mendapatkan kesempatan untuk menerapkan teori yang telah dipelajari dalam situasi nyata dengan pasien sungguhan.', 'Praktik langsung di rumah sakit mitra dengan supervisi dosen berpengalaman dan perawat senior untuk pengalaman klinis nyata.', 'fas fa-hospital-alt', 1, 3, 3),
(1, 'Laboratorium Sains Dasar', 'Medical Sciences', 'laboratorium-sains-dasar', 'Lab anatomi, fisiologi, dan biokimia dengan peralatan canggih untuk pemahaman mendalam ilmu dasar kesehatan. Fasilitas ini dilengkapi dengan teknologi modern untuk mendukung pembelajaran ilmu dasar yang menjadi fondasi pendidikan kesehatan.', 'Lab anatomi, fisiologi, dan biokimia dengan peralatan canggih untuk pemahaman mendalam ilmu dasar kesehatan.', 'fas fa-microscope', 1, 4, 4);

-- Insert highlights untuk setiap fasilitas
INSERT INTO `facility_highlights` (`facility_id`, `title`, `description`, `icon`, `color`, `sort_order`) VALUES
-- Lab Keperawatan highlights
(1, 'High-Fidelity Simulator', 'Manikin canggih dengan respon realistis untuk simulasi berbagai kondisi medis', 'fas fa-robot', '#007bff', 1),
(1, 'VR Training', 'Teknologi Virtual Reality untuk pengalaman pembelajaran yang immersive', 'fas fa-vr-cardboard', '#28a745', 2),
(1, 'Real-time Monitoring', 'Sistem monitoring real-time untuk evaluasi performa mahasiswa', 'fas fa-chart-line', '#dc3545', 3),

-- Lab Kebidanan highlights  
(2, 'Birth Simulator', 'Simulator persalinan dengan teknologi terdepan untuk pembelajaran obstetri', 'fas fa-baby', '#e83e8c', 1),
(2, 'Neonatal Care', 'Fasilitas perawatan neonatal dengan incubator dan peralatan NICU', 'fas fa-heart', '#fd7e14', 2),
(2, 'Emergency Training', 'Pelatihan penanganan kegawatdaruratan maternal dan neonatal', 'fas fa-ambulance', '#dc3545', 3),

-- Rumah Sakit Pendidikan highlights
(3, 'Real Patient Care', 'Pengalaman langsung merawat pasien dengan supervisi ketat', 'fas fa-user-md', '#007bff', 1),
(3, 'Expert Supervision', 'Bimbingan dari dokter dan perawat berpengalaman', 'fas fa-graduation-cap', '#28a745', 2),
(3, 'Case Studies', 'Pembelajaran berbasis kasus nyata dari berbagai kondisi medis', 'fas fa-file-medical-alt', '#6f42c1', 3),

-- Lab Sains Dasar highlights
(4, '3D Anatomy', 'Model anatomi 3D interaktif untuk pembelajaran struktur tubuh', 'fas fa-cube', '#007bff', 1),
(4, 'Digital Microscopy', 'Mikroskop digital dengan kemampuan imaging canggih', 'fas fa-search-plus', '#28a745', 2),
(4, 'Interactive Learning', 'Platform pembelajaran interaktif dengan teknologi AR/VR', 'fas fa-hand-pointer', '#fd7e14', 3);

-- Insert spesifikasi teknis (contoh)
INSERT INTO `facility_specifications` (`facility_id`, `spec_name`, `spec_value`, `spec_unit`, `spec_category`, `sort_order`) VALUES
-- Lab Keperawatan specs
(1, 'Luas Ruangan', '200', 'm²', 'Physical', 1),
(1, 'Kapasitas Mahasiswa', '30', 'orang', 'Capacity', 2),
(1, 'Jumlah Manikin', '15', 'unit', 'Equipment', 3),
(1, 'Sistem Audio Visual', '4K Resolution', '', 'Technology', 4),

-- Lab Kebidanan specs
(2, 'Luas Ruangan', '150', 'm²', 'Physical', 1),
(2, 'Kapasitas Mahasiswa', '25', 'orang', 'Capacity', 2),
(2, 'Bed Simulasi', '10', 'unit', 'Equipment', 3),
(2, 'Incubator', '5', 'unit', 'Equipment', 4),

-- Rumah Sakit specs
(3, 'Jumlah Tempat Tidur', '500', 'bed', 'Capacity', 1),
(3, 'Spesialisasi', '25', 'departemen', 'Services', 2),
(3, 'Mahasiswa per Shift', '50', 'orang', 'Capacity', 3),

-- Lab Sains Dasar specs
(4, 'Luas Ruangan', '180', 'm²', 'Physical', 1),
(4, 'Kapasitas Mahasiswa', '35', 'orang', 'Capacity', 2),
(4, 'Mikroskop Digital', '20', 'unit', 'Equipment', 3),
(4, 'Workstation', '15', 'unit', 'Equipment', 4);

-- ============================================
-- INDEXES FOR PERFORMANCE
-- ============================================

-- Additional indexes for better performance
CREATE INDEX idx_facilities_featured_status ON facilities(is_featured, status, featured_order);
CREATE INDEX idx_facilities_category_status ON facilities(category_id, status, sort_order);
CREATE INDEX idx_highlights_facility_status ON facility_highlights(facility_id, status, sort_order);
CREATE INDEX idx_specs_facility_category ON facility_specifications(facility_id, spec_category, sort_order);