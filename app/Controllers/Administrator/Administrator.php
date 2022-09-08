<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Auth\M_Auth;
use App\Models\PekerjaModel;
use App\Models\Trail;

class Administrator extends BaseController
{

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->karyawanModel = new PekerjaModel();
        $this->authModel = new M_Auth();
    }
    public function index()
    {
        echo (base_url());
    }

    public function listUser()
    {
        $authModel = $this->authModel;
        $data['getUser'] = $authModel->getListUser();
        // dd($data);
        $data['validation'] = $this->validation;
        $data['title'] = 'Daftar User | PT Bank BCA Syariah';
        $data['pageHeader'] = 'Daftar User';
        $data['active'] = 'user';
        $data['admin_sa'] = $authModel->getAdministratorUser();
        $data['admin_hsd'] = $authModel->getAdministratorUser(2);
        // dd($data);


        return view('admin/user_list', $data);
    }

    public function detailUser($id)
    {
        $data['pageHeader'] = 'Detail User';
        $data['active'] = 'user';
        $data['validation'] = $this->validation;
        $karyawanModel = $this->karyawanModel;
        // $query = $karyawanModel->getPekerja();

        $akun = $this->authModel->where('userid', $id)->get()->getRowArray();
        $data['akun'] = $akun;
        if ($akun['role'] !== "1" || $akun['role'] !== "2") {
            $query = $karyawanModel->where('fnip', $id)->get()->getRowArray();
            $data['info'] = $query;
        }
        $data['title'] = 'Detail User | PT Bank BCA Syariah';


        //MARK: AMBIL ATASAN PEKERJA
        // dd($query);
        return view('admin/detail_user', $data);
    }
    public function formatPassword($id)
    {
        $data['title'] = 'Format Password | PT Bank BCA Syariah';
        $data['active'] = 'Karyawan';
        $data['pageHeader'] = 'Format Password';
        $data['validation'] = $this->validation;
        $data['userid'] = $id;
        $karyawanModel = $this->karyawanModel;

        $akun = $this->authModel->where('userid', $id)->get()->getRowArray();
        $data['akun'] = $akun;
        if ($akun['role'] !== "1" || $akun['role'] !== "2") {
            $query = $karyawanModel->where('fnip', $id)->get()->getRowArray();
            $data['info'] = $query;
        }
        $data['pageHeader'] = ((bool)$akun['is_blocked']) ? 'Kata Sandi Baru' : 'Format Kata Sandi';

        return view('admin/format_password', $data);
    }
    public function formatPasswordProcess()
    {
        $id = $this->request->getPost('userid');
        $is_blocked = (bool)$this->request->getPost('is_blocked');
        // dd($is_blocked);

        if (!$this->validate(
            [
                'password' => [
                    'label' => 'kata sandi baru',
                    'rules' => 'trim|required|min_length[8]|max_length[100]|is_there_uppercase|is_there_number|is_there_special_character',
                    'errors' => [
                        'required' => 'Masukkan Password Baru',
                        'min_length' => '{field} tidak boleh kurang dari 8 karakter',
                        'max_length' => '{field} lebih dari 100 karakter'
                    ]
                ],
                're_password' => [
                    'label' => 'konfirmasi kata sandi',
                    'rules' => 'trim|required|matches[password]',
                    'errors' => [
                        'required' => 'Ketik Ulang Password Baru',
                        'matches' => "Password Konfirmasi tidak sama dengan Password Baru"
                    ]
                ]
            ]
        )) {
            return redirect()->to(base_url("/format-password/$id"))->withInput()->with('validation', $this->validator);
        }

        $password = md5($this->request->getPost('re_password'));
        $query = $this->authModel->set(['password' => $password, 'is_blocked' => 0])->where('userid', $id)->update();

        if (!$query) {

            if (!$is_blocked) {
                return redirect()->to(base_url("/format-password/$id"))->withInput()->with('info', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Kata sandi gagal diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            }

            return redirect()->to(base_url("/user/$id"))->withInput()->with('info', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            User gagal diaktifkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        }

        if (!$is_blocked) {
            return redirect()->to(base_url("/format-password/$id"))->withInput()->with('info', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Kata sandi berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        }


        return redirect()->to(base_url("/user/$id"))->withInput()->with('info', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        User telah diaktifkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }

    public function turnOffUserProcess()
    {
        $id = $this->request->getPost('userid');
        $status = $this->request->getPost('status');
        $is_active = $this->request->getPost('is_active');

        $blokir = 1;
        if ($is_active === "0") {
            $blokir = 0;
        }

        $query = $this->authModel->set(['status' => $status, 'is_active' => $is_active, 'is_blocked' => $blokir])->where('userid', $id)->update();

        if (!$query) {
            if ($is_active === "1") {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Aktifkan Akun!');
                session()->setFlashdata('swal_text', "Akun dengan user id $id gagal diaktifkan");
            } else {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Nonaktifkan Akun!');
                session()->setFlashdata('swal_text', "Akun dengan user id $id gagal dinonaktifkan");
            }

            return redirect()->to(base_url('/user/' . $id));
        }

        if ($is_active === "1") {
            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Aktifkan Akun!');
            session()->setFlashdata('swal_text', "Akun dengan user id $id berhasil diaktifkan");
        } else {
            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Nonaktifkan Akun!');
            session()->setFlashdata('swal_text', "Akun dengan user id $id berhasil dinonaktifkan");
        }

        return redirect()->to(base_url('/user/' . $id));
    }

    public function logActivity()
    {

        $params = $this->request->getGet();
        $data['page_number'] = $this->request->getVar('page_log') ? $this->request->getVar('page_log') : 1;
        $data['keyword'] = null;
        $keyword = "";
        if (isset($params) && isset($params['keyword'])) {
            $keyword = $params['keyword'];
            if ($keyword === "") return redirect()->to(base_url("log"));
            $data['keyword'] = $keyword;
        }

        $logModel = new Trail();

        $data['data_per_page'] = 10;
        $data['title'] = 'Log Aktivitas | PT Bank BCA Syariah';
        $data['active'] = 'log';
        $data['pageHeader'] = 'Log Aktivitas';
        $data['validation'] = $this->validation;
        $data['log'] = $logModel->getActivity($keyword);
        // $data['log'] = $logModel->findAll();
        $data['pager'] = $logModel->pager;
        // dd($data['pager']);

        return view('admin/log_activity', $data);
    }

    public function scheduler()
    {
        $logModel = new Trail();
        $logModel->insert([
            'activity_code' => 'LOGI', 'user_agent' => 'SERVER', 'ip_address' => '192.168.0.1', 'mac_address' => '0000:0000:0000:0000', 'user_id' => 'SYSTEM', 'user_name' => 'SYSTEM'
        ]);
        $data['title'] = 'Scheduler | PT Bank BCA Syariah';
        return view('admin/scheduler', $data);
    }
}
