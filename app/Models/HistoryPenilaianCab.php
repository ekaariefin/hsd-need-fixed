<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryPenilaianCab extends Model
{

    public function get_gol_123($fnip){
        $query   = $this->db->query("SELECT * FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE pekerja.fnip = '$fnip' ");
        return $query->getResultArray();
    }
}
