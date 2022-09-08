<?php

namespace App\Controllers\Config;

use App\Controllers\BaseController;
use App\Models\ConfigModel;

class Sarbis extends BaseController
{
    public function index()
    {
        $model = new ConfigModel();
        $id_periode = '1';
        $data['active'] = 'conf_sarbis';
        $data['title'] = 'Konfigurasi Formulir Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['date'] = $model->find($id_periode);
        return view('config/sarbis', $data);
    }

    public function update_sarbis()
    {
        //MARK: View Attributed Definition
        $data['title'] = 'Konfigurasi Formulir Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'conf_sarbis';

        //MARK: Validasi Pengisian Formulir
        $date_start     = $this->request->getPost('date_start');
        $date_end       = $this->request->getPost('date_end');

        helper(['form', 'url']);
        $input = $this->validate([
            'date_start' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Tanggal Mulai harus terdefinisi.'
                ]
            ],
            'date_end' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Tanggal Akhir harus terdefinisi'
                ]
            ],
        ]);

        //MARK: Apabila ditemukan data tidak valid maka kembalikan ke view dengan pesan error
        if (!$input) {
            echo view('config/sarbis', $data, [
                'validation' => $this->validator
            ]);
        } else {
            //MARK: Definisi data ke array untuk dikirimkan ke database
            $id = '1';

            $data = array(
                'date_start'        => $date_start,
                'date_end'          => $date_end,
            );

            //MARK: Definisi Model
            $model = new ConfigModel();

            //MARK: Penambahan Data ke DB dan menampilkan SweetAlert dalam bentuk Flashdata
            $process = $model->update($id, $data);

            if ($process) {
                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Waktu Formulir Sarbis Berhasil Diubah!');
            } else {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Maaf!');
                session()->setFlashdata('swal_text', 'Waktu Formulir Sarbis Gagal Diubah!');
            }
        }

        //MARK: Kembalikan ke View Sarbis
        $data['title'] = 'Konfigurasi Formulir Sasaran Bisnis dan Kinerja | PT Bank BCA Syariah';
        $data['active'] = 'Konfigurasi';
        $id_periode = '1';
        $data['date'] = $model->find($id_periode);
        return view('config/sarbis', $data);
    }
}
