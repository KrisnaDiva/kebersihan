<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Pemesanan extends AbstractMigration
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
        $table = $this->table('pemesanan');
        $table->addColumn('user_id', 'integer',['null' => false, 'signed' => false])
            ->addColumn('jasa_layanan_id', 'integer',['null' => false, 'signed' => false])
            ->addColumn('tanggal_pesan', 'datetime')
            ->addColumn('status', 'enum', ['values' => ['pending', 'diterima', 'ditolak'], 'default' => 'pending'])
            ->addColumn('catatan', 'text')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('jasa_layanan_id', 'jasa_layanan', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
