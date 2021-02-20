<?php

class Admin_model extends CI_Model
{
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $admin = $this->db->get_where('admin', ['username' => $username])->row_array();

        if ($admin) {
            if (hash_verified($password, $admin['password'])) {
                $this->lastLogin($admin['username']);
                $data = [
                    'id' => $admin['id'],
                    'username' => $admin['username'],
                    'password' => $admin['password'],
                    'role' => $admin['role']
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata([
                    'type' => 1,
                    'message' => 'Login Berhasil!'
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata([
                    'type' => 3,
                    'message' => 'Login Gagal!'
                ]);
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata([
                'type' => 3,
                'message' => 'Login Gagal!'
            ]);
            redirect('auth');
        }
    }

    public function getAdmin($id)
    {
        if ($id == null) {
            return $this->db->get_where('admin', array('role' => 1))->result_array();
        } else {
            return $this->db->get_where('admin', array('id' => $id))->row_array();
        }
    }

    public function insert()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => get_hash($this->input->post('password')),
            'role' => 1
        ];

        $this->db->insert('admin', $data);
    }

    public function update()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => get_hash($this->input->post('password'))
        ];

        $this->db->update('admin', $data, ['id' => $this->input->post('id')]);
    }

    public function delete($id)
    {
        $this->db->delete('admin', ['id' => $id]);
    }

    public function lastLogin($username)
    {
        $data = [
            'username' => $username,
            'time' => date("Y-m-d H:i:s"),
            'type' => 'Web',
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->agent->agent_string()
        ];

        $this->db->insert('last_login', $data);
    }

    public function getAktivitas($type)
    {
        $this->db->where('type', $type);
        $this->db->order_by('time', 'DESC');
        return $this->db->get('last_login')->result_array();
    }
}
