<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_facilities extends CI_Model
{
    var $table = 'facilities';
    var $table_categories = 'facility_categories';
    var $table_highlights = 'facility_highlights';
    var $table_specs = 'facility_specifications';

    var $column_order = array('f.id', 'f.title', 'fc.name', 'f.subtitle', 'f.status', 'f.is_featured');
    var $column_search = array('f.title', 'f.subtitle', 'f.description', 'fc.name');
    var $order = array('f.featured_order' => 'asc', 'f.sort_order' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    // ==========================================
    // METHODS FOR DATATABLES (ADMIN)
    // ==========================================

    private function _get_datatables_query()
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // ==========================================
    // CRUD OPERATIONS
    // ==========================================

    public function get_by_id($id)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_slug($slug)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.slug', $slug);
        $this->db->where('f.status', 'Active');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Increment view count
            $this->db->where('slug', $slug);
            $this->db->set('view_count', 'view_count + 1', FALSE);
            $this->db->update($this->table);

            return $query->row();
        }
        return null;
    }

    public function insert_facility($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_facility($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_facility($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    // ==========================================
    // PUBLIC METHODS (FOR FRONTEND)
    // ==========================================

    public function get_featured_facilities($limit = 4)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.is_featured', 1);
        $this->db->where('f.status', 'Active');
        $this->db->where('fc.status', 'Active');
        $this->db->order_by('f.featured_order', 'asc');
        $this->db->order_by('f.sort_order', 'asc');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_active($limit = 0)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.status', 'Active');
        $this->db->where('fc.status', 'Active');
        $this->db->order_by('f.sort_order', 'asc');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_category($category_id, $limit = 0)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.category_id', $category_id);
        $this->db->where('f.status', 'Active');
        $this->db->where('fc.status', 'Active');
        $this->db->order_by('f.sort_order', 'asc');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_related($current_id, $category_id = null, $limit = 3)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.id !=', $current_id);
        $this->db->where('f.status', 'Active');
        $this->db->where('fc.status', 'Active');

        if ($category_id) {
            $this->db->where('f.category_id', $category_id);
        }

        $this->db->order_by('f.view_count', 'desc');
        $this->db->order_by('f.sort_order', 'asc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // ==========================================
    // HIGHLIGHT METHODS
    // ==========================================

    public function get_facility_highlights($facility_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_highlights);
        $this->db->where('facility_id', $facility_id);
        $this->db->where('status', 'Active');
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_highlight($data)
    {
        return $this->db->insert($this->table_highlights, $data);
    }

    public function update_highlight($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table_highlights, $data);
    }

    public function delete_highlight($id)
    {
        return $this->db->delete($this->table_highlights, ['id' => $id]);
    }

    public function delete_highlights_by_facility($facility_id)
    {
        return $this->db->delete($this->table_highlights, ['facility_id' => $facility_id]);
    }

    // ==========================================
    // CATEGORY METHODS
    // ==========================================

    public function get_categories()
    {
        $this->db->select('fc.*, COUNT(f.id) as facilities_count');
        $this->db->from($this->table_categories . ' fc');
        $this->db->join($this->table . ' f', 'fc.id = f.category_id', 'left');
        $this->db->where('fc.status !=', 'Deleted');
        $this->db->group_by('fc.id');
        $this->db->order_by('fc.sort_order', 'asc');
        $this->db->order_by('fc.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_category_by_id($id)
    {
        $this->db->select('fc.*, COUNT(f.id) as facilities_count');
        $this->db->from($this->table_categories . ' fc');
        $this->db->join($this->table . ' f', 'fc.id = f.category_id', 'left');
        $this->db->where('fc.id', $id);
        $this->db->group_by('fc.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_category($data)
    {
        return $this->db->insert($this->table_categories, $data);
    }

    public function update_category($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table_categories, $data);
    }

    public function delete_category($id)
    {
        return $this->db->delete($this->table_categories, ['id' => $id]);
    }

    public function count_facilities_by_category($category_id)
    {
        $this->db->from($this->table);
        $this->db->where('category_id', $category_id);
        $this->db->where('status !=', 'Deleted');
        return $this->db->count_all_results();
    }

    // ==========================================
    // SPECIFICATION METHODS
    // ==========================================

    public function get_facility_specifications($facility_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_specs);
        $this->db->where('facility_id', $facility_id);
        $this->db->order_by('spec_category', 'asc');
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_specifications_grouped($facility_id)
    {
        $specs = $this->get_facility_specifications($facility_id);
        $grouped = array();

        foreach ($specs as $spec) {
            $category = $spec->spec_category ?: 'General';
            if (!isset($grouped[$category])) {
                $grouped[$category] = array();
            }
            $grouped[$category][] = $spec;
        }

        return $grouped;
    }

    public function insert_specification($data)
    {
        return $this->db->insert($this->table_specs, $data);
    }

    public function delete_specifications_by_facility($facility_id)
    {
        return $this->db->delete($this->table_specs, ['facility_id' => $facility_id]);
    }



    // ==========================================
    // UTILITY METHODS
    // ==========================================

    public function count_active()
    {
        $this->db->from($this->table);
        $this->db->where('status', 'Active');
        return $this->db->count_all_results();
    }

    public function count_by_category($category_id)
    {
        $this->db->from($this->table);
        $this->db->where('category_id', $category_id);
        $this->db->where('status', 'Active');
        return $this->db->count_all_results();
    }

    public function get_popular_facilities($limit = 5)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.status', 'Active');
        $this->db->where('fc.status', 'Active');
        $this->db->order_by('f.view_count', 'desc');
        $this->db->order_by('f.created_at', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function search_facilities($keyword, $category_id = null, $limit = 0)
    {
        $this->db->select('f.*, fc.name as category_name, fc.color as category_color');
        $this->db->from($this->table . ' f');
        $this->db->join($this->table_categories . ' fc', 'f.category_id = fc.id', 'left');
        $this->db->where('f.status', 'Active');
        $this->db->where('fc.status', 'Active');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('f.title', $keyword);
            $this->db->or_like('f.subtitle', $keyword);
            $this->db->or_like('f.description', $keyword);
            $this->db->or_like('f.short_description', $keyword);
            $this->db->group_end();
        }

        if (!empty($category_id)) {
            $this->db->where('f.category_id', $category_id);
        }

        $this->db->order_by('f.sort_order', 'asc');

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function generate_slug($title, $id = null)
    {
        $slug = url_title($title, 'dash', TRUE);
        $original_slug = $slug;
        $count = 1;

        while (TRUE) {
            $this->db->where('slug', $slug);
            if ($id) {
                $this->db->where('id !=', $id);
            }
            $query = $this->db->get($this->table);

            if ($query->num_rows() == 0) {
                break;
            }

            $slug = $original_slug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
