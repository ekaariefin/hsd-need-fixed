<?php

namespace App\Models\Auth;

use CodeIgniter\Model;

class UserTokenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_token';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email', 'token', 'created_at'];
}
