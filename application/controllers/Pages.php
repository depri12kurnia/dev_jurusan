<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->model('M_menu_items');
        $this->load->model('M_menu_categories');
        $this->load->model('M_prodi');
    }

    /**
     * Show page by slug
     */
    public function show($slug)
    {
        $data['website'] = $this->M_settings->get_settings();
        $data['page_title'] = 'Jurusan';
        $data['program_studi_all'] = $this->M_prodi->get_all_active();
        $page = $this->M_menu_items->get_by_slug($slug);

        if (!$page) {
            show_404();
        }

        // Get navbar menu structure
        $data['navbar_menu'] = $this->M_menu_items->get_navbar_structure();
        $data['website'] = $this->M_settings->get_main_settings();

        // Page data
        $data['page'] = $page;
        $data['title'] = $page->meta_title ?: $page->title;
        $data['meta_description'] = $page->meta_description;

        // Breadcrumb
        $data['breadcrumb'] = [
            ['title' => 'Home', 'url' => base_url()],
            ['title' => $page->category_name, 'url' => '#'],
            ['title' => $page->title, 'url' => '']
        ];

        $this->load->view('frontend/page', $data);
    }

    /**
     * Show category pages
     */
    public function category($category_slug)
    {
        $data['website'] = $this->M_settings->get_settings();
        $data['page_title'] = 'Jurusan';
        $category = $this->M_menu_categories->get_by_slug($category_slug);

        if (!$category) {
            show_404();
        }

        $items = $this->M_menu_items->get_by_category_slug($category_slug);

        // Get navbar menu structure
        $data['navbar_menu'] = $this->M_menu_items->get_navbar_structure();
        $data['website'] = $this->M_settings->get_main_settings();

        // Category data
        $data['category'] = $category;
        $data['items'] = $items;
        $data['title'] = $category->name;
        $data['meta_description'] = 'Daftar halaman dalam kategori ' . $category->name;

        // Breadcrumb
        $data['breadcrumb'] = [
            ['title' => 'Home', 'url' => base_url()],
            ['title' => $category->name, 'url' => '']
        ];

        $this->load->view('frontend/category', $data);
    }

    /**
     * Search pages
     */
    public function search()
    {
        $keyword = $this->input->get('q');

        if (empty($keyword)) {
            redirect(base_url());
        }

        $results = $this->M_menu_items->search($keyword);

        // Get navbar menu structure
        $data['navbar_menu'] = $this->M_menu_items->get_navbar_structure();
        $data['website'] = $this->M_settings->get_main_settings();

        // Search data
        $data['keyword'] = $keyword;
        $data['results'] = $results;
        $data['total_results'] = count($results);
        $data['title'] = 'Hasil Pencarian: ' . $keyword;
        $data['meta_description'] = 'Hasil pencarian untuk kata kunci: ' . $keyword;

        // Breadcrumb
        $data['breadcrumb'] = [
            ['title' => 'Home', 'url' => base_url()],
            ['title' => 'Pencarian', 'url' => '']
        ];

        $this->load->view('frontend/search', $data);
    }
}
