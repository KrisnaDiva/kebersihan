<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
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
                'username'    => 'admin',
                'password'    => password_hash('admin123', PASSWORD_BCRYPT),
                'role'        => 'admin',
            ],
            [
                'username'    => 'krisna',
                'password'    => password_hash('password', PASSWORD_BCRYPT),
                'role'        => 'pencari',
            ],
            [
                'username'    => 'wisnu',
                'password'    => password_hash('password', PASSWORD_BCRYPT),
                'role'        => 'penyedia',
            ],
        ];

        $this->table('users')->insert($data)->saveData();
    }
}