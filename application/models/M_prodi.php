<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_prodi extends CI_Model
{

    private $table = 'program_studi';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ================ ADMIN CRUD OPERATIONS ================

    /**
     * Get all program studi with pagination for admin
     */
    public function get_all_admin($limit = null, $offset = null, $search = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ($search) {
            $this->db->group_start();
            $this->db->like('nama_prodi', $search);
            $this->db->or_like('kode_prodi', $search);
            $this->db->or_like('jenjang', $search);
            $this->db->or_like('gelar', $search);
            $this->db->group_end();
        }

        $this->db->order_by('created_at', 'DESC');

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result();
    }

    /**
     * Count all records for pagination
     */
    public function count_all($search = null)
    {
        $this->db->from($this->table);

        if ($search) {
            $this->db->group_start();
            $this->db->like('nama_prodi', $search);
            $this->db->or_like('kode_prodi', $search);
            $this->db->or_like('jenjang', $search);
            $this->db->or_like('gelar', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    /**
     * Get single program studi by ID
     */
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    /**
     * Get single program studi by slug
     */
    public function get_by_slug($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('status', 'aktif');
        return $this->db->get($this->table)->row();
    }

    /**
     * Insert new program studi
     */
    public function insert($data)
    {
        // Generate slug from nama_prodi
        $data['slug'] = $this->generate_slug($data['nama_prodi']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->db->insert($this->table, $data);
    }

    /**
     * Update program studi
     */
    public function update($id, $data)
    {
        // Update slug if nama_prodi changed
        if (isset($data['nama_prodi'])) {
            $data['slug'] = $this->generate_slug($data['nama_prodi'], $id);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete program studi (soft delete)
     */
    public function delete($id)
    {
        $data = array(
            'status' => 'nonaktif',
            'deleted_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Permanent delete program studi
     */
    public function permanent_delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Restore deleted program studi
     */
    public function restore($id)
    {
        $data = array(
            'status' => 'aktif',
            'deleted_at' => null,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Toggle status (aktif/nonaktif)
     */
    public function toggle_status($id)
    {
        $current = $this->get_by_id($id);
        if ($current) {
            $new_status = ($current->status == 'aktif') ? 'nonaktif' : 'aktif';
            $data = array(
                'status' => $new_status,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->db->where('id', $id);
            return $this->db->update($this->table, $data);
        }
        return false;
    }

    // ================ PUBLIC/HOMEUSER OPERATIONS ================

    /**
     * Get all active program studi for public display
     */
    public function get_all_active($limit = null)
    {
        $this->db->select('id, nama_prodi, kode_prodi, jenjang, gelar, deskripsi, 
                          icon, warna, durasi_studi, sks_total, akreditasi, 
                          prospek_karir, slug, gambar, featured_description, urutan');
        $this->db->from($this->table);
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by('nama_prodi', 'ASC');

        if ($limit !== null) {
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    /**
     * Get featured program studi for homepage
     */
    public function get_featured($limit = 3)
    {
        $this->db->select('id, nama_prodi, kode_prodi, jenjang, gelar, deskripsi, 
                          icon, warna, slug, gambar, featured_description, durasi_studi, 
                          sks_total, akreditasi, urutan');
        $this->db->from($this->table);
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->where('is_featured', 1);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by('nama_prodi', 'ASC');
        $this->db->limit($limit);

        return $this->db->get()->result();
    }

    /**
     * Get program studi by jenjang for public
     */
    public function get_by_jenjang($jenjang, $limit = null)
    {
        $this->db->select('id, nama_prodi, kode_prodi, jenjang, gelar, deskripsi, 
                          icon, warna, durasi_studi, sks_total, akreditasi, slug, gambar,
                          featured_description, urutan');
        $this->db->from($this->table);
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->where('deleted_at IS NULL');
        $this->db->where('jenjang', $jenjang);
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by('nama_prodi', 'ASC');

        if ($limit !== null) {
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    /**
     * Get program studi statistics for homepage
     */
    public function get_statistics()
    {
        // Total program studi aktif
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $total_prodi = $this->db->count_all_results($this->table);

        // Hitung berdasarkan jenjang
        $this->db->select('jenjang, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->group_by('jenjang');
        $by_jenjang = $this->db->get()->result();

        // Hitung berdasarkan akreditasi
        $this->db->select('akreditasi, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->where('akreditasi !=', '');
        $this->db->group_by('akreditasi');
        $by_akreditasi = $this->db->get()->result();

        return array(
            'total_prodi' => $total_prodi,
            'by_jenjang' => $by_jenjang,
            'by_akreditasi' => $by_akreditasi
        );
    }



    // ================ UTILITY FUNCTIONS ================

    /**
     * Generate unique slug
     */
    private function generate_slug($nama_prodi, $id = null)
    {
        $slug = url_title($nama_prodi, 'dash', TRUE);
        $original_slug = $slug;
        $counter = 1;

        // Check if slug exists
        while ($this->slug_exists($slug, $id)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Check if slug exists
     */
    private function slug_exists($slug, $exclude_id = null)
    {
        $this->db->where('slug', $slug);
        if ($exclude_id !== null) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results($this->table) > 0;
    }

    /**
     * Get dropdown data for forms
     */
    public function get_dropdown_data($value_field = 'id', $label_field = 'nama_prodi')
    {
        $this->db->select($value_field . ', ' . $label_field);
        $this->db->from($this->table);
        $this->db->where('status', 'aktif');
        $this->db->order_by($label_field, 'ASC');

        $result = $this->db->get()->result();

        $dropdown = array();
        foreach ($result as $row) {
            $dropdown[$row->$value_field] = $row->$label_field;
        }

        return $dropdown;
    }

    /**
     * Validate required fields
     */
    public function validate_data($data, $is_update = false)
    {
        $errors = array();

        // Required fields
        if (empty($data['nama_prodi'])) {
            $errors[] = 'Nama Program Studi wajib diisi';
        }

        if (empty($data['kode_prodi'])) {
            $errors[] = 'Kode Program Studi wajib diisi';
        }

        if (empty($data['jenjang'])) {
            $errors[] = 'Jenjang wajib diisi';
        }

        if (empty($data['gelar'])) {
            $errors[] = 'Gelar wajib diisi';
        }

        // Check unique kode_prodi
        if (!$is_update && $this->kode_exists($data['kode_prodi'])) {
            $errors[] = 'Kode Program Studi sudah digunakan';
        }

        return $errors;
    }

    /**
     * Check if kode_prodi exists
     */
    private function kode_exists($kode_prodi, $exclude_id = null)
    {
        $this->db->where('kode_prodi', $kode_prodi);
        if ($exclude_id !== null) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results($this->table) > 0;
    }

    /**
     * Get next urutan number
     */
    public function get_next_urutan()
    {
        $this->db->select_max('urutan');
        $result = $this->db->get($this->table)->row();
        return ($result->urutan ?? 0) + 1;
    }

    /**
     * Update urutan (for drag & drop reordering)
     */
    public function update_urutan($updates)
    {
        foreach ($updates as $update) {
            $this->db->where('id', $update['id']);
            $this->db->update($this->table, array('urutan' => $update['urutan']));
        }
        return true;
    }

    /**
     * Bulk update status
     */
    public function bulk_update_status($ids, $status)
    {
        $this->db->where_in('id', $ids);
        $data = array(
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->update($this->table, $data);
    }

    /**
     * Get program studi with related data (for detailed view)
     */
    public function get_with_relations($id)
    {
        // Get basic program studi data
        $prodi = $this->get_by_id($id);

        if ($prodi) {
            // Add any related data here (e.g., mata kuliah, dosen, dll)
            // This is extensible for future relationships

            return $prodi;
        }

        return null;
    }

    // ================ STATISTICS METHODS ================

    /**
     * Count active program studi
     */
    public function count_active()
    {
        return $this->db->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->count_all_results($this->table);
    }

    /**
     * Sum all active students
     */
    public function sum_mahasiswa_aktif()
    {
        $result = $this->db->select_sum('jumlah_mahasiswa_aktif')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->row();

        return $result->jumlah_mahasiswa_aktif ?: 0;
    }

    /**
     * Sum all alumni
     */
    public function sum_alumni()
    {
        $result = $this->db->select_sum('jumlah_alumni')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->row();

        return $result->jumlah_alumni ?: 0;
    }

    /**
     * Count program studi with A accreditation
     */
    public function count_akreditasi_a()
    {
        return $this->db->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->group_start()
            ->where('akreditasi', 'A')
            ->or_where('akreditasi', 'Unggul')
            ->group_end()
            ->count_all_results($this->table);
    }

    /**
     * Get related program studi (by jenjang, excluding current)
     */
    public function get_related($jenjang, $exclude_id, $limit = 3)
    {
        return $this->db->where('jenjang', $jenjang)
            ->where('id !=', $exclude_id)
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('nama_prodi', 'ASC')
            ->limit($limit)
            ->get($this->table)
            ->result();
    }

    /**
     * Generate unique slug for program studi
     */
    public function generate_unique_slug($nama_prodi, $id = null)
    {
        $slug = url_title($nama_prodi, 'dash', TRUE);
        $original_slug = $slug;
        $counter = 1;

        // Check if slug exists
        while ($this->slug_exists($slug, $id)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    // ================ FRONTEND/PUBLIC METHODS ================

    /**
     * Get all published program studi for public
     */
    public function get_public_list($limit = null, $offset = null)
    {
        $this->db->select('id, kode_prodi, nama_prodi, jenjang, gelar, slug, deskripsi, featured_description, icon, warna, is_featured, urutan, created_at');
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by('nama_prodi', 'ASC');

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get($this->table)->result();
    }

    /**
     * Get featured programs for public
     */
    public function get_featured_programs($limit = 6)
    {
        return $this->db->select('id, kode_prodi, nama_prodi, jenjang, gelar, slug, deskripsi, featured_description, icon, warna, urutan')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('is_featured', 1)
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('nama_prodi', 'ASC')
            ->limit($limit)
            ->get($this->table)
            ->result();
    }

    /**
     * Get public statistics (optimized with caching)
     */
    public function get_public_statistics()
    {
        // Check if session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Simple session-based caching untuk mengurangi query berulang
        if (
            isset($_SESSION['prodi_stats_cache']) &&
            isset($_SESSION['prodi_stats_time']) &&
            (time() - $_SESSION['prodi_stats_time']) < 300
        ) { // Cache 5 menit
            return $_SESSION['prodi_stats_cache'];
        }

        // Single optimized query to get all statistics at once
        $result = $this->db->select('
                COUNT(*) as total_prodi,
                SUM(CASE WHEN jumlah_mahasiswa_aktif IS NOT NULL THEN jumlah_mahasiswa_aktif ELSE 0 END) as total_mahasiswa,
                SUM(CASE WHEN jumlah_alumni IS NOT NULL THEN jumlah_alumni ELSE 0 END) as total_alumni
            ')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->row();

        $stats = array(
            'total_prodi' => (int)$result->total_prodi,
            'total_mahasiswa' => (int)$result->total_mahasiswa,
            'total_alumni' => (int)$result->total_alumni
        );

        // Cache hasil untuk mengurangi query selanjutnya
        $_SESSION['prodi_stats_cache'] = $stats;
        $_SESSION['prodi_stats_time'] = time();

        return $stats;
    }

    /**
     * Get jenjang list with count
     */
    public function get_jenjang_list()
    {
        $result = $this->db->select('jenjang, COUNT(*) as total')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->group_by('jenjang')
            ->order_by('jenjang', 'ASC')
            ->get($this->table)
            ->result();

        $jenjang_list = array();
        foreach ($result as $item) {
            $jenjang_list[$item->jenjang] = $item->total;
        }

        return $jenjang_list;
    }

    /**
     * Search public program studi
     */
    public function search_public($keyword = '', $jenjang = '', $limit = null, $offset = null)
    {
        $this->db->select('id, kode_prodi, nama_prodi, jenjang, gelar, slug, deskripsi, featured_description, icon, warna, is_featured, urutan');
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->where('deleted_at IS NULL');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('nama_prodi', $keyword);
            $this->db->or_like('kode_prodi', $keyword);
            $this->db->or_like('deskripsi', $keyword);
            $this->db->or_like('gelar', $keyword);
            $this->db->group_end();
        }

        if (!empty($jenjang)) {
            $this->db->where('jenjang', $jenjang);
        }

        $this->db->order_by('is_featured', 'DESC');
        $this->db->order_by('urutan', 'ASC');
        $this->db->order_by('nama_prodi', 'ASC');

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get($this->table)->result();
    }

    /**
     * Get related programs
     */
    public function get_related_programs($jenjang, $exclude_id, $limit = 4)
    {
        return $this->db->select('id, kode_prodi, nama_prodi, jenjang, gelar, slug, deskripsi, icon, warna, urutan')
            ->where('jenjang', $jenjang)
            ->where('id !=', $exclude_id)
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('nama_prodi', 'ASC')
            ->limit($limit)
            ->get($this->table)
            ->result();
    }

    /**
     * Increment view count (optional feature)
     */
    public function increment_view_count($id)
    {
        // You can add a view_count field to track popularity
        // For now, this is just a placeholder
        return true;
    }

    /**
     * Get filtered programs for AJAX
     */
    public function get_filtered_programs($jenjang = '', $keyword = '', $limit = 12, $offset = 0)
    {
        return $this->search_public($keyword, $jenjang, $limit, $offset);
    }

    /**
     * Count filtered programs for AJAX pagination
     */
    public function count_filtered_programs($jenjang = '', $keyword = '')
    {
        $this->db->where('status', 'aktif');
        $this->db->where('is_published', 1);
        $this->db->where('deleted_at IS NULL');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('nama_prodi', $keyword);
            $this->db->or_like('kode_prodi', $keyword);
            $this->db->or_like('deskripsi', $keyword);
            $this->db->or_like('gelar', $keyword);
            $this->db->group_end();
        }

        if (!empty($jenjang)) {
            $this->db->where('jenjang', $jenjang);
        }

        return $this->db->count_all_results($this->table);
    }

    /**
     * Get program studi untuk navbar dengan optimasi
     */
    public function get_navbar_prodi()
    {
        return $this->db->select('id, nama_prodi, jenjang, slug')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('deleted_at IS NULL')
            ->order_by('jenjang', 'ASC')
            ->order_by('nama_prodi', 'ASC')
            ->limit(20) // Batasi untuk performa navbar
            ->get($this->table)
            ->result();
    }
}
