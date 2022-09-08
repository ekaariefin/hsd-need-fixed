<?php

namespace App\Models\Coaching;

use CodeIgniter\Model;

class TestcoachingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'testcoaching';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'karyawan_fnip', 'karyawan_fnama', 'karyawan_jabatan', 'karyawan_fgrade', 'karyawan_satuan_kerja', 'karyawan_departemen', 'karyawan_bidang', 'karyawan_fungsi', 'atasan_fnip', 'atasan_fnama', 'atasan_jabatan', 'atasan_satuan_kerja', 'atasan_departemen', 'atasan_bidang', 'atasan_fungsi', 'atasan_fgrade', 'tanggal_coaching', 'periode_coaching', 'tanggal_konfirmasi_karyawan', 'sasaran_bisnis_or_kecakapan_kerja_1', 'sasaran_bisnis_or_kecakapan_kerja_2', 'sasaran_bisnis_or_kecakapan_kerja_3', 'sasaran_bisnis_or_kecakapan_kerja_4', 'sasaran_bisnis_or_kecakapan_kerja_5', 'sasaran_bisnis_or_kecakapan_kerja_6', 'sasaran_bisnis_or_kecakapan_kerja_7', 'sasaran_bisnis_or_kecakapan_kerja_8', 'realisasi_capaian_1', 'realisasi_capaian_2', 'realisasi_capaian_3', 'realisasi_capaian_4', 'realisasi_capaian_5', 'realisasi_capaian_6', 'realisasi_capaian_7', 'realisasi_capaian_8', 'perilaku_budaya_1', 'perilaku_budaya_2', 'perilaku_budaya_3', 'perilaku_budaya_4', 'perilaku_budaya_5', 'perilaku_budaya_6', 'perilaku_budaya_7', 'perilaku_budaya_8', 'saran_dukungan_atasan', 'created_at', 'edited_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    public function getAllCoaching()
    {
        $result = $this->findAll('array');
        return $result;
    }

    public function getListCoaching($nip, $atasan = false)
    {

        if ($atasan == true) {
            $result = $this->where('atasan_fnip', $nip)->get()->getResultArray();
        } else {
            $result = $this->where('karyawan_fnip', $nip)->get()->getResultArray();
        }

        return $result;
    }

    public function getEmployeeCoaching($id)
    {
        $result = $this->where('atasan_fnip', $id)->get()->getResultArray();
        return $result;
    }

    public function getDetailCoaching($id)
    {
        $result = $this->where('id', "'$id'")->get()->getRowArray();
        return $result;
    }

    public function getPendingCoaching($nip)
    {
        $query = $this->where('karyawan_fnip', $nip)->where('status', 0)->get()->getResultArray();
        return $query;
    }

    public function getDetailCoachingPure($id)
    {
        $query =  $this->getDetailCoaching($id);

        $data['tanggal'] = $query['tanggal_coaching'];
        $data['status'] = $query['status'];
        $data['periode'] = ['id' => $query['periode_coaching'], 'value' => $query['periode']];

        $data['perilaku_kerja'] = array();
        for ($i = 1; $i < 11; $i++) {
            if (!$query["budaya_kerja$i"]) {
                break;
            }
            $data['perilaku_kerja'][] = $query["budaya_kerja$i"];
        }

        // dd(sizeof($data['perilaku_kerja']));

        $data['sarbis'] = array();

        for ($i = 1; $i < 11; $i++) {
            if (!$query["sarbis$i"] && !$query["target_tercapai$i"]) {
                break;
            }
            $data['sarbis'][] = [
                'sarbis' => $query["sarbis$i"],
                'realisasi' => $query["target_tercapai$i"]

            ];
        }

        $data['atasan'] = [
            'nip' => $query['fnip'],
            'nama' => $query['fnama'],
            'jabatan' => $query['jabatan'],
            'satuan_kerja' => $query['satuan_kerja'],
            'departemen' => $query['departemen'],
            'fungsi' => $query['fungsi'],
            'bidang' => $query['bidang'],
            'golongan' => $query['fgrade']

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
}
