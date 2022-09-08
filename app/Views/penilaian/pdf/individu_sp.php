<table class="table table-bordered" style="margin-top: 20px;">
    <tr>
        <td class="bcas-cell" colspan="4" style="background-color:#c9c9c9">
            <b>PENGURANGAN PA (SANKSI)</b>
        </td>
    </tr>
    <tr>
        <td class='bcas-cell' style="width: 10%; text-align: center; font-weight: bold">Poin Sanksi</td>
        <td class='bcas-cell' style="width: 15%; text-align: center; font-weight: bold">Jenis Sanksi</td>
        <td class='bcas-cell' style="width: 20%; text-align: center; font-weight: bold">Nomor Sanksi</td>
        <td class='bcas-cell' style="width: 20%; text-align: center; font-weight: bold">Tahun Sanksi</td>
    </tr>
    <tr>
        <?php
        if (empty($sp['poin_sp']) and empty($sp['nomor_sp'])) {
            echo "
                                <td class='bcas-cell' colspan='4'><center><i>Tidak ditemukan data surat peringatan tahun berjalan</i></center></td>
                                ";
        } else {
            echo "  <td class='bcas-cell'><center>" . $sp['poin_sp'] . "</center></td>
                                        <td class='bcas-cell'><center>" . $sp['jenis_sp'] . "</center></td>
                                        <td class='bcas-cell'><center>" . $sp['nomor_sp'] . "</center></td>
                                        <td class='bcas-cell'><center>" . $sp['tahun_sp'] . "</center></td>";
        }
        ?>
    </tr>
</table>