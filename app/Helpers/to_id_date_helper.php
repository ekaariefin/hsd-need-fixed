<?php

function id_date($date, $singkat = true)
{
    if ($singkat) {
        # code...
        $month = array(
            1 =>       'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Ags',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        );
    } else {

        $month = array(
            1 =>       'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
    }

    $var = explode('-', $date);

    return $var[2] . ' ' . $month[(int)$var[1]] . ' ' . $var[0];
    // var 0 = tanggal
    // var 1 = bulan
    // var 2 = tahun
}
