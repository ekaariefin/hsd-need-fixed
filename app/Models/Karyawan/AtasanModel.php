<?php

namespace App\Models\Karyawan;

use CodeIgniter\Model;

class AtasanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'atasan';
    protected $primaryKey       = 'user_nip';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_nip', 'atasan_nip'];

    public function getAtasan($nip)
    {
        $atasan1 = $this->where('user_nip', $nip)->limit(1)->get()->getRow()->atasan_nip;

        if (!$atasan1) {
            $data['atasan1'] = ['fnip' => null, 'fnama' => null];
            $data['atasan2'] = ['fnip' => null, 'fnama' => null];
        } else {
            $data['atasan1'] = $this->detailAtasan($atasan1);

            $atasan2 = $this->where('user_nip', $atasan1)->limit(1)->get()->getRow()->atasan_nip;
            if (empty($atasan2)) {
                $data['atasan2'] = ['fnip' => null, 'fnama' => null];
            } else {
                $data['atasan2'] = $this->detailAtasan($atasan2);
            }
        }

        return (array)$data;
    }

    private function detailAtasan($nip, $table_for_join = 'pekerja')
    {
        $builder = $this->table($this->table);
        $builder->select("$table_for_join.fnip, $table_for_join.fnama, $table_for_join.jabatan, $table_for_join.satuan_kerja, $table_for_join.departemen");
        $builder->join($table_for_join, "$table_for_join.fnip = $this->table.user_nip", 'inner')->where("$table_for_join.fnip", $nip);
        $query = $builder->get();

        return ((array)$query->getRow());
    }

    public function getBawahan($table_for_join = 'pekerja')
    {
        $listBawahan = $this->select('user_nip')->where('atasan_nip', session()->get('fnip'))->findAll();
        $first_elements = array_map(function ($i) {
            return $i['user_nip'];
        }, $listBawahan);

        $builder = $this->table($this->table);
        $builder->select("$table_for_join.fnip, $table_for_join.fnama")->join('auth', "auth.userid = $this->table.user_nip", 'left')->where('auth.is_active', 1);
        $builder->join($table_for_join, "$table_for_join.fnip = $this->table.user_nip", 'left')->whereIn("$table_for_join.fnip", $first_elements);
        $query = $builder->get()->getResultArray();

        // dd($query);
        if (!$query) {
            return ("Tidak ada data");
        }

        // dd($query);
        return ($query);
    }

    public function getBawahanWajibCoaching($table_for_join = 'pekerja')
    {
        $listBawahan = $this->select('user_nip')->where('atasan_nip', session()->get('fnip'))->findAll();
        $first_elements = array_map(function ($i) {
            return $i['user_nip'];
        }, $listBawahan);

        $builder = $this->table($this->table);
        $builder->select("$table_for_join.fnip, $table_for_join.fnama, $table_for_join.jabatan")->join('auth', "auth.userid = $this->table.user_nip", 'left')->where('auth.is_active', 1)->notLike("$table_for_join.jabatan", "PENGURUS BCA SYARIAH");
        $builder->join($table_for_join, "$table_for_join.fnip = $this->table.user_nip", 'left')->whereIn("$table_for_join.fnip", $first_elements);
        $query = $builder->get()->getResultArray();


        if (!$query) {
            return ("Tidak ada data");
        }

        return ($query);
    }

    public function getRole()
    {
        $nip = session()->fnip;
        $atasan = $this->db->query("SELECT user_nip FROM $this->table WHERE atasan_nip = $nip")->getRow();

        if (!$atasan) {
            return "4";
        }
        return "3";
    }

    public function getBawahanFull($table_for_join = 'pekerja')
    {
        $listBawahan = $this->select('atasan.user_nip, a.is_active, a.status')->join('auth as a', 'atasan.user_nip=a.userid')->where('atasan_nip', session()->get('fnip'))->where('a.status != "resign" ')->findAll();
        $first_elements = array_map(function ($i) {
            return $i['user_nip'];
        }, $listBawahan);
        try {
            $builder = $this->table($this->table)->select("$table_for_join.*, auth.is_blocked")->join('auth', "auth.userid = $this->table.user_nip", 'left')->join($table_for_join, "$table_for_join.fnip = $this->table.user_nip", 'left')->where('auth.is_active', 1)->whereIn("$table_for_join.fnip", $first_elements);
            $query = $builder->get()->getResultArray();
        } catch (\Throwable $th) {
            return [];
        }

        // dd($query);

        if (!$query) {
            return ("Tidak ada data");
        }

        return ($query);
    }
}
