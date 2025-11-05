<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu_categories extends CI_Model
{
    private $table = 'menu_categories';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all categories
     * @return array
     */
    public function get_all()
    {
        $this->db->order_by('order_position', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get active categories for navbar
     * @return array
     */
    public function get_active_categories()
    {
        $this->db->where('is_active', 1);
        $this->db->order_by('order_position', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get category by ID
     * @param int $id
     * @return object|null
     */
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Get category by slug
     * @param string $slug
     * @return object|null
     */
    public function get_by_slug($slug)
    {
        $this->db->where('slug', $slug);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Insert new category
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update category
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
     * Delete category
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
     * Get categories with item count
     * @return array
     */
    public function get_categories_with_count()
    {
        $this->db->select('mc.*, COUNT(mi.id) as items_count');
        $this->db->from($this->table . ' mc');
        $this->db->join('menu_items mi', 'mc.id = mi.category_id', 'left');
        $this->db->group_by('mc.id');
        $this->db->order_by('mc.order_position', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get next order position
     * @return int
     */
    public function get_next_order()
    {
        $this->db->select_max('order_position');
        $query = $this->db->get($this->table);
        $result = $query->row();
        return $result->order_position + 1;
    }
}
