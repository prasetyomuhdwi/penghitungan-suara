<?php

class Paslon_model extends CI_Model
{
	public function getPaslon($id)
	{
		if ($id == null) {
			$this->db->where('is_active', 1);
			return $this->db->get('paslon')->result_array();
		} else {
			$this->db->where('is_active', 1);
			return $this->db->get_where('paslon', array('id' => $id))->row_array();
		}
	}

	public function getAllPaslon()
	{
		return $this->db->get('paslon')->result_array();
	}

	public function getTidakSah()
	{
		$this->db->where('is_active', 0);
		return $this->db->get('paslon')->result_array();
	}

	public function getCount()
	{
		return $this->db->get('paslon')->num_rows();
	}

	public function insert()
	{
		$data = [
			'no_urut' => $this->input->post('no_urut'),
			'nama' => $this->input->post('nama'),
			'cabub' => $this->input->post('cabub'),
			'cawabub' => $this->input->post('cawabub'),
			'is_active' => 1
		];

		$this->db->insert('paslon', $data);
	}

	public function update($id)
	{
		$data = [
			'no_urut' => $this->input->post('no_urut'),
			'nama' => $this->input->post('nama'),
			'cabub' => $this->input->post('cabub'),
			'cawabub' => $this->input->post('cawabub'),
			'is_active' => 1
		];

		$this->db->update('paslon', $data, ['id' => $id]);
	}

	public function delete($id)
	{
		$this->db->delete('paslon', ['id' => $id]);
	}

	public function uploadImage()
	{
		$data['paslon'] = $this->paslon->getPaslon($this->input->post('id2'));
		$cek = $_FILES['foto']['name'];

		if ($cek) {
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite'] = true;
			$config['max_size'] = 1024;
			$config['upload_path'] = './assets/images/paslon';
			$config['file_name'] = $data['paslon']['id'] . $data['paslon']['no_urut'] . $data['paslon']['cabub'] . $data['paslon']['cawabub'];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				$new_image = $this->upload->data('file_name');
				$this->db->set('foto', $new_image);
				$this->db->where('id', $data['paslon']['id']);
				$this->db->update('paslon');

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
}
