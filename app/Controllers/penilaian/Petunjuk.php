<?php

namespace App\Controllers\Penilaian;

use App\Controllers\BaseController;
use App\Models\PetunjukModel;

class Petunjuk extends BaseController
{
    public function index()
    {
        //
    }

    public function detail()
    {
        $selected = $this->request->getPost('getDetail');
        $modelPetunjuk = new PetunjukModel();
        $data['info'] = $modelPetunjuk->where('nama_petunjuk', $selected)->get()->getRowArray();
        return view ('penilaian/petunjuk/show_detail', $data);
    }
}
