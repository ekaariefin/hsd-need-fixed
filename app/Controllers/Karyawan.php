<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth\M_Auth;
use App\Models\Karyawan\AtasanModel;
use App\Models\Otorisasi\OtorisasiModel;
use App\Models\PekerjaModel;
use App\Models\Struktur\DepartemenModel;
use PHPExcel;
use PHPExcel_IOFactory;

class Karyawan extends BaseController
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
        $this->model = new PekerjaModel();
        $this->atasanModel = new AtasanModel();
        $this->karyawanModel = new PekerjaModel();
        $this->authModel = new M_Auth();
    }

    public function index()
    {
        $data['title'] = 'Daftar Karyawan | PT Bank BCA Syariah';
        $data['getPekerja'] = $this->model->getPekerja();
        $data['active'] = 'Karyawan';
        $data['pageHeader'] = 'Daftar Karyawan';
        return view('karyawan/daftar_karyawan', $data);
    }

    public function detail()
    {
        $data['title'] = 'Detail Karyawan | PT Bank BCA Syariah';
        $data['active'] = 'Karyawan';
        $data['pageHeader'] = 'Informasi Karyawan';
        return view('karyawan/detail_karyawan', $data);
    }

    public function daftar_karyawan()
    {
        $data['title'] = 'Daftar Karyawan Dibawahi | PT Bank BCA Syariah';
        $data['getPekerja'] = $this->atasanModel->getBawahanFull();
        $data['pageHeader'] = 'Daftar Karyawan';
        // dd($data['getPekerja']);

        $data['active'] = 'Karyawan';
        return view('karyawan/daftar_dibawahi', $data);
    }

    public function detail_karyawan($fnip)
    {
        $seluruhKaryawan = $this->model->where('fnip', $fnip)->get()->getRowArray();
        $data['title'] = 'Detail Karyawan | PT Bank BCA Syariah';
        $data['info'] = $seluruhKaryawan;
        $data['active'] = 'Karyawan';
        $data['pageHeader'] = 'Informasi Karyawan';

        //MARK: AMBIL ATASAN PEKERJA
        $atasanModel = new AtasanModel();

        $atasan = $atasanModel->getAtasan($data['info']['fnip']);
        $data['atasan1'] = $atasan['atasan1'];
        // dd($data);
        return view('karyawan/detail_karyawan', $data);
    }

    public function tambahKaryawanIndividu()
    {
        $departemen = new DepartemenModel();
        $data['title'] = 'Ubah Karyawan | PT Bank BCA Syariah';
        $data['active'] = 'Karyawan';
        $data['departemen'] = $departemen->findAll();

        return view('karyawan/tambah_karyawan', $data);
    }

    public function edit_karyawan($fnip)
    {
        $seluruhKaryawan = $this->model->where('fnip', $fnip)->get()->getRowArray();
        $data['pageHeader'] = 'Ubah Data Karyawan';
        $data['title'] = 'Ubah Karyawan | PT Bank BCA Syariah';
        $data['info'] = $seluruhKaryawan;
        $data['active'] = 'Karyawan';
        return view('karyawan/edit_karyawan', $data);
    }

    public function edit_atasan($fnip)
    {
        $seluruhKaryawan = $this->model->where('fnip', $fnip)->get()->getRowArray();
        $data['info'] = $seluruhKaryawan;

        //MARK: AMBIL ATASAN PEKERJA
        $atasanModel = new AtasanModel();

        $data['pageHeader'] = 'Ubah Atasan';
        $atasan = $atasanModel->getAtasan($fnip);
        $data['atasan1'] = $atasan['atasan1']['fnip'];
        $data['atasan1_nama'] = $atasan['atasan1']['fnama'];
        $data['fnip'] = $fnip;
        $data['title'] = 'Ubah Atasan Karyawan | PT Bank BCA Syariah';
        $data['active'] = 'Karyawan';

        return view('karyawan/edit_atasan', $data);
    }

    public function delete_karyawan($fnip)
    {
        $data['title'] = 'Data Karyawan | PT Bank BCA Syariah';
        $pekerjaModel = new PekerjaModel();
        $pekerjaModel->delete_account($fnip);
        $data['active'] = 'Karyawan';
        $seluruhKaryawan = $this->model->findAll();
        $data['karyawan'] = $seluruhKaryawan;
        return view('karyawan/daftar_seluruh_karyawan', $data);
    }

    public function update()
    {
        //MARK: Ambil Isi Formulir
        $fnip             = $this->request->getPost('fnip');
        $fnama            = $this->request->getPost('fnama');
        $jabatan          = $this->request->getPost('jabatan');
        $satuan_kerja     = $this->request->getPost('satuan_kerja');
        $departemen       = $this->request->getPost('departemen');
        $bidang           = $this->request->getPost('bidang');
        $fungsi           = $this->request->getPost('fungsi');
        $email            = $this->request->getPost('email');
        $fgrade           = $this->request->getPost('fgrade');

        //MARK: Proses Validasi Isi Formulir
        helper(['form', 'url']);
        $input = $this->validate([
            'fnama' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Nama Karyawan Wajib diisi'
                ]
            ],
            'jabatan' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Jabatan wajib diisi'
                ]
            ],
            'satuan_kerja' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Satuan Kerja Wajib Diisi'
                ]
            ],
            'departemen' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Departemen Wajib Diisi'
                ]
            ],
            'bidang' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bidang Wajib Diisi'
                ]
            ],
            'fungsi' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Fungsi Wajib Diisi'
                ]
            ],
            'email' => [
                'rules' => 'trim|required|valid_email',
                'errors' => [
                    'required' => 'Email Wajib Diisi',
                    'valid_email' => 'Format email tidak valid'
                ]
            ],
            'fgrade' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Grade Wajib Diisi'
                ]
            ]
        ]);
        if (!$input) {
            $data['title']  = 'Ubah Data Karyawan | PT Bank BCA Syariah';
            $data['active'] = 'Karyawan';
            $seluruhKaryawan = $this->model->where('fnip', $fnip)->get()->getRowArray();
            $data['info'] = $seluruhKaryawan;
            return redirect()->to(base_url('karyawan/edit/karyawan/' . $fnip))->withInput()->with('validation', $this->validator);
            return view('karyawan/edit/karyawan/' . $fnip, $data, [
                'validation' => $this->validator
            ]);
        } else {
            $form_data = array(
                'fnama'         => $fnama,
                'jabatan'       => $jabatan,
                'satuan_kerja'  => $satuan_kerja,
                'departemen'    => $departemen,
                'bidang'        => $bidang,
                'fungsi'        => $fungsi,
                'email'         => $email,
                'fgrade'        => $fgrade
            );

            if (stristr($form_data['email'], '@bcasyariah.co.id') == false) {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Gagal!');
                session()->setFlashdata('swal_text', 'Email tidak valid! Pastikan anda mengisikan email internal PT Bank BCA Syariah');
                return redirect()->to(base_url('karyawan/edit/karyawan/' . $fnip))->withInput()->with('validation', $this->validator);
            }


            $model = new PekerjaModel();
            $model->update($fnip, $form_data);

            $seluruhKaryawan = $this->model->where('fnip', $fnip)->get()->getRowArray();
            $data['title'] = 'Detail Karyawan | PT Bank BCA Syariah';
            $data['info'] = $seluruhKaryawan;
            $data['active'] = 'Karyawan';

            //MARK: AMBIL ATASAN PEKERJA
            $atasanModel = new AtasanModel();
            $atasan = $atasanModel->getAtasan($data['info']['fnip']);
            $data['atasan1'] = $atasan['atasan1'];
            $data['atasan2'] = $atasan['atasan2'];

            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Proses Perubahan Data Karyawan Berhasil!');

            loggerActivity("UPDATE EMPLOYEE");
            $data['pageHeader'] = 'Detail Data Karyawan';

            return view('karyawan/detail_karyawan', $data);
        }
    }

    public function update_spv()
    {
        //MARK: Ambil Isi Formulir
        $user_nip             = $this->request->getPost('user_nip');
        $atasan_nip            = $this->request->getPost('atasan_nip');

        if (empty($atasan_nip)) {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Maaf!');
            session()->setFlashdata('swal_text', 'Detail Informasi tidak dapat diproses!');

            if (isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
            }
            return redirect()->to($previous);
        }

        $form_data = array(
            'atasan_nip'         => $atasan_nip,
        );

        $model = new AtasanModel();
        $model->update($user_nip, $form_data);

        $seluruhKaryawan = $this->model->where('fnip', $user_nip)->get()->getRowArray();
        $data['title'] = 'Detail Karyawan | PT Bank BCA Syariah';
        $data['info'] = $seluruhKaryawan;
        $data['active'] = 'Karyawan';

        //MARK: AMBIL ATASAN PEKERJA
        $atasanModel = new AtasanModel();
        $atasan = $atasanModel->getAtasan($data['info']['fnip']);
        $data['atasan1'] = $atasan['atasan1'];
        $data['atasan2'] = $atasan['atasan2'];

        session()->setFlashdata('swal_icon', 'success');
        session()->setFlashdata('swal_title', 'Berhasil!');
        session()->setFlashdata('swal_text', 'Proses Perubahan Data Atasan Berhasil!');


        loggerActivity("UPDATE EMPLOYEE");
        $data['pageHeader'] = 'Ubah Detail Karyawan';
        return view('karyawan/detail_karyawan', $data);
    }

    public function data_karyawan_pdf()
    {
        $filename =  'DAFTAR KARYAWAN BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $data['karyawan'] = $this->model->get()->getResultArray();
        $dompdf->loadHtml(view('karyawan/pdf/all', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    public function data_karyawan_dibawahi_pdf()
    {
        $filename =  'DAFTAR KARYAWAN ' . strtoupper(session()->get('fnama')) . ' TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $data['karyawan'] = $this->atasanModel->getBawahanFull();
        if (session()->get('role') != '2') {
            $pekerjaModel = new PekerjaModel();
            $data['supervisor_fnip']    = session()->get('fnip');
            $supervisor_fnama           = $pekerjaModel->select('fnama')->where('fnip', $data['supervisor_fnip'])->get()->getRowArray();
            $data['supervisor_fnama']   = $supervisor_fnama['fnama'];
        }
        $dompdf->loadHtml(view('karyawan/pdf/all', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    public function data_karyawan_penilaian_pdf()
    {
        $filename =  'DAFTAR KARYAWAN ' . strtoupper(session()->get('satuan_kerja')) . ' TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;

        $otorisasiModel = new OtorisasiModel();
        $data['karyawan'] = $otorisasiModel->getAllDataPenilaianSK(session()->get('satuan_kerja'));
        dd($data['karyawan']);

        $dompdf->loadHtml(view('karyawan/pdf/all', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    public function daftar_seluruh_karyawan()
    {
        $seluruhKaryawan = $this->model->getPekerja(true);

        $data['title'] = 'Daftar Karyawan | PT Bank BCA Syariah';
        $data['karyawan'] = $seluruhKaryawan;
        $data['active'] = 'Karyawan';
        $data['pageHeader'] = 'Daftar Karyawan';
        return view('karyawan/daftar_seluruh_karyawan', $data);
    }

    public function uploadFile()
    {
        $file = $this->request->getFile('karyawan_file');

        if (!$this->validate([

            'karyawan_file' => [
                'rules' => 'uploaded[karyawan_file]|max_size[karyawan_file,2048]|mime_in[karyawan_file,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'mime_in' => 'File extention harus berupa excel',
                    'max_size' => 'Ukuran file maksimal 2 MB'
                ]
            ]
        ])) {

            return redirect()->to(base_url('karyawan'))->with('validation', 'file harus berekstensi xlsx dan memiliki ukuran maksimal 2MB');
        }

        if ($file) {
            $excelReader  = new PHPExcel();

            //mengambil lokasi temp file
            $fileLocation = $file->getTempName();

            //baca file
            $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
            //ambil sheet active
            $sheet    = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            //looping untuk mengambil data
            if (sizeof($sheet) === 4) {
                return redirect()->to(base_url('karyawan'))->with('message', '<div class="alert alert-warning">Gagal memperbarui data karyawan<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
            }

            foreach ($sheet as $idx => $data) {
                //skip index 1 karena title excel
                if ($idx == 1 || $idx == 2 || $idx == 3 || $idx == 4) {
                    continue;
                }

                try {
                    $fnip = htmlspecialchars(trim($data['A']));
                    $fnama = htmlspecialchars(trim($data['B']));
                    $jabatan = htmlspecialchars(trim($data['C']));
                    $satuan_kerja = htmlspecialchars(trim($data['D']));
                    $departemen = htmlspecialchars(trim($data['E']));
                    $bidang = htmlspecialchars(trim($data['F']));
                    $fungsi = htmlspecialchars(trim($data['G']));
                    $fgrade = htmlspecialchars(trim($data['H']));
                    $fkode_cab = htmlspecialchars(trim($data['I']));
                    $email = htmlspecialchars(trim($data['J']));
                    $fnip_atasan = htmlspecialchars(trim($data['K']));
                } catch (\Throwable $th) {

                    return redirect()->to(base_url('karyawan'))->with('message', '<div class="alert alert-warning">Gagal memperbarui data karyawan format file tidak sesuai<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
                }



                $dataQuery = [
                    'fnip' => $fnip,
                    'fnama' => strtoupper($fnama),
                    'jabatan' => strtoupper($jabatan),
                    'satuan_kerja' => strtoupper($satuan_kerja),
                    'departemen' => strtoupper($departemen),
                    'bidang' => strtoupper($bidang),
                    'fungsi' => strtoupper($fungsi),
                    'fgrade' => strtoupper($fgrade),
                    'fkode_cab' => strtoupper($fkode_cab),
                    'email' => $email
                ];
                // $dat[] = $dataQuery;

                $cekDataKaryawan = $this->karyawanModel->find($fnip);
                if ($cekDataKaryawan) {
                    if ($this->karyawanModel->save($dataQuery)) {
                        $this->atasanModel->save([
                            'user_nip' => $fnip,
                            'atasan_nip' => $fnip_atasan
                        ]);
                    } else {
                        $failedSave[] = $dataQuery['fnip'];
                    }
                } else {

                    if ($this->karyawanModel->insert($dataQuery) !== false) {
                        $this->authModel->insert([
                            'userid' => $fnip,
                            'password' => md5($fnip)
                        ]);

                        $this->atasanModel->insert([
                            'user_nip' => $fnip,
                            'atasan_nip' => $fnip_atasan
                        ]);
                    } else {
                        $failedSave[] = $dataQuery['fnip'];
                    }
                }
            }

            loggerActivity('UPDATE EMPLOYEE (BATCH)');

            return redirect()->to(base_url('karyawan'))->with('message', '<div class="alert alert-success">Selesai memperbarui data karyawan <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
        } else {
            return redirect()->to(base_url('karyawan'))->with('message', '<div class="alert alert-warning">Gagal memperbarui data karyawan<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
        }
    }
}
