<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\M_Auth;
use App\Models\Auth\UserTokenModel;
use App\Models\Coaching\TestcoachingModel;
use App\Models\Karyawan\AtasanModel;
use App\Models\PekerjaModel;
use App\Models\Trail;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->m_auth = new M_Auth();
    }

    public function index()
    {

        $validation = \Config\Services::validation();
        $data['validation'] = $validation;

        if (session()->get('islogin')) {
            return redirect()->to(base_url('/home'));
        }

        return view('auth/login', $data);
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');

        if (!empty(session()->get('currentUserLogin'))) {
            if ($username != session()->get('currentUserLogin')) {
                session()->set('login_attempt', 0);
            }
        }


        if (!$this->validate([
            'username' => [
                'label' => 'User id',
                'rules' => 'required|min_length[6]|max_length[50]|is_not_unique[auth.userid,is_active,1]|is_blocked',
                'errors' => [
                    'is_not_unique' => '{field} tidak ditemukan',
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} tidak boleh kurang dari 6 karakter',
                    'max_length' => '{field} melebihi 50 karakter'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[100]|is_password_true[auth.userid,username,is_active,1]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} tidak boleh kurang dari 8 karakter',
                    'max_length' => '{field} melebihi 100 karakter'
                ]
            ],
        ])) {
            //MARK: MENAMBAHKAN JUMLAH PERCOBAAN LOGIN
            $getValue = (int)session()->get('login_attempt');
            $attempt = $getValue++;

            //update session
            session()->set('login_attempt', $getValue++);
            session()->set('currentUserLogin', $username);

            // dd($attempt);
            if ($attempt >= '2') {
                //PROSES BLOKIR
                $this->m_auth->set(['is_blocked' => 1])->where('userid', $username = $this->request->getPost('username'))->update();
                session()->setFlashdata('swal_icon', 'warning');
                session()->setFlashdata('swal_title', 'Maaf!');
                session()->setFlashdata('swal_text', 'Akun anda terblokir');
                session()->set('login_attempt', 0);
            }
            return redirect()->to(base_url('login'))->withInput()->with('validation', $this->validator);
        }

        $username   = $this->request->getPost('username');
        $check      = $this->m_auth->where('userid', $username)->where('is_active', 1)->limit(1)->get()->getRow();

        if ($check->role === '1' || $check->role === '2') {
            session()->set('islogin', true);
            session()->set('role', $check->role);
            session()->set('fnip', $username);
            session()->set('fnama', 'Administrator');
            session()->set('jabatan', ($check->role === "2") ? 'Administrator HSD' : 'Security Administrator');
        } else {
            $employeeModel = new PekerjaModel();
            $employee = $employeeModel->where('fnip', $username)->limit(1)->get()->getRow();

            session()->set('fnip', $employee->fnip);
            session()->set('fnama', $employee->fnama);
            session()->set('jabatan', $employee->jabatan);
            session()->set('satuan_kerja', $employee->satuan_kerja);
            session()->set('departemen', $employee->departemen);
            session()->set('bidang', $employee->bidang);
            session()->set('fungsi', $employee->fungsi);
            session()->set('fkode_cab', $employee->fkode_cab);
            session()->set('fgrade', $employee->fgrade);
            session()->set('email', $employee->email);
            session()->set('islogin', true);

            if ($username === $this->request->getPost('password')) {
                session()->set('password_warning', true);
                session()->setFlashdata('swal_icon', 'warning');
                session()->setFlashdata('swal_title', 'Oops!');
                session()->setFlashdata('swal_text', 'Password anda terlihat lemah, Saatnya Mengganti Password');
            }

            $atasanModel = new AtasanModel();
            session()->set('role', $atasanModel->getRole());

            $atasan = $atasanModel->getAtasan(session()->get('fnip'));
            $atasan1 = $atasan['atasan1'];


            if (!$atasan1['fnip']) {
                session()->set('not_have_supervisor', true);
            }
            $atasan2 = $atasan['atasan2'];

            session()->set('atasan1.nama', $atasan1['fnama']);
            session()->set('atasan2.nama', $atasan2['fnama']);
            session()->set('atasan1.nip', $atasan1['fnip']);
            session()->set('atasan2.nip', $atasan2['fnip']);
        }


        loggerActivity("LOGIN");
        return redirect()->to(base_url('/home'));
    }


    public function logout()
    {
        loggerActivity("LOGOUT");
        $_SESSION = [];
        session_unset();
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
