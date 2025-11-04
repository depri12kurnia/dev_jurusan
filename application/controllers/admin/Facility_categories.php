<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facility_categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->model('M_log_user');
        $this->load->model('M_facilities');
        $this->load->helper(['text', 'url']);

        if (!$this->ion_auth->in_group('admin')) {
            redirect('page_errors');
        }
    }

    public function index()
    {
        $data['website'] = $this->M_settings->get_all_settings();
        $data['title'] = 'Facility Categories | Admin Panel';
        $data['content'] = 'paneladmin/facility_categories/list';
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

        $categories = $this->M_facilities->get_categories();
        $data = array();
        $no = 0;

        foreach ($categories as $category) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<div class="d-flex align-items-center">
                        <div class="category-color" style="width: 20px; height: 20px; background-color: ' . $category->color . '; margin-right: 10px; border-radius: 3px;"></div>
                        <strong>' . $category->name . '</strong>
                      </div>';
            $row[] = $category->description ?? '<span class="text-muted">No description</span>';
            $row[] = '<span class="badge badge-info">' . $category->facilities_count . '</span>';
            $row[] = $category->status == 'Active' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            $row[] = '<div class="btn-group" role="group">
                        <a class="btn btn-primary btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_category(' . "'" . $category->id . "'" . ')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0)" title="Delete" onclick="delete_category(' . "'" . $category->id . "'" . ')">
                            <i class="fa fa-trash"></i>
                        </a>
                      </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 1,
            "recordsTotal" => count($categories),
            "recordsFiltered" => count($categories),
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

        $data = array(
            'name'        => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'color'       => $this->input->post('color'),
            'icon'        => $this->input->post('icon'),
            'sort_order'  => $this->input->post('sort_order') ?: 0,
            'status'      => $this->input->post('status'),
            'created_by'  => $user->id,
            'updated_by'  => $user->id
        );

        $this->M_facilities->insert_category($data);

        $this->M_log_user->save_log($user->id, 'Add facility category: ' . $this->input->post('name'));

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_edit($id)
    {
        $data = $this->M_facilities->get_category_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->validate_csrf();
        $this->_validate();

        $user = $this->ion_auth->user()->row();
        $id = $this->input->post('id');

        $data = array(
            'name'        => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'color'       => $this->input->post('color'),
            'icon'        => $this->input->post('icon'),
            'sort_order'  => $this->input->post('sort_order') ?: 0,
            'status'      => $this->input->post('status'),
            'updated_by'  => $user->id
        );

        $this->M_facilities->update_category($id, $data);

        $this->M_log_user->save_log($user->id, 'Update facility category: ' . $this->input->post('name'));

        echo json_encode([
            "status" => TRUE,
            "csrf_token" => $this->security->get_csrf_hash()
        ]);
    }

    public function ajax_delete($id)
    {
        $this->validate_csrf();

        $category = $this->M_facilities->get_category_by_id($id);
        if (!$category) {
            echo json_encode(["status" => FALSE, "message" => "Category not found"]);
            return;
        }

        // Check if category has facilities
        if ($category->facilities_count > 0) {
            echo json_encode(["status" => FALSE, "message" => "Cannot delete category with existing facilities"]);
            return;
        }

        $this->M_facilities->delete_category($id);

        $user = $this->ion_auth->user()->row();
        $this->M_log_user->save_log($user->id, 'Delete facility category: ' . $category->name);

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

        if (empty($csrf_token)) {
            log_message('error', 'CSRF Token kosong, periksa apakah dikirim dari frontend.');
        }

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

        if ($this->input->post('name') == '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
