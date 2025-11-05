<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_studi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_prodi', 'm_prodi');
        $this->load->model('M_prodi_frontend', 'm_prodi_frontend');
        $this->load->helper(['url', 'text']);
    }

    /**
     * Halaman daftar semua program studi
     */
    public function index()
    {
        // Load data dengan limit untuk performa lebih baik - minimal query untuk load awal
        $prodi_list = $this->m_prodi->get_public_list(8); // Kurangi limit untuk load lebih cepat
        $stats = $this->m_prodi->get_public_statistics();

        // Load data tambahan
        $prodi_featured = $this->m_prodi->get_featured_programs(6); // Load program unggulan
        $jenjang_list = $this->m_prodi->get_jenjang_list(); // Get dari database dengan count

        $data = array(
            'title' => 'Program Studi',
            'meta_description' => 'Daftar Program Studi yang tersedia di institusi kami',
            'meta_keywords' => 'program studi, jurusan, pendidikan, kuliah',
            'prodi_list' => $prodi_list,
            'prodi_featured' => $prodi_featured,
            'stats' => $stats,
            'jenjang_list' => $jenjang_list,
            'program_studi_all' => $this->m_prodi->get_all_active() // Untuk navbar
        );

        $data['content'] = 'paneluser/program_studi/index';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Halaman detail program studi berdasarkan slug
     */
    public function detail($slug = '')
    {
        if (empty($slug)) {
            show_404();
        }

        $prodi = $this->m_prodi->get_by_slug($slug);

        if (!$prodi) {
            show_404();
        }

        // Update view count (optional)
        $this->m_prodi->increment_view_count($prodi->id);

        // Get related programs (same jenjang, exclude current)
        $related_programs = $this->m_prodi->get_related_programs($prodi->jenjang, $prodi->id, 4);

        $data = array(
            'title' => $prodi->nama_prodi,
            'meta_description' => $prodi->deskripsi ? character_limiter(strip_tags($prodi->deskripsi), 160) : 'Program Studi ' . $prodi->nama_prodi,
            'meta_keywords' => $prodi->nama_prodi . ', ' . $prodi->jenjang . ', ' . $prodi->kode_prodi,
            'prodi' => $prodi,
            'related_programs' => $related_programs,
            'breadcrumb' => array(
                'Program Studi' => site_url('program-studi'),
                $prodi->nama_prodi => ''
            )
        );

        $data['content'] = 'paneluser/program_studi/detail';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Filter program studi berdasarkan jenjang
     */
    public function jenjang($jenjang = '')
    {
        if (empty($jenjang)) {
            redirect('program-studi');
        }

        // Convert URL friendly to database format
        $jenjang_mapping = array(
            'diploma' => 'D3',
            'sarjana' => 'S1',
            'magister' => 'S2',
            'doktor' => 'S3'
        );

        $jenjang_lower = strtolower($jenjang);
        $db_jenjang = isset($jenjang_mapping[$jenjang_lower]) ? $jenjang_mapping[$jenjang_lower] : strtoupper($jenjang);

        $valid_jenjang = ['D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3', 'PROFESI'];

        if (!in_array($db_jenjang, $valid_jenjang)) {
            show_404();
        }

        // Get filters from URL
        $tab = $this->input->get('tab') ?: 'semua';
        $sort = $this->input->get('sort') ?: 'nama_asc';

        // Get programs with filters
        $filters = array(
            'tab' => $tab,
            'sort' => $sort,
            'limit' => 12,
            'offset' => 0
        );

        $programs = $this->m_prodi_frontend->get_by_jenjang_filtered($db_jenjang, $filters);
        $stats = $this->m_prodi_frontend->get_jenjang_stats($db_jenjang);

        // Check if there are more programs
        $total_programs = $stats['total_programs'];
        $has_more = count($programs) < $total_programs;

        // Get jenjang description
        $jenjang_descriptions = array(
            'D3' => 'Program Diploma adalah pendidikan vokasi yang memberikan keahlian khusus dalam bidang tertentu',
            'S1' => 'Program Sarjana (S1) memberikan pendidikan akademik yang komprehensif dengan gelar sarjana',
            'S2' => 'Program Magister (S2) adalah jenjang pendidikan lanjutan setelah sarjana',
            'S3' => 'Program Doktor (S3) adalah jenjang tertinggi dalam pendidikan formal'
        );

        $data = array(
            'title' => 'Program Studi ' . $db_jenjang,
            'meta_description' => 'Daftar Program Studi jenjang ' . $db_jenjang,
            'meta_keywords' => 'program studi ' . $db_jenjang . ', jurusan ' . $db_jenjang,
            'jenjang' => $db_jenjang,
            'jenjang_description' => $jenjang_descriptions[$db_jenjang] ?? 'Program studi ' . $db_jenjang,
            'active_tab' => $tab,
            'sort' => $sort,
            'programs' => $programs,
            'stats' => $stats,
            'total_programs' => $total_programs,
            'has_more_programs' => $has_more,
            'all_jenjang' => $this->m_prodi->get_jenjang_list(),
            'breadcrumb' => array(
                'Program Studi' => site_url('program-studi'),
                'Jenjang ' . $db_jenjang => ''
            )
        );

        $data['content'] = 'paneluser/program_studi/jenjang';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Pencarian program studi
     */
    public function search()
    {
        $keyword = $this->input->get('q', TRUE);
        $jenjang = $this->input->get('jenjang', TRUE);

        if (empty($keyword) && empty($jenjang)) {
            redirect('program-studi');
        }

        $results = $this->m_prodi->search_public($keyword, $jenjang);

        $data = array(
            'title' => 'Pencarian Program Studi',
            'meta_description' => 'Hasil pencarian program studi',
            'keyword' => $keyword,
            'jenjang_filter' => $jenjang,
            'results' => $results,
            'total_results' => count($results),
            'jenjang_list' => $this->m_prodi->get_jenjang_list(),
            'breadcrumb' => array(
                'Program Studi' => site_url('program-studi'),
                'Pencarian' => ''
            )
        );

        $data['content'] = 'paneluser/program_studi/search';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * API untuk mendapatkan data program studi (AJAX)
     */
    public function ajax_get_programs()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $jenjang = $this->input->post('jenjang');
        $keyword = $this->input->post('keyword');
        $limit = (int) $this->input->post('limit') ?: 12;
        $offset = (int) $this->input->post('offset') ?: 0;

        $programs = $this->m_prodi->get_filtered_programs($jenjang, $keyword, $limit, $offset);
        $total = $this->m_prodi->count_filtered_programs($jenjang, $keyword);

        $response = array(
            'status' => 'success',
            'data' => $programs,
            'total' => $total,
            'has_more' => ($offset + $limit) < $total
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * Halaman program unggulan/featured
     */
    public function unggulan()
    {
        $data = array(
            'title' => 'Program Studi Unggulan',
            'meta_description' => 'Program Studi Unggulan yang menjadi kebanggaan institusi',
            'meta_keywords' => 'program unggulan, program favorit, program studi terbaik',
            'prodi_featured' => $this->m_prodi->get_featured_programs(),
            'breadcrumb' => array(
                'Program Studi' => site_url('program-studi'),
                'Program Unggulan' => ''
            )
        );

        $data['content'] = 'paneluser/program_studi/unggulan';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * AJAX Load More untuk lazy loading
     */
    public function ajax_load_more()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $offset = (int) $this->input->post('offset') ?: 0;
        $limit = (int) $this->input->post('limit') ?: 8;

        $programs = $this->m_prodi->get_public_list($limit, $offset);

        $response = array(
            'status' => 'success',
            'programs' => $programs,
            'count' => count($programs)
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
