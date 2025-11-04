<?php
class M_news extends CI_Model
{
    var $table = 'news';
    var $column_order = array('news.id', 'news.category_id', 'news.title', 'news.slug', 'news.author', 'news.status', 'news.published_at');
    var $column_search = array('news.title', 'news.slug', 'users.username');
    var $order = array('news.published_at' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->check_views_column();
    }

    /**
     * Check if views column exists, create if not
     */
    private function check_views_column()
    {
        $fields = $this->db->list_fields($this->table);
        if (!in_array('views', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN views INT(11) DEFAULT 0 AFTER status");
        }
    }

    /**
     * Check if views column exists
     */
    private function has_views_column()
    {
        $fields = $this->db->list_fields($this->table);
        return in_array('views', $fields);
    }

    private function _get_datatables_query()
    {
        $this->db->select('news.*, category.name as category_name, users.username as author');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->order_by('news.published_at', 'desc');

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
                $i++;
            }
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

    public function get_category()
    {
        $this->db->select('id, name, slug');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('news.*, category.name as category_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->where('news.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_news($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_news($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_news($id)
    {
        // Get news data first for file cleanup
        $news = $this->get_by_id($id);

        if ($news && !empty($news->thumbnail)) {
            $thumbnail_path = FCPATH . 'public/uploads/news/' . $news->thumbnail;
            if (file_exists($thumbnail_path)) {
                unlink($thumbnail_path);
            }
        }

        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function get_news_statistics()
    {
        // Total news
        $total = $this->db->count_all($this->table);

        // Published news
        $this->db->where('news.status', 'published');
        $published = $this->db->count_all_results($this->table);

        // Draft news
        $this->db->where('news.status', 'draft');
        $draft = $this->db->count_all_results($this->table);

        // Today's news
        $this->db->where('DATE(news.published_at)', date('Y-m-d'));
        $today = $this->db->count_all_results($this->table);

        return [
            'total' => $total,
            'published' => $published,
            'draft' => $draft,
            'today' => $today
        ];
    }

    public function get_authors()
    {
        $this->db->select('DISTINCT users.id, users.username');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = news.author');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_latest_news($limit = 5)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.status', 'published');
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_popular_news($limit = 5)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.status', 'published');

        // Order by views (column should exist after constructor check)
        if ($this->has_views_column()) {
            $this->db->order_by('news.views', 'DESC');
        } else {
            // Fallback to published_at if views column doesn't exist
            $this->db->order_by('news.published_at', 'DESC');
        }

        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_views($id)
    {
        // SUPER SAFE METHOD - Use raw SQL to avoid Active Record issues
        $id = (int)$id;
        if ($id <= 0) {
            return false;
        }

        // Use direct SQL query with prepared statement
        $sql = "UPDATE {$this->table} SET views = COALESCE(views, 0) + 1 WHERE id = ? LIMIT 1";

        // Execute with query() method
        $result = $this->db->query($sql, array($id));

        // Check affected rows - MUST be exactly 1
        $affected = $this->db->affected_rows();

        // Log for debugging
        log_message('info', "increment_views: ID=$id, affected_rows=$affected, success=" . ($result ? 'true' : 'false'));

        return $result && $affected == 1;
    }
    public function get_news_by_category($category_id, $limit = null)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.category_id', $category_id);
        $this->db->where('news.status', 'published');
        $this->db->order_by('news.published_at', 'DESC');

        if ($limit) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function search_news($keyword)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.status', 'published');
        $this->db->group_start();
        $this->db->like('news.title', $keyword);
        $this->db->or_like('news.content', $keyword);
        $this->db->or_like('news.excerpt', $keyword);
        $this->db->group_end();
        $this->db->order_by('news.published_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Methods for frontend news controller

    public function count_published_news()
    {
        $this->db->where('news.status', 'published');
        return $this->db->count_all_results($this->table);
    }

    public function get_published_news($limit, $offset)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.status', 'published');
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_slug($slug)
    {
        $this->db->select('news.*, category.name as category_name, category.slug as category_slug, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.slug', $slug);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_related_news($category_id, $exclude_id, $limit = 4)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.category_id', $category_id);
        $this->db->where('news.status', 'published');
        $this->db->where('news.id !=', $exclude_id);
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_search_results($keyword)
    {
        $this->db->from($this->table);
        $this->db->where('news.status', 'published');
        $this->db->group_start();
        $this->db->like('news.title', $keyword);
        $this->db->or_like('news.content', $keyword);
        $this->db->or_like('news.excerpt', $keyword);
        $this->db->group_end();
        return $this->db->count_all_results();
    }

    public function search_news_paginated($keyword, $limit, $offset)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.status', 'published');
        $this->db->group_start();
        $this->db->like('news.title', $keyword);
        $this->db->or_like('news.content', $keyword);
        $this->db->or_like('news.excerpt', $keyword);
        $this->db->group_end();
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_category_by_slug($slug)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row();
    }

    public function count_news_by_category($category_id)
    {
        $this->db->where('news.category_id', $category_id);
        $this->db->where('news.status', 'published');
        return $this->db->count_all_results($this->table);
    }

    public function get_news_by_category_paginated($category_id, $limit, $offset)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.category_id', $category_id);
        $this->db->where('news.status', 'published');
        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_featured_news($limit = 3)
    {
        // Check if is_featured column exists
        $fields = $this->db->list_fields($this->table);
        $has_featured_column = in_array('is_featured', $fields);

        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('news.status', 'published');

        if ($has_featured_column) {
            $this->db->where('news.is_featured', 1);
        }

        $this->db->order_by('news.published_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        // If no featured news or no featured column, get latest news instead
        if ($query->num_rows() == 0 || !$has_featured_column) {
            return $this->get_latest_news($limit);
        }

        return $query->result();
    }

    public function get_public_statistics()
    {
        // Total published news
        $this->db->where('news.status', 'published');
        $total_published = $this->db->count_all_results($this->table);

        // News this month
        $this->db->where('news.status', 'published');
        $this->db->where('MONTH(news.published_at)', date('m'));
        $this->db->where('YEAR(news.published_at)', date('Y'));
        $this_month = $this->db->count_all_results($this->table);

        // Total categories with news
        $this->db->select('DISTINCT news.category_id');
        $this->db->where('news.status', 'published');
        $categories_with_news = $this->db->count_all_results($this->table);

        // Total views (if views column exists)
        $this->db->select_sum('news.views');
        $this->db->where('news.status', 'published');
        $query = $this->db->get($this->table);
        $total_views = $query->row()->views ?? 0;

        return [
            'total_published' => $total_published,
            'this_month' => $this_month,
            'categories_with_news' => $categories_with_news,
            'total_views' => $total_views
        ];
    }
}
