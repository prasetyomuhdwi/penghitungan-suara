<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paslon extends CI_Controller
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
		$data['title'] = 'Data Paslon';
		foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}

		$data['paslon'] = $this->paslon->getPaslon(null);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('paslon/index');
		$this->load->view('templates/footer');
		$this->load->view('paslon/script');
	}

	public function insert()
	{
		$this->paslon->insert();
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect('paslon');
	}

	public function update()
	{
		$this->paslon->update($this->input->post('id'));
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Disimpan!'
		]);
		redirect('paslon');
	}

	public function delete($id)
	{
		$this->paslon->delete($id);
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Data Berhasil Dihapus!'
		]);
		redirect('paslon');
	}

	public function foto()
	{
		$this->paslon->uploadImage();
		redirect('paslon');
	}

	public function ajax()
	{
		echo json_encode($this->paslon->getPaslon($this->input->post('id')));
	}
}
