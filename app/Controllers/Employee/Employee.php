<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\PekerjaModel;

class Employee extends BaseController
{
    // public function __construct()
    // {
    //     $session = session();
    // }

    public function index()
    {
        $model = new PekerjaModel();
        $data['title'] = 'Daftar Karyawan | BCA Syariah';
        $data['getPekerja'] = $model->getPekerja();
        return view('karyawan/daftar_karyawan', $data);
    }

    public function detail()
    {
        $data['title'] = 'Detail Karyawan | BCA Syariah';
        return view('karyawan/detail_karyawan', $data);
    }

    public function daftar_karyawan()
    {
        $model = new PekerjaModel();
        $data['title'] = 'Daftar Karyawan Dibawahi | BCA Syariah';
        $data['getPekerja'] = $model->getPekerjaDibawahi();
        return view('karyawan/daftar_dibawahi', $data);
    }
}
