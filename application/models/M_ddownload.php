<?php
class M_ddownload extends CI_Model
{
    var $table = 'd_downloads';
    var $column_order = array('id', 'd_category_id', 'd_type_id', 'name_files');
    var $column_search = array('title', 'slug', 'author');
    var $order = array('created_at' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('d_downloads.*, d_category.name as category_name, d_type.name as type_name');
        $this->db->from($this->table);
        $this->db->join('d_category', 'd_category.id = d_category.d_category_id', 'left');
        $this->db->join('d_type', 'd_type.id = d_downloads.d_type_id', 'left');
        $this->db->order_by('d_downloads.created_at', 'desc');

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
        $this->db->from('d_category');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_type()
    {
        $this->db->select('id, name');
        $this->db->from('d_type');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('d_downloads.*, d_category.name as category_name, d_type.name as type_name');
        $this->db->from($this->table);
        $this->db->join('d_category', 'd_category.id = d_category.d_category_id', 'left');
        $this->db->join('d_type', 'd_type.id = d_downloads.d_type_id', 'left');
        $this->db->where('d_downloads.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_download($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_download($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_download($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
