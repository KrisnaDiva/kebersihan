<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Konsumen extends AbstractSeed
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
                'nama'    => 'John Doe',
                'alamat'  => '123 Main St, Anytown, USA',
                'no_hp'   => '081234567890',
                'email'   => 'john.doe@example.com',
            ]
        ];

        $this->table('konsumen')->insert($data)->saveData();
    }
}