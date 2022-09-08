<?php

namespace App\Controllers\Scheduler;

use App\Controllers\BaseController;
use App\Models\PekerjaModel;

class PasswordExpScheduler extends BaseController
{
    public function __construct()
    {
        $this->pekerjaModel = new PekerjaModel();
    }
    public function index()
    {
        echo "memeriksa akun dengan email kedaluwarsa\n";
        $mustUpdatePassword = $this->pekerjaModel->getActiveAccountWithEmail();
        if (empty($mustUpdatePassword)) {
            return "tidak ada akun dengan password kedaluwarsa";
        }
        // echo $mustUpdatePassword;
        echo "selesai\n";
        echo "mengirim email...\n";
        foreach ($mustUpdatePassword as $update) {
            try {
                $expDate = strtotime($update['last_change_password']) + 2592000;

                if ($expDate < time()) {
                    $pass = true;
                } else {
                    $pass = false;
                }

                $this->_sendEmail($update['email'], '[eCoaching & ePA] Peringatan Kedaluwarsa Kata Sandi', view('mail-style/mail_exp_pass', ['name' => $update['fnama'], 'expDate' => $expDate, 'pass' => $pass]));
            } catch (\Throwable $th) {
                echo "gagal megirim email untuk akun" . $update['fnama'];
            }
        }
        echo "selesai\n";
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
