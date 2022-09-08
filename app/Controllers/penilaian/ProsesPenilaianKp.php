<?php
// MARK: Definisi/Import Controller
namespace App\Controllers;

namespace App\Controllers\Penilaian;

use App\Controllers\BaseController;
use App\Models\PALogModel;
use App\Models\PekerjaModel;
// MARK: Definisi Model Penilaian PA Kantor Pusat
use App\Models\Penilaian123;
use App\Models\Penilaian4f;
use App\Models\Penilaian4s;
use App\Models\Penilaian5f;
use App\Models\Penilaian5s;
use App\Models\Penilaian67;
use App\Models\Trail;

//------------------------------------------------------------------//
// PROSES PENILAIAN KINERJA PEKERJA KANTOR PUSAT                    //
// PT BANK BCA SYARIAH COPYRIGHT 2022                               //
// DIKEMBANGKAN OLEH BCA SYARIAH INFORMATION TECHNOLOGY PROGRAM     //
// TAHUN 2022                                                       //
//------------------------------------------------------------------//

class ProsesPenilaianKp extends BaseController
{

    //MARK: Construct untuk mendefinisikan Email, etc..
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->receiver_mail = session()->get('email');
        $this->receiver_name = session()->get('fnama');
    }

    //MARK: Fungsi Untuk Menghitung Nilai PA
    public function tambahPenilaian($golongan)
    {
        //MARK: Memanggil Model Penilaian Golongan 1/2/3/4F/4S (KECAKAPAN KERJA + PERILAKU BUDAYA)
        if ($golongan == '123') {
            $model = new Penilaian123();
        } else if ($golongan == '4F') {
            $model = new Penilaian4f();
        } else if ($golongan == '4S') {
            $model = new Penilaian4s();
        } else if ($golongan == '5F') {
            $model = new Penilaian5f();
        } else if ($golongan == '5S') {
            $model = new Penilaian5s();
        } else if ($golongan == '67') {
            $model = new Penilaian67();
        }

        //MARK: Define Tahun PA (Current Year - 1)
        $current_year = date('Y');
        $pa_year = $current_year - 1;

        //MARK: Definisi Data dalam bentuk Array untuk Input ke Database
        //MARK: Data Default + Perilaku Budaya Default
        $data = array(
            'id_user'                       => session()->get('fnip'),
            'tahun_pa'                      => $pa_year,
            'tgl_isi'                       => date('d M Y'),
            'penilai_satu'                  => $this->request->getPost('atasan1'),
            'penilai_dua'                   => $this->request->getPost('atasan2'),

            'bobot_kupel'                   => $this->request->getPost('bobot_kupel'),
            'nilai_kupel'                   => $this->request->getPost('nilai_kupel'),
            'hasil_kupel'                   => bcdiv($this->request->getPost('hasil_kupel'), 1, 2),
            'alasan_kupel'                  => $this->request->getPost('alasan_kupel'),

            'bobot_disiplin'                => $this->request->getPost('bobot_disiplin'),
            'nilai_disiplin'                => $this->request->getPost('nilai_disiplin'),
            'hasil_disiplin'                => bcdiv($this->request->getPost('hasil_disiplin'), 1, 2),
            'alasan_disiplin'               => $this->request->getPost('alasan_disiplin'),

            'bobot_inisiatif'               => $this->request->getPost('bobot_inisiatif'),
            'nilai_inisiatif'               => $this->request->getPost('nilai_inisiatif'),
            'hasil_inisiatif'               => bcdiv($this->request->getPost('hasil_inisiatif'), 1, 2),
            'alasan_inisiatif'              => $this->request->getPost('alasan_inisiatif'),

            'bobot_integritas'              => $this->request->getPost('bobot_integritas'),
            'nilai_integritas'              => $this->request->getPost('nilai_integritas'),
            'hasil_integritas'              => bcdiv($this->request->getPost('hasil_integritas'), 1, 2),
            'alasan_integritas'             => $this->request->getPost('alasan_integritas'),

            'bobot_kerjasama'               => $this->request->getPost('bobot_kerjasama'),
            'nilai_kerjasama'               => $this->request->getPost('nilai_kerjasama'),
            'hasil_kerjasama'               => bcdiv($this->request->getPost('hasil_kerjasama'), 1, 2),
            'alasan_kerjasama'              => $this->request->getPost('alasan_kerjasama'),

            'hal_menonjol'                  => $this->request->getPost('hal_menonjol'),
            'hal_peningkatan'               => $this->request->getPost('hal_peningkatan'),
            'req_training'                  => $this->request->getPost('req_training')
        );

        //MARK: Apabila Golongan 1/2/3/4F/4S Maka Tambahkan Penilaian Kecakapan Kerja
        if ($golongan == '123' or $golongan == '4F' or $golongan == '4S') {
            $data['bobot_pengetahuan_jabatan']     = $this->request->getPost('bobot_pengetahuan_jabatan');
            $data['nilai_pengetahuan_jabatan']     = $this->request->getPost('nilai_pengetahuan_jabatan');
            $data['hasil_pengetahuan_jabatan']     = bcdiv($this->request->getPost('hasil_pengetahuan_jabatan'), 1, 2);
            $data['alasan_pengetahuan_jabatan']    = $this->request->getPost('alasan_pengetahuan_jabatan');

            $data['bobot_kualitas_kerja']          = $this->request->getPost('bobot_kualitas_kerja');
            $data['nilai_kualitas_kerja']          = $this->request->getPost('nilai_kualitas_kerja');
            $data['hasil_kualitas_kerja']          = bcdiv($this->request->getPost('hasil_kualitas_kerja'), 1, 2);
            $data['alasan_kualitas_kerja']         = $this->request->getPost('alasan_kualitas_kerja');

            $data['bobot_adaptasi']                = $this->request->getPost('bobot_adaptasi');
            $data['nilai_adaptasi']                = $this->request->getPost('nilai_adaptasi');
            $data['hasil_adaptasi']                = bcdiv($this->request->getPost('hasil_adaptasi'), 1, 2);
            $data['alasan_adaptasi']               = $this->request->getPost('alasan_adaptasi');

            $data['bobot_kemampuan_komunikasi']    = $this->request->getPost('bobot_kemampuan_komunikasi');
            $data['nilai_kemampuan_komunikasi']    = $this->request->getPost('nilai_kemampuan_komunikasi');
            $data['hasil_kemampuan_komunikasi']    = bcdiv($this->request->getPost('hasil_kemampuan_komunikasi'), 1, 2);
            $data['alasan_kemampuan_komunikasi']   = $this->request->getPost('alasan_kemampuan_komunikasi');
        }


        //MARK: Apabila Golongan 4F dan 4S Maka Tambahkan Penilaian Berikut:
        if ($golongan == '4F' or $golongan == '4S' or $golongan == '5F' or $golongan == '5S' or $golongan == '67') {
            $data['bobot_mandiri']  = $this->request->getPost('bobot_mandiri');
            $data['nilai_mandiri']  = $this->request->getPost('nilai_mandiri');
            $data['hasil_mandiri']  = bcdiv($this->request->getPost('hasil_mandiri'), 1, 2);
            $data['alasan_mandiri'] = $this->request->getPost('alasan_mandiri');
        }


        //MARK: Apabila Golongan 4S dan 5S Maka Tambahkan Penilaian Berikut:
        if ($golongan == '4S' or $golongan == '5S') {
            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = bcdiv($this->request->getPost('hasil_kemampuan_manajerial'), 1, 2);
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');
        }

        //MARK: Apabila Golongan 5F/5S maka tambahkan aspek Penilaian SASARAN BISNIS DAN KINERJA
        if ($golongan == '5F' or $golongan == '5S' or $golongan == '67') {
            $data['uraian_sb1']         = $this->request->getPost('uraian_sb1');
            $data['realisasi_sb1']      = $this->request->getPost('realisasi_sb1');
            $data['bobot_sb1']          = $this->request->getPost('bobot_sb1');
            $data['nilai_sb1']          = $this->request->getPost('nilai_sb1');
            $data['hasil_sb1']          = bcdiv($this->request->getPost('hasil_sb1'), 1, 2);

            $data['uraian_sb2']         = $this->request->getPost('uraian_sb2');
            $data['realisasi_sb2']      = $this->request->getPost('realisasi_sb2');
            $data['bobot_sb2']          = $this->request->getPost('bobot_sb2');
            $data['nilai_sb2']          = $this->request->getPost('nilai_sb2');
            $data['hasil_sb2']          = bcdiv($this->request->getPost('hasil_sb2'), 1, 2);

            $data['uraian_sb3']         = $this->request->getPost('uraian_sb3');
            $data['realisasi_sb3']      = $this->request->getPost('realisasi_sb3');
            $data['bobot_sb3']          = $this->request->getPost('bobot_sb3');
            $data['nilai_sb3']          = $this->request->getPost('nilai_sb3');
            $data['hasil_sb3']          = bcdiv($this->request->getPost('hasil_sb3'), 1, 2);

            $data['uraian_sb4']         = $this->request->getPost('uraian_sb4');
            $data['realisasi_sb4']      = $this->request->getPost('realisasi_sb4');
            $data['bobot_sb4']          = $this->request->getPost('bobot_sb4');
            $data['nilai_sb4']          = $this->request->getPost('nilai_sb4');
            $data['hasil_sb4']          = bcdiv($this->request->getPost('hasil_sb4'), 1, 2);

            $data['uraian_sb5']         = $this->request->getPost('uraian_sb5');
            $data['realisasi_sb5']      = $this->request->getPost('realisasi_sb5');
            $data['bobot_sb5']          = $this->request->getPost('bobot_sb5');
            $data['nilai_sb5']          = $this->request->getPost('nilai_sb5');
            $data['hasil_sb5']          = bcdiv($this->request->getPost('hasil_sb5'), 1, 2);

            $data['uraian_sb6']         = $this->request->getPost('uraian_sb6');
            $data['realisasi_sb6']      = $this->request->getPost('realisasi_sb6');
            $data['bobot_sb6']          = $this->request->getPost('bobot_sb6');
            $data['nilai_sb6']          = $this->request->getPost('nilai_sb6');
            $data['hasil_sb6']          = bcdiv($this->request->getPost('hasil_sb6'), 1, 2);

            $data['uraian_sb7']         = $this->request->getPost('uraian_sb7');
            $data['realisasi_sb7']      = $this->request->getPost('realisasi_sb7');
            $data['bobot_sb7']          = $this->request->getPost('bobot_sb7');
            $data['nilai_sb7']          = $this->request->getPost('nilai_sb7');
            $data['hasil_sb7']          = bcdiv($this->request->getPost('hasil_sb7'), 1, 2);
        }

        //MARK: Apabila Golongan 5S maka tambahkan aspek Penilaian 'KEMAMPUAN MANAJERIAL'
        if ($golongan == '5S' or $golongan == '67') {
            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = bcdiv($this->request->getPost('hasil_kemampuan_manajerial'), 1, 2);
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');
        }

        //MARK: Pengecekan Data Atasan Kedua (Second Supervisor)
        if (empty($data['penilai_dua']) or $data['penilai_dua'] == NULL or $data['penilai_dua'] == '') {
            $data['penilai_dua'] = $data['penilai_satu'];
        }

        //MARK: Define Nilai Bobot Akhir
        //NEED TO CHANGE -> CALL MODEL
        $bobot_kecakapan_kerja  = 0.70;
        $bobot_sasaran_bisnis   = 0.70;
        $bobot_perilaku_budaya  = 0.30;

        //MARK: Menghitung Nilai Total dan Hasil PA
        if ($golongan == '123') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 1/2/3/4F
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];
            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;
            $data['hasil_kecakapan_kerja'] = round($data['hasil_kecakapan_kerja'], 2);

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 1/2/3/4F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);
        } else if ($golongan == '4F') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 1/2/3/4F
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];
            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;
            $data['hasil_kecakapan_kerja'] = round($data['hasil_kecakapan_kerja'], 2);

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 1/2/3/4F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);
        } else if ($golongan == '4S') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 4S
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];
            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;
            $data['hasil_kecakapan_kerja'] = round($data['hasil_kecakapan_kerja'], 2);

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 4S
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);
        } else if ($golongan == '5F') {
            //MARK: Logic untuk menghitung Nilai Sasaran Bisnis dan Kinerja Golongan 5F
            // dd($data);
            $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;
            $data['hasil_sarbis'] = round($data['hasil_sarbis'], 2);

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 5F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);
        } else if ($golongan == '5S' or $golongan == '67') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 5S/67
            $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;
            $data['hasil_sarbis'] = round($data['hasil_sarbis'], 2);

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 5S/67
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);
        } else {
            echo '<script>
                    alert("Undefinied Level! Gagal Menambahkan Penilaian")
                    window.location="' . base_url('penilaian/riwayat') . '"
                </script>';
        }

        //MARK: Logic untuk menghitung Nilai Total Kecakapan Kerja dan Perilaku Budaya
        if ($golongan == '5F' or $golongan == '5S' or $golongan == '67') {
            $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
            $data['total_hasil_pa'] = round($data['total_hasil_pa'], 2);
        } else {
            $data['total_hasil_pa'] = $data['hasil_kecakapan_kerja'] + $data['hasil_perilaku_budaya'];
            $data['total_hasil_pa'] = round($data['total_hasil_pa'], 2);
        }


        //MARK: Mendapatkan Nilai SP
        $poin_sp = $this->request->getPost('poin_sp');

        //MARK: Proses Pengurangan Nilai PA
        $data['angka_pa'] = $data['total_hasil_pa'] - $poin_sp;


        //MARK: Menerjemahkan Nilai PA kedalam bentuk Huruf
        if ($data['angka_pa'] <= 1.5) {
            $data['huruf_pa'] = 'D';
        } else if ($data['angka_pa'] <= 2.5) {
            $data['huruf_pa'] = 'C';
        } else if ($data['angka_pa'] <= 3.5) {
            $data['huruf_pa'] = 'B';
        } else {
            $data['huruf_pa'] = 'A';
        }

        // $data['golongan'] = $golongan;

        // dd($model->insert($data));


        //MARK: Proses Menambahkan Data ke Database
        if ($model->insert($data)) {
            $pekerjaModel       = new PekerjaModel();
            $getDetailUser      = $pekerjaModel->where('fnip', session()->get('fnip'))->get()->getRowArray();

            $data_log = array(
                'tahun_pa'                      => $data['tahun_pa'],
                'fgrade'                        => $golongan,
                'id_user'                       => $data['id_user'],
                'fnama'                         => $getDetailUser['fnama'],
                'jabatan'                       => $getDetailUser['jabatan'],
                'satuan_kerja'                  => $getDetailUser['satuan_kerja'],
                'departemen'                    => $getDetailUser['departemen'],
                'fungsi'                        => $getDetailUser['fungsi'],
                'penilai_satu'                  => $this->request->getPost('atasan1'),
                'penilai_dua'                   => $this->request->getPost('atasan2')
            );

            $logModel = new PALogModel();
            $logModel->insert($data_log);

            //MARK: Mengirimkan Email Konfirmasi
            if (!empty($this->receiver_mail)) {
                $pekerjaModel = new PekerjaModel();

                //MARK: Send Email ke Pekerja
                $data['receiver_mail'] = $this->receiver_mail;
                $data['receiver_name'] = session()->get('fnama');
                $subject = 'Konfirmasi Penilaian Kinerja Pekerja';
                $message = view('mail-style\mail_pa_evaluation_send', $data);
                $this->sendEmail($this->receiver_mail, $subject, $message);

                //MARK: Send Email ke Atasan 1
                $supervisor1 = $pekerjaModel->where('fnip', $data['penilai_satu'])->get()->getRowArray();
                $data['receiver_name'] = session()->get('atasan1.nama');
                $data['target_name'] = session()->get('fnama');
                $supervisor1_mail = $supervisor1['email'];
                $subject = 'Penilaian Kinerja Pekerja Memerlukan Otorisasi';
                $message = view('mail-style\mail_pa_evaluation_to_validate', $data);
                $this->sendEmail($supervisor1_mail, $subject, $message);

                //MARK: Send Email ke Atasan 2
                $supervisor2 = $pekerjaModel->where('fnip', $data['penilai_dua'])->get()->getRowArray();
                $data['receiver_name'] = session()->get('atasan2.nama');
                $data['target_name'] = session()->get('fnama');
                $supervisor2_mail = $supervisor2['email'];
                $subject = 'Penilaian Kinerja Pekerja Memerlukan Otorisasi';
                $message = view('mail-style\mail_pa_evaluation_to_validate', $data);
                $this->sendEmail($supervisor2_mail, $subject, $message);
            }

            // $logModel = new Trail();
            // $logModel->insert([
            //     'activity_code' => 'ADPN', 'user_agent' => 'SERVER', 'ip_address' => '192.168.0.1', 'mac_address' => '0000:0000:0000:0000', 'user_id' => 'SYSTEM', 'user_name' => 'SYSTEM'
            // ]);
            loggerActivity("TAMBAH PENILAIAN KP");

            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Formulir Penilaian Berhasil Dikirim dan Menunggu Persetujuan!');
            // $this->load->helper('url');
            return redirect()->to("/penilaian/riwayat");
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Terjadi Kesalahan Saat Mengirim Formulir PA!');
            // $this->load->helper('url');
            return redirect()->to("/penilaian/formulir");
        }
    }


    public function revisiPenilaian($golongan)
    {

        //MARK: Memanggil Model Penilaian Golongan 1/2/3/4F/4S (KECAKAPAN KERJA + PERILAKU BUDAYA)
        if ($golongan == '123') {
            $model = new Penilaian123();
        } else if ($golongan == '4F') {
            $model = new Penilaian4f();
        } else if ($golongan == '4S') {
            $model = new Penilaian4s();
        } else if ($golongan == '5F') {
            $model = new Penilaian5f();
        } else if ($golongan == '5S') {
            $model = new Penilaian5s();
        } else if ($golongan == '67') {
            $model = new Penilaian67();
        }

        //MARK: Define Tahun PA (Current Year - 1)
        $current_year = date('Y');
        $pa_year = $current_year - 1;

        $id_pn = $this->request->getPost('id_pn');

        //MARK: Definisi Data dalam bentuk Array untuk Input ke Database
        //MARK: Data Default + Perilaku Budaya Default
        $data = array(
            'id_user'                       => $this->request->getPost('fnip_pekerja'),
            'tahun_pa'                      => $pa_year,
            'tgl_isi'                       => date('d M Y'),
            'penilai_satu'                  => $this->request->getPost('atasan1'),
            'penilai_dua'                   => $this->request->getPost('atasan2'),
            'approval_satu'                 => '',
            'approval_dua'                  => '',
            'bobot_kupel'                   => $this->request->getPost('bobot_kupel'),
            'nilai_kupel'                   => $this->request->getPost('nilai_kupel'),
            'hasil_kupel'                   => $this->request->getPost('hasil_kupel'),
            'alasan_kupel'                  => trim($this->request->getPost('alasan_kupel')),

            'bobot_disiplin'                => $this->request->getPost('bobot_disiplin'),
            'nilai_disiplin'                => $this->request->getPost('nilai_disiplin'),
            'hasil_disiplin'                => $this->request->getPost('hasil_disiplin'),
            'alasan_disiplin'               => trim($this->request->getPost('alasan_disiplin')),

            'bobot_inisiatif'               => $this->request->getPost('bobot_inisiatif'),
            'nilai_inisiatif'               => $this->request->getPost('nilai_inisiatif'),
            'hasil_inisiatif'               => $this->request->getPost('hasil_inisiatif'),
            'alasan_inisiatif'              => trim($this->request->getPost('alasan_inisiatif')),

            'bobot_integritas'              => $this->request->getPost('bobot_integritas'),
            'nilai_integritas'              => $this->request->getPost('nilai_integritas'),
            'hasil_integritas'              => $this->request->getPost('hasil_integritas'),
            'alasan_integritas'             => trim($this->request->getPost('alasan_integritas')),

            'bobot_kerjasama'               => $this->request->getPost('bobot_kerjasama'),
            'nilai_kerjasama'               => $this->request->getPost('nilai_kerjasama'),
            'hasil_kerjasama'               => $this->request->getPost('hasil_kerjasama'),
            'alasan_kerjasama'              => trim($this->request->getPost('alasan_kerjasama')),
        );

        //MARK: Apabila Golongan 1/2/3/4F/4S Maka Tambahkan Penilaian Kecakapan Kerja
        if ($golongan == '123' or $golongan == '4F' or $golongan == '4S') {
            $data['bobot_pengetahuan_jabatan']     = $this->request->getPost('bobot_pengetahuan_jabatan');
            $data['nilai_pengetahuan_jabatan']     = $this->request->getPost('nilai_pengetahuan_jabatan');
            $data['hasil_pengetahuan_jabatan']     = $this->request->getPost('hasil_pengetahuan_jabatan');
            $data['alasan_pengetahuan_jabatan']    = trim($this->request->getPost('alasan_pengetahuan_jabatan'));

            $data['bobot_kualitas_kerja']          = $this->request->getPost('bobot_kualitas_kerja');
            $data['nilai_kualitas_kerja']          = $this->request->getPost('nilai_kualitas_kerja');
            $data['hasil_kualitas_kerja']          = $this->request->getPost('hasil_kualitas_kerja');
            $data['alasan_kualitas_kerja']         = trim($this->request->getPost('alasan_kualitas_kerja'));

            $data['bobot_adaptasi']                = $this->request->getPost('bobot_adaptasi');
            $data['nilai_adaptasi']                = $this->request->getPost('nilai_adaptasi');
            $data['hasil_adaptasi']                = $this->request->getPost('hasil_adaptasi');
            $data['alasan_adaptasi']               = trim($this->request->getPost('alasan_adaptasi'));

            $data['bobot_kemampuan_komunikasi']    = $this->request->getPost('bobot_kemampuan_komunikasi');
            $data['nilai_kemampuan_komunikasi']    = $this->request->getPost('nilai_kemampuan_komunikasi');
            $data['hasil_kemampuan_komunikasi']    = $this->request->getPost('hasil_kemampuan_komunikasi');
            $data['alasan_kemampuan_komunikasi']   = trim($this->request->getPost('alasan_kemampuan_komunikasi'));
        }


        //MARK: Apabila Golongan 4F dan 4S Maka Tambahkan Penilaian Berikut:
        if ($golongan == '4F' or $golongan == '4S' or $golongan == '5F' or $golongan == '5S' or $golongan == '67') {
            $data['bobot_mandiri']  = $this->request->getPost('bobot_mandiri');
            $data['nilai_mandiri']  = $this->request->getPost('nilai_mandiri');
            $data['hasil_mandiri']  = $this->request->getPost('hasil_mandiri');
            $data['alasan_mandiri'] = trim($this->request->getPost('alasan_mandiri'));
        }


        //MARK: Apabila Golongan 4S dan 5S Maka Tambahkan Penilaian Berikut:
        if ($golongan == '4S' or $golongan == '5S') {
            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = $this->request->getPost('hasil_kemampuan_manajerial');
            $data['alasan_kemampuan_manajerial']    = trim($this->request->getPost('alasan_kemampuan_manajerial'));
        }

        //MARK: Apabila Golongan 5F/5S maka tambahkan aspek Penilaian SASARAN BISNIS DAN KINERJA
        if ($golongan == '5F' or $golongan == '5S' or $golongan == '67') {
            $data['uraian_sb1']         = $this->request->getPost('uraian_sb1');
            $data['realisasi_sb1']      = $this->request->getPost('realisasi_sb1');
            $data['bobot_sb1']          = $this->request->getPost('bobot_sb1');
            $data['nilai_sb1']          = $this->request->getPost('nilai_sb1');
            $data['hasil_sb1']          = $this->request->getPost('hasil_sb1');

            $data['uraian_sb2']         = $this->request->getPost('uraian_sb2');
            $data['realisasi_sb2']      = $this->request->getPost('realisasi_sb2');
            $data['bobot_sb2']          = $this->request->getPost('bobot_sb2');
            $data['nilai_sb2']          = $this->request->getPost('nilai_sb2');
            $data['hasil_sb2']          = $this->request->getPost('hasil_sb2');

            $data['uraian_sb3']         = $this->request->getPost('uraian_sb3');
            $data['realisasi_sb3']      = $this->request->getPost('realisasi_sb3');
            $data['bobot_sb3']          = $this->request->getPost('bobot_sb3');
            $data['nilai_sb3']          = $this->request->getPost('nilai_sb3');
            $data['hasil_sb3']          = $this->request->getPost('hasil_sb3');

            $data['uraian_sb4']         = $this->request->getPost('uraian_sb4');
            $data['realisasi_sb4']      = $this->request->getPost('realisasi_sb4');
            $data['bobot_sb4']          = $this->request->getPost('bobot_sb4');
            $data['nilai_sb4']          = $this->request->getPost('nilai_sb4');
            $data['hasil_sb4']          = $this->request->getPost('hasil_sb4');

            $data['uraian_sb5']         = $this->request->getPost('uraian_sb5');
            $data['realisasi_sb5']      = $this->request->getPost('realisasi_sb5');
            $data['bobot_sb5']          = $this->request->getPost('bobot_sb5');
            $data['nilai_sb5']          = $this->request->getPost('nilai_sb5');
            $data['hasil_sb5']          = $this->request->getPost('hasil_sb5');

            $data['uraian_sb6']         = $this->request->getPost('uraian_sb6');
            $data['realisasi_sb6']      = $this->request->getPost('realisasi_sb6');
            $data['bobot_sb6']          = $this->request->getPost('bobot_sb6');
            $data['nilai_sb6']          = $this->request->getPost('nilai_sb6');
            $data['hasil_sb6']          = $this->request->getPost('hasil_sb6');

            $data['uraian_sb7']         = $this->request->getPost('uraian_sb7');
            $data['realisasi_sb7']      = $this->request->getPost('realisasi_sb7');
            $data['bobot_sb7']          = $this->request->getPost('bobot_sb7');
            $data['nilai_sb7']          = $this->request->getPost('nilai_sb7');
            $data['hasil_sb7']          = $this->request->getPost('hasil_sb7');
        }

        //MARK: Apabila Golongan 5S maka tambahkan aspek Penilaian 'KEMAMPUAN MANAJERIAL'
        if ($golongan == '5S' or $golongan == '67') {
            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = $this->request->getPost('hasil_kemampuan_manajerial');
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');
        }

        //MARK: Pengecekan Data Atasan Kedua (Second Supervisor)
        if (empty($data['penilai_dua']) or $data['penilai_dua'] == NULL or $data['penilai_dua'] == '') {
            $data['penilai_dua'] = $data['penilai_satu'];
        }

        //MARK: Define Nilai Bobot Akhir
        //NEED TO CHANGE -> CALL MODEL
        $bobot_kecakapan_kerja  = 0.70;
        $bobot_sasaran_bisnis   = 0.70;
        $bobot_perilaku_budaya  = 0.30;

        //MARK: Menghitung Nilai Total dan Hasil PA
        if ($golongan == '123') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 1/2/3
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];

            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 1/2/3
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];

            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
        } else if ($golongan == '4F') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 4F
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];

            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 4F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'];

            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
        } else if ($golongan == '4S') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 4S
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];

            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 4S
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];

            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
        } else if ($golongan == '5F') {
            //MARK: Logic untuk menghitung Nilai Sasaran Bisnis dan Kinerja Golongan 5F
            // dd($data);
            $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 5F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
        } else if ($golongan == '5S' or $golongan == '67') {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 5S/67
            $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 5S/67
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
        } else {
            echo '<script>
                    alert("Undefinied Level! Gagal Menambahkan Penilaian")
                    window.location="' . base_url('penilaian/riwayat') . '"
                </script>';
        }

        //MARK: Logic untuk menghitung Nilai Total Kecakapan Kerja dan Perilaku Budaya
        if ($golongan == '5F' or $golongan == '5S' or $golongan == '67') {
            $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
        } else {
            $data['total_hasil_pa'] = $data['hasil_kecakapan_kerja'] + $data['hasil_perilaku_budaya'];
        }

        //MARK: Mendapatkan Nilai SP
        if (empty($this->request->getPost('poin_sp'))) {
            $poin_sp = 0;
        } else {
            $poin_sp = $this->request->getPost('poin_sp');
        }

        //MARK: Proses Pengurangan Nilai PA
        $data['angka_pa'] = $data['total_hasil_pa'] - $poin_sp;


        //MARK: Menerjemahkan Nilai PA kedalam bentuk Huruf
        if ($data['angka_pa'] <= 1.5) {
            $data['huruf_pa'] = 'D';
        } else if ($data['angka_pa'] <= 2.5) {
            $data['huruf_pa'] = 'C';
        } else if ($data['angka_pa'] <= 3.5) {
            $data['huruf_pa'] = 'B';
        } else {
            $data['huruf_pa'] = 'A';
        }

        //dd($data);


        //MARK: Perbarui Status Perubahan Data Penilaian (Telah Diedit oleh Atasan)
        //MARK: Ambil NIP Atasan
        $fnip_atasan = session()->get('fnip');

        // dd($fnip_atasan);

        if ($fnip_atasan == $data['penilai_satu']) {
            $data['approval_satu'] = 'Edited';
        } else if ($fnip_atasan == $data['penilai_dua']) {
            $data['approval_dua'] = 'Edited';
        }

        //MARK: Proses Menambahkan Data ke Database

        if ($model->update($id_pn, $data)) {
            //MARK: Ambil Data Pekerja
            $pekerjaModel     = new PekerjaModel();
            $dataPekerja      = $pekerjaModel->where('fnip', $data['id_user'])->get()->getRowArray();
            $emailPekerja     = $dataPekerja['email'];

            //MARK: Mengirimkan Email Konfirmasi
            if (!empty($emailPekerja)) {
                //MARK: Send Email
                $data['receiver_mail'] = $emailPekerja;
                $data['receiver_name'] = $pekerjaModel->select('fnama')->where('fnip', $data['id_user'])->get()->getRowArray();
                $data['supervisor_name'] = session()->get('fnama');

                $subject = 'Konfirmasi Penilaian Kinerja Pekerja';
                $message = view('mail-style\mail_pa_evaluation_revision', $data);
                $this->sendEmail($emailPekerja, $subject, $message);
            }

            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Perubahan penilaian berhasil dilakukan, harap lakukan otorisasi persetujuan sebagai finalisasi otorisasi anda.');
            // $this->load->helper('url');
            return redirect()->to("/penilaian/otorisasi");
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Terjadi Kesalahan Saat Memperbarui Formulir PA!');
            // $this->load->helper('url');
            return redirect()->to("/penilaian/otorisasi");
        }
    }

    //MARK: SEND-MAIL TESTING ONLY
    public function sendMail()
    {
        $data['receiver_name'] = $this->receiver_name;
        $receiver_mail = $this->receiver_mail;
        $subject = 'Konfirmasi Penilaian Kinerja Karyawan';
        $message = view('mail-style\mail_example', $data);
        $this->sendEmail($receiver_mail, $subject, $message);
    }

    //MARK: MAIL CONFIGURATION
    //MARK: DO NOT CHANGE
    public function sendEmail($to, $title, $message)
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $to = trim($to);
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
