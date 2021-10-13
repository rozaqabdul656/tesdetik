<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Transaksipembayaran extends AbstractMigration
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
        $users = $this->table('transaksi_pembayaran', array('id' => 'id_pembayaran'));

        // buat kolom-kolom untuk transaksi pembayaran
        $users->addColumn('invoice_id', 'string', ['limit' => 64])
            ->addColumn('references_id', 'string', ['limit' => 64])
            ->addColumn('item_name', 'string', ['limit' => 64])
            ->addColumn('amount', 'string', ['limit' => 20])
            ->addColumn('payment_type', 'enum', ['values' => ['VA','CC']])
            ->addColumn('customer_name','string', ['limit' => 255])
            ->addColumn('merchant_id', 'string', ['limit' => 20])
            ->addColumn('status', 'string', ['limit' => 10])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
