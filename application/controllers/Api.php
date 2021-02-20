<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends REST_Controller
{
    public function login_post()
    {

        $id = $this->post('id');
        $password = $this->post('password');
        $kecamatan = $this->post('kecamatan');
        $api = $this->api->login($id, $password);


        if ($api) {
            $data = [
                'username' => $kecamatan . " - " . $api['desa'],
                'time' => date("Y-m-d H:i:s"),
                'type' => 'Mobile',
                'ip_address' => $this->input->ip_address(),
                'user_agent' => 'Login desa ' . $api['desa']
            ];
            $this->db->insert('last_login', $data);

            $this->response([
                'status' => true,
                'data' => $api
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function kecamatan_get()
    {
        $api = $this->api->getkecamatan(null);

        if ($api) {
            $this->response([
                'status' => true,
                'data' => $api,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function desa_get()
    {
        $kecamatan_id = $this->get('kecamatan_id');

        $api = $this->api->getDesa($kecamatan_id);

        if ($api) {
            $this->response([
                'status' => true,
                'data' => $api,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function tps_get()
    {
        $desa_id = $this->get('desa_id');

        $api = $this->api->getTps($desa_id);

        if ($api) {
            $this->response([
                'status' => true,
                'data' => $api,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function data_get()
    {
        $tps_id = $this->get('tps_id');

        $api = $this->api->getData($tps_id);

        if ($api) {
            $this->response([
                'status' => true,
                'data' => $api,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function data_put()
    {
        $tps_id = $this->put('tps_id');
        $paslon_id = $this->put('paslon_id');
        $kecamatan = $this->put('kecamatan');
        $desa = $this->put('desa');
        $tps = $this->put('tps');

        $data = [
            'jml_suara' => $this->put('jml_suara'),
            'paslon_id' => $paslon_id,
            'tps_id' => $tps_id
        ];

        if ($this->api->update($data, $tps_id, $paslon_id) > 0) {
            $data = [
                'username' => $kecamatan . " - " . $desa,
                'time' => date("Y-m-d H:i:s"),
                'type' => 'Mobile',
                'ip_address' => $this->input->ip_address(),
                'user_agent' => 'Input suara masuk TPS ' . $tps
            ];
            $this->db->insert('last_login', $data);

            $this->response([
                'status' => true,
                'message' => 'Data berhasil disimpan!'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal disimpan!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function paslon_get()
    {
        $api = $this->api->getPaslon();

        if ($api) {
            $this->response([
                'status' => true,
                'data' => $api,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }


    // public function report_get()
    // {
    //     $kecamatan_id = $this->get('kecamatan_id');

    //     if (!$kecamatan_id == null) {

    //         $kecamatan['desa'] = $this->desa->getDesa(2, $kecamatan_id);
    //         $a = $kecamatan;
    //         $i = 0;
    //         foreach ($kecamatan['desa'] as $desa) {
    //             $desa['tps'] = $this->tps->getTps(2, $desa['id']);
    //             $j = 0;
    //             foreach ($desa['tps'] as $tps) {
    //                 foreach ($this->paslon->getAllPaslon() as $paslon) {
    //                     $tps['hasil'][] = $this->hasil->getSuara(3, $tps['id'], $paslon['id']);
    //                 }
    //                 $j++;
    //                 $a['desa'][$i]['tps'][] = $tps;
    //             }
    //             $i++;
    //         }
    //         $data['hasil'][] = $a;

    //         $api = $data['hasil'];

    //         if ($api) {
    //             $this->response([
    //                 'status' => true,
    //                 'data' => $api,
    //             ], REST_Controller::HTTP_OK);
    //         } else {
    //             $this->response([
    //                 'status' => false,
    //                 'message' => 'id not found'
    //             ], REST_Controller::HTTP_NOT_FOUND);
    //         }
    //     } else {
    //         $this->response([
    //             'status' => false,
    //             'message' => 'id not found'
    //         ], REST_Controller::HTTP_NOT_FOUND);
    //     }
    // }
}
