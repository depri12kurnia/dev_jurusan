<?php
class M_news extends CI_Model
{
    var $table = 'news';
    var $column_order = array('id', 'category_id', 'title', 'slug', 'author', 'status', 'published_at');
    var $column_search = array('title', 'slug', 'author');
    var $order = array('published_at' => 'asc');

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
        $this->db->select('id, name');
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
            $thumbnail_path = FCPATH . 'assets/uploads/news/' . $news->thumbnail;
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
        $this->db->where('status', 'published');
        $published = $this->db->count_all_results($this->table);

        // Draft news
        $this->db->where('status', 'draft');
        $draft = $this->db->count_all_results($this->table);

        // Today's news
        $this->db->where('DATE(published_at)', date('Y-m-d'));
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
        $this->db->where('status', 'published');
        $this->db->order_by('published_at', 'DESC');
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
        $this->db->where('status', 'published');
        $this->db->order_by('views', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function increment_views($id)
    {
        $this->db->where('id', $id);
        $this->db->set('views', 'views + 1', FALSE);
        return $this->db->update($this->table);
    }

    public function get_news_by_category($category_id, $limit = null)
    {
        $this->db->select('news.*, category.name as category_name, users.username as author_name');
        $this->db->from($this->table);
        $this->db->join('category', 'category.id = news.category_id', 'left');
        $this->db->join('users', 'users.id = news.author', 'left');
        $this->db->where('category_id', $category_id);
        $this->db->where('status', 'published');
        $this->db->order_by('published_at', 'DESC');

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
        $this->db->where('status', 'published');
        $this->db->group_start();
        $this->db->like('title', $keyword);
        $this->db->or_like('content', $keyword);
        $this->db->or_like('excerpt', $keyword);
        $this->db->group_end();
        $this->db->order_by('published_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
