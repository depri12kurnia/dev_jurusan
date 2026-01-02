<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->model('M_log_user');
        $this->load->model('M_ddownload');

        $this->load->library('upload'); // Load library upload

        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }
    }

    public function index()
    {
        $data['website'] = $this->M_settings->get_all_settings();
        $data['category'] = $this->M_ddownload->get_category();
        $data['type'] = $this->M_ddownload->get_type();
        $data['title'] = 'Downloads | Admin Panel';
        $data['content'] = 'paneladmin/download/list';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function ajax_list()
    {
        // Get CSRF token from header or POST data
        $csrf_token = $this->input->server('HTTP_X_CSRF_TOKEN');
        if (empty($csrf_token)) {
            $csrf_token = $this->input->post($this->security->get_csrf_token_name());
        }

        $valid_token = $this->security->get_csrf_hash();

        if (empty($csrf_token)) {
            log_message('error', 'CSRF Token kosong, periksa apakah dikirim dari frontend.');
        }

        if ($csrf_token !== $valid_token) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid CSRF Token']);
            exit();
        }

        // Get filter parameters
        $category_filter = $this->input->post('category_filter');
        $type_filter = $this->input->post('type_filter');

        // Pass filters to model
        $list = $this->M_ddownload->get_datatables($category_filter, $type_filter);
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $x) {
            $row = array();
            $row[] = $no++;
            $row[] = $x->category_name;
            $row[] = $x->type_name;
            $row[] = $x->name;
            $row[] = $x->name_files;
            $row[] = '<div class="action-buttons">
                        <a class="btn btn-success btn-sm" href="javascript:void(0)" title="Lihat File" onclick="view_file(' . "'" . $x->name_files . "', '" . addslashes($x->name) . "'" . ')">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_download(' . "'" . $x->id . "'" . ')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0)" title="Delete" onclick="delete_download(' . "'" . $x->id . "'" . ')">
                            <i class="fa fa-trash"></i>
                        </a>
                      </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_ddownload->count_all(),
            "recordsFiltered" => $this->M_ddownload->count_filtered($category_filter, $type_filter),
            "data" => $data,
            "csrf_token" => $this->security->get_csrf_hash() // Kirim token CSRF baru
        );
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $this->validate_csrf();
        $this->_validate();

        $user = $this->ion_auth->user()->row();

        if (empty($_FILES['filesname']['name'])) {
            echo json_encode(["status" => false, "inputerror" => ["filesname"], "error_string" => ["File tidak boleh kosong"]]);
            exit;
        }

        // Validate file size before upload
        if ($_FILES['filesname']['size'] > 5242880) { // 5MB = 5242880 bytes
            echo json_encode(["status" => false, "inputerror" => ["filesname"], "error_string" => ["Ukuran file melebihi 5MB"]]);
            exit;
        }

        // Validate file type
        $file_ext = strtolower(pathinfo($_FILES['filesname']['name'], PATHINFO_EXTENSION));
        if ($file_ext !== 'pdf') {
            echo json_encode(["status" => false, "inputerror" => ["filesname"], "error_string" => ["Hanya file PDF yang diperbolehkan"]]);
            exit;
        }

        // Handle Upload File
        $filenames = $this->_upload_filesname();

        if (!$filenames) {
            echo json_encode(["status" => false, "inputerror" => ["filesname"], "error_string" => ["Gagal mengupload file"]]);
            exit;
        }

        $name = $this->input->post('name');

        $data = array(
            'd_category_id'   => $this->input->post('d_category_id'),
            'd_type_id'       => $this->input->post('d_type_id'),
            'name'            => $name,
            'name_files'      => $filenames,
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        );

        $this->M_ddownload->insert_download($data);

        $user = $this->ion_auth->user()->row();
        $this->M_log_user->save_log($user->id, 'Add Download');

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_edit($id)
    {
        $data = $this->M_ddownload->get_by_id($id);
        echo json_encode($data);
    }


    public function ajax_update()
    {
        $this->validate_csrf();
        $this->_validate();

        $user = $this->ion_auth->user()->row();

        $id = $this->input->post('id');
        $download = $this->M_ddownload->get_by_id($id);

        // Cek apakah ada file baru diupload
        $filename = !empty($_FILES['filesname']['name']) ? $this->_upload_filesname($download->name_files) : $download->name_files;

        $name = $this->input->post('name');

        $data = array(
            'd_category_id' => $this->input->post('d_category_id'),
            'd_type_id'     => $this->input->post('d_type_id'),
            'name'          => $name,
            'name_files'    => $filename,
            'updated_at'    => date('Y-m-d H:i:s')
        );

        $this->M_ddownload->update_download($id, $data);

        $user = $this->ion_auth->user()->row();
        $this->M_log_user->save_log($user->id, 'Update Download');

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_delete($id)
    {
        $this->validate_csrf();

        // Ambil data download sebelum dihapus
        $download = $this->M_ddownload->get_by_id($id);

        if (!$download) {
            echo json_encode(["status" => false, "error" => "Data tidak ditemukan."]);
            exit;
        }

        // Path lokasi penyimpanan file
        $file_path = FCPATH . 'public/uploads/files/' . $download->name_files;

        // Hapus file jika ada
        if (!empty($download->name_files) && file_exists($file_path)) {
            unlink($file_path);
        }

        // Hapus download dari database
        $this->M_ddownload->delete_download($id);

        // Mendapatkan user yang login
        $user = $this->ion_auth->user()->row();

        // Simpan log aktivitas
        $this->M_log_user->save_log($user->id, 'Delete Download');

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash() // Kirim token CSRF baru
        ]);
    }


    private function _upload_filesname($old_filesname = null)
    {
        // Pastikan direktori upload ada
        if (!is_dir('./public/uploads/files/')) {
            mkdir('./public/uploads/files/', 0755, true);
        }

        $config['upload_path']   = './public/uploads/files/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = 8000; // Maksimum 8MB (8192 KB)
        $config['max_width']     = 0; // No limit for PDF
        $config['max_height']    = 0; // No limit for PDF
        $config['file_name']     = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['filesname']['name']);
        $config['encrypt_name']  = TRUE; // Keep original name with timestamp
        $config['remove_spaces'] = TRUE; // Remove spaces from filename

        $this->upload->initialize($config);

        if ($this->upload->do_upload('filesname')) {
            $upload_data = $this->upload->data();

            // Hapus file lama jika ada dan upload berhasil
            if ($old_filesname && file_exists('./public/uploads/files/' . $old_filesname)) {
                unlink('./public/uploads/files/' . $old_filesname);
            }

            return $upload_data['file_name']; // Return nama file baru
        } else {
            // Jika gagal upload, return false
            return false;
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $name = $this->input->post('name');
        $category = $this->input->post('d_category_id');
        $type = $this->input->post('d_type_id');

        if (empty($category)) {
            $data['inputerror'][] = 'd_category_id';
            $data['error_string'][] = 'Kategori harus dipilih';
            $data['status'] = FALSE;
        }

        if (empty($type)) {
            $data['inputerror'][] = 'd_type_id';
            $data['error_string'][] = 'Tipe harus dipilih';
            $data['status'] = FALSE;
        }

        if (empty($name)) {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Nama file harus diisi';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }


    private function validate_csrf()
    {
        // Get CSRF token from header or POST data
        $csrf_token = $this->input->server('HTTP_X_CSRF_TOKEN');
        if (empty($csrf_token)) {
            $csrf_token = $this->input->post($this->security->get_csrf_token_name());
        }

        $valid_token = $this->security->get_csrf_hash();

        if ($csrf_token !== $valid_token) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid CSRF Token']);
            exit();
        }
    }

    public function view_file($filename)
    {
        // Validate admin access
        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }

        // Sanitize filename to prevent directory traversal
        $filename = basename($filename);
        $file_path = FCPATH . 'public/uploads/files/' . $filename;

        // Check if file exists
        if (!file_exists($file_path)) {
            show_404();
            return;
        }

        // Check if it's a PDF file
        $file_info = pathinfo($file_path);
        if (strtolower($file_info['extension']) !== 'pdf') {
            show_error('File type not allowed', 403);
            return;
        }

        // Set appropriate headers for PDF display
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file_path));
        header('Accept-Ranges: bytes');

        // Output the file
        readfile($file_path);
    }

    public function download_file($filename)
    {
        // Validate admin access
        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }

        // Sanitize filename to prevent directory traversal
        $filename = basename($filename);
        $file_path = FCPATH . 'public/uploads/files/' . $filename;

        // Check if file exists
        if (!file_exists($file_path)) {
            show_404();
            return;
        }

        // Check if it's a PDF file
        $file_info = pathinfo($file_path);
        if (strtolower($file_info['extension']) !== 'pdf') {
            show_error('File type not allowed', 403);
            return;
        }

        // Force download
        $this->load->helper('download');
        force_download($filename, file_get_contents($file_path));
    }
}
