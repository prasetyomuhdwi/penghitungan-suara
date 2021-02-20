<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tps extends CI_Controller
{
	public function index($desa_id)
	{
		if (empty($this->session->userdata("login_session_user"))) {
			if (!$this->session->userdata('username')) {
				redirect('auth');
			} else {
				if ($this->session->userdata('role') != 0) {
					redirect('auth/blocked');
				}
			}
		}

		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}
		$data['desa'] = $this->desa->getDesa(1, $desa_id);
		$data['tps'] = $this->tps->getTps(2, $desa_id);
		$data['title'] = 'Data TPS - Desa ' . $data['desa']['desa'];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('tps/index');
		$this->load->view('templates/footer');
		$this->load->view('tps/script');
	}

	public function insert()
	{
		$desa_id = $this->input->post('desa_id');
		$this->tps->insert();
		$this->hasil->insert();
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{
		$desa_id = $this->input->post('desa_id');
		$this->tps->update($this->input->post('id'));
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id)
	{
		$desa_id = $this->input->post('desa_id');
		$this->hasil->delete($id);
		$this->tps->delete($id);
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Dihapus!'
		]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function ajax()
	{
		echo json_encode($this->tps->getTps(0, $this->input->post('id')));
	}

	public function belum_input()
	{
		if (empty($this->session->userdata("login_session_user"))) {
			if (!$this->session->userdata('username')) {
				redirect('auth');
			}
		}

		$id = $this->input->post('id');
		$data['title'] = 'Data TPS Belum Input';
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}
		$data['list'] = $this->kecamatan->getKecamatan(null);

		if ($this->kecamatan->getBelumInput($id)) {
			foreach ($this->kecamatan->getBelumInput($id) as $kecamatan) {
				foreach ($this->desa->getBelumInput($kecamatan['id']) as $desa) {
					foreach ($this->tps->getBelumInput($desa['id']) as $tps) {
						$desa['tps'][] = $tps;
					}
					$kecamatan['desa'][] = $desa;
				}
				$data['kecamatan'][] = $kecamatan;
			}
		} else {
			$data['kecamatan'] = NULL;
		}


		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('tps/belum-input');
		$this->load->view('templates/footer');
		$this->load->view('tps/script');
	}
}
