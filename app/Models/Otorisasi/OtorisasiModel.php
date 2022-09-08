<?php

namespace App\Models\Otorisasi;

use CodeIgniter\Model;

class OtorisasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pekerja';
    // protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    public function getDataOto()
    {
        $fnip = session()->get('fnip');
        $query   = $this->db->query("SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_ao_reg INNER JOIN pekerja ON pekerja.fnip = pn_cab_ao_reg.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_kcu INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcu.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_kcp INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcp.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_uls INNER JOIN pekerja ON pekerja.fnip = pn_cab_uls.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, penilai_dua, approval_satu, approval_dua, angka_pa, huruf_pa, jabatan, fgrade, fkode_cab FROM pn_cab_koc INNER JOIN pekerja ON pekerja.fnip = pn_cab_koc.id_user WHERE penilai_satu = '$fnip' OR penilai_dua = '$fnip'; ");
        return $query->getResultArray();
    }

    public function countAllData()
    {
        $query   = $this->db->query("SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_kp_gol_123  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_kp_gol_4f 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_kp_gol_4s 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_kp_gol_5f 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_kp_gol_5s
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_kp_gol_67
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_cab_gol_123
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_cab_gol_4s 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_cab_ao_reg 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_cab_kcu
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_cab_kcp
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_cab_uls
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user FROM pn_cab_koc");
        return $query->getNumRows();
    }

    public function getAllDataPenilaian()
    {
        $query   = $this->db->query("SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_ao_reg INNER JOIN pekerja ON pekerja.fnip = pn_cab_ao_reg.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcu INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcu.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcp INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcp.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_uls INNER JOIN pekerja ON pekerja.fnip = pn_cab_uls.id_user
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_koc INNER JOIN pekerja ON pekerja.fnip = pn_cab_koc.id_user
        ORDER BY satuan_kerja DESC");
        return $query->getResultArray();
    }

    public function getAllDataPenilaianTahunPA()
    {
        $tahun_pa = date('Y') - 1;
        $query   = $this->db->query("SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE pn_kp_gol_123.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE pn_kp_gol_4f.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE pn_kp_gol_4s.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE pn_kp_gol_5f.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE pn_kp_gol_5s.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user WHERE pn_kp_gol_67.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE pn_cab_gol_123.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE pn_cab_gol_4s.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_ao_reg INNER JOIN pekerja ON pekerja.fnip = pn_cab_ao_reg.id_user WHERE pn_cab_ao_reg.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcu INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcu.id_user WHERE pn_cab_kcu.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcp INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcp.id_user WHERE pn_cab_kcp.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_uls INNER JOIN pekerja ON pekerja.fnip = pn_cab_uls.id_user WHERE pn_cab_uls.tahun_pa = $tahun_pa
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja,departemen, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_koc INNER JOIN pekerja ON pekerja.fnip = pn_cab_koc.id_user WHERE pn_cab_koc.tahun_pa = $tahun_pa
        ORDER BY satuan_kerja DESC");
        return $query->getResultArray();
    }

    public function getAllDataPenilaianSK($satuan_kerja)
    {
        $query   = $this->db->query("SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_ao_reg INNER JOIN pekerja ON pekerja.fnip = pn_cab_ao_reg.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcu INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcu.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcp INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcp.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_uls INNER JOIN pekerja ON pekerja.fnip = pn_cab_uls.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_koc INNER JOIN pekerja ON pekerja.fnip = pn_cab_koc.id_user WHERE pekerja.satuan_kerja = '$satuan_kerja'  
        ORDER BY satuan_kerja DESC");
        return $query->getResultArray();
    }


    public function getSpecificDataPenilaian($fnip)
    {
        $query   = $this->db->query("SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_123.id_user WHERE id_user = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4f.id_user WHERE id_user = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_4s.id_user WHERE id_user = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5f INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5f.id_user WHERE id_user = '$fnip' 
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_5s INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_5s.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_kp_gol_67 INNER JOIN pekerja ON pekerja.fnip = pn_kp_gol_67.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_123 INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_123.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_gol_4s INNER JOIN pekerja ON pekerja.fnip = pn_cab_gol_4s.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_ao_reg INNER JOIN pekerja ON pekerja.fnip = pn_cab_ao_reg.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcu INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcu.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_kcp INNER JOIN pekerja ON pekerja.fnip = pn_cab_kcp.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_uls INNER JOIN pekerja ON pekerja.fnip = pn_cab_uls.id_user WHERE id_user = '$fnip'
        UNION SELECT id_pn, tgl_isi, tahun_pa, id_user, fnama, penilai_satu, satuan_kerja, angka_pa, huruf_pa, jabatan, fkode_cab, fgrade FROM pn_cab_koc INNER JOIN pekerja ON pekerja.fnip = pn_cab_koc.id_user WHERE id_user = '$fnip'
        ORDER BY satuan_kerja DESC");
        return $query->getResultArray();
    }

    public function update_selected($table, $id_pn, $position)
    {
        //MARK: DEFINE POSISI PEMBERI OTORISASI
        if ($position == 'First') {
            $position = 'approval_satu';
        } else {
            $position = 'approval_dua';
        }

        //MARK: CEK KP/KC
        if ($table == '123') {
            $query = $this->db->query("UPDATE pn_kp_gol_123 SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == '4F') {
            $query = $this->db->query("UPDATE pn_kp_gol_4f SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == '4S') {
            $query = $this->db->query("UPDATE pn_kp_gol_4s SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == '5F') {
            $query = $this->db->query("UPDATE pn_kp_gol_5f SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == '5S') {
            $query = $this->db->query("UPDATE pn_kp_gol_5s SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == '67') {
            $query = $this->db->query("UPDATE pn_kp_gol_67 SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == '67') {
            $query = $this->db->query("UPDATE pn_kp_gol_67 SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_123') {
            $query = $this->db->query("UPDATE pn_cab_gol_123 SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_4s') {
            $query = $this->db->query("UPDATE pn_cab_gol_4s SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_ao') {
            $query = $this->db->query("UPDATE pn_cab_ao_reg SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_uls') {
            $query = $this->db->query("UPDATE pn_cab_uls SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_kcp') {
            $query = $this->db->query("UPDATE pn_cab_kcp SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_koc') {
            $query = $this->db->query("UPDATE pn_cab_koc SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_kcu') {
            $query = $this->db->query("UPDATE pn_cab_kcu SET $position = '" . session()->get('fnip') . "' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }

    public function update_koreksi($table, $id_pn, $position)
    {
        //MARK: DEFINE POSISI PEMBERI OTORISASI
        if ($position == 'First') {
            $position = 'approval_satu';
        } else {
            $position = 'approval_dua';
        }

        //MARK: CEK KP/KC
        if ($table == '123') {
            $query = $this->db->query("UPDATE pn_kp_gol_123 SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == '4F') {
            $query = $this->db->query("UPDATE pn_kp_gol_4f SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == '4S') {
            $query = $this->db->query("UPDATE pn_kp_gol_4s SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == '5F') {
            $query = $this->db->query("UPDATE pn_kp_gol_5f SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == '5S') {
            $query = $this->db->query("UPDATE pn_kp_gol_5s SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == '67') {
            $query = $this->db->query("UPDATE pn_kp_gol_67 SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == '67') {
            $query = $this->db->query("UPDATE pn_kp_gol_67 SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_123') {
            $query = $this->db->query("UPDATE pn_cab_gol_123 SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_4s') {
            $query = $this->db->query("UPDATE pn_cab_gol_4s SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_ao') {
            $query = $this->db->query("UPDATE pn_cab_ao_reg SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_uls') {
            $query = $this->db->query("UPDATE pn_cab_uls SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_kcp') {
            $query = $this->db->query("UPDATE pn_cab_kcp SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_koc') {
            $query = $this->db->query("UPDATE pn_cab_koc SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        } else if ($table == 'cab_kcu') {
            $query = $this->db->query("UPDATE pn_cab_kcu SET $position = 'Revision' WHERE id_pn = '$id_pn'");
        }
        return $query;
    }
}
