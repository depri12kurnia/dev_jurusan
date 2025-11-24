<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get total count of all news
     */
    public function count_all_news()
    {
        // Check if table exists first
        if (!$this->db->table_exists('news')) {
            return 0;
        }
        return $this->db->count_all('news');
    }

    /**
     * Get total count of all program studi
     */
    public function count_all_prodi()
    {
        // Check if table exists first
        if (!$this->db->table_exists('program_studi')) {
            return 0;
        }
        return $this->db->count_all('program_studi');
    }

    /**
     * Get total count of all departments/jurusan
     */
    public function count_all_departments()
    {
        // Check if program_studi table exists first
        if (!$this->db->table_exists('program_studi')) {
            return 0;
        }

        // Check if departments table exists
        if ($this->db->table_exists('departments')) {
            return $this->db->count_all('departments');
        }

        // Fallback: count distinct jenjang from program_studi table as departments
        try {
            $this->db->select('DISTINCT jenjang');
            $this->db->from('program_studi');
            $this->db->where('jenjang IS NOT NULL');
            $this->db->where('jenjang !=', '');
            $this->db->where('status', 'aktif');
            return $this->db->count_all_results();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Get today's visitors count (simulated for now)
     * Replace with actual visitor tracking logic
     */
    public function get_today_visitors()
    {
        // Check if visitors table exists
        if ($this->db->table_exists('visitors')) {
            $this->db->select('COUNT(*) as count');
            $this->db->from('visitors');
            $this->db->where('DATE(visit_date)', date('Y-m-d'));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row()->count;
            }
        }

        // Fallback: simulate visitor count
        return rand(50, 200);
    }

    /**
     * Get news published today
     */
    public function get_today_news($limit = 5)
    {
        $this->db->select('n.*, nc.name as category_name');
        $this->db->from('news n');
        $this->db->join('category nc', 'n.category_id = nc.id', 'left');
        $this->db->where('DATE(n.published_at)', date('Y-m-d'));
        $this->db->where('n.status', 'published');
        $this->db->order_by('n.published_at', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get all program studi with statistics
     */
    public function get_all_prodi_with_stats($limit = 5)
    {
        // Check if jumlah_mahasiswa_aktif column exists and has data
        $this->db->select('p.*, COALESCE(p.jumlah_mahasiswa_aktif, 0) as total_mahasiswa');
        $this->db->from('program_studi p');
        $this->db->where('p.status', 'aktif');
        $this->db->order_by('p.jumlah_mahasiswa_aktif', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();

        // If query successful, return results
        if ($query && $query->num_rows() > 0) {
            return $query->result();
        }

        // Fallback: get prodi without mahasiswa count constraint
        $this->db->select('*, 0 as total_mahasiswa');
        $this->db->from('program_studi');
        $this->db->limit($limit);

        $query = $this->db->get();
        $results = $query ? $query->result() : array();

        // Add simulated mahasiswa count if no real data
        foreach ($results as $result) {
            if (!isset($result->total_mahasiswa) || $result->total_mahasiswa == 0) {
                $result->total_mahasiswa = rand(20, 100);
            }
        }

        return $results;
    }

    /**
     * Get recent published news
     */
    public function get_recent_news($limit = 5)
    {
        $this->db->select('n.*, nc.name as category_name');
        $this->db->from('news n');
        $this->db->join('category nc', 'n.category_id = nc.id', 'left');
        $this->db->where('n.status', 'published');
        $this->db->order_by('n.published_at', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get dashboard statistics summary
     */
    public function get_dashboard_stats()
    {
        $stats = array();

        // Total berita
        $stats['total_berita'] = $this->count_all_news();

        // Total program studi
        $stats['total_prodi'] = $this->count_all_prodi();

        // Total jurusan
        $stats['total_jurusan'] = $this->count_all_departments();

        // Pengunjung hari ini
        $stats['pengunjung_hari_ini'] = $this->get_today_visitors();

        // Berita published (with error handling)
        if ($this->db->table_exists('news')) {
            $this->db->where('status', 'published');
            $stats['berita_published'] = $this->db->count_all_results('news');

            // Berita draft
            $this->db->where('status', 'draft');
            $stats['berita_draft'] = $this->db->count_all_results('news');
        } else {
            $stats['berita_published'] = 0;
            $stats['berita_draft'] = 0;
        }

        // Total fasilitas (if table exists)
        if ($this->db->table_exists('facilities')) {
            $stats['total_facilities'] = $this->db->count_all('facilities');
        } else {
            $stats['total_facilities'] = 0;
        }

        // Total SDM (if table exists)
        if ($this->db->table_exists('sdm') || $this->db->table_exists('staff')) {
            $table = $this->db->table_exists('sdm') ? 'sdm' : 'staff';
            $stats['total_sdm'] = $this->db->count_all($table);
        } else {
            $stats['total_sdm'] = 0;
        }

        return $stats;
    }

    /**
     * Get monthly news statistics
     */
    public function get_monthly_news_stats()
    {
        $this->db->select('MONTH(published_at) as month, COUNT(*) as count');
        $this->db->from('news');
        $this->db->where('YEAR(published_at)', date('Y'));
        $this->db->where('status', 'published');
        $this->db->group_by('MONTH(published_at)');
        $this->db->order_by('month', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get popular program studi based on news/content
     */
    public function get_popular_prodi($limit = 3)
    {
        // Try to get prodi with most related news
        $this->db->select('p.*, COUNT(n.id) as news_count');
        $this->db->from('program_studi p');
        $this->db->join('news n', 'FIND_IN_SET(p.id, n.related_prodi) > 0', 'left');
        $this->db->where('p.status', 'aktif');
        $this->db->group_by('p.id');
        $this->db->order_by('news_count', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();

        // If no related_prodi field, just get active prodi
        if ($query->num_rows() == 0) {
            $this->db->select('*');
            $this->db->from('program_studi');
            $this->db->where('status', 'aktif');
            $this->db->order_by('nama_prodi', 'ASC');
            $this->db->limit($limit);

            $query = $this->db->get();
        }

        return $query->result();
    }

    /**
     * Get system information
     */
    public function get_system_info()
    {
        $info = array();
        $info['server_time'] = date('Y-m-d H:i:s');
        $info['php_version'] = PHP_VERSION;
        $info['ci_version'] = CI_VERSION;
        $info['database_version'] = $this->db->version();

        return $info;
    }

    /**
     * Get content summary for admin
     */
    public function get_content_summary()
    {
        $summary = array();

        // News summary
        $summary['news'] = array(
            'total' => $this->count_all_news(),
            'published' => $this->db->where('status', 'published')->count_all_results('news'),
            'draft' => $this->db->where('status', 'draft')->count_all_results('news'),
            'today' => $this->db->where('DATE(published_at)', date('Y-m-d'))->count_all_results('news')
        );

        // Prodi summary
        $summary['prodi'] = array(
            'total' => $this->count_all_prodi(),
            'active' => $this->db->where('status', 'aktif')->count_all_results('program_studi'),
            'inactive' => $this->db->where('status !=', 'aktif')->count_all_results('program_studi')
        );

        return $summary;
    }
}
