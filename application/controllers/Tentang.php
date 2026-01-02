<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tentang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_menu_items');
        $this->load->model('M_settings');
        $this->load->model('M_prodi');
    }

    /**
     * Show specific tentang page by slug
     */
    public function index($slug = null)
    {
        $data['website'] = $this->M_settings->get_settings();
        $data['program_studi_all'] = $this->M_prodi->get_all_active();

        if (!$slug) {
            // If no slug provided, show tentang overview or redirect
            redirect('/');
        }

        // Get the menu item by slug from tentang-kami category
        $item = $this->M_menu_items->get_by_slug($slug);

        if (!$item || $item->category_slug !== 'tentang-kami') {
            show_404();
        }

        // Load data for the view
        $data['item'] = $item;
        $data['page_title'] = $item->title;
        $data['meta_title'] = $item->meta_title ?: $item->title;
        $data['meta_description'] = $item->meta_description ?: strip_tags(substr($item->content, 0, 160));

        // Load tentang menu for navbar
        $data['tentang_menu'] = $this->M_menu_items->get_by_category_slug('tentang-kami');

        // Load the view
        $data['content'] = 'pages/tentang_detail';
        $this->load->view('layouts/user_layout', $data);
    }
}
