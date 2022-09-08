<?php

namespace App\Controllers;

namespace App\Controllers\SuratPeringatan;

use App\Controllers\BaseController;
use App\Models\PekerjaModel;
use App\Models\SuratPeringatan\SPModel;

class SuratPeringatan extends BaseController
{
    //MARK: Construct untuk definisi mail, etc..
    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->receiver_mail = session()->get('email');
    }

    //MARK: Fungsi untuk memanggil view Formulir SP (Isi Data Karyawan)
    public function add()
    {
        $data['title'] = 'Surat Peringatan | PT Bank BCA Syariah';
        $data['active'] = 'entri_sp';
        return view('surat-peringatan\form_add', $data);
    }

    //MARK: Fungsi untuk melanjutkan ke Formulir Lanjutan (Detail SP)
    public function to_form()
    {
        $employeeData = $this->request->getVar();

        //MARK: Validasi Pengecekan session EmployeeData (Data Karyawan)
        if (!empty($employeeData['nip'])) {
            $data['employee'] = $employeeData;
            session()->set('last_employee', $employeeData);
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Data Karyawan Wajib Diisi Terlebih Dahulu!');
            $data['title'] = 'Entri Surat Peringatan | PT Bank BCA Syariah';
            $data['active'] = 'Surat Peringatan';
            return view('surat-peringatan\form_add', $data);
        }
        $data['title'] = 'Surat Peringatan | PT Bank BCA Syariah';
        $data['active'] = 'Surat Peringatan';
        return view('surat-peringatan\form_add_detail', $data);
    }

    //MARK: Fungsi untuk memproses formulir SP dan menyimpan ke DB
    public function process()
    {
        //MARK: Validasi Pengisian Formulir
        $jenis_sp           = $this->request->getPost('jenis_sp');
        $nomor_sp           = $this->request->getPost('nomor_sp');
        $tanggal_sp_mulai   = $this->request->getPost('tanggal_sp_mulai');
        $tanggal_sp_akhir   = $this->request->getPost('tanggal_sp_akhir');
        $pasal_sp           = $this->request->getPost('pasal_sp');
        $perihal_sp         = $this->request->getPost('perihal_sp');
        $user_sp            = $this->request->getPost('user_sp');

        helper(['form', 'url']);
        $input = $this->validate([
            'jenis_sp' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Jenis SP harus terdefinisi.'
                ]
            ],
            'nomor_sp' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Nomor SP harus terdefinisi'
                ]
            ],
            'tanggal_sp_mulai' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Tanggal Mulai SP harus terdefinisi'
                ]
            ],
            'tanggal_sp_akhir' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Tanggal Akhir SP harus terdefinisi'
                ]
            ],
            'pasal_sp' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Pasal SP wajib diisi'
                ]
            ],
            'perihal_sp' => [
                'rules' => 'trim|required|min_length[15]',
                'errors' => [
                    'required' => 'Perihal SP harus terdefinisi',
                    'min_length' => 'Masukkan Perihal SP Minimal 15 Karakter.'
                ]
            ],
        ]);

        //MARK: Apabila Validasi tidak terpenuhi, alihkan kembali ke laman Form SP
        if (!$input) {
            $data['title'] = 'Surat Peringatan | PT Bank BCA Syariah';
            $data['active'] = 'Surat Peringatan';
            $data['employee'] = session()->get('last_employee');
            echo view('surat-peringatan/form_add_detail', $data, [
                'validation' => $this->validator
            ]);
        }
        //MARK: Apabila validasi berhasil, alihkan ke halaman selanjutnya
        else {
            //MARK: Definisi Tahun SP
            $sp_date = strtotime($tanggal_sp_mulai);
            $tahun_sp = date("Y", $sp_date);
            //MARK: Definisi data ke array untuk dikirimkan ke database
            $data = array(
                'jenis_sp'          => $jenis_sp,
                'tahun_sp'          => $tahun_sp,
                'nomor_sp'          => $nomor_sp,
                'tanggal_sp_mulai'  => $tanggal_sp_mulai,
                'tanggal_sp_akhir'  => $tanggal_sp_akhir,
                'perihal_sp'        => $perihal_sp,
                'pasal_sp'          => $pasal_sp,
                'user_sp'           => $user_sp
            );

            if ($jenis_sp == "1") {
                $data['poin_sp']    = '0.5';
            } else if ($jenis_sp == "2") {
                $data['poin_sp']    = '1';
            } else if ($jenis_sp == "3") {
                $data['poin_sp']    = '1.5';
            } else {
                $data['poin_sp'] = '0';
            }

            //MARK: Memanggil Email Penerima SP
            $sendToMail = array(
                'email' => $this->request->getPost('employee_email')
            );

            //MARK: Memanggil Model SP
            $model = new SPModel();

            //MARK: Pengecekan Penambahan Data ke DB dan Proses Pengiriman Email
            if ($model->insert($data)) {
                //MARK: Ambil Nama Pekerja Berdasarkan User NIP
                $pekerjaModel = new PekerjaModel();
                $karyawan = $pekerjaModel->where('fnip', $data['user_sp'])->get()->getRowArray();
                $data['receiver_name'] = $karyawan['fnama'];
                $data['receiver_mail'] = $karyawan['email'];

                //MARK: Send Email
                $subject = 'Dokumen SP Diterbitkan';
                $message = view('mail-style\mail_sp_send', $data);

                $this->sendEmail($sendToMail['email'], $subject, $message);
                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Proses penambahan data berhasil!');
                $data['title'] = 'List Surat Peringatan | PT Bank BCA Syariah';
                $data['active'] = 'Surat Peringatan';
                $data['list'] = $model->select('*')
                    ->join('pekerja', 'pekerja.fnip = surat_peringatan.user_sp')
                    ->findAll();
                return view('surat-peringatan/list', $data);
            } else {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Gagal!');
                session()->setFlashdata('swal_text', 'Proses penambahan data tidak berhasil! Kode Error: 1069');
                $data['title'] = 'List Surat Peringatan | PT Bank BCA Syariah';
                $data['active'] = 'Surat Peringatan';
                $data['list'] = $model->select('*')
                    ->join('pekerja', 'pekerja.fnip = surat_peringatan.user_sp')
                    ->findAll();
                return view('surat-peringatan/list', $data);
            }
        }
    }

    //MARK: Fungsi untuk melihat list seluruh data SP.
    public function list()
    {
        $data['title'] = 'Surat Peringatan | PT Bank BCA Syariah';
        $data['active'] = 'riwayat_sp';
        $model = new SPModel();
        $data['list'] = $model->select('*')
            ->join('pekerja', 'pekerja.fnip = surat_peringatan.user_sp')
            ->findAll();
        return view('surat-peringatan\list', $data);
    }

    //MARK: Fungsi untuk melihat detail SP
    public function detail($id_sp)
    {
        $model = new SPModel();
        $data['title'] = 'Detail Surat Peringatan | PT Bank BCA Syariah';
        $data['active'] = 'riwayat_sp';
        $data['list'] = $model->getDataSpecific($id_sp);
        return view('surat-peringatan\detail', $data);
    }

    public function edit_sp($id_sp)
    {
        $model = new SPModel();
        $data['title'] = 'Detail Surat Peringatan | PT Bank BCA Syariah';
        $data['active'] = 'entri_sp';
        $data['list'] = $model->getDataSpecific($id_sp);
        return view('surat-peringatan\edit', $data);
    }

    public function proses_edit_sp()
    {
        //MARK: PROSES FORM
        $id_sp              = $this->request->getPost('id_sp');
        $jenis_sp           = $this->request->getPost('jenis_sp');
        $nomor_sp           = $this->request->getPost('nomor_sp');
        $tanggal_sp_mulai   = $this->request->getPost('tanggal_sp_mulai');
        $tanggal_sp_akhir   = $this->request->getPost('tanggal_sp_akhir');
        $pasal_sp           = $this->request->getPost('pasal_sp');
        $perihal_sp         = $this->request->getPost('perihal_sp');
        $user_sp            = $this->request->getPost('user_sp');

        //MARK: Definisi Tahun SP
        $sp_date = strtotime($tanggal_sp_mulai);
        $tahun_sp = date("Y", $sp_date);

        $data = array(
            'jenis_sp'          => $jenis_sp,
            'tahun_sp'          => $tahun_sp,
            'nomor_sp'          => $nomor_sp,
            'tanggal_sp_mulai'  => $tanggal_sp_mulai,
            'tanggal_sp_akhir'  => $tanggal_sp_akhir,
            'pasal_sp'          => $pasal_sp,
            'perihal_sp'        => $perihal_sp,
            'user_sp'           => $user_sp
        );

        if ($jenis_sp == "1") {
            $data['poin_sp']    = '0.5';
        } else if ($jenis_sp == "2") {
            $data['poin_sp']    = '1';
        } else {
            $data['poin_sp']    = '1.5';
        }

        //MARK: Memanggil Model SP
        $model = new SPModel();
        if ($model->update($id_sp, $data)) {
            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Proses perubahan data berhasil!');
            $data['title'] = 'List Surat Peringatan | PT Bank BCA Syariah';
            $data['active'] = 'Surat Peringatan';
            $data['list'] = $model->getDataSpecific($id_sp);
            return view('surat-peringatan/detail', $data);
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Proses perubahan data tidak berhasil!');
            $data['title'] = 'List Surat Peringatan | PT Bank BCA Syariah';
            $data['active'] = 'Surat Peringatan';
            $data['list'] = $model->getDataSpecific($id_sp);
            return view('surat-peringatan/detail', $data);
        }
    }

    public function delete($id_sp)
    {
        $model = new SPModel();
        if ($model->delete(['id_sp' => $id_sp])) {
            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Data berhasil dihapus!');
            $data['title'] = 'List Surat Peringatan | PT Bank BCA Syariah';
            $data['active'] = 'Surat Peringatan';
            $data['list'] = $model->select('*')
                ->join('pekerja', 'pekerja.fnip = surat_peringatan.user_sp')
                ->findAll();
            return view('surat-peringatan/list', $data);
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Data tidak berhasil dihapus!');
            $data['title'] = 'List Surat Peringatan | PT Bank BCA Syariah';
            $data['active'] = 'Surat Peringatan';
            $data['list'] = $model->select('*')
                ->join('pekerja', 'pekerja.fnip = surat_peringatan.user_sp')
                ->findAll();
            return view('surat-peringatan/list', $data);
        }
    }

    //MARK: Fungsi untuk Pengiriman Email | DO NOT CHANGE!
    public function sendEmail($to, $title, $message)
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from_name = "PT Bank BCA Syariah";
        $from_mail = "no-reply@bcasyariah.co.id";
        $destination = $to;
        $subject = $title;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $from_name . " <" . $from_mail . ">";
        $message = $message;
        if (!empty($to)) {
            $send = mail($destination, $subject, $message, $headers);
            return (bool)$send;
        }
        return false;
    }

    //MARK: GENERATE PDF UNTUK DATA SELURUH KARYAWAN
    public function data_sp_pdf()
    {
        $filename =  'DAFTAR SURAT PERINGATAN BCAS TAHUN ' . date('Y');
        $dompdf = new \Dompdf\Dompdf;
        $model = new SPModel();
        $data['list'] = $model->select('*')
            ->join('pekerja', 'pekerja.fnip = surat_peringatan.user_sp')
            ->findAll();
        $dompdf->loadHtml(view('surat-peringatan/pdf/all', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }
}
