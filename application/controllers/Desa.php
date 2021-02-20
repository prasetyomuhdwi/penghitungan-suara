<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Desa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata("login_session_user"))) {
			if (!$this->session->userdata('username')) {
				redirect('auth');
			} else {
				if ($this->session->userdata('role') != 0) {
					redirect('auth/blocked');
				}
			}
		}
	}

	public function index($kecamatan_id)
	{
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$data['desa'] = $this->desa->getDesa(2, $kecamatan_id);
		$data['kecamatan'] = $this->kecamatan->getKecamatan($kecamatan_id);
		$data['title'] = 'Data Desa - Kecamatan ' . $data['kecamatan']['kecamatan'];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('desa/index');
		$this->load->view('templates/footer');
		$this->load->view('desa/script');
	}

	public function insert()
	{
		$this->desa->insert();
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{
		$this->desa->update($this->input->post('id'));
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id)
	{
		$this->desa->delete($id);
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Dihapus!'
		]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function ajax()
	{
		echo json_encode($this->desa->getDesa(1, $this->input->post('id')));
	}
}
