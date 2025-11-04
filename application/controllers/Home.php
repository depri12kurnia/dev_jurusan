<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_settings');
		$this->load->model('M_prodi');
		$this->load->model('M_news');
		$this->load->helper(['text', 'url']);
	}

	public function index()
	{
		$data['website'] = $this->M_settings->get_all_settings();
		$data['title'] = 'Selamat Datang di Fakultas Kesehatan';

		// Data Program Studi untuk homepage
		$data['program_studi_featured'] = $this->M_prodi->get_featured(3); // 3 program studi featured
		$data['program_studi_all'] = $this->M_prodi->get_all_active(); // Semua program studi aktif
		$data['program_studi_by_jenjang'] = [
			'D3' => $this->M_prodi->get_by_jenjang('D3', 5),
			'S1' => $this->M_prodi->get_by_jenjang('S1', 5),
			'PROFESI' => $this->M_prodi->get_by_jenjang('PROFESI', 5)
		];

		// Statistik untuk counter section
		$data['stats'] = [
			'total_prodi' => $this->M_prodi->count_active(),
			'total_mahasiswa' => $this->M_prodi->sum_mahasiswa_aktif(),
			'total_alumni' => $this->M_prodi->sum_alumni(),
			'rata_akreditasi_a' => $this->M_prodi->count_akreditasi_a()
		];

		// Data berita untuk homepage
		$data['get_featured_news'] = $this->M_news->get_featured_news(3); // 3 berita unggulan
		$data['latest_news'] = $this->M_news->get_latest_news(6); // 6 berita terbaru

		$data['content'] = 'paneluser/home';
		$this->load->view('layouts/user_layout', $data);
	}

	// Halaman detail program studi
	public function program_studi($slug = null)
	{
		if (!$slug) {
			// Tampilkan daftar semua program studi
			$data['website'] = $this->M_settings->get_all_settings();
			$data['title'] = 'Program Studi - Fakultas Kesehatan';
			$data['program_studi_all'] = $this->M_prodi->get_all_active();
			$data['program_studi_by_jenjang'] = [
				'D3' => $this->M_prodi->get_by_jenjang('D3'),
				'S1' => $this->M_prodi->get_by_jenjang('S1'),
				'PROFESI' => $this->M_prodi->get_by_jenjang('PROFESI')
			];

			$this->load->view('program_studi/index', $data);
		} else {
			// Tampilkan detail program studi berdasarkan slug
			$prodi = $this->M_prodi->get_by_slug($slug);

			if (!$prodi) {
				show_404();
			}

			$data['website'] = $this->M_settings->get_all_settings();
			$data['title'] = $prodi->nama_prodi . ' - Fakultas Kesehatan';
			$data['prodi'] = $prodi;
			$data['related_prodi'] = $this->M_prodi->get_related($prodi->jenjang, $prodi->id, 3);

			$this->load->view('program_studi/detail', $data);
		}
	}

	// AJAX endpoint untuk search program studi
	public function search_prodi()
	{
		$keyword = $this->input->post('keyword');
		$jenjang = $this->input->post('jenjang');

		$results = $this->M_prodi->search_public($keyword, $jenjang);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($results));
	}
}
