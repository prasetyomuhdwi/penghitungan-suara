<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata("login_session_user"))) {
			if (!$this->session->userdata('username')) {
				redirect('auth');
			}
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->refresh();
		$this->load->view('templates/footer');
		$this->load->view('dashboard/script');
	}

	public function refresh()
	{
		$data['title'] = 'Dashboard';
		$data['color'] = ['bg-info', 'bg-primary', 'bg-warning', 'bg-success'];
		$data['kecamatan_count'] = count($this->kecamatan->getKecamatan(null));
		$data['desa_count'] = count($this->desa->getDesa(1, null));
		$data['tps_count'] = count($this->tps->getTps(0, null));
		$data['tps_input'] = count($this->tps->getTps(0, null)) - $this->tps->getTpsKosong(0, null);
		$data['all_paslon_count'] = count($this->paslon->getAllPaslon());
		$data['paslon_count'] = count($this->paslon->getPaslon(null));
		$data['tidak_sah_count'] = count($this->paslon->getTidakSah());
		$data['paslon'] = $this->paslon->getPaslon(null);

		//HASIL SAH
		foreach ($this->paslon->getPaslon(null) as $paslon) {
			$kabupaten_sah[] = $this->hasil->getSuara(0, null, $paslon['id']);
		}
		$data['hasil_sah'] = $kabupaten_sah;
		$total_sah = 0;
		for ($i = 0; $i < count($data['hasil_sah']); $i++) {
			$total_sah = $total_sah + $data['hasil_sah'][$i]['jml_suara'];
		}
		$data['total_sah'] = $total_sah;

		$data['hasil_tidak_sah'] = $this->hasil->getSuaraTidakSah(0, null)['jml_suara'];


		//SEMUA HASIL TERMASUK TIDAK SAH
		foreach ($this->paslon->getAllPaslon() as $paslon) {
			$kabupaten_tidak_sah[] = $this->hasil->getSuara(0, null, $paslon['id']);
		}
		$data['hasil'] = $kabupaten_tidak_sah;


		$jumlah_total = 0;
		foreach ($data['hasil'] as $h) {
			$jumlah_total = $jumlah_total + $h['jml_suara'];
			$data['total'] = $jumlah_total;
		}

		$data['dpt'] = $this->tps->getDpt(0, null)['dpt'];

		foreach ($data['hasil_sah'] as $hs) {
			$data['chart']['nama'][] = $hs['nama'];
			if ($data['total_sah'] == 0) {
				$data['chart']['jml_suara'][] = 0;
			} else {

				$data['chart']['jml_suara'][] = round($hs['jml_suara'] / $data['total_sah'] * 100, 2);
			}
		}

		$this->load->view('dashboard/index', $data);
		$this->load->view('dashboard/chart');
	}
}
