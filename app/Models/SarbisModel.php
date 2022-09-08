<?php

namespace App\Models;

use CodeIgniter\Model;

class SarbisModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sarbis';
    protected $primaryKey       = 'id_sarbis';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tahun_sarbis', 'desc_sarbis1', 'bobot_sarbis1', 'desc_sarbis2', 'bobot_sarbis2', 'desc_sarbis3', 'bobot_sarbis3', 'desc_sarbis4', 'bobot_sarbis4', 'desc_sarbis5', 'bobot_sarbis5',  'desc_sarbis6', 'bobot_sarbis6', 'desc_sarbis7', 'bobot_sarbis7', 'desc_sarbis8', 'bobot_sarbis8', 'user_nip', 'atasan1', 'atasan2', 'approval1', 'approval2'];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
