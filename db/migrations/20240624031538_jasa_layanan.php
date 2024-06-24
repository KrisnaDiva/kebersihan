<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class JasaLayanan extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('jasa_layanan');
        $table
            ->addColumn('user_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('keterangan_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('nama_jasa', 'string', ['limit' => 100])
            ->addColumn('harga', 'integer')
            ->addColumn('foto', 'string', ['limit' => 255])
            ->addColumn('no_hp', 'string', ['limit' => 20])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('facebook', 'string', ['limit' => 100])
            ->addColumn('instagram', 'string', ['limit' => 100])

            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('keterangan_id', 'keterangan', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
