<?php

namespace App\Models\Struktur;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'departemen';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];
}
