<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pribadi Karyawan - <?= session()->get('fnama') ?></title>

</head>

<body>
                 Nama :         <?= session()->get('fnama'); ?> <br/>
                 NIP :          <?= session()->get('fnip'); ?> <br/>
                 Jabatan :      <?= session()->get('jabatan'); ?> <br/>
                 Satuan Kerja : <?= session()->get('satuan_kerja'); ?> <br/>
                 Departemen :   <?= session()->get('departemen'); ?> <br/>
                 Fungsi :       <?= session()->get('fungsi'); ?> <br/>
                 Bidang :       <?= session()->get('bidang'); ?> <br/>
                 Grade :        <?= session()->get('fgrade'); ?> <br/>
                 Kantor :       <?= session()->get('fkode_cab'); ?>


                 <br/><br/>
                 Nama Atasan 1:<br/>
                 
                 <?= session()->get('atasan1.nama'); ?>

                 <br/><br/>
                 Nama Atasan 2:<br/>
                 <?php
                    if(session()->get('atasan2.nip') <= 0){
                        echo "Tidak Ada Data";
                    }
                    else {
                        echo session()->get('atasan2.nama');
                    }
                ?>

</body>

</html>