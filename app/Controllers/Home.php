<?php

namespace App\Controllers;

use App\Models\Auth\M_Auth;
use App\Models\Coaching\CoachingModel;
use App\Models\Config\CoachingConfigModel;
use App\Models\Karyawan\AtasanModel;
use App\Models\Otorisasi\OtorisasiModel;
use App\Models\PekerjaModel;
use App\Models\SarbisModel;
use App\Models\SuratPeringatan\SPModel;

class Home extends BaseController
{
        public function __construct()
        {
                if ((int)session()->role === 3) {
                        $bawahan = new AtasanModel();
                        $modelCoaching = new CoachingModel();
                        $PekerjaModel = new PekerjaModel();
                        $nip = (string)session()->fnip;
                        $data['karyawan'] = $bawahan->getBawahanWajibCoaching();
                        $data['coaching_available'] = (object)$this->isCoachingAvailable();

                        $coachingPeriode = $data['coaching_available'];
                        if ($coachingPeriode->periode_1 && $coachingPeriode->periode_2) {
                                $data['is_both_period_active'] = true;
                                $data['current_period'] = 99;

                                $thisYear = date("Y");
                                $coachingSemester1 = $modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", $nip)->where("tanggal_coaching BETWEEN '$thisYear-01-01' AND '$thisYear-06-30'")->get()->getResultArray();
                                $coachedEmployee1 = [];

                                $coachee = [];
                                foreach ($data['karyawan'] as $key) {
                                        $coachee[] = $key['fnip'];
                                }
                                foreach ($coachingSemester1 as $key) {
                                        $coachedEmployee1[] = $key['fnip'];
                                }
                                $belumCoachingSemester1 = array_diff($coachee, $coachedEmployee1);


                                $coachingSemester2 = $modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", session()->fnip)->where("tanggal_coaching BETWEEN '$thisYear-07-01' AND '$thisYear-12-31'")->get()->getResultArray();
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
                                        $coachingSemester1 = $modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", $nip)->where("tanggal_coaching BETWEEN '$thisYear-01-01' AND '$thisYear-06-30'")->get()->getResultArray();
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
                                        $coachingSemester1 = $modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", $nip)->where("tanggal_coaching BETWEEN '$thisYear-01-01' AND '$thisYear-06-30'")->get()->getResultArray();
                                        $coachedEmployee1 = [];

                                        $coachee = [];
                                        foreach ($data['karyawan'] as $key) {
                                                $coachee[] = $key['fnip'];
                                        }
                                        foreach ($coachingSemester1 as $key) {
                                                $coachedEmployee1[] = $key['fnip'];
                                        }
                                        $belumCoachingSemester1 = array_diff($coachee, $coachedEmployee1);


                                        $coachingSemester2 = $modelCoaching->select("fnip_karyawan as fnip")->where("fnip_atasan", session()->fnip)->where("tanggal_coaching BETWEEN '$thisYear-07-01' AND '$thisYear-12-31'")->get()->getResultArray();
                                        $coachedEmployee2 = [];
                                        foreach ($coachingSemester2 as $key) {
                                                $coachedEmployee2[] = $key['fnip'];
                                        }
                                        $belumCoachingSemester2 = array_diff($coachee, $coachedEmployee2);
                                } else {
                                        $data['current_period'] = 0;
                                }
                        }


                        if (isset($belumCoachingSemester1)) {
                                // $getData = $PekerjaModel->select("fnip, fnama")->whereIn("fnip", $belumCoachingSemester1)->get()->getResultArray();
                                // $this->coachingQueue1 = $getData;
                                try {
                                        $getData = $PekerjaModel->select("fnip, fnama")->whereIn("fnip", $belumCoachingSemester1)->get()->getResultArray();
                                        $this->coachingQueue1 = $getData;
                                } catch (\Throwable $th) {
                                }
                        }
                        if (isset($belumCoachingSemester2)) {

                                // $getData = $PekerjaModel->select("fnip, fnama")->whereIn("fnip", $belumCoachingSemester2)->get()->getResultArray();
                                // $this->coachingQueue2 = $getData;
                                try {
                                        $getData = $PekerjaModel->select("fnip, fnama")->whereIn("fnip", $belumCoachingSemester2)->get()->getResultArray();
                                        $this->coachingQueue2 = $getData;
                                } catch (\Throwable $th) {
                                }
                        }
                }
        }
        public function index()
        {


                if (isset($this->coachingQueue1)) {

                        $data['coachingQueue1'] = $this->coachingQueue1;;
                }

                if (isset($this->coachingQueue2)) {

                        $data['coachingQueue2'] = $this->coachingQueue2;
                }


                $supervisor = new AtasanModel();
                $data['title'] = 'Aplikasi Penilaian dan Coaching Pekerja | PT Bank BCA Syariah';
                $data['active'] = 'Dashboard';

                if (session()->role == '3' || session()->role == '4') {
                        $coaching = new CoachingModel();
                        $data['coaching'] = $coaching->getPendingCoaching(session()->fnip);
                }

                //MARK: DEFINE MODEL
                $pekerjaModel = new PekerjaModel();
                $spModel = new SPModel();
                $coachingModel = new CoachingModel();
                $otorisasiModel = new OtorisasiModel();
                $atasanModel = new AtasanModel();
                $authModel = new M_Auth();
                $sarbisModel = new SarbisModel();

                //MARK: FOR WIDGET
                $data['count_all_pekerja']      = $pekerjaModel->where('jabatan !=', 'PENGURUS BCA SYARIAH')->countAllResults();
                // $data['count_all_sp']           = count($spModel->where('tahun_sp', date('Y'))->findAll());
                $data['count_all_sp']           = count($spModel->findAll());
                $data['is_password_expired']    = $pekerjaModel->isPasswordExpired((string)session()->fnip);

                //THIS IS FOR COACHING PERIOD CONFIGURATION
                $currentDate = date('Y-m-d');
                $currentDate = date('Y-m-d', strtotime($currentDate));
                $currentYear = date('Y');

                //SEMESTER 1
                $startDate = date('Y-m-d', strtotime($currentYear . '-01-01'));
                $endDate = date('Y-m-d', strtotime($currentYear . '-06-30'));
                $startDate2 = date('Y-m-d', strtotime($currentYear . '-07-01'));
                $endDate2 = date('Y-m-d', strtotime($currentYear . '-12-31'));


                if (($currentDate <= $endDate)) {
                        $data['descPeriod'] = 'Semester 1';
                        $data['count_coaching'] = $coachingModel->query('SELECT id FROM coaching WHERE tanggal_coaching BETWEEN "' . $startDate . '" AND "' . $endDate . ' " GROUP BY fnip_karyawan')->getResultArray();
                        $data['count_coaching'] = count($data['count_coaching']);
                } else {
                        $data['descPeriod'] = 'Semester 2';
                        $data['count_coaching'] = $coachingModel->query('SELECT id FROM coaching WHERE tanggal_coaching BETWEEN "' . $startDate2 . '" AND "' . $endDate2 . ' " GROUP BY fnip_karyawan')->getResultArray();
                        $data['count_coaching'] = count($data['count_coaching']);
                }

                $data['count_pa']               = $otorisasiModel->countAllData();
                $data['activeUser']             = $authModel->where('is_active', 1)->where('is_blocked != 1')->countAllResults();
                $data['nonactiveUser']          = $authModel->where('is_active', 0)->countAllResults();
                $data['blockUser']              = $authModel->where('is_blocked', 1)->where('is_active', 1)->countAllResults();


                //MARK: FOR CHART
                $data['count_stl']  = $pekerjaModel->where('satuan_kerja', 'SATUAN KERJA TI DAN LOGISTIK')->countAllResults();
                $data['count_sai']  = $pekerjaModel->where('satuan_kerja', 'SATUAN KERJA AUDIT INTERNAL')->countAllResults();
                $data['count_hsd']  = $pekerjaModel->where('satuan_kerja', 'SATUAN KERJA HUKUM DAN SDM')->countAllResults();
                $data['count_sbk']  = $pekerjaModel->where('satuan_kerja', 'SATUAN KERJA BISNIS DAN KOMUNIKASI')->countAllResults();
                $data['count_arp']  = $pekerjaModel->where('satuan_kerja', 'SATUAN KERJA ANALISA RISIKO PEMBIAYAAN')->countAllResults();
                $data['count_ska']  = $pekerjaModel->where('satuan_kerja', 'SATUAN KERJA KEUANGAN DAN PERENCANAAN PERUSAHAAN')->countAllResults();
                $data['count_mrk']  = $pekerjaModel->where('satuan_kerja', 'MANAJEMEN RISIKO')->countAllResults();
                $data['count_dop']  = $pekerjaModel->where('satuan_kerja', 'DIVISI OPERASI')->countAllResults();
                $data['count_kep']  = $pekerjaModel->where('satuan_kerja', 'KEPATUHAN')->countAllResults();

                //MARK: FOR EMPLOYEE DASHBOARD

                $pekerjaModel       = new PekerjaModel();
                $data['pekerja']    = $pekerjaModel->where('fnip', session()->get('fnip'))->get()->getRowArray();
                $data['cek_pa']     = $otorisasiModel->getSpecificDataPenilaian(session()->get('fnip'));

                //MARK: FOR SUPERVISOR DASHBOARD
                $otorisasiModel         = new OtorisasiModel();
                if (session()->role == '3') {
                        $data['countEmployee']  = count($atasanModel->getBawahanFull());
                        $data['countCoaching']  = count($coachingModel->where('fnip_atasan', session()->get('fnip'))->like('tanggal_coaching', date('Y'))->get()->getResultArray());
                        $data['countPA']        = count($otorisasiModel->getDataOto());

                        $where = "atasan1='" . session()->get('fnip') . "'OR atasan2='" . session()->get('fnip') . "'";
                        $sarbisModel->select("sarbis.*, pekerja.fnama, pekerja.jabatan, pekerja.departemen, pekerja.satuan_kerja, pekerja.bidang, pekerja.fungsi");
                        $sarbisModel->join("pekerja", "pekerja.fnip = sarbis.user_nip");
                        $data['countOtoSarbis'] = count($sarbisModel->where($where)->get()->getResultArray());
                }

                return view('dashboard/home', $data);
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
}
