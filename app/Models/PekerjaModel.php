<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaModel extends Model
{
    protected $table            = 'pekerja';
    protected $primaryKey       = 'fnip';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'fnip',
        'fnama',
        'jabatan',
        'satuan_kerja',
        'departemen',
        'bidang',
        'fungsi',
        'email',
        'fgrade',
        'fkode_cab'
    ];

    public function getPekerja($active = false)
    {
        $table = $this->table;
        $table_join = 'auth';
        if (!$active) {
            return $this->findAll();
        }

        $query = $this->select("$table.fnip, $table.fnama,  $table.jabatan, $table.departemen, $table.satuan_kerja, $table_join.is_active")->join($table_join, "$table.fnip = $table_join.userid", 'left')->get()->getResultArray();

        return $query;
        // dd($query);
    }

    public function getPekerjaDibawahi($id = false)
    {
        $jabatan = session()->get('jabatan');
        $satuan_kerja = session()->get('satuan_kerja');
        $departemen = session()->get('departemen');
        $bidang = session()->get('bidang');
        $fungsi = session()->get('fungsi');

        if ($jabatan == 'KEPALA SATUAN KERJA') {
            $query   = $this->db->query("SELECT * FROM pekerja 
            WHERE satuan_kerja = '$satuan_kerja' AND (
                jabatan = 'KEPALA DEPARTEMEN' OR 
                jabatan = 'KEPALA BIDANG' OR
                jabatan = 'KEPALA BAGIAN' OR
                jabatan = 'KEPALA CABANG') ");
        } else if ($jabatan == 'KEPALA DEPARTEMEN') {
            $query   = $this->db->query("SELECT * FROM pekerja 
            WHERE 
                satuan_kerja = '$satuan_kerja' AND 
                departemen = '$departemen' AND
                jabatan != 'KEPALA DEPARTEMEN' ");
        } else if ($jabatan == 'KEPALA BIDANG') {
            $query   = $this->db->query("SELECT * FROM pekerja 
            WHERE 
                satuan_kerja = '$satuan_kerja' AND 
                departemen = '$departemen' AND
                bidang = '$bidang' AND 
                jabatan != 'KEPALA BIDANG' ");
        } else if ($jabatan == 'KEPALA BAGIAN') {
            $query   = $this->db->query("SELECT * FROM pekerja 
            WHERE 
                satuan_kerja = '$satuan_kerja' AND 
                departemen = '$departemen' AND
                bidang = '$bidang' AND 
                fungsi = '$fungsi' AND
                jabatan != 'KEPALA BAGIAN' ");
        } else if ($jabatan == 'KEPALA CABANG') {
            $query   = $this->db->query("SELECT * FROM pekerja 
            WHERE 
                satuan_kerja = '$satuan_kerja' AND 
                departemen = '$departemen' AND
                bidang = '$bidang' AND 
                jabatan != 'KEPALA BIDANG' ");
        }

        return $query->getResultArray();
    }

    // selector atasan untuk kantor pusat

    // SK dibawah presiden direktur
    public function getPresdir()
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE jabatan = 'Pengurus BCA Syariah' AND departemen='Presiden Direktur' ");
        return $query->getRowArray();
    }

    public function getDirPranata()
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE jabatan = 'Pengurus BCA Syariah' AND departemen='Direktur' AND fnama = 'PRANATA' ");
        return $query->getRowArray();
    }

    public function getDirRickyadi()
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE jabatan = 'Pengurus BCA Syariah' AND departemen='Direktur' AND fnama = 'RICKYADI WIDJAJA' ");
        return $query->getRowArray();
    }

    public function getDirLukman()
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE jabatan = 'Pengurus BCA Syariah' AND departemen='Direktur' AND fnama = 'Lukman Hadiwijaya' ");
        return $query->getRowArray();
    }

    public function getDirHouda()
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE jabatan = 'Pengurus BCA Syariah' AND departemen='Direktur' AND fnama = 'HOUDA MULJANTI' ");
        return $query->getRowArray();
    }
    //atasan 1 berdasarkan database
    public function getAtasanLangsung($fnip)
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE fnip = (SELECT atasan_nip FROM atasan WHERE user_nip = '$fnip')");
        return $query->getRowArray();
    }

    //atasan 2 berdasarkan hierarki
    public function getKasat($satuan_kerja)
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE satuan_kerja = '$satuan_kerja' AND jabatan LIKE '%Kepala Satuan Kerja%' LIMIT 1");
        return $query->getRowArray();
    }

    public function getKadep($satuan_kerja, $departemen)
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE satuan_kerja = '$satuan_kerja' AND jabatan = 'Kepala Departemen' AND departemen = '$departemen' LIMIT 1");
        return $query->getRowArray();
    }

    public function getKabid($satuan_kerja, $departemen, $bidang)
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE satuan_kerja = '$satuan_kerja' AND jabatan = 'Kepala Bidang' AND departemen = '$departemen' AND bidang = '$bidang' LIMIT 1");
        return $query->getRowArray();
    }

    public function getKabag($satuan_kerja, $departemen, $bidang, $fungsi)
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE satuan_kerja = '$satuan_kerja' AND jabatan = 'Kepala Bagian' AND departemen = '$departemen' AND bidang = '$bidang' AND fungsi = '$fungsi' LIMIT 1");
        return $query->getRowArray();
    }

    //kantor cabang
    public function getKoc($satuan_kerja, $departemen)
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE satuan_kerja = '$satuan_kerja'  AND departemen = '$departemen' AND jabatan LIKE 'Kepala Operasi Cabang' LIMIT 1");
        return $query->getRowArray();
    }

    public function getKacab($satuan_kerja, $departemen)
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE satuan_kerja = '$satuan_kerja'  AND departemen = '$departemen' AND jabatan LIKE '%Kepala Cabang%' LIMIT 1");
        return $query->getRowArray();
    }

    public function getKaSbk()
    {
        $query   = $this->db->query("SELECT fnip, fnama FROM pekerja WHERE satuan_kerja = 'SATUAN KERJA BISNIS DAN KOMUNIKASI' AND jabatan LIKE '%Kepala Satuan Kerja%' LIMIT 1");
        return $query->getRowArray();
    }

    //User Password
    public function getUserPassword($fnip)
    {
        $query   = $this->db->query("SELECT password FROM auth WHERE fnip = '$fnip' ");
        return $query->getRowArray();
    }

    public function changeUserPassword($fnip, $password)
    {
        $query = $this->db->query("UPDATE auth SET password='$password' WHERE fnip='$fnip'");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    //HAPUS AKUN PEKERJA
    public function delete_account($fnip)
    {
        $query = $this->db->query("DELETE FROM pekerja WHERE fnip= '$fnip' ");
        return $query;
    }


    public function getActiveAccountWithEmail()
    {
        $query = $this->db->query("SELECT p.fnip, p.fnama, p.email, a.last_change_password from pekerja as p LEFT JOIN auth as a ON p.fnip = a.userid WHERE p.email != '' AND a.is_active is true AND a.is_blocked is false AND a.last_change_password < now() - INTERVAL 16 DAY")->getResultArray();
        // dd($query);


        return $query;
    }

    public function isPasswordExpired($id)
    {
        $query = $this->db->query("SELECT p.fnip, p.fnama, a.last_change_password from pekerja as p LEFT JOIN auth as a ON p.fnip = a.userid WHERE p.fnip = '$id' AND a.is_active is true AND a.is_blocked is false AND a.last_change_password < now() - INTERVAL 16 DAY")->getRowArray();

        return $query;
    }
}


// INSERT INTO `auth` (`userid`, `password`, `role`, `is_active`, `status`, `created_at`, `edited_at`, `deleted_at`) VALUES ('admin_sa1', MD5('Admin@123'), '1', '1', 'not set', current_timestamp(), current_timestamp(), current_timestamp()), ('admin_sa2', MD5('Admin@123'), '1', '1', 'not set', current_timestamp(), current_timestamp(), current_timestamp()), ('admin_hsd2', MD5('Admin@123'), '2', '1', 'not set', current_timestamp(), current_timestamp(), current_timestamp()), ('admin_hsd1', MD5('Admin@123'), '2', '1', 'not set', current_timestamp(), current_timestamp(), current_timestamp());