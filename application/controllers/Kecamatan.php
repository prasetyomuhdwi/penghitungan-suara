<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller
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

	public function index()
	{
		$data['title'] = 'Data Kecamatan';
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$data['kecamatan'] = $this->kecamatan->getKecamatan(null);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('kecamatan/index');
		$this->load->view('templates/footer');
		$this->load->view('kecamatan/script');
	}

	public function insert()
	{
		$this->kecamatan->insert();
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect('kecamatan');
	}

	public function update()
	{
		$this->kecamatan->update($this->input->post('id'));
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect('kecamatan');
	}

	public function delete($id)
	{
		$this->kecamatan->delete($id);
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Dihapus!'
		]);
		redirect('kecamatan');
	}

	public function ajax()
	{
		echo json_encode($this->kecamatan->getKecamatan($this->input->post('id')));
	}
}
