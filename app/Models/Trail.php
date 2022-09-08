<?php

namespace App\Models;

use CodeIgniter\Model;

class Trail extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'trail_log';
    protected $primaryKey       = 'record';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';


    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['activity_code', 'user_agent', 'ip_address', 'mac_address', 'user_id', 'user_name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getActivity($keyword = null)
    {
        $page = 20;
        $table = $this->table;
        $result = $this->select("*")->orLike('activity_code', "%$keyword%")->orLike('user_agent', "%$keyword%")->orLike('ip_address', "%$keyword%")->orLike('mac_address', "%$keyword%")->orLike('created_at', "%$keyword%")->orLike('user_id', "%$keyword%")->orderBy("created_at", "DESC")->paginate($page, "log");
        // dd($result);

        return $result;
    }
}
