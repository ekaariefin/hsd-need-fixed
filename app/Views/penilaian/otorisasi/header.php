<table class="table table-bordered">
    <tr>
        <td style="width: 20%; font-weight:bold">NIP</td>
        <td style="width: 30%;"><?= $getData['fnip']; ?></td>
        <td style="width: 20%; font-weight:bold">Nama Karyawan</td>
        <td style="width: 30%;"><?= $getData['fnama']; ?></td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Jabatan</td>
        <td><?= $getData['jabatan']; ?> </td>
        <td style="width: 20%; font-weight:bold">Satuan Kerja</td>
        <td><?= $getData['satuan_kerja']; ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Departemen/Cabang</td>
        <td><?= $getData['departemen']; ?> </td>
        <td style="width: 20%; font-weight:bold">Fungsi</td>
        <td><?= $getData['fungsi']; ?> </td>
    </tr>
    <tr>
        <td style="width: 20%; font-weight:bold">Atasan 1</td>
        <td><?= $atasan1; ?></td>
        <td style="width: 20%; font-weight:bold">Atasan 2</td>
        <td><?= $atasan2; ?></td>
    </tr>
</table>
