<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Keterangan extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Mencuci Piring',
            ],
            [
                'nama' => 'Menyetrika Pakaian',
            ],
            [
                'nama' => 'Membersihkan Kamar Mandi',
            ],
            [
                'nama' => 'Menyapu dan Mengepel',
            ],
            [
                'nama' => 'Membersihkan Taman',
            ],
            [
                'nama' => 'Mencuci Pakaian',
            ],
            [
                'nama' => 'Memvakum Sofa atau Tempat Tidur',
            ],

        ];

        $this->table('keterangan')->insert($data)->saveData();
    }
}
