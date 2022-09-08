<?php

namespace App\Controllers\Penilaian\Otorisasi;

use App\Controllers\BaseController;
use App\Models\ConfigModel;
use App\Models\Karyawan\AtasanModel;
use App\Models\Otorisasi\OtorisasiModel;
use App\Models\PekerjaModel;
use App\Models\SuratPeringatan\SPModel;

class Otorisasi extends BaseController
{

    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->receiver_mail = session()->get('email');
        $this->receiver_name = session()->get('fnama');
    }

    public function show()
    {
        $data['title'] = 'Otorisasi Penilaian PA | PT Bank BCA Syariah';
        $data['active'] = 'Otorisasi PA';
        $otorisasiModel = new OtorisasiModel();
        $data['getList'] = $otorisasiModel->getDataOto();
        return view('penilaian/otorisasi/data_table', $data);
    }

    public function detail_penilaian($gol, $id_pn)
    {
        $data['title'] = 'Otorisasi Penilaian PA | PT Bank BCA Syariah';
        $data['active'] = 'Otorisasi PA';
        $otorisasiModel = new OtorisasiModel();
        $spModel = new SPModel();

        //MARK: PEMISAHAN DATA BERDASARKAN GOLONGAN
        if ($gol == '123') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_kp_gol_123", "pn_kp_gol_123.id_user = pekerja.fnip");
        } else if ($gol == '4F') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_kp_gol_4f", "pn_kp_gol_4f.id_user = pekerja.fnip");
        } else if ($gol == '4S') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_kp_gol_4s", "pn_kp_gol_4s.id_user = pekerja.fnip");
        } else if ($gol == '5F') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_kp_gol_5f", "pn_kp_gol_5f.id_user = pekerja.fnip");
        } else if ($gol == '5S') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_kp_gol_5s", "pn_kp_gol_5s.id_user = pekerja.fnip");
        } else if ($gol == '67') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_kp_gol_67", "pn_kp_gol_67.id_user = pekerja.fnip");
        } else if ($gol == 'cab_123') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_cab_gol_123", "pn_cab_gol_123.id_user = pekerja.fnip");
        } else if ($gol == 'cab_4s') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_cab_gol_4s", "pn_cab_gol_4s.id_user = pekerja.fnip");
        } else if ($gol == 'cab_ao') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_cab_ao_reg", "pn_cab_ao_reg.id_user = pekerja.fnip");
        } else if ($gol == 'cab_uls') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_cab_uls", "pn_cab_uls.id_user = pekerja.fnip");
        } else if ($gol == 'cab_kcp') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_cab_kcp", "pn_cab_kcp.id_user = pekerja.fnip");
        } else if ($gol == 'cab_koc') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_cab_koc", "pn_cab_koc.id_user = pekerja.fnip");
        } else if ($gol == 'cab_kcu') {
            $otorisasiModel->where("id_pn = '" . $id_pn . "'");
            $otorisasiModel->join("pn_cab_kcu", "pn_cab_kcu.id_user = pekerja.fnip");
        }

        $data['getData'] = $otorisasiModel->get()->getRowArray();
        $data['sp'] = $spModel->getDataUserSpecificYear($data['getData']['fnip'], date('Y') - 1);
        $data['userGol'] = $gol;

        //MARK: AMBIL ATASAN PEKERJA
        $atasanModel = new AtasanModel();
        $atasan = $atasanModel->getAtasan($data['getData']['fnip']);
        $data['atasan1'] = $atasan['atasan1']['fnama'];
        $data['atasan2'] = $atasan['atasan2']['fnama'];

        //MARK: CEK APAKAH SUDAH DISETUJUI
        if ($data['getData']['approval_satu'] === session()->get('fnip') or $data['getData']['approval_dua'] === session()->get('fnip')) {
            $data['markStatus'] = 'Approved';
        } else {
            $data['markStatus'] = '';
        }

        $id_periode = '2';
        $model = new ConfigModel();
        $data['date'] = $model->find($id_periode);

        return view('penilaian/otorisasi/data_detail', $data);
    }


    public function proses_otorisasi($gol, $id_pn)
    {
        $data['title'] = 'Otorisasi Penilaian PA | PT Bank BCA Syariah';
        $data['active'] = 'Otorisasi PA';
        $otorisasiModel = new OtorisasiModel();
        $otorisasiModel->where("id_pn = '" . $id_pn . "'");

        //MARK: PEMISAHAN DATA BERDASARKAN GOLONGAN
        if ($gol == '123') {
            $selectedTable = '123';
            $otorisasiModel->join("pn_kp_gol_123", "pn_kp_gol_123.id_user = pekerja.fnip");
        } else if ($gol == '4F') {
            $selectedTable = '4F';
            $otorisasiModel->join("pn_kp_gol_4f", "pn_kp_gol_4f.id_user = pekerja.fnip");
        } else if ($gol == '4S') {
            $selectedTable = '4S';
            $otorisasiModel->join("pn_kp_gol_4s", "pn_kp_gol_4s.id_user = pekerja.fnip");
        } else if ($gol == '5F') {
            $selectedTable = '5F';
            $otorisasiModel->join("pn_kp_gol_5f", "pn_kp_gol_5f.id_user = pekerja.fnip");
        } else if ($gol == '5S') {
            $selectedTable = '5S';
            $otorisasiModel->join("pn_kp_gol_5s", "pn_kp_gol_5s.id_user = pekerja.fnip");
        } else if ($gol == '67') {
            $selectedTable = '67';
            $otorisasiModel->join("pn_kp_gol_67", "pn_kp_gol_67.id_user = pekerja.fnip");
        } else if ($gol == 'cab_123') {
            $selectedTable = 'cab_123';
            $otorisasiModel->join("pn_cab_gol_123", "pn_cab_gol_123.id_user = pekerja.fnip");
        } else if ($gol == 'cab_4s') {
            $selectedTable = 'cab_4s';
            $otorisasiModel->join("pn_cab_gol_4s", "pn_cab_gol_4s.id_user = pekerja.fnip");
        } else if ($gol == 'cab_ao') {
            $selectedTable = 'cab_ao';
            $otorisasiModel->join("pn_cab_ao_reg", "pn_cab_ao_reg.id_user = pekerja.fnip");
        } else if ($gol == 'cab_uls') {
            $selectedTable = 'cab_uls';
            $otorisasiModel->join("pn_cab_uls", "pn_cab_uls.id_user = pekerja.fnip");
        } else if ($gol == 'cab_kcp') {
            $selectedTable = 'cab_kcp';
            $otorisasiModel->join("pn_cab_kcp", "pn_cab_kcp.id_user = pekerja.fnip");
        } else if ($gol == 'cab_koc') {
            $selectedTable = 'cab_koc';
            $otorisasiModel->join("pn_cab_koc", "pn_cab_koc.id_user = pekerja.fnip");
        } else if ($gol == 'cab_kcu') {
            $selectedTable = 'cab_kcu';
            $otorisasiModel->join("pn_cab_kcu", "pn_cab_kcu.id_user = pekerja.fnip");
        }
        $data['getData'] = $otorisasiModel->get()->getRowArray();
        $data['userGol'] = $gol;

        //MARK: AMBIL ATASAN PEKERJA
        $atasanModel = new AtasanModel();
        $atasan = $atasanModel->getAtasan($data['getData']['fnip']);
        $data['atasan1'] = $atasan['atasan1']['fnip'];
        $data['atasan2'] = $atasan['atasan2']['fnip'];

        //JALANKAN QUERY
        if (session()->get('fnip') === $data['atasan1']) {
            $query = $otorisasiModel->update_selected($selectedTable, $data['getData']['id_pn'], 'First');
            if (!$query) {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Gagal!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Penilaian Kinerja Gagal!');
            } else {
                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Penilaian Kinerja Berhasil!');
            }
        } else if (session()->get('fnip') === $data['atasan2']) {
            $query = $otorisasiModel->update_selected($selectedTable, $data['getData']['id_pn'], 'Second');
            if (!$query) {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Gagal!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Penilaian Kinerja Gagal!');
            } else {
                if (!empty($this->receiver_mail)) {
                    //KIRIMKAN EMAIL
                    $data['receiver_mail'] = $this->receiver_mail;
                    $data['receiver_name'] = session()->get('fnama');
                    $pekerjaModel = new PekerjaModel();
                    $pekerjaModel->where('fnip', $data['getData']['id_user']);
                    $dataPekerja = $pekerjaModel->get()->getRowArray();
                    $data['target_name'] = $dataPekerja['fnama'];
                    $data['target_email'] = $dataPekerja['email'];
                    $subject = 'Konfirmasi Otorisasi Penilaian Kinerja Pekerja';
                    $message = view('mail-style\mail_pa_evaluation_approval', $data);
                    $this->sendEmail($data['target_email'], $subject, $message);
                }

                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Penilaian Kinerja Berhasil!');
            }
        }

        $data['getList'] = $otorisasiModel->getDataOto();
        return view('penilaian/otorisasi/data_table', $data);
    }

    public function proses_koreksi($gol, $id_pn)
    {
        $data['title'] = 'Otorisasi Penilaian PA | PT Bank BCA Syariah';
        $data['active'] = 'Otorisasi PA';
        $otorisasiModel = new OtorisasiModel();
        $otorisasiModel->where("id_pn = '" . $id_pn . "'");

        //MARK: PEMISAHAN DATA BERDASARKAN GOLONGAN
        if ($gol == '123') {
            $selectedTable = '123';
            $otorisasiModel->join("pn_kp_gol_123", "pn_kp_gol_123.id_user = pekerja.fnip");
        } else if ($gol == '4F') {
            $selectedTable = '4F';
            $otorisasiModel->join("pn_kp_gol_4f", "pn_kp_gol_4f.id_user = pekerja.fnip");
        } else if ($gol == '4S') {
            $selectedTable = '4S';
            $otorisasiModel->join("pn_kp_gol_4s", "pn_kp_gol_4s.id_user = pekerja.fnip");
        } else if ($gol == '5F') {
            $selectedTable = '5F';
            $otorisasiModel->join("pn_kp_gol_5f", "pn_kp_gol_5f.id_user = pekerja.fnip");
        } else if ($gol == '5S') {
            $selectedTable = '5S';
            $otorisasiModel->join("pn_kp_gol_5s", "pn_kp_gol_5s.id_user = pekerja.fnip");
        } else if ($gol == '67') {
            $selectedTable = '67';
            $otorisasiModel->join("pn_kp_gol_67", "pn_kp_gol_67.id_user = pekerja.fnip");
        } else if ($gol == 'cab_123') {
            $selectedTable = 'cab_123';
            $otorisasiModel->join("pn_cab_gol_123", "pn_cab_gol_123.id_user = pekerja.fnip");
        } else if ($gol == 'cab_4s') {
            $selectedTable = 'cab_4s';
            $otorisasiModel->join("pn_cab_gol_4s", "pn_cab_gol_4s.id_user = pekerja.fnip");
        } else if ($gol == 'cab_ao') {
            $selectedTable = 'cab_ao';
            $otorisasiModel->join("pn_cab_ao_reg", "pn_cab_ao_reg.id_user = pekerja.fnip");
        } else if ($gol == 'cab_uls') {
            $selectedTable = 'cab_uls';
            $otorisasiModel->join("pn_cab_uls", "pn_cab_uls.id_user = pekerja.fnip");
        } else if ($gol == 'cab_kcp') {
            $selectedTable = 'cab_kcp';
            $otorisasiModel->join("pn_cab_kcp", "pn_cab_kcp.id_user = pekerja.fnip");
        } else if ($gol == 'cab_koc') {
            $selectedTable = 'cab_koc';
            $otorisasiModel->join("pn_cab_koc", "pn_cab_koc.id_user = pekerja.fnip");
        } else if ($gol == 'cab_kcu') {
            $selectedTable = 'cab_kcu';
            $otorisasiModel->join("pn_cab_kcu", "pn_cab_kcu.id_user = pekerja.fnip");
        }
        $data['getData'] = $otorisasiModel->get()->getRowArray();
        $data['userGol'] = $gol;

        //MARK: AMBIL ATASAN PEKERJA
        $atasanModel = new AtasanModel();
        $atasan = $atasanModel->getAtasan($data['getData']['fnip']);
        $data['atasan1'] = $atasan['atasan1']['fnip'];
        $data['atasan2'] = $atasan['atasan2']['fnip'];

        //JALANKAN QUERY
        if (session()->get('fnip') === $data['atasan1']) {
            $query = $otorisasiModel->update_koreksi($selectedTable, $data['getData']['id_pn'], 'First');
            if (!$query) {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Gagal!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Koreksi Penilaian Kinerja Gagal!');
            } else {
                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Koreksi Penilaian Kinerja Berhasil!');
            }
        } else if (session()->get('fnip') === $data['atasan2']) {
            $query = $otorisasiModel->update_koreksi($selectedTable, $data['getData']['id_pn'], 'Second');
            if (!$query) {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Gagal!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Koreksi Penilaian Kinerja Gagal!');
            } else {
                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Proses Otorisasi Koreksi Penilaian Kinerja Berhasil!');
            }
        }
        //KIRIMKAN EMAIL
        $data['receiver_mail'] = $this->receiver_mail;
        $data['receiver_name'] = session()->get('fnama');
        $pekerjaModel = new PekerjaModel();
        $pekerjaModel->where('fnip', $data['getData']['id_user']);
        $dataPekerja = $pekerjaModel->get()->getRowArray();
        $data['target_name'] = $dataPekerja['fnama'];
        $data['target_email'] = $dataPekerja['email'];
        $subject = 'Permohonan Perbaikan Penilaian Kinerja Pekerja';
        $message = view('mail-style\mail_pa_evaluation_revision', $data);
        $this->sendEmail($data['target_email'], $subject, $message);


        $data['getList'] = $otorisasiModel->getDataOto();
        return view('penilaian/otorisasi/data_table', $data);
    }

    public function show_all()
    {
        $data['title'] = 'Daftar Penilaian Karyawan | PT Bank BCA Syariah';
        $data['active'] = 'Riwayat Penilaian';
        $otorisasiModel = new OtorisasiModel();
        $data['getList'] = $otorisasiModel->getAllDataPenilaian();
        return view('penilaian/all_data', $data);
    }

    public function show_all_to_pdf()
    {
        $otorisasiModel = new OtorisasiModel();
        $data['list'] = $otorisasiModel->getAllDataPenilaianTahunPA();
        $filename =  'DAFTAR PENILAIAN KINERJA BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/all', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    //MARK: MAIL CONFIGURATION
    //MARK: DO NOT CHANGE
    public function sendEmail($to, $title, $message)
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from_name = "PT Bank BCA Syariah";
        $from_mail = "no-reply@bcasyariah.co.id";
        $destination = $to;
        $subject = $title;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $from_name . " <" . $from_mail . ">";
        $message = $message;
        if (!empty($to)) {
            $send = mail($destination, $subject, $message, $headers);
            return (bool)$send;
        }
        return false;
    }
}
