<?php

namespace App\Models;

use CodeIgniter\Model;

class Penilaian4f extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pn_kp_gol_4f';
    protected $primaryKey       = 'id_pn';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['tahun_pa', 'tgl_isi', 'id_user', 'penilai_satu', 'penilai_dua', 'approval_satu', 'approval_dua', 'bobot_pengetahuan_jabatan', 'nilai_pengetahuan_jabatan', 'hasil_pengetahuan_jabatan', 'alasan_pengetahuan_jabatan', 'bobot_kualitas_kerja', 'nilai_kualitas_kerja', 'hasil_kualitas_kerja', 'alasan_kualitas_kerja', 'bobot_adaptasi', 'nilai_adaptasi', 'hasil_adaptasi', 'alasan_adaptasi', 'bobot_kemampuan_komunikasi', 'nilai_kemampuan_komunikasi', 'hasil_kemampuan_komunikasi', 'alasan_kemampuan_komunikasi', 'total_kecakapan_kerja', 'hasil_kecakapan_kerja', 'bobot_kupel', 'nilai_kupel', 'hasil_kupel', 'alasan_kupel', 'bobot_disiplin', 'nilai_disiplin', 'hasil_disiplin', 'alasan_disiplin', 'bobot_inisiatif', 'nilai_inisiatif', 'hasil_inisiatif', 'alasan_inisiatif', 'bobot_integritas', 'nilai_integritas', 'hasil_integritas', 'alasan_integritas', 'bobot_kerjasama', 'nilai_kerjasama', 'hasil_kerjasama', 'alasan_kerjasama', 'bobot_mandiri', 'nilai_mandiri', 'hasil_mandiri', 'alasan_mandiri', 'total_perilaku_budaya', 'hasil_perilaku_budaya', 'hal_menonjol', 'hal_peningkatan', 'req_training', 'total_hasil_pa', 'angka_pa', 'huruf_pa'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
