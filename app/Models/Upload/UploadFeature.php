<?php

namespace App\Models\Upload;

use CodeIgniter\Model;

class UploadFeature extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'test_upload_data';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nama', 'harga', 'stok'];
}
