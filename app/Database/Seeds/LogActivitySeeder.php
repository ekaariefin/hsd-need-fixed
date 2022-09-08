<?php

namespace App\Database\Seeds;

use App\Models\Auth\M_Auth;
use App\Models\PekerjaModel;
use App\Models\Trail;
use CodeIgniter\Database\Seeder;

class LogActivitySeeder extends Seeder
{
    public function run()
    {
        $logModel = new Trail();
        $authModel = new M_Auth();
        $userid = $authModel->select('userid')->notLike('userid', 'admin%')->get()->getResultArray();
        $user_count = count($userid);
        $user = $userid[rand(0, $user_count - 1)]["userid"];

        // $data = array_combine($user[]['userid'], $pekerja[]['fnama']);



        $faker = \Faker\Factory::create();

        $kode = array('ADDED COACHING', 'DELETED COACHING', 'UPDATED EMPLOYEE (BATCH)', 'UPDATED EMPLOYEE', 'UPDATED EMPLOYEE SPV',  'UPDATED COACHING');
        $browser = array('Firefox 102.0', 'Chrome 103.0.0.0');

        $data = [];

        $a = 0;
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $d = explode('Physical Address. . . . . . . . .', shell_exec("ipconfig/all"));
            $d1 = explode(':', $d[1]);
            $d2 = explode(' ', $d1[1]);

            $mac = $d2[1];
            // echo 'This is a server using Windows!';
        } else {
            $mac = "LINUX";
            // echo 'This is a server not using Windows!';
        }

        $ip = ":::";

        for ($i = 0; $i < 10000; $i++) {

            $activity = $kode[rand(0, 5)];
            $brows = $browser[rand(0, 1)];
            $user = $userid[rand(0, $user_count - 1)]["userid"];



            $data[] = [
                'activity_code' => $activity,
                'user_agent' => $brows,
                'ip_address' => "$ip",
                // 'mac_address' => "$mac",
                'user_id' => "$user",
                'user_name' => $faker->name(),
            ];
        }
        $logModel->insertBatch($data);

        // print_r($data);
        // $logModel->save(
        //     $data
        // );
    }
}
