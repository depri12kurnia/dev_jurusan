<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_prodi');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form', 'text']);

        // Cek login dan akses admin
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login');
        }
    }

    // Halaman daftar program studi
    // Halaman daftar program studi
    public function index()
    {
        $data = [
            'title' => 'Kelola Program Studi',
            'prodi_list' => $this->M_prodi->get_all_admin(),
            'content' => 'paneladmin/prodi/list'
        ];

        $this->load->view('layouts/adminlte3', $data);
    }

    // Halaman tambah program studi
    public function create()
    {
        $data = [
            'title' => 'Tambah Program Studi',
            'content' => 'paneladmin/prodi/create',
            'action' => site_url('paneladmin/prodi/store')
        ];

        $this->load->view('layouts/adminlte3', $data);
    }

    // Proses simpan data baru
    public function store()
    {
        $this->form_validation->set_rules('nama_prodi', 'Nama Program Studi', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('kode_prodi', 'Kode Program Studi', 'required|trim|max_length[20]|is_unique[program_studi.kode_prodi]');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|in_list[D3,Sarjana Terapan,Profesi]');
        $this->form_validation->set_rules('gelar', 'Gelar', 'required|trim|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
            return;
        }

        // Generate slug
        $slug = $this->M_prodi->generate_unique_slug($this->input->post('nama_prodi'));

        $data = [
            'nama_prodi' => $this->input->post('nama_prodi'),
            'kode_prodi' => strtoupper($this->input->post('kode_prodi')),
            'slug' => $slug,
            'jenjang' => $this->input->post('jenjang'),
            'gelar' => $this->input->post('gelar'),
            'deskripsi' => $this->input->post('deskripsi'),
            'deskripsi_lengkap' => $this->input->post('deskripsi_lengkap'),
            'featured_description' => $this->input->post('featured_description'),
            'visi' => $this->input->post('visi'),
            'misi' => $this->input->post('misi'),
            'tujuan' => $this->input->post('tujuan'),
            'durasi_studi' => $this->input->post('durasi_studi') ?: 8,
            'sks_total' => $this->input->post('sks_total') ?: 144,
            'akreditasi' => $this->input->post('akreditasi'),
            'no_sk_akreditasi' => $this->input->post('no_sk_akreditasi'),
            'tanggal_akreditasi' => $this->input->post('tanggal_akreditasi') ?: null,
            'masa_berlaku_akreditasi' => $this->input->post('masa_berlaku_akreditasi') ?: null,
            'prospek_karir' => $this->input->post('prospek_karir'),
            'kompetensi_lulusan' => $this->input->post('kompetensi_lulusan'),
            'fasilitas' => $this->input->post('fasilitas'),
            'mata_kuliah_unggulan' => $this->input->post('mata_kuliah_unggulan'),
            'kerjasama_industri' => $this->input->post('kerjasama_industri'),
            'prestasi' => $this->input->post('prestasi'),
            'biaya_pendidikan' => $this->input->post('biaya_pendidikan') ?: null,
            'kuota_mahasiswa' => $this->input->post('kuota_mahasiswa') ?: 0,
            'syarat_masuk' => $this->input->post('syarat_masuk'),
            'kontak_person' => $this->input->post('kontak_person'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'website' => $this->input->post('website'),
            'alamat' => $this->input->post('alamat'),
            'kepala_prodi' => $this->input->post('kepala_prodi'),
            'sekretaris_prodi' => $this->input->post('sekretaris_prodi'),
            'jumlah_dosen' => $this->input->post('jumlah_dosen') ?: 0,
            'jumlah_mahasiswa_aktif' => $this->input->post('jumlah_mahasiswa_aktif') ?: 0,
            'jumlah_alumni' => $this->input->post('jumlah_alumni') ?: 0,
            'tingkat_kepuasan_mahasiswa' => $this->input->post('tingkat_kepuasan_mahasiswa'),
            'tingkat_kelulusan' => $this->input->post('tingkat_kelulusan'),
            'lama_tunggu_kerja' => $this->input->post('lama_tunggu_kerja'),
            'icon' => $this->input->post('icon') ?: 'fas fa-graduation-cap',
            'warna' => $this->input->post('warna') ?: '#00B9AD',
            'urutan' => $this->input->post('urutan') ?: 0,
            'is_featured' => $this->input->post('is_featured') ? 1 : 0,
            'is_published' => $this->input->post('is_published') ? 1 : 0,
            'seo_title' => $this->input->post('seo_title'),
            'seo_description' => $this->input->post('seo_description'),
            'seo_keywords' => $this->input->post('seo_keywords'),
            'status' => $this->input->post('status') ?: 'aktif',
            'created_by' => $this->session->userdata('user_id')
        ];



        // Handle file upload untuk banner
        if (!empty($_FILES['banner']['name'])) {
            $config['upload_path'] = './public/uploads/prodi/banner/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
            $config['max_size'] = 3072; // 3MB
            $config['file_name'] = time() . '_banner_' . $_FILES['banner']['name'];

            $this->load->library('upload', $config);

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            if ($this->upload->do_upload('banner')) {
                $data['banner'] = 'public/uploads/prodi/banner/' . $this->upload->data('file_name');
            }
        }

        if ($this->M_prodi->insert($data)) {
            $this->session->set_flashdata('success', 'Program Studi berhasil ditambahkan.');
            redirect('paneladmin/prodi');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan Program Studi.');
            $this->create();
        }
    }

    // Halaman edit program studi
    public function edit($id)
    {
        $prodi = $this->M_prodi->get_by_id($id);

        if (!$prodi) {
            show_404();
        }

        $data = [
            'title' => 'Edit Program Studi',
            'prodi' => $prodi,
            'content' => 'paneladmin/prodi/edit',
            'action' => site_url('paneladmin/prodi/update/' . $id)
        ];

        $this->load->view('layouts/adminlte3', $data);
    }

    // Proses update data
    public function update($id)
    {
        $prodi = $this->M_prodi->get_by_id($id);

        if (!$prodi) {
            show_404();
        }

        // Validasi CSRF Token (CodeIgniter 3 sudah otomatis validasi jika POST request)
        // Token akan divalidasi otomatis oleh sistem jika csrf_protection = TRUE di config

        $this->form_validation->set_rules('nama_prodi', 'Nama Program Studi', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('kode_prodi', 'Kode Program Studi', 'required|trim|max_length[20]|callback_check_unique_kode_prodi[' . $id . ']');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|in_list[D3,Sarjana Terapan,Profesi]');
        $this->form_validation->set_rules('gelar', 'Gelar', 'required|trim|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        // Generate slug if nama changed
        $slug = $prodi->slug;
        if ($this->input->post('nama_prodi') != $prodi->nama_prodi) {
            $slug = $this->M_prodi->generate_unique_slug($this->input->post('nama_prodi'), $id);
        }

        $data = [
            'nama_prodi' => $this->input->post('nama_prodi'),
            'kode_prodi' => strtoupper($this->input->post('kode_prodi')),
            'slug' => $slug,
            'jenjang' => $this->input->post('jenjang'),
            'gelar' => $this->input->post('gelar'),
            'deskripsi' => $this->input->post('deskripsi'),
            'deskripsi_lengkap' => $this->input->post('deskripsi_lengkap'),
            'featured_description' => $this->input->post('featured_description'),
            'visi' => $this->input->post('visi'),
            'misi' => $this->input->post('misi'),
            'tujuan' => $this->input->post('tujuan'),
            'durasi_studi' => $this->input->post('durasi_studi') ?: 8,
            'sks_total' => $this->input->post('sks_total') ?: 144,
            'akreditasi' => $this->input->post('akreditasi'),
            'no_sk_akreditasi' => $this->input->post('no_sk_akreditasi'),
            'tanggal_akreditasi' => $this->input->post('tanggal_akreditasi') ?: null,
            'masa_berlaku_akreditasi' => $this->input->post('masa_berlaku_akreditasi') ?: null,
            'prospek_karir' => $this->input->post('prospek_karir'),
            'kompetensi_lulusan' => $this->input->post('kompetensi_lulusan'),
            'fasilitas' => $this->input->post('fasilitas'),
            'mata_kuliah_unggulan' => $this->input->post('mata_kuliah_unggulan'),
            'kerjasama_industri' => $this->input->post('kerjasama_industri'),
            'prestasi' => $this->input->post('prestasi'),
            'biaya_pendidikan' => $this->input->post('biaya_pendidikan') ?: null,
            'kuota_mahasiswa' => $this->input->post('kuota_mahasiswa') ?: 0,
            'syarat_masuk' => $this->input->post('syarat_masuk'),
            'kontak_person' => $this->input->post('kontak_person'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'website' => $this->input->post('website'),
            'alamat' => $this->input->post('alamat'),
            'kepala_prodi' => $this->input->post('kepala_prodi'),
            'sekretaris_prodi' => $this->input->post('sekretaris_prodi'),
            'jumlah_dosen' => $this->input->post('jumlah_dosen') ?: 0,
            'jumlah_mahasiswa_aktif' => $this->input->post('jumlah_mahasiswa_aktif') ?: 0,
            'jumlah_alumni' => $this->input->post('jumlah_alumni') ?: 0,
            'tingkat_kepuasan_mahasiswa' => $this->input->post('tingkat_kepuasan_mahasiswa'),
            'tingkat_kelulusan' => $this->input->post('tingkat_kelulusan'),
            'lama_tunggu_kerja' => $this->input->post('lama_tunggu_kerja'),
            'icon' => $this->input->post('icon') ?: 'fas fa-graduation-cap',
            'warna' => $this->input->post('warna') ?: '#00B9AD',
            'urutan' => $this->input->post('urutan') ?: 0,
            'is_featured' => $this->input->post('is_featured') ? 1 : 0,
            'is_published' => $this->input->post('is_published') ? 1 : 0,
            'seo_title' => $this->input->post('seo_title'),
            'seo_description' => $this->input->post('seo_description'),
            'seo_keywords' => $this->input->post('seo_keywords'),
            'status' => $this->input->post('status') ?: 'aktif',
            'updated_by' => $this->session->userdata('user_id')
        ];



        if ($this->M_prodi->update($id, $data)) {
            $this->session->set_flashdata('success', 'Program Studi berhasil diperbarui.');
            redirect('admin/prodi');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui Program Studi.');
            $this->edit($id);
        }
    }

    // Hapus program studi (soft delete)
    public function delete($id = null)
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
        }

        $prodi = $this->M_prodi->get_by_id($id);

        if (!$prodi) {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Program Studi tidak ditemukan.']));
                return;
            } else {
                $this->session->set_flashdata('error', 'Program Studi tidak ditemukan.');
                redirect('paneladmin/prodi');
            }
        }

        if ($this->M_prodi->delete($id)) {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => true, 'message' => 'Program Studi berhasil dihapus.']));
            } else {
                $this->session->set_flashdata('success', 'Program Studi berhasil dihapus.');
                redirect('paneladmin/prodi');
            }
        } else {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Gagal menghapus Program Studi.']));
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus Program Studi.');
                redirect('paneladmin/prodi');
            }
        }
    }

    // Toggle status aktif/nonaktif
    public function toggle_status()
    {
        $id = $this->input->post('id');
        $prodi = $this->M_prodi->get_by_id($id);

        if (!$prodi) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Program Studi tidak ditemukan.']));
            return;
        }

        $new_status = ($prodi->status == 'aktif') ? 'nonaktif' : 'aktif';

        if ($this->M_prodi->update($id, ['status' => $new_status])) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'message' => 'Status berhasil diubah menjadi ' . $new_status . '.']));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Gagal mengubah status.']));
        }
    }

    // Toggle featured
    public function toggle_featured()
    {
        $id = $this->input->post('id');
        $featured = $this->input->post('featured');

        $prodi = $this->M_prodi->get_by_id($id);

        if (!$prodi) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Program Studi tidak ditemukan.']));
            return;
        }

        if ($this->M_prodi->update($id, ['is_featured' => $featured])) {
            $message = $featured ? 'Program Studi berhasil dijadikan featured.' : 'Program Studi berhasil dihapus dari featured.';
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'message' => $message]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Gagal mengubah status featured.']));
        }
    }

    // Bulk actions
    public function bulk_action()
    {
        $action = $this->input->post('bulk_action');
        $selected_ids = $this->input->post('selected_ids');

        if (empty($selected_ids)) {
            $this->session->set_flashdata('error', 'Tidak ada data yang dipilih.');
            redirect('paneladmin/prodi');
        }

        $success_count = 0;

        switch ($action) {
            case 'activate':
                $success_count = $this->M_prodi->bulk_update_status($selected_ids, 'aktif');
                $message = $success_count . ' Program Studi berhasil diaktifkan.';
                break;

            case 'deactivate':
                $success_count = $this->M_prodi->bulk_update_status($selected_ids, 'nonaktif');
                $message = $success_count . ' Program Studi berhasil dinonaktifkan.';
                break;

            case 'delete':
                foreach ($selected_ids as $id) {
                    if ($this->M_prodi->delete($id)) {
                        $success_count++;
                    }
                }
                $message = $success_count . ' Program Studi berhasil dihapus.';
                break;

            case 'featured':
                foreach ($selected_ids as $id) {
                    if ($this->M_prodi->update($id, ['is_featured' => 1])) {
                        $success_count++;
                    }
                }
                $message = $success_count . ' Program Studi berhasil dijadikan featured.';
                break;

            case 'unfeatured':
                foreach ($selected_ids as $id) {
                    if ($this->M_prodi->update($id, ['is_featured' => 0])) {
                        $success_count++;
                    }
                }
                $message = $success_count . ' Program Studi berhasil dihapus dari featured.';
                break;

            default:
                $this->session->set_flashdata('error', 'Aksi tidak valid.');
                redirect('paneladmin/prodi');
        }

        $this->session->set_flashdata('success', $message);
        redirect('paneladmin/prodi');
    }

    // Detail program studi (AJAX)
    public function detail_ajax($id)
    {
        $prodi = $this->M_prodi->get_by_id($id);

        if (!$prodi) {
            echo '<div class="alert alert-danger">Program Studi tidak ditemukan.</div>';
            return;
        }

        $this->load->view('paneladmin/prodi/detail_modal', ['prodi' => $prodi]);
    }

    // Export data
    public function export()
    {
        $format = $this->input->get('format') ?: 'excel';
        $data = $this->M_prodi->get_all_admin();

        if ($format == 'pdf') {
            $this->export_pdf($data);
        } else {
            $this->export_excel($data);
        }
    }

    private function export_excel($data)
    {
        $filename = 'program_studi_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Header
        fputcsv($output, [
            'ID',
            'Nama Program Studi',
            'Kode',
            'Jenjang',
            'Gelar',
            'Akreditasi',
            'Durasi (Semester)',
            'Total SKS',
            'Status',
            'Featured',
            'Created'
        ]);

        // Data
        foreach ($data as $row) {
            fputcsv($output, [
                $row->id,
                $row->nama_prodi,
                $row->kode_prodi,
                $row->jenjang,
                $row->gelar,
                $row->akreditasi,
                $row->durasi_studi,
                $row->sks_total,
                $row->status,
                $row->is_featured ? 'Ya' : 'Tidak',
                $row->created_at
            ]);
        }

        fclose($output);
        exit;
    }

    // Custom validation untuk kode prodi unik saat update
    public function check_unique_kode_prodi($kode_prodi, $id)
    {
        $existing = $this->db->where('kode_prodi', strtoupper($kode_prodi))
            ->where('id !=', $id)
            ->get('program_studi')->row();

        if ($existing) {
            $this->form_validation->set_message('check_unique_kode_prodi', 'Kode Program Studi sudah digunakan.');
            return FALSE;
        }
        return TRUE;
    }
}
