<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PhotoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'kawaii neko.jpg',
                'type' => 'image/jpeg',
            ],
            [
                'name' => 'kiyowo namja.png',
                'type' => 'image/png',
            ],
            [
                'name' => 'picrew girl.jpg',
                'type' => 'image/jpeg',
            ],
        ];

        $this->db->table('photos')->insertBatch($data);
    }
}
