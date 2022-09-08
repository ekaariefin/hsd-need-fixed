<?php

namespace App\Controllers\Penilaian\Otorisasi;

use App\Controllers\BaseController;
use App\Models\Otorisasi\OtorisasiKp;
use App\Models\Otorisasi\OtorisasiCab;

class OtorisasiDetail extends BaseController
{
    public function index()
    {
    }

    public function gol_123($id_pn)
    {
        $model = new OtorisasiKp();
        $data['info'] = $model->getDetail123($id_pn);
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Otorisasi PA';
        return view('penilaian/pusat/otorisasi/detail/gol_123', $data);
    }

    public function gol_4f($id_pn)
    {
        $model = new OtorisasiKp();
        $data['info'] = $model->getDetail4f($id_pn, session()->get('fnip'));
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Otorisasi PA';
        return view('penilaian/pusat/otorisasi/detail/gol_4f', $data);
    }

    public function gol_4s($id_pn)
    {
        $model = new OtorisasiKp();
        $data['info'] = $model->getDetail4s($id_pn, session()->get('fnip'));
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Otorisasi PA';
        return view('penilaian/pusat/otorisasi/detail/gol_5s', $data);
    }

    public function gol_5f($id_pn)
    {
        $model = new OtorisasiKp();
        $data['info'] = $model->getDetail5f($id_pn, session()->get('fnip'));
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Otorisasi PA';
        return view('penilaian/pusat/otorisasi/detail/gol_5f', $data);
    }

    public function gol_5s($id_pn)
    {
        $model = new OtorisasiKp();
        $data['info'] = $model->getDetail5s($id_pn, session()->get('fnip'));
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Otorisasi PA';
        return view('penilaian/pusat/otorisasi/detail/gol_5s', $data);
    }

    public function gol_67($id_pn)
    {
        $model = new OtorisasiKp();
        $data['info'] = $model->getDetail67($id_pn, session()->get('fnip'));
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Otorisasi PA';
        return view('penilaian/pusat/otorisasi/detail/gol_67', $data);
    }


    // kantor cabang
    public function cab_gol_123($id_pn)
    {
        $model = new OtorisasiCab();
        $data['info'] = $model->getDetail123($id_pn);
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Otorisasi PA';
        return view('penilaian/pusat/otorisasi/detail/gol_123', $data);
    }
}
