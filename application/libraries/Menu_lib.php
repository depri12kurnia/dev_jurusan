<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Menu Library
 * Handles dynamic menu loading for the frontend
 */
class Menu_lib
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('M_menu_items');
        $this->CI->load->model('M_menu_categories');
    }

    /**
     * Get menu data for navbar
     * @return array
     */
    public function get_navbar_menus()
    {
        // Cache the menu data to avoid multiple DB queries
        static $menu_cache = null;

        if ($menu_cache === null) {
            $menu_cache = [
                'academic_menu' => $this->CI->M_menu_items->get_by_category_slug('akademik'),
                'tentang_menu' => $this->CI->M_menu_items->get_by_category_slug('tentang-kami'),
                'all_categories' => $this->CI->M_menu_categories->get_active_categories()
            ];
        }

        return $menu_cache;
    }

    /**
     * Get academic menu items
     * @return array
     */
    public function get_academic_menu()
    {
        $menus = $this->get_navbar_menus();
        return $menus['academic_menu'];
    }

    /**
     * Get tentang (about) menu items
     * @return array
     */
    public function get_tentang_menu()
    {
        $menus = $this->get_navbar_menus();
        return $menus['tentang_menu'];
    }

    /**
     * Get all menu categories
     * @return array
     */
    public function get_all_categories()
    {
        $menus = $this->get_navbar_menus();
        return $menus['all_categories'];
    }

    /**
     * Generate menu HTML for dropdown
     * @param array $items
     * @param string $base_url
     * @return string
     */
    public function generate_dropdown_html($items, $base_url = '')
    {
        if (empty($items)) {
            return '<li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-2"></i>Tidak ada menu tersedia</a></li>';
        }

        $html = '';
        foreach ($items as $item) {
            $url = !empty($base_url) ? site_url($base_url . '/' . $item->slug) : '#';
            $icon = !empty($item->icon) ? $item->icon : 'fas fa-file-alt';

            $html .= '<li>';
            $html .= '<a class="dropdown-item" href="' . $url . '">';
            $html .= '<i class="' . $icon . ' me-2"></i>';
            $html .= htmlspecialchars($item->title);
            $html .= '</a>';
            $html .= '</li>';
        }

        return $html;
    }
}
