<?php

namespace App\Models\Coaching;

use App\Models\Config\CoachingConfigModel;
use App\Models\Karyawan\AtasanModel;
use App\Models\PekerjaModel;
use CodeIgniter\Model;

class CoachingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'coaching';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'array';

    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'fnip_atasan', 'fnama_atasan', 'jabatan_atasan', 'fgrade_atasan', 'satuan_kerja_atasan', 'departemen_atasan', 'bidang_atasan', 'fungsi_atasan', 'fnip_karyawan', 'fnama_karyawan', 'jabatan_karyawan', 'fgrade_karyawan', 'satuan_kerja_karyawan', 'departemen_karyawan', 'bidang_karyawan', 'fungsi_karyawan', 'periode_coaching', 'tanggal_coaching', 'tanggal_konfirmasi_coaching', 'sarbis1', 'target_tercapai1', 'sarbis2', 'target_tercapai2', 'sarbis3', 'target_tercapai3', 'sarbis4', 'target_tercapai4', 'sarbis5', 'target_tercapai5', 'sarbis6', 'target_tercapai6', 'sarbis7', 'target_tercapai7', 'sarbis8', 'target_tercapai8', 'sarbis9', 'target_tercapai9', 'sarbis10', 'target_tercapai10', 'budaya_kerja1', 'budaya_kerja2', 'budaya_kerja3', 'budaya_kerja4', 'budaya_kerja5', 'budaya_kerja6', 'budaya_kerja7', 'budaya_kerja8', 'budaya_kerja9', 'budaya_kerja10', 'saran_dukungan', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAllCoaching($full = false, $keyword = null, $page = 5)
    {
        // $result = $this->db->query("SELECT pa.*, p.fnip as fnip_karyawan, p.fnama as fnama_karyawan, p.jk as jk_karyawan, p.jabatan as jabatan_karyawan, p.satuan_kerja as satuan_kerja_karyawan, p.departemen as departemen_karyawan, p.bidang as bidang_karyawan, p.fungsi as fungsi_karyawan, p.fgrade as fgrade_karyawan, C.* FROM coaching as C LEFT JOIN pekerja pa ON C.fnip_atasan = pa.fnip LEFT JOIN pekerja p ON C.fnip_karyawan = p.fnip");
        $table = $this->table;
        $join_table = 'periode_coaching';

        // dd($keyword);
        if (!$full) {
            $result = $this->select("$table.id, $table.tanggal_coaching, DATE_FORMAT(tanggal_coaching,'%d/%m/%Y') as tanggal, $join_table.range_periode, $table.satuan_kerja_karyawan, departemen_karyawan, fnip_karyawan, fnama_karyawan, jabatan_karyawan")->join($join_table, "$table.periode_coaching = $join_table.id")->orLike('fnama_karyawan', "%$keyword%")->orLike('satuan_kerja_karyawan', "%$keyword%")->orLike('departemen_karyawan', "%$keyword%")->orLike('fnip_karyawan', "%$keyword%")->orLike('jabatan_karyawan', "%$keyword%")->orLike("$join_table.range_periode", "%$keyword%")->orLike('periode_coaching', "%$keyword%")->orLike("DATE_FORMAT(tanggal_coaching,'%d/%m/%Y')", "%$keyword%")->orderBy("tanggal_coaching", "DESC")->paginate($page, 'coaching');
            // if ($keyword != null) {
            // } else {

            //     $result = $this->select("id, tanggal_coaching, periode_coaching, satuan_kerja_karyawan, departemen_karyawan, fnip_karyawan, fnama_karyawan, jabatan_karyawan")->orderBy("tanggal_coaching", "DESC")->paginate($page);
            // }
        } else {

            $result = $this->orderBy("tanggal_coaching", "DESC")->findAll();
        }
        // dd($result);



        return $result;
    }

    public function getListCoaching($nip, $atasan = false)
    {

        if ($atasan == true) {

            // $result = $this->db->query("SELECT p.fnama, p.jabatan, C.id, C.tanggal_coaching, C.status, masa.range_periode as periode FROM coaching as C LEFT JOIN periode_coaching masa ON C.periode_coaching = masa.id  LEFT JOIN pekerja pa ON C.fnip_atasan = pa.fnip LEFT JOIN pekerja p ON C.fnip_karyawan = p.fnip WHERE pa.fnip='$nip'");
            $result = $this->getCoachingBawahan();
        } else {

            $result = $this->db->query("SELECT pa.fnama, pa.jabatan, pa.departemen, pa.satuan_kerja, C.id, C.tanggal_coaching, C.status, masa.range_periode as periode FROM coaching as C LEFT JOIN periode_coaching masa ON C.periode_coaching = masa.id LEFT JOIN pekerja pa ON C.fnip_atasan = pa.fnip LEFT JOIN pekerja p ON C.fnip_karyawan = p.fnip WHERE p.fnip=$nip");
        }
        // dd($result->getResultArray());
        return $result->getResultArray();
    }

    public function getFields()
    {

        $fields = $this->db->getFieldNames("coaching");
        return $fields;
    }
    public function getEmployeeCoaching($id)
    {
        $result = $this->db->query("SELECT pa.*, p.fnip as fnip_karyawan, p.fnama as fnama_karyawan, p.jk as jk_karyawan, p.jabatan as jabatan_karyawan, p.satuan_kerja as satuan_kerja_karyawan, p.departemen as departemen_karyawan, p.bidang as bidang_karyawan, p.fungsi as fungsi_karyawan, p.fgrade as fgrade_karyawan, C.*, masa.range_periode as periode FROM coaching as C LEFT JOIN periode_coaching masa ON C.periode_coaching = masa.id LEFT JOIN pekerja pa ON C.fnip_atasan = pa.fnip LEFT JOIN pekerja p ON C.fnip_karyawan = p.fnip WHERE pa.fnip='$id'");



        return $result->getResultArray();
    }

    public function getDetailCoaching($id)
    {
        // $result = $this->db->query("SELECT pa.*, p.fnip as fnip_karyawan, p.fnama as fnama_karyawan, p.jk as jk_karyawan, p.jabatan as jabatan_karyawan, p.satuan_kerja as satuan_kerja_karyawan, p.departemen as departemen_karyawan, p.bidang as bidang_karyawan, p.fungsi as fungsi_karyawan, p.fgrade as fgrade_karyawan, C.*, masa.range_periode as periode FROM coaching as C LEFT JOIN periode_coaching masa ON C.periode_coaching = masa.id LEFT JOIN pekerja pa ON C.fnip_atasan = pa.fnip LEFT JOIN pekerja p ON C.fnip_karyawan = p.fnip WHERE C.id='$id'");


        $result = $this->find($id, 'array');

        return $result;
    }

    public function getPendingCoaching($nip)
    {
        $query = $this->where('fnip_karyawan', $nip)->where('status', 0)->get()->getResultArray();
        return $query;
    }

    public function getDetailCoachingPure($id)
    {
        $query =  $this->getDetailCoaching($id);
        $periodeModel = new CoachingConfigModel();

        $periode = $periodeModel->select('range_periode as periode')->where('id', $query['periode_coaching'])->get()->getRowArray();
        // dd($query['periode']);

        $data['tanggal'] = $query['tanggal_coaching'];
        $data['status'] = $query['status'];
        $data['periode'] = ['id' => $query['periode_coaching'], 'value' => $periode['periode']];
        $data['tanggal_input_data'] = $query['created_at'];
        $data['tanggal_konfirmasi_coaching'] = $query['tanggal_konfirmasi_coaching'];

        $data['perilaku_kerja'] = array();
        for ($i = 1; $i < 11; $i++) {
            if (!$query["budaya_kerja$i"]) {
                break;
            }
            $data['perilaku_kerja'][] = $query["budaya_kerja$i"];
        }


        $data['sarbis'] = array();

        for ($i = 1; $i < 9; $i++) {
            if (!$query["sarbis$i"] && !$query["target_tercapai$i"]) {
                break;
            }
            $data['sarbis'][] = [
                'sarbis' => $query["sarbis$i"],
                'realisasi' => $query["target_tercapai$i"]

            ];
        }

        $data['atasan'] = [
            'nip' => $query['fnip_atasan'],
            'nama' => $query['fnama_atasan'],
            'jabatan' => $query['jabatan_atasan'],
            'satuan_kerja' => $query['satuan_kerja_atasan'],
            'departemen' => $query['departemen_atasan'],
            'fungsi' => $query['fungsi_atasan'],
            'bidang' => $query['bidang_atasan'],
            'golongan' => $query['fgrade_atasan']

        ];
        $data['karyawan'] = [
            'nip' => $query['fnip_karyawan'],
            'nama' => $query['fnama_karyawan'],
            'jabatan' => $query['jabatan_karyawan'],
            'satuan_kerja' => $query['satuan_kerja_karyawan'],
            'departemen' => $query['departemen_karyawan'],
            'fungsi' => $query['fungsi_karyawan'],
            'bidang' => $query['bidang_karyawan'],
            'golongan' => $query['fgrade_karyawan']

        ];
        $data['dukungan'] = array_filter(explode(PHP_EOL, $query['saran_dukungan']));
        return $data;
    }

    public function getCoachingBawahan()
    {
        $table = $this->table;
        $atasanModel = new AtasanModel();
        $listBawahan = $atasanModel->select('user_nip')->where('atasan_nip', session()->get('fnip'))->findAll();
        $first_elements = array_map(function ($i) {
            return $i['user_nip'];
        }, $listBawahan);


        $builder = $this->table($this->table)->select("$table.id, $table.fnama_karyawan as fnama, $table.jabatan_karyawan as jabatan, $table.tanggal_coaching, status, $table.periode_coaching as periode")->whereIn("fnip_karyawan", $first_elements)->orderBy("$table.tanggal_coaching", "DESC");
        $query = $builder->get();

        // dd($query->getResultArray());


        if (!$query) {
            return ("Tidak ada data");
        }

        return ($query);
    }
}
