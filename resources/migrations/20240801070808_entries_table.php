<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class EntriesTable extends AbstractMigration
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
        $this->table('entries')
            ->addIndex(['uuid'], ['unique' => true])
            ->addColumn('date_time', 'datetime')
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('uuid', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('amount', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('note', 'text', ['null' => true])
            ->addColumn('type', 'string', ['limit' => 255])
            ->addColumn('warranty', 'boolean', ['default' => false])
            ->addColumn('transfer', 'boolean', ['default' => false])
            ->addColumn('confirmed', 'boolean', ['default' => false])
            ->addColumn('planned', 'boolean', ['default' => false])
            ->addColumn('installment', 'boolean', ['default' => false])
            ->addColumn('category_id', 'integer', [ 'signed' => false, 'null' => false])
            ->addColumn('account_id', 'integer', [ 'signed' => false, 'null' => false])
            ->addColumn('transfer_id', 'integer', [ 'signed' => false, 'null' => true])
            ->addColumn('transfer_relation', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('currency_id','integer', [ 'signed' => false, 'null' => false])
            ->addColumn('payment_type_id','integer', [ 'signed' => false, 'null' => false, 'default' => 1])
            ->addColumn('payee_id','integer', [ 'signed' => false, 'null' => true])
            ->addColumn('waranty', 'boolean', ['default' => false])
            ->addColumn('geolocation', 'point', ['null' => true])
            ->addColumn('workspace_id','integer', [ 'signed' => false, 'null' => false])
            ->addColumn('exclude_from_stats', 'boolean', ['default' => false])
            ->addIndex(['category_id'])
            ->addIndex(['account_id'])
            ->addIndex(['transfer_id'])
            ->addIndex(['currency_id'])
            ->addIndex(['payment_type_id'])
            ->addIndex(['payee_id'])
            ->addIndex(['workspace_id'])
            ->addIndex('id', ['unique' => true])
            ->create();
    }
}
