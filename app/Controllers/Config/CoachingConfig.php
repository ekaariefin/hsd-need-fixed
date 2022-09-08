<?php

namespace App\Controllers\Config;

use App\Controllers\BaseController;
use App\Models\Config\CoachingConfigModel;

class CoachingConfig extends BaseController
{
    public function __construct()
    {
        $this->periodeModel = new CoachingConfigModel();
    }
    public function index()
    {
        $data['title'] = 'Konfigurasi Coaching | PT Bank BCA Syariah';
        $data['active'] = 'conf_coaching';
        $data['months'] = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $data['pageHeader'] = 'Konfigurasi Coaching';

        $data['periode_coaching'] = $this->periodeModel->getPeriodeConfig();
        // dd($data['periode_coaching']);
        return view('config/coaching_config', $data);
    }

    public function savePeriodeCoaching()
    {
        if (session()->role != "2") {
            return json_encode(0);
        }

        $postData = $this->request->getVar();

        $start = strtotime(date('Y') . '-' . $postData['start_coaching']);
        $end = strtotime(date('Y') . '-' . $postData['end_coaching']);

        if ($end < $start) {
            return json_encode(0);
        }

        $query = $this->periodeModel->set($postData)->where(['id' => $postData['id']])->update();

        if ($query) {
            return json_encode(1);
        }
        return json_encode(0);
    }
}
