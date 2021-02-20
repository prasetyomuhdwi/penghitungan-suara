<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktivitas extends CI_Controller
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
        $data['title'] = 'Aktivitas';
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }
        $data['web'] = $this->admin->getAktivitas('web');
        $data['mobile'] = $this->admin->getAktivitas('mobile');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('aktivitas/index');
        $this->load->view('templates/footer');
        $this->load->view('aktivitas/script');
    }
}
