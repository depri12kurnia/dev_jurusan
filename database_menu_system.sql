-- =====================================================
-- Database Schema untuk Menu Dinamis
-- =====================================================

-- 1. Tabel untuk Kategori Menu Utama
CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `order_position` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel untuk Menu Items (submenu)
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `content` longtext,
  `icon` varchar(50) DEFAULT NULL,
  `order_position` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  KEY `is_active` (`is_active`),
  KEY `order_position` (`order_position`),
  CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Data Sample untuk Menu Categories
-- =====================================================

INSERT INTO `menu_categories` (`id`, `name`, `slug`, `icon`, `order_position`, `is_active`) VALUES
(1, 'Tentang Kami', 'tentang-kami', 'fas fa-info-circle', 1, 1),
(2, 'Akademik', 'akademik', 'fas fa-university', 2, 1);

-- =====================================================
-- Data Sample untuk Menu Items
-- =====================================================

INSERT INTO `menu_items` (`category_id`, `title`, `slug`, `content`, `icon`, `order_position`, `is_active`, `meta_title`, `meta_description`) VALUES

-- Tentang Kami Menu Items
(1, 'Profil', 'profil', 
'<h2>Profil Institusi</h2>
<p>Institusi kami adalah lembaga pendidikan yang berdedikasi untuk menghasilkan tenaga profesional yang berkualitas dan berintegritas tinggi.</p>
<p>Dengan pengalaman lebih dari 20 tahun, kami telah menghasilkan ribuan alumni yang tersebar di berbagai bidang profesi.</p>', 
'fas fa-building', 1, 1, 'Profil Institusi', 'Profil lengkap institusi pendidikan kami'),

(1, 'Visi Misi', 'visi-misi', 
'<h2>Visi</h2>
<p>Menjadi institusi pendidikan terkemuka yang menghasilkan lulusan profesional, berkarakter, dan berdaya saing global pada tahun 2030.</p>

<h2>Misi</h2>
<ul>
<li>Menyelenggarakan pendidikan tinggi yang berkualitas dan relevan dengan kebutuhan industri</li>
<li>Mengembangkan penelitian dan pengabdian masyarakat yang inovatif</li>
<li>Membangun kemitraan strategis dengan berbagai pihak</li>
<li>Menciptakan lingkungan akademik yang kondusif dan berkarakter</li>
</ul>', 
'fas fa-eye', 2, 1, 'Visi Misi Institusi', 'Visi dan misi institusi pendidikan kami'),

(1, 'Sejarah', 'sejarah', 
'<h2>Sejarah Institusi</h2>
<p>Institusi kami didirikan pada tahun 2003 dengan tekad untuk memberikan kontribusi nyata bagi pembangunan sumber daya manusia Indonesia.</p>

<h3>Timeline Sejarah</h3>
<ul>
<li><strong>2003:</strong> Pendirian institusi dengan 1 program studi</li>
<li><strong>2008:</strong> Memperoleh akreditasi B untuk semua program studi</li>
<li><strong>2015:</strong> Pembukaan program studi baru dan fasilitas modern</li>
<li><strong>2020:</strong> Transformasi digital dan pembelajaran online</li>
<li><strong>2023:</strong> Meraih akreditasi A untuk program studi unggulan</li>
</ul>', 
'fas fa-history', 3, 1, 'Sejarah Institusi', 'Perjalanan sejarah dan perkembangan institusi kami'),

-- Akademik Menu Items
(2, 'Kalender Akademik', 'kalender-akademik', 
'<h2>Kalender Akademik 2024/2025</h2>
<p>Berikut adalah jadwal kegiatan akademik untuk tahun ajaran 2024/2025:</p>

<h3>Semester Ganjil</h3>
<ul>
<li><strong>Juli 2024:</strong> Registrasi dan KRS</li>
<li><strong>Agustus 2024:</strong> Perkuliahan dimulai</li>
<li><strong>Oktober 2024:</strong> UTS (Ujian Tengah Semester)</li>
<li><strong>Desember 2024:</strong> UAS (Ujian Akhir Semester)</li>
</ul>

<h3>Semester Genap</h3>
<ul>
<li><strong>Februari 2025:</strong> Registrasi dan KRS</li>
<li><strong>Maret 2025:</strong> Perkuliahan dimulai</li>
<li><strong>Mei 2025:</strong> UTS (Ujian Tengah Semester)</li>
<li><strong>Juli 2025:</strong> UAS (Ujian Akhir Semester)</li>
</ul>', 
'fas fa-calendar-alt', 1, 1, 'Kalender Akademik', 'Jadwal kegiatan akademik tahun ajaran'),

(2, 'Kurikulum', 'kurikulum', 
'<h2>Kurikulum Berbasis Kompetensi</h2>
<p>Kurikulum kami dirancang sesuai dengan Kerangka Kualifikasi Nasional Indonesia (KKNI) dan kebutuhan industri terkini.</p>

<h3>Prinsip Kurikulum</h3>
<ul>
<li>Berorientasi pada capaian pembelajaran</li>
<li>Mengintegrasikan teori dan praktik</li>
<li>Mengembangkan soft skills dan hard skills</li>
<li>Menerapkan pembelajaran berbasis teknologi</li>
</ul>

<h3>Struktur Kurikulum</h3>
<ul>
<li><strong>Mata Kuliah Wajib Nasional:</strong> 20 SKS</li>
<li><strong>Mata Kuliah Inti:</strong> 80 SKS</li>
<li><strong>Mata Kuliah Pilihan:</strong> 20 SKS</li>
<li><strong>Mata Kuliah Praktik/Magang:</strong> 24 SKS</li>
</ul>', 
'fas fa-book', 2, 1, 'Kurikulum Program Studi', 'Struktur dan konten kurikulum program studi'),

(2, 'Beasiswa', 'beasiswa', 
'<h2>Program Beasiswa</h2>
<p>Kami menyediakan berbagai program beasiswa untuk mendukung mahasiswa berprestasi dan kurang mampu.</p>

<h3>Jenis Beasiswa</h3>
<ol>
<li><strong>Beasiswa Prestasi Akademik</strong>
   <ul>
   <li>IPK minimal 3.50</li>
   <li>Tidak ada tunggakan biaya kuliah</li>
   <li>Aktif dalam kegiatan kemahasiswaan</li>
   </ul>
</li>
<li><strong>Beasiswa Ekonomi Kurang Mampu</strong>
   <ul>
   <li>Surat keterangan tidak mampu dari kelurahan</li>
   <li>IPK minimal 3.00</li>
   <li>Wawancara dan survei lapangan</li>
   </ul>
</li>
<li><strong>Beasiswa Bidikmisi/KIP-K</strong>
   <ul>
   <li>Penerima KIP (Kartu Indonesia Pintar)</li>
   <li>Memenuhi kriteria ekonomi</li>
   <li>Lulus seleksi nasional</li>
   </ul>
</li>
</ol>', 
'fas fa-graduation-cap', 3, 1, 'Program Beasiswa', 'Informasi lengkap program beasiswa yang tersedia'),

(2, 'Uji Kompetensi', 'uji-kompetensi', 
'<h2>Uji Kompetensi Profesi</h2>
<p>Sebagai bagian dari standar kompetensi lulusan, mahasiswa diwajibkan mengikuti uji kompetensi sesuai bidang studi masing-masing.</p>

<h3>Tujuan Uji Kompetensi</h3>
<ul>
<li>Mengukur pencapaian kompetensi lulusan</li>
<li>Memastikan kesiapan kerja lulusan</li>
<li>Meningkatkan daya saing di dunia kerja</li>
<li>Memberikan sertifikasi kompetensi nasional</li>
</ul>

<h3>Jadwal Uji Kompetensi</h3>
<ul>
<li><strong>Gelombang 1:</strong> Maret - April</li>
<li><strong>Gelombang 2:</strong> September - Oktober</li>
</ul>

<h3>Persyaratan</h3>
<ul>
<li>Mahasiswa semester akhir (minimal semester 6)</li>
<li>IPK minimal 2.75</li>
<li>Telah menyelesaikan mata kuliah wajib</li>
<li>Melunasi biaya uji kompetensi</li>
</ul>', 
'fas fa-certificate', 4, 1, 'Uji Kompetensi Profesi', 'Informasi uji kompetensi dan sertifikasi profesi');

-- =====================================================
-- Index untuk Performance
-- =====================================================

CREATE INDEX idx_menu_categories_active ON menu_categories(is_active, order_position);
CREATE INDEX idx_menu_items_category_active ON menu_items(category_id, is_active, order_position);
CREATE INDEX idx_menu_items_slug ON menu_items(slug);