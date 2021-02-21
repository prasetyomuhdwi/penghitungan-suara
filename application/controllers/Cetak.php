<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cetak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }


    public function total()
    {
        $data['title'] = 'REKAPITULASI HASIL SEMENTARA PENGHITUNGAN SUARA PILKADA SE KABUPATEN NGAWI';
        $data['kabupaten'] = 'Ngawi';
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        $data['all_paslon_count'] = count($this->paslon->getAllPaslon());
        $data['paslon_count'] = count($this->paslon->getPaslon(null));
        $data['tidak_sah_count'] = count($this->paslon->getTidakSah());
        $data['paslon'] = $this->paslon->getPaslon(null);

        //HASIL SAH
        foreach ($this->paslon->getPaslon(null) as $paslon) {
            $kabupaten_sah['hasil'][] = $this->hasil->getSuara(0, null, $paslon['id']);
        }
        $data['hasil_sah'][] = $kabupaten_sah;

        foreach ($data['hasil_sah'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total_sah'] = $total;
        }


        $data['hasil_tidak_sah'] = $this->hasil->getSuaraTidakSah(0, null);

        //SEMUA HASIL TERMASUK TIDAK SAH
        foreach ($this->paslon->getAllPaslon() as $paslon) {
            $kabupaten_tidak_sah['hasil'][] = $this->hasil->getSuara(0, null, $paslon['id']);
        }
        $data['hasil'][] = $kabupaten_tidak_sah;

        foreach ($data['hasil'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['all_paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total'][] = $total;
        }

        $data['dpt'] = $this->tps->getDpt(0, null);
        $data['tps_kosong'] = $this->tps->getTpsKosong(0, null);
        $data['tps_input'] = count($this->tps->getTps(0, null)) - $this->tps->getTpsKosong(0, null);

        //RINCIAN KECAMATAN
        //HASIL SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            foreach ($this->paslon->getPaslon(null) as $paslon) {
                $kecamatan['hasil'][] = $this->hasil->getSuara(1, $kecamatan['id'], $paslon['id']);
            }
            $data['kecamatan']['hasil_sah'][] = $kecamatan;
        }

        //JUMLAH HASIL SAH
        for ($j = 0; $j < $data['paslon_count']; $j++) {
            $jumlah = 0;
            foreach ($data['kecamatan']['hasil_sah'] as $h) {
                $jumlah = $jumlah + $h['hasil'][$j]['jml_suara'];
                // $h['hasil'][$j]['jml_suara'] / $total_sah[$i] * 100;
            }
            $data['kecamatan']['jumlah']['paslon'][] = $jumlah;
        }

        //TOTAL HASIL SAH
        foreach ($data['kecamatan']['hasil_sah'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['kecamatan']['total_sah'][] = $total;
        }

        //JUMLAH TOTAL HASIL SAH
        $data['kecamatan']['jumlah']['sah'] = array_sum($data['kecamatan']['total_sah']);

        //HASIL TIDAK SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $kecamatan['hasil'][] = $this->hasil->getSuaraTidakSah(1, $kecamatan['id']);
            $data['kecamatan']['hasil_tidak_sah'][] = $kecamatan;
        }

        //JUMLAH HASIL TIDAK SAH
        for ($j = 0; $j < $data['tidak_sah_count']; $j++) {
            $jumlah = 0;
            foreach ($data['kecamatan']['hasil_tidak_sah'] as $hts) {
                $jumlah = $jumlah + $hts['hasil'][$j]['jml_suara'];
            }
            $data['kecamatan']['jumlah']['tidak_sah'] = $jumlah;
        }

        //SEMUA HASIL TERMASUK TIDAK SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            foreach ($this->paslon->getAllPaslon() as $paslon) {
                $kecamatan['hasil'][] = $this->hasil->getSuara(1, $kecamatan['id'], $paslon['id']);
            }
            $data['kecamatan']['hasil'][] = $kecamatan;
        }

        foreach ($data['kecamatan']['hasil'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['all_paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['kecamatan']['total'][] = $total;
        }

        $data['kecamatan']['jumlah']['hadir'] = array_sum($data['kecamatan']['total']);

        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $data['kecamatan']['dpt'][] = $this->tps->getDpt(1, $kecamatan['id'])['dpt'];
        }

        $data['kecamatan']['jumlah']['dpt'] = array_sum($data['dpt']);

        $type = $this->input->get('type');

        $option = array(
            'orientation' => 'P',
            'name' => 'Rekapitulasi Total',
            'type' => $type
        );

        if ($type == 'D') {
            $this->pdf->print('cetak/total', $data, $option);
        } else {
            $this->load->view('cetak/total', $data);
            $this->load->view('cetak/templates/footer');
        }
    }

    public function kabupaten()
    {
        $data['title'] = 'REKAPITULASI HASIL SEMENTARA PENGHITUNGAN SUARA PILKADA SE KABUPATEN NGAWI';
        $data['kabupaten'] = 'Ngawi';
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        $data['all_paslon_count'] = count($this->paslon->getAllPaslon());
        $data['paslon_count'] = count($this->paslon->getPaslon(null));
        $data['tidak_sah_count'] = count($this->paslon->getTidakSah());
        $data['paslon'] = $this->paslon->getPaslon(null);

        //HASIL SAH
        foreach ($this->paslon->getPaslon(null) as $paslon) {
            $kabupaten_sah['hasil'][] = $this->hasil->getSuara(0, null, $paslon['id']);
        }
        $data['hasil_sah'][] = $kabupaten_sah;

        foreach ($data['hasil_sah'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total_sah'] = $total;
        }

        $data['hasil_tidak_sah'] = $this->hasil->getSuaraTidakSah(0, null);

        //SEMUA HASIL TERMASUK TIDAK SAH
        foreach ($this->paslon->getAllPaslon() as $paslon) {
            $kabupaten_tidak_sah['hasil'][] = $this->hasil->getSuara(0, null, $paslon['id']);
        }
        $data['hasil'][] = $kabupaten_tidak_sah;

        foreach ($data['hasil'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['all_paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total'][] = $total;
        }

        $data['dpt'] = $this->tps->getDpt(0, null);
        $data['tps_kosong'] = $this->tps->getTpsKosong(0, null);
        $data['tps_input'] = count($this->tps->getTps(0, null)) - $this->tps->getTpsKosong(0, null);

        $type = $this->input->get('type');

        $option = array(
            'orientation' => 'L',
            'name' => 'Rekapitulasi Total',
            'type' => $type
        );

        if ($type == 'D') {
            $this->pdf->print('cetak/kabupaten', $data, $option);
        } else {
            $this->load->view('cetak/kabupaten', $data);
            $this->load->view('cetak/templates/footer');
        }
    }

    public function kecamatan()
    {
        $data['title'] = 'REKAPITULASI HASIL SEMENTARA PENGHITUNGAN SUARA PILKADA PER KECAMATAN';
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        $data['all_paslon_count'] = count($this->paslon->getAllPaslon());
        $data['paslon_count'] = count($this->paslon->getPaslon(null));
        $data['tidak_sah_count'] = count($this->paslon->getTidakSah());
        $data['paslon'] = $this->paslon->getPaslon(null);

        //HASIL SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            foreach ($this->paslon->getPaslon(null) as $paslon) {
                $kecamatan['hasil'][] = $this->hasil->getSuara(1, $kecamatan['id'], $paslon['id']);
            }
            $data['hasil_sah'][] = $kecamatan;
        }

        //JUMLAH HASIL SAH
        for ($j = 0; $j < $data['paslon_count']; $j++) {
            $jumlah = 0;
            foreach ($data['hasil_sah'] as $h) {
                $jumlah = $jumlah + $h['hasil'][$j]['jml_suara'];
                // $h['hasil'][$j]['jml_suara'] / $total_sah[$i] * 100;
            }
            $data['jumlah']['paslon'][] = $jumlah;
        }

        //TOTAL HASIL SAH
        foreach ($data['hasil_sah'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total_sah'][] = $total;
        }

        //JUMLAH TOTAL HASIL SAH
        $data['jumlah']['sah'] = array_sum($data['total_sah']);

        //HASIL TIDAK SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $kecamatan['hasil'][] = $this->hasil->getSuaraTidakSah(1, $kecamatan['id']);
            $data['hasil_tidak_sah'][] = $kecamatan;
        }

        //JUMLAH HASIL TIDAK SAH
        for ($j = 0; $j < $data['tidak_sah_count']; $j++) {
            $jumlah = 0;
            foreach ($data['hasil_tidak_sah'] as $hts) {
                $jumlah = $jumlah + $hts['hasil'][$j]['jml_suara'];
            }
            $data['jumlah']['tidak_sah'] = $jumlah;
        }

        //SEMUA HASIL TERMASUK TIDAK SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            foreach ($this->paslon->getAllPaslon() as $paslon) {
                $kecamatan['hasil'][] = $this->hasil->getSuara(1, $kecamatan['id'], $paslon['id']);
            }
            $data['hasil'][] = $kecamatan;
        }

        foreach ($data['hasil'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['all_paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total'][] = $total;
        }

        $data['jumlah']['hadir'] = array_sum($data['total']);

        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $data['dpt'][] = $this->tps->getDpt(1, $kecamatan['id'])['dpt'];
            $data['tps_kosong'][] = $this->tps->getTpsKosong(1, $kecamatan['id']);
            $data['tps_input'][] = count($this->tps->getTps(1, $kecamatan['id'])) - $this->tps->getTpsKosong(1, $kecamatan['id']);
        }

        $data['jumlah']['dpt'] = array_sum($data['dpt']);
        $data['jumlah']['tps_kosong'] = array_sum($data['tps_kosong']);
        $data['jumlah']['tps_input'] = array_sum($data['tps_input']);

        $type = $this->input->get('type');

        $option = array(
            'orientation' => 'L',
            'name' => 'Rekapitulasi Kecamatan',
            'type' => $type
        );

        if ($type == 'D') {
            $this->pdf->print('cetak/kecamatan', $data, $option);
        } else {
            $this->load->view('cetak/kecamatan', $data);
            $this->load->view('cetak/templates/footer');
        }
    }

    public function desa()
    {
        $data['title'] = "REKAPITULASI HASIL SEMENTARA PENGHITUNGAN SUARA PILKADA PER DESA";
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        $data['all_paslon_count'] = count($this->paslon->getAllPaslon());
        $data['paslon_count'] = count($this->paslon->getPaslon(null));
        $data['tidak_sah_count'] = count($this->paslon->getTidakSah());
        $data['paslon'] = $this->paslon->getPaslon(null);

        //HASIL SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $kecamatan['desa'] = $this->desa->getDesa(2, $kecamatan['id']);
            $a = $kecamatan;
            $i = 0;
            foreach ($kecamatan['desa'] as $desa) {
                foreach ($this->paslon->getPaslon(null) as $paslon) {

                    $a['desa'][$i]['hasil'][] = $this->hasil->getSuara(2, $desa['id'], $paslon['id']);
                }
                $i++;
            }
            $data['hasil_sah'][] = $a;
        }

        //JUMLAH HASIL SAH
        foreach ($data['hasil_sah'] as $h) {
            for ($i = 0; $i < $data['paslon_count']; $i++) {
                $total = 0;
                for ($j = 0; $j < count($this->desa->getDesa(2, $h['id'])); $j++) {
                    $total = $total + $h['desa'][$j]['hasil'][$i]['jml_suara'];
                }
                $h['total'][] = $total;
            }
            $data['jumlah']['paslon'][] = $h['total'];
        }


        foreach ($data['hasil_sah'] as $h) {
            for ($i = 0; $i < count($this->desa->getDesa(2, $h['id'])); $i++) {
                $a = 0;
                for ($j = 0; $j < $data['paslon_count']; $j++) {
                    $a = $a + $h['desa'][$i]['hasil'][$j]['jml_suara'];
                }
                $h['total'][] = $a;
            }
            $data['total_sah'][] = $h['total'];
        }


        foreach ($data['total_sah'] as $ts) {
            $data['jumlah']['sah'][] = array_sum($ts);
        }


        //HASIL TIDAK SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $kecamatan['desa'] = $this->desa->getDesa(2, $kecamatan['id']);
            $a = $kecamatan;
            $i = 0;
            foreach ($kecamatan['desa'] as $desa) {
                foreach ($this->paslon->getTidakSah() as $paslon) {

                    $a['desa'][$i]['hasil'][] = $this->hasil->getSuara(2, $desa['id'], $paslon['id']);
                }
                $i++;
            }
            $data['hasil_tidak_sah'][] = $a;
        }

        foreach ($data['hasil_tidak_sah'] as $h) {
            for ($i = 0; $i < count($this->desa->getDesa(2, $h['id'])); $i++) {
                $a = 0;
                for ($j = 0; $j < $data['tidak_sah_count']; $j++) {
                    $a = $a + $h['desa'][$i]['hasil'][$j]['jml_suara'];
                }
                $h['total'][] = $a;
            }
            $data['total_tidak_sah'][] = $h['total'];
        }

        foreach ($data['total_tidak_sah'] as $ts) {
            $data['jumlah']['tidak_sah'][] = array_sum($ts);
        }


        //SEMUA HASIL TERMASUK TIDAK SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $kecamatan['desa'] = $this->desa->getDesa(2, $kecamatan['id']);
            $a = $kecamatan;
            $i = 0;
            foreach ($kecamatan['desa'] as $desa) {
                foreach ($this->paslon->getAllPaslon() as $paslon) {

                    $a['desa'][$i]['hasil'][] = $this->hasil->getSuara(2, $desa['id'], $paslon['id']);
                }
                $i++;
            }
            $data['hasil'][] = $a;
        }

        foreach ($data['hasil'] as $h) {
            for ($i = 0; $i < count($this->desa->getDesa(2, $h['id'])); $i++) {
                $a = 0;
                for ($j = 0; $j < $data['all_paslon_count']; $j++) {
                    $a = $a + $h['desa'][$i]['hasil'][$j]['jml_suara'];
                }
                $h['total'][] = $a;
            }
            $data['total'][] = $h['total'];
        }

        foreach ($data['hasil'] as $h) {
            foreach ($this->desa->getDesa(2, $h['id']) as $desa) {
                $dpt = $this->tps->getDpt(2, $desa['id'])['dpt'];
                $tps_kosong = $this->tps->getTpsKosong(2, $desa['id']);
                $tps_input = count($this->tps->getTps(2, $desa['id'])) - $this->tps->getTpsKosong(2, $desa['id']);
                $h['dpt'][] = $dpt;
                $h['tps_kosong'][] = $tps_kosong;
                $h['tps_input'][] = $tps_input;
            }
            $data['dpt'][] = $h['dpt'];
            $data['tps_kosong'][] = $h['tps_kosong'];
            $data['tps_input'][] = $h['tps_input'];
        }
        foreach ($data['dpt'] as $dpt) {
            $data['jumlah']['dpt'][] = array_sum($dpt);
        }
        foreach ($data['tps_kosong'] as $tps_kosong) {
            $data['jumlah']['tps_kosong'][] = array_sum($tps_kosong);
        }
        foreach ($data['tps_input'] as $tps_input) {
            $data['jumlah']['tps_input'][] = array_sum($tps_input);
        }

        foreach ($data['total'] as $t) {
            $data['jumlah']['hadir'][] = array_sum($t);
        }

        $type = $this->input->get('type');

        $option = array(
            'orientation' => 'L',
            'name' => 'Rekapitulasi Desa',
            'type' => $type
        );

        if ($type == 'D') {
            $this->pdf->print('cetak/desa', $data, $option);
        } else {
            $this->load->view('cetak/desa', $data);
            $this->load->view('cetak/templates/footer');
        }
    }

    public function tps()
    {
        $data['title'] = "REKAPITULASI HASIL SEMENTARA PENGHITUNGAN SUARA PILKADA PER TPS";
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        $data['all_paslon_count'] = count($this->paslon->getAllPaslon());
        $data['paslon_count'] = count($this->paslon->getPaslon(null));
        $data['tidak_sah_count'] = count($this->paslon->getTidakSah());
        $data['paslon'] = $this->paslon->getPaslon(null);

        //SEMUA HASIL TERMASUK TIDAK SAH
        foreach ($this->kecamatan->getKecamatan(null) as $kecamatan) {
            $kecamatan['desa'] = $this->desa->getDesa(2, $kecamatan['id']);
            $a = $kecamatan;
            $i = 0;
            foreach ($kecamatan['desa'] as $desa) {
                $desa['tps'] = $this->tps->getTps(2, $desa['id']);
                $j = 0;
                foreach ($desa['tps'] as $tps) {
                    foreach ($this->paslon->getPaslon(null) as $paslon) {
                        $tps['sah'][] = $this->hasil->getSuara(3, $tps['id'], $paslon['id']);
                    }
                    foreach ($this->paslon->getTidakSah() as $paslon) {
                        $tps['tidak_sah'] = $this->hasil->getSuara(3, $tps['id'], $paslon['id']);
                    }
                    $j++;
                    $a['desa'][$i]['tps'][] = $tps;
                }
                $i++;
            }
            $data['hasil'][] = $a;
        }

        foreach ($data['hasil'] as $hasil) {
            for ($j = 0; $j < count($this->desa->getDesa(2, $hasil['id'])); $j++) {
                for ($i = 0; $i < $data['paslon_count']; $i++) {
                    $total = 0;
                    for ($k = 0; $k < count($this->tps->getTps(2, $hasil['desa'][$j]['id'])); $k++) {
                        $total = $total + $hasil['desa'][$j]['tps'][$k]['sah'][$i]['jml_suara'];
                    }
                    $sah[$j][$i] = $total;
                }
            }
            $data['jumlah']['paslon'][] = $sah;
        }

        foreach ($data['hasil'] as $hasil) {
            for ($i = 0; $i < count($this->desa->getDesa(2, $hasil['id'])); $i++) {
                $dpt = 0;
                for ($j = 0; $j < count($this->tps->getTps(2, $hasil['desa'][$i]['id'])); $j++) {
                    //SAH
                    $sah = 0;
                    for ($k = 0; $k < $data['paslon_count']; $k++) {
                        $sah = $sah + $hasil['desa'][$i]['tps'][$j]['sah'][$k]['jml_suara'];
                    }
                    $hasil['total'][$i]['sah'][$j] = $sah;

                    //TIDAK SAH
                    $tidak_sah = 0;
                    $tidak_sah = $tidak_sah + $hasil['desa'][$i]['tps'][$j]['tidak_sah']['jml_suara'];
                    $hasil['total'][$i]['tidak_sah'][$j] = $tidak_sah;

                    //JUMLAH
                    $hasil['total'][$i]['jumlah'][] = $hasil['total'][$i]['tidak_sah'][$j] + $hasil['total'][$i]['sah'][$j];

                    //DPT
                    $dpt = $dpt + $hasil['desa'][$i]['tps'][$j]['dpt'];
                }
                $hasil['dpt'][] = $dpt;
            }
            $data['total'][] = $hasil['total'];
            $data['jumlah']['dpt'][] = $hasil['dpt'];
        }


        foreach ($data['total'] as $total) {
            for ($i = 0; $i < count($total); $i++) {
                $jumlah[$i]['sah'] = array_sum($total[$i]['sah']);
                $jumlah[$i]['tidak_sah'] = array_sum($total[$i]['tidak_sah']);
                $jumlah[$i]['jumlah'] = array_sum($total[$i]['jumlah']);
            }
            $data['jumlah'][] = $jumlah;
        }

        $type = $this->input->get('type');

        $option = array(
            'orientation' => 'L',
            'name' => 'Rekapitulasi TPS',
            'type' => $type
        );

        if ($type == 'D') {
            $this->pdf->print('cetak/tps', $data, $option);
        } else {
            $this->load->view('cetak/tps', $data);
            $this->load->view('cetak/templates/footer');
        }
    }

    public function api($desa_id)
    {
        $data['title'] = "Desa " . $this->desa->getDesa(1, $desa_id)['desa'];
        $data['desa_id'] = $desa_id;
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        $data['all_paslon_count'] = count($this->paslon->getAllPaslon());
        $data['paslon_count'] = count($this->paslon->getPaslon(null));
        $data['tidak_sah_count'] = count($this->paslon->getTidakSah());
        $data['paslon'] = $this->paslon->getPaslon(null);
        $data['all_paslon'] = $this->paslon->getAllPaslon();

        //HASIL SAH
        foreach ($this->tps->getTps(2, $desa_id) as $tps) {
            foreach ($this->paslon->getPaslon(null) as $paslon) {
                $tps['hasil'][] = $this->hasil->getSuara(3, $tps['id'], $paslon['id']);
            }
            $data['hasil_sah'][] = $tps;
        }

        //JUMLAH HASIL SAH
        for ($j = 0; $j < $data['paslon_count']; $j++) {
            $jumlah = 0;
            foreach ($data['hasil_sah'] as $h) {
                $jumlah = $jumlah + $h['hasil'][$j]['jml_suara'];
                // $h['hasil'][$j]['jml_suara'] / $total_sah[$i] * 100;
            }
            $data['jumlah']['paslon'][] = $jumlah;
        }

        foreach ($data['hasil_sah'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total_sah'][] = $total;
        }

        //JUMLAH TOTAL HASIL SAH
        $data['jumlah']['sah'] = array_sum($data['total_sah']);

        foreach ($this->tps->getTps(2, $desa_id) as $tps) {
            $tps['hasil'][] = $this->hasil->getSuaraTidakSah(3, $tps['id']);
            $data['hasil_tidak_sah'][] = $tps;
        }

        //JUMLAH HASIL TIDAK SAH
        for ($j = 0; $j < $data['tidak_sah_count']; $j++) {
            $jumlah = 0;
            foreach ($data['hasil_tidak_sah'] as $hts) {
                $jumlah = $jumlah + $hts['hasil'][$j]['jml_suara'];
            }
            $data['jumlah']['tidak_sah'] = $jumlah;
        }

        //SEMUA HASIL TERMASUK TIDAK SAH
        foreach ($this->tps->getTps(2, $desa_id) as $tps) {
            foreach ($this->paslon->getAllPaslon() as $paslon) {
                $tps['hasil'][] = $this->hasil->getSuara(3, $tps['id'], $paslon['id']);
            }
            $data['hasil'][] = $tps;
        }

        foreach ($data['hasil'] as $h) {
            $total = 0;
            for ($i = 0; $i < $data['all_paslon_count']; $i++) {
                $total = $total + $h['hasil'][$i]['jml_suara'];
            }
            $data['total'][] = $total;
        }

        $this->load->view('cetak/api', $data);
    }

    public function belumInput()
    {
        $data['title'] = 'Data TPS Belum Input';
        foreach ($this->pengaturan->getPengaturan() as $pengaturan) {
            $data[$pengaturan['name']] = $pengaturan['value'];
        }

        if ($this->kecamatan->getBelumInput()) {
            foreach ($this->kecamatan->getBelumInput() as $kecamatan) {
                foreach ($this->desa->getBelumInput($kecamatan['id']) as $desa) {
                    foreach ($this->tps->getBelumInput($desa['id']) as $tps) {
                        $desa['tps'][] = $tps;
                    }
                    $kecamatan['desa'][] = $desa;
                }
                $data['kecamatan'][] = $kecamatan;
            }
        } else {
            $data['kecamatan'] = NULL;
        }

        $option = array(
            'orientation' => 'P',
            'name' => 'TPS Belum Input',
            'type' => $type
        );

        $this->pdf->print('cetak/belum-input', $data, $option);
    }
}
