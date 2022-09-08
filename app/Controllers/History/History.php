<?php

namespace App\Controllers\History;

use App\Controllers\BaseController;
use App\Models\HistoryPenilaian;

class History extends BaseController
{
    public function index()
    {
        $model = new HistoryPenilaian();
        $fnip           = session()->get('fnip');
        $fkode_cab      = session()->get('fkode_cab');
        $jabatan        = trim(session()->get('jabatan'));

        $data['title'] = 'Riwayat Penilaian Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'Riwayat Penilaian';
        $data['history'] = $model->getAllUserData($fnip);

        echo view('penilaian/history/data_table', $data);
    }


    public function backuppp_indexxxx()
    {
        $model = new HistoryPenilaian();

        $fnip           = session()->get('fnip');
        $fkode_cab      = session()->get('fkode_cab');
        $fgrade         = session()->get('fgrade');
        $jabatan        = trim(session()->get('jabatan'));

        $data['title'] = 'Riwayat Penilaian Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'Riwayat Penilaian';

        // lokasi kantor pusat
        if ($fkode_cab == '99') {
            if ($fgrade == "1" or $fgrade == "2" or $fgrade == "3") {
                $data['gol'] = '123';
                session()->set('gol', '123');
                $data['history'] = $model->kp_gol_123($fnip);
            } else if ($fgrade == "4" and $jabatan == "ASSOCIATE OFFICER") {
                $data['gol'] = '4f';
                session()->set('gol', '4f');
                $data['history'] = $model->kp_gol_4f($fnip);
            } else if ($fgrade == "4" and $jabatan == "KEPALA BAGIAN") {
                $data['gol'] = '4s';
                session()->set('gol', '4s');
                $data['history'] = $model->kp_gol_4s($fnip);
            } else if ($fgrade == "5" and $jabatan == "OFFICER") {
                $data['gol'] = '5f';
                session()->set('gol', '5f');
                $data['history'] = $model->kp_gol_5f($fnip);
            } else if ($fgrade == "5" and $jabatan == "KEPALA BIDANG") {
                $data['gol'] = '5s';
                session()->set('gol', '5s');
                $data['history'] = $model->kp_gol_5s($fnip);
            } else if ($fgrade == "5" and $jabatan == "KEPALA BAGIAN") {
                $data['gol'] = '5s';
                session()->set('gol', '5s');
                $data['history'] = $model->kp_gol_5s($fnip);
            } else if ($fgrade == "6") {
                $data['gol'] = '67';
                session()->set('gol', '67');
                $data['history'] = $model->kp_gol_67($fnip);
            } else if ($fgrade == "7") {
                $data['gol'] = '67';
                session()->set('gol', '67');
                $data['history'] = $model->kp_gol_67($fnip);
            }

            // ini untuk direksi
            else if ($fgrade == "99") {
                $data['gol'] = '99';
                session()->set('gol', '99');
                return ("<h1>UPS INI DIREKSI</h1>");
                $data['history'] = $model->kp_gol_67($fnip);
            } else {
                session()->destroy();
                return redirect()->to(base_url('login'));
            }
        } else if ($fkode_cab != '99') {

            $jabatan_kecakapan_kerja = array(
                "BACK OFFICE SENIOR OPERASIONAL",
                "BACK OFFICE SENIOR ADMINISTRASI KANTOR",
                "CUSTOMER SERVICE SENIOR",
                "BACK OFFICE ADMINISTRASI KANTOR (FUNGSI POOLING)",
                "BACK OFFICE SENIOR ADMINISTRASI KANTOR ",
                "TELLER",
                "BACK OFFICE SENIOR ADMINISTRASI KANTOR (FUNGSI POOLING)",
                "STAF OPERASIONAL",
                "CUSTOMER SERVICE",
                "BACK OFFICE OPERASIONAL",
                "BACK OFFICE ADMINISTRASI KANTOR",
                "BACK OFFICE ADMINISTRASI KANTOR (FUNGSI SALES ADMIN)",
                "BACK OFFICE OPERASIONAL ",
                "BACK OFFICE OPERASIONAL",
                "BACK OFFICE OPERASIONAL (FUNGSI POOLING)",
                "STAF OPERASIONAL SENIOR"
            );
            if (in_array($jabatan, $jabatan_kecakapan_kerja)) {
                $data['gol'] = '123';
                session()->set('gol', '123');
                $data['history'] = $model->cab_gol_123($fnip);
            }

            $jabatan_kabag = array(
                "KEPALA BAGIAN TELLER DAN BACKOFFICE",
                "KEPALA BAGIAN OPERASIONAL",
                "KEPALA BAGIAN CUSTOMER SERVICE",
            );
            if (in_array($jabatan, $jabatan_kabag)) {
                $data['gol'] = '4S';
                session()->set('gol', '4S');
                $data['history'] = $model->cab_gol_4s($fnip);
            }

            $jabatan_ao = array(
                "ASSOCIATE ACCOUNT OFFICER",
                "ACCOUNT OFFICER",
                "ASSISTANT ACCOUNT OFFICER",
            );
            if (in_array($jabatan, $jabatan_ao)) {
                $data['gol'] = 'AO';
                session()->set('gol', 'AO');
                $data['history'] = $model->cab_ao_reguler($fnip);
            }

            if ($jabatan == "KEPALA CABANG") {
                $data['gol'] = 'KC';
                session()->set('gol', 'KC');
                $data['history'] = $model->cab_kcu($fnip);
            }

            if ($jabatan == "KEPALA CABANG PEMBANTU") {
                $data['gol'] = 'KCP';
                session()->set('gol', 'KCP');
                $data['history'] = $model->cab_kcp($fnip);
            }

            if ($jabatan == "KEPALA OPERASI CABANG") {
                $data['gol'] = 'KOC';
                session()->set('gol', 'KOC');
                $data['history'] = $model->cab_koc($fnip);
            }

            if ($jabatan == "KEPALA ULS") {
                $data['gol'] = 'ULS';
                session()->set('gol', 'ULS');
                $data['history'] = $model->cab_uls($fnip);
            }
        } else {
            echo 'Error [KODE_CABANG] Harap hubungi Administrator!';
        }

        echo view('penilaian/history/data_table', $data);
    }
}
