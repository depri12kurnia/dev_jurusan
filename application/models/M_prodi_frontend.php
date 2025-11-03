<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_prodi_frontend extends CI_Model
{
    // Get jenjang statistics
    public function get_jenjang_stats($jenjang)
    {
        // Total programs
        $total_programs = $this->db->where('jenjang', $jenjang)
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->count_all_results('program_studi');

        // Featured programs
        $featured_programs = $this->db->where('jenjang', $jenjang)
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('is_featured', 1)
            ->count_all_results('program_studi');

        // Accredited A programs
        $accredited_a = $this->db->where('jenjang', $jenjang)
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('akreditasi', 'A')
            ->count_all_results('program_studi');

        // Total students and alumni
        $student_stats = $this->db->select('
                                   COUNT(CASE WHEN mahasiswa.status = "aktif" THEN 1 END) as total_students,
                                   COUNT(CASE WHEN mahasiswa.status = "lulus" THEN 1 END) as total_alumni
                               ')
            ->from('program_studi')
            ->join('mahasiswa', 'mahasiswa.kode_prodi = program_studi.kode_prodi', 'left')
            ->where('program_studi.jenjang', $jenjang)
            ->where('program_studi.status', 'aktif')
            ->where('program_studi.is_published', 1)
            ->get()
            ->row();

        return array(
            'total_programs' => $total_programs,
            'featured_programs' => $featured_programs,
            'accredited_a' => $accredited_a,
            'total_students' => $student_stats->total_students ?? 0,
            'total_alumni' => $student_stats->total_alumni ?? 0
        );
    }

    // Get programs by jenjang with filtering and sorting (enhanced version)
    public function get_by_jenjang_filtered($jenjang, $filters = array())
    {
        $this->db->select('program_studi.*, 
                          COUNT(DISTINCT mahasiswa.id) as jumlah_mahasiswa_aktif,
                          COUNT(DISTINCT alumni.id) as jumlah_alumni')
            ->from('program_studi')
            ->join('mahasiswa', 'mahasiswa.kode_prodi = program_studi.kode_prodi AND mahasiswa.status = "aktif"', 'left')
            ->join('mahasiswa as alumni', 'alumni.kode_prodi = program_studi.kode_prodi AND alumni.status = "lulus"', 'left')
            ->where('program_studi.jenjang', $jenjang)
            ->where('program_studi.status', 'aktif')
            ->where('program_studi.is_published', 1);

        // Apply filters
        if (!empty($filters['tab'])) {
            switch ($filters['tab']) {
                case 'unggulan':
                    $this->db->where('program_studi.is_featured', 1);
                    break;
                case 'akreditasi':
                    $this->db->where('program_studi.akreditasi', 'A');
                    break;
                case 'terbaru':
                    $this->db->where('program_studi.created_at >=', date('Y-m-d', strtotime('-6 months')));
                    break;
            }
        }

        $this->db->group_by('program_studi.id');

        // Apply sorting
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'nama_desc':
                    $this->db->order_by('program_studi.nama_prodi', 'DESC');
                    break;
                case 'akreditasi_desc':
                    $this->db->order_by('FIELD(program_studi.akreditasi, "A", "B", "C", "")', 'ASC');
                    break;
                case 'created_desc':
                    $this->db->order_by('program_studi.created_at', 'DESC');
                    break;
                default:
                    $this->db->order_by('program_studi.nama_prodi', 'ASC');
            }
        } else {
            $this->db->order_by('program_studi.nama_prodi', 'ASC');
        }

        // Apply pagination
        if (!empty($filters['limit'])) {
            $this->db->limit($filters['limit'], $filters['offset'] ?? 0);
        }

        return $this->db->get()->result();
    }

    // Get search filters data
    public function get_search_filters()
    {
        // Jenjang list with counts
        $jenjang_list = $this->db->select('jenjang, COUNT(*) as count')
            ->from('program_studi')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->group_by('jenjang')
            ->order_by('jenjang', 'ASC')
            ->get()
            ->result();

        // Akreditasi list with counts
        $akreditasi_list = $this->db->select('akreditasi, COUNT(*) as count')
            ->from('program_studi')
            ->where('status', 'aktif')
            ->where('is_published', 1)
            ->where('akreditasi !=', '')
            ->group_by('akreditasi')
            ->order_by('FIELD(akreditasi, "A", "B", "C")', 'ASC')
            ->get()
            ->result();

        return array(
            'jenjang_list' => $jenjang_list,
            'akreditasi_list' => $akreditasi_list
        );
    }

    // Count search results
    public function count_search_results($query = '', $filters = array())
    {
        $this->_build_search_query($query, $filters);
        return $this->db->count_all_results('program_studi');
    }

    // Advanced search with filters
    public function search_advanced($query = '', $filters = array(), $limit = 12, $offset = 0)
    {
        $this->_build_search_query($query, $filters);

        $this->db->limit($limit, $offset);

        // Apply sorting
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'nama_desc':
                    $this->db->order_by('nama_prodi', 'DESC');
                    break;
                case 'jenjang_asc':
                    $this->db->order_by('jenjang', 'ASC');
                    break;
                case 'akreditasi_desc':
                    $this->db->order_by('FIELD(akreditasi, "A", "B", "C", "")', 'ASC');
                    break;
                default:
                    $this->db->order_by('nama_prodi', 'ASC');
            }
        } else {
            // Default relevance sorting for search results
            if (!empty($query)) {
                $this->db->order_by('is_featured', 'DESC');
                $this->db->order_by('FIELD(akreditasi, "A", "B", "C", "")', 'ASC');
            }
            $this->db->order_by('nama_prodi', 'ASC');
        }

        return $this->db->get()->result();
    }

    // Private method to build search query
    private function _build_search_query($query = '', $filters = array())
    {
        $this->db->select('program_studi.*, 
                          COUNT(DISTINCT mahasiswa.id) as jumlah_mahasiswa_aktif,
                          COUNT(DISTINCT alumni.id) as jumlah_alumni')
            ->from('program_studi')
            ->join('mahasiswa', 'mahasiswa.kode_prodi = program_studi.kode_prodi AND mahasiswa.status = "aktif"', 'left')
            ->join('mahasiswa as alumni', 'alumni.kode_prodi = program_studi.kode_prodi AND alumni.status = "lulus"', 'left')
            ->where('program_studi.status', 'aktif')
            ->where('program_studi.is_published', 1);

        // Search query
        if (!empty($query)) {
            $this->db->group_start();
            $this->db->like('program_studi.nama_prodi', $query);
            $this->db->or_like('program_studi.deskripsi', $query);
            $this->db->or_like('program_studi.gelar', $query);
            $this->db->or_like('program_studi.prospek_karir', $query);
            $this->db->group_end();
        }

        // Jenjang filter
        if (!empty($filters['jenjang'])) {
            if (is_array($filters['jenjang'])) {
                $this->db->where_in('program_studi.jenjang', $filters['jenjang']);
            } else {
                $this->db->where('program_studi.jenjang', $filters['jenjang']);
            }
        }

        // Akreditasi filter
        if (!empty($filters['akreditasi'])) {
            if (is_array($filters['akreditasi'])) {
                $this->db->where_in('program_studi.akreditasi', $filters['akreditasi']);
            } else {
                $this->db->where('program_studi.akreditasi', $filters['akreditasi']);
            }
        }

        // Unggulan filter
        if (!empty($filters['unggulan'])) {
            $this->db->where('program_studi.is_featured', 1);
        }

        $this->db->group_by('program_studi.id');
    }
}
