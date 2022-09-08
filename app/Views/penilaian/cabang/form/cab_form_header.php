<?php
    //MARK: COUNT LEFT DAYS
    date_default_timezone_set("Asia/Jakarta");
    $date_start     = strtotime($date['date_start']);
    $date_end       = strtotime($date['date_end']);
    $current_date   = strtotime(date("Y-m-d"));
    $diff = floor($date_end - $current_date)/60/60/24;
    
    if((int)$diff < 0){
        session()->setFlashdata('swal_icon', 'error');
        session()->setFlashdata('swal_title', 'Maaf!');
        session()->setFlashdata('swal_text', 'Waktu Isi Formulir PA Telah Berakhir!');
    }
?>
<table class="table table-bordered table-hover">
    <tr>
        <td style="width: 20%; font-weight:bold">NIP</td>
        <td style="width: 30%;"><?= session()->get('fnip'); ?></td>
        <td style="width: 20%; font-weight:bold">Nama Karyawan</td>
        <td style="width: 30%; text-transform: uppercase;"><?= session()->get('fnama'); ?></td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Jabatan</td>
        <td><?= session()->get('jabatan'); ?> </td>
        <td style="width: 20%; font-weight:bold">Satuan Kerja</td>
        <td><?= session()->get('satuan_kerja'); ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Departemen/Cabang</td>
        <td><?= session()->get('departemen'); ?> </td>
        <td style="width: 20%; font-weight:bold">Fungsi</td>
        <td><?= session()->get('fungsi'); ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Atasan 1</td>
        <td><?= session()->get('atasan1.nama'); ?></td>
        <input type="hidden" name="atasan1" value="<?= session()->get('atasan1.nip'); ?>">
        <td style="width: 20%; font-weight:bold">Atasan 2</td>
        <td><?= session()->get('atasan2.nama'); ?></td>
        <input type="hidden" name="atasan2" value="<?= session()->get('atasan2.nip'); ?>">
    </tr>
</table>
