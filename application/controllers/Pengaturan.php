<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
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
        $data['title'] = 'Pengaturan Aplikasi';

        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        $data['admin'] = $this->admin->getAdmin(null);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('pengaturan/index');
        $this->load->view('templates/footer');
        $this->load->view('pengaturan/script');
    }

    public function addAdmin()
    {
        $this->admin->insert();
        $this->session->set_flashdata([
            'type' => 1,
            'message' => 'Data Berhasil Disimpan!'
        ]);
        redirect('pengaturan');
    }

    public function updateAdmin()
    {
        $this->admin->update();
        $this->session->set_flashdata([
            'type' => 1,
            'message' => 'Data Berhasil Disimpan!'
        ]);
        redirect('pengaturan');
    }

    public function deleteAdmin($id)
    {
        $this->admin->delete($id);
        $this->session->set_flashdata([
            'type' => 1,
            'message' => 'Data Berhasil Dihapus!'
        ]);
        redirect('pengaturan');
    }

    public function ajaxAdmin()
    {
        echo json_encode($this->admin->getAdmin($this->input->post('id')));
    }

    public function ajaxAplikasi()
    {
        if ($this->pengaturan->saveAplikasi() == true) {
            $this->session->set_flashdata([
                'type' => 1,
                'message' => 'Data Berhasil Disimpan!'
            ]);
        } else {
            $this->session->set_flashdata([
                'type' => 3,
                'message' => 'Data Gagal Disimpan!'
            ]);
        }
        echo json_encode('redirect');
    }

    public function ajaxLaporan()
    {
        if ($this->pengaturan->saveLaporan() == true) {
            $this->session->set_flashdata([
                'type' => 1,
                'message' => 'Data Berhasil Disimpan!'
            ]);
        } else {
            $this->session->set_flashdata([
                'type' => 3,
                'message' => 'Data Gagal Disimpan!'
            ]);
        }
        echo json_encode('redirect');
    }

    public function upload()
    {
        $this->pengaturan->uploadImage();
        redirect('pengaturan');
    }
}
