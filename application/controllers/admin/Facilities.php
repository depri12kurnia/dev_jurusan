<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facilities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->model('M_log_user');
        $this->load->model('M_facilities');
        $this->load->library('upload');
        $this->load->helper(['text', 'url']);

        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }
    }

    public function index()
    {
        $data['website'] = $this->M_settings->get_all_settings();
        $data['title'] = 'Facilities | Admin Panel';
        $data['content'] = 'paneladmin/facilities/list';
        $data['categories'] = $this->M_facilities->get_categories();
        $this->load->view('layouts/adminlte3', $data);
    }

    public function ajax_list()
    {
        $csrf_token = $this->input->server('HTTP_X_CSRF_TOKEN');
        $valid_token = $this->security->get_csrf_hash();

        if ($csrf_token !== $valid_token) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid CSRF Token']);
            exit();
        }

        $list = $this->M_facilities->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $x) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<span class="badge badge-info">' . $x->category_name . '</span>';
            $row[] = '<strong>' . $x->title . '</strong><br><small class="text-muted">' . $x->subtitle . '</small>';

            // Featured status
            $featured_badge = $x->is_featured ? '<span class="badge badge-success">Featured</span>' : '<span class="badge badge-secondary">Regular</span>';
            $row[] = $featured_badge;

            // Status badge
            if ($x->status == 'Active') {
                $status_badge = '<span class="badge badge-success">Active</span>';
            } elseif ($x->status == 'Inactive') {
                $status_badge = '<span class="badge badge-danger">Inactive</span>';
            } else {
                $status_badge = '<span class="badge badge-warning">Draft</span>';
            }
            $row[] = $status_badge;

            // Action buttons
            $row[] = '<div class="btn-group" role="group">
                        <a class="btn btn-info btn-sm" href="javascript:void(0)" title="View" onclick="view_facility(' . "'" . $x->id . "'" . ')">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_facility(' . "'" . $x->id . "'" . ')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0)" title="Delete" onclick="delete_facility(' . "'" . $x->id . "'" . ')">
                            <i class="fa fa-trash"></i>
                        </a>
                      </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_facilities->count_all(),
            "recordsFiltered" => $this->M_facilities->count_filtered(),
            "data" => $data,
            "csrf_token" => $this->security->get_csrf_hash()
        );
        echo json_encode($output);
    }

    public function ajax_add()
    {
        $this->validate_csrf();
        $this->_validate();

        $user = $this->ion_auth->user()->row();

        // Handle upload image
        $image = null;
        if (!empty($_FILES['image']['name'])) {
            $image = $this->_upload_image();
        }

        // Generate slug
        $slug = $this->M_facilities->generate_slug($this->input->post('title'));

        $data = array(
            'category_id'       => $this->input->post('category_id'),
            'title'            => $this->input->post('title'),
            'subtitle'         => $this->input->post('subtitle'),
            'slug'             => $slug,
            'description'      => $this->input->post('description'),
            'short_description' => $this->input->post('short_description'),
            'icon'             => $this->input->post('icon'),
            'image'            => $image,
            'location'         => $this->input->post('location'),
            'capacity'         => $this->input->post('capacity'),
            'operational_hours' => $this->input->post('operational_hours'),
            'contact_person'   => $this->input->post('contact_person'),
            'phone'           => $this->input->post('phone'),
            'email'           => $this->input->post('email'),
            'website_url'     => $this->input->post('website_url'),
            'virtual_tour_url' => $this->input->post('virtual_tour_url'),
            'is_featured'     => $this->input->post('is_featured') ? 1 : 0,
            'featured_order'  => $this->input->post('featured_order') ?: 0,
            'sort_order'      => $this->input->post('sort_order') ?: 0,
            'meta_title'      => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keywords'   => $this->input->post('meta_keywords'),
            'status'          => $this->input->post('status'),
            'created_by'      => $user->id,
            'updated_by'      => $user->id
        );

        $facility_id = $this->M_facilities->insert_facility($data);

        // Save highlights
        if ($facility_id) {
            $this->_save_highlights($facility_id);
        }

        $this->M_log_user->save_log($user->id, 'Add facility: ' . $this->input->post('title'));

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_edit($id)
    {
        $data = $this->M_facilities->get_by_id($id);
        if ($data) {
            $data->highlights = $this->M_facilities->get_facility_highlights($id);
        }
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->validate_csrf();
        $this->_validate();

        $user = $this->ion_auth->user()->row();
        $id = $this->input->post('id');
        $facility = $this->M_facilities->get_by_id($id);

        if (!$facility) {
            echo json_encode(["status" => FALSE, "message" => "Facility not found"]);
            return;
        }

        // Handle upload image
        $image = !empty($_FILES['image']['name']) ? $this->_upload_image($facility->image) : $facility->image;

        // Generate slug if title changed
        $slug = ($this->input->post('title') !== $facility->title)
            ? $this->M_facilities->generate_slug($this->input->post('title'), $id)
            : $facility->slug;

        $data = array(
            'category_id'       => $this->input->post('category_id'),
            'title'            => $this->input->post('title'),
            'subtitle'         => $this->input->post('subtitle'),
            'slug'             => $slug,
            'description'      => $this->input->post('description'),
            'short_description' => $this->input->post('short_description'),
            'icon'             => $this->input->post('icon'),
            'image'            => $image,
            'location'         => $this->input->post('location'),
            'capacity'         => $this->input->post('capacity'),
            'operational_hours' => $this->input->post('operational_hours'),
            'contact_person'   => $this->input->post('contact_person'),
            'phone'           => $this->input->post('phone'),
            'email'           => $this->input->post('email'),
            'website_url'     => $this->input->post('website_url'),
            'virtual_tour_url' => $this->input->post('virtual_tour_url'),
            'is_featured'     => $this->input->post('is_featured') ? 1 : 0,
            'featured_order'  => $this->input->post('featured_order') ?: 0,
            'sort_order'      => $this->input->post('sort_order') ?: 0,
            'meta_title'      => $this->input->post('meta_title'),
            'meta_description' => $this->input->post('meta_description'),
            'meta_keywords'   => $this->input->post('meta_keywords'),
            'status'          => $this->input->post('status'),
            'updated_by'      => $user->id
        );

        $this->M_facilities->update_facility($id, $data);

        // Update highlights
        $this->M_facilities->delete_highlights_by_facility($id);
        $this->_save_highlights($id);

        $this->M_log_user->save_log($user->id, 'Update facility: ' . $this->input->post('title'));

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_delete($id)
    {
        $this->validate_csrf();

        $facility = $this->M_facilities->get_by_id($id);
        if (!$facility) {
            echo json_encode(["status" => FALSE, "message" => "Facility not found"]);
            return;
        }

        // Delete image file
        if ($facility->image && file_exists('./public/uploads/facilities/' . $facility->image)) {
            unlink('./public/uploads/facilities/' . $facility->image);
        }

        // Delete facility (will cascade to highlights and specs)
        $this->M_facilities->delete_facility($id);

        $user = $this->ion_auth->user()->row();
        $this->M_log_user->save_log($user->id, 'Delete facility: ' . $facility->title);

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    // Private methods
    private function validate_csrf()
    {
        $csrf_token = $this->input->server('HTTP_X_CSRF_TOKEN');
        $valid_token = $this->security->get_csrf_hash();

        if ($csrf_token !== $valid_token) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid CSRF Token']);
            exit();
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('title') == '') {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('category_id') == '') {
            $data['inputerror'][] = 'category_id';
            $data['error_string'][] = 'Category is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('description') == '') {
            $data['inputerror'][] = 'description';
            $data['error_string'][] = 'Description is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _upload_image($old_image = null)
    {
        // Delete old image if exists
        if ($old_image && file_exists('./public/uploads/facilities/' . $old_image)) {
            unlink('./public/uploads/facilities/' . $old_image);
        }

        $config['upload_path']          = './public/uploads/facilities/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']            = 2048; // 2MB
        $config['encrypt_name']        = TRUE;

        // Create directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        } else {
            echo json_encode([
                "status" => FALSE,
                "inputerror" => ["image"],
                "error_string" => [$this->upload->display_errors('', '')]
            ]);
            exit;
        }
    }

    private function _save_highlights($facility_id)
    {
        $highlights = $this->input->post('highlights');

        if (!empty($highlights)) {
            foreach ($highlights as $index => $highlight) {
                if (!empty($highlight['title'])) {
                    $highlight_data = array(
                        'facility_id' => $facility_id,
                        'title'       => $highlight['title'],
                        'description' => $highlight['description'] ?? null,
                        'icon'        => $highlight['icon'] ?? 'fas fa-check',
                        'color'       => $highlight['color'] ?? '#28a745',
                        'sort_order'  => $index + 1,
                        'status'      => 'Active'
                    );
                    $this->M_facilities->insert_highlight($highlight_data);
                }
            }
        }
    }
}
