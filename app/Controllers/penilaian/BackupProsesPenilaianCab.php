<?php

namespace App\Controllers\Penilaian;

use App\Controllers\BaseController;
use App\Models\PenilaianCab123;
use App\Models\PenilaianCab4s;
use App\Models\PenilaianCabAOReg;

class ProsesPenilaianCab extends BaseController
{
    public function add_gol_123(){
        $model = new PenilaianCab123();
        $data = array (
            'id_user' => session()->get('fnip'),
            'tgl_isi' => date('Y-m-d'),
            'penilai_satu' => $this->request->getPost('atasan1'),
            'penilai_dua' => $this->request->getPost('atasan2'),
            'bobot_pengetahuan_jabatan' => $this->request->getPost('bobot_pengetahuan_jabatan'),
            'nilai_pengetahuan_jabatan' => $this->request->getPost('nilai_pengetahuan_jabatan'),
            'hasil_pengetahuan_jabatan' => $this->request->getPost('hasil_pengetahuan_jabatan'),
            'alasan_pengetahuan_jabatan' => $this->request->getPost('alasan_pengetahuan_jabatan'),
            'bobot_kualitas_kerja' => $this->request->getPost('bobot_kualitas_kerja'),
            'nilai_kualitas_kerja' => $this->request->getPost('nilai_kualitas_kerja'),
            'hasil_kualitas_kerja' => $this->request->getPost('hasil_kualitas_kerja'),
            'alasan_kualitas_kerja' => $this->request->getPost('alasan_kualitas_kerja'),
            'bobot_adaptasi' => $this->request->getPost('bobot_adaptasi'), 
            'nilai_adaptasi' => $this->request->getPost('nilai_adaptasi'), 
            'hasil_adaptasi' => $this->request->getPost('hasil_adaptasi'),
            'alasan_adaptasi' => $this->request->getPost('alasan_adaptasi'),
            'bobot_kemampuan_komunikasi' => $this->request->getPost('bobot_kemampuan_komunikasi'),
            'nilai_kemampuan_komunikasi' => $this->request->getPost('nilai_kemampuan_komunikasi'),
            'hasil_kemampuan_komunikasi' => $this->request->getPost('hasil_kemampuan_komunikasi'),
            'alasan_kemampuan_komunikasi' => $this->request->getPost('alasan_kemampuan_komunikasi'),
            'bobot_kupel' => $this->request->getPost('bobot_kupel'),
            'nilai_kupel' => $this->request->getPost('nilai_kupel'),
            'hasil_kupel' => $this->request->getPost('hasil_kupel'),
            'alasan_kupel' => $this->request->getPost('alasan_kupel'),
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
            'jenis_sp' => $this->request->getPost('jenis_sp'),
            'no_sp' => $this->request->getPost('no_sp'),
            'tgl_sp' => $this->request->getPost('tgl_sp'),
            'perihal_sp' => $this->request->getPost('perihal_sp'),
            'hal_menonjol' => $this->request->getPost('hal_menonjol'),
            'hal_peningkatan' => $this->request->getPost('hal_peningkatan'),
            'req_training' => $this->request->getPost('req_training')
        );
        // count kecakapan kerja
        if(empty($data['penilai_dua']) OR $data['penilai_dua'] == NULL OR $data['penilai_dua'] == ''){ $data['penilai_dua'] = $data['penilai_satu']; }

        $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];
        $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja']*0.70;

        // count perilaku budaya
        $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];
        $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*0.30;

        $data['total_hasil_pa'] = $data['hasil_kecakapan_kerja'] + $data['hasil_perilaku_budaya'];
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
                window.location="'.base_url('riwayat-penilaian').'"
            </script>';
    }

    public function add_gol_4s(){
        $model = new PenilaianCab4s();
        $data = array (
            'id_user' => session()->get('fnip'),
            'tgl_isi' => date('Y-m-d'),
            'penilai_satu' => $this->request->getPost('atasan1'),
            'penilai_dua' => $this->request->getPost('atasan2'),
            'bobot_pengetahuan_jabatan' => $this->request->getPost('bobot_pengetahuan_jabatan'),
            'nilai_pengetahuan_jabatan' => $this->request->getPost('nilai_pengetahuan_jabatan'),
            'hasil_pengetahuan_jabatan' => $this->request->getPost('hasil_pengetahuan_jabatan'),
            'alasan_pengetahuan_jabatan' => $this->request->getPost('alasan_pengetahuan_jabatan'),
            'bobot_kualitas_kerja' => $this->request->getPost('bobot_kualitas_kerja'),
            'nilai_kualitas_kerja' => $this->request->getPost('nilai_kualitas_kerja'),
            'hasil_kualitas_kerja' => $this->request->getPost('hasil_kualitas_kerja'),
            'alasan_kualitas_kerja' => $this->request->getPost('alasan_kualitas_kerja'),
            'bobot_adaptasi' => $this->request->getPost('bobot_adaptasi'), 
            'nilai_adaptasi' => $this->request->getPost('nilai_adaptasi'), 
            'hasil_adaptasi' => $this->request->getPost('hasil_adaptasi'),
            'alasan_adaptasi' => $this->request->getPost('alasan_adaptasi'),
            'bobot_kemampuan_komunikasi' => $this->request->getPost('bobot_kemampuan_komunikasi'),
            'nilai_kemampuan_komunikasi' => $this->request->getPost('nilai_kemampuan_komunikasi'),
            'hasil_kemampuan_komunikasi' => $this->request->getPost('hasil_kemampuan_komunikasi'),
            'alasan_kemampuan_komunikasi' => $this->request->getPost('alasan_kemampuan_komunikasi'),
            'bobot_kupel' => $this->request->getPost('bobot_kupel'),
            'nilai_kupel' => $this->request->getPost('nilai_kupel'),
            'hasil_kupel' => $this->request->getPost('hasil_kupel'),
            'alasan_kupel' => $this->request->getPost('alasan_kupel'),
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
            'jenis_sp' => $this->request->getPost('jenis_sp'),
            'no_sp' => $this->request->getPost('no_sp'),
            'tgl_sp' => $this->request->getPost('tgl_sp'),
            'perihal_sp' => $this->request->getPost('perihal_sp'),
            'hal_menonjol' => $this->request->getPost('hal_menonjol'),
            'hal_peningkatan' => $this->request->getPost('hal_peningkatan'),
            'req_training' => $this->request->getPost('req_training')
        );
        // count kecakapan kerja
        if(empty($data['penilai_dua']) OR $data['penilai_dua'] == NULL OR $data['penilai_dua'] == ''){ $data['penilai_dua'] = $data['penilai_satu']; }

        $data['total_kecakapan_kerja'] = $data['hasil_pengetahuan_jabatan'] + $data['hasil_kualitas_kerja'] + $data['hasil_adaptasi'] + $data['hasil_kemampuan_komunikasi'];
        $data['hasil_kecakapan_kerja'] = $data['total_kecakapan_kerja']*0.70;

        // count perilaku budaya
        $data['total_perilaku_budaya'] = $data['hasil_kupel'] + $data['hasil_disiplin'] + $data['hasil_inisiatif'] + $data['hasil_integritas'] + $data['hasil_kerjasama'];
        $data['hasil_perilaku_budaya'] = $data['total_perilaku_budaya']*0.30;

        $data['total_hasil_pa'] = $data['hasil_kecakapan_kerja'] + $data['hasil_perilaku_budaya'];
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
                window.location="'.base_url('riwayat-penilaian').'"
            </script>';
    }

    public function add_ao_reguler(){
        $model = new PenilaianCabAOReg();
        $data = array (
            'id_user' => session()->get('fnip'),
            'tgl_isi' => date('Y-m-d'),
            'penilai_satu' => $this->request->getPost('atasan1'),
            'penilai_dua' => $this->request->getPost('atasan2'),

            'uraian_sb1' => $this->request->getPost('uraian_sb1'),
            'target_sb1' => $this->request->getPost('target_sb1'),
            'realisasi_sb1' => $this->request->getPost('realisasi_sb1'),
            'pencapaian_sb1' => $this->request->getPost('pencapaian_sb1'),
            'bobot_sb1' => $this->request->getPost('bobot_sb1'),
            'nilai_sb1' => $this->request->getPost('nilai_sb1'),
            'hasil_sb1' => $this->request->getPost('hasil_sb1'),

            'uraian_sb2' => $this->request->getPost('uraian_sb2'),
            'target_sb2' => $this->request->getPost('target_sb2'),
            'realisasi_sb2' => $this->request->getPost('realisasi_sb2'),
            'pencapaian_sb2' => $this->request->getPost('pencapaian_sb2'),
            'bobot_sb2' => $this->request->getPost('bobot_sb2'),
            'nilai_sb2' => $this->request->getPost('nilai_sb2'),
            'hasil_sb2' => $this->request->getPost('hasil_sb2'),

            'uraian_sb3' => $this->request->getPost('uraian_sb3'),
            'target_sb3' => $this->request->getPost('target_sb3'),
            'realisasi_sb3' => $this->request->getPost('realisasi_sb3'),
            'pencapaian_sb3' => $this->request->getPost('pencapaian_sb3'),
            'bobot_sb3' => $this->request->getPost('bobot_sb3'),
            'nilai_sb3' => $this->request->getPost('nilai_sb3'),
            'hasil_sb3' => $this->request->getPost('hasil_sb3'),

            'uraian_sb4' => $this->request->getPost('uraian_sb4'),
            'target_sb4' => $this->request->getPost('target_sb4'),
            'realisasi_sb4' => $this->request->getPost('realisasi_sb4'),
            'pencapaian_sb4' => $this->request->getPost('pencapaian_sb4'),
            'bobot_sb4' => $this->request->getPost('bobot_sb4'),
            'nilai_sb4' => $this->request->getPost('nilai_sb4'),
            'hasil_sb4' => $this->request->getPost('hasil_sb4'),

            'uraian_sb5' => $this->request->getPost('uraian_sb5'),
            'target_sb5' => $this->request->getPost('target_sb5'),
            'realisasi_sb5' => $this->request->getPost('realisasi_sb5'),
            'pencapaian_sb5' => $this->request->getPost('pencapaian_sb5'),
            'bobot_sb5' => $this->request->getPost('bobot_sb5'),
            'nilai_sb5' => $this->request->getPost('nilai_sb5'),
            'hasil_sb5' => $this->request->getPost('hasil_sb5'),

            'uraian_sb6' => $this->request->getPost('uraian_sb6'),
            'target_sb6' => $this->request->getPost('target_sb6'),
            'realisasi_sb6' => $this->request->getPost('realisasi_sb6'),
            'pencapaian_sb6' => $this->request->getPost('pencapaian_sb6'),
            'bobot_sb6' => $this->request->getPost('bobot_sb6'),
            'nilai_sb6' => $this->request->getPost('nilai_sb6'),
            'hasil_sb6' => $this->request->getPost('hasil_sb6'),

            // key performance indicator

            'nilai_npf_kpi' => $this->request->getPost('nilai_npf_kpi'),
            'nilai_audit_kpi' => $this->request->getPost('nilai_audit_kpi'),
            'nilai_dok_kpi' => $this->request->getPost('nilai_dok_kpi'),

            
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

        // NPF KPI
        if($data['nilai_npf_kpi'] >= '0.01'){
            $data['bobot_npf_kpi'] = '0.5';
        }
        else{
            $data['bobot_npf_kpi'] = '0';
        }

        // AUDIT KPI
        if($data['nilai_audit_kpi'] == 'Cukup Baik'){
            $data['bobot_audit_kpi'] = '0.25';
        }
        else if($data['nilai_audit_kpi'] == 'Kurang Baik'){
            $data['bobot_audit_kpi'] = '0.50';
        }
        else if($data['nilai_audit_kpi'] == 'Tidak Baik'){
            $data['bobot_audit_kpi'] = '0.50';
        }
        else {
            $data['bobot_audit_kpi'] = '0';
        }

        // DOK.KURANG KPI
        if(empty($data['nilai_dok_kpi']) OR $data['nilai_dok_kpi'] == ''){
            $data['bobot_dok_kpi'] = '0';
        }
        else{
            $data['bobot_dok_kpi'] = '0.50';
        }

        if(empty($data['penilai_dua']) OR $data['penilai_dua'] == NULL OR $data['penilai_dua'] == ''){ $data['penilai_dua'] = $data['penilai_satu']; }
        
        // count kecakapan kerja
        $data['total_sarbis'] = $data['hasil_sb1'] + $data['hasil_sb2'] + $data['hasil_sb3'] + $data['hasil_sb4'] + $data['hasil_sb5'] + $data['hasil_sb6'];

        // count pemotongan nilai
        $data['subtotal_sarbis'] = $data['total_sarbis'] - $data['bobot_npf_kpi'] - $data['bobot_audit_kpi'] - $data['bobot_dok_kpi'];

        $data['hasil_sarbis'] = $data['subtotal_sarbis']*0.70;

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
                window.location="'.base_url('riwayat-penilaian').'"
            </script>';
    }
}
?>