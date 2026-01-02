<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Downloads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_downloads');
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->model('M_prodi');
        $this->load->model('M_settings');
    }

    /**
     * Display all downloads
     */
    public function index($page = 1)
    {
        $config['base_url'] = base_url('downloads');
        $config['total_rows'] = $this->M_downloads->count_all();
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next >';
        $config['prev_link'] = '< Prev';
        $config['full_tag_open'] = '<nav><ul class="pagination">';;
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" href="';
        $config['num_tag_close'] = '">page</a></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

        $this->pagination->initialize($config);

        $offset = ($page - 1) * $config['per_page'];
        $data['downloads'] = $this->M_downloads->get_all($config['per_page'], $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->M_downloads->get_categories();
        $data['types'] = $this->M_downloads->get_types();
        $data['page_title'] = 'Akreditasi & Unduhan';
        $data['website'] = $this->M_settings->get_settings();
        $data['program_studi_all'] = $this->M_prodi->get_all_active();

        // Load the view
        $data['content'] = 'paneluser/downloads/index';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Display downloads by category
     */
    public function category($category_id, $page = 1)
    {
        $categories = $this->M_downloads->get_categories();
        $cat_found = false;
        $cat_name = 'Unknown';

        foreach ($categories as $cat) {
            if ($cat->id == $category_id) {
                $cat_found = true;
                $cat_name = $cat->name;
                break;
            }
        }

        if (!$cat_found) {
            show_404();
        }

        $config['base_url'] = base_url('downloads/category/' . $category_id);
        $config['total_rows'] = $this->M_downloads->count_by_category($category_id);
        $config['per_page'] = 10;
        $config['num_links'] = 4;

        $this->pagination->initialize($config);

        $offset = ($page - 1) * $config['per_page'];
        $data['downloads'] = $this->M_downloads->get_by_category($category_id, $config['per_page'], $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $categories;
        $data['types'] = $this->M_downloads->get_types();
        $data['current_category'] = $category_id;
        $data['category_name'] = $cat_name;
        $data['page_title'] = 'Akreditasi - ' . $cat_name;
        $data['website'] = $this->M_settings->get_settings();
        $data['program_studi_all'] = $this->M_prodi->get_all_active();

        $data['content'] = 'paneluser/downloads/index';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Display downloads by type
     */
    public function type($type_id, $page = 1)
    {
        $types = $this->M_downloads->get_types();
        $type_found = false;
        $type_name = 'Unknown';

        foreach ($types as $type) {
            if ($type->id == $type_id) {
                $type_found = true;
                $type_name = $type->name;
                break;
            }
        }

        if (!$type_found) {
            show_404();
        }

        $config['base_url'] = base_url('downloads/type/' . $type_id);
        $config['total_rows'] = $this->db->where('d_type_id', $type_id)->count_all_results('d_downloads');
        $config['per_page'] = 10;
        $config['num_links'] = 4;

        $this->pagination->initialize($config);

        $offset = ($page - 1) * $config['per_page'];
        $data['downloads'] = $this->M_downloads->get_by_type($type_id, $config['per_page'], $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->M_downloads->get_categories();
        $data['types'] = $types;
        $data['current_type'] = $type_id;
        $data['type_name'] = $type_name;
        $data['page_title'] = 'Akreditasi - ' . $type_name;
        $data['website'] = $this->M_settings->get_settings();
        $data['program_studi_all'] = $this->M_prodi->get_all_active();

        $data['content'] = 'paneluser/downloads/index';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Search downloads
     */
    public function search()
    {
        $keyword = $this->input->get('q', true);

        if (empty($keyword)) {
            redirect('downloads');
        }

        $data['downloads'] = $this->M_downloads->search($keyword);
        $data['categories'] = $this->M_downloads->get_categories();
        $data['types'] = $this->M_downloads->get_types();
        $data['keyword'] = $keyword;
        $data['page_title'] = 'Search Akreditasi - ' . $keyword;

        $data['website'] = $this->M_settings->get_settings();
        $data['program_studi_all'] = $this->M_prodi->get_all_active();

        $data['content'] = 'paneluser/downloads/index';
        $this->load->view('layouts/user_layout', $data);
    }

    /**
     * Download file
     */
    public function download($id)
    {
        $download = $this->M_downloads->get_by_id($id);

        if (!$download) {
            show_404();
        }

        $file_path = FCPATH . 'public/uploads/files/' . $download->name_files;

        if (!file_exists($file_path)) {
            show_404();
        }

        force_download($file_path, $download->name);
    }

    /**
     * View file (for PDF or other viewable formats)
     */
    public function view($id)
    {
        $download = $this->M_downloads->get_by_id($id);

        if (!$download) {
            show_404();
        }

        $file_path = FCPATH . 'public/uploads/files/' . $download->name_files;

        if (!file_exists($file_path)) {
            show_404();
        }

        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

        // List of viewable formats
        $viewable_formats = array('pdf', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'webp');

        if (in_array(strtolower($file_extension), $viewable_formats)) {
            // Get file MIME type
            $mime_types = array(
                'pdf' => 'application/pdf',
                'txt' => 'text/plain',
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'webp' => 'image/webp'
            );

            $mime_type = $mime_types[strtolower($file_extension)] ?? 'application/octet-stream';

            // Output file for viewing
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: inline; filename="' . $download->name . '"');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
        } else {
            // If not viewable, force download instead
            force_download($file_path, $download->name);
        }
    }

    /**
     * View file via AJAX (returns JSON with file URL)
     */
    public function view_ajax($id)
    {
        header('Content-Type: application/json');

        $download = $this->M_downloads->get_by_id($id);

        if (!$download) {
            echo json_encode(['success' => false, 'message' => 'File tidak ditemukan']);
            return;
        }

        $file_path = FCPATH . 'public/uploads/files/' . $download->name_files;

        if (!file_exists($file_path)) {
            echo json_encode(['success' => false, 'message' => 'File tidak ditemukan di server']);
            return;
        }

        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
        $file_url = base_url('public/uploads/files/' . $download->name_files);

        // List of viewable formats
        $viewable_formats = array('pdf', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'webp');

        if (in_array(strtolower($file_extension), $viewable_formats)) {
            echo json_encode([
                'success' => true,
                'file_url' => $file_url,
                'file_extension' => $file_extension,
                'file_name' => $download->name
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Format file tidak didukung untuk ditampilkan di browser'
            ]);
        }
    }
}
