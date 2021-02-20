<?php

class Pengaturan_model extends CI_Model
{
    public function getPengaturan()
    {
        return $this->db->get('settings')->result_array();
    }

    public function saveAplikasi()
    {
        $value = $this->input->post('value');

        $data = [
            'value'  => $value[1]
        ];

        $this->db->update('settings', $data, ['name' => $value[0]]);

        return true;
    }

    public function saveLaporan()
    {
        $value = $this->input->post('value');

        for ($i = 0; $i < count($value); $i++) {
            $data = [
                'value'  => $value[$i][1]
            ];

            $this->db->update('settings', $data, ['name' => $value[$i][0]]);
        }

        return true;
    }

    public function uploadImage()
    {
        $config['upload_path']          = './assets/images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->input->post('nama');
        $config['overwrite']            = true;
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('upload')) {
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
    }
}
