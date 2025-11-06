<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kemahasiswaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_menu_items');
        $this->load->model('M_settings');
    }

    /**
     * Show specific academic page by slug
     */
    public function index($slug = null)
    {
        if (!$slug) {
            // If no slug provided, show academic overview or redirect
            redirect('/');
        }

        // Get the menu item by slug from academic category
        $item = $this->M_menu_items->get_by_slug($slug);

        if (!$item || $item->category_slug !== 'kemahasiswaan') {
            show_404();
        }

        // Load data for the view
        $data['item'] = $item;
        $data['title'] = $item->title . ' | ' . ($this->M_settings->get_main_settings()->name ?? 'Website');
        $data['meta_title'] = $item->meta_title ?: $item->title;
        $data['meta_description'] = $item->meta_description ?: strip_tags(substr($item->content, 0, 160));

        // Load kemahasiswaan menu for navbar
        $data['kemahasiswaan_menu'] = $this->M_menu_items->get_by_category_slug('kemahasiswaan');

        // Load the view
        $data['content'] = 'pages/kemahasiswaan_detail';
        $this->load->view('layouts/user_layout', $data);
    }
}
