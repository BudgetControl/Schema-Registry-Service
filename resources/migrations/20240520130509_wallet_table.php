<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class WalletTable extends AbstractMigration
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
        $this->table('wallets')
            ->addColumn('uuid', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('color', 'string', ['limit' => 70])
            ->addColumn('type', \Phinx\Util\Literal::from('wallet'), ['null' => false])
            ->addColumn('installement', 'boolean', ['default' => false])
            ->addColumn('installement_value', 'float', ['null' => true])
            ->addColumn('credit_limit', 'decimal', ['precision' => 10, 'scale' => 2, 'null' => true])
            ->addColumn('currency', 'string', ['limit' => 3])
            ->addColumn('balance', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('exclude_from_stats', 'boolean', ['default' => false])
            ->addColumn('invoice_date', 'date')
            ->addColumn('payment_account', 'integer')
            ->addColumn('closing_date', 'date')
            ->addColumn('sorting', 'integer')
            ->addColumn('workspace_id','integer', [ 'signed' => false, 'null' => false])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addIndex('uuid', ['unique' => true])
            ->addIndex('workspace_id')
            ->addIndex('id', ['unique' => true])
            ->create();
    }
}
