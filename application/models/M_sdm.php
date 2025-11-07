<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sdm extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Mendapatkan semua data dosen aktif
     */
    public function get_all_dosen()
    {
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get('dosen');
        return $query->result();
    }

    /**
     * Mendapatkan dosen berdasarkan program studi
     */
    public function get_dosen_by_prodi($program_studi)
    {
        $this->db->where('program_studi', $program_studi);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get('dosen');
        return $query->result();
    }

    /**
     * Mendapatkan dosen berdasarkan jabatan akademik
     */
    public function get_dosen_by_jabatan($jabatan_akademik)
    {
        $this->db->where('jabatan_akademik', $jabatan_akademik);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get('dosen');
        return $query->result();
    }

    /**
     * Mendapatkan detail dosen berdasarkan ID
     */
    public function get_dosen_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('dosen');
        return $query->row();
    }

    /**
     * Mendapatkan semua data staf aktif
     */
    public function get_all_staf()
    {
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get('staf');
        return $query->result();
    }

    /**
     * Mendapatkan staf berdasarkan divisi
     */
    public function get_staf_by_divisi($divisi)
    {
        $this->db->where('divisi', $divisi);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('nama_lengkap', 'ASC');
        $query = $this->db->get('staf');
        return $query->result();
    }

    /**
     * Mendapatkan detail staf berdasarkan ID
     */
    public function get_staf_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('staf');
        return $query->row();
    }

    /**
     * Mendapatkan statistik SDM
     */
    public function get_sdm_statistics()
    {
        $stats = [];

        // Total Dosen
        $this->db->where('status_aktif', 'Aktif');
        $stats['total_dosen'] = $this->db->count_all_results('dosen');

        // Total Staf
        $this->db->where('status_aktif', 'Aktif');
        $stats['total_staf'] = $this->db->count_all_results('staf');

        // Dosen berdasarkan pendidikan
        $this->db->select('pendidikan_terakhir, COUNT(*) as jumlah');
        $this->db->where('status_aktif', 'Aktif');
        $this->db->group_by('pendidikan_terakhir');
        $query = $this->db->get('dosen');
        $stats['dosen_by_education'] = $query->result();

        // Staf berdasarkan divisi
        $this->db->select('divisi, COUNT(*) as jumlah');
        $this->db->where('status_aktif', 'Aktif');
        $this->db->group_by('divisi');
        $query = $this->db->get('staf');
        $stats['staf_by_divisi'] = $query->result();

        return $stats;
    }

    /**
     * Mendapatkan daftar program studi yang ada
     */
    public function get_program_studi_list()
    {
        $this->db->select('program_studi');
        $this->db->distinct();
        $this->db->where('program_studi IS NOT NULL');
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('program_studi', 'ASC');
        $query = $this->db->get('dosen');
        return $query->result();
    }

    /**
     * Mendapatkan daftar divisi yang ada
     */
    public function get_divisi_list()
    {
        $this->db->select('divisi');
        $this->db->distinct();
        $this->db->where('divisi IS NOT NULL');
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by('divisi', 'ASC');
        $query = $this->db->get('staf');
        return $query->result();
    }

    // Legacy methods for backward compatibility
    public function get_all_sdm_dosen()
    {
        return $this->get_all_dosen();
    }

    public function get_all_sdm_staf()
    {
        return $this->get_all_staf();
    }
}
