<?php

namespace App\Controllers\Penilaian;

use App\Controllers\BaseController;
use App\Models\Detail\DetailPenilaianModel;
use App\Models\PekerjaModel;
use App\Models\SuratPeringatan\SPModel;

class DetailPenilaian extends BaseController
{
    public function index()
    {
        return view('Home');
    }


    public function gol_123($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetail123($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', '123');

        return view('penilaian/pusat/detail/detail_pusat', $data);
    }

    public function gol_4f($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetail4f($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', '4f');
        return view('penilaian/pusat/detail/detail_pusat', $data);
    }

    public function gol_4s($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetail4s($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', '4s');
        return view('penilaian/pusat/detail/detail_pusat', $data);
    }

    public function gol_5f($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetail5f($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', '5f');
        return view('penilaian/pusat/detail/detail_pusat', $data);
    }

    public function gol_5s($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetail5s($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', '5s');
        return view('penilaian/pusat/detail/detail_pusat', $data);
    }

    public function gol_67($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetail67($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', '67');
        return view('penilaian/pusat/detail/detail_pusat', $data);
    }

    public function cab_gol_123($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetailCab123($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', 'cab_123');
        return view('penilaian/cabang/detail/detail_cabang', $data);
    }

    public function cab_gol_4s($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetailCab4s($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', 'cab_4s');
        return view('penilaian/cabang/detail/detail_cabang', $data);
    }

    public function cab_gol_uls($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetailCabKaULS($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', 'cab_uls');
        return view('penilaian/cabang/detail/detail_cabang', $data);
    }

    public function cab_gol_koc($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetailCabKaKOC($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', 'cab_koc');
        return view('penilaian/cabang/detail/detail_cabang', $data);
    }

    public function cab_gol_kcp($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetailCabKaKCP($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', 'cab_kcp');
        return view('penilaian/cabang/detail/detail_cabang', $data);
    }

    public function cab_gol_kc($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetailCabKaKCU($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', 'cab_kcu');
        return view('penilaian/cabang/detail/detail_cabang', $data);
    }

    public function cab_gol_ao($id_pn)
    {
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetailCabAO($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUserSpecificYear($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);

        $pekerjaModel = new PekerjaModel();
        $data['historicalPersonalData'] = $model->getHistoricalUser($data['info'][0]['fnip'], $data['info'][0]['tahun_pa']);
        $data['atasan1'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_satu'])->get()->getRowArray();
        $data['atasan2'] = $pekerjaModel->select('fnama')->where('fnip', $data['historicalPersonalData'][0]['penilai_dua'])->get()->getRowArray();

        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Riwayat Penilaian';
        session()->set('db_gol', 'cab_ao');
        return view('penilaian/cabang/detail/detail_cabang', $data);
    }

    //public function cab_gol_ao
}
