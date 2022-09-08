<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryPenilaian extends Model
{
    //kantor pusat

    public function kp_gol_123($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function kp_gol_4s($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function kp_gol_4f($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function kp_gol_5s($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function kp_gol_5f($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function kp_gol_67($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }


    //kantor cabang
    public function cab_gol_123($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function cab_gol_4s($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function cab_ao_reguler($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_ao_reg INNER JOIN pekerja ON pekerja.fnip = pn_cab_ao_reg.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function cab_uls($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_uls INNER JOIN pekerja ON pekerja.fnip = pn_cab_uls.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function cab_koc($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_koc INNER JOIN pekerja ON pekerja.fnip = pn_cab_koc.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function cab_kcp($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_kcp INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcp.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }

    public function cab_kcu($fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_kcu INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcu.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }


    //MARK: AMBIL DATA PA TAHUN BERJALAN
    public function cek_kp_123($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_123 WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_kp_4f($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4f WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_kp_4s($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4s WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_kp_5f($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5f WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_kp_5s($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5s WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_kp_67($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_67 WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }

    //KANTOR CABANG
    public function cek_cab_kc($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_kcu WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_cab_koc($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_koc WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_cab_kcp($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_kcp WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_cab_uls($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_uls WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_cab_123($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_123 WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_cab_4s($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_4s WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }
    public function cek_cab_ao($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_ao_reg WHERE id_user = '$fnip' AND tahun_pa = '$year'");
        return $query->getNumRows();
    }


    public function cek_pa_tahunan_is_avaiable($fnip, $year)
    {
        $query = $this->db->query("SELECT * FROM pa_log WHERE id_user = '$fnip' AND tahun_pa = '$year' ");
        return $query->getNumRows();
    }


    //CEK DATA SELURUH TABEL
    public function getAllUserData($fnip)
    {
        $query = $this->db->query("SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_kp_gol_123 pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_kp_gol_4f pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_kp_gol_4s pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_kp_gol_5f pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_kp_gol_5s pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_kp_gol_67 pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_cab_gol_123 pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_cab_gol_4s pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_cab_ao_reg pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_cab_kcu pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_cab_kcp pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_cab_uls pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        UNION SELECT pa_log.*, pekerja.fkode_cab, pn.id_pn, pn.angka_pa, pn.huruf_pa FROM pa_log INNER JOIN pn_cab_koc pn ON pn.id_user = pa_log.id_user INNER JOIN pekerja ON pekerja.fnip = pn.id_user WHERE pa_log.id_user = '$fnip' AND pa_log.tahun_pa = pn.tahun_pa
        ORDER BY tahun_pa DESC");
        return $query->getResultArray();
    }
}
