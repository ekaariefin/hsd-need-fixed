<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;


class Coaching extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true, 'primary_key' => true],
            'fnip_atasan' => ['type' => 'VARCHAR', 'constraint' => 15],
            'fnip_karyawan' => ['type' => 'VARCHAR', 'constraint' => 15],

            'periode_coaching' => ['type' => 'VARCHAR', 'constraint' => 255],
            'waktu_coaching' => ['type' => 'date'],


            'sarbis1' => ['type' => 'text'],
            'target_tercapai1' => ['type' => 'text', 'null' => true],
            'sarbis2' => ['type' => 'text', 'null' => true],
            'target_tercapai2' => ['type' => 'text', 'null' => true],
            'sarbis3' => ['type' => 'text', 'null' => true],
            'target_tercapai3' => ['type' => 'text', 'null' => true],
            'sarbis4' => ['type' => 'text', 'null' => true],
            'target_tercapai4' => ['type' => 'text', 'null' => true],
            'sarbis5' => ['type' => 'text', 'null' => true],
            'target_tercapai5' => ['type' => 'text', 'null' => true],
            'sarbis6' => ['type' => 'text', 'null' => true],
            'target_tercapai6' => ['type' => 'text', 'null' => true],
            'sarbis7' => ['type' => 'text', 'null' => true],
            'target_tercapai7' => ['type' => 'text', 'null' => true],
            'sarbis8' => ['type' => 'text', 'null' => true],
            'target_tercapai8' => ['type' => 'text', 'null' => true],
            'sarbis9' => ['type' => 'text', 'null' => true],
            'target_tercapai9' => ['type' => 'text', 'null' => true],
            'sarbis10' => ['type' => 'text', 'null' => true],
            'target_tercapai10' => ['type' => 'text', 'null' => true],



            'budaya_kerja1' => ['type' => 'text'],
            'budaya_kerja2' => ['type' => 'text', 'null' => true],
            'budaya_kerja3' => ['type' => 'text', 'null' => true],
            'budaya_kerja4' => ['type' => 'text', 'null' => true],
            'budaya_kerja5' => ['type' => 'text', 'null' => true],
            'budaya_kerja6' => ['type' => 'text', 'null' => true],
            'budaya_kerja7' => ['type' => 'text', 'null' => true],
            'budaya_kerja8' => ['type' => 'text', 'null' => true],
            'budaya_kerja9' => ['type' => 'text', 'null' => true],
            'budaya_kerja10' => ['type' => 'text', 'null' => true],


            'saran_dukungan' => ['type' => 'text'],

            'status'      => [
                'type'           => 'ENUM',
                'constraint'     => ['publish', 'pending'],
                'default'        => 'pending',
            ],


            'created_at' => ['type' => 'datetime']
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('fnip_atasan', 'pekerja', 'fnip');
        $this->forge->addForeignKey('fnip_karyawan', 'pekerja', 'fnip');
        $this->forge->createTable('coaching');
    }

    public function down()
    {
        $this->forge->dropTable('coaching');
    }
}





// CREATE TABLE `coaching` (
//     `id` INT NOT NULL AUTO_INCREMENT,
//     `fnip_atasan` VARCHAR(15) NOT NULL,
//     `fnip_karyawan` VARCHAR(15) NOT NULL,
//     `periode_coaching` VARCHAR(255) NOT NULL,
//     `waktu_coaching` date NOT NULL,
//     `sarbis1` text NOT NULL,
//     `target_tercapai1` text NULL,
//     `sarbis2` text NULL,
//     `target_tercapai2` text NULL,
//     `sarbis3` text NULL,
//     `target_tercapai3` text NULL,
//     `sarbis4` text NULL,
//     `target_tercapai4` text NULL,
//     `sarbis5` text NULL,
//     `target_tercapai5` text NULL,
//     `sarbis6` text NULL,
//     `target_tercapai6` text NULL,
//     `sarbis7` text NULL,
//     `target_tercapai7` text NULL,
//     `sarbis8` text NULL,
//     `target_tercapai8` text NULL,
//     `sarbis9` text NULL,
//     `target_tercapai9` text NULL,
//     `sarbis10` text NULL,
//     `target_tercapai10` text NULL,
//     `budaya_kerja1` text NOT NULL,
//     `budaya_kerja2` text NULL,
//     `budaya_kerja3` text NULL,
//     `budaya_kerja4` text NULL,
//     `budaya_kerja5` text NULL,
//     `budaya_kerja6` text NULL,
//     `budaya_kerja7` text NULL,
//     `budaya_kerja8` text NULL,
//     `budaya_kerja9` text NULL,
//     `budaya_kerja10` text NULL,
//     `saran_dukungan` text NOT NULL,
//     `status` ENUM('publish','pending') NOT NULL DEFAULT 'pending',
//     `created_at` datetime NOT NULL,
//     CONSTRAINT `pk_coaching` PRIMARY KEY(`id`),
//     CONSTRAINT `coaching_fnip_atasan_foreign` FOREIGN KEY (`fnip_atasan`) REFERENCES `pekerja`(`fnip`),
//     CONSTRAINT `coaching_fnip_karyawan_foreign` FOREIGN KEY (`fnip_karyawan`) REFERENCES `pekerja`(`fnip`)
// )