<?php
class M_staf extends CI_Model
{
    var $table = 'staf';
    var $column_order = array('staf.id', 'staf.nip', 'staf.nama_lengkap', 'staf.email', 'staf.divisi', 'staf.jabatan', 'staf.status_aktif');
    var $column_search = array('staf.nip', 'staf.nama_lengkap', 'staf.email', 'staf.divisi', 'staf.jabatan');
    var $order = array('staf.id' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('staf.*');
        $this->db->from($this->table);
        $this->db->order_by('staf.id', 'desc');

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

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
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

    public function get_all($limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('nama_lengkap', 'asc');

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_nip($nip)
    {
        $this->db->from($this->table);
        $this->db->where('nip', $nip);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        if (isset($this->ion_auth)) {
            $data['created_by'] = $this->ion_auth->user()->row()->id;
        }

        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (isset($this->ion_auth)) {
            $data['updated_by'] = $this->ion_auth->user()->row()->id;
        }

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function get_by_divisi($divisi)
    {
        $this->db->from($this->table);
        $this->db->where('divisi', $divisi);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_active_staf()
    {
        $this->db->from($this->table);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_by_status()
    {
        $this->db->select('status_aktif, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->group_by('status_aktif');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_by_divisi()
    {
        $this->db->select('divisi, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->group_by('divisi');
        $this->db->order_by('total', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_by_status_kepegawaian()
    {
        $this->db->select('status_kepegawaian, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->group_by('status_kepegawaian');
        $this->db->order_by('total', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function check_nip_exists($nip, $exclude_id = null)
    {
        $this->db->from($this->table);
        $this->db->where('nip', $nip);

        if ($exclude_id !== null) {
            $this->db->where('id !=', $exclude_id);
        }

        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    public function check_email_exists($email, $exclude_id = null)
    {
        $this->db->from($this->table);
        $this->db->where('email', $email);

        if ($exclude_id !== null) {
            $this->db->where('id !=', $exclude_id);
        }

        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    public function get_divisi_list()
    {
        $this->db->select('divisi');
        $this->db->from($this->table);
        $this->db->where('divisi IS NOT NULL');
        $this->db->where('divisi !=', '');
        $this->db->group_by('divisi');
        $this->db->order_by('divisi', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jabatan_list()
    {
        $this->db->select('jabatan');
        $this->db->from($this->table);
        $this->db->where('jabatan IS NOT NULL');
        $this->db->where('jabatan !=', '');
        $this->db->group_by('jabatan');
        $this->db->order_by('jabatan', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_staf_with_gaji()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('gaji_pokok IS NOT NULL');
        $this->db->where('gaji_pokok >', 0);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('gaji_pokok', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_total_gaji()
    {
        $this->db->select('SUM(gaji_pokok) as total_gaji');
        $this->db->from($this->table);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->where('gaji_pokok IS NOT NULL');
        $query = $this->db->get();
        $result = $query->row();
        return $result ? $result->total_gaji : 0;
    }

    public function get_staf_by_golongan($golongan)
    {
        $this->db->from($this->table);
        $this->db->where('golongan', $golongan);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function search_staf($keyword)
    {
        $this->db->from($this->table);
        $this->db->group_start();
        $this->db->like('nama_lengkap', $keyword);
        $this->db->or_like('nip', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('jabatan', $keyword);
        $this->db->group_end();
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_staf_retiring_soon($months = 6)
    {
        // Assuming retirement age is 58 for PNS
        $retirement_date = date('Y-m-d', strtotime("+$months months"));

        $this->db->select('*, YEAR(CURDATE()) - YEAR(tanggal_lahir) - (RIGHT(CURDATE(), 5) < RIGHT(tanggal_lahir, 5)) as umur');
        $this->db->from($this->table);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->where('status_kepegawaian', 'PNS');
        $this->db->having('umur >=', 57);
        $this->db->order_by('tanggal_lahir', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
}
