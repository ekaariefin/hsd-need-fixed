<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\M_Auth;

class ChangePassword extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Auth();
    }

    public function index()
    {
        $data['title'] = 'Ganti Password | PT Bank BCA Syariah';
        $data['active'] = 'Ganti Password';
        $data['validation'] = \Config\Services::validation();

        return view('security/change_password', $data);
    }

    public function process()
    {
        $id = session()->fnip;
        if (!$this->validate(
            [
                'old_password' => [
                    'rules' => "trim|required|is_password_true[auth.userid,$id,is_active,1,1]",
                    'errors' => [
                        'required' => 'Password lama wajib diisi',
                    ]
                ],
                'new_password' => [
                    'label' => 'kata sandi baru',
                    'rules' => 'trim|required|min_length[8]|max_length[100]|is_there_uppercase|is_there_number|is_there_special_character',
                    'errors' => [
                        'required' => 'Masukkan Password Baru',
                        'min_length' => '{field} tidak boleh kurang dari 8 karakter',
                        'max_length' => '{field} lebih dari 100 karakter'
                    ]
                ],
                'confirm_password' => [
                    'label' => 'konfirmasi kata sandi',
                    'rules' => 'trim|required|matches[new_password]',
                    'errors' => [
                        'required' => 'Ketik Ulang Password Baru',
                        'matches' => "Password Konfirmasi tidak sama dengan Password Baru"
                    ]
                ]
            ]
        )) {
            return redirect()->to(base_url('/change-password'))->withInput()->with('validation', $this->validator);
        }

        $new_password = $this->request->getPost('new_password');

        $change_password_control = $this->model->changePassword(session()->get('fnip'), $new_password);
        if (!$change_password_control) {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Proses Ganti Password Tidak Berhasil!');
            return redirect()->to(base_url('/change-password'))->with('danger', 'Gagal mengganti password');
        }
        session()->setFlashdata('swal_icon', 'success');
        session()->setFlashdata('swal_title', 'Berhasil!');
        session()->setFlashdata('swal_text', 'Proses Ganti Password Berhasil!');
        return redirect()->to(base_url('/change-password'))->with('success', 'Berhasil mengganti password');
    }
}
