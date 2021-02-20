<?php

use function PHPSTORM_META\type;

class Hasil_model extends CI_Model
{
    public function getSuara($type, $id, $paslon_id)
    {
        if ($type == 0) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`, `paslon`.`cabub`, `paslon`.`cawabub`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `paslon`.`id` = '$paslon_id'
            ";
        } else if ($type == 1) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`,`kecamatan`.`kecamatan`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `kecamatan`.`id` = '$id' AND `paslon`.`id` = '$paslon_id'
            ";
        } else if ($type == 2) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `desa`.`id` = '$id' AND `paslon`.`id` = '$paslon_id'
            ";
        } else if ($type == 3) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`id`, `paslon`.`no_urut`, `paslon`.`nama`,`desa`.`desa`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `tps`.`id` = '$id' AND `paslon`.`id` = '$paslon_id'
            ";
        }

        return $this->db->query($query)->row_array();
    }

    public function getSuaraTidakSah($type, $id)
    {
        if ($type == 0) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`,`kecamatan`.`kecamatan`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `paslon`.`is_active` = 0
            ";
        } else if ($type == 1) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`,`kecamatan`.`kecamatan`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `kecamatan`.`id` = '$id' AND `paslon`.`is_active` = 0
            ";
        } else if ($type == 2) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`,`desa`.`desa`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `desa`.`id` = '$id' AND `paslon`.`is_active` = 0
            ";
        } else if ($type == 3) {
            $query = "
            SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`,`desa`.`desa`
            FROM `hasil`
            JOIN `tps`
            ON `hasil`.`tps_id` = `tps`.`id`
            JOIN `desa`
            ON `tps`.`desa_id` = `desa`.`id`
            JOIN `kecamatan`
            ON `desa`.`kecamatan_id` = `kecamatan`.`id`
            JOIN `paslon`
            ON `paslon`.`id` = `hasil`.`paslon_id`
            WHERE `tps`.`id` = '$id' AND `paslon`.`is_active` = 0
            ";
        }

        return $this->db->query($query)->row_array();
    }

    public function insert()
    {
        $this->db->select_max('id', 'id');
        $tps_id = $this->db->get('tps')->row_array()['id'];

        foreach ($this->paslon->getAllPaslon() as $paslon) {
            $data = [
                'jml_suara' => $this->input->post('jml_suara'),
                'paslon_id' => $paslon['id'],
                'tps_id' => $tps_id
            ];

            $this->db->insert('hasil', $data);
        }
    }

    public function update()
    {
        $tps_id = $this->input->post('tps_id');

        for ($i = 0; $i < count($this->paslon->getAllPaslon()); $i++) {
            $this->db->where('tps_id', $tps_id);
            $this->db->where('paslon_id', $this->input->post('paslon_id')[$i]);
            $this->db->update('hasil', array('jml_suara' => $this->input->post('suara')[$i]));
        }
    }

    public function delete($tps_id)
    {
        $this->db->delete('hasil', ['tps_id' => $tps_id]);
    }
}
