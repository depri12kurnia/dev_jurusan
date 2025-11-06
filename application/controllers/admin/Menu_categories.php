<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->model('M_log_user');
        $this->load->model('M_menu_categories');
        $this->load->library('form_validation');

        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }
    }

    public function index()
    {
        $data['website'] = $this->M_settings->get_main_settings();
        $data['title'] = 'Menu Categories | Admin Panel';
        $data['content'] = 'paneladmin/menu/categories/list';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function ajax_list()
    {
        try {
            $categories = $this->M_menu_categories->get_categories_with_count();

            $data = [];
            if ($categories) {
                foreach ($categories as $category) {
                    $row = [];
                    $row[] = $category->id;
                    $row[] = '<i class="' . ($category->icon ?: 'fas fa-folder') . ' mr-2"></i>' . $category->name;
                    $row[] = $category->slug;
                    $row[] = $category->order_position;
                    $row[] = $category->items_count ?? 0;
                    $row[] = $category->is_active ?
                        '<span class="badge badge-success">Aktif</span>' :
                        '<span class="badge badge-secondary">Nonaktif</span>';
                    $row[] = '
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-info" onclick="viewDetail(' . $category->id . ')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="' . base_url('admin/menu_categories/edit/' . $category->id) . '" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $category->id . ')">
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
            log_message('error', 'Menu categories ajax list error: ' . $e->getMessage());
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
        $category = $this->M_menu_categories->get_by_id($id);

        if (!$category) {
            echo '<div class="alert alert-danger">Data tidak ditemukan!</div>';
            return;
        }

        // Get items count for this category
        $this->load->model('M_menu_items');
        $items = $this->db->where('category_id', $id)->get('menu_items')->result();

        // Return HTML content for the modal
        echo '
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">ID</th>
                        <td>' . $category->id . '</td>
                    </tr>
                    <tr>
                        <th>Nama Kategori</th>
                        <td><i class="' . ($category->icon ?: 'fas fa-folder') . ' mr-2"></i>' . $category->name . '</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td><code>' . $category->slug . '</code></td>
                    </tr>
                    <tr>
                        <th>Urutan</th>
                        <td>' . $category->order_position . '</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>' . ($category->is_active ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>') . '</td>
                    </tr>
                    <tr>
                        <th>Jumlah Item</th>
                        <td><span class="badge badge-info">' . count($items) . ' items</span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Menu Items dalam Kategori ini:</h6>
                <div class="border p-3" style="max-height: 300px; overflow-y: auto;">
                    ' . (count($items) > 0 ?
            '<ul class="list-unstyled">' .
            implode('', array_map(function ($item) {
                return '<li><i class="fas fa-chevron-right mr-2"></i>' . $item->title . '</li>';
            }, $items)) .
            '</ul>'
            : '<em>Tidak ada menu items dalam kategori ini</em>') . '
                </div>
            </div>
        </div>';
    }

    public function create()
    {
        // Handle form submission
        if ($this->input->method() === 'post') {
            $this->_process_create_form();
            return;
        }

        // Show form
        $data['website'] = $this->M_settings->get_main_settings();
        $data['title'] = 'Tambah Menu Category | Admin Panel';
        $data['content'] = 'paneladmin/menu/categories/create';
        $this->load->view('layouts/adminlte3', $data);
    }

    private function _process_create_form()
    {
        // Set validation rules with custom error messages
        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim|min_length[2]|max_length[100]', [
            'required' => 'Nama kategori wajib diisi',
            'min_length' => 'Nama kategori minimal 2 karakter',
            'max_length' => 'Nama kategori maksimal 100 karakter'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'trim|max_length[50]', [
            'max_length' => 'Icon maksimal 50 karakter'
        ]);
        $this->form_validation->set_rules('order_position', 'Urutan', 'required|integer|greater_than[0]', [
            'required' => 'Urutan tampil wajib diisi',
            'integer' => 'Urutan harus berupa angka',
            'greater_than' => 'Urutan minimal 1'
        ]);

        if ($this->form_validation->run() === FALSE) {
            // Validation failed, show form again with errors
            $data['website'] = $this->M_settings->get_main_settings();
            $data['title'] = 'Tambah Menu Category | Admin Panel';
            $data['content'] = 'paneladmin/menu/categories/create';
            $this->load->view('layouts/adminlte3', $data);
            return;
        }

        // Generate slug from name
        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        // Check if slug already exists
        if ($this->M_menu_categories->slug_exists($slug)) {
            $slug .= '-' . time();
        }

        $data = [
            'name' => $this->input->post('name'),
            'slug' => $slug,
            'icon' => $this->input->post('icon') ?: 'fas fa-folder',
            'order_position' => $this->input->post('order_position'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        if ($this->M_menu_categories->insert($data)) {
            $this->session->set_flashdata('success', 'Menu category berhasil ditambahkan!');
            redirect('admin/menu_categories');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data! Silakan coba lagi.');
            redirect('admin/menu_categories/create');
        }
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Nama Category', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|max_length[100]|callback_check_slug');
        $this->form_validation->set_rules('icon', 'Icon', 'trim|max_length[50]');
        $this->form_validation->set_rules('order_position', 'Urutan', 'required|integer');
        $this->form_validation->set_rules('is_active', 'Status', 'required|in_list[0,1]');

        if ($this->form_validation->run() === FALSE) {
            $this->create();
            return;
        }

        $data = [
            'name' => $this->input->post('name'),
            'slug' => $this->input->post('slug'),
            'icon' => $this->input->post('icon'),
            'order_position' => $this->input->post('order_position'),
            'is_active' => $this->input->post('is_active')
        ];

        if ($this->M_menu_categories->insert($data)) {
            $this->session->set_flashdata('success', 'Menu category berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan menu category!');
        }

        redirect('admin/menu_categories');
    }

    public function edit($id)
    {
        $data['category'] = $this->M_menu_categories->get_by_id($id);

        if (!$data['category']) {
            show_404();
        }

        $data['website'] = $this->M_settings->get_main_settings();
        $data['title'] = 'Edit Menu Category | Admin Panel';
        $data['content'] = 'paneladmin/menu/categories/edit';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function update($id)
    {
        $category = $this->M_menu_categories->get_by_id($id);

        if (!$category) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Nama Category', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|max_length[100]|callback_check_slug[' . $id . ']');
        $this->form_validation->set_rules('icon', 'Icon', 'trim|max_length[50]');
        $this->form_validation->set_rules('order_position', 'Urutan', 'required|integer');
        $this->form_validation->set_rules('is_active', 'Status', 'required|in_list[0,1]');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
            return;
        }

        $data = [
            'name' => $this->input->post('name'),
            'slug' => $this->input->post('slug'),
            'icon' => $this->input->post('icon'),
            'order_position' => $this->input->post('order_position'),
            'is_active' => $this->input->post('is_active')
        ];

        if ($this->M_menu_categories->update($id, $data)) {
            $this->session->set_flashdata('success', 'Menu category berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui menu category!');
        }

        redirect('admin/menu_categories');
    }

    public function delete($id)
    {
        $category = $this->M_menu_categories->get_by_id($id);

        if (!$category) {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
            return;
        }

        if ($this->M_menu_categories->delete($id)) {
            echo json_encode(['success' => true, 'message' => 'Menu category berhasil dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus menu category']);
        }
    }

    public function check_slug($slug, $exclude_id = null)
    {
        if ($this->M_menu_categories->slug_exists($slug, $exclude_id)) {
            $this->form_validation->set_message('check_slug', 'Slug sudah digunakan');
            return FALSE;
        }
        return TRUE;
    }

    public function generate_slug()
    {
        $title = $this->input->post('name');
        $slug = url_title($title, 'dash', TRUE);

        // Check if slug exists and add number if needed
        $original_slug = $slug;
        $counter = 1;

        while ($this->M_menu_categories->slug_exists($slug)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }

        echo json_encode(['slug' => $slug]);
    }

    public function test_connection()
    {
        // Test database connection and data for menu categories
        $this->load->database();

        try {
            // Test categories with count
            $categories = $this->M_menu_categories->get_categories_with_count();
            echo "<h3>Categories with Item Count (" . count($categories) . "):</h3>";

            if ($categories) {
                echo "<table border='1' style='border-collapse: collapse;'>";
                echo "<tr><th>ID</th><th>Name</th><th>Slug</th><th>Items Count</th><th>Active</th></tr>";
                foreach ($categories as $cat) {
                    echo "<tr>";
                    echo "<td>{$cat->id}</td>";
                    echo "<td>{$cat->name}</td>";
                    echo "<td>{$cat->slug}</td>";
                    echo "<td>{$cat->items_count}</td>";
                    echo "<td>" . ($cat->is_active ? 'Yes' : 'No') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: orange;'>No categories found!</p>";
            }

            echo "<h3>CSRF Token Test:</h3>";
            echo "Token: " . $this->security->get_csrf_hash();

            echo "<h3>AJAX Test:</h3>";
            echo "<button onclick='testAjax()'>Test AJAX Call</button>";
            echo "<div id='ajax-result'></div>";

            echo "<script>
            function testAjax() {
                var csrfToken = $('meta[name=\"csrf-token\"]').attr('content');
                $.ajax({
                    url: '" . base_url('admin/menu_categories/ajax_list') . "',
                    type: 'POST',
                    data: { csrf_token_jkt3: csrfToken },
                    success: function(response) {
                        $('#ajax-result').html('<p style=\"color: green;\">✓ AJAX call successful! Data count: ' + JSON.parse(response).data.length + '</p>');
                    },
                    error: function(xhr) {
                        $('#ajax-result').html('<p style=\"color: red;\">✗ AJAX call failed: ' + xhr.status + ' - ' + xhr.statusText + '</p>');
                    }
                });
            }
            </script>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
