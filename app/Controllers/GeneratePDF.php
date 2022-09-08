<?php

namespace App\Controllers;

use App\Models\Detail\DetailPenilaianModel;
use App\Models\SuratPeringatan\SPModel;
use CodeIgniter\Controller;

class GeneratePDF extends Controller
{


    public function index()
    {
        return view('pdf-view');
    }

    function htmlToPDF($id_pn)
    {
        $filename = date('y-m-d-H-i-s') . 'Hasil Penilaian PA Tahun ' . date('Y') . ' - ' . session()->get('fnama') . '';
        $dompdf = new \Dompdf\Dompdf(['isRemoteEnabled' => true]);
        $model = new DetailPenilaianModel();
        $sp = new SPModel();
        $data['info'] = $model->getDetail123($id_pn, session()->get('fnip'));
        $data['sp'] = $sp->getDataUser($data['info'][0]['fnip']);
        $data['title'] = 'PT Bank BCA Syariah | Detail Penilaian';
        $data['active'] = 'Detail Penilaian';
        $dompdf->loadHtml(view('list', $data));
        $dompdf->setPaper('A4', 'portait');
        $dompdf->render();
        $dompdf->stream($filename);
    }
}
