<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dosen');
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security');

        // Check if user is logged in and has admin access
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Manajemen Dosen';
        $data['page'] = 'admin/dosen/list';
        $data['dosen_count'] = $this->M_dosen->count_all();
        $data['prodi_stats'] = $this->M_dosen->count_by_program_studi();
        $data['status_stats'] = $this->M_dosen->count_by_status();
        $data['csrf_token'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();

        $data['content'] = 'paneladmin/dosen/list';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function ajax_list()
    {
        $list = $this->M_dosen->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $dosen) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $dosen->nidn;
            $row[] = $dosen->nama_gelar;
            $row[] = $dosen->email ? $dosen->email : '-';
            $row[] = $dosen->program_studi ? $dosen->program_studi : '-';
            $row[] = $dosen->jabatan_akademik ? $dosen->jabatan_akademik : '-';
            $row[] = '<span class="badge badge-' . ($dosen->status_aktif == 'Aktif' ? 'success' : 'secondary') . '">' . $dosen->status_aktif . '</span>';

            // Action buttons
            $row[] = '<div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-info" onclick="view_dosen(' . $dosen->id . ')" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="edit_dosen(' . $dosen->id . ')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="delete_dosen(' . $dosen->id . ')" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                      </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dosen->count_all(),
            "recordsFiltered" => $this->M_dosen->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function get_csrf_token()
    {
        $csrf_token = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();

        echo json_encode(array(
            'csrf_token' => $csrf_token,
            'csrf_hash' => $csrf_hash
        ));
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $this->_validate_dosen();

            if ($this->form_validation->run() === FALSE) {
                $response = array(
                    'success' => false,
                    'message' => validation_errors()
                );
                echo json_encode($response);
                return;
            }

            // Handle foto upload
            $foto_name = '';
            if (!empty($_FILES['foto']['name'])) {
                $foto_name = $this->_upload_foto('foto');
                if (!$foto_name) {
                    $response = array(
                        'success' => false,
                        'message' => 'Gagal mengupload foto'
                    );
                    echo json_encode($response);
                    return;
                }
            }

            $data = array(
                'nidn' => $this->input->post('nidn'),
                'nip' => $this->input->post('nip'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'gelar_depan' => $this->input->post('gelar_depan'),
                'gelar_belakang' => $this->input->post('gelar_belakang'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'agama' => $this->input->post('agama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'email' => $this->input->post('email'),
                'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
                'bidang_keahlian' => $this->input->post('bidang_keahlian'),
                'program_studi' => $this->input->post('program_studi'),
                'jabatan_akademik' => $this->input->post('jabatan_akademik'),
                'jabatan_struktural' => $this->input->post('jabatan_struktural'),
                'status_kepegawaian' => $this->input->post('status_kepegawaian'),
                'status_aktif' => $this->input->post('status_aktif'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'foto' => $foto_name,
                'created_by' => $this->ion_auth->user()->row()->id,
                'created_at' => date('Y-m-d H:i:s')
            );

            $insert = $this->M_dosen->insert($data);

            if ($insert) {
                $response = array(
                    'success' => true,
                    'message' => 'Data dosen berhasil ditambahkan'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Gagal menambahkan data dosen'
                );
            }

            echo json_encode($response);
        } else {
            $data['title'] = 'Tambah Dosen';
            $data['page'] = 'admin/dosen/form';
            $data['action'] = 'add';
            $data['csrf_token'] = $this->security->get_csrf_token_name();
            $data['csrf_hash'] = $this->security->get_csrf_hash();
            $data['dosen'] = (object) array(
                'id' => '',
                'nidn' => '',
                'nip' => '',
                'nama_lengkap' => '',
                'gelar_depan' => '',
                'gelar_belakang' => '',
                'tempat_lahir' => '',
                'tanggal_lahir' => '',
                'jenis_kelamin' => 'L',
                'agama' => '',
                'alamat' => '',
                'telepon' => '',
                'email' => '',
                'pendidikan_terakhir' => 'S2',
                'bidang_keahlian' => '',
                'program_studi' => '',
                'jabatan_akademik' => '',
                'jabatan_struktural' => '',
                'status_kepegawaian' => 'Tetap',
                'status_aktif' => 'Aktif',
                'tanggal_masuk' => ''
            );

            $data['content'] = 'paneladmin/dosen/form';
            $this->load->view('layouts/adminlte3', $data);
        }
    }

    public function edit($id)
    {
        if ($this->input->method() === 'post') {
            $this->_validate_dosen($id);

            if ($this->form_validation->run() === FALSE) {
                $response = array(
                    'success' => false,
                    'message' => validation_errors()
                );
                echo json_encode($response);
                return;
            }

            // Handle foto upload
            $foto_name = '';
            if (!empty($_FILES['foto']['name'])) {
                // Get old foto to delete later
                $old_dosen = $this->M_dosen->get_by_id($id);
                $old_foto = $old_dosen->foto;

                $foto_name = $this->_upload_foto('foto');
                if (!$foto_name) {
                    $response = array(
                        'success' => false,
                        'message' => 'Gagal mengupload foto'
                    );
                    echo json_encode($response);
                    return;
                } else {
                    // Delete old foto if exists
                    if ($old_foto && file_exists('./uploads/foto/' . $old_foto)) {
                        unlink('./uploads/foto/' . $old_foto);
                    }
                }
            }

            $data = array(
                'nidn' => $this->input->post('nidn'),
                'nip' => $this->input->post('nip'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'gelar_depan' => $this->input->post('gelar_depan'),
                'gelar_belakang' => $this->input->post('gelar_belakang'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'agama' => $this->input->post('agama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'email' => $this->input->post('email'),
                'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
                'bidang_keahlian' => $this->input->post('bidang_keahlian'),
                'program_studi' => $this->input->post('program_studi'),
                'jabatan_akademik' => $this->input->post('jabatan_akademik'),
                'jabatan_struktural' => $this->input->post('jabatan_struktural'),
                'status_kepegawaian' => $this->input->post('status_kepegawaian'),
                'status_aktif' => $this->input->post('status_aktif'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'updated_by' => $this->ion_auth->user()->row()->id,
                'updated_at' => date('Y-m-d H:i:s')
            );

            // Add foto to data if uploaded
            if ($foto_name) {
                $data['foto'] = $foto_name;
            }

            $update = $this->M_dosen->update($id, $data);

            if ($update) {
                $response = array(
                    'success' => true,
                    'message' => 'Data dosen berhasil diperbarui'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Gagal memperbarui data dosen'
                );
            }

            echo json_encode($response);
        } else {
            $dosen = $this->M_dosen->get_by_id($id);

            if (!$dosen) {
                show_404();
            }

            $data['title'] = 'Edit Dosen';
            $data['page'] = 'admin/dosen/form';
            $data['action'] = 'edit';
            $data['csrf_token'] = $this->security->get_csrf_token_name();
            $data['csrf_hash'] = $this->security->get_csrf_hash();
            $data['dosen'] = $dosen;

            $data['content'] = 'paneladmin/dosen/form';
            $this->load->view('layouts/adminlte3', $data);
        }
    }

    public function view($id)
    {
        $dosen = $this->M_dosen->get_by_id($id);

        if (!$dosen) {
            echo json_encode(array('success' => false, 'message' => 'Data tidak ditemukan'));
            return;
        }

        // Get additional data
        $dosen->pendidikan = $this->M_dosen->get_pendidikan_by_dosen($id);
        $dosen->matakuliah = $this->M_dosen->get_matakuliah_by_dosen($id);

        echo json_encode(array('success' => true, 'data' => $dosen));
    }

    public function delete($id)
    {
        $dosen = $this->M_dosen->get_by_id($id);

        if (!$dosen) {
            $response = array(
                'success' => false,
                'message' => 'Data tidak ditemukan'
            );
            echo json_encode($response);
            return;
        }

        $delete = $this->M_dosen->delete($id);

        if ($delete) {
            $response = array(
                'success' => true,
                'message' => 'Data dosen berhasil dihapus'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Gagal menghapus data dosen'
            );
        }

        echo json_encode($response);
    }

    private function _validate_dosen($id = null)
    {
        $this->form_validation->set_rules('nidn', 'NIDN', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('program_studi', 'Program Studi', 'required');
        $this->form_validation->set_rules('status_kepegawaian', 'Status Kepegawaian', 'required');
        $this->form_validation->set_rules('status_aktif', 'Status Aktif', 'required');

        if ($this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
        }

        // Check NIDN uniqueness
        $nidn = $this->input->post('nidn');
        if ($this->M_dosen->check_nidn_exists($nidn, $id)) {
            $this->form_validation->set_rules('nidn', 'NIDN', 'required|callback_check_nidn_exists');
        }

        // Check email uniqueness
        $email = $this->input->post('email');
        if ($email && $this->M_dosen->check_email_exists($email, $id)) {
            $this->form_validation->set_rules('email', 'Email', 'callback_check_email_exists');
        }
    }

    public function check_nidn_exists($nidn)
    {
        $id = $this->input->post('id');
        if ($this->M_dosen->check_nidn_exists($nidn, $id)) {
            $this->form_validation->set_message('check_nidn_exists', 'NIDN sudah digunakan');
            return FALSE;
        }
        return TRUE;
    }

    public function check_email_exists($email)
    {
        $id = $this->input->post('id');
        if ($this->M_dosen->check_email_exists($email, $id)) {
            $this->form_validation->set_message('check_email_exists', 'Email sudah digunakan');
            return FALSE;
        }
        return TRUE;
    }

    public function report()
    {
        $data['title'] = 'Laporan Dosen';
        $data['page'] = 'admin/dosen/report';
        $data['total_dosen'] = $this->M_dosen->count_all();
        $data['prodi_stats'] = $this->M_dosen->count_by_program_studi();
        $data['status_stats'] = $this->M_dosen->count_by_status();

        $this->load->view('admin/layout', $data);
    }

    public function export_excel()
    {
        $this->load->library('excel');

        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('Sistem Manajemen Jurusan')
            ->setLastModifiedBy('Admin')
            ->setTitle('Data Dosen')
            ->setSubject('Export Data Dosen')
            ->setDescription('Export data dosen dari sistem manajemen jurusan');

        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIDN');
        $sheet->setCellValue('C1', 'Nama Lengkap');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Program Studi');
        $sheet->setCellValue('F1', 'Jabatan Akademik');
        $sheet->setCellValue('G1', 'Status Kepegawaian');
        $sheet->setCellValue('H1', 'Status Aktif');

        // Data
        $dosen_list = $this->M_dosen->get_all();
        $row = 2;
        $no = 1;

        foreach ($dosen_list as $dosen) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $dosen->nidn);
            $sheet->setCellValue('C' . $row, $dosen->nama_gelar);
            $sheet->setCellValue('D' . $row, $dosen->email);
            $sheet->setCellValue('E' . $row, $dosen->program_studi);
            $sheet->setCellValue('F' . $row, $dosen->jabatan_akademik);
            $sheet->setCellValue('G' . $row, $dosen->status_kepegawaian);
            $sheet->setCellValue('H' . $row, $dosen->status_aktif);
            $row++;
            $no++;
        }

        $filename = 'data_dosen_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
    }

    // Methods untuk manajemen pendidikan dosen
    public function pendidikan($dosen_id)
    {
        $dosen = $this->M_dosen->get_by_id($dosen_id);

        if (!$dosen) {
            show_404();
        }

        $data['title'] = 'Pendidikan Dosen - ' . $dosen->nama_lengkap;
        $data['page'] = 'admin/dosen/pendidikan';
        $data['dosen'] = $dosen;
        $data['pendidikan_list'] = $this->M_dosen->get_pendidikan_by_dosen($dosen_id);

        $this->load->view('admin/layout', $data);
    }

    public function add_pendidikan()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('dosen_id', 'Dosen', 'required');
            $this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
            $this->form_validation->set_rules('nama_institusi', 'Nama Institusi', 'required');

            if ($this->form_validation->run() === FALSE) {
                $response = array('success' => false, 'message' => validation_errors());
                echo json_encode($response);
                return;
            }

            $data = array(
                'dosen_id' => $this->input->post('dosen_id'),
                'jenjang' => $this->input->post('jenjang'),
                'nama_institusi' => $this->input->post('nama_institusi'),
                'program_studi' => $this->input->post('program_studi'),
                'tahun_lulus' => $this->input->post('tahun_lulus'),
                'gelar' => $this->input->post('gelar')
            );

            $insert = $this->M_dosen->insert_pendidikan($data);

            if ($insert) {
                $response = array('success' => true, 'message' => 'Data pendidikan berhasil ditambahkan');
            } else {
                $response = array('success' => false, 'message' => 'Gagal menambahkan data pendidikan');
            }

            echo json_encode($response);
        }
    }

    // Methods untuk manajemen mata kuliah dosen
    public function matakuliah($dosen_id)
    {
        $dosen = $this->M_dosen->get_by_id($dosen_id);

        if (!$dosen) {
            show_404();
        }

        $data['title'] = 'Mata Kuliah Dosen - ' . $dosen->nama_lengkap;
        $data['page'] = 'admin/dosen/matakuliah';
        $data['dosen'] = $dosen;
        $data['matakuliah_list'] = $this->M_dosen->get_matakuliah_by_dosen($dosen_id);

        $this->load->view('admin/layout', $data);
    }

    public function add_matakuliah()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('dosen_id', 'Dosen', 'required');
            $this->form_validation->set_rules('kode_matakuliah', 'Kode Mata Kuliah', 'required');
            $this->form_validation->set_rules('nama_matakuliah', 'Nama Mata Kuliah', 'required');

            if ($this->form_validation->run() === FALSE) {
                $response = array('success' => false, 'message' => validation_errors());
                echo json_encode($response);
                return;
            }

            $data = array(
                'dosen_id' => $this->input->post('dosen_id'),
                'kode_matakuliah' => $this->input->post('kode_matakuliah'),
                'nama_matakuliah' => $this->input->post('nama_matakuliah'),
                'sks' => $this->input->post('sks'),
                'semester' => $this->input->post('semester'),
                'tahun_akademik' => $this->input->post('tahun_akademik')
            );

            $insert = $this->M_dosen->insert_matakuliah($data);

            if ($insert) {
                $response = array('success' => true, 'message' => 'Data mata kuliah berhasil ditambahkan');
            } else {
                $response = array('success' => false, 'message' => 'Gagal menambahkan data mata kuliah');
            }

            echo json_encode($response);
        }
    }

    public function import_excel()
    {
        if ($this->input->method() === 'post') {
            $config['upload_path'] = './uploads/temp/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = 2048;
            $config['file_name'] = 'import_dosen_' . time();

            // Create upload directory if not exists
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file_excel')) {
                $response = array(
                    'success' => false,
                    'message' => $this->upload->display_errors('', '')
                );
            } else {
                $file_data = $this->upload->data();
                $file_path = $file_data['full_path'];

                // Load PHPExcel library
                require_once FCPATH . 'vendor/autoload.php';

                try {
                    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_path);
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                    $spreadsheet = $reader->load($file_path);
                    $worksheet = $spreadsheet->getActiveSheet();

                    $rows = $worksheet->toArray();

                    // Skip header row
                    array_shift($rows);

                    $success_count = 0;
                    $error_count = 0;
                    $errors = array();

                    foreach ($rows as $index => $row) {
                        // Skip empty rows
                        if (empty(array_filter($row))) {
                            continue;
                        }

                        $row_number = $index + 2; // +2 because we removed header and array is 0-indexed

                        // Validate required fields
                        if (empty($row[0]) || empty($row[2])) {
                            $errors[] = "Baris $row_number: NIDN dan Nama Lengkap wajib diisi";
                            $error_count++;
                            continue;
                        }

                        // Check if NIDN already exists
                        if ($this->M_dosen->check_nidn_exists($row[0])) {
                            $errors[] = "Baris $row_number: NIDN {$row[0]} sudah ada dalam database";
                            $error_count++;
                            continue;
                        }

                        // Check email format if provided
                        if (!empty($row[8]) && !valid_email($row[8])) {
                            $errors[] = "Baris $row_number: Format email tidak valid";
                            $error_count++;
                            continue;
                        }

                        // Check if email already exists
                        if (!empty($row[8]) && $this->M_dosen->check_email_exists($row[8])) {
                            $errors[] = "Baris $row_number: Email {$row[8]} sudah ada dalam database";
                            $error_count++;
                            continue;
                        }

                        $data = array(
                            'nidn' => $row[0],
                            'nip' => $row[1] ?? '',
                            'nama_lengkap' => $row[2],
                            'gelar_depan' => $row[3] ?? '',
                            'gelar_belakang' => $row[4] ?? '',
                            'tempat_lahir' => $row[5] ?? '',
                            'tanggal_lahir' => !empty($row[6]) ? date('Y-m-d', strtotime($row[6])) : null,
                            'jenis_kelamin' => !empty($row[7]) ? $row[7] : 'L',
                            'agama' => $row[8] ?? '',
                            'alamat' => $row[9] ?? '',
                            'telepon' => $row[10] ?? '',
                            'email' => $row[11] ?? '',
                            'pendidikan_terakhir' => !empty($row[12]) ? $row[12] : 'S2',
                            'bidang_keahlian' => $row[13] ?? '',
                            'program_studi' => $row[14] ?? '',
                            'jabatan_akademik' => $row[15] ?? '',
                            'jabatan_struktural' => $row[16] ?? '',
                            'status_kepegawaian' => !empty($row[17]) ? $row[17] : 'Tetap',
                            'status_aktif' => !empty($row[18]) ? $row[18] : 'Aktif',
                            'tanggal_masuk' => !empty($row[19]) ? date('Y-m-d', strtotime($row[19])) : null,
                            'created_by' => $this->ion_auth->user()->row()->id,
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        if ($this->M_dosen->insert($data)) {
                            $success_count++;
                        } else {
                            $errors[] = "Baris $row_number: Gagal menyimpan data ke database";
                            $error_count++;
                        }
                    }

                    // Delete uploaded file
                    unlink($file_path);

                    $message = "Import selesai. Berhasil: $success_count, Gagal: $error_count";
                    if (!empty($errors)) {
                        $message .= "\n\nDetail Error:\n" . implode("\n", array_slice($errors, 0, 10));
                        if (count($errors) > 10) {
                            $message .= "\ndan " . (count($errors) - 10) . " error lainnya...";
                        }
                    }

                    $response = array(
                        'success' => $success_count > 0,
                        'message' => $message,
                        'success_count' => $success_count,
                        'error_count' => $error_count,
                        'errors' => $errors
                    );
                } catch (Exception $e) {
                    unlink($file_path);
                    $response = array(
                        'success' => false,
                        'message' => 'Error membaca file Excel: ' . $e->getMessage()
                    );
                }
            }

            echo json_encode($response);
        }
    }

    public function download_template()
    {
        require_once FCPATH . 'vendor/autoload.php';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = array(
            'A1' => 'NIDN*',
            'B1' => 'NIP',
            'C1' => 'Nama Lengkap*',
            'D1' => 'Gelar Depan',
            'E1' => 'Gelar Belakang',
            'F1' => 'Tempat Lahir',
            'G1' => 'Tanggal Lahir (YYYY-MM-DD)',
            'H1' => 'Jenis Kelamin (L/P)',
            'I1' => 'Agama',
            'J1' => 'Alamat',
            'K1' => 'Telepon',
            'L1' => 'Email',
            'M1' => 'Pendidikan Terakhir',
            'N1' => 'Bidang Keahlian',
            'O1' => 'Program Studi',
            'P1' => 'Jabatan Akademik',
            'Q1' => 'Jabatan Struktural',
            'R1' => 'Status Kepegawaian',
            'S1' => 'Status Aktif',
            'T1' => 'Tanggal Masuk (YYYY-MM-DD)'
        );

        foreach ($headers as $cell => $value) {
            $worksheet->setCellValue($cell, $value);
        }

        // Style headers
        $worksheet->getStyle('A1:T1')->getFont()->setBold(true);
        $worksheet->getStyle('A1:T1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $worksheet->getStyle('A1:T1')->getFill()->getStartColor()->setARGB('FFE0E0E0');

        // Auto-size columns
        foreach (range('A', 'T') as $col) {
            $worksheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Add sample data
        $worksheet->setCellValue('A2', '1234567890123456');
        $worksheet->setCellValue('B2', '196001011980031001');
        $worksheet->setCellValue('C2', 'Dr. John Doe, M.T.');
        $worksheet->setCellValue('D2', 'Dr.');
        $worksheet->setCellValue('E2', 'M.T.');
        $worksheet->setCellValue('F2', 'Jakarta');
        $worksheet->setCellValue('G2', '1980-01-01');
        $worksheet->setCellValue('H2', 'L');
        $worksheet->setCellValue('I2', 'Islam');
        $worksheet->setCellValue('J2', 'Jl. Contoh No. 123');
        $worksheet->setCellValue('K2', '08123456789');
        $worksheet->setCellValue('L2', 'john.doe@example.com');
        $worksheet->setCellValue('M2', 'S3');
        $worksheet->setCellValue('N2', 'Teknik Informatika');
        $worksheet->setCellValue('O2', 'Teknik Informatika');
        $worksheet->setCellValue('P2', 'Lektor Kepala');
        $worksheet->setCellValue('Q2', 'Ketua Program Studi');
        $worksheet->setCellValue('R2', 'Tetap');
        $worksheet->setCellValue('S2', 'Aktif');
        $worksheet->setCellValue('T2', '2020-01-01');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $filename = 'Template_Import_Dosen_' . date('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    private function _upload_foto($field_name)
    {
        $config['upload_path'] = './uploads/foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'dosen_' . time() . '_' . rand(1000, 9999);

        // Create upload directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field_name)) {
            $upload_data = $this->upload->data();
            return $upload_data['file_name'];
        } else {
            return false;
        }
    }
}
