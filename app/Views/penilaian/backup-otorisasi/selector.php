<?php
    $fkode_cab = session()->get('fkode_cab');
    $satuan_kerja = session()->get('satuan_kerja');
    $fgrade = session()->get('fgrade');
    $jabatan = session()->get('jabatan');

    if($fkode_cab == "99") {
        // lokasi kantor pusat
        if ($fgrade == "1" OR $fgrade == "2" OR $fgrade == "3"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_123').'"
            </script>';
        }
        else if ($fgrade == "4" AND $jabatan == "ASSOCIATE OFFICER"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_4f').'"
            </script>';
        }
        else if ($fgrade == "4" AND $jabatan == "KEPALA BAGIAN"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_4s').'"
            </script>';
        }
        else if ($fgrade == "5" AND $jabatan == "OFFICER"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_5f').'"
            </script>';
        }
        else if ($fgrade == "5" AND $jabatan == "KEPALA BIDANG"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_5s').'"
            </script>';
        }
         else if ($fgrade == "5" AND $jabatan == "KEPALA BAGIAN"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_5s').'"
            </script>';
        }
        else if ($fgrade == "6"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_67').'"
            </script>';
        }
        else if ($fgrade == "7"){
            echo '<script>
                window.location="'.base_url('penilaian/kp_form_gol_67').'"
            </script>';
        }
        else{
            echo "Undefinied";
            exit();
        }
    }
    else if ($fkode_cab != "99"){
        if ($jabatan == "KEPALA CABANG PEMBANTU"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_ka_kcp_reguler').'"
            </script>';
        }
        else if ($jabatan == "KEPALA ULS"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_ka_uls').'"
            </script>';
        }
        else if ($jabatan == "KEPALA BAGIAN TELLER DAN BACKOFFICE"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_gol_4s').'"
            </script>';
        }
        else if ($jabatan == "KEPALA CABANG"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_ka_kcu').'"
            </script>';
        }
        else if ($jabatan == "KABAG BO DAN TELLER"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_gol_4s').'"
            </script>';
        }
        else if ($jabatan == "KEPALA BAGIAN OPERASIONAL"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_gol_4s').'"
            </script>';
        }
        else if ($jabatan == "KEPALA OPERASI CABANG"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_koc').'"
            </script>';
        }
        else if ($jabatan == "KEPALA BAGIAN CUSTOMER SERVICE"){
            echo $this->include("penilaian/cab_form_gol_4s");
        }
        else if ($jabatan == "ASSOCIATE ACCOUNT OFFICER" OR $jabatan == "ACCOUNT OFFICER" OR $jabatan == "ASSISTANT ACCOUNT OFFICER" OR $jabatan == "STAF ACCOUNT OFFICER" OR $jabatan == "BACK OFFICE SENIOR OPERASIONAL"){
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_ao_reguler').'"
            </script>';
        }
        else {
            echo '<script>
                window.location="'.base_url('penilaian/cab_form_gol_123').'"
            </script>';
        }

    }
    else{
        echo "Belum Memenuhi Hak untuk melakukan Penilaian PA";
    }
?>