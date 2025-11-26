<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_settings', 'M_log_user', 'M_news']);
        $this->load->library(['upload', 'form_validation', 'session', 'ion_auth']);
        $this->load->helper(['url', 'form', 'text', 'file']);

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }
    }
    public function index()
    {
        $data['website'] = $this->M_settings->get_all_settings();
        $data['category'] = $this->M_news->get_category();
        $data['title'] = 'Manajemen Berita | Admin Panel';
        $data['content'] = 'paneladmin/news/list';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function get_statistics()
    {
        $stats = $this->M_news->get_news_statistics();
        echo json_encode($stats);
    }

    public function get_authors()
    {
        try {
            $authors = $this->M_news->get_authors();

            // Always return valid JSON
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($authors ? $authors : []));
        } catch (Exception $e) {
            log_message('error', 'Error in get_authors: ' . $e->getMessage());

            // Return empty array instead of 500 error
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([]));
        }
    }

    public function preview($id)
    {
        $data['news'] = $this->M_news->get_by_id($id);
        if (!$data['news']) {
            show_404();
        }

        $data['title'] = 'Preview: ' . $data['news']->title;
        $this->load->view('paneladmin/news/preview', $data);
    }

    public function ajax_list()
    {
        $csrf_token = $this->input->server('HTTP_X_CSRF_TOKEN');
        $valid_token = $this->security->get_csrf_hash();

        if (empty($csrf_token)) {
            log_message('error', 'CSRF Token kosong, periksa apakah dikirim dari frontend.');
        }

        if ($csrf_token !== $valid_token) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid CSRF Token']);
            exit();
        }

        $list = $this->M_news->get_datatables();
        $data = array();
        $no = $_POST['start'] + 1;
        foreach ($list as $x) {
            $row = array();
            $row[] = $no++;

            // Thumbnail
            $thumbnail = !empty($x->thumbnail)
                ? '<img src="' . base_url('public/uploads/news/' . $x->thumbnail) . '" class="img-thumbnail" style="max-width: 60px; max-height: 60px;" alt="Thumbnail">'
                : '<div class="bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;"><i class="fas fa-image text-muted"></i></div>';
            $row[] = $thumbnail;

            // Category with badge
            $row[] = '<span class="badge badge-info">' . $x->category_name . '</span>';

            // Title with excerpt
            $title_display = '<div class="d-flex flex-column">';
            $title_display .= '<strong class="text-primary">' . character_limiter($x->title, 40) . '</strong>';
            if (!empty($x->excerpt)) {
                $title_display .= '<small class="text-muted">' . character_limiter($x->excerpt, 60) . '</small>';
            }
            $title_display .= '</div>';
            $row[] = $title_display;

            // Author
            $row[] = '<span class="text-info"><i class="fas fa-user mr-1"></i>' . $x->author . '</span>';

            // Status with proper badges
            $status = ($x->status == 'published')
                ? '<span class="badge badge-success"><i class="fas fa-check mr-1"></i>Terbit</span>'
                : '<span class="badge badge-warning"><i class="fas fa-edit mr-1"></i>Draft</span>';
            $row[] = $status;

            // Published date
            $date_display = date('d/m/Y', strtotime($x->published_at));
            $row[] = '<small class="text-muted"><i class="fas fa-calendar mr-1"></i>' . $date_display . '</small>';

            // Action buttons
            $actions = '<div class="btn-group" role="group">';
            $actions .= '<button type="button" class="btn btn-info btn-sm" onclick="preview_news(' . $x->id . ')" title="Preview">';
            $actions .= '<i class="fas fa-eye"></i></button>';
            $actions .= '<button type="button" class="btn btn-warning btn-sm" onclick="edit_news(' . $x->id . ')" title="Edit">';
            $actions .= '<i class="fas fa-edit"></i></button>';
            $actions .= '<button type="button" class="btn btn-danger btn-sm" onclick="delete_news(' . $x->id . ')" title="Delete">';
            $actions .= '<i class="fas fa-trash"></i></button>';
            $actions .= '</div>';
            $row[] = $actions;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_news->count_all(),
            "recordsFiltered" => $this->M_news->count_filtered(),
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

        if (empty($_FILES['thumbnail']['name'])) {
            echo json_encode(["status" => false, "inputerror" => ["thumbnail"], "error_string" => ["Thumbnail tidak boleh kosong"]]);
            exit;
        }
        // Handle Upload Thumbnail
        $thumbnail = $this->_upload_thumbnail();

        $title = $this->input->post('title');
        $slug  = url_title($title, 'dash', TRUE);

        $published_at = $this->input->post('published_at');
        if (!empty($published_at)) {
            $published_at = date('Y-m-d H:i:s', strtotime($published_at));
        } else {
            $published_at = date('Y-m-d H:i:s'); // Default ke waktu sekarang jika kosong
        }

        // Cek slug unik
        $this->db->where('slug', $slug);
        if ($this->db->get('news')->row()) {
            $slug .= '-' . time();
        }

        $data = array(
            'category_id'   => $this->input->post('category_id'),
            'title'         => $title,
            'slug'          => $slug,
            'content'       => $this->input->post('content'),
            'thumbnail'     => $thumbnail,
            'author'        => $user->id,
            'status'        => $this->input->post('status'),
            'published_at'  => $published_at,
        );

        $this->M_news->insert_news($data);

        $user = $this->ion_auth->user()->row();
        $this->M_log_user->save_log($user->id, 'Add News');

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_edit($id)
    {
        $data = $this->M_news->get_by_id($id);
        echo json_encode($data);
    }


    public function ajax_update()
    {
        $this->validate_csrf();
        $this->_validate();

        $user = $this->ion_auth->user()->row();

        $id = $this->input->post('id');
        $news = $this->M_news->get_by_id($id);

        $published_at = $this->input->post('published_at');
        if (!empty($published_at)) {
            $news->published_at = date('Y-m-d\TH:i', strtotime($news->published_at)); // Format untuk <input type="datetime-local">
        } else {
            $published_at = date('Y-m-d H:i:s'); // Default ke waktu sekarang jika kosong
        }

        // Cek apakah ada file thumbnail baru diupload
        $thumbnail = !empty($_FILES['thumbnail']['name']) ? $this->_upload_thumbnail($news->thumbnail) : $news->thumbnail;

        $data = array(
            'category_id'   => $this->input->post('category_id'),
            'title'         => $this->input->post('title'),
            'content'       => $this->input->post('content'),
            'thumbnail'     => $thumbnail, // Update thumbnail jika ada perubahan
            'status'        => $this->input->post('status'),
            'author'        => $user->id,
            'published_at'  => $published_at,
        );

        $this->M_news->update_news($id, $data);

        $user = $this->ion_auth->user()->row();
        $this->M_log_user->save_log($user->id, 'Update News');

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_delete($id)
    {
        $this->validate_csrf();

        // Ambil data berita sebelum dihapus
        $news = $this->M_news->get_by_id($id);

        if (!$news) {
            echo json_encode(["status" => false, "error" => "Data tidak ditemukan."]);
            exit;
        }

        // Path lokasi penyimpanan thumbnail
        $thumbnail_path = FCPATH . 'public/uploads/news/' . $news->thumbnail;

        // Hapus thumbnail jika ada
        if (!empty($news->thumbnail) && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        // Hapus berita dari database
        $this->M_news->delete_news($id);

        // Mendapatkan user yang login
        $user = $this->ion_auth->user()->row();

        // Simpan log aktivitas
        $this->M_log_user->save_log($user->id, 'Delete News');

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash() // Kirim token CSRF baru
        ]);
    }


    private function _upload_thumbnail($old_thumbnail = null)
    {
        $config['upload_path']   = './public/uploads/news/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // Maksimum 2MB
        $config['file_name']     = time() . '_' . $_FILES['thumbnail']['name'];

        $this->upload->initialize($config);

        if ($this->upload->do_upload('thumbnail')) {
            $upload_data = $this->upload->data();

            // Tentukan batas ukuran (misal: 800x800px)
            $max_width  = 800;
            $max_height = 800;

            // Resize jika lebih besar dari batasan
            if ($upload_data['image_width'] > $max_width || $upload_data['image_height'] > $max_height) {
                $config_resize['image_library']  = 'gd2';
                $config_resize['source_image']   = $upload_data['full_path'];
                $config_resize['maintain_ratio'] = TRUE;
                $config_resize['width']          = $max_width;
                $config_resize['height']         = $max_height;

                $this->load->library('image_lib', $config_resize);
                $this->image_lib->resize();
            }

            // Hapus file lama jika ada
            if ($old_thumbnail && file_exists('./public/uploads/news/' . $old_thumbnail)) {
                unlink('./public/uploads/news/' . $old_thumbnail);
            }

            return $upload_data['file_name']; // Return nama file baru
        } else {
            return $old_thumbnail; // Jika gagal upload, gunakan thumbnail lama
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $title = $this->input->post('title');
        $content = $this->input->post('content');

        if (empty($title)) {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'title is required';
            $data['status'] = FALSE;
        }

        if (empty($content)) {
            $data['inputerror'][] = 'content';
            $data['error_string'][] = 'content is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }


    private function validate_csrf()
    {
        $csrf_token = $this->input->server('HTTP_X_CSRF_TOKEN');
        $valid_token = $this->security->get_csrf_hash();

        if ($csrf_token !== $valid_token) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid CSRF Token']);
            exit();
        }
    }
}
