<?php

namespace App\Models\Otorisasi;

use CodeIgniter\Model;

class OtorisasiCab extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pekerja';

    public function getOtorisasi($fnip){
        $query   = $this->db->query("SELECT id_pn, tgl_isi, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' ; ");
        return $query->getResultArray();
    }

    public function getDetail123($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }

    public function getDetail4s($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }
}

?>