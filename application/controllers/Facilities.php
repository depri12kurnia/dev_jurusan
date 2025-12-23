<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facilities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_facilities', 'M_settings']);
        $this->load->model('M_prodi', 'm_prodi'); // For navbar compatibility
        $this->load->library(['pagination']);
        $this->load->helper(['url', 'text', 'form', 'date']);
    }

    /**
     * Facilities listing page
     */
    public function index($page = 0)
    {
        $per_page = 9; // Facilities per page
        $offset = $page;

        // Get total count for pagination
        $total_facilities = $this->M_facilities->count_all_active();

        // Configure pagination
        $config = [
            'base_url' => site_url('facilities/page/'),
            'total_rows' => $total_facilities,
            'per_page' => $per_page,
            'uri_segment' => 3,
            'use_page_numbers' => FALSE,
            'full_tag_open' => '<nav aria-label="Facilities pagination"><ul class="pagination justify-content-center">',
            'full_tag_close' => '</ul></nav>',
            'first_link' => 'First',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'last_link' => 'Last',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'next_link' => 'Next &raquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'prev_link' => '&laquo; Previous',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '</span></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link']
        ];

        $this->pagination->initialize($config);

        // Get facilities data with pagination
        if (method_exists($this->M_facilities, 'get_all_active_paginated')) {
            $data['facilities'] = $this->M_facilities->get_all_active_paginated($per_page, $offset);
        } else {
            // Fallback: Use existing method and manual pagination
            $all_facilities = $this->M_facilities->get_all_active();
            $data['facilities'] = array_slice($all_facilities, $offset, $per_page);
        }
        $data['pagination'] = $this->pagination->create_links();
        $data['total_facilities'] = $total_facilities;
        $data['current_page'] = ($offset / $per_page) + 1;
        $data['total_pages'] = ceil($total_facilities / $per_page);

        // Get categories for filter
        $data['categories'] = $this->M_facilities->get_categories();

        // Get featured facilities for sidebar
        $data['featured_facilities'] = $this->M_facilities->get_featured_facilities(5);

        // Website settings
        $data['website'] = $this->M_settings->get_settings();
        $data['title'] = 'Fasilitas & Sarana';
        $data['meta_description'] = 'Fasilitas lengkap dan modern untuk mendukung proses pembelajaran dan praktik mahasiswa';

        // Data untuk navbar
        $data['program_studi_all'] = $this->m_prodi->get_all_active(10);
        $data['facility_categories'] = $data['categories'];

        $data['content'] = 'paneluser/facilities/index';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Facility detail page
     */
    public function detail($slug)
    {
        if (empty($slug)) {
            show_404();
        }

        // Get facility by slug
        $facility = $this->M_facilities->get_by_slug($slug);

        if (!$facility || $facility->status !== 'Active') {
            show_404();
        }

        // Get facility highlights
        $data['facility_highlights'] = $this->M_facilities->get_facility_highlights($facility->id);

        // Get facility specifications
        $data['facility_specifications'] = $this->M_facilities->get_facility_specifications($facility->id);

        // Get related facilities (same category)
        $data['related_facilities'] = $this->M_facilities->get_related($facility->id, $facility->category_id, 4);

        // Get featured facilities for sidebar
        $data['featured_facilities'] = $this->M_facilities->get_featured_facilities(5);

        $data['facility'] = $facility;
        $data['website'] = $this->M_settings->get_settings();
        $data['title'] = $facility->title;
        $data['meta_description'] = !empty($facility->description) ? character_limiter($facility->description, 160) : character_limiter(strip_tags($facility->content), 160);

        // Data untuk navbar
        $data['program_studi_all'] = $this->m_prodi->get_all_active(10);
        $data['facility_categories'] = $this->M_facilities->get_categories();

        $data['content'] = 'paneluser/facilities/detail';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Facilities by category
     */
    public function category($category_slug = null, $page = 0)
    {
        if (empty($category_slug)) {
            show_404();
        }

        // Get category info
        $category = $this->M_facilities->get_category_by_slug($category_slug);

        if (!$category) {
            show_404();
        }

        $per_page = 9;
        $offset = $page;

        // Get total count for this category
        $total_facilities = $this->M_facilities->count_by_category($category->id);

        // Configure pagination
        $config = [
            'base_url' => site_url('facilities/category/' . $category_slug . '/'),
            'total_rows' => $total_facilities,
            'per_page' => $per_page,
            'uri_segment' => 4,
            'use_page_numbers' => FALSE,
            'full_tag_open' => '<nav aria-label="Facilities pagination"><ul class="pagination justify-content-center">',
            'full_tag_close' => '</ul></nav>',
            'first_link' => 'First',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'last_link' => 'Last',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'next_link' => 'Next &raquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'prev_link' => '&laquo; Previous',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '</span></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link']
        ];

        $this->pagination->initialize($config);

        // Get URL parameters for sorting and view
        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'newest';
        $per_page_param = $this->input->get('per_page') ? (int)$this->input->get('per_page') : $per_page;
        $view = $this->input->get('view') ? $this->input->get('view') : 'grid';

        // Get facilities data for this category
        $data['facilities'] = $this->M_facilities->get_by_category_paginated($category->id, $per_page_param, $offset, $sort);
        $data['pagination'] = $this->pagination->create_links();
        $data['category'] = $category;
        $data['total_facilities'] = $total_facilities;
        $data['current_page'] = ($offset / $per_page_param) + 1;
        $data['total_pages'] = ceil($total_facilities / $per_page_param);

        // Get featured count for this category
        $data['featured_count'] = $this->M_facilities->count_featured_by_category($category->id);

        // Add sort, per_page, and view parameters to data
        $data['sort'] = $sort;
        $data['per_page'] = $per_page_param;
        $data['view'] = $view;

        // Get all categories for filter (exclude current category)
        $data['categories'] = $this->M_facilities->get_categories();
        $data['other_categories'] = array_filter($data['categories'], function ($cat) use ($category) {
            return $cat->id != $category->id;
        });

        // Get featured facilities for sidebar
        $data['featured_facilities'] = $this->M_facilities->get_featured_facilities(5);

        // Website settings
        $data['website'] = $this->M_settings->get_settings();
        $data['title'] = 'Fasilitas ' . $category->name;
        $data['meta_description'] = 'Fasilitas dan sarana terkait ' . $category->name;

        // Data untuk navbar
        $data['program_studi_all'] = $this->m_prodi->get_all_active(10);
        $data['facility_categories'] = $data['categories'];

        $data['content'] = 'paneluser/facilities/category';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Search facilities
     */
    public function search()
    {
        $keyword = $this->input->get('q', TRUE);

        if (empty($keyword)) {
            redirect('facilities');
        }

        $per_page = 9;
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 0;
        $offset = $page;

        // Search facilities 
        $search_results = $this->M_facilities->search_facilities($keyword, null, $per_page);
        $all_results = $this->M_facilities->search_facilities($keyword, null, 0);
        $total_results = count($all_results);

        // Configure pagination for search
        $config = [
            'base_url' => site_url('facilities/search?q=' . urlencode($keyword) . '&page='),
            'total_rows' => $total_results,
            'per_page' => $per_page,
            'page_query_string' => TRUE,
            'query_string_segment' => 'page',
            'use_page_numbers' => FALSE,
            'full_tag_open' => '<nav aria-label="Search pagination"><ul class="pagination justify-content-center">',
            'full_tag_close' => '</ul></nav>',
            'first_link' => 'First',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'last_link' => 'Last',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'next_link' => 'Next &raquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'prev_link' => '&laquo; Previous',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '</span></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link']
        ];

        $this->pagination->initialize($config);

        $data['facilities'] = $search_results;
        $data['pagination'] = $this->pagination->create_links();
        $data['keyword'] = $keyword;
        $data['total_results'] = $total_results;
        $data['current_page'] = ($offset / $per_page) + 1;
        $data['total_pages'] = ceil($total_results / $per_page);

        // Get categories for filter
        $data['categories'] = $this->M_facilities->get_categories();

        // Website settings
        $data['website'] = $this->M_settings->get_settings();
        $data['title'] = 'Pencarian Fasilitas: ' . $keyword;
        $data['meta_description'] = 'Hasil pencarian fasilitas untuk kata kunci: ' . $keyword;

        // Data untuk navbar
        $data['program_studi_all'] = $this->m_prodi->get_all_active(10);
        $data['facility_categories'] = $data['categories'];

        $data['content'] = 'paneluser/facilities/search';
        $this->load->view('layouts/user_layout', $data);
    }
}
