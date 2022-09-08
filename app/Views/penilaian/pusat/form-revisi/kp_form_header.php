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
        <td style="width: 30%;"><?= $dataPekerja['fnip']; ?></td>
        <input type="hidden" name="fnip_pekerja" value="<?= $dataPekerja['fnip']; ?>">
        <td style="width: 20%; font-weight:bold">Nama Karyawan</td>
        <td style="width: 30%; text-transform: uppercase;"><?= $dataPekerja['fnama']; ?></td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Jabatan</td>
        <td><?= $dataPekerja['jabatan']; ?> </td>
        <td style="width: 20%; font-weight:bold">Satuan Kerja</td>
        <td><?= $dataPekerja['satuan_kerja']; ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Departemen/Cabang</td>
        <td><?= $dataPekerja['departemen']; ?> </td>
        <td style="width: 20%; font-weight:bold">Fungsi</td>
        <td><?= $dataPekerja['fungsi']; ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Atasan 1</td>
        <td><?= $atasan1_nama['fnama']; ?></td>
        <input type="hidden" name="atasan1" value="<?= $atasan1_fnip['atasan_nip']; ?>">
        <td style="width: 20%; font-weight:bold">Atasan 2</td>
        <td><?= $atasan2_nama['fnama']; ?></td>
        <input type="hidden" name="atasan2" value="<?= $atasan2_fnip['atasan_nip']; ?>">
    </tr>
</table>
