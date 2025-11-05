<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu_items extends CI_Model
{
    private $table = 'menu_items';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all menu items
     * @return array
     */
    public function get_all()
    {
        $this->db->select('mi.*, mc.name as category_name');
        $this->db->from($this->table . ' mi');
        $this->db->join('menu_categories mc', 'mi.category_id = mc.id', 'left');
        $this->db->order_by('mi.category_id', 'ASC');
        $this->db->order_by('mi.order_position', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get menu items by category
     * @param int $category_id
     * @return array
     */
    public function get_by_category($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->where('is_active', 1);
        $this->db->order_by('order_position', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get active menu items by category slug
     * @param string $category_slug
     * @return array
     */
    public function get_by_category_slug($category_slug)
    {
        $this->db->select('mi.*');
        $this->db->from($this->table . ' mi');
        $this->db->join('menu_categories mc', 'mi.category_id = mc.id');
        $this->db->where('mc.slug', $category_slug);
        $this->db->where('mi.is_active', 1);
        $this->db->where('mc.is_active', 1);
        $this->db->order_by('mi.order_position', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get menu item by ID
     * @param int $id
     * @return object|null
     */
    public function get_by_id($id)
    {
        $this->db->select('mi.*, mc.name as category_name');
        $this->db->from($this->table . ' mi');
        $this->db->join('menu_categories mc', 'mi.category_id = mc.id', 'left');
        $this->db->where('mi.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Get menu item by slug
     * @param string $slug
     * @return object|null
     */
    public function get_by_slug($slug)
    {
        $this->db->select('mi.*, mc.name as category_name, mc.slug as category_slug');
        $this->db->from($this->table . ' mi');
        $this->db->join('menu_categories mc', 'mi.category_id = mc.id', 'left');
        $this->db->where('mi.slug', $slug);
        $this->db->where('mi.is_active', 1);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Insert new menu item
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update menu item
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete menu item
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Check if slug exists
     * @param string $slug
     * @param int $exclude_id
     * @return bool
     */
    public function slug_exists($slug, $exclude_id = null)
    {
        $this->db->where('slug', $slug);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    /**
     * Get next order position in category
     * @param int $category_id
     * @return int
     */
    public function get_next_order($category_id)
    {
        $this->db->select_max('order_position');
        $this->db->where('category_id', $category_id);
        $query = $this->db->get($this->table);
        $result = $query->row();
        return ($result->order_position ?? 0) + 1;
    }

    /**
     * Search menu items
     * @param string $keyword
     * @return array
     */
    public function search($keyword)
    {
        $this->db->select('mi.*, mc.name as category_name');
        $this->db->from($this->table . ' mi');
        $this->db->join('menu_categories mc', 'mi.category_id = mc.id', 'left');
        $this->db->group_start();
        $this->db->like('mi.title', $keyword);
        $this->db->or_like('mi.content', $keyword);
        $this->db->group_end();
        $this->db->where('mi.is_active', 1);
        $this->db->order_by('mi.category_id', 'ASC');
        $this->db->order_by('mi.order_position', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get menu structure for navbar
     * @return array
     */
    public function get_navbar_structure()
    {
        $this->db->select('
            mc.id as category_id,
            mc.name as category_name,
            mc.slug as category_slug,
            mc.icon as category_icon,
            mi.id,
            mi.title,
            mi.slug,
            mi.icon
        ');
        $this->db->from('menu_categories mc');
        $this->db->join('menu_items mi', 'mc.id = mi.category_id', 'left');
        $this->db->where('mc.is_active', 1);
        $this->db->where('mi.is_active', 1);
        $this->db->order_by('mc.order_position', 'ASC');
        $this->db->order_by('mi.order_position', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        // Group by category
        $grouped = [];
        foreach ($result as $row) {
            $cat_id = $row->category_id;
            if (!isset($grouped[$cat_id])) {
                $grouped[$cat_id] = (object)[
                    'category_id' => $row->category_id,
                    'category_name' => $row->category_name,
                    'category_slug' => $row->category_slug,
                    'category_icon' => $row->category_icon,
                    'items' => []
                ];
            }

            if ($row->id) {
                $grouped[$cat_id]->items[] = (object)[
                    'id' => $row->id,
                    'title' => $row->title,
                    'slug' => $row->slug,
                    'icon' => $row->icon
                ];
            }
        }

        return array_values($grouped);
    }
}
