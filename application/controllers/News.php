<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_news');
        $this->load->model('M_settings');
        $this->load->model('M_prodi'); // For navbar compatibility
        $this->load->library(['pagination']);
        $this->load->helper(['url', 'text', 'form', 'date']);
    }

    /**
     * News listing page
     */
    public function index($page = 0)
    {
        $per_page = 9; // News per page
        $offset = $page;

        // Get total count for pagination
        $total_news = $this->M_news->count_published_news();

        // Configure pagination
        $config = [
            'base_url' => site_url('news/page/'),
            'total_rows' => $total_news,
            'per_page' => $per_page,
            'uri_segment' => 3,
            'use_page_numbers' => FALSE,
            'full_tag_open' => '<nav aria-label="News pagination"><ul class="pagination justify-content-center">',
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

        // Get news data
        $data['news'] = $this->M_news->get_published_news($per_page, $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['total_news'] = $total_news;
        $data['current_page'] = ($offset / $per_page) + 1;
        $data['total_pages'] = ceil($total_news / $per_page);

        // Get categories for filter
        $data['categories'] = $this->M_news->get_category();

        // Get popular news for sidebar
        $data['popular_news'] = $this->M_news->get_popular_news(5);

        // Get latest news for sidebar
        $data['latest_news'] = $this->M_news->get_latest_news(5);

        // Website settings
        $data['website'] = $this->M_settings->get_settings();

        $data['title'] = 'Berita & Kegiatan';
        $data['meta_description'] = 'Update terbaru seputar kegiatan akademik, praktik klinik, dan prestasi mahasiswa';

        // Data untuk navbar
        $data['program_studi_all'] = $this->M_prodi->get_all_active();

        $data['content'] = 'paneluser/news/index';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * News detail page
     */
    public function detail($slug)
    {
        if (empty($slug)) {
            show_404();
        }

        // Get news by slug
        $news = $this->M_news->get_by_slug($slug);

        if (!$news || $news->status !== 'published') {
            show_404();
        }

        // Auto increment views - SIMPLE!
        $this->M_news->increment_views($news->id);

        // Get related news
        $data['related_news'] = $this->M_news->get_related_news($news->category_id, $news->id, 4);

        // Get popular news for sidebar
        $data['popular_news'] = $this->M_news->get_popular_news(5);

        $data['news'] = $news;
        $data['website'] = $this->M_settings->get_settings();
        $data['title'] = $news->title;
        $data['meta_description'] = !empty($news->excerpt) ? character_limiter($news->excerpt, 160) : character_limiter(strip_tags($news->content), 160);

        // Data untuk navbar
        $data['program_studi_all'] = $this->M_prodi->get_all_active(10);

        $data['content'] = 'paneluser/news/detail';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * News by category
     */
    public function category($category_slug, $page = 0)
    {
        if (empty($category_slug)) {
            show_404();
        }

        // Get category info
        $category = $this->M_news->get_category_by_slug($category_slug);

        if (!$category) {
            show_404();
        }

        $per_page = 9;
        $offset = $page;

        // Get total count for this category
        $total_news = $this->M_news->count_news_by_category($category->id);

        // Configure pagination
        $config = [
            'base_url' => site_url('news/category/' . $category_slug . '/'),
            'total_rows' => $total_news,
            'per_page' => $per_page,
            'uri_segment' => 4,
            'use_page_numbers' => FALSE,
            'full_tag_open' => '<nav aria-label="News pagination"><ul class="pagination justify-content-center">',
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

        // Get news data for this category
        $data['news'] = $this->M_news->get_news_by_category_paginated($category->id, $per_page, $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['category'] = $category;
        $data['total_news'] = $total_news;
        $data['current_page'] = ($offset / $per_page) + 1;
        $data['total_pages'] = ceil($total_news / $per_page);

        // Get all categories for filter
        $data['categories'] = $this->M_news->get_category();

        // Get popular news for sidebar
        $data['popular_news'] = $this->M_news->get_popular_news(5);

        // Website settings
        $data['website'] = $this->M_settings->get_settings();
        $data['title'] = 'Berita ' . $category->name;
        $data['meta_description'] = 'Berita dan kegiatan terkait ' . $category->name;

        // Data untuk navbar
        $data['program_studi_all'] = $this->M_prodi->get_all_active(10);

        $data['content'] = 'paneluser/news/category';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Search news
     */
    public function search()
    {
        $keyword = $this->input->get('q');
        $page = (int)$this->input->get('page', TRUE) ?: 0;
        $per_page = 9;

        if (empty($keyword)) {
            redirect('news');
        }

        // Get total count for search results
        $total_news = $this->M_news->count_search_results($keyword);

        // Configure pagination
        $config = [
            'base_url' => site_url('news/search?q=' . urlencode($keyword) . '&page='),
            'total_rows' => $total_news,
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

        // Get search results
        $data['news'] = $this->M_news->search_news_paginated($keyword, $per_page, $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['keyword'] = $keyword;
        $data['total_news'] = $total_news;
        $data['current_page'] = ($page / $per_page) + 1;
        $data['total_pages'] = ceil($total_news / $per_page);

        // Get categories for filter
        $data['categories'] = $this->M_news->get_category();

        // Get popular news for sidebar
        $data['popular_news'] = $this->M_news->get_popular_news(5);

        // Website settings
        $data['website'] = $this->M_settings->get_settings();
        $data['title'] = 'Pencarian: ' . $keyword;
        $data['meta_description'] = 'Hasil pencarian berita untuk: ' . $keyword;

        // Data untuk navbar
        $data['program_studi_all'] = $this->M_prodi->get_all_active(10);

        $data['content'] = 'paneluser/news/search';
        $this->load->view('layouts/user_layout', $data);
    }

    // =========================
    // API METHODS FOR AJAX CALLS
    // =========================

    /**
     * Get latest news (JSON)
     */
    public function get_latest_news($limit = 5)
    {
        $news = $this->M_news->get_latest_news($limit);

        $result = [];
        foreach ($news as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'excerpt' => !empty($item->excerpt) ? $item->excerpt : character_limiter(strip_tags($item->content), 150),
                'thumbnail' => !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg'),
                'category' => $item->category_name,
                'author' => $item->author_name,
                'published_at' => $item->published_at,
                'views' => $item->views,
                'url' => site_url('news/' . $item->slug)
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $result,
                'count' => count($result)
            ]));
    }

    /**
     * Get featured news (JSON)
     */
    public function get_featured_news($limit = 3)
    {
        $news = $this->M_news->get_featured_news($limit);

        $result = [];
        foreach ($news as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'excerpt' => !empty($item->excerpt) ? $item->excerpt : character_limiter(strip_tags($item->content), 150),
                'thumbnail' => !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg'),
                'category' => $item->category_name,
                'author' => $item->author_name,
                'published_at' => $item->published_at,
                'views' => $item->views,
                'url' => site_url('news/' . $item->slug)
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $result,
                'count' => count($result)
            ]));
    }

    /**
     * Get popular news (JSON)
     */
    public function get_popular_news($limit = 5)
    {
        $news = $this->M_news->get_popular_news($limit);

        $result = [];
        foreach ($news as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'excerpt' => !empty($item->excerpt) ? $item->excerpt : character_limiter(strip_tags($item->content), 150),
                'thumbnail' => !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg'),
                'category' => $item->category_name,
                'author' => $item->author_name,
                'published_at' => $item->published_at,
                'views' => $item->views,
                'url' => site_url('news/' . $item->slug)
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $result,
                'count' => count($result)
            ]));
    }

    /**
     * Widget API for embedding news
     */
    public function widget($type = 'latest', $limit = 5)
    {
        switch ($type) {
            case 'featured':
                $news = $this->M_news->get_featured_news($limit);
                break;
            case 'popular':
                $news = $this->M_news->get_popular_news($limit);
                break;
            case 'latest':
            default:
                $news = $this->M_news->get_latest_news($limit);
                break;
        }

        $result = [];
        foreach ($news as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'excerpt' => !empty($item->excerpt) ? $item->excerpt : character_limiter(strip_tags($item->content), 120),
                'thumbnail' => !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg'),
                'category' => $item->category_name,
                'author' => $item->author_name,
                'published_at' => $item->published_at,
                'views' => $item->views ?? 0,
                'url' => site_url('news/' . $item->slug)
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $result,
                'count' => count($result),
                'type' => $type
            ]));
    }

    /**
     * Get news by category (JSON)
     */
    public function get_news_by_category($category_id, $limit = 10)
    {
        $news = $this->M_news->get_news_by_category($category_id, $limit);

        $result = [];
        foreach ($news as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'excerpt' => !empty($item->excerpt) ? $item->excerpt : character_limiter(strip_tags($item->content), 150),
                'thumbnail' => !empty($item->thumbnail) ? base_url('public/uploads/news/' . $item->thumbnail) : base_url('public/img/default-news.jpg'),
                'category' => $item->category_name,
                'author' => $item->author_name,
                'published_at' => $item->published_at,
                'views' => $item->views,
                'url' => site_url('news/' . $item->slug)
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $result,
                'count' => count($result)
            ]));
    }

    /**
     * Get public statistics (JSON)
     */
    public function get_stats()
    {
        $stats = $this->M_news->get_public_statistics();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'data' => $stats
            ]));
    }
}
