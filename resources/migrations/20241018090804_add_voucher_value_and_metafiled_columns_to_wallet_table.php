<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddVoucherValueAndMetafiledColumnsToWalletTable extends AbstractMigration
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
    public function up(): void
    {
        $this->table('wallets')
            ->addColumn('voucher_value', 'float', ['null' => true])
            ->addColumn('metafield', 'json', ['null' => true])
            ->update();
    }

    public function down(): void
    {
        $this->table('wallets')
            ->removeColumn('voucher_value')
            ->removeColumn('metafield')
            ->update();
    }
}
