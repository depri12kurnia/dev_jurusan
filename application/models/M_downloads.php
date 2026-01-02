<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_downloads extends CI_Model
{
    private $table = 'd_downloads';
    private $db_table_categories = 'd_category';
    private $db_table_types = 'd_type';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all downloads with category and type info
     */
    public function get_all($limit = 0, $offset = 0)
    {
        $this->db->select('dd.id, dd.d_category_id, dd.d_type_id, dd.name, dd.name_files, dd.created_at, dd.updated_at, dc.name as category_name, dt.name as type_name');
        $this->db->from($this->table . ' dd');
        $this->db->join($this->db_table_categories . ' dc', 'dc.id = dd.d_category_id', 'left');
        $this->db->join($this->db_table_types . ' dt', 'dt.id = dd.d_type_id', 'left');
        $this->db->order_by('dd.created_at', 'DESC');

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get downloads by category
     */
    public function get_by_category($category_id, $limit = 0, $offset = 0)
    {
        $this->db->select('dd.id, dd.d_category_id, dd.d_type_id, dd.name, dd.name_files, dd.created_at, dd.updated_at, dc.name as category_name, dt.name as type_name');
        $this->db->from($this->table . ' dd');
        $this->db->join($this->db_table_categories . ' dc', 'dc.id = dd.d_category_id', 'left');
        $this->db->join($this->db_table_types . ' dt', 'dt.id = dd.d_type_id', 'left');
        $this->db->where('dd.d_category_id', $category_id);
        $this->db->order_by('dd.created_at', 'DESC');

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get downloads by type
     */
    public function get_by_type($type_id, $limit = 0, $offset = 0)
    {
        $this->db->select('dd.id, dd.d_category_id, dd.d_type_id, dd.name, dd.name_files, dd.created_at, dd.updated_at, dc.name as category_name, dt.name as type_name');
        $this->db->from($this->table . ' dd');
        $this->db->join($this->db_table_categories . ' dc', 'dc.id = dd.d_category_id', 'left');
        $this->db->join($this->db_table_types . ' dt', 'dt.id = dd.d_type_id', 'left');
        $this->db->where('dd.d_type_id', $type_id);
        $this->db->order_by('dd.created_at', 'DESC');

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get single download by ID
     */
    public function get_by_id($id)
    {
        $this->db->select('dd.id, dd.d_category_id, dd.d_type_id, dd.name, dd.name_files, dd.created_at, dd.updated_at, dc.name as category_name, dt.name as type_name');
        $this->db->from($this->table . ' dd');
        $this->db->join($this->db_table_categories . ' dc', 'dc.id = dd.d_category_id', 'left');
        $this->db->join($this->db_table_types . ' dt', 'dt.id = dd.d_type_id', 'left');
        $this->db->where('dd.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Search downloads
     */
    public function search($keyword, $limit = 0, $offset = 0)
    {
        $this->db->select('dd.id, dd.d_category_id, dd.d_type_id, dd.name, dd.name_files, dd.created_at, dd.updated_at, dc.name as category_name, dt.name as type_name');
        $this->db->from($this->table . ' dd');
        $this->db->join($this->db_table_categories . ' dc', 'dc.id = dd.d_category_id', 'left');
        $this->db->join($this->db_table_types . ' dt', 'dt.id = dd.d_type_id', 'left');
        $this->db->like('dd.name', $keyword);
        $this->db->or_like('dt.name', $keyword);
        $this->db->order_by('dd.created_at', 'DESC');

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Count total downloads
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Count downloads by category
     */
    public function count_by_category($category_id)
    {
        $this->db->where('d_category_id', $category_id);
        return $this->db->count_all_results($this->table);
    }

    /**
     * Insert new download
     */
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update download
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete download
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Get all categories
     */
    public function get_categories()
    {
        $query = $this->db->get($this->db_table_categories);
        return $query->result();
    }

    /**
     * Get all types
     */
    public function get_types()
    {
        $query = $this->db->get($this->db_table_types);
        return $query->result();
    }
}
