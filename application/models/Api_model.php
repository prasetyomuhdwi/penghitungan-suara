<?php

class Api_model extends CI_Model
{
    // public function login($kecamatan, $password)
    // {
    //     $result = $this->db->get_where('kecamatan', ['kecamatan' => $kecamatan])->row_array();



    //     if ($result) {
    //         if (hash_verified($password, $result['password'])) {
    //             $this->db->select('id, kecamatan');
    //             $this->db->where('kecamatan', $kecamatan);
    //             return $this->db->get('kecamatan')->row_array();
    //         } else {
    //             return null;
    //         }
    //     } else {
    //         return null;
    //     }
    // }

    public function login($id, $password)
    {
        $result = $this->db->get_where('desa', ['id' => $id])->row_array();
        if ($result) {
            if (hash_verified($password, $result['password'])) {
                $this->db->select('id, desa, kecamatan_id');
                $this->db->where('id', $id);
                return $this->db->get('desa')->row_array();
            } else {
                return null;
            }
        } else {
            return null;
        }

        $this->db->where('id', $id);
        $this->db->where('password', $password);

        return $this->db->get('desa')->row_array();
    }

    public function getkecamatan()
    {
        return $this->db->get('kecamatan')->result_array();
    }

    public function getDesa($kecamatan_id)
    {
        return $this->db->get_where('desa', array('kecamatan_id' => $kecamatan_id))->result_array();
    }

    public function getTps($desa_id)
    {
        return $this->db->get_where('tps', array('desa_id' => $desa_id))->result_array();
    }

    public function getData($tps_id)
    {
        $query = "
        SELECT `tps`.`id` AS 'tps_id', `tps`.`tps`, `paslon`.`id` AS 'paslon_id', `paslon`.`nama`, `hasil`.`jml_suara`
        FROM `tps`
        JOIN `hasil`
        ON `tps`.`id` = `hasil`.`tps_id`
        JOIN `paslon`
        ON `hasil`.`paslon_id` = `paslon`.`id`
        WHERE `tps`.`id` = '$tps_id'
        ORDER BY `paslon`.`no_urut` ASC
        ";

        return $this->db->query($query)->result_array();
    }

    public function getPaslon()
    {
        return $this->db->get('paslon')->result_array();
    }

    public function update($data, $tps_id, $paslon_id)
    {
        $this->db->where('tps_id', $tps_id);
        $this->db->where('paslon_id', $paslon_id);

        $this->db->update('hasil', $data);
        return $this->db->affected_rows();
    }

    // public function getReport($kecamatan_id, $paslon_id)
    // {
    //     $query = "
    //     SELECT SUM(`hasil`.`jml_suara`) AS 'jml_suara', `paslon`.`no_urut`, `paslon`.`nama`,`kecamatan`.`kecamatan`
    //     FROM `hasil`
    //     JOIN `tps`
    //     ON `hasil`.`tps_id` = `tps`.`id`
    //     JOIN `desa`
    //     ON `tps`.`desa_id` = `desa`.`id`
    //     JOIN `kecamatan`
    //     ON `desa`.`kecamatan_id` = `kecamatan`.`id`
    //     JOIN `paslon`
    //     ON `paslon`.`id` = `hasil`.`paslon_id`
    //     WHERE `kecamatan`.`id` = '$kecamatan_id' AND `paslon`.`id` = '$paslon_id'
    //     ";
    //     return $this->db->query($query)->result_array();
    // }
}
