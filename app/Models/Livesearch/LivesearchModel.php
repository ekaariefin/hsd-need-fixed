<?php

namespace App\Models\Livesearch;

use CodeIgniter\Model;

class LivesearchModel extends Model
{
    protected $table            = 'pekerja';
    protected $primaryKey       = 'fnip';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'array';



    public function __construct()
    {
        parent::__construct();
    }

    public function searchEmployeeModel($params)
    {
        $query = $this->db->table($this->table)->select(['fnama'])->like('fnama', $params);
        return ($query->get()->getResult());
    }

    public function liveSearchEmployee($keyword)
    {
        $response = array();

        if (isset($keyword['search'])) {

            $query = $this->db->table('pekerja')
                ->select(['fnama', 'fnip', 'jabatan', 'fgrade', 'satuan_kerja', 'email'])
                ->like('fnama', $keyword['search'])
                ->orLike('fnip', $keyword['search'])
                ->get()->getResult();
            foreach ($query as $row) {
                $response[] = array(
                    "nama" => $row->fnama,
                    "nip" => $row->fnip,
                    "gol" => $row->fgrade,
                    "jabatan" => $row->jabatan,
                    "unit" => $row->satuan_kerja,
                    "email" => $row->email
                );
            }
        }

        return $response;
    }

    public function selectedCoachee($id)
    {
        $response = array();

        if (isset($id)) {
            $query = $this->db->table($this->table)
                ->select(['fnama', 'fnip', 'jabatan', 'departemen', 'fgrade', 'satuan_kerja'])
                ->like('fnip', $id)
                ->get()->getResult();
            foreach ($query as $row) {
                $response[] = array(
                    "nama" => $row->fnama,
                    "nip" => $row->fnip,
                    "gol" => $row->fgrade,
                    "jabatan" => $row->jabatan,
                    "departemen" => $row->departemen,
                    "unit" => $row->satuan_kerja
                );
            }
        }

        return $response;
    }
}
