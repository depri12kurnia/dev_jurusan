<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_staf');
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
        $data['title'] = 'Manajemen Staf';
        $data['page'] = 'admin/staf/list';
        $data['staf_count'] = $this->M_staf->count_all();
        $data['divisi_stats'] = $this->M_staf->count_by_divisi();
        $data['status_stats'] = $this->M_staf->count_by_status();
        $data['csrf_token'] = $this->security->get_csrf_token_name();
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        $data['content'] = 'paneladmin/staf/list';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function ajax_list()
    {
        $list = $this->M_staf->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $staf) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $staf->nip;
            $row[] = $staf->nama_lengkap;
            $row[] = $staf->email ? $staf->email : '-';
            $row[] = $staf->divisi ? $staf->divisi : '-';
            $row[] = $staf->jabatan ? $staf->jabatan : '-';
            $row[] = '<span class="badge badge-' . ($staf->status_aktif == 'Aktif' ? 'success' : 'secondary') . '">' . $staf->status_aktif . '</span>';

            // Action buttons
            $row[] = '<div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-info" onclick="view_staf(' . $staf->id . ')" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="edit_staf(' . $staf->id . ')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="delete_staf(' . $staf->id . ')" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                      </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_staf->count_all(),
            "recordsFiltered" => $this->M_staf->count_filtered(),
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
            $this->_validate_staf();

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
                'nip' => $this->input->post('nip'),
                'nik' => $this->input->post('nik'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'agama' => $this->input->post('agama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'email' => $this->input->post('email'),
                'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
                'jurusan_pendidikan' => $this->input->post('jurusan_pendidikan'),
                'divisi' => $this->input->post('divisi'),
                'jabatan' => $this->input->post('jabatan'),
                'golongan' => $this->input->post('golongan'),
                'pangkat' => $this->input->post('pangkat'),
                'status_kepegawaian' => $this->input->post('status_kepegawaian'),
                'status_aktif' => $this->input->post('status_aktif'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'keterangan' => $this->input->post('keterangan'),
                'foto' => $foto_name,
                'created_by' => $this->ion_auth->user()->row()->id,
                'created_at' => date('Y-m-d H:i:s')
            );

            $insert = $this->M_staf->insert($data);

            if ($insert) {
                $response = array(
                    'success' => true,
                    'message' => 'Data staf berhasil ditambahkan'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Gagal menambahkan data staf'
                );
            }

            echo json_encode($response);
        } else {
            $data['title'] = 'Tambah Staf';
            $data['page'] = 'admin/staf/form';
            $data['action'] = 'add';
            $data['csrf_token'] = $this->security->get_csrf_token_name();
            $data['csrf_hash'] = $this->security->get_csrf_hash();
            $data['staf'] = (object) array(
                'id' => '',
                'nip' => '',
                'nik' => '',
                'nama_lengkap' => '',
                'tempat_lahir' => '',
                'tanggal_lahir' => '',
                'jenis_kelamin' => 'L',
                'agama' => '',
                'alamat' => '',
                'telepon' => '',
                'email' => '',
                'pendidikan_terakhir' => '',
                'jurusan_pendidikan' => '',
                'divisi' => '',
                'jabatan' => '',
                'golongan' => '',
                'pangkat' => '',
                'status_kepegawaian' => 'Kontrak',
                'status_aktif' => 'Aktif',
                'tanggal_masuk' => '',
                'gaji_pokok' => '',
                'keterangan' => ''
            );

            $data['content'] = 'paneladmin/staf/list';
            $this->load->view('layouts/adminlte3', $data);
        }
    }

    public function edit($id)
    {
        if ($this->input->method() === 'post') {
            $this->_validate_staf($id);

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
                $old_staf = $this->M_staf->get_by_id($id);
                $old_foto = $old_staf->foto;

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
                'nip' => $this->input->post('nip'),
                'nik' => $this->input->post('nik'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'agama' => $this->input->post('agama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'email' => $this->input->post('email'),
                'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
                'jurusan_pendidikan' => $this->input->post('jurusan_pendidikan'),
                'divisi' => $this->input->post('divisi'),
                'jabatan' => $this->input->post('jabatan'),
                'golongan' => $this->input->post('golongan'),
                'pangkat' => $this->input->post('pangkat'),
                'status_kepegawaian' => $this->input->post('status_kepegawaian'),
                'status_aktif' => $this->input->post('status_aktif'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'tanggal_keluar' => $this->input->post('tanggal_keluar'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'keterangan' => $this->input->post('keterangan'),
                'updated_by' => $this->ion_auth->user()->row()->id,
                'updated_at' => date('Y-m-d H:i:s')
            );

            // Add foto to data if uploaded
            if ($foto_name) {
                $data['foto'] = $foto_name;
            }

            $update = $this->M_staf->update($id, $data);

            if ($update) {
                $response = array(
                    'success' => true,
                    'message' => 'Data staf berhasil diperbarui'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Gagal memperbarui data staf'
                );
            }

            echo json_encode($response);
        } else {
            $staf = $this->M_staf->get_by_id($id);

            if (!$staf) {
                show_404();
            }

            $data['title'] = 'Edit Staf';
            $data['page'] = 'admin/staf/form';
            $data['action'] = 'edit';
            $data['csrf_token'] = $this->security->get_csrf_token_name();
            $data['csrf_hash'] = $this->security->get_csrf_hash();
            $data['staf'] = $staf;

            $data['content'] = 'paneladmin/staf/form';
            $this->load->view('layouts/adminlte3', $data);
        }
    }

    public function view($id)
    {
        $staf = $this->M_staf->get_by_id($id);

        if (!$staf) {
            echo json_encode(array('success' => false, 'message' => 'Data tidak ditemukan'));
            return;
        }

        echo json_encode(array('success' => true, 'data' => $staf));
    }

    public function delete($id)
    {
        $staf = $this->M_staf->get_by_id($id);

        if (!$staf) {
            $response = array(
                'success' => false,
                'message' => 'Data tidak ditemukan'
            );
            echo json_encode($response);
            return;
        }

        $delete = $this->M_staf->delete($id);

        if ($delete) {
            $response = array(
                'success' => true,
                'message' => 'Data staf berhasil dihapus'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Gagal menghapus data staf'
            );
        }

        echo json_encode($response);
    }

    private function _validate_staf($id = null)
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('status_kepegawaian', 'Status Kepegawaian', 'required');
        $this->form_validation->set_rules('status_aktif', 'Status Aktif', 'required');

        if ($this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
        }

        // Check NIP uniqueness
        $nip = $this->input->post('nip');
        if ($this->M_staf->check_nip_exists($nip, $id)) {
            $this->form_validation->set_rules('nip', 'NIP', 'required|callback_check_nip_exists');
        }

        // Check email uniqueness
        $email = $this->input->post('email');
        if ($email && $this->M_staf->check_email_exists($email, $id)) {
            $this->form_validation->set_rules('email', 'Email', 'callback_check_email_exists');
        }
    }

    public function check_nip_exists($nip)
    {
        $id = $this->input->post('id');
        if ($this->M_staf->check_nip_exists($nip, $id)) {
            $this->form_validation->set_message('check_nip_exists', 'NIP sudah digunakan');
            return FALSE;
        }
        return TRUE;
    }

    public function check_email_exists($email)
    {
        $id = $this->input->post('id');
        if ($this->M_staf->check_email_exists($email, $id)) {
            $this->form_validation->set_message('check_email_exists', 'Email sudah digunakan');
            return FALSE;
        }
        return TRUE;
    }

    public function report()
    {
        $data['title'] = 'Laporan Staf';
        $data['page'] = 'admin/staf/report';
        $data['total_staf'] = $this->M_staf->count_all();
        $data['divisi_stats'] = $this->M_staf->count_by_divisi();
        $data['status_stats'] = $this->M_staf->count_by_status();
        $data['kepegawaian_stats'] = $this->M_staf->count_by_status_kepegawaian();
        $data['total_gaji'] = $this->M_staf->get_total_gaji();

        $this->load->view('admin/layout', $data);
    }

    public function export_excel()
    {
        $this->load->library('excel');

        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('Sistem Manajemen Jurusan')
            ->setLastModifiedBy('Admin')
            ->setTitle('Data Staf')
            ->setSubject('Export Data Staf')
            ->setDescription('Export data staf dari sistem manajemen jurusan');

        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'Nama Lengkap');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Divisi');
        $sheet->setCellValue('F1', 'Jabatan');
        $sheet->setCellValue('G1', 'Status Kepegawaian');
        $sheet->setCellValue('H1', 'Status Aktif');

        // Data
        $staf_list = $this->M_staf->get_all();
        $row = 2;
        $no = 1;

        foreach ($staf_list as $staf) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $staf->nip);
            $sheet->setCellValue('C' . $row, $staf->nama_lengkap);
            $sheet->setCellValue('D' . $row, $staf->email);
            $sheet->setCellValue('E' . $row, $staf->divisi);
            $sheet->setCellValue('F' . $row, $staf->jabatan);
            $sheet->setCellValue('G' . $row, $staf->status_kepegawaian);
            $sheet->setCellValue('H' . $row, $staf->status_aktif);
            $row++;
            $no++;
        }

        $filename = 'data_staf_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
    }

    public function import_excel()
    {
        if ($this->input->method() === 'post') {
            $config['upload_path'] = './uploads/temp/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = 2048;
            $config['file_name'] = 'import_staf_' . time();

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
                            $errors[] = "Baris $row_number: NIP dan Nama Lengkap wajib diisi";
                            $error_count++;
                            continue;
                        }

                        // Check if NIP already exists
                        if ($this->M_staf->check_nip_exists($row[0])) {
                            $errors[] = "Baris $row_number: NIP {$row[0]} sudah ada dalam database";
                            $error_count++;
                            continue;
                        }

                        // Check email format if provided
                        if (!empty($row[10]) && !valid_email($row[10])) {
                            $errors[] = "Baris $row_number: Format email tidak valid";
                            $error_count++;
                            continue;
                        }

                        // Check if email already exists
                        if (!empty($row[10]) && $this->M_staf->check_email_exists($row[10])) {
                            $errors[] = "Baris $row_number: Email {$row[10]} sudah ada dalam database";
                            $error_count++;
                            continue;
                        }

                        $data = array(
                            'nip' => $row[0],
                            'nik' => $row[1] ?? '',
                            'nama_lengkap' => $row[2],
                            'tempat_lahir' => $row[3] ?? '',
                            'tanggal_lahir' => !empty($row[4]) ? date('Y-m-d', strtotime($row[4])) : null,
                            'jenis_kelamin' => !empty($row[5]) ? $row[5] : 'L',
                            'agama' => $row[6] ?? '',
                            'alamat' => $row[7] ?? '',
                            'telepon' => $row[8] ?? '',
                            'email' => $row[9] ?? '',
                            'pendidikan_terakhir' => $row[10] ?? '',
                            'jurusan_pendidikan' => $row[11] ?? '',
                            'divisi' => $row[12] ?? '',
                            'jabatan' => $row[13] ?? '',
                            'golongan' => $row[14] ?? '',
                            'pangkat' => $row[15] ?? '',
                            'status_kepegawaian' => !empty($row[16]) ? $row[16] : 'Kontrak',
                            'status_aktif' => !empty($row[17]) ? $row[17] : 'Aktif',
                            'tanggal_masuk' => !empty($row[18]) ? date('Y-m-d', strtotime($row[18])) : null,
                            'gaji_pokok' => !empty($row[19]) ? str_replace(',', '', $row[19]) : null,
                            'keterangan' => $row[20] ?? '',
                            'created_by' => $this->ion_auth->user()->row()->id,
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        if ($this->M_staf->insert($data)) {
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
            'A1' => 'NIP*',
            'B1' => 'NIK',
            'C1' => 'Nama Lengkap*',
            'D1' => 'Tempat Lahir',
            'E1' => 'Tanggal Lahir (YYYY-MM-DD)',
            'F1' => 'Jenis Kelamin (L/P)',
            'G1' => 'Agama',
            'H1' => 'Alamat',
            'I1' => 'Telepon',
            'J1' => 'Email',
            'K1' => 'Pendidikan Terakhir',
            'L1' => 'Jurusan Pendidikan',
            'M1' => 'Divisi',
            'N1' => 'Jabatan',
            'O1' => 'Golongan',
            'P1' => 'Pangkat',
            'Q1' => 'Status Kepegawaian',
            'R1' => 'Status Aktif',
            'S1' => 'Tanggal Masuk (YYYY-MM-DD)',
            'T1' => 'Gaji Pokok',
            'U1' => 'Keterangan'
        );

        foreach ($headers as $cell => $value) {
            $worksheet->setCellValue($cell, $value);
        }

        // Style headers
        $worksheet->getStyle('A1:U1')->getFont()->setBold(true);
        $worksheet->getStyle('A1:U1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $worksheet->getStyle('A1:U1')->getFill()->getStartColor()->setARGB('FFE0E0E0');

        // Auto-size columns
        foreach (range('A', 'U') as $col) {
            $worksheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Add sample data
        $worksheet->setCellValue('A2', '196001011980031001');
        $worksheet->setCellValue('B2', '3201010180010001');
        $worksheet->setCellValue('C2', 'Jane Smith, S.E.');
        $worksheet->setCellValue('D2', 'Bandung');
        $worksheet->setCellValue('E2', '1980-01-01');
        $worksheet->setCellValue('F2', 'P');
        $worksheet->setCellValue('G2', 'Islam');
        $worksheet->setCellValue('H2', 'Jl. Contoh No. 456');
        $worksheet->setCellValue('I2', '08123456789');
        $worksheet->setCellValue('J2', 'jane.smith@example.com');
        $worksheet->setCellValue('K2', 'S1');
        $worksheet->setCellValue('L2', 'Ekonomi');
        $worksheet->setCellValue('M2', 'Administrasi');
        $worksheet->setCellValue('N2', 'Staff Administrasi');
        $worksheet->setCellValue('O2', 'III/a');
        $worksheet->setCellValue('P2', 'Penata Muda');
        $worksheet->setCellValue('Q2', 'Tetap');
        $worksheet->setCellValue('R2', 'Aktif');
        $worksheet->setCellValue('S2', '2020-01-01');
        $worksheet->setCellValue('T2', '3500000');
        $worksheet->setCellValue('U2', 'Staff bagian administrasi akademik');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $filename = 'Template_Import_Staf_' . date('YmdHis') . '.xlsx';

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
        $config['file_name'] = 'staf_' . time() . '_' . rand(1000, 9999);

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
