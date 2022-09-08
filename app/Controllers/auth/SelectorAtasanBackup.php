//pemeriksaan atasan
            $data['atasan1'] = $m_pekerja->getAtasanLangsung($fnip);

            //selector kantor pusat
            if ($fkode_cab == '99') {
                if ($satuan_kerja == 'SATUAN KERJA HUKUM DAN SDM') {
                    if ($jabatan == 'KEPALA SATUAN KERJA') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'ASSISTANT OFFICER') {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                        if ($data['atasan1'] == $data['atasan2']) {
                            $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                        }
                    } else {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                    }
                } else if ($satuan_kerja == 'SATUAN KERJA AUDIT INTERNAL') {
                    if ($jabatan == 'KEPALA SATUAN KERJA') {
                        $data['atasan2'] = $data['atasan1'];
                    } else if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'ASSISTANT OFFICER') {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                        if ($data['atasan1'] == $data['atasan2']) {
                            $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                        }
                    } else {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                    }
                } else if ($satuan_kerja == 'SATUAN KERJA BISNIS DAN KOMUNIKASI') {
                } else if ($satuan_kerja == 'SATUAN KERJA BISNIS RITEL DAN KONSUMER') {
                    if ($jabatan == 'KEPALA SATUAN KERJA') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getDirPranata();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getDirPranata();
                    } else if ($jabatan == 'ASSISTANT OFFICER' OR $jabatan == 'Asisstant Officer') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'STAF'){
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } 
                    else {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                    }
                } else if ($satuan_kerja == 'SATUAN KERJA KEUANGAN DAN PERENCANAAN PERUSAHAAN') {
                    if ($jabatan == 'KEPALA SATUAN KERJA') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getDirPranata();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getDirPranata();
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getDirPranata();
                    } else if ($jabatan == 'ASSISTANT OFFICER' OR $jabatan == 'Asisstant Officer') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'STAF'){
                        $data['atasan2'] = $m_pekerja->getDirPranata();
                    } else if ($jabatan == 'STAF SENIOR'){
                        $data['atasan2'] = $m_pekerja->getDirPranata();
                    } 
                    else {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                    }
                } else if ($satuan_kerja == 'SATUAN KERJA ANALISA RISIKO PEMBIAYAAN') {
                    if ($jabatan == 'KEPALA SATUAN KERJA') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getDirRickyadi();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getDirRickyadi();
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'ASSISTANT OFFICER' OR $jabatan == 'Asisstant Officer') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'STAF'){
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'STAF SENIOR'){
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } 
                    else {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                    } 
                } else if ($satuan_kerja == 'DIVISI OPERASI') {
                    if ($jabatan == 'KEPALA SATUAN KERJA') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getDirRickyadi();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getDirRickyadi();
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getDirRickyadi();
                    } else if ($jabatan == 'ASSISTANT OFFICER' OR $jabatan == 'Asisstant Officer') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'STAF'){
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'STAF SENIOR'){
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } 
                    else {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                    } 
                } else if ($satuan_kerja == 'MANAJEMEN RISIKO' OR $satuan_kerja == 'MANAJEMEN RISIKO ') {
                    if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'ASSISTANT OFFICER' OR $jabatan == 'Asisstant Officer') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'STAF'){
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'STAF SENIOR'){
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } 
                    else {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    }
                } else if ($satuan_kerja == 'KEPATUHAN') {
                    if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'ASSISTANT OFFICER' OR $jabatan == 'Asisstant Officer') {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'STAF'){
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } else if ($jabatan == 'STAF SENIOR'){
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    } 
                    else {
                        $data['atasan2'] = $m_pekerja->getDirHouda();
                    }
                } else if ($satuan_kerja == 'SATUAN KERJA TI DAN LOGISTIK') {
                    if ($jabatan == 'KEPALA SATUAN KERJA') {
                        $data['atasan2'] = $m_pekerja->getAtasanPresdir();
                    } else if ($jabatan == 'KEPALA DEPARTEMEN') {
                        $data['atasan2'] = $m_pekerja->getAtasanDirLukman();
                    } else if ($jabatan == 'KEPALA BIDANG') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'KEPALA BAGIAN') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else if ($jabatan == 'OFFICER' or $jabatan == 'SENIOR OFFICER' or $jabatan == 'ASSOCIATE OFFICER' or $jabatan == 'ASSISTANT OFFICER') {
                        $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                    } else {
                        $data['atasan2'] = $m_pekerja->getKadep($satuan_kerja, $departemen, $bidang);
                        if (!$data['atasan2']) {
                            $data['atasan2'] = $m_pekerja->getKasat($satuan_kerja, $departemen, $bidang);
                        }
                    }
                }
            }
            //selector kantor cabang
            else if ($fkode_cab != '99') {
                if ($satuan_kerja == 'CABANG JABODETABEK'){
                    if($jabatan == 'ACCOUNT OFFICER' OR $jabatan == 'ASSISTANT ACCOUNT OFFICER' OR $jabatan == 'ASSISTANT ACCOUNT OFFICER ' OR $jabatan == 'ASSOCIATE ACCOUNT OFFICER' OR $jabatan == 'STAF ACCOUNT OFFICER'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'BACK OFFICE ADMINISTRASI KANTOR' OR $jabatan == 'BACK OFFICE ADMINISTRASI KANTOR (FUNGSI POOLING)' OR $jabatan == 'BACK OFFICE ADMINISTRASI KANTOR (FUNGSI SALES ADMIN)'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'BACK OFFICE OPERASIONAL'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'BACK OFFICE SENIOR ADMINISTRASI KANTOR (FUNGSI POOLING)' OR $jabatan == 'BACK OFFICE SENIOR OPERASIONAL' OR $jabatan == 'BACK OFFICE SENIOR ADMINISTRASI KANTOR'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'CUSTOMER SERVICE' OR $jabatan == 'TELLER' OR $jabatan == 'CUSTOMER SERVICE SENIOR'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'KEPALA BAGIAN OPERASIONAL'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'KEPALA BAGIAN TELLER DAN BACKOFFICE'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'KEPALA CABANG'){
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    }
                    else if ($jabatan == 'KEPALA CABANG PEMBANTU'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'KEPALA OPERASI CABANG'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'KEPALA ULS'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'KEPALA BAGIAN CUSTOMER SERVICE'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'STAF OPERASIONAL'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }

                } else if ($satuan_kerja == 'CABANG NON JABODETABEK'){
                    if($jabatan == 'ACCOUNT OFFICER' OR $jabatan == 'ASSISTANT ACCOUNT OFFICER' OR $jabatan == 'ASSISTANT ACCOUNT OFFICER ' OR $jabatan == 'ASSOCIATE ACCOUNT OFFICER' OR $jabatan == 'STAF ACCOUNT OFFICER'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'BACK OFFICE ADMINISTRASI KANTOR' OR $jabatan == 'BACK OFFICE ADMINISTRASI KANTOR (FUNGSI POOLING)' OR $jabatan == 'BACK OFFICE ADMINISTRASI KANTOR (FUNGSI SALES ADMIN)'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'BACK OFFICE OPERASIONAL'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'BACK OFFICE SENIOR ADMINISTRASI KANTOR (FUNGSI POOLING)' OR $jabatan == 'BACK OFFICE SENIOR OPERASIONAL' OR $jabatan == 'BACK OFFICE SENIOR ADMINISTRASI KANTOR'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'CUSTOMER SERVICE' OR $jabatan == 'TELLER' OR $jabatan == 'CUSTOMER SERVICE SENIOR'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'KEPALA BAGIAN OPERASIONAL'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'KEPALA BAGIAN TELLER DAN BACKOFFICE'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'KEPALA CABANG'){
                        $data['atasan2'] = $m_pekerja->getPresdir();
                    }
                    else if ($jabatan == 'KEPALA CABANG PEMBANTU'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'KEPALA OPERASI CABANG'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'KEPALA ULS'){
                        $data['atasan2'] = $m_pekerja->getKaSbk();
                    }
                    else if ($jabatan == 'KEPALA BAGIAN CUSTOMER SERVICE'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }
                    else if ($jabatan == 'STAF OPERASIONAL'){
                        $data['atasan2'] = $m_pekerja->getKacab($satuan_kerja, $departemen);
                    }

                }
            }