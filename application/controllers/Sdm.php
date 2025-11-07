<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_sdm']);
        $this->load->helper(['url', 'text', 'form', 'date']);
        $this->load->library('user_agent');
    }

    public function index()
    {
        $data['title'] = 'Sumber Daya Manusia';
        $data['dosen'] = $this->M_sdm->get_all_dosen();
        $data['staf'] = $this->M_sdm->get_all_staf();
        $data['statistics'] = $this->M_sdm->get_sdm_statistics();
        $data['program_studi_list'] = $this->M_sdm->get_program_studi_list();
        $data['divisi_list'] = $this->M_sdm->get_divisi_list();

        $data['content'] = 'paneluser/sdm/index';
        $this->load->view('layouts/user_layout', $data);
    }

    public function get_dosen_by_prodi()
    {
        $prodi = $this->input->post('prodi');
        $data = $this->M_sdm->get_dosen_by_prodi($prodi);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function get_staf_by_divisi()
    {
        $divisi = $this->input->post('divisi');
        $data = $this->M_sdm->get_staf_by_divisi($divisi);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function detail_dosen($id)
    {
        $data['title'] = 'Detail Dosen';
        $data['dosen'] = $this->M_sdm->get_dosen_by_id($id);

        if (!$data['dosen']) {
            show_404();
        }

        $data['content'] = 'paneluser/sdm/detail_dosen';
        $this->load->view('layouts/user_layout', $data);
    }

    public function detail_staf($id)
    {
        $data['title'] = 'Detail Staf';
        $data['staf'] = $this->M_sdm->get_staf_by_id($id);

        if (!$data['staf']) {
            show_404();
        }

        $data['content'] = 'paneluser/sdm/detail_staf';
        $this->load->view('layouts/user_layout', $data);
    }
}
