<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PlannedEntriesTable extends AbstractMigration
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
        $this->table('planned_entries')
            ->addColumn('date_time', 'datetime')
            ->addColumn('end_date_time', 'datetime')
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('uuid', 'string', ['limit' => 36, 'null' => false])
            ->addColumn('amount', 'float', ['null' => false])
            ->addColumn('note', 'text', ['null' => true])
            ->addColumn('planning', \Phinx\Util\Literal::from('planning'), ['limit' => 255])
            ->addColumn('type', \Phinx\Util\Literal::from('entry'), ['null' => false])
            ->addColumn('warranty', 'boolean', ['default' => false])
            ->addColumn('transfer', 'boolean', ['default' => false])
            ->addColumn('confirmed', 'boolean', ['default' => false])
            ->addColumn('planned', 'boolean', ['default' => true])
            ->addColumn('category_id', 'integer')
            ->addColumn('account_id', 'integer')
            ->addColumn('transfer_id', 'integer', ['null' => true])
            ->addColumn('currency_id', 'integer')
            ->addColumn('payment_type', 'string', ['limit' => 255])
            ->addColumn('payee_id', 'integer')
            ->addColumn('geolocation_id', 'integer', ['null' => true])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addColumn('workspace_id','integer', [ 'signed' => false, 'null' => false])
            ->addIndex(['uuid'], ['unique' => true])
            ->addIndex(['category_id'])
            ->addIndex(['account_id'])
            ->addIndex(['transfer_id'])
            ->addIndex(['currency_id'])
            ->addIndex(['payment_type'])
            ->addIndex(['payee_id'])
            ->addIndex(['workspace_id'])
            ->addIndex('id', ['unique' => true])
            ->create();
    }
}
