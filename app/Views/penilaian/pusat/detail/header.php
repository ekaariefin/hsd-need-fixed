<table class="table table-bordered table-hover">
    <tr>
        <td style="width: 20%; font-weight:bold">NIP</td>
        <td style="width: 30%;"><?= session()->get('fnip'); ?></td>
        <td style="width: 20%; font-weight:bold">Nama Karyawan</td>
        <td style="width: 30%;"><?= session()->get('fnama'); ?></td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Jabatan</td>
        <td><?= $historicalPersonalData[0]['jabatan']; ?> </td>
        <td style="width: 20%; font-weight:bold">Satuan Kerja</td>
        <td><?= $historicalPersonalData[0]['satuan_kerja']; ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Departemen/Cabang</td>
        <td><?= $historicalPersonalData[0]['departemen']; ?> </td>
        <td style="width: 20%; font-weight:bold">Fungsi</td>
        <td><?= $historicalPersonalData[0]['fungsi']; ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Atasan 1</td>
        <td><?= $atasan1['fnama']; ?></td>
        <td style="width: 20%; font-weight:bold">Atasan 2</td>
        <td><?= $atasan2['fnama']; ?></td>
    </tr>
</table>