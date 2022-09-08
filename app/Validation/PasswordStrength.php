<?php

namespace App\Validation;

use App\Models\Auth\M_Auth;
use App\Models\PekerjaModel;
use Config\Database;

class PasswordStrength
{

    public $uppercaseCheck = false;
    public $numericCheck = false;
    public $specialCharacterCheck = false;

    public function is_there_uppercase(?string $str, string &$error = null)
    {
        $this->uppercaseCheck = strtolower($str) !== $str;
        if ($this->uppercaseCheck) {
            return true;
        }

        $error = "password harus mengandung kombinasi huruf kapital dan non-kapital";
        return false;
    }

    public function is_there_special_character(?string $str, string &$error = null)
    {
        $this->specialCharacterCheck = (bool) preg_match('/[^A-Za-z0-9]/', $str);
        if ($this->specialCharacterCheck) {
            return true;
        }

        $error = "kata sandi harus memiliki kombinasi karakter khusus";
        return false;
    }

    public function is_there_number(?string $str, string &$error = null)
    {
        $this->numericCheck = (bool) preg_match('/[0-9]/', $str);
        if ($this->numericCheck) {
            return true;
        }

        $error = "kata sandi harus memiliki kombinasi angka";
        return false;
    }

    public function is_password_true(?string $str, string $field, array $data, string &$error = null)
    {
        [$field, $userid, $whereField, $whereValue, $mode] = array_pad(explode(',', $field), 5, null);
        $error = "Password yang dimasukkan tidak sesuai";
        $str = md5($str);

        // Break the table and field apart
        sscanf($field, '%[^.].%[^.]', $table, $field);

        $id = (!empty($mode)) ?  $userid : $data[$userid];

        $row = Database::connect($data['DBGroup'] ?? null)
            ->table($table)
            ->select('1')
            ->where($field, $id)
            ->where('password', $str)
            ->limit(1);

        if (!empty($whereField) && !empty($whereValue) && !preg_match('/^\{(\w+)\}$/', $whereValue)) {
            $row = $row->where($whereField, $whereValue);
        }

        return $row->get()->getRow() !== null;
    }

    public function is_user_active(?string $str, string &$error = null)
    {
        $pekerjaModel = new PekerjaModel();
        $fnip = $pekerjaModel->where('email', $str)->get()->getRow()->fnip;


        $error = "user dengan email ini tidak aktif";
        if (!$fnip) return false;
        $user = new M_Auth();
        $is_active = $user->where('userid', $fnip)->limit(1)->get()->getRow()->is_active;
        if (!(int)$is_active) {
            return false;
        }

        $is_blocked = $user->where('userid', $fnip)->limit(1)->get()->getRow()->is_blocked;

        if (!(int)$is_blocked) {
            return true;
        }
        $error = "akun anda diblokir silahkan hubungi administrator untuk membukanya kembali";
        return false;
    }
    public function is_blocked(?string $str, string &$error = null)
    {
        $user = new M_Auth();

        $is_blocked = $user->where('userid', $str)->limit(1)->get()->getRow()->is_blocked;

        if (!(int)$is_blocked) {
            return true;
        }

        $error = "akun anda telah diblokir";
        return false;
    }
}
