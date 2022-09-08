<?php

namespace App\Models\Detail;

use CodeIgniter\Model;

class DetailPenilaianModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pekerja';

    public function getDetail123($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetail4f($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetail4s($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetail5f($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetail5s($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetail67($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetailCab123($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetailCab4s($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetailCabKaULS($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_uls INNER JOIN pekerja ON pekerja.fnip = pn_cab_uls.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetailCabKaKOC($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_koc INNER JOIN pekerja ON pekerja.fnip = pn_cab_koc.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetailCabKaKCP($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_kcp INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcp.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetailCabKaKCU($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_kcu INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcu.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }

    public function getDetailCabAO($id_pn, $fnip)
    {
        $query   = $this->db->query("SELECT * FROM pn_cab_ao_reg INNER JOIN pekerja ON pekerja.fnip = pn_cab_ao_reg.id_user WHERE id_pn = '$id_pn' AND id_user = '$fnip' ");
        return $query->getResultArray();
    }


    public function getHistoricalUser($fnip, $year)
    {
        $query   = $this->db->query("SELECT * FROM pa_log WHERE id_user = '$fnip' AND tahun_pa = '$year' ");
        return $query->getResultArray();
    }
}
