<?php

class Desa_model extends CI_Model
{
    public function getDesa($type, $id)
    {
        if ($type == 1) {
            if ($id == null) {
                $query = "
                SELECT `desa`.*, `kecamatan`.`kecamatan`
                FROM `desa`
                JOIN `kecamatan`
                ON `desa`.`kecamatan_id` = `kecamatan`.`id`
                ORDER BY `kecamatan_id` ASC
                ";

                return $this->db->query($query)->result_array();
            } else {
                $query = "
                SELECT `desa`.*, `kecamatan`.`kecamatan`
                FROM `desa`
                JOIN `kecamatan`
                ON `desa`.`kecamatan_id` = `kecamatan`.`id`
                WHERE `desa`.`id` = '$id'
                ";

                return $this->db->query($query)->row_array();
            }
        } else if ($type == 2) {
            $query = "
            SELECT `desa`.*, `kecamatan`.`kecamatan`
            FROM `desa`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            WHERE `kecamatan`.`id` = '$id'
            ";

            return $this->db->query($query)->result_array();
        }
    }

    public function insert()
    {
        $data = [
            'desa' => $this->input->post('desa'),
            'kecamatan_id' => $this->input->post('kecamatan_id')
        ];

        $this->db->insert('desa', $data);
    }

    public function update($id)
    {
        $data = [
            'desa' => $this->input->post('desa')
        ];

        $this->db->update('desa', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('desa', ['id' => $id]);
    }

    public function getBelumInput($kecamatan_id)
    {
        $query = "
        SELECT DISTINCT(`desa`.`desa`), `desa`.`id`
        FROM `kecamatan`
        JOIN `desa`
        ON `kecamatan`.`id` = `desa`.`kecamatan_id`
        JOIN `tps`
        ON `desa`.`id` = `tps`.`desa_id`
        JOIN `hasil`
        ON `tps`.`id` = `hasil`.`tps_id`
        WHERE `kecamatan`.`id` = '$kecamatan_id' AND `hasil`.`jml_suara` IS NULL
        ";

        return $this->db->query($query)->result_array();
    }
}
