<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfigModel;
use App\Models\Karyawan\AtasanModel;
use App\Models\SarbisModel;

class Sarbis extends BaseController
{
    public function index()
    {
        //
    }

    public function entri()
    {
        $configModel = new ConfigModel();
        $sarbisModel = new SarbisModel();
        $data['title'] = 'Tambah Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'entri_sarbis';

        $id_periode = '1';
        $data['date'] = $configModel->find($id_periode);
        if ($data['cekSarbis'] = $sarbisModel->where([
            'user_nip' => session()->get('fnip'),
            'tahun_sarbis' => date('Y')
        ])->get()->getRowArray()) {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Maaf!');
            session()->setFlashdata('swal_text', 'Anda sudah mengisi Sasaran Bisnis Tahun Berjalan!');
        }
        return view('sarbis/add', $data);
    }

    public function process_add()
    {
        //MARK: Ambil Isi Formulir
        $tahun_sarbis           = $this->request->getPost('tahun_sarbis');
        $desc_sarbis1           = $this->request->getPost('desc_sarbis1');
        $desc_sarbis2           = $this->request->getPost('desc_sarbis2');
        $desc_sarbis3           = $this->request->getPost('desc_sarbis3');
        $desc_sarbis4           = $this->request->getPost('desc_sarbis4');
        $desc_sarbis5           = $this->request->getPost('desc_sarbis5');
        $desc_sarbis6           = $this->request->getPost('desc_sarbis6');
        $desc_sarbis7           = $this->request->getPost('desc_sarbis7');
        $desc_sarbis8           = $this->request->getPost('desc_sarbis8');

        $bobot_sarbis1           = $this->request->getPost('bobot_sarbis1');
        $bobot_sarbis2           = $this->request->getPost('bobot_sarbis2');
        $bobot_sarbis3           = $this->request->getPost('bobot_sarbis3');
        $bobot_sarbis4           = $this->request->getPost('bobot_sarbis4');
        $bobot_sarbis5           = $this->request->getPost('bobot_sarbis5');
        $bobot_sarbis6           = $this->request->getPost('bobot_sarbis6');
        $bobot_sarbis7           = $this->request->getPost('bobot_sarbis7');
        $bobot_sarbis8           = $this->request->getPost('bobot_sarbis8');

        //MARK: Proses Validasi Isi Formulir
        helper(['form', 'url']);
        $input = $this->validate([
            'desc_sarbis1' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis2' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis3' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis4' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis5' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis6' => [
                'rules' => 'trim'
            ],
            'desc_sarbis7' => [
                'rules' => 'trim'
            ],
            'bobot_sarbis1' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis2' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis3' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis4' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis5' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis6' => [
                'rules' => 'trim'
            ],
            'bobot_sarbis7' => [
                'rules' => 'trim'
            ],
        ]);

        if (!$input) {
            $data['title']  = 'Tambah Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
            $data['active'] = 'entri_sarbis';
            $id_periode = '1';
            $model = new ConfigModel();
            $data['date'] = $model->find($id_periode);
            echo view('sarbis/add', $data, [
                'validation' => $this->validator
            ]);
        } else {
            $form_data = array(
                'tahun_sarbis'          => $tahun_sarbis,
                'desc_sarbis1'          => $desc_sarbis1,
                'desc_sarbis2'          => $desc_sarbis2,
                'desc_sarbis3'          => $desc_sarbis3,
                'desc_sarbis4'          => $desc_sarbis4,
                'desc_sarbis5'          => $desc_sarbis5,
                'desc_sarbis6'          => $desc_sarbis6,
                'desc_sarbis7'          => $desc_sarbis7,
                'desc_sarbis8'          => $desc_sarbis8,

                'bobot_sarbis1'         => $bobot_sarbis1 / 100,
                'bobot_sarbis2'         => $bobot_sarbis2 / 100,
                'bobot_sarbis3'         => $bobot_sarbis3 / 100,
                'bobot_sarbis4'         => $bobot_sarbis4 / 100,
                'bobot_sarbis5'         => $bobot_sarbis5 / 100,
                'bobot_sarbis6'         => $bobot_sarbis6 / 100,
                'bobot_sarbis7'         => $bobot_sarbis7 / 100,
                'bobot_sarbis8'         => $bobot_sarbis8 / 100,

                'user_nip'              => session()->get('fnip'),
                'atasan1'               => session()->get('atasan1.nip'),
                'atasan2'               => session()->get('atasan2.nip')
            );

            if (!empty($bobot_sarbis6)) {
                $form_data['bobot_sarbis6'] = $bobot_sarbis6 / 100;
            }
            if (!empty($bobot_sarbis7)) {
                $form_data['bobot_sarbis7'] = $bobot_sarbis7 / 100;
            }
            if (!empty($bobot_sarbis8)) {
                $form_data['bobot_sarbis8'] = $bobot_sarbis8 / 100;
            }

            $configModel = new SarbisModel();
            $configModel->insert($form_data);

            // dd(session()->get('atasan1.nip'));

            $data['title'] = 'Daftar Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
            $data['active'] = 'Sasaran Bisnis';
            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Proses Tambah Sasaran Bisnis Berhasil!');
            return redirect()->to(base_url('sarbis/list/' . date('Y')));
        }
    }

    public function list($tahun_sarbis)
    {
        $data['title'] = 'Daftar Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'lihat_sarbis';
        $model = new SarbisModel();
        if (empty($tahun_sarbis)) {
            $tahun_sarbis = date('Y');
        }
        $data['detailSarbis'] = $model->where([
            'user_nip' => session()->get('fnip'),
            'tahun_sarbis' => $tahun_sarbis
        ])->get()->getRowArray();

        if (empty($data['detailSarbis'])) {
            session()->setFlashdata('error_log', 'Empty Sarbis');
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Maaf!');
            session()->setFlashdata('swal_text', 'Anda belum mengisi Formulir Sasaran Bisnis Tahun Berjalan');
        }
        return view('sarbis/list', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'lihat_sarbis';
        $model = new SarbisModel();
        $data['detailSarbis'] = $model->where('id_sarbis', $id)->get()->getRowArray();
        return view('sarbis/edit', $data);
    }

    public function process_edit()
    {
        //MARK: Ambil Isi Formulir
        $id_sarbis              = $this->request->getPost('id_sarbis');
        $desc_sarbis1           = $this->request->getPost('desc_sarbis1');
        $desc_sarbis2           = $this->request->getPost('desc_sarbis2');
        $desc_sarbis3           = $this->request->getPost('desc_sarbis3');
        $desc_sarbis4           = $this->request->getPost('desc_sarbis4');
        $desc_sarbis5           = $this->request->getPost('desc_sarbis5');
        $desc_sarbis6           = $this->request->getPost('desc_sarbis6');
        $desc_sarbis7           = $this->request->getPost('desc_sarbis7');
        $desc_sarbis8           = $this->request->getPost('desc_sarbis8');

        $bobot_sarbis1           = $this->request->getPost('bobot_sarbis1');
        $bobot_sarbis2           = $this->request->getPost('bobot_sarbis2');
        $bobot_sarbis3           = $this->request->getPost('bobot_sarbis3');
        $bobot_sarbis4           = $this->request->getPost('bobot_sarbis4');
        $bobot_sarbis5           = $this->request->getPost('bobot_sarbis5');
        $bobot_sarbis6           = $this->request->getPost('bobot_sarbis6');
        $bobot_sarbis7           = $this->request->getPost('bobot_sarbis7');
        $bobot_sarbis8           = $this->request->getPost('bobot_sarbis8');

        //MARK: Proses Validasi Isi Formulir
        helper(['form', 'url']);
        $input = $this->validate([
            'desc_sarbis1' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis2' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis3' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis4' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis5' => [
                'rules' => 'trim|required|min_length[1]',
                'errors' => [
                    'required' => 'Deskripsi Sasaran Bisnis Wajib Diisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
            'desc_sarbis6' => [
                'rules' => 'trim'
            ],
            'desc_sarbis7' => [
                'rules' => 'trim'
            ],
            'bobot_sarbis1' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis2' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis3' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis4' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis5' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Bobot Wajib Diisi',
                ]
            ],
            'bobot_sarbis6' => [
                'rules' => 'trim'
            ],
            'bobot_sarbis7' => [
                'rules' => 'trim'
            ],
        ]);

        if (!$input) {
            $data['title']  = 'Tambah Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
            $data['active'] = 'entri_sarbis';
            $id_periode = '1';
            $model = new ConfigModel();
            $data['date'] = $model->find($id_periode);
            return view('sarbis/edit/' . $id_periode, $data, [
                'validation' => $this->validator
            ]);
        } else {
            $form_data = array(
                'desc_sarbis1'          => $desc_sarbis1,
                'desc_sarbis2'          => $desc_sarbis2,
                'desc_sarbis3'          => $desc_sarbis3,
                'desc_sarbis4'          => $desc_sarbis4,
                'desc_sarbis5'          => $desc_sarbis5,
                'desc_sarbis6'          => $desc_sarbis6,
                'desc_sarbis7'          => $desc_sarbis7,
                'desc_sarbis8'          => $desc_sarbis8,

                'bobot_sarbis1'         => $bobot_sarbis1,
                'bobot_sarbis2'         => $bobot_sarbis2,
                'bobot_sarbis3'         => $bobot_sarbis3,
                'bobot_sarbis4'         => $bobot_sarbis4,
                'bobot_sarbis5'         => $bobot_sarbis5,
                'bobot_sarbis6'         => $bobot_sarbis6,
                'bobot_sarbis7'         => $bobot_sarbis7,
                'bobot_sarbis8'         => $bobot_sarbis8,

                'user_nip'              => session()->get('fnip'),
                'atasan1'               => session()->get('atasan1.nip'),
                'atasan2'               => session()->get('atasan2.nip'),

                'approval1'             => NULL,
                'approval2'             => NULL

            );
            $configModel = new SarbisModel();
            $configModel->update($id_sarbis, $form_data);

            $data['title'] = 'Daftar Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
            $data['active'] = 'Sasaran Bisnis';
            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Proses Perubahan Sasaran Bisnis Berhasil!');
            return redirect()->to(base_url('sarbis/riwayat'));
        }
    }

    public function riwayat()
    {
        $data['title'] = 'Detail Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'riwayat_sarbis';
        $model = new SarbisModel();
        $data['listSarbis'] = $model->where('user_nip', session()->get('fnip'))->get()->getResultArray();
        return view('sarbis/riwayat', $data);
    }

    public function otorisasi()
    {
        $data['title'] = 'Otorisasi Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'Otorisasi Sarbis';
        $model = new SarbisModel();
        $where = "atasan1='" . session()->get('fnip') . "'OR atasan2='" . session()->get('fnip') . "'";
        $model->select("sarbis.*, pekerja.fnama, pekerja.jabatan, pekerja.departemen, pekerja.satuan_kerja, pekerja.bidang, pekerja.fungsi");
        $model->join("pekerja", "pekerja.fnip = sarbis.user_nip");
        $data['getData'] = $model->where($where)->get()->getResultArray();
        return view('sarbis/otorisasi', $data);
    }

    public function otorisasi_detail($id_sarbis)
    {
        $data['title'] = 'Otorisasi Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'Otorisasi Sarbis';
        $model = new SarbisModel();
        $where = "id_sarbis = '$id_sarbis' AND (atasan1='" . session()->get('fnip') . "'OR atasan2='" . session()->get('fnip') . "')";
        $model->select("sarbis.*, pekerja.fnama, pekerja.jabatan, pekerja.departemen, pekerja.satuan_kerja, pekerja.bidang, pekerja.fungsi");
        $model->join("pekerja", "pekerja.fnip = sarbis.user_nip");
        $data['detailSarbis'] = $model->where($where)->get()->getRowArray();

        //MARK: AMBIL ATASAN PEKERJA
        $atasanModel = new AtasanModel();
        $atasan = $atasanModel->getAtasan($data['detailSarbis']['user_nip']);
        $data['atasan1'] = $atasan['atasan1']['fnama'];
        $data['atasan2'] = $atasan['atasan2']['fnama'];

        //MARK: CEK APAKAH SUDAH DISETUJUI
        if ($data['detailSarbis']['approval1'] === session()->get('fnip') or $data['detailSarbis']['approval2'] === session()->get('fnip')) {
            $data['markStatus'] = 'Approved';
        } else {
            $data['markStatus'] = '';
        }

        return view('sarbis/otorisasi_detail', $data);
    }

    public function otorisasi_process($id_sarbis)
    {
        //MARK: AMBIL DATA SARBIS
        $model = new SarbisModel();
        $where = "id_sarbis = '$id_sarbis' AND (atasan1='" . session()->get('fnip') . "'OR atasan2='" . session()->get('fnip') . "')";
        $model->select("sarbis.*, pekerja.fnama, pekerja.jabatan, pekerja.departemen, pekerja.satuan_kerja, pekerja.bidang, pekerja.fungsi");
        $model->join("pekerja", "pekerja.fnip = sarbis.user_nip");
        $data['detailSarbis'] = $model->where($where)->get()->getRowArray();

        //MARK: PROSES PENCOCOKAN DATA ATASAN DAN UPDATE DATA
        if ($data['detailSarbis']['atasan1'] === session()->get('fnip')) {
            $model->update($id_sarbis, ['approval1' => session()->get('fnip')]);
        } else if ($data['detailSarbis']['atasan2'] === session()->get('fnip')) {
            $model->update($id_sarbis, ['approval2' => session()->get('fnip')]);
        } else {
            $data['title'] = 'Otorisasi Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
            $data['active'] = 'Otorisasi Sarbis';
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Proses Otorisasi Sasaran Bisnis Gagal!');
            return redirect()->to(base_url('sarbis/otorisasi'));
        }
        session()->setFlashdata('swal_icon', 'success');
        session()->setFlashdata('swal_title', 'Berhasil!');
        session()->setFlashdata('swal_text', 'Otorisasi Sasaran Bisnis Berhasil!');
        return redirect()->to(base_url('sarbis/otorisasi'));
    }
}
