<?php

class Kecamatan_model extends CI_Model
{
    public function getKecamatan($id)
    {
        if ($id == null) {
            return $this->db->get('kecamatan')->result_array();
        } else {
            return $this->db->get_where('kecamatan', array('id' => $id))->row_array();
        }
    }

    public function insert()
    {
        $data = [
            'kecamatan' => $this->input->post('kecamatan'),
            'koordinator' => $this->input->post('koordinator')
        ];

        $this->db->insert('kecamatan', $data);
    }

    public function update($id)
    {
        $data = [
            'kecamatan' => $this->input->post('kecamatan'),
            'password' => $this->input->post('password'),
            'koordinator' => $this->input->post('koordinator')
        ];

        $this->db->update('kecamatan', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('kecamatan', ['id' => $id]);
    }

    public function getCount()
    {
        return $this->db->get('kecamatan')->num_rows();
    }

    public function getBelumInput($id)
    {
        $query = "
            SELECT DISTINCT(`kecamatan`.`kecamatan`), `kecamatan`.`id`, `kecamatan`.`koordinator`
            FROM `kecamatan`
            JOIN `desa`
            ON `kecamatan`.`id` = `desa`.`kecamatan_id`
            JOIN `tps`
            ON `desa`.`id` = `tps`.`desa_id`
            JOIN `hasil`
            ON `tps`.`id` = `hasil`.`tps_id`
            WHERE `hasil`.`jml_suara` IS NULL
        ";

        if ($id != null) {
            return $this->db->query($query . " AND `kecamatan`.`id` = '$id'")->result_array();
        } else {
            return $this->db->query($query)->result_array();
        }
    }

    public function getRanking($kecamatan_id)
    {
        $query = "
        SELECT COUNT(`kecamatan`.`id`) AS 'jumlah', `kecamatan`.`kecamatan`, `kecamatan`.`koordinator`
        FROM `kecamatan`
        JOIN `desa`
        ON `kecamatan`.`id` = `desa`.`kecamatan_id`
        JOIN `tps`
        ON `desa`.`id` = `tps`.`desa_id`
        JOIN `hasil`
        ON `tps`.`id` = `hasil`.`tps_id`
        WHERE `kecamatan`.`id` = '$kecamatan_id' AND `hasil`.`jml_suara` IS NOT NULL
        ";

        return $this->db->query($query)->row_array();
    }
}
