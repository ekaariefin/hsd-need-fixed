<?php

namespace App\Controllers\Config;

use App\Controllers\BaseController;
use App\Models\BobotPenilaian;

class Bobot extends BaseController
{
    public function index()
    {
        $data['title'] = 'Konfigurasi Bobot Penilaian PA | PT Bank BCA Syariah';
        $data['active'] = 'conf_bobot';
        $data['form'] = false;
        return view('config/bobot', $data);
    }

    public function to_form()
    {
        $bobotModel = new BobotPenilaian();
        $data['title'] = 'Konfigurasi Bobot Penilaian PA | PT Bank BCA Syariah';
        $data['active'] = 'conf_bobot';
        $data['form'] = true;
        $data['selected_form'] = $this->request->getPost('golongan');
        if ($data['selected_form'] == '123-KP') {
            $where_clause = array('golongan' => '123', 'fkode_cab' => 'KANTOR PUSAT');
            $data['listForm'] = $bobotModel->where($where_clause)->get()->getResultArray();
        } else if ($data['selected_form'] == '123-KC') {
            $where_clause = array('golongan' => '123', 'fkode_cab' => 'KANTOR CABANG');
            $data['listForm'] = $bobotModel->where($where_clause)->get()->getResultArray();
        } else if ($data['selected_form'] == '4S-KC') {
            $where_clause = array('golongan' => '4S', 'fkode_cab' => 'KANTOR CABANG');
            $data['listForm'] = $bobotModel->where($where_clause)->get()->getResultArray();
        } else if ($data['selected_form'] == '4S-KP') {
            $where_clause = array('golongan' => '4S', 'fkode_cab' => 'KANTOR PUSAT');
            $data['listForm'] = $bobotModel->where($where_clause)->get()->getResultArray();
        } else {
            $data['listForm'] = $bobotModel->where('golongan', $data['selected_form'])->get()->getResultArray();
        }
        return view('config/bobot', $data);
    }

    public function update()
    {
        $bobotModel = new BobotPenilaian();
        $postData = array($this->request->getPost());
        $golongan = $postData[0]['golongan'];
        if ($golongan == '123-KP' or $golongan == '123-KC') {
            $golongan = '123';
        } else if ($golongan == '4S-KP' or $golongan == '4S-KC') {
            $golongan = '4S';
        }
        $fkode_cab = $postData[0]['fkode_cab'];
        foreach ($postData as $x) {

            if (isset($x['nilai_bobot_PENGETAHUAN_JABATAN'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'PENGETAHUAN JABATAN');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_PENGETAHUAN_JABATAN']);
                $bobotModel->update();
            }


            if (isset($x['nilai_bobot_ADAPTASI'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'ADAPTASI');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_ADAPTASI']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_DISIPLIN'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'DISIPLIN');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_DISIPLIN']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_INISIATIF'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'INISIATIF');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_INISIATIF']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_INTEGRITAS'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'INTEGRITAS');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_INTEGRITAS']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_KEMAMPUAN_KOMUNIKASI'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'KEMAMPUAN KOMUNIKASI');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_KEMAMPUAN_KOMUNIKASI']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_KEMAMPUAN_MANAJERIAL'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'KEMAMPUAN MANAJERIAL');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_KEMAMPUAN_MANAJERIAL']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_KERJASAMA'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'KERJASAMA');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_KERJASAMA']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_KUALITAS_KERJA'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'KUALITAS KERJA');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_KUALITAS_KERJA']);
                $bobotModel->update();
            }


            if (isset($x['nilai_bobot_KUALITAS_PELAYANAN'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'KUALITAS PELAYANAN');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_KUALITAS_PELAYANAN']);
                $bobotModel->update();
            }

            if (isset($x['nilai_bobot_MANDIRI'])) {
                $bobotModel->where('golongan', $golongan);
                $bobotModel->where('nama_bobot', 'MANDIRI');
                $bobotModel->where('fkode_cab', $fkode_cab);
                $bobotModel->set('nilai_bobot', $x['nilai_bobot_MANDIRI']);
                $bobotModel->update();
            }



            session()->setFlashdata('swal_icon', 'success');
            session()->setFlashdata('swal_title', 'Berhasil!');
            session()->setFlashdata('swal_text', 'Proses Perubahan Sasaran Bisnis Berhasil!');
            $data['title'] = 'Konfigurasi Bobot Penilaian PA | PT Bank BCA Syariah';
            $data['active'] = 'Konfigurasi';
            $data['form'] = false;
            return view('config/bobot', $data);
        }
    }
}
