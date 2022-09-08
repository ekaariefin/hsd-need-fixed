<?php

namespace App\Controllers\Penilaian;

use App\Controllers\BaseController;
use App\Models\Detail\DetailPenilaianModel;
use App\Models\PekerjaModel;
use App\Models\SuratPeringatan\SPModel;

class UnduhPenilaianIndividu extends BaseController
{
    public function index($gol, $id_pn)
    {
        if ($gol == '123') {
            $this->gol_123($id_pn);
        } else if ($gol == '4f') {
            $this->gol_4f($id_pn);
        } else if ($gol == '4s') {
            $this->gol_4s($id_pn);
        } else if ($gol == '5f') {
            $this->gol_5f($id_pn);
        } else if ($gol == '5s') {
            $this->gol_5s($id_pn);
        } else if ($gol == '67') {
            $this->gol_67($id_pn);
        } else if ($gol == 'cab_123') {
            $this->cab_gol_123($id_pn);
        } else if ($gol == 'cab_4s') {
            $this->cab_gol_4s($id_pn);
        } else if ($gol == 'cab_ao') {
            $this->cab_gol_ao($id_pn);
        } else if ($gol == 'cab_koc') {
            $this->cab_gol_koc($id_pn);
        } else if ($gol == 'cab_kcp') {
            $this->cab_gol_kcp($id_pn);
        } else if ($gol == 'cab_kcu') {
            $this->cab_gol_kc($id_pn);
        } else if ($gol == 'cab_uls') {
            $this->cab_gol_uls($id_pn);
        }
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        // dd($data);

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename, array('Attachment' => 0));
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
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

        $filename =  'DAFTAR PENILAIAN KINERJA INDIVIDU BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $dompdf->loadHtml(view('penilaian/pdf/individu', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    //public function cab_gol_ao
}
