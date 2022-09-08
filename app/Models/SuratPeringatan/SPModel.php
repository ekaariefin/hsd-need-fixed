<?php

namespace App\Models\SuratPeringatan;

use CodeIgniter\Model;

class SPModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'surat_peringatan';
    protected $primaryKey       = 'id_sp';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['jenis_sp', 'nomor_sp', 'tahun_sp', 'tanggal_sp_mulai', 'tanggal_sp_akhir', 'pasal_sp', 'perihal_sp', 'poin_sp', 'user_sp'];
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function tambahData($data){
        $builder = $this->db->table($this->table);
        if($builder->insert($data)){
            return true;
        }
        else {
            return false;
        }
    }

    public function getData(){
        $query = $this->db->query("SELECT * FROM surat_peringatan LEFT JOIN pekerja ON pekerja.fnip = surat_peringatan.user_sp");
        return $query->getResultArray();
    }

    public function getDataSpecific($id_sp){
        $query = $this->db->query("SELECT * FROM surat_peringatan LEFT JOIN pekerja ON pekerja.fnip = surat_peringatan.user_sp WHERE id_sp = '$id_sp' ");
        return $query->getRowArray();
    }

    public function getDataUser($fnip){
        $query = $this->db->query("SELECT * FROM surat_peringatan LEFT JOIN pekerja AS p ON p.fnip = surat_peringatan.user_sp WHERE p.fnip = '$fnip';
        ");
        return $query->getRowArray();
    }

    public function getDataUserSpecificYear($fnip, $tahun_sp){
        $query = $this->db->query("SELECT * FROM surat_peringatan LEFT JOIN pekerja AS p ON p.fnip = surat_peringatan.user_sp WHERE p.fnip = '$fnip' AND surat_peringatan.tahun_sp = '$tahun_sp';
        ");
        return $query->getRowArray();
    }
}
