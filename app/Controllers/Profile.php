<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PekerjaModel;

class Profile extends BaseController
{
    public function index()
    {
        $pekerjaModel   = new PekerjaModel();
        $data['title']  = 'Konfigurasi Profil | PT Bank BCA Syariah';
        $data['active'] = 'Konfigurasi';
        $data['info'] = $pekerjaModel->where('fnip', session()->get('fnip'))->get()->getRowArray();
        return view('profile/show_profile', $data);
    }

    public function change_email()
    {
        $pekerjaModel   = new PekerjaModel();
        $data['title']  = 'Konfigurasi Profil | PT Bank BCA Syariah';
        $data['active'] = 'Konfigurasi';
        $data['info'] = $pekerjaModel->select('fnip, email')->where('fnip', session()->get('fnip'))->get()->getRowArray();
        return view('profile/form_email', $data);
    }

    public function process_email()
    {
        //MARK: Ambil Data dari Formulir
        $fnip = $this->request->getPost('fnip');
        $email = $this->request->getPost('email');

        //MARK: Proses Validasi Isi Formulir
        helper(['form', 'url']);

        $input = $this->validate([
            'email' => [
                'rules' => 'valid_email|trim|required|is_unique[pekerja.email]',
                'errors' => [
                    'valid_email' => 'Format Email tidak sesuai',
                    'required' => 'Email Wajib Diisi',
                    'is_unique' => 'Alamat email telah terdaftar, harap gunakan email lain!'
                ]
            ]
        ]);

        if (!$input) {
            $pekerjaModel   = new PekerjaModel();
            $data['title']  = 'Konfigurasi Profil | PT Bank BCA Syariah';
            $data['active'] = 'Konfigurasi';
            $data['info']   = $pekerjaModel->select('fnip, email')->where('fnip', session()->get('fnip'))->get()->getRowArray();
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Proses Perubahan Email Tidak Berhasil!');
            echo view('profile/form_email', $data, [
                'validation' => $this->validator
            ]);
        } else {
            $form_data = array(
                'email'          => $email
            );
            if (stristr($form_data['email'], '@bcasyariah.co.id') == false) {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Gagal!');
                session()->setFlashdata('swal_text', 'Email tidak valid! Pastikan anda mengisikan email internal BCA Syariah');
                return redirect()->to(base_url('profile'));
            } else {
                $pekerjaModel   = new PekerjaModel();
                $pekerjaModel->update($fnip, $form_data);
                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Proses Perubahan Email berhasil!');
                return redirect()->to(base_url('profile'));
            }
        }
    }
}
