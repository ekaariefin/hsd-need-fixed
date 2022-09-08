<?php

namespace App\Controllers\Coaching;

use App\Controllers\BaseController;
use App\Models\Coaching\CoachingModel;
use App\Models\Config\CoachingConfigModel;
use App\Models\Karyawan\AtasanModel;
use App\Models\PekerjaModel;
use App\Models\Trail;

use function PHPUnit\Framework\countOf;

class Coaching extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->modelCoaching = new CoachingModel();
    }

    public function index()
    {

        $nip = session()->fnip;
        $bawahan = new AtasanModel();
        $data['karyawan'] = $bawahan->getBawahan();
        $data['data'] = $this->modelCoaching->getListCoaching($nip, true);

        $periode = new CoachingConfigModel();
        $data['openForm'] = $periode->findAll();
        // dd($data['openForm']);
        // print_r($this->request->getUserAgent()->getReferrer());

        // print_r($_SESSION);
        // die();
        $data['title'] = 'Daftar Coaching | PT Bank BCA Syariah';
        $data['pageHeader'] = 'Tambah Coaching';
        $data['active'] = 'Tambah Coaching';

        $data['coaching_available'] = (object)$this->isCoachingAvailable();

        $coachingPeriode = $data['coaching_available'];
        if ($coachingPeriode->periode_1 && $coachingPeriode->periode_2) {
            $data['is_both_period_active'] = true;
            $data['current_period'] = 99;

            $thisYear = date("Y");
            $coachingSemester1 = $this->modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", $nip)->where("tanggal_coaching BETWEEN '$thisYear-01-01' AND '$thisYear-06-30'")->get()->getResultArray();
            $coachedEmployee1 = [];

            $coachee = [];
            foreach ($data['karyawan'] as $key) {
                $coachee[] = $key['fnip'];
            }
            foreach ($coachingSemester1 as $key) {
                $coachedEmployee1[] = $key['fnip'];
            }
            $belumCoachingSemester1 = array_diff($coachee, $coachedEmployee1);


            $coachingSemester2 = $this->modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", session()->fnip)->where("tanggal_coaching BETWEEN '$thisYear-07-01' AND '$thisYear-12-31'")->get()->getResultArray();
            $coachedEmployee2 = [];
            foreach ($coachingSemester2 as $key) {
                $coachedEmployee2[] = $key['fnip'];
            }
            $belumCoachingSemester2 = array_diff($coachee, $coachedEmployee2);
        } else {
            $data['is_both_period_active'] = false;

            if ($coachingPeriode->periode_1) {
                $data['current_period'] = 1;
                $thisYear = date("Y");
                $coachingSemester1 = $this->modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", $nip)->where("tanggal_coaching BETWEEN '$thisYear-01-01' AND '$thisYear-06-30'")->get()->getResultArray();
                $coachedEmployee1 = [];

                $coachee = [];
                foreach ($data['karyawan'] as $key) {
                    $coachee[] = $key['fnip'];
                }
                foreach ($coachingSemester1 as $key) {
                    $coachedEmployee1[] = $key['fnip'];
                }
                $belumCoachingSemester1 = array_diff($coachee, $coachedEmployee1);
            } elseif (($coachingPeriode->periode_2)) {
                $data['current_period'] = 2;
                $thisYear = date("Y");
                $coachingSemester1 = $this->modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", $nip)->where("tanggal_coaching BETWEEN '$thisYear-01-01' AND '$thisYear-06-30'")->get()->getResultArray();
                $coachedEmployee1 = [];

                $coachee = [];
                foreach ($data['karyawan'] as $key) {
                    $coachee[] = $key['fnip'];
                }
                foreach ($coachingSemester1 as $key) {
                    $coachedEmployee1[] = $key['fnip'];
                }
                $belumCoachingSemester1 = array_diff($coachee, $coachedEmployee1);


                $coachingSemester2 = $this->modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", session()->fnip)->where("tanggal_coaching BETWEEN '$thisYear-07-01' AND '$thisYear-12-31'")->get()->getResultArray();
                $coachedEmployee2 = [];
                foreach ($coachingSemester2 as $key) {
                    $coachedEmployee2[] = $key['fnip'];
                }
                $belumCoachingSemester2 = array_diff($coachee, $coachedEmployee2);
            } else {
                $data['current_period'] = 0;
            }
        }


        $pekerjaModel = new PekerjaModel();

        if (isset($belumCoachingSemester1)) {
            try {
                $getData = $pekerjaModel->select("fnip, fnama")->whereIn("fnip", $belumCoachingSemester1)->get()->getResultArray();
                $data['coachingQueue1'] = $getData;
            } catch (\Throwable $th) {
            }
        }
        if (isset($belumCoachingSemester2)) {
            try {
                $getData = $pekerjaModel->select("fnip, fnama")->whereIn("fnip", $belumCoachingSemester2)->get()->getResultArray();
                $data['coachingQueue2'] = $getData;
            } catch (\Throwable $th) {
            }
        }
        $x = [];

        // dd(sizeof($x));

        return view('coaching/tambah_coaching', $data);
    }

    // MARK: Menampilkan seluruh riwayat coaching yang telah dilakukan di BCA Syariah
    public function historyCoaching()
    {

        $params = $this->request->getGet();
        $data['keyword'] = null;

        $keyword = "";
        if (isset($params) && isset($params['keyword'])) {
            $keyword = $params['keyword'];
            if ($keyword === "") return redirect()->to(base_url("coaching/histori-all"));
            $data['keyword'] = $keyword;
        }

        $data['data_per_page'] = 10;
        $data['title'] = 'Riwayat Data Coaching | PT Bank BCA Syariah';
        $data['pageHeader'] = 'Riwayat Coaching';
        $data['active'] = 'Riwayat Coaching';
        $data['data'] = $this->modelCoaching->getAllCoaching(false, $keyword, 10);
        $data['pager'] = $this->modelCoaching->pager;
        $data['page_number'] = $this->request->getVar('page_coaching') ? $this->request->getVar('page_coaching') : 1;



        return view('coaching/riwayat_seluruh_coaching', $data);
    }

    public function detailCoachingFull($id)
    {

        $data['title'] = 'Detail Coaching | PT Bank BCA Syariah';
        $data['pageHeader'] = 'Detail Coaching';
        $data['active'] = 'Riwayat Coaching';
        $query = $this->modelCoaching->getDetailCoachingPure($id);

        $data['id'] = $id;
        $data['atasan'] = $query['atasan'];
        $data['karyawan'] = $query['karyawan'];
        $data['perilaku'] = $query['perilaku_kerja'];
        $data['dukungan'] = $query['dukungan'];
        $data['sarbis'] = $query['sarbis'];
        $data['tanggal'] = $query['tanggal'];
        $data['tanggal_input_data'] = $query['tanggal_input_data'];
        $data['tanggal_konfirmasi_coaching'] = $query['tanggal_konfirmasi_coaching'];
        $data['periode'] = $query['periode'];
        $data['status'] = $query['status'];
        // dd($data['tanggal_konfirmasi_coaching']);

        return view('coaching/detail_coaching_admin_hsd', $data);
    }

    public function listEmployeeCoaching()
    {
        $nip = session()->get('fnip');
        $data['title'] = 'Riwayat Data Coaching | PT Bank BCA Syariah';
        $data['pageHeader'] = 'Riwayat Coaching';
        $data['active'] = 'Riwayat Coaching';
        $data['data'] = $this->modelCoaching->getListCoaching("$nip");
        // dd($data);



        return view('coaching/riwayat_coaching_karyawan', $data);
    }

    // MARK: Untuk melihat detail coaching bagi karyawan, otomatis ditinjau untuk melihat sebagai atasan atau bawahan
    public function detailCoaching($type = 0, $id)
    {
        $query = $this->modelCoaching->getDetailCoachingPure($id);

        $data['id'] = $id;
        $data['atasan'] = $query['atasan'];
        $data['karyawan'] = $query['karyawan'];
        $data['perilaku'] = $query['perilaku_kerja'];
        $data['dukungan'] = $query['dukungan'];
        $data['sarbis'] = $query['sarbis'];
        $data['tanggal'] = $query['tanggal'];
        $data['tanggal_input_data'] = $query['tanggal_input_data'];
        $data['tanggal_konfirmasi_coaching'] = $query['tanggal_konfirmasi_coaching'];
        $data['periode'] = $query['periode'];
        $data['status'] = $query['status'];

        // dd($data);
        if ($type == 0) {
            if (!($data['karyawan']['nip'] === session()->fnip)) {
                return redirect()->to(base_url('/coaching/history'));
            }
            $data['title'] = 'Detail Coaching | PT Bank BCA Syariah';
            $data['pageHeader'] = 'Detail Coaching';
            $data['active'] = 'Riwayat Coaching';

            return view('coaching/detail_coaching_karyawan', $data);
        } else {
            // if (!($data['atasan']['nip'] === session()->fnip)) {
            //     return redirect()->to(base_url('/coaching'));
            // }

            // dd($data);
            $data['title'] = 'Detail Coaching | PT Bank BCA Syariah';
            $data['pageHeader'] = 'Detail Coaching Karyawan Anda';
            $data['active'] = 'Tambah Coaching';

            session()->set('last_edit', $data['karyawan']['nip']);

            return view('coaching/detail_coaching', $data);
        }
    }

    // MARK: untuk mengedit hasil coaching yang belum dikonfirmasi karyawan
    public function editCoaching($id)
    {
        $validation = \Config\Services::validation();
        $data['validation'] = $validation;

        $query = $this->modelCoaching->getDetailCoachingPure($id);
        if (isset(session()->sarbis_count)) {
            $data['limit_sarbis'] = (int)session()->sarbis_count;
        } else {
            $data['limit_sarbis'] = 3;
        }
        if (session()->perilaku_kerja_count) {
            $data['limit_perilaku_kerja'] = (int)session()->perilaku_kerja_count;
        } else {
            $data['limit_perilaku_kerja'] = 3;
        }

        $data['coachee'] = session()->last_edit;

        $data['id'] = $id;
        $data['atasan'] = $query['atasan'];
        $data['karyawan'] = $query['karyawan'];
        $data['perilaku'] = $query['perilaku_kerja'];
        $data['dukungan'] = $query['dukungan'];
        $data['sarbis'] = $query['sarbis'];
        $data['tanggal'] = $query['tanggal'];
        $data['periode'] = $query['periode'];
        $data['status'] = $query['status'];
        // dd($data)

        if (!($data['atasan']['nip'] === session()->fnip)) {
            return redirect()->to(base_url('/coaching'));
        }
        $data['title'] = 'Detail Coaching | PT Bank BCA Syariah';
        $data['pageHeader'] = 'Detail Coaching Karyawan Anda';
        $data['active'] = 'Tambah Coaching';

        return view('coaching/formulir_edit_coaching', $data);
    }

    public function deleteCoaching()
    {
        $postData = $this->request->getVar();
        $id = $postData['id'];
        $delete = $this->modelCoaching->delete(strval($id));
        if (!$delete) {
            return redirect()->to(base_url("/coaching/detail_karyawan/" . strval($id)))->with('message', '<div class="container-fluid"><div class="alert alert-success">hasil coaching gagal dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>  </div>');
        }

        loggerActivity('DELETE COACHING');

        return redirect()->to(base_url('coaching'))->with('message', '<div class="container-fluid"><div class="alert alert-success">hasil coaching berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>  </div>');
    }

    public function addCoaching()
    {
        $validation = \Config\Services::validation();
        $data['validation'] = $validation;
        $coacheeData = $this->request->getVar();
        $bawahan = new AtasanModel();
        $data['karyawan'] = $bawahan->getBawahan();
        $coachingPeriode = (object)$this->isCoachingAvailable();
        if ($coachingPeriode->periode_1 && $coachingPeriode->periode_2) {

            $data['is_both_period_active'] = true;
            $data['current_period'] = 99;
        } else {
            $data['is_both_period_active'] = false;

            if ($coachingPeriode->periode_1) {
                $data['current_period'] = 1;
            } elseif ($coachingPeriode->periode_2) {
                $data['current_period'] = 2;
            } else {
                return redirect()->to(base_url('coaching'))->withInput()->with('info', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Formulir pengisian coaching belum dibuka
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ');
            }
        }

        // dd($data);

        if (isset(session()->sarbis_count)) {
            $data['limit_sarbis'] = (int)session()->sarbis_count;
        } else {
            $data['limit_sarbis'] = 3;
        }
        if (session()->perilaku_kerja_count) {
            $data['limit_perilaku_kerja'] = (int)session()->perilaku_kerja_count;
        } else {
            $data['limit_perilaku_kerja'] = 2;
        }


        if (!empty($coacheeData)) {
            $data['coachee'] = $coacheeData;
            session()->set('last_coachee', $coacheeData);
        } else {
            $data['coachee'] = session()->get('last_coachee');
        }

        $data['title'] = 'Tambah Coaching | PT Bank BCA Syariah';
        $data['pageHeader'] = 'Formulir Coaching';
        $data['active'] = 'Tambah Coaching';




        return view('coaching/formulir_coaching', $data);
    }

    public function saveEditCoaching()
    {
        $postData = $this->request->getVar();
        $id = $postData['id'];
        $nip = session()->fnip;

        $karyawanModel = new PekerjaModel();
        $karyawan = $karyawanModel->where('fnip', $postData['fnip_karyawan'])->get()->getRowArray();
        $atasan = $karyawanModel->where('fnip', $nip)->get()->getRowArray();

        $data = [
            'fnip_atasan' => $nip,
            'fnama_atasan' => $atasan['fnama'],
            'jabatan_atasan' => $atasan['jabatan'],
            'fgrade_atasan' => $atasan['fgrade'],
            'satuan_kerja_atasan' => $atasan['satuan_kerja'],
            'departemen_atasan' => $atasan['departemen'],
            'bidang_atasan' => $atasan['bidang'],
            'fungsi_atasan' => $atasan['fungsi'],
            'fnip_karyawan' => $postData['fnip_karyawan'],
            'fnama_karyawan' => $karyawan['fnama'],
            'jabatan_karyawan' => $karyawan['jabatan'],
            'fgrade_karyawan' => $karyawan['fgrade'],
            'satuan_kerja_karyawan' => $karyawan['satuan_kerja'],
            'departemen_karyawan' => $karyawan['departemen'],
            'bidang_karyawan' => $karyawan['bidang'],
            'fungsi_karyawan' => $karyawan['fungsi'],
            'tanggal_coaching' => $postData['tanggal_coaching'],
            'periode_coaching' => $postData['periode'],
            'saran_dukungan' => htmlspecialchars($postData['dukungan'])
        ];

        $i = 0;
        foreach ($postData['sasaran_bisnis']['sarbis'] as $sarbis) {
            $index = $i + 1;
            $data["sarbis$index"] = htmlspecialchars($sarbis);
            $data["target_tercapai$index"] = htmlspecialchars($postData['sasaran_bisnis']['realisasi'][$i]);

            $val['sasaran_bisnis.sarbis.' . strval($i)] =  [
                'label' => 'formulir',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} kurang dari 6 karakter',
                ]
            ];
            $val['sasaran_bisnis.realisasi.' . strval($i)] = [
                'label' => 'formulir',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} kurang dari 6 karakter',
                ]
            ];
            $i++;
        }
        for ($j =  $i + 1; $j < 9; $j++) {
            $data["sarbis$j"] = null;
            $data["target_tercapai$j"] = null;
        }

        $i = 0;
        foreach ($postData['perilaku_kerja'] as $perilaku) {
            $index = $i + 1;
            $data["budaya_kerja$index"] = $perilaku;

            $val['perilaku_kerja.' . strval($i)] = [
                'label' => 'formulir perilaku kerja',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} kurang dari 6 karakter',
                ]
            ];
            $i++;
        }
        for ($j = $i + 1; $j < 11; $j++) {
            $data["budaya_kerja$j"] = null;
        }


        $val['dukungan'] = [
            'label' => 'saran dan dukungan',
            'rules' => 'required|min_length[10]',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'min_length' => '{field} kurang dari 6 karakter',
            ]
        ];

        if (!$this->validate($val)) {
            session()->setFlashdata('sarbis_count', sizeof($postData['sasaran_bisnis']['sarbis']));
            session()->setFlashdata('perilaku_kerja_count', sizeof($postData['perilaku_kerja']));
            session()->setFlashdata('attempt', true);

            return redirect()->to(base_url("/coaching/edit/$id"))->withInput()->with('validation', $this->validator);
        }

        $this->modelCoaching->update($id, $data);

        loggerActivity('EDIT COACHING');

        return redirect()->to(base_url("/coaching/detail_karyawan/" . strval($id)))->with('message', '<div class="container-fluid"><div class="alert alert-success">hasil coaching telah berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>  </div>');
    }

    public function saveCoaching()
    {
        $postData = $this->request->getVar();
        $nip = session()->fnip;

        $karyawanModel = new PekerjaModel();
        $karyawan = $karyawanModel->where('fnip', $postData['fnip_karyawan'])->get()->getRowArray();
        $atasan = $karyawanModel->where('fnip', $nip)->get()->getRowArray();

        $data = [
            'id' => uniqid(),
            'fnip_atasan' => $nip,
            'fnama_atasan' => $atasan['fnama'],
            'jabatan_atasan' => $atasan['jabatan'],
            'fgrade_atasan' => $atasan['fgrade'],
            'satuan_kerja_atasan' => $atasan['satuan_kerja'],
            'departemen_atasan' => $atasan['departemen'],
            'bidang_atasan' => $atasan['bidang'],
            'fungsi_atasan' => $atasan['fungsi'],
            'fnip_karyawan' => $postData['fnip_karyawan'],
            'fnama_karyawan' => $karyawan['fnama'],
            'jabatan_karyawan' => $karyawan['jabatan'],
            'fgrade_karyawan' => $karyawan['fgrade'],
            'satuan_kerja_karyawan' => $karyawan['satuan_kerja'],
            'departemen_karyawan' => $karyawan['departemen'],
            'bidang_karyawan' => $karyawan['bidang'],
            'fungsi_karyawan' => $karyawan['fungsi'],
            'tanggal_coaching' => $postData['tanggal_coaching'],
            'periode_coaching' => $postData['periode'],
            'saran_dukungan' => htmlspecialchars($postData['dukungan'])
        ];

        // $data = [
        //     'id' => uniqid(),
        //     'fnip_atasan' => $nip,
        //     'fnip_karyawan' => $postData['fnip_karyawan'],
        //     'tanggal_coaching' => $postData['tanggal_coaching'],
        //     'periode_coaching' => $postData['periode'],
        //     'saran_dukungan' => htmlspecialchars($postData['dukungan'])
        // ];

        $i = 0;
        foreach ($postData['sasaran_bisnis']['sarbis'] as $sarbis) {
            $index = $i + 1;
            $data["sarbis$index"] = htmlspecialchars($sarbis);
            $data["target_tercapai$index"] = htmlspecialchars($postData['sasaran_bisnis']['realisasi'][$i]);

            $val['sasaran_bisnis.sarbis.' . strval($i)] =  [
                'label' => 'formulir',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} kurang dari 6 karakter',
                ]
            ];
            $val['sasaran_bisnis.realisasi.' . strval($i)] = [
                'label' => 'formulir',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} kurang dari 6 karakter',
                ]
            ];
            $i++;
        }

        $i = 0;
        foreach ($postData['perilaku_kerja'] as $perilaku) {
            $index = $i + 1;
            $data["budaya_kerja$index"] = $perilaku;

            $val['perilaku_kerja.' . strval($i)] = [
                'label' => 'formulir perilaku kerja',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} kurang dari 6 karakter',
                ]
            ];
            $i++;
        }

        $val['dukungan'] = [
            'label' => 'saran dan dukungan',
            'rules' => 'required|min_length[10]',
            'errors' => [
                'required' => '{field} tidak boleh kosong',
                'min_length' => '{field} kurang dari 6 karakter',
            ]
        ];

        if (!$this->validate($val)) {
            session()->setFlashdata('sarbis_count', sizeof($postData['sasaran_bisnis']['sarbis']));
            session()->setFlashdata('perilaku_kerja_count', sizeof($postData['perilaku_kerja']));
            return redirect()->to(base_url('coaching/add'))->withInput()->with('validation', $this->validator);
        }

        $query = $this->modelCoaching->save($data);

        $pekerjaModel = new PekerjaModel();
        $sendToMail = $pekerjaModel->where('fnip', $data['fnip_karyawan'])->get()->getRow();
        $target_name = $sendToMail->fnama;

        if ($sendToMail->email != '') {
            $send = $this->_sendEmail($sendToMail->email, '[eCoaching] Hasil Coaching', view('mail-style/mail_coaching', ['target_name' => "$target_name"]));

            // if (!$send) {
            //     return redirect()->to(base_url('forgot-password'))->with('message', '<div class="alert alert-danger">Gagal mengirim tautan ke email anda <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div> ');
            // }
        }



        if (!$query) {
            return redirect()->to(base_url("/coaching"))->with('message', '<div class="container-fluid"><div class="alert alert-danger">Gagal menambahkan data coaching<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>  </div>');
        }

        loggerActivity('ADD COACHING');



        return redirect()->to(base_url("/coaching"))->with('message', '<div class="container-fluid"><div class="alert alert-success">Data coaching berhasil ditambahkan<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>  </div>');
    }

    public function commitCoaching()
    {
        $id = $this->request->getVar('id');

        // $this->modelCoaching->set($data)->where('id', $id)->update();
        $update = $this->modelCoaching->set('status', true)->set('tanggal_konfirmasi_coaching', date('Y-m-d'))->where('id', $id)->update();

        if (!$update) {
            return redirect()->to(base_url("/coaching/detail/$id"))->with('message', '<div class="container-fluid"><div class="alert alert-danger">Gagal menyetujui hasil coaching<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>  </div>');
        }

        loggerActivity('CONFIRM COACHING');
        return redirect()->to(base_url("/coaching/detail/$id"))->with('message', '<div class="container-fluid"><div class="alert alert-success">hasil coaching telah berhasil anda disetujui<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>  </div>');
    }

    private function isCoachingAvailable()
    {
        $periodeModel = new CoachingConfigModel();
        $data = $periodeModel->getPeriodeConfig();
        $now = time();
        $i = 0;
        $periodAvailable = ['periode_1' => false, 'periode_2' => false];
        foreach ($data as $periods) {
            $i++;
            if ($now > $periods['tanggal_buka'] && $now < $periods['tanggal_tutup']) {
                $periodAvailable['periode_' . $i] = true;
            }
        }

        return $periodAvailable;
    }

    private function _sendEmail($to, $title, $message)
    {
        $email = \Config\Services::email();
        $email->setFrom('noreply.bcas@gmail.com', 'PT Bank BCA Syariah');
        $email->setTo($to);
        $email->setSubject($title);
        $email->setMessage($message);
        if (!$email->send()) {
            return false;
        }
        return true;
    }
}
