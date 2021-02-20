<?php

class Tps_model extends CI_Model
{
    public function getTps($type, $id)
    {
        if ($type == 0) {
            if ($id == null) {
                return $this->db->get('tps')->result_array();
            } else {
                $this->db->order_by('tps', 'ASC');
                return $this->db->get_where('tps', array('id' => $id))->row_array();
            }
        } else if ($type == 1) {
            $query = "
            SELECT `tps`.*
            FROM `tps`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `kecamatan`.`id` = `desa`.`kecamatan_id`
            WHERE `kecamatan`.`id` = '$id'
            ";

            return $this->db->query($query)->result_array();
        } else if ($type == 2) {
            $this->db->order_by('tps', 'ASC');
            return $this->db->get_where('tps', array('desa_id' => $id))->result_array();
        }
    }

    public function getTpsKosong($type, $id)
    {
        if ($type == 0) {
            $query = "
            SELECT DISTINCT(`tps`.`id`)
            FROM `tps`
            JOIN `hasil`
            ON `tps`.`id` = `hasil`.`tps_id`
            JOIN `desa`
            ON `desa`.`id` = `tps`.`desa_id`
            JOIN `kecamatan`
            ON `kecamatan`.`id` = `desa`.`kecamatan_id`
            WHERE `hasil`.`jml_suara` IS NULL
            ";
        } else if ($type == 1) {
            $query = "
            SELECT DISTINCT(`tps`.`id`)
            FROM `tps`
            JOIN `hasil`
            ON `tps`.`id` = `hasil`.`tps_id`
            JOIN `desa`
            ON `desa`.`id` = `tps`.`desa_id`
            JOIN `kecamatan`
            ON `kecamatan`.`id` = `desa`.`kecamatan_id`
            WHERE `hasil`.`jml_suara` IS NULL
            AND `kecamatan`.`id` = '$id'
            ";
        } else if ($type == 2) {
            $query = "
            SELECT DISTINCT(`tps`.`id`)
            FROM `tps`
            JOIN `hasil`
            ON `tps`.`id` = `hasil`.`tps_id`
            JOIN `desa`
            ON `desa`.`id` = `tps`.`desa_id`
            JOIN `kecamatan`
            ON `kecamatan`.`id` = `desa`.`kecamatan_id`
            WHERE `hasil`.`jml_suara` IS NULL
            AND `desa`.`id` = '$id'
            ";
        }

        return $this->db->query($query)->num_rows();
    }

    public function insert()
    {
        $data = [
            'tps' => $this->input->post('tps'),
            'dpt' => $this->input->post('dpt'),
            'desa_id' => $this->input->post('desa_id')
        ];

        $this->db->insert('tps', $data);
    }

    public function update($id)
    {
        $data = [
            'tps' => $this->input->post('tps'),
            'dpt' => $this->input->post('dpt')
        ];

        $this->db->update('tps', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('tps', ['id' => $id]);
    }

    public function getDpt($type, $id)
    {
        //kabupaten
        if ($type == 0) {
            $query = "
            SELECT SUM(`tps`.`dpt`) AS 'dpt',`kecamatan`.`kecamatan`
            FROM `tps`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            ";
        }
        //kecamatan
        elseif ($type == 1) {
            $query = "
            SELECT SUM(`tps`.`dpt`) AS 'dpt'
            FROM `tps`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            WHERE `kecamatan`.`id` = '$id'
            ";
        }
        //desa
        else if ($type == 2) {
            $query = "
            SELECT SUM(`tps`.`dpt`) AS 'dpt',`desa`.`desa`
            FROM `tps`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            WHERE `desa`.`id` = '$id'
            ";
        } else if ($type == 3) {
            $query = "
            SELECT SUM(`tps`.`dpt`) AS 'dpt'
            FROM `tps`
            WHERE `tps`.`id` = '$id'
            ";
        }


        return $this->db->query($query)->row_array();
    }

    public function getBelumInput($desa_id)
    {
        $query = "
        SELECT DISTINCT(`tps`.`tps`), `tps`.`id`
        FROM `kecamatan`
        JOIN `desa`
        ON `kecamatan`.`id` = `desa`.`kecamatan_id`
        JOIN `tps`
        ON `desa`.`id` = `tps`.`desa_id`
        JOIN `hasil`
        ON `tps`.`id` = `hasil`.`tps_id`
        WHERE `desa`.`id` = '$desa_id' AND `hasil`.`jml_suara` IS NULL
        ";

        return $this->db->query($query)->result_array();
    }
}
