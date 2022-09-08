<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\M_Auth;
use App\Models\Auth\UserTokenModel;
use App\Models\PekerjaModel;

class ForgotPassword extends BaseController
{
    public function __construct()
    {
        $this->m_auth = new M_Auth();
    }
    public function forgotPassword()
    {
        $validation = \Config\Services::validation();
        $data['validation'] = $validation;
        if (session()->get('islogin')) {
            return redirect()->to(base_url('/home'));
        }

        return view('auth/forgot-password.php', $data);
    }

    public function forgotPasswordProcess()
    {
        if (!$this->validate([
            'email' => [
                'label' => 'email',
                'rules' => 'required|valid_email|is_not_unique[pekerja.email]|is_user_active',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => '{field} tidak valid',
                    'is_not_unique' => '{field} tidak terdaftar'
                ]
            ]
        ])) {
            return redirect()->to(base_url('forgot-password'))->withInput()->with('validation', $this->validator);
        }

        $sendToMail = array(
            'email' => htmlspecialchars($this->request->getPost('email'))
        );


        //siapkan token
        $token = base64_encode(random_bytes(32));
        $user_token = [
            'email' => $sendToMail['email'],
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $email = $sendToMail['email'];
        $tokenURL = urlencode($token);

        $userTokenModel = new UserTokenModel();
        $userTokenModel->where('email', $email)->delete();
        $userTokenModel->insert($user_token);

        $link = base_url('reset-password') . "?email=$email&token=$tokenURL";

        $pekerjaModel = new PekerjaModel();
        $nip = $pekerjaModel->where('email', $email)->get()->getRow()->fnip;


        $send = $this->_sendEmail($sendToMail['email'], '[eChoaching & ePA] Ubah Kata Sandi', view('mail-style/mail_forgot_password', ['nip' => "$nip", 'link' => $link]));

        //if (!$send) {
        //    return redirect()->to(base_url('forgot-password'))->with('message', '<div class="alert alert-danger">Gagal mengirim tautan ke email anda <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div> ');
        //}

        session()->setFlashdata('swal_icon', 'success');
        session()->setFlashdata('swal_title', 'Tautan Berhasil Terkirim!');
        session()->setFlashdata('swal_text', 'Silahkan cek email anda untuk melakukan proses berikutnya.');

        return redirect()->to(base_url('forgot-password'))->with('message', '<div class="alert alert-success">Tautan berhasil dikirim ke email anda <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div> ');
    }

    public function resetPassword()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        if (empty($token) || empty($email)) {
            session()->setFlashdata('message', '<div class="alert alert-danger">email atau token tidak valid<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
            return redirect()->to(base_url('login'));
        }

        $userTokenModel = new UserTokenModel();
        $cekEmail = $userTokenModel->where('email', $email)->limit(1)->get(); //->getRow();
        // dd($cekEmail);
        if (!$cekEmail) {
            session()->setFlashdata('message', '<div class="alert alert-danger">email tidak valid<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
            return redirect()->to(base_url('login'));
        } else {
            if (!$userTokenModel->where('token', $token)->limit(1)->get()->getRow()) {
                session()->setFlashdata('message', '<div class="alert alert-danger">token tidak valid<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
                return redirect()->to(base_url('login'));
            }
        }

        $expireToken = $userTokenModel->where('email', $email)->limit(1)->get()->getRow()->created_at;
        if ((time() - strtotime($expireToken)) > (60 * 60 * 1)) {
            session()->setFlashdata('message', '<div class="alert alert-danger">token expired<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');

            $userTokenModel->where('email', $email)->delete();
            return redirect()->to(base_url('login'));
        }

        session()->set('reset_email', $email);

        $data = [
            'email' => $email,
            'token' => $token
        ];
        $validation = \Config\Services::validation();
        $data['validation'] = $validation;

        if (!isset(session()->reset_email)) {
            return redirect()->to(base_url('/login'));
        }

        return view('Auth/new-password', $data);
    }

    public function resetPasswordProcess()
    {
        if (!isset(session()->reset_email)) {
            return redirect()->to(base_url('/login'));
        }

        $email = $this->request->getPost('email');
        $token = $this->request->getPost('token');
        // dd($token);

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


            // $validation = \Config\Services::validation();
            // $data['validation'] = $validation;
            // return view('Auth/new-password', $data);
            return redirect()->to(base_url("/reset-password?email=$email&token=$token"))->withInput()->with('validation', $this->validator);
        }

        $pekerjaModel = new PekerjaModel();
        $fnip = $pekerjaModel->where('email', session()->reset_email)->get()->getRow()->fnip;

        $password = $this->request->getPost('re_password');
        $change_password = $this->m_auth->changePassword($fnip, $password);


        if (!$change_password) {
            session()->setFlashdata('message', '<div class="alert alert-danger">password gagal diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
            unset($_SESSION['reset_email']);
            return redirect()->to(base_url("/reset-password?email=$email&token=$token"));
        }

        session()->setFlashdata('swal_icon', 'success');
        session()->setFlashdata('swal_title', 'Password Berhasil Diubah!');
        session()->setFlashdata('swal_text', 'Silahkan login kembali dengan menggunakan password baru anda.');

        session()->setFlashdata('message', '<div class="alert alert-success">password berhasil diubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');

        $userTokenModel = new UserTokenModel();
        $userTokenModel->where('email', session()->reset_email)->delete();

        unset($_SESSION['reset_email']);
        return redirect()->to(base_url("/login"));
    }

    public function _sendEmail($to, $title, $message)
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from_name = "PT Bank BCA Syariah";
        $from_mail = "no-reply@bcasyariah.co.id";
        $to = $to;
        $subject = $title;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $from_name . " <" . $from_mail . ">";
        $message = $message;
        mail($to, $subject, $message, $headers);
    }
}
