<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_items extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->model('M_log_user');
        $this->load->model('M_menu_categories');
        $this->load->model('M_menu_items');
        $this->load->library('form_validation');

        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }
    }

    public function index()
    {
        try {
            $data['website'] = $this->M_settings->get_main_settings();
            $data['categories'] = $this->M_menu_categories->get_all();
            $data['items'] = $this->M_menu_items->get_all(); // Add items data
            $data['title'] = 'Menu Items | Admin Panel';
            $data['content'] = 'paneladmin/menu/items/list';

            // Debug: log data
            log_message('debug', 'Categories loaded: ' . count($data['categories']) . ' items');
            log_message('debug', 'Menu items loaded: ' . count($data['items']) . ' items');

            $this->load->view('layouts/adminlte3', $data);
        } catch (Exception $e) {
            log_message('error', 'Menu items index error: ' . $e->getMessage());
            show_error('An error occurred while loading the menu items page.');
        }
    }
    public function ajax_list()
    {
        try {
            $items = $this->M_menu_items->get_all();

            $data = [];
            if ($items) {
                foreach ($items as $item) {
                    $row = [];
                    $row[] = $item->id;
                    $row[] = '<i class="' . ($item->icon ?: 'fas fa-file') . ' mr-2"></i>' . $item->title;
                    $row[] = '<span class="badge badge-info">' . ($item->category_name ?: 'No Category') . '</span>';
                    $row[] = $item->slug;
                    $row[] = $item->order_position;
                    $row[] = $item->is_active ?
                        '<span class="badge badge-success">Aktif</span>' :
                        '<span class="badge badge-secondary">Nonaktif</span>';
                    $row[] = date('d M Y', strtotime($item->created_at ?? date('Y-m-d')));
                    $row[] = '
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-info" onclick="viewDetail(' . $item->id . ')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="' . base_url('admin/menu_items/edit/' . $item->id) . '" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $item->id . ')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    ';
                    $data[] = $row;
                }
            }

            $output = [
                'draw' => intval($this->input->post('draw')),
                'recordsTotal' => count($data),
                'recordsFiltered' => count($data),
                'data' => $data
            ];

            echo json_encode($output);
        } catch (Exception $e) {
            log_message('error', 'Ajax list error: ' . $e->getMessage());
            echo json_encode([
                'draw' => intval($this->input->post('draw')),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => 'An error occurred while loading data'
            ]);
        }
    }

    public function detail($id)
    {
        $item = $this->M_menu_items->get_by_id($id);

        if (!$item) {
            echo '<div class="alert alert-danger">Data tidak ditemukan!</div>';
            return;
        }

        // Load the detail view
        $data['item'] = $item;
        $this->load->view('paneladmin/menu/items/detail', $data);
    }

    public function create()
    {
        // Handle form submission
        if ($this->input->method() === 'post') {
            $this->_process_form();
            return;
        }

        // Show form
        $data['website'] = $this->M_settings->get_main_settings();
        $data['categories'] = $this->M_menu_categories->get_all();
        $data['title'] = 'Tambah Menu Item | Admin Panel';
        $data['content'] = 'paneladmin/menu/items/create';
        $this->load->view('layouts/adminlte3', $data);
    }

    private function _process_form()
    {
        // Basic validation
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('content', 'Konten', 'required');
        $this->form_validation->set_rules('order_position', 'Urutan', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            return;
        }

        // Generate slug
        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = [
            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'content' => $this->input->post('content'),
            'icon' => $this->input->post('icon') ?: 'fas fa-file',
            'order_position' => $this->input->post('order_position'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
            'meta_title' => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description')
        ];

        if ($this->M_menu_items->insert($data)) {
            $this->session->set_flashdata('success', 'Menu item berhasil ditambahkan!');
            redirect('admin/menu_items');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data!');
        }
    }

    public function store()
    {
        try {
            // Set validation rules
            $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer', [
                'required' => 'Kategori wajib dipilih',
                'integer' => 'Kategori harus berupa angka'
            ]);
            $this->form_validation->set_rules('title', 'Judul', 'required|trim|min_length[3]|max_length[200]', [
                'required' => 'Judul wajib diisi',
                'min_length' => 'Judul minimal 3 karakter',
                'max_length' => 'Judul maksimal 200 karakter'
            ]);
            $this->form_validation->set_rules('content', 'Konten', 'required|trim', [
                'required' => 'Konten wajib diisi'
            ]);
            $this->form_validation->set_rules('icon', 'Icon', 'trim|max_length[50]', [
                'max_length' => 'Icon maksimal 50 karakter'
            ]);
            $this->form_validation->set_rules('order_position', 'Urutan', 'required|integer|greater_than[0]', [
                'required' => 'Urutan tampil wajib diisi',
                'integer' => 'Urutan harus berupa angka',
                'greater_than' => 'Urutan minimal 1'
            ]);
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|max_length[255]', [
                'max_length' => 'Meta title maksimal 255 karakter'
            ]);
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|max_length[500]', [
                'max_length' => 'Meta description maksimal 500 karakter'
            ]);

            if ($this->form_validation->run() === FALSE) {
                // Tambahkan error message ke session
                $this->session->set_flashdata('error', 'Validasi form gagal. Silakan periksa kembali data yang diisi.');
                log_message('debug', 'Form validation errors: ' . validation_errors());
                $this->create();
                return;
            }

            // Generate slug from title
            $slug = url_title($this->input->post('title'), 'dash', TRUE);

            // Check if slug exists, add number if needed
            $original_slug = $slug;
            $counter = 1;
            while ($this->M_menu_items->slug_exists($slug)) {
                $slug = $original_slug . '-' . $counter;
                $counter++;
            }

            // Handle checkbox is_active
            $is_active = $this->input->post('is_active') ? 1 : 0;

            $data = [
                'category_id' => $this->input->post('category_id'),
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'content' => $this->input->post('content'),
                'icon' => $this->input->post('icon') ?: 'fas fa-file',
                'order_position' => $this->input->post('order_position'),
                'is_active' => $is_active,
                'meta_title' => $this->input->post('meta_title') ?: $this->input->post('title'),
                'meta_description' => $this->input->post('meta_description'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            log_message('debug', 'Attempting to insert menu item: ' . json_encode($data));

            if ($this->M_menu_items->insert($data)) {
                $this->session->set_flashdata('success', 'Menu item berhasil ditambahkan!');
                log_message('info', 'Menu item created successfully: ' . $data['title']);
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan menu item ke database!');
                log_message('error', 'Failed to insert menu item to database');
            }
        } catch (Exception $e) {
            log_message('error', 'Store menu item error: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        redirect('admin/menu_items');
    }

    public function edit($id)
    {
        $data['item'] = $this->M_menu_items->get_by_id($id);

        if (!$data['item']) {
            show_404();
        }

        $data['website'] = $this->M_settings->get_main_settings();
        $data['categories'] = $this->M_menu_categories->get_all();
        $data['title'] = 'Edit Menu Item | Admin Panel';
        $data['content'] = 'paneladmin/menu/items/edit';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function update($id)
    {
        $item = $this->M_menu_items->get_by_id($id);

        if (!$item) {
            show_404();
        }

        // Set validation rules with proper error messages
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer', [
            'required' => 'Kategori wajib dipilih',
            'integer' => 'Kategori harus berupa angka'
        ]);
        $this->form_validation->set_rules('title', 'Judul', 'required|trim|min_length[3]|max_length[200]', [
            'required' => 'Judul wajib diisi',
            'min_length' => 'Judul minimal 3 karakter',
            'max_length' => 'Judul maksimal 200 karakter'
        ]);
        $this->form_validation->set_rules('content', 'Konten', 'required|trim', [
            'required' => 'Konten wajib diisi'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'trim|max_length[50]', [
            'max_length' => 'Icon maksimal 50 karakter'
        ]);
        $this->form_validation->set_rules('order_position', 'Urutan', 'required|integer|greater_than[0]', [
            'required' => 'Urutan tampil wajib diisi',
            'integer' => 'Urutan harus berupa angka',
            'greater_than' => 'Urutan minimal 1'
        ]);
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|max_length[255]', [
            'max_length' => 'Meta title maksimal 255 karakter'
        ]);
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|max_length[500]', [
            'max_length' => 'Meta description maksimal 500 karakter'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Validasi form gagal. Silakan periksa kembali data yang diisi.');
            $this->edit($id);
            return;
        }

        // Generate new slug if title changed
        $new_slug = $item->slug; // Keep existing slug
        if ($this->input->post('title') != $item->title) {
            $new_slug = url_title($this->input->post('title'), 'dash', TRUE);

            // Check if new slug exists (exclude current item)
            $original_slug = $new_slug;
            $counter = 1;
            while ($this->M_menu_items->slug_exists($new_slug, $id)) {
                $new_slug = $original_slug . '-' . $counter;
                $counter++;
            }
        }

        // Handle checkbox is_active (0 if not checked, 1 if checked)
        $is_active = $this->input->post('is_active') ? 1 : 0;

        $data = [
            'category_id' => $this->input->post('category_id'),
            'title' => $this->input->post('title'),
            'slug' => $new_slug,
            'content' => $this->input->post('content'),
            'icon' => $this->input->post('icon') ?: 'fas fa-file',
            'order_position' => $this->input->post('order_position'),
            'is_active' => $is_active,
            'meta_title' => $this->input->post('meta_title') ?: $this->input->post('title'),
            'meta_description' => $this->input->post('meta_description'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->M_menu_items->update($id, $data)) {
            $this->session->set_flashdata('success', 'Menu item berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui menu item ke database!');
        }

        redirect('admin/menu_items');
    }

    public function delete($id)
    {
        $item = $this->M_menu_items->get_by_id($id);

        if (!$item) {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
            return;
        }

        if ($this->M_menu_items->delete($id)) {
            echo json_encode(['success' => true, 'message' => 'Menu item berhasil dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus menu item']);
        }
    }

    public function check_slug($slug, $exclude_id = null)
    {
        if ($this->M_menu_items->slug_exists($slug, $exclude_id)) {
            $this->form_validation->set_message('check_slug', 'Slug sudah digunakan');
            return FALSE;
        }
        return TRUE;
    }

    public function generate_slug()
    {
        $title = $this->input->post('title');
        $slug = url_title($title, 'dash', TRUE);

        // Check if slug exists and add number if needed
        $original_slug = $slug;
        $counter = 1;

        while ($this->M_menu_items->slug_exists($slug)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }

        echo json_encode(['slug' => $slug]);
    }

    public function test_connection()
    {
        // Test database connection and data
        $this->load->database();

        try {
            // Test categories
            $categories = $this->M_menu_categories->get_all();
            echo "<h3>Categories (" . count($categories) . "):</h3>";
            foreach ($categories as $cat) {
                echo "- " . $cat->name . "<br>";
            }

            // Test menu items
            $items = $this->M_menu_items->get_all();
            echo "<h3>Menu Items (" . count($items) . "):</h3>";
            foreach ($items as $item) {
                echo "- " . $item->title . " (Category: " . ($item->category_name ?? 'None') . ")<br>";
            }

            echo "<h3>CSRF Token Test:</h3>";
            echo "Token: " . $this->security->get_csrf_hash();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
