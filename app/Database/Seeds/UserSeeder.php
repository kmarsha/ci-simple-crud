<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $dataUsers = [
            [
                'username' => 'macca',
                'password' => password_hash('pass', PASSWORD_BCRYPT),
                'role' => 'admin',
            ],
            [
                'username' => 'admin',
                'password' => password_hash('pass', PASSWORD_BCRYPT),
                'role' => 'admin',
            ],
            [
                'username' => 'karyawan',
                'password' => password_hash('pass', PASSWORD_BCRYPT),
                'role' => 'karyawan',
            ],
            [
                'username' => 'marshaa',
                'password' => password_hash('pass', PASSWORD_BCRYPT),
                'role' => 'karyawan',
            ],
            [
                'username' => 'caa',
                'password' => password_hash('pass', PASSWORD_BCRYPT),
                'role' => 'karyawan',
            ],
        ];

        $this->db->table('users')->insertBatch($dataUsers);

        $dataAdmins = [
            [
                'user_id' => '1',
                'nama' => 'Marsha K'
            ],
            [
                'user_id' => '2',
                'nama' => 'Si Admin A'
            ],
        ];

        $this->db->table('admins')->insertBatch($dataAdmins);

        $dataKaryawans = [
            [
                'id_user' => 3,
                'nama_karyawan' => 'Karyawan',
                'usia' => 22,
            ],
            [
                'id_user' => 4,
                'nama_karyawan' => 'Marshaa',
                'usia' => 12,
            ],
            [
                'id_user' => 5,
                'nama_karyawan' => 'Caa',
                'usia' => 11,
            ],
        ];

        $this->db->table('employees')->insertBatch($dataKaryawans);
    }
}
