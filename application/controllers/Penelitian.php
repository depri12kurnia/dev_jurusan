<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penelitian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_menu_items', 'm_menu_items');
        $this->load->model('M_settings', 'm_settings');
        $this->load->model('M_prodi', 'm_prodi');
    }

    /**
     * Show specific penelitian page by slug
     */
    public function index($slug = null)
    {
        $data['website'] = $this->m_settings->get_settings();
        $data['program_studi_all'] = $this->m_prodi->get_all_active();

        if (!$slug) {
            // If no slug provided, show penelitian overview or redirect
            redirect('/');
        }

        // Get the menu item by slug from penelitian category
        $item = $this->m_menu_items->get_by_slug($slug);

        if (!$item || $item->category_slug !== 'penelitian-pengabmas') {
            show_404();
        }

        // Load data for the view
        $data['item'] = $item;
        $data['page_title'] = $item->title;
        $data['meta_title'] = $item->meta_title ?: $item->title;
        $data['meta_description'] = $item->meta_description ?: strip_tags(substr($item->content, 0, 160));

        // Load penelitian menu for navbar (kategori slug harus sama dengan navbar)
        $data['penelitian_menu'] = $this->m_menu_items->get_by_category_slug('penelitian-pengabmas');

        // Load the view
        $data['content'] = 'pages/penelitian_detail';
        $this->load->view('layouts/user_layout', $data);
    }
}
