<?php

namespace App\Controllers\Upload;

use App\Controllers\BaseController;
use App\Models\Auth\M_Auth;
use App\Models\Karyawan\AtasanModel;
use App\Models\PekerjaModel;
use App\Models\Upload\Uploadfeature as UploadUploadfeature;
use PHPExcel;
use PHPExcel_IOFactory;

class UploadFeature extends BaseController
{
    public function __construct()
    {
        $this->uploadModel = new UploadUploadfeature();
        $this->karyawanModel = new PekerjaModel();
        $this->authModel = new M_Auth();
        $this->atasanModel = new AtasanModel();
    }

    public function updateDataKaryawan()
    {

        // $this->uploadModel->insert(['nama' => 'indomilk', 'harga' => 6000, 'stok' => 12]);

        $data['title'] = 'Upload Data Karyawan | BCA Syariah';
        $data['pageHeader'] = 'Upload Data Karyawan';
        $data['active'] = 'Tambah Coaching';


        return view('upload\upload_view', $data);
        dd('berhasil tambah data');
    }

    public function uploadFile()
    {
        $file = $this->request->getFile('karyawan_file');


        if (!$this->validate([

            'karyawan_file' => [
                'rules' => 'uploaded[karyawan_file]|mime_in[karyawan_file,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|max_size[karyawan_file,4096]',
                'errors' => [
                    'uploaded' => 'Harus ada file yang diupload',
                    'mime_in' => 'File extention harus berupa excel',
                    'max_size' => 'Ukuran file maksimal 2 MB'
                ]
            ]
        ])) {
            // mime_in[karyawan_file,xlsx]|
            // dd($_FILES);
            // dd($this->validator);
            return redirect()->to(base_url('karyawan'))->with('validation', 'file harus berekstensi xlsx dan memiliki ukuran maksimal 2MB');
        }

        $dat = array();
        if ($file) {
            $excelReader  = new PHPExcel();

            //mengambil lokasi temp file
            $fileLocation = $file->getTempName();

            //baca file
            $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
            //ambil sheet active
            $sheet    = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            //looping untuk mengambil data
            if (sizeof($sheet) === 4) {
                redirect()->to(base_url('karyawan'))->with('message', '<div class="alert alert-warning">Gagal memperbarui data karyawan<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
            }

            foreach ($sheet as $idx => $data) {
                //skip index 1 karena title excel
                if ($idx == 1 || $idx == 2 || $idx == 3 || $idx == 4) {
                    continue;
                }


                $fnip = htmlspecialchars(trim($data['A']));
                $fnama = htmlspecialchars(trim($data['B']));
                $jk = htmlspecialchars(trim($data['C']));
                $jabatan = htmlspecialchars(trim($data['D']));
                $satuan_kerja = htmlspecialchars(trim($data['E']));
                $departemen = htmlspecialchars(trim($data['F']));
                $bidang = htmlspecialchars(trim($data['G']));
                $fungsi = htmlspecialchars(trim($data['H']));
                $fgrade = htmlspecialchars(trim($data['I']));
                $fkode_cab = htmlspecialchars(trim($data['J']));
                $fnip_atasan = htmlspecialchars(trim($data['K']));

                $dataQuery = [
                    'fnip' => $fnip,
                    'fnama' => $fnama,
                    'jk' => $jk,
                    'jabatan' => $jabatan,
                    'satuan_kerja' => $satuan_kerja,
                    'departemen' => $departemen,
                    'bidang' => $bidang,
                    'fungsi' => $fungsi,
                    'fgrade' => $fgrade,
                    'fkode_cab' => $fkode_cab
                ];

                $cekDataKaryawan = $this->karyawanModel->find($fnip);
                if ($cekDataKaryawan) {
                    if ($this->karyawanModel->save($dataQuery)) {
                        $this->atasanModel->save([
                            'user_nip' => $fnip,
                            'atasan_nip' => $fnip_atasan
                        ]);
                    } else {
                    }
                } else {

                    if ($this->karyawanModel->insert($dataQuery) !== false) {
                        $this->authModel->insert([
                            'userid' => $fnip,
                            'password' => md5($fnip)
                        ]);

                        $this->atasanModel->insert([
                            'user_nip' => $fnip,
                            'atasan_nip' => $fnip_atasan
                        ]);
                    } else {
                        $dat[] = $dataQuery;
                    }
                }
            }
            // dd($dat);
            return redirect()->to(base_url('karyawan'))->with('message', '<div class="alert alert-success">Selesai memperbarui data karyawan <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
        } else {
            return redirect()->to(base_url('karyawan'))->with('message', '<div class="alert alert-warning">Gagal memperbarui data karyawan<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"> &times; </span> </button></div>');
        }
    }

    public function saveData()
    {
        $postData = $this->request->getVar();
        $postData['id'] = 7;
        $this->uploadModel->save($postData);
        dd($postData);
    }
}
