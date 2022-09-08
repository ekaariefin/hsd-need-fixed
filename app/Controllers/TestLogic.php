<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestLogic extends BaseController
{
    public function index()
    {

        session();
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('test_view/password_validation', $data);
    }

    public function validate_password()
    {
        if (!$this->validate([
            'fname' => [
                'label' => 'Nama lengkap',
                'rules' => ['required'],
                'errors' => [
                    'required' => "The {field} is already not completed."
                ]
            ],
            'lname' => [
                'label' => 'Nama belakang',
                'rules' => 'password_strength[8]'
            ]
        ])) {



            $validation = \Config\Services::validation();
            return redirect()->to('/testlogic')->withInput()->with('validation', $validation);
        }

        return "<h1>Success</h1>";
    }
}
