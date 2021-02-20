<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suara_masuk extends CI_Controller
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
		$data['title'] = 'Data Suara Masuk se Kabupaten Ngawi';
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$data['all_paslon_count'] = count($this->paslon->getAllPaslon());
		$data['paslon_count'] = count($this->paslon->getPaslon(null));
		$data['tidak_sah_count'] = count($this->paslon->getTidakSah());
		$data['paslon'] = $this->paslon->getPaslon(null);

		//HASIL SAH
		foreach ($this->paslon->getPaslon(null) as $paslon) {
			$kabupaten_sah['hasil'][] = $this->hasil->getSuara(0, null, $paslon['id']);
		}
		$data['hasil_sah'][] = $kabupaten_sah;

		foreach ($data['hasil_sah'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total_sah'] = $total;
		}

		$data['hasil_tidak_sah'] = $this->hasil->getSuaraTidakSah(0, null);

		//SEMUA HASIL TERMASUK TIDAK SAH
		foreach ($this->paslon->getAllPaslon() as $paslon) {
			$kabupaten_tidak_sah['hasil'][] = $this->hasil->getSuara(0, null, $paslon['id']);
		}
		$data['hasil'][] = $kabupaten_tidak_sah;

		foreach ($data['hasil'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['all_paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total'][] = $total;
		}

		$data['dpt'][] = $this->tps->getDpt(0, null);
		$data['tps_kosong'][] = $this->tps->getTpsKosong(0, null);
		$data['tps_input'][] = count($this->tps->getTps(0, null)) - $this->tps->getTpsKosong(0, null);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('suara-masuk/index');
		$this->load->view('templates/footer');
		$this->load->view('suara-masuk/script');
	}

	public function kabupaten()
	{
		$data['title'] = 'Data Suara Masuk';
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$data['all_paslon_count'] = count($this->paslon->getAllPaslon());
		$data['paslon_count'] = count($this->paslon->getPaslon(null));
		$data['tidak_sah_count'] = count($this->paslon->getTidakSah());
		$data['paslon'] = $this->paslon->getPaslon(null);

		//HASIL SAH
		foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
			foreach ($this->paslon->getPaslon(null) as $paslon) {
				$kecamatan['hasil'][] = $this->hasil->getSuara(1, $kecamatan['id'], $paslon['id']);
			}
			$data['hasil_sah'][] = $kecamatan;
		}

		//JUMLAH HASIL SAH
		for ($j = 0; $j < $data['paslon_count']; $j++) {
			$jumlah = 0;
			foreach ($data['hasil_sah'] as $h) {
				$jumlah = $jumlah + $h['hasil'][$j]['jml_suara'];
				// $h['hasil'][$j]['jml_suara'] / $total_sah[$i] * 100;
			}
			$data['jumlah']['paslon'][] = $jumlah;
		}

		//TOTAL HASIL SAH
		foreach ($data['hasil_sah'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total_sah'][] = $total;
		}

		//JUMLAH TOTAL HASIL SAH
		$data['jumlah']['sah'] = array_sum($data['total_sah']);

		//HASIL TIDAK SAH
		foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
			$kecamatan['hasil'][] = $this->hasil->getSuaraTidakSah(1, $kecamatan['id']);
			$data['hasil_tidak_sah'][] = $kecamatan;
		}

		//JUMLAH HASIL TIDAK SAH
		for ($j = 0; $j < $data['tidak_sah_count']; $j++) {
			$jumlah = 0;
			foreach ($data['hasil_tidak_sah'] as $hts) {
				$jumlah = $jumlah + $hts['hasil'][$j]['jml_suara'];
			}
			$data['jumlah']['tidak_sah'] = $jumlah;
		}

		//SEMUA HASIL TERMASUK TIDAK SAH
		foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
			foreach ($this->paslon->getAllPaslon() as $paslon) {
				$kecamatan['hasil'][] = $this->hasil->getSuara(1, $kecamatan['id'], $paslon['id']);
			}
			$data['hasil'][] = $kecamatan;
		}

		foreach ($data['hasil'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['all_paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total'][] = $total;
		}

		$data['jumlah']['hadir'] = array_sum($data['total']);

		foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
			$data['dpt'][] = $this->tps->getDpt(1, $kecamatan['id'])['dpt'];
			$data['tps_kosong'][] = $this->tps->getTpsKosong(1, $kecamatan['id']);
			$data['tps_input'][] = count($this->tps->getTps(1, $kecamatan['id'])) - $this->tps->getTpsKosong(1, $kecamatan['id']);
		}

		$data['jumlah']['dpt'] = array_sum($data['dpt']);
		$data['jumlah']['tps_kosong'] = array_sum($data['tps_kosong']);
		$data['jumlah']['tps_input'] = array_sum($data['tps_input']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('suara-masuk/kabupaten');
		$this->load->view('templates/footer');
		$this->load->view('suara-masuk/script');
	}

	public function kecamatan($kecamatan_id)
	{
		$data['title'] = "Data Suara - Kecamatan " . $this->kecamatan->getKecamatan($kecamatan_id)['kecamatan'];
		$data['kecamatan_id'] = $kecamatan_id;
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$data['all_paslon_count'] = count($this->paslon->getAllPaslon());
		$data['paslon_count'] = count($this->paslon->getPaslon(null));
		$data['tidak_sah_count'] = count($this->paslon->getTidakSah());
		$data['paslon'] = $this->paslon->getPaslon(null);

		//HASIL SAH
		foreach ($this->desa->getDesa(2, $kecamatan_id) as $desa) {
			foreach ($this->paslon->getPaslon(null) as $paslon) {
				$desa['hasil'][] = $this->hasil->getSuara(2, $desa['id'], $paslon['id']);
			}
			$data['hasil_sah'][] = $desa;
		}

		//JUMLAH HASIL SAH
		for ($j = 0; $j < $data['paslon_count']; $j++) {
			$jumlah = 0;
			foreach ($data['hasil_sah'] as $h) {
				$jumlah = $jumlah + $h['hasil'][$j]['jml_suara'];
			}
			$data['jumlah']['paslon'][] = $jumlah;
		}

		foreach ($data['hasil_sah'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total_sah'][] = $total;
		}

		//JUMLAH TOTAL HASIL SAH
		$data['jumlah']['sah'] = array_sum($data['total_sah']);

		foreach ($this->desa->getDesa(2, $kecamatan_id) as $desa) {
			$desa['hasil'][] = $this->hasil->getSuaraTidakSah(2, $desa['id']);
			$data['hasil_tidak_sah'][] = $desa;
		}

		//JUMLAH HASIL TIDAK SAH
		for ($j = 0; $j < $data['tidak_sah_count']; $j++) {
			$jumlah = 0;
			foreach ($data['hasil_tidak_sah'] as $hts) {
				$jumlah = $jumlah + $hts['hasil'][$j]['jml_suara'];
			}
			$data['jumlah']['tidak_sah'] = $jumlah;
		}

		//SEMUA HASIL TERMASUK TIDAK SAH
		foreach ($this->desa->getDesa(2, $kecamatan_id) as $desa) {
			foreach ($this->paslon->getAllPaslon() as $paslon) {
				$desa['hasil'][] = $this->hasil->getSuara(2, $desa['id'], $paslon['id']);
			}
			$data['hasil'][] = $desa;
		}

		foreach ($data['hasil'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['all_paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total'][] = $total;
		}

		$data['jumlah']['hadir'] = array_sum($data['total']);

		foreach ($this->desa->getDesa(2, $kecamatan_id) as $desa) {
			$data['dpt'][] = $this->tps->getDpt(2, $desa['id'])['dpt'];
			$data['tps_kosong'][] = $this->tps->getTpsKosong(2, $desa['id']);
			$data['tps_input'][] = count($this->tps->getTps(2, $desa['id'])) - $this->tps->getTpsKosong(2, $desa['id']);
		}

		$data['jumlah']['dpt'] = array_sum($data['dpt']);
		$data['jumlah']['tps_kosong'] = array_sum($data['tps_kosong']);
		$data['jumlah']['tps_input'] = array_sum($data['tps_input']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('suara-masuk/kecamatan');
		$this->load->view('templates/footer');
	}

	public function desa($desa_id)
	{
		$data['title'] = "Data Suara - Desa " . $this->desa->getDesa(1, $desa_id)['desa'];
		$data['desa_id'] = $desa_id;
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$data['all_paslon_count'] = count($this->paslon->getAllPaslon());
		$data['paslon_count'] = count($this->paslon->getPaslon(null));
		$data['tidak_sah_count'] = count($this->paslon->getTidakSah());
		$data['paslon'] = $this->paslon->getPaslon(null);
		$data['all_paslon'] = $this->paslon->getAllPaslon();

		//HASIL SAH
		foreach ($this->tps->getTps(2, $desa_id) as $tps) {
			foreach ($this->paslon->getPaslon(null) as $paslon) {
				$tps['hasil'][] = $this->hasil->getSuara(3, $tps['id'], $paslon['id']);
			}
			$data['hasil_sah'][] = $tps;
		}

		//JUMLAH HASIL SAH
		for ($j = 0; $j < $data['paslon_count']; $j++) {
			$jumlah = 0;
			foreach ($data['hasil_sah'] as $h) {
				$jumlah = $jumlah + $h['hasil'][$j]['jml_suara'];
				// $h['hasil'][$j]['jml_suara'] / $total_sah[$i] * 100;
			}
			$data['jumlah']['paslon'][] = $jumlah;
		}

		foreach ($data['hasil_sah'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total_sah'][] = $total;
		}

		//JUMLAH TOTAL HASIL SAH
		$data['jumlah']['sah'] = array_sum($data['total_sah']);

		foreach ($this->tps->getTps(2, $desa_id) as $tps) {
			$tps['hasil'][] = $this->hasil->getSuaraTidakSah(3, $tps['id']);
			$data['hasil_tidak_sah'][] = $tps;
		}

		//JUMLAH HASIL TIDAK SAH
		for ($j = 0; $j < $data['tidak_sah_count']; $j++) {
			$jumlah = 0;
			foreach ($data['hasil_tidak_sah'] as $hts) {
				$jumlah = $jumlah + $hts['hasil'][$j]['jml_suara'];
			}
			$data['jumlah']['tidak_sah'] = $jumlah;
		}

		//SEMUA HASIL TERMASUK TIDAK SAH
		foreach ($this->tps->getTps(2, $desa_id) as $tps) {
			foreach ($this->paslon->getAllPaslon() as $paslon) {
				$tps['hasil'][] = $this->hasil->getSuara(3, $tps['id'], $paslon['id']);
			}
			$data['hasil'][] = $tps;
		}

		foreach ($data['hasil'] as $h) {
			$total = 0;
			for ($i = 0; $i < $data['all_paslon_count']; $i++) {
				$total = $total + $h['hasil'][$i]['jml_suara'];
			}
			$data['total'][] = $total;
		}

		$data['jumlah']['hadir'] = array_sum($data['total']);

		foreach ($this->tps->getTps(2, $desa_id) as $tps) {
			$data['dpt'][] = $this->tps->getDpt(3, $tps['id'])['dpt'];
		}

		$data['jumlah']['dpt'] = array_sum($data['dpt']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('suara-masuk/desa');
		$this->load->view('templates/footer');
		$this->load->view('suara-masuk/script');
	}

	public function update()
	{
		$this->hasil->update();
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function ajax()
	{
		foreach ($this->paslon->getAllPaslon() as $paslon) {
			$value[] = $this->hasil->getSuara(3, $this->input->post('id'), $paslon['id']);
		}
		echo json_encode($value);
	}
}
