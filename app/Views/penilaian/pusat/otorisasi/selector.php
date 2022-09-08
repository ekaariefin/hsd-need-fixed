<?php
    $fkode_cab = session()->get('fkode_cab');
    $satuan_kerja = session()->get('satuan_kerja');
    $fgrade = session()->get('fgrade');
    $jabatan = session()->get('jabatan');

    if($fkode_cab == "99") {
        // lokasi kantor pusat
        if ($fgrade == "1" OR $fgrade == "2" OR $fgrade == "3"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_123').'"
            </script>';
        }
        else if ($fgrade == "4" AND $jabatan == "ASSOCIATE OFFICER"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_4f').'"
            </script>';
        }
        else if ($fgrade == "4" AND $jabatan == "KEPALA BAGIAN"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_4s').'"
            </script>';
        }
        else if ($fgrade == "5" AND $jabatan == "OFFICER"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_5f').'"
            </script>';
        }
        else if ($fgrade == "5" AND $jabatan == "KEPALA BIDANG"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_5s').'"
            </script>';
        }
         else if ($fgrade == "5" AND $jabatan == "KEPALA BAGIAN"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_5s').'"
            </script>';
        }
        else if ($fgrade == "6"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_67').'"
            </script>';
        }
        else if ($fgrade == "7"){
            echo '<script>
                window.location="'.base_url('History/HistoryKp/kp_gol_67').'"
            </script>';
        }
        else{
            echo "Undefinied";
            exit();
        }
    }
    
?>