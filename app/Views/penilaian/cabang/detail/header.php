<table class="table table-bordered table-hover">
    <tr>
        <td style="width: 20%; font-weight:bold">NIP</td>
        <td style="width: 30%;"><?= session()->get('fnip'); ?></td>
        <td style="width: 20%; font-weight:bold">Nama Karyawan</td>
        <td style="width: 30%;"><?= session()->get('fnama'); ?></td>
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
        <td style="width: 20%; font-weight:bold">Atasan 2</td>
        <td><?= session()->get('atasan2.nama'); ?></td>
    </tr>
</table>
