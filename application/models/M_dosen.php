<?php
class M_dosen extends CI_Model
{
    var $table = 'dosen';
    var $column_order = array('dosen.id', 'dosen.nidn', 'dosen.nama_lengkap', 'dosen.email', 'dosen.program_studi', 'dosen.jabatan_akademik', 'dosen.status_aktif');
    var $column_search = array('dosen.nidn', 'dosen.nama_lengkap', 'dosen.email', 'dosen.program_studi', 'dosen.jabatan_akademik');
    var $order = array('dosen.id' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('dosen.*, 
                          CONCAT(COALESCE(dosen.gelar_depan, ""), " ", dosen.nama_lengkap, " ", COALESCE(dosen.gelar_belakang, "")) as nama_gelar');
        $this->db->from($this->table);
        $this->db->order_by('dosen.id', 'desc');

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
        $this->db->select('dosen.*, 
                          CONCAT(COALESCE(dosen.gelar_depan, ""), " ", dosen.nama_lengkap, " ", COALESCE(dosen.gelar_belakang, "")) as nama_gelar');
        $this->db->from($this->table);
        $this->db->order_by('dosen.nama_lengkap', 'asc');

        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('dosen.*, 
                          CONCAT(COALESCE(dosen.gelar_depan, ""), " ", dosen.nama_lengkap, " ", COALESCE(dosen.gelar_belakang, "")) as nama_gelar');
        $this->db->from($this->table);
        $this->db->where('dosen.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_nidn($nidn)
    {
        $this->db->from($this->table);
        $this->db->where('nidn', $nidn);
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

    public function get_by_program_studi($program_studi)
    {
        $this->db->select('dosen.*, 
                          CONCAT(COALESCE(dosen.gelar_depan, ""), " ", dosen.nama_lengkap, " ", COALESCE(dosen.gelar_belakang, "")) as nama_gelar');
        $this->db->from($this->table);
        $this->db->where('program_studi', $program_studi);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_active_dosen()
    {
        $this->db->select('dosen.*, 
                          CONCAT(COALESCE(dosen.gelar_depan, ""), " ", dosen.nama_lengkap, " ", COALESCE(dosen.gelar_belakang, "")) as nama_gelar');
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

    public function count_by_program_studi()
    {
        $this->db->select('program_studi, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->group_by('program_studi');
        $this->db->order_by('total', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function check_nidn_exists($nidn, $exclude_id = null)
    {
        $this->db->from($this->table);
        $this->db->where('nidn', $nidn);

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

    // Methods untuk tabel dosen_pendidikan
    public function get_pendidikan_by_dosen($dosen_id)
    {
        $this->db->select('*');
        $this->db->from('dosen_pendidikan');
        $this->db->where('dosen_id', $dosen_id);
        $this->db->order_by('jenjang', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_pendidikan($data)
    {
        return $this->db->insert('dosen_pendidikan', $data);
    }

    public function update_pendidikan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('dosen_pendidikan', $data);
    }

    public function delete_pendidikan($id)
    {
        return $this->db->delete('dosen_pendidikan', ['id' => $id]);
    }

    // Methods untuk tabel dosen_matakuliah
    public function get_matakuliah_by_dosen($dosen_id)
    {
        $this->db->select('*');
        $this->db->from('dosen_matakuliah');
        $this->db->where('dosen_id', $dosen_id);
        $this->db->order_by('semester', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_matakuliah($data)
    {
        return $this->db->insert('dosen_matakuliah', $data);
    }

    public function update_matakuliah($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('dosen_matakuliah', $data);
    }

    public function delete_matakuliah($id)
    {
        return $this->db->delete('dosen_matakuliah', ['id' => $id]);
    }

    public function get_program_studi_list()
    {
        $this->db->select('program_studi');
        $this->db->from($this->table);
        $this->db->where('program_studi IS NOT NULL');
        $this->db->where('program_studi !=', '');
        $this->db->group_by('program_studi');
        $this->db->order_by('program_studi', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
}
