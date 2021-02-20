<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Login Admin';

		if ($this->session->userdata('id')) {
			redirect('dashboard');
		} else {
			if ($this->agent->is_mobile() || $this->agent->is_browser()) {
				$this->load->view('auth/login', $data);
			} else {
				redirect('auth/blocked');
			}
		}
	}

	public function login()
	{
		$this->admin->login();
	}

	public function logout()
	{
		foreach ($this->session->userdata() as $key => $value) {
			if ($key != '__ci_last_regenerate' && $key != '__ci_vars')
				$this->session->unset_userdata($key);
		}
		$this->session->set_flashdata([
			'type' => 1,
			'message' => 'Logout Berhasil!'
		]);
		redirect('auth');
	}

	public function blocked()
	{
		$data['title'] = 'Halaman Tidak Ditemukan';

		$this->load->view('errors/404', $data);
	}
}
