<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_settings');
        $this->load->model('M_dashboard');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['website'] = $this->M_settings->get_settings();
        $data['dashboard_stats'] = $this->M_dashboard->get_dashboard_stats();
        $data['berita_hari_ini'] = $this->M_dashboard->get_today_news(5);
        $data['prodi_list'] = $this->M_dashboard->get_all_prodi_with_stats(5);
        $data['title'] = 'Dashboard | Admin Panel';
        $data['content'] = 'paneladmin/dashboard';
        $this->load->view('layouts/adminlte3', $data);
    }
}
