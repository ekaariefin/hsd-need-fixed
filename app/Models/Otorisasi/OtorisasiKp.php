<?php

namespace App\Models\Otorisasi;

use CodeIgniter\Model;

class OtorisasiKp extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pekerja';

    public function getOtorisasi($fnip){
        $query   = $this->db->query("SELECT id_pn, tgl_isi, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'; ");
        return $query->getResultArray();
    }

    public function getDetail123($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }

    public function getDetail4f($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }

    public function getDetail4s($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }

    public function getDetail5f($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }

    public function getDetail5s($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }
    
    public function getDetail67($id_pn){
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user WHERE id_pn = '$id_pn' ");
        return $query->getResultArray();
    }

    public function approveOtorisasi123($id_pn, $fnip, $penilai){
        if($penilai == 'first'){
            $query   = $this->db->query("UPDATE pn_kp_gol_123 SET approval_satu = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'second'){
             $query   = $this->db->query("UPDATE pn_kp_gol_123 SET approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'both'){
             $query   = $this->db->query("UPDATE pn_kp_gol_123 SET approval_satu = 'Disetujui',  approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }

    public function approveOtorisasi4f($id_pn, $fnip, $penilai){
        if($penilai == 'first'){
            $query   = $this->db->query("UPDATE pn_kp_gol_4f SET approval_satu = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'second'){
             $query   = $this->db->query("UPDATE pn_kp_gol_4f SET approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'both'){
             $query   = $this->db->query("UPDATE pn_kp_gol_4f SET approval_satu = 'Disetujui',  approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }

    public function approveOtorisasi4s($id_pn, $fnip, $penilai){
        if($penilai == 'first'){
            $query   = $this->db->query("UPDATE pn_kp_gol_4s SET approval_satu = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'second'){
             $query   = $this->db->query("UPDATE pn_kp_gol_4s SET approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'both'){
             $query   = $this->db->query("UPDATE pn_kp_gol_4s SET approval_satu = 'Disetujui',  approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }

    public function approveOtorisasi5f($id_pn, $fnip, $penilai){
        if($penilai == 'first'){
            $query   = $this->db->query("UPDATE pn_kp_gol_5f SET approval_satu = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'second'){
             $query   = $this->db->query("UPDATE pn_kp_gol_5f SET approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'both'){
             $query   = $this->db->query("UPDATE pn_kp_gol_5f SET approval_satu = 'Disetujui',  approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }

    public function approveOtorisasi5s($id_pn, $fnip, $penilai){
        if($penilai == 'first'){
            $query   = $this->db->query("UPDATE pn_kp_gol_5s SET approval_satu = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'second'){
             $query   = $this->db->query("UPDATE pn_kp_gol_5s SET approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'both'){
             $query   = $this->db->query("UPDATE pn_kp_gol_5s SET approval_satu = 'Disetujui', approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }

    public function approveOtorisasi67($id_pn, $fnip, $penilai){
        if($penilai == 'first'){
            $query   = $this->db->query("UPDATE pn_kp_gol_67 SET approval_satu = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'second'){
             $query   = $this->db->query("UPDATE pn_kp_gol_67 SET approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        else if ($penilai == 'both'){
             $query   = $this->db->query("UPDATE pn_kp_gol_67 SET approval_satu = 'Disetujui',  approval_dua = 'Disetujui' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }
}
