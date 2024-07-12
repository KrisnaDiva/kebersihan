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
            ['nama' => 'Kebersihan rumah'],
            ['nama' => 'Kebersihan rumah baru renovasi'],
            ['nama' => 'Kebersihan ruangan tamu'],
            ['nama' => 'Kebersihan ruang dapur'],
            ['nama' => 'Kebersihan kamar'],
            ['nama' => 'Kebersihan kamar mandi'],
            ['nama' => 'Kebersihan interior rumah'],
            ['nama' => 'Cuci/kering karpet'],
            ['nama' => 'Cuci/kering sofa'],
            ['nama' => 'Cuci/kering springbad'],
            ['nama' => 'Cuci/kering piring'],
            ['nama' => 'Cuci/kering pakaian'],
        ];

        $this->table('keterangan')->insert($data)->saveData();
    }}
