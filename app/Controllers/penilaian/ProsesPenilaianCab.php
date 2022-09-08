<?php

namespace App\Controllers\Penilaian;

use App\Controllers\BaseController;
use App\Models\PALogModel;
use App\Models\PekerjaModel;
use App\Models\PenilaianCab123;
use App\Models\PenilaianCab4s;
use App\Models\PenilaianCabAOReg;
use App\Models\PenilaianKepalaKC;
use App\Models\PenilaianKepalaKCP;
use App\Models\PenilaianKepalaKOC;
use App\Models\PenilaianKepalaULS;

class ProsesPenilaianCab extends BaseController
{
    //MARK: Construct untuk mendefinisikan Email, etc..
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->receiver_mail = session()->get('email');
        $this->receiver_name = session()->get('fnama');
    }

    //MARK: Fungsi Untuk Menghitung Nilai PA
    public function tambahPenilaian($kode_form)
    {
        $jabatan = trim(session()->get('jabatan'));

        //MARK: Memanggil Model Penilaian Golongan 1/2/3/4F/4S (KECAKAPAN KERJA + PERILAKU BUDAYA)
        if ($kode_form == 'ka_kc') {
            $model = new PenilaianKepalaKC();
            $golongan = $kode_form;
        } else if ($kode_form == 'ka_koc') {
            $model = new PenilaianKepalaKOC();
            $golongan = $kode_form;
        } else if ($kode_form == 'ka_kcp') {
            $model = new PenilaianKepalaKCP();
            $golongan = $kode_form;
        } else if ($kode_form == 'ao_reg') {
            $model = new PenilaianCabAOReg();
            $golongan = $kode_form;
        } else if ($kode_form == 'ka_uls') {
            $model = new PenilaianKepalaULS();
            $golongan = $kode_form;
        } else if ($kode_form == '4S') {
            $model = new PenilaianCab4s();
            $golongan = $kode_form;
        } else if ($kode_form == '123') {
            $model = new PenilaianCab123();
            $golongan = $kode_form;
        } else {
            echo "Undefinied Grade";
            exit();
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

        //MARK: Apabila Golongan 123
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
            "STAF OPERASIONAL SENIOR",
            "KEPALA BAGIAN TELLER DAN BACKOFFICE",
            "KEPALA BAGIAN OPERASIONAL",
            "KEPALA BAGIAN CUSTOMER SERVICE"
        );
        if (in_array($jabatan, $jabatan_kecakapan_kerja)) {
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

        //MARK: Apabila Golongan 4S
        $jabatan_struktural = array(
            "KEPALA CABANG PEMBANTU",
            "KEPALA BAGIAN TELLER DAN BACKOFFICE",
            "KEPALA CABANG",
            "KEPALA ULS",
            "KEPALA BAGIAN OPERASIONAL",
            "KEPALA OPERASI CABANG",
            "KEPALA ULS ",
            "KEPALA BAGIAN CUSTOMER SERVICE",
            "KEPALA CABANG ",
        );

        if (in_array($jabatan, $jabatan_struktural)) {
            $data['bobot_mandiri']                  = $this->request->getPost('bobot_mandiri');
            $data['nilai_mandiri']                  = $this->request->getPost('nilai_mandiri');
            $data['hasil_mandiri']                  = bcdiv($this->request->getPost('hasil_mandiri'), 1, 2);
            $data['alasan_mandiri']                 = $this->request->getPost('alasan_mandiri');

            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = bcdiv($this->request->getPost('hasil_kemampuan_manajerial'), 1, 2);
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');
        }

        //JABATAN DENGAN SASARAN BISNIS HINGGA 1-5
        $jabatan_sarbis_reg = array(
            "KEPALA OPERASI CABANG",
            "KEPALA CABANG",
            "ACCOUNT OFFICER",
            "KEPALA CABANG PEMBANTU",
            "ASSOCIATE ACCOUNT OFFICER",
            "KEPALA ULS",
            "ASSISTANT ACCOUNT OFFICER",
        );
        if (in_array($jabatan, $jabatan_sarbis_reg)) {
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
        }

        //JABATAN DENGAN MAX. 6 SARBIS
        $jabatan_sarbis_med = array(
            "KEPALA CABANG",
            "KEPALA CABANG PEMBANTU",
            "ACCOUNT OFFICER",
            "ASSOCIATE ACCOUNT OFFICER",
            "ASSISTANT ACCOUNT OFFICER"
        );
        if (in_array($jabatan, $jabatan_sarbis_med)) {
            $data['uraian_sb6']         = $this->request->getPost('uraian_sb6');
            $data['realisasi_sb6']      = $this->request->getPost('realisasi_sb6');
            $data['bobot_sb6']          = $this->request->getPost('bobot_sb6');
            $data['nilai_sb6']          = $this->request->getPost('nilai_sb6');
            $data['hasil_sb6']          = bcdiv($this->request->getPost('hasil_sb6'), 1, 2);
        }

        //JABATAN DENGAN MAX. 8 SARBIS
        $jabatan_sarbis_full = array(
            "KEPALA CABANG",
            "KEPALA CABANG PEMBANTU"
        );
        if (in_array($jabatan, $jabatan_sarbis_full)) {
            $data['uraian_sb7']         = $this->request->getPost('uraian_sb7');
            $data['realisasi_sb7']      = $this->request->getPost('realisasi_sb7');
            $data['bobot_sb7']          = $this->request->getPost('bobot_sb7');
            $data['nilai_sb7']          = $this->request->getPost('nilai_sb7');
            $data['hasil_sb7']          = bcdiv($this->request->getPost('hasil_sb7'), 1, 2);

            $data['uraian_sb8']         = $this->request->getPost('uraian_sb8');
            $data['realisasi_sb8']      = $this->request->getPost('realisasi_sb8');
            $data['bobot_sb8']          = $this->request->getPost('bobot_sb8');
            $data['nilai_sb8']          = $this->request->getPost('nilai_sb8');
            $data['hasil_sb8']          = bcdiv($this->request->getPost('hasil_sb8'), 1, 2);
        }

        if ($jabatan == "KEPALA ULS") {
            $data['nilai_audit']        = $this->request->getPost('nilai_audit');
            $data['bobot_audit']        = $this->request->getPost('bobot_audit');
            $data['nilai_smart']        = $this->request->getPost('nilai_smart');
            $data['bobot_smart']        = $this->request->getPost('bobot_smart');
        }

        $jabatan_kepala = array(
            "KEPALA OPERASI CABANG",
            "KEPALA CABANG",
            "KEPALA CABANG PEMBANTU"
        );
        if (in_array($jabatan, $jabatan_kepala)) {
            $data['nilai_npf']          = $this->request->getPost('nilai_npf');
            $data['bobot_npf']          = $this->request->getPost('bobot_npf');
            $data['nilai_audit']        = $this->request->getPost('nilai_audit');
            $data['bobot_audit']        = $this->request->getPost('bobot_audit');
            $data['nilai_smart']        = $this->request->getPost('nilai_smart');
            $data['bobot_smart']        = $this->request->getPost('bobot_smart');
        }

        $jabatan_ao = array(
            "ACCOUNT OFFICER",
            "ASSOCIATE ACCOUNT OFFICER",
            "ASSISTANT ACCOUNT OFFICER"
        );
        if (in_array($jabatan, $jabatan_ao)) {
            $data['bobot_mandiri']                  = $this->request->getPost('bobot_mandiri');
            $data['nilai_mandiri']                  = $this->request->getPost('nilai_mandiri');
            $data['hasil_mandiri']                  = bcdiv($this->request->getPost('hasil_mandiri'), 1, 2);
            $data['alasan_mandiri']                 = $this->request->getPost('alasan_mandiri');

            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = bcdiv($this->request->getPost('hasil_kemampuan_manajerial'), 1, 2);
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');

            $data['nilai_npf']                      = $this->request->getPost('nilai_npf');
            $data['bobot_npf']                      = $this->request->getPost('bobot_npf');
            $data['nilai_audit']                    = $this->request->getPost('nilai_audit');
            $data['bobot_audit']                    = $this->request->getPost('bobot_audit');
            $data['nilai_dok']                      = $this->request->getPost('nilai_dok');
            $data['bobot_dok']                      = $this->request->getPost('bobot_dok');
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

        //MARK: HITUNG NILAI KECAKAPAN KERJA/SARBIS/NPF/AUDIT/SMART/PERILAKU BUDAYA
        if (in_array($jabatan, $jabatan_kecakapan_kerja)) {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 1/2/3/4F
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];
            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;
            $data['hasil_kecakapan_kerja'] = round($data['hasil_kecakapan_kerja'], 2);

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 1/2/3/4F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);

            $data['total_hasil_pa'] = $data['hasil_kecakapan_kerja'] + $data['hasil_perilaku_budaya'];
        } else if (in_array($jabatan, $jabatan_struktural)) {
            if (empty($data['hasil_sb6'])) {
                $data['hasil_sb6'] = 0;
                $data['hasil_sb7'] = 0;
                $data['hasil_sb8'] = 0;
            }

            $jumlah_hasil_sarbis = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] +  $data['hasil_sb7'] + $data['hasil_sb8'];


            //MARK: HITUNG PEMOTONGAN NILAI TERHADAP SARBIS
            if (empty($data['bobot_npf'])) {
                $data['bobot_npf'] = 0;
            }
            $data['total_sarbis'] = $jumlah_hasil_sarbis - $data['bobot_npf'] - $data['bobot_audit'] - $data['bobot_smart'];
            // dd($data['total_sarbis']);

            //MARK: HITUNG TOTAL NILAI SARBIS
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;
            $data['hasil_sarbis'] = round($data['hasil_sarbis'], 2);

            //MARK: HITUNG NILAI PERILAKU BUDAYA
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);

            $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
        } else if (in_array($jabatan, $jabatan_ao)) {
            $jumlah_hasil_sarbis = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'];
            //MARK: HITUNG PEMOTONGAN NILAI TERHADAP SARBIS
            $data['total_sarbis'] = $jumlah_hasil_sarbis - $data['bobot_npf'] - $data['bobot_audit'] - $data['bobot_dok'];
            //MARK: HITUNG TOTAL NILAI SARBIS
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;
            $data['hasil_sarbis'] = round($data['hasil_sarbis'], 2);

            //MARK: HITUNG NILAI PERILAKU BUDAYA
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;
            $data['hasil_perilaku_budaya'] = round($data['hasil_perilaku_budaya'], 2);

            $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
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

            loggerActivity("TAMBAH PENILAIAN CAB");

            //MARK: Mengirimkan Email Konfirmasi
            if (!empty($this->receiver_mail)) {
                //MARK: Send Email
                $data['receiver_mail'] = $this->receiver_mail;
                $data['receiver_name'] = session()->get('fnama');
                $subject = 'Konfirmasi Penilaian Kinerja Pekerja';
                $message = view('mail-style\mail_evaluation_send', $data);
                $this->sendEmail($this->receiver_mail, $subject, $message);
            }

            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Formulir Penilaian Berhasil Dikirim dan Menunggu Persetujuan!');
            return redirect()->to("/penilaian/riwayat");
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Terjadi Kesalahan Saat Mengirim Formulir PA!');
            return redirect()->to("/penilaian/formulir");
        }
    }

    public function revisiPenilaian($kode_form)
    {
        //AMBIL JABATAN USER TERKAIT
        $pekerjaModel = new PekerjaModel();
        $getJabatanUser = $pekerjaModel->select('jabatan')->where('fnip', $this->request->getPost('fnip_pekerja'))->get()->getRowArray();
        $jabatan = $getJabatanUser['jabatan'];

        if ($kode_form == 'ka_kc') {
            $model = new PenilaianKepalaKC();
        } else if ($kode_form == 'ka_koc') {
            $model = new PenilaianKepalaKOC();
        } else if ($kode_form == 'ka_kcp') {
            $model = new PenilaianKepalaKCP();
        } else if ($kode_form == 'ao_reg') {
            $model = new PenilaianCabAOReg();
        } else if ($kode_form == 'ka_uls') {
            $model = new PenilaianKepalaULS();
        } else if ($kode_form == '4S') {
            $model = new PenilaianCab4s();
        } else if ($kode_form == '123') {
            $model = new PenilaianCab123();
        } else {
            echo "Undefinied Grade";
            exit();
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
            'alasan_kupel'                  => $this->request->getPost('alasan_kupel'),
            'bobot_disiplin'                => $this->request->getPost('bobot_disiplin'),
            'nilai_disiplin'                => $this->request->getPost('nilai_disiplin'),
            'hasil_disiplin'                => $this->request->getPost('hasil_disiplin'),
            'alasan_disiplin'               => $this->request->getPost('alasan_disiplin'),
            'bobot_inisiatif'               => $this->request->getPost('bobot_inisiatif'),
            'nilai_inisiatif'               => $this->request->getPost('nilai_inisiatif'),
            'hasil_inisiatif'               => $this->request->getPost('hasil_inisiatif'),
            'alasan_inisiatif'              => $this->request->getPost('alasan_inisiatif'),
            'bobot_integritas'              => $this->request->getPost('bobot_integritas'),
            'nilai_integritas'              => $this->request->getPost('nilai_integritas'),
            'hasil_integritas'              => $this->request->getPost('hasil_integritas'),
            'alasan_integritas'             => $this->request->getPost('alasan_integritas'),
            'bobot_kerjasama'               => $this->request->getPost('bobot_kerjasama'),
            'nilai_kerjasama'               => $this->request->getPost('nilai_kerjasama'),
            'hasil_kerjasama'               => $this->request->getPost('hasil_kerjasama'),
            'alasan_kerjasama'              => $this->request->getPost('alasan_kerjasama'),
            'hal_menonjol'                  => $this->request->getPost('hal_menonjol'),
            'hal_peningkatan'               => $this->request->getPost('hal_peningkatan'),
            'req_training'                  => $this->request->getPost('req_training')
        );

        //MARK: CEK YANG REVISI ATASAN 1/ATASAN 2
        $getNIPAtasan = session()->get('fnip');
        if ($getNIPAtasan == $data['penilai_satu']) {
            $data['approval_satu'] = 'Revisi';
        } else if ($getNIPAtasan == $data['penilai_dua']) {
            $data['approval_dua'] = 'Revisi';
        }

        //MARK: Apabila Golongan 123
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
            "STAF OPERASIONAL SENIOR",
            "KEPALA BAGIAN TELLER DAN BACKOFFICE",
            "KEPALA BAGIAN OPERASIONAL",
            "KEPALA BAGIAN CUSTOMER SERVICE"
        );
        if (in_array($jabatan, $jabatan_kecakapan_kerja)) {
            $data['bobot_pengetahuan_jabatan']     = $this->request->getPost('bobot_pengetahuan_jabatan');
            $data['nilai_pengetahuan_jabatan']     = $this->request->getPost('nilai_pengetahuan_jabatan');
            $data['hasil_pengetahuan_jabatan']     = $this->request->getPost('hasil_pengetahuan_jabatan');
            $data['alasan_pengetahuan_jabatan']    = $this->request->getPost('alasan_pengetahuan_jabatan');
            $data['bobot_kualitas_kerja']          = $this->request->getPost('bobot_kualitas_kerja');
            $data['nilai_kualitas_kerja']          = $this->request->getPost('nilai_kualitas_kerja');
            $data['hasil_kualitas_kerja']          = $this->request->getPost('hasil_kualitas_kerja');
            $data['alasan_kualitas_kerja']         = $this->request->getPost('alasan_kualitas_kerja');
            $data['bobot_adaptasi']                = $this->request->getPost('bobot_adaptasi');
            $data['nilai_adaptasi']                = $this->request->getPost('nilai_adaptasi');
            $data['hasil_adaptasi']                = $this->request->getPost('hasil_adaptasi');
            $data['alasan_adaptasi']               = $this->request->getPost('alasan_adaptasi');
            $data['bobot_kemampuan_komunikasi']    = $this->request->getPost('bobot_kemampuan_komunikasi');
            $data['nilai_kemampuan_komunikasi']    = $this->request->getPost('nilai_kemampuan_komunikasi');
            $data['hasil_kemampuan_komunikasi']    = $this->request->getPost('hasil_kemampuan_komunikasi');
            $data['alasan_kemampuan_komunikasi']   = $this->request->getPost('alasan_kemampuan_komunikasi');
        }

        //MARK: Apabila Golongan 4S
        $jabatan_struktural = array(
            "KEPALA CABANG PEMBANTU",
            "KEPALA BAGIAN TELLER DAN BACKOFFICE",
            "KEPALA CABANG",
            "KEPALA ULS",
            "KEPALA BAGIAN OPERASIONAL",
            "KEPALA OPERASI CABANG",
            "KEPALA ULS ",
            "KEPALA BAGIAN CUSTOMER SERVICE",
            "KEPALA CABANG ",
        );

        if (in_array($jabatan, $jabatan_struktural)) {
            $data['bobot_mandiri']                  = $this->request->getPost('bobot_mandiri');
            $data['nilai_mandiri']                  = $this->request->getPost('nilai_mandiri');
            $data['hasil_mandiri']                  = $this->request->getPost('hasil_mandiri');
            $data['alasan_mandiri']                 = $this->request->getPost('alasan_mandiri');
            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = $this->request->getPost('hasil_kemampuan_manajerial');
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');
        }

        //JABATAN DENGAN SASARAN BISNIS HINGGA 1-5
        $jabatan_sarbis_reg = array(
            "KEPALA OPERASI CABANG",
            "KEPALA CABANG",
            "ACCOUNT OFFICER",
            "KEPALA CABANG PEMBANTU",
            "ASSOCIATE ACCOUNT OFFICER",
            "KEPALA ULS",
            "ASSISTANT ACCOUNT OFFICER",
        );
        if (in_array($jabatan, $jabatan_sarbis_reg)) {
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
        }

        //JABATAN DENGAN MAX. 6 SARBIS
        $jabatan_sarbis_med = array(
            "KEPALA CABANG",
            "KEPALA CABANG PEMBANTU",
            "ACCOUNT OFFICER",
            "ASSOCIATE ACCOUNT OFFICER",
            "ASSISTANT ACCOUNT OFFICER"
        );
        if (in_array($jabatan, $jabatan_sarbis_med)) {
            $data['uraian_sb6']         = $this->request->getPost('uraian_sb6');
            $data['realisasi_sb6']      = $this->request->getPost('realisasi_sb6');
            $data['bobot_sb6']          = $this->request->getPost('bobot_sb6');
            $data['nilai_sb6']          = $this->request->getPost('nilai_sb6');
            $data['hasil_sb6']          = $this->request->getPost('hasil_sb6');
        }

        //JABATAN DENGAN MAX. 8 SARBIS
        $jabatan_sarbis_full = array(
            "KEPALA CABANG",
            "KEPALA CABANG PEMBANTU"
        );
        if (in_array($jabatan, $jabatan_sarbis_full)) {
            $data['uraian_sb7']         = $this->request->getPost('uraian_sb7');
            $data['realisasi_sb7']      = $this->request->getPost('realisasi_sb7');
            $data['bobot_sb7']          = $this->request->getPost('bobot_sb7');
            $data['nilai_sb7']          = $this->request->getPost('nilai_sb7');
            $data['hasil_sb7']          = $this->request->getPost('hasil_sb7');

            $data['uraian_sb8']         = $this->request->getPost('uraian_sb8');
            $data['realisasi_sb8']      = $this->request->getPost('realisasi_sb8');
            $data['bobot_sb8']          = $this->request->getPost('bobot_sb8');
            $data['nilai_sb8']          = $this->request->getPost('nilai_sb8');
            $data['hasil_sb8']          = $this->request->getPost('hasil_sb8');
        }

        if ($jabatan == "KEPALA ULS") {
            $data['nilai_audit']        = $this->request->getPost('nilai_audit');
            $data['bobot_audit']        = $this->request->getPost('bobot_audit');
            $data['nilai_smart']        = $this->request->getPost('nilai_smart');
            $data['bobot_smart']        = $this->request->getPost('bobot_smart');
        }

        $jabatan_kepala = array(
            "KEPALA OPERASI CABANG",
            "KEPALA CABANG",
            "KEPALA CABANG PEMBANTU"
        );
        if (in_array($jabatan, $jabatan_kepala)) {
            $data['nilai_npf']          = $this->request->getPost('nilai_npf');
            $data['bobot_npf']          = $this->request->getPost('bobot_npf');
            $data['nilai_audit']        = $this->request->getPost('nilai_audit');
            $data['bobot_audit']        = $this->request->getPost('bobot_audit');
            $data['nilai_smart']        = $this->request->getPost('nilai_smart');
            $data['bobot_smart']        = $this->request->getPost('bobot_smart');
        }

        $jabatan_ao = array(
            "ACCOUNT OFFICER",
            "ASSOCIATE ACCOUNT OFFICER",
            "ASSISTANT ACCOUNT OFFICER"
        );
        if (in_array($jabatan, $jabatan_ao)) {
            $data['bobot_mandiri']                  = $this->request->getPost('bobot_mandiri');
            $data['nilai_mandiri']                  = $this->request->getPost('nilai_mandiri');
            $data['hasil_mandiri']                  = $this->request->getPost('hasil_mandiri');
            $data['alasan_mandiri']                 = $this->request->getPost('alasan_mandiri');
            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = $this->request->getPost('hasil_kemampuan_manajerial');
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');
            $data['nilai_npf']                      = $this->request->getPost('nilai_npf');
            $data['bobot_npf']                      = $this->request->getPost('bobot_npf');
            $data['nilai_audit']                    = $this->request->getPost('nilai_audit');
            $data['bobot_audit']                    = $this->request->getPost('bobot_audit');
            $data['nilai_dok']                      = $this->request->getPost('nilai_dok');
            $data['bobot_dok']                      = $this->request->getPost('bobot_dok');
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

        //MARK: HITUNG NILAI KECAKAPAN KERJA/SARBIS/NPF/AUDIT/SMART/PERILAKU BUDAYA
        if (in_array($jabatan, $jabatan_kecakapan_kerja)) {
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 1/2/3/4F
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];
            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja'] * $bobot_kecakapan_kerja;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 1/2/3/4F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;

            $data['total_hasil_pa'] = $data['hasil_kecakapan_kerja'] + $data['hasil_perilaku_budaya'];
        } else if (in_array($jabatan, $jabatan_struktural)) {
            if (empty($data['hasil_sb6'])) {
                $data['hasil_sb6'] = 0;
            }
            if (empty($data['hasil_sb7'])) {
                $data['hasil_sb7'] = 0;
            }
            if (empty($data['hasil_sb8'])) {
                $data['hasil_sb8'] = 0;
            }

            $jumlah_hasil_sarbis = (int)$data['hasil_sb1'] + (int)$data['hasil_sb2'] + (int)$data['hasil_sb3'] + (int)$data['hasil_sb4'] + (int)$data['hasil_sb5'] + (int)$data['hasil_sb6'] +  (int)$data['hasil_sb7'] + (int)$data['hasil_sb8'];

            //MARK: HITUNG PEMOTONGAN NILAI TERHADAP SARBIS
            if (empty($data['bobot_npf'])) {
                $data['bobot_npf'] = 0;
            }
            $data['total_sarbis'] = $jumlah_hasil_sarbis - $data['bobot_npf'] - $data['bobot_audit'] - $data['bobot_smart'];
            //MARK: HITUNG TOTAL NILAI SARBIS
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;

            //dd($data);

            //MARK: HITUNG NILAI PERILAKU BUDAYA
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;

            $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
        } else if (in_array($jabatan, $jabatan_ao)) {
            $jumlah_hasil_sarbis = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'];
            //MARK: HITUNG PEMOTONGAN NILAI TERHADAP SARBIS
            $data['total_sarbis'] = $jumlah_hasil_sarbis - $data['bobot_npf'] - $data['bobot_audit'] - $data['bobot_dok'];
            //MARK: HITUNG TOTAL NILAI SARBIS
            $data['hasil_sarbis'] = $data['total_sarbis'] * $bobot_sasaran_bisnis;

            //MARK: HITUNG NILAI PERILAKU BUDAYA
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];
            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya'] * $bobot_perilaku_budaya;

            $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
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

        if ($model->update($id_pn, $data)) {
            if (!empty($this->receiver_mail)) {
                $data['receiver_mail'] = $this->receiver_mail;
                $data['receiver_name'] = session()->get('fnama');
                $subject = 'Konfirmasi Penilaian Kinerja Pekerja';
                $message = view('mail-style\mail_evaluation_send', $data);
                $this->sendEmail($this->receiver_mail, $subject, $message);
            }

            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Formulir Penilaian Berhasil Dikirim dan Menunggu Persetujuan!');
            return redirect()->to("/penilaian/otorisasi");
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Terjadi Kesalahan Saat Mengirim Formulir PA!');
            return redirect()->to("/penilaian/otorisasi");
        }
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
