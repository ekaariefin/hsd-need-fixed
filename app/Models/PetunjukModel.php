<?php

namespace App\Models;

use CodeIgniter\Model;

class PetunjukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'petunjuk';
    protected $primaryKey       = 'id_petunjuk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_petunjuk', 'deskripsi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
