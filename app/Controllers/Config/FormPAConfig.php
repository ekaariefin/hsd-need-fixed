<?php

namespace App\Controllers\Config;

use App\Controllers\BaseController;
use App\Controllers\Penilaian\Petunjuk;
use App\Models\ConfigModel;
use App\Models\PetunjukModel;

class FormPAConfig extends BaseController
{
    public function index()
    {
        $model = new ConfigModel();
        $id_periode = '2';
        $data['active'] = 'conf_pa';
        $data['title'] = 'Konfigurasi Formulir Performance Appraisal (PA) | PT Bank BCA Syariah';
        $data['date'] = $model->find($id_periode);
        return view('config/form_pa', $data);
    }

    public function update_pa()
    {
        //MARK: View Attributed Definition
        $data['title'] = 'Konfigurasi Formulir Performance Appraisal (PA) | PT Bank BCA Syariah';
        $data['active'] = 'conf_pa';

        //MARK: Validasi Pengisian Formulir
        $date_end       = $this->request->getPost('date_end');

        helper(['form', 'url']);
        $input = $this->validate([
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
            $id = '2';

            $data = array(
                'date_end'          => $date_end,
            );

            //MARK: Definisi Model
            $model = new ConfigModel();

            //MARK: Penambahan Data ke DB dan menampilkan SweetAlert dalam bentuk Flashdata
            $process = $model->update($id, $data);

            if ($process) {
                session()->setFlashdata('swal_icon', 'success');
                session()->setFlashdata('swal_title', 'Berhasil!');
                session()->setFlashdata('swal_text', 'Waktu Formulir PA Berhasil Diubah!');
            } else {
                session()->setFlashdata('swal_icon', 'error');
                session()->setFlashdata('swal_title', 'Maaf!');
                session()->setFlashdata('swal_text', 'Waktu Formulir PA Gagal Diubah!');
            }
        }

        $id_periode = '2';
        $data['active'] = 'Konfigurasi';
        $data['title'] = 'Konfigurasi Formulir Performance Appraisal (PA) | PT Bank BCA Syariah';
        $data['date'] = $model->find($id_periode);
        return view('config/form_pa', $data);
    }

    public function show_desc()
    {
        $model = new PetunjukModel();
        $data['active'] = 'conf_detail_pa';
        $data['title'] = 'Konfigurasi Formulir Performance Appraisal (PA) | PT Bank BCA Syariah';
        $data['list'] = $model->findAll();
        $data['form'] = false;
        return view('config/deskripsi_pa', $data);
    }

    public function to_form()
    {
        $model = new PetunjukModel();
        $data['active'] = 'conf_detail_pa';;
        $data['title'] = 'Konfigurasi Formulir Performance Appraisal (PA) | PT Bank BCA Syariah';
        $data['selected_form'] = $this->request->getPost('nama_petunjuk');
        $data['list'] = $model->findAll();
        $data['info'] = $model->select('id_petunjuk, nama_petunjuk, deskripsi')->where('nama_petunjuk', $data['selected_form'])->get()->getRowArray();
        $data['form'] = true;
        return view('config/deskripsi_pa', $data);
    }

    public function update_desc()
    {
        $model = new PetunjukModel();

        //MARK: AMBIL ISI FORMULIR
        $id_petunjuk = $this->request->getPost('id_petunjuk');
        $deskripsi = $this->request->getPost('deskripsi');

        //MARK: PROSES PERUBAHAN DATA
        $proses = $model->where('id_petunjuk', $id_petunjuk)
            ->set('deskripsi', $deskripsi)
            ->update();

        if ($proses) {
            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Proses Perubahan Deskripsi Penilaian Berhasil!');
        } else {
            session()->setFlashdata('swal_icon', 'error');
            session()->setFlashdata('swal_title', 'Gagal!');
            session()->setFlashdata('swal_text', 'Proses Perubahan Sasaran Bisnis Gagal!');
        }

        $model = new PetunjukModel();
        $data['active'] = 'Konfigurasi';
        $data['title'] = 'Konfigurasi Formulir Performance Appraisal (PA) | PT Bank BCA Syariah';
        $data['list'] = $model->findAll();
        $data['form'] = false;
        return view('config/deskripsi_pa', $data);
    }
}
