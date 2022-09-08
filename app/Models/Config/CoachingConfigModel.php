<?php

namespace App\Models\Config;

use CodeIgniter\Model;

class CoachingConfigModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'periode_coaching';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['start_coaching', 'end_coaching', 'range_periode'];


    public function getPeriodeConfig()
    {
        $query = $this->findAll();

        foreach ($query as $periode) {

            // mengembalikan waktu dalam unix time
            $data[$periode['id']]['tanggal_buka'] = strtotime(date('Y') . '-' . $periode['start_coaching']);
            $data[$periode['id']]['tanggal_tutup'] = strtotime(date('Y') . '-' . $periode['end_coaching']);
        }

        return $data;
    }
}
