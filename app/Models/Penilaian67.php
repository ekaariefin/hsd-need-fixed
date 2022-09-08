<?php

namespace App\Models;

use CodeIgniter\Model;

class Penilaian67 extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pn_kp_gol_67';
    protected $primaryKey       = 'id_pn';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['tgl_isi', 'tahun_pa', 'id_user', 'penilai_satu', 'penilai_dua', 'approval_satu', 'approval_dua', 'uraian_sb1', 'realisasi_sb1', 'bobot_sb1', 'nilai_sb1', 'hasil_sb1', 'uraian_sb2', 'realisasi_sb2', 'bobot_sb2', 'nilai_sb2', 'hasil_sb2', 'uraian_sb3', 'realisasi_sb3', 'bobot_sb3', 'nilai_sb3', 'hasil_sb3', 'uraian_sb4', 'realisasi_sb4', 'bobot_sb4', 'nilai_sb4', 'hasil_sb4', 'uraian_sb5', 'realisasi_sb5', 'bobot_sb5', 'nilai_sb5', 'hasil_sb5', 'uraian_sb6', 'realisasi_sb6', 'bobot_sb6', 'nilai_sb6', 'hasil_sb6', 'uraian_sb7', 'realisasi_sb7', 'bobot_sb7', 'nilai_sb7', 'hasil_sb7', 'total_sarbis', 'hasil_sarbis', 'bobot_kupel', 'nilai_kupel', 'hasil_kupel', 'alasan_kupel', 'bobot_disiplin', 'nilai_disiplin', 'hasil_disiplin', 'alasan_disiplin', 'bobot_inisiatif', 'nilai_inisiatif', 'hasil_inisiatif', 'alasan_inisiatif', 'bobot_integritas', 'nilai_integritas', 'hasil_integritas', 'alasan_integritas', 'bobot_kerjasama', 'nilai_kerjasama', 'hasil_kerjasama', 'alasan_kerjasama', 'bobot_mandiri', 'nilai_mandiri', 'hasil_mandiri', 'alasan_mandiri', 'bobot_kemampuan_manajerial', 'nilai_kemampuan_manajerial', 'hasil_kemampuan_manajerial', 'alasan_kemampuan_manajerial', 'total_perilaku_budaya', 'hasil_perilaku_budaya', 'hal_menonjol', 'hal_peningkatan', 'req_training', 'total_hasil_pa', 'angka_pa', 'huruf_pa'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
