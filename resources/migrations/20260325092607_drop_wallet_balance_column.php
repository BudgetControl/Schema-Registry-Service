<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class DropWalletBalanceColumn extends AbstractMigration
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
        $sql = "ALTER TABLE wallets DROP COLUMN balance";
        $this->execute($sql);
    }

    public function down(): void
    {
        $sql = "ALTER TABLE wallets ADD COLUMN balance DECIMAL(15, 2) NOT NULL DEFAULT 0";
        $this->execute($sql);
    }
}
