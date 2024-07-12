<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Pemesanan extends AbstractSeed
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
                'user_id' => 2,
                'jasa_layanan_id' => 1,
                'layanan' => 'Cuci/kering sofa',
                'harga' => 25252,
                'tanggal_pesan' => '2024-06-24 15:07:57',
                'catatan' => 'Pesan jasa layanan',
            ],
        ];

        $table = $this->table('pemesanan');
        $table->insert($data)
            ->save();
    }
}
