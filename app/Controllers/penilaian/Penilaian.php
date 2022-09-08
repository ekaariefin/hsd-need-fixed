<?php

namespace App\Controllers\Penilaian;

use App\Controllers\BaseController;
use App\Models\BobotPenilaian;
use App\Models\ConfigModel;
use App\Models\HistoryPenilaian;
use App\Models\Karyawan\AtasanModel;
use App\Models\PekerjaModel;
use App\Models\Penilaian123;
use App\Models\Penilaian4f;
use App\Models\Penilaian4s;
use App\Models\Penilaian5f;
use App\Models\Penilaian5s;
use App\Models\Penilaian67;
use App\Models\PenilaianCab123;
use App\Models\PenilaianCab4s;
use App\Models\PenilaianCabAOReg;
use App\Models\PenilaianKepalaKC;
use App\Models\PenilaianKepalaKCP;
use App\Models\PenilaianKepalaKOC;
use App\Models\PenilaianKepalaULS;
use App\Models\SarbisModel;
use App\Models\SuratPeringatan\SPModel;

class Penilaian extends BaseController
{
    //MARK: FUNGSI UNTUK MENGARAHKAN KE FORMULIR PA
    public function form_pa()
    {
        $fkode_cab      = session()->get('fkode_cab');
        $fgrade         = session()->get('fgrade');
        $jabatan        = trim(session()->get('jabatan'));

        $current_year   = date('Y');
        $previous_year  = $current_year - 1;
        $cekModel = new HistoryPenilaian();
        if ($cekModel->cek_pa_tahunan_is_avaiable(session()->get('fnip'), $previous_year) != NULL) {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Maaf!');
            session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
            return redirect()->to(base_url('penilaian/riwayat'));
        }

        //MARK: KONFIGURASI FORMULIR UNTUK KANTOR PUSAT
        if ($fkode_cab == "99") {

            //MARK: CEK APAKAH SUDAH MENGISI FORMULIR PA TAHUN BERJALAN
            $data['title']      = 'Formulir Penilaian Kinerja Kantor Pusat | PT Bank BCA Syariah';
            $data['active']     = 'Penilaian PA';
            $id_periode = '2';
            $model = new ConfigModel();
            $data['date'] = $model->find($id_periode);

            if ($fgrade == "1" or $fgrade == "2" or $fgrade == "3") {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_kp_123(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('123');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form/kp_gol_123', $data);
            } else if ($fgrade == "4" and $jabatan == "ASSOCIATE OFFICER" or $jabatan == "ASSOCIATE OFFICER ") {

                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_kp_4f(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('4F');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form/kp_gol_4f', $data);
            } else if ($fgrade == "4" and $jabatan == "KEPALA BAGIAN") {

                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_kp_4s(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('4S');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                // dd($data);
                echo view('penilaian/pusat/form/kp_gol_4s', $data);
            } else if ($fgrade == "5" and $jabatan == "OFFICER") {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_kp_5f(session()->get('fnip'), $previous_year)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();

                    if (($data['getSarbis']['approval1'] == NULL)   or  ($data['getSarbis']['approval2'] == NULL)) {
                        session()->setFlashdata('swal_icon', 'error');
                        session()->setFlashdata('swal_title', 'Maaf!');
                        session()->setFlashdata('error_log', 'Sasaran Bisnis anda belum diotorisasi atasan anda!');
                        session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan Sasaran Bisnis anda belum diotorisasi oleh atasan anda.');
                        return redirect()->to(base_url('sarbis/riwayat'));
                    }
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('5F');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form/kp_gol_5f', $data);
            } else if ($fgrade == "5" and ($jabatan == "KEPALA BIDANG" or $jabatan == "KEPALA BAGIAN")) {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_kp_5s(session()->get('fnip'), $previous_year)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                if (($data['getSarbis']['approval1'] == NULL)   or  ($data['getSarbis']['approval2'] == NULL)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Sasaran Bisnis anda belum diotorisasi atasan anda!');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan Sasaran Bisnis anda belum diotorisasi oleh atasan anda.');
                    return redirect()->to(base_url('sarbis/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('5S');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form/kp_gol_5s', $data);
            } else if ($fgrade == "6" or $fgrade == "7") {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_kp_67(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                if (($data['getSarbis']['approval1'] == NULL)   or  ($data['getSarbis']['approval2'] == NULL)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Sasaran Bisnis anda belum diotorisasi atasan anda!');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan Sasaran Bisnis anda belum diotorisasi oleh atasan anda.');
                    return redirect()->to(base_url('sarbis/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('67');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form/kp_gol_67', $data);
            } else {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Maaf!');
                session()->setFlashdata('swal_text', 'Anda tidak memiliki akses!');
                return redirect()->to(base_url());
            }
        }
        //MARK: KONFIGURASI FORMULIR UNTUK KANTOR CABANG
        else if ($fkode_cab != "99") {
            $data['title'] = 'Formulir Penilaian Kinerja Kantor Cabang | PT Bank BCA Syariah';
            $data['active'] = 'Penilaian PA';
            $id_periode = '2';
            $model = new ConfigModel();
            $data['date'] = $model->find($id_periode);
            if ($jabatan == "KEPALA CABANG") {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_cab_kc(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                if (($data['getSarbis']['approval1'] == NULL)   or  ($data['getSarbis']['approval2'] == NULL)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Sasaran Bisnis anda belum diotorisasi atasan anda!');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan Sasaran Bisnis anda belum diotorisasi oleh atasan anda.');
                    return redirect()->to(base_url('sarbis/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA CABANG');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_ka_kcu', $data);
            } else if ($jabatan == "KEPALA CABANG PEMBANTU") {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_cab_kcp(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                if (($data['getSarbis']['approval1'] == NULL)   or  ($data['getSarbis']['approval2'] == NULL)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Sasaran Bisnis anda belum diotorisasi atasan anda!');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan Sasaran Bisnis anda belum diotorisasi oleh atasan anda.');
                    return redirect()->to(base_url('sarbis/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA CABANG PEMBANTU');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_ka_kcp', $data);
            } else if ($jabatan == "KEPALA ULS") {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_cab_uls(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                if (($data['getSarbis']['approval1'] == NULL)   or  ($data['getSarbis']['approval2'] == NULL)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Sasaran Bisnis anda belum diotorisasi atasan anda!');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan Sasaran Bisnis anda belum diotorisasi oleh atasan anda.');
                    return redirect()->to(base_url('sarbis/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA ULS');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_ka_uls', $data);
            } else if ($jabatan == "KEPALA OPERASI CABANG") {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_cab_koc(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                if (($data['getSarbis']['approval1'] == NULL)   or  ($data['getSarbis']['approval2'] == NULL)) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Sasaran Bisnis anda belum diotorisasi atasan anda!');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan Sasaran Bisnis anda belum diotorisasi oleh atasan anda.');
                    return redirect()->to(base_url('sarbis/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA OPERASI CABANG');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_koc', $data);
            }

            //---------------------------------------//
            $jabatan_kabag = array(
                "KEPALA BAGIAN TELLER DAN BACKOFFICE",
                "KEPALA BAGIAN OPERASIONAL",
                "KEPALA BAGIAN CUSTOMER SERVICE",
            );
            if (in_array($jabatan, $jabatan_kabag)) {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_cab_4s(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('4S');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_gol_4s', $data);
            }

            $jabatan_ao = array(
                "ASSOCIATE ACCOUNT OFFICER",
                "ACCOUNT OFFICER",
                "ASSISTANT ACCOUNT OFFICER",
            );
            if (in_array($jabatan, $jabatan_ao)) {
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();
                if ($cekModel->cek_cab_ao(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('ACCOUNT OFFICER');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_ao_reguler', $data);
            }

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
                //MARK: Cek Apakah Sudah Mengisi PA Tahun Berjalan
                $cekModel = new HistoryPenilaian();

                //hanya untuk testing

                if ($cekModel->cek_cab_123(session()->get('fnip'), $previous_year) != 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('swal_text', 'Anda sudah mengisi Formulir PA Periode Ini');
                    return redirect()->to(base_url('penilaian/riwayat'));
                }

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('123');

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_gol_123', $data);
            }
        } else {
            echo "Undefinied Grade";
        }
    }

    //
    //
    //
    //

    public function form_pa_edit($tahun_pa, $id_pn, $fnip)
    {
        $tahun_pa       = $tahun_pa;
        $id_pn          = $id_pn;

        //get user data
        $pekerjaModel           = new PekerjaModel();
        $dataPekerja            = $pekerjaModel->where('fnip', $fnip)->get()->getRowArray();
        $data['dataPekerja']    = $dataPekerja;

        $atasanModel    = new AtasanModel();
        $data['atasan1_fnip']        = $atasanModel->select('atasan_nip')->where('user_nip', $fnip)->get()->getRowArray();
        $data['atasan1_nama']        = $pekerjaModel->select('fnama')->where('fnip', $data['atasan1_fnip'])->get()->getRowArray();
        $data['atasan2_fnip']        = $atasanModel->select('atasan_nip')->where('user_nip', $data['atasan1_fnip'])->get()->getRowArray();
        $data['atasan2_nama']        = $pekerjaModel->select('fnama')->where('fnip', $data['atasan2_fnip'])->get()->getRowArray();


        $fkode_cab      = $dataPekerja['fkode_cab'];
        $fgrade         = $dataPekerja['fgrade'];
        $jabatan        = trim($dataPekerja['jabatan']);
        $current_year   = date('Y');

        //MARK: KONFIGURASI FORMULIR UNTUK KANTOR PUSAT
        if ($fkode_cab == "99") {

            //MARK: CEK APAKAH SUDAH MENGISI FORMULIR PA TAHUN BERJALAN
            $data['title']      = 'Formulir Revisi Penilaian Kinerja Kantor Pusat | PT Bank BCA Syariah';
            $data['active']     = 'Penilaian PA';
            $id_periode = '2';
            $model = new ConfigModel();
            $data['date'] = $model->find($id_periode);

            if ($fgrade == "1" or $fgrade == "2" or $fgrade == "3") {

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('123');
                $penilaianModel = new Penilaian123();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }

                echo view('penilaian/pusat/form-revisi/kp_gol_123', $data);
            } else if ($fgrade == "4" and $jabatan == "ASSOCIATE OFFICER" or $jabatan == "ASSOCIATE OFFICER ") {

                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('4F');
                $penilaianModel = new Penilaian4f();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();

                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form-revisi/kp_gol_4f', $data);
            } else if ($fgrade == "4" and $jabatan == "KEPALA BAGIAN") {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('4S');
                $penilaianModel = new Penilaian4s();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }

                echo view('penilaian/pusat/form-revisi/kp_gol_4s', $data);
            } else if ($fgrade == "5" and $jabatan == "OFFICER") {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                //MARK: Ambil Data Sasaran Bisnis
                $data['getSarbis'] = $cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray();

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('5F');
                $penilaianModel = new Penilaian5f();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form-revisi/kp_gol_5f', $data);
            } else if ($fgrade == "5" and ($jabatan == "KEPALA BIDANG" or $jabatan == "KEPALA BAGIAN")) {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                //MARK: Ambil Data Sasaran Bisnis
                $data['getSarbis'] = $cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray();


                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('5S');
                $penilaianModel = new Penilaian5s();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form-revisi/kp_gol_5s', $data);
            } else if ($fgrade == "6" or $fgrade == "7") {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                //MARK: Ambil Data Sasaran Bisnis
                $data['getSarbis'] = $cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray();


                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('67');
                $penilaianModel = new Penilaian67();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/pusat/form-revisi/kp_gol_67', $data);
            } else {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Maaf!');
                session()->setFlashdata('swal_text', 'Anda tidak memiliki akses!');
                return redirect()->to(base_url());
            }
        }
        //MARK: KONFIGURASI FORMULIR UNTUK KANTOR CABANG
        else if ($fkode_cab != "99") {
            $data['title'] = 'Formulir Penilaian Kinerja Kantor Cabang | PT Bank BCA Syariah';
            $data['active'] = 'Penilaian PA';
            $id_periode = '2';
            $model = new ConfigModel();
            $data['date'] = $model->find($id_periode);
            if ($jabatan == "KEPALA CABANG") {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                //MARK: Ambil Data Sasaran Bisnis
                $data['getSarbis'] = $cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray();


                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA CABANG');
                $penilaianModel = new PenilaianKepalaKC();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form-revisi/cab_ka_kcu', $data);
            } else if ($jabatan == "KEPALA CABANG PEMBANTU") {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                //MARK: Ambil Data Sasaran Bisnis
                $data['getSarbis'] = $cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray();


                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA CABANG PEMBANTU');
                $penilaianModel = new PenilaianKepalaKCP();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form-revisi/cab_ka_kcp', $data);
            } else if ($jabatan == "KEPALA ULS") {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                if ($cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray() == 0) {
                    session()->setFlashdata('swal_icon', 'error');
                    session()->setFlashdata('swal_title', 'Maaf!');
                    session()->setFlashdata('error_log', 'Missing Previous Year');
                    session()->setFlashdata('swal_text', 'Anda tidak dapat mengisi Formulir PA dikerenakan belum mengisi Sasaran Bisnis Tahun PA');
                    return redirect()->to(base_url('sarbis/entri'));
                } else {
                    //MARK: Ambil Data Sasaran Bisnis
                    $data['getSarbis'] = $cekSarbis->where([
                        'user_nip' => session()->get('fnip'),
                        'tahun_sarbis' => $sarbis_date
                    ])->get()->getRowArray();
                }

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA ULS');
                $penilaianModel = new PenilaianKepalaULS();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form/cab_ka_uls', $data);
            } else if ($jabatan == "KEPALA OPERASI CABANG") {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);


                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                //MARK: Ambil Data Sasaran Bisnis
                $data['getSarbis'] = $cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray();

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('KEPALA OPERASI CABANG');
                $penilaianModel = new PenilaianKepalaKOC();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form-revisi/cab_koc', $data);
            }

            //---------------------------------------//
            $jabatan_kabag = array(
                "KEPALA BAGIAN TELLER DAN BACKOFFICE",
                "KEPALA BAGIAN OPERASIONAL",
                "KEPALA BAGIAN CUSTOMER SERVICE",
            );
            if (in_array($jabatan, $jabatan_kabag)) {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('4S');
                $penilaianModel = new PenilaianCab4s();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form-revisi/cab_gol_4s', $data);
            }

            $jabatan_ao = array(
                "ASSOCIATE ACCOUNT OFFICER",
                "ACCOUNT OFFICER",
                "ASSISTANT ACCOUNT OFFICER",
            );
            if (in_array($jabatan, $jabatan_ao)) {
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);


                //MARK: Cek Apakah Sudah Mengisi Sasaran Bisnis
                $cekSarbis = new SarbisModel();
                $current_date = date('Y');
                $sarbis_date = (int)$current_date - 1;
                //MARK: Ambil Data Sasaran Bisnis
                $data['getSarbis'] = $cekSarbis->where([
                    'user_nip' => session()->get('fnip'),
                    'tahun_sarbis' => $sarbis_date
                ])->get()->getRowArray();
                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('ACCOUNT OFFICER');
                $penilaianModel = new PenilaianCabAOReg();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form-revisi/cab_ao_reguler', $data);
            }

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
                //MARK: Define SPModel
                $sp = new SPModel();
                $tahun_pa = strval(date("Y") - 1);
                $data['sp'] = $sp->getDataUserSpecificYear(session()->get('fnip'), $tahun_pa);

                //MARK: Define Bobot Penilaian Model
                $model = new BobotPenilaian();
                $getBobot = $model->get_bobot('123');
                $penilaianModel = new PenilaianCab123();
                $data['getData'] = $penilaianModel->where('tahun_pa', $tahun_pa)->where('id_pn', $id_pn)->get()->getRowArray();


                //MARK: Load Data
                foreach ($getBobot as $bobot) {
                    $str = strtolower(trim($bobot['nama_bobot']));
                    $str = preg_replace('/[^a-z0-9-]/', '_', $str);
                    $str = preg_replace('/-+/', "_", $str);
                    $data['bobot_' . $str] = $bobot['nilai_bobot'];
                }
                echo view('penilaian/cabang/form-revisi/cab_gol_123', $data);
            }
        } else {
            echo "Undefinied Grade";
        }
    }
}
