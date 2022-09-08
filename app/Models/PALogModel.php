<?php

namespace App\Models;

use CodeIgniter\Model;

class PALogModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pa_log';
    protected $primaryKey       = 'id_record';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_record', 'tahun_pa', 'fgrade', 'id_user', 'fnama', 'jabatan', 'satuan_kerja', 'departemen', 'fungsi', 'penilai_satu', 'penilai_dua', 'created_at', 'updated_at', 'deleted_at'];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
