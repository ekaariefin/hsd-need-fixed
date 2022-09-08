<?php

namespace App\Models;

use CodeIgniter\Model;

class BobotPenilaian extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bobot_pa';
    protected $primaryKey       = 'id_bobot';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_bobot', 'nilai_bobot', 'golongan', 'fkode_cab'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function get_bobot($golongan)
    {
        $fkode_cab  = session()->get('fkode_cab');
        if ($fkode_cab == '99') {
            $query      = $this->db->query("SELECT * FROM bobot_pa WHERE golongan = '$golongan' AND fkode_cab = 'KANTOR PUSAT' ");
        } else {
            $query      = $this->db->query("SELECT * FROM bobot_pa WHERE golongan = '$golongan' AND fkode_cab = 'KANTOR CABANG' ");
        }
        return $query->getResultArray();
    }
}
