<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->library(['form_validation', 'upload', 'session']);
        $this->load->helper(['url', 'form', 'file', 'text']);

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }
    }

    public function index()
    {
        $data['settings'] = $this->M_settings->get_all_settings();
        $data['title'] = 'Pengaturan Sistem | Admin Panel';
        $data['content'] = 'paneladmin/settings/store';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function edit($id)
    {
        $settings = $this->M_settings->get_setting_by_id($id);
        if (!$settings) {
            $this->session->set_flashdata('error', 'Data pengaturan tidak ditemukan!');
            redirect('admin/settings');
        }

        $data['settings'] = $settings;
        $data['title'] = 'Edit Pengaturan | Admin Panel';
        $data['content'] = 'paneladmin/settings/edit';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function update($id)
    {
        // Validasi input
        $this->form_validation->set_rules('name', 'Nama Aplikasi', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|max_length[500]');
        $this->form_validation->set_rules('company', 'Nama Perusahaan', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('address', 'Alamat', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim|regex_match[/^[\d\-\+\(\)\s]+$/]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        // Ambil data lama untuk backup
        $old_settings = $this->M_settings->get_setting_by_id($id);
        if (!$old_settings) {
            $this->session->set_flashdata('error', 'Data pengaturan tidak ditemukan!');
            redirect('admin/settings');
        }

        // Siapkan data untuk update
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'company' => $this->input->post('company'),
            'address' => $this->input->post('address'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        // Handle upload logo jika ada file
        if (!empty($_FILES['logo']['name'])) {
            $upload_result = $this->_handle_logo_upload($old_settings->logo);

            if ($upload_result['status']) {
                $data['logo'] = $upload_result['file_name'];
            } else {
                $this->session->set_flashdata('error', $upload_result['message']);
                $this->edit($id);
                return;
            }
        }

        // Update data ke database
        $update_result = $this->M_settings->update_setting($id, $data);

        if ($update_result) {
            $this->session->set_flashdata('success', 'Pengaturan berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui pengaturan!');
        }

        redirect('admin/settings');
    }

    public function create()
    {
        $data['title'] = 'Tambah Pengaturan | Admin Panel';
        $data['content'] = 'paneladmin/settings/create';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function store()
    {
        // Validasi input
        $this->form_validation->set_rules('name', 'Nama Aplikasi', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim|max_length[500]');
        $this->form_validation->set_rules('company', 'Nama Perusahaan', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('address', 'Alamat', 'required|trim|max_length[200]');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim|regex_match[/^[\d\-\+\(\)\s]+$/]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
            return;
        }

        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'company' => $this->input->post('company'),
            'address' => $this->input->post('address'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        // Handle upload logo
        if (!empty($_FILES['logo']['name'])) {
            $upload_result = $this->_handle_logo_upload();

            if ($upload_result['status']) {
                $data['logo'] = $upload_result['file_name'];
            } else {
                $this->session->set_flashdata('error', $upload_result['message']);
                $this->create();
                return;
            }
        }

        $insert_result = $this->M_settings->insert_setting($data);

        if ($insert_result) {
            $this->session->set_flashdata('success', 'Pengaturan berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan pengaturan!');
        }

        redirect('admin/settings');
    }

    public function delete($id)
    {
        $settings = $this->M_settings->get_setting_by_id($id);
        if (!$settings) {
            $this->session->set_flashdata('error', 'Data pengaturan tidak ditemukan!');
            redirect('admin/settings');
        }

        // Hapus file logo jika ada
        if (!empty($settings->logo) && file_exists('./assets/uploads/settings/' . $settings->logo)) {
            unlink('./assets/uploads/settings/' . $settings->logo);
        }

        $delete_result = $this->M_settings->delete_setting($id);

        if ($delete_result) {
            $this->session->set_flashdata('success', 'Pengaturan berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pengaturan!');
        }

        redirect('admin/settings');
    }

    private function _handle_logo_upload($old_logo = null)
    {
        // Pastikan folder upload ada
        $upload_path = './assets/uploads/settings/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        // Konfigurasi upload
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|svg';
        $config['max_size'] = 2048; // 2MB
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('logo')) {
            return array(
                'status' => false,
                'message' => 'Error upload logo: ' . $this->upload->display_errors('', '')
            );
        }

        $upload_data = $this->upload->data();

        // Hapus logo lama jika ada dan berbeda
        if (!empty($old_logo) && file_exists($upload_path . $old_logo)) {
            unlink($upload_path . $old_logo);
        }

        return array(
            'status' => true,
            'file_name' => $upload_data['file_name'],
            'message' => 'Logo berhasil diupload'
        );
    }
}
