<?php

namespace App\Models\Auth;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class M_Auth extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['userid', 'password', 'role', 'last_change_password', 'is_active', 'is_blocked', 'status'];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function changePassword($userid, $password)
    {
        // dd(date("Y-m-d H:i:s"));
        $query = $this->set(['password' => md5($password), 'last_change_password' => date("Y-m-d H:i:s")]);
        $query->where('userid', $userid);
        $query->update();

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserWithInfo($email, $join_table = "pekerja")
    {
        $query = $this->select("userid, is_active, $join_table.email, auth.token, auth.created_at");
        $query->join('auth', "auth.email = $join_table.email");
        $query->join($join_table, "$join_table.fnip = $this->table.userid", 'right');
        $query->where("$join_table.email = $email");
        $query->get()->limit(1)->row();
        return $query;
    }
    public function getListUser($join_table = "pekerja")
    {
        // $query = $this->select("userid, is_active, $join_table.email, created_at");
        // $query->join($join_table, "$join_table.fnip = $this->table.userid", 'left');
        // $query->where("$join_table.fnip='20211101885");
        // $query->get()->getRow();

        $query = $this->select("userid, $join_table.fnama as nama, $join_table.email, is_active as status, is_blocked as blokir")->join($join_table, "$join_table.fnip = $this->table.userid", 'left')->where("role != 1")->where("role != 2")->get()->getResultArray();
        return $query;
    }

    public function getAdministratorUser($role = 1)
    {
        $query = $this->select("userid, created_at, is_active as status, is_blocked as blokir")->where('role', $role)->get()->getResultArray();
        return $query;
    }
}
