<?php
// MARK: Definisi/Import Controller
namespace App\Controllers;
namespace App\Controllers\Penilaian;
use App\Controllers\BaseController;

// MARK: Definisi Model Penilaian PA Kantor Pusat
use App\Models\Penilaian123;
use App\Models\Penilaian4f;
use App\Models\Penilaian4s;
use App\Models\Penilaian5f;
use App\Models\Penilaian5s;
use App\Models\Penilaian67;


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
	}

    //MARK: Fungsi Untuk Menghitung Nilai PA
    public function tambahPenilaian($golongan){

        //MARK: Memanggil Model Penilaian Golongan 1/2/3/4F/4S (KECAKAPAN KERJA + PERILAKU BUDAYA)
        if($golongan == '123'){
            $model = new Penilaian123();
        }
        else if ($golongan == '4F'){
            $model = new Penilaian4f();
        }
        else if ($golongan == '4S'){
            $model = new Penilaian4s();
        }
        else if ($golongan == '5F'){
            $model = new Penilaian5f();
        }
        else if ($golongan == '5S'){
            $model = new Penilaian5s();
        }
        else if ($golongan == '67'){
            $model = new Penilaian67();
        }
        
        //MARK: Definisi Data dalam bentuk Array untuk Input ke Database

        //MARK: Data Default + Perilaku Budaya Default
        $data = array (
            'id_user'                       => session()->get('fnip'),
            'tahun_pa'                      => date('Y'),
            'tgl_isi'                       => date('d M Y'),
            'penilai_satu'                  => $this->request->getPost('atasan1'),
            'penilai_dua'                   => $this->request->getPost('atasan2'),
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

        //MARK: Apabila Golongan 1/2/3/4F/4S Maka Tambahkan Penilaian Kecakapan Kerja
        if($golongan == '123' OR $golongan == '4F' OR $golongan == '4S'){
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
        
        //MARK: Apabila Golongan 4F dan 4S Maka Tambahkan Penilaian Berikut:
        if($golongan == '4F' OR $golongan == '4S'){
            $data['bobot_mandiri']  = $this->request->getPost('bobot_mandiri');
            $data['nilai_mandiri']  = $this->request->getPost('nilai_mandiri');
            $data['hasil_mandiri']  = $this->request->getPost('hasil_mandiri');
            $data['alasan_mandiri'] = $this->request->getPost('alasan_mandiri');
        }
        
        //MARK: Apabila Golongan 4S Maka Tambahkan Penilaian Berikut:
        if($golongan == '4S'){
            $data['bobot_kemampuan_manajerial']  = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']  = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']  = $this->request->getPost('hasil_kemampuan_manajerial');
            $data['alasan_kemampuan_manajerial'] = $this->request->getPost('alasan_kemampuan_manajerial');
        }

        //MARK: Apabila Golongan 5F/5S maka tambahkan aspek Penilaian SASARAN BISNIS DAN KINERJA
        if($golongan == '5F' OR $golongan == '5S' OR $golongan == '67'){
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
        if($golongan == '5S' OR $golongan == '67'){
            $data['bobot_kemampuan_manajerial']     = $this->request->getPost('bobot_kemampuan_manajerial');
            $data['nilai_kemampuan_manajerial']     = $this->request->getPost('nilai_kemampuan_manajerial');
            $data['hasil_kemampuan_manajerial']     = $this->request->getPost('hasil_kemampuan_manajerial');
            $data['alasan_kemampuan_manajerial']    = $this->request->getPost('alasan_kemampuan_manajerial');
        }

        //MARK: Pengecekan Data Atasan Kedua (Second Supervisor)
        if(empty($data['penilai_dua']) OR $data['penilai_dua'] == NULL OR $data['penilai_dua'] == '')
        { 
            $data['penilai_dua'] = $data['penilai_satu']; 
        }

        
        //MARK: Define Nilai Bobot Akhir
        $bobot_kecakapan_kerja = 0.70;
        $bobot_sasaran_bisnis = 0.70;
        $bobot_perilaku_budaya = 0.30;

        
        if($golongan == '123' OR $golongan == '4F'){
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 1/2/3/4F
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];

            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja']*$bobot_kecakapan_kerja;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 1/2/3/4F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];

            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*$bobot_perilaku_budaya;
        }
        else if ($golongan == '4S'){
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 4S
            $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];

            $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja']*$bobot_kecakapan_kerja;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 4S
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];

            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*$bobot_perilaku_budaya;
        }
        else if ($golongan == '5F'){
            //MARK: Logic untuk menghitung Nilai Sasaran Bisnis dan Kinerja Golongan 5F
            $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];

            $data['hasil_sarbis'] = $data['total_sarbis']*$bobot_sasaran_bisnis;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 5F
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'];

            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*$bobot_perilaku_budaya;
        }
        else if ($golongan == '5S' OR $golongan == '67'){
            //MARK: Logic untuk menghitung Nilai Kecakapan Kerja Golongan 5S/67
            $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];

            $data['hasil_sarbis'] = $data['total_sarbis']*$bobot_sasaran_bisnis;

            //MARK: Logic untuk menghitung Nilai Perilaku Budaya Golongan 5S/67
            $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];

            $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*$bobot_perilaku_budaya;
        }
        else {
            echo '<script>
                    alert("Undefinied Level! Gagal Menambahkan Penilaian")
                    window.location="'.base_url('penilaian/riwayat').'"
                </script>';
        }

        //MARK: Logic untuk menghitung Nilai Total Kecakapan Kerja dan Perilaku Budaya
        $data['total_hasil_pa'] = $data['hasil_kecakapan_kerja'] + $data['hasil_perilaku_budaya'];
        
        //MARK: Mendapatkan Nilai SP
        $poin_sp = $this->request->getPost('poin_sp');

        //MARK: Proses Pengurangan Nilai PA
        $data['angka_pa'] = $data['total_hasil_pa'] - $poin_sp;
        
        //MARK: Menerjemahkan Nilai PA kedalam bentuk Huruf
        if ($data['angka_pa'] <= 1.5){
            $data['huruf_pa'] = 'D';
        }
        else if ($data['angka_pa']<= 2.5){
            $data['huruf_pa'] = 'C';
        }
        else if ($data['angka_pa'] <= 3.5){
            $data['huruf_pa'] = 'B';
        }
        else{
            $data['huruf_pa'] = 'A';
        }

        // dd($data);
        
        //MARK: Proses Menambahkan Data ke Database
        if($model->tambahData($data))
        {
            //MARK: Mengirimkan Email Konfirmasi
            //MARK: Load View to Mail Message
            //$message = '';

            //MARK: Send Email
            $this->sendEmail($this->receiver_mail, 'Konfirmasi Penilaian Kinerja Karyawan', 'Terima Kasih sudah mengirimkan penilaian PA Tahun 2022');
            echo '<script>
                    alert("Sukses Menambahkan Data Penilaian")
                    window.location="'.base_url('penilaian/riwayat').'"
                </script>';
        }
    }

    //--------------------------------------------------------
    //BATAS AKHIR REVITALISASI CODING
    //--------------------------------------------------------


    public function add_gol_5f(){
        $model = new Penilaian5f();
        $data = array (
            'id_user' => session()->get('fnip'),
            'tgl_isi' => date('Y-m-d'),
            'penilai_satu' => $this->request->getPost('atasan1'),
            'penilai_dua' => $this->request->getPost('atasan2'),

            'uraian_sb1' => $this->request->getPost('uraian_sb1'),
            'realisasi_sb1' => $this->request->getPost('realisasi_sb1'),
            'bobot_sb1' => $this->request->getPost('bobot_sb1'),
            'nilai_sb1' => $this->request->getPost('nilai_sb1'),
            'hasil_sb1' => $this->request->getPost('hasil_sb1'),

            'uraian_sb2' => $this->request->getPost('uraian_sb2'),
            'realisasi_sb2' => $this->request->getPost('realisasi_sb2'),
            'bobot_sb2' => $this->request->getPost('bobot_sb2'),
            'nilai_sb2' => $this->request->getPost('nilai_sb2'),
            'hasil_sb2' => $this->request->getPost('hasil_sb2'),

            'uraian_sb3' => $this->request->getPost('uraian_sb3'),
            'realisasi_sb3' => $this->request->getPost('realisasi_sb3'),
            'bobot_sb3' => $this->request->getPost('bobot_sb3'),
            'nilai_sb3' => $this->request->getPost('nilai_sb3'),
            'hasil_sb3' => $this->request->getPost('hasil_sb3'),

            'uraian_sb4' => $this->request->getPost('uraian_sb4'),
            'realisasi_sb4' => $this->request->getPost('realisasi_sb4'),
            'bobot_sb4' => $this->request->getPost('bobot_sb4'),
            'nilai_sb4' => $this->request->getPost('nilai_sb4'),
            'hasil_sb4' => $this->request->getPost('hasil_sb4'),

            'uraian_sb5' => $this->request->getPost('uraian_sb5'),
            'realisasi_sb5' => $this->request->getPost('realisasi_sb5'),
            'bobot_sb5' => $this->request->getPost('bobot_sb5'),
            'nilai_sb5' => $this->request->getPost('nilai_sb5'),
            'hasil_sb5' => $this->request->getPost('hasil_sb5'),

            'uraian_sb6' => $this->request->getPost('uraian_sb6'),
            'realisasi_sb6' => $this->request->getPost('realisasi_sb6'),
            'bobot_sb6' => $this->request->getPost('bobot_sb6'),
            'nilai_sb6' => $this->request->getPost('nilai_sb6'),
            'hasil_sb6' => $this->request->getPost('hasil_sb6'),

            'uraian_sb7' => $this->request->getPost('uraian_sb7'),
            'realisasi_sb7' => $this->request->getPost('realisasi_sb7'),
            'bobot_sb7' => $this->request->getPost('bobot_sb7'),
            'nilai_sb7' => $this->request->getPost('nilai_sb7'),
            'hasil_sb7' => $this->request->getPost('hasil_sb7'),

            'bobot_kualitas_pelayanan' => $this->request->getPost('bobot_kualitas_pelayanan'),
            'nilai_kualitas_pelayanan' => $this->request->getPost('nilai_kualitas_pelayanan'),
            'hasil_kualitas_pelayanan' => $this->request->getPost('hasil_kualitas_pelayanan'),
            'alasan_kualitas_pelayanan' => $this->request->getPost('alasan_kualitas_pelayanan'),
            'bobot_disiplin' => $this->request->getPost('bobot_disiplin'),
            'nilai_disiplin' => $this->request->getPost('nilai_disiplin'),
            'hasil_disiplin' => $this->request->getPost('hasil_disiplin'),
            'alasan_disiplin' => $this->request->getPost('alasan_disiplin'),
            'bobot_inisiatif' => $this->request->getPost('bobot_inisiatif'),
            'nilai_inisiatif' => $this->request->getPost('nilai_inisiatif'),
            'hasil_inisiatif' => $this->request->getPost('hasil_inisiatif'),
            'alasan_inisiatif' => $this->request->getPost('alasan_inisiatif'),
            'bobot_integritas' => $this->request->getPost('bobot_integritas'),
            'nilai_integritas' => $this->request->getPost('nilai_integritas'),
            'hasil_integritas' => $this->request->getPost('hasil_integritas'),
            'alasan_integritas' => $this->request->getPost('alasan_integritas'),
            'bobot_kerjasama' => $this->request->getPost('bobot_kerjasama'),
            'nilai_kerjasama' => $this->request->getPost('nilai_kerjasama'),
            'hasil_kerjasama' => $this->request->getPost('hasil_kerjasama'),
            'alasan_kerjasama' => $this->request->getPost('alasan_kerjasama'),
            'bobot_mandiri' => $this->request->getPost('bobot_mandiri'),
            'nilai_mandiri' => $this->request->getPost('nilai_mandiri'),
            'hasil_mandiri' => $this->request->getPost('hasil_mandiri'),
            'alasan_mandiri' => $this->request->getPost('alasan_mandiri'),
            'jenis_sp' => $this->request->getPost('jenis_sp'),
            'no_sp' => $this->request->getPost('no_sp'),
            'tgl_sp' => $this->request->getPost('tgl_sp'),
            'perihal_sp' => $this->request->getPost('perihal_sp'),
            'hal_menonjol' => $this->request->getPost('hal_menonjol'),
            'hal_peningkatan' => $this->request->getPost('hal_peningkatan'),
            'req_training' => $this->request->getPost('req_training')
        );
        if(empty($data['penilai_dua']) OR $data['penilai_dua'] == NULL OR $data['penilai_dua'] == ''){ $data['penilai_dua'] = $data['penilai_satu']; }
        // count kecakapan kerja
        if(empty($data['hasil_sb3']) OR $data['hasil_sb3'] == NULL OR $data['hasil_sb3'] == ''){ $data['hasil_sb3'] = '0'; }
        if(empty($data['hasil_sb4']) OR $data['hasil_sb4'] == NULL OR $data['hasil_sb4'] == ''){ $data['hasil_sb4'] = '0'; }
        if(empty($data['hasil_sb5']) OR $data['hasil_sb5'] == NULL OR $data['hasil_sb5'] == ''){ $data['hasil_sb5'] = '0'; }
        if(empty($data['hasil_sb6']) OR $data['hasil_sb6'] == NULL OR $data['hasil_sb6'] == ''){ $data['hasil_sb6'] = '0'; }
        if(empty($data['hasil_sb7']) OR $data['hasil_sb7'] == NULL OR $data['hasil_sb7'] == ''){ $data['hasil_sb7'] = '0'; }

        $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];

        $data['hasil_sarbis'] = $data['total_sarbis']*0.70;

        // count perilaku budaya
        $data['total_perilaku_budaya'] = $data['hasil_kualitas_pelayanan'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'];

        $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*0.30;

        $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
        // SP
        if($data['jenis_sp'] == '1'){
            $data['poin_sp'] = '0.5';
        }
        else if($data['jenis_sp'] == '2'){
            $data['poin_sp'] = '1';
        }
        else if($data['jenis_sp'] == '3'){
            $data['poin_sp'] = '1.5';
        }
        else{
            $data['poin_sp'] = '0';
        }

        $data['angka_pa'] = $data['total_hasil_pa'] - $data['poin_sp'];
        
        if ($data['angka_pa'] <= 1.5){
            $data['huruf_pa'] = 'D';
        }
        else if ($data['angka_pa']<= 2.5){
            $data['huruf_pa'] = 'C';
        }
        else if ($data['angka_pa'] <= 3.5){
            $data['huruf_pa'] = 'B';
        }
        else{
            $data['huruf_pa'] = 'A';
        }

        $model->tambahData($data);
        echo '<script>
                alert("Sukses Menambahkan Data Penilaian")
                window.location="'.base_url('penilaian/riwayat').'"
            </script>';
    }

    public function add_gol_5s(){
        $model = new Penilaian5s();
        $data = array (
            'id_user' => session()->get('fnip'),
            'tgl_isi' => date('Y-m-d'),
            'penilai_satu' => $this->request->getPost('atasan1'),
            'penilai_dua' => $this->request->getPost('atasan2'),

            'uraian_sb1' => $this->request->getPost('uraian_sb1'),
            'realisasi_sb1' => $this->request->getPost('realisasi_sb1'),
            'bobot_sb1' => $this->request->getPost('bobot_sb1'),
            'nilai_sb1' => $this->request->getPost('nilai_sb1'),
            'hasil_sb1' => $this->request->getPost('hasil_sb1'),

            'uraian_sb2' => $this->request->getPost('uraian_sb2'),
            'realisasi_sb2' => $this->request->getPost('realisasi_sb2'),
            'bobot_sb2' => $this->request->getPost('bobot_sb2'),
            'nilai_sb2' => $this->request->getPost('nilai_sb2'),
            'hasil_sb2' => $this->request->getPost('hasil_sb2'),

            'uraian_sb3' => $this->request->getPost('uraian_sb3'),
            'realisasi_sb3' => $this->request->getPost('realisasi_sb3'),
            'bobot_sb3' => $this->request->getPost('bobot_sb3'),
            'nilai_sb3' => $this->request->getPost('nilai_sb3'),
            'hasil_sb3' => $this->request->getPost('hasil_sb3'),

            'uraian_sb4' => $this->request->getPost('uraian_sb4'),
            'realisasi_sb4' => $this->request->getPost('realisasi_sb4'),
            'bobot_sb4' => $this->request->getPost('bobot_sb4'),
            'nilai_sb4' => $this->request->getPost('nilai_sb4'),
            'hasil_sb4' => $this->request->getPost('hasil_sb4'),

            'uraian_sb5' => $this->request->getPost('uraian_sb5'),
            'realisasi_sb5' => $this->request->getPost('realisasi_sb5'),
            'bobot_sb5' => $this->request->getPost('bobot_sb5'),
            'nilai_sb5' => $this->request->getPost('nilai_sb5'),
            'hasil_sb5' => $this->request->getPost('hasil_sb5'),

            'uraian_sb6' => $this->request->getPost('uraian_sb6'),
            'realisasi_sb6' => $this->request->getPost('realisasi_sb6'),
            'bobot_sb6' => $this->request->getPost('bobot_sb6'),
            'nilai_sb6' => $this->request->getPost('nilai_sb6'),
            'hasil_sb6' => $this->request->getPost('hasil_sb6'),

            'uraian_sb7' => $this->request->getPost('uraian_sb7'),
            'realisasi_sb7' => $this->request->getPost('realisasi_sb7'),
            'bobot_sb7' => $this->request->getPost('bobot_sb7'),
            'nilai_sb7' => $this->request->getPost('nilai_sb7'),
            'hasil_sb7' => $this->request->getPost('hasil_sb7'),

            'bobot_kualitas_pelayanan' => $this->request->getPost('bobot_kualitas_pelayanan'),
            'nilai_kualitas_pelayanan' => $this->request->getPost('nilai_kualitas_pelayanan'),
            'hasil_kualitas_pelayanan' => $this->request->getPost('hasil_kualitas_pelayanan'),
            'alasan_kualitas_pelayanan' => $this->request->getPost('alasan_kualitas_pelayanan'),
            'bobot_disiplin' => $this->request->getPost('bobot_disiplin'),
            'nilai_disiplin' => $this->request->getPost('nilai_disiplin'),
            'hasil_disiplin' => $this->request->getPost('hasil_disiplin'),
            'alasan_disiplin' => $this->request->getPost('alasan_disiplin'),
            'bobot_inisiatif' => $this->request->getPost('bobot_inisiatif'),
            'nilai_inisiatif' => $this->request->getPost('nilai_inisiatif'),
            'hasil_inisiatif' => $this->request->getPost('hasil_inisiatif'),
            'alasan_inisiatif' => $this->request->getPost('alasan_inisiatif'),
            'bobot_integritas' => $this->request->getPost('bobot_integritas'),
            'nilai_integritas' => $this->request->getPost('nilai_integritas'),
            'hasil_integritas' => $this->request->getPost('hasil_integritas'),
            'alasan_integritas' => $this->request->getPost('alasan_integritas'),
            'bobot_kerjasama' => $this->request->getPost('bobot_kerjasama'),
            'nilai_kerjasama' => $this->request->getPost('nilai_kerjasama'),
            'hasil_kerjasama' => $this->request->getPost('hasil_kerjasama'),
            'alasan_kerjasama' => $this->request->getPost('alasan_kerjasama'),
            'bobot_mandiri' => $this->request->getPost('bobot_mandiri'),
            'nilai_mandiri' => $this->request->getPost('nilai_mandiri'),
            'hasil_mandiri' => $this->request->getPost('hasil_mandiri'),
            'alasan_mandiri' => $this->request->getPost('alasan_mandiri'),
            'bobot_kemampuan_manajerial' => $this->request->getPost('bobot_kemampuan_manajerial'),
            'nilai_kemampuan_manajerial' => $this->request->getPost('nilai_kemampuan_manajerial'),
            'hasil_kemampuan_manajerial' => $this->request->getPost('hasil_kemampuan_manajerial'),
            'alasan_kemampuan_manajerial' => $this->request->getPost('alasan_kemampuan_manajerial'),
            'jenis_sp' => $this->request->getPost('jenis_sp'),
            'no_sp' => $this->request->getPost('no_sp'),
            'tgl_sp' => $this->request->getPost('tgl_sp'),
            'perihal_sp' => $this->request->getPost('perihal_sp'),
            'hal_menonjol' => $this->request->getPost('hal_menonjol'),
            'hal_peningkatan' => $this->request->getPost('hal_peningkatan'),
            'req_training' => $this->request->getPost('req_training')
        );
        if(empty($data['penilai_dua']) OR $data['penilai_dua'] == NULL OR $data['penilai_dua'] == ''){ $data['penilai_dua'] = $data['penilai_satu']; }
        // count kecakapan kerja
        if(empty($data['hasil_sb3']) OR $data['hasil_sb3'] == NULL OR $data['hasil_sb3'] == ''){ $data['hasil_sb3'] = '0'; }
        if(empty($data['hasil_sb4']) OR $data['hasil_sb4'] == NULL OR $data['hasil_sb4'] == ''){ $data['hasil_sb4'] = '0'; }
        if(empty($data['hasil_sb5']) OR $data['hasil_sb5'] == NULL OR $data['hasil_sb5'] == ''){ $data['hasil_sb5'] = '0'; }
        if(empty($data['hasil_sb6']) OR $data['hasil_sb6'] == NULL OR $data['hasil_sb6'] == ''){ $data['hasil_sb6'] = '0'; }
        if(empty($data['hasil_sb7']) OR $data['hasil_sb7'] == NULL OR $data['hasil_sb7'] == ''){ $data['hasil_sb7'] = '0'; }
        
        $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];

        $data['hasil_sarbis'] = $data['total_sarbis']*0.70;

        // count perilaku budaya
        $data['total_perilaku_budaya'] = $data['hasil_kualitas_pelayanan'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];

        $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*0.30;

        $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];
        // SP
        if($data['jenis_sp'] == '1'){
            $data['poin_sp'] = '0.5';
        }
        else if($data['jenis_sp'] == '2'){
            $data['poin_sp'] = '1';
        }
        else if($data['jenis_sp'] == '3'){
            $data['poin_sp'] = '1.5';
        }
        else{
            $data['poin_sp'] = '0';
        }

        $data['angka_pa'] = $data['total_hasil_pa'] - $data['poin_sp'];
        
        if ($data['angka_pa'] <= 1.5){
            $data['huruf_pa'] = 'D';
        }
        else if ($data['angka_pa']<= 2.5){
            $data['huruf_pa'] = 'C';
        }
        else if ($data['angka_pa'] <= 3.5){
            $data['huruf_pa'] = 'B';
        }
        else{
            $data['huruf_pa'] = 'A';
        }

        $model->tambahData($data);
        echo '<script>
                alert("Sukses Menambahkan Data Penilaian")
                window.location="'.base_url('penilaian/riwayat').'"
            </script>';
    }

    public function add_gol_67(){
        $model = new Penilaian67();
        $data = array (
            'id_user' => session()->get('fnip'),
            'tgl_isi' => date('Y-m-d'),
            'penilai_satu' => $this->request->getPost('atasan1'),
            'penilai_dua' => $this->request->getPost('atasan2'),

            'uraian_sb1' => $this->request->getPost('uraian_sb1'),
            'realisasi_sb1' => $this->request->getPost('realisasi_sb1'),
            'bobot_sb1' => $this->request->getPost('bobot_sb1'),
            'nilai_sb1' => $this->request->getPost('nilai_sb1'),
            'hasil_sb1' => $this->request->getPost('hasil_sb1'),

            'uraian_sb2' => $this->request->getPost('uraian_sb2'),
            'realisasi_sb2' => $this->request->getPost('realisasi_sb2'),
            'bobot_sb2' => $this->request->getPost('bobot_sb2'),
            'nilai_sb2' => $this->request->getPost('nilai_sb2'),
            'hasil_sb2' => $this->request->getPost('hasil_sb2'),

            'uraian_sb3' => $this->request->getPost('uraian_sb3'),
            'realisasi_sb3' => $this->request->getPost('realisasi_sb3'),
            'bobot_sb3' => $this->request->getPost('bobot_sb3'),
            'nilai_sb3' => $this->request->getPost('nilai_sb3'),
            'hasil_sb3' => $this->request->getPost('hasil_sb3'),

            'uraian_sb4' => $this->request->getPost('uraian_sb4'),
            'realisasi_sb4' => $this->request->getPost('realisasi_sb4'),
            'bobot_sb4' => $this->request->getPost('bobot_sb4'),
            'nilai_sb4' => $this->request->getPost('nilai_sb4'),
            'hasil_sb4' => $this->request->getPost('hasil_sb4'),

            'uraian_sb5' => $this->request->getPost('uraian_sb5'),
            'realisasi_sb5' => $this->request->getPost('realisasi_sb5'),
            'bobot_sb5' => $this->request->getPost('bobot_sb5'),
            'nilai_sb5' => $this->request->getPost('nilai_sb5'),
            'hasil_sb5' => $this->request->getPost('hasil_sb5'),

            'uraian_sb6' => $this->request->getPost('uraian_sb6'),
            'realisasi_sb6' => $this->request->getPost('realisasi_sb6'),
            'bobot_sb6' => $this->request->getPost('bobot_sb6'),
            'nilai_sb6' => $this->request->getPost('nilai_sb6'),
            'hasil_sb6' => $this->request->getPost('hasil_sb6'),

            'uraian_sb7' => $this->request->getPost('uraian_sb7'),
            'realisasi_sb7' => $this->request->getPost('realisasi_sb7'),
            'bobot_sb7' => $this->request->getPost('bobot_sb7'),
            'nilai_sb7' => $this->request->getPost('nilai_sb7'),
            'hasil_sb7' => $this->request->getPost('hasil_sb7'),

            'bobot_kualitas_pelayanan' => $this->request->getPost('bobot_kualitas_pelayanan'),
            'nilai_kualitas_pelayanan' => $this->request->getPost('nilai_kualitas_pelayanan'),
            'hasil_kualitas_pelayanan' => $this->request->getPost('hasil_kualitas_pelayanan'),
            'alasan_kualitas_pelayanan' => $this->request->getPost('alasan_kualitas_pelayanan'),
            'bobot_disiplin' => $this->request->getPost('bobot_disiplin'),
            'nilai_disiplin' => $this->request->getPost('nilai_disiplin'),
            'hasil_disiplin' => $this->request->getPost('hasil_disiplin'),
            'alasan_disiplin' => $this->request->getPost('alasan_disiplin'),
            'bobot_inisiatif' => $this->request->getPost('bobot_inisiatif'),
            'nilai_inisiatif' => $this->request->getPost('nilai_inisiatif'),
            'hasil_inisiatif' => $this->request->getPost('hasil_inisiatif'),
            'alasan_inisiatif' => $this->request->getPost('alasan_inisiatif'),
            'bobot_integritas' => $this->request->getPost('bobot_integritas'),
            'nilai_integritas' => $this->request->getPost('nilai_integritas'),
            'hasil_integritas' => $this->request->getPost('hasil_integritas'),
            'alasan_integritas' => $this->request->getPost('alasan_integritas'),
            'bobot_kerjasama' => $this->request->getPost('bobot_kerjasama'),
            'nilai_kerjasama' => $this->request->getPost('nilai_kerjasama'),
            'hasil_kerjasama' => $this->request->getPost('hasil_kerjasama'),
            'alasan_kerjasama' => $this->request->getPost('alasan_kerjasama'),
            'bobot_mandiri' => $this->request->getPost('bobot_mandiri'),
            'nilai_mandiri' => $this->request->getPost('nilai_mandiri'),
            'hasil_mandiri' => $this->request->getPost('hasil_mandiri'),
            'alasan_mandiri' => $this->request->getPost('alasan_mandiri'),
            'bobot_kemampuan_manajerial' => $this->request->getPost('bobot_kemampuan_manajerial'),
            'nilai_kemampuan_manajerial' => $this->request->getPost('nilai_kemampuan_manajerial'),
            'hasil_kemampuan_manajerial' => $this->request->getPost('hasil_kemampuan_manajerial'),
            'alasan_kemampuan_manajerial' => $this->request->getPost('alasan_kemampuan_manajerial'),
            'jenis_sp' => $this->request->getPost('jenis_sp'),
            'no_sp' => $this->request->getPost('no_sp'),
            'tgl_sp' => $this->request->getPost('tgl_sp'),
            'perihal_sp' => $this->request->getPost('perihal_sp'),
            'hal_menonjol' => $this->request->getPost('hal_menonjol'),
            'hal_peningkatan' => $this->request->getPost('hal_peningkatan'),
            'req_training' => $this->request->getPost('req_training')
        );
        if(empty($data['penilai_dua']) OR $data['penilai_dua'] == NULL OR $data['penilai_dua'] == ''){ $data['penilai_dua'] = $data['penilai_satu']; }
        // count kecakapan kerja
        if(empty($data['hasil_sb3']) OR $data['hasil_sb3'] == NULL OR $data['hasil_sb3'] == ''){ $data['hasil_sb3'] = '0'; }
        if(empty($data['hasil_sb4']) OR $data['hasil_sb4'] == NULL OR $data['hasil_sb4'] == ''){ $data['hasil_sb4'] = '0'; }
        if(empty($data['hasil_sb5']) OR $data['hasil_sb5'] == NULL OR $data['hasil_sb5'] == ''){ $data['hasil_sb5'] = '0'; }
        if(empty($data['hasil_sb6']) OR $data['hasil_sb6'] == NULL OR $data['hasil_sb6'] == ''){ $data['hasil_sb6'] = '0'; }
        if(empty($data['hasil_sb7']) OR $data['hasil_sb7'] == NULL OR $data['hasil_sb7'] == ''){ $data['hasil_sb7'] = '0'; }
        $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'] + $data['hasil_sb7'];

        $data['hasil_sarbis'] = $data['total_sarbis']*0.70;

        // count perilaku budaya
        $data['total_perilaku_budaya'] = $data['hasil_kualitas_pelayanan'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'] + $data['hasil_mandiri'] + $data['hasil_kemampuan_manajerial'];

        $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*0.30;

        $data['total_hasil_pa'] = $data['hasil_sarbis'] + $data['hasil_perilaku_budaya'];

        // SP
        if($data['jenis_sp'] == '1'){
            $data['poin_sp'] = '0.5';
        }
        else if($data['jenis_sp'] == '2'){
            $data['poin_sp'] = '1';
        }
        else if($data['jenis_sp'] == '3'){
            $data['poin_sp'] = '1.5';
        }
        else{
            $data['poin_sp'] = '0';
        }

        $data['angka_pa'] = $data['total_hasil_pa'] - $data['poin_sp'];
        
        if ($data['angka_pa'] <= 1.5){
            $data['huruf_pa'] = 'D';
        }
        else if ($data['angka_pa']<= 2.5){
            $data['huruf_pa'] = 'C';
        }
        else if ($data['angka_pa'] <= 3.5){
            $data['huruf_pa'] = 'B';
        }
        else{
            $data['huruf_pa'] = 'A';
        }

        $model->tambahData($data);
        echo '<script>
                alert("Sukses Menambahkan Data Penilaian")
                window.location="'.base_url('penilaian/riwayat').'"
            </script>';
    }

    //MARK: SEND-MAIL TESTING ONLY
    public function sendMail(){
        $message = view('mail-style\mail_evaluation_approval');
        $this->sendEmail('ekaariefin@gmail.com', 'Konfirmasi Penilaian Kinerja Karyawan', $message);
    }

    //MARK: MAIL CONFIGURATION
    //MARK: DO NOT CHANGE
    public function sendEmail($to, $title, $message)
	{
		$this->email->setFrom('noreply.bcas@gmail.com','PT Bank BCA Syariah');
		$this->email->setTo($to);
		$this->email->setSubject($title);
		$this->email->setMessage($message);

		if(!$this->email->send()){
			return false;
		}else{
			return true;
		}

	}
}